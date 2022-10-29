<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    $api = new INC();
    $add = $api->addTicket($_POST);


    if(!$add){
        header('location:../service.php');
    }else{
        header('location:../service_2.php');
    }


}else{
    header('location:../service.php');
}


?>