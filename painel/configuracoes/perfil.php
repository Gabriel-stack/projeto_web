<?php
    include ('../../config.php');
    require_once '../../php/usuarios.php';
    $u = new Usuario();
    require_once '../../php/painel.php';
    $p = new Painel();
?>
<link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css/perfil.css">
<div class="formulario">
    <?php
        if(isset($_POST['btn_salvar'])){
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['telefone']);
            $imagem = $_FILES['arquivo'];
            $imagem_atual = $_SESSION['imagem'];
            if(isset($nome) && !empty($nome) && isset($telefone) && !empty($telefone)){
                $u->conectar("usuario","localhost","root","");
                if($u->msgErro == ""){
                    if(isset($_FILES['arquivo']) && !empty($_FILES['arquivo'])){
                        $atualizado = false;
                        if($p->verificarImagem($imagem)){
                            $p->deletarImagem($imagem_atual);
                            $imagem = $p->uploadImagem($imagem);
                            if($u->atualizarImg($_SESSION['id'], $imagem)){
                                $_SESSION['imagem'] = $imagem;
                                $atualizado = true;
                            }else{
                                ?>
                                <script>
                                    alert("Ocorreu um erro ao tentar atualizar a imagem!");
                                </script>
                                <?php
                            }
                        }else{
                            ?>
                            <script>
                                alert("O formato da imagem não é válido!");
                            </script>
                            <?php
                        }
                        if($u->atualizarDados($_SESSION['id'], $nome, $telefone)){
                            $_SESSION['nome'] = $nome;
                            $_SESSION['telefone'] = $telefone;
                            $atualizado = true;
                            // header('Refresh:0');
                        }else{
                            ?>
                            <script>
                                alert("Ocorreu um erro ao tentar atualizar!");
                            </script>
                            <?php
                        }
                        if($atualizado){
                            ?>
                            <script>
                                alert("Atualizado com sucesso!");
                            </script>
                            <?php
                        }
                    }
                }else{
                    ?>
                    <script>
                        alert("Ocorreu um erro ao tentar salvar: <?php echo $u->msgErro;?>");
                    </script>
                    <?php
                }
            }else{
                ?>
                <script>
                    alert("Os campos não podem ficar vazios!");
                </script>
                <?php
            }
        }
    ?>
    <form method="POST" enctype="multipart/form-data">
        <h3>ALTERAR PERFIL</h3>
        <?php
            if($_SESSION['imagem'] == NULL){
                ?>
                <div class="user-avatar photo">
                    <i class="far fa-edit"></i>
                    <label for="img-enviar">
                        <img src="../../img/user-none.png" alt="imagem padrão do usuário" name="arquivo_atual">
                    </label>
                </div>
                <?php
            }else{
                ?>
                <label for="img-enviar">
                <div class="user-img photo">
                    <label for="img-enviar">
                        <img src="<?php echo '../uploads/'.$_SESSION['id'].$_SESSION['imagem'];?>" alt="user" name="img_default">
                    </label>
                    <i class="far fa-edit fa-2x"></i>
                    </div>
                </label>
                <?php
            }
        ?>
        <script src="<?php echo INCLUDE_PATH;?>js/index.js"></script>
        <input type="file" id="img-enviar" name="arquivo">
        <input type="text" name="nome" value="<?php  echo $_SESSION['nome']; ?>">
        <input type="text" name="telefone" value="<?php echo $_SESSION['telefone'] ?>">
        <button type="submit" name="btn_salvar">Salvar</button>
    </form>
</div>