<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    // Config

    // Process
    $api = new INC();
    $update = $api->updateSystem($_POST['system']);

    if(!$update){
        header('location:../setting.php');
    }else{
        header('location:../setting.php');
    }


}
?>