<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
$functionsfile = $_SERVER['DOCUMENT_ROOT']."/classes/functions.php";
include($functionsfile);
include('attorney/classes/meshed.php');
$temp_profile = new meshed();
	$a_username = $_SESSION['username'];
	$a      = $_SESSION['username'];
	$meshednew     = new Meshed();
	$att_ids       = $meshednew->getIdByUname();
?>
<section class="row">
	<div class="container dashboard_bg">
<?php if(isset($_REQUEST['fid'])){?>
	<p class="plantiff_name"><?php echo $pName = $meshednew->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); ?></p>
	<?php }?>
			<div class="upload_clients_document">
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
							<label>Document Name</label>
							<input type="text" name="document_name" value="" required />
						</div>
						<div class="attorney_row">
							<label>Choose File</label>
							<input type="file" name="choose_file" id="" required />
						</div>	
					</div>
					<div class="attorney_documents_right">		
						<div class="attorney_row">
							<label>Comment</label>
							<textarea placeholder="Document Description" name="message"></textarea>
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
						@$form_id      = $_REQUEST['fid'];
						@$user_id      = $_REQUEST['uid'];
						@$att_id       = $_REQUEST['mid'];
						$related_to    = $_POST['relate_to']; 
						//$case          = $_POST['case'];
						$document_name = $_POST['document_name'];
						$filename      = $_FILES["choose_file"]["name"];
						$temp_name     = $_FILES["choose_file"]["tmp_name"];
						$message       = $_POST['message'];
						$extension     = pathinfo($filename,PATHINFO_EXTENSION);
						$add_name      = rand(000000,999999);
						$newfilename   = date("y-m-d_h:m:s").$add_name.".".$extension;
						$upload_path   = "uploads/".$newfilename;
						$move          = move_uploaded_file($temp_name,$upload_path);
						$current_date  = date("Y-m-d"); 
						
						$messaged = $related_to. " Document Uploaded of Client ". $pName;
						
						$notification = $sql = mysql_query("INSERT INTO `notifications` (`user_id`,`form_id`,`main_id`,`message`) values ('$_REQUEST[fid]','$_REQUEST[uid]','','$messaged')") or die(mysql_error());
						
						$inserMessage = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$att_id','','$messaged',now())") or die(mysql_error());
						
						$save_upload   = mysql_query("INSERT INTO `upload_documents` (`form_id`,`user_id`,`attorney_id`,`related_to`,
						`name_of_document`,`upload_document_path`,`message`,`upload_date`)VALUES 
						('$form_id','$user_id','$att_id','$related_to','$document_name','$newfilename','$message','$current_date')") or die(mysql_error());
						if(isset($_REQUEST['name']) && ($_REQUEST['name']=="sm"))
						{
							$sql = mysql_query("UPDATE `plantiff_case_type_info` set `signed_medical_records`='download' WHERE `form_id`='$_REQUEST[fid]' && id='$_REQUEST[uid]'") or die(mysql_error());

						}
						elseif(isset($_REQUEST['name']) && ($_REQUEST['name']=="pl"))
						{
							
							$sql = mysql_query("UPDATE `plantiff_case_type_info` set `product_label`='download' WHERE `form_id`='$_REQUEST[fid]' && id='$_REQUEST[uid]'") or die(mysql_error());
						}
						elseif(isset($_REQUEST['name']) && ($_REQUEST['name']=="ml"))
						{
							$sql = mysql_query("UPDATE `plantiff_case_type_info` set `medial_bill`='download' WHERE `form_id`='$_REQUEST[fid]' && id='$_REQUEST[uid]'") or die(mysql_error());

						}
						elseif(isset($_REQUEST['name']) && ($_REQUEST['name']=="mr"))
						{
							$sql = mysql_query("UPDATE `plantiff_case_type_info` set `medical_record`='download' WHERE `form_id`='$_REQUEST[fid]' && id='$_REQUEST[uid]'") or die(mysql_error());

						}
						elseif(isset($_REQUEST['name']) && ($_REQUEST['name']=="tb"))
						{
							$sql = mysql_query("UPDATE `plantiff_case_type_info` set `travel_bills`='download' WHERE `form_id`='$_REQUEST[fid]' && id='$_REQUEST[uid]'") or die(mysql_error());

							
						}
						elseif(isset($_REQUEST['name']) && ($_REQUEST['name']=="ob"))
						{
							
							$sql = mysql_query("UPDATE `plantiff_case_type_info` set `other`='download' WHERE `form_id`='$_REQUEST[fid]' && id='$_REQUEST[uid]'") or die(mysql_error());
							
						}
						elseif(isset($_REQUEST['name']) && ($_REQUEST['name']=="pr"))
						{
							
							$sql = mysql_query("UPDATE `plantiff_case_type_info` set `police_accident_report`='download' WHERE `form_id`='$_REQUEST[fid]' && id='$_REQUEST[uid]'") or die(mysql_error());
							
						}
					
						if($move)
						{
							echo $filename."Uploaded Successfully";
						}
						if(($save_upload) && ($move))
						{
							echo "<script type='text/javascript'> alert('Files Uploaded Successfully'); window.close();</script>";
						}

					}			
				?>	
		</div>
	</div>
</section>
<?php
require($get_footer);
?>
