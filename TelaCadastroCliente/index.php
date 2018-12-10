<?php
    include '../loginho.php';
?>
<!DOCTYPE.html>
<html>
    <head>
        <meta charset="UTF-8">
         <title>Listagem de Clientes</title>
         <link href="../css/estilo.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        
    </head>
    <body>
<!--        <div class="topo_pag">        -->
                 <div class="content">
                        <div>
                           <a class="letra" href="cadastro_c.php"> <h3> Cadastrar Clientes</h3>  </a>                  
                        </div>

                        <div>
                            <a href="../index.php"><img class="logo" src="logo.png"></a>
                       </div>

                         <div>
                           <a class="letra" href="index.php"> <h3> Listar Clientes</h3>  </a>                  
                        </div>
                  </div>   
                     
<!--                     <a href="cadastro_c.php">Cadastrar Clientes</a>-->
                
<!--        </div>-->
            
        <div class="list_part">
                    <div class="container justify-center letter"><h1>Listagem de Clientes</h1></div>

                    <div class="container justify-center white">
                    <?php
                            try{
                            include './ConexaoBanco.php';

                            $banco = new ConexaoBanco();

                            $conn = $banco->getConexao();

                            //print("Sucesso em conectar com o banco");
                            $query="SELECT * from cliente";
                            $stm = $conn->prepare($query);

                            $stm->execute();
            //                print $stm->rowCount()."<br>";//mostra a contagem de pessoas

                            print"<table class='edit_table'>";
                                print "<th><tr>";
                                    print"<td>Nome</td>";
                                    print "<td>Sobrenome</td>";
                                    print "<td>Sexo</td>";
                                    print "<td>CPF</td>";
                                    print "<td>Endereço</td>";
                                    print "<td>Telefone</td>";
                                    print"<td>E-mail</td>";
                                    print "<td>EXCLUIR</td>";
                                    print "<td>ALTERAR</td>";
                                print "</tr></th>";  

                                for($i=0;$i<$stm->rowCount();$i++){
                                $aux = $stm->fetch(PDO::FETCH_OBJ);
                                print "<tr>";

                                print "<td>".$aux->nome."</td>";
                                print "<td>".$aux->sobrenome."</td>";
                                print "<td>".$aux->sexo."</td>";
                                print "<td>".$aux->cpf."</td>";
                                print "<td>".$aux->endereco."</td>";
                                print "<td>".$aux->telefone."</td>";
                                print "<td>".$aux->email."</td>";
                    ?>
                     <td><a class="del_alt" href="excluirCliente.php?cpf=<?php echo $aux->cpf; ?>">Excluir</a></td>
                    <td><a class="del_alt" href="cadastro_c.php?cpf=<?php echo $aux->cpf; ?>">Alterar</a></td>

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
        
<!--            <div class="container rodape"> 
                <h3> Rodapéricles </h3>
            </div>-->
        
        
         
           
        
    </body>
</html>
