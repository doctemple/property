<?php
$production = true;

# Production
if ($production==true)
{
    $host       = 'localhost';
    $user       = '';
    $password   = '';
    $dbname     = '';
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
