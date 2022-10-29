<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    $api = new INC();
    $add = $api->addTicket($_POST);


    if(!$add){
        header('location:../recive.php');
    }else{
        header('location:../recive_2.php');
    }

}else{
    header('location:../recive.php');
}


?>