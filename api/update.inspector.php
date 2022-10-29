<?php
session_start();
include('config.php');
include('user.inc.php');

if(isset($_POST)){
    // Config

    // Process
    $api = new INC();
    $update = $api->updateInspector($_POST);


    if(!$update){
        header('location:../edit-inspector.php');
    }else{
        header('location:../inspector.php');
    }

}
?>