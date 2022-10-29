<?php
session_start();
include('config.php');
include('user.inc.php');

if(isset($_GET['id'])){
    // Config
    // Process
    $api = new INC();
    $del = $api->delMember($_GET['id']);

    if($del){
        header('location:../members.php');
    }else{
        echo "ลบข้อมูลสมาชิก ไม่สำเร็จ";
    }

}
?>