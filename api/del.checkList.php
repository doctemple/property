<?php
session_start();
include('config.php');
include('user.inc.php');

if(isset($_GET['id'])){
    // Config
    // Process
    $api = new INC();
    $del = $api->delCheckSheet($_GET['id']);

    if($del){
        header('location:../checkList.php');
    }else{
        echo "ลบข้อมูลข่าว ไม่สำเร็จ";
    }

}
?>