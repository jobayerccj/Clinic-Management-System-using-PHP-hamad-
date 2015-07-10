<?php
	ob_start();
	ini_set('display_errors',1);  
	error_reporting(E_ALL);
	$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
	require_once($path);
	require_once($config);
	$functions  = $pathofmayo."/classes/functions.php";
	include($functions);
	$meshedfile = $pathofmayo."/attorney/classes/meshed.php";
	require_once($meshedfile);
	$getdata    = new Meshed();
?>

Latest Message
	<div class="dr_message_side">
	<?php
		$temp_message = mysql_query("SELECT * FROM `message_sent` order by message_id desc limit 0,100") or die(mysql_error());
		if(mysql_num_rows($temp_message)>0)
		{
		while($message= mysql_fetch_object($temp_message))
			{	
	?>
			<div class="dr_message_side_row">
				<div class="dr_message_side_left">
					<label>
						<?php 
							
							echo '<b>'.ucwords($getdata->GetInfoPlantiffInformation('plantiff_name',$message->form_id)).'</b><br/>';
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
						<?php
							$cide = $getdata->GetInfoPlantiffInformation('case_type',$message->form_id);
							switch($cide)
							{
								case "1":
								echo "<a href='/mayo-admin/welcome/ortho-case/index.php?cid=1&fid=".$message->form_id."&uid=".$message->user_id."'>Read More</a>";
								break;
								
								case "2":
								echo "<a href='/mayo-admin/welcome/mesh-case/index.php?cid=2&fid=".$message->form_id."&uid=".$message->user_id."'>Read More</a>";
								break;
								
								case "3":
								echo "<a href='/mayo-admin/welcome/pain-management-case/index.php?cid=3&fid=".$message->form_id."&uid=".$message->user_id."'>Read More</a>";
								break;
								
								case "4":
								echo "<a href='/mayo-admin/welcome/general-surgery-case/index.php?cid=4&fid=".$message->form_id."&uid=".$message->user_id."'>Read More</a>";
								break;
								
								case "5":
								echo "<a href='/mayo-admin/welcome/neurology-case/index.php?cid=5&fid=".$message->form_id."&uid=".$message->user_id."'>Read More</a>";
								break;
								
								default:
								echo "<a href='/mayo-admin/welcome/medical-release/index.php?cid=6&fid=".$message->form_id."&uid=".$message->user_id."'>Read More</a>";
								break;
								
							}
						?>
					</label>
				</div>
			</div>
	<?php
			}
		}
		else
			{
				echo "There is no Message for You.";
			}
		
	?>		
</div>
