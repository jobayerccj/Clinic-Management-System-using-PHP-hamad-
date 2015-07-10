<?php
session_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $pathofmayo."/path.php";
require_once($path);
if($_SESSION['designation']!=="6")
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
//$functions     = new AllFunctions();
$doctor_id     = $functions->GetDetailsByUsername($username,"id");
$d_f_name      = $functions->GetDetailsByUsername($username,"first_name");
$d_l_name      = $functions->GetDetailsByUsername($username,"last_name");
$contactn      = $functions->GetDetailsByUsername($username,"contact_number");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<?php
	 $title = $_SERVER['REQUEST_URI'];
?> 
<title> <?php 
			switch($title)
{
	case "/underwriter/":
	echo "Home";
	break;
	case "/underwriter/add-staff.php";
	echo "Add Staff";
	break;
	case "/underwriter/client-list.php"; 
	echo "View Staff";
	break;
	case "/underwriter/billing.php";
	echo "Funding requests";
	break;
	
}
?></title>
	<?php 
		$path = $_SERVER['DOCUMENT_ROOT']."/path.php"; 
		include($path);
	?>
	<link rel="stylesheet" href="<?php echo $sitepath; ?>/underwriter/style.css" type="text/css"/>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script type="text/javascript">
		var auto_refresh = setInterval(
		function ()
		{
			$('#lastest_messages').load('latestmessages.php?doctor_id=<?=$doctor_id?>').fadeIn("slow");
		}, 10000); // refresh every 10000 milliseconds
	</script>
	
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
				<h1><a href="profile.php">Profile</a></h1>
			</div>
		</div>
	</div>
</header>
