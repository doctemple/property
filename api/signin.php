<?php
session_start();
include('config.php');
include('user.inc.php');

if(isset($_POST)){
    // Config
    $idcard = $_POST['idcard'];
    $password = $_POST['pwd'];

    // Process
    $api = new INC();
    $sign = $api->CheckSignin($idcard,$password);


    if(!$sign){
        $_SESSION['aut'] = false;
        header('location:../signin.php');
    }else{
        $_SESSION['aut'] = true;
        $_SESSION['role']=1;
            header('location:../profile.php');
    }

}
?>