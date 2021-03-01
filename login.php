<?php
    session_start();
    if(isset($_SESSION['id'])){
        header("Location: painel/notas.php");
        exit;
    }else{
        include('config.php');
        ob_start();
        require_once 'php/usuarios.php';
        $u = new Usuario();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/header.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Logo das redes sociais no rodapé -->
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
    </head>
    <body>
        <header class="conteudo-header">
            <div class="imagem">
                <a href="<?php echo INCLUDE_PATH;?>">
                    <img class ="logo" src="img/logo-branca.png"></img>
                </a>
            </div>
        </header>
        <div class="login">
            <?php
                if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){
                    $email = addslashes($_POST['email']);
                    $senha = addslashes($_POST['senha']);
                    if(!empty($email) && !empty($senha)){
                        $u->conectar("usuario","localhost","root","");
                        if($u->msgErro == ""){
                            if($u->logar($email, $senha)){
                                header("Location: painel/notas.php");
                                die();
                            }else{
                                ?>
                                <div class="msg-erro">
                                    Email e/ou senha estão incorretos!
                                </div>
                                <?php
                            }
                        }else{
                            ?>
                            <div class="msg-erro">
                                <?php echo $u->msgErro; ?>
                            </div>
                            <?php
                        }
                    }else{
                        ?>
                        <div class="msg-erro">
                            Preencha todos os campos!
                        </div>
                        <?php
                    }
                }
            ?>
            <div class="formulario">
                <form method="POST">
                    <h3>Login</h3>
                    <label for="email">
                        <i class="far fa-envelope"></i>
                        <input type="email" name="email" maxlength="40" placeholder="E-mail" id = "email" required>   
                    </label>
                    <label for="senha">
                        <i class="fas fa-key"></i>
                        <input type="password" name="senha" maxlength="20" placeholder="Senha"  id= "senha"required>
                    </label>
                    <!-- <label>
                        <a id="novasenha" href="modifSenha.php">Esqueci minha senha</a><br>
                    </label> -->
                    <label>
                        <input type="checkbox" name="auto_login"> Manter-me conectado
                    </label>
                    <button type="submit" name="btn_login">Login</button>
                    <span>ou</span>
                </form>
                <p>Não possui cadastro? <a href="cadastro.php">Cadastre-se!</a></p>
            </div>
        </div>
    </body>
</html>
<?php
    }
?>