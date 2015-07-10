<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
include '../../functions.php';
include '../classes/Cases.php';
$desg = new Cases();
$functions  = $pathofmayo."/classes/functions.php";
include($functions);
$meshedfile = $pathofmayo."/attorney/classes/meshed.php";
require_once($meshedfile);
$getdatas = new Meshed();
if(loggedin())
{
	$header_admin = $pathofmayo."/mayo-admin/welcome/header.php";
	require_once($header_admin);
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
	function getXMLHTTP() 
	{ 
		var xmlhttp=false;	
		try
		{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	
		{		
			try
			{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				try
				{
					xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1)
				{
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getUnderwriterInfo(undrId) 
	{		
		var strURL="../includes/getInfo.php?user_details="+undrId;
		var req = getXMLHTTP();
			
		if (req) 
		{	
			req.onreadystatechange = function() 
			{
				if (req.readyState == 4) 
				{
					// only if "OK"
					if (req.status == 200) 
					{						
						document.getElementById('u_info').innerHTML=req.responseText;						
					} 
					else 
					{
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
				req.open("GET", strURL, true);
				req.send(null);
		}
				
	}
function getEmailsFormat(emailId) {		
		var strURL="../includes/getemailsformat.php?email_format="+emailId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('email_formats').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>
<section class="row">
	<div class="container">
		<div class="anesth_box_bg">
				<div class="billing_box_bg">
					<div class="attorney_client_info">
						<h1>Forward Billing To Underwriter</h1>
					</div>
					<?php 
					$sql = "SELECT * FROM `bill_forward_underwriter` 
					WHERE `user_id`='$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]'";
					$qry = mysql_query($sql) or die(mysql_error());
					if(mysql_num_rows($qry)>0)
					{
						$data       = mysql_fetch_object($qry);
						$uid        = $data->underwriter_id;
						$firstname  = $getdatas->GetObjectById($uid,"first_name");
						$lastname   = $getdatas->GetObjectById($uid,"last_name");
						echo "Bill is Successfully Forward to <b>".$firstname."&nbsp;".$lastname."</b><br/>";
						echo "<b>Emp No:</b>".$getdatas->GetObjectById($uid,"id")."<br/>";
						echo "<b>Contact No:</b>".$getdatas->GetObjectById($uid,"contact_number")."<br/>";
						$checks      = $data->underwriter_message;
						if($checks!=0)
						{
							$var1   = $data->underwriter_message;
							echo "<b>Message From Underwriter:".$getdata =$getdatas->getDataAllTables("dec_name","decisions",$var1)."</b><br/>";
							echo "<b>Emp No:</b>".$getdatas->GetObjectById($uid,"id")."<br/>";
							echo "<b>Contact No:</b>".$getdatas->GetObjectById($uid,"contact_number")."<br/>";
						}
						else
						{
							"Decision is Pending From Underwriter";
						}
						
					}
					else
					{
				?>
					<form name="forwardbill" id="otho_group" method="post" action="">
						<select name="underwriter" onchange="getUnderwriterInfo(this.value)" required>
							<option value="">...Choose Underwriter...</option>
							<?php		
								$temp_getinfo  = mysql_query("SELECT a.id AS hire_id, b. * FROM members AS a, hire_staff AS b WHERE a.id = b.hire_id
AND a.designation = 6 && b.form_id='$_REQUEST[fid]' && b.user_id='$_REQUEST[uid]'") or die(mysql_error());
								while($getinfo = mysql_fetch_object($temp_getinfo))
								{
							?>
								<option value="<?=$getinfo->hire_id;?>">
									<?php
										echo $firstname = $getdatas->GetObjectById($getinfo->hire_id,"first_name").'&nbsp';
										echo $lastname  = $getdatas->GetObjectById($getinfo->hire_id,"last_name");
									?>
								</option>
							<?php
							}
							?>
						</select>
						<div id="u_info"></div>
						<div class="dashboard_row">
							<label>Message</label>
							<select name="email_format" onchange="getEmailsFormat(this.value);">
								<option value="">Please Select Email Type</option>
								<?php
									$sql = mysql_query("SELECT * FROM `email_formats`") or die(mysql_error());
									while($email_f=mysql_fetch_object($sql))
									{
								?>
									<option value="<?php echo $email_f->id; ?>"><?php echo $email_f->name_email; ?></option>
								<?php
									}
								?>
							</select>
							<div id="email_formats"></div>
						</div>
						<!--<textarea name="messagess" placeholder="Message/Mail" required /></textarea>-->
						<input type="submit" id="u_bill" name="forwardbill" value="Forward Bill">
					</form>
					<script>
					$(document).ready(function()
					{
						$("#u_bill").click(function()
						{
							$(".thank_message").fadeOut(3000);
						});
					});
				</script>
					<?php
					}
					?>
					<div class="messages">
						<?php
							$getallmessages = mysql_query("SELECT * FROM `bill_forward_underwriter` WHERE `user_id`='$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]'") or die(mysql_error());
							if(mysql_num_rows($getallmessages)>0)
							{
								$data     = mysql_fetch_object($getallmessages);
								$message  = $data->underwriter_message;
							}
						?>
					</div>
				<?php
					if(isset($_POST['forwardbill']))
					{
						$underwriter = $_POST['underwriter'];
						$messagess   = $_POST['document_message'];
						$query       = mysql_query("UPDATE `billing_info` SET `underwriter_id` = '$underwriter' WHERE `form_id` = '$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
						$temp_send   = mysql_query("INSERT INTO `bill_forward_underwriter` (`form_id`,`user_id`,`underwriter_id`,`admin_message`,`date_time`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$underwriter','$messagess',now())") or die(msyql_error());$dattime = date('d-M-Y h:i:s a');
						
						/* 
							Get UserInformation By Id 
						*/
						
						$user_id  = $underwriter;
						$u_f_name = $getdatas->GetObjectById($user_id,"first_name");
						$u_l_name = $getdatas->GetObjectById($user_id,"last_name");
						$email_id = $getdatas->GetObjectById($user_id,"email_id");
						$fullname = $u_f_name."&nbsp;".$u_l_name;
						$case_no  = $_REQUEST['fid'];
						
						/*
							End
						*/
						
						$subject  = "NEW FUNDING REQUEST On".$dattime;
						echo $mfa      = "<html><body>".$messagess."</body><html>";
						$extravalues=array('Client Name'=>$fullname,'Case No.'=>$case_no,'Message'=>$mfa);
						$getdatas->SendEmail($email_id,$subject,$mfa,$extravalues);
						if($temp_send)
						{
							echo "<div class='thank_message'>Bill is forwarded to <b>".$firstname."&nbsp".$lastname. "</b></div>";
						}
						else
						{
							echo "<div class='thank_message'>There is something going Wrong</div>";
						}
					}
				?>
				</div>
				
				<!-- Forward Bill to the Doctor -->
				<div class="billing_box_bg">
					<div class="view_client_row">
						<h1>Forward Billing To Doctor For Approval</h1>
					</div>
					<?php 
					$sql = "SELECT * FROM `bill_forward_doctor` 
					WHERE `user_id`='$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]'";
					$qry = mysql_query($sql) or die(mysql_error());
					if(mysql_num_rows($qry)>0)
					{
						$data       = mysql_fetch_object($qry);
						$uid        = $data->doctor_id;
						$firstname  = $getdatas->GetObjectById($uid,"first_name");
						$lastname   = $getdatas->GetObjectById($uid,"last_name");
						echo "Bill is Already Transferred to <b>".$firstname."&nbsp;".$lastname."</b>
						<br/>
						<br/>";
						$check      = $data->doctor_approved;
						if($check!=0 || $check!= "null")
						{
							echo "<b>Emp No:</b>".$getdatas->GetObjectById($uid,"id")."<br/>";
							echo "<b>Contact No:</b>".$getdatas->GetObjectById($uid,"contact_number")."<br/>";
						}
						else
						{
							echo "Waiting for Schedule Update";
						}
						
					}
					else
					{
				?>
					<form name="forwardbill_doctor" id="otho_groupss" method="post" action="">
						<select name="doctor" onchange="getUnderwriterInfo(this.value)" required>
							<option value="">...Choose Doctor...</option>
							<?php		
								$temp_getinfo  = mysql_query("SELECT a.id AS hire_id, b. * 
FROM members AS a, hire_staff AS b
WHERE a.id = b.hire_id
AND a.designation =3 && b.form_id='$_REQUEST[fid]' && b.user_id='$_REQUEST[uid]'") or die(mysql_error());
								while($getinfo = mysql_fetch_object($temp_getinfo))
								{
								
							?>
								<option value="<?=$getinfo->hire_id;?>">
									<?php
										echo $firstname = $getdatas->GetObjectById($getinfo->hire_id,"first_name").'&nbsp';
										echo $lastname  = $getdatas->GetObjectById($getinfo->hire_id,"last_name");
									?>
								</option>
							<?php
							}
							?>
						</select>
						<div id="u_info"></div>
						<div class="dashboard_row">
							<label>Message</label>
							<textarea name="message_doctor" required ></textarea>
						</div>
						<!--<textarea name="messagess" placeholder="Message/Mail" required /></textarea>-->
						<input type="submit" id="forward_bills" name="forward_bills" value="Forward Bill">
					</form>
					<?php
					}
					?>
					<div class="messages">
						<?php
							$docmessages = mysql_query("SELECT * FROM `message_doctor_billing` WHERE `user_id`='$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]' order by id desc") or die(mysql_error());
							if(mysql_num_rows($docmessages)>0)
							{
								while($mess = mysql_fetch_object($docmessages))
								{
									echo $mess->message;
								}
							}
							else
							{
								echo "<h1>There is no Message.</h1>";
							}
						?>
					</div>
				<script>
					$(document).ready(function()
					{
						$("#forward_bills").click(function()
						{
							$(".thank_message").fadeOut(3000);
						});
					});
				</script>
				<?php
					if(isset($_POST['forward_bills']))
					{
						$doctor      = $_POST['doctor'];
						echo $dmessagess  = mysql_real_escape_string($_POST['message_doctor']);
						//$query       = mysql_query("UPDATE `billing_info` SET `underwriter_id` = '$underwriter' WHERE `form_id` = '$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
						$temp_send   = mysql_query("INSERT INTO `bill_forward_doctor` (`form_id`,`user_id`,`doctor_id`,`date_time`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor',now())") or die(mysql_error());
						$dattime = date('d-M-Y h:i:s a');
						
						/*Query used to insert the messages*/
						$temp_send   = mysql_query("INSERT INTO `message_doctor_billing` (`main_id`,`form_id`,`user_id`,`message`,`date_time`) VALUES ('$doctor','$_REQUEST[fid]','$_REQUEST[uid]','$dmessagess',now())") or die(mysql_error());
						$dattime = date('d-M-Y h:i:s a');
						
						/* 
							Get UserInformation By Id 
						*/
						
						$user_id  = $doctor;
						$u_f_name = $getdatas->GetObjectById($user_id,"first_name");
						$u_l_name = $getdatas->GetObjectById($user_id,"last_name");
						$email_id = $getdatas->GetObjectById($user_id,"email_id");
						$fullname = $u_f_name."&nbsp;".$u_l_name;
						$case_no  = $_REQUEST['fid'];
						
						/*
							End
						*/
						
						$subject  = "NEW FUNDING REQUEST On".$dattime;
						$extravalues=array('Client Name: '=>$fullname,'Case No: '=>$case_no);
						$getdatas->SendEmail($email_id,$subject,$dmessagess,$extravalues);
						if($temp_send)
						{
							echo "<div class='thank_message'>Bill is forwarded to <b>".$firstname."&nbsp".$lastname. "</b></div>";
							$page = "index.php?fid=$_REQUEST[fid]&uid=$_REQUEST[uid]&cid=2";
							header("refresh:3;url=$page");
						}
						else
						{
							echo "<div class='thank_message'>There is something going Wrong</div>";
						}
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
