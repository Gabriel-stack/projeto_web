<?php 
    session_start();
    include('config.php'); 
?>
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
        <?php
            include('header.php');
        ?>
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
    <?php
        include('footer.php');
    ?>
</html>