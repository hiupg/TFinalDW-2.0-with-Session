<?php
session_start();

if (isset($_SESSION["login"])){
    if ($_SESSION["login"]==false){
        header("location: login.php");
    }
}else{
    header("location: login.php");
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
            
            $nome = $_POST["nome"];
            $sexo = $_POST["sexo"];
            $cpf = $_POST["cpf"];
            $cargo = $_POST["cargo"];
            $endereco= $_POST["endereco"];
            $telefone= $_POST["telefone"];
            $email=$_POST["email"];
            $pass= md5($_POST["pass"]);
                 
            /* var_dump($_FILES['arquivo']);
            
            $destino = "css/imagens/perfil/".$_FILES['arquivo']['name'];
            
            $tmp = $_FILES['arquivo']['tmp_name'];
            
            move_uploaded_file($tmp, $destino);*/
            
            
            try{
                include './ConexaoBanco.php';
                
                $banco = new ConexaoBanco();
                
                $conn = $banco->getConexao();
                
                 //Query utilizada para consultas e inserções no banco de dados
                 //Nós criamos variáveis com o :chave para que depois possamos colocar o
                 //valor com o bindValue
                $query = "INSERT INTO funcionario (nome,sexo,cpf,cargo,endereco,telefone,email,pass) VALUES (:nome,:sexo,:cpf,:cargo,:endereco,:telefone,:email,:pass)";
                
                 //O prepere cria o stratment que será utilizado pra executar a consulta
                 //E para colocar os valores nas variáveis criadas anteriormente.
                $stm = $conn->prepare($query);
                
                 //Colocando valores nas variáveis
                $stm->bindValue(":nome",$nome);
                $stm->bindValue(":sexo",$sexo);
                $stm->bindValue(":cpf",$cpf);
                $stm->bindValue(":cargo",$cargo);
                $stm->bindValue(":endereco",$endereco);
                $stm->bindValue(":telefone",$telefone);
                $stm->bindValue(":email",$email);
                $stm->bindValue(":pass",$pass);
                
                 //por último precisamos apenas executar a query.
                
                $stm->execute();
                
                header("Location: index.php");
                
            }catch(PDOException $erro){
                print "Ocorreu  problema ao inserir o cliente $nome no banco. <br> error =>$erro";
            }
        ?>

    </body>
</html>
