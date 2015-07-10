<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
require_once($config);
$functionsfile = $pathofmayo."/classes/functions.php";
include($functionsfile);
include('classes/meshed.php');
$temp_profile = new meshed();
if(@$_REQUEST['attorneys_id']!="")
{
	@$attorneys_id = $_REQUEST['attorneys_id'];
}
else
{
	$attorneys_id;
}
?>
<div class="dr_message_side_bg">
	<h1>Latest Message</h1>
	<?php
		$temp_message = mysql_query("SELECT * FROM `message_sent` WHERE find_in_set('$attorneys_id',main_user_id) order by message_id desc limit 0,6") or die(mysql_error());
		if(mysql_num_rows($temp_message)>0)
		{
		while($message= mysql_fetch_object($temp_message))
			{
			$getall_id  = $message->main_user_id;
			$getalldeta = explode(",",$getall_id);
		
	?>
			<div class="dr_message_side_row">
				<div class="dr_message_side_left">
					<label>
						<?php 
							echo '<b>'.ucwords($temp_profile->GetInfoPlantiffInformation('plantiff_name',$message->form_id)).'</b><br/>';
							$a_mess = $message->date_message;
							echo date('m-d-Y',strtotime($a_mess))."&nbsp";
							echo date('h:m:s a',strtotime($a_mess));
						?>
					</label>
				</div>
				<div class="dr_message_side_right">
					<label>
						<?php 
							$tempmessages  = $message->message;
							echo $messages = substr($tempmessages,0,90);
						?><br/>
						<a href="messages.php?msid=<?=$message->message_id?>&fid=<?=$message->form_id?>&uid=<?=$message->user_id?>">Read More</a>
					</label>
				</div>
			</div>
	<?php
			
		}
		}
		else
			{
				echo '<div class="dr_message_side_row">There is no Message for You.</div>';
			}
		
	?>
</div>	
