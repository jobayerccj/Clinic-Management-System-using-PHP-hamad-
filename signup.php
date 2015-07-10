<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php"; 
include($path);
include($config);
require_once('classes/register.php');
require($get_header);
?>
 <!-- For validations -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://<?php echo $jqueryminjs; ?>"></script>

<script src="https://<?php echo $validateminjs; ?>"></script>
<script type="text/javascript">
function mask(e,f){
 var len = f.value.length;
 var key = whichKey(e);
  if((key>47 && key<58) || (key>95 && key<106))
 {
  if( len==0 )f.value=f.value+'('
  else if( len==4 )f.value=f.value+') '
  else if(len==9 )f.value=f.value+'-'
  else f.value=f.value;
 }
}
function whichKey(e) 
{
	 var code;
	 if (!e) var e = window.event;
	 if (e.keyCode) code = e.keyCode;
	 else if (e.which) code = e.which;
	 return code
	// return String.fromCharCode(code);
	}
</script>
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
			address:{required:true},
			state:{required:true},
			city:{required:true},
			zip_code:{required:true},
			contact_number:{required:true},
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
				required:true
				},
			organisation:{
				required:true
				},
			uemail:{
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
            confirm_password:"Password doesn't Match",
            organisation:"Field is required",
            uemail: "Please enter a valid email address",
            username: "Please enter a valid username",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                noSpace: "Spaces are not allowed in Password"
            },
            check:"Required"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
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
<!-- Jquery validation code ends -->
<section class="row">
<div class="container">
<div class="form_section_content">
	<?php
	$registration = new Register();
	
	if(isset($_POST['register']))
	{	
		$seprator = "|";
		
		$message = "User Added";
		
		@$check = $_POST['check'];
		
		if($check=="")
		{
			$check_message  = "Please Check the Terms & Conditions";
		}
		
		$uname              = mysql_real_escape_string($_POST['uname']);
		
		$password           = mysql_real_escape_string($_POST['upassword']);
		
		$mdpass             = md5($password);
		
		$fname              = mysql_real_escape_string($_POST['fname']);
		
		$lname              = mysql_real_escape_string($_POST['lname']);
		
		$address            = mysql_real_escape_string($_POST['address']);
		
		$state              = mysql_real_escape_string($_POST['state']);
		
		$city               = mysql_real_escape_string($_POST['city']);
		
		$contact_no         = mysql_real_escape_string($_POST['contact_number']);
		
		$designation        = mysql_real_escape_string($_POST['designation']);
		
		$organisation       = mysql_real_escape_string($_POST['organisation']);
		
		$uemail             = mysql_real_escape_string($_POST['uemail']);
		
		$zip_code           = $_POST['zip_code'];
		
		$user_ip            = $_SERVER['REMOTE_ADDR'];
		
		$user_type          = "1";
		
		$finalreg           = $registration->UserRegister($uname,$mdpass,$fname,$lname,$state,$city,$address,$contact_no,$designation,$zip_code,$organisation,$uemail,$user_type,$user_ip);
		
		if($finalreg==1)
		{
			echo "<div class='thank_messages'>Thank you for Registering with Mayo Surgical, your information has been sent for approval 
			and you will receive an email when your account is active.</div>";
			
			
		}
		else
		{
			echo "<div class='thank_messages'>Username / Email-ID Already Exists.</div>";
			
		}

	}
?>
<?php 
	if(!loggedin()) 
		{
?>
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
				<label>Address</label>
			</span>
			<span class="form_input">
				<input type="text" name="address" placeholder="Address">
				<span class="error"></span>
			</span>
	   </li>
	    <li>
		   <span class="form_label">
				<label>City</label>
			</span>
			<span class="form_input">
				<input type="text" name="city" placeholder="City">
				<span class="error"></span>
			</span>
	   </li>
	    <li>
		   <span class="form_label">
				<label>State</label>
			</span>
			<span class="form_input">
				<select name="state">
					<option value="">...Select...</option>
					<?php
						$tempstate = mysql_query("SELECT * FROM `states`") or die(mysql_error());
						while($getstate = mysql_fetch_object($tempstate))
						{
					?>
						<option value="<?php echo $getstate->state_code; ?>"><?php echo $getstate->state; ?></option>
					<?php
						}
					?>
				</select>
				<span class="error"></span>
			</span>
	   </li>
	   <li>
		   <span class="form_label">
				<label>Zip Code</label>
			</span>
			<span class="form_input">
				<input type="text" name="zip_code" placeholder="Zip Code">
				<span class="error"></span>
			</span>
	   </li>
	   <li>
		   <span class="form_label">
				<label>Contact Number</label>
			</span>
			<span class="form_input">
				<input type="text" name="contact_number" maxlength="14" onkeyup="mask(event,this);"   onkeydown="mask(event,this);" placeholder="Contact Number">
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
					<?php
						$desig_temp = mysql_query("SELECT * FROM `designation` where id!=5 and id!=8 order by id ") or die(mysql_error());
						while($designat = mysql_fetch_array($desig_temp))
						{
					 ?>
						<option value="<?php echo $designat['id']; ?>"><?php echo $designat['designation']; ?></option>
					<?php 
						} 
					?>
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
				<label>Organization</label>
			</span>
			<span class="form_input">
				<input type="text" name="organisation" placeholder="Organization">
				<span class="error"></span>
			</span>
		</li>
        <li>
		<span class="form_label">
			<div class="chk_bx_area">&nbsp;</div>
		</span>
		<span class="form_input">
			<div class="chk_btn"><input name="check" id="terms" type="checkbox" value="check" required /></div>
           <div class="chk_txt"><label>I agree to MayoSurgical.com Terms &amp; Policies</label></div>
        <span class="error_checkbox"></span>
        </span>
		</li>

		<li>	
			<input type="submit" id="signUp" name="register" value="Register">
		</li>
		</ul>
	
</form>
<?php
}
else
{
	echo "<h1 class='add_user'>You are Already Logged-In.</h1>";
}
?>

</div>
	</div>
</section>
<?php
require($get_footer);
?>
