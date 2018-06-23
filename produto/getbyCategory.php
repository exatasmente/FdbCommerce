<?php header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once '../config/database.php';
include_once '../objetos/produto.class.php';
$database = new Database();
$db = $database->getConnection();
 

$produto = new Produto($db);
 

$idCat = $_GET['categoria'];
$stmt = $produto->getByCategory($idCat);
$num = $stmt->rowCount();


if($num > 0){
    $prodArray = array();
    $prodArray['dados'] = array();

    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $prod = array(
            "id"=> $id,
            "nome"=> $nome,
            "sku"=>$sku,
            "descricao"=>html_entity_decode($descricao),
            "estado"=>array("idEstado"=>$id_estado,"valor"=>$valorEstado),
            "preco_padrao"=>$preco_padrao,
            "preco_desconto"=>$preco_desconto,
            "promocao"=>$promocao,
            "quantidade"=>$quantidade,
            "imagens" => $produto->getImages($id),
            "categorias" => $produto->getCategories($id),
            "meta_dados" => $produto->getMeta($id)

        );
        
        array_push($prodArray['dados'],$prod);

    }
    echo json_encode($prodArray);
}else{
    echo json_encode(array("message"=> "Sem Produtos com essa Categoria"));
} 


?>