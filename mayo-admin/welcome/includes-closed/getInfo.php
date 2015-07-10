<?php
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
$id = $_GET['user_details'];
$tempgetusers = mysql_query("SELECT * from `members` where `id`='$id'") or die(mysql_error());
$getusers = mysql_fetch_object($tempgetusers);

echo "<div class='verify_div'><div class='name_info'><p class='verify_detail_lt'>Name:</p><p class='verify_detail_rt'>".$getusers->first_name." ".$getusers->last_name."</p></div>";
echo "<p class='verify_detail_lt'>Email Id:</p><p class='verify_detail_rt'>".$getusers->email_id."</p><br/>";
$state = $getusers->state;
$getstate = mysql_fetch_object(mysql_query("SELECT `state` FROM `states` where state_code = '$state'"));

echo "<div class='name_info'><p class='verify_detail_lt'>State:</p><p class='verify_detail_rt'>".$getstate->state."</p></div>";
echo "<div class='name_info'><p class='verify_detail_lt'>Address:</p><p class='verify_detail_rt'>".$getusers->address."</p></div>";
echo "<div class='name_info'><p class='verify_detail_lt'>Zip Code:</p><p class='verify_detail_rt'>".$getusers->zip_code."</p></div>";
echo "<div class='name_info'><p class='verify_detail_lt'>Contact No.:</p><p class='verify_detail_rt'>".$getusers->contact_number."</p></div>";
echo "<div class='name_info'><p class='verify_detail_lt'>Account Created On:</p><p class='verify_detail_rt'>".date('m-d-Y',strtotime($getusers->date_time))."</p></div></div>";
?>

