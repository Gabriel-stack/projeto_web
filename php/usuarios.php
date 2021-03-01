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
			$sql->bindValue(":im", $idMarcador);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		public function excluirMarcador($id_user, $idMarcador){
			global $pdo;
			$sql = $pdo->prepare("DELETE FROM marcador WHERE idUsuario = :iu AND idMarcador = :im");
			$sql->bindValue("iu", $id_user);
			$sql->bindValue("im", $idMarcador);
			$sql->execute();
			if($sql->rowCount() == 0){
				$sql = $pdo->prepare("DELETE FROM notas WHERE idMarcador = :im");
				$sql->bindValue("im", $idMarcador);
				$sql->execute();
				if($sql->rowCount() == 0){
					$sql = $pdo->prepare("DELETE FROM arquivos WHERE idNota = :iNota");// ESTÁ ERRADO!
					$sql->bindValue("iNota", $idNota);
					$sql->execute();
					if($sql->rowCount() == 0){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
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
		public function adicionarNota($idMarcador, $titulo, $conteudoNota){
			global $pdo;
			$sql = $pdo->prepare("INSERT INTO notas (idMarcador, titulo, conteudoNota) VALUES (:i, :t, :c)");
			$sql->bindValue(":i", $idMarcador);
			$sql->bindValue(":t", $titulo);
			$sql->bindValue(":c", $conteudoNota);
			$sql->execute();
			if($sql->rowCount() == 0){
				return false;
			}else{
				return true;
			}
		}
		public function editarNota($idMarcador, $idNota, $titulo, $conteudoNota){
			global $pdo;
			$sql = $pdo->prepare("UPDATE notas SET titulo = :t, conteudoNota = :c WHERE idMarcador = :im AND IdNota = :iNota");
			$sql->bindValue(":im", $idMarcador);
			$sql->bindValue(":iNota", $idNota);
			$sql->bindValue(":t", $titulo);
			$sql->bindValue(":c", $conteudoNota);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
		public function excluirNota($idMarcador, $idNota){
			global $pdo;
			$sql = $pdo->prepare("DELETE FROM notas WHERE idMarcador = :im AND idNota = :iNota");
			$sql->bindValue("im", $idMarcador);
			$sql->bindValue("iNota", $idNota);
			$sql->execute();
			if($sql->rowCount() == 0){
				$sql = $pdo->prepare("DELETE FROM arquivos WHERE idNota = :iNota");
				$sql->bindValue("iNota", $idNota);
				$sql->bindValue("ia", $idArquivo);
				$sql->execute();
				if($sql->rowCount() == 0){
					return true;
				}else{
					return false;
				}
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
		public function adicionarArquivo($idNota, $nomeArquivo, $arquivo){
			global $pdo;
			$sql = $pdo->prepare("INSERT INTO arquivos (idNota, nomeArquivo, Arquivo) VALUES (:i, :n, :a)");
			$sql->bindValue(":i", $idNota);
			$sql->bindValue(":n", $nomeArquivo);
			$sql->bindValue(":a", $Arquivo);
			$sql->execute();
			if($sql->rowCount() == 0){
				return false;
			}else{
				return true;
			}
		}
		public function excluirArquivo($idNota, $idArquivo){
			global $pdo;
			$sql = $pdo->prepare("DELETE FROM arquivos WHERE idNota = :iNota AND idArquivo = :ia");
			$sql->bindValue("iNota", $idNota);
			$sql->bindValue("ia", $idArquivo);
			$sql->execute();
			if($sql->rowCount() == 0){
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
	}
?>