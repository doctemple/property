<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    // Config

    // Process
    $api = new INC();
    $update = $api->updateProfile($_POST);


    if(!$update){
        header('location:../edit.member.php');
    }else{
        header('location:../members.php');
    }

}
?>