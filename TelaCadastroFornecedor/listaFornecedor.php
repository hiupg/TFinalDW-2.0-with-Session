<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
  <title>Listagem de Fornecedores</title>

</head>
<body>
<div class="content">
    <div>
        <a class="letra" href="registraFornecedor.php"> <h3> Cadastrar Fornecedores</h3>  </a>
    </div>

    <div>
         <a href="../index.php"><img class="logo" src="../image/logo.png"></a>
    </div>

    <div>
        <a  class="letra" href="listaFornecedor.php"> <h3> Listar Fornecedores</h3>  </a>
    </div>
</div>

<!--                     <a href="cadastro_c.php">Cadastrar Clientes</a>-->

<!--        </div>-->

<div class="list_part">
    <div class="container justify-center letter"><h1>Listagem de Fornecedores</h1></div>

    <div class="container justify-center white">

<?php
try{
    include './ConexaoBanco.php';

    $banco = new ConexaoBanco();

    $conn = $banco->getConexao();

    //print("Sucesso em conectar com o banco");
    $query="SELECT * from fornecedor";
    $stm = $conn->prepare($query);

    $stm->execute();


    print"<table class='edit_table'>";
    print "<th><tr>";
    print "<td>Imagem</td>";
    print "<td>CNPJ</td>";
    print "<td>Nome</td>";
    print "<td>Endereço</td>";
    print "<td>CEP</td>";
    print "<td>E-mail</td>";
    print "<td>Telefone</td>";
    print "<td>EXCLUIR</td>";
    print "<td>ALTERAR</td>";
    print "</tr></th>";

    for($i=0;$i<$stm->rowCount();$i++){
        $aux = $stm->fetch(PDO::FETCH_OBJ);
        print "<tr>";
        ?>
            <td>
                <img class="imagem-perfil" src="<?php print $aux->img;?>" alt="Imagem do perfil">
            </td>
        <?php
        print "<td>".$aux->cnpj."</td>";
        print "<td>".$aux->nome."</td>";
        print "<td>".$aux->endereco."</td>";
        print "<td>".$aux->cep."</td>";
        print "<td>".$aux->email."</td>";
        print "<td>".$aux->telefone."</td>";
        ?>
        <td><a class="del_alt"href="excluirForn.php?cnpj=<?php echo $aux->cnpj; ?>">Excluir</a></td>
        <td><a class="del_alt" href="registraFornecedor.php?cnpj=<?php echo $aux->cnpj; ?>">Alterar</a></td>
        <?php
        print "</tr>";
    }



}
catch(PDOException $erro){
    print("Deu erro ao conectar com o banco =>".$erro);
}

?>

</body>
</html>