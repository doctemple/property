<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_GET['id'])){
    // Config
    // Process
    $api = new INC();
    $del = $api->delPrice($_GET['id']);

    $tid=$_GET['tid'];
    if($del){
        header("location:../ticket_detail.php?id={$tid}");
    }else{
        header("location:../ticket_detail.php?id={$tid}");
    }

}
?>