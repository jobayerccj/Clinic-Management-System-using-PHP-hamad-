<?php
session_start();
?>
<div class="page">
	<section class="row">
	<div class="container">
		<div class="about_bg">
			<?php 
				include "config/mayo-config.php";
				
				/* -------------------------------- update profile ------------------ */
				
				if(isset($_POST['updprofile'])){
					
					$fn = $_POST['first_name'];
					$ln = $_POST['last_name'];
					$st = $_POST['state'];
					$cty = $_POST['city'];
					$add = $_POST['address'];
					$zip = $_POST['zip_code'];
					$cn = $_POST['contact_number'];
					$em = $_POST['email_id'];
					$desg = $_POST['designation'];
					$org = $_POST['organisation'];
					
					$update = "UPDATE members SET first_name = '".$fn."', last_name = '".$ln."', state = '".$st."', city = '".$cty."', address = '".$add."', zip_code = '".$zip."', 
					contact_number = '".$cn."', email_id = '".$em."', designation = '".$desg."', organisation = '".$org."'";
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
			<table border="0">
				<tbody>
					<tr>
						<th>User id</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>State</th>
						<th>City</th>
						<th>Address</th>
						<th>Zipcode</th>
						<th>Contact Number</th>
						<th>Email</th>
						<th>Designation</th>
						<th>Organization</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					<tr>
						<td><?=$profile->id?></td>
						<td><?=$profile->first_name?></td>
						<td><?=$profile->last_name?></td>
						<td><?=$profile->state?></td>
						<td><?=$profile->city?></td>
						<td><?=$profile->address?></td>
						<td><?=$profile->zip_code?></td>
						<td><?=$profile->contact_number?></td>
						<td><?=$profile->email_id?></td>
						<td><?=$profile->designation?></td>
						<td><?=$profile->organisation?></td>
						<td><a href="?action=update&id=<?=$profile->id?>">Edit Profile</a></td>
					</tr>
				</tbody>
			</table>
			<?php
			}
			/* -------------------------------- Find profile ------------------ */
				if(isset($_REQUEST['action'])){
					if(isset($_REQUEST['id']))
					$prof_id = $_REQUEST['id'];
					$queryforprofile = "select * from members WHERE id = '".$prof_id."'";
					$sqlqry = mysql_query($queryforprofile) or die("Something Wrong !".mysql_error());
					$data = mysql_fetch_object($sqlqry);
			?>
			<form name="updateprofile" action="?profile.php" method="post">
				<input type="hidden" name="id" value="<?=$data->id?>" />
				first name <br />
				<input type="text" name="first_name" value="<?=$data->first_name?>" /><br />
				last name <br />
				<input type="text" name="last_name" value="<?=$data->last_name?>" /><br />
				state <br />
				<input type="text" name="state" value="<?=$data->state?>" /><br />
				city <br />
				<input type="text" name="city" value="<?=$data->city?>" /><br />
				address <br />
				<input type="text" name="address" value="<?=$data->address?>" /><br />
				zipcode <br />
				<input type="text" name="zip_code" value="<?=$data->zip_code?>" /><br />
				contact_number <br />
				<input type="text" name="contact_number" value="<?=$data->contact_number?>" /><br />
				email id <br />
				<input type="text" name="email_id" value="<?=$data->email_id?>" readonly /><br />
				designation <br />
				<input type="text" name="designation" value="<?=$data->designation?>" /><br />
				organisation <br />
				<input type="text" name="organisation" value="<?=$data->organisation?>" /><br />
				<input type="submit" name="updprofile" value="Update" />
			</form>
			<?php
				}
			?>
	    </div>		
	</div>	
</div>
</section>