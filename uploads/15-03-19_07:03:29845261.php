<?php
session_start();
require_once('../../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include($config);
include_once '../../functions.php';
include_once '../class.php';
include_once '../classes/plantiff.php';
$user_id = $_GET['id'];
if(loggedin())
{
	include('../header.php');
?>
<link rel="stylesheet" href="../admin-style.css" type="text/css">
<link rel="stylesheet" href="<?php echo $appcss; ?>" type="text/css">
<section class="row">
	<div class="container">
		<form name="plantiff" id="plantiff_app" method="post" action="" enctype="multipart/form-data">
			<div id="main_div">
<h2>APPLICATION</h2>
<h3>PLAINTIFF'S INFORMATION</h3>
<div id="application_form">
	<div class="row-fluid">
		<div class="gen_app_div">
			<?php 
				$user_info = mysql_query("SELECT * FROM `plantiff_information` where `id`='$_GET[id]'") or die(mysql_error());
				$row = mysql_fetch_object($user_info);
			 ?>
			<div class="span2">Plaintiff Name:</div>
			<div class="span4"><?php $name = $row->plantiff_name; echo ucwords($name); ?><span class="error"></span></div>
			<div class="span2">Date Completed:</div>
			<div class="span4"><?php echo $row->date_completed; ?></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Address:</div>
			<div class="span10"><?php echo $row->address; ?></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Work Phone:</div>
			<div class="span4"><?php echo $row-> work_phone; ?></div>
			<div class="span2">Date of Birth:</div>
			<div class="span4"><?php echo $row->d_o_b; ?></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Home Phone:</div>
			<div class="span4"><?php echo $row->home_phone; ?></div>
			<div class="span2">Driver\"s" License:</div>
			<div class="span4"><?php echo $row->driver_licence; ?></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Mobile Phone:</div>
			<div class="span4"><?php echo $row->mobile_phone; ?></div>
			<div class="span2">E-mail:</div>
			<div class="span4"><?php echo $row->e_mail; ?></div>
		</div>
		<div class="gen_app_div">
			<div class="span4">Auto Insurance Carrier (auto collisions only):</div>
			<div class="span8"><?php echo $row->auto_insurance; ?></div>
		</div>
		<div class="gen_app_div">
			<div class="span6 form_div_left">
				<p class="span3">UM/UIM</p>
				<?php
					if(!empty($row->um_uim))
					{
				?>
				<p class="span2">Yes</p>
				<div id="um_uim_l">
					<div class="span5">
						<p class="span3">Limits</p>
						<p class="span9"><?php echo $row->um_uim; ?></p>
						<?php
							}
							else
							{
						?>
						<p class="span2">No</p>
						<?php
							}
						?>
					</div>
				</div>
			</div>
			<div class="span6">
				<p class="span3">PIP/Med Pay?</p>
				<?php
					if(!empty($row->pip_med_pay))
					{
				?>
				<p class="span3">Yes</p>
				<?php
					}
					else
					{ 
				?>
				<p class="span3">No</p>
				<?php
					}
				?>
			</div>
		</div>
		<div class="gen_app_div">
			<div class="span3">Client ever claim bankruptcy?</div>
				<?php 
				if(!empty($row->client_bankrupty))
				{
				?>
				Yes
				<div class="span7">
				<div id="bankrupty_w">
					<p class="span2">When:</p><p class="span10">
						<?php echo $row->client_bankrupty; ?>
					</p>
				</div>
				<?php
				}
				else
				{
				?>
				No
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<h3>PLAINTIFF\'S ATTORNEY'S INFORMATION</h3>
<?php 
	$p_a_i = mysql_query("SELECT * FROM `plantiff_attorney_information` where `id`='$_GET[id]'") or die(mysql_error());
	$plantiff_attorney_i = mysql_fetch_object($p_a_i);
 ?>
<div id="application_form">
	<div class="row-fluid">
		<div class="gen_app_div">
			<div class="span2">Firm:</div>
			<div class="span10"><?php $firm = $plantiff_attorney_i-> a_firm; echo ucwords($firm); ?></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Address:</div>
			<div class="span10"><?php echo $plantiff_attorney_i-> a_address; ?> </div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Phone: ( )</div>
			<div class="span4"><?php echo $plantiff_attorney_i-> a_phone;?></div>
			<div class="span2">Fax: ( )</div>
			<div class="span4"><?php echo $plantiff_attorney_i-> a_fax; ?></div>
		</div>
		<div class="gen_app_div">
			<div class="span6">
				<div class="span4">Firm Contact Person:</div>
				<div class="span8"><?php echo $plantiff_attorney_i-> a_firm_contact_person; ?></div>
			</div>
			<div class="span6">
				<div class="span4">Position:</div>
				<div class="span4"><?php echo $plantiff_attorney_i-> a_position; ?></div>
			</div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Contact E-mail</div>
			<div class="span10"><?php echo $plantiff_attorney_i-> a_contact_e_mail; ?></div>
		</div>
	</div>
</div>
<h3>DEFENDANT'S INFORMAATION (lnsurance information is needed whether or not in suit)</h3>
<div id="application_form">
<div class="row-fluid">
<?php 
	$i=1;
	$defendant_info = mysql_query("SELECT * FROM `defendants_information` where `id`='$_GET[id]'") or die(mysql_error());
	while($defendant_info_d = mysql_fetch_object($defendant_info))
	{
?>
	<div class="gen_app_div">
		<div class="span2"><strong>Defendant Name (<?php echo $i; ?>):</strong></div>
		<div class="span10"><?php $def_name = $defendant_info_d->d_defendant_name; echo ucwords($def_name); ?></div>
	</div>
	<div class="gen_app_div">
		<div class="span3">Insurance Company (<?php echo $i; ?>):</div>
		<div class="span2"><?php $i_country = $defendant_info_d->d_insurance_company; echo ucwords($i_country); ?></div>
		<div class="span2">Claim No.:</div>
		<div class="span2"><?php $claim_no = $defendant_info_d->d_claim_no; echo ucwords($claim_no); ?></div>
		<div class="span1">Limits:</div>
		<div class="span2"><?php $limits = $defendant_info_d->d_limits; echo ucwords($limits); ?></div>
	</div>
<?php
$i++;
}
?>
</div>
</div>
<h3>INCIDENT INFORMATION</h3>
<?php
	$incident = mysql_query("SELECT * FROM `incident_information` where `id` = '$_GET[id]'") or die(mysql_error());
	$incident_information = mysql_fetch_object($incident);
?>
<div id="application_form">
	<div class="row-fluid">
		<div class="gen_app_div">
			<div class="span2">Date of Injury:</div>
			<div class="span4"><?php echo $incident_information -> i_injury_date; ?></div>
			<div class="span2">Location of the Event:</div>
			<div class="span4"><?php echo $incident_information -> event_location; ?></div>
		</div>
		<div class="gen_app_div">
			<div class="span3">Description of the Event:</div>
			<div class="span9"><?php echo $incident_information ->i_event_description; ?></div>
			<!--<div class="row-fluid"><input name="" type="text" class="txt_field"></div>-->
		</div>
		<div class="gen_app_div">
			<div class="span3">Description of injuries :</div>
			<div class="span9"><?php echo $incident_information -> i_injuries_description; ?></div>
		</div>
		<div class="gen_app_div">
			<div class="span3">Was there a police report?</div>
			<?php
				$report = $incident_information-> i_police_report;
				if(!empty($report))
				{
			?>
			<div class="span1">Yes</div>
			<div class="span7" id="attach_copy">
				<a href="<?php echo $sitepath.'/uploads/policereport/'.$report; ?>" target="_blank">Click here to download Document</a></div>
			</div>
			<?php
			}
			else
			{
			?>
			<div class="span1">No</div>
			<?php
			}
			?>
		<div class="gen_app_div">
			<div class="span3">Others injured too?</div>
			<?php
				$injured = $incident_information-> i_others_injured;
				if(!empty($injured))
				{
			?>
			<div class="span1">Yes</div>
				<div id="claim"><div class="span7">
				<p class="span9">lf yes, what\'s the value of his/her/their claim(s)?</p>
				<p class="span3"><?php echo $injured; ?></p></div></div>
		</div>
		<?php
			}
			else
			{
				echo '<div class="span1">No</div>';
			}
		?>
		<div class="gen_app_div">
			<div class="span3">Witness(es)?</div>
			<?php
				$witness = $incident_information-> i_others_injured;
				if(!empty($witness))
				{
			?>
			<div class="span1">Yes</div>
			<div id="witness_name">
				<div class="span5">
				<p class="span4">Name(s):</p>
				<p class="span8"><?php echo $witness;  ?></p>
			</div>
			<?php
				}
			?>
			</div>
		</div>
	</div>
</div>
<h3>MEDICAL TREATMENT &amp; BILLS TO DATE</h3>
<div id="application_form">
<div class="row-fluid">
<div class="gen_app_div">
<div class="span1">Date<br>
<?php 
	$bill_date             = mysql_query("SELECT * FROM `medical_treatment_bill_amount` where `id`='$_GET[id]'") or die(mysql_error());
	while($bill_date_info  = mysql_fetch_object($bill_date))
	{
?>
<?php echo $bill_date_info->date_amount; ?><br>
<?php
	}
?></div>
<div class="span2">Provider<br>
<?php 
	$amount_prov      = mysql_query("SELECT * FROM `medical_treatment_bill_amount` where `id`='$_GET[id]'") or die(mysql_error());
	while($amount_provider  = mysql_fetch_object($amount_prov))
	{
?>
<?php echo $amount_provider->amount_provider; ?><br>
<?php
	}
?></div>
<div class="span2">Treatment<br>
<?php 
	$amount_treat      = mysql_query("SELECT * FROM `medical_treatment_bill_amount` where `id`='$_GET[id]'") or die(mysql_error());
	while($amount_treatment  = mysql_fetch_object($amount_treat))
	{
?>
<?php echo $amount_treatment->amount_treatment; ?><br>
<?php
	}
?></div>
<div class="span1">Cost<br>
<?php 
	$cost      = mysql_query("SELECT * FROM `medical_treatment_bill_amount` where `id`='$_GET[id]'") or die(mysql_error());
	while($cost_amount  = mysql_fetch_object($cost))
	{
?>
<?php echo $cost_amount->amount_cost; ?><br>
<?php
	}
?>
</div>
<div class="span2">Amount Paid<br>
<?php 
	$amount     = mysql_query("SELECT * FROM `medical_treatment_bill_amount` where `id`='$_GET[id]'") or die(mysql_error());
	while($amount_paid  = mysql_fetch_object($amount))
	{
?>
<?php echo $amount_paid->amount_paid; ?><br>
<?php
	}
?>
</div>
<div class="span2">By Whom?<br>
<?php 
	$by_whom     = mysql_query("SELECT * FROM `medical_treatment_bill_amount` where `id`='$_GET[id]'") or die(mysql_error());
	while($by_whom_name  = mysql_fetch_object($by_whom))
	{
?>
<?php echo $by_whom_name->amount_by_whom; ?><br>
<?php
	}
?>
</div>
<div class="span2">Balance<br>
<?php 
	$balance           = mysql_query("SELECT amount_cost - amount_paid AS diff_cost FROM  `medical_treatment_bill_amount`") or die(mysql_error());
	while($get_balance = mysql_fetch_object($balance))
	{
		echo $get_balance->diff_cost ."<br>";
	}
?>
</div>
</div>
<div class="gen_app_div">
<div class="span5 total_txt">Total</div>
<div class="span1">
<?php 
	$total      = mysql_query("SELECT SUM(`amount_cost`) as total FROM `medical_treatment_bill_amount` WHERE id = '$_GET[id]'");
	$total_cost = mysql_fetch_object($total);
	echo $total_cost-> total;
?>
</div>
<div class="span2">
<?php 
	$amount_paid     = mysql_query("SELECT SUM(`amount_paid`) as total_cost FROM `medical_treatment_bill_amount` WHERE id = '$_GET[id]'");
	$amount_paid1 = mysql_fetch_object($amount_paid);
	echo $amount_paid1->total_cost;
?></div>
<div class="span2"><input name="" type="hidden" class="txt_field"></div>
<div class="span2">
<?php
	$total_balance = mysql_query("SELECT SUM( amount_cost - amount_paid ) AS total_balance FROM  `medical_treatment_bill_amount`") or die(mysql_error());
	$balance_total = mysql_fetch_row($total_balance);
	echo $balance_total[0];
?>
	</div>
</div>

<div class="gen_app_div">
		<p class="span2">Surgery(ies)?</p>
		<?php 
			$surgery        = mysql_query("SELECT * FROM `medical_treatment_bill_surgury` WHERE id = '$_GET[id]'");
			$surgery1       = mysql_fetch_object($surgery);
			$surgery_result = $surgery1->surgery;
			if($surgery_result=="yes")
			{
		?>
			<p class="span1">Yes</p>
			
		
		<div id="surgery1">
		<p class="span2">If Yes, Date(s):</p>
		<p class="span3"><?php echo $surgery1->surgery_date; ?></p>
		<p class="span1">Type(s):</p>
		<p class="span2"><?php echo $surgery1->surgery_type; ?></p>
		<?php
			}
			else
			{
		?>
		<p class="span1">No</p>
		<?php
			}
		?>
		</div>
</div>
<div class="gen_app_div">
<p class="span2">Diagnostic Tests?</p>
<?php 
	$diagnostic_values         = mysql_query("SELECT * FROM `medical_treatment_bill_surgury` WHERE id = '$_GET[id]'");
	$diagnostic_result         = mysql_fetch_object($diagnostic_values);
	$diagnostic_e              = $surgery1->surgery;
	if($diagnostic_e == "yes")
	{
?>
<p class="span1">Yes</p>
<div id="diagnostic_tests"><p class="span2">Type of test:</p>
<p class="span2"><?php echo $diagnostic_result->type_of_test; ?></p>
<p class="span1">Result:</p>
<p class="span3"><?php echo $diagnostic_result->result; ?></p>
<?php
}
else
{
?>
<p class="span1">No</p></p>
<?php
}
?>
</div>
</div>
<div class="gen_app_div">
<p class="row-fluid">Prior collisions, incidents, injuries or pre-existing conditions, if any, regardless of whether resulted
in claimllawsuit:</p>
<p class="row-fluid"><?php echo $diagnostic_result->prior_collisions; ?></p>
</div>
<div class="gen_app_div">
<p class="row-fluid">Subsequent collisions, incidents, or injuries, if any, regardiess of whether resulted claim/lawsuit:</p>
<p class="row-fluid"><?php echo $diagnostic_result->subsequent_collisions; ?></p>
</div>
	<div class="gen_app_div">
		<p class="span4">Client have health insurance?</p>
		<?php
			if(($diagnostic_result->client_insurance)=="yes")
			{
		?>
		<p class="span1">Yes</p>
		<div id="health_insurance">
			<p class="span4">If so, has it paid any of the expenses?</p>
			<p class="span1"><?php echo $diagnostic_result->insurance_expenses; ?></p>
		</div>
		<?php
			}
			else
			{
		?>
			<p class="span1">No</p>
		<?php
			}
		?>
	</div>
	<div id="insurance_amount"	>
		<div class="gen_app_div">
			<div class="span7 form_div_left">
				List all current liens against the case (Medicare, Worker\"s" Comp,
				Soc Sec, Settlement Advance Companies, VA, TriCare, etc.)?
			</div>
			<div class="span5">
				<p class="span4">Amount?</p>
				<p class="span8">
					<?php echo $diagnostic_result->amount_all; ?>
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
			<?php
				$claim = mysql_query('SELECT * FROM `status_claim` where `id`="'.$_GET[id].'"') or die(mysql_error());
				$claim_suit = mysql_fetch_object($claim);
				echo $claim_suit->s_action_title;
				if(!empty($claim_suit->s_action_title))
				{
			?>
			<p class="span2">Yes</p>
			<p class="span6">If Yes, please provide the following information:</p>
		</div>
		<div id="suit_y_y">
		<div class="gen_app_div">
			<p class="span4">Title of Action (if commenced):</p>
			<p class="span8"><?php echo $claim_suit->s_action_title;?></p>
		</div>
		<div class="gen_app_div">
			<p class="span4">Index/Cause Number:</p>
			<p class="span8"><?php echo $claim_suit->s_index_number; ?></p>
		</div>
		<div class="gen_app_div">
			<p class="span1">Venue:</p>
			<p class="span2"><?php echo $claim_suit->s_venue; ?></p>
			<p class="span1">State</p>
			<p class="span2"><?php echo $claim_suit->s_state; ?></p>
			<p class="span1">Supreme</p>
			<p class="span2"><?php echo $claim_suit->s_supreme; ?></p>
			<p class="span1">Federal</p>
			<p class="span2"><?php echo $claim_suit->s_federal; ?></p>
		</div>
	
		<div class="gen_app_div">
			<p class="span2">Trial Date:</p>
				<?php
					if(!empty($claim_suit->s_trial_date))
					{
				?>
				<p class="span1">Yes</p>
				<div id="date_trial">
					<div class="span4">
						<p class="span4">Date:</p>
						<p class="span8"><?php echo $claim_suit->s_trial_date; ?></p>
					</div>
				</div>
				<?php
					}
					elseif(!empty($claim_suit->projected_date))
					{
				?>
				<p class="span2"><input id="trial_date_n" name="plantiffstatus_claim_trial_date" type="radio" value="no">No</p>
				<div id="projected_date">
					<p class="span2">Projected Date</p>
					<p class="span2"><?php echo $claim_suit->projected_date; ?></p>
					</div>
					</div>
					</div>
				<?php
					}
				}
				else
				{
			?>
			<p class="span2">No</p>
			<?php
				}
		?>
			</div>
		</div>
		</form>
		<form name="accept_plantiff" method="post" action="">
		<div class="button_bg">
			<ul>
				<li><div id="accept" class="accpet_button">Click Here to Accept</div></li>
				<li><div id="decline" class="accpet_button">Click Here to Decline</div></li>
				<li><div id="delete" class="accpet_button">Click Here to Delete</div></li>
			</ul>
			<!--Only accept is working-->
			<div id="accept_plantiff" style="display:none;">
				<!--Multiselect for Doctors-->
				<div class="accept_row">
					<h3>Case type:</h3>
					<label>Ortho</label>
					<input type="radio" name="case-type" value="Ortho">
					<label>Meshed-Case</label>
					<input type="radio" name="case-type" value="Meshed-Case">
				</div>
				<div class="accept_row">	
					<p>Choose Doctors:</p>
					<select name="choose-doctors" multiple>
						<?php
							$doctors = mysql_query("SELECT * FROM  `members` WHERE  `designation` !=  'Plaintiff (Injured Party)' &&  `designation` !=  'admin'") or die(mysql_error());
						    while($doctors_list = mysql_fetch_array($doctors))
						    {
						 ?>
						       <option value="<?php echo $doctors_list['id']; ?>"><?php echo $doctors_list['first_name'].$doctors_list['last_name']; ?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="accept_row">	
					<p>Message to Doctor:</p>
					<textarea name="message-doctor"></textarea>
				</div>
				<div class="accept_row">				
					<p>Message to Plantiff:</p>
					<textarea name="message-doctor"></textarea>
					<input type="button" name="Accept" value="Accept">
				</div>	
			</div>
			<!-- Accept ends here -->
			
			<!--Decline button for plantiff-->
			<div id="decline-plantiff" style="display:none;">
				Reason to Decline:<textarea name="message-doctor"></textarea>
				<input type="button" name="Decline" value="Decline">
			</div>
			<!-- Decline ends here -->
			
			<!--Delete button for plantiff-->
			<div id="delete-plantiff" style="display:none;">
				<input type="button" name="Delete" value="Delete">
			</div>
			<!--Delete button ends here-->
		</div>
	</form>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function()
			{
				$("#accept").click(function()
				{
					$("#accept_plantiff").toggle('slow');
				});
				$("#decline").click(function()
				{
					$("#decline-plantiff").toggle('slow');
				});
				$("#delete").click(function()
				{
					$("#delete-plantiff").toggle('slow');
				});
			});
		</script>
		<?php
			/*if(isset($_POST['Accept']))
			{
				
			}
			if(isset($_POST['Decline']))
			{
				
			}
			if(isset($_POST['Delete']))
			{
				
			}*/
		?>
</section>
<?php
include($get_footer);
}
else
{
header('Location:../../login.php');
}
?>


