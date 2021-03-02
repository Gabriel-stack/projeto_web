<?php
	include ('../../config.php');
    require_once '../../php/usuarios.php';
    $u = new Usuario();
?>
<link rel="stylesheet" href="../../css/privacidade.css">
<div class="formulario">
    <?php
        if(isset($_POST['btn_salvar'])){
            $senhaatual = addslashes($_POST['senhaatual']);
            $novasenha = addslashes($_POST['novasenha']);
            $confsenha = addslashes($_POST['confsenha']);
            if(isset($senhaatual) && !empty($senhaatual) && isset($novasenha) && !empty($novasenha) && isset($confsenha) && !empty($confsenha)){
                if(md5($senhaatual) == $_SESSION['senha']){
                    if($novasenha == $confsenha){
                        $u->conectar("usuario","localhost","root","");
                        if($u->msgErro == ""){
                            if($u->atualizarSenha($_SESSION['id'], $novasenha)){
                                $_SESSION['senha'] = $novasenha;
                                ?>
                                <script>
                                    alert("Atualizado com sucesso!");
                                </script>
                                <?php
                                header('Refresh:0');
                            }else{
                                ?>
                                <script>
                                    alert("Ocorreu um erro ao tentar atualizar!");
                                </script>
                                <?php
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
                            alert("Senha e repetir senha não correspondem!");
                        </script>
                        <?php
                    }
                }else{
                    ?>
                    <script>
                        alert("Senha incorreta!");
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
        <h3>PRIVACIDADE</h3>
        <input type ="password" name="senhaatual" placeholder="Insira senha atual" required>
        <input type ="password" name="novasenha" placeholder="Insira nova senha" required>
        <input type ="password" name="confsenha" placeholder="Insira nova senha novamente" required>
        <button type="submit" name="btn_salvar">Salvar</button>
    </form>
</div>