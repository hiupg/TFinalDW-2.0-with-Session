<?php
session_start();

if (isset($_SESSION["login"])){
    if ($_SESSION["login"]==false){
        header("location: ../login.php");
    }
}else{
    header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
            $cpf =$_GET["cpf"];
            $nome =$_POST["nome"];
            $sexo =$_POST["sexo"];
            $cpfAlterado = $_POST["cpf"];
            $cargo =$_POST["cargo"];
            $endereco=$_POST["endereco"];
            $telefone=$_POST["telefone"];
            $email=$_POST["email"];
         
            
            try{
                include './ConexaoBanco.php';
                
                $banco = new ConexaoBanco();
                
                $conn = $banco->getConexao();
                
                 //Query utilizada para consultas e inserções no banco de dados
                 //Nós criamos variáveis com o :chave para que depois possamos colocar o
                 //valor com o bindValue
                $query = "UPDATE funcionario SET nome=:nome,sexo=:sexo,cpf=:cpfAlterado,cargo=:cargo,"
                        . "endereco=:endereco,telefone=:telefone, email=:email WHERE cpf=:cpf";
                
                 //O prepare cria o stratment que será utilizado pra executar a consulta
                 //E para colocar os valores nas variáveis criadas anteriormente.
                $stm = $conn->prepare($query);
                
                 //Colocando valores nas variáveis
                $stm->bindValue(":nome",$nome);
                $stm->bindValue(":sexo",$sexo);
                $stm->bindValue(":cpf",$cpf);
                $stm->bindValue(":cpfAlterado",$cpfAlterado);
                $stm->bindValue(":cargo",$cargo);
                $stm->bindValue(":endereco",$endereco);
                $stm->bindValue(":telefone",$telefone);
                $stm->bindValue(":email",$email);
                

                
                 //por último precisamos apenas executar a query.
                
                $stm->execute();
                
                header("Location: index.php");
                
            }catch(PDOException $erro){
                print "Ocorreu erro ao alterar dados do funcionário $nome no banco. <br> <br>error=> $erro";
            }
        ?>

    </body>
</html>

