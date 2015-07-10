<?php 
session_start();
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
include('classes/Plantiff.php');
if(loggedin()) 
{
/*Class file to call the functions*/
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
<?php
	
	/* 
	 * 
	 * On  button action these of the following functions are called to stores the user information in the database
	 * 
	 * */
	if(isset($_POST['plantiffinfor']))
	{
		/*
		 * 
		 * Variables of the plantiff information table only
		 * 
		 * */
		 
		$plantiff_name          = mysql_real_escape_string($_POST['plantiff_name']);
		$plantiff_date          = mysql_real_escape_string($_POST['plantiff_date']);
        $plantiff_address       = mysql_real_escape_string($_POST['plantiff_address']);
        $plantiff_workphone     = mysql_real_escape_string($_POST['plantiff_workphone']);
        $plantiff_dob           = mysql_real_escape_string($_POST['plantiff_dob']);
        $plantiff_homephone     = mysql_real_escape_string($_POST['plantiff_homephone']);
        $plantiff_driverlicense = mysql_real_escape_string($_POST['plantiff_driverlicense']);
        $plantiff_mobilephone   = mysql_real_escape_string($_POST['plantiff_mobilephone']);
        $plantiff_email         = mysql_real_escape_string($_POST['plantiff_email']);
        $plantiff_autoinsurance = mysql_real_escape_string($_POST['plantiff_autoinsurance']);
		if($_POST['plantiff_um_uim']=="yes")
		{
			$plantiff_UM_UIM    = mysql_real_escape_string($_POST['plantiff_UM_UIM_limits']);
		}
		else
		{
			$plantiff_UM_UIM    = mysql_real_escape_string($_POST['plantiff_um_uim']);
		}
		$plantiff_PIP_med_pay   =  mysql_real_escape_string($_POST['plantiff_pip']);
		if($_POST['client_bankrupty'] == "yes")
		{
			$plantiff_client_bankrupty = mysql_real_escape_string($_POST['bankrupty_when']);
		}
		else
		{
			$plantiff_client_bankrupty = mysql_real_escape_string($_POST['client_bankrupty']);
		}
		/*
		 * 
		 * First table ends here
		 * 
		 * */

		/* 
		 * 
		 * 
		 * Plantiff AttorneyInformation variables starts from here 
		 * 
		 * 
		 * */
		$plantiff_AttorneyInformation_firm          = mysql_real_escape_string($_POST['plantiff_AttorneyInformation_firm']);
		$plantiff_AttorneyInformation_address       = mysql_real_escape_string($_POST['plantiff_AttorneyInformation_address']);
		$plantiff_AttorneyInformation_phone         = mysql_real_escape_string($_POST['plantiff_AttorneyInformation_phone']);
		$plantiff_AttorneyInformation_fax           = mysql_real_escape_string($_POST['plantiff_AttorneyInformation_fax']);
		$plantiff_AttorneyInformation_firm_contact  = mysql_real_escape_string($_POST['plantiff_AttorneyInformation_firm_contact']);
		$plantiff_AttorneyInformation_position      = mysql_real_escape_string($_POST['plantiff_AttorneyInformation_position']);
		$plantiff_AttorneyInformation_contact_email = mysql_real_escape_string($_POST['plantiff_AttorneyInformation_contact_email']);
		
		/*
		 * 
		 * End of 2nd table variables
		 * 
		 * */
		 
		 /* 
		 * 
		 * 
		 * Defendants Information array Variables 
		 * 
		 * 
		 * */
		$plantiffdefendants_information_name       = $_POST['plantiffdefendants_information_name'];
		$plantiffdefendants_information_company    = $_POST['plantiffdefendants_information_company'];
		$plantiffdefendants_information_claim      = $_POST['plantiffdefendants_information_claim'];
		$plantiffdefendants_information_limits     = $_POST['plantiffdefendants_information_limits'];
		
		/*3rd table variables ends here*/
		  
		/* 
		 * 
		 * 
		 * incident information variables starts from here
		 * 
		 * 
		 * 
		 * */
		$plantiffincident_information_injury_date          = mysql_real_escape_string($_POST['plantiffincident_information_injury_date']);
		$plantiffincident_information_event_location       = mysql_real_escape_string($_POST['plantiffincident_information_event_location']);
		$plantiffincident_information_event_description    = mysql_real_escape_string($_POST['plantiffincident_information_event_description']);
		$plantiffincident_information_injuries_description = mysql_real_escape_string($_POST['plantiffincident_information_injuries_description']);
		if($_POST['plantiffincident_information_report_y'] == "yes")
		{
			$plantiffincident_information_report           = $_POST['plantiffincident_information_police_report'];
		}
		else
		{
			$plantiffincident_information_report           = mysql_real_escape_string($_POST['plantiffincident_information_report_y']);
		}
		if($_POST['plantiffincident_information_injured'] == "yes")
		{
			$plantiffincident_information_injured_claim    = mysql_real_escape_string($_POST['plantiffincident_information_injured_claim']);
		}
		else
		{
			$plantiffincident_information_injured_claim    = mysql_real_escape_string($_POST['plantiffincident_information_injured']);
		}
		if($_POST['plantiffincident_information_witness'] == "yes")
		{
			$plantiffincident_information_witnes_name      = mysql_real_escape_string($_POST['plantiffincident_information_witnes_name']);
		}
		else
		{
			$plantiffincident_information_witnes_name      = mysql_real_escape_string($_POST['plantiffincident_information_witness']);
		}
		
		/*
		 * 4th table ends here
		 * */
		 
		 /*
		  * 
		  * Medical treatment table variables starts over here
		  * 
		  * 
		  * */
		  
		$bill_date       = $_POST['bill_date'];
		$bill_provider   = $_POST['bill_provider'];
		$bill_treatment  = $_POST['bill_treatment'];
		$bill_cost       = $_POST['bill_cost'];
		$bill_amountpaid = $_POST['bill_amountpaid'];
		$bill_by_whom    = $_POST['bill_by_whom'];
		$bill_balance    = $_POST['bill_balance'];
		$total_cost      = $_POST['total_balance'];
		
		/*
		 * Medical treatment table ends here
		 * */
		 
		 /*
		  * Surgury and Medical information same form as above but stores the information in two tables
		  * */
		 $surgury_re = $_POST['surgury2'];
		 $diagnostic = $_POST['diagnostic'];
		 if($_POST['surgury2']=="yes")
		 {
			$surgury_date1 = mysql_real_escape_string($_POST['surgury_date']);
			$surgery_type1 = mysql_real_escape_string($_POST['surgery_type']);
		 }
		 if($_POST['diagnostic'] == "yes")
		 {
			$type_of_diagnostic = mysql_real_escape_string($_POST['type_of_diagnostic']);
			$diagnostice_results = mysql_real_escape_string($_POST['diagnostice_results']);
		 }
		 $prior_collison = mysql_real_escape_string($_POST['prior_collision']);
		 $collisions = mysql_real_escape_string($_POST['prior_collision']);
		 if($_POST['health_insurance'] == "yes")
		 {
			$health_insurance = $_POST['health_insurance'];
			$expenses = $_POST['expenses'];
			if($_POST['expenses'] == "yes")
			{
				$amount_health = $_POST['amount_health'];					
			}
			else
			{
				$amount_health = "";
			}
		 }
		 else
		 {
			$amount_health = "";
		 }
		
		/* 
		 * 
		 * Status Claim variables starts over here
		 * 
		 */
		 
		if($_POST['plantiffstatus_claim_suit'] == "yes")
		{
			 $plantiffstatus_claim_action_title      = mysql_real_escape_string($_POST['plantiffstatus_claim_action_title']);
			 $plantiffstatus_claim_index_no          = mysql_real_escape_string($_POST['plantiffstatus_claim_index_no']);
			 $plantiffstatus_claim_venue             = mysql_real_escape_string($_POST['plantiffstatus_claim_venue']);
			 $plantiffstatus_claim_state             = mysql_real_escape_string($_POST['plantiffstatus_claim_state']);
			 $plantiffstatus_claim_supreme           = mysql_real_escape_string($_POST['plantiffstatus_claim_supreme']);
			 $plantiffstatus_claim_federal           = mysql_real_escape_string($_POST['plantiffstatus_claim_federal']);
			if($_POST['plantiffstatus_claim_trial_date'] == "yes")
			{
				$plantiffstatus_claim_date           = mysql_real_escape_string($_POST['plantiffstatus_claim_date']);
			}
			else
			{
				$plantiffstatus_claim_projected_date = mysql_real_escape_string($_POST['plantiffstatus_claim_projected_date']);
			}
		}
		else
		{
		$plantiffstatus_claim_action_title           = " ";
		$plantiffstatus_claim_index_no               = " ";
		$plantiffstatus_claim_venue                  = " ";
		$plantiffstatus_claim_state                  = " ";
		$plantiffstatus_claim_supreme                = " ";
		$plantiffstatus_claim_federal                = " ";
		}
		
		/*
		 * All form variables are end here
		 * */

		$user_information               = new UsersDetails();

		$user_id                        = $user_information->current_user_id();

		$plantiffreg                    = new Plantiff();
		
		//$plantiffregister               = $plantiffreg->PlantiffRegister($user_id,$plantiff_name,$plantiff_date,$plantiff_address,$plantiff_workphone,$plantiff_dob,$plantiff_homephone,$plantiff_driverlicense,$plantiff_mobilephone,$plantiff_email,$plantiff_autoinsurance,$plantiff_UM_UIM,$plantiff_PIP_med_pay,$plantiff_client_bankrupty);

		//$PlantiffAttorneyInformation    = $plantiffreg->PlantiffAttorneyInformation($user_id,$plantiff_AttorneyInformation_firm,$plantiff_AttorneyInformation_address,$plantiff_AttorneyInformation_phone,$plantiff_AttorneyInformation_fax,$plantiff_AttorneyInformation_firm_contact,$plantiff_AttorneyInformation_position,$plantiff_AttorneyInformation_contact_email);

		//$Plantiffdefendants_information = $plantiffreg->Plantiffdefendants_information($user_id,$plantiffdefendants_information_name,$plantiffdefendants_information_company,$plantiffdefendants_information_claim,$plantiffdefendants_information_limits);
		/*
		 * Used to upload the files in Uploads/policereport form
		 * 
		$file_name   = $_FILES["plantiffincident_information_police_report"]["name"];
		$temp_name   = $_FILES["plantiffincident_information_police_report"]["tmp_name"];
		$target_path = "../../uploads/policereport/".$file_name;
		$move        = move_uploaded_file($temp_name, $target_path);
		if($move)
		{
			echo "True";
		}
		else
		{
			echo "False";
		}
		//$Plantiffincident_information = $plantiffreg->Plantiffincident_information($user_id,$plantiffincident_information_injury_date,$plantiffincident_information_event_location,$plantiffincident_information_event_description,$plantiffincident_information_injuries_description,$plantiffincident_information_report,$plantiffincident_information_injured_claim,$plantiffincident_information_witnes_name,$file_name,$temp_name);
		//$Plantiffstatus_claim         = $plantiffreg->Plantiffstatus_claim($user_id,$plantiffstatus_claim_action_title,$plantiffstatus_claim_index_no,$plantiffstatus_claim_venue,$plantiffstatus_claim_state,$plantiffstatus_claim_supreme,$plantiffstatus_claim_federal,$plantiffstatus_claim_date,$plantiffstatus_claim_projected_date);
		
		/*
		 * function call to medical_treatment_bill_amount
		 * */
		 
		//$plantiff_treatment_bill      = $plantiffreg->PlantiffCostInformation($user_id,$bill_date,$bill_provider,$bill_treatment,$bill_cost,$bill_amountpaid,$bill_by_whom);
        //$surgery_plantiff             = $plantiffreg->PlantiffSurgeryInformation($user_id,$surgury_re,$surgury_date1,$surgery_type1,$diagnostic,$type_of_diagnostic,$diagnostice_results,$prior_collison,$collisions,$health_insurance,$expenses,$amount_health);
		
		/*
		 * function call to store value 1 (If this form successfully stored)
		 * */
		 
		$plantiffstatusinformation    = $plantiffreg->PlantiffStatusInformation($user_id);
}
?>
<form name="plantiff" id="plantiff_app" method="post" action="" enctype="multipart/form-data">
			<div id="main_div">
<h2>APPLICATION</h2>
<h3>PLAINTIFF'S INFORMATION</h3>
<div id="application_form">
	<div class="row-fluid">
		<div class="gen_app_div">
			<div class="span2">Plaintiff Name:</div>
			<div class="span4"><input name="plantiff_name" type="text" class="txt_field"><span class="error"></span></div>
			<div class="span2">Date Completed:</div>
			<div class="span4"><input name="plantiff_date" type="date" class="txt_field"></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Address:</div>
			<div class="span10"><input name="plantiff_address" type="text" class="txt_field"></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Work Phone:</div>
			<div class="span4"><input name="plantiff_workphone" type="text" class="txt_field"></div>
			<div class="span2">Date of Birth:</div>
			<div class="span4"><input name="plantiff_dob" type="date" class="txt_field"></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Home Phone:</div>
			<div class="span4"><input name="plantiff_homephone" type="text" class="txt_field"></div>
			<div class="span2">Driver's License:</div>
			<div class="span4"><input name="plantiff_driverlicense" type="text" class="txt_field"></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Mobile Phone:</div>
			<div class="span4"><input name="plantiff_mobilephone" type="text" class="txt_field"></div>
			<div class="span2">E-mail:</div>
			<div class="span4"><input name="plantiff_email" type="text" class="txt_field"></div>
		</div>
		<div class="gen_app_div">
			<div class="span4">Auto Insurance Carrier (auto collisions only):</div>
			<div class="span8"><input name="plantiff_autoinsurance" type="text" class="txt_field"></div>
		</div>
		<div class="gen_app_div">
			<div class="span6 form_div_left">
			<p class="span3">UM/UIM</p>
			<p class="span2"><input id="um_uim_y" name="plantiff_um_uim" type="radio" value="yes">Yes</p>
			<p class="span2"><input id="um_uim_n" name="plantiff_um_uim" type="radio" value="no">No</p>
			<div id="um_uim_l" style="display:none;">
            <div class="span5">
            <p class="span3">Limits</p>
            <p class="span9"><input name="plantiff_UM_UIM_limits" type="text" class="txt_field"></p>
            </div>
            </div>
		</div>
		<div class="span6">
			<p class="span3">PIP/Med Pay?</p>
			<p class="span3"><input id="pipr" name="plantiff_pip" type="radio" value="yes">Yes</p>
			<p class="span3"><input id="pipn" name="plantiff_pip" type="radio" value="no">No</p>
			<div id="limitr" style="display:none;"><p class="span3">Limits <input name="limitpip" type="text" class="txt_field"></p></div>
		</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</div>
<div class="gen_app_div">
<div class="span3">Client ever claim bankruptcy?</div>
<div class="span1"><input id="bankrupty_y" name="client_bankrupty" type="radio" value="yes">Yes</div>
<div class="span1"><input id="bankrupty_n" name="client_bankrupty" type="radio" value="no">No</div>
<div class="span7">
<div id="bankrupty_w" style="display:none;"><p class="span2">When:</p><p class="span10"><input name="bankrupty_when" type="text" class="txt_field"></p></div>
</div>
</div>
</div>
</div>
<h3>PLAINTIFF'S ATTORNEY'S INFORMATION</h3>
<div id="application_form">
<div class="row-fluid">
<div class="gen_app_div">
<div class="span2">Firm:</div>
<div class="span10"><input name="plantiff_AttorneyInformation_firm" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span2">Address:</div>
<div class="span10"><input name="plantiff_AttorneyInformation_address" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span2">Phone: ( )</div>
<div class="span4"><input name="plantiff_AttorneyInformation_phone" type="text" class="txt_field"></div>
<div class="span2">Fax: ( )</div>
<div class="span4"><input name="plantiff_AttorneyInformation_fax" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span6">
<div class="span4">Firm Contact Person:</div>
<div class="span8"><input name="plantiff_AttorneyInformation_firm_contact" type="text" class="txt_field"></div>
</div>
<div class="span6">
<div class="span4">Position:</div>
<div class="span4"><input id="plantiff_AttorneyInformation_position_a" name="plantiff_AttorneyInformation_position" type="radio" value="Attorney">Attorney</div>
<div class="span4"><input id="plantiff_AttorneyInformation_position_an" name="plantiff_AttorneyInformation_position" type="radio" value="Non-attorney">Non-attorney</div>
</div>
</div>
<div class="gen_app_div">
<div class="span2">Contact E-mail</div>
<div class="span10"><input name="plantiff_AttorneyInformation_contact_email" type="text" class="txt_field"></div>
</div>
</div>
</div>
<h3>DEFENDANT'S INFORMAATION (lnsurance information is needed whether or not in suit)</h3>
<div id="application_form">
<div class="row-fluid">
<div class="gen_app_div">
<div class="span2"><strong>Defendant Name (1):</strong></div>
<div class="span10"><input name="plantiffdefendants_information_name[]" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span3">Insurance Company (1):</div>
<div class="span2"><input name="plantiffdefendants_information_company[]" type="text" class="txt_field"></div>
<div class="span2">Claim No.:</div>
<div class="span2"><input name="plantiffdefendants_information_claim[]" type="text" class="txt_field"></div>
<div class="span1">Limits:</div>
<div class="span2"><input name="plantiffdefendants_information_limits[]" type="text" class="txt_field"></div>
<input type="hidden" value="end" name="end[]">
</div>
<div class="gen_app_div">
<div class="span2"><strong>Defendant Name (2):</strong></div>
<div class="span10"><input name="plantiffdefendants_information_name[]" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span3">Insurance Company (1):</div>
<div class="span2"><input name="plantiffdefendants_information_company[]" type="text" class="txt_field"></div>
<div class="span2">Claim No.:</div>
<div class="span2"><input name="plantiffdefendants_information_claim[]" type="text" class="txt_field"></div>
<div class="span1">Limits:</div>
<div class="span2"><input name="plantiffdefendants_information_limits[]" type="text" class="txt_field"></div>
<input type="hidden" value="end" name="end[]">
</div>
</div>
</div>
<h3>INCIDENT INFORMATION</h3>
<div id="application_form">
<div class="row-fluid">
<div class="gen_app_div">
<div class="span2">Date of Injury:</div>
<div class="span4"><input name="plantiffincident_information_injury_date" type="date" class="txt_field"></div>
<div class="span2">Location of the Event:</div>
<div class="span4"><input name="plantiffincident_information_event_location" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span3">Description of the Event:</div>
<div class="span9"><input name="plantiffincident_information_event_description" type="text" class="txt_field"></div>
<!--<div class="row-fluid"><input name="" type="text" class="txt_field"></div>-->
</div>
<div class="gen_app_div">
<div class="span3">Description of injuries :</div>
<div class="span9"><input name="plantiffincident_information_injuries_description" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span3">Was there a police report?</div>
<div class="span1"><input id="report_y" name="plantiffincident_information_report_y" type="radio" value="yes">Yes</div>
<div class="span1"><input id="report_n" name="plantiffincident_information_report_y" type="radio" value="no">No</div>
<div class="span7" id="attach_copy" style="display:none;">
	<input name="plantiffincident_information_police_report" type="file">(if so, please attach a copy)</div>
</div>

<div class="gen_app_div">
<div class="span3">Others injured too?</div>
<div class="span1"><input id="injured_y" name="plantiffincident_information_injured" type="radio" value="yes">Yes</div>
<div class="span1"><input id="injured_n" name="plantiffincident_information_injured" type="radio" value="no">No</div>
<div id="claim" style="display:none;"><div class="span7">
<p class="span9">lf yes, what's the value of his/her/their claim(s)?</p>
<p class="span3"><input name="plantiffincident_information_injured_claim" type="text" class="txt_field"></p></div></div>
</div>
<div class="gen_app_div">
<div class="span3">Witness(es)?</div>
<div class="span1"><input id="witness_y" name="plantiffincident_information_witness" type="radio" value="yes">Yes</div>
<div class="span1"><input id="witness_n" name="plantiffincident_information_witness" type="radio" value="no">No</div>
<div id="witness_name" style="display:none;">
	<div class="span5">
	<p class="span4">Name(s):</p>
	<p class="span8"><input name="plantiffincident_information_witnes_name" type="text" class="txt_field"></p>
</div>
</div>
</div>
</div>
</div>
<h3>MEDICAL TREATMENT &amp; BILLS TO DATE</h3>
<div id="application_form">
<div class="row-fluid">
<div class="gen_app_div">
<div class="span1">Date<br>
<input name="bill_date[]" type="date" class="txt_field"><br>
<input name="bill_date[]" type="date" class="txt_field"><br>
<input name="bill_date[]" type="date" class="txt_field"><br>
<input name="bill_date[]" type="date" class="txt_field"></div>
<div class="span2">Provider<br>
<input name="bill_provider[]" type="text" class="txt_field"><br>
<input name="bill_provider[]" type="text" class="txt_field"><br>
<input name="bill_provider[]" type="text" class="txt_field"><br>
<input name="bill_provider[]" type="text" class="txt_field"></div>
<div class="span2">Treatment<br>
<input name="bill_treatment[]" type="text" class="txt_field"><br>
<input name="bill_treatment[]" type="text" class="txt_field"><br>
<input name="bill_treatment[]" type="text" class="txt_field"><br>
<input name="bill_treatment[]" type="text" class="txt_field"></div>
<div class="span1">Cost<br>
<input name="bill_cost[]" id="billcost1" type="text" class="txt_field"><br>
<input name="bill_cost[]" id="billcost2" type="text" class="txt_field"><br>
<input name="bill_cost[]" id="billcost3" type="text" class="txt_field"><br>
<input name="bill_cost[]" id="billcost4" type="text" class="txt_field"></div>
<div class="span2">Amount Paid<br>
<input name="bill_amountpaid[]" type="text" class="txt_field"><br>
<input name="bill_amountpaid[]" type="text" class="txt_field"><br>
<input name="bill_amountpaid[]" type="text" class="txt_field"><br>
<input name="bill_amountpaid[]" type="text" class="txt_field"></div>
<div class="span2">By Whom?<br>
<input name="bill_by_whom[]" type="text" class="txt_field"><br>
<input name="bill_by_whom[]" type="text" class="txt_field"><br>
<input name="bill_by_whom[]" type="text" class="txt_field"><br>
<input name="bill_by_whom[]" type="text" class="txt_field"></div>
<div class="span2">Balance<br>
<input name="bill_balance[]" type="text" class="txt_field"><br>
<input name="bill_balance[]" type="text" class="txt_field"><br>
<input name="bill_balance[]" type="text" class="txt_field"><br>
<input name="bill_balance[]" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span5 total_txt">Total</div>
<div class="span1"><input name="total_cost" id="totalcost" type="text" class="txt_field"></div>
<div class="span2"><input name="total_amount_paid" type="text" class="txt_field"></div>
<div class="span2"><input name="" type="hidden" class="txt_field"></div>
<div class="span2"><input name="total_balance" type="text" class="txt_field"></div>
</div>

<div class="gen_app_div">
		<p class="span2">Surgery(ies)?</p>
		<p class="span1"><input id="surgury_y" name="surgury2" type="radio" value="yes">Yes</p>
		<p class="span1"><input id="surgury_n" name="surgury2" type="radio" value="no">No</p>
		<div id="surgery1" style="display:none;">
		<p class="span2">If Yes, Date(s):</p>
		<p class="span3"><input name="surgury_date" type="text" class="txt_field"></p>
		<p class="span1">Type(s):</p>
		<p class="span2"><input name="surgery_type" type="text" class="txt_field"></p>
		</div>
</div>
<div class="gen_app_div">
<p class="span2">Diagnostic Tests?</p>
<p class="span1"><input id="diagnostic_y" name="diagnostic" type="radio" value="yes">Yes</p>
<p class="span1"><input id="diagnostic_n" name="diagnostic" type="radio" value="no">No</p>
<div id="diagnostic_tests" style="display:none;"><p class="span2">Type of test:</p>
<p class="span2"><input name="type_of_diagnostic" type="text" class="txt_field"></p>
<p class="span1">Result:</p>
<p class="span3"><input name="diagnostice_results" type="text" class="txt_field"></p>
</div>
</div>
<div class="gen_app_div">
<p class="row-fluid">Prior collisions, incidents, injuries or pre-existing conditions, if any, regardless of whether resulted
in claimllawsuit:</p>
<p class="row-fluid"><input name="prior_collision" type="text" class="txt_field"></p>
</div>
<div class="gen_app_div">
<p class="row-fluid">Subsequent collisions, incidents, or injuries, if any, regardiess of whether resulted claim/lawsuit:</p>
<p class="row-fluid"><input name="collisions" type="text" class="txt_field"></p>
</div>
	<div class="gen_app_div">
		<p class="span4">Client have health insurance?</p>
		<p class="span1"><input id="health_insurance_y" name="health_insurance" type="radio" value="yes">Yes</p>
		<p class="span1 form_div_left"><input id="health_insurance_n" name="health_insurance" type="radio" value="no">No</p>
		<div id="health_insurance" style="display:none">
			<p class="span4">If so, has it paid any of the expenses?</p>
			<p class="span1"><input id="expenses_y" name="expenses" type="radio" value="yes">Yes</p>
			<p class="span1"><input id="expenses_n" name="expenses" type="radio" value="no">No</p>
		</div>
	</div>
	<div id="insurance_amount" style="display:none;">
		<div class="gen_app_div">
			<div class="span7 form_div_left">
				List all current liens against the case (Medicare, Worker's Comp,
				Soc Sec, Settlement Advance Companies, VA, TriCare, etc.)?
			</div>
			<div class="span5">
				<p class="span4">Amount?</p>
				<p class="span8">
					<input name="amount_health" type="text" class="txt_field">
				</p>
			</div>
		</div>
	</div>
</div>
</div>
<h3>STATUS OF CLAIM</h3>
<div id="application_form">
	<div class="row-fluid">
		<div class="gen_app_div">
			<p class="span2">ls case in suit?</p>
			<p class="span2"><input id="suit_y" name="plantiffstatus_claim_suit" type="radio" value="yes">Yes</p>
			<p class="span2"><input id="suit_n" name="plantiffstatus_claim_suit" type="radio" value="no">No</p>
			
			<p class="span6">If Yes, please provide the following information:</p>
		</div>
		<div id="suit_y_y">
		<div class="gen_app_div">
			<p class="span4">Title of Action (if commenced):</p>
			<p class="span8"><input name="plantiffstatus_claim_action_title" type="text" class="txt_field"></p>
		</div>
		<div class="gen_app_div">
			<p class="span4">Index/Cause Number:</p>
			<p class="span8"><input name="plantiffstatus_claim_index_no" type="text" class="txt_field"></p>
		</div>
		<div class="gen_app_div">
			<p class="span1">Venue:</p>
			<p class="span2"><input name="plantiffstatus_claim_venue" type="text" class="txt_field"></p>
			<p class="span1">State</p>
			<p class="span2"><input name="plantiffstatus_claim_state" type="text" class="txt_field"></p>
			<p class="span1">Supreme</p>
			<p class="span2"><input name="plantiffstatus_claim_supreme" type="text" class="txt_field"></p>
			<p class="span1">Federal</p>
			<p class="span2"><input name="plantiffstatus_claim_federal" type="text" class="txt_field"></p>
		</div>
	
		<div class="gen_app_div">
			<p class="span2">Trial Date:</p>
			<p class="span1"><input id="trial_date_y" name="plantiffstatus_claim_trial_date" type="radio" value="yes">Yes</p>
			<div style="display:none;" id="date_trial">
				<div class="span4">
					<p class="span4">Date:</p>
					<p class="span8"><input name="plantiffstatus_claim_date" type="date" class="txt_field"></p>
				</div>
			</div>
			<p class="span2"><input id="trial_date_n" name="plantiffstatus_claim_trial_date" type="radio" value="no">No</p>
			<div id="projected_date" style="display:none">
				<p class="span2">Projected Date</p>
				<p class="span2"><input name="plantiffstatus_claim_projected_date" type="date" class="txt_field"></p>
			</div>
		</div>
		</div>
	</div>
</div>
	<div id="application_form">
		<div class="row-fluid">
			<div class="gen_app_div">
				<h3>PLEASE ALSO PROVIDE THE FOLLOWING, IF AVAILABLE:</h3>
				<strong>Main documents needed to moye the case to underwriting</strong><br>
				1. ACCIDENT ROPORTS<br>
				Z. ALL MEDICAL RECORDS<br>
				3. ALL MEDICAL BILLS<br><br>
				PLEASE FAX COMPLETED APPLICATION To: <strong>1-800-865-8691</strong><br>
				OR EMAIL TO: <a href="mailto:INFO@MAYOSURGICAL.COM">INFO@MAYOSURGICAL.COM</a>
				<div class="app_btn_area"><input type="submit" value="Submit" name="plantiffinfor" class="app_btn"></div>
			</div>
		</div>
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


