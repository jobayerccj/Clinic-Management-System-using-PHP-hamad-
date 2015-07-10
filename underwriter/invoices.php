<?php 
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
?>	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<section class="row">
	<div class="container dashboard_bg">
		<div class="dr_upload_doc_slide">
			<div class="dr_message_side_bg">
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
			
		<div class="slide_right">
			<div class="anesth_bg">
			<div class="view_application">
			<?php 
				if(isset($_REQUEST['fid']) && ($_REQUEST['uid']))
				{
					$functions->getInnerBilling($doctor_id,$_REQUEST['fid']);
					$functions->acceptBilling($doctor_id,$_REQUEST['fid']);
				}
				else
				{
		?>
					<div class="dr_upload_side_row">	
						<div id="container">
							<?php
								echo $functions->getBilling($doctor_id);							
							?>
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
