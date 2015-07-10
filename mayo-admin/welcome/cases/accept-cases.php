<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include($config);
include '../../functions.php';
include '../classes/Cases.php';
$functions = $_SERVER['DOCUMENT_ROOT']."/rao/classes/functions.php";
require_once($functions);
$getinformation = new Allfunctions();
?>
<?php
if(loggedin())
{
	$header_admin = $_SERVER['DOCUMENT_ROOT']."/rao/mayo-admin/welcome/header.php";
	require_once($header_admin);
?>
<div class="container dashboard_bg tabber" id="tab1">
		<div class="tabbertab">
			<h2><a name="tab1">View Application</a></h2>
			<div class="view_application">
				<div class="client_1">
					<div class="view_client_row">
						<h1>Plantiff Information</h1>
					</div>
					<?php
						$qry = "SELECT a . *, b . * , c . * FROM plantiff_information AS a, plantiff_case_type_info AS b, members AS c
WHERE a.form_id ='".$_GET['id']."' && b.form_id = '".$_GET['id']."' && a.id = c.id && b.id = c.id";
						$sql = mysql_query($qry) or die(mysql_error());
						$row = mysql_fetch_array($sql);
					?>
					<div class="view_client_row">
						<div class="client_left">
							<label>Plantiff Name</label>
							<label class="filled_label"><?php echo $row['plantiff_name']; ?></label>
						</div>
						<div class="client_right">
							<label>Date</label>
							<label class="filled_label"><?php echo $row['p_date']; ?></label>
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
							<label class="filled_label"><?php echo $row['p_email_address']; ?></label>
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
						<label class="filled_label"><?php echo $row['p_address']; ?></label>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>State</label>
							<label class="filled_label"><?php echo $row['p_state']; ?></label>
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
						<label>Auto Insurance Carrier (Auto collision only)</label>
						<label class="filled_label">1<?php echo $row['auto_insurance']; ?></label>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<div class="form_field_left">
								<label>UM / UIM</label>
							</div>
							<div class="form_field_right">
								<label class="filled_label">
								<?php
									if($row['um_uim'] == "yes")
									{
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim1" checked> Yes';
									?>
										
									<?php
									}
									else if($row['um_uim']== "no")
									{
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim1" checked> No';
									}
									else
									{
										echo '<input type="radio" value="'.$row['um_uim'].'" name="um_uim1" checked> N/A';
									}
								?>
								</label>
							</div>	
						</div>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<div class="form_field_left">
								<label>Client ever claim bankruptcy ?</label>
							</div>
							<div class="form_field_right">
								<label class="filled_label">
									<?php
									if($row['client_bankrupty'] == "yes")
									{
										echo '<input type="radio" value="'.$row['client_bankrupty'].'" name="client_bank" checked> Yes';
									}
									else if($row['client_bankrupty']== "no")
									{
										echo '<input type="radio" value="'.$row['client_bankrupty'].'" name="client_bank" checked> No';
									}
									else
									{
										echo '<input type="radio" value="'.$row['client_bankrupty'].'" name="client_bank" checked> N/A';
									}	
								?>
								</label>
							</div>
						</div>
					</div>
				</div><!--client_1_end-->
				<div class="client_2">
					<h1>Plantiff’s Attorney’s Information</h1>
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
				</div><!--client_2_end-->
				<div class="client_2">
					<h1>Defendant Infomation Insurance ( information is neededwhether or not in suit)</h1>
					<div class="view_client_row">
						<label>Defendant Name</label>
						<label class="filled_label"><?php echo $row['defendant_name']; ?></label>
					</div>
					<div class="view_client_row">
						<label>Insurance Company</label>
						<label class="filled_label"><?php echo $row['insurance_company']; ?></label>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Claim No</label>
							<label class="filled_label"><?php echo $row['claim_no']; ?></label>
						</div>
						<div class="client_right">
							<label>Limits</label>
							<label class="filled_label"><?php echo $row['d_limits']; ?></label>
						</div>
					</div>
				</div><!--client_2_end-->
				<div class="client_2">
					<h1>Incident Information</h1>
					<div class="view_client_row">
						<label>Date of Injury</label>
						<label class="filled_label"><?php echo $row['date_injury']; ?></label>
					</div>
					<div class="view_client_row">
						<label>Location of Event</label>
						<label class="filled_label"><?php echo $row['location_of_event']; ?></label>
					</div>
					<div class="view_client_row">
						<div class="client_left">
							<label>Description of the Event</label>
							<label class="filled_label"><?php echo $row['description_of_event']; ?></label>
						</div>
						<div class="client_right">
							<label>Description of the Injury</label>
							<label class="filled_label"><?php echo $row['description_of_injury']; ?></label>
						</div>
					</div>
				</div><!--client_2_end-->
				<div class="client_3">
					<h1>Please also provide the following, if Available</h1>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Police / Accident Report</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
								<?php
									if($row['police_report'] == "yes")
									{
										echo '<input type="radio" value="'.$row['police_report'].'" name="police_rep" checked> Yes';
									}
									else
									{
										echo '<input type="radio" value="'.$row['police_report'].'" name="police_rep" checked> No';
									}
								?>
							</label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Medical Record</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
								<?php
									if($row['others_injured_too'] == "yes")
									{
										echo '<input type="radio" value="'.$row['others_injured_too'].'" name="um_uim" checked> Yes';
									}
									else
									{
										echo '<input type="radio" value="'.$row['others_injured_too'].'" name="um_uim" checked> No';
									}
								?>	
								</label>
						</div>
					</div>
					<div class="view_client_row">
						<div class="form_field_left">
							<label>Medical Bill</label>
						</div>
						<div class="form_field_right">
							<label class="filled_label">
							<?php
									if($row['witness'] == "yes")
									{
										echo '<input type="radio" value="'.$row['witness'].'" name="witnes" checked> Yes';
									}
									else
									{
										echo '<input type="radio" value="'.$row['witness'].'" name="witnes" checked> No';
									}
								?>
							</label>
						</div>
					</div>
					</div>
			</div>
		</div>
		<div class="tabbertab">
			<h2>Documents</h2>
			<div class="dashbord_client">
				<div class="update_status_botom">
					<div class="view_client_row">
		<label class="filled_label">
		<div class="dashbord_client">
			<h1>Documents Missing</h1>
			<div class="client_box_bg">
	<form>
		<div class="hire_left">
			<form name="documents_missing" method="get" action="">
				<div class="dashboard_row">
					<label>Message</label>
					<textarea name="document_message" required></textarea>
					<input type="hidden" name="user_id" value="<?php echo $id = $row['id']; ?>">
					<input type="hidden" name="main_user_id" value="<?php echo $att_id = $row['attorney_id']; ?>">
					<?php
						echo $user_email_id=$getinformation->GetObjectById($id,"email_id");
						echo $att_email_id=$getinformation->GetObjectById($att_id,"email_id");
					?>
				</div>
				<div class="dashboard_row">
					<input type="submit" name="documents_missing" id="" value="Submit"/>
				</div>
			</form>
		</div>
		<div class="hire_right">
				<h1>Accept Case</h1>
				<form name="accept_case" method="post" action="">
					<div class="dashboard_row">
						<label>Message</label>
						<textarea required></textarea>
					</div>
					<div class="dashboard_row">
						<input type="submit" name="acceptcase" id="" value="Submit"/>
					</div>
			</form>
			<?php
				if(isset($_GET['documents_missing']))
				{
					$message_docs= $_GET['documentsmissing'];
					$main_user_id = $_GET['main_user_id'];
					$user_id      = $_GET['user_id'];
					$subject = "Message Sent from Mayo Department"; 
					$tempmissing = mysql_query("INSERT INTO `documents_messages` (`form_id`,`user_id`,`main_user_id`,`documents_messages`,`date_document`) 
					VALUES ('$_GET[id]','$user_id','$main_user_id,'$message_docs',now()) ")or die(mysql_error());
					echo $getinformation->SendEmail($user_email_id,$subject,$message_docs);
					echo $getinformation->SendEmail($att_email_id,$subject,$message_docs);
					if($tempmissing)
					{
						echo "Message is Sucessfully Sent";
						
					}
					else
					{
						echo "Some Problems Occured. Please Try again";
					}
					header("url=http://$sitepath/mayo-admin/welcome/cases/new-cases.php?id=$_REQUEST[id]");
				}

				if(isset($_POST['acceptcase']))
				{
					$tempacceptcas = mysql_query("UPDATE `plantiff_case_type_info` set `admin_approved`='1' ") or die(mysql_error());
				}
					
			?>
			
		</div>	 

</div>
<h1>Uploaded Documents</h1>
			<div class="client_box_bg">
				<div class="client_row_heading">
					<div class="client_span_1">Sr. No.</div>
					<div class="client_span_2">Document Name</div>
					<div class="client_span_3">Description</div>
					<div class="client_span_4">Document Type</div>
					<div class="client_span_5">Date</div>
					<div class="client_span_6">View</div>
				</div>
				<?php
				$i=1;
					$temp_docs = mysql_query("SELECT * FROM `upload_documents` where `form_id`='$_REQUEST[id]'") or die(mysql_error());
					while($docs= mysql_fetch_object($temp_docs))
					{
				?>
							<div class="client_row_content">
								<div class="client_span_5"><?php echo $i; ?></div>
								<div class="client_span_1"><?php echo $docs->name_of_document; ?></div>
								<div class="client_span_2"><?php echo $docs->message; ?></div>
								<div class="client_span_3"><?php echo $docs->related_to; ?></div>
								<div class="client_span_4"><?php echo $docs->upload_date; ?></div>
								<div class="client_span_6">
									<a target="_blank" href="<?php echo $sitepath;?>/uploads/<?php echo $docs->upload_document_path; ?>">view</a>
								</div>
							</div>
				<?php	
					$i++;
					}
				?>
		</div>
		</label>
	</div>
</div>
				</div>
			</div>
		</div>
		<div class="tabbertab">
			<h2>Hire Application</h2>
			<div class="dashbord_client dashboard_boder">
				<h1>Process Verified Clients</h1>
				<div class="client_box_bg">
					<form>
						<div class="hire_left">
							<div class="dashboard_row">
								<label>Choose Department</label>
								<select>
									<option>Select Department</option>
									<option>Doctor</option>
									<option>Attorney</option>
									<option>Underwriter</option>
									<option>Underwriter</option>
								</select>
							</div>
							<div class="dashboard_row">
								<label>Employee Name</label>
								<select>
									<option>Select Department</option>
									<option>Doctor</option>
									<option>Attorney</option>
									<option>Underwriter</option>
									<option>Underwriter</option>
								</select>
							</div>
						</div>
						<div class="hire_right">
							<div class="dashboard_row">
								<label>Message</label>
								<textarea></textarea>
							</div>
							<div class="dashboard_row">
								<input type="submit" name="" id="" value="Submit"/>
							</div>
						</div>	 
					</form>
				</div>	
			</div>
			<div class="dashbord_client">
				<h1>Details List</h1>
				<div class="client_box_bg">
					<div class="dashboard_row_heading">
						<div class="dashboard_span_1">Case Type</div>
						<div class="dashboard_span_2">Choose Department</div>
						<div class="dashboard_span_3">Employee Name</div>
						<div class="dashboard_span_4">Message</div>
					</div>
					<div class="client_row_content">
						<div class="dashboard_span_1">1024568</div>
						<div class="dashboard_span_2">Mayo Surgical</div>
						<div class="dashboard_span_3">joham_william@gmail.com</div>
						<div class="dashboard_span_4">Mayo Lipsum</div>
					</div>
					<div class="client_row_content">
						<div class="dashboard_span_1">1024568</div>
						<div class="dashboard_span_2">Mayo Surgical</div>
						<div class="dashboard_span_3">joham_william@gmail.com</div>
						<div class="dashboard_span_4">Mayo Lipsum</div>
					</div>
					<div class="client_row_content">
						<div class="dashboard_span_1">1024568</div>
						<div class="dashboard_span_2">Mayo Surgical</div>
						<div class="dashboard_span_3">joham_william@gmail.com</div>
						<div class="dashboard_span_4">Mayo Lipsum</div>
					</div>
					<div class="client_row_content">
						<div class="dashboard_span_1">1024568</div>
						<div class="dashboard_span_2">Mayo Surgical</div>
						<div class="dashboard_span_3">joham_william@gmail.com</div>
						<div class="dashboard_span_4">Mayo Lipsum</div>
					</div>
					<div class="client_row_content">
						<div class="dashboard_span_1">1024568</div>
						<div class="dashboard_span_2">Mayo Surgical</div>
						<div class="dashboard_span_3">joham_william@gmail.com</div>
						<div class="dashboard_span_4">Mayo Lipsum</div>
					</div>
					<div class="client_row_content">
						<div class="dashboard_span_1">1024568</div>
						<div class="dashboard_span_2">Mayo Surgical</div>
						<div class="dashboard_span_3">joham_william@gmail.com</div>
						<div class="dashboard_span_4">Mayo Lipsum</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tabbertab">
			<h2>Update Status</h2>
			<div class="dashbord_client">
				<div class="update_status_top">
					<h1>Update Status</h1>
					<form>
						<textarea placeholder="Update client status"></textarea>
						<input type="submit" name="" id="" value="Submit"/>
					</form>
				</div>
				<div class="update_status_botom">
					<div class="update_status_row_heading">
						<div class="update_status_span_1">Date</div>
						<div class="update_status_span_2">Message</div>
						<div class="update_status_span_3">Status</div>
					</div>
					<div class="update_status_row">
						<div class="update_status_span_1">21-10-2014</div>
						<div class="update_status_span_2">Client-side JavaScript does not allow the reading or writing of files. </div>
						<div class="update_status_span_3">Status</div>
					</div>
					<div class="update_status_row">
						<div class="update_status_span_1">21-10-2014</div>
						<div class="update_status_span_2">Client-side JavaScript does not allow the reading or writing of files. </div>
						<div class="update_status_span_3">Status</div>
					</div>
					<div class="update_status_row">
						<div class="update_status_span_1">21-10-2014</div>
						<div class="update_status_span_2">Client-side JavaScript does not allow the reading or writing of files. </div>
						<div class="update_status_span_3">Status</div>
					</div>
					<div class="update_status_row">
						<div class="update_status_span_1">21-10-2014</div>
						<div class="update_status_span_2">Client-side JavaScript does not allow the reading or writing of files. </div>
						<div class="update_status_span_3">Status</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
}
else 
{ 
header('Location:../../login.php');
}
?>
<script src="http://<?php echo $jqueryminjs; ?>"></script>
<script src="http://<?php echo $validateminjs; ?>"></script>
<!--<script type="text/javascript">
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
<script type="text/javascript" src="<?php //echo $sitepath; ?>/tabs/tabber.js"></script>
<script type="text/javascript">
	tabberAutomatic(tabberOptions);
</script>
</div>
	</div>
</section>-->
<?php
require($get_footer);
?>
