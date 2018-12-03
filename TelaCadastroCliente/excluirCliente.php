<!DOCTYPE html>
<html>
    <head>
        <title>Excluir Clientes</title>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php

            try{
               include './ConexaoBanco.php';
                
                $banco = new ConexaoBanco();
                
                $conn = $banco->getConexao();
                
                $query="DELETE from cliente WHERE cpf=:cpf";// não entendi
                $stm = $conn->prepare($query);
                
                $stm->bindValue(":cpf",$_GET["cpf"]);
                
                $stm->execute();
                
                header("Location: index.php");//pra não mostra essa pagina
                
            }
            catch(PDOException $erro){
                print(" Ocorreu um erro ao excluir o cliente ".$erro);
            }
        
        ?>
    </body>
</html>