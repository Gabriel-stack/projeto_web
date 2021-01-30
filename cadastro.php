<?php
    require_once 'php/usuarios.php';
    $u = new Usuario;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastro</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"> <!-- Logo das redes sociais no rodapé -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <header class="conteudo-header">
        <div class="imagem">
            <a href="index.html">
                <img class ="logo" src="img/logo-branca.png"></img>
            </a>
        </div>
	</header>
    <div class="cadastro">
        <div class="formulario">
            <form method="POST">
                <h3>Cadastrar</h3>
                <label for="">
                    <i class="fas fa-user"></i>
                    <input type="text" name="nome" maxlength="30" placeholder="Nome" required>
                </label>
                <label for="">
                    <i class="far fa-envelope"></i>
                    <input type="email" name="email" maxlength="40" placeholder="E-mail" required>
                </label>
                <label for="">
                    <i class="fas fa-phone"></i>
                    <input type="tel" name="telefone" maxlength="15" placeholder="Telefone" required>
                </label>
                <label for="">  
                    <i class="fas fa-key"></i>   
                    <input type="password" name="senha" maxlength="20" placeholder="Senha" required>
                </label>
                <label for="">
                    <i class="fas fa-key"></i>
                    <input type="password" name="confsenha" maxlength="20" placeholder="Repetir senha" required>
                </label>


                <div class="user-avatar" hidden>
                    <label for="img-enviar">
                        <input type="file" id="img-enviar" name="arquivo_atual">
                        <i class="fas fa-edit fa-2x" id="img-enviar"></i>
                    </label>
                </div>


                <label>
                    <!-- <a href="../termos.html">Ler os termos de uso</a><br> -->
                    <input type="checkbox" name="termos" required checked> Ao se inscrever no FileNote, você concorda com os Termos de Serviço e Política de Privacidade do FileNote.
                </label>
                <button type="submit" name="btn_cadastrar">Cadastrar</button>
            </form>
        </div>
    </div>
    <?php
		if(isset($_POST['nome'])){
			$nome = addslashes($_POST['nome']);
			$email = addslashes($_POST['email']);
			$telefone = addslashes($_POST['telefone']);
			$senha = addslashes($_POST['senha']);
            $confsenha = addslashes($_POST['confsenha']);
            $imagem = $_POST['arquivo_atual'];
			if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confsenha)){
				$u->conectar("usuario","localhost","root","");
				if($u->msgErro == ""){
					if($senha == $confsenha){
						if($u->cadastrar($nome, $email, $telefone, $senha, $imagem)){
                            ?>
                                <div id="msg-sucesso">
                                    Cadastrado com sucesso!
                                </div>
                            <?php
						}else{
                            ?>
                                <div class="msg-erro">
                                    Já possui uma conta cadastrada com esse e-mail!
                                </div>
                            <?php
						}
					}else{
                        ?>
                            <div class="msg-erro">
                                Senha e repetir senha não correspondem!
                            </div>
                        <?php
					}
				}else{
                    ?>
                        <div class="msg-erro">
                            <?php echo "Erro: ".$u->msgErro; ?>
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