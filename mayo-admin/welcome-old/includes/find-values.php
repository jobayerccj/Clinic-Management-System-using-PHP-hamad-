<?php
	$providerId = $_GET['provider_id'];
	$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
	require_once($path);
	include($config);
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
	$temp_data = mysql_query("SELECT * FROM `admin_billing` WHERE `id`='$providerId'") or die(mysql_error());
	$data      = mysql_fetch_object($temp_data);
	
?>
<select name="cpt" class="sel_reg_form" onchange="getAllCpt(<?php echo $providerId;?>,this.value);" required>
	<option value="">...CPT Code...</option>
	<?php
		$dataTemp = mysql_query("SELECT * FROM `admin_billing` WHERE id='$providerId'") or die(mysql_error());
		while($data = mysql_fetch_object($dataTemp))
		{
	?>
		<option value="<?=$data->cpt_code?>"><?=$data->cpt_code?></option>
	<?php
		}
	?>
</select>
<div id="final_area">
	<textarea name="description" placeholder="Description" required /></textarea>
	<input type="text" name="phy_loc" placeholder="Physician Cost" value="" required />
	<input type="text" name="ortho_group" placeholder="Physician" value="" required />
	<input type="text" name="st_mathews" placeholder="Facility" value="" required />
	<input type="text" name="phenoix" placeholder="Other" value="" required />
	<input type="text" name="other" placeholder="Other" value="" required />
	<input type="submit" name="add_cpt" value="Add Bill">
</div>