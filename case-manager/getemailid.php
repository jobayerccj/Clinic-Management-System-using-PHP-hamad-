<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$q       = $_GET['q'];
$my_data = $q;
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
require_once($config);
include('../classes/login-functions.php');
include('classes/meshed.php');
$get_emailid = new Meshed();
echo $get_emailid->Populatedata($my_data);
?>
