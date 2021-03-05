<?php
    session_start();
    include('config.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css/style.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css/sobre.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css/header.css">
        <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css/footer.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Bungee+Outline&family=Hanalei+Fill&family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hanalei+Fill&family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
        <title>FILENOTE | Crie anotações inteligentes e práticas</title>
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    </head>
    <body>
        <?php
            include('header.php');
        ?>
        <div class="conteudo-pagina">
            <div class="principal">
                <p>Faça as suas anotações diárias sem perder tempo.</p>
                <a href="cadastro.php"><button type="submit" name="btn_cadastrar">Comece agora!</button></a>
            </div>
            <div class="imagem-principal">
                <img src="img/fundo2.png" alt="">
            </div>
        </div>
        <section class="info" id="sessao-um">
            <div class="carac">
                <img src="img/praticidade.png"></img>
                <p>Faça anotações de forma rápida, fácil  e inteligente através de uma ferramenta simples e prática.</p>
            </div>
            <div class="carac">
                <img src="img/associacao.png">
                <p>Associe arquivos as suas anotações, possibilitando uma nova forma diferente e mais completa para a criação de suas notas.</p>
            </div>
            <div class="carac">
                <img src="img/agendar.png">
                <p>Agende as suas anotações para uma melhor organização de suas tarefas.</p>
            </div>
        </section>
        <?php
            include('footer.php');
        ?>
        <script src="js/inicio.js"></script>
    </body>
</html>