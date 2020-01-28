<!DOCTYPE>
<html lang="pt-br">
<head>
    <meta charset='utf-8'>
    <title>Consultar produtos</title>
</head>
<body>
    <form name="f_consulta" method="GET" action="consultar_produtos.php">
        <p>Listar produtos</p>
        <p>Filtrar: 
            <select  name="f_tipo" require>
                    <option value="">Todos</option>
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
        <input name="f_submit" type="submit" value="Listar">
    </form> 

    <?php 

        if(isset($_GET['f_submit'])){

            include "connect.php";

            $filtro = $_GET['f_tipo'];
            if($filtro != NULL){
                
                $lista_produtos = $PDO -> prepare("SELECT * FROM produtos WHERE tipo=:filtro ");
                $lista_produtos->bindValue(":filtro",$filtro);
                $lista_produtos->execute();
                if($lista_produtos->rowCount() == 0){
                    echo "Não existem itens para o filtro: ".$filtro;
                }else{
                    echo "<br>"."Foram encontrados: ".$lista_produtos->rowCount()." iten(s) para o filtro: ".$filtro."<br>";
                    while($linha=$lista_produtos->fetch(PDO::FETCH_ASSOC)){
                        echo $linha['tipo']."<br>";
                    }
                }

                


            }else{
                $lista_produtos = $PDO -> prepare("SELECT * FROM produtos");
                $lista_produtos->execute();
                echo "Foram encontrados: ".$lista_produtos->rowCount()." Produtos."."<br>";
                while($linha=$lista_produtos->fetch(PDO::FETCH_ASSOC)){
                    echo $linha['tipo']."<br>";
                }      
            }
        }

    ?>
    
</body>
</html>