<?php
class UsersDetails
{
	/* function used to get the current username */

	public function current_user_id()
	{
		
		$session_username = $_SESSION['username'];
		
		$cookie_name = $_COOKIE['username'];
		
		$sql = mysql_query("SELECT `id` FROM `members` where `user_name`='$session_username' || `user_name`='$cookie_name'") or die(mysql_error());
		
		$username = mysql_fetch_row($sql);
		
		return $username[0];
		
	}
	
	/*
	 * function used to get the user-information that registration form is filled successfully or  not ?
	 * */
	
	public function ShowForm($user_id)
	{
		$showform   = mysql_query("SELECT `p_s_id` FROM `plantiff_status_information` where `id`='$user_id'") or die(mysql_error());
		$getmessage = mysql_query("SELECT * FROM `plantiff_status_information` where `id`='$user_id'") or die(mysql_error());
		$getstatus  = mysql_fetch_array($getmessage);
		if((mysql_num_rows($showform)>= 1) && ($getstatus['plantiff_status']==""))
		{
			echo '<h1>Form is Under Processing.<br/> You will get message from Mayo Shortly.</h1>';
		}
		elseif(!empty($getstatus['plantiff_status']))
		{
			echo '<h1>'.$getstatus['plantiff_status'].'</h1>';
		}
		else
		{
			$this->PlantiffForm();
		}
	}
	
	private function PlantiffForm()
	{
		echo '<form name="plantiff" id="plantiff_app" method="post" action="" enctype="multipart/form-data">
			<div id="main_div">
<h2>APPLICATION</h2>
<h3>PLAINTIFF\'S INFORMATION</h3>
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
			<div class="span2">Driver\"s" License:</div>
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
<h3>PLAINTIFF\'S ATTORNEY\'S INFORMATION</h3>
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
<h3>DEFENDANT\'S INFORMAATION (lnsurance information is needed whether or not in suit)</h3>
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
<p class="span9">lf yes, what\'s the value of his/her/their claim(s)?</p>
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
<input name="bill_cost[]" id="billcost1" type="text" id="bill_cost" class="cost txt_field"><br>
<input name="bill_cost[]" id="billcost2" type="text" id="bill_cost" class="cost txt_field"><br>
<input name="bill_cost[]" id="billcost3" type="text" id="bill_cost" class="cost txt_field"><br>
<input name="bill_cost[]" id="billcost4" type="text" id="bill_cost" class="cost txt_field"></div>
<div class="span2">Amount Paid<br>
<input name="bill_amountpaid[]" type="text" id="amount_paid" class="amount_paid txt_field"><br>
<input name="bill_amountpaid[]" type="text" id="amount_paid" class="amount_paid txt_field"><br>
<input name="bill_amountpaid[]" type="text" id="amount_paid" class="amount_paid txt_field"><br>
<input name="bill_amountpaid[]" type="text" id="amount_paid" class="amount_paid txt_field"></div>
<div class="span2">By Whom?<br>
<input name="bill_by_whom[]" type="text" class="txt_field"><br>
<input name="bill_by_whom[]" type="text" class="txt_field"><br>
<input name="bill_by_whom[]" type="text" class="txt_field"><br>
<input name="bill_by_whom[]" type="text" class="txt_field"></div>
<div class="span2">Balance<br>
<input name="bill_balance[]" type="text" class="balance_remain txt_field" onkeyup="balance();"><br>
<input name="bill_balance[]" type="text" class="balance_remain txt_field" onkeyup="balance();"><br>
<input name="bill_balance[]" type="text" class="balance_remain txt_field" onkeyup="balance();"><br>
<input name="bill_balance[]" type="text" class="balance_remain txt_field" onkeyup="balance();"></div>
</div>
<div class="gen_app_div">
<div class="span5 total_txt">Total</div>
<div class="span1"><div id="total_cost"></div></div>
<div class="span2"><div id="total_amount_paid"></div></div>
<div class="span2"><input name="" type="hidden" class="txt_field"></div>
<div class="span2"><div id="total_remain_balance"></div></div>
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
				List all current liens against the case (Medicare, Worker\"s" Comp,
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
		</form>'; 
	}
	
}
?>
