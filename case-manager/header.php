	<?php
session_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php"; 
include($path);
$functionsfile = $pathofmayo."/classes/functions.php";
include($functionsfile);
include('classes/meshed.php');
$temp_profile = new meshed();
$panel = $_SESSION['username'];
$attorneys_id = $temp_profile->GetDetailsByUsername($panel,"id");
if($_SESSION['designation']!=="7")
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
	
	<?php
	if(isset($_REQUEST['fid']))
	{
		$pName = ucwords($temp_profile->GetInfoPlantiffInformation('plantiff_name',$_REQUEST['fid']));		
	}
	if(isset($_REQUEST['cid']))
	{
		$caseName = $temp_profile->getNameCase($_REQUEST['cid']);	
	}
	if(isset($_REQUEST['page']))
	{
		$page = $_REQUEST['page'];
	}
	$title = $_SERVER['REQUEST_URI'];
	//echo "/attorney/full-details.php?fid=".$_REQUEST['fid']."&uid=".$_REQUEST['uid']."&cid=".$_REQUEST['cid'];
?> 
	<title>
	<?php 
			switch($title)
{
		case "/case-manager/":
	echo "Home";
	break;
	case "/case-manager/index.php":
	echo "Home";
	break;
	case "/case-manager/meshed-form/";
	echo "Mesh Registration Form";
	break;
	case "/case-manager/meshed-form/index.php";
	echo "Mesh Registration Form";
	break;
	case "/case-manager/meshed-form/meshed-step-2.php";
	echo "Mesh Registration Step 2 Form";
	break;
	case "/case-manager/ortho-form/"; 
	echo "Ortho Form";
	break;
	case "/case-manager/ortho-form/index.php"; 
	echo "Ortho Form";
	break;
	case "/case-manager/ortho-form/ortho-step-2.php"; 
	echo "Ortho Step 2 Form";
	break;
	case "/case-manager/pain-management/";
	echo "Pain-Management Application Form";
	break;
	case "/case-manager/pain-management/index.php";
	echo "Pain-Management Application Form";
	break;
	case "/case-manager/pain-management/pain-management-step-2.php";
	echo "Pain-Management Step 2 Application Form";
	break;
	case "/case-manager/general-surgery-case/";
	echo "General Registration Form";
	break;
	case "/case-manager/general-surgery-case/index.php";
	echo "General Registration Form";
	break;
	case "/case-manager/general-surgery-case/general-surgery-step-2.php";
	echo "General Registration Step 2 Form";
	break;
	case "/case-manager/neurology/";
	echo "Spine/Neuro Application Form";
	break;	
	case "/case-manager/neurology/index.php";
	echo "Spine/Neuro Application Form";
	break;	
	
	case "/case-manager/neurology/neurology-step-2.php";
	echo "Spine/Neuro Application Step 2 Form";
	break;
	
	case "/case-manager/medical-records-request/";
	echo "Medical Records Request";
	break;	
	case "/case-manager/medical-records-request/index.php";
	echo "Medical Records Request";
	break;	
	
	case "medical-records-request-step-2.php";
	echo "Medical Records Request Step 2";
	break;
	
	case "/case-manager/cases.php";
	echo "View Cases";
	break;
		
	case "/case-manager/index.php";
	echo "View Cases";
	break;
	
	case "/case-manager/all-cases.php";
	echo "Pending Cases";
	break;	
	
	case "/case-manager/add-new-client.php";
	echo "New Staff Registration";
	break;	
	
	case "/case-manager/clients-list.php";
	echo "Staff List";
	break;

	case "/case-manager/meshed-form/meshed-step-2.php/";
	echo "Meshed Step-2 Registration Form";
	break;
	
	case "/case-manager/ortho-form/ortho-step-2.php";
	echo "Ortho Step-2 Registration Form";
	break;
	
	case "/case-manager/pain-management/pain-management-step-2.php";
	echo "Pain Management Step-2 Registration Form";
	break;
	
	case "/case-manager/general-surgery-case/general-surgery-step-2.php";
	echo "General Surgery Step-2 Registration Form";
	break;
	
	case "/case-manager/neurology/neurology-step-2.php";
	echo "Neuro Step-2 Registration Form";
	break;
	
	case "/case-manager/medical-records-request/medical-records-request-step-2.php";
	echo "Medical Records Request Step-2 Registration Form";
	break;
	
	case "/case-manager/profile.php";
	echo "Profile";
	break;
	
	
}
if(isset($_REQUEST['fid']) && isset($_REQUEST['cid']) && isset($_REQUEST['uid']))
	{
		if($title == "/case-manager/full-details.php?fid=".$_REQUEST['fid']."&uid=".$_REQUEST['uid']."&cid=".$_REQUEST['cid'])
		{
			echo $fulldetailsurl = "[ ".$caseName." ] Full Details of Client ".$pName;	
		}
		elseif($title == "/case-manager/check-status.php?fid=".$_REQUEST['fid']."&uid=".$_REQUEST['uid']."&cid=".$_REQUEST['cid'])
		{
			echo $checkstatusurl = "[ ".$caseName." ] Status Details of Client ".$pName;
		}
		elseif($title == "/case-manager/upload-documents.php?fid=".$_REQUEST['fid']."&uid=".$_REQUEST['uid']."&cid=".$_REQUEST['cid'])
		{
			echo $uploadDocurl = "[ ".$caseName." ] Upload Documents of Client ".$pName;
		}
	}
	elseif(isset($_REQUEST['page']))
	{
		$title == "/case-manager/?page=".$_REQUEST['page'];
		echo $pageurl ="Cases List Page ".$_REQUEST['page'];
	}
	elseif(isset($_REQUEST['action']))
	{
		echo "Edit Profile";
	}
	elseif(isset($_REQUEST['msid']))
	{
		$title == "/case-manager/messages.php?msid=".$_REQUEST['msid']."&fid=".$_REQUEST['fid']."&uid=".$_REQUEST['uid'];
		echo "Message ( ".$pName." ) ";
	}
?>
	 </title>
	<link rel="stylesheet" href="<?php echo $sitepath; ?>/case-manager/style.css" type="text/css"/>
		<script type="text/javascript">
function mask(e,f){
 var len = f.value.length;
 var key = whichKey(e);
  if((key>47 && key<58) || (key>95 && key<106))
 {
  if( len==0 )f.value=f.value+'('
  else if( len==4 )f.value=f.value+') '
  else if(len==9 )f.value=f.value+'-'
  else f.value=f.value;
 }
}
function whichKey(e) 
{
	 var code;
	 if (!e) var e = window.event;
	 if (e.keyCode) code = e.keyCode;
	 else if (e.which) code = e.which;
	 return code
	// return String.fromCharCode(code);
	}
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
			$pane = $temp_profile->GetPanel($panel);
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
			<div class="login_button">
				
				<h1><a href="<?php echo $sitepath; ?>/case-manager/profile.php">Profile</a> &nbsp; </h1>
			</div>
		</div>
	</div>
</header>
