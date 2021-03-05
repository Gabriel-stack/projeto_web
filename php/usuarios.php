<?php
	class Usuario{
		private $pdo;
		public $msgErro;
		public function conectar($nome, $host, $email, $senha){
			global $pdo;
			$this->msgErro = "";
			try{
				$pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $email, $senha);
			}catch(PDOException $e){
				$this->msgErro = "Erro de conexão!";
			}catch(Exception $e){
				$this->msgErro = "Ocorreu um erro!";
			}
		}
		public function cadastrar($nome, $email, $telefone, $senha){
			global $pdo;
			$sql = $pdo->prepare("SELECT id FROM conta WHERE email = :e");
			$sql-> bindValue(":e", $email);
			$sql-> execute();
			if($sql->rowCount() > 0){
				return false;
			}else{
				$sql = $pdo->prepare("INSERT INTO conta(nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
				$sql->bindValue(":n", $nome);
				$sql->bindValue(":t", $telefone);
				$sql->bindValue(":e", $email);
				$sql->bindValue(":s", md5($senha));
				$sql->execute();
				return true;
			}
		}
		public function logar($email, $senha){
			global $pdo;
			$sql = $pdo->prepare("SELECT * FROM conta WHERE email = :e AND senha = :s");
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", md5($senha));
			$sql->execute();
			if($sql->rowCount() > 0){
				$dado = $sql->fetch(PDO::FETCH_ASSOC);
				session_start();
				$_SESSION = $dado;
				return true;
			}else{
				return false;
			}
		}
		public function atualizarDados($id, $nome, $telefone){
			global $pdo;
			$sql = $pdo->prepare("UPDATE conta SET nome = :n, telefone = :t WHERE id = '$id'");
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":t", $telefone);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		public function atualizarImg($id, $imagem){
			global $pdo;
			$sql = $pdo->prepare("UPDATE conta SET imagem = :i WHERE id = '$id'");
			$sql->bindValue(":i", $imagem);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		public function atualizarSenha($id, $senha){
			global $pdo;
			$sql = $pdo->prepare("UPDATE conta SET senha = :s WHERE id = '$id'");
			$sql->bindValue(":s", md5($senha));
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		public function verificaEmail_e_Telefone($email, $telefone){
			global $pdo;
			$sql = $pdo->prepare("SELECT * FROM conta WHERE email = :e AND telefone = :t");
			$sql->bindValue(":e", $email);
			$sql->bindValue(":t", $telefone);
			$sql->execute();
			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}
		public function modificarSenha($email, $novaSenha){
			global $pdo;
			$sql = $pdo->prepare("UPDATE conta SET senha = :s WHERE email = '$email'");
			$sql->bindValue(":s", md5($novaSenha));
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		public function criarMarcador($id_user, $nome){
			global $pdo;
			$sql = $pdo->prepare("SELECT * FROM marcador WHERE nomeMarcador = :n AND idUsuario :i");
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":i", $id_user);
			$sql->execute();
			if($sql->rowCount() > 0){
				return false;
			}else{
				$sql = $pdo->prepare("INSERT INTO marcador(nomeMarcador, idUsuario) VALUES (:n, :i)");
				$sql->bindValue(":n", $nome);
				$sql->bindValue(":i", $id_user);
				$sql->execute();
				return true;
			}
		}
		public function editarMarcador($id_user, $idMarcador, $nomeMarcador){
			global $pdo;
			$sql = $pdo->prepare("UPDATE marcador SET nomeMarcador = :n WHERE idUsuario = :iu AND idMarcador = :i");
			$sql->bindValue(":n", $nomeMarcador);
			$sql->bindValue(":iu", $id_user);
			$sql->bindValue(":i", $idMarcador);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		public function excluirMarcador($id_user, $idMarcador){
			global $pdo;
			$notas = Usuario::listarNotas($idMarcador);
			for($i = 0; $i < count($notas); $i++){
				if($notas[$i][3] == $idMarcador){
					Usuario::excluirNota($idMarcador, $notas[$i][0], $id_user);
				}
			}
			$sql = $pdo->prepare("DELETE  FROM marcador WHERE marcador.idUsuario = :iu AND marcador.idMarcador = :im");
			$sql->bindValue("iu", $id_user);
			$sql->bindValue("im", $idMarcador);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		public function listarMarcador($id_user){
			global $pdo;
			$sql = $pdo->prepare("SELECT * FROM marcador WHERE idUsuario = :i");
			$sql->bindValue(":i", $id_user);
			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetchAll(PDO::FETCH_NUM);
			}else{
				return false;
			}
		}
		public function adicionarNota($idMarcador, $titulo, $conteudoNota, $cor){
			global $pdo;
			$sql = $pdo->prepare("INSERT INTO notas (idMarcador, titulo, conteudoNota, cor) VALUES (:i, :t, :c, :co)");
			$sql->bindValue(":i", $idMarcador);
			$sql->bindValue(":t", $titulo);
			$sql->bindValue(":c", $conteudoNota);
			$sql->bindValue(":co", $cor);
			$sql->execute();
			if($sql->rowCount() == 0){
				return false;
			}else{
				return true;
			}
		}
		public function editarNota($idMarcador, $idNota, $titulo, $conteudoNota, $cor){
			global $pdo;
			$sql = $pdo->prepare("UPDATE notas SET titulo = :t, conteudoNota = :c, cor = :co WHERE idMarcador = :im AND IdNota = :iNota");
			$sql->bindValue(":im", $idMarcador);
			$sql->bindValue(":iNota", $idNota);
			$sql->bindValue(":t", $titulo);
			$sql->bindValue(":c", $conteudoNota);
			$sql->bindValue(":co", $cor);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		public function excluirNota($idMarcador, $idNota, $id_user){
			global $pdo;
			$cmd = $pdo->prepare("SELECT * FROM arquivos WHERE idNota = :i");
			$cmd->bindValue(":i", $idNota);
			$cmd->execute();
			$arq = $cmd->fetchAll(PDO::FETCH_NUM);
			for($j = 0; $j < count($arq); $j++){
				$nomeArquivo = $arq[$j][1];
				@unlink('../painel/uploads/usuario'.$id_user.'/'.$idNota.$nomeArquivo);
			}
			$sql = $pdo->prepare("DELETE  FROM notas WHERE notas.idMarcador = :im AND notas.idNota = :iNota");
			$sql->bindValue("im", $idMarcador);
			$sql->bindValue("iNota", $idNota);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		public function listarNotas($idMarcador){
			global $pdo;
			$sql = $pdo->prepare("SELECT * FROM notas WHERE idMarcador = :i");
			$sql->bindValue(":i", $idMarcador);
			$sql->execute();
			if($sql->rowCount() == 0){
				return false;
			}else{
				return $sql->fetchAll(PDO::FETCH_NUM);
			}
		}
		public function pesquisarNota($idNota, $idMarcador, $pesquisa){
			global $pdo;
			$sql = $pdo->prepare("SELECT * FROM notas WHERE idNota = :iNota and idMarcador = :im  AND (titulo LIKE '%".$pesquisa."%' OR conteudoNota LIKE '%".$pesquisa."%')");
			$sql->bindValue(":iNota", $idNota);
			$sql->bindValue(":im", $idMarcador);
			$sql->execute();
			if($sql->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}
		public function adicionarArquivo($idNota, $nomeArquivo, $arquivo, $id_user){
			$tamanho = intval($file['size'] / 1024);
			if($tamanho < 100000){
				global $pdo;
				$sql = $pdo->prepare("INSERT INTO arquivos (idNota, nomeArquivo, arquivo) VALUES (:i, :n, :a)");
				$sql->bindValue(":i", $idNota);
				$sql->bindValue(":a", $arquivo);
				$sql->bindValue(":n", $nomeArquivo);
				if(!$sql->execute()){
					return false;
				}else{
					if(move_uploaded_file($arquivo['tmp_name'], 'D:/xampp/htdocs/projeto_Web/painel/uploads/usuario'.$id_user.'/'.$idNota.$nomeArquivo)){
						return $arquivo['name']; 
					}else{
						return false;
					}
				}
			}else{
				return false;
			}
		}
		public function excluirArquivo($idNota, $idArquivo, $nomeArquivo, $id_user){
			$arq = Usuario::listarArquivos($idNota);
			for($i = 0; $i < count($arq); $i++){
				if($arq[$i][0] == $idArquivo){
					@unlink('../painel/uploads/usuario'.$id_user.'/'.$idNota.$nomeArquivo);
					break;
				}
			}
			global $pdo;
			$sql = $pdo->prepare("DELETE  FROM arquivos WHERE arquivos.idArquivo = :ia");
			$sql->bindValue("ia", $idArquivo);	
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		public function listarArquivos($idNota){
			global $pdo;
			$sql = $pdo->prepare("SELECT * FROM arquivos WHERE idNota = :i");
			$sql->bindValue(":i", $idNota);
			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetchAll(PDO::FETCH_NUM);
			}else{
				return false;
			}
		}
		public function pegarNota($idNota){
			global $pdo;
			$sql = $pdo->prepare("SELECT * FROM notas WHERE idNota = :i");
			$sql->bindValue(":i", $idNota);
			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetch(PDO::FETCH_ASSOC);
			}else{
				return false;
			}
		}
		public function pegarMarcador($idMarcador){
			global $pdo;
			$sql = $pdo->prepare("SELECT * FROM marcador WHERE idMarcador = :i");
			$sql->bindValue(":i", $idMarcador);
			$sql->execute();
			if($sql->rowCount() > 0){
				return $sql->fetch(PDO::FETCH_ASSOC);
			}else{
				return false;
			}
		}
		public function pegaIdNota(){
			global $pdo;
			$sql = $pdo->prepare("SELECT idNota from notas where idNota = (SELECT max(idNota) from notas)");
			if($sql->execute()){
				return $sql->fetch(PDO::FETCH_ASSOC);
			}
		}
	}
?>