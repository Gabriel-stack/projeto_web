<?php
    require_once '../php/usuarios.php';
    $u = new Usuario;
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
        <link rel="stylesheet" href="css/modifSenha.css">
        <link rel="stylesheet" href="css/header.css">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
        <title>Alterar senha</title>
    </head>
    <body>
        <header class="conteudo-header">
            <div class="imagem">
                <a href="index.html">
                    <img class ="logo" src="img/logo-branca.png"></img>
                </a>
            </div>
        </header>
        <div class="senha">
            <?php
                if(isset($_POST['ok'])){
                    $email = $mysqli->escape_string($_POST['email']);
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $erro[] = "E-mail inválido!";
                    }
                    if(count($erro) == 0){
                        if($u->verificaEmail_e_Telefone($_POST['email'], $_POST['telefone'])){
                            $novaSenha = substr(md5(time()), 0, 6);
                            $novaSenhaCriptografada = md5(md5($novaSenha));
                            if(mail($email, "Sua nova senha", "Sua nova senha: ".$novaSenha)){
                                if($u->modificarSenha($_POST['email'], $novaSenhaCriptografada)){
                                    ?>
                                    <script>
                                        alert("Foi enviada uma nova senha para seu email!");
                                    </script>
                                    <?php
                                }else{
                                    ?>
                                    <script>
                                        alert("Ocorreu um erro!");
                                    </script>
                                    <?php
                                }
                            }else{
                                ?>
                                <script>
                                    alert("Não foi possível enviar o email!");
                                </script>
                                <?php
                            }
                        }else{
                            ?>
                            <script>
                                alert("Email ou telefone estão incorretos!");
                            </script>
                            <?php
                        }
                    }else{
                        ?>
                        <script>
                            alert("Email inválido!");
                        </script>
                        <?php
                    }
                }
            ?>
            <form method="POST">
                <input type="email" name="email" placeholder="Digite o email da conta" required>
                <input type="tel" name="telefone" placeholder="Digite o telefone da conta" required>
                <button type="submit" name="ok" value="Ok"></button>
            </form>
        </div>
    </body>
</html>