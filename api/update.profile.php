<?php
session_start();
include('config.php');
include('user.inc.php');

if(isset($_POST)){
    // Config

    // Process
    $api = new INC();
    $update = $api->updateProfile($_POST);


    if(!$update){
        header('location:../edit-profile.php');
    }else{
        header('location:../profile.php');
    }

}
?>