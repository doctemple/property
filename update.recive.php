<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    $api = new INC();
    $add = $api->updateTicket($_POST);


    if(!$add){
        header('location:../recive_edit.php');
    }else{
        header('location:../recive_3.php');
    }


}else{
    header('location:../recive.php');
}


?>