<?php
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 

include_once '../config/database.php';
 

include_once '../objetos/produto.class.php';
 
$database = new Database();
$db = $database->getConnection();
 
$produto = new Produto($db);
 

$data = json_decode(file_get_contents("php://input"));
if(isset($data)){
    $produto->nome = $data->nome;
    $produto->sku = $data->sku;
    $produto->descricao = $data->descricao;
    $produto->estado = $data->estado;
    $produto->preco_padrao = $data->preco_padrao;
    $produto->preco_desconto = $data->preco_desconto;
    $produto->promocao = $data->promocao;
    $produto->quantidade = $data->quantidade;
    $produto->categorias = $data->categorias;
    $produto->imagens = $data->imagens;
    $produto->metaDados = $data->meta_dados;

    if($produto->create()){
        echo '{';
            echo '"message": "Product criado com Sucesso."';
        echo '}';
    }else{
        echo '{';
            echo '"message": "Não Foi possível criar o Produto."';
        echo '}';
    }
}else{
    echo '{';
        echo '"message": "Não Foi possível criar o Produto."';
    echo '}';
}
?>