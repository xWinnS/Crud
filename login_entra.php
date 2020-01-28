<!DOCTYPE>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
    <?php

        include "Connect.php";

        if(isset($_POST['f_user'])){
            $usuario = $_POST['f_user'];
            $senha = $_POST['f_senha'];

            $buscar_usuario = $PDO -> query("SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = '$senha'");

            $busca_segura = $PDO -> prepare("SELECT * FROM usuarios WHERE usuario ='$usuario' AND senha = '$senha'");;

            

            echo $buscar_usuario->rowCount();

        
        }
    ?>
</body>
</html>