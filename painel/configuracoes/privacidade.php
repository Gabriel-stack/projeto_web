<?php
    require_once '../../php/edita_usuarios.php';
    $u = new Usuario;
?>
<link rel="stylesheet" href="../../css/privacidade.css">
<div class="formulario">
    <form action="" method="POST" enctype="multipart/form-data">
        <h3>PRIVACIDADE</h3>
        <input type ="password" placeholder="insira senha atual" required>
        <input type ="password" placeholder="insira nova senha" required>
        <button type="submit" name="btn_salvar">Salvar</button>
    </form>
</div>