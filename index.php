<?php
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
        <header class="conteudo-header">
            <div class="imagem">
                <a href="<?php echo INCLUDE_PATH;?>">
                    <img class ="logo" src="img/logo-branca.png"></img>
                </a>
            </div>
                <nav class="navegacao">
                    <i class="fas fa-bars fa-2x"></i>
                    <ul>
                        <li><a href="<?php echo INCLUDE_PATH; ?>">INÍCIO</a></li>
                        <li><a href="<?php echo INCLUDE_PATH; ?>sobre.php">SOBRE</a></li>
                        <li><a href="<?php echo INCLUDE_PATH; ?>login.php"><i class="fas fa-user fa-2x"></i></a></li>
                    </ul>
                </nav>
        </header>
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
    </body>
</html>