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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $p['titulo'];?></title>
		<style>
			body{
				height: 100vh;
				display: flex;
				justify-content: center;
				align-items: center;
			}
		</style>
	</head>
	<body>
	<label class="janelaNotaExpandir">
		<a href="notas.php"><img src="../img/close.svg" alt="" class="notaExpandirFalse"></a>
		<form method="POST">
			<input type="text" placeholder="insira o título" name="titulo" id ="titulo" value="<?php echo $p['titulo']; ?>">
			<input type="textarea" placeholder="insira sua descrição" name="conteudoNota" id="descricao" value="<?php echo $p['conteudoNota']; ?>">
			<input type="color" name="cor">
			<input type="file" name="arquivo">
			<input type="submit" name="editarNota" value ="SALVAR">
		</form>
		<?php
			if(isset($_POST['editarNota'])){
				if(!$u->editarNota($p['idMarcador'], $p['idNota'], $_POST['titulo'], $_POST['conteudoNota'], $_POST['cor'])){
				?>
					<script>
						alert("Ocorreu um erro ao tentar editar a nota!");
					</script>
				<?php
				}else{
					header('Location: notas.php');
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