<?php
    class Painel{
        public function verificarImagem($imagem){
            if($imagem['type'] == 'imagem/jpeg' || $imagem['type'] == 'imagem/jpg' || $imagem['type'] == 'imagem/png'){
                $tamanho = intval($imagem['size'] / 1024);
                if($tamanho < 300){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
        public function uploadImagem($file){
            if(move_uploaded_file($file['tmp_name'], BASE_DIR_PAINEL.'/uploads/'.$file['name'])){
                return $file['name'];
            }else{
                return false;
            }
        }
        public function deletaArquivo($file){
            @unlink('upload/'.$file);
        }
    }
?>