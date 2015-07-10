<?php
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
include($path);
include($config);
include '../functions.php';
if(loggedin())
{
include('header.php');
?>
<section class="row">
	<div class="container">
		<div class="form_section_content">
		<h1 class="add_user">User Registration</h1>
<form name="userinfo" method="post" action="" id="regform">
	<ul>
		<li>
			<span class="form_label">	
				<label>User Name</label>
			</span>
			<span class="form_input">
				<input type="text" name="uname" placeholder="Choose User Name">
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">	
				<label>Password</label>
			</span>
			<span class="form_input">
				<input type="password" name="upassword" id="uppassword" placeholder="Choose Password">
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">
				<label>Confirm Password</label>
			</span>
			<span class="form_input">
				<input type="password" name="confirm_password" placeholder="Confirm Password">
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">
				<label>First Name</label>
			</span>
			<span class="form_input">
				<input type="text" name="fname" placeholder="First Name">
				<span class="error"></span>
			</span>
		</li>
			
	   <li>
		   <span class="form_label">
				<label>Last Name</label>
			</span>
			<span class="form_input">
				<input type="text" name="lname" placeholder="Last Name">
				<span class="error"></span>
			</span>
	   </li>
	  
	   <li>
		   <span class="form_label">
				<label>Designation</label>
			</span>
			<span class="form_input">
				<select name="designation" class="sel_reg_form">
					<option value="">...Select...</option>
					<?php
						$sql = mysql_query("select * from designation") or die(mysql_error());
						while($data = mysql_fetch_object($sql))
						{
					?>
						<option value="<?php echo $data->id; ?>"><?php echo $data->designation; ?></option>
					<?php
						}
					?>
				</select>
				<span class="error"></span>
			</span>
	   </li>
		
		<li>
			<span class="form_label">
				<label>Organisation</label>
			</span>
			<span class="form_input">
				<input type="text" name="organisation" placeholder="Organisation">
				<span class="error"></span>
			</span>
		</li>
	
		<li>
			<span class="form_label">
				<label>Email-ID</label>
			</span>
			<span class="form_input">
				<input type="email" name="uemail" placeholder="Email-ID">
				<span class="error"></span>
			</span>
		</li>
		
		<li>	
		<span class="form_label">&nbsp;</span>
			<input type="submit" name="register" value="Register" required/>
		</li>
		</ul>
	
</form>
<?php }else { 
header('Location:../login.php');
 } ?>


<?php

	if(isset($_POST['register']))
	{
		$seprator = "|";
		
		$message = "User Added";
		
		$uname = $_POST['uname'];
		
		$password = $_POST['upassword'];
		
		$mdpass = md5($password);
		
		$fname = $_POST['fname'];
		
		$lname = $_POST['lname'];
		
		$designation = $_POST['designation'];
		
		$organisation = $_POST['organisation'];
		
		$uemail = $_POST['uemail'];
		
		$ip_addre = $_SERVER['REMOTE_ADDR'];
		
		$check = mysql_query("SELECT * FROM `members` where `user_name`='$uname' || `email_id`='$uemail'") or die(mysql_error());
		
		if(mysql_num_rows($check) >=1)
		{
			echo "Username/Email id is already Registered with this account";
			exit();
		}
		else
		{
		$querys = mysql_query("INSERT INTO `members` (`user_name`,`password`,`first_name`,`last_name`,`designation`,`organisation`,`email_id`,`activation_code`,`user_ip`,`date_time`)
		 VALUES ('$uname','$mdpass','$fname','$lname','$designation','$organisation','$uemail',1,'$ip_addre',now())") or die(mysql_error());
		
		echo $testing;
	
	}
	if($querys)
	{
		echo "<div class='e_messages'>You have Successfully Registered.</div>";
		
	}
	else
	{
		echo "<div class='e_messages'>Something went wrong</div>";
	}
		
	}

?>
<!-- For validations -->
<script src="https://<?php echo $jqueryminjs; ?>"></script>

<script src="https://<?php echo $validateminjs; ?>"></script>

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
    $("#regform").validate({
    
        // Specify the validation rules
        rules: {
            uname: {
				required:true,
				minlength:5,
				noSpace: true
				},
            email: {
                required: true,
                email: true
            },
            upassword: {
                required: true,
                minlength: 5,
                noSpace: true
            },
            confirm_password:{
					required:true,
					equalTo:"#uppassword"
				},
            fname:{
				required: true,
				minlength: 3,
				alpha: true
				},
			lname:{
				required:true,
				minlength: 3,
				alpha: true
				},
			designation:{
				required:true,
				},
			organisation:{
				required:true,
				},
				uemail:{
					required:true,
					}
				
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            uname: {
				required: "Please choose Username",
				noSpace: "Spaces are not allowed in Username"
			},
            fname:{
				required: "Please Enter your Name",
				alpha: "Only Characters are allowed"
			},
            lname:{
				required: "Please enter your Last Name",
				alpha: "Only Characters are allowed"
			},
            designation:"Field is required",
            confirm_password:"Password don not Match",
            organisation:"Field is required",
            uemail: "Please enter a valid email address",
            username: "Please enter a valid username",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                noSpace: "Spaces are not allowed in Password"
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script></div>
	</div>
</section>
<?php
require($get_footer);
?>
