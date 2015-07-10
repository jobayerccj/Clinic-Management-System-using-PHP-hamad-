<?php 
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');

if(loggedin()) 
{
/*Class file to call the functions*/
include('classes/meshed.php');
?>
<script type="text/javascript">
document.write('<style type="text/css">.tabber{display:none;}<\/style>');

var tabberOptions = {

  'manualStartup':true,

  'onLoad': function(argsObj) {
    /* Display an alert only after tab2 */
    if (argsObj.tabber.id == 'tab2') {
      alert('Finished loading tab2!');
    }
  },

  'onClick': function(argsObj) {

    var t = argsObj.tabber; /* Tabber object */
    var id = t.id; /* ID of the main tabber DIV */
    var i = argsObj.index; /* Which tab was clicked (0 is the first tab) */
    var e = argsObj.event; /* Event object */

    if (id == 'tab2') {
      return confirm('Swtich to '+t.tabs[i].headingText+'?\nEvent type: '+e.type);
    }
  },

  'addLinkId': true

};

</script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/tabs/tabber.js"></script>
<section class="row">
	<div class="container dashboard_bg">
			<div class="dr_upload_doc_slide">
			<div class="dr_message_side_bg">
				<h1>Latest Message</h1>
				<div class="dr_message_side">
					<?php
						$username1 = $_SESSION['username'];
						$a_iid=$getpanel->GetDetailsByUsername($username1,"id");
						$temp_message = mysql_query("SELECT * FROM `message_sent` where `main_user_id`='$a_iid'") or die(mysql_error());
						while($message= mysql_fetch_object($temp_message))
						{
					?>
						
						<div class="dr_message_side_row">
							<div class="dr_message_side_left">
								<label><?php echo $message->date_message; ?></label>
							</div>
							<div class="dr_message_side_right">
								<label><?php echo $message->message; ?></label>
							</div>
						</div>
					<?php
						}
					?>
				</div>		
			</div>
		</div>
		<div class="slide_right">
			<div class="dashbord_client">
				<h1>Cases</h1>
				<div class="tabber" id="tab1">
				  <div class="tabbertab">
					<h2><a name="tab1">Ortho Case<em></em></a></h2>
					<div class="search_head">
						<div><input type="text" name="fname" placeholder="First Name" class="ser_txt_btn"></div>
						<div><input type="text" name="lname" placeholder="Last Name" class="ser_txt_btn"></div>
						<div><input type="text" name="email" placeholder="Email" class="ser_txt_btn"></div>
						<div><input type="submit" name="Search" value="Search" class="ser_btn"></div>
					</div>
				<div class="client_row_heading">
						<div class="client_span_1">Client No.</div>
						<div class="client_span_2">Client Name</div>
						<div class="client_span_3">Email Address</div>
						<div class="client_span_4">State</div>
						<div class="client_span_5">Application Date</div>
						<div class="client_span_5">Check Status</div>
						<div class="client_span_6">Action</div>
					</div>
				<?php
					
					$tempgetinfo = mysql_query("SELECT a . * , b . * FROM plantiff_information AS a,  `plantiff_case_type_info` AS b
					WHERE a.form_id = b.form_id && a.id = b.id && b.case_type = 1 && b.admin_approved =1 && b.attorney_id = '$a_iid' order by a.form_id desc") 
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
							<div class="client_span_1"><?php echo $getinfo->form_id; ?></div>
							<div class="client_span_2">
								<?php 
									$firstname = $getpanel->GetObjectById($client_id,"first_name");
									$lastname  = $getpanel->GetobjectById($client_id,"last_name");
									echo ucwords($firstname)."&nbsp;".ucwords($lastname); 
								?>
							</div>
							<div class="client_span_3">
								<?php 
									echo $email_id = $getpanel->GetObjectById($client_id,"email_id"); 
								?>
							</div>
							<div class="client_span_4">
								<?php 
									$state  = $getinfo->p_state;
									echo $getpanel->GetStatebyStateCode($state);
								?>
								</div>
							<div class="client_span_5">
								<?php 
									echo date('Y-m-d',strtotime($getinfo->p_date)); 
								?>
							</div>
							
							
							
							<div class="attorney_monitor_5">
								<a href="check-status.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>">
									<span class="pending_status1">Approve</span>
								</a>
							</div>
				
								
							<div class="attorney_monitor_51">
								<a class="btn btn-default" href="other-documents.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>&action=upload">
									<span class="pending_status">Approve</span>
								</a>
							</div>
							
						</div>				
						
				<?php
						}
					}
					else
					{
						echo '<div class="client_row_content"><h1>There is no Approved Ortho Case</h1></div>';					}
				?>
				  </div>

				  <div class="tabbertab">
					<h2>Mesh Case</h2>
					<div class="search_head">
						<div><input type="text" name="fname" placeholder="First Name" class="ser_txt_btn"></div>
						<div><input type="text" name="lname" placeholder="Last Name" class="ser_txt_btn"></div>
						<div><input type="text" name="email" placeholder="Email" class="ser_txt_btn"></div>
						<div><input type="submit" name="Search" value="Search" class="ser_btn"></div>
					</div>
				<div class="client_row_heading">
						<div class="client_span_1">Client No.</div>
						<div class="client_span_2">Client Name</div>
						<div class="client_span_3">Email Address</div>
						<div class="client_span_4">State</div>
						<div class="client_span_5">Application Date</div>
						<div class="client_span_5">Check Status</div>
						<div class="client_span_6">Action</div>
					</div>
				<?php
					
					$tempgetinfo = mysql_query("SELECT a . * , b . * FROM plantiff_information AS a,  `plantiff_case_type_info` AS b
					WHERE a.form_id = b.form_id && a.id = b.id && b.case_type = 2 && b.admin_approved =1 && b.attorney_id = '$a_iid' order by a.form_id desc") 
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
							<div class="client_span_1"><?php echo $getinfo->form_id; ?></div>
							<div class="client_span_2">
								<?php 
									$firstname = $getpanel->GetObjectById($client_id,"first_name");
									$lastname  = $getpanel->GetobjectById($client_id,"last_name");
									echo ucwords($firstname)."&nbsp;".ucwords($lastname); 
								?>
							</div>
							<div class="client_span_3">
								<?php 
									echo $email_id = $getpanel->GetObjectById($client_id,"email_id"); 
								?>
							</div>
							<div class="client_span_4">
								<?php 
									$state  = $getinfo->p_state;
									echo $getpanel->GetStatebyStateCode($state);
								?>
								</div>
							<div class="client_span_5">
								<?php 
									echo date('Y-m-d',strtotime($getinfo->p_date)); 
								?>
							</div>
							
							
							
							<div class="attorney_monitor_5">
								<a href="check-status.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>">
									<span class="pending_status1">Approve</span>
								</a>
							</div>
				
								
							<div class="attorney_monitor_51">
								<a class="btn btn-default" href="other-documents.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>&action=upload">
									<span class="pending_status">Approve</span>
								</a>
							</div>
							
						</div>				
						
				<?php
						}
					}
					else
					{
						echo '<div class="client_row_content"><h1>There is no Approved Mesh Case</h1></div>';					}
				?>
				  </div>

				  <div class="tabbertab">
					<h2>Pain Management Case</h2>
					<div class="search_head">
						<div><input type="text" name="fname" placeholder="First Name" class="ser_txt_btn"></div>
						<div><input type="text" name="lname" placeholder="Last Name" class="ser_txt_btn"></div>
						<div><input type="text" name="email" placeholder="Email" class="ser_txt_btn"></div>
						<div><input type="submit" name="Search" value="Search" class="ser_btn"></div>
					</div>
				<div class="client_row_heading">
						<div class="client_span_1">Client No.</div>
						<div class="client_span_2">Client Name</div>
						<div class="client_span_3">Email Address</div>
						<div class="client_span_4">State</div>
						<div class="client_span_5">Application Date</div>
						<div class="client_span_5">Check Status</div>
						<div class="client_span_6">Action</div>
					</div>
				<?php
					
					$tempgetinfo = mysql_query("SELECT a . * , b . * FROM plantiff_information AS a,  `plantiff_case_type_info` AS b
					WHERE a.form_id = b.form_id && a.id = b.id && b.case_type = 3 && b.admin_approved =1 && b.attorney_id = '$a_iid' order by a.form_id desc") 
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
							<div class="client_span_1"><?php echo $getinfo->form_id; ?></div>
							<div class="client_span_2">
								<?php 
									$firstname = $getpanel->GetObjectById($client_id,"first_name");
									$lastname  = $getpanel->GetobjectById($client_id,"last_name");
									echo ucwords($firstname)."&nbsp;".ucwords($lastname); 
								?>
							</div>
							<div class="client_span_3">
								<?php 
									echo $email_id = $getpanel->GetObjectById($client_id,"email_id"); 
								?>
							</div>
							<div class="client_span_4">
								<?php 
									$state  = $getinfo->p_state;
									echo $getpanel->GetStatebyStateCode($state);
								?>
								</div>
							<div class="client_span_5">
								<?php 
									echo date('Y-m-d',strtotime($getinfo->p_date)); 
								?>
							</div>
							
							
							
							<div class="attorney_monitor_5">
								<a href="check-status.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>">
									<span class="pending_status1">Approve</span>
								</a>
							</div>
				
								
							<div class="attorney_monitor_51">
								<a class="btn btn-default" href="other-documents.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>&action=upload">
									<span class="pending_status">Approve</span>
								</a>
							</div>
							
						</div>				
						
				<?php
						}
					}
					else
					{
						echo '<div class="client_row_content"><h1>There is no Approved Pain Management Case</h1></div>';					}
				?>
				  </div>
				  <div class="tabbertab">
					<h2>General Surgery Case</h2>
					<div class="search_head">
						<div><input type="text" name="fname" placeholder="First Name" class="ser_txt_btn"></div>
						<div><input type="text" name="lname" placeholder="Last Name" class="ser_txt_btn"></div>
						<div><input type="text" name="email" placeholder="Email" class="ser_txt_btn"></div>
						<div><input type="submit" name="Search" value="Search" class="ser_btn"></div>
					</div>
				<div class="client_row_heading">
						<div class="client_span_1">Client No.</div>
						<div class="client_span_2">Client Name</div>
						<div class="client_span_3">Email Address</div>
						<div class="client_span_4">State</div>
						<div class="client_span_5">Application Date</div>
						<div class="client_span_5">Check Status</div>
						<div class="client_span_6">Action</div>
					</div>
				<?php
					
					$tempgetinfo = mysql_query("SELECT a . * , b . * FROM plantiff_information AS a,  `plantiff_case_type_info` AS b
					WHERE a.form_id = b.form_id && a.id = b.id && b.case_type = 4 && b.admin_approved =1 && b.attorney_id = '$a_iid' order by a.form_id desc") 
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
							<div class="client_span_1"><?php echo $getinfo->form_id; ?></div>
							<div class="client_span_2">
								<?php 
									$firstname = $getpanel->GetObjectById($client_id,"first_name");
									$lastname  = $getpanel->GetobjectById($client_id,"last_name");
									echo ucwords($firstname)."&nbsp;".ucwords($lastname); 
								?>
							</div>
							<div class="client_span_3">
								<?php 
									echo $email_id = $getpanel->GetObjectById($client_id,"email_id"); 
								?>
							</div>
							<div class="client_span_4">
								<?php 
									$state  = $getpanel->GetObjectById($client_id,"state"); 
									echo $getpanel->GetStatebyStateCode($state);
								?>
								</div>
							<div class="client_span_5">
								<?php 
									echo date('Y-m-d',strtotime($getinfo->p_date)); 
								?>
							</div>
							
							
							
							<div class="attorney_monitor_5">
								<a href="check-status.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>">
									<span class="pending_status1">Approve</span>
								</a>
							</div>
				
								
							<div class="attorney_monitor_51">
								<a class="btn btn-default" href="other-documents.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>&action=upload">
									<span class="pending_status">Approve</span>
								</a>
							</div>
							
						</div>				
						
				<?php
						}
					}
					else
					{
						echo '<div class="client_row_content"><h1>There is no Approved General Surgery Case.</h1></div>';					}
				?>
				  </div>
				  <div class="tabbertab">
					<h2>Spine/Neuro Form Case</h2>
					<div class="search_head">
						<div><input type="text" name="fname" placeholder="First Name" class="ser_txt_btn"></div>
						<div><input type="text" name="lname" placeholder="Last Name" class="ser_txt_btn"></div>
						<div><input type="text" name="email" placeholder="Email" class="ser_txt_btn"></div>
						<div><input type="submit" name="Search" value="Search" class="ser_btn"></div>
					</div>
				<div class="client_row_heading">
						<div class="client_span_1">Client No.</div>
						<div class="client_span_2">Client Name</div>
						<div class="client_span_3">Email Address</div>
						<div class="client_span_4">State</div>
						<div class="client_span_5">Application Date</div>
						<div class="client_span_5">Check Status</div>
						<div class="client_span_6">Action</div>
					</div>
				<?php
					
					$tempgetinfo = mysql_query("SELECT a . * , b . * FROM plantiff_information AS a,  `plantiff_case_type_info` AS b
					WHERE a.form_id = b.form_id && a.id = b.id && b.case_type = 5 && b.admin_approved =1 && b.attorney_id = '$a_iid' order by a.form_id desc") 
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
							<div class="client_span_1"><?php echo $getinfo->form_id; ?></div>
							<div class="client_span_2">
								<?php 
									$firstname = $getpanel->GetObjectById($client_id,"first_name");
									$lastname  = $getpanel->GetobjectById($client_id,"last_name");
									echo ucwords($firstname)."&nbsp;".ucwords($lastname); 
								?>
							</div>
							<div class="client_span_3">
								<?php 
									echo $email_id = $getpanel->GetObjectById($client_id,"email_id"); 
								?>
							</div>
							<div class="client_span_4">
								<?php 
									$state  = $getinfo->p_state;
									echo $getpanel->GetStatebyStateCode($state);
								?>
								</div>
							<div class="client_span_5">
								<?php 
									echo date('Y-m-d',strtotime($getinfo->p_date)); 
								?>
							</div>
							
							
							
							<div class="attorney_monitor_5">
								<a href="check-status.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>">
									<span class="pending_status1">Approve</span>
								</a>
							</div>
				
								
							<div class="attorney_monitor_51">
								<a class="btn btn-default" href="other-documents.php?fid=<?php echo $getinfo->form_id; ?>&uid=<?php echo $getinfo->id; ?>&cid=<?php echo $getinfo->case_type; ?>&action=upload">
									<span class="pending_status">Approve</span>
								</a>
							</div>
							
						</div>				
						
				<?php
						}
					}
					else
					{
						echo '<div class="client_row_content"><h1>There is no Approved Spine/Neuro Form</h1></div>';					}
				?>
					</div>				
				</div>
				<script type="text/javascript">
					tabberAutomatic(tabberOptions);
				</script>
			</div>
		</div>
	</div>
</div>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $sitepath; ?>/popup/featherlight.min.css" title="Featherlight Styles" />
<script src="<?php echo $sitepath; ?>/popup/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo $sitepath; ?>/popup/style.css">
<?php
require($get_footer);
}
else
{
	
header('Location:../../login.php');
	
}
?>
