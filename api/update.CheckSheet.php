<?php
session_start();
include('config.php');
include('user.inc.php');

if(isset($_POST)){
    // Config

    // Process
    $api = new INC();
    $update = $api->updateCheckSheet($_POST);
    $id = $_POST['id'];
    $member = $_POST['member'];

    if(!$update){
        header('location:../edit.checkSheet.php?id='.$member."&sid=".$id);
    }else{
        header('location:../checkList.php');
    }

}
?>