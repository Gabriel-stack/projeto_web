<?php
    require_once 'usuarios.php';
    $u = new Usuario;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Logo das redes sociais no rodapé -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<body>
    <header class="conteudo-header">
        <div class="imagem">
            <a href="../index.html">
                <img class ="logo" src="../img/logo-nome-nova.png"></img>
            </a>
        </div>
            <nav class="navegacao">
                <i class="fas fa-bars fa-2x"></i>
                <ul>
                    <li><a href="../index.html">INÍCIO</a></li>
                    <li><a href="../sobre.html">SOBRE</a></li>
                    <li><a href="login.php">LOGIN</a></li>
                </ul>
            </nav>
    </header>
    <div class="login">
        <div class="formulario">
            <form method="POST">
                <h3>Login</h3>
                <label for="email">
                    <i class="far fa-envelope"></i>
                    <input type="email" name="email" maxlength="40" placeholder="E-mail" required>   
                </label><br>
                <label for="senha">
                    <i class="fas fa-key"></i>
                    <input type="password" name="senha" maxlength="20" placeholder="Senha" required>
                </label><br>
                <label>
                    <input type="checkbox" name="auto_login"> Manter-me conectado
                </label><br>
                <a id="novasenha" href="redefinir_senha.html">Esqueci minha senha</a><br>
                <button type="submit" name="btn_login">Login</button>
                <br>ou<br>
            </form>
            <a href="cadastro.php"><button type="submit" name="btn_cadastrar">Cadastrar</button></a>
        </div>
    </div>
    <?php
		if(isset($_POST['email'])){
			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);
			if(!empty($email) && !empty($senha)){
				$u->conectar("projeto_login","localhost","root","");
				if($u->msgErro == ""){
					if($u->logar($email,$senha)){
						header("location: notas.php");
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
</html>