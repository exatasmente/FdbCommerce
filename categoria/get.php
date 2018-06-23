<?php
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8"); 

    include_once "../config/database.php";
    include_once "../objetos/categoria.class.php";

    $database = new Database();
    $db = $database->getConnection();

    $categoria = new Categoria($db);

    $stmt = $categoria->read();
    $num = $stmt->rowCount();


    if($num>0){
        $catArray = array();
        $catArray['dados'] = array();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $cat = array(
                "id"=> $id,
                "nome"=> $nome,
                "idPai"=>$id_pai,
               
            );
            array_push($catArray['dados'],$cat);

        }
        echo json_encode($catArray);
    }else{
        echo json_encode(array("message"=> "Sem Categorias"));
    }
?>