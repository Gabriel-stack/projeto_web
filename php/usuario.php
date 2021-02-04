<?php
    class Usuario{
        public function atualizarDados($nome, $telefone, $imagem){
            global $pdo;
            $sql = $pdo->prepare("UPDATE conta SET = nome = :n, telefone = :t, imagem = :i WHERE id = :id");
            if($sql->execute(array($nome, $telefone, $imagem, $_SESSION['id']))){
            	return true;
            }else{
            	return false;
            }
        }
    }
?>