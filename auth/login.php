<?php
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8"); 

    include_once "../config/database.php";
    include_once "../objetos/usuario.class.php";

    $database = new Database();
    $db = $database->getConnection();

    $usuario = new Usuario($db);
    $data = json_decode(file_get_contents("php://input"));
    if(isset($data)){
        $usuario->login = $data->login;
        $stmt = $usuario->doLogin($data->senha);
    }
    


    if(isset($usuario->id)){
        print_r(json_encode($usuario));
    }else{
        echo json_encode(array("message"=> "Login ou Senha Inválidos"));
    }
    
     
    
?>