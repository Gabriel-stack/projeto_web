<?php include('config.php');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/sobre.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/header.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/footer.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Bungee+Outline&family=Hanalei+Fill&family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hanalei+Fill&family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <title>Sobre</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
</head>
<body>
<header class="conteudo-header">
        <div class="imagem">
            <a href="<?php echo INCLUDE_PATH;?>">
                <img class ="logo" src="img/logo-branca.png"></img>
            </a>
        </div>
            <nav class="navegacao">
                <i class="fas fa-bars fa-2x"></i>
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>index.php">INÍCIO</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>sobre.php">SOBRE</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>login.php"><i class="fas fa-user fa-2x"></i></a></li>
                    <!-- <li><a href="login.php">LOGIN</a></li> -->
                </ul>
            </nav>
 </header>

 <div class="labels">
        <div id="titulo">
            <h1>Sobre o FileNote</h1>
        </div>
        <div class="conteudo um">
            <div class="img">
                <img src="img/sobre_img_1.jpg" alt="">
            </div>
            <div class="texto"> 
                <p>Somos um site que visa facilitar a vida do usuário em que precisa
                 de praticidade no dia-a-dia em meio a correria</p>  
            </div>
        </div>
        <div class="conteudo dois">
            <div class="img">
                <img src="img/sobre_img_2.jpg" alt="">
            </div>
            <div class="texto">
                <p>Proporcionamos aos usuários uma experiência mais do 
                que satisfatória para a criação e organização de suas tarefas diárias.</p>   
            </div>
        </div>
        <div class="conteudo tres">
            <div class="img">
                <img src="img/sobre_img_3.jpg" alt="">
            </div>
            <div class="texto">
                <p>Agende as suas notas para ter facilidade sobre os prazos de suas tarefas.</p>   
            </div>
        </div>
        <div class="conteudo quatro">
            <div class="img">
                <img src="img/sobre_img_4.jpg" alt="">
            </div>
            <div class="texto">   
                <p>Adicione arquivos as suas notas, facilitando na sua organização.</p>
            </div>
        </div>      
</div>
</body>
<footer class="rodape">
    <div class="info">
        <h3>CONTATO</h3>
        <p>
            E-mail: filenote@gmail.com<br>
            WhatsApp: (00) 99999-9999
        </p>
    </div>
    <div id="linha"><hr></div>
    <div class="detalhes">
        <i class="far fa-copyright"> 2020 FILE NOTE</i>
        <div id="redes-sociais">
            <a href="https://www.twitter.com" target="_blank">
                <i id="twitter" class="fab fa-twitter fa-2x" ></i>
            </a>
            <a href="https://www.facebook.com" target="_blank">
                <i id="facebook" class="fab fa-facebook fa-2x"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank">
                <i id="instagram" class="fab fa-instagram fa-2x"></i>
            </a>
        </div>
    </div>
</footer>
