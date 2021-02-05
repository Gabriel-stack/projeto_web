<?php
    include ('../../config.php');
    require_once '../../php/usuarios.php';
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
                <!-- <input type="hidden" name="arquivo_atual" value="<?php //echo $_SESSION['imagem']; ?>"> -->
                <img src="../../img/user-none.png" alt="imagem padrão do usuário" name="arquivo_atual">
                <?php $imagem_atual = 'arquivo_atual'; ?>
            </label> <!-- sim? -->
        </div>
        <?php }else{ ?>
            <div class="user-img">
                <label for="img-enviar">
                    <img src="<?php ?>">
                    <?php $imagem_atual = $_SESSION['imagem']; ?>
                </label>
            </div>
        <?php } ?>
        <input type="file" id="img-enviar" name="arquivo">
        <input type="text" name="nome" value="<?php  echo $_SESSION['nome'];?>">
        <input type="text" name="telefone" value="<?php echo $_SESSION['telefone'] ?>">
        <button type="submit" name="btn_salvar">Salvar</button>
        <?php
            if(isset($_POST['btn_salvar'])){
                $nome = addslashes($_POST['nome']);
                $telefone = addslashes($_POST['telefone']);
                $imagem = $_FILES['arquivo'];
                if($imagem['name'] != ''){
                    $u->conectar("usuario","localhost","root","");
                    if($u->msgErro == ""){
                        if($p->verificarImagem($imagem)){
                            $p->deletaArquivo($imagem_atual);
                            $imagem = $p->uploadImagem($imagem);
                            if($u->atualizarDados($_SESSION['id'], $nome, $telefone, $imagem)){
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