<?php
//    include_once '../config.php';
    class Painel{
        public function verificarImagem($imagem){
            if($imagem['type'] == 'image/jpeg' || $imagem['type'] == 'image/jpg' || $imagem['type'] == 'image/png'){
                $tamanho = intval($imagem['size'] / 1024);
                if($tamanho < 1024){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        public function uploadImagem($file){
            if(move_uploaded_file($file['tmp_name'], 'D:/xampp/htdocs/projeto_Web/painel/uploads/'.$_SESSION['id'].$file['name'])){
                return $file['name'];
            }else{
                return false;
            }
        }
        public function deletarImagem($file){
            @unlink('../uploads/'.$_SESSION['id'].$file);
        }
    }
?>