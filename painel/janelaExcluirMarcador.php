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
		<title><?php echo $p['nomeMarcador'];?></title>
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
            <div class="msg">
                <p>Deseja excluir o marcador?</p>
				<p>Será excluído o marcador, todas as notas contidas nele e todos os arquivos relacionados!</p>
            </div>
            <div class="inp">
                <input type="submit" name="excluirMarcSim" value="SIM">
                <input type="submit" name="excluirMarcNao" value="NÃO">
            </div>
		</form>
		<?php
			if(isset($_POST['excluirMarcSim'])){
                if($u->excluirMarcador($p['idUsuario'], $p['idMarcador'])){
                    header('Location: notas.php');
                    die();
                }else{
                    ?>
                    <script>
                        alert("Ocorreu um erro ao tentar excluir a nota!");
                    </script>
                    <?php
                }
			}else if(isset($_POST['excluirMarcNao'])) {
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