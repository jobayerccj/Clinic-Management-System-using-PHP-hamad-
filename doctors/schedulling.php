<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
$a_username    = $_SESSION['username'];
		
$getfunction   = new Allfunctions();
$designationid = $getfunction->GetObjectByUsername("id",$a_username);
?>
<section class="row">
	<div class="container">
		<div class="search_bottom">
			<h1>Schedulling</h1>
			<div class="attorney_row">
				<div class="attorney_row_heading">
					<div class="attorney_client_1">Client No.</div>
					<div class="attorney_client_2">Client Name</div>
					<div class="attorney_client_3">Contact No.</div>
					<div class="attorney_client_4">Email-Address</div>
					<div class="attorney_client_4">Date of Birth</div>
					<div class="attorney_client_5">Date</div>
					<div class="attorney_client_6">Action</div>
				</div>
				<?php
					$qry = "SELECT * FROM `bill_forward_doctor` WHERE `doctor_id`='$doctor_id' && `doctor_approved`=0";
					$sql = mysql_query($qry) or die(mysql_error());
					if(mysql_num_rows($sql)>0)
					{
						while($row = mysql_fetch_array($sql)){
				?>
				<div class="attorney_row_content">
					<div class="attorney_client_1"><?php echo $formid = $row['form_id']?></div>
					<div class="attorney_client_2"><?php echo $getfunction->GetInfoPlantiffInformation("plantiff_name",$formid);?></div>
					<div class="attorney_client_3"><?php echo $getfunction->GetInfoPlantiffInformation("p_mob_no",$formid);?></div>
					<div class="attorney_client_4"><?php echo $getfunction->GetInfoPlantiffInformation("p_email_address",$formid);?></div>
					<div class="attorney_client_4"><?php echo $getfunction->GetInfoPlantiffInformation("p_d_o_b",$formid);?></div>
					<?php //$date = date('d-M-Y', strtotime($row['date_time'])); ?>
					<div class="attorney_client_5"><?php echo date('m-d-Y',strtotime($row['date_time']));?></div>
					<div class="attorney_client_6">
						<ul>
							<li><a href="schedule-messages.php?fid=<?=$row['form_id']?>&uid=<?=$row['user_id']?>&id=<?php echo $formid = $row['id']?>" class="messages" title="Message">Email Admin</a></li><br/>
							<li><a href="check-status.php?fid=<?=$row['form_id']?>&uid=<?=$row['user_id']?>" class="messages" title="Message">View Application</a></li>
						</ul>
					</div>
				</div>
				<?php
					}
					}
					else
					{
						echo "<h1 style='text-align:center;'>There is no Schedulling From Mayo.</h1>";
					}
				?>
			</div>
		</div>
	</div>
</section>
<?php
require($get_footer);
}
else
{	
header('Location:../../login.php');
}
?>
