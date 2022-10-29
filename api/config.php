<?php
$production = true;

# Production
if ($production==true)
{
    $host       = 'localhost';
    $user       = 'cp656732_admin';
    $password   = 'Phuvieng123';
    $dbname     = 'cp656732_tickets';
	$_CONFIG['mode']='prod'; //debug
}else{

# Development
$host       = 'localhost';
$user       = 'root';
$password   = '';
$dbname     = 'sp';
$_CONFIG['mode']='debug'; 
}

define('HOST',$host);
define('DB',$dbname);
define('USR',$user);
define('PWD',$password);


?>
