<?php
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php"; 
include($path);
include($config);
require_once('classes/register.php');
include('header.php');
?>
 <!-- For validations -->
 
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>

<!-- validation end --> 

<!-- jQuery Form Validation code -->
<script>
$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
    $("#regform").validate({
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
				required:true
				},
			check:{
				required:true
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
            },
            check:"Please Check Terms and Conditions"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<!-- Jquery validation code ends -->
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<h1 class="add_user">MayoSurgical New Client Registration</h1>
<form name="userinfo" method="post" action="" id="regform">
	<ul>
		
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
				<label>Email-ID</label>
			</span>
			<span class="form_input">
				<input type="email" name="uemail" placeholder="Email-ID">
				<span class="error"></span>
			</span>
		</li>
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
				<label>Designation</label>
			</span>
			<span class="form_input">
				<select name="designation" class="sel_reg_form">
				<option value="">...Select...</option>
				<option value="">...Select...</option>
					<option value="Anesthesiologist">Anesthesiologist</option>
					<option value="Attorney">Attorney</option>
					<option value="Doctor">Doctor</option>
					<option value="Medical Facility">Medical Facility</option>
					<option value="Plaintiff (Injured Party)">Plaintiff (Injured Party)</option>
				</select>
				<span class="error"></span>
			</span>
	   </li>
       <!--<li>
		    <span class="form_label">
				<label>Employee No</label>	
			</span>
			<span class="form_input">
				<input type="text" name="empno" placeholder="Employee No">
				<span class="error"></span>
			</span>
		</li>-->
		
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
			
			</span>
			<span class="form_input">	<div class="chk_bx_area"><input name="check" type="checkbox" value="" /></div>
            <strong style="font: 15px open_sansregular;">I agree to MayoSurgical.com Terms &amp; Policies</strong><span class="error"></span> </span>
		</li>

		<li>	
			<input type="submit" name="register" value="Register">
		</li>
		</ul>
	
</form>
<?php
	$registration = new Register();
	
	if(isset($_POST['register']))
	{
		
		$seprator = "|";
		
		$message = "User Added";
		
		$uname = mysql_real_escape_string($_POST['uname']);
		
		$password = mysql_real_escape_string($_POST['upassword']);
		
		$mdpass = md5($password);
		
		$fname = mysql_real_escape_string($_POST['fname']);
		
		$lname = mysql_real_escape_string($_POST['lname']);
		
		$designation = mysql_real_escape_string($_POST['designation']);
		
		$organisation = mysql_real_escape_string($_POST['organisation']);
		
		$uemail = mysql_real_escape_string($_POST['uemail']);
		
		$user_ip = $_SERVER['REMOTE_ADDR'];
		
		function getRandomString($length) 
		{
			$validCharacters = "1080nordiff00123456vikas09084abcdefghijklmnopqrstuvwxyz";
			
			$validCharNumber = strlen($validCharacters);
			
			$result = "";

			for ($i = 0; $i < $length; $i++) 
			{
				$index = mt_rand(0, $validCharNumber - 1);
				
				$result .= $validCharacters[$index];
			}
			
			return $result;
		}
		$activation_code=getRandomString(50);
		
		$finalreg = $registration->UserRegister($uname,$mdpass,$fname,$lname,$designation,$organisation,$uemail,$user_ip,$activation_code);

	}
?>
</div>
	</div>
</section>
<?php
require($get_footer);
?>
