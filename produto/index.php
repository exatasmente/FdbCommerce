<?php
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 

if(isset($_GET["id"])){
    header("Location:./getOne.php?". $_SERVER['QUERY_STRING']);
    exit;
}else if(isset($_GET["categoria"])){
    header("Location:./getbyCategory.php?". $_SERVER['QUERY_STRING']);
    exit;
}else{
    $data = json_decode(file_get_contents("php://input"));
    if(isset($data)){
    header("Location:./criar.php");
    exit;
    }else{
    header("Location:./get.php");
    exit;
    }
}

?>