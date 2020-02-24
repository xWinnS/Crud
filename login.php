<?php

include "Connect.php";

if(isset($_POST['f_user'])){
    $usuario = $_POST['f_user'];
    //$senha = $_POST['f_senha']; Método inseguro

    $busca_segura = $PDO -> prepare("SELECT * FROM usuarios WHERE usuario=:usuario AND senha=:senha");;
    $busca_segura -> bindValue(":usuario", $usuario);
    $busca_segura -> bindValue(":senha", $_POST['f_senha']);
    $busca_segura -> execute();

    if($busca_segura->rowCount()){
        header('Location: home.html');
    }else {
        header('Location: login.php?senhaIncorreta=true');
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <TITLE>Login - TechHardware</TITLE>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html">
</head>
<body>
    <?php

        if(isset($_GET['senhaIncorreta'])){
            echo "<p>Dados incorretos</p>";
        }

    ?>
    <form name="f_login" method="POST" action="login.php">
        Usuário:
        <input type="text" name="f_user" autocomplete="off" required>
        Senha:
        <input type="password" name="f_senha" required>
        <input type="submit" name="f_submit" value="Entrar">
    </form> 
    <a href="criar_usuario.php">Cadastar</a>
    <a href="">Esqueci a senha</a>
</body>
</html>