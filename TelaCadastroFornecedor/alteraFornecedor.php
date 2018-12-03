<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
            $cnpj = $_GET['cnpj'];
            $cnpjAlterado = $_POST["cnpj"];
            $nome = $_POST["nome"];
            $endereco = $_POST["endereco"];
            $cep = $_POST["cep"];
            $email = $_POST["email"];
            $telefone = $_POST["telefone"];

            try{
                include './ConexaoBanco.php';

                $banco = new ConexaoBanco();

                $conn = $banco->getConexao();

                $query = "UPDATE fornecedor SET nome=:nome,endereco=:endereco,cep=:cep,email=:email,telefone=:telefone,cnpj=:cnpjAlterado WHERE cnpj=:cnpj";

                $stm = $conn->prepare($query);


                $stm->bindValue(":cnpj",$cnpj);
                $stm->bindValue(":cnpjAlterado",$cnpjAlterado);
                $stm->bindValue(":nome",$nome);
                $stm->bindValue(":endereco",$endereco);
                $stm->bindValue(":cep",$cep);
                $stm->bindValue(":email",$email);
                $stm->bindValue(":telefone",$telefone);


                $stm->execute();

                header("Location: listaFornecedor.php");

            }catch(PDOException $erro){
                print "Deu problema ao inserir o fornecedor no banco" .$erro;
            }
        ?>

    </body>
</html>
