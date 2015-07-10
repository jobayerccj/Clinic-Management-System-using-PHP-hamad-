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
        <div id="show_data">
			<div class="dr_message_side">
			  <script>
						 $(document).ready(function() 
						 {
							 $(".view").load("latestmessages.php?doctor_id=<?php echo $doctor_id; ?>");
						   var refreshId = setInterval(function() {
							  $(".view").load('latestmessages.php?doctor_id=<?php echo $doctor_id; ?>');
						   }, 5000);
						   $.ajaxSetup({ cache: false });
						});
					</script>
					<div class="view"></div>
			</div>
        </div>
      </div>
    </div>
		<div class="slide_right">
			<p class="plantiff_name"><?php echo ucwords($functions->GetInfoPlantiffInformation('plantiff_name',$_REQUEST['fid'])); ?></p>
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
							<input type="hidden" name="case" value=<?php echo $_GET['cid']; ?>>
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
						<div class="anesth_span_1">Date</div>
						<div class="anesth_span_2">Document Type</div>
						<div class="anesth_span_3">Document Description</div>
						<div class="anesth_span_4">Action</div>
					</div>
					<?php
					$documents = mysql_query("SELECT * FROM `upload_documents` WHERE user_id  = '$_REQUEST[uid]'") or die(mysql_error());
					while($listdocuments  = mysql_fetch_array($documents))
					{
				?>
					<div class="attorney_row_content">
						<div class="anesth_span_1"><?php $getdate = $listdocuments['upload_date']; echo date('m-d-Y',strtotime($getdate)); ?></div>
						<div class="anesth_span_2"><?php echo $listdocuments['related_to']; ?></div>
						<div class="anesth_span_3"><?php echo $listdocuments['message']; ?></div>
						<div class="anesth_span_4">
							<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
								<button class="dr_check_status">view</button>
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
