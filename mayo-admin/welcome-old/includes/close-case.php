<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); ?>"/></a>
</div>
<h2>Close Case</h2>
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
					<form name="form1" method="post" action="">
						<div class="close_case"><strong>Close Case :</strong> <input class="confirmationd" type="submit" name="case_close" value="Close Case"></div>
						<div class="close_case"><strong>Delete Case:</strong> <input class="confirmationd" type="submit" name="delete_case" value="Delete Case"> </div>
					</form>
					
					<?php
						
						if(isset($_POST['case_close']))
						{
							
							$close_case = mysql_query("UPDATE `plantiff_case_type_info` SET `case_closed`=1 WHERE `form_id`='$_REQUEST[id]' && `id`='$_REQUEST[uid]'") or die(mysql_error());
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
							$delete_case = mysql_query("DELETE FORM `plantiff_Case_type_info` WHERE `form_id`='$_REQUEST[id]' && `id`='$_REQUEST[id]'") or die(mysql_error());
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