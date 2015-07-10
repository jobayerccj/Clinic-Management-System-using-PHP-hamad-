<?php
ob_start();
require_once('../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";

require_once($path);
include($config);
include '../functions.php';
$classfile = $_SERVER['DOCUMENT_ROOT']."/classes/functions.php";
include($classfile);
include('header.php');
if(loggedin())
{
	$desg  = new Allfunctions();
?>
<section class="row">
	<div class="container">
		<div class="form_section_content">
		<h1 class="add_user">Add Subroles</h1>
<form name="userinfo" method="post" action="" id="regform">
	<ul>
		<li>
			<span class="form_label">	
				<label>Designation</label>
			</span>
			<span class="form_input">
				<?php 
					$var = "designation";
					echo $desg->GetRoles($var); 
				?>
				<span class="error"></span>
			</span>
		</li>
	  
	   <li>
		   <span class="form_label">
				<label>Sub Role</label>
			</span>
			<span class="form_input">
				<input type="text" name="sub_role" value="" required />
				<span class="error"></span>
			</span>
	   </li>
			
		<li>	
		<span class="form_label">&nbsp;</span>
			<input type="submit" name="add-role" value="Add Role" required/>
		</li>
		</ul>
	
</form>
<?php
	if(isset($_POST['add-role']))
	{
		$desig    = $_POST['designation'];
		$sub_role = $_POST['sub_role'];
		$addrole  = mysql_query("INSERT INTO `sub_designation` (`designation_id`,`sub_designation_name`) VALUES ('$desig','$sub_role')") 
		or die(mysql_error());
		echo "Role Added Successfully";
	}
?>
<?php }else { 
header('Location:../login.php');
 } ?>
</div>
	</div>
</section>
<?php
require($get_footer);
?>
