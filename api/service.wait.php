<?php
session_start();
include('config.php');
include('icare.inc.php');

if(isset($_GET)){

        $_SESSION['tid'] = $_GET['tid'];
        $_SESSION['wait'] = 1;
        header('location:../service_wait.php');

}else{
    header('location:../follow.php');
}


?>