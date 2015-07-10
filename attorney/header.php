<!DOCTYPE html>
<html class="no-js" lang="en">
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
if($_SESSION['designation']!=="2")
{
?>
<script>window.location="<?php echo $sitepath; ?>"</script>
<?php
}
?>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
	

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
	case "/attorney/":
	echo "Home";
	break;
	case "/attorney/index.php":
	echo "Home";
	break;
	case "/attorney/meshed-form/";
	echo "Mesh Registration Form";
	break;
	case "/attorney/meshed-form/index.php";
	echo "Mesh Registration Form";
	break;
	case "/attorney/meshed-form/meshed-step-2.php";
	echo "Mesh Registration Step 2 Form";
	break;
	case "/attorney/ortho-form/"; 
	echo "Ortho Form";
	break;
	case "/attorney/ortho-form/index.php"; 
	echo "Ortho Form";
	break;
	case "/attorney/ortho-form/ortho-step-2.php"; 
	echo "Ortho Step 2 Form";
	break;
	case "/attorney/pain-management/";
	echo "Pain-Management Application Form";
	break;
	case "/attorney/pain-management/index.php";
	echo "Pain-Management Application Form";
	break;
	case "/attorney/pain-management/pain-management-step-2.php";
	echo "Pain-Management Step 2 Application Form";
	break;
	case "/attorney/general-surgery-case/";
	echo "General Registration Form";
	break;
	case "/attorney/general-surgery-case/index.php";
	echo "General Registration Form";
	break;
	case "/attorney/general-surgery-case/general-surgery-step-2.php";
	echo "General Registration Step 2 Form";
	break;
	case "/attorney/neurology/";
	echo "Spine/Neuro Application Form";
	break;	
	case "/attorney/neurology/index.php";
	echo "Spine/Neuro Application Form";
	break;	
	
	case "/attorney/neurology/neurology-step-2.php";
	echo "Spine/Neuro Application Step 2 Form";
	break;
	
	case "/attorney/medical-records-request/";
	echo "Medical Records Request";
	break;	
	case "/attorney/medical-records-request/index.php";
	echo "Medical Records Request";
	break;	
	
	case "medical-records-request-step-2.php";
	echo "Medical Records Request Step 2";
	break;
	
	case "/attorney/cases.php";
	echo "View Cases";
	break;
		
	case "/attorney/index.php";
	echo "View Cases";
	break;
	
	case "/attorney/all-cases.php";
	echo "Pending Cases";
	break;	
	
	case "/attorney/add-new-client.php";
	echo "New Staff Registration";
	break;	
	
	case "/attorney/clients-list.php";
	echo "Staff List";
	break;

	case "/attorney/meshed-form/meshed-step-2.php/";
	echo "Meshed Step-2 Registration Form";
	break;
	
	case "/attorney/ortho-form/ortho-step-2.php";
	echo "Ortho Step-2 Registration Form";
	break;
	
	case "/attorney/pain-management/pain-management-step-2.php";
	echo "Pain Management Step-2 Registration Form";
	break;
	
	case "/attorney/general-surgery-case/general-surgery-step-2.php";
	echo "General Surgery Step-2 Registration Form";
	break;
	
	case "/attorney/neurology/neurology-step-2.php";
	echo "Neuro Step-2 Registration Form";
	break;
	
	case "/attorney/medical-records-request/medical-records-request-step-2.php";
	echo "Medical Records Request Step-2 Registration Form";
	break;
	
	case "/attorney/profile.php";
	echo "Profile";
	break;
	
	
}
if(isset($_REQUEST['fid']) && isset($_REQUEST['cid']) && isset($_REQUEST['uid']))
	{
		if($title == "/attorney/full-details.php?fid=".$_REQUEST['fid']."&uid=".$_REQUEST['uid']."&cid=".$_REQUEST['cid'])
		{
			echo $fulldetailsurl = "[ ".$caseName." ] Full Details of Client ".$pName;	
		}
		elseif($title == "/attorney/check-status.php?fid=".$_REQUEST['fid']."&uid=".$_REQUEST['uid']."&cid=".$_REQUEST['cid'])
		{
			echo $checkstatusurl = "[ ".$caseName." ] Status Details of Client ".$pName;
		}
		elseif($title == "/attorney/upload-documents.php?fid=".$_REQUEST['fid']."&uid=".$_REQUEST['uid']."&cid=".$_REQUEST['cid'])
		{
			echo $uploadDocurl = "[ ".$caseName." ] Upload Documents of Client ".$pName;
		}
	}
	elseif(isset($_REQUEST['page']))
	{
		$title == "/attorney/?page=".$_REQUEST['page'];
		echo $pageurl ="Cases List Page ".$_REQUEST['page'];
	}
	elseif(isset($_REQUEST['action']))
	{
		echo "Edit Profile";
	}
	elseif(isset($_REQUEST['msid']))
	{
		$title == "/attorney/messages.php?msid=".$_REQUEST['msid']."&fid=".$_REQUEST['fid']."&uid=".$_REQUEST['uid'];
		echo "Message ( ".$pName." ) ";
	}
?>
</title>
	<link rel="stylesheet" href="<?php echo $sitepath; ?>/attorney/style.css" type="text/css"/>
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
				
				<h1><a href="<?php echo $sitepath; ?>/attorney/profile.php">Profile</a> &nbsp; </h1>
			</div>
		</div>
	</div>
</header>
