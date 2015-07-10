<?php 
session_start();
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
?>
<div class="page">
	<section class="row">
	<div class="container">
		<div class="about_bg">
			<?php 
				
				/* -------------------------------- update profile ------------------ */
				
				if(isset($_POST['updprofile'])){
					$user = $_SESSION['username'];
					$fn = $_POST['first_name'];
					$ln = $_POST['last_name'];
					$st = $_POST['state'];
					$cty = $_POST['city'];
					$add = $_POST['address'];
					$zip = $_POST['zip_code'];
					$cn = $_POST['contact_number'];
					$em = $_POST['email_id'];
					$org = $_POST['organisation'];
					
					$update = "UPDATE members SET first_name = '".$fn."', last_name = '".$ln."', state = '".$st."', city = '".$cty."', address = '".$add."', zip_code = '".$zip."', 
					contact_number = '".$cn."', email_id = '".$em."', organisation = '".$org."' WHERE user_name = '".$user."' ";
					$sqlupdate = mysql_query($update) or die(mysql_error());
					if(mysql_affected_rows()){
						echo "Profile is updated !";
					}else{
						echo "Query was not write";
					}
				}
				
				/* -------------------------------- profile display ------------------ */
				if(isset($_SESSION['username'])){
					$user = $_SESSION['username'];
					$query = "select * from members WHERE user_name = '".$user."'";
					$sql = mysql_query($query) or die("Something Wrong !".mysql_error());
					$profile = mysql_fetch_object($sql);
			?>
			
			

			<?php
			}
			/* -------------------------------- Find profile ------------------ */
				if(isset($_REQUEST['action'])){
					if(isset($_REQUEST['id']))
					$prof_id = $_REQUEST['id'];
					$queryforprofile = "select * from members WHERE user_name = '".$user."'";;
					$sqlqry = mysql_query($queryforprofile) or die("Something Wrong !".mysql_error());
					$data = mysql_fetch_object($sqlqry);
			?>
			<form name="updateprofile" action="?profile.php" method="post">
				<input type="hidden" name="id" value="<?=$data->id?>" />
			<div class="profile_row">
				<h2>Profile Information</h2>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>First Name</label>
					<input type="text" name="first_name" value="<?=$data->first_name?>" /><br />
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>Last Name</label>
					<input type="text" name="last_name" value="<?=$data->last_name?>" />
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>state </label>
					<input type="text" name="state" value="<?=$data->state?>" />
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>City</label>
					<input type="text" name="city" value="<?=$data->city?>" />
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>Address</label>
					<input type="text" name="address" value="<?=$data->address?>" />
				</div>
			</div>
			
			<div class="profile_row">
				<div class="profile_left">
					<label>Zip Code</label>
					<input type="text" name="zip_code" value="<?=$data->zip_code?>" />
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>Contact Number</label>
					<input type="text" name="contact_number" value="<?=$data->contact_number?>" />
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>Email Id </label>
					<input type="text" name="email_id" value="<?=$data->email_id?>" />
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>Organisation </label>
					<input type="text" name="organisation" value="<?=$data->organisation?>" />
				</div>
			</div>
			<div class="profile_row">
				<input type="submit" name="updprofile" value="Update" />
			</div>
		</form>
	
			<?php
				}
				else
				{
					?><div class="container profile_application">
		<form name="updateprofile" action="?profile.php" method="post">
				<input type="hidden" name="id" value="<?=$data->id?>" />
			<div class="profile_row">
				<h2>Profile Information</h2>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>First Name</label>
					<label><p><?=$profile->first_name?></p></label>
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>Last Name</label>
					<label><p><?=$profile->last_name?></p></label>
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>State</label>
					<label><p><?=$profile->state?></p></label>
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>City</label>
					<label><p><?=$profile->city?></p></label>
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>Address</label>
					<label><p><?=$profile->address?></p></label>
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>Zip Code</label>
					<label><p><?=$profile->zip_code?></p></label>
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>Contact Number</label>
					<label><p><?=$profile->contact_number?></p></label>
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>Email Id </label>
					<label><p><?=$profile->email_id?></p></label>
				</div>
			</div>
			<div class="profile_row">
				<div class="profile_left">
					<label>Organisation </label>
					<label><p><?=$profile->organisation?></p></label>
				</div>
			</div>
			<div class="profile_row">
				<a class="button" href="?action=update">Edit Profile</a>
			</div>
		</form>
					
					<?php
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
