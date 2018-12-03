<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="../css/register_style.css" rel="stylesheet" type="text/css"/>
    <title>Cadastro de Fornecedores</title>
</head>
<body>
<div class="top_content">
    <div>
        <a class="top_words" href="registraFornecedor.php" > <h3> Cadastrar Fornecedores</h3>  </a>
    </div>

    <div>
        <a href="../index.php"><img class="logo" src="../image/logo.png"></a>
    </div>

    <div>
        <a class="top_words" href="listaFornecedor.php"> <h3 > Listar Fornecedores</h3>  </a>
    </div>
</div>

<div class="register_part">




<?php
include './ConexaoBanco.php';
$banco = new ConexaoBanco();

if(isset($_GET["cnpj"])){
    print "<div class=\"container justify-center letter\"><h1>Alterar dados do Fornecedores</h1></div>";
    $catch = $_GET["cnpj"];


    $query="SELECT * from fornecedor WHERE cnpj=:cnpj";

    $stm = $banco->getConexao()->prepare($query);
    $stm->bindValue(":cnpj",$catch);
    $stm->execute();

    $fornecedorBuscado = $stm->fetch(PDO::FETCH_ASSOC);


    if($fornecedorBuscado == FALSE){

        header("Location: index.php");
    }
}else{
    print "<div class=\"container justify-center letter\"><h1>Cadastro de Fornecedores</h1></div>";
    $catch = NULL;
}
?>
    <div class="container white">
<?php if($catch){
?>
<form action="alteraFornecedor.php?cnpj=<?php echo ($catch);?>" method="post" enctype="multipart/form-data">

    <?php
    }
    else{
    ?>
    <form action="cadastraForn.php" method="post" enctype="multipart/form-data">
        <?php
        }
        ?>
        <div>
            <label>CNPJ</label><br>
            <input class="input_text" type="text" name="cnpj" value="<?php
            if($catch){
                print $fornecedorBuscado["cnpj"];

            } ?>">
        </div>
        <div>
            <label>Nome</label><br>
            <input class="input_text" type="text" name="nome" value="<?php
            if($catch){
                print $fornecedorBuscado["nome"];

            } ?>">
        </div>

        <div>
            <label>Endereço</label><br>
            <input class="input_text" type="text" name="endereco" value="<?php
            if($catch){
                echo($fornecedorBuscado["endereco"]);

            }
            ?>">
        </div>

        <div>
            <label>CEP</label><br>
            <input class="input_text" type="text" name="cep" value="<?php
            if($catch){
                print $fornecedorBuscado["cep"];

            } ?>">
        </div>

        <div>
            <label>E-mail</label><br>
            <input class="input_text" type="email" name="email" value="<?php
            if($catch){
                echo ($fornecedorBuscado["email"]);

            } ?>">
        </div>

        <div>
            <label>Telefone</label><br>
            <input class="input_text" type="tel" name="telefone" value="<?php
            if($catch){
                print $fornecedorBuscado["telefone"];

            } ?>">
        </div>
        <div>
            <label>Foto do Fornecedor</label>
            <input class="foto_forn" type="file" name="arquivo">
        </div>

        <div class="container">
            <input class="btnenviar" type="submit" value="Confirmar">
        </div>

    </form>
    </form>

    </div>

</body>
</html>