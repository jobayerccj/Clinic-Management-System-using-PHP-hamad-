<?php
class Subusers extends Allfunctions
{
	function registerSubuser($profId,$username)
	{
?>
	<h1>New Staff Registration</h1>
	<?php
			if(isset($_POST['addsubworker']))
			{
				$first_name    = mysql_real_escape_string($_POST['first_name']);
				$last_name	   = mysql_real_escape_string($_POST['last_name']);
				$user_name	   = mysql_real_escape_string($_POST['user_name']);
				$password	   = mysql_real_escape_string($_POST['password']);
				$encpassword   = md5($password);
				$email_address = mysql_real_escape_string($_POST['email_address']);
				$phone_no	   = mysql_real_escape_string($_POST['phone_no']);
				$address	   = mysql_real_escape_string($_POST['address']);
				$city		   = mysql_real_escape_string($_POST['city']);
				$state		   = mysql_real_escape_string($_POST['state']);
				$zip_code	   = mysql_real_escape_string($_POST['zip_code']);
				$subgroup	   = mysql_real_escape_string($_POST['subgroup']);
				$organisation  = mysql_real_escape_string($_POST['organisation']);
				$all_emails	   = mysql_real_escape_string($_POST['all_emails']);
				
				$designationid = mysql_real_escape_string($_POST['subgroup']);
				
				$id            = $this->GetObjectByUsername("id",$username);
				$nameofatt     = $this->GetObjectByUsername("first_name",$username);
				$lastnameofatt = $this->GetObjectByUsername("last_name",$username);
				$att_id        = $this->GetObjectByUsername("email_id",$username);
				
				$date          = date('m/d/Y h:i:s a', time());
				
				$to            = $email_address;
				$subject       = "Hi ".ucwords($first_name)." ".ucwords($last_name).". Your Account has been created by ".ucwords($nameofatt)." ".ucwords($lastnameofatt)." on ".$date."";
				$message       = "Your Login Information. Please keep it safe";
				$extravalues   = array("Name"=> $first_name , "Username"=> $user_name ,"Password" => $password);
				
				$subjectattor  = "Hi ".ucwords($nameofatt)." ".ucwords($lastnameofatt).". This Account ".ucwords($first_name)." ".ucwords($last_name)." has been created from your account on ".$date."";
				$messageatt    = "Your Sub Worker Login Information";
				$this->SendEmail($to,$subject,$message,$extravalues);
				$this->SendEmail($att_id,$subjectattor,$messageatt,$extravalues);
				$checkusername = mysql_query("SELECT `id` FROM `members` where `user_name`='$user_name' || `email_id`='$email_address'") or die(mysql_error());
				if(mysql_num_rows($checkusername)>=1)
				{
					echo "<div class='thank_message'>Username/Email Already Exists.</div>";
				}
				else
				{
					$insert     = mysql_query("INSERT INTO `members` (`user_name`,`password`,`first_name`,`last_name`,`state`,`city`,`address`,`zip_code`,`contact_number`,`designation`,`sub_designation`,`organisation`,`email_id`,`email_permissions`,`user_type`,`user_ip`,`date_time`)	VALUES ('$user_name','$encpassword','$first_name','$last_name','$state','$city','$address','$zip_code','$phone_no','$designationid','$subgroup','$organisation','$email_address','$all_emails','2','".$_SERVER['REMOTE_ADDR']."',now())") or die(mysql_error());
					
					$sub_worker_id = $this->GetObjectByUsername("id",$user_name);
					
					$insert2    = mysql_query("INSERT INTO `sub_members` (`user_id`,`main_user_id`) VALUES ('$sub_worker_id','$id')") or die(mysql_error());
					
					if($insert2)
					{
						echo  "<div class='thank_message'>Thank you for Registering with Mayo Surgical, your information has been sent for approval and you will receive an email when your account is active.</div>";
					}
				
				}
			}

		?>
				<div class="attorney_row">
					<form name="register-sub-group" id="sub_registration" method="post" action="">
					<div class="attorney_row_form">
						<label>First Name</label>
						<input type="text" name="first_name" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Last Name</label>
						<input type="text" name="last_name" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Choose Username</label>
						<input type="text" name="user_name" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Password</label>
						<input type="password" name="password" id="uppassword"/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Confirm Password</label>
						<input type="password" name="choose_password" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Email Address</label>
						<input type="text" name="email_address" id=""/>
						<span class="error"></span>
					</div>		
					<div class="attorney_row_form">
						<label>Phone No.</label>
						<input type="text" name="phone_no" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Address</label>
						<input type="text" name="address" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>City</label>
						<input type="text" name="city" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>State</label>
						<?php $this->GetStates(); ?>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Zip Code</label>
						<input type="text" name="zip_code" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Organisation</label>
						<input type="text" name="organisation" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Sub Group</label>
						<?php $designationid = $this->GetObjectById($profId,"designation");
							$this->Subgroup($designationid);  ?>
						<span class="error"></span>
					</div>	
					<div class="attorney_row_form">
					<div class="form_input">
						<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="1" checked /></div>
						<div class="chk_txt"><label>Receive All Emails</label></div>
					</div>
					<div class="form_input">
						<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="2"/></div>
						<div class="chk_txt"><label>Receive Scheduling Emails</label></div>
					</div>
					<div class="form_input">
						<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="3"/></div>
						<div class="chk_txt"><label>Receive Billing Emails</label></div>
					</div>
					</div>
					<div class="attorney_row_form">
						<input type="submit" name="addsubworker" id=""/>
					</div>
					</form>					
				</div>	
<?php
	}
	
