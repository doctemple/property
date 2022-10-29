<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_GET)){
    $api = new INC();
    $add = $api->delTicket($_GET);


    if(!$add){
        header('location:../history.php');
    }else{
        header('location:../history.php');
    }


}else{
    header('location:../history.php');
}


?>