<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Consultar Usuários</title>
        <meta charset = "utf-8">
    </head>
    <body>
        <form name="f_consulta" method="GET" action="consultar_usuarios.php">
            <p>
                Consultar Usuarios
            </p>
            <p>
                Digite o ID: 
                <input type="text" name="f_id" size="2" autocomplete="off">
                <input type="submit" name="f_submit"  value="Buscar">
            </p>
            <input type="submit" name="f_submit"  value="Lista Todos">
        </form> 

        <?php

            if(isset($_GET['f_submit'])){

                include "connect.php";

                $campo_id = $_GET['f_id'];
                if($campo_id != NULL){

                    $busca_segura = $PDO -> prepare("SELECT * FROM usuarios WHERE id=:id");
                    $busca_segura -> bindValue("id",$campo_id);
                    $busca_segura -> execute();

                    if($busca_segura->rowCount() == 0){
                        echo "Usuário não encontrado";
                    }else{
                        echo "Usuário encontrado: <br>";
                        while($busca = $busca_segura->fetch(PDO::FETCH_ASSOC)){
                            echo "ID: ".$busca['id']." // Usuário: ".$busca['usuario']."<br>";
                        }
                    }

                }else {
                    $busca_segura = $PDO -> prepare("SELECT * FROM usuarios");
                    $busca_segura -> execute();

                    if($busca_segura->rowCount() == 0){
                        echo "Nenhum usuário encontrado";
                    }else{
                        echo "Foram encontrados ".$busca_segura->rowCount()." usuários: <br>";
                        while($busca = $busca_segura->fetch(PDO::FETCH_ASSOC)){
                            echo "ID: ".$busca['id']." // Usuário: ".$busca['usuario']."<br>";
                        }
                    }
                }
            }

        ?>


    </body>
</html>