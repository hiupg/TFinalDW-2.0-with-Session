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
        <link href="../css/register_style.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    </head>
    <body>
        
          <div class="top_content">
                        <div>
                           <a class="top_words" href="cadastro_f.php" > <h3> Cadastrar Funcionários</h3>  </a>
                        </div>

                        <div>
                                  <a href="../index.php"><img class="logo" src="logo.png"></a>
                       </div>

                         <div>
                           <a class="top_words" href="index.php"> <h3> Listar Funcionários</h3>  </a>                  
                        </div>
            </div>   
        
        <div class="register_part">
        
        <?php
            include './ConexaoBanco.php';
            $banco = new ConexaoBanco();
            
            if(isset($_GET["cpf"])){
                ?>
                    <div class="container justify-center letter">
                                         <h1>Alterar dados do Funcionário</h1>
                    </div>
            <?php
                $cpf_func = $_GET["cpf"];    
                
                
                $query="SELECT * from funcionario WHERE cpf=:cpf";
                
                $stm = $banco->getConexao()->prepare($query);
                $stm->bindValue(":cpf",$cpf_func);
                $stm->execute();
                
                $funcionarioBuscado = $stm->fetch(PDO::FETCH_ASSOC);
                
                
                //Se  o estudanteBuscado for igual a falso significa que ele foi excluido do banco 
                //Enquanto entramos na tela de alterar.
                if($funcionarioBuscado == FALSE){
                    // header manda a navegação para a tela que especificamos.
                    header("Location: index.php");
                }
            }else{
                $cpf_func = NULL;
                ?>
                    <div class="container justify-center letter">
                              <h1>Cadastro de Funcionário</h1>
                    </div>
                <?php
                }
                ?>
            
           <div class="container white"> 
        
        <?php if($cpf_func){
             ?>
        <form action="alteraFuncionario.php?cpf=<?php echo ($cpf_func);?>" method="post" enctype="multipart/form-data">
            
                <?php
        }
        else{
            ?>
                <form action="cadastroFuncionario.php" method="post" enctype="multipart/form-data">
                <?php
            }
        ?>
            <div>
                <label>Nome</label><br>
                <input class="input_text" type="text" name="nome" value="<?php 
                        if($cpf_func){
                            print $funcionarioBuscado["nome"];
                        } ?>">
                    
            </div>
           
            <div class="div_mef">
                <label>Sexo</label><br>
                <?php if($cpf_func==NULL){?>
                M<input class="mef" type="radio" name="sexo" value="M" checked="checked">
                    F<input class="mef" type="radio" name="sexo" value="F">
                <?php }
                    else{
                        if($funcionarioBuscado["sexo"]=='M'){
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
                        if($cpf_func){
                            echo($funcionarioBuscado["cpf"]);
                        } 
                        ?>">                    
            </div>
            
            <div>
                <label>Cargo</label><br>
                <input class="input_text" type="text" name="cargo" value="<?php 
                    if($cpf_func){
                        print $funcionarioBuscado["cargo"];
                    } ?>">
            </div>        
                    
            <div>
                <label>Endereço</label><br>
                <input class="input_text" type="text" name="endereco" value="<?php 
                        if($cpf_func){
                            print $funcionarioBuscado["endereco"];
                        } ?>"> 
            </div>
                    
            <div>
                <label>Telefone</label><br>
                <input class="input_text" type="text" name="telefone" value="<?php 
                        if($cpf_func){
                            print $funcionarioBuscado["telefone"];
                        } ?>">
            </div> 
            
             <div>
                <label>E-mail</label><br>
                <input class="input_text" type="email" name="email" value="<?php
                        if($cpf_func){
                            print $funcionarioBuscado["email"];
                        } ?>">                  
            </div>
                    <label>Senha</label><br>
                    <input class="input_text" type="password" name="pass">
                    
            <div class="container">
                <input class="btnenviar" type="submit" value="Confirmar">
            </div>
            
                </form>
            </div>   
        </div>
        
    </body>
</html>