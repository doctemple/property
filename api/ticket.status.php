<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_REQUEST)){
    $api = new INC();
    $update = $api->TicketChangeStatus($_REQUEST);
              $api->TicketApprove($_REQUEST);

    if(!$update){
        header('location:../tickets.php?c=0');
    }else{
        if(isset($_REQUEST['s']) && $_REQUEST['s']==4){
            session_destroy();
            header('location:../index.html');
        }else{
        header('location:../ticket_detail.php?c=1&id='.$_REQUEST['id']);
        }
    }



}else{
    header('location:../tickets.php.php');
}


?>