<?php
	ini_set('display_errors',1);  
	error_reporting(E_ALL);
	
	if(!isset($_SESSION))
	{
		session_start();
	}
	
	$path       = $_SERVER['DOCUMENT_ROOT']."/path.php";
	require_once($path);
	
	include($config);
	
	$functions  = $pathofmayo."/classes/functions.php";
	include($functions);
	
	$meshedfile = $pathofmayo."/attorney/classes/meshed.php";
	require_once($meshedfile);
	
	$getdata    = new Meshed();
	
	echo $admin      = $_SESSION['username'];
	echo $admin_id   = $getdata->GetDetailsByUsername($admin,"id");
	
	$workComment= $_REQUEST['commentData'];
	$form_s_id  = $_REQUEST['fid'];
	$use_id     = $_REQUEST['uid'];
	$work_comments_area = $_REQUEST['notes'];
	
	$query      = mysql_query("INSERT INTO `work_comments` (`form_id`,`user_id`,`main_user_id`,`work_comments`,`work_comments_area`,`work_comments_date`) 
	VALUES ('$form_s_id','$use_id','$admin_id','$workComment','$work_comments_area',now())") or die(mysql_error());
	if($query)
	{
		echo "<div class='thank_message'>Work Flow is Successfully Updated</div>";
	}
	else
	{
		echo "<div class='thank_message'>There is some problem</div>";
	}
?>

<div class="update_status_botom">
	<div class="update_status_row_heading">
		<div class="update_status_span_1">Date</div>
		<div class="update_status_span_2">Update By</div>
		<div class="update_status_span_3">Status</div>
	</div>
	<?php
		$count=0;
		$temp_getstatus = mysql_query("SELECT * FROM `work_comments` where `form_id`='$_REQUEST[fid]' order by id desc") or die(mysql_error());
		if(mysql_num_rows($temp_getstatus)>0)
		{
			while($getstatus= mysql_fetch_object($temp_getstatus))
			{
	?>
			<div class="update_status_row">
				<div class="update_status_span_1">
					<?php 
						$tempdate = $getstatus->work_comments_date;
						echo $date_time = date("Y-M-d",strtotime($tempdate))."<br/>"; 
						echo $datetime = date("H:m:s a",strtotime($tempdate));
					?>
				</div>
				<div class="update_status_span_2">
					<?php 
						$a_id = $getstatus->main_user_id;
						$fname = $getdata->GetObjectById($a_id,"first_name");
						$lname = $getdata->GetObjectById($a_id,"last_name");
						echo ucwords($fname)."&nbsp;";
						echo ucwords($lname);
						//echo $temdes= $getinformation->GetObjectById($a_id,"designation");									
					?>
				</div>
				<div class="update_status_span_3">
					<?php 
						echo $getstatus->work_comments;
					?>						
				</div>
			</div>
	<?php	
			}
		}
		else
		{
	?>
			<div class="update_status_row">
				No Work Comments Till now.
			</div>
	<?php
		}
	?>
</div>