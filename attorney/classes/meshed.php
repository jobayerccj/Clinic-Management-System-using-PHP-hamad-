<?php
ini_set('display_errors',1);  
error_reporting(E_ALL);
 Class Meshed extends Allfunctions
 {
	 public  $sitepath;
	 public  $plantiff_name;
	 public  $date_reg;
	 public  $mobile_no;    
	 public	 $home_no;       
	 public	 $office_no;      
	 public	 $email_address;   
	 public	 $d_o_b;        
	 public	 $driving_licence; 
	 public	 $user_address;   
	 public  $user_state;  
	 public	 $user_city; 
	 public	 $zip_code;
	 public	 $doctor_name;
	 private $getemail;
	 public  $u_name;
	 public  $getemail1;
	 public $client_email;
	 
	 /* 
	  * Step Form 2 
	  */
	public $firmname;
	public $address;
	public $phone;
	public $fax;
	public $contactp; 
	public $position;
	public $p_email;
	public $other_documents_m;
	public $travel_m;
	public $medical_bills_m;  
	public $medical_records_m;
	public $product_label_m;
	public $s_m_r_f_m; 

	 /*Step 2 ortho
	  * */
	public $um_uim_o;   
	public $um_uim2_o;
	public $bankruptcy_o;
	public $firm_o;
	public $o_address_o;
	public $phone_o;
	public $fax_o;
	public $firm_contact_p_o;
	public $position_o;
	public $contact_email_o;
	public $defendent_name_o;
	public $insurance_company_o;
	public $claim_no_o;
	public $limits_o;
	public $date_of_injury_o;
	public $desc_event_o;
	public $location_event_o;
	public $desc_injury_o;
	public $police_report_o_o;
	public $other_injured_o;
	public $witness_o;
	
	public $s_m_r_r_f_o;
	public $other_records_o;
	public $travel_bills_o;
	public $medical_records_o;
	public $medial_bill_o ;
	public $police_report_oo;
	
	public function getIdByUname()
	{
		$s_username       = $_SESSION['username'];
		$sql              = mysql_query("SELECT `id` FROM `members` where `user_name`='$s_username'") or die(mysql_error());
		$username         = mysql_fetch_array($sql);
		return $username['id'];
	}
	
	function OldUser($case_type,$auto_insurance,$ssn)
	{
		/*
		* Check user from members table 
		*/
		$this->u_name;
		$this->plantiff_name;
		$this->date_reg;
		$this->mobile_no;    
		$this->home_no;    
		$this->office_no;      
		$this->email_address;   
		$this->d_o_b;        
		$this->driving_licence; 
		$this->user_address;   
		$this->user_state;  
		$this->user_city; 
		$this->zip_code;
		$this->doctor_name;
		$this->getemail1;
		$this->client_email;

		$check_user = mysql_query("SELECT `id` from `members` where `email_id`='".$this->email_address."'") or die(mysql_error());
		$getemail_id = mysql_fetch_array($check_user);
		$getemail    = $getemail_id['id'];
		if(mysql_num_rows($check_user)>=1)
		{
			$this->UserExist($getemail,$case_type,$auto_insurance,$ssn);
		}
		else
		{ 
			$this->UserNotExist($case_type,$auto_insurance,$ssn);	 
		}
	}
	 
	 private function UserExist($getemail,$case_type,$auto_insurance,$ssn)
	 {
		 
		$p_info = mysql_query("INSERT INTO `plantiff_information` (`id`,`plantiff_name`,`p_date`,`p_mob_no`,`p_home_no`,
			 `p_office_no`,`p_email_address`,`p_d_o_b`,`p_driving_licence`,`p_address`,`p_state`,`p_city`,`p_zip_code`,`p_preferred_coice`,`case_type`,`auto_insurance`,`client_email`) 
			 VALUES ('".$getemail."',
			 '".$this->plantiff_name."',
			 '".$this->date_reg."',
			 '".$this->mobile_no."',
			 '".$this->home_no."',
			 '".$this->office_no."',
			 '".$this->email_address."',
			 '".$this->d_o_b."',
			 '".$this->driving_licence."',
			 '".$this->user_address."',
			 '".$this->user_state."',
			 '".$this->user_city."',
			 '".$this->zip_code."',
			 '".$this->doctor_name."',
			 '$case_type',
			 '$auto_insurance','".$this->client_email."')") or die(mysql_error());
			 
			 if($p_info)
			 {
				return true;
			 }
	 }
	 
	 private function UserNotExist($case_type,$auto_insurance,$ssn)
	 {
		 $this->Register($case_type,$auto_insurance,$ssn);
	 }
	 
	 private function Register($case_type,$auto_insurance,$ssn)
	 {
		 
		 $regis         = mysql_query("SELECT * FROM `members` where `email_id`='".$this->email_address."'") or die(mysql_error());
		 $register_user = mysql_query("SELECT `id` from `members` where `email_id`='".$this->email_address."'") or die(mysql_error());
		 
		 if(mysql_num_rows($register_user)>=1)
		 {
			 return false;
		 }
		 else
		 {
			 $chars      = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
			 $password   = substr( str_shuffle( $chars ),0,14 );
			 $passwordmd = md5($password);
			 $chars      = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
			 $uname      = substr( str_shuffle( $chars ), 0,4);
			 
			 /* Register member if not registered yet */
			 
			 $Insert = mysql_query("INSERT INTO `members` (`user_name`,`password`,`first_name`,`designation`,`email_id`,`user_ip`,`user_type`,`date_time`) 
			 VALUES ('".$this->u_name.$uname."',
			 '".md5($password)."',
			 '".$this->plantiff_name."',
			 '5',
			 '". $this->email_address."',
			 '".$_SERVER['REMOTE_ADDR']."',
			 '3',
			 now()) ") or die(mysql_error());
			 
			 /*
			  * 
			  * Get the New registered ID of the User
			  *
			  */
			  
			 $check_user1  = mysql_query("SELECT `id` from `members` where `email_id`='".$this->email_address."'") or die(mysql_error());
			 $getemail_id1 = mysql_fetch_array($check_user1);
			 $getemail1    = $getemail_id1['id'];
			 $datetime     = date("Y-m-d H:i:s a");
			 /* After successfull registration insert the userinfo in plantiff_information */
			 
			 $p_info = mysql_query("INSERT INTO `plantiff_information` (`id`,`plantiff_name`,`p_date`,`p_mob_no`,`p_home_no`,
			 `p_office_no`,`p_email_address`,`p_d_o_b`,`p_driving_licence`,`p_address`,`p_state`,`p_city`,`p_zip_code`,`p_preferred_coice`,`case_type`,
			 `auto_insurance`,`ssn_no`,`client_email`) 
			 VALUES ('".$getemail1."',
			 '".$this->plantiff_name."',
			 '".$this->date_reg."',
			 '".$this->mobile_no."',
			 '".$this->home_no."',
			 '".$this->office_no."',
			 '".$this->email_address."',
			 '".$this->d_o_b."',
			 '".$this->driving_licence."',
			 '".$this->user_address."',
			 '".$this->user_state."',
			 '".$this->user_city."',
			 '".$this->zip_code."',
			 '".$this->doctor_name."',
			 '$case_type',
			 '$auto_insurance',
			 '$ssn','".$this->client_email."')") or die(mysql_error());
			 
			 $this->MailtoUser($uname,$password);
		 }
		 
	 }
	 
	 private function MailtoUser($uname,$password)
	 {
		 
		 $subject = "Mayo Surgical";
		 $message = "<html><body>";
		 $message.="<img src='http://mayosurgical.com/images/logo.png' alt='Username/Password'>";
		 $message.="</body></html>";
		 $message.='<table rules="all" style="border-color: #666;" cellpadding="10">';
		 $message.="<tr style='background: #eee;'><td colspan='2'>Hi ".$this->plantiff_name." <br/>Your Login Information</td></tr>";
		 $message.="<tr style='background: #eee;'><td colspan='2'>Automatically Created Username and Password</td></tr>";
		 $message.="<tr style='background: #eee;'><td><strong>Username:</strong> </td><td>".$this->u_name.$uname."</td></tr>";
		 $message.="<tr style='background: #eee;'><td><strong>Password:</strong> </td><td>".$password."</td></tr>";
		 $message.="</table>";
		 $headers = "From: Mayo Surgical\r\n";
		 $headers.= "CC: nordiff.com\r\n";
		 $headers.= "MIME-Version: 1.0\r\n";
		 $headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		 $mail    = mail($this->email_address,$subject,$message,$headers);
		 if($mail)
		 {
			 return true;
		 }
		 else
		 {
			 return false;
		 }	  
	 }
	 
	  public function getFormId($formid)
	 {
		$tempform         = mysql_query("SELECT max(form_id) as `id` from `plantiff_information` where `p_email_address`='$formid'") or die(mysql_error());
		$form_id          = mysql_fetch_array($tempform);
		$data = $form_id['0'];
		return $data;
	 } 
	 
	 public function UserId($formid)
	 {
		 $temp_user       = mysql_query("SELECT `id` FROM `members` where `email_id`='$formid'") or die(mysql_error());
		 $user_id         = mysql_fetch_row($temp_user);
		 return $user_id['0'];
	 }
	 
	 public function MeshedStep($form_id,$user_id,$att_id,$case_type)
	 {
		 $this->firmname;
		 $this->address;
		 $this->phone;
		 $this->fax;
		 $this->contactp; 
		 $this->position;
		 $this->p_email;
		 $this->other_documents_m;
	     $this->travel_m;
		 $this->medical_bills_m;  
		 $this->medical_records_m;
		 $this->product_label_m;
		 $this->s_m_r_f_m; 
		 $datetime = date("Y-m-d H:i:s a");
		 $step2    = mysql_query("INSERT INTO `plantiff_case_type_info` 
		 (`form_id`,`id`,`attorney_id`,`att_firm`,`att_address`,`att_phone`,`att_fax`,`att_contact_person`,
		 `att_position`,`att_email`,`signed_medical_records`,`product_label`,`medical_record`,`medial_bill`,`travel_bills`,`other`,`case_type`,`date_time`) 
		 VALUES ('$form_id','$user_id','$att_id',
		 '".$this->firmname."',
		 '".$this->address."',
		 '".$this->phone."',
		 '".$this->fax."',
		 '".$this->contactp."',
		 '".$this->position."',
		 '".$this->p_email."',
		 '".$this->s_m_r_f_m."',
		 '".$this->product_label_m."',
		 '".$this->medical_records_m."',
		 '".$this->medical_bills_m."',
		 '".$this->travel_m."',
		 '".$this->other_documents_m."',
		 '$case_type',
		 '$datetime')") or die(mysql_error());
		 $insertTemp = mysql_query("INSERT INTO `temp_data` (`form_id`) VALUES ('$form_id')") or die(mysql_error());
		 return true;		 
	 }
	
	 public function OrthoStep($form_id,$user_id,$att_id,$case_type)
	 {		
	 
			$this->um_uim_o;
			$this->um_uim2_o;
			$this->bankruptcy_o;
			$this->firm_o;
			$this->o_address_o;
			$this->phone_o;
			$this->fax_o;
			$this->firm_contact_p_o;
			$this->position_o;
			$this->contact_email_o;
			$this->defendent_name_o;
			$this->insurance_company_o;
			$this->claim_no_o;
			$this->limits_o;
			$this->location_event_o;
			$this->date_of_injury_o;
			$desc_event = trim($this->desc_event_o);
			$this->location_event_o;
			$desc_injury = trim($this->desc_injury_o);
			$this->police_report_o_o;
			$this->other_injured_o;
			$this->witness_o;
			$this->s_m_r_r_f_o;
			$this->other_records_o;
			$this->travel_bills_o;
			$this->medical_records_o;
			$this->medial_bill_o;
			$this->police_report_oo;
			
			$datetime = date("Y-m-d H:i:s a");
			$qry = "INSERT INTO `plantiff_case_type_info` (`form_id`,`id`,`attorney_id`,`um_uim`,`client_bankrupty`,`att_firm`
			,`att_address`,`att_phone`,`att_fax`,`att_contact_person`,`att_position`,`att_email`,`defendant_name`,`insurance_company`,`claim_no`,
			`d_limits`,`date_injury`,`location_of_event`,`description_of_event`,`description_of_injury`,`police_report`,`others_injured_too`,
			`witness`,`signed_medical_records`,`police_accident_report`,`medical_record`,`medial_bill`,`travel_bills`,`other`,`case_type`,`date_time`)
			 VALUES ('$form_id','$user_id','$att_id','".$this->um_uim_o."','".$this->bankruptcy_o."','".$this->firm_o."','".$this->o_address_o."',
			 '".$this->phone_o."','".$this->fax_o."','".$this->firm_contact_p_o."','".$this->position_o."','".$this->contact_email_o."',
			 '".$this->defendent_name_o."','".$this->insurance_company_o."','".$this->claim_no_o."','".$this->limits_o."',
			 '".$this->date_of_injury_o."','".$this->location_event_o."','$desc_event','$desc_injury',
			 '".$this->police_report_o_o."',
			 '".$this->other_injured_o."',
			 '".$this->witness_o."',
			 '".$this->s_m_r_r_f_o."',
			 '".$this->police_report_oo."',
			 '".$this->medical_records_o."',
			 '".$this->medial_bill_o."',
			 '".$this->travel_bills_o."',
			 '".$this->other_records_o."',
			 '".$case_type."','$datetime')";
			
			$temportho = mysql_query($qry) or die(mysql_error());
			$insertTemp = mysql_query("INSERT INTO `temp_data` (`form_id`) VALUES ('$form_id')") or die(mysql_error());
			 
			 if($temportho)
			 {
				 return true;
			 }
			 else
			 {
				 return false;
			 }
		 
	 }
	 
	 function DisplayProfile($att_username)
	 {
		 $temp_display = mysql_query("SELECT * FROM `members` where `user_name`='$att_username'") or die(mysql_error());
		 $profile      = mysql_fetch_object($temp_display);
		 $datetime     = $profile->date_time;
		 $n_date       = date('d-M-Y', strtotime($datetime));
		 $n_time       = date('H:i', strtotime($datetime));
		 return '<div class="slide_left">
			<h1>Client Information</h1>
			<div class="slide_top_bar">
				<div class="side_row">
					<div class="slide_row_left">
						<label>Client Name</label>
					</div>
					<div class="slide_row_right">
						<label>'.ucwords($profile->first_name).'&nbsp; '.ucwords($profile->last_name).'</label>
					</div>
				</div>
				<div class="side_row">
					<div class="slide_row_left">
						<label>Email Address</label>
					</div>
					<div class="slide_row_right">
						<label>'.$profile->email_id.'</label>
					</div>
				</div>
				<div class="side_row">
					<div class="slide_row_left">
						<label>Organization</label>
					</div>
					<div class="slide_row_right">
						<label>'.ucwords($profile->organisation).'</label>
					</div>
				</div>
				<div class="side_row">
					<div class="slide_row_left">
						<label>Starting Date</label>
					</div>
					<div class="slide_row_right">
						<label>'.$n_date.'</label>
					</div>
				</div>
				
			</div>
		</div>';
	 }
	 
	 function UserList()
	 {?>

<div class="slide_right">
  <div class="attorney_box_bg">
    <div class="attorney_row_heading">
      <div class="attorney_monitor_1">Date</div>
      <div class="attorney_monitor_2">Application Stage</div>
      <div class="attorney_monitor_3">Discription</div>
      <div class="attorney_monitor_4">Case Type</div>
      <div class="attorney_monitor_5">Action</div>
    </div>
    <?php
		 $u_id = $this->getIdByUname();
		 $get_data = mysql_query("SELECT a . * , b . * FROM  `plantiff_information` AS a,  `plantiff_case_type_info` AS b
									WHERE a.form_id = b.form_id
AND a.id = b.id
AND attorney_id =$u_id") or die(mysql_error());
while($get_data1=mysql_fetch_object($get_data))
{
?>
    <div class="attorney_row_content">
      <div class="attorney_monitor_1"><?php echo $get_data1->p_date; ?></div>
      <div class="attorney_monitor_2">Mayo Surgical</div>
      <div class="attorney_monitor_3">joham_william gmail com joham_william </div>
      <div class="attorney_monitor_4"> <span class="pending_status">Approve</span> </div>
      <div class="attorney_monitor_5"> <a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
        <button class="message_button">view</button>
        </a> </div>
    </div>
    <?php
	}
?>
  </div>
</div>
<?php
	 
 }
 public function Populatedata($my_data)
 {
	 $u_id = $this->getIdByUname();
	 $temp_email = mysql_query("SELECT a.p_email_address, b.* FROM  `plantiff_information` AS a,  `plantiff_case_type_info` AS b
									WHERE a.form_id = b.form_id
AND a.id = b.id
AND attorney_id = '$u_id' AND `p_email_address` LIKE '%$my_data%'") or die(mysql_error());
while($us_email = mysql_fetch_object($temp_email))
{
	return $us_email->p_email_address."\n";
}

 }
 function GetState()
 {
 ?>
<select name="user_state">
  <option value="">...Select...</option>
  <?php
			$state_d = mysql_query("SELECT * FROM `states`") or die(mysql_error());
			while($stateslist = mysql_fetch_object($state_d))
			{
		?>
  <option value="<?php echo $stateslist->state_code; ?>"><?php echo $stateslist->state; ?></option>
  <?php
		} 
		?>
</select>
<?php
 }
 
	function getstats($state){
		$state_d = mysql_query("SELECT * FROM `states`") or die(mysql_error());
		while($stateslist = mysql_fetch_object($state_d))
		{
	?>
<option value="<?php echo $stateslist->state_code; ?>" <?php if(isset($state) && $state == $stateslist->state_code) { echo "selected=selected" ;} ?>><?php echo $stateslist->state; ?></option>
<?php
		} 
	}
	function getdesignation($designation){
		$qrudesg = mysql_query("SELECT * FROM `sub_designation`") or die(mysql_error());
		while($desig = mysql_fetch_object($qrudesg))
		{
	?>
<option value="<?php echo $desig->id; ?>" <?php if(isset($designation) && $designation == $desig->id) { echo "selected=selected" ;} ?>><?php echo $desig->sub_designation_name; ?></option>
<?php
		} 
	}
	
	function getcasetype($casetype){
		$qrudesg = mysql_query("SELECT * FROM `type_of_cases`") or die(mysql_error());
		while($desig = mysql_fetch_object($qrudesg))
		{
	?>
<option value="<?php echo $desig->case_id; ?>" <?php if(isset($casetype) && $casetype == $desig->case_id) { echo "selected=selected" ;} ?>><?php echo $desig->name_of_case; ?></option>
<?php
		}
	}
	
	function documentMessages($attorneys_id)
	{
?>
<div class="dashbord_client">
  <?php
			$temp_getinfo = mysql_query("SELECT * FROM `documents_messages` WHERE `main_user_id`='$attorneys_id' && `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
			if(mysql_num_rows($temp_getinfo)>0)
			{
		?>
  <h1>Pending Documents</h1>
  <div class="client_box_bg">
    <div class="client_row_heading">
      <div class="client_span_1">Client No.</div>
      <div class="client_span_2">Client Name</div>
      <div class="client_span_3">Message</div>
      <div class="client_span_5">Application Date</div>
      <div class="client_span_6">Action</div>
    </div>
    <?php
			while($f_getinfo= mysql_fetch_object($temp_getinfo))
			{
				$user_ids = $f_getinfo->user_id;
		?>
    <div class="client_row_content">
      <div class="client_span_1"><?php echo $f_getinfo->form_id; ?></div>
      <div class="client_span_2">
        <?php 
			echo $name = $this->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
		?>
      </div>
      <div class="client_span_3"><?php echo $f_getinfo->documents_messages; ?></div>
      <div class="client_span_5">
		<?php 
			$date = $f_getinfo->date_document; 
			echo $dattime = date('m-d-Y',strtotime($date));
		?>
      </div>
      <div class="client_span_6">
         <a href="other-documents.php?fid=<?php echo $_REQUEST['fid']; ?>&id=<?php echo $_REQUEST['uid']; ?>&cid=<?php echo $_REQUEST['cid']; ?>&action=upload">Upload Documents</a>
      </div>
    </div>
    <?php
			}
			?>
  </div>
  <?php
		}
		?>
</div>
<?php
	}
	function uploadDocuments()
	{
?>
<div class="attorney_client_info">
  <h1>Uploaded Client Documents</h1>
  <div class="anesth_box_bg">
    <div class="anesth_row_heading">
      <div class="anesth_span_1">Client No</div>
      <div class="anesth_span_2">Document Type</div>
      <div class="anesth_span_3">Document Name</div>
      <div class="anesth_span_4">Uploaded Date</div>
      <div class="anesth_span_5">View</div>
    </div>
    <?php
				$temp_uploads   = mysql_query("select a.id,b.* from members as a,upload_documents as b where a.id=b.attorney_id and a.designation!=6 and a.designation!=3 and `user_id` = '$_REQUEST[uid]' && `form_id` = '$_REQUEST[fid]' && `related_to` !=  'Estimate of Doctor and Facilities Charges'") or die(mysql_error());
				if(mysql_num_rows($temp_uploads)>0)
				{
				while($uploads  = mysql_fetch_object($temp_uploads))
				{
			?>
    <div class="anesth_row_content">
      <div class="anesth_span_1">
        <?=$uploads->form_id;?>
      </div>
      <div class="anesth_span_2">
        <?=$uploads->related_to;?>
      </div>
      <div class="anesth_span_3">
        <?=$uploads->name_of_document;?>
      </div>
      <div class="anesth_span_4">
        <?php $uDate = $uploads->upload_date; echo date('m-d-Y',strtotime($uDate)); ?>
      </div>
	  <?php $sitepa = "http://".$_SERVER['HTTP_HOST']; ?>
      <div class="anesth_span_5"><a href="download.php?filename=<?=$uploads->upload_document_path;?>&fid=<?php echo $uploads->form_id; ?>">Download</a></div>
    <?php
				}
			}
			else
			{
				echo "<h2 style='text-align:center'>No Documents are Available</h2>";
			}
			?>
  </div>
</div>
<?php
	}
	/* meshed case for case_id=2,4*/
	function meshedView($row)
	{
?>
<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="attorney_client_info">
  <h1>Client Information</h1>
<div class="view_client_row">
  <div class="client_left">
    <label>Client Name</label>
    <label class="filled_label"><?php echo $row['plantiff_name']; ?></label>
  </div>
  <div class="client_right">
    <label>Date</label>
    <label class="filled_label"><?php $p_date = $row['p_date']; list($a,$b) = explode(" ",$p_date); echo $a; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Mobile No.</label>
    <label class="filled_label"><?php echo $row['p_mob_no']; ?></label>
  </div>
  <div class="client_right">
    <label>Home No.</label>
    <label class="filled_label"><?php echo $row['p_home_no']; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Office No.</label>
    <label class="filled_label"><?php echo $row['p_office_no']; ?></label>
  </div>
  <div class="client_right">
    <label>Email Address</label>
    <label class="filled_label"><?php echo $row['client_email']; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Date of Birth</label>
    <label class="filled_label"><?php echo $row['p_d_o_b']; ?></label>
  </div>
  <div class="client_right">
    <label>Driving License</label>
    <label class="filled_label"><?php echo $row['p_driving_licence']; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_right"><label>Address</label>
  <label class="filled_label"><?php echo $row['p_address']; ?></label>
</div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>State</label>
    <label class="filled_label">
    <?php 
		$m_state = $row['p_state']; 
		if($m_state!=""){ echo $state1 = $this->GetStatebyStateCode($m_state); }
	?>
    </label>
  </div>
  <div class="client_right">
    <label>City</label>
    <label class="filled_label"><?php echo $row['p_city']; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Zip Code</label>
    <label class="filled_label"><?php echo $row['p_zip_code']; ?></label>
  </div>
  <div class="client_right">
    <label>Preferred Choice of Doctor</label>
    <label class="filled_label"><?php echo $row['p_preferred_coice']; ?></label>
  </div>
</div>
  <div class="view_client_row">
    <h1>Attorney / Case Manager Information</h1>
    <div class="view_client_row">
      <div class="client_left">
      <label>Firm</label>
      <label class="filled_label"><?php echo $row['att_firm']; ?></label>
      </div>
    </div>
    <div class="view_client_row">
     <div class="client_left">
      <label>Address</label>
      <label class="filled_label"><?php echo $row['att_address']; ?></label>
      </div>
    </div>
    <div class="view_client_row">
      <div class="client_left">
        <label>Phone</label>
        <label class="filled_label"><?php echo $row['att_phone']; ?></label>
      </div>
      <div class="client_right">
        <label>Fax</label>
        <label class="filled_label"><?php echo $row['att_fax']; ?></label>
      </div>
    </div>
    <div class="view_client_row">
      <div class="client_left">
        <label>Firm Contact Person</label>
        <label class="filled_label"><?php echo $row['att_contact_person']; ?></label>
      </div>
      <div class="client_right">
        <label>Position</label>
        <label class="filled_label"><?php echo $row['att_position']; ?></label>
      </div>
    </div>
      <div class="client_left">
        <label>Contact E-mail</label>
        <label class="filled_label"><?php echo $row['att_email']; ?></label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Please also provide the following, if Available</h1>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Signed Medical Records Release Form</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label" id="upload">
	  <?php
		$path = $this->sitepath= "http://".$_SERVER['HTTP_HOST'];
		$signed_medical_records = $row['signed_medical_records'];
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	  ?>
        <input type="radio" name="signed_medical" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=sm')" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
       <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "Uploaded"; }else{echo "Upload";} ?>
	<?php
		}
		else
		{
	?>
		<input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
        Download
	<?php
		}
	?>
		</label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="n/a"){ echo "checked"; } ?> id=""/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="will fax"){ echo "checked"; } ?> id=""/>
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Product Label</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php 
		$product_label = $row['product_label'];
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	  ?>
        <input type="radio" name="police_report" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=pl')" value="<?=$product_label?>" id="" <?php if(isset($product_label) && $product_label=="download"){ echo "checked"; } ?> />
        <?php if(isset($product_label) && $product_label=="download"){ echo "Uploaded"; }else{ echo "Upload";} ?> </label>
	<?php	
		}
		else
		{
	?>
		<input type="radio" name="police_report" value="<?=$product_label?>" id="" <?php if(isset($product_label) && $product_label=="download"){ echo "checked"; } ?> />
        Download </label>
	<?php
		}
	?>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$product_label?>" id=""<?php if(isset($product_label) && $product_label=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$product_label?>" id="" <?php if(isset($product_label) && $product_label=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
 
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Records</label>
    </div>
  
    <div class="form_field_right">
      <label class="checkbox_label">
	 <?php 
		$medical_record = $row['medical_record']; 
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	?>
        <input type="radio" name="medical_records" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=mr')" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
        <?php if(isset($medical_record) && $medical_record=="download"){ echo "Uploaded"; }else{echo "Upload";} ?></label>
	<?php
		}
		else
		{
	?>
		<input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
        Download </label>
	<?php
		}
	?>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <h1>Optional Documents</h1>
    <div class="form_field_left">
      <label>Travel Bills</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php 
		$travel_bill=$row['travel_bills']; 
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	?>
        <input type="radio" name="travel_bills" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=tb')" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "Uploaded"; }else{ echo "Upload"; } ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  
    <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Bill</label>
    </div>

    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php 
		$medical_bi = $row['medial_bill']; 
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	?>
        <input type="radio" name="medical_bill" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ml')" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
		
	<?php
		}
		else
		{
	?>
		 <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "Uploaded"; }else{ echo "Upload"; } ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="n/a"){ echo "checked"; } ?>/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Other</label>
    </div>
   
    <div class="form_field_right">
      <label class="checkbox_label">
		 <?php 
			$other_bill = $row['other'];
			if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
			{
		?>
			<input type="radio" name="other_records" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ob')" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?>/>
		<?php
			}
		?>
        <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "Uploaded"; }else{echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
</div>
<?php
	}
	
	/*ortho case for case_id=1,3,5*/
	
	function orthoView($row)
	{
?>
<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="attorney_client_info">
  <h1>Client Information</h1>
  <div class="view_client_row">
    <div class="client_left">
      <label>Client Name</label>
      <label class="filled_label"><?php echo $row['plantiff_name']; ?></label>
    </div>
    <div class="client_right">
      <label>Date</label>
      <label class="filled_label"><?php list($date,$time) = explode(" ",$row['p_date']); echo $date; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Mobile No.</label>
      <label class="filled_label"><?php echo $row['p_mob_no']; ?></label>
    </div>
    <div class="client_right">
      <label>Home No.</label>
      <label class="filled_label"><?php echo $row['p_home_no']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Office No.</label>
      <label class="filled_label"><?php echo $row['p_office_no']; ?></label>
    </div>
    <div class="client_right">
      <label>Email Address</label>
      <label class="filled_label"><?php echo $row['client_email']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Date of Birth</label>
      <label class="filled_label"><?php echo $row['p_d_o_b']; ?></label>
    </div>
    <div class="client_right">
      <label>Driving License</label>
      <label class="filled_label"><?php echo $row['p_driving_licence']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
    <label>Address</label>
    <label class="filled_label add_area"><?php echo $row['p_address']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>State</label>
      <label class="filled_label">
        <?php 
					$o_state = $row['p_state']; 
					if($o_state!=""){ echo $statess = $this->GetStatebyStateCode($o_state);}
				?>
      </label>
    </div>
    <div class="client_right">
      <label>City</label>
      <label class="filled_label"><?php echo $row['p_city']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Zip Code</label>
      <label class="filled_label"><?php echo $row['p_zip_code']; ?></label>
    </div>
    <div class="client_right">
      <label>Preferred Choice of Doctor</label>
      <label class="filled_label"><?php echo $row['p_preferred_coice']; ?></label>
    </div>
  </div>
  <!--<div class="view_client_row">
    <div class="client_left">
    <label>Auto Insurance Carrier (Auto collision only)</label>
    <label class="filled_label">1<?php //echo $row['auto_insurance']; ?></label>
    </div>
  </div>-->
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Attorney / Case Manager Information</h1>
  <div class="view_client_row">
   <div class="client_left">
    <label>Firm</label>
    <label class="filled_label"><?php echo $row['att_firm']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
    <label>Address</label>
    <label class="filled_label add_area"><?php echo $row['att_address']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Phone</label>
      <label class="filled_label"><?php echo $row['att_phone']; ?></label>
    </div>
    <div class="client_right">
      <label>Fax</label>
      <label class="filled_label"><?php echo $row['att_fax']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Firm Contact Person</label>
      <label class="filled_label"><?php echo $row['att_contact_person']; ?></label>
    </div>
    <div class="client_right">
      <label>Position</label>
      <label class="filled_label"><?php echo $row['att_position']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Contact E-mail</label>
      <label class="filled_label"><?php echo $row['att_email']; ?></label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Defendant Insurance Information ( information is needed whether or not in suit)</h1>
  <div class="view_client_row">
    <div class="client_left">
    <label>Defendant Name</label>
    <label class="filled_label"><?php echo $row['defendant_name']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
    <label>Insurance Company</label>
    <label class="filled_label"><?php echo $row['insurance_company']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Claim No</label>
      <label class="filled_label"><?php echo $row['claim_no']; ?></label>
    </div>
    <div class="client_right">
      <label>Bodily Injury Limits</label>
      <label class="filled_label"><?php echo $row['d_limits']; ?></label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Incident Information</h1>
  <div class="view_client_row">
    <div class="client_left">
    <label>Date of Injury</label>
    <label class="filled_label"><?php echo $row['date_injury']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
   <div class="client_left">
    <label>Location of Event</label>
    <label class="filled_label"><?php echo $row['location_of_event']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Description of the Event</label>
      <label class="filled_label"><?php echo $row['description_of_event']; ?></label>
    </div>
    <div class="client_right">
      <label>Specify Body Part to be Evaluated</label>
      <label class="filled_label"><?php echo $row['description_of_injury']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="attorney_left">
      <div class="form_field_left">
        <label>UM / UIM</label>
      </div>
      <?php $check = $row['um_uim']; ?>
      <div class="form_field_right">
        <label class="checkbox_label">
          <input type="radio" name="um_uim1" value="<?= $check ?>" <?php if(isset($check) && $check == "yes"){ echo "checked";} ?> />
          Yes </label>
        <label class="checkbox_label">
          <input type="radio" name="um_uim2" value="<?= $check ?>" <?php if(isset($check) && $check =="no") { echo "checked"; } ?> />
          No </label>
        <label class="checkbox_label">
          <input type="radio" name="um_uim3" <?php if(isset($check) && $check =="n/a") echo "checked"; ?> value="<?php echo $row['um_uim'];?>"   id="" />
          N/A </label>
      </div>
    </div>
  </div>
  <div class="view_client_row">
    <div class="attorney_left">
      <div class="form_field_left">
        <label>Client ever claim bankruptcy ?</label>
      </div>
      <?php
		$bankrupty = $row['client_bankrupty'];
	  ?>
      <div class="form_field_right">
        <label class="checkbox_label">
          <input type="radio" name="bankruptcy1" value="<?= $bankrupty ?>" <?php if(isset($bankrupty) && $bankrupty == "yes"){echo "checked";}?>  />
          Yes </label>
        <label class="checkbox_label">
          <input type="radio" name="bankruptcy2" value="<?= $bankrupty ?>" <?php if(isset($bankrupty) && $bankrupty == "no"){echo "checked";}?> />
          No </label>
        <label class="checkbox_label">
          <input type="radio" name="bankruptcy3" value="<?= $bankrupty ?>" <?php if(isset($bankrupty) && $bankrupty == "n/a"){echo "checked";}?> />
          N/A </label>
      </div>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info" id="upload">
  <h1>Please also provide the following, if Available</h1>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Signed Medical Records Release Form</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  	<?php
			$signed_medical_records = $row['signed_medical_records'];
			$path = $this->sitepath= "http://".$_SERVER['HTTP_HOST'];
			if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
			{
		?>
			<input type="radio" name="signed_medical" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=sm')" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
		<?php 
			}
			else
			{ 
		?>
			<input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
		<?php 
			} 
		?>
        <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "Uploaded"; }else {echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="n/a"){ echo "checked"; } ?> id=""/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="will fax"){ echo "checked"; } ?> id=""/>
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Police Report</label>
    </div>
    <?php $polic_acc_rep = $row['police_accident_report']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	 <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=pr')" name="police_report" value="<?=$polic_acc_rep?>" id="" <?php if(isset($polic_acc_rep) && $polic_acc_rep=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="police_report" value="<?=$polic_acc_rep?>" id="" <?php if(isset($polic_acc_rep) && $polic_acc_rep=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        <?php if(isset($polic_acc_rep) && $polic_acc_rep=="download"){ echo "Uploaded"; }else{ echo "Upload"; } ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$polic_acc_rep?>" id=""<?php if(isset($polic_acc_rep) && $polic_acc_rep=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$polic_acc_rep?>" id="" <?php if(isset($polic_acc_rep) && $polic_acc_rep=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Bill</label>
    </div>
    <?php $medical_bi = $row['medial_bill']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	 <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" name="medical_bill" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ml')" value="<?=$medical_bi?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="medical_bill" value="<?=$medical_bi?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "Uploaded"; }else{echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$medical_bi?>" id="" <?php if(isset($medical_bi) && $medical_bi=="n/a"){ echo "checked"; } ?>/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$medical_bi?>" id="" <?php if(isset($medical_bi) && $medical_bi=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Records</label>
    </div>
    <?php $medical_record = $row['medical_record']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
			<input type="radio" name="medical_records" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=mr')" value="<?=$medical_record?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
			<input type="radio" name="medical_records" value="<?=$medical_record?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
	<?php 
		} 
	?>
       <?php if(isset($medical_record) && $medical_record=="download"){ echo "Uploaded"; }else{echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$medical_record?>" <?php if(isset($medical_record) && $medical_record=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$medical_record?>" <?php if(isset($medical_record) && $medical_record=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <div class="view_client_row">
    <h1>Optional Documents</h1>
    <div class="form_field_left">
      <label>Travel Bills</label>
    </div>
    <?php $travel_bill=$row['travel_bills']; ?>
    <div class="form_field_right">
      <label class="checkbox_label"> 
	 <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" name="travel_bills" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=tb')" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
       <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "Uploaded"; }else{echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Other</label>
    </div>
    <?php $other_bill = $row['other']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ob')" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "Uploaded"; }else{ echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
</div>
<?php
}	
	/*Medical records Request case for case_id=6*/
	
	function medicalView($row)
	{
?>
<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="attorney_client_info">
    <h1>Client Information</h1>
  <div class="view_client_row">
    <div class="client_left">
      <label>Client Name</label>
      <label class="filled_label"><?php echo $row['plantiff_name']; ?></label>
    </div>
    <div class="client_right">
      <label>Date</label>
      <label class="filled_label"><?php list($date,$time) = explode(" ",$row['p_date']); echo $date; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Mobile No.</label>
      <label class="filled_label"><?php echo $row['p_mob_no']; ?></label>
    </div>
    <div class="client_right">
      <label>Home No.</label>
      <label class="filled_label"><?php echo $row['p_home_no']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Office No.</label>
      <label class="filled_label"><?php echo $row['p_office_no']; ?></label>
    </div>
    <div class="client_right">
      <label>Email Address</label>
      <label class="filled_label"><?php echo $row['client_email']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Date of Birth</label>
      <label class="filled_label"><?php echo $row['p_d_o_b']; ?></label>
    </div>
    <div class="client_right">
      <label>Driving License</label>
      <label class="filled_label"><?php echo $row['p_driving_licence']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <label>Address</label>
    <label class="filled_label add_area"><?php echo $row['p_address']; ?></label>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>State</label>
      <label class="filled_label">
        <?php 
						$m_state = $row['p_state']; 
						if($m_state!=""){ echo $state1 =$this->GetStatebyStateCode($m_state);}
					?>
      </label>
    </div>
    <div class="client_right">
      <label>City</label>
      <label class="filled_label"><?php echo $row['p_city']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Zip Code</label>
      <label class="filled_label"><?php echo $row['p_zip_code']; ?></label>
    </div>
    <div class="client_right">
      <label>Preferred Choice of Doctor</label>
      <label class="filled_label"><?php echo $row['p_preferred_coice']; ?></label>
    </div>
  </div>
</div>

<div class="attorney_client_info">
  <div class="view_client_row">
    <h1>Client Attorney’s Information</h1>
    <div class="view_client_row">
      <label>Firm</label>
      <label class="filled_label"><?php echo $row['att_firm']; ?></label>
    </div>
    <div class="view_client_row">
      <label>Address</label>
      <label class="filled_label"><?php echo $row['att_address']; ?></label>
    </div>
    <div class="view_client_row">
      <div class="client_left">
        <label>Phone</label>
        <label class="filled_label"><?php echo $row['att_phone']; ?></label>
      </div>
      <div class="client_right">
        <label>Fax</label>
        <label class="filled_label"><?php echo $row['att_fax']; ?></label>
      </div>
    </div>
    <div class="view_client_row">
      <div class="client_left">
        <label>Firm Contact Person</label>
        <label class="filled_label"><?php echo $row['att_contact_person']; ?></label>
      </div>
      <div class="client_right">
        <label>Position</label>
        <label class="filled_label"><?php echo $row['att_position']; ?></label>
      </div>
    </div>
    <div class="view_client_row">
      <div class="client_left">
        <label>Contact E-mail</label>
        <label class="filled_label"><?php echo $row['att_email']; ?></label>
      </div>
    </div>
  </div>
</div>
 <div class="view_client_row" id="upload">
    <div class="form_field_left">
      <label>Signed Medical Records Release Form</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  	<?php
			$signed_medical_records = $row['signed_medical_records'];
			$path = $this->sitepath= "http://".$_SERVER['HTTP_HOST'];
			if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
			{
		?>
			<input type="radio" name="signed_medical" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=sm')" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
		<?php 
			}
			else
			{ 
		?>
			<input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
		<?php 
			} 
		?>
        <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "Uploaded"; }else {echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="n/a"){ echo "checked"; } ?> id=""/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="will fax"){ echo "checked"; } ?> id=""/>
        Will Fax </label>
    </div>
  </div>
<div class="attorney_client_info">
<?php
	//echo "SELECT * FROM `medial_records_request` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'";
	$sqls = mysql_query("SELECT * FROM `medial_records_request` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
	if(mysql_num_rows($sqls)>0)
	{
		$i=1;
		while($data = mysql_fetch_object($sqls))
		{
?>
	<div class="view_client_row">
		<h1>Start Date of Service Form (<?php echo $i; ?>)</h1>
		<div class="view_client_row">
		  <div class="client_left">
			<label>Start Date of Service</label>
			<label class="filled_label"><?php echo $data->s_date_service; ?></label>
		  </div>
		  <div class="client_right">
			<label>End Date of Service</label>
			<label class="filled_label"><?php echo $data->e_date_service; ?></label>
		  </div>
		</div>
		<div class="view_client_row">
		  <div class="client_left">
			<label>Facility or Physician's Name</label>
			<label class="filled_label">
			  <?php $facility = $data->facility_name; echo ucwords($facility); ?>
			</label>
		  </div>
		  <div class="client_right">
			<label>Office No</label>
			<label class="filled_label"><?php echo $data->office_no; ?></label>
		  </div>
		</div>
		<div class="view_client_row">
			<label>Address</label>
			<label class="filled_label add_area"><?php echo $data->address; ?></label>
		</div>
<div class="view_client_row">
  <div class="client_left">
    <label>State</label>
    <label class="filled_label">
      <?php $state = $data->state; echo ucwords($state); ?>
    </label>
  </div>
  <div class="client_right">
    <label>City</label>
    <label class="filled_label">
      <?php $city = $data->city; echo ucwords($city); ?>
    </label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Zip Code</label>
    <label class="filled_label"><?php echo $data->zip_code; ?></label>
  </div>
  <div class="client_left">
    <label>Notes- Type of Records to Order</label>
    <label class="filled_label"><?php echo $data->type_of_records_other; ?></label>
  </div>
</div>
</div>
<?php
			//print_r($data);
			$i++;
		}
	}
	else
	{
		echo "No Record Found";
	}
?>
</div>
<!--attorney_client_info_end-->
<?php
	}
		function statusShow()
	{
?>
	<div class="anesth_dashbord_client">
		<h1>Current Status</h1>
		<div class="anesth_box_bg">
			<div class="anesth_row_heading">
				<div class="anesth_span_1">Client No.</div>
				<div class="anesth_span_2">Client Name</div>
				<div class="anesth_span_3">Date of Birth</div>
				<div class="anesth_span_4">Date</div>
				<div class="anesth_span_5">Status</div>
			</div>
			<?php
				$temp_status = mysql_query("SELECT * FROM status_update WHERE form_id = '$_REQUEST[fid]' ORDER by id desc") or die(mysql_error());
				while($status = mysql_fetch_object($temp_status))
				{
			?>
				<div class="anesth_row_content">
					<div class="anesth_span_1"><?=$status->form_id?></div>
					<div class="anesth_span_2">
						<?php 
							$s_u_id = $status->user_id;
							echo $fname  = $this->GetObjectById($s_u_id,"first_name");
							echo $lname  = $this->GetObjectById($s_u_id,"last_name");
						?>
					</div>
					<div class="anesth_span_3"><?=$this->GetInfoPlantiffInformation("p_d_o_b",$_REQUEST['fid']);?></div>
					<div class="anesth_span_4"><?php echo date('m-d-Y',strtotime($status->date_status)); ?></div>
					<div class="anesth_span_4">
						<?=$status->status_messages?>
						<?php 
							if(!empty($status->status_notes))
							{
								echo '<div class="btn-group">
										<a class="btn btn-default" href="#" data-featherlight="#fl'.$status->id.'" data-featherlight-variant="fixwidth">See Notes</a>
									  </div>';
								echo '<div class="lightbox" id="fl'.$status->id.'">
											<h2>Note</h2>
											<p>'.$status->status_notes.'</p>
									  </div>';
							}
						?>
					</div>
				</div>
			<?php
				}
			?>
		</div>
	</div>
<?php
	}
	function popUp()
	{
?>	
		<script src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
		<script src="../popup/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
		<link href="../popup/featherlight.min.css" rel="stylesheet" type="text/css"/>
		<link href="../popup/style.css" rel="stylesheet" type="text/css"/>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//stats.g.doubleclick.net/dc.js','ga');
			ga('create', 'UA-5342062-6', 'noelboss.github.io');
			ga('send', 'pageview');
		</script>
<?php
	}
}
?>
