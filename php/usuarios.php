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
				$dado = $sql->fetch(); //PDO::FETCH_ASSOC
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
	}
?>