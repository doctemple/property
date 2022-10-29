<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
    $api = new INC();
    $check = $api->checkService($_POST);

    $sizeof = sizeof($check);

    if($sizeof>0){
        header('location:../service.list.php?phone='.$_POST['cPhone']);
    }else{
        header('location:../follow.php?r=0');
    }


}else{
    header('location:../follow.php');
}


?>