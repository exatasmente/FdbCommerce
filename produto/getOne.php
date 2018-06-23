<?php header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once '../config/database.php';
include_once '../objetos/produto.class.php';
$database = new Database();
$db = $database->getConnection();
 

$product = new Produto($db);
 

$product->id = $_GET['id'];
 

$product->readOne();
 
if(isset($product->id)){
    $product_arr =
        array(
        "id"=> $product->id,
        "nome"=> $product->nome,
        "sku"=>$product->sku,
        "descricao"=>html_entity_decode($product->descricao),
        "estado"=>$product->estado,
        "preco_padrao"=>$product->preco_padrao,
        "preco_desconto"=>$product->preco_desconto,
        "promocao"=>$product->promocao,
        "quantidade"=>$product->quantidade,
        "imagens" => $product->getImages($product->id),
        "categorias" => $product->getCategories($product->id),
        "meta_dados" =>$product->getMeta($product->id)
        );
    print_r(json_encode($product_arr));
}else{
    echo json_encode(array("message"=> "Produto não encontrado"));
}

 


?>