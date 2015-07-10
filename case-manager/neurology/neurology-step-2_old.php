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
$a = $_SESSION['username'];
$data1 = $_SESSION['email'];

$meshednew          = new Meshed();
$att_id        = $meshednew->getIdByUname();
$form_id       = $meshednew->getFormId($data1);
$user_id       = $meshednew->UserId($data1);
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
				required:true,
				minlength: 3,
				alpha: true
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
				minlength: 3,
				alpha: true
				},
			auto_insure:{
				required:true,
				minlength: 3,
				alpha: true
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
				minlength: 3,
				number:true,
				minlength:10,
				maxlength:10
				},
			
			fax:  {
				required:true,
				number:true
				},

			frm_contact:{
				required:true
				},
			
			position:{
				required:true,
				minlength: 3,
				alpha: true
				},

			contct_email:{
				required:true,
				email:true
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
				required:true
				},
			limits:{
				required:true
				},
			injury_date:{
				required:true
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
				alpha: "Only Characters are allowed"
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
				required: "Please Enter phone number"
				},
			fax:{
				required: "Please Enter fax"
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
		<h1>Neurological Step-2 Form</h1>
		<form name="ortho" id="ortho" method="post" action="">
			<div class="client_1">
				<div class="attorney_row">
					<h2>Client Information</h2>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<div class="form_field_left">
							<label>UM / UIM</label>
						</div>
						<div class="form_field_right">
							<label class="checkbox_label">
								<input type="checkbox" name="um_uim" value="yes" id=""/>Yes
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="um_uim" value="no" id=""/>No
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="um_uim" value="n/a" id=""/>N/A
							</label>
						</div>	
						
					</div>
					<div class="attorney_right">
						<div class="form_field_left">
							<label>UM / UIM</label>
						</div>
						<div class="form_field_right">
							<label class="checkbox_label">
								<input type="checkbox" name="um_uim2" value="yes" id=""/>Yes
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="um_uim2" value="no" id=""/>No
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="um_uim2" value="n/a" id=""/>N/A
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
								<input type="checkbox" name="bankruptcy" value="yes" id=""/>Yes
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="bankruptcy" value="no" id=""/>No
							</label>
							<label class="checkbox_label">
								<input type="checkbox" name="bankruptcy" value="n/a" id=""/>N/A
							</label>
							
						</div>
					</div>
				</div>
			</div><!--client_1_end-->
			<div class="client_2">
				<h2>Client's Attorney’s Information</h2>
				<div class="attorney_row">
					<label>Firm</label>
					<input type="text" required="required" name="firm" id="firm"/>
					<span class="error"></span>
					
				</div>
				<div class="attorney_row">
					<label>Address</label>
					<input type="text" required="required" name="frm_address" id="frm_address"/>
					<span class="error"></span>
					
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Phone</label>
						<input type="text" required="required" name="phone" id="phone"/>
						<span class="error"></span>
					
					</div>
					<div class="attorney_right">
						<label>Fax</label>
						<input type="text" required="required" name="fax" id="fax"/>
						<span class="error"></span>
					</div>
					
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Firm Contact Person</label>
						<input type="text" required="required" name="frm_contact" id="frm_contact"/>
						<span class="error"></span>
						
					</div>
					<div class="attorney_right">
						<label>Position</label>
						<input type="text" required="required" name="position" id="position"/>
						<span class="error"></span>
						
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Contact E-mail</label>
						<input type="text" required="required" name="contct_email" id="contct_email"/>
						<span class="error"></span>
						
					</div>
				</div>
			</div><!--client_2_end-->
			<div class="client_3">
				<h2>Defendant Infomation Insurance ( information is neededwhether or not in suit)</h2>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Defendent Name</label>
						<input type="text" required="required" name="dfndr_name" id="dfndr_name"/>
						<span class="error"></span>
						
					</div>
					<div class="attorney_right">
						<label>Insurance Company</label>
						<input type="text" required="required" name="insure_cmpny" id="insure_cmpny"/>
						<span class="error"></span>
						
					</div>
				</div>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Claim No.</label>
						<input type="text" required="required" name="claim_no" id="claim_no"/>
						<span class="error"></span>
						
					</div>
					<div class="attorney_right">
						<label>Limits</label>
						<input type="text" required="required" name="limits" id="limits"/>
						<span class="error"></span>
						
					</div>
				</div>
			</div><!--client_2_end-->
			<div class="client_3">
				<h2>Incident Information</h2>
				<div class="attorney_row">
					<div class="attorney_left">
						<label>Date of Injury</label>
						<input type="text" required="required" name="injury_date" id="injury_date"/>
						<span class="error"></span>
						
					</div>
					<div class="attorney_right">
						<label>Location of Event</label>
						<input type="text" required="required" name="event_location" id="event_location"/>
						<span class="error"></span>
						
					</div>
				</div>
				<div class="attorney_row">
					<label>Description of the Event</label>
					<textarea name="event_desc" id="event_desc"></textarea>
					
				</div>
				<div class="attorney_row">
					<label>Description of the Injury</label>
					<textarea name="injury_desc" id="injury_desc"></textarea>
					
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Was there a Police Report</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="checkbox" name="police_report" value="yes" id=""/>Yes
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="police_report" value="no" id=""/>No
						</label>
					
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Other injured too?</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="checkbox" name="other_injured" value="yes" id=""/>Yes
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="other_injured" value="no" id=""/>No
						</label>
					</div>
					
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Witness(es) ?</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="checkbox" name="witnesses" value="yes" id=""/>Yes
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="witnesses" value="no" id=""/>No
						</label>
						
					</div>
				</div>
			</div><!--client_3_end-->
			<div class="client_4">
				<h2>Please also provide the following, if Available</h2>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Product Label</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="checkbox" name="police_accident_report" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&u_id=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&case_id=5')" id=""/>Download 
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="police_accident_report" value="n/a" id=""/> N/A
						</label>
						<label class="checkbox_label"> 
							<input type="checkbox" name="police_accident_report" value="will fax" id=""/>Will Fax
						</label>
						
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Medical Record</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="checkbox" name="medical_record" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&u_id=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&case_id=5')" id=""/>Download 
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="medical_record" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="medical_record" value="will fax" id=""/>Will Fax
						</label>
						
					</div>
				</div>
				<div class="attorney_row">
					<div class="form_field_left">
						<label>Medical Bill</label>
					</div>
					<div class="form_field_right">
						<label class="checkbox_label">
							<input type="checkbox" name="medical_bill" value="download" onclick="window.open('<?php echo $sitepath; ?>/attorney/upload-documents.php?fid=<?php echo $form_id; ?>&u_id=<?php echo $user_id; ?>&att_id=<?php echo $att_id; ?>&case_id=5')" id=""/>Download 
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="medical_bill" value="n/a" id=""/>N/A
						</label>
						<label class="checkbox_label">
							<input type="checkbox" name="medical_bill" value="will fax" id=""/>Will Fax
						</label>
						
					</div>
				</div>
			</div><!--client_4_end-->
			<div class="client_5">
				<div class="attorney_row">
					<input type="submit" name="submit" id="submit" value="Submit"/>
				</div>	
			</div>
			
		</form>
		</div>
		
		<?php
		if(isset($_REQUEST['submit']))
		{
			$meshednew->um_uim_o                    = $_REQUEST['um_uim'];
			@$meshednew->um_uim2_o                  = $_REQUEST['um_uim2'];
			$meshednew->bankruptcy_o                = $_REQUEST['bankruptcy'];
			$meshednew->firm_o                      = $_REQUEST['firm'];
			$meshednew->o_address_o                 = $_REQUEST['frm_address'];
			$meshednew->phone_o                     = $_REQUEST['phone'];
			$meshednew->fax_o                       = $_REQUEST['fax'];
			$meshednew->firm_contact_p_o            = $_REQUEST['frm_contact'];
			$meshednew->position_o                  = $_REQUEST['position'];
			$meshednew->contact_email_o             = $_REQUEST['contct_email'];
			$meshednew->defendent_name_o            = $_REQUEST['dfndr_name'];
			$meshednew->insurance_company_o         = $_REQUEST['insure_cmpny'];
			$meshednew->claim_no_o                  = $_REQUEST['claim_no'];
			$meshednew->limits_o					= $_REQUEST['limits'];
			$meshednew->date_of_injury_o            = $_REQUEST['injury_date'];
			$meshednew->desc_event_o                = $_REQUEST['event_desc'];
			$meshednew->location_event_o            = $_REQUEST['event_location'];
			$meshednew->desc_injury_o               = $_REQUEST['injury_desc'];
			$meshednew->police_report_o             = $_REQUEST['police_report'];
			$meshednew->other_injured_o             = $_REQUEST['other_injured'];
			$meshednew->witness_o                   = $_REQUEST['witnesses'];
			$meshednew->police_accident_report_o    = $_REQUEST['police_accident_report'];
			$meshednew->medical_record_o            = $_REQUEST['medical_record'];
			$meshednew->medial_bill_o               = $_REQUEST['medical_bill'];
			$meshednew->police_report_o             = $_REQUEST['police_report']; 
			$meshednew->medical_record_o            = $_REQUEST['medical_record'];
			$meshednew->medical_bill_o              = $_REQUEST['medical_bill'];
			$meshednew->user_email_o                = $_SESSION['email'];
			$case_type      = "4";
			$test = $meshednew->OrthoStep($form_id,$user_id,$att_id,$case_type);
			if($test=1)
			{
				"Form Successfully submitted";
			}
			else
			{
				"There is some problem Please retry later";
			}
		} 
		?>
</section>
<?php
require($get_footer);
}
else
{
	
header('Location:../../login.php');
	
}
?>
