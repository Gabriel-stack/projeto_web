<header class="conteudo-header">
    <div class="imagem">
        <a href="<?php echo INCLUDE_PATH;?>">
            <img class ="logo" src="img/logo-branca.png"></img>
        </a>
    </div>
    <nav class="navegacao">
        <i class="fas fa-bars fa-2x"></i>
        <ul>
            <li><a href="<?php echo INCLUDE_PATH; ?>">INÍCIO</a></li>
            <li><a href="<?php echo INCLUDE_PATH; ?>sobre.php">SOBRE</a></li>
            <?php
                if(!isset($_SESSION['id'])){
                    ?>
                    <li><a href="<?php echo INCLUDE_PATH; ?>login.php"><i class="fas fa-user fa-2x"></i></a></li>
                    <?php
                }else{
                    if($_SESSION['imagem'] != NULL){
                        ?>
                        <li><a href="login.php"><img src="<?php echo INCLUDE_PATH.'painel/uploads/'.$_SESSION['id'].$_SESSION['imagem'] ?>" style = "width: 40px; height: 40px; border-radius: 50%;"></a></li>
                        <?php
                    }else {
                        ?>
                        <li><a href="login.php"><img src="img/user-none.png" alt="imagem padrão do usuário" name="arquivo_atual" style = "width: 40px; height: 40px; border-radius: 50%;"></a></li>
                        <?php
                    }
                }
            ?>
            </ul>
        </nav>
</header>