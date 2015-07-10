<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);  
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
if(loggedin()) 
{
/*Class file to call the functions*/
?>
<section class="row">
	<div class="container dashboard_bg">
		<?php
			$qry = "SELECT a. * , b. *  FROM plantiff_information AS a, plantiff_case_type_info AS b WHERE a.id = b.id && a.form_id = b.form_id AND 
			b.attorney_id ='$attorneys_id' && a.form_id='$_REQUEST[fid]' && b.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]'	&& b.id='$_REQUEST[uid]'";
			$sql       = mysql_query($qry) or die(mysql_error());
			$row       = mysql_fetch_array($sql);
			$case_type = $row['case_type'];
			if(($case_type == 1)||($case_type == 3)||($case_type == 5))
			{
				$temp_profile->orthoView($row);
			}
			elseif($case_type ==6 )
			{ 
				$temp_profile->medicalView($row);
			}
			else
			{
				$temp_profile->meshedView($row);
			}
			
			$temp_profile->documentMessages($attorneys_id);
			$temp_profile->uploadDocuments();
		?>	
	</div>
</section>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $sitepath; ?>/popup/featherlight.min.css" title="Featherlight Styles" />
<script src="<?php echo $sitepath; ?>/popup/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo $sitepath; ?>/popup/style.css">
<?php
		require($get_footer);
	}
	else
	{	
		header('Location:../../login.php');
	}
?>