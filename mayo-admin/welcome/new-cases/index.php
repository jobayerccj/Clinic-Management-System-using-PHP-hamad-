<?php
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
include '../../functions.php';
include '../classes/Cases.php';
$desg       = new Cases();
$functions  = $pathofmayo."/classes/functions.php";
include($functions);
$meshedfile = $pathofmayo."/attorney/classes/meshed.php";
require_once($meshedfile);
$getdata    = new Meshed();
?>

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
	// this file is exists in the includes folder used to get the users list by there professions
	function getUser(desgntnId) {		
		
		var strURL="../cases/find-user.php?desgntn="+desgntnId;
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
	
	// this file is exists in the includes folder used to get the users full information by there professions
	
function getInfo(usersId) {		
		var strURL="../cases/getInfo.php?user_details="+usersId;
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
	// geting here the email format used to send the emails to the users for particular reason
	
	function getEmailsFormat(emailId) {		
		var strURL="getemailsformat.php?email_format="+emailId;
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




<?php
if(loggedin())
{
	$header_admin = $pathofmayo."/mayo-admin/welcome/header.php";
	include($header_admin);
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="stylesheet" href="admin-style.css" type="text/css">
<section class="row">
	<div class="container">
	<?php 
		if(isset($_REQUEST['fid'])) 
		{
	?>
			</div>
		<div class="container dashboard_bg">
		<div class="slide_left_pane">
			<script>
				 $(document).ready(function() 
				 {
					 $(".view").load("../includes/latest-messages.php");
				   var refreshId = setInterval(function() {
					  $(".view").load("../includes/latest-messages.php");
				   }, 30000);
				   $.ajaxSetup({ cache: false });
				});
			</script>
			<div class="view"></div>
		</div>
		<div class="slide_right_pane">
		<div id="tabs">
			<ul class="tabbernav">
				<li><a href="#application">Application</a></li>
				<li><a href="#documents">Documents</a></li>
				<li><a href="#upload-documents">Upload Documents</a></li>
				<li><a href="#work-flow">Work Flow/Status Update</a></li>
				<li><a href="#process-case">Process Case</a></li>
			</ul>
				<div class="dashboard_bg tabber">
					<div class="tabbertab" id="application">
						<div class="view_application">
							<?php
								/*to get the case view passing qury*/
								$qry = "select a.*,b.*,d.* from plantiff_information a 
								inner join plantiff_case_type_info b on a.form_id=b.form_id and a.id=b.id
								inner join members d on a.id=d.id and b.id=d.id
								where b.admin_approved=0 and b.case_closed=0 && a.form_id='$_REQUEST[fid]' && b.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]' && b.id='$_REQUEST[uid]'";
								$sql = mysql_query($qry) or die(mysql_error());
								$row = mysql_fetch_array($sql);
								$c_type = $row['case_type'];
								if($c_type == '1' || $c_type =='3' || $c_type =='5')
								{
									/*working from the attorney classes file */
									$getdata->orthoView($row);
								}
								elseif($c_type == '6')
								{
									$getdata->MedicalView($row);
									echo "</div>";
								}
								else
								{ 
									$getdata->meshedView($row);
								} 
							?>
					</div>
				</div>
		<div class="tabbertab" id="documents">
		<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); ?>"/></a>
</div>
<div class="attorney_client_info"><h1>Documents</h1></div>
		<div class="dashbord_client">
			<div class="update_status_botom">
				<div class="view_client_row">
									
					<div class="dashbord_client">

						<div class="client_box_bg">
							<?php
								$admin    = $_SESSION['username'];
								$admin_id = $getdata->GetDetailsByUsername($admin,"id");
							?>
							<form name="documentsmissing" method="post" action="">
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
									<input type="hidden" name="user_id" value="<?php echo $id = $row['id']; ?>">
									<input type="hidden" name="main_user_id" value="<?php echo $att_id = $getdata->GetObjectFromPCTI("attorney_id",$_REQUEST['fid']); ?>">
									<?php
										//getting client email and attorney/casemanager email
										//$user_email_id=$getdata->GetObjectById($_REQUEST['fid'],"email_id");
										$att_email_ids=$getdata->GetObjectFromPCTI("attorney_id",$_REQUEST['fid']);
										$att_email_id=$getdata->GetObjectById($att_email_ids,"email_id");
									?>
								</div>
								<div class="dashboard_row">
									<input type="submit" name="documentsd" id="" value="Submit"/>
								</div>
							</form>
							<?php
								
								$datetime     = date("Y-m-d H:i:s a");
								
								
								if(isset($_REQUEST['documentsd']))
								{
									$main_user_ida = $_REQUEST['main_user_id'];
									$uid           = $_REQUEST['user_id']; 
									$fname         = $getdata->GetObjectById($uid,"first_name");
									$lastn         = $getdata->GetObjectById($uid,"last_name");
									$email_id      = $getdata->GetObjectById($att_id,"email_id");
									//$name          =  ucwords($fname)."&nbsp;".ucwords($lastn);
									
									$name          = $getdata->GetInfoPlantiffInformation('plantiff_name',$_REQUEST['fid']);
									$date          = date("Y-m-d H:i:s a");
									
									$message_docs  = $_POST['document_message'];
									$subject       = "Message Sent from Mayo Department"; 
									$message       = "Documents Missing";
									$extravalues   = array("Name of Client"=>$name,"Case No"=>$_REQUEST['fid'],"Message" => $message,"Note:"=>"Related Documents");
									
									$tempmissing   = mysql_query("INSERT INTO `documents_messages` (`form_id`,`user_id`,`main_user_id`,`documents_messages`,`date_document`) VALUES ('$_GET[fid]','$uid','$main_user_ida','$message_docs',now())") or die(mysql_error());
									
									$proffId       = $getdata->GetObjectFromPCTI("attorney_id",$_REQUEST['fid']);
									$notifications = mysql_query("INSERT INTO `notifications` (`user_id`,`form_id`,`main_id`,`message`) VALUES ('$_REQUEST[uid]','$_REQUEST[fid]','$proffId','$message_docs')") or die(mysql_error());
									
										//hide email functionality for the users not required for client
										//$getdata->SendEmail($user_email_id,$subject,$message_docs,$extravalues);
									
										//here we are going to send the automatically mail to attorney/case manager
										//$document_message = mysql_query("SELECT * FROM `document_message` where `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());

									$getdata->SendEmail($att_email_id,$subject,$message_docs,$extravalues);
									
									$admin    = $_SESSION['username'];
									$admin_id = $getdata->GetDetailsByUsername($admin,"id");
													
									$inserMessage = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$admin_id','$att_id','$message_docs',now())") or die(mysql_error());
									if($tempmissing)
									{
										echo "<div class='thank_message'>Message Sent Successfully</div>";
									}
									else
									{
										echo "<div class='thank_message'>There is the error</div>";
									}
								}
							?>
							
						</div>
						<?php
							$temp_docs = mysql_query("SELECT * FROM `documents_messages` where `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
							if(mysql_num_rows($temp_docs)>0)
							{
						?>
						<div class="client_box_bg">
							<div class="client_row_heading">
								<div class="client_span_1">Sr. No.</div>
								<div class="client_span_2">Client No.</div>
								<div class="client_span_3">Message</div>
								<div class="client_span_5">Date</div>
							</div>
							<?php
								$i=1;
								while($docs= mysql_fetch_object($temp_docs))
								{
							?>
										<div class="client_row_content">
											<div class="client_span_1"><?php echo $i; ?></div>
											<div class="client_span_2"><?php echo $docs->form_id; ?></div>
											<div class="client_span_3"><?php echo $docs->documents_messages; ?></div>
											<div class="client_span_4"><?php echo date('m-d-Y',strtotime($docs->date_document)); ?></div>
										</div>
							<?php	
									$i++;
								}
							?>
						</div>
							<?php } ?>
						<h1>Uploaded Documents</h1>
						<div class="client_box_bg">
							<div class="client_row_heading">
								<div class="client_span_1">Sr. No.</div>
								<div class="client_span_2">Document Name</div>
								<div class="client_span_3">Document Type</div>
								<div class="client_span_4">Date</div>
								<div class="client_span_5">View</div>
								<div class="client_span_6">Delete</div>
							</div>
							<?php
							$i=1;
								$temp_docs = mysql_query("SELECT * FROM `upload_documents` where `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
								while($docs= mysql_fetch_object($temp_docs))
								{
							?>
										<div class="client_row_content">
											<div class="client_span_1"><?php echo $i; ?></div>
											<div class="client_span_2"><?php echo $docs->name_of_document; ?></div>
											<div class="client_span_3"><?php echo $docs->related_to; ?></div>
											<div class="client_span_4"><?php echo date('m-d-Y',strtotime($docs->upload_date)); ?></div>
											<div class="client_span_5"><a href="/mayo-admin/welcome/download.php?filename=<?=$docs->upload_document_path;?>&fid=<?php echo $docs->form_id; ?>">Download</a></div>
											<div class="client_span_6">
												<a href="/mayo-admin/welcome/delete-docs.php?filename=<?=$docs->upload_document_path;?>&url=<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&fid=<?php echo $_REQUEST['fid'];?>&cid=<?php echo $_REQUEST['cid']; ?>&action=deletedocs">Delete</a>
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
		<div class="tabbertab" id="upload-documents">
			<div class="view_application">
				<?php
					include('../includes/upload-documents.php');
				?>
			</div>
		</div>
		<!-- Update Status Files -->
		<div class="tabbertab" id="work-flow">
			<?php include('../includes/update-status.php'); ?>
		</div>
		
		<div class="tabbertab" id="process-case">
			<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); ?>"/></a>
</div>
<div class="attorney_client_info"><h1>Process Case</h1></div>
			<div class="dashbord_client">
				<div class="update_status_botom">
				
					<div class="view_client_row">
						<div class="dashbord_client">
							<form name="acceptcase" method="post" action="">
								<div class="dashboard_row">
									<label>Message</label>
									<textarea name="accept_message" required>Approved for Processing. Thank You for your business.</textarea>
								</div>
								<input type="hidden" name="user_id" value="<?php echo $id = $row['id']; ?>">
								
								<input type="hidden" name="main_user_id" value="<?php echo $att_id = $getdata->GetObjectFromPCTI("attorney_id",$_REQUEST['fid']); ?>">
								<div class="dashboard_row">
									<input type="submit" name="acceptcase" id="" value="Submit"/>
								</div>
							</form>
							<?php
								 //useremail
								$user_email_id1 = $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
									
									//clientfirstname
									//$u_f_name       = $getdata->GetObjectById($id,"first_name");
								$u_f_name = $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']);
									
									//clientlastname
									//$u_l_name       = $getdata->GetObjectById($id,"last_name");
									
									//client contact number
								$cont_number    = $getdata->GetInfoPlantiffInformation("p_mob_no",$_REQUEST['fid']);
									
									//attorney email id
								$att_email_id1  = $getdata->GetObjectById($att_id,"email_id");
								$atts_id = $getdata->GetObjectFromPCTI("attorney_id",$_REQUEST['fid']);
								$fnameofatt = $getdata->GetObjectById($att_id,"first_name");
								$lnameofatt = $getdata->GetObjectById($att_id,"last_name");
								$fullnameofatt = $fnameofatt.$lnameofatt;
								if(isset($_POST['acceptcase']))
								{
																		
									$main_user_id   = $_POST['main_user_id'];
									//$messaged = $_POST['accept_message'];
									$messaged = $_POST['accept_message'];
									$tempacceptcas = mysql_query("UPDATE `plantiff_case_type_info` set `admin_approved`='1' where `form_id`='$_REQUEST[fid]' && `id`='$_REQUEST[uid]'") or die(mysql_error());
									$deleteq = mysql_query("DELETE FROM `documents_messages` where `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
									
									$designationofAtt  = $getdata->GetObjectById($att_id,"email_id");
									if($designationofAtt==2)
									{
										$temptable = mysql_query("UPDATE `temp_data` SET `attorney`='$fullnameofatt',`casemanager`='no' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
									}
									else
									{
										$temptable = mysql_query("UPDATE `temp_data` SET `casemanager`='$fullnameofatt',`attorney`='no' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
									}
									
									$hireAttorney = mysql_query("INSERT INTO `hire_staff` (`form_id`,`hire_id`,`user_id`,`date_time`) VALUES ('$_REQUEST[fid]','$atts_id','$_REQUEST[uid]',now())") or die(mysql_error());
									
									
									
									$notifi  = mysql_query("INSERT INTO `notifications` (`user_id`,`form_id`,`main_id`,`message`) VALUES ('$_REQUEST[uid]','$_REQUEST[fid]','$atts_id','Case Accepted By Admin')") or die(mysql_error());
									
									$subject="Status Note Mayo Surgical";
									$mess="Hello:  We have received all necessary information to consider this case for underwriting.  You may check back periodically for status reports on your cases.  You will receive notification when a case has been underwritten.";
									//$extravalues2 = array("Note" =>"Please Confirm your Case");
									$extravalues1 = array("Client Name" => $u_f_name,"Case In Progress,You may log onto mayosurgical.com for current status updates"=>$mess);
									//$getdata->SendEmail($user_email_id1,$subject,$message,$extravalues2);
									
									//sending an email to underwriter
									
									$getdata->SendEmail($att_email_id1,$subject,$messaged,$extravalues1);
										
									if($deleteq)
									{
										echo "<div class='thank_message'>Case is Accepted</div>";
										header("refresh:2;url=index.php");
									}
									else
									{
										echo "<div class='thank_message'>Something Went Wrong. Please Try Again</div>";
									}
								}
									
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
		
		<script>
		$(function() {
			//  jQueryUI 1.10 and HTML5 ready
			//      http://jqueryui.com/upgrade-guide/1.10/#removed-cookie-option 
			//  Documentation
			//      http://api.jqueryui.com/tabs/#option-active
			//      http://api.jqueryui.com/tabs/#event-activate
			//      http://balaarjunan.wordpress.com/2010/11/10/html5-session-storage-key-things-to-consider/
			//
			//  Define friendly index name
			var index = 'key';
			//  Define friendly data store name
			var dataStore = window.sessionStorage;
			//  Start magic!
			try {
				// getter: Fetch previous value
				var oldIndex = dataStore.getItem(index);
			} catch(e) {
				// getter: Always default to first tab in error state
				var oldIndex = 0;
			}
			$('#tabs').tabs({
				// The zero-based index of the panel that is active (open)
				active : oldIndex,
				// Triggered after a tab has been activated
				activate : function( event, ui ){
					//  Get future value
					var newIndex = ui.newTab.parent().children().index(ui.newTab);
					//  Set future value
					dataStore.setItem( index, newIndex ) 
				}
			}); 
		}); 
		</script>
	<?php 
	} 
	else 
	{
?>
<script type="text/javascript">
	$(document).ready(function(){
		function loading_show(){
			$('#loading').html("<img src='../images/loading.gif'/>").fadeIn('fast');
		}
		function loading_hide(){
			$('#loading').fadeOut('fast');
		}                
		function loadData(page){
			loading_show();                    
			$.ajax
			({
				type: "POST",
				url: "new-cases-temp.php",
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
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
<div class="form_section_content"><h1 class="add_user">New Cases</h1></div>
<div class="view_log_details">
	<div class="log_heading">
		<div class="serial_no_15">S.No.</div>
		<div class="user_name_15">Attorney / Case Manager (Name)</div>
		<div class="first_name_15">Client Name</div>
		<div class="email_address_15">Date of Birth</div>
		<div class="status_15">Case Documents</div>
		<div class="action_15">Action</div>
	</div>
</div>
	<div id="loading"></div>
	<div id="container">
		<div class="data"></div>
		<div class="pagination"></div>
	</div>
<?php 
	} 
?>
	</div></div>
<div class="clear"></div>
</div>

</section>
<?php 
}
else 
{ 
header('Location:../../login.php');
}
?>

</div>
	</div>
</section>
<?php
require($get_footer);
?>

