<?php
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
        <meta name="google-signin-scope" content="profile email">
        <meta name="google-signin-client_id" content="775264815049-pq8q0mcjekciagds6miv5ed30d7hao64.apps.googleusercontent.com">
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
                    <label>
                        <a id="novasenha" href="modifSenha.php">Esqueci minha senha</a><br>
                    </label>
                    <label>
                        <input type="checkbox" name="auto_login"> Manter-me conectado
                    </label>
                    <button type="submit" name="btn_login">Login</button>
                    <span>ou</span>
                    <div class="google-login">
                        <div class="g-signin2" style="width: inherit;"data-onsuccess="onSignIn" data-theme="dark" data-width="350" data-height="50" data-longtitle="true" data-lang="pt-BR">
                            <div style="height:100%;width:100%;background-color: white;" class="abcRioButton abcRioButtonBlue">
                                <div class="abcRioButtonContentWrapper">
                                    <div class="abcRioButtonIcon" style="padding:15px">
                                        <div style="width:18px;height:18px;" class="abcRioButtonSvgImageWithFallback abcRioButtonIconImage abcRioButtonIconImage18">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 48 48" class="abcRioButtonSvg"><g><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></g></svg>
                                        </div>
                                    </div>
                                    <span style="font-size:16px;line-height:48px;" class="abcRioButtonContents">
                                    <span id="not_signed_in8olp4cahzg7l">Logar com Google</span><span id="connected8olp4cahzg7l" style="display:none">Signed in with Google</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <p>Não possui cadastro? <a href="cadastro.php">Cadastre-se!</a></p>
            </div>
        </div>
        <?php
            if(isset($_POST['btn_login'])){
                $email = addslashes($_POST['email']);
                $senha = addslashes($_POST['senha']);
                if(!empty($email) && !empty($senha)){
                    $u->conectar("usuario","localhost","root","");
                    if($u->msgErro == ""){
                        if($u->logar($email,$senha)){
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
                                <?php echo"Erro: ".$u->msgErro; ?>
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
    </body>
</html>