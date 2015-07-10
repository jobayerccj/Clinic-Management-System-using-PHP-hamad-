<?php 
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
$header = $_SERVER['DOCUMENT_ROOT']."/rao/attorney/header.php";
require($header);
require_once($config);
include('../../classes/login-functions.php');
include('../classes/meshed.php');
if(loggedin()) 
{
/*Class file to call the functions*/
$meshedform = new Meshed();
?>

<!-- For validations -->
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>

<!-- validation end --> 

<style type="text/css">
	.error{
		color: #ff0000;
		font: 12px/4 open_sansregular;
		margin: 0 !important;
	}
</style>
<!-- jQuery Form Validation code -->
<script>
$(document).ready(function(){
    $("#registration").validate({
    
        // Specify the validation rules
        rules: {
            plantiff_name:{
				required: true,
				minlength: 3,
				alpha: true
				},
			date_reg:{
				required:true,
				minlength: 3,
				alpha: true
				},
			
			mobile_no:{
				required:true,
				number:true,
				minlength:10,
				maxlength:10
				},
				
			email_address:{
					required:true,
					email:true
				},
				
			d_o_b:{
				required:true,
				minlength: 3,
				alpha: true
				},
				
			drv_licns:{
				required:true,
				minlength: 3,
				alpha: true
				},
			
			user_address:{
				required:true,
				minlength: 3,
				alpha: true
				},
			
			user_state:{
				required:true,
				minlength: 3,
				alpha: true
				},
			
			
			user_city:{
				required:true,
				minlength: 3,
				alpha: true
				},
			
			zipcode:{
				required:true,
				minlength: 3,
				alpha: true
				},
			doctor_name:{
				required:true,
				minlength: 3,
				alpha: true
				},
        },
		
		errorElement: "span",
        messages: {
            plantiff_name:{
				required: "Please Enter Name",
				alpha: "Only Characters are allowed"
				},
			date_reg:{
				required: "Please Enter Date",
				alpha: "Only numbers are allowed"
				},
			mobile_no:{
				required:"Please enter Phone Number",
				number:"Please Enter Correct Phone Number"
				},
			email_address:{
					required:"Please enter your Email Address",
					email:"Please enter correct Email Address"
				},
			d_o_b:{
				required: "Please Enter Date of birth",
				alpha: "Only numbers are allowed"
				},
			drv_licns:{
				required: "Please Enter driving license",
				alpha: "Only Characters are allowed"
				},
			user_address:{
				required: "Please Enter Address",
				alpha: "Only Characters are allowed"
				},
			user_state:{
				required: "Please Enter State",
				alpha: "Only Characters are allowed"
				},
			user_city:{
				required: "Please Enter city",
				alpha: "Only Characters are allowed"
				},
			zipcode:{
				required: "Please Enter Zipcode of your city",
				alpha: "Only numbers are allowed"
				},
			doctor_name:{
				required: "Please Enter doctor name",
				alpha: "Only Characters are allowed"
				},
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>

<section class="row">
	<div class="container client_application">
		<h1>General Surgery Registration Form</h1>
		<form name="registration" id="registration" method="post" action="">
			<div class="client_1">
				<div class="attorney_row">
					<h2>Client Information</h2>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Client Name</label>
						<input type="text" required="required" name="plantiff_name" id=""/>
						<span class="error message"></span>
					</div>
					<div class="attorney_right">
						<label>Date</label>
						<input type="text" required="required" name="date_reg" id="datepicker" />
						<span class="error message"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Mobile No.</label>
						<input type="text" required="required" name="mobile_no" id=""/>
						<span class="error validation"></span>
					</div>
					<div class="attorney_right">
						<label>Home No.</label>
						<input type="text" required="required" name="home_no" id=""/>
						<span class="error validation"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Office No.</label>
						<input type="text" required="required" name="office_no" id=""/>
						<span class="error validation"></span>
					</div>
					<div class="attorney_right">
						<label>Email Address</label>
						<input type="text" required="required" name="email_address" id=""/>
						<span class="error validation"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Date of Birth</label>
						<input type="text" required="required" name="d_o_b" id=""/>
						<span class="error validation"></span>
					</div>
					<div class="attorney_right">
						<label>Driving License</label>
						<input type="text" required="required" name="driving_licence" id=""/>
						<span class="error validation"></span>
					</div>
				</div>
				<div class="attorney_row">
					<label>Address</label>
					<input type="text" required="required" name="user_address" id=""/>
					<span class="error validation"></span>
				</div>
				<div class="attorney_row">
					<div class="attorney_right">
						<label>City</label>
						<input type="text" required="required" name="user_city" id=""/>
						<span class="error validation"></span>
					</div>
					<div class="attorney_left">
						<label>State</label>
						<?php $meshedform-> GetState(); ?>
						<span class="error validation"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Zip Code</label>
						<input type="text" required="required" name="zip_code" id=""/>
						<span class="error validation"></span>
					</div>
					<div class="attorney_right">
						<label>Preferred Choice of Doctor  *Not Requried</label>
						<input type="text" required="required" name="doctor_name" id=""/>
						<span class="error validation"></span>
					</div>
				</div>
				<!--<div class="attorney_row">
					<label>Auto Insurance Carrier (Auto collision only)</label>
					<input type="text" name="" id=""/>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<div class="form_field_left">
							<label>UM / UIM</label>
						</div>
						<div class="form_field_right">
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>Yes
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>No
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>N/A
							</label>
						</div>	
					</div>
					<div class="attorney_right">
						<div class="form_field_left">
							<label>UM / UIM</label>
						</div>
						<div class="form_field_right">
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>Yes
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>No
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>N/A
							</label>
						</div>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<div class="form_field_left">
							<label>Client ever claim bankruptcy ?</label>
						</div>
						<div class="form_field_right">
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>Yes
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>No
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="" id=""/>N/A
							</label>
						</div>
					</div>
				</div>
			</div><!--client_1_end-->
			<div class="client_5">
				<div class="attorney_row">
					<input type="submit" name="register" id="sactions" value="Next"/>
				</div>	
			</div>
		</form>
		<div id="mesages"></div>
	</div>
</section>
<?php
	if(isset($_REQUEST['register']))
	{		
		$meshedform->plantiff_name   = mysql_real_escape_string($_REQUEST['plantiff_name']);
		$meshedform->date_reg        = mysql_real_escape_string($_REQUEST['date_reg']);
		$meshedform->mobile_no       = mysql_real_escape_string($_REQUEST['mobile_no']);
		$meshedform->home_no         = mysql_real_escape_string($_REQUEST['home_no']);
		$meshedform->office_no       = mysql_real_escape_string($_REQUEST['office_no']);
		$meshedform->email_address   = mysql_real_escape_string($_REQUEST['email_address']);
		$meshedform->d_o_b           = mysql_real_escape_string($_REQUEST['d_o_b']);
		$meshedform->driving_licence = mysql_real_escape_string($_REQUEST['driving_licence']);
		$meshedform->user_address    = mysql_real_escape_string($_REQUEST['user_address']);
		$meshedform->user_state      = mysql_real_escape_string($_REQUEST['user_state']);
		$meshedform->user_city       = mysql_real_escape_string($_REQUEST['user_city']);
		$meshedform->zip_code        = mysql_real_escape_string($_REQUEST['zip_code']);
		$meshedform->doctor_name     = mysql_real_escape_string($_REQUEST['doctor_name']);
		$case_type                   = "4";
		$auto_insurance              = " ";
		/*Convert to small letters*/
		$username                    = strtolower(mysql_real_escape_string($_REQUEST['plantiff_name']));
		$u_name1                     = preg_replace('/\\s/','',$username);
		$meshedform->u_name          = $u_name1;
		$var = $meshedform->OldUser($case_type,$auto_insurance);
		echo $emails                      = mysql_real_escape_string($_REQUEST['email_address']);
		echo $_SESSION['email']           = $emails;
		if($var = 1 )
		{
			echo "<div id='e_message'>Your Login Information has been sent to your Email</div>";
			header("Refresh:8;url=$sitepath/attorney/meshed-form/meshed-step-2.php/");
		}
		else
		{
			echo "<div id='e_message'>Email Sending Failed</div>";
		}
		
	}
require($get_footer);
}
else
{
header('Location:../../login.php');
}

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
 <script>
$(function() {
$( "#datepicker" ).datepicker();
});
</script>
