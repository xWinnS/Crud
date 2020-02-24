<!DOCTYPE>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Produto - Tech Hardware</title>
</head>
<body>

    <?php
        if(isset($_GET['f_submit'])){
            
            include "connect.php";

            $descricao = $_GET['f_name'];
            $tipo = $_GET['f_tipo'];
            $qtd = $_GET['f_quantidade'];

            $criar_produto = $PDO ->prepare("INSERT INTO produtos VALUES (NULL,:tipo,:descricao,:qtd)");
            $criar_produto->bindValue(":descricao", $descricao);
            $criar_produto->bindValue(":tipo",$tipo);
            $criar_produto->bindValue(":qtd",$qtd);
            $criar_produto->execute();

            if($criar_produto->rowCount() > 0){
                echo "<p> Produto criado com sucesso </p>";
            }else{
                echo "<p> Erro ao criar produto. Contate o suporte. </p>";
            }
            
        }

    ?>

    <form name="f_adicionar" method="GET" action="criar_produto.php">
        <p>
            Descrição: 
            <input type="text" size="50" name="f_name" autocomplete="off" required>
        <p>
        <p>
            Tipo:
            <select  name="f_tipo" required>
                <option value="Processador">Processador</option>
                <option value="Placa mãe">Placa mãe</option>
                <option value="Placa de video">Placa de vídeo</option>
                <option value="Memória">Memória</option>
                <option value="HD">HD</option>
                <option value="SSD">SSD</option>
                <option value="Fonte">Fonte</option>
                <option value="Gabinete">Gabinete</option>
                <option value="Cooler">Cooler</option>
                <option value="Outros">Outros</option>
            </select>
        </p>
        <p>
            Quantidade:
            <input type="number" size="15" name="f_quantidade" required>
        </p>
        <input type="submit" name="f_submit" value="Criar">
    </form>


</body>
</html>