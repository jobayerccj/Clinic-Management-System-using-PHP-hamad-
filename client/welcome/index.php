<?php 
session_start();
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../../classes/login-functions.php');
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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.js"></script>
<script type="text/javascript">
	$(document).ready(function () 
	{
     //iterate through each textboxes and add keyup
     //handler to trigger sum event
     $(".cost").each(function () {	

         $(this).keyup(function () {
             calculateSum();
         });
     });
     $(".amount_paid").each(function () {	

         $(this).keyup(function () {
             calculateTotal();
         });
     });

 });
 function calculateSum() 
 {
     var sum = 0;
     //iterate through each textboxes and add the values
     $(".cost").each(function () {

         //add only if the value is number
         if (!isNaN(this.value) && this.value.length != 0) {
             sum += parseFloat(this.value);
         }
     });
     //.toFixed() method will roundoff the final sum to 2 decimal places
     $("#total_cost").html(sum.toFixed(3));
     var sumcost = sum.toFixed(3);
 }
  function calculateTotal() {

     var totalsum = 0;
     //iterate through each textboxes and add the values
     $(".amount_paid").each(function () {

         //add only if the value is number
         if (!isNaN(this.value) && this.value.length != 0) {
             totalsum += parseFloat(this.value);
         }
     });
     //.toFixed() method will roundoff the final sum to 2 decimal places
     $("#total_amount_paid").html(totalsum.toFixed(3));
     var totalamountpaid = totalsum.toFixed(3);
     $("#total_balance").innerHTML(sumcost-totalamountpaid);
 }
 function balance()
 {
	 var bill_cost   = document.getElementById('bill_cost').value;
	 var amount_cost = document.getElementById('amount_paid').value;
	 var sumtotal=0;
	 sumtotal = parseFloat(bill_cost)-parseFloat(amount_cost);
	 document.getElementById('total_remain_balance').innerHTML(sumtotal);
 }
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
	 
	$user_information               = new UsersDetails();

	$user_id                        = $user_information->current_user_id();

	$plantiffreg                    = new Plantiff();
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

		
		$plantiffregister               = $plantiffreg->PlantiffRegister($user_id,$plantiff_name,$plantiff_date,$plantiff_address,$plantiff_workphone,$plantiff_dob,$plantiff_homephone,$plantiff_driverlicense,$plantiff_mobilephone,$plantiff_email,$plantiff_autoinsurance,$plantiff_UM_UIM,$plantiff_PIP_med_pay,$plantiff_client_bankrupty);

		$PlantiffAttorneyInformation    = $plantiffreg->PlantiffAttorneyInformation($user_id,$plantiff_AttorneyInformation_firm,$plantiff_AttorneyInformation_address,$plantiff_AttorneyInformation_phone,$plantiff_AttorneyInformation_fax,$plantiff_AttorneyInformation_firm_contact,$plantiff_AttorneyInformation_position,$plantiff_AttorneyInformation_contact_email);

		$Plantiffdefendants_information = $plantiffreg->Plantiffdefendants_information($user_id,$plantiffdefendants_information_name,$plantiffdefendants_information_company,$plantiffdefendants_information_claim,$plantiffdefendants_information_limits);
		/*
		 * Used to upload the files in Uploads/policereport form */
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
		$Plantiffincident_information = $plantiffreg->Plantiffincident_information($user_id,$plantiffincident_information_injury_date,$plantiffincident_information_event_location,$plantiffincident_information_event_description,$plantiffincident_information_injuries_description,$plantiffincident_information_report,$plantiffincident_information_injured_claim,$plantiffincident_information_witnes_name,$file_name,$temp_name);
		$Plantiffstatus_claim         = $plantiffreg->Plantiffstatus_claim($user_id,$plantiffstatus_claim_action_title,$plantiffstatus_claim_index_no,$plantiffstatus_claim_venue,$plantiffstatus_claim_state,$plantiffstatus_claim_supreme,$plantiffstatus_claim_federal,$plantiffstatus_claim_date,$plantiffstatus_claim_projected_date);
		
		/*
		 * function call to medical_treatment_bill_amount
		 * */
		 
		$plantiff_treatment_bill      = $plantiffreg->PlantiffCostInformation($user_id,$bill_date,$bill_provider,$bill_treatment,$bill_cost,$bill_amountpaid,$bill_by_whom);
        $surgery_plantiff             = $plantiffreg->PlantiffSurgeryInformation($user_id,$surgury_re,$surgury_date1,$surgery_type1,$diagnostic,$type_of_diagnostic,$diagnostice_results,$prior_collison,$collisions,$health_insurance,$expenses,$amount_health);
		
		/*
		 * function call to store value 1 (If this form successfully stored)
		 * */
		 
		$plantiffstatusinformation    = $plantiffreg->PlantiffStatusInformation($user_id);
		
}
$plantiffform1 = $user_information->ShowForm($user_id); 
?>

	</div>
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


