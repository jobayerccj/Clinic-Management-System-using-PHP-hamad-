<?php
session_start();

require_once('../../includes/functions.php');

$path = $_SERVER['DOCUMENT_ROOT']."/path.php";

require_once($path);

include($config);

require_once('../../includes/functions.php');

include '../functions.php';

include 'class.php';

if(loggedin())
{
	include('header.php');
	
	$id = $_GET['id']
?>
<link rel="stylesheet" href="admin-style.css" type="text/css">
<!-- For validations -->
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>

<!-- validation end --> 

<!-- jQuery Form Validation code -->
<script>
	setTimeout(function(){ $('.messages').fadeOut('slow'); }, 5000);
$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
    $("#modify-form").validate({
    
        // Specify the validation rules
        rules: {
            email_id: {
                required: true,
                email: true
            },
           first_name:{
				required: true,
				minlength: 3,
				alpha: true
				},
			last_name:{
				required:true,
				minlength: 3,
				alpha: true
				},
			designation:{
				required:true
				},
			employee:{
				required: true,
				},
			organisation:{
				required:true,
				},
				
        },
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            first_name:{
				required: "Please Enter your Name",
				alpha: "Only Characters are allowed"
			},
            last_name:{
				required: "Please enter your Last Name",
				alpha: "Only Characters are allowed"
			},
            designation:"Field is required",
            employee: "Field is required",
            confirm_password:"Password don not Match",
            organisation:"Field is required",
            email_id: "Please enter a valid email address"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<h1 class="add_user">Modify User</h1>
			<form name="form1" method="post" action="" id="modify-form">
				<ul>
					<?php
					
						$modif = mysql_query("SELECT * FROM `members` where `id` = '$id'") or die(mysql_error());
						$row = mysql_fetch_array($modif);
					?>
					<li>
						<label>First Name</label>
						<input type="text" value="<?php echo $row['first_name'];?>" name="first_name" id="">
					</li>	
					<li>
						<label>Last Name</label>
						<input type="text" value="<?php echo $row['last_name'];?>" name="last_name" id="">
					</li>	
					<li>
						<label>Organisation</label>
						<input type="text" value="<?php echo $row['organisation'];?>" name="organisation" id="">
					</li><?php $design = $row['designation'];?>
					<li>
						<label>Designation</label>
					<select name="designation" class="sel_reg_form">
						<option value="">...Select...</option>
						<option <?php if($design =="Anesthesiologist") { ?> selected="selected"<?php } ?> value="Anesthesiologist">Anesthesiologist</option>
						<option <?php if($design =="Attorney") { ?> selected="selected"<?php } ?> value="Attorney">Attorney</option>
						<option <?php if($design =="Doctor") { ?> selected="selected"<?php } ?> value="Doctor">Doctor</option>
						<option <?php if($design =="Medical Facility") { ?> selected="selected"<?php } ?> value="Medical Facility">Medical Facility</option>
						<option <?php if($design =="Plaintiff (Injured Party)") { ?> selected="selected"<?php } ?> value="Plaintiff (Injured Party)">Plaintiff (Injured Party)</option>
					</select>
					</li>	
					<li>
						<label>Email Address</label>
						<input type="text" value="<?php echo $row['email_id'];?>" name="email_id" id="">
					</li>
					<li>
						<input type="submit" name="modify" id="" value="Submit"/>
					</li>					
				</ul>
			</form>
			<?php
			
				//$password = $_POST['password'];
				
				
			
				if(isset($_POST['modify']))
				{
					$fname = $_POST['first_name'];
				
				$lname = $_POST['last_name'];
				
				$organisation = $_POST['organisation'];
				
				$employee = $_POST['employee'];
				
				$designation = $_POST['designation'];
				
				$email_id = $_POST['email_id'];
					$sql = mysql_query("Update `members` set `first_name`='$fname',`last_name`='$lname',`designation`
					='$designation',organisation='$organisation' where `id` = '$id'") or die(mysql_error());
					if($sql)
					{
						
						echo "<div class='messages'>User Updated Successfully</div>";
						
					}
					else
					{
						
						echo "<div class='messages'>Something Wrong</div>";
						
					}
					
				}
			
			?>
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
