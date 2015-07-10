<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../includes/functions.php');
$path       = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
include '../functions.php';
$functions  = $pathofmayo."/classes/functions.php";
include($functions);
$meshedfile = $pathofmayo."/attorney/classes/meshed.php";
require_once($meshedfile);
$getdata    = new Meshed();
?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
<?php
if(loggedin())
{
	include('header.php');
?>
<section class="row">
<div class="container">
<div class="form_section_content">
     <h1 class="add_user">Update Reports</h1>
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
		$tempReports = mysql_query("SELECT a . * , b . * , c.date_time AS billing_date, d . *,e.*
FROM plantiff_information AS a, appointment_doctor AS b, final_billing AS c, `plantiff_case_type_info` AS d, `billing_payment_information` as e
WHERE a.form_id = b.form_id
AND d.form_id = a.form_id
AND d.form_id = b.form_id
AND d.form_id = c.form_id
AND c.form_id = b.form_id
AND c.form_id = a.form_id
AND a.form_id = e.form_id
AND b.form_id = e.form_id
AND c.form_id = e.form_id
AND d.form_id = e.form_id
AND b.app_type =2 and c.form_id='$_REQUEST[fid]'");
		$reports = mysql_fetch_object($tempReports);
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
				<input type="text" name="dob" placeholder="" value="<?php echo date('d-m-Y',strtotime($reports->p_d_o_b));?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Application Date</label>
			</span>
			<span class="form_input">
				<input type="text" name="adate" placeholder="" value="<?php echo date('d-m-Y',strtotime($reports->date_time)); ?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Surgery Date</label>
			</span>
			<span class="form_input">
				<input type="text" name="sdate" placeholder="" value="
<?php $dateSurgury = explode('/',$reports->date_appt); list($a,$b)=$dateSurgury; echo date('d-m-Y',strtotime($a)) ;?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Billing Date</label>
			</span>
			<span class="form_input">
				<input type="text" name="bdate" placeholder="" value="<?php echo date('d-m-Y',strtotime($reports->billing_date)); ?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Doctor Bill Amount</label>
			</span>
			<span class="form_input">
				<input type="text" name="d_b_amount" placeholder="" value="<?php echo $reports->d_b_amount ;?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Doctor Payment Received</label>
			</span>
			<span class="form_input">
				<input type="text" name="d_p_received" placeholder="" value="<?php echo $reports->d_p_received;?>">
				<span class="error"></span>
			</span>
	   </li>
	   <li>
		   <span class="form_label">
				<label>Doctor Paid</label>
			</span>
			<span class="form_input">
				<input type="text" name="d_paid" placeholder="" value="<?php echo $reports->d_paid;?>">
				<span class="error"></span>
			</span>
	   </li>
	   <li>
		   <span class="form_label">
				<label>Medical facility Bill Amount</label>
			</span>
			<span class="form_input">
				<input type="text" name="m_f_b_amount" placeholder="" value="<?php echo $reports->m_f_b_amount; ?>">
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
				<input type="text" name="medical_facility_receive" placeholder="" value="<?php echo $reports-> m_f_p_received; ?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Medical facility Paid</label>
			</span>
			<span class="form_input">
				<input type="text" name="m_f_p_paid" placeholder="" value="<?php echo $reports->m_f_p_paid;?>">
				<span class="error"></span>
			</span>
	   </li>
<li>
		   <span class="form_label">
				<label>Anesthesiologist Bill Amount</label>
			</span>
			<span class="form_input">
				<input type="text" name="anes_b_amount" placeholder="" value="<?php echo $reports->anes_b_amount; ?>">
				<span class="error"></span>
			</span>
	   </li>

<li>
<li>
		   <span class="form_label">
				<label>Anesthesiologist payment received</label>
			</span>
			<span class="form_input">	
				<input type="text" name="anes_p_received" placeholder="" value="<?php echo $reports->anes_p_received; ?>">
				<span class="error"></span>
			</span>
	   </li>

<li>
		   <span class="form_label">
				<label>Anesthesiologist paid</label>
			</span>
			<span class="form_input">
				<input type="text" name="anes_p_paid" placeholder="" value="<?php echo $reports->anes_p_paid ?>">
				<span class="error"></span>
			</span>
	   </li>

<li>
		   <span class="form_label">
				<label>Other Bill Amount</label>
			</span>
			<span class="form_input">
				<input type="text" name="other_bill_amount" placeholder="" value="<?php echo $reports->other_bill_amount?>">
				<span class="error"></span>
			</span>
	   </li>	
	   <li>
		   <span class="form_label">
				<label>Other payment Received</label>
			</span>
			<span class="form_input">
				<input type="text" name="other_payment_received" placeholder="" value="<?php echo $reports->other_payment_received?>">
				<span class="error"></span>
			</span>
	   </li>	
	   <li>
		   <span class="form_label">
				<label>Other Paid</label>
			</span>
			<span class="form_input">
				<input type="text" name="other_paid" placeholder="" value="<?php echo $reports->other_paid?>">
				<span class="error"></span>
			</span>
	   </li>	

		
		<li>	
			
			<input type="submit" id="signUp" name="update" value="Update">
		
			<input type="submit" id="signUp" name="close" onclick="window.location.href='full-details.php?fid=$_REQUEST[fid]'" id="closeCase" value="close">
		</li>
		</ul>
		</div>
	</form>
	<script type="text/javascript">
		
	</script>
	<?php
		if(isset($_POST['close']))
		{	
			echo '<a href="full-details.php?fid='.$_REQUEST['fid'].'">Download Information</a>';
		}
	?>
</div>
</div>
</section>

<?php
require($get_footer);
?>
<?php 
}

else 
{ 
header('Location:../../login.php');
}
?>
