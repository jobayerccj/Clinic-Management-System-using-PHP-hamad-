<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";

include($path);

require_once('../../../includes/functions.php');
require_once('../classes/Cases.php');

include($config);

include '../../functions.php';
?>
<!-- autocomplte end-->
<?php
$header_admin = $_SERVER['DOCUMENT_ROOT']."/rao/mayo-admin/welcome/header.php";
require_once($header_admin);
if(loggedin())
{
?>

<section class="row">
	<div class="container dashboard_bg">
		<div class="slide_left">
			<h1>Case History</h1>
			<div class="slide_top_bar">
				<div class="side_row">
					<div class="slide_row_left">
						<label>Client Name</label>
					</div>
					<div class="slide_row_right">
						<label>John William</label>
					</div>
				</div>
				<div class="side_row">
					<div class="slide_row_left">
						<label>Email Address</label>
					</div>
					<div class="slide_row_right">
						<label>william_john@gmail.com</label>
					</div>
				</div>
				<div class="side_row">
					<div class="slide_row_left">
						<label>Contact No.</label>
					</div>
					<div class="slide_row_right">
						<label>21354879</label>
					</div>
				</div>
				<div class="side_row">
					<div class="slide_row_left">
						<label>Starting Date</label>
					</div>
					<div class="slide_row_right">
						<label>21-Sep-2014</label>
					</div>
				</div>
				<div class="side_row">
					<div class="slide_row_left">
						<label>Address</label>
					</div>
					<div class="slide_row_right">
						<label>William</label>
					</div>
				</div>
			</div>
		</div>
		<div class="slide_right">
			<div class="attorney_box_bg">
				<h1>Meshed Case Type</h1>
				<div class="attorney_row_heading">
					<div class="attorney_monitor_1">Date</div>
					<div class="attorney_monitor_2">Application Stage</div>
					<div class="attorney_monitor_3">Discription</div>
					<div class="attorney_monitor_4">Hire Doctor</div>
					<div class="attorney_monitor_5">Update Status</div>
				</div>
				<?php
					$query = mysql_query("SELECT a . * , b. * , c . * , d.designation AS desg
					FROM plantiff_information a
					RIGHT JOIN plantiff_case_type_info b ON a.form_id = b.form_id
					AND a.id = b.id
					LEFT JOIN members c ON c.id = b.id
					LEFT JOIN designation d ON c.designation = d.id
					WHERE a.case_type =  2
					AND b.case_type =  2
					ORDER BY a.`form_id` && `admin_approved`=1 ") or die(mysql_error());
					while ($row = mysql_fetch_array($query)) 
					{
						
				?>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">
						<?php 
							$data = $row['p_date']; 
							$n_date = date('d-M-Y',strtotime($data)); 
							$d_date = date('H:i:s:A',strtotime($data)); 
							echo $n_date.'<br/>';
							echo $d_date;
						?>
					</div>
					<div class="attorney_monitor_2">
						<?php 
							$approved = $row['admin_approved']; 
							if($approved =='1')
							{
								echo "Case Under Mayo Surgical";
							}
						?>
					</div>
					<div class="attorney_monitor_3"><?php echo $row['case_status']; ?></div>
					<div class="attorney_monitor_4">
						<a class="btn btn-default" href="#" data-featherlight="#fl<?php echo $row['form_id']; ?>" data-featherlight-variant="fixwidth">
							<button class="message_button">view</button>
						</a>
					</div>
					<div class="lightbox" id="fl<?php echo $row['form_id']; ?>">
					<form name="form" method="post" action="">
						<h3>Client Details:</h3>
						<div class="client_details">
							<strong>Name : <?php echo $approved = ucwords($row['plantiff_name']);?></strong>
						</div>
						<div class="client_details">
							<strong>Phone No: <?php echo $approved = ucwords($row['p_mob_no']);?></strong>
						</div>
						<div class="client_details">
							<strong>Email: <?php echo $approved = $row['p_email_address'];?></strong>
						</div>
						<h3>Client's Attorney Details</h3>
						<div class="attorney_details">
							<strong>Name : <?php echo $approved = ucwords($row['plantiff_name']);?></strong>
						</div>
						<div class="attorney_details">
							<strong>Phone Number: <?php echo $approved = ucwords($row['p_mob_no']);?></strong>
						</div>
						<?php 
						if($row['hired'] == " ")
						{
						?>
						<div class="attorney_details">
							<strong>Email: <?php echo $approved = $row['p_email_address'];?></strong>
						</div>
						<div class="popup_row">
							<input type="hidden" name="form_ids" value="<?php echo $form_id = $row['form_id']; ?>">
							<input type="hidden" name="user_ids" value="<?php echo $user_id = $row['id']; ?>">
							<input type="hidden" name="att_ids" value="<?php echo $att_id  = $row['attorney_id'];?>">
							<?php
									$email_ids = mysql_query("SELECT * FROM `members` where `designation`='3'") or die(mysql_error());
									while($ema = mysql_fetch_array($email_ids))
									{
								
										 $att_id  = $ema['id'];
							
									}
								?>
							Choose Doctor:<select name="doctors_emails" onchange="showUser(this.value);">
								<option value="...Select...">...Select...</option>
								<?php
									$email_ids = mysql_query("SELECT * FROM `members` where `designation`='3'") or die(mysql_error());
									while($ema = mysql_fetch_array($email_ids))
									{
								?>
										<option value="<?php echo $ema['id'] ?>"><?php echo $ema['email_id']; ?></option>
								<?php
									}
								?>
							</select>
						</div>
						<div id="txtHint"></div>
						<div class="popup_row">
							<textarea placeholder="Message to Doctor" name="message_to_doctor"></textarea>
						</div>
						<div class="popup_row">
							<textarea placeholder="Message to Client" name="message_to_client"></textarea>
						</div>
						<div class="popup_row">
							<input type="submit" name="sendmessage" id="" value="Submit"/>
						</div>
						<?php
							}
							else
							{
								$getdoc  = mysql_query("SELECT a.*, b.* from members as a, hire_doctors as b where a.id = b.doctor_id 
								&& b.form_id='".$row['form_id']."'") or die(mysql_error());
								$getfulld = mysql_fetch_array($getdoc);
						?>
						<h3>Case Transfer To : <?php echo $approved = ucwords($getfulld['first_name'])."&nbsp;"; echo $approved = ucwords($getfulld ['last_name']); ?></h3>
						<h3>Doctor's Details:</h3>
						<div class="client_details">
							<strong>Name : <?php echo $approved = ucwords($getfulld['first_name'])."&nbsp;"; echo $approved = ucwords($getfulld ['last_name']); ?></strong>
						</div>
						<div class="client_details">
							<strong>Email: <?php echo $approved = ucwords($getfulld ['email_id']);?></strong>
						</div>
						
						<?php
							}
						?>
						</form>
					</div>
					<div class="attorney_monitor_5">
						<a class="btn btn-default" href="#" data-featherlight="#fll<?php echo $row['form_id']; ?>" data-featherlight-variant="fixwidth">
							<span class="pending_status">Approve</span>
						</a>
					</div>
				</div>
				<div class="lightbox" id="fll<?php echo $row['form_id']; ?>">
					<h2>Vikram Featherlight with custom styles</h2>
					<p><?php echo $approved = $row['attorney_id']; ?></p>
				</div>
			<?php
				}
			?>
			<?php
				$hired = new Cases();
				if(isset($_POST['sendmessage']))
				{
				  echo $hired->user_id         = $_REQUEST['user_ids'];
				  echo $hired->attorney_id     = $_REQUEST['att_ids'];
				  echo $hired->form_id         = $_REQUEST['form_ids'];
				  $hired->doctor_id       = mysql_real_escape_string($_REQUEST['doctors_emails']);
				  $hired->messagetodoctor = mysql_real_escape_string($_REQUEST['message_to_doctor']);
				  $hired->messagetoclient = mysql_real_escape_string($_REQUEST['message_to_client']);
				  $mesage = $hired->HireDoctor();
				  if($mesage=1)
				  {
					  echo "Doctor is Hired";
				  }
				  else
				  {
					  echo "Something Went Wrong";
				  }
					
				}
			?>
			</div>
		</div>
		
		<div class="slide_right" style="float:right;">
			<h1>Ortho Cases</h1>
			<div class="attorney_box_bg">
				<div class="attorney_row_heading">
					<div class="attorney_monitor_1">Date</div>
					<div class="attorney_monitor_2">Applciation Stage</div>
					<div class="attorney_monitor_3">Discription</div>
					<div class="attorney_monitor_4">Status Type</div>
					<div class="attorney_monitor_5">Action</div>
				</div>
				<?php
					$query = mysql_query("SELECT a . * , b. * , c . * , d.designation AS desg
					FROM plantiff_information a
					RIGHT JOIN plantiff_case_type_info b ON a.form_id = b.form_id
					AND a.id = b.id
					LEFT JOIN members c ON c.id = b.id
					LEFT JOIN designation d ON c.designation = d.id
					WHERE a.case_type =  'ortho'
					AND b.case_type =  'ortho'
					ORDER BY a.`form_id` && `admin_approved`=1 ") or die(mysql_error());
					while ($row = mysql_fetch_array($query)) 
					{
				?>
				<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<a class="btn btn-default" href="#" data-featherlight="#fl4" data-featherlight-variant="fixwidth">
							<button class="message_button">view</button>
						</a>
					</div>
					<div class="attorney_monitor_5">
						<a class="btn btn-default" href="#" data-featherlight="#fl5" data-featherlight-variant="fixwidth">
							<span class="pending_status">Approve</span>
						</a>
					</div>
			  </div>
			  <div class="lightbox" id="fl4">
				<h2> VikasFeatherlight with custom styles</h2>
				<p>asd</p>
			 </div>
			<?php
				}
			?>
			</div>
		</div>
	</div>
</section>
<style>
	.client_details
	{
		width:50%;
		float:left;
	}
	.attorney_details
	{
		width:50%;
		float:left;
	}
	.lightbox h3
	{
		width:100%;
		margin-top:15px;
		width: 100%;
		margin: 9px 7px 9px 0px;
		float: left;
		border-top:1px solid #fff;
	}
	.lightbox h3:first-child
	{
		width:100%;
		margin-top:15px;
		width: 100%;
		margin: 9px 7px 9px 0px;
		float: left;
		border-top:none;
	}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","getdoctors.php?q="+str,true);
  xmlhttp.send();
}
</script>

<!-- <script src="http://code.jquery.com/jquery-1.7.0.min.js"></script> Files used to call the pop up -->
<link type="text/css" rel="stylesheet" href="<?php echo $sitepath; ?>/popup/featherlight.min.css" title="Featherlight Styles" />
<script src="<?php echo $sitepath; ?>/popup/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo $sitepath; ?>/popup/style.css">
<!--pop up ends-->
<?php
require($get_footer);
}
else
{
	header("location:../../index.php");
}
?>

