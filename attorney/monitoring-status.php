<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
include('classes/meshed.php');
if(loggedin()) 
{
	$a_username = $_SESSION['username'];
?>
<section class="row">
	<div class="container dashboard_bg">
		<?php
			$temp_profile = new meshed();
			$profile      = $temp_profile->DisplayProfile($a_username);
			echo $profile;
			$userlist     = $temp_profile->UserList();
			//echo $userlist;

		?>
		
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
