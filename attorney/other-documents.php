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
	$a_username = $_SESSION['username'];
	$a      = $_SESSION['username'];
	$meshednew     = new Meshed();
	$att_ids       = $meshednew->getIdByUname();
?>
<section class="row">
	<div class="container dashboard_bg">
			<?php 
				if(isset($_REQUEST['action'])){
					if(isset($_REQUEST['fid'])) $id = $_REQUEST['fid'];	
					$temp_query = mysql_query("SELECT * FROM `documents_messages` WHERE `main_user_id`='$att_ids' && user_id='".$id."'") or die(mysql_error());
					$documents = mysql_fetch_object($temp_query);
			?>
			<div class="upload_clients_document">
			<?php if(isset($_REQUEST['fid'])){?>
	<p class="plantiff_name"><?php echo $pName = ucwords($meshednew->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid'])); ?></p>
	<?php }?><br/><br/>
				<h1>Uploaded Client Documents</h1>
				<div class="attorney_row">
					<div class="attorney_documents_left">
					
					<form name="upload-form" method="post" enctype="multipart/form-data" id="uploadForm" action="">
						<div class="attorney_row">
							<label>Document Type</label>
							<select name="relate_to" required >
								<option value=" ">...Select...</option>
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
									
								?>" readonly />
						</div>
						<div class="attorney_row">
							<label>Name of Document</label>
							<input type="text" name="document_name" value="">
						</div>
						<div class="attorney_row">
							<label>Choose File</label>
							<input type="file" name="choose_file" id=""/>
						</div>	
					</div>
					<div class="attorney_documents_right">		
						<div class="attorney_row">
							<label>Message</label>
							<textarea placeholder="Document Description" name="message"></textarea>
						</div>	
					</div>
					<div class="attorney_row">
						<input type="submit" name="up_user_documents" id=""/>
					</div>
				</form>	
				<?php
					if(isset($_POST['up_user_documents']))
					{
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
					
						$save_upload   = "INSERT INTO `upload_documents`(`form_id`,`user_id`,`attorney_id`,`related_to`,`type_of_case`,
						`name_of_document`,`upload_document_path`,`message`,`upload_date`)VALUES 
						('$_REQUEST[fid]','$_REQUEST[uid]','".$att_ids."','".$related_to."','$_REQUEST[cid]','".$document_name."','".$newfilename."','".$message."','".$current_date."')";
						$upqry = mysql_query($save_upload) or die(mysql_error());
						switch($related_to)
						{
							case "Medical Bill":
							$insertDocs = mysql_query("UPDATE `plantiff_case_type_info` set `medial_bill`='download' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
							break;
							
							
							case "Medical Record":
							$insertDocs = mysql_query("UPDATE `plantiff_case_type_info` set `medical_record`='download' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
							break;
							
							case "Police Record":
							$insertDocs = mysql_query("UPDATE `plantiff_case_type_info` set `police_accident_report`='download' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
							break;
														
							case "Product Label":
							$insertDocs = mysql_query("UPDATE `plantiff_case_type_info` set `product_label`='download' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
							break;
							
							case "Travel Expense":
							$insertDocs = mysql_query("UPDATE `plantiff_case_type_info` set `travel_bills`='download' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
							break;
							
							case "Other":
							$insertDocs = mysql_query("UPDATE `plantiff_case_type_info` set `other`='download' WHERE `form_id`='$_REQUEST[fid]'") or die(mysql_error());
							break;
						}
						$messaged = $related_to. " Document Uploaded of Client ". $pName;
						
						$notification = $sql = mysql_query("INSERT INTO `notifications` (`user_id`,`form_id`,`main_id`,`message`) values ('$_REQUEST[fid]','$_REQUEST[uid]','','$messaged')") or die(mysql_error());
						
						$inserMessage = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$att_ids','','$messaged',now())") or die(mysql_error());
						
						if($move)
						{
							echo $filename." Uploaded Successfully";
							header("Refresh:2;url=".$sitepath."/attorney/full-details.php?fid=$_REQUEST[fid]&uid=$_REQUEST[uid]&cid=$_REQUEST[cid]");
						}
					}
				?>	
			</div>
			<?php }else{ ?>
			<div class="dashbord_client">
				<h1>Uploaded Client Documents</h1>
				
				<div class="attorney_box_bg">
					<div class="attorney_row_heading">
						<div class="attorney_span_1">Date</div>
						<div class="attorney_span_2">Document Type</div>
						<div class="attorney_span_3">Document Description</div>
						<div class="attorney_span_4">Action</div>
					</div>
					<?php
					$documents = mysql_query("SELECT * FROM `upload_documents` where `attorney_id`='$att_ids' order by `form_id`") or die(mysql_error());
					while($listdocuments  = mysql_fetch_array($documents))
					{
				?>
					<div class="attorney_row_content">
						<div class="attorney_span_1"><?php $getdate = $listdocuments['upload_date']; echo date('d-M-Y',strtotime($getdate)); ?></div>
						<div class="attorney_span_2"><?php echo $listdocuments['related_to']; ?></div>
						<div class="attorney_span_3"><?php echo $listdocuments['message']; ?></div>
						<div class="attorney_span_4">
							<a href="?fid=<?=$listdocuments['form_id'];?>&cid=<?=$listdocuments['type_of_case']?>&action=upload" class="attorney_upload" title="Upload Pending Document">Pending Document Upload</a>
						</div>
					</div>
				<?php 
					} 
				?>
				</div>
			</div>
			<?php } ?>
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