	function clientLists($designationid)
	{
?>
	<section class="row">
	<div class="container">
		<div class="search_bottom">
		 <div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div> 	<h1>Staff List</h1>
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
					$qry = "select a.*,b.* from members as a, sub_members as b where a.sub_designation!=0 and b.user_id=a.id and b.main_user_id='$designationid'";
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
					<?php $date = date('m-d-Y', strtotime($row['date_time'])); ?>
					<div class="attorney_client_5"><?=$date?></div>
					<div class="attorney_client_6">
						<ul>
							<li><a href="?action=update&id=<?=$row['id']?>" class="attorney_upload" title="Update">Update</a></li>
							<li><a href="?action=delete&id=<?=$row['id']?>" class="attorney_delete" title="Delete">Delete</a></li>
							<!--<li><a href="?action=assign&id=<?php //$row['id'];?>" class="attorney_assign" title="Assign Work">Assign Work</a></li>-->
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
	
	function UpdateStaff()
	{
?>
<div style="margin:0px auto; width:75%;">
	<form style="margin:auto;width:75%;" name="register-sub-group" method="post" action="">
		<input type="hidden" name="id" value="<?=$rows['id']?>" />
		<div class="attorney_row_form"> 
			<div class="back_btn_area">
				<a href="client-list.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
			</div> 			
			<h1>Update Staff</h1> 
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
				<?php $getpanel->getstats($rows['state']); ?>
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
				$subDes = $rows['sub_designation'];
			?>
			<select name="sub_designation">
			<?php
				$sql = mysql_query("SELECT * FROM `sub_designation` where `designation_id`=6") or die(mysql_error());
				while($row = mysql_fetch_object($sql))
				{
			?>
				<option value="<?=$row->designation_id?>"<?php if($subDes == $row->id){echo "selected='selected'";} ?>><?=$row->sub_designation_name?></option>
			<?php
				}
			?>
			</select>
		</div>	
		<span class="form_input">
			<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="1" checked /></div>
			<div class="chk_txt"><label>Receive All Emails</label></div>
		</span>
		<span class="form_input">
			<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="2"/></div>
			<div class="chk_txt"><label>Receive Scheduling Emails</label></div>
		</span>
		<span class="form_input">
			<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="3"/></div>
			<div class="chk_txt"><label>Receive Billing Emails</label></div>
		</span>
		<div class="attorney_row_form">
			<input type="submit" name="update" value="Update" />
		</div>
	</form>	
</div>
<?php
	}
}
$subusers = new Subusers();
?>