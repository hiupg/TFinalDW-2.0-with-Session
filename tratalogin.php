<?php
    session_start();

    $email = $_POST["email"];
    $pass = $_POST["pass"];

    include './ConexaoBanco.php';

    $banco = new ConexaoBanco();
    $conn = $banco->getConexao();

    $query = "SELECT email,pass FROM funcionario WHERE email=:email";

    $stm = $conn->prepare($query);
    $stm->bindValue(":email",$email);

    $stm->execute();

    $result = $stm->fetch(PDO::FETCH_ASSOC);
    if($result == null){
        print ("No enters with this e-mail");
    }
    else{
        if (md5($pass) == $result["pass"]){
            $_SESSION["login"]=true;
            header("location: cadastro_f.php");
        }
        else{
            print ("Your password don't match with this e-mail");
            $_SESSION["login"]=true;
        }
    }