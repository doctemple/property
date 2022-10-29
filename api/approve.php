<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    $tid = $_POST['tid'];
    $api = new INC();
    $add = $api->TicketApprove($_POST);


    if(!$add){
        header('location:../recive_wait.php?tid='.$tid);
    }else{
        header('location:../recive_wait.php?tid='.$tid);
    }


}else{
    header('location:../index.html');
}


?>