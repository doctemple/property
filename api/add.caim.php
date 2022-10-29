<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    $api = new INC();
    $add = $api->addCaim($_POST);


    if(!$add){
        header('location:../caims.php');
    }else{
        header('location:../caims_2.php');
    }


}else{
    header('location:../caims.php');
}


?>