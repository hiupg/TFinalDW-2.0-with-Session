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
        <link  href="../css/estilo.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <title>Listagem de Funcionários</title>
    </head>
    <body>
        <div class="content">
                    <div>
                       <a class="letra" href="cadastro_f.php"> <h3> Cadastrar Funcionários</h3>  </a>                  
                    </div>

                    <div>
                              <a href="../index.php"><img class="logo" src="logo.png"></a>
                   </div>

                     <div>
                       <a class="letra" href="index.php"> <h3> Listar Funcionários</h3>  </a>                  
                    </div>
        </div>   
        
           <div class="list_part">
                    <div class="container justify-center letter"><h1>Listagem de Funcionários</h1></div>

                    <div class="container justify-center white">
        
        <?php
            try{
                include './ConexaoBanco.php';
                
                $banco = new ConexaoBanco();
                
                $conn = $banco->getConexao();
                
                //print("Sucesso em conectar com o banco");
                $query="SELECT * from funcionario";
                $stm = $conn->prepare($query);
                
                $stm->execute();
  
                
                print"<table class='edit_table'>";
                    print "<th><tr>";
                        print"<td>Nome</td>";
                        print "<td>Sexo</td>";
                        print "<td>CPF</td>";
                        print "<td>Cargo</td>";
                        print "<td>Endereço</td>";
                        print "<td>Telefone</td>";
                        print"<td>Email</td>";
                        print "<td>EXCLUIR</td>";
                        print "<td>ALTERAR</td>";
                    print "</tr></th>";  
                    
                    for($i=0;$i<$stm->rowCount();$i++){
                    $aux = $stm->fetch(PDO::FETCH_OBJ);
                    print "<tr>";
                    
                    print "<td>".$aux->nome."</td>";
                    print "<td>".$aux->sexo."</td>";
                    print "<td>".$aux->cpf."</td>";
                    print "<td>".$aux->cargo."</td>";
                    print "<td>".$aux->endereco."</td>";
                    print "<td>".$aux->telefone."</td>";
                    print "<td>".$aux->email."</td>";
        ?>
         <td><a class="del_alt" href="excluirFuncionario.php?cpf=<?php echo $aux->cpf; ?>">Excluir</a></td>
        <td><a class="del_alt" href="cadastro_f.php?cpf=<?php echo $aux->cpf; ?>">Alterar</a></td>
        
        <?php
                    print"</tr>";
                    }
            }
            
            catch(PDOException $erro){
                print("Ocorreu um erro ao conectar com o banco <br> error=> $erro");
            }         
        ?>
                    </div>
           </div>
        
    </body>
</html>
