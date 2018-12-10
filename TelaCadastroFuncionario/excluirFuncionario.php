<?php
session_start();

if (isset($_SESSION["login"])){
    if ($_SESSION["login"]==false){
        header("location: ../login.php");
    }
}else{
    header("location: ../login.php");
}
?>
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
                
                $query="DELETE from funcionario WHERE cpf=:cpf";
                $stm = $conn->prepare($query);
                
                $stm->bindValue(":cpf",$_GET["cpf"]);
                
                $stm->execute();
                
                header("Location: index.php");//pra não mostrar essa pagina
                
            }
            catch(PDOException $erro){
                print("Ocorreu um erro ao excluir o funcionário".$erro);
            }
        
        ?>
    </body>
</html>