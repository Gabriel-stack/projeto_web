<?php
	class Usuario{
		private $pdo;
		public $msgErro = "";
		public function conectar($nome, $host, $email, $senha){
			global $pdo;
			try{
				$pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $email, $senha);
			}catch(PDOException $e){
				$msgErro = $e->getMessage();
			}
			catch(Exception $e){
				$msgErro = $e->getMessage();
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
				$dado = $sql->fetch();
				session_start();
				$_SESSION['id'] = $dado['id'];
				$_SESSION['nome'] = $dado['nome'];
				$_SESSION['telefone'] = $dado['telefone'];
				$_SESSION['email'] = $dado['email'];	
				$_SESSION['imagem'] = $dado['imagem'];
				return true;
			}else{
				return false;
			}
		}
		public function atualizarDados($id, $nome, $telefone, $imagem){
			global $pdo;
			$sql = $pdo->prepare("UPDATE conta SET nome = :n, telefone = :t, imagem = :i WHERE id = :id");
			$sql->bindValue(":id", $id);
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":t", $telefone);
			$sql->bindValue(":i", $imagem);
			if($sql->execute()){
				return true;
			}else{
				return false;
			}
		}
	}
?>