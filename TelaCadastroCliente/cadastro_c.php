<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="../css/register_style.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <title>Cadastro de Clientes</title>
    </head>
    <body>
        
                <div class="top_content">
                        <div>
                           <a class="top_words" href="cadastro_c.php" > <h3> Cadastrar Clientes</h3>  </a>                  
                        </div>

                        <div>
                            <a href="../index.php"><img class="logo" src="logo.png"></a>
                       </div>

                         <div>
                           <a class="top_words" href="index.php"> <h3> Listar Clientes</h3>  </a>                  
                        </div>
                  </div>   
        
        <div class="register_part">
            
                            <?php
                            include './ConexaoBanco.php';
                            $banco = new ConexaoBanco();

                            if(isset($_GET["cpf"])){
                                ?>
                                    <div class="container justify-center letter">
                                         <h1>Alterar dados do Cliente</h1>
                                     </div>
                                <?php
                                
                                $cpfcliente = $_GET["cpf"];    


                                $query="SELECT * from cliente WHERE cpf=:cpf";

                                $stm = $banco->getConexao()->prepare($query);
                                $stm->bindValue(":cpf",$cpfcliente);
                                $stm->execute();

                                $clienteBuscado = $stm->fetch(PDO::FETCH_ASSOC);


                                //Se  o estudanteBuscado for igual a falso significa que ele foi excluido do banco 
                                //Enquanto entramos na tela de alterar.
                                if($clienteBuscado == FALSE){
                                    // header manda a navegação para a tela que especificamos.
                                    header("Location: index.php");
                                }
                            }else{
                                $cpfcliente = NULL;
                                ?>
                                    <div class="container justify-center letter">
                                         <h1>Cadastro de Cliente</h1>
                                     </div>
                                <?php
                            }
                    ?>
                <div class="container white">

                    <?php if($cpfcliente){
                         ?>
                    <form action="alteraCliente.php?cpf=<?php echo ($cpfcliente);?>" method="post" enctype="multipart/form-data">

                            <?php
                    }
                    else{
                        ?>
                            <form action="cadastroCliente.php" method="post" enctype="multipart/form-data">
                            <?php
                        }
                    ?>
                        <div>
                            <label>Nome</label><br>
                            <input class="input_text" type="text" name="nome" value="<?php 
                                    if($cpfcliente){
                                        print $clienteBuscado["nome"];
                                    } ?>">

                        </div>
                        <div>
                            <label>Sobrenome</label><br>
                            <input class="input_text" type="text" name="sobrenome" value="<?php 
                                if($cpfcliente){
                                    print $clienteBuscado["sobrenome"];
                                } ?>">
                        </div>
                        <div class="div_mef">
                            <label>Sexo</label><br>
                            <?php if($cpfcliente==NULL){?>
                                M<input class="mef"type="radio" name="sexo" value="M" checked="checked">
                                F<input class="mef" type="radio" name="sexo" value="F">
                            <?php }
                                else{
                                    if($clienteBuscado["sexo"]=='M'){
                                        ?>
                                            M<input class="mef" type="radio" name="sexo" value="M" checked="checked">
                                            F<input class="mef" type="radio" name="sexo" value="F">

                                        <?php


                                    }else{
                                        ?>
                                            M<input class="mef" type="radio" name="sexo" value="M">
                                            F<input class="mef" type="radio" name="sexo" value="F" checked="checked">
                                        <?php
                                        }
                                   }
                            ?>
                        </div>
                        <div>
                            <label>CPF</label><br>
                            <input class="input_text" type="text" name="cpf" value="<?php 
                                    if($cpfcliente){
                                        echo($clienteBuscado["cpf"]);
                                    } 
                                    ?>">

                        </div>

                        <div>
                            <label>Endereço</label><br>
                            <input class="input_text" type="text" name="endereco" value="<?php 
                                    if($cpfcliente){
                                        print $clienteBuscado["endereco"];
                                    } ?>">

                        </div>

                        <div>
                            <label>Telefone</label><br>
                            <input class="input_text" type="text" name="telefone" value="<?php 
                                    if($cpfcliente){
                                        print $clienteBuscado["telefone"];
                                    } ?>">

                        </div> 

                         <div>
                            <label>E-mail</label><br>
                            <input class="input_text" type="text" name="email" value="<?php 
                                    if($cpfcliente){
                                        print $clienteBuscado["email"];
                                    } ?>">

                        </div> 

                        <div class="container">
                            <input class="btnenviar" type="submit" value="Confirmar">
                        </div>

                    </form>
            </div>

        </div>
            
        
    </body>
</html>