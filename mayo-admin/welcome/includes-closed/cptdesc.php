<?php
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
$cptIds = $_GET['cptId'];
$descTemp = mysql_query("SELECT * FROM `cpt_codes` WHERE `cpt_code`=$cptIds") or die(msyql_error());
$desc     = mysql_fetch_object($descTemp);
?>
<li>
   <span class="form_label">
		<label>Description</label>
	</span>
	<span class="form_input">
		<textarea name="description" rows="10" cols="50"><?php echo $desc->description; ?></textarea>
		<span class="error"></span>
	</span>
</li>
