<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    // Config
    // Process
    $api = new INC();
    $add = $api->addMember($_POST);


    if(!$add){
        header('location:../signup.php');
    }else{
        header('location:../members.php');
    }


}
?>