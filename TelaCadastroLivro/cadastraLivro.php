<?php
    include '../loginho.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php

$id = $_POST["id"];
$nome = $_POST["nome"];
$faixaEtaria = $_POST["faixaEtaria"];
$genero = $_POST["genero"];
$editora = $_POST["editora"];
$autor = $_POST["autor"];
$nDePaginas = $_POST["nDePaginas"];
$dataLanc = $_POST["dataLanc"];


$destino = "../image/perfil/".$_FILES['arquivo']['name'];

$tmp = $_FILES['arquivo']['tmp_name'];

move_uploaded_file($tmp, $destino);

try{
    include './ConexaoBanco.php';

    $banco = new ConexaoBanco();

    $conn = $banco->getConexao();


    $query = "INSERT INTO livro (id,nome,genero,faixaEtaria,editora,autor,nDePaginas,dataLanc,img) VALUES (:id,:nome,:genero,:faixaEtaria,:editora,:autor,:nDePaginas,:dataLanc,:img)";


    $stm2 = $conn->prepare($query);

    $stm2->bindValue(":id", $id);
    $stm2->bindValue(":nome", $nome);
    $stm2->bindValue(":genero", $genero);
    $stm2->bindValue(":faixaEtaria", $faixaEtaria);
    $stm2->bindValue(":editora", $editora);
    $stm2->bindValue(":autor", $autor);
    $stm2->bindValue(":nDePaginas", $nDePaginas);
    $stm2->bindValue(":dataLanc", $dataLanc);
    $stm2->bindValue(":img",$destino);


    $stm2->execute();

    header("Location: listaFornecedor.php");

}catch(PDOException $erro){
    print "Deu problema ao inserir o livro $nome no banco $erro";
}
?>

</body>
</html>
