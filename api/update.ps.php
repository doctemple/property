<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_GET)){
    $api = new INC();
    $add = $api->updateTicketPS($_GET);


    if(!$add){
        header('location:../ticket_detail.php?c=0&id='.$_REQUEST['id']);
    }else{
        header('location:../ticket_detail.php?c=1&id='.$_REQUEST['id']);
    }


}else{
    header('location:../tickets.php');
}


?>