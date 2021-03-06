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
				<h1>Message</h1>
				<div class="dr_message_side">
					<div class="dr_message_side_row">
						<div class="dr_message_side_left">
							<label>10:00am</label>
						</div>
						<div class="dr_message_side_right">
							<label>John William Johan William</label>
						</div>
					</div>
					<div class="dr_message_side_row">
						<div class="dr_message_side_left">
							<label>10:00am</label>
						</div>
						<div class="dr_message_side_right">
							<label>John William Johan William</label>
						</div>
					</div>
					<div class="dr_message_side_row">
						<div class="dr_message_side_left">
							<label>10:00am</label>
						</div>
						<div class="dr_message_side_right">
							<label>John William Johan William</label>
						</div>
					</div>
					<div class="dr_message_side_row">
						<div class="dr_message_side_left">
							<label>10:00am</label>
						</div>
						<div class="dr_message_side_right">
							<label>John William Johan William</label>
						</div>
					</div>
					<div class="dr_message_side_row">
						<div class="dr_message_side_left">
							<label>10:00am</label>
						</div>
						<div class="dr_message_side_right">
							<label>John William Johan William</label>
						</div>
					</div>
				</div>
				<div class="add_dr_message">
					<a href="#" class="dr_add_message">Add Message</a>
				</div>
			</div>
		</div>
		<div class="slide_right">
			<div class="upload_clients_document">
				<?php 
					$tempcheck = mysql_query("SELECT `form_id` FROM `hire_staff` WHERE `hire_id`='$doctor_id' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
					if(mysql_num_rows($tempcheck)>=1)
					{
				?>
				<h1>Uploaded Client Documents</h1>
				<div class="attorney_row">
					<div class="attorney_documents_left">
					<form name="upload-form" method="post" enctype="multipart/form-data" id="uploadForm" action="">
						<div class="attorney_row">
							<label>Document Type</label>
							<select name="relate_to" required>
								<option value="">...Select...</option>
								<option value="Medical Bill">Medical Bill</option>
								<option value="Medical Record">Medical Record</option>
								<option value="Police Record">Police Record</option>
								<option value="Product Label">Product Label</option>
								<option value="Release of Medical Records">Release of Medical Records</option>
								<option value="Travel Expense">Travel Expense</option>
								<option value="Other">Other</option>
							</select>
						</div>
						<div class="attorney_row">
							<label>Type of Case</label>
							<input type="text" name="case" value="<?php
									$case = mysql_query("SELECT * FROM `type_of_cases` where `case_id`='".$_GET['cid']."'") or die(mysql_error());
									$caselist = mysql_fetch_array($case);
									echo $caselist['name_of_case'];
									
								?>" readonly/>
							<input type="hidden" name="case" value=<?php echo $_GET['cid']; ?>>
						</div>
						<div class="attorney_row">
							<label>Name of Document</label>
							<input type="text" name="document_name" value="" required />
						</div>
						<div class="attorney_row">
							<label>Choose File</label>
							<input type="file" name="choose_file" id="" required />
						</div>	
					</div>
					<div class="attorney_documents_right">		
						<div class="attorney_row">
							<label>Message</label>
							<textarea placeholder="Document Description" name="message" required ></textarea>
						</div>	
					</div>
					<div class="attorney_row">
						<input type="submit" name="up_user_documents" id=""/>
					</div>
				</form>	
				</div>	
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
						$save_upload   = mysql_query("INSERT INTO `upload_documents` (`form_id`,`user_id`,`attorney_id`,`related_to`,`type_of_case`,
						`name_of_document`,`upload_document_path`,`message`,`upload_date`)VALUES 
						('$form_id','$user_id','$doctor_id','$related_to','$case','$document_name','$newfilename','$message','$current_date')") or die(mysql_error());
						if($move)
						{
							echo $filename." Uploaded Successfully";
						}
					}
				?>	
			</div>
			<div class="dashbord_client">
				<h1>Uploaded Client Documents</h1>
				
				<div class="attorney_box_bg">
					<div class="attorney_row_heading">
						<div class="attorney_span_1">Date</div>
						<div class="attorney_span_2">Document Type</div>
						<div class="attorney_span_3">Document Description</div>
						<div class="attorney_span_4">Download</div>
					</div>
					<?php
					$documents = mysql_query("select a.id,b.* from members as a,upload_documents as b where a.id=b.attorney_id and a.designation!=6 and `user_id` = '$_REQUEST[uid]' && `form_id` = '$_REQUEST[fid]' && `related_to` !=  'Estimate of Doctor and Facilities Charges'") or die(mysql_error());
					while($listdocuments  = mysql_fetch_array($documents))
					{
				?>
					<div class="attorney_row_content">
						<div class="attorney_span_1"><?php $getdate = $listdocuments['upload_date']; echo date('d-M-Y',strtotime($getdate)); ?></div>
						<div class="attorney_span_2"><?php echo $listdocuments['related_to']; ?></div>
						<div class="attorney_span_3"><?php echo $listdocuments['message']; ?></div>
						<div class="attorney_span_4">
							<a href="<?php echo $sitepath ?>/uploads/<?php echo $listdocuments['upload_document_path']; ?>" target="_blank">
								<button class="view_button">view</button>
							</a>
						</div>
					</div>
				<?php 
					} 
				?>
				</div>
				<?php
					}
					else
					{
				?>
					Unexpected Error. Return Go Back
				<?php
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
