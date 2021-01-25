<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("location: ../../login.php");
		exit;
	}else{
        ?>
<!DOCTYPE html>
<html>
    <head>
        <title>perfil</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../css/conta.css">
        <link rel="stylesheet" href="../../css/header.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="conteudo">
            <header class="conteudo-header">
                <div class="imagem">
                    <a href="../../index.html">
                        <img class ="logo" src="../../img/logo-branca.png"></img>
                    </a>
                </div>
                <nav class="navegacao">
                 <i class="fas fa-bars fa-2x"></i>
                    <ul>
                        <li><a href="../notas.php">VOLTAR</a></li>
                        <li><a href="../../php/logoff.php">SAIR</a></li>
                    </ul>
                </nav>
            </header>
            <div class="menu">
                <i class="fas fa-arrow-right"></i>
                <ul>
                    <li><a href="?painel=perfil">Perfil</a></li>
                    <li><a href="?painel=privacidade">Segurança</a></li>
                    <li><a href="?painel=tema">Temas</a></li>
                    <li><a href="?painel=termo_uso">Termos de uso</a></li>
                </ul>
                <i class="fas left"></i>
            </div>
            <div class="config">
            <?php
                $pagina = isset( $_GET['painel'] ) ? $_GET['painel'] : '';
                if($pagina ==''){
                    include ('perfil.php');
                }elseif(file_exists($pagina.'.php')){
                    include ($pagina.'.php');
                }else{
                }
                ?>

            </div>
        </div>
    </body>
</html>
<?php
    }
?>