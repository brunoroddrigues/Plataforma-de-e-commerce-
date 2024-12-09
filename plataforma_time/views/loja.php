<?php
    require_once "cabecalho1.php";
?>
</head>
<body>
    <header>
        <h1>Loja</h1>
        <nav>
            <ul>  
                <?php
                    require_once "menu.php";
                ?>
            </ul>
            <a href="index.php?controle=carrinhoController&metodo=exibir"><i class="fas fa-shopping-cart carrinho-icon" onclick="window.location.href='carrinho.html'"></i></a>
        </nav>
    </header>
    <main class="produtos-background">
    <div class="centralizar_produtos">
        <?php
        //vou puchar dinamicamente no banco de dados
        foreach($retorno as $dado)
        {
            $preco = number_format($dado->preco,2,',','.'); // aqui chama a função do botao carrinho..
            echo"<section class='produto'>
            <a href='index.php?controle=produtoController&metodo=mostrar_detalhes_produto&id={$dado->idproduto}'><img src='img/{$dado->imagem}' alt='{$dado->nome}' width='200px'></a>
            <h2 class='tauri-regular'>{$dado->nome}</h2>
            <p class='preco-texto'>Preço: <span class='preco'>R$ $preco</span></p>
            <a href='index.php?controle=produtoController&metodo=adicionar_carrinho&idproduto={$dado->idproduto}' class = 'btn1'>Adicionar Carrinho
            </a> 
            </section>";
        }
        ?>
    </div>
    </main>
    <footer>
    <p>&copy; 2024 BN - CAMISAS DE TIMES </a><br>
    R. Frei Galvão - Jardim Pedro Ometto, Jaú - SP, 17212-599
  </p>
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17557.55927827929!2d-48.5508488077036!3d-22.315001495830753!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c7583ac8032c15%3A0xd3db07d9284a5cb2!2sFaculdade%20de%20Tecnologia%20de%20Jahu!5e0!3m2!1spt-BR!2sbr!4v1733185083009!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </footer>
     <!-- Início do Código VLibras -->
     <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>

    <!-- Script para carregar o VLibras de forma assíncrona -->
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
    <!-- Fim do Código VLibras -->
</body>
</html>
