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
<section class="row">
	<div class="container dashboard_bg">
		<div class="dr_upload_doc_slide">
			<div class="dr_message_side_bg">
				
				<div class="dr_message_side">
				<?php if(isset($_REQUEST['fid']) && isset($_REQUEST['uid'])){?>
				<h1>Appointment</h1>
					<div class="dr_message_side_row">
						<div class="dr_message_side_right">
							<a href="appointment-schedule.php?fid=<?php echo $_REQUEST['fid'];?>&uid=<?php echo $_REQUEST['uid']; ?>">Appointment Schedule</a>
						</div>
						<div class="dr_message_side_right">
							<a href="appointment-status.php?fid=<?php echo $_REQUEST['fid'];?>&uid=<?php echo $_REQUEST['uid']; ?>">Appointment Status</a>
						</div>
					</div>
					<?php }else{ include('latestmessages.php'); }?>
					
				</div>		
			</div>
		</div>
		<div class="slide_right">
			<div class="anesth_bg">
			<?php 
				if(isset($_REQUEST['fid']) && ($_REQUEST['uid']))
				{
			?>
			<div class="view_application">
			
				<?php
					$tempcheck = mysql_query("SELECT `form_id` FROM `hire_staff` WHERE `hire_id`='$doctor_id' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
					if(mysql_num_rows($tempcheck)>=1)
					{
						$qry = "SELECT a . * , b . * , c.id AS hi_id FROM plantiff_information AS a, plantiff_case_type_info AS b, hire_staff AS c WHERE a.id = b.id && a.form_id = b.form_id && hire_id ='$doctor_id' && a.form_id='$_REQUEST[fid]' && b.form_id='$_REQUEST[fid]' && b.admin_approved = 1 && b.case_closed=0";
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
					<div class="tabber" id="tab1">
						<div class="tabbertab">
							<h2><a name="tab1">Ortho Case</a></h2>
							<?php
								$functions->getClientRecords(1,$doctor_id); 
								$functions->getAppointment(1,$doctor_id)
							?>
						</div>
						<div class="tabbertab">
							<h2>Mesh Case</h2>
							<?php
								$functions->getClientRecords(2,$doctor_id); 
								$functions->getAppointment(2,$doctor_id)
							?>
						</div>
						<div class="tabbertab">
							<h2>Pain Management<br>Case</h2>
							<?php
								$functions->getClientRecords(3,$doctor_id); 
								$functions->getAppointment(3,$doctor_id)
							?>
						</div>
						<div class="tabbertab">
							<h2>General Surgery<br>Case</h2>
							<?php
								$functions->getClientRecords(4,$doctor_id); 
								$functions->getAppointment(4,$doctor_id)
							?>
						</div>
						<div class="tabbertab">
							<h2>Spine/Neuro<br>Case</h2>
							<?php
								$functions->getClientRecords(5,$doctor_id); 
								$functions->getAppointment(5,$doctor_id)
							?>
						</div>
						<div class="tabbertab">
							<h2>Medical Release<br>Home </h2>
							<?php
								$functions->getClientRecords(6,$doctor_id); 
								$functions->getAppointment(6,$doctor_id)
							?>
						</div>
					</div>
				</div>
				<?php } ?>
		</div>
	</div>
</section>
<script type="text/javascript">
	document.write('<style type="text/css">.tabber{display:none;}<\/style>');
	var tabberOptions = {
		'manualStartup':true,
		'onLoad':function(argsObj) {
		/* Display an alert only after tab2 */
			if (argsObj.tabber.id == 'tab2') {
				alert('Finished loading tab2!');
			}
		},
		'onClick':function(argsObj) {
			var t = argsObj.tabber; /* Tabber object */
			var id = t.id; /* ID of the main tabber DIV */
			var i = argsObj.index; /* Which tab was clicked (0 is the first tab) */
			var e = argsObj.event; /* Event object */
			if (id == 'tab2') {
				return confirm('Swtich to '+t.tabs[i].headingText+'?\nEvent type: '+e.type);
			}
		},
		'addLinkId':true
	};
</script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/tabs/tabber.js"></script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/tabs/example.css"></script>
<script type="text/javascript">
	tabberAutomatic(tabberOptions);
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $sitepath; ?>/popup/featherlight.min.css" title="Featherlight Styles" />
<script src="<?php echo $sitepath; ?>/popup/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo $sitepath; ?>/popup/style.css">
<?php
require($get_footer);
}
else
{
	
header('Location:../../login.php');
	
}
?>
