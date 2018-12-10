<?php
    include '../loginho.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../css/register_style.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
      <title>Cadastro de Livrosr</title>
</head>
<body>
<div class="top_content">
    <div>
        <a class="top_words" href="registraLivro.php"> <h3> Cadastrar Livro</h3>  </a>
    </div>

    <div>
        <a href="../index.php"><img class="logo" src="../image/logo.png"></a>
    </div>

    <div>
        <a  class="top_words" href="listaLivro.php"> <h3> Listar Livros</h3>  </a>
    </div>
</div>

<div class="register_part">

    <div class="container justify-center letter">
        <h1>Cadastro de Livros</h1>
    </div>

    <div class="container white">
<?php
include './ConexaoBanco.php';
$banco = new ConexaoBanco();

if(isset($_GET["id"])){

    $id = $_GET["id"];


    $query="SELECT * from livro WHERE id=:id";

    $stm = $banco->getConexao()->prepare($query);
    $stm->bindValue(":id",$id);
    $stm->execute();

    $livroBuscado = $stm->fetch(PDO::FETCH_ASSOC);


    if($livroBuscado == FALSE){

        header("Location: index.php");
    }
}else{

    $id = NULL;
}
?>

<?php if($id){
?>
<form action="alteraLivro.php?id=<?php echo ($id);?>" method="post" enctype="multipart/form-data">

    <?php
    }
    else{
    ?>
    <form action="cadastraLivro.php" method="post" enctype="multipart/form-data">
        <?php
        }
        ?>
        <div>
            <label>Id</label><br>
            <input  class="input_text" type="text" name="id" value="<?php
            if($id){
                print $livroBuscado["id"];

            } ?>">
        </div>
        <div>
            <label>Nome</label><br>
            <input class="input_text" type="text" name="nome" value="<?php
            if($id){
                print $livroBuscado["nome"];

            } ?>">
        </div>

        <div>
            <label>Genero</label><br>
            <input class="input_text" type="text" name="genero" value="<?php
            if($id){
                echo($livroBuscado["genero"]);

            }
            ?>">
        </div>

        <div>
            <label>Faixa Etaria</label><br>
            <?php if($id==NULL){?>
                +18<input class="mef" type="radio" name="faixaEtaria" value="18" checked>
                +16<input class="mef" type="radio" name="faixaEtaria" value="16">
                +14<input class="mef" type="radio" name="faixaEtaria" value="14">
                +10<input class="mef" type="radio" name="faixaEtaria" value="10">
            <?php }
            else{
                if($livroBuscado["faixaEtaria"]=='18'){
                    ?>
                    +18<input class="mef" type="radio" name="faixaEtaria" value="18" checked>
                    +16<input class="mef" type="radio" name="faixaEtaria" value="16">
                    +14<input class="mef" type="radio" name="faixaEtaria" value="14">
                    +10<input class="mef" type="radio" name="faixaEtaria" value="10">

                    <?php


                }if($livroBuscado["faixaEtaria"]=='16'){
                    ?>
                    +18<input class="mef" type="radio" name="faixaEtaria" value="18">
                    +16<input class="mef" type="radio" name="faixaEtaria" value="16" checked>
                    +14<input class="mef" type="radio" name="faixaEtaria" value="14">
                    +10<input class="mef" type="radio" name="faixaEtaria" value="10">

                    <?php

                }if($livroBuscado["faixaEtaria"]=='14'){
                    ?>
                    +18<input class="mef" type="radio" name="faixaEtaria" value="18">
                    +16<input class="mef" type="radio" name="faixaEtaria" value="16">
                    +14<input class="mef" type="radio" name="faixaEtaria" value="14" checked>
                    +10<input class="mef" type="radio" name="faixaEtaria" value="10">

                    <?php

                }if($livroBuscado["faixaEtaria"]=='10'){
                    ?>
                    +18<input class="mef" type="radio" name="faixaEtaria" value="18">
                    +16<input class="mef" type="radio" name="faixaEtaria" value="16">
                    +14<input class="mef" type="radio" name="faixaEtaria" value="14">
                    +10<input class="mef" type="radio" name="faixaEtaria" value="10" checked>

                    <?php

                }

            }



            ?>
        </div>

        <div>
            <label>Editora</label><br>
            <input class="input_text" type="text" name="editora" value="<?php
            if($id){
                print $livroBuscado["editora"];

            } ?>">
        </div>

        <div>
            <label>Autor</label><br>
            <input class="input_text" type="text" name="autor" value="<?php
            if($id){
                print $livroBuscado["autor"];

            } ?>">
        </div>

        <div>
            <label>Número De Páginas</label><br>
            <input class="input_text" type="text" name="nDePaginas" value="<?php
            if($id){
                print $livroBuscado["nDePaginas"];

            } ?>">
        </div>

        <div>
            <label>Data de Lançamento</label><br>
            <input class="input_text" type="text" name="dataLanc" value="<?php
            if($id){
                print $livroBuscado["dataLanc"];

            } ?>">
            <div>
                <label>Foto do Livro</label>
                <input class="foto_forn" type="file" name="arquivo">
            </div>
        </div>

        <div class="container">
            <input class="btnenviar" type="submit" value="Confirmar">
        </div>

    </form>
        </form>
    </div>

</body>
</html>