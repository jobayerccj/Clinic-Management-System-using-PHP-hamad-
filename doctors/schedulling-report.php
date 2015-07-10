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
?>
<script type="text/javascript" src="<?php echo $sitepath; ?>/autocomplete/jquery.js"></script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/autocomplete/jquery.autocomplete.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $("#email_address").autocomplete("getemailid.php", {
		selectFirst: true
	});
});
</script>

<section class="row">
	<div class="container dashboard_bg">
		<div class="dr_upload_doc_slide">
			<div class="dr_message_side_bg">
				<div class="dr_message_side">
					<?php include('latestmessages.php'); ?>
				</div>
			</div>
		</div>	
		<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
		<div class="slide_right">
			<p class="plantiff_name"><?php $uName=$functions->GetInfoPlantiffInformation('plantiff_name',$_REQUEST['fid']); echo ucwords($uName); ?></p>
			<div class="upload_clients_document">
				<h1>Documents Description</h1>
				<?php
					
					if(isset($_POST['up_user_documents']))
					{
						$form_id       = $_REQUEST['fid'];
						$user_id       = $_REQUEST['uid'];
						$related_to    = $_POST['relate_to']; 
						$case          = $_POST['case'];
						$document_name = $_POST['document_name'];
						$filename      = $_FILES["choose_file"]["name"];
						$temp_name     = $_FILES["choose_file"]["tmp_name"];
						$message       = $_POST['message'];
						$extension     = pathinfo($filename,PATHINFO_EXTENSION);
						$add_name      = rand(000000,999999);
						$newfilename   = date("y-m-d_h:m:s").$add_name.".".$extension;
						$upload_path   = "../uploads/".$newfilename;
						$move          = move_uploaded_file($temp_name,$upload_path);
						$current_date  = date("Y-m-d"); 
						
						$update        = mysql_query("UPDATE `appointment_doctor` SET `appt_status`='$_POST[status_updated]',`appt_report`=1,`date_time`=now() WHERE `appt_id`='$_GET[id]'") or die(mysql_error());
						
						$save_upload   = mysql_query("INSERT INTO `upload_documents` (`form_id`,`user_id`,`attorney_id`,`related_to`,`type_of_case`,
						`name_of_document`,`upload_document_path`,`message`,`upload_date`)VALUES 
						('$form_id','$user_id','$doctor_id','$related_to','$case','$document_name','$newfilename','$message','$current_date')") or die(mysql_error());
						
						/*Notifications*/
						$notification = mysql_query("INSERT INTO `notifications` (`user_id`,`form_id`,`main_id`,`message`) VALUES ('$_REQUEST[uid]','$_REQUEST[fid]','$doctor_id','$related_to')") or die(mysql_error());
						
						$messageData  = $related_to." Uploaded of Client ".$uName;
						
						$message      = mysql_query("INSERT INTO `message_sent` (form_id,user_id,sent_by,main_user_id,message,date_message) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$doctor_id','','$messageData',now())") or die(mysql_error());
						
						if($move)
						{
							echo "<div class='thank_message'>".$filename." Uploaded Successfully </div>";
							header("refresh:2;url=$sitepath/doctors/appointment-status.php?fid=$_REQUEST[fid]&uid=$_REQUEST[uid]");
						}
					}
				?>	
				<div class="attorney_row">
					<form name="upload-form" method="post" enctype="multipart/form-data" id="uploadForm" action="">
						<div class="attorney_documents_left">
							<div class="attorney_row">
								<label>Document Type</label>
								<select required aria-required="true" name="relate_to" required="required">
									<option value="">...Select...</option>
									<option value="Consultation Report">Consultation Report</option>
									<option value="Estimate of Doctor and Facilities Charges">Estimate of Doctor Charges</option>
									<option value="Post Consultation Report">Operative Report</option>
									<option value="Post-Surgery Report">Follow-Up Report</option>
									<option value="Other">Other</option>
							</select>
							</div>
							<div class="attorney_row">
								<label>Type of Case</label>
								<input type="text" name="case" value="<?php $case_id = $functions->Getcidbyformid($_REQUEST['fid']); echo $functions->getNameCase($case_id);?>" readonly/>
								<input type="hidden" name="case" value=<?php  echo $case_id = $functions->Getcidbyformid($_REQUEST['fid']); ?>>
							</div>
							<div class="attorney_row">
								<label>Name of Document</label>
								<input type="text" name="document_name" value="" required>
							</div>
							<div class="attorney_row">
								<label>Choose File</label>
								<input type="file" name="choose_file" id="" required />
							</div>
						</div>
						<div class="attorney_documents_right">	
							
							<div class="attorney_row">
								<label>Message</label>
								<textarea placeholder="Document Description" name="message"></textarea>
							</div>	
							<div class="attorney_row">
								<!--<label>Status Update</label>-->
								<input type="hidden" name="status_updated" value="Status Updated">
							</div>
						</div>
						<div class="attorney_row">
							<input type="submit" name="up_user_documents" id=""/>
						</div>
					</form>		
				</div>	
				
			</div>
			<div class="dashbord_client">
				<h1>Uploaded Client Documents</h1>
				<div class="attorney_box_bg">
					<div class="attorney_row_heading">
						<div class="dr_new_client_1">Date</div>
						<div class="dr_new_client_2">Document Type</div>
						<div class="dr_new_client_3">Document Name</div>
						<div class="dr_new_client_4">Document Description</div>
						<div class="dr_new_client_5">View</div>
					</div>
					<?php
					$documents = mysql_query("select a.id,b.* from members as a,upload_documents as b where a.id=b.attorney_id and a.designation!=6 && `form_id` = '$_REQUEST[fid]'") or die(mysql_error());
					while($listdocuments  = mysql_fetch_array($documents))
					{
					?>
					<div class="attorney_row_content">
						<div class="dr_new_client_1"><?php $getdate = $listdocuments['upload_date']; echo date('d-M-Y',strtotime($getdate)); ?></div>
						<div class="dr_new_client_2"><?php echo $listdocuments['related_to']; ?></div>
						<div class="dr_new_client_3"><?php echo $listdocuments['name_of_document']; ?></div>
						<div class="dr_new_client_4"><?php echo $listdocuments['message']; ?></div>
						<div class="dr_new_client_5">
								<a target="_blank" href="<?php echo $sitepath; ?>/uploads/<?php echo $listdocuments['upload_document_path']; ?>" class="view_button">view</a>
						</div>
					</div>
				<?php 
					} 
				?>
				</div>
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
