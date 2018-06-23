<?php 
class Categoria{
    private $conn;
    private $tabela = "categorias";
    public $id;
    public $nome;
    public $idPai;

    public function __construct($db){
        
        $this->conn = $db;
    }

    public function read(){
        $consulta = "SELECT * from ".$this->tabela;
        $stmt = $this->conn->prepare($consulta);
        $stmt->execute();
        
        return $stmt;
    }
    
function readOne(){

    $query = "SELECT * FROM " . $this->tabela . " WHERE id = ? LIMIT 0,1";
 
 
    $stmt = $this->conn->prepare( $query );
 
 
    $stmt->bindParam(1, $this->id);
 
    // execute query
    $stmt->execute();
    
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->id=$row["id"]; 
        $this->nome=$row["nome"];
        $this->idPai=$row["id_pai"];

    
}
}

?>