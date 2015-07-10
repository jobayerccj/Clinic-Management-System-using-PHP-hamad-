<?php 
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
?><script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link href="<?php echo $sitepath; ?>/calend/jquery.datepick.css" rel="stylesheet">
			<script src="<?php echo $sitepath; ?>/calend/jquery.plugin.js"></script>
			<script src="<?php echo $sitepath; ?>/calend/jquery.datepick.js"></script>
			<script>
$(function() {
	$('#popupDatepicker').datepick({yearRange: '1920:2020',minDate: new Date(12-1, 25),dateFormat: 'dd-mm-yyyy'});
});
</script>	
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
			?>
			
			
				<?php
					$tempcheck = mysql_query("SELECT `form_id` FROM `hire_staff` WHERE `hire_id`='$doctor_id' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
					if(mysql_num_rows($tempcheck)>=1)
					{
						$qry = "SELECT a . * , b . * , c.id AS hi_id FROM plantiff_information AS a, plantiff_case_type_info AS b, hire_staff AS c WHERE a.id = b.id && a.form_id = b.form_id && a.id = c.user_id && a.id = c.user_id && b.id = c.user_id && hire_id ='$doctor_id' && a.form_id='$_REQUEST[fid]' && b.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]' && b.id='$_REQUEST[uid]' && c.user_id='$_REQUEST[uid]' && b.case_closed=0";
						$sql = mysql_query($qry) or die(mysql_error());
						$row = mysql_fetch_array($sql);
						$case_type = $row['case_type'];
						if($case_type =='1' || $case_type == '3' || $case_type == 	'5')
						{
							//echo "Test1";
							echo $functions->orthoView($row);
						}
						elseif($case_type == '6')
						{
							//echo "Test2";
							$functions->MedicalView($row);
						}
						else
						{ 
							//echo "Test3";
							$functions->meshedView($row);
						}
					}
					else
					{
						echo "<div class='e_message'>Unexpected Error. No Data. Please Go <a href='index.php'>Back</a></div>";
					}
		}
		else
		{
		?>
				<h1>Search Clients</h1>
				<div class="dr_upload_side_row">	
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
								$functions->getClientRecords($doctor_id,10,4,$search);	
							}
							else
							{
								$functions->getClientRecords($doctor_id,10,4,""); 
								//echo "<div class='slide_right'>";
								$functions->getAppointment($doctor_id);
								//echo "</div>";
								echo "<div class='slide_right'>";
								//$functions->getBilling($doctor_id);
								echo "</div>";
							}
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
