<?php 
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
include('includes/appointment.php');
//class file calling from attorney panel
$functions = new Appointment();
if(loggedin()) 
{
/*Class file to call the functions*/
?><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<section class="row">
	<div class="container dashboard_bg">
	
		<div class="dr_upload_doc_slide">
			<div class="dr_message_side_bg">
			<div class="dr_message_side">
				<script>
						 $(document).ready(function() 
						 {
							 $(".view").load("latestmessages.php?attorneys_id=<?php echo $attorneys_id; ?>");
						   var refreshId = setInterval(function() {
							  $(".view").load('latestmessages.php?attorneys_id=<?php echo $attorneys_id; ?>');
						   }, 5000);
						   $.ajaxSetup({ cache: false });
						});
					</script>
					<div class="view"></div>
</div>					
			</div>
		</div>
		<div class="slide_right">
			<div class="dashbord_client">
				<h1>Cases</h1>
				<div id="loading"></div>
					<div id="container">
						<div class="data">
						</div>
						<div class="pagination">
						</div>
						<?php
							if(isset($_POST['search_data']))
							{
								$firstname = mysql_real_escape_string($_POST['plantiffName']);
								$lastname  = mysql_real_escape_string($_POST['plantiflName']);
								$dob       = mysql_real_escape_string($_POST['dob']);
								$cases     = mysql_real_escape_string($_POST['type_of_cases']);
								$search    = array($firstname,$lastname,$dob,$cases);
								$functions->getClientRecords($attorneys_id,10,4,$search);	
							}
							else
							{
								$functions->getClientRecords($attorneys_id,10,4,""); 
								$functions->getAppointment($attorneys_id);
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
	else{
		header('Location:../../login.php');
	}
?>