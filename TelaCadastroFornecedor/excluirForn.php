<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
</head>
<body>
<?php

try{
    include './ConexaoBanco.php';

    $banco = new ConexaoBanco();

    $conn = $banco->getConexao();

    $query="DELETE from fornecedor WHERE cnpj=:nome";
    $stm = $conn->prepare($query);

    $stm->bindValue(":nome",$_GET["cnpj"]);

    $stm->execute();

    header("Location: listaFornecedor.php");

}
catch(PDOException $erro){
    print("Erro ao excluir Fornecedor ".$erro);
}

?>
</body>
</html>