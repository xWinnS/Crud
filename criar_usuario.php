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

            
            if( (!empty($usuario)) && (!empty($_POST['f_password'])) && (!empty($_POST['f_cpf'])) ){
                include "connect.php";

                $verifica_usuario = $PDO->prepare("SELECT * FROM usuarios WHERE usuario=:usuario");
                $verifica_cpf = $PDO->prepare ("SELECT * FROM usuarios WHERE cpf=:cpf");
                $verifica_usuario->bindValue(":usuario",$usuario);
                $verifica_cpf->bindValue(":cpf",$_POST['f_cpf']);
                $verifica_usuario->execute();
                $verifica_cpf->execute();

                if($verifica_usuario->rowCount() > 0){
                    echo "<p>Nome de usuário já cadastrado, utilize outro.</p>";
                }
                if($verifica_cpf->rowCount() > 0){
                    echo "<p>CPF já cadastrado, recuperar senha pode ser útil.</p>";
                }

                if ($verifica_usuario->rowCount() == 0 && $verifica_cpf->rowCount() == 0){
                    $criar_usuario = $PDO->prepare("INSERT INTO usuarios VALUES (NULL, :usuario, :senha, :cpf)");
                    $criar_usuario->bindValue(":usuario",$usuario);
                    $criar_usuario->bindValue(":senha",$_POST['f_password']);
                    $criar_usuario->bindValue(":cpf",$_POST['f_cpf']);
                    $criar_usuario->execute();

                    if($criar_usuario->rowCount() > 0){
                        echo "Usuario criado com sucesso";
                    }else{
                        echo "Preencha todos os campos";
                    }
                }         
            }
        }
    ?>

    <form name="f_adicionar" method="POST" action="criar_usuario.php">
            <p>
                Usuário: 
                <input type="text" size="25" name="f_user" autocomplete="off" required>
            </p>
            <p>
                Senha:
                <input type="password" size="25" name="f_password" required>
            </p>
            <p>
                CPF(somente numeros):
                <input type="text" size="11" name="f_cpf" pattern="([0-9]{11,11})+$" title="Somente numeros (11)" autocomplete="off" required>
            </p>
            <input type="submit" name="f_submit" value="Cadastrar">
        </form>
</body>
</html>