<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("Location: ../login.php");
		exit;
	}else{
		require_once '../php/usuarios.php';
    	$u = new Usuario();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Notas</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/notas.css">
		<link rel="stylesheet" href="../css/header.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
		<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
	</head>
	<body>
		<div class="marcador-nota">
			<img src="../img/close.svg" alt="" class="close-marcador">
			<div class="adicionar-marcador">
				<form action="" method="POST">
					<input type="text" placeholder="insira o nome do marcador" name="nomeMarcador" id ="nomeMarcador" value="">
					<input type="submit" value="ADICIONAR" name="addMarcador" id = "addMarcador">
				</form>
			</div>
		</div>
		<?php
			if(isset($_POST['addMarcador']) and isset($_POST['addMarcador'])){
				$nomeMarcador = addslashes($_POST['nomeMarcador']);
				if(!empty($nomeMarcador)){
					$u->conectar("usuario","localhost","root","");
					if($u->msgErro == ""){
						if(!$u->criarMarcador($_SESSION['id'], $nomeMarcador)){
							?>
							<script>
								alert("Não foi possível criar o marcador!");
							</script>
							<?php
						}else{
							header('Location: notas.php');
							die();
						}
					}else{
						?>
						<script>
							alert("<?php echo $u->msgErro; ?>");
						</script>
						<?php
					}
				}else{
					?>
					<script>
						alert("Digite um nome para o marcador!");
					</script>
					<?php
				}
			}
		?>
		<div class="conteudo">
			<header class="conteudo-header">
				<div class="imagem">
					<a href="../">
						<img class ="logo" src="../img/logo-branca.png"></img>
					</a>
				</div>
				<div class="pesquisa">
					<form method="GET">
						<label>
							<input type="text" name="textoPesquisa" maxlength="100" placeholder="Pesquisar notas">
							<button type="submit"><i class="fas fa-search fa-2x"></i></button>
						</label>
					</form>
				</div>
				<nav class="navegacao">
					<ul>
						<li><a href="../php/logoff.php">SAIR</a></li>
						<li><a href="configuracoes/conta.php">CONFIGURAÇÕES</a></li>
					</ul>
				</nav>
			</header>
			<div class="menu">
				<ul class ="botoes-menu">
					<a href="" id="plus"><li><i class="fas fa-plus"></i></li></a>
					<a href="" id="sync"><li><i class="fas fa-sync-alt"></i></li></a>
					<a href="" id="slider"><li><i class="fas fa-sliders-h"></i></li></a>
				</ul>
			</div>
			<div class="notas">
				<?php
				$u->conectar("usuario","localhost","root","");
				if($u->msgErro == ""){
					if(isset($_GET['textoPesquisa']) && !empty($_GET['textoPesquisa'])){
						$marc = $u->listarMarcador($_SESSION['id']);
						for($i = 0; $i < count($marc); $i++){
							if($u->listarNotas($marc[$i][0])){
								$nota = $u->listarNotas($marc[$i][0]);
								?>
								<div class="resultado-pesquisa">
									<?php
										for($j = 0; $j < count($nota); $j++){
											if($u->pesquisarNota($nota[$j][0], $nota[$j][3], $_GET['textoPesquisa'])){
										?>
										<label class="nota example" id="<?php echo($nota[$j][0]);?>" style="background-color: <?php echo $nota[$j][4] == NULL ? '#ffff3f;' :  $nota[$j][4].';'?>">
											<div class="titulo">
		<?php echo $nota[$j][1];?>
											</div>
										</label>
										<?php
											}
										}
									?>
								</div>
								<?php
							}
						}
					}else{
						if($u->listarMarcador($_SESSION['id']) == false){
							?>
							<p>Seja Bem-Vindo ao ambiente das suas notas!</p>
							<?php
						}else{
							$marc = $u->listarMarcador($_SESSION['id']);
							for($i = 0; $i < count($marc); $i++){
								?>
								<label for="<?php echo $marc[$i][0]; ?>">
									<div class="configuracoes-notas">
										<i class="far fa-edit fa-3x"></i>
										<i class="fas fa-eraser fa-3x"></i>
									</div>
									<fieldset>
										<legend><?php echo $marc[$i][1]; ?></legend>
										<div class="orgNotas">
											<?php
												if($u->listarNotas($marc[$i][0])){
													$nota = $u->listarNotas($marc[$i][0]);
													for($j = 0; $j < count($nota); $j++){
														?>
														<label class="nota example" id="<?php echo($nota[$j][0]);?>" style="background-color: <?php echo $nota[$j][4] == NULL ? '#ffff3f;' :  $nota[$j][4].';'?>">
															<div class="titulo">
<?php echo $nota[$j][1];?>
															</div>
														</label>
														<?php
													}
												}
											?>	
											<div class="adicionar_nota example">
												<i class="fas fa-plus-circle fa-3x" id="<?php  echo $marc[$i][0];?>"></i>
												<?php
													if(isset($_POST['addNota'])){
														$titulo = addslashes($_POST['titulo']);
														$conteudoNota = addslashes($_POST['conteudoNota']);
														$cor = $_POST['cor'];
														$idMarc = $_POST['idMarc'];
														$arquivo = $_POST['arquivo'];
														if(!empty($_POST['titulo'])){
															if(!$u->adicionarNota($idMarc, $titulo, $conteudoNota, $cor)){
																?>
																<script>
																	alert("O campo não pode ficar vazio!");
																</script>
																<?php
															}else{
																header('Location: notas.php');
																die();
															}
														}
													}
												?>
											</div>
										</div>
									</fieldset>
								</label>
								<?php
							}
						}
					}
				}else{
					?>
					<script>
						alert("<?php echo $u->msgErro;?>");
					</script>
					<?php
				}
				?>	
			</div>
		</div>
		<div class="janelaAddNota">
			<img src="../img/close.svg" alt="" class="janelaAddNotaFalse">
			<form method="POST">
				<input type="text" name="idMarc" value=""  id="idMarc" required>
				<input type="text" placeholder="insira o título" name="titulo" id="titulo">
				<input type="textarea" placeholder="insira sua descrição" name="conteudoNota" id="descricao">
				<input type="color" name="cor">
				<input type="file" name="arquivo">
				<input type="submit" name="addNota" value="SALVAR">
			</form>
		</div>
		<div class="opcao-nota">
		<img src="../img/close.svg" alt="" class="fecharOp">
			<form method="POST" >
				<input type="text" name="idNota" id="idNotaMostrar" value="" required style="display:none;">
				<button type="submit" name="btn_editar" id="btn_editar">Editar</button>
				<button type="submit" name="btn_excluir" id="btn_excluir">Excluir</button>
			</form>
		</div>
		<?php
			if(isset($_POST['btn_editar']) and isset($_POST['idNota'])){
				$_SESSION['idN'] = $_POST['idNota'];
					echo "<script>location.href='janelaNota.php';</script>";
					exit;
			}
			if(isset($_POST['btn_excluir'])){
				$_SESSION['idN'] = $_POST['idNota'];
					echo "<script>location.href='janelaNotaExcluir.php';</script>";
					exit;
			}
		?>
		<script src="../js/configs.js"></script>
	</body>
</html>
<?php
	}
?>