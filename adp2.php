<?php

$json = file_get_contents('php://input');
$json = json_decode($json);
if (!$json) {
    header("HTTP/1.0 404 Not Found");
    header('Content-Type: application/json');
    die(json_encode(["status" => "error", "description" => "no data send"]));
}



ob_flush();
ob_start();
var_dump($json);
file_put_contents("dump.txt", ob_get_flush());
die();