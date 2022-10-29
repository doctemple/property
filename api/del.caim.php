<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_GET)){
    $api = new INC();
    $add = $api->delCaim($_GET);


    if(!$add){
        header('location:../caims_history.php');
    }else{
        header('location:../caims_history.php');
    }


}else{
    header('location:../caims_history.php');
}


?>