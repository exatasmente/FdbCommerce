<?php
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 

if(isset($_GET["id"])){
    header("Location:./getOne.php?". $_SERVER['QUERY_STRING']);
    exit;
}else{
    header("Location:./get.php");
}

?>