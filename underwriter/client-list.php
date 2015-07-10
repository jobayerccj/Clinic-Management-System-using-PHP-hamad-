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
/*Class file to call the functions*/
include('../attorney/classes/meshed.php');
$functions = $_SERVER['DOCUMENT_ROOT']."/classes/functions.php";
require_once($functions);
$myobj = new Meshed();
$a_username    = $_SESSION['username'];
		
$getfunction   = new Allfunctions();
$designationid = $getfunction->GetObjectByUsername("id",$a_username);
?>

<?php
if(isset($_REQUEST['record'])){
	switch($_REQUEST['record']){
		case 'updated' :		
		$msg = "Reocrd Updated Successfully";
?>
		<div class="container">
			<div class="search_bottom">
				<p><?=$msg?></p>
				<h1>Client List</h1>
				<div class="attorney_row">
					<div class="attorney_row_heading">
						<div class="attorney_client_1">SR No.</div>
						<div class="attorney_client_1">Staff No.</div>
						<div class="attorney_client_2">Staff Name</div>
						<div class="attorney_client_3">Contact No.</div>
						<div class="attorney_client_4">Email-Address</div>
						<div class="attorney_client_4">Position</div>
						<div class="attorney_client_5">Date</div>
						<div class="attorney_client_6">Action</div>
					</div>
					<?php
						$qry = " SELECT a . * , b . * , c . * FROM members AS a, sub_members AS b, states AS c WHERE a.id = b.user_id && a.state = c.state_code && a.id='$designationid'";
						$sql = mysql_query($qry) or die(mysql_error());
						$i = 0;
						while($row = mysql_fetch_array($sql)){
						$i++;
					?>
					<div class="attorney_row_content">
						<div class="attorney_client_1"><?=$i?></div>
						<div class="attorney_client_1"><?=$row['id']?></div>
						<div class="attorney_client_2"><?=$row['first_name']?></div>
						<div class="attorney_client_3"><?=$row['contact_number']?></div>
						<div class="attorney_client_4"><?=$row['email_id']?></div>
						<div class="attorney_client_4"><?=$row['sub_designation']?></div>
						<?php $date = date('d-M-Y', strtotime($row['date_time'])); ?>
						<div class="attorney_client_5"><?=$date?></div>
						<div class="attorney_client_6">
							<a href="?action=update&id=<?=$row['id']?>">Update</a>&nbsp; / &nbsp;<a href="?action=delete&id=<?=$row['id']?>">Delete</a>&nbsp; / &nbsp;<a href="?action=assign&id=<?=$row['id']?>">Assign Work</a>
						</div>
					</div>
					<?php
						}
					?>
				</div>
			</div>
		</div>
<?php
		break;
		
		case 'deleted' :
			$msg = "Successfully Deleted";
		break;
	}
}
if(isset($_REQUEST['action'])){
	$action = $_REQUEST['action'];
	switch($action){
		case 'update' :
		if(isset($_REQUEST['id'])) $id = $_REQUEST['id'];
		$qryupd = " SELECT * FROM members WHERE id = '$id'";
		$sqlupd = mysql_query($qryupd) or die(mysql_error());
		$rows = mysql_fetch_array($sqlupd);
?>

<div style="margin:0px auto; width:75%;">
	<form style="margin:auto;width:75%;" name="register-sub-group" method="post" action="">
		<input type="hidden" name="id" value="<?=$rows['id']?>" />
		<div class="attorney_row_form">
			<label>First Name</label>
			<input type="text" name="first_name" value="<?=$rows['first_name']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>Last Name</label>
			<input type="text" name="last_name" value="<?=$rows['last_name']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>Email Address</label>
			<input type="text" name="email_id" value="<?=$rows['email_id']?>" id="" readonly />
		</div>		
		<div class="attorney_row_form">
			<label>Phone No.</label>
			<input type="text" name="contact_number" value="<?=$rows['contact_number']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>Address</label>
			<input type="text" name="address" value="<?=$rows['address']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>City</label>
			<input type="text" name="city" value="<?=$rows['city']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>State</label>
			<select name="state">
				<?php $myobj->getstats($rows['state']); ?>
			</select>
		</div>
		<div class="attorney_row_form">
			<label>Zip Code</label>
			<input type="text" name="zip_code" value="<?=$rows['zip_code']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>Organisation</label>
			<input type="text" name="organisation" value="<?=$rows['organisation']?>" id=""/>
		</div>
		<div class="attorney_row_form">
			<label>Sub Group</label>
			<?php 
				$subDes = $rows['sub_designation'];
			?>
			<select name="sub_designation">
			<?php
				$sql = mysql_query("SELECT * FROM `sub_designation` where `designation_id`=6") or die(mysql_error());
				while($row = mysql_fetch_object($sql))
				{
			?>
				<option value="<?=$row->designation_id?>"<?php if($subDes == $row->id){echo "selected='selected'";} ?>><?=$row->sub_designation_name?></option>
			<?php
				}
			?>
			</select>
		</div>	
		<span class="form_input">
			<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="1" checked /></div>
			<div class="chk_txt"><label>Receive All Emails</label></div>
		</span>
		<span class="form_input">
			<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="2"/></div>
			<div class="chk_txt"><label>Receive Scheduling Emails</label></div>
		</span>
		<span class="form_input">
			<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="3"/></div>
			<div class="chk_txt"><label>Receive Billing Emails</label></div>
		</span>
		<div class="attorney_row_form">
			<input type="submit" name="update" value="Update" />
		</div>
	</form>	
</div>
<?php
	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$contact_number = $_POST['contact_number'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$zip_code = $_POST['zip_code'];
		$organisation = $_POST['organisation'];
		$sub_designation = $_POST['sub_designation'];
		$updaterecords = " UPDATE members SET first_name = '".$first_name."', last_name = '".$last_name."', 
		contact_number = '".$contact_number."', address = '".$address."', city = '".$city."', state = '".$state."',
		zip_code = '".$zip_code."', organisation = '".$organisation."', sub_designation = '".$sub_designation."' WHERE id='".$id."' ";
		$sqlupdatercrd = mysql_query($updaterecords) or die(mysql_error());
		if(mysql_affected_rows()){
			header("location:?record=updated");
		}
	}
		break;

		case 'delete' :
			if(isset($_REQUEST['id'])) $id = $_REQUEST['id'];
			$qryupd = " DELETE * FROM members WHERE id = '$id'";
			$sqlupd = mysql_query($qryupd) or die(mysql_error());
			if(mysql_affected_rows()){
			header("location:?record=deleted");
		}
		break;
		
		case 'assign' :
?>
<link rel="stylesheet" href="<?php echo $sitepath; ?>/tabs/example.css" TYPE="text/css" MEDIA="screen">
<script type="text/javascript">
document.write('<style type="text/css">.tabber{display:none;}<\/style>');

var tabberOptions = {

  'manualStartup':true,

  'onLoad': function(argsObj) {
    /* Display an alert only after tab2 */
    if (argsObj.tabber.id == 'tab2') {
      alert('Finished loading tab2!');
    }
  },

  'onClick': function(argsObj) {

    var t = argsObj.tabber; /* Tabber object */
    var id = t.id; /* ID of the main tabber DIV */
    var i = argsObj.index; /* Which tab was clicked (0 is the first tab) */
    var e = argsObj.event; /* Event object */

    if (id == 'tab2') {
      return confirm('Swtich to '+t.tabs[i].headingText+'?\nEvent type: '+e.type);
    }
  },

  'addLinkId': true

};

</script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/tabs/tabber.js"></script>
<div class="container">
<div class="search_bottom">
	<div class="tabber" id="tab1">
		<div class="tabbertab">
			<h2><a name="tab1">Assign Work</a></h2>
			<form style="margin:auto;width:75%;" name="workassign" method="post" action="">
				<div class="attorney_row_form">
					<label>Select Client</label>
					<select name="clients">
						<option value="">Select</option>
						<option value="client1">client1</option>
						<option value="client2">client1</option>
					</select>
				</div>
				<div class="attorney_row_form">
					<label>Assign Work To Client</label>
					<textarea rows="5" cols="30" placeholder="Assign Work To Client"></textarea>
				</div>
				<div class="attorney_row_form">
					<input type="submit" name="assign" value="Assign Work" />
				</div>
			</form>
		</div>
		<div class="tabbertab">
			<h2>View Work History</h2>
			<p>Tab 2 content. A nested tabber:</p>
		</div>
	</div>
	<script type="text/javascript">
	tabberAutomatic(tabberOptions);
</script>
</div>
</div>
<?php
		break;
	}
}else{
?>

<section class="row">
	<div class="container">
		<div class="search_bottom">
			<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div> <h1>Staff List</h1>
			<div class="attorney_row">
				<div class="attorney_row_heading">
					<div class="attorney_client_1">Staff No.</div>
					<div class="attorney_client_2">Staff Name</div>
					<div class="attorney_client_3">Contact No.</div>
					<div class="attorney_client_4">Email-Address</div>
					<div class="attorney_client_4">Position</div>
					<div class="attorney_client_5">Date</div>
					<div class="attorney_client_6">Action</div>
				</div>
				<?php
					$qry = "select a.*,b.* from members as a, sub_members as b where a.sub_designation!=0 and b.user_id=a.id and b.main_user_id='$designationid'";
					$sql = mysql_query($qry) or die(mysql_error());
					if(mysql_num_rows($sql)>0)
					{
					$i = 0;
					while($row = mysql_fetch_array($sql)){
					$i++;
				?>
				<div class="attorney_row_content">
					<div class="attorney_client_1"><?=$row['id']?></div>
					<div class="attorney_client_2"><?=$row['first_name']?></div>
					<div class="attorney_client_3"><?=$row['contact_number']?></div>
					<div class="attorney_client_4"><?=$row['email_id']?></div>
					<div class="attorney_client_4"><?=$row['sub_designation']?></div>
					<?php $date = date('m-d-Y', strtotime($row['date_time'])); ?>
					<div class="attorney_client_5"><?=$date?></div>
					<div class="attorney_client_6">
						<ul>
							<li><a href="?action=update&id=<?=$row['id']?>" class="attorney_upload" title="Update">Update</a></li>
							<li><a href="?action=delete&id=<?=$row['id']?>" class="attorney_delete" title="Delete">Delete</a></li>
							<!--<li><a href="?action=assign&id=<?php //$row['id']; ?>" class="attorney_assign" title="Assign Work">Assign Work</a></li>-->
						</ul>
					</div>
				</div>
				<?php
					}
					}
					else{
						echo "<h1 style='text-align:center;'>No Staff List</h1>";
					}
				?>
			</div>
		</div>
	</div>
</section>
<?php
}
require($get_footer);
}
else
{	
header('Location:../../login.php');
}
?>
