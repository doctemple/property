<?php
session_start();
include('config.php');
include('icare.inc.php');
header('Content-Type: Application/json; charset=utf8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
$cid = $_SESSION['cid'];
    $api = new INC();
    $caim = $api->Caim($cid);

    $time = strtotime($caim['createDate']);
    $newformat = date('ymd',$time);

    $caimCode = $newformat.$cid;

echo json_encode(['caimCode' => $caimCode],JSON_UNESCAPED_UNICODE);
?>