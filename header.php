<?php
	session_start();
	include('classes/login-functions.php');
	$path = $_SERVER['DOCUMENT_ROOT']."/path.php"; 
	include($path);
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
	<title>
		<?php  
			$page_name = $_SERVER['REQUEST_URI']; 
			switch($page_name)
			{
				case "/":
				echo "mayosurgical.com";
				break;
				
				case "/signup.php":
				echo "Sign Up";
				break;
				
				case "/index.php":
				echo "Home";
				break;
				
				case "/about.php":
				echo "About";
				break;
				
				case "/services.php":
				echo "Services";
				break;
				
				case "/faq.php":
				echo "FAQ";
				break;
				
				case "/terms.php":
				echo "Terms";
				break;
				
				case "/contact.php":
				echo "Contact Us";
				break;
				
				case  "/login.php":
				echo "Login";
				break;
				
				case  "/forgot-password.php":
				echo "Forgot Password";
				break;
				
				case "/forget-password.php";
				echo "Forget Password";
				break;
				
				case "/upload-docs.php";
				echo "Upload Documents";
				break;
				
				default:
				echo "Home";
				
			}
		?>
	</title>
<link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<header class="row">
	<div class="primary_nav">
		<div class="container">
			<div class="primary_nav_left">
				<span class="nav_icon_left"></span>
				<div class="menu_bg">
					<ul>
						<li><a href="<?php echo $sitepath; ?>/index.php">Home</a></li>
						<li><a href="<?php echo $sitepath; ?>/about.php">About</a></li>
						<li><a href="<?php echo $sitepath; ?>/services.php">Services</a></li>
						<li><a href="<?php echo $sitepath; ?>/faq.php">FAQ</a></li>
						<li><a href="<?php echo $sitepath; ?>/terms.php">Terms</a></li>
						<li><a href="<?php echo $sitepath; ?>/contact.php">Contact Us</a></li>
						<li><a href="<?php echo $sitepath; ?>/signup.php">Registration</a></li>
					</ul>
				</div>
				<span class="nav_icon_right"></span>
			</div>
			<div class="login_button">
				<?php if(loggedin()) 
					{
						$uDesignations = $_SESSION['designation'];
						switch($uDesignations)
						{
							case '1':
							echo '<div class="backpanel"><a href="'.$sitepath.'/anesthesiologist">Anesthesiologist Profile</a></div>';
							break;
							
							case '2':
							echo '<div class="backpanel"><a href="'.$sitepath.'/attorney">Attorney Profile</a></div>';
							break;
							
							case '3':
							echo '<div class="backpanel"><a href="'.$sitepath.'/doctors">Doctor Profile</a></div>';
							break;
							
							case '4':
							echo '<div class="backpanel"><a href="'.$sitepath.'/medical-facility">Medical Facility Profile</a></div>'; 
							break;
							
							case '6':
							echo '<div class="backpanel"><a href="'.$sitepath.'/underwriter">Underwriter Profile</a></div>';
							break;
							
							case '7':
							echo '<div class="backpanel"><a href="'.$sitepath.'/case-manager">Case Manager Profile</a></div>';
							break;
							
							case '8':
							echo '<div class="backpanel"><a href="'.$sitepath.'/mayo-admin/welcome/">Admin Profile</a></div>';
							break;
						}
						
				?>
				<h1><a href="<?php echo $sitepath; ?>/logout.php">Logout</a></h1>
				<?php
					}
					else
					{
			?>
					<span class="login_icon"></span>
					<h1><a href="<?php echo $sitepath; ?>/login.php">Login</a></h1>
			<?php   } 
			?>
			</div>
		</div>
	</div>
	<!--<div class="container">
		<div class="logo">
			<h1><a href="#">logo</a></h1>
		</div>
		<div class="social_right">
			<div class="social_feeds">
				<ul>
					<li class="social_facebook"><a href="#">F</a></li>
					<li class="social_twitter"><a href="#">t</a></li>
					<li class="social_linkedin"><a href="#">l</a></li>
				<ul>
			</div>
			<div class="toll_free">
				<h1>1-866-411-2525</h1>
			</div>
		</div>
	</div>	-->
</header>
