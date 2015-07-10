<?php 
ob_start();
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
$header = $pathofmayo."/attorney/header.php";
require($header);
require_once($config);
include('../../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
?>
<script src="https://<?php echo $jqueryminjs; ?>"></script>

<script src="https://<?php echo $validateminjs; ?>"></script>

<!-- validation end --> 

<!-- jQuery Form Validation code -->
<script>
	$(document).ready(function(){
	 $("#registration").validate({
    
        // Specify the validation rules
        rules: {
            plantiff_name:{
				required: true
				},
			plantiff_last:{
				required:true
				},
			home_no:
			{
				required:true
			},
			email_address:
			{
				required:true,
				email:true
			},
			d_o_b_y:
			{
				required:true,
				digits:true,
				minlength:4
			}
					
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            plantiff_name:{
				required: "Please Enter your Name"
			},
			date_reg:{required: "Date is required"},
			mobile_no:{required:"Please Enter the Mobile No", number:"Please Enter the Correct Phone Number"},
			email_addrress:{required:"Please Enter Your Email Address", email:"Please enter correct Email Address"},
			d_o_b:{required:"Please enter the Date of Birth"},
			driving_licence:{required: "Please Enter you Driving Licence Number"}
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
	<?php
	if(isset($_REQUEST['register']))
	{
		$dob_m = mysql_real_escape_string($_POST['d_o_b_m']);
		$dob_d = mysql_real_escape_string($_POST['d_o_b_d']);
		$dob_y = mysql_real_escape_string($_POST['d_o_b_y']);

		$fullDob = $dob_m."-".$dob_d."-".$dob_y;

		$plantiff_first				   = mysql_real_escape_string($_REQUEST['plantiff_name']);
		$plantiff_name 				   = mysql_real_escape_string($_REQUEST['plantiff_last']);
		$temp_profile->plantiff_name   = $plantiff_first." ".$plantiff_name;
		$temp_profile->date_reg        = mysql_real_escape_string($_REQUEST['date_reg']);
		$temp_profile->mobile_no       = mysql_real_escape_string($_REQUEST['mobile_no']);
		$temp_profile->home_no         = mysql_real_escape_string($_REQUEST['home_no']);
		$temp_profile->office_no       = mysql_real_escape_string($_REQUEST['office_no']);
		$temp_profile->email_address   = mysql_real_escape_string($_REQUEST['email_address']);
		$temp_profile->d_o_b           = $fullDob;
		$temp_profile->driving_licence = mysql_real_escape_string($_REQUEST['driving_licence']);
		$temp_profile->user_address    = mysql_real_escape_string($_REQUEST['user_address']);
		$temp_profile->user_state      = mysql_real_escape_string($_REQUEST['user_state']);
		$temp_profile->user_city       = mysql_real_escape_string($_REQUEST['user_city']);
		$temp_profile->zip_code        = mysql_real_escape_string($_REQUEST['zip_code']);
		$temp_profile->doctor_name     = mysql_real_escape_string($_REQUEST['doctor_name']);
		$temp_profile->client_email     = mysql_real_escape_string($_REQUEST['client_email_address']);
		$case_type                     = "1";
		$auto_insurance                = "";
		$ssn_no                        = "";
		/*Convert to small letters*/
		$username                      = strtolower(mysql_real_escape_string($_REQUEST['plantiff_name']));
		$u_name1                       = preg_replace('/\\s/','',$username);
		$temp_profile->u_name          = $u_name1;
		$var                           = $temp_profile->OldUser($case_type,$auto_insurance,$ssn_no);
		$emails                        = mysql_real_escape_string($_REQUEST['email_address']);
		$_SESSION['email']             = $emails;
		if($var = 1 )
		{
			echo "<div class='thank_message'>Form Submitted Sucessfully. You will redirected to next step shortly. Don't close the browser.</div>";
			header("Refresh:2;url=$sitepath/attorney/ortho-form/ortho-step-2.php");
		}
		else
		{
			echo "<div class='thank_message'>Email Sending Failed</div>";
		}
	}
?>
	<div class="container client_application">
		<h1>Ortho Form</h1>
		<form name="registration" id="registration" method="post" action="">
			<div class="client_1">
				<div class="attorney_row">
					<h2>Client Information</h2>
				</div>
				<div class="attorney_row">
					<div class="attorney_names">
						<div class="attorney_left">
							<label>First Name</label>
							<input type="text" name="plantiff_name" value="" id=""/>
							<span class="error message"></span>
						</div>
						<div class="attorney_right">
							<label>Last Name</label>
							<input type="text" name="plantiff_last" value="" id=""/>
							<span class="error message"></span>
						</div>
					</div>
					<div class="attorney_right">
						<label>Date</label>
						<input type="text" name="date_reg" value="<?php echo date('m-d-Y H:i:s'); ?>" readonly />
						<span class="error message"></span>
						<div id="calendarDiv"></div>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
					<label>Best Contact Number</label>
						<input type="text" maxlength="14" name="home_no" onkeyup="mask(event,this);"   onkeydown="mask(event,this);" id=""/>
						<span class="error validation"></span>
						
					</div>
					<div class="attorney_right">
						<label>Mobile No.</label>
						<input type="text" maxlength="14" onkeyup="mask(event,this);"   onkeydown="mask(event,this);" name="mobile_no" id=""/>
						<span class="error validation"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Work No.</label>
						<input type="text" maxlength="14" onkeyup="mask(event,this);"   onkeydown="mask(event,this);" name="office_no" id=""/>
						<span class="error validation"></span>
					</div>
					<div class="attorney_right">
						<label>Client Email</label>
						<input type="hidden" name="email_address" id="" value="<?=$temp_profile->GetDetailsByUsername($panel,"email_id")?>"/>
						<input type="text" name="client_email_address" id="" value=""/>
						<span class="error validation"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Date of Birth</label>
						<div class="dob">
							<select name="d_o_b_m" required>
								<option value="">Select Month</option>
								<?php 
									$array = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"); 
									foreach($array as $key=>$value)
									{
										if($key<9)
										{
											$newkey = "";
											$newkey .= 0;
											$newkey .= $key+1;
										}
										else
										{
											echo $newkey = $key+1;
										}
										echo "<option value=$newkey>$value</option>";
									}
								?>
							</select>
						</div>
						<div class="dob">
							<select name="d_o_b_d" required>
								<option value="">Select Date</option>
								<?php 
									for($i=1;$i<=31;$i++)
									{
										if($i<10)
										{
											$k = "";
											$k .= 0;
											$k .= $i;
										}
										else
										{
											$k = $i;
										}
										echo "<option value=$k>$k</option>";
									}
								?>
							</select>
						</div>
						<div class="dob">
							<input type="text" name="d_o_b_y" value="" placeholder="Year e.g. (YYYY)" maxlength="4" required />	
						</div>
					</div>
					<div class="attorney_right">
						<label>Driver's License</label>
						<input type="text" name="driving_licence" id=""/>
						<span class="error validation"></span>
					</div>
				</div>
				<div class="attorney_row">
					<label>Address</label>
					<input type="text" name="user_address" id=""/>
					<span class="error validation"></span>
				</div>
				<div class="attorney_row">
					<div class="attorney_right">
						<label>City</label>
						<input type="text" name="user_city" id=""/>
						<span class="error validation"></span>
					</div>
					<div class="attorney_left">
						<label>State</label>
						<?php $temp_profile-> GetState(); ?>
						<span class="error validation"></span>
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Zip Code</label>
						<input type="text" name="zip_code" id=""/>
						<span class="error validation"></span>
					</div>
					<div class="attorney_right">
						<label>Preferred Choice of Doctor  *Not Requried</label>
						<input type="text" name="doctor_name" id=""/>
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
	</div><div id="calendarDiv"></div>
</section>
<?php
require($get_footer);
}
else
{
header('Location:../../login.php');
}
?>
