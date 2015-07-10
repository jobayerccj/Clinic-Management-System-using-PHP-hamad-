<?php
	$providerId = $_GET['provider_id'];
	$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
	require_once($path);
	include($config);
	$userId = $_REQUEST['userId'];
	$cptId  = $_REQUEST['cptId'];
?>
<?php
	//$temp_data = mysql_query("SELECT * FROM `cpt_codes` WHERE `cpt_code`='$code'") or die(mysql_error());
	//$data      = mysql_fetch_object($temp_data);
	
?>
<!--<textarea name="description" placeholder="Description" required /><?//=$data->description?></textarea>
<input type="text" name="phy_loc" placeholder="Physician Cost" value="<?//=$data->loc?>" required />
<input type="text" name="physician" placeholder="Physician" value="<?//=$data->ortho_group?>" required />
<input type="text" name="facility" placeholder="Facility" value="<?//=$data->phoenix?>" required />
<input type="text" name="other" placeholder="Other" value="<?//=$data->matthews?>" required />
<input type="submit" name="add_cpt" value="Add Bill">-->

<?php
	$temp="SELECT * FROM `admin_billing` WHERE `id`='$userId' && `cpt_code`='$cptId'";
	$temp_data = mysql_query("SELECT * FROM `admin_billing` WHERE `id`='$userId' && `cpt_code`='$cptId'") or die(mysql_error());
	$data      = mysql_fetch_object($temp_data);
	
?>

<textarea name="description" placeholder="Description" required /><?=$data->description?></textarea>
Physician Cost<br/>
<input type="text" name="d_cost" placeholder="Physician Cost" value="<?=$data->doctor_cost?>" required /><br/>
Physician<br/>
<input type="text" name="d_price" placeholder="Physician" value="<?=$data->doctor_price?>" required /><br/>
Facility Cost<br/>
<input type="text" name="f_cost" placeholder="Facility Cost" value="<?=$data->facility_cost?>" required /><br/>
Facility<br/>
<input type="text" name="f_price" placeholder="Facility" value="<?=$data->facility_price?>" required /><br/>
Other Cost<br/>
<input type="text" name="a_cost" placeholder="Other Cost" value="<?=$data->anes_cost?>" required /><br/>
Other<br/>
<input type="text" name="a_price" placeholder="Other" value="<?=$data->anes_price?>" required /><br/>
<input type="submit" name="add_cpt" value="Add Bill">
