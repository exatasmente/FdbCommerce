<?php 
include_once "endereco.class.php";
class Usuario{
    private $conn;
    private $tabela = "usuario_api";
    public $id;
    public $nome;
    public $email;
    public $sobrenome;
    public $ativo;
    public $login;
    
    public $endereco;
    public function __construct($db){
        
        $this->conn = $db;
    }

    public function doLogin($senha){
        $consulta = "SELECT * from ".$this->tabela." where login =? and senha = ?";
        $stmt = $this->conn->prepare($consulta);
        $stmt->bindParam(1, $this->login);
        $senha = md5($senha);
        
        $stmt->bindParam(2,$senha);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id=$row["id_usuario"]; 
        $this->nome=$row["nome"];
        $this->sobrenome = $row["sobrenome"];
        $this->email = $row["email"];
        $this->ativo = $row["ativo"];
        $this->login = $row["login"];
        $this->endereco = new Endereco(
                                            $row['logadouro'],
                                            $row['complemento'],
                                            $row['bairro'],
                                            $row['cidade'],
                                            $row['estado'],
                                            $row['pais'],
                                            $row['cep']
        );
       
    }

}

?>