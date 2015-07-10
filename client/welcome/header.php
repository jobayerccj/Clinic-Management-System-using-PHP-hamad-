<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
if($_SESSION['designation']!=="5")
{
?>
<script>window.location="<?php echo $sitepath; ?>"</script>
<?php
}
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>:: Home Page ::</title>
	<?php 
		$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php"; 
		include($path);
	?>
	<link rel="stylesheet" href="<?php echo $sitepath; ?>/style.css" type="text/css"/>
	<link rel="stylesheet" href="css/application.css" type="text/css"/>
</head>
<body>
<header class="row">
	<div class="primary_nav">
		<div class="container">
			<div class="primary_nav_left">
				<span class="nav_icon_left"></span>
				<div class="menu_bg">
					<ul>
						<li><a href="<?php echo $sitepath; ?>/client/welcome">Ortho</a></li>
						<li><a href="<?php echo $sitepath; ?>/about.php">About</a></li>
						<li><a href="<?php echo $sitepath; ?>/services.php">Services</a></li>
						<li><a href="<?php echo $sitepath; ?>/faq.php">FAQ</a></li>
						<li><a href="<?php echo $sitepath; ?>/terms.php">Terms</a></li>
						<li><a href="<?php echo $sitepath; ?>/contact.php">Contact Us</a></li>
					</ul>
				</div>
				<span class="nav_icon_right"></span>
			</div>
			<div class="login_button">
				<span class="login_icon"></span>
				<a href="../../../profile.php">Profile</a> &nbsp; 
				<h1><a href="<?php echo $sitepath; ?>/logout.php">Logout</a></h1>
			</div>
		</div>
	</div>
</header>
