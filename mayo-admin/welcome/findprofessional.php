<?php
require_once('../../includes/functions.php');
$path         = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
$functions    = $_SERVER['DOCUMENT_ROOT']."/classes/functions.php";
require_once($functions);
$functions    = new Allfunctions();
$desg         = $_REQUEST['designation'];
$query        = "select * from `members` where `activated`='1' && designation!=5 and designation!=8";
$designation  = isset($_REQUEST["designation"])?$_REQUEST["designation"]:'';
$fname        = isset($_REQUEST["fname"])?$_REQUEST["fname"]:'';
$lname        = isset($_REQUEST["lname"])?$_REQUEST["lname"]:'';
$email        = isset($_REQUEST["email"])?$_REQUEST["email"]:'';
if($_REQUEST['fname']!="")
{
	$query .="&& `first_name` LIKE '%".$fname."%'";
}
if($_REQUEST['lname']!="")
{
	$query .="&& `last_name` LIKE '%".$lname."%'";
}
if($designation!="")
{
	$query .="&& `designation`='$desg'";
}
if($email!="")
{
	$query .="&& `email_id`='$_REQUEST[email]' ";
}

?>
<div class="view_log_details">
	<div class="log_heading">
		<div class="serial_no">Name</div>
		<div class="user_name">Email Address</div>
		<div class="first_name">Contact Number</div>
		<div class="last_name">Address</div>
		<div class="email_address">Designation</div>
		<div class="organisation">Organisation</div>
		<div class="department">Date</div>
		<div class="department">Action</div>
	</div>
<?php
$data = mysql_query($query) or die(mysql_error());
if(mysql_num_rows($data)>0)
{
while($row = mysql_fetch_object($data))
{
?>
<div class="log_row">
	<div class="serial_no">
		<?php 
			$fname = $row->first_name; 
			$lname=$row->last_name; 
			echo ucwords($fname); 
			echo "&nbsp";
			echo ucwords($lname); 
		?>
	</div>
	<div class="user_name">
		<?php 
			echo $row->email_id; 
		?>
	</div>
	<div class="first_name">
		<?php 
			$contact = $row->contact_number; 
			if($contact!="")
			{
				echo $contact;
			}
			else
			{
				echo "No Contact";
			}
		?>
	</div>
	<div class="last_name">
	<?php 
		$city=$row->state;
		if($city!="")
		{
			echo $functions->GetStatebyStateCode($city).","; echo $row->city.","; echo $row->address.","; echo $row->zip_code.","; 
		}
	?>
	</div>
	<div class="email_address"><?php $desg= $row->designation; echo $functions->getRoleByRoleId($desg); ?></div>
	<div class="organisation"><?php echo $row->organisation; ?></div>
	<div class="department"><?php $date_time = $row->date_time; echo date('h:i:s:a',strtotime($date_time)); ?></div>
	<div class="action"><a href="action.php?data=<?=$row->id?>">Delete/Update</a></div>
</div>
<?php
}
?>
</div>
<?php
}
else
{
	echo "<h1 style='text-align:center;'>No Record Found.</h1>";
}
?>