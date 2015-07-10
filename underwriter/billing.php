<?php 
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
?>
<section class="row">
	<div class="container dashboard_bg">
	<?php 
		if(isset($_REQUEST['fid'])) 
		{ 
	?>
			<p class="plantiff_name"><?php echo ucwords($functions->GetInfoPlantiffInformation('plantiff_name',$_REQUEST['fid'])); ?></p>
	<?php
		} 
	?>
		<div class="anesth_dashbord_client">
		
			<?php
				if(isset($_POST['acceptcase']))
				{
					$newDate = date('d-m-Y');
					$accepttt = $_POST['accept'];
					$update_bill = mysql_query("UPDATE `bill_forward_underwriter` SET `underwriter_message`= '$accepttt',`approved_date`='$newDate' WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]' && `underwriter_id`='$doctor_id'") or die(mysql_error());
/*******************************    Store the billing in the latest messages  ******************************************************/
					$getdatak =$functions->getDataAllTables("dec_name","decisions",$accepttt);
					$billingDecision = "Billing Decision from Underwriter ".$getdatak;
					$data = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor_id','1','$billingDecision',now())") or die(mysql_error());
					
					if($update_bill)
					{
						echo "<div class='thank_message'>Decision is Successfully Sent to Admin</div>";
						header("refresh:2;url=billing.php");
					}
					else
					{
						echo "There is Something going Wrong. Please try again Later.";
					}
				}
			?>
			<?php
				if(isset($_REQUEST['fid']) && isset($_REQUEST['action'])== "bill")
				{
			?>
				<?php
					$tempd = mysql_query("SELECT * FROM `bill_forward_underwriter` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]' && `underwriter_id`='$doctor_id'") or die(mysql_error());
					if(mysql_num_rows($tempd) > 0)
					{
				?>
				<h2>Accept Bill</h2>
						<div class="anesth_box_bg">
							<div class="anesth_row_heading">
								<div class="application_1">Date</div>
								<div class="application_2">Message</div>
								<div class="application_3">Physician</div>
								<div class="application_4">Facility</div>
								<div class="application_5">Other</div>
								<div class="application_6">Total</div>
							</div>
							<div class="anesth_box_bg">
								<?php 
									/*echo $k = "SELECT * , SUM( doctor_price ) AS totalcostd, SUM( facility_price ) AS totalcostf, SUM( anes_price ) AS totalcosta, SUM( doctor_price + facility_price + anes_price ) AS all_total
FROM  `billing_info`  WHERE form_id = '$_REQUEST[fid]' && user_id = '$_REQUEST[uid]' && `underwriter_id`='$doctor_id'";*/
									
									$sql = mysql_query("SELECT * , SUM( doctor_price ) AS totalcostd, SUM( facility_price ) AS totalcostf, SUM( anes_price ) AS totalcosta, SUM( doctor_price + facility_price + anes_price ) AS all_total
FROM  `billing_info`  WHERE form_id = '$_REQUEST[fid]' && user_id = '$_REQUEST[uid]' && `underwriter_id`='$doctor_id'") or die(mysql_error()); 
									
									$row = mysql_fetch_object($sql);
									$data = mysql_query("SELECT * FROM `bill_forward_underwriter` WHERE form_id='$_GET[fid]' && user_id='$_GET[uid]' && `underwriter_id`='$doctor_id'") or die(mysql_error());
									$sdata = mysql_fetch_object($data);
								?>
								<div class="client_row_content">
									<div class="application_1">
										<?php 
											$dataDate = $sdata->date_time;  
											echo date('m-d-Y',strtotime($dataDate));
										?>
									</div>
									<div class="application_2"><?php echo $sdata->admin_message; ?></div>
									<div class="application_3">
										<b>
											$<?php 
												$phytot = $row->totalcostd;
												echo number_format($phytot,2);
											?>
										</b>
									</div>
									<div class="application_4">
										<b>
											$<?php 
												$tfac = $row->totalcostf;
												echo number_format($tfac,2);
											?>
										</b>
									</div>
									<div class="application_5">
										<b>
											$<?php 
												$tother = $row->totalcosta;
												echo number_format($tother,2);
											?>
										</b>
									</div>
									<div class="application_6">
									<b>
										$<?php 
											$all_total = $row->all_total;
											echo number_format($all_total,2);
										?>
									</b>
									</div>
								</div>
							</div>
							<h2>Billing Information With CPT Codes</h2>
							<div class="anesth_row_heading">
								<div class="application_1">CPT Code</div>
								<div class="application_2">Description</div>
								<div class="application_3">Physician</div>
								<div class="application_4">Facility</div>
								<div class="application_5">Other</div>
								<div class="application_6">Total</div>
							</div>
							<?php
								/*$a = "SELECT * , doctor_price AS totalcostd, facility_price AS totalcostf, anes_price AS totalcosta, SUM( doctor_price + facility_price + anes_price ) AS all_total
FROM billing_info WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]' && `underwriter_id`='$doctor_id' group by billing_id";*/
								$t_data = mysql_query("SELECT * , doctor_price AS totalcostd, facility_price AS totalcostf, anes_price AS totalcosta, SUM( doctor_price + facility_price + anes_price ) AS all_total
FROM billing_info WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]' && `underwriter_id`='$doctor_id' group by billing_id") or die(mysql_error());
								while($cpt_code = mysql_fetch_object($t_data))
								{
							?>
								<div class="client_row_content">
									<div class="application_1"><?=$cpt_code->cpt_code?></div>
									<div class="application_2"><?=$cpt_code->description?></div>
									<div class="application_3">$<?php echo number_format($cpt_code->totalcostd,2); ?></div>
									<div class="application_4">$<?php echo number_format($cpt_code->totalcostf,2); ?></div>
									<div class="application_5">$<?php echo number_format($cpt_code->totalcosta,2); ?></div>
									<div class="application_6">$<?php echo number_format($cpt_code->all_total,2); ?></div>
								</div>
							<?php
								}
							?>
						</div>
					<div class="accept_case">
						<h2>Underwriter Decisions</h2>
						<form name="billing_update" method="post" action="" class="mess_msg_form">
						<?php
							$sql = mysql_query("SELECT * FROM `decisions`") or die(mysql_error());
							while($data = mysql_fetch_object($sql))
							{
						?>
						<div class="mess_msg_form_div">
							<div class="writter_decisions_l"><input type="radio" name="accept" selected	 value=<?php echo $data->id; ?>></div>
							<div class="writter_decisions_r"><?php echo $data->dec_name; ?></div>
							</div>
						<?php
							}
						?>
							<div class="mess_msg_form_div">
							<input type="submit" name="acceptcase" value="Action" class="write_btn">
							</div>
						</form>
						<?php
							$data = mysql_query("SELECT a . * , b . * FROM bill_forward_underwriter AS a, decisions AS b WHERE a.underwriter_message = b.id && a.`form_id`='$_REQUEST[fid]' && a.`user_id`='$_REQUEST[uid]' && a.`underwriter_id`='$doctor_id'") or die(mysql_error());
							if(mysql_num_rows($data)>0)
							{
								$data           = mysql_fetch_object($data);
								echo "Your Last Message has been forwarded to Admin: &nbsp;<h1>". $data->dec_name."</h1>";
							}
						?>
						
					</div>
			<?php
			}
			else{
				echo "Unexpected Error. Please Go Back";
			}
			}
			else
			{
			?>
			<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div> <h2>Funding Requests</h2>
			<div class="anesth_box_bg">
				<div class="anesth_row_heading">
					<div class="application_1">Client No.</div>
					<div class="application_2">Client Name</div>
					<div class="application_3">Date of Birth</div>
					<div class="application_4">Application Date</div>	
					<div class="application_5">Accept Billing</div>
					<div class="application_6">View Billing</div>		
				</div>
				<?php
				//echo $data = "SELECT * FROM `bill_forward_underwriter` WHERE `underwriter_id`='$doctor_id' and not message_underwriter=1";
					$temp_bill  = mysql_query("SELECT * FROM `bill_forward_underwriter` WHERE `underwriter_id`='$doctor_id' and not (`underwriter_message` = 1 || `underwriter_message` = 3) ") or die(mysql_error());
					if(mysql_num_rows($temp_bill)>0)
					{
						while($bill = mysql_fetch_object($temp_bill))
						{
				?>
							<div class="anesth_row_content">				
								<div class="application_1">
									<?php
										echo $form_id = $bill->form_id;
									?>
								</div>
								<div class="application_2">
									<?php
										echo $first_name = $functions->GetInfoPlantiffInformation("plantiff_name",$form_id);	
									?>
								</div>
								<div class="application_3">
									<?php
										echo $first_name = $functions->GetInfoPlantiffInformation("p_d_o_b",$form_id);
									?>
								</div>
								<div class="application_4">
									<?php
										$app_date = $functions->GetObjectFromPCTI("date_time",$form_id);
										echo date('Y-M-d',strtotime($app_date))."<br/>";
										echo date('h:m:s a',strtotime($app_date));
									?>
								</div>
								<div class="application_5">
									<a title="Check Status" href="check-status.php?fid=<?=$bill->form_id; ?>&uid=<?=$bill->user_id;?>&cid=<?=$functions->Getcidbyformid($form_id);?>" class="dr_check_status">View Application</a>
									
								</div>
								<div class="application_6"><a title="Accept Billing" href="billing.php?fid=<?=$bill->form_id; ?>&uid=<?=$bill->user_id;?>&action=bill">Summary of Charges</a></div>
							</div>
				<?php
						}
					}
					else
					{
						echo '<div class="anesth_row_content"><h1>No Funding Request</h1></div>';
					}
				}
				?>
			</div>
			
		</div>
	</div>
</section>
<?php
require($get_footer);
}
else
{
	
header('Location:../../login.php');
	
}
?>
