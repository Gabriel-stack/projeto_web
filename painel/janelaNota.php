<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("Location: ../login.php");
		exit;
	}else{
		require_once '../php/usuarios.php';
    	$u = new Usuario();
		$u->conectar("usuario","localhost","root","");
		$p = $u->pegarNota($_SESSION['idN']);
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="../css/notas.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $p['titulo'];?></title>
		<style>
			*{
				margin: 0;
				padding: 0;
				box-sizing: border-box;
			}
			body{
				height: 100vh;
				display: flex;
				justify-content: center;
				align-items: center;
			}
		</style>
	</head>
	<body>
	<label class="janelaNotaExpandir" style="background-color: <?php echo $p['cor']?>;">
		<a href="notas.php"><img src="../img/close.svg" alt="" class="notaExpandirFalse"></a>
		<form method="POST" enctype="multipart/form-data">
			<input type="text" placeholder="insira o título" name="titulo" id ="titulo" maxlength="20" value="<?php echo $p['titulo']; ?>">
			<textarea name="conteudoNota" id="descricao" cols="40" rows="10" maxlength="100000" style=""><?php echo $p['conteudoNota'];?></textarea>
			<input type="color" name="cor" value="<?php echo $p['cor']?>">
			<input type="file" name="arquivo">
			<input type="submit" name="editarNota" value ="SALVAR">
		</form>
		<div class="arquivos">
			<?php
				if($u->listarArquivos($_SESSION['idN'])){
					$arq = $u->listarArquivos($_SESSION['idN']);
					$dir = opendir('D:/xampp/htdocs/projeto_Web/painel/uploads/usuario'.$_SESSION['id'].'/');
					for($i = 0; $i < count($arq); $i++){
						if($arq[$i][3] == $_SESSION['idN']){
							?>
							<div class="arq">
								<i class="fas fa-file-alt fa-4x"></i>
								<p><?php echo $arq[$i][1]; ?></p>
								<form method="POST">
									<button name="baixar"><a target="_blank" href="uploads/usuario<?php echo $_SESSION['id'].'/'.$_SESSION['idN'].''.$arq[$i][1]?>" download>Baixar</a></button>
									<button type="submit"name="excluir">Excluir</button>
								</form>
							</div>
							<?php
							if(isset($_POST['excluir'])){
								if($u->excluirArquivo($_SESSION['idN'], $arq[$i][0], $arq[$i][1], $_SESSION['id'])){
									?>
									<script>
										alert("O arquivo foi excluído com sucesso!");
									</script>
									<?php
									header('Refresh:0');
									die();
								}else{
									?>
									<script>
										alert("Ocorreu um erro ao tentar excluir o arquivo!");
									</script>
									<?php
								}
							}
						}
					}
				}else{
					?>
					<p>Não tem nenhum arquivo!</p>
					<?php
				}
			?>
		</div>
		<?php
			if(isset($_POST['editarNota'])){
				if(!$u->editarNota($p['idMarcador'], $p['idNota'], $_POST['titulo'], $_POST['conteudoNota'], $_POST['cor'])){
				?>
					<script>
						alert("Ocorreu um erro ao tentar editar a nota!");
					</script>
				<?php
				}else{
					if(isset($_FILES['arquivo']) && !empty($_FILES['arquivo']['name'])){
						$arquivo = $_FILES['arquivo'];
						$nomeArquivo = $_FILES['arquivo']['name'];
						$u->adicionarArquivo($_SESSION['idN'], $nomeArquivo, $arquivo, $_SESSION['id']);
					}
					header('Location: janelaNota.php');
					die();
				}
			}
		?>
	</label>
	</body>
</html>
<?php
	}
?>