<link rel="stylesheet" href="../../css/perfil.css">
<div class="formulario">
    <form method="POST" enctype="multipart/form-data">
        <h3>ALTERAR PERFIL</h3>
        <?php
            if($_SESSION['imagem'] == NULL){
        ?>


        <!-- <div class="user-avatar">
            <label for="img-enviar">
                <input type="file" id="img-enviar" name="arquivo_atual">
                <i class="fas fa-edit fa-2x" id="img-enviar"></i>
            </label>
        </div> -->


        <?php
        }else{?>
            <div class="user-img">
                <label for="img-enviar">
                    <input type="file" id="img-enviar">
                    <img name="arquivo" src="<?php echo INCLUDE_PATH_PAINEL ?>..uploads/<?php echo $_SESSION['imagem'];?>">
                    <i class="fas fa-edit fa-2x"></i>
                </label>
            </div>
         ?><?php } ?>
         
        <input type="text" name="nome" required value="<?php  echo $_SESSION['nome'];?>">
        <input type="text" name="telefone">
        <button type="submit" name="btn_salvar">Salvar</button>
        <?php
            if(isset($_POST['btn_salvar'])){
                $nome = $_POST['nome'];
                $telefone = $_POST['telefone'];
                $imagem = $_FILES['arquivo'];
                $imagem_atual = $_POST['arquivo_atual'];
                if(!empty($imagem)){
                    $u->conectar("usuario","localhost","root","");
                    if($u->msgErro == ""){
                        if($u->verificarImagem($imagem)){
                            $imagem = $u->uploadImagem($imagem);
                        }
                    }else{
                        ?>
                            <div class="msg-erro">
                                <?php echo"Erro: ".$u->msgErro; ?>
                            </div>
                        <?php
                    }
                }
            }
        ?>
    </form>
</div>