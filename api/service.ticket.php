<?php
session_start();
include('config.php');
include('icare.inc.php');
header('Content-Type: Application/json; charset=utf8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
$tid = $_SESSION['tid'];
    $api = new INC();
    $ticket = $api->Ticket($tid);

    $time = strtotime($ticket['createDate']);
    $newformat = date('ymd',$time);

    $ticketCode = $newformat.$tid;

echo json_encode(['ticketCode' => $ticketCode],JSON_UNESCAPED_UNICODE);
?>