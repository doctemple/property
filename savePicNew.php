<?php
session_start();
if (isset($_FILES['myFile'])) {
    move_uploaded_file($_FILES['myFile']['tmp_name'], "images/news/logo.png" );
    echo 'successful';
}

?>