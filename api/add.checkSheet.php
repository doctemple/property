<?php
session_start();
include('config.php');
include('user.inc.php');

if(isset($_POST)){
    // Config

    // Process
    $api = new INC();
    $add = $api->addCheckSheet($_POST);
        $id = $_POST['member'];

    if(!$add){
        //header('location:../add.checkSheet.php?id='.$id);
    }else{
        header('location:../checkList.php');
    }

}
?>