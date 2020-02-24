<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Deletar Produtos</title>
    <meta charset="utf-8">
</head>
<body>
    
    <?php

        if(isset($_GET['f_id'])){
                
            include "connect.php";

            $id = $_GET['f_id'];

            $deleta_usuario = $PDO -> prepare("DELETE FROM produtos WHERE id=:id");
            $deleta_usuario->bindValue(":id",$id);
            $deleta_usuario->execute();

            if($deleta_usuario->rowCount()>0){
                echo "Produto deletado com sucesso.";
            }else{
                echo "ID não encontrado.";
            }
        }
    ?>

<form name="f_delete" method="GET" action="deletar_produtos.php">
        <p>
            Digite o ID do produto a ser deletado: 
            <input type="text" name="f_id" size="2" autocomplete="off">
            <input type="submit" name="f_submit" value="Deletar">
        </p>

        <?php

            include "connect.php";

            $busca_segura = $PDO -> prepare("SELECT * FROM produtos");
            $busca_segura -> execute();

            if($busca_segura->rowCount() == 0){
                echo "Nenhum produto encontrado";
            }else{
                echo "Foram encontrados ".$busca_segura->rowCount()." produtos: <br>";
                while($linha = $busca_segura->fetch(PDO::FETCH_ASSOC)){
                    echo " // ID: "
                    .$linha['id']
                    ." // "
                    .$linha['tipo']
                    ." // "
                    .$linha['nome']
                    ." // Estoque: "
                    .$linha['quantidade']
                    ."<button type='submit' name='f_id' value="
                    .$linha['id']
                    .">Deletar</button> <br>";
                }
            }

        ?>

    </form>

</body>
</html>