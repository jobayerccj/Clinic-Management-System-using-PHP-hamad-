<?php
/* 
 *Plantiff class file
 * */
class Plantiff
	{
		/* 
		 * 
		 * Plantiff Information form stores the user information in plantiff_information table 
		 * 
		 * */
		
		function PlantiffRegister($user_id,$plantiff_name,$plantiff_date,$plantiff_address,$plantiff_workphone,$plantiff_dob,$plantiff_homephone,$plantiff_driverlicense,$plantiff_mobilephone,$plantiff_email,$plantiff_autoinsurance,$plantiff_UM_UIM,$plantiff_PIP_med_pay,$plantiff_client_bankrupty)
		{		
			$insert_plantiff = mysql_query("INSERT INTO `plantiff_information` (`id`,`plantiff_name`,`date_completed`,`address`,`work_phone`,`d_o_b`,`home_phone`,`driver_licence`,`mobile_phone`,`e_mail`,`auto_insurance`,
			`um_uim`,`pip_med_pay`,`client_bankrupty`) VALUES ('$user_id','$plantiff_name','$plantiff_date','$plantiff_address','$plantiff_workphone','$plantiff_dob','$plantiff_homephone','$plantiff_driverlicense',
			'$plantiff_mobilephone','$plantiff_email','$plantiff_autoinsurance','$plantiff_UM_UIM','$plantiff_PIP_med_pay','$plantiff_client_bankrupty')") or die(mysql_error());
		}
		
		/*
		 * 
		 * Attorney Information form stores user information in plantiff_attorney_information table 
		 * 
		 * */
		
		public function PlantiffAttorneyInformation($user_id,$plantiff_AttorneyInformation_firm,$plantiff_AttorneyInformation_address,$plantiff_AttorneyInformation_phone,$plantiff_AttorneyInformation_fax,$plantiff_AttorneyInformation_firm_contact,$plantiff_AttorneyInformation_position,$plantiff_AttorneyInformation_contact_email)
		{
			$insert_Attorney = mysql_query("INSERT INTO `plantiff_attorney_information` (`id`, `a_firm`, `a_address`, `a_phone`, `a_fax`, 
			`a_firm_contact_person`, `a_position`, `a_contact_e_mail`) VALUES ('$user_id','$plantiff_AttorneyInformation_firm','$plantiff_AttorneyInformation_address','$plantiff_AttorneyInformation_phone',
			'$plantiff_AttorneyInformation_fax','$plantiff_AttorneyInformation_firm_contact','$plantiff_AttorneyInformation_position',
			'$plantiff_AttorneyInformation_contact_email')") or die(mysql_error());
		}
		
		/*
		 * 
		 * Defendants information form stores user information in defendants_information table
		 * 
		 * 
		 * */
		
		public function Plantiffdefendants_information($user_id,$plantiffdefendants_information_name,$plantiffdefendants_information_company,$plantiffdefendants_information_claim,$plantiffdefendants_information_limits)
		{
			$countss = count($plantiffdefendants_information_name);
			for($i=0;$i<$countss;$i++)
			{
				if(!empty($plantiffdefendants_information_name[$i])||!empty($plantiffdefendants_information_company[$i])||!empty($plantiffdefendants_information_claim[$i])||!empty($plantiffdefendants_information_limits[$i]))
				{
					$insert_defendants_information = mysql_query("INSERT INTO `defendants_information` (`id`, `d_defendant_name`, `d_insurance_company`,
					`d_claim_no`, `d_limits`)
					 VALUES ('$user_id','".mysql_real_escape_string($plantiffdefendants_information_name[$i])."' , 
					 '".mysql_real_escape_string($plantiffdefendants_information_company[$i])."' , 
					 '".mysql_real_escape_string($plantiffdefendants_information_claim[$i])."',
					 '".mysql_real_escape_string($plantiffdefendants_information_limits[$i])."' )") or die(mysql_error());
				 }
			}
		}
		
		/*
		 * 
		 * 
		 * Incident information form stores information in incident_information
		 * 
		 * 
		 * */
				
		public function Plantiffincident_information($user_id,$plantiffincident_information_injury_date,$plantiffincident_information_event_location,
		$plantiffincident_information_event_description,$plantiffincident_information_injuries_description,$file_name,
		$plantiffincident_information_injured_claim,$plantiffincident_information_witnes_name,$file_name)
		{
			$insert_incident_information = mysql_query("INSERT INTO `incident_information` (`id`, `i_injury_date`, `event_location`,
			`i_event_description`, `i_injuries_description`, `i_police_report`, `i_others_injured`, `i_witness`) 
			VALUES ('$user_id','$plantiffincident_information_injury_date','$plantiffincident_information_event_location',
			'$plantiffincident_information_event_description','$plantiffincident_information_injuries_description',
			'$file_name','$plantiffincident_information_injured_claim','$plantiffincident_information_witnes_name')")
			 or die(mysql_error());
		}
		
		/*Plantiff Cost Information form below the incident information table stores the values in the medical_teatment_bill_amount*/
		
		public function PlantiffCostInformation($user_id,$bill_date,$bill_provider,$bill_treatment,$bill_cost,$bill_amountpaid,$bill_by_whom)
		{
			$p_total_am = count($bill_date);
			for($i=0;$i<=$p_total_am;$i++)
			{
				if(!empty($bill_date[$i])||!empty($bill_provider[$i])||!empty($bill_treatment[$i])||!empty($bill_cost[$i])||!empty($bill_amountpaid[$i])||!empty($bill_by_whom[$i]))
				{
					$plantiffcostinformation = mysql_query("INSERT INTO `medical_treatment_bill_amount`	
					(`id`,`date_amount`,`amount_provider`,`amount_treatment`,`amount_cost`,`amount_paid`,`amount_by_whom`) VALUES 
					('$user_id',
					'".mysql_real_escape_string($bill_date[$i])."',
					'".mysql_real_escape_string($bill_provider[$i])."',
					'".mysql_real_escape_string($bill_treatment[$i])."',
					'".mysql_real_escape_string($bill_cost[$i])."',
					'".mysql_real_escape_string($bill_amountpaid[$i])."',
					'".mysql_real_escape_string($bill_by_whom[$i])."')") or die(mysql_error());
				}
			}
		}
		
		/*Plantiff suregery information function stores only the the surgery information in the medical_treatment_bill_surgury table in db*/
		
		public function PlantiffSurgeryInformation($user_id,$surgury_re,$surgury_date1,$surgery_type1,$diagnostic,$type_of_diagnostic,$diagnostice_results,
		$prior_collison,$collisions,$health_insurance,$expenses,$amount_health)
		{
			
			$plantiffSurgeryInfor = mysql_query("INSERT INTO `medical_treatment_bill_surgury`(`id`,`surgery`,`surgery_date`,`surgery_type`,`diagnostic`,`type_of_test`,`result`,`prior_collisions`,`subsequent_collisions`,`client_insurance`,`insurance_expenses`,`amount_all`) VALUES ('$user_id','$surgury_re','$surgury_date1','$surgery_type1','$diagnostic','$type_of_diagnostic','$diagnostice_results','$prior_collison','$collisions','$health_insurance','$expenses','$amount_health')") or die(mysql_error());
			
			print_r($plantiffSurgeryInfor);
		}
		
		/*
		 * 
		 * 
		 * Status Claim function stores information status_claim
		 * 
		 * 
		 * */
		
		public function Plantiffstatus_claim($user_id,$plantiffstatus_claim_action_title,$plantiffstatus_claim_index_no,$plantiffstatus_claim_venue,$plantiffstatus_claim_state,$plantiffstatus_claim_supreme,$plantiffstatus_claim_federal,$plantiffstatus_claim_date,$plantiffstatus_claim_projected_date)
		{
			$insert_status_claim = mysql_query("INSERT INTO `status_claim`(`id`, `s_action_title`, `s_index_number`, `s_venue`, `s_state`, 
			`s_supreme`, `s_federal`, `s_trial_date`, `projected_date`) VALUES ('$user_id','$plantiffstatus_claim_action_title','$plantiffstatus_claim_index_no','$plantiffstatus_claim_venue','$plantiffstatus_claim_state','$plantiffstatus_claim_supreme','$plantiffstatus_claim_federal','$plantiffstatus_claim_date','$plantiffstatus_claim_projected_date')") or die(mysql_error());
		}
		
		/*Plantiff Information form end*/
		
		/*This function is used to insert information in plantiff_status_information table whether form is submitted successfully or not */
		
		public function PlantiffStatusInformation($user_id)
		{
			$plantiff_status_information = mysql_query("INSERT INTO `plantiff_status_information` (`id`,`form_filled`) VALUES ('$user_id',1)") or die(mysql_error());
		}
		
}
?>


