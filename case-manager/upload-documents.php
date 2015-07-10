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
			<div class="upload_clients_document">
				<h1>Upload Client Documents</h1>
				<div class="attorney_row">
					<div class="attorney_documents_left">
					<form name="upload-form" method="post" enctype="multipart/form-data" id="uploadForm" action="">
						<div class="attorney_row">
							<label>Document Type</label>
							<select name="relate_to">
								<option value="...Select...">...Select...</option>
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
							<input type="hidden" name="case" value=<?php echo $_GET['case_id']; ?>>
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
				</div>	
				<?php
					if(isset($_POST['up_user_documents']))
					{
						@$form_id      = $_REQUEST['fid'];
						@$user_id      = $_REQUEST['uid'];
						@$att_id       = $att_ids;
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
						('$form_id','$user_id','$att_id','$related_to','$case','$document_name','$newfilename','$message','$current_date')") or die(mysql_error());
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
			<!--<div class="dashbord_client">
				<h1>Uploaded Client Documents</h1>
				
				<div class="attorney_box_bg">
					<div class="attorney_row_heading">
						<div class="attorney_span_1">Date</div>
						<div class="attorney_span_2">Document Type</div>
						<div class="attorney_span_3">Document Description</div>
					</div>
					<?php
					//$u_id = $_REQUEST['uid'];
					//$documents = mysql_query("SELECT * FROM `upload_documents` where `user_id` = '".$u_id."' order by `form_id`") or die(mysql_error());
					//while($listdocuments  = mysql_fetch_array($documents))
					//{
				?>
					<div class="attorney_row_content">
						<div class="attorney_span_1"><?php //$getdate = $listdocuments['upload_date']; echo date('d-M-Y',strtotime($getdate)); ?></div>
						<div class="attorney_span_2"><?php //echo $listdocuments['related_to']; ?></div>
						<div class="attorney_span_3"><?php //echo $listdocuments['message']; ?></div>
					</div>
				<?php 
					//} 
				?>
				</div>
			</div>-->
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
