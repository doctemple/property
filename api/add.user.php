<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    // Config
    // Process
    $api = new INC();
    $add = $api->addUser($_POST);

    if(!$add){
        header('location:../add.users.php');
    }else{
        header('location:../users.php');
    }

}
?>