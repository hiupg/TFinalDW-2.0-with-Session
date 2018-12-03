<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
</head>
<body>
<?php
echo "O id que veio pelo link é: ".$_GET["id"];
try{
    include './ConexaoBanco.php';

    $banco = new ConexaoBanco();

    $conn = $banco->getConexao();

    $query="DELETE from livro WHERE id=:nome";
    $stm = $conn->prepare($query);

    $stm->bindValue(":nome",$_GET["id"]);

    $stm->execute();

    header("Location: listaLivro.php");

}
catch(PDOException $erro){
    print("Erro ao excluir Estudante ".$erro);
}

?>
</body>
</html>