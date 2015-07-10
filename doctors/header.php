<?php
session_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $pathofmayo."/path.php";
require_once($path);
if($_SESSION['designation']!=="3")
{
?>
<script>window.location="<?php echo $sitepath; ?>"</script>
<?php
}
$username = $_SESSION['username'];
$functionsfile = $pathofmayo."/classes/functions.php";
include($functionsfile);
//$functions = new AllFunctions();

include('../allpanels/allpanels.php');
//class file calling from attorney panel
$functions = new AllPanels();
$doctor_id = $functions->GetDetailsByUsername($username,"id");
$d_f_name  = $functions->GetDetailsByUsername($username,"first_name");
$d_l_name  = $functions->GetDetailsByUsername($username,"last_name");
$contactn   = $functions->GetDetailsByUsername($username,"contact_number");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<?php
	$title = $_SERVER['REQUEST_URI'];
?>
	<title>
		 <?php 
		 
			switch($title)
{
	case "/doctors/index.php":
	echo "Home";
	break;
	case "/doctors/add-staff.php";
	echo "Add Staff";
	break;
	case "/doctors/client-list.php";
	echo "View Staff";
	break; 
	case "/doctors/appointments.php";
	echo "Appointments";
	break;
	case "/doctors/schedulling.php";
    echo "Schedulling";
	break;
	
} 
		?> 
	</title>
	<link rel="stylesheet" href="<?php echo $sitepath; ?>/doctors/style.css" type="text/css"/>
	<link rel="stylesheet" href="../allpanels/pagination.css" type="text/css"/>
</head>
<body>
<header class="row">
	<div class="container">
		<div class="logo">
			<h1><a href="<?php echo $sitepath; ?>">logo</a></h1>
		</div>
		<div class="social_right">
			<?php
			$getpanel = new AllFunctions();
			$pane = $getpanel->GetPanel($username);
			echo $pane;
			?>
		</div>
	</div>
	<div class="primary_nav">
		<div class="container">
			<div class="primary_nav_left">
				<span class="nav_icon_left"></span>
				<?php
					include('menu.php');
				?>
				<span class="nav_icon_right"></span>
			</div>
			<div class="profile_button">
				<span class="profile_icon"></span>
				<h1><a href="profile.php">Profile</a> &nbsp; </h1>
			</div>
		</div>
	</div>
</header>
