<?php
session_start();
include('config.php');
include('icare.inc.php');
header('Content-Type: Application/json; charset=utf8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');

if(isset($_REQUEST['tid'])){
    $tid = $_REQUEST['tid'];
}else{
    if(isset($_SESSION['tid'])){
    $tid = $_SESSION['tid'];  
    }
}

    $api = new INC();
    $ticket = $api->Ticket($tid);
    
echo json_encode(['tStatus' => $ticket['tStatus']],JSON_UNESCAPED_UNICODE);
?>