<?php
ob_start();
require_once('../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";

require_once($path);
include($config);
include '../functions.php';
$classfile = $_SERVER['DOCUMENT_ROOT']."/classes/functions.php";
include($classfile);
include('header.php');
if(loggedin())
{
	$desg  = new Allfunctions();
	
	if(isset($_POST['updates']) && isset($_REQUEST['data'])){
	
	
	$id = $_REQUEST['data'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$state = $_POST['state'];
	$city = $_POST['city'];
	$address = $_POST['address'];
	$zip_code = $_POST['zip_code'];

	$contact_number = $_POST['contact_number'];
	
	

		$upqry = "UPDATE `members` SET first_name = '".$first_name."', last_name = '".$last_name."', state = '".$state."', city = '".$city."',
		address = '".$address."', zip_code = '".$zip_code."', contact_number = '".$contact_number."' WHERE id = $id ";
		$uqry = mysql_query($upqry) or die(mysql_error());
		
		if(mysql_affected_rows() == 1){
			$msg = "<div class='thank_message'>Profile Updated Successfully.</div>";
		}else{
			$msg = "Mysql Error! Please check query again.";
		}
	
}
if(isset($_POST['updateemail']) && isset($_REQUEST['data']))
{
	$emailId = $_POST['email_id'];
	$checkEmail = mysql_query("select * from `members` where email_id='$emailId'") or die(mysql_error());
	if(mysql_num_rows($checkEmail)>0)
	{
		echo "Error. Email ID already in Use. Please Choose other Email.";
	}
	else
	{
		$upqry = "UPDATE `members` SET email_id='$emailId' WHERE id = '$_REQUEST[data]' ";
		$update = mysql_query($upqry) or die(mysql_error());
		$designationss = $desg->GetObjectById($_REQUEST['data'],"designation");
		if($designationss==2 || $designationss==7)
		{
			$upPlantiffinformation = mysql_query("UPDATE `plantiff_information` set `p_email_address`='$emailId' WHERE `id`= '$_REQUEST[data]' ") or die(mysql_error());
			$upPlantiCaseType      = mysql_query("UPDATE `plantiff_case_type_info` set `att_email`='$emailId' WHERE `attorney_id`= '$_REQUEST[data]'") or die(mysql_error());
			echo "<div class='thank_message'>Email Id Updated Successfully</div>";
		}
	}
}
if(isset($_POST['delete']) && isset($_REQUEST['data'])){
	$id = $_REQUEST['data'];
	$dltqry = "DELETE FROM `members` WHERE `members`.`id` = $id ";
	$dlry = mysql_query($dltqry) or die(mysql_error());
	if(mysql_affected_rows() == 1){
		$msg = "<div class='thank_message'>Account Delted Successfully.</div>";
	}else{
		$msg = "Mysql Error! Please check query again.";
	}
}
?>
<script>
	$(function() 
	{
		setTimeout(function() 
		{ 
			$(".thank_messages").fadeOut(5000); }, 5000)
			$('#signUp').click(function() {
			setTimeout(function() { $(".thank_messages").fadeOut(5000); }, 5000)
		})
	})
</script>
<section class="row">
	<div class="container">
		<div class="form_section_content">
		<?php 
		if(isset($_REQUEST['data'])){
			$updateqry = "select * from `members` where id = '".$_REQUEST['data']."'";
			$sqlqry = mysql_query($updateqry) or die(mysql_error());
			$row = mysql_fetch_array($sqlqry);
			// print_R($row);
		?>
		<?php if(isset($msg)){ ?><div class="thank_messages"><?php echo $msg; ?></div><?php }?>
		<h1 class="add_user">Update Professionals</h1>
		<div class="update-profile-admin">
			<form name="formUpdate" action="" method="post"> 
				<ul>
					<li>
						<span class="form_label">
							<label>User Name</label>
						</span>
						<span class="form_input">
							<input type="text" name="user_name" value="<?=$row['user_name']?>" readonly />
						</span>
					</li>
					<li>
						<span class="form_label">
							<label>First Name</label>
						</span>
						<span class="form_input">
							<input type="text" name="first_name" value="<?=$row['first_name']?>" required/>
						</span>
					</li>
					<li>
						<span class="form_label">
							<label>Last Name</label>
						</span>
						<span class="form_input">
							<input type="text" name="last_name" value="<?=$row['last_name']?>" required/>
						</span>
					</li>
					
					<li>
						<span class="form_label">
							<label>State</label>
						</span>
						<span class="form_input">
							<select name="state">
							<?php
								$qry = "SELECT * FROM `states`";
								$sql = mysql_query($qry) or die(mysql_error());
								while($result = mysql_fetch_object($sql)){
								?>
									<option value="<?=$result->state_code?>" <?php if($row['state'] == $result->state_code) { echo "selected='selected'";}?>><?=$result->state?></option>
								<?php
								}
							?>
							</select>
						</span>
					</li>
					<li>
						<span class="form_label">
							<label>City</label>
						</span>
						<span class="form_input">
							<input type="text" name="city" value="<?=$row['city']?>" required/>
						</span>
					</li>
					<li>
						<span class="form_label">
							<label>Address</label>
						</span>
						<span class="form_input">
							<input type="text" name="address" value="<?=$row['address']?>" required/>
						</span>
					</li>
					<li>
						<span class="form_label">
							<label>ZipCode</label>
						</span>
						<span class="form_input">
							<input type="text" name="zip_code" value="<?=$row['zip_code']?>" required/>
						</span>
					</li>
					<li>
						<span class="form_label">
							<label>Contact Number</label>
						</span>
						<span class="form_input">
							<input type="text" name="contact_number" value="<?=$row['contact_number']?>" required/>
						</span>
					</li>
					<li>
						<span class="form_label">
							<input type="submit" name="updates" value="Update" />
						</span>
						<span class="form_input">
							<input type="submit" name="delete" value="Delete" />
						</span>
					</li>
				</ul>
			</form>
		</div>
		<div class="update-email-admin">
			<form name="updateEmail" method="post" action="">
			<ul>
					<li>
						<span class="form_label">
							<label>Email</label>
						</span>
						<span class="form_input">
							<input type="text" name="email_id" value="<?=$row['email_id']?>" required />
						</span>
					</li>
					<li><input type="submit" name="updateemail" value="Update Email"></li>
				</ul>
			</form>
		</div>
		<?php
		}
		?>
		<?php 
		}else { 
			header('Location:../login.php');
		}	 
		?>
		</div>
	</div>
</section>
<?php
require($get_footer);
?>	