<?php
    include('../../config.php');
    require_once '../../php/usuario.php';
    $u = new Usuario();
    require_once '../../php/painel.php';
    $p = new Painel();
?>
<link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css/perfil.css">
<div class="formulario">
    <form method="POST" enctype="multipart/form-data">
        <h3>ALTERAR PERFIL</h3>
        <?php
            if($_SESSION['imagem'] == NULL){
        ?>
         <div class="user-avatar">
            <label for="img-enviar">
                <input type="file" id="img-enviar" name="arquivo_atual">
                <i class="fas fa-edit fa-2x" id="img-enviar"></i>
            </label>
        </div>
        <?php }else{ ?>
            <div class="user-img">
                <label for="img-enviar">
                    <img src="data:image/png;base64, <?php echo base64_encode($_SESSION['imagem']);?>">
                    <input type="file" id="img-enviar" name="arquivo">
                    <i class="fas fa-edit fa-2x"></i>
                </label>
            </div>
        <?php } ?> 
        <input type="text" name="nome" value="<?php  echo $_SESSION['nome'];?>">
        <input type="text" name="telefone" value="<?php echo $_SESSION['telefone'] ?>">
        <button type="submit" name="btn_salvar">Salvar</button>
        <?php
            if(isset($_POST['btn_salvar'])){
                $nome = $_POST['nome'];
                $telefone = $_POST['telefone'];
                $imagem = $_FILES['arquivo'];
                $imagem_atual = $_POST['arquivo_atual'];
                if(!empty($imagem)){
                    $p->conectar("usuario","localhost","root","");
                    if($p->msgErro == ""){
                        if($p->verificarImagem($imagem)){
                            $p->deletaArquivo($imagem_atual);
                            $imagem = $p->uploadImagem($imagem);
                            if($u->atualizarDados($nome, $telefone, $imagem)){
                                $_SESSION['imagem'] = $imagem;
                                ?>
                                    <div class="msg-sucesso">Atualizado com sucesso!</div>
                                <?php
                            }else{
                                ?>
                                    <div class="msg-erro">Ocorreu um erro ao tentar atualizar!</div>
                                <?php
                            }
                        }else{
                            ?>
                                <div class="msg-erro">O formato da imagem não é válido!</div>
                            <?php
                        }
                    }else{
                        $imagem = $imagem_atual;
                        if($u->atualizarDados($nome, $telfone, $imagem)){
                            ?>
                                <div class="msg-sucesso">Atualizado com sucesso!</div>
                            <?php
                        }else{
                            ?>
                                <div class="msg-erro">Ocorreu um erro ao tentar atualizar!</div>
                            <?php
                        }
                    }
                }
            }
        ?>
    </form>
</div>