<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    // Config

    // Process
    $api = new INC();
    $update = $api->updateUser($_POST);


    if(!$update){
        header('location:../edit.user.php');
    }else{
        header('location:../users.php');
    }


}
?>