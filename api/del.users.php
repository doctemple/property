<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_GET['id'])){
    // Config
    // Process
    $api = new INC();
    $del = $api->delUser($_GET['id']);

    if($del){
        header('location:../users.php');
    }else{
        echo "ลบข้อมูลผู้ใช้ ไม่สำเร็จ";
    }

}
?>