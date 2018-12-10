<?php


class ConexaoBanco {
    //Atributos
    private $user = "root";
    private $senha = "root";
    private $dsn = "mysql:host=localhost;dbname=bibliotecasistem";//tem q mudar
    private $conn;
    
    //Metodos dois underline_ _
    public function __construct() {
        $this->conn =  new PDO($this->dsn,$this->user,$this->senha);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    
    public function getConexao(){
        return $this->conn;
    }
  
}

