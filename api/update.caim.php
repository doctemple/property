<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    $api = new INC();
    $add = $api->updateCaim($_POST);


    if(!$add){
        header('location:../caim_edit.php');
    }else{
        header('location:../caims_3.php');
    }


}else{
    header('location:../caims.php');
}


?>