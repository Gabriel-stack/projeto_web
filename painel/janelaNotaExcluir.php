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
			<input type="submit" name="excluirSim" value="SIM">
			<input type="submit" name="excluirNao" value="NÃO">
		</form>
		<?php
			if(isset($_POST['excluirSim'])){
                if($u->excluirNota($p['idMarcador'], $p['idNota'])){
					echo $u->excluirNota($p['idMarcador'], $p['idNota']);
					die();
                    ?>
                    <script>
                        alert("A nota foi excluída!");
                    </script>
                    <?php
                    header('Location: notas.php');
                    die();
                }else{
                    ?>
                    <script>
                        alert("Ocorreu um erro ao tentar excluir a nota!");
                    </script>
                    <?php
                }
			}else if(isset($_POST['excluirNao'])) {
                header('Location: notas.php');
                die();
            }
		?>
	</label>
	</body>
</html>
<?php
	}
?>