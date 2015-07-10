<script src="calendar.js"></script>
<link href="calendar.css" rel="stylesheet">
<?php 
ob_start();
session_start();
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
$header = $_SERVER['DOCUMENT_ROOT']."/rao/attorney/header.php";
require($header);
require_once($config);
include('../../classes/login-functions.php');
include('../classes/meshed.php');
if(loggedin()) 
{
$meshedform = new Meshed();
?>

<!-- For validations -->
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>

<!-- validation end --> 

<!-- jQuery Form Validation code -->
<script>
	$(document).ready(function(){
	 $("#ortho").validate({
    
        // Specify the validation rules
        rules: {
            plantiff_name:{
				required: true
				},
			date:
			{
				required:true
			},
			mob_no:
			{
				required:true,
				number:true,
				minlength:10,
				maxlength:10
			},
			home_no:
			{
				required:true
			},
			email:
			{
				required:true,
				email:true
			},
			dob:
			{
				required:true
			},
			drv_licns:
			{
				required:true
			},
			address:
			{
				required:true
			},
			city:
			{
				required:true
			},
			zipcode:
			{
				required:true,
				number:true
			},
			user_state:
			{
				required:true
			},
			auto_insure:{
				required:true
			}
					
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            plantiff_name:{
				required: "Please Enter your Name"
			},
			date:{required: "Date is required"},
			mob_no:{required:"Please Enter the Mobile No", number:"Please Enter the Correct Phone Number"},
			home_no:{required:"Please Enter home No"},
			email:{required:"Please Enter Your Email Address", email:"Please enter correct Email Address"},
			dob:{required:"Please enter the Date of Birth"},
			drv_licns:{required: "Please Enter you Driving Licence Number"},
			address:{required: "Please Enter your address"},
			city:{required: "Please Enter city name"},
			zipcode:{required: "Please Enter you zip code", number: "Only numbers are required"},
			auto_insure:{required: "Please Enter auto insurence field"}
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
<!-- validation end -->
<style type="text/css">
.error
{
	color: #ff0000;
	font: 12px/4 open_sansregular;
	margin: 0 !important;
}
</style>
<!-- jQuery Form Validation code -->

<section class="row">
	<div class="container client_application">
		<h1>Pain Management Form</h1>
		<form name="ortho" id="ortho" method="post" action="">
			<div class="client_1">
				<div class="attorney_row">
					<h2>Client Information</h2>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Client Name</label>
						<input type="text" name="plantiff_name" id="plantiff_name"/>
						
						<span class="error"></span>
					</div>
					<div class="attorney_right">
						<label>Date</label>
						<input type="text" class="calendarSelectDate" name="date" id="date"/>
						<div id="calendarDiv"></div>
						<span class="error"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Mobile No.</label>
						<input type="text" name="mob_no" id="mob_no"/>
						
						<span class="error"></span>
					</div>
					<div class="attorney_right">
						<label>Home No.</label>
						<input type="text" name="home_no" id="home_no"/>
						
						<span class="error"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Office No.</label>
						<input type="text" name="ofc_no" id="ofc_no"/>
						
						<span class="error"></span>
					</div>
					<div class="attorney_right">
						<label>Email Address</label>
						<input type="text" name="email" id="email"/>
						
						<span class="error"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Date of Birth</label>
						<input type="text" class="calendarSelectDate" name="dob" id="dob"/>
						<span class="error"></span>
						<div id="calendarDiv"></div>
					
					</div>
					<div class="attorney_right">
						<label>Driving License</label>
						<input type="text" name="drv_licns" id="drv_licns"/>
						<span class="error"></span>
						
					</div>
				</div>
				<div class="attorney_row">
					<label>Address</label>
					<input type="text" name="address" id="address"/>
					
					<span class="error"></span>
				</div>
				<div class="attorney_row">
					<div class="attorney_right">
						<label>City</label>
						<input type="text" name="city" id="city"/>
						
						<span class="error"></span>
					</div>
					<div class="attorney_left">
						<label>State</label>
						<?php $meshedform-> GetState(); ?>
						
						<span class="error"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Zip Code</label>
						<input type="text" name="zipcode" id="zipcode"/>
						
						<span class="error"></span>
					</div>
				</div>
				<div class="attorney_row">
					<label>Auto Insurance Carrier (Auto collision only)</label>
					<input type="text" name="auto_insure" id="auto_insure"/>
					<span class="error"></span>
					
				</div>
				
			</div><!--client_4_end-->
			<div class="client_5">
				<div class="attorney_row">
					<input type="submit" name="submit" id="submit" value="Submit"/>
				</div>	
			</div>
		</form>
		<?php
			if(isset($_REQUEST['submit']))
			{
				$meshedform->plantiff_name   = mysql_real_escape_string($_REQUEST['plantiff_name']);
				$meshedform->date_reg        = mysql_real_escape_string($_REQUEST['date']);
				$meshedform->mobile_no       = mysql_real_escape_string($_REQUEST['mob_no']);
				$meshedform->home_no         = mysql_real_escape_string($_REQUEST['home_no']);
				$meshedform->office_no       = mysql_real_escape_string($_REQUEST['ofc_no']);
				$meshedform->email_address   = mysql_real_escape_string($_REQUEST['email']);
				$meshedform->d_o_b           = mysql_real_escape_string($_REQUEST['dob']);
				$meshedform->driving_licence = mysql_real_escape_string($_REQUEST['drv_licns']);
				$meshedform->user_address    = mysql_real_escape_string($_REQUEST['address']);
				$meshedform->user_state      = mysql_real_escape_string($_REQUEST['user_state']);
				$meshedform->user_city       = mysql_real_escape_string($_REQUEST['city']);
				$meshedform->zip_code        = mysql_real_escape_string($_REQUEST['zipcode']);
				$auto_insurance              = mysql_real_escape_string($_REQUEST['auto_insure']);
				$username                    = strtolower(mysql_real_escape_string($_REQUEST['plantiff_name']));
				$u_name1                     = preg_replace('/\\s/','',$username);
				$case_type                   = "3";
				$meshedform->u_name  = $u_name1;
				$var = $meshedform->OldUser($case_type,$auto_insurance);
				if($var = 1 )
				{
					echo "<div id='e_message'>Your Login Information has been sent to your Email</div>";
					$emails                      = mysql_real_escape_string($_REQUEST['email']);
					$_SESSION['email']           = $emails;
					header("Refresh:8;url=$sitepath/attorney/ortho-form/pain-management-step-2.php/");
				}
				else
				{
					echo "<div id='e_message'>Email Sending Failed</div>";
				}
			}
		?>
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
