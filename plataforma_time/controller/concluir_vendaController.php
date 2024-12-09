<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once "models/conexao.php";
require_once "models/itens.php";
require_once "models/formapagamentoDAO.php";
require_once "models/forma_pagamento.php";
require_once "models/venda.php";
require_once "models/vendaDAO.php";
require_once "models/usuario.php";
require_once "models/usuarioDAO.php";
require_once "models/produto.php";
require_once "openboleto-master/src/BoletoAbstract.php";
require_once "openboleto-master/src/Agente.php";
require_once "openboleto-master/src/Banco/BancoDoBrasil.php";

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Dompdf\Dompdf;
use OpenBoleto\Agente;
use OpenBoleto\Banco\BancoDoBrasil;

class concluir_vendaController
{
    public function finalizar_compra()
    {
        // Verificar se o carrinho está vazio
        if (empty($_SESSION["carrinho"])) {
            // Redirecionar de volta para o carrinho ou página de produtos
            header("Location: index.php?controle=carrinhoController&metodo=exibir");
            die();
        }

        // Fazer aqui o método do PIX

        // Verificar se há POST e se a forma de pagamento foi selecionada
        if ($_POST && isset($_POST["Forma_pagamento"]) && $_POST["Forma_pagamento"] != "0") {
            $forma_pagamento = new forma_pagamento($_POST["Forma_pagamento"]);
            $usuario = new usuario($_SESSION["idusuario"]);
            $venda = new venda(0, date("Y-m-d"), $forma_pagamento, array(), $usuario);
            $total = 0;
            foreach ($_SESSION["carrinho"] as $value) {
                $produto = new produto($value["idproduto"]);
                $venda->setItens(0, $value["quantidade"], null, $value["preco"], $produto);
                $total += $value["quantidade"] * $value["preco"];
            }

            // Gerar QRCode
            if ($_POST["Forma_pagamento"] == 1) {
                $payloadPIX = $this->gerarPayloadPIX('43941428810', 'Banco do Brasil', 'PEDERNEIRAS', $total);

                $options = new QROptions([
                    'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                    'eccLevel' => QRCode::ECC_L,
                    'scale' => 5,
                ]);

                $qrcode = (new QRCode($options))->render($payloadPIX);
            }

            // Gerar Boleto
            if ($_POST["Forma_pagamento"] == 2) {

                $cedente = new Agente(
                    'BN Camisas de time Ltda.',
                    '05.055.456/0001-72',
                    'Rua Exemplo, 123 - Centro',
                    '17280000',
                    'Pederneiras',
                    'SP'
                );

                $sacado = new Agente(
                    '',
                    '123.456.789-00',
                );

                $boleto = new BancoDoBrasil([
                    'dataVencimento' => new DateTime('+5 days'), // Data de vencimento
                    'valor' => $total, // Valor do boleto
                    'sequencial' => 1234567, // Nosso número
                    'sacado' => $sacado,
                    'cedente' => $cedente,
                    'agencia' => 1899, // Agência sem dígito
                    'conta' => 73573, // Conta sem dígito
                    'convenio' => 1234567, // Número do convênio com o banco
                    'carteira' => 18, // Carteira de cobrança (consulte seu banco)
                    'descricaoDemonstrativo' => [
                        'Pagamento de compra na Minha Empresa Ltda',
                        "Produto XYZ - R$ $total",
                    ],
                    'instrucoes' => [
                        '- Não receber após o vencimento.',
                        '- Após vencimento, multa de 2% e juros de 0,33% ao dia.',
                    ],
                ]);

                $html = $boleto->getOutput();
                
                $domPdf = new Dompdf();
                $domPdf->loadHtml($html);

                $domPdf->setPaper('A4');

                $domPdf->render();

                $domPdf->stream("boleto.pdf", ["Attachment" => false]);
            }

            $vendaDAO = new vendaDAO();
            $vendaDAO->inserir($venda);

            // Após processar a venda, exibir mensagem de sucesso
            $mensagem_sucesso = "Seu pedido foi concluído com sucesso!";

            $_SESSION["carrinho"] = [];
        } elseif ($_POST) {
            // Se a forma de pagamento não for selecionada
            $mensagem_erro = "Por favor, escolha uma forma de pagamento para concluir o pedido.";
        }

        // Buscar formas de pagamento
        $forma_pagamento = new formapagamentoDAO();
        $retorno = $forma_pagamento->buscar_formapagamento();

        require_once "views/concluirVenda.php";
        die();
    }

    private function gerarPayloadPIX($chave, $nome, $cidade, $valor, $descricao = '') {
        $emv = [
            '00' => '01', // Identificador do payload
            '26' => [ // Dados do Merchant Account
                '00' => 'BR.GOV.BCB.PIX', // Domínio do PIX (fixo)
                '01' => $chave // Chave PIX (pode ser CPF, e-mail, etc.)
            ],
            '52' => '0000', // Merchant Category Code
            '53' => '986',  // Moeda (986 = BRL)
            '54' => number_format($valor, 2, '.', ''), // Valor
            '58' => 'BR',   // País
            '59' => substr($nome, 0, 25), // Nome do beneficiário (máximo 25 caracteres)
            '60' => substr($cidade, 0, 15), // Cidade (máximo 15 caracteres)
            '62' => [ // Dados adicionais
                '05' => $descricao, // Descrição ou identificador da transação
            ]
        ];
    
        // Função recursiva para montar o payload em formato EMV
        $montarPayload = function ($dados) use (&$montarPayload) {
            $resultado = '';
            foreach ($dados as $id => $valor) {
                if (is_array($valor)) {
                    $valor = $montarPayload($valor);
                }
                $resultado .= $id . str_pad(strlen($valor), 2, '0', STR_PAD_LEFT) . $valor;
            }
            return $resultado;
        };
    
        $payload = $montarPayload($emv);
        $payload .= '6304'; // Adicionar campo do CRC16 no final
    
        // Calcular o CRC16
        $crc = strtoupper(dechex($this->crc16($payload)));
        return $payload . str_pad($crc, 4, '0', STR_PAD_LEFT);
    }

    // Função para calcular o CRC16
    private function crc16($string) {
        $polynomial = 0x1021;
        $crc = 0xFFFF;
    
        foreach (str_split($string) as $char) {
            $crc ^= ord($char) << 8;
            for ($i = 0; $i < 8; $i++) {
                if ($crc & 0x8000) {
                    $crc = ($crc << 1) ^ $polynomial;
                } else {
                    $crc = $crc << 1;
                }
            }
        }
    
        return $crc & 0xFFFF;
    }
}
?>
