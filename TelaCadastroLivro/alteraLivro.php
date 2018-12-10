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
$id = $_GET['id'];
$idAlterado = $_POST["id"];
$nome = $_POST["nome"];
$faixaEtaria = $_POST["faixaEtaria"];
$genero = $_POST["genero"];
$editora = $_POST["editora"];
$autor = $_POST["autor"];
$nDePaginas = $_POST["nDePaginas"];
$dataLanc = $_POST["dataLanc"];
try{
    include './ConexaoBanco.php';

    $banco = new ConexaoBanco();

    $conn = $banco->getConexao();


    $query = "UPDATE livro SET nome=:nome,genero=:genero,faixaEtaria=:faixaEtaria,editora=:editora,autor=:autor,nDePaginas=:nDePaginas,dataLanc=:dataLanc,id=:idAlterado WHERE id=:id";


    $stm2 = $conn->prepare($query);


    $stm2->bindValue(":id", $id);
    $stm2->bindValue(":idAlterado", $idAlterado);
    $stm2->bindValue(":nome", $nome);
    $stm2->bindValue(":genero", $genero);
    $stm2->bindValue(":faixaEtaria", $faixaEtaria);
    $stm2->bindValue(":editora", $editora);
    $stm2->bindValue(":autor", $autor);
    $stm2->bindValue(":nDePaginas", $nDePaginas);
    $stm2->bindValue(":dataLanc", $dataLanc);


    $stm2->execute();

    header("Location: listaLivro.php");

}catch(PDOException $erro){
    print "Deu problema ao inserir o livro no banco".$erro;
}
?>

</body>
</html>
