<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_GET['id'])){
    // Config
    // Process
    $api = new INC();
    $del = $api->delNews($_GET['id']);

    if($del){
        @unlink('../images/products/'.$_GET['img']);
        header('location:../products.php');
    }else{
        echo "ลบข้อมูลข่าว ไม่สำเร็จ";
    }

}
?>