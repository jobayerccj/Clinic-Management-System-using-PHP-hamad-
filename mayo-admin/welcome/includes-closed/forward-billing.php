<?php
	$admin       = $_SESSION['username'];
	$admin_id    = $getdata->GetDetailsByUsername($admin,"id");
	$clientfname = $getdata->GetObjectById($_REQUEST['uid'],"first_name");
	$clientlname = $getdata->GetObjectById($_REQUEST['uid'],"last_name");
	$dattime = date('d-M-Y h:i:s a');
	global $uid;
?>
<div class='billing_infos'>
<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); ?>"/></a>
</div>
</div>
<div class="billing_box_bg">
					<div class="view_client_row">
						<div class="attorney_client_info">
							<h1>
								Forward Billing To Underwriter
							</h1>
						</div>
					</div>
					<?php 
					$sql = "SELECT * FROM `bill_forward_underwriter` 
					WHERE `user_id`='$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]'";
					$qry = mysql_query($sql) or die(mysql_error());
					if(mysql_num_rows($qry)>0)
					{
						$data       = mysql_fetch_object($qry);
						$uid        = $data->underwriter_id;
						$firstname  = $getdata->GetObjectById($uid,"first_name");
						$lastname   = $getdata->GetObjectById($uid,"last_name");
						
						//echo "<b>Emp No:</b>".$getdata->GetObjectById($uid,"id")."<br/>";
						echo "<div id='billing_remove'><p class='infos'>Bill is Successfully Forward to <b>".$firstname."&nbsp;".$lastname."</b></p><br/>";
						echo "<p class='infos'><b>Contact No: </b>".$getdata->GetObjectById($uid,"contact_number")."<br/><br/></p>";
						
						$check      = $data->underwriter_message;
						
						if($check!=0)
						{
							$var1   = $data->underwriter_message;
							echo "<p class='infos'>Message From Underwriter:&nbsp;<b>".$getdatak =$getdata->getDataAllTables("dec_name","decisions",$var1)."</b><br/></p><br/>";
							//echo "<b>Contact No:</b>". $getdata->GetObjectById($uid,"contact_number")."<br/>";
						}
						else
						{
							echo "<b>Decision is Pending From Underwriter</b>";
						}

						
					}
					else
					{
				?>
					<form name="forwardbill" id="otho_group" method="post" action="">
						<select name="underwriter" onchange="getUnderwriterInfo(this.value)" required>
							<?php
							$temp_cpt = mysql_query("SELECT a.id, a.user_name, a.first_name, a.last_name, b . * FROM members AS a, hire_staff AS b WHERE a.id = b.hire_id AND a.designation =6 && b.`form_id`='$_REQUEST[fid]' && b.`user_id`='$_REQUEST[uid]'") or die(mysql_error());
							if(mysql_num_rows($temp_cpt)>0)
							{
								echo '<option value="">...Select List...</option>';
								while($cpt= mysql_fetch_object($temp_cpt))
								{
						?>
									<option value=<?php echo $cpt->hire_id;?>><?php echo ucwords($getdata->GetObjectById($cpt->hire_id,"first_name"))."&nbsp;".ucwords($getdata->GetObjectById($cpt->hire_id,"last_name"));?></option>
						<?php
								}
							}
							else
							{
								echo '<option value="">No Underwriter is Assigned for this Case.</option>';
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
						$messagess   = mysql_real_escape_string($_POST['document_message']);
						$query       = mysql_query("UPDATE `billing_info` SET `underwriter_id` = '$underwriter' WHERE `form_id` = '$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
						$temp_send   = mysql_query("INSERT INTO `bill_forward_underwriter` (`form_id`,`user_id`,`underwriter_id`,`admin_message`,`date_time`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$underwriter','$messagess',now())") or die(msyql_error());
						
						
						/* Notifications */
						
						$notiFication = mysql_query("INSERT INTO `notifications` (`user_id`,`form_id`,`main_id`,`message`) VALUES ('$_REQUEST[uid]','$_REQUEST[fid]','$underwriter','New Billing to Approve')") or die(mysql_error());
						/* 
							Get UserInformation By Id 
						*/
						
						$user_id  = $underwriter;
						$p_name   = $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
						$u_f_name = $getdata->GetObjectById($user_id,"first_name");
						$u_l_name = $getdata->GetObjectById($user_id,"last_name");
						$email_id = $getdata->GetInfoPlantiffInformation("client_email",$_REQUEST['fid']);
						
						/*underwriter email*/
						$email_underwriter = $getdata->GetObjectById($user_id,"email_id");
						
						$contact_n= $getdata->GetInfoPlantiffInformation("p_home_no",$_REQUEST['fid']);
						
						$case_no  = $_REQUEST['fid'];
						
						/*
							End
						*/
						
						$subject  = "NEW FUNDING REQUEST On ".$dattime;
						$mfa      = "Please <a href='mayosurgical.com'>Click Here</a> to view the information";
						$extravalues=array('Client Name'=>$p_name,'Email ID'=>$email_id,'Contact No.'=>$contact_n,'Information'=>$mfa);
						$getdata->SendEmail($email_underwriter,$subject,$messagess,$extravalues);
						if($temp_send)
						{
							echo "<div class='thank_message'>Bill is forwarded to <b>".$u_f_name."&nbsp".$u_l_name. "</b></div>";
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
						<div class="attorney_client_info"><h1>Forward Approval for Surgery to Doctor</h1></div>
					</div>
					<?php 
					$sql = "SELECT * FROM `bill_forward_doctor` 
					WHERE `user_id`='$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]'";
					$qry = mysql_query($sql) or die(mysql_error());
					if(mysql_num_rows($qry)>0)
					{
						$data       = mysql_fetch_object($qry);
						$uid        = $data->doctor_id;
						$firstname  = $getdata->GetObjectById($uid,"first_name");
						$lastname   = $getdata->GetObjectById($uid,"last_name");
						echo "Approval for Surgery Already Forwarded to Doctor <b>".$firstname."&nbsp;".$lastname."</b>
						<br/>
						<br/>";
						$check      = $data->doctor_approved;
						if($check!=0 || $check!= "null")
						{
							//echo "<b>Emp No:</b>".$getdata->GetObjectById($uid,"id")."<br/>";
							//echo "<b>Contact No:</b>".$getdata->GetObjectById($uid,"contact_number")."<br/>";
							echo "<b>Waiting for Schedule Update</b><br/>";
						}
						//else
						//{
							//echo "Decision is Pending From Doctor";
						//}
						
					}
					else
					{
				?>
					<form name="forwardbill_doctor" id="otho_groupss" method="post" action="">
						<select name="doctor" onchange="getUnderwriterInfo(this.value)" required>
							<option value="">...Choose Doctor...</option>
							<?php		
								$temp_getinfo  = mysql_query("SELECT a.id AS hire_id, b. * FROM members AS a, hire_staff AS b WHERE a.id = b.hire_id
AND a.designation =3 && b.form_id='$_REQUEST[fid]' && b.user_id='$_REQUEST[uid]'") or die(mysql_error());
								while($getinfo = mysql_fetch_object($temp_getinfo))
								{
								
							?>
								<option value="<?=$getinfo->hire_id;?>">
									<?php
										echo $firstname = $getdata->GetObjectById($getinfo->hire_id,"first_name").'&nbsp';
										echo $lastname  = $getdata->GetObjectById($getinfo->hire_id,"last_name");
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
						<input type="submit" id="forward_bills" name="forward_bills" value="Surgery Approved">
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
									echo "<b>".$getdata->GetObjectById($mess->sent_by,"first_name").'&nbsp</b>';
									echo "<b>".$getdata->GetObjectById($mess->sent_by,"last_name").'&nbsp</b><br/>';
									echo "<b>".$mess->date_time.'&nbsp</b><br/>';
									echo "<textarea>".$mess->message."</textarea>";
								}
						?>
							<form name="form1" method="post" action="">

							<input type="hidden" name="doc_i" value="<?php		
								$temp_getinfo  = mysql_query("SELECT a.id AS hire_id, b. * FROM members AS a, hire_staff AS b WHERE a.id = b.hire_id
								AND a.designation =3 && b.form_id='$_REQUEST[fid]' && b.user_id='$_REQUEST[uid]'") or die(mysql_error());
								$getdataa = mysql_fetch_object($temp_getinfo);
								echo $getdataa->hire_id; ?>">
			
								<textarea name="reply_doctors" required ></textarea>
								<input type="submit" name="reply_doctor" value="Reply"/>
							</form>
						<?php
							if(isset($_POST['reply_doctor']))
								{
									$user_id = $_REQUEST['uid'];
									$form_id = $_REQUEST['fid'];
									$m_ssage = mysql_real_escape_string($_REQUEST['reply_doctors']);
									$doc_id  = mysql_real_escape_string($_REQUEST['doc_i']);
									$sql     = mysql_query("INSERT INTO `message_doctor_billing` (`main_id`,`form_id`,`user_id`,`sent_by`,`message`,`date_time`) VALUES ('$doc_id','$form_id','$user_id','$admin_id','$m_ssage',now())") or die(mysql_error()); 
									
									$subject  = "New Message From Admin for Funding On ".$dattime;
									$mfa      = "<html><body>".$m_ssage."</body><html>";
									$case = $_REQUEST['fid'];
									$extravalues=array('Client Name'=>$clientfname,'Case No.'=>$case);
									$getdata->SendEmail($email_id,$subject,$mfa,$extravalues);
									
									if($sql)
									{
										echo "<div class='thank_message'>Message Sent Successfully</div>";
										header("refresh:2;url = index.php?fid=$_REQUEST[fid]&uid=$_REQUEST[uid]&cid=$_REQUEST[cid]");
									}
									else
									{
										echo "<div class='thank_message'>There is something going Wrong</div>";
									}
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
						$dmessagess  = mysql_real_escape_string($_POST['message_doctor']);
						//$query       = mysql_query("UPDATE `billing_info` SET `underwriter_id` = '$underwriter' WHERE `form_id` = '$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
						$temp_send   = mysql_query("INSERT INTO `bill_forward_doctor` (`form_id`,`user_id`,`doctor_id`,`date_time`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor',now())") or die(mysql_error());
						$dattime = date('d-M-Y h:i:s a');
						
						/*Query used to insert the messages*/
						$temp_send   = mysql_query("INSERT INTO `message_doctor_billing` (`main_id`,`form_id`,`user_id`,`sent_by`,`message`,`date_time`) VALUES ('$doctor','$_REQUEST[fid]','$_REQUEST[uid]','$admin_id','$dmessagess',now())") or die(mysql_error());
						$dattime = date('d-M-Y h:i:s a');
						
						/* 
							Get UserInformation By Id 
						*/
						
						$u_f_name = $getdata->GetObjectById($doctor,"first_name");
						$u_l_name = $getdata->GetObjectById($doctor,"last_name");
						$email_id = $getdata->GetObjectById($doctor,"email_id");
						$fullname = $u_f_name." ".$u_l_name;
						$plan_name= $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
						$case_no  = $_REQUEST['fid'];
						
						$case_id  = $getdata->getNameCase($_REQUEST['cid']);
						
						/*
							End
						*/
						
						$subject = $case_id.' From Mayo to '.$fullname.' (Approval of Billing by Underwriter and Mayo)';
						$message="";
						$message .= '<html><body>';
						$message .= '<img src="http:s//mayosurgical.com/images/logo.png" alt="Surgery Approval Notification  (Approval of Billing by Underwriter and Mayo" />';

						$message .='<table rules="all" cellpadding="0" cellspacing="5" border="0" style="font-size:17px;color:#000; border:1px solid #0665be; border-radius:5px;">';

						$message .='<tr><td style="background: none repeat scroll 0 0 #3a9df8;border-top-left-radius: 5px;border-top-right-radius: 5px;color: #fff;font: 15px MemphisLTStd-Medium;padding: 15px 0;text-align: center;">';
						
						$message .='<h1>Mayo Surgical LLC has received acceptance for charges relating to surgery for '.$plan_name.' .</h1></td></tr>';
						
						$message .='<tr><td align="center"><h2 style="color:#f6801f;">'.$case_id.'</h2></td></tr>';
						$message .='<tr><td align="center">Authorization is for the surgery procedure(s) listed below:</td></tr>';
						$message .='<tr><td><table>';
						//echo $a =" SELECT * FROM `billing_info` WHERE `form_id` = '$_REQUEST[fid]' && `user_id`= '$_REQUEST[uid]'";
						$blingToD = mysql_query("SELECT * FROM `billing_info` WHERE `form_id` = '$_REQUEST[fid]' && `user_id`= '$_REQUEST[uid]'") or die(mysql_error());
						while($biling_te = mysql_fetch_object($blingToD))
						{
						
						
							$message .='<tr><td align="left" width="100"><strong>'.$biling_te->cpt_code .'</strong></td>';
							$message .='<td><strong>'.$biling_te->description .'</strong></td></tr><br/>';
						
						
						}
						$message .='</table></td></tr>';
						$message .='<tr><td>Mayo Surgical LLC will not be contractually responsible for additional surgery codes performed exceeding 120% of the original estimate provided by the Doctor.  If the Doctor believes additional codes are necessary, please include on your estimate for pre-approval.</td></tr>';
						$message .='<tr><td>1.	Please LOGIN and enter the surgery appointment date once set, by clicking on the appointment tab in the main menu.  Please enter any additional information needed (i.e. Clearances required, 
						Travel accommodations.</td></tr>';
						
						$message .='<tr><td>Please UPLOAD or Fax the following documents to our offices upon completion of the above 
						referenced medical services.</td></tr>';
						$message .='<tr><td>
							<ul style="text-align:left; list-style-type:none;">
								<li>Copy of the Operative Report</li>
								<li>Copy of Anesthesia Record</li>
								<li>Copy of AOI and insurance Letter – signed by patient upon check-in.</li>
								<li>Copy of Final Bill </li>
							</ul>
						</td></tr>';
						$message .='<tr><td>****All Surgical Referrals should include <Company Name> on Invoice (i.e. Mayo Surgical, OrthoGroup, Banner, Emerson)  as the Guarantor on the account and ALL BILLS forwarded to Mayo Surgical LLC, not the patient****</td></tr>';
						$message .='<tr><td>Thank you for choosing '.$case_id.' Group,  a Mayo Surgical LLC affiliate company:</td></tr>';
						$message .='<tr><td>Please login into <a href="mayosurgical.com">Mayo Surgical</a> for further information.</td></tr>';
						$message .='<tr><td> If you have any questions please call us at 1-866-411-2525.</td></tr>';
						$message .='<tr><td>Thank You,</td></tr>';
						$message .='<tr><td>Mayo Surgical, LLC</td></tr>';
						$message .='<tr><td>DO NOT REPLY TO THIS MESSAGE. THIS EMAIL IS NOT MONITORED.</td></tr>';
						$message .='</table>';
						
						$to       = $email_id; 
						//$getdata->GetObjectById($attManId,"email_id");
						$headers  ="From: Mayo Surgical\r\n";
						$headers .="Reply-To: mayosurical.com\r\n";
						$headers .="MIME-Version: 1.0\r\n";
						$headers .="Content-Type: text/html; charset=ISO-8859-1\r\n";
						
						mail($to, $subject, $message, $headers);
						
						if($temp_send)
						{
							echo "<div class='thank_message'>Bill is forwarded to <b>".$firstname."&nbsp".$lastname. "</b></div>";
							$page = "index.php?fid=$_REQUEST[fid]&uid=$_REQUEST[uid]&cid=2";
							//header("refresh:3;url=$page");
						}
						else
						{
							echo "<div class='thank_message'>There is something going Wrong</div>";
						}
					}
				?>
				</div>