<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    $api = new INC();
    $update = $api->CaimChangeStatus($_POST);

    if(!$update){
        header('location:../ticket_detail.php?id='.$_GET['tid']);
    }else{
        header('location:../ticket_detail.php?id='.$_GET['tid']);
    }

}else{
    header('location:../ticket_detail.php?id='.$_GET['tid']);
}


?>