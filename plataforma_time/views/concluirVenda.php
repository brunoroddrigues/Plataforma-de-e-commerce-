<?php
require_once "cabecalho1.php";
?>
   <style>
    body {
        background: linear-gradient(to bottom, black, blue); /* Alterado para azul */
        color: white;
        font-family: Arial, sans-serif;
    }
    h1, h2, h3, p {
        margin: 0;
    }
    main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100vh - 150px);
    }
    section {
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 18px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        text-align: center;
        width: 80%;
        max-width: 800px;
        margin: auto;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
        border-radius: 5px;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid #444;
        text-align: center;
    }
    th {
        background-color: rgba(0, 0, 0, 0.8);
    }
    td img {
        width: 100px;
        border: none; 
    }
    .actions {
        margin-top: 20px;
    }
    .actions a {
        text-decoration: none;
        background-color: #1E90FF; /* Alterado para azul */
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        margin: 5px;
    }
    .actions a:hover {
        background-color: #4682B4; /* Alterado para azul mais escuro */
    }
    h3 {
        color: white;
    }

    form {
        display: flex;
        justify-content: center; 
        align-items: center;   

        width: 90%;             
        margin: 0;               
    }

    /* Estilos do select */
    form select[name="Forma_pagamento"] {
        padding: 2px;
        background-color: rgba(0, 0, 0, 0.8);  /* Fundo escuro */
        color: white;  /* Texto branco */
        border: 2px solid #1E90FF;  /* Borda azul */
        border-radius: 8px;  /* Cantos arredondados */
        font-size: 16px;  /* Tamanho da fonte */
        width: 60%;  /* Largura do campo */
        margin-top: 10px;  /* Espaço acima do campo */
    }
</style>

</head>
<body>
    <header>
        <nav>
            <ul>
                <?php
                    require_once "menu.php";
                ?>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <?php
            // Exibir mensagem de sucesso ou erro
            if (isset($mensagem_sucesso)) {
                echo "<h1>$mensagem_sucesso</h1>";
                
                // Exibir mensagens adicionais após a finalização da venda
                echo "<p style='font-size: 18px; color: white;'>A sua compra será entregue no endereço cadastrado.</p>";
                echo "<p style='font-size: 18px; color: red; font-weight: bold;'>Obrigado!! Até a próxima!</p>";
            } elseif (isset($mensagem_erro)) {
                echo "<p style='color: white;'>$mensagem_erro</p>";
            }
            ?>
            
            <?php if (!isset($mensagem_sucesso)) { ?>
            <h3>Escolha a Forma de Pagamento</h3>
            <form action="index.php?controle=concluir_vendaController&metodo=finalizar_compra" method="post">
                <p>Forma de Pagamento:
                    <select name="Forma_pagamento" required>
                        <option value="0">Escolha uma forma de Pagamento</option>
                        <option value="1">PIX</option>
                        <option value="2">Boleto bancário</option>
                    </select>
                </p>
                <button type="submit">Concluir Venda</button>
            </form>
            <?php } ?>

            <?php
                // PIX
                if (isset($qrcode)) {
                    echo '<img src="'.$qrcode.'" alt="QRCode pix">';
                }
            ?>

            <h3>Detalhes do Pedido</h3>
            <p>Estimativa de Entrega: <?php echo date('d/m/Y', strtotime('+7 days')); ?></p>

            <table>
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $subtotal = 0;
                    $total = 0;
                    foreach ($_SESSION["carrinho"] as $dado) {
                        $subtotal = $dado["preco"] * $dado["quantidade"];
                        $total += $subtotal;
                        echo "<tr>
                                <td><img src='img/{$dado['imagem']}'></td>
                                <td class='nome'>{$dado["nome"]}</td>
                                <td>R$ " . number_format($dado["preco"], 2, ",", ".") . "</td>
                                <td style='text-align:center'>{$dado['quantidade']}</td>
                                <td>R$ " . number_format($subtotal, 2, ",", ".") . "</td>
                              </tr>";
                    }
                    ?>
                    <tr>
                        <th colspan='4'>Total da compra:</th>
                        <th>R$ <?php echo number_format($total, 2, ",", "."); ?></th>
                    </tr>
                </tbody>
            </table>
            <h3 style="color: white; display: inline;">Informações de Contato <span style="font-weight: bold; color: blue;"></span></h3>
            <p>Se você tiver qualquer dúvida, entre em contato conosco pelo e-mail camisasdetime@gmail.com ou pelo telefone (14) 9.9614-9608</p>
            <div class="actions">
                <a href="index.php">Voltar à página inicial</a>
            </div>
        </section>
    </main>
  
     <!-- Início do Código VLibras -->
     <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script>
        (function() {
            var script = document.createElement('script');
            script.src = 'https://vlibras.gov.br/app/vlibras-plugin.js';
            script.async = true;
            script.onload = function() {
                new window.VLibras.Widget('https://vlibras.gov.br/app');
            };
            document.head.appendChild(script);
        })();
    </script>
</body>
</html>
