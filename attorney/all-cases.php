<?php 
session_start();
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
?><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<section class="row">
	<div class="container dashboard_bg">
		<div class="dr_upload_doc_slide">
			<div class="dr_message_side_bg">
			<div class="dr_message_side">
				<script>
						 $(document).ready(function() 
						 {
							 $(".view").load("latestmessages.php?attorneys_id=<?php echo $attorneys_id; ?>");
						   var refreshId = setInterval(function() {
							  $(".view").load('latestmessages.php?attorneys_id=<?php echo $attorneys_id; ?>');
						   }, 5000);
						   $.ajaxSetup({ cache: false });
						});
					</script>
					<div class="view"></div>
</div>					
			</div>
		</div>
		<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
		<div class="slide_right">
			<div class="dashbord_client">
				<div class="case_search">
					<form name="form1" method="get" action="">
						
							<input type="text" name="fname" placeholder="First Name" value="<?php if(isset($_REQUEST['fname'])){ echo $_REQUEST['fname'];} ?>" class="ser_txt_btn">
						
							<input type="text" name="email" placeholder="Email" value="<?php if(isset($_REQUEST['email'])){ echo $_REQUEST['email'];} ?>" class="ser_txt_btn">
						
							<input type="text" name="d_o_b" value="<?php if(isset($_REQUEST['d_o_b'])){ echo $_REQUEST['d_o_b'];} ?>" placeholder="Date of Birth" class="ser_txt_btn">
						
							<input type="submit" name="Search" value="Search" class="ser_btn">
						
							<input type="button" name="rest" onclick="window.location.href='all-cases.php'" value="Reset" class="ser_btn">
						
					</form>
				</div>
				<div class="client_row_heading">
						<div class="client_att_1">Client No.</div>
						<div class="client_att_2">Client Name</div>
						<div class="client_att_4">State</div>
						<div class="client_att_5">Application Date</div>
						<div class="client_att_6">Status</div>
						<div class="client_att_7">View</div>
					</div>
				<?php
					if(isset($_REQUEST['fname']) || isset($_REQUEST['email']) || isset($_REQUEST['d_o_b']))
					{
						$search_temp ="SELECT a . * , b . * FROM plantiff_information AS a,  `plantiff_case_type_info` AS b
					WHERE a.form_id = b.form_id && a.id = b.id && b.admin_approved = 0 && b.case_closed = 0 && b.attorney_id = '$attorneys_id'";
						if($_REQUEST['fname']!=""){	$search_temp .= " AND`plantiff_name` LIKE '%".$_REQUEST['fname']."%'";}
						if($_REQUEST['email']!=""){$search_temp .="AND `p_email_address` = '".$_REQUEST['email']."'";}
						if($_REQUEST['d_o_b']!=""){$search_temp .="AND `p_d_o_b`='".$_REQUEST['d_o_b']."'";}
						$search_tempk  = mysql_query($search_temp." order by a.form_id desc") or die(mysql_error());
						if(mysql_num_rows($search_tempk)>0)
						{
							while($search = mysql_fetch_object($search_tempk))
							{
					?>
					<div class="client_row_content">
							<input type="hidden" name="form_di" value="">
							<div class="client_att_1"><?php echo $search->form_id; ?></div>
							<div class="client_att_2">
								<?php 
									echo ucwords($search->plantiff_name); 
								?>
							</div>
							
							<div class="client_att_4">
								<?php 
									$state  = $search->p_state;
									if($state!=""){ echo $temp_profile->GetStatebyStateCode($state);}
								?>
								</div>
							<div class="client_att_5">
								<?php 
									//echo date('m-d-Y',strtotime($getinfo->p_date));
									$p_date = $search->p_date; list($a,$b) = explode(" ",$p_date); echo $a;			
								?>
							</div>
							
							
							
							<div class="client_att_6">
								<?php
									$check = $search->admin_approved;
									if($check == 1)
									{
										echo "Approved";
									}
									else
									{
										echo "Pending";
									}
								?>
							</div>
				
								
							<div class="client_att_7">
								<a class="dr_check_status" href="full-details.php?fid=<?php echo $search->form_id; ?>&uid=<?php echo $search->id; ?>&cid=<?php echo $search->case_type; ?>">
									View
								</a>
							</div>
							
						</div>		
					<?php
							}
						}
						else
						{
							echo "<h1 style='text-align:center;'>No Record Found.</h1>";
						}
					}
					else
					{
					$tempgetinfo = mysql_query("SELECT a . * , b . * FROM plantiff_information AS a,  `plantiff_case_type_info` AS b
					WHERE a.form_id = b.form_id && a.id = b.id && b.admin_approved = 0 && b.case_closed = 0 && b.attorney_id = '$attorneys_id' order by a.form_id desc") 
					or die(mysql_error());
					$tempget = mysql_num_rows($tempgetinfo);
					if($tempget>0)
					{
						while($getinfo=mysql_fetch_object($tempgetinfo))
						{
							$client_id = $getinfo->id;
	
				?>
						<div class="client_row_content">
							<input type="hidden" name="form_di" value="<?php echo $getinfo->form_id; ?>">
							<div class="client_att_1"><?php echo $getinfo->form_id; ?></div>
							<div class="client_att_2">
								<?php 
									echo ucwords($getinfo->plantiff_name); 
								?>
							</div>
							
							<div class="client_att_4">
								<?php 
									$state  = $getinfo->p_state;
									if($state!=""){ echo $temp_profile->GetStatebyStateCode($state);}
								?>
								</div>
							<div class="client_att_5">
								<?php 
									//echo date('m-d-Y',strtotime($getinfo->p_date));
									$p_date = $getinfo->p_date; list($a,$b) = explode(" ",$p_date); echo $a;			
								?>
							</div>
							
							
							
							<div class="client_att_6">
								<?php
									$check = $getinfo->admin_approved;
									if($check == 1)
									{
										echo "Approved";
									}
									else
									{
										echo "Pending";
									}
								?>
							</div>
				
								
							<div class="client_att_7">
								<a class="dr_check_status" href="full-details.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>">
									View
								</a>
							</div>
							
						</div>				
						
				<?php
						}
					}
					else
					{
						echo '<div class="client_row_content"><h1>There are no Cases Yet.</h1></div>';					
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
