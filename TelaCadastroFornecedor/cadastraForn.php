<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<?php
$cnpj = $_POST["cnpj"];
$nome = $_POST["nome"];
$endereco = $_POST["endereco"];
$cep = $_POST["cep"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];


$destino = "../image/perfil/".$_FILES['arquivo']['name'];

$tmp = $_FILES['arquivo']['tmp_name'];

move_uploaded_file($tmp, $destino);

try {
    include './ConexaoBanco.php';

    $banco = new ConexaoBanco();

    $conn = $banco->getConexao();

    $query = "INSERT INTO fornecedor VALUES (:cnpj,:nome,:endereco,:cep,:email,:telefone,:img)";


    $stm = $conn->prepare($query);

    $stm->bindValue(":cnpj", $cnpj);
    $stm->bindValue(":nome", $nome);
    $stm->bindValue(":endereco", $endereco);
    $stm->bindValue(":cep", $cep);
    $stm->bindValue(":email", $email);
    $stm->bindValue(":telefone", $telefone);
    $stm->bindValue(":img",$destino);


    $stm->execute();

    header("Location: listaFornecedor.php");

} catch (PDOException $erro) {
    print "Deu problema ao inserir o fornecedor $nome no banco $erro";
}
?>

</body>
</html>
