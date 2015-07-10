<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); ?>"/></a>
</div>
<div class="attorney_client_info"><h1>Close Case</h1></div>
			<div class="dashbord_client">
				<div class="billing_box_bg">
					<script type="text/javascript">
						$(document).ready(function()
						{
							$('.confirmationd').click(function()
							{
								return confirm('Are You Sure?');
							});
						});
					</script>
<?php
					if(isset($_POST['update']))
					{
					$form=$_REQUEST['fid'];
					 $d_b_amount= $_POST['d_b_amount'];
					$d_p_received = $_POST['d_p_received'];
					$d_paid	 = $_POST['d_paid'];
					$m_f_b_amount= $_POST['m_f_b_amount'];
					$medicalReceived = $_POST['medical_facility_receive'];
					$m_f_p_paid  = $_POST['m_f_p_paid'];
					$anes_p_paid= $_POST['anes_p_paid'];
					$anes_b_amount= $_POST['anes_b_amount'];
					$anes_p_received= $_POST['anes_p_received'];
					$other_bill_amount= $_POST['other_bill_amount'];

					$other_payment_received= $_POST['other_payment_received'];
					$other_paid= $_POST['other_paid'];
						

					$query = "update billing_payment_information
					SET d_b_amount = '$d_b_amount', 
					d_p_received = '$d_p_received',
					d_paid ='$d_paid',
					m_f_b_amount ='$m_f_b_amount',
					m_f_p_received ='$medicalReceived',
					m_f_p_paid='$m_f_p_paid',
					anes_p_paid='$anes_p_paid',
					anes_b_amount='$anes_b_amount', 
					anes_p_received='$anes_p_received',
					other_bill_amount ='$anes_p_received',
					other_payment_received='$other_payment_received',
					other_paid='$other_paid'
					 
					 WHERE form_id = '$form'";
					$update=mysql_query($query) ;
					if($update)
					{
						echo "<div class='thank_message'>Record Updated Successfully</div>";
					}
					else
					{
							echo "<div class='thank_message'>Something going wrong. Please try again Later</div>";
					}
				}
?>
	<form name="reports" method="post" action="">
	<?php  
		$pInfo = mysql_query("SELECT a.*,b.* FROM `plantiff_information` as a,`plantiff_case_type_info` as b WHERE a.`form_id`=b.form_id and a.form_id='$_REQUEST[fid]' and b.form_id='$_REQUEST[fid]'") or die(mysql_error());
		$reports = mysql_fetch_object($pInfo);
	?>
		<div class="reports_left">
			<ul>
		
		<li>
			<span class="form_label">
				<label>First Name</label>
			</span>
			<span class="form_input">
				<input type="text" name="fname" placeholder="" value="<?php echo $reports->plantiff_name; ?>">
				<span class="error"></span>
			</span>
		</li>
			
	   
	    <li>
		   <span class="form_label">
				<label>Date of birth</label>
			</span>
			<span class="form_input">
				<input type="text" name="dob" placeholder="" value="<?php echo $reports->p_d_o_b;?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Application Date</label>
			</span>
			<span class="form_input">
				<input type="text" name="adate" placeholder="" value="<?php echo date('m-d-Y',strtotime($reports->date_time)); ?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
<?php
	$surgDatetemp = mysql_query("SELECT * FROM `appointment_doctor` WHERE `form_id` = '$_REQUEST[fid]' and `app_type`=2") or die(mysql_error());
	$surgeryDate  = mysql_fetch_array($surgDatetemp);
?>
		   <span class="form_label">
				<label>Surgery Date</label>
			</span>
			<span class="form_input">
				<input type="text" name="sdate" placeholder="" value="<?php if(isset($surgeryDate['date_appt']))
						{
						$dateSurgury = explode('/',$surgeryDate['date_appt']); list($a,$b)=$dateSurgury; echo $a;
						}?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Billing Date</label>
			</span>
			<?php
				$billing_date = mysql_query("SELECT * FROM `final_billing` WHERE `form_id`='$_REQUEST[fid]' and id = (select max(id) from `final_billing` where `form_id`='$_REQUEST[fid]')") or die(mysql_error());
				$data         = mysql_fetch_object($billing_date);
				
			?>
			<span class="form_input">
				<input type="text" name="bdate" placeholder="" value="<?php if(isset($data->date_time)){ echo date('m-d-Y',strtotime($data->date_time));} ?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
