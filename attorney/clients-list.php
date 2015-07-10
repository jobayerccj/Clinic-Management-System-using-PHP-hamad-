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

$a_username    = $_SESSION['username'];
		
$temp_profile   = new Allfunctions();
$designationid = $temp_profile->GetObjectByUsername("id",$a_username);
?>

<?php
if(isset($_REQUEST['record'])){
	switch($_REQUEST['record']){
		case 'updated' :		
		$msg = "Reocrd Updated Successfully";
?>
		<div class="container">
			<div class="search_bottom">
				<p><?=$msg?></p>
				<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
     <h1>Staff List</h1>
				<div class="attorney_row">
					<div class="attorney_row_heading">
						<div class="attorney_client_1">SR No.</div>
						<div class="attorney_client_1">Staff No.</div>
						<div class="attorney_client_2">staff Name</div>
						<div class="attorney_client_3">Contact No.</div>
						<div class="attorney_client_4">Email-Address</div>
						<div class="attorney_client_4">Position</div>
						<div class="attorney_client_5">Date</div>
						<div class="attorney_client_6">Action</div>
					</div>
					<?php
						$qry = " SELECT a . * , b . * , c . * FROM members AS a, sub_members AS b, states AS c WHERE a.id = b.user_id && a.state = c.state_code && a.id='$designationid'";
						$sql = mysql_query($qry) or die(mysql_error());
						$i = 0;
						while($row = mysql_fetch_array($sql)){
						$i++;
					?>
					<div class="attorney_row_content">
						<div class="attorney_client_1"><?=$i?></div>
						<div class="attorney_client_1"><?=$row['id']?></div>
						<div class="attorney_client_2"><?=$row['first_name']?></div>
						<div class="attorney_client_3"><?=$row['contact_number']?></div>
						<div class="attorney_client_4"><?=$row['email_id']?></div>
						<div class="attorney_client_4"><?=$row['sub_designation']?></div>
						<?php $date = date('d-M-Y', strtotime($row['date_time'])); ?>
						<div class="attorney_client_5"><?=$date?></div>
						<div class="attorney_client_6">
							<a href="?action=update&id=<?=$row['id']?>">Update</a>&nbsp; / &nbsp;<a href="?action=delete&id=<?=$row['id']?>">Delete</a>&nbsp; / &nbsp;<a href="?action=assign&id=<?=$row['id']?>">Assign Work</a>
						</div>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
<?php
		break;
		
		case 'deleted' :
			$msg = "Successfully Deleted";
		break;
	}
}
if(isset($_REQUEST['action'])){
	$action = $_REQUEST['action'];
	switch($action){
		case 'update' :
		if(isset($_REQUEST['id'])) $id = $_REQUEST['id'];
		$qryupd = " SELECT * FROM members WHERE id = '$id'";
		$sqlupd = mysql_query($qryupd) or die(mysql_error());
		$rows = mysql_fetch_array($sqlupd);
?>

<div style="margin:0px auto; width:75%;">
	<form style="margin:auto;width:75%;" name="register-sub-group" method="post" action="">
		<input type="hidden" name="id" value="<?=$rows['id']?>" />
		<div class="attorney_row_form">
			<div class="back_btn_area">
		<a href="clients-list.php">
			<input name="" type="button" class="back_btn" value="<<Back"/></a> 
			
</div>
			<h2>Update Information</h2>
    
			<label>First Name</label>
			<input type="text" name="first_name" value="<?=$rows['first_name']?>" id=""/>
		</div>
			<div class="attorney_row_form">
			<label>Last Name</label>
			<input type="text" name="last_name" value="<?=$rows['last_name']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>Email Address</label>
			<input type="text" name="email_id" value="<?=$rows['email_id']?>" id="" readonly />
		</div>		
		<div class="attorney_row_form">
			<label>Phone No.</label>
			<input type="text" name="contact_number" value="<?=$rows['contact_number']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>Address</label>
			<input type="text" name="address" value="<?=$rows['address']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>City</label>
			<input type="text" name="city" value="<?=$rows['city']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>State</label>			
				<select name="state">
				<?php
					$userState = $rows['state']; 
					$sqlstat= mysql_query("SELECT * FROM `states`") or die(mysql_error());
					while($stast = mysql_fetch_object($sqlstat))
					{
				?>
					<option value="<?php echo $stast->state_code; ?>" <?php if($userState == $stast->state_code) {echo "Selected";} ?>><?php echo $stast->state; ?></option>
				<?php
					}
				?>
				</select>
			
		</div>
		<div class="attorney_row_form">
			<label>Zip Code</label>
			<input type="text" name="zip_code" value="<?=$rows['zip_code']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>Organisation</label>
			<input type="text" name="organisation" value="<?=$rows['organisation']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>Sub Group</label>
				<?php 
					$designation = $rows['designation'];
					$subdesignation = $rows['sub_designation'];
					//$myobj->getdesignation($rows['sub_designation']); 
				?>
			<select name="sub_designation">
				<?php
					$sql = mysql_query("SELECT * FROM `sub_designation` where designation_id=7") or die(mysql_error());
					while($subdesg = mysql_fetch_object($sql))
					{
				?>
					<option value="<?=$subdesg->designation_id?>"<?php if($designation==$subdesg->designation_id){echo "Selected";} ?>><?=$subdesg->sub_designation_name?></option>
				<?php
					}
				?>
			</select>
		</div>	
		<span class="form_input">
			<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="1" <?php if($rows['email_permissions']=='1'){echo "Checked";} ?>/></div>
			<div class="chk_txt"><label>Receive All Emails</label></div>
		</span>
		<span class="form_input">
			<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="2" <?php if($rows['email_permissions']=='2'){echo "checked=\"Checked\"";} ?>"/></div>
			<div class="chk_txt"><label>Receive Scheduling Emails</label></div>
		</span>
		<span class="form_input">
			<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="3" <?php if($rows['email_permissions']==	'3'){echo "checked=\"Checked\"";} ?>"/></div>
			<div class="chk_txt"><label>Receive Billing Emails</label></div>
		</span>
		<div class="attorney_row_form">
			<input type="submit" name="update" value="Update" />
		</div>
	</form>	
</div>
<?php
	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$contact_number = $_POST['contact_number'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip_code = $_POST['zip_code'];
		$organisation = $_POST['organisation'];
		$sub_designation = $_POST['sub_designation'];
		$prmissions = $_POST['all_emails'];
		$updaterecords = " UPDATE members SET first_name = '".$first_name."', last_name = '".$last_name."', 
		contact_number = '".$contact_number."', address = '".$address."', city = '".$city."', state = '".$state."',
		zip_code = '".$zip_code."', organisation = '".$organisation."',email_permissions = '".$prmissions."',sub_designation = '".$sub_designation."' WHERE id='".$id."' ";
		$sqlupdatercrd = mysql_query($updaterecords) or die(mysql_error());
		if(mysql_affected_rows()){
			header("location:clients-list.php");
		}
	}
		break;

		case 'delete' :
			if(isset($_REQUEST['id'])) $id = $_REQUEST['id'];
			$qryupd = " DELETE * FROM members WHERE id = '$id'";
			$sqlupd = mysql_query($qryupd) or die(mysql_error());
			if(mysql_affected_rows()){
			header("location:?record=deleted");
		}
		break;
		
		case 'assign' :
		
						/* Assign Work to user */
						
						if(isset($_POST['assigncase'])){
							$form_id = $_POST['form_id'];
							$professional_id = $_POST['professional_id'];
							$coworker_id = $_POST['coworker_id'];
							$message = $_POST['message'];
							$qry = "INSERT INTO `hire_staff_coworkers` (form_id, professional_id, coworker_id, message, date_assign) VALUES('".$form_id."', '".$main_user_id."', '".$user_id."', '".$message."', now())"; 
							$result = mysql_query($qry) or die(mysql_error());
							if(mysql_affected_rows() == 1){
								echo "Success";
							}else{
								echo "Database Error";
							}
						}
						
						?>
				<form name="" action="" method="post">
					<div style="margin:0px auto; width:75%;">
						<a href="clients-list.php">
						<input name="" type="button" class="back_btn" value="<<Back"/></a> <br />
						<div style="background:#eeeeee;margin:10px auto 10px auto;width:65%;clear:both;overflow:hidden;padding:20px;">
						<label>
							Cases : 
						</label>
						<p style="padding:5px;"></p>
							<?php
							$dataarr = $temp_profile->GetCasesByProfessId($attorneys_id);
							for($i = 0; $i<count($dataarr);$i++){
							?>
							<p style="padding:10px;"></p>	<input type="radio" name="form_id" value="<?=$dataarr[$i]['form_id']?>" />
							<?php
								$pFid = $dataarr[$i]['form_id'];
								echo $temp_profile->GetInfoPlantiffInformation('plantiff_name',$pFid) . '<br />';
							}
							
							
							/* End Assign Work to user */
							
							
							?>
							<input type="hidden" name="professional_id" value="<?=$attorneys_id?>" />
							<input type="hidden" name="coworker_id" value="<?php if(isset($_REQUEST['id'])) echo $_REQUEST['id'];?>" />
							<p style="padding:10px;"></p>
							<label>
								Message : 
							</label>
							<p style="padding:10px;"></p>
							<textarea name="message" cols="55" rows="12">  </textarea>
							<p style="padding:10px;"></p>
							<input type="submit" name="assigncase" value="Assign" />
						</div>
					</div>
				</form>				
<?php								
		break;
	}
}else{
?>

<section class="row">
	<div class="container">
		<div class="search_bottom">
			<div class="back_btn_area">
			<a href="index.php">
					<input name="" type="button" class="back_btn" value="<<Back"/></a>
			</div> 
<h1>Staff List</h1>
			<div class="attorney_row">
				<div class="attorney_row_heading">
					<div class="attorney_client_1">Staff No.</div>
					<div class="attorney_client_2">Staff Name</div>
					<div class="attorney_client_3">Contact No.</div>
					<div class="attorney_client_4">Email-Address</div>
					<div class="attorney_client_4">Position</div>
					<div class="attorney_client_5">Date</div>
					<div class="attorney_client_6">Action</div>
				</div>
				<?php
					$qry = " SELECT a . * , b . * , c . * FROM members AS a, sub_members AS b, states AS c WHERE a.id = b.user_id && a.state = c.state_code && main_user_id='$attorneys_id'";
					$sql = mysql_query($qry) or die(mysql_error());
					$i = 0;
					while($row = mysql_fetch_array($sql)){
					$i++;
				?>
				<div class="attorney_row_content">
					<div class="attorney_client_1"><?=$row['id']?></div>
					<div class="attorney_client_2"><?=$row['first_name']?></div>
					<div class="attorney_client_3"><?=$row['contact_number']?></div>
					<div class="attorney_client_4"><?=$row['email_id']?></div>
					<div class="attorney_client_4"><?=$row['sub_designation']?></div>
						<?php 
							$date = date('m-d-Y', strtotime($row['date_time'])); 
						?>
					<div class="attorney_client_5"><?=$date?></div>
					<div class="attorney_client_6">
						<ul>
							<li><a href="?action=update&id=<?=$row['id']?>" class="attorney_upload" title="Update">Update</a></li>
							<li><a href="?action=delete&id=<?=$row['id']?>" class="attorney_delete" title="Delete">Delete</a></li>
							<li><a href="?action=assign&id=<?=$row['id']?>" class="attorney_assign" title="Assign Work">Assign Work</a></li>
						</ul>
					</div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</section>
<?php
}
require($get_footer);
}
else
{	
header('Location:../../login.php');
}
?>
