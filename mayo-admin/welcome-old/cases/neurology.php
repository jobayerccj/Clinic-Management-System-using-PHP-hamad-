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
$desg = new Cases();
$functions = $_SERVER['DOCUMENT_ROOT']."/rao/classes/functions.php";
require_once($functions);
$getinformation = new Allfunctions();
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
<script language="javascript" type="text/javascript">
function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getUser(desgntnId) {		
		
		var strURL="find-user.php?desgntn="+desgntnId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('result').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function getInfo(usersId) {		
		var strURL="getInfo.php?user_details="+usersId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('result2').innerHTML=req.responseText;						
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 

        <script type="text/javascript">
            $(document).ready(function(){
                function loading_show(){
                    $('#loading').html("<img src='images/loading.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax
                    ({
                        type: "POST",
                        url: "neurology-temp.php",
                        data: "page="+page,
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);
                    
                });           
                $('#go_btn').live('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
            });
        </script>
<?php
if(loggedin())
{
	$header_admin = $_SERVER['DOCUMENT_ROOT']."/rao/mayo-admin/welcome/header.php";
	require_once($header_admin);
?>
<section class="row">
	<div class="container">
		<?php if(isset($_REQUEST['id']))
		{
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
WHERE a.form_id ='".$_REQUEST['id']."' && b.form_id = '".$_REQUEST['id']."' && a.id = c.id && b.id = c.id";
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

		<div class="dashbord_client">
			<h1>Documents Missing</h1>
			<div class="client_box_bg">
				<?php
					$admin    = $_SESSION['username'];
					$admin_id = $getinformation->GetDetailsByUsername($admin,"id");
				?>

			<form name="documentsmissing" method="post" action="">
				<div class="dashboard_row">
					<label>Message</label>
					<textarea name="document_message" required></textarea>
					<input type="hidden" name="user_id" value="<?php echo $id = $row['id']; ?>">
					<input type="hidden" name="main_user_id" value="<?php echo $att_id = $row['attorney_id']; ?>">
					<?php
						$user_email_id=$getinformation->GetObjectById($id,"email_id");
						$att_email_id=$getinformation->GetObjectById($att_id,"email_id");
					?>
				</div>
				<div class="dashboard_row">
					<input type="submit" name="documents" id="" value="Submit"/>
				</div>
			</form>
			<?php
				
				$datetime     = date("Y-m-d H:i:s a");
				
				if(isset($_REQUEST['documents']))
				{
					$main_user_ida = $_REQUEST['main_user_id'];
					$uid          = $_REQUEST['user_id']; 
					$message_docs = $_REQUEST['document_message'];
					$message      = $_REQUEST['document_message'];
		
					$subject      = "Message Sent from Mayo Department"; 
					$extravalues  = array("Message" => $message,"Note:"=>"Documents are Missing");
					$tempmissing  = "INSERT INTO `documents_messages` (`form_id`,`user_id`,`main_user_id`,`date_document`) 
					VALUES ('$_GET[id]','$uid','$main_user_ida',now())";
					$tempmess     = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES 
					('$_REQUEST[id]','$uid','$admin_id','$main_user_ida','$message_docs','$datetime') ")or die(mysql_error());
					$final  = mysql_query($tempmissing) or die(mysql_error());
					$getinformation->SendEmail($user_email_id,$subject,$message,$extravalues);
					$getinformation->SendEmail($att_email_id,$subject,$message,$extravalues);
					if($final)
					{
						echo "Message Sent Successfully";
					}
					else
					{
						echo "There is the error";
					}
				}
			?>


				<h1>Accept Case</h1>
				<form name="acceptcase" method="post" action="">
					<div class="dashboard_row">
						<label>Message</label>
						<textarea name="accept_message" required></textarea>
					</div>
					<input type="hidden" name="user_id" value="<?php echo $id = $row['id']; ?>">
					<input type="hidden" name="main_user_id" value="<?php echo $att_id = $row['attorney_id']; ?>">
					<?php
						$user_email_id1 = $getinformation->GetObjectById($id,"email_id");
						$u_f_name       = $getinformation->GetObjectById($id,"first_name");
						$u_l_name       = $getinformation->GetObjectById($id,"last_name");
						$cont_number    = $getinformation->GetObjectById($id,"contact_number");
						$att_email_id1  = $getinformation->GetObjectById($att_id,"email_id");
					?>
					<div class="dashboard_row">
						<input type="submit" name="acceptcase" id="" value="Submit"/>
					</div>
				</form>
			<?php
				 
				if(isset($_POST['acceptcase']))
				{
					$main_user_id   = $_POST['main_user_id'];
					$mess = $_POST['accept_message'];
					$tempacceptcas = mysql_query("UPDATE `plantiff_case_type_info` set `admin_approved`='1' where `form_id`='$_REQUEST[id]' && `id`='$_REQUEST[uid]'") or die(mysql_error());
					$tempquer      = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) 
					VALUES ('$_REQUEST[id]','$_REQUEST[uid]','$admin_id','$main_user_id','$mess','$datetime')") or die(mysql_error());
					$deleteq = mysql_query("DELETE FROM `documents_messages` where `form_id`='$_REQUEST[id]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
					if($deleteq)
					{
						$subject="Case is Accepted by Mayo for further Processing";
						$message="Case Accepted Successfully";
						$extravalues2 = array("Note" =>"Please Confirm your Case");
						$extravalues1 = array("First Name" => $u_f_name,"Last Name" => $u_l_name,"Contact No"=>$cont_number);
						$getinformation->SendEmail($user_email_id1,$subject,$message,$extravalues2);
						$getinformation->SendEmail($att_email_id1,$subject,$message,$extravalues1);
						echo "Case is Accepted";
					}
					else
					{
						echo "Something Went Wrong. Please Try Again";
					}
				}
					
			?>
			


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

	</div>
</div>
				</div>
			</div>
		</div>
		<div class="tabbertab">
			<h2>Assign Professionals</h2>
			<div class="dashbord_client dashboard_boder">
				<h1>Process Verified Clients</h1>
				<div class="client_box_bg">
					<form name="form1" method="post" action="">
						<div class="hire_left">
							<div class="dashboard_row">
								<label>Choose Department</label>
								<select name="desgntn" onchange="getUser(this.value)">
									<option>Select Department</option>
									<?php echo $desg->getdesignation(); ?>
								</select>
							</div>
							<div class="dashboard_row">
								<label>Employee Name</label>
								<div id="result">
									<select name="members" >
										<option value="">...Select...</option>
									</select>
								</div>
								<div id="result2"></div>
								
							</div>
						</div>
						<div class="hire_right">
							<div class="dashboard_row">
								<label>Message</label>
								<textarea name="hire_message"></textarea>
							</div>
							<div class="dashboard_row">
								<input type="submit" name="hire_button" id="" value="Submit"/>
							</div>
						</div>	 
					</form>
					<?php
						$date_time     = date("Y-m-d H:i:s a");
						if(isset($_POST['hire_button']))
						{
							$desgntn      = $_REQUEST['desgntn'];
							$getname      = $getinformation->GetDesgBydesId($desgntn);
							
							/*client info*/
						    $user_id_req   = $_REQUEST['uid'];
							$fname         = $getinformation->GetObjectById($user_id_req,"first_name");
							$lname         = $getinformation->GetObjectById($user_id_req,"last_name");
							$c_email_id    = $getinformation->GetObjectById($user_id_req,"email_id");
							$contact_cl    = $getinformation->GetObjectById($user_id_req,"email_id");
							/*end*/
							
							/*Hire information*/
							$hire_id       = $_REQUEST['user_details'];
							$h_f_name      = $getinformation->GetObjectById($hire_id,"first_name");
							$l_f_name      = $getinformation->GetObjectById($hire_id,"last_name");
							$s_email_id    = $getinformation->GetObjectById($hire_id,"email_id");
							$s_email_id    = $getinformation->GetObjectById($hire_id,"email_id");
							$contact_h     = $getinformation->GetObjectById($hire_id,"email_id");
							/*End*/
							
							/*Emails*/
							$c_subject     = "Case Successfully Transferred";
							$s_subject     = "New Case Information";
							$s_message     = $_REQUEST['hire_message']; 
							/*ends*/
							$message_c     = "Client Details";
							$extravalues_c = array("Name" =>ucwords($h_f_name),"Email Id" =>$c_email_id,"Contact No" =>$contact_cl);
							$extravalues_s = array("Name" =>ucwords($fname),"Email Id" =>$s_email_id ,"Contact No" =>$contact_h);
							$form_id_req   = $_REQUEST['id'];
							
							/*Store Hire Information*/ 
							
							$temp_hire     = mysql_query("INSERT INTO `hire_staff` (`form_id`,`hire_id`,`user_id`,`date_time`)VALUES 
							('$form_id_req','$hire_id','$user_id_req','$date_time')") or die(mysql_error());
							
							/*Store Messsage*/    
							$mess_insert   = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`main_user_id`,`message`,`date_message`) VALUES 
							('$form_id_req','$user_id_req','$hire_id','$s_message ','$date_time')") or die(mysql_error());
							/*Delete user record from upload Documents*/
							//$delete_docs   = mysql_query("DELETE FROM `documents_messages` WHERE `form_id`='$_REQUEST[id]'") or die(mysql_error());
							//header("refresh:3;url=http://$sitepath/mayo-admin/welcome/cases/new-cases.php?id=$_REQUEST[id]&uid=$_REQUEST[uid]/#tabnav3");
							if($temp_hire)
							{
								$sendmail_client = $getinformation->SendEmail($c_email_id,$c_subject,$message_c,$extravalues_c);
								$sendmail_staff  = $getinformation->SendEmail($s_email_id,$s_subject,$s_message,$extravalues_s);
								echo $getname." ".ucwords($h_f_name)." ".ucwords($l_f_name)." is Successfully Assigned to ".ucwords($fname)." ".ucwords($lname);
							}
						}
					?>
				</div>	
			</div>
			<div class="dashbord_client">
				<h1>Details List</h1>
				<div class="client_box_bg">
					<div class="dashboard_row_heading">
						<div class="dashboard_span_1">Case Type</div>
						<div class="dashboard_span_2">Choose Department</div>
						<div class="dashboard_span_3">Employee Name</div>
						<div class="dashboard_span_3">Email ID</div>
						<div class="dashboard_span_4">Message</div>
					</div>
					<?php
						$count=0;
						$temp_hired_inform = mysql_query("SELECT * FROM `hire_staff` WHERE `user_id`= '$_REQUEST[uid]'") or die(mysql_error());
							while($data        = mysql_fetch_object($temp_hired_inform))
							{
								$count++;
								echo $hire_id = $data->hire_id;
								if($count>0)
								{
					?>
								<div class="client_row_content">
									<div class="dashboard_span_1"><?php echo $data->form_id; ?></div>
									<div class="dashboard_span_2">
										<?php 
											$department = $getinformation->GetObjectById($hire_id,"designation"); 
											echo $depar = $getinformation->GetDesgBydesId($department);
										?>
									</div>
									<div class="dashboard_span_3">
										<?php 
											$hire_id = $data->hire_id; 
											$f_name  = $getinformation->GetObjectById($hire_id,"first_name");
											$l_name  = $getinformation->GetObjectById($hire_id,"last_name");
											echo ucwords($f_name)."&nbsp".ucwords($l_name);
										?>
										</div>
									<div class="dashboard_span_3">
										<?php 
											echo $email_id  = $getinformation->GetObjectById($hire_id,"email_id"); 
										?>
									</div>
									<div class="dashboard_span_4">
										<?php 
											$u_id = $_REQUEST['uid'];
											$hire_id;
											// $m_u_id = $getinformation->GetMessage("main_user_id",$hire_id);
											echo $message = $getinformation->GetMessageByUidAndMid("message",$u_id,$hire_id);
										?>
										</div>
								</div>
						<?php 
							}
							else
							{
						?>
							<div class="client_row_content">
								<h1>No Team is selected for this Client.</h1>		
							</div>
						<?php
							}
						} 
						?>
				</div>
			</div>
		</div>
		<div class="tabbertab">
			<h2>Update Status</h2>
			<div class="dashbord_client">
				<div class="update_status_top">
					<h1>Update Status</h1>
					<form name="update_status" method="post" action="">
						<textarea name="status" placeholder="Update client status"></textarea>
						<input type="submit" name="send_status" id="" value="Submit"/>
					</form>
					<?php
						if(isset($_POST['send_status']))
						{
							$status    = $_POST['status'];
							$form_s_id = $_REQUEST['id'];
							$use_id    = $_REQUEST['uid'];
							$query     = mysql_query("INSERT INTO `status_update` (`form_id`,`user_id`,`main_user_id`,`status_messages`,`date_status`) 
							VALUES ('$form_s_id','$use_id','1','$status','$date_time')") or die(mysql_error());
							if($query)
							{
								echo "Status is Successfully Updated";
							}
							else
							{
								echo "There is some problem";
							}
						}
					?>
				</div>
				<div class="update_status_botom">
					<div class="update_status_row_heading">
						<div class="update_status_span_1">Date</div>
						<div class="update_status_span_2">Update By</div>
						<div class="update_status_span_3">Status</div>
					</div>
					<?php
						$count=0;
						$temp_getstatus = mysql_query("SELECT * FROM `status_update` where `form_id`='$_REQUEST[id]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
						while($getstatus= mysql_fetch_object($temp_getstatus))
						{
							$count++;
							if($count>0)
							{
					?>
							<div class="update_status_row">
								<div class="update_status_span_1">
									<?php 
										$tempdate = $getstatus->date_status;
										echo $date_time = date("Y-M-d",strtotime($tempdate))."<br/>"; 
										echo $datetime = date("H:m:s a",strtotime($tempdate));
									?>
								</div>
								<div class="update_status_span_2">
									<?php 
										$a_id = $getstatus->id;
										$fname = $getinformation->GetObjectById($a_id,"first_name");
										$lname = $getinformation->GetObjectById($a_id,"last_name");
										echo ucwords($fname)."&nbsp;";
										echo ucwords($lname);
										//echo $temdes= $getinformation->GetObjectById($a_id,"designation");									
									?>
								</div>
								<div class="update_status_span_3"><?php echo $getstatus->status_messages; ?></div>
							</div>
					<?php	
						}
						else
						{
					?>
							<div class="update_status_row">
								No Status Update Till now.
							</div>
					<?php
						}
						}
					?>
				</div>
			</div>
		</div>
		<div class="tabbertab">
			<h2>Message</h2>
			<div class="dashbord_client">
				<div class="update_status_top">
					<h1>Message</h1>
					<form name="update_status" method="post" action="">
						<textarea name="status" placeholder="Update client status"></textarea>
						<input type="submit" name="send_status" id="" value="Submit"/>
					</form>
					
				</div>
				<div class="update_status_botom">
					<div class="update_status_row_heading">
						<div class="update_status_span_1">Date</div>
						<div class="update_status_span_2">Update By</div>
						<div class="update_status_span_3">Status</div>
					</div>
					<?php
						$count=0;
						$temp_getstatus = mysql_query("SELECT * FROM `status_update` where `form_id`='$_REQUEST[id]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
						while($getstatus= mysql_fetch_object($temp_getstatus))
						{
							$count++;
							if($count>0)
							{
					?>
							<div class="update_status_row">
								<div class="update_status_span_1">
									<?php 
										$tempdate = $getstatus->date_status;
										echo $date_time = date("Y-M-d",strtotime($tempdate))."<br/>"; 
										echo $datetime = date("H:m:s a",strtotime($tempdate));
									?>
								</div>
								<div class="update_status_span_2">
									<?php 
										$a_id = $getstatus->id;
										$fname = $getinformation->GetObjectById($a_id,"first_name");
										$lname = $getinformation->GetObjectById($a_id,"last_name");
										echo ucwords($fname)."&nbsp;";
										echo ucwords($lname);
										//echo $temdes= $getinformation->GetObjectById($a_id,"designation");									
									?>
								</div>
								<div class="update_status_span_3"><?php echo $getstatus->status_messages; ?></div>
							</div>
					<?php	
						}
						else
						{
					?>
							<div class="update_status_row">
								No Status Update Till now.
							</div>
					<?php
						}
						}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
		
		<?php
		}
		else
		{
		?>
		<div class="form_section_content">
			<h1 class="add_user">User's Verification</h1>
			<div class="view_log_details">
				<div class="log_heading">
					<div class="serial_no">S.No.</div>
					<div class="user_name">User Name</div>
					<div class="user_name">First Name</div>
					<div class="user_name">Last Name</div>
					<div class="user_name">Designation</div>
					<div class="user_name">Organisation</div>
					<div class="user_name1">Email</div>
					<div class="user_name">Status</div>
					<div class="user_name">Action</div>
				</div>
			</div>
		</div>
		
         <div id="loading"></div>
        <div id="container">
            <div class="data"></div>
            <div class="pagination"></div>
        </div>
       <?php } ?>
	</div>
</section>

</div>
	</div>
</section>
<script src="http://<?php echo $jqueryminjs; ?>"></script>
<script src="http://<?php echo $validateminjs; ?>"></script>
</div>
	</div>
</section>
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
<script type="text/javascript">
	tabberAutomatic(tabberOptions);
</script>
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
