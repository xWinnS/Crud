<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8">
    <title>Criar Usuário</title>
</head>
<body>

    <?php

        if(isset($_POST['f_submit'])){
            $usuario = $_POST['f_user'];
            $senha = $_POST['f_password'];
            $cpf = $_POST['f_cpf'];
            
            if( (!empty($usuario)) && (!empty($senha)) && (!empty($cpf)) ){
                include "connect.php";
                $criar_usuario = $PDO->prepare("INSERT INTO usuarios VALUES (NULL, :usuario, :senha, :cpf)");
                $criar_usuario->bindValue(":usuario",$usuario);
                $criar_usuario->bindValue(":senha",$senha);
                $criar_usuario->bindValue(":cpf",$cpf);
                $criar_usuario->execute();

                if($criar_usuario->rowCount() > 0){
                    echo "Usuario criado com sucesso";
                }
            }else{
                echo "Preencha todos os campos";
            }
        }
    ?>

    <form name="f_adicionar" method="POST" action="criar_usuario.php">
            <p>
                Usuário: 
                <input type="text" size="25" name="f_user" autocomplete="off" require>
            </p>
            <p>
                Senha:
                <input type="password" size="25" name="f_password" require>
            </p>
            <p>
                CPF(somente numeros):
                <input type="text" size="11" name="f_cpf" pattern="([0-9]{11,11})+$" title="Somente o numeros(11)" autocomplete="off" require>
            </p>
            <input type="submit" name="f_submit" value="Cadastrar">
        </form>
</body>
</html>