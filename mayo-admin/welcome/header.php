<?php
ob_start();
if(!isset($_SESSION))
{
	session_start();
}
ini_set('display_errors',1);  
error_reporting(E_ALL);
if($_SESSION['designation']!='8')
{
	header('location:../logout.php');
}
$path = $_SERVER['DOCUMENT_ROOT']."/path.php"; 
include($path);

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
	<?php 
		$page  = $_SERVER['REQUEST_URI'];		
	?>
	<title>
	<?php
		$page = $_SERVER['REQUEST_URI'];
		
		
		switch($page)
		{	
			case "/mayo-admin/welcome/index.php":
			echo "Admin Panel";
			break;
			
			case "/mayo-admin/welcome/adduser.php":
			echo "Manage Users";
			break;
			
			case "/mayo-admin/welcome/adduser.php":
			echo "Add Users";
			break;
			
			case "/mayo-admin/welcome/verify-users.php":
			echo "Verify Users";
			break;
			
			case "/mayo-admin/welcome/add-subroles.php":
			echo "Add Subroles";
			break;
			
			case "/mayo-admin/welcome/manage-professionals.php":
			echo "Manage Professionals";
			break;
			
			case "/mayo-admin/welcome/new-cases/":
			echo "New Cases";
			break;
			
			case "/mayo-admin/welcome/mesh-case/":
			echo "Mesh Cases";
			break;
			
			case "/mayo-admin/welcome/ortho-case/":
			echo "Ortho Cases";
			break;
			
			case "/mayo-admin/welcome/pain-management-case/":
			echo "Pain Management Cases";
			break;
			
			case "/mayo-admin/welcome/general-surgery-case/":
			echo "General Sergery Case";
			break;
			
			case "/mayo-admin/welcome/neurology-case/":
			echo "Neurlogy Case";
			break;
			
			case "/mayo-admin/welcome/medical-release/":
			echo "Medical Release";
			break;
			
			case "/mayo-admin/welcome/view-logs.php":
			echo "View Logs";
			break;
			
			case "/mayo-admin/welcome/reset-password.php":
			echo "Reset Password";
			break;
			
			case "/mayo-admin/welcome/insert-cpt-code.php":
			echo "Insert CPT Codes";
			break;
			
			case "/mayo-admin/welcome/insert-email.php":
			echo "Insert Email";
			break;
			
			case "/mayo-admin/welcome/add-billing.php":
			echo "Add Billing";
			break;
			
			case "/mayo-admin/welcome/reports.php":
			echo "Reports";
			break;
			
			case "/mayo-admin/welcome/forms.php":
			echo "Add Forms";
			break;
			
			default:
			echo "Admin";
			
			
		}
		
	?>
	</title>

	<link rel="stylesheet" href="<?php echo $sitepath; ?>/mayo-admin/welcome/admin-style.css" type="text/css"/>
	<script type="text/javascript">
						$(function()
						{
							$("#del_forwarded_billing").click(function()
							{
								var element = $(this);
								var dfbid   = element.attr("dfbid");
								var info     = 'dfbid='+dfbid;
								if(confirm("Sure you want to delete this Forwarded billing? There is no undo"))
								{
									$.ajax({
										type:"POST",
										url:"../includes/delete-assigned-billing.php",
										data:info,
										success:function()
										{
											$('#billing_remove').hide();
										}
									});
								}
								return false;
							});
						});
					</script>
</head>
<body>
<header class="row">
	<div class="container">
		<div class="logo">
			<h1><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/">logo</a></h1>
		</div>
		<div class="social_right">
			<!--<div class="social_feeds">
				<ul>
					<li class="social_facebook"><a href="#">F</a></li>
					<li class="social_twitter"><a href="#">t</a></li>
					<li class="social_linkedin"><a href="#">l</a></li>
				<ul>
			</div>-->
			<div class="toll_free">
				<h1>1-866-411-2525</h1>
			</div>
		</div>
	</div>
	<div class="primary_nav">
		<div class="container">
			<div class="primary_nav_left">
				<span class="nav_icon_left"></span>
				<?php include ('menu.php'); ?>
				<span class="nav_icon_right"></span>
			</div>
			<div class="login_button">
				<span class="login_icon"></span>
				<h1><a href="<?php echo $sitepath; ?>/logout.php">Logout</a></h1>
			</div>
		</div>
	</div>	
</header>
<style>
	.menu_bg ul li {
list-style: none;
display: block;
float: left;
position: relative;
border-right: 1px solid #044c8b;
border-left: 1px solid #84b4de;
padding: 0px 0px !important;
}
</style>
