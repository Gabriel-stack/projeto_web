<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("Location: ../login.php");
		exit;
	}else{
		require_once '../php/usuarios.php';
    	$u = new Usuario();
		$u->conectar("usuario","localhost","root","");
		$p = $u->pegarMarcador($_SESSION['idM']);
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="../css/notas.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $p['idMarcador'];?></title>
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
	<label class="janelaNotaExcluir">
		<a href="notas.php"><img src="../img/close.svg" alt="" class="notaExpandirFalse"></a>
		<form method="POST">
			<input type="text" placeholder="insira o nome do marcador" name="nomeMarcador" id ="NomeMarcador" maxlength="20" value="<?php echo $p['nomeMarcador']; ?>">
			<input type="submit" name="editarMarcador" value ="SALVAR">
		</form>
		<?php
			if(isset($_POST['editarMarcador'])){
				if(!$u->editarMarcador($_SESSION['id'], $p['idMarcador'], $_POST['nomeMarcador'])){
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