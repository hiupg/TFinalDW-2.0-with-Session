<?php
    include '../loginho.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
    <title>Listagem de Livros</title>

</head>
<body>
<div class="content">
    <div>
        <a class="letra" href="registraLivro.php"> <h3> Cadastrar Livro</h3>  </a>
    </div>

    <div>
         <a href="../index.php"><img class="logo" src="../image/logo.png"></a>
    </div>

    <div>
        <a  class="letra" href="listaLivro.php"> <h3> Listar Livro</h3>  </a>
    </div>
</div>


<div class="list_part">
    <div class="container justify-center letter"><h1>Listagem de Livros</h1></div>

    <div class="container justify-center white">

<?php
try{
    include './ConexaoBanco.php';

    $banco = new ConexaoBanco();

    $conn = $banco->getConexao();

    //print("Sucesso em conectar com o banco");
    $query="SELECT * from livro";
    $stm = $conn->prepare($query);

    $stm->execute();

    print "<table class='edit_table'>";
    print "<th><tr>";
    print "<td>Imagem</td>";
    print "<td>Id</td>";
    print "<td>Nome</td>";
    print "<td>Gênero</td>";
    print "<td>Faixa Etária</td>";
    print "<td>Editora</td>";
    print "<td>Autor</td>";
    print "<td>N° de Páginas</td>";
    print "<td>Data de Lançamento</td>";
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
        print "<td>".$aux->id."</td>";
        print "<td>".$aux->nome."</td>";
        print "<td>".$aux->genero."</td>";
        print "<td>".$aux->faixaEtaria."</td>";
        print "<td>".$aux->editora."</td>";
        print "<td>".$aux->autor."</td>";
        print "<td>".$aux->nDePaginas."</td>";
        print "<td>".$aux->dataLanc."</td>";
        ?>
        <td><a class="del_alt" href="excluirLivro.php?id=<?php echo $aux->id; ?>">Excluir</a></td>
        <td><a class="del_alt" href="registraLivro.php?id=<?php echo $aux->id; ?>">Alterar</a></td>
        <?php
        print "</tr>";
    }



}
catch(PDOException $erro){
    print("Deu erro ao conectar com o banco =>".$erro);
}

?>
    </div>
</div>

</body>
</html>