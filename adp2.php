<?php
require __DIR__ . '/vendor/autoload.php';

use phpseclib\Crypt\RSA;
use App\Test\Helpers;

$json = file_get_contents('php://input');
$json = json_decode($json,true);
if (!$json) {
    header("HTTP/1.0 404 Not Found");
    header('Content-Type: application/json');
    die(json_encode(["status" => "error", "description" => "no data send"]));
}

$helpers = new Helpers();

$helpers->loadData($json);

$decriptRequestData = $helpers->getDecriptData();

$verify = $helpers->verifySignature($decriptRequestData);

if($verify){
    //insert user into database
    die(json_encode(["status" => "success", "description" => "Спасибо, Ваши данные приняты"]));
}else{
    die(json_encode(["status" => "error", "description" => "Ваши данные испорчены"]));
}


    
die();
?>
