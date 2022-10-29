<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_POST)){
// Config
$username = $_POST['user'];
$password = $_POST['pwd'];

// Process
$api = new INC();
$login = $api->CheckLogin($username,$password);

if(!$login){
    $_SESSION['aut'] = false;
    header('location:../main.php');
}else{
    
    if($api->CheckRole($_SESSION['u'])){
        $_SESSION['role']=3;
    }else{
        $_SESSION['role']=2;
    }
    $_SESSION['firstName'] = $api->getFirstName($_SESSION['u']);
    $_SESSION['aut'] = true;
        header('location:../admin.php');
}



}
?>