<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
            $cpf = $_GET['cpf'];
            $nome = $_POST["nome"];
            $sobrenome = $_POST["sobrenome"];
            $sexo = $_POST["sexo"];
            $cpfAlterado = $_POST["cpf"];
            $endereco= $_POST["endereco"];
            $telefone= $_POST["telefone"];
            $email=$_POST["email"];
           
            try{
                include './ConexaoBanco.php';
                
                $banco = new ConexaoBanco();
                
                $conn = $banco->getConexao();
                
                 //Query utilizada para consultas e inserções no banco de dados
                 //Nós criamos variáveis com o :chave para que depois possamos colocar o
                 //valor com o bindValue
                $query = "UPDATE cliente SET nome=:nome,sobrenome=:sobrenome,sexo=:sexo,cpf=:cpfAlterado"
                        . ",endereco=:endereco,telefone=:telefone, email=:email WHERE cpf=:cpf";// CPF não está alterando;
                
                 //O prepare cria o stratment que será utilizado pra executar a consulta
                 //E para colocar os valores nas variáveis criadas anteriormente.
                $stm = $conn->prepare($query);
                
                
                 //Colocando valores nas variáveis
                $stm->bindValue(":nome",$nome);
                $stm->bindValue(":sobrenome",$sobrenome);
                $stm->bindValue(":sexo",$sexo);
                $stm->bindValue(":cpf",$cpf);
                $stm->bindValue(":cpfAlterado",$cpfAlterado);
                $stm->bindValue(":endereco",$endereco);
                $stm->bindValue(":telefone",$telefone);
                $stm->bindValue(":email",$email);
                
                
                
                 //por último precisamos apenas executar a query.
                
                $stm->execute();
                
               header("Location: index.php");
                
            }catch(PDOException $erro){
                print "Ocorreu erro ao alterar dados do cliente $nome no banco. <br> error=> $erro";
            }
        ?>

    </body>
</html>

