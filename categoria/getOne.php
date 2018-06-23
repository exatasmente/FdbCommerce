<?php header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
include_once '../config/database.php';
include_once '../objetos/categoria.class.php';
$database = new Database();
$db = $database->getConnection();
 

$categoria = new Categoria($db);
 

$categoria->id = $_GET['id'];
 

$categoria->readOne();
 
if(isset($categoria->id)){
    $categoria_arr =
        array(
        "id"=> $categoria->id,
        "nome"=> $categoria->nome,
        "idPai"=>$categoria->idPai,
  
        );
    print_r(json_encode($categoria_arr));
}else{
    echo json_encode(array("message"=> "Categoria não encontrada"));
}

 


?>