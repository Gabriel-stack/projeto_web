<?php
    session_start();
	if(!isset($_SESSION['id'])){
		header("Location: ../../login.php");
		exit;
	}else{
        ob_start();
        require_once '../../php/usuarios.php';
        $u = new Usuario();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Conta</title>
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
                    <a href="../../">
                        <img class ="logo" src="../../img/logo-branca.png"></img>
                    </a>
                </div>
                <input type="checkbox" id="toggle">
                <label for="toggle">&#9776;</label>
                <nav class="navegacao">
                    <ul>
                        <li><a href="../notas.php">VOLTAR</a></li>
                        <li><a href="../../php/logoff.php">SAIR</a></li>
                    </ul>
                </nav>
            </header>
            <div class="menu">
                <ul>
                    <li><a  title="perfil" href="?painel=perfil"><i class="fas fa-user" ></i></a></li>
                    <li><a title="segurança" href="?painel=privacidade"><i class="fas fa-user-shield" ></i></a></li>
                    <li><a  title="termo de uso" href="?painel=termo_uso"><i class="fas fa-scroll" ></i></a></li>
                </ul>
                <i class="fas left"></i>
            </div>
            <div class="config">
                <?php
                    $pagina = isset( $_GET['painel'] ) ? $_GET['painel'] : '';
                    if($pagina ==''){
                        include('perfil.php');
                    }elseif(file_exists($pagina.'.php')){
                        include($pagina.'.php');
                    }else{
                        header("Location: ../../erro404.php");
                    }
                ?>
            </div>
        </div>
    </body>
</html>
<?php
    }
?>