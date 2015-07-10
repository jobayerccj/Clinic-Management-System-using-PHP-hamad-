<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);

require_once('../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";

require_once($path);
include($config);
include '../functions.php';
$classfile = $pathofmayo."/classes/functions.php";
include($classfile);
include('header.php');

if(loggedin())
{
	$desg  = new Allfunctions();
?>
<section class="row">		
	<div class="container">
		<div class="form_section_content">
			<h1 class="add_user">Upload Forms</h1>
			<form name="userinfo" method="post" action="" id="regform" enctype="multipart/form-data">
				<ul>
					<li>
						<span class="form_label">	
							<label>Form Name</label>
						</span>
						<span class="form_input">
							<input type="text" name="form_name" value="" required />
						</span>
					</li>
					<li>
						<span class="form_label">	
							<label>Upload Form</label>
						</span>
						<span class="form_input">
							<input type="file" name="form_upload" />
						</span>
					</li>
					<li>
						<span class="form_label">	
							<label></label>
						</span>
						<span class="form_input">
							<input type="submit" name="upload" value="Upload Form" />
						</span>
					</li>
				</ul>
			</form>	
			<?php
				if(isset($_POST['upload']))
				{	
					$formName   = $_REQUEST['form_name'];
					$formUpload = $_FILES["form_upload"]["name"];
					$tempName   = $_FILES["form_upload"]["tmp_name"];
					
					$upload_dir = "forms";
					$b =  $_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .$upload_dir."/";
					if(file_exists($b.$_FILES["form_upload"]["name"]))
					{
						echo "<div class='thank_message'>File Already Exists.</div>";
					}
					else
					{
						$uploadPath = "../../forms/".$formUpload;
						$move       = move_uploaded_file($tempName,$uploadPath);
						if($move)
						{
							$sql = mysql_query("INSERT INTO `site_forms` (`form_name`,`path_form`,`date_time`) VALUES ('$formName','$formUpload',now())") or die(mysql_error());
							echo "<div class='thank_message'>".$tempName." Uploaded Successfully</div>";
						}
						else
						{
							echo "<div class='thank_message'>There is Error. Some thing going Wrong. Please try again Later</div>";	
						}
					}
					
				}
			?>
			
			<div class="dashbord_client">
				<h1>Uploaded Client Documents</h1>
				
				<div class="attorney_box_bg">
					<div class="attorney_row_heading">
						<div class="anesth_span_1">Date</div>
						<div class="anesth_span_2">Form Name</div>
						<div class="anesth_span_3">View</div>
						<div class="anesth_span_4">Delete</div>
					</div>
					<?php
					$documents = mysql_query("SELECT * FROM `site_forms`") or die(mysql_error());
					while($listdocuments  = mysql_fetch_array($documents))
					{
				?>
					<div class="attorney_row_content">
						<div class="anesth_span_1">
							<?php 
								$getdate = $listdocuments['date_time']; 
								echo date('d-M-Y',strtotime($getdate)); 
							?>
						</div>
						<div class="anesth_span_2">
							<?php 
								echo $foremName = $listdocuments['form_name']; 
							?>
						</div>

						<div class="anesth_span_3">
							<a href="/forms/<?php echo $path_form = $listdocuments['path_form']; ?>" onclick="" target="_blank">View</a>
						</div>
						<div class="anesth_span_4">
							<a href="forms.php?id=<?php echo $listdocuments['id'];?>&name=<?php echo $listdocuments['path_form']; ?>&action=delete">Delete</a>
						</div>
					</div>
				<?php 
					}
					$upload_dir = "forms";
					$b =  $_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .$upload_dir."/";
					/***************************************Delete Uploaded image and record from the database ***********/
					if(isset($_REQUEST['action']) && $_REQUEST['action']=="delete")
					{
						unlink($b.$_REQUEST['name']);
						$sql = mysql_query("DELETE FROM `site_forms` WHERE id='$_REQUEST[id]'") or die(mysql_error());
						
						if($sql)
						{	
							echo "<div class='thank_message'>Form Deleted Successfully</div>";
							header("refresh:2,url=forms.php");
						}
						else
						{	
							echo "<div class='thank_message'>Form Deleted Successfully</div>";
						}
					}
				?>
				</div>
				
			</div>
			
		</div>
</div>
<?php 
}
else
{
	header('Location:../login.php');
}
?>
</section>
<?php
require($get_footer);
?>
