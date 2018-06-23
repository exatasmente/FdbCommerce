<?php 
class Database{
    private $host = "localhost";
    private $dbName = "fdb";
    private $username = "root";
    private $password ="383842";

    private $conn;


    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbName,$this->username,$this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erro de conexão com o banco de dados". $exception->getMessage();
        }

        return $this->conn;
    }

}
?>