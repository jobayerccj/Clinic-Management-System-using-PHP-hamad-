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
		<div class="slide_right">
		<div style="width:100%!important">
					<p class="plantiff_name"><?php echo ucwords($functions->GetInfoPlantiffInformation('plantiff_name',$_REQUEST['fid'])); ?></p>
				</div>
				
			<div class="upload_clients_document">
				<?php 
					$tempcheck = mysql_query("SELECT `form_id` FROM `hire_staff` WHERE `hire_id`='$doctor_id' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
					if(mysql_num_rows($tempcheck)>=1)
					{
				?>
				<div class="back_btn_area">
					<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
				</div>
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
						$save_upload   = mysql_query("INSERT INTO `upload_documents` (`form_id`,`user_id`,`attorney_id`,`related_to`,`type_of_case`,
						`name_of_document`,`upload_document_path`,`message`,`upload_date`)VALUES 
						('$form_id','$user_id','$doctor_id','$related_to','$case','$document_name','$newfilename','$message','$current_date')") or die(mysql_error());
						if($move)
						{
							echo "<div class='thank_message'>".$filename." Uploaded Successfully</div>";
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
									<option value="Estimate of Doctor and Facilities Charges">Estimate of Doctor and Facilities Charges</option>
									<option value="Post Consultation Report">Post Consultation Report</option>
									<option value="Post-Surgery Report">Post-Surgery Report</option>
									<option value="Follow-Up Report">Follow-Up Report</option>
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
								<textarea placeholder="" name="message"></textarea>
							</div>	
						</div>
						<div class="attorney_row">
							<input type="submit" name="up_user_documents" id=""/>
						</div>
					</form>		
				</div>	
					
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
</section>
<?php
require($get_footer);
}
else
{
	
header('Location:../../login.php');
	
}
?>
