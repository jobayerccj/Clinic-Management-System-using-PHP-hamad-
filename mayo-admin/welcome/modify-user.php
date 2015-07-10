<?php
session_start();

require_once('../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);

include '../functions.php';

include 'class.php';

if(loggedin())
{
	include('header.php');
?>
<link rel="stylesheet" href="admin-style.css" type="text/css">
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<h1 class="add_user">Users Details</h1>
			<div class="log_calender">
				<label>Date From</label>
				<input type="date" name="" id=""/>
				<label>Date To</label>
				<input type="date" name="" id=""/>
				<input type="Submit" name="" id="" value="Submit"/>
			</div>
			<div class="view_log_details">
				<div class="log_heading">
					<div class="serial_no">S.No.</div>
					<div class="user_name">User Name</div>
					<div class="first_name">First Name</div>
					<div class="last_name">Last Name</div>
					<div class="email_address">Email Address</div>
					<div class="organisation">Organisation</div>
					<div class="department">Action</div>
				</div>
<?php 
	$i = 1;
	$usersdata = mysql_query("SELECT * FROM `members` where designation!=8 || designation!=5") or die(mysql_error());
	while($userdetails = mysql_fetch_array($usersdata))
	{
		
 ?>		
		<div class="log_row">
			<div class="serial_no"><?php echo $i; ?></div>
			<div class="user_name"><?php echo $userdetails['user_name'];?></div>
			<div class="first_name"><?php echo $userdetails['first_name'];?></div>
			<div class="last_name"><?php echo $userdetails['last_name'];?></div>
			<div class="email_address"><?php echo $userdetails['email_id'];?></div>
			<div class="organisation"><?php echo $userdetails['organisation'];?></div>
			<div class="department"><a href="edituser.php?id=<?php echo $userdetails['id'];?>">Edit</a></div>
		</div>
<?php
$i++;
}
?>
			</div>
		</div>
	</div>
</section>

</div>
	</div>
</section>
<?php
include($get_footer);
}
else
{
header('Location:../login.php');
}
?>
