<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    $tid = $_POST['tid'];
    $api = new INC();
    $add = $api->ticketAddPrice($_POST);

    if(!$add){
        header('location:../ticket_detail.php?id='.$tid);
    }else{
        header('location:../ticket_detail.php?id='.$tid);
    }


}else{
    header('location:../ticket_detail.php?id='.$tid);
}


?>