<?php
	$allBillingTemp = mysql_query("SELECT * FROM `billing_payment_information` WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
	$allBilling     = mysql_fetch_object($allBillingTemp);
?>
		   <span class="form_label">
				<label>Doctor Bill Amount</label>
			</span>
			<span class="form_input">
				<input type="text" name="d_b_amount" placeholder="" value="<?php if(isset($allBilling->d_b_amount)){echo $allBilling->d_b_amount ;}?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Doctor Payment Received</label>
			</span>
			<span class="form_input">
				<input type="text" name="d_p_received" placeholder="" value="<?php if(isset($allBilling->d_p_received)){echo $allBilling->d_p_received;}?>">
				<span class="error"></span>
			</span>
	   </li>
	   <li>
		   <span class="form_label">
				<label>Doctor Paid</label>
			</span>
			<span class="form_input">
				<input type="text" name="d_paid" placeholder="" value="<?php if(isset($allBilling->d_paid)){echo $allBilling->d_paid;}?>">
				<span class="error"></span>
			</span>
	   </li>
	   <li>
		   <span class="form_label">
				<label>Medical facility Bill Amount</label>
			</span>
			<span class="form_input">
				<input type="text" name="m_f_b_amount" placeholder="" value="<?php if(isset($allBilling->m_f_b_amount)){echo $allBilling->m_f_b_amount;} ?>">
				<span class="error"></span>
			</span>
	   </li>
	   
		</div>

		<div class="reports_right">
	<ul> 
		
<li>
		   <span class="form_label">
				<label>Medical facility Payment received</label>
			</span>
			<span class="form_input">
				<input type="text" name="medical_facility_receive" placeholder="" value="<?php if(isset($allBilling-> m_f_p_received)){echo $allBilling-> m_f_p_received;} ?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Medical facility Paid</label>
			</span>
			<span class="form_input">
				<input type="text" name="m_f_p_paid" placeholder="" value="<?php if(isset($allBilling->m_f_p_paid)){echo $allBilling->m_f_p_paid;}?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Anesthesiologist Bill Amount</label>
			</span>
			<span class="form_input">
				<input type="text" name="anes_b_amount" placeholder="" value="<?php if(isset($allBilling->anes_b_amount)){echo $allBilling->anes_b_amount;} ?>">
				<span class="error"></span>
			</span>
	   </li>

<li>
<li>
		   <span class="form_label">
				<label>Anesthesiologist payment received</label>
			</span>
			<span class="form_input">	
				<input type="text" name="anes_p_received" placeholder="" value="<?php if(isset($allBilling->anes_p_received)){echo $allBilling->anes_p_received;} ?>">
				<span class="error"></span>
			</span>
	   </li>

<li>
		   <span class="form_label">
				<label>Anesthesiologist paid</label>
			</span>
			<span class="form_input">
				<input type="text" name="anes_p_paid" placeholder="" value="<?php if(isset($allBilling->anes_p_paid)){echo $allBilling->anes_p_paid;} ?>">
				<span class="error"></span>
			</span>
	   </li>

<li>
		   <span class="form_label">
				<label>Other Bill Amount</label>
			</span>
			<span class="form_input">
				<input type="text" name="other_bill_amount" placeholder="" value="<?php if(isset($allBilling->other_bill_amount)){echo $allBilling->other_bill_amount;}?>">
				<span class="error"></span>
			</span>
	   </li>	
	   <li>
		   <span class="form_label">
				<label>Other payment Received</label>
			</span>
			<span class="form_input">
				<input type="text" name="other_payment_received" placeholder="" value="<?php if(isset($allBilling->other_payment_received)){echo $allBilling->other_payment_received;}?>">
				<span class="error"></span>
			</span>
	   </li>	
	   <li>
		   <span class="form_label">
				<label>Other Paid</label>
			</span>
			<span class="form_input">
				<input type="text" name="other_paid" placeholder="" value="<?php if(isset($allBilling->other_paid)){echo $allBilling->other_paid;}?>">
				<span class="error"></span>
			</span>
	   </li>	

		<li>
		<br/>
		</li>
		<li>
		<br/>
		</li>
		<br/>
		<br/>
		<br/>
		
			
		
		</ul>
		<div class="update_button">
			<input type="submit" id="signUp" name="update" value="Update">
		</div>
		<div class="close_button">
			<input type="submit" id="signUp" name="case_close" id="closeCase" value="close">
		</div>
		</div>
	</form>
					
					<?php
						
						if(isset($_POST['case_close']))
						{
							$dateofClosing = date('m-d-Y');
							
							$close_case = mysql_query("UPDATE `plantiff_case_type_info` SET `case_closed`=1,`case_close_date`='$dateofClosing' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
							if($close_case)
							{
								$attorney_id  = $getdata->GetObjectFromPCTI("attorney_id",$_REQUEST['fid']);
								$att_Fname    = ucwords($getdata->GetObjectById($attorney_id,"first_name"));
								$att_Lname    = ucwords($getdata->GetObjectById($attorney_id,"last_name"));
								$p_u_name     = $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
								$email_id     = $getdata->GetObjectById($attorney_id,"email_id");
								
								$message="";
								$message .= '<html><body>';
								$message .= '<img src="http://mayosurgical.com/images/logo.png" alt="Thank You – Case Completed and Closed" />';
								
								$message .='<table rules="all" cellpadding="0" cellspacing="5" border="0" style="font-size:17px;color:#000; border:1px solid #0665be; border-radius:5px;">';
								
								$message .='<tr><td> Dear &nbsp;'.$att_Fname."&nbsp;".$att_Lname.'</td></tr>';
								
								$message .='<tr><td>Client Name: &nbsp;'.$p_u_name.'</td></tr>';

								$message .='<tr><td>Your client’s funding request has been completed and closed.  Mayo Surgical appreciates your trust in us processing your referrals.  We look forward to working with you in the future.</td></tr>';
								
								$message .='<tr><td>You may login to the Mayo Surgical Website to review any case documentation if needed at any time.</td></tr>';
								
								$message .='<tr><td>Thank you,</td></tr>';
								
								$message .='<tr><td>Mayo Surgical LLC and affiliates</td></tr>';
								
								$subject  = "Thank You – Case Completed and Closed";
								$headers  ="From: Mayo Surgical to ".$att_Fname." ".$att_Lname."\r\n";
								$headers .="Reply-To: mayosurical.com\r\n";
								$headers .="MIME-Version: 1.0\r\n";
								$headers .="Content-Type: text/html; charset=ISO-8859-1\r\n";
								mail($email_id, $subject, $message, $headers);
								echo "Case is Closed";
								header("refresh:2;url=index.php");
							}
							
						}
						if(isset($_POST['delete_case']))
						{
							$delete_case = mysql_query("DELETE FORM `plantiff_Case_type_info` WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
							if($delete_case)
							{
								echo "<b>Case is Deleted Successfully.</b>";
							}
							else
							{
								echo "<b>Something going wrong. Please try again Later.</b>";
							}
						}
					?>
				</div>
			</div>