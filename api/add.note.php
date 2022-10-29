<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    $api = new INC();
    $add = $api->noteTicket($_POST);
    $tid=$_POST['id'];


    if(!$add){
        header('location:../ticket_detail.php?id='.$tid);
    }else{
        header('location:../ticket_detail.php?id='.$tid);
    }


}else{
    header('location:../tickets.php');
}


?>