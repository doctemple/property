<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("content-type:text/javascript;charset=utf-8");   
include('config.php');
include('user.inc.php');
$m = $_GET['m'];
    $api = new INC();
    $reports = $api->Reports($m);

    echo json_encode($reports);