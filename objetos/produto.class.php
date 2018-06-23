<?php 
class Produto{
    private $conn;
    private $tabela = "produtos_api";

    public $id;
    public $nome;
    public $sku;
    public $descricao;
    public $estado;
    public $preco_padrao;
    public $preco_desconto;
    public $promocao;
    public $quantidade;
    public $categorias;
    public $imagens;
    public $metaDados;
    public function __construct($db){
        
        $this->conn = $db;
    }

    public function getImages($id){
        $query = "SELECT * FROM imagem_produto WHERE id_produto = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();    
        $images = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($images,array("idImagem"=>$row['id'],"src"=>$row['imagem']));
        }
        return $images;
    }
    public function getMeta($id){
        $query = "SELECT chave,valor FROM meta_produto WHERE id_produto = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();    
        $metas = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){            
            array_push($metas,array("chave"=>$row['chave'],"valor"=>json_decode($row['valor'])));
        }
        return $metas;
    }
    public function getCategories($id){
        $query = "SELECT idCategoria,nomeCategoria,idPai FROM categoriasapi WHERE idProduto = ?";
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $id);
        $stmt->execute();    
        $categories = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($categories,$row);
            if(isset($row['idPai']) ){
                $queryCat = "SELECT id as idCategoria, nome as nomeCategoria, id_pai as idPai FROM categorias WHERE id = ?";
                $stmtPai = $this->conn->prepare( $queryCat );
                $stmtPai->bindParam(1, $row['idPai']);
                $stmtPai->execute();   
                $cat = $stmtPai->fetch(PDO::FETCH_ASSOC);
                array_push($categories,$cat);
            }
        }
        return $categories;
    }
    public function read(){
        $consulta = "SELECT * from ".$this->tabela;
        $stmt = $this->conn->prepare($consulta);
        $stmt->execute();
        
        return $stmt;
    }
    public function create(){
    
        
        $query = "INSERT INTO
                   produtos 
                   (sku,nome,preco_padrao,preco_desconto,id_estado,promocao,quantidade,descricao)
                values
                    (?,?,?,?,?,?,?,?)";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->sku=htmlspecialchars(strip_tags($this->sku));
        $this->preco_padrao=htmlspecialchars(strip_tags($this->preco_padrao));
        $this->preco_desconto=htmlspecialchars(strip_tags($this->preco_desconto));
        $this->estado=htmlspecialchars(strip_tags($this->estado));
        $this->promocao=htmlspecialchars(strip_tags($this->promocao));
        $this->quantidade=htmlspecialchars(strip_tags($this->quantidade));
        $this->descricao=htmlspecialchars(strip_tags($this->descricao));


        $stmt->bindParam(1, $this->sku);
        $stmt->bindParam(2, $this->nome);
        $stmt->bindParam(3, $this->preco_padrao);
        $stmt->bindParam(4, $this->preco_desconto);
        $stmt->bindParam(5,$this->estado);
        $stmt->bindParam(6, $this->promocao);
        $stmt->bindParam(7, $this->quantidade);
        $stmt->bindParam(8, $this->descricao);
        if($stmt->execute()){
            $queryP = "SELECT * FROM " . $this->tabela . " WHERE sku = ? LIMIT 0,1";
            $stmtP = $this->conn->prepare( $queryP );
            $stmtP->bindParam(1, $this->sku);
            $stmtP->execute();
            $row = $stmtP->fetch(PDO::FETCH_ASSOC);
            $this->id=$row["id"]; 
            
            $query2 = "INSERT INTO
                categorias_produto (id_categoria,id_produto)
                VALUES
                (?,?)";
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->bindParam(1, $this->categorias[0]->idCategoria);
            $stmt2->bindParam(2, $this->id);
            if($stmt2->execute()){
                foreach ($this->imagens as $img) {
                    $query3 = "INSERT INTO
                    imagem_produto
                    (id_produto,imagem)
                    values
                    (?,?)";
                    $stmt3 = $this->conn->prepare($query3);
                    $stmt3->bindParam(1, $this->id);
                    $stmt3->bindParam(2, $img);
                    
                    $stmt3->execute();    
                }
                
                foreach ($this->metaDados as $meta) {

                    $queryMeta = "INSERT INTO
                    meta_produto (chave,valor,id_produto)
                    VALUES
                    (?,?,?)";
                    $stmtMeta = $this->conn->prepare($queryMeta);
                    $stmtMeta->bindParam(1, $meta->chave);
                    $stmtMeta->bindParam(2, json_encode($meta->valor));
                    $stmtMeta->bindParam(3, $this->id);
                    $stmtMeta->execute();
                }
            }else{
                return false;
            }
            return true;
            
        }
     
        return false;
         
    }
    function update(){
        $query = "UPDATE 
                   produtos 
                   SET
                   sku=?,
                   nome=?,
                   preco_padrao=?,
                   preco_desconto=?,
                   id_estado=?,
                   promocao=?,
                   quantidade=?,
                   descricao=?
                WHERE 
                id = ?";
     
        // prepare query
        $stmt = $this->conn->prepare($query);
     
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->sku=htmlspecialchars(strip_tags($this->sku));
        $this->preco_padrao=htmlspecialchars(strip_tags($this->preco_padrao));
        $this->preco_desconto=htmlspecialchars(strip_tags($this->preco_desconto));
        $this->estado=htmlspecialchars(strip_tags($this->estado));
        $this->promocao=htmlspecialchars(strip_tags($this->promocao));
        $this->quantidade=htmlspecialchars(strip_tags($this->quantidade));
        $this->descricao=htmlspecialchars(strip_tags($this->descricao));


        $stmt->bindParam(1, $this->sku);
        $stmt->bindParam(2, $this->nome);
        $stmt->bindParam(3, $this->preco_padrao);
        $stmt->bindParam(4, $this->preco_desconto);
        $stmt->bindParam(5,$this->estado['idEstado']);
        $stmt->bindParam(6, $this->promocao);
        $stmt->bindParam(7, $this->quantidade);
        $stmt->bindParam(8, $this->descricao);
            
        $stmt->execute();
     
        
         
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
        $this->sku=$row["sku"];
        $this->descricao=$row["descricao"];
        $this->estado=array("idEstado"=>$row["id_estado"],"valor"=>$row['valorEstado']);
        $this->preco_padrao=$row["preco_padrao"];
        $this->preco_desconto=$row["preco_desconto"];
        $this->promocao=$row["promocao"];
        $this->quantidade=$row["quantidade"];
        
    
}
function getByCategory($idCat){
    $consulta = "SELECT *
                FROM produtos_api,categoriasapi
                WHERE produtos_api.id = categoriasapi.idProduto and
                      categoriasapi.idCategoria = ?";
    $stmt = $this->conn->prepare($consulta);
    $stmt->bindParam(1, $idCat);
    $stmt->execute();
    
    return $stmt;
}
}

?>