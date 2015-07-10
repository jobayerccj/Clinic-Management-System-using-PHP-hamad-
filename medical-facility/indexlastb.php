<?php 
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
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
		<?php include('latestmessages.php'); ?>
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
					<div class="tabber" id="tab1">
						<div class="tabbertab">
							<h2><a name="tab1">Ortho Case</a></h2>
							<div class="anesth_search">
							<form name="form1" method="post" action="">
									<input type="text" name="p_name_p" id="" placeholder="First Name"/>
									<input type="text" name="p_email_p" id="" placeholder="Last Name"/>
									<input type="text" name="p_d_o_b" id="" placeholder="Date of Birth"/>
									<input type="Submit" name="p_search1" id="" value="Search"/>
								</form>
							<?php
								if(isset($_POST['p_search1']))
								{
									$p_name_p = $_POST['p_name_p'];
									$p_email_p = $_POST['p_email_p'];
									$p_d_o_b = $_POST['p_d_o_b'];
									$array_p = array($p_name_p,$p_email_p,$p_d_o_b);
									$functions->searchFunction(1,$doctor_id,$array_p);
								}
								else
								{
									$functions->getClientRecords(1,$doctor_id); 
									$functions->getAppointment(1,$doctor_id);
								}
							?>
							
						</div>
						<div class="tabbertab">
							<h2>Mesh Case</h2>
							<div class="anesth_search">
							<form name="form2" method="post" action="">
									<input type="text" name="p_name_p" id="" placeholder="First Name"/>
									<input type="text" name="p_email_p" id="" placeholder="Last Name"/>
									<input type="text" name="p_d_o_b" id="" placeholder="Date of Birth"/>
									<input type="Submit" name="p_search2" id="" value="Search"/>
								</form>
							<?php
								if(isset($_POST['p_search2']))
								{
									$p_name_p = $_POST['p_name_p'];
									$p_email_p = $_POST['p_email_p'];
									$p_d_o_b = $_POST['p_d_o_b'];
									$array_p = array($p_name_p,$p_email_p,$p_d_o_b);
									$functions->searchFunction(2,$doctor_id,$array_p);
								}
								else
								{
									$functions->getClientRecords(2,$doctor_id); 
									$functions->getAppointment(2,$doctor_id);
								}
							?>
						</div>
						<div class="tabbertab">
							<h2>Pain Management<br>Case</h2>
							<div class="anesth_search">
							<form name="form3" method="post" action="">
									<input type="text" name="p_name_p" id="" placeholder="First Name"/>
									<input type="text" name="p_email_p" id="" placeholder="Last Name"/>
									<input type="text" name="p_d_o_b" id="" placeholder="Date of Birth"/>
									<input type="Submit" name="p_search2" id="" value="Search"/>
								</form>
							<?php
								if(isset($_POST['p_search3']))
								{
									$p_name_p = $_POST['p_name_p'];
									$p_email_p = $_POST['p_email_p'];
									$p_d_o_b = $_POST['p_d_o_b'];
									$array_p = array($p_name_p,$p_email_p,$p_d_o_b);
									$functions->searchFunction(3,$doctor_id,$array_p);
								}
								else
								{
									$functions->getClientRecords(3,$doctor_id); 
									$functions->getAppointment(3,$doctor_id);
								}
							?>
						</div>
						<div class="tabbertab">
							<h2>General Surgery<br>Case</h2>
							<div class="anesth_search">
							<form name="form4" method="post" action="">
									<input type="text" name="p_name_p" id="" placeholder="First Name"/>
									<input type="text" name="p_email_p" id="" placeholder="Last Name"/>
									<input type="text" name="p_d_o_b" id="" placeholder="Date of Birth"/>
									<input type="Submit" name="p_search4" id="" value="Search"/>
								</form>
							<?php
								if(isset($_POST['p_search4']))
								{
									$p_name_p = $_POST['p_name_p'];
									$p_email_p = $_POST['p_email_p'];
									$p_d_o_b = $_POST['p_d_o_b'];
									$array_p = array($p_name_p,$p_email_p,$p_d_o_b);
									$functions->searchFunction(4,$doctor_id,$array_p);
								}
								else
								{
									$functions->getClientRecords(4,$doctor_id); 
									$functions->getAppointment(4,$doctor_id);
								}
							?>
						</div>
						<div class="tabbertab">
							<h2>Spine/Neuro<br>Case</h2>
							<div class="anesth_search">
							<form name="form5" method="post" action="">
									<input type="text" name="p_name_p" id="" placeholder="First Name"/>
									<input type="text" name="p_email_p" id="" placeholder="Last Name"/>
									<input type="text" name="p_d_o_b" id="" placeholder="Date of Birth"/>
									<input type="Submit" name="p_search5" id="" value="Search"/>
								</form>
							<?php
								if(isset($_POST['p_search5']))
								{
									$p_name_p = $_POST['p_name_p'];
									$p_email_p = $_POST['p_email_p'];
									$p_d_o_b = $_POST['p_d_o_b'];
									$array_p = array($p_name_p,$p_email_p,$p_d_o_b);
									$functions->searchFunction(5,$doctor_id,$array_p);
								}
								else
								{
									$functions->getClientRecords(5,$doctor_id); 
									$functions->getAppointment(5,$doctor_id);
								}
							?>
						</div>
						<div class="tabbertab">
							<h2>Medical Release Form</h2>
							<div class="anesth_search">
							<form name="form6" method="post" action="">
									<input type="text" name="p_name_p" id="" placeholder="First Name"/>
									<input type="text" name="p_email_p" id="" placeholder="Last Name"/>
									<input type="text" name="p_d_o_b" id="" placeholder="Date of Birth"/>
									<input type="Submit" name="p_search6" id="" value="Search"/>
								</form>
							<?php
								if(isset($_POST['p_search6']))
								{
									$p_name_p = $_POST['p_name_p'];
									$p_email_p = $_POST['p_email_p'];
									$p_d_o_b = $_POST['p_d_o_b'];
									$array_p = array($p_name_p,$p_email_p,$p_d_o_b);
									$functions->searchFunction(6,$doctor_id,$array_p);
								}
								else
								{
									$functions->getClientRecords(6,$doctor_id); 
									$functions->getAppointment(6,$doctor_id);
								}
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
