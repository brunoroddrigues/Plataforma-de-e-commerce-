<?php
    require_once "cabecalho1.php";
?>
   <style>
        * {box-sizing:border-box}

  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}



.mySlides {
  display: none;
  width: 100%;
  height: 100%;
   
}

.mySlides img {

  box-shadow: 11px 13px 19px 4px rgba(16, 16, 181, 1), -9px -16px 16px 4px rgba(0, 0, 255, 1);
}


.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}


.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}


.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}


.text {
  color: white; 
  font-size: 50px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
  font-family: 'Times New Roman', Times, serif;
  background-image: linear-gradient(to bottom, black, blue, black); /* Mudando a cor do degradê para azul */
  border: 2px solid blue; 
}




.numbertext {
  color: blue;
  font-size: 16px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}


.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: blue; /* Mudando a cor dos pontos ativos e ao passar o mouse para azul */
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}
@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
    </style>
</head>
<body>
    </div>
    <header>
        <h1>Camisas de time</h1>
        <nav>
            <ul>
                <?php
                    require_once "menu.php";
                ?>
            </ul>
        </nav>
    </header>
    <main>
        <!-- Slideshow container -->
<div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
   
        
      <div class="mySlides fade">
        <div class="numbertext">1 / 1</div>
        <a href="index.php?controle=produtoController&metodo=buscar_todos"><img src="img/capa.jpg" style="width:1000px" height="700px"></a>
        <div class="text">Loja</div>
      </div>

      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
      
      
      
  </div>
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
  </div>
  <br>




    </main>
    <style>

  .container {
    width: 80%; 
    margin: 0 auto; 
    font-family: Arial, sans-serif; 
  }

  .section {
    display: flex;
    flex-direction: column; 
    justify-content: flex-start;
    margin-bottom: 20px;
  }

  .section p {
    margin: 0; 
    line-height: 1.6; 
  }

  .section strong {
    font-weight: bold;
    margin-bottom: 20px;
    text-align: center; 
    width: 100%; 
  }

 
  .missao p, .visao p, .valores p {
    word-break: break-word; 
  }
</style>

<div class="container">
  <div class="section missao">
    <p><strong>Missão:</strong><br>
      Proporcionar aos fãs de futebol uma experiência de compra única,<br>
      oferecendo camisas de times com qualidade, conforto e autenticidade,<br>
      para que cada cliente possa expressar sua paixão pelo esporte com estilo.</p>
  </div>
  <br>
  <div class="section visao">
    <p><strong>Visão:</strong><br>
      Ser a principal plataforma de e-commerce de camisas de times,<br>
      reconhecida pela excelência na qualidade dos produtos,<br>
      pela diversidade de opções e pelo atendimento diferenciado ao cliente.</p>
  </div>
  <br>
  <div class="section valores">
    <p><strong>Valores:</strong><br>
      Compromisso com a qualidade, atendimento ao cliente de excelência,<br>
      variedade e exclusividade de produtos, paixão pelo esporte e pelo futebol,<br>
      ética e transparência em todas as nossas ações.</p>
  </div>
</div>


    <footer>
    <p>&copy; 2024 BN - CAMISAS DE TIMES </a><br>
    R. Frei Galvão - Jardim Pedro Ometto, Jaú - SP, 17212-599
  </p>
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d17557.55927827929!2d-48.5508488077036!3d-22.315001495830753!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c7583ac8032c15%3A0xd3db07d9284a5cb2!2sFaculdade%20de%20Tecnologia%20de%20Jahu!5e0!3m2!1spt-BR!2sbr!4v1733185083009!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </footer>
    
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
    <!-- Fim do Código VLibras -->
    <script src="js/script.js"></script>
</body>
</html>
