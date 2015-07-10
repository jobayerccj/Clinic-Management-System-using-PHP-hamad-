<?php 
session_start();
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../../classes/login-functions.php');

if(loggedin()) 
{
/*
 * 
 * Class file to call the functions
 * 
 * */
include('classes/UsersDetails.php');
?>
<!--Required Validation files called from validation folder-->
<script src="http://<?php echo $jqueryminjs; ?>"></script>
<script src="http://<?php echo $validateminjs; ?>"></script>
<!-- Validation rules start from here -->
<script type="text/javascript">
		$('#plantiff_app').validate({
    
        // Specify the validation rules
        rules: {
            plantiff_name: {
				required:true
				},
            upassword: {
                required: true
            }
	
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
           plantiff_name: {
				required: "Please enter username"
			},
            password: {
                required: "Please Enter password"
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });
	$(document).ready(function()
	{    
		$("#um_uim_y").click(function()
		{
			$("#um_uim_l").show('slow');
		});
		$("#um_uim_n").click(function()
		{
			$("#um_uim_l").hide('slow');
		});
		$("#bankrupty_y").click(function()
		{
			$("#bankrupty_w").show('slow');
		});
		$("#bankrupty_n").click(function()
		{
			$("#bankrupty_w").hide('slow');
		});
		
		
		$("#report_y").click(function()
		{
			$("#attach_copy").show('slow');
		});
		$("#report_n").click(function()
		{
			$("#attach_copy").hide('slow');
		});
		
		$("#injured_y").click(function()
		{
			$("#claim").show('slow');
		});
		$("#injured_n").click(function()
		{
			$("#claim").hide('slow');
		});
		
		
		$("#witness_y").click(function()
		{
			$("#witness_name").show('slow');
		});
		$("#witness_n").click(function()
		{
			$("#witness_name").hide('slow');
		});
		
		$("#surgury_y").click(function()
		{
			$("#surgery1").show('slow');
		});
		$("#surgury_n").click(function()
		{
			$("#surgery1").hide('slow');
		});
		
		$("#diagnostic_y").click(function()
		{
			$("#diagnostic_tests").show('slow');
		});
		$("#diagnostic_n").click(function()
		{
			$("#diagnostic_tests").hide('slow');
		});
		
		$("#health_insurance_y").click(function()
		{
			$("#health_insurance").show('slow');
		});
		$("#health_insurance_n").click(function()
		{
			$("#health_insurance").hide('slow');
		});
		
		$("#expenses_y").click(function()
		{
			$("#insurance_amount").show('slow');
		});
		$("#expenses_n").click(function()
		{
			$("#insurance_amount").hide('slow');
		});
		
		$("#trial_date_y").click(function()
		{
			$("#date_trial").show('slow');
			$("#projected_date").hide('slow');
		});
		$("#trial_date_n").click(function()
		{
			$("#projected_date").show('slow');
			$("#date_trial").hide('slow');
		});
		
		$("#suit_y").click(function()
		{
			$("#suit_y_y").show('slow');
		});
		$("#suit_n").click(function()
		{
			$("#suit_y_y").hide('slow');
			
		});
	});
</script>
<section class="row">
	<div class="container">
		<div class="form_section_content">	
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
			<div class="chk_bx_area">&nbsp;</div>
			</span>
			<span class="form_input">	
          	<div class="error_chk"><input name="check" type="checkbox" value="" /></div><br />
            <div style="font: 15px open_sansregular; text-align:left; overflow:hidden; width:100%;">I agree to MayoSurgical.com Terms &amp; Policies</div><br />
            <span class="error"></span>
            </span>
            
		</li>

		<li>	
			<input type="submit" name="register" value="Register">
		</li>
		</ul>
	
</form>
		</div>
</div>
</section>
<?php
require($get_footer);
}
else
{
	
header('Location:../login.php');
	
}
?>


