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
	setTimeout(function(){ $('.messages').fadeOut('slow'); }, 5000);
$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
    $("#ortho").validate({
    
        // Specify the validation rules
        rules: {
            plantiff_name:{
				required: true,
				minlength: 3,
				alpha: true
				},
			date:{
				required:true
				},
			
			mob_no:{
				required:true,
				number:true,
				minlength:10,
				maxlength:10
				},
				
			email:{
					required:true,
					email:true
				},
			drv_licns:{
				required:true,
				minlength: 3,
				alpha: true
				},
			
			address:{
				required:true,
				minlength: 3,
				alpha: true
				},
			
			state:{
				required:true,
				minlength: 3,
				alpha: true
				},
			
			
			city:{
				required:true,
				minlength: 3,
				alpha: true
				},
			
			zipcode:{
				required:true,
				minlength: 3
				},
			auto_insure:{
				required:true,
				minlength: 3
				},
			firm:{
				required:true,
				minlength: 3,
				alpha: true
				},

			frm_address:{
				required:true,
				minlength: 3,
				alpha: true
				},

			phone:{
				required:true,
				minlength: 3
				},
			
			fax:  {
				required:true,
				minlength: 3
				},

			frm_contact:{
				required:true,
				minlength: 3,
				alpha: true
				},
			
			position:{
				required:true,
				minlength: 3,
				alpha: true
				},

			contct_email:{
				required:true,
				minlength: 3,
				alpha: true
				},
			dfndr_name:{
				required:true,
				minlength: 3,
				alpha: true
				},
			insure_cmpny:{
				required:true,
				minlength: 3,
				alpha: true
				},
			claim_no:{
				required:true,
				minlength: 3,
				alpha: true
				},
			limits:{
				required:true,
				minlength: 3,
				alpha: true
				},
			injury_date:{
				required:true,
				minlength: 3,
				alpha: true
				},
			event_location:{
				required:true,
				minlength: 3,
				alpha: true
				},
			event_desc:{
				required:true,
				minlength: 3,
				alpha: true
				},
			injury_desc:{
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
			date:{
				required: "Please Enter Date",
				},
			mob_no:{
				required:"Please enter Phone Number",
				number:"Please Enter Correct Phone Number"
				},
			email:{
					required:"Please enter your Email Address",
					email:"Please enter correct Email Address"
				},
			dob:{
				required: "Please Enter Date of birth",
				alpha: "Only Characters are allowed"
				},
			drv_licns:{
				required: "Please Enter driving license",
				alpha: "Only Characters are allowed"
				},
			address:{
				required: "Please Enter Address",
				alpha: "Only Characters are allowed"
				},
			state:{
				required: "Please Enter State",
				alpha: "Only Characters are allowed"
				},
			city:{
				required: "Please Enter city",
				alpha: "Only Characters are allowed"
				},
			zipcode:{
				required: "Please Enter Zipcode of your city",
				alpha: "Only Characters are allowed"
				},
			auto_insure:{
				required: "Please Enter Zipcode of your city",
				alpha: "Only Characters are allowed"
				},
			firm:{
				required: "Please Enter firm name",
				alpha: "Only Characters are allowed"
				},
			phone:{
				required: "Please Enter phone number",
				alpha: "Only Characters are allowed"
				},
			fax:{
				required: "Please Enter fax",
				alpha: "Only Characters are allowed"
				},
			frm_contact:{
				required: "Please Enter firm contact",
				alpha: "Only Characters are allowed"
				},
			position:{
				required: "Please Enter Position",
				alpha: "Only Characters are allowed"
				},
			contct_email:{
				required: "Please Enter firm email id",
				alpha: "Only Characters are allowed"
				},
			dfndr_name:{
				required: "Please Enter diffender name",
				alpha: "Only Characters are allowed"
				},
			insure_cmpny:{
				required: "Please Enter Insurence company",
				alpha: "Only Characters are allowed"
				},
			claim_no:{
				required: "Please Enter cliam Number",
				alpha: "Only Characters are allowed"
				},
			limits:{
				required: "Please Enter Limits",
				alpha: "Only Characters are allowed"
				},
			injury_date:{
				required: "Please Enter Injury date",
				alpha: "Only Characters are allowed"
				},
			event_location:{
				required: "Please Enter event location",
				alpha: "Only Characters are allowed"
				},
			event_desc:{
				required: "Please Enter event Description",
				alpha: "Only Characters are allowed"
				},
			injury_desc:{
				required: "Please Enter injury Description",
				alpha: "Only Characters are allowed"
				},
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<style type="text/css">
	.error{
		color: #ff0000;
		font: 12px/3 open_sansregular;
	}
</style>
<section class="row">
	<div class="container client_application">
		<h1>Neurological Application Form</h1>
		<form name="ortho" id="ortho" method="post" action="">
			<div class="client_1">
				<div class="attorney_row">
					<h2>Client Information</h2>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Client Name</label>
						<input type="text" required="required" name="plantiff_name" id="plantiff_name"/>
						
						<span class="error"></span>
					</div>
					<div class="attorney_right">
						<label>Date</label>
						<input type="text" required="required" name="date" id="date"/>
						
						<span class="error"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Mobile No.</label>
						<input type="text" required="required" name="mob_no" id="mob_no"/>
						
						<span class="error"></span>
					</div>
					<div class="attorney_right">
						<label>Home No.</label>
						<input type="text" required="required" name="home_no" id="home_no"/>
						
						<span class="error"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Office No.</label>
						<input type="text" required="required" name="ofc_no" id="ofc_no"/>
						
						<span class="error"></span>
					</div>
					<div class="attorney_right">
						<label>Email Address</label>
						<input type="text" required="required" name="email" id="email"/>
						
						<span class="error"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Date of Birth</label>
						<input type="text" required="required" name="dob" id="dob"/>
						<span class="error"></span>
					
					</div>
					<div class="attorney_right">
						<label>Driving License</label>
						<input type="text" required="required" name="drv_licns" id="drv_licns"/>
						<span class="error"></span>
						
					</div>
				</div>
				<div class="attorney_row">
					<label>Address</label>
					<input type="text" required="required" name="address" id="address"/>
					
					<span class="error"></span>
				</div>
				<div class="attorney_row">
					<div class="attorney_right">
						<label>City</label>
						<input type="text" required="required" name="city" id="city"/>
						
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
						<input type="text" required="required" name="zipcode" id="zipcode"/>
						
						<span class="error"></span>
					</div>
				</div>
				<div class="attorney_row">
					<label>Auto Insurance Carrier (Auto collision only)</label>
					<input type="text" required="required" name="auto_insure" id="auto_insure"/>
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
				$case_type                   = "4";
				$meshedform->u_name  = $u_name1;
				$var = $meshedform->OldUser($case_type,$auto_insurance);
				if($var = 1 )
				{
					echo "<div id='e_message'>Your Login Information has been sent to your Email</div>";
					$emails                      = mysql_real_escape_string($_REQUEST['email']);
					$_SESSION['email']           = $emails;
					header("Refresh:8;url=$sitepath/attorney/ortho-form/general-surgery-step-2.php/");
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
