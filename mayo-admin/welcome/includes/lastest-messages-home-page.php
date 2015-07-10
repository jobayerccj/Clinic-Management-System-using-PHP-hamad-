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
<h1>Latest Message</h1>
	<div class="dr_message_sides">
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
							$cide = $getdata->GetInfoPlantiffInformation('case_type',$message->form_id);
							$caseClosed = $getdata->GetObjectFromPCTI('case_closed',$message->form_id);
							$admin_approved = $getdata->GetObjectFromPCTI('admin_approved',$message->form_id);
							if($caseClosed==0 && $admin_approved==1)
							{
								switch($cide)
									{
										case "1":
										echo "<a href='/mayo-admin/welcome/ortho-case/index.php?cid=1&fid=".$message->form_id."&uid=".$message->user_id."#messages'><b>".ucwords($getdata->GetInfoPlantiffInformation('plantiff_name',$message->form_id))."</b></a>";
										break;
										
										case "2":
										echo "<a href='/mayo-admin/welcome/mesh-case/index.php?cid=2&fid=".$message->form_id."&uid=".$message->user_id."#messages'><b>".ucwords($getdata->GetInfoPlantiffInformation('plantiff_name',$message->form_id))."</b></a>";
										break;
										
										case "3":
										echo "<a href='/mayo-admin/welcome/pain-management-case/index.php?cid=3&fid=".$message->form_id."&uid=".$message->user_id."#messages'><b>".ucwords($getdata->GetInfoPlantiffInformation('plantiff_name',$message->form_id))."</b></a>";
										break;
										
										case "4":
										echo "<a href='/mayo-admin/welcome/general-surgery-case/index.php?cid=4&fid=".$message->form_id."&uid=".$message->user_id."#messages'><b>".ucwords($getdata->GetInfoPlantiffInformation('plantiff_name',$message->form_id))."</b></a>";
										break;
										
										case "5":
										echo "<a href='/mayo-admin/welcome/neurology-case/index.php?cid=5&fid=".$message->form_id."&uid=".$message->user_id."#messages'><b>".ucwords($getdata->GetInfoPlantiffInformation('plantiff_name',$message->form_id))."</b></a>";
										break;
										
										default:
										echo "<a href='/mayo-admin/welcome/medical-release/index.php?cid=6&fid=".$message->form_id."&uid=".$message->user_id."#messages'><b>".ucwords($getdata->GetInfoPlantiffInformation('plantiff_name',$message->form_id))."</b></a>";
										break;
										
									}
								echo '<br/>';
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
							echo $messages = substr($tempmessages,0,300);
						?><br/>
						<?php
							
							if(strlen($tempmessages)>200)
							{
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
							}
						}
						elseif($caseClosed==1 && $admin_approved==1)
						{
								
								echo "<a href='/mayo-admin/welcome/closed-cases/index.php?cid=".$cide."&fid=".$message->form_id."&uid=".$message->user_id."#messages'><b>".ucwords($getdata->GetInfoPlantiffInformation('plantiff_name',$message->form_id))."</b></a>";

								echo '<br/>';
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
							echo $messages = substr($tempmessages,0,300);
						?><br/>
						<?php
							
							if(strlen($tempmessages)>200)
							{

									echo "<a href='/mayo-admin/welcome/closed-cases/index.php?cid=".$cide."&fid=".$message->form_id."&uid=".$message->user_id."'>Read More</a>";
									
									
							}
						}
						else
						{

						echo "<a href='/mayo-admin/welcome/new-cases/index.php?cid=".$cide."&fid=".$message->form_id."&uid=".$message->user_id."#messages'><b>".ucwords($getdata->GetInfoPlantiffInformation('plantiff_name',$message->form_id))."</b></a>";

								echo '<br/>';
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
							echo $messages = substr($tempmessages,0,300);
						?><br/>
						<?php
							
							if(strlen($tempmessages)>200)
							{

									echo "<a href='/mayo-admin/welcome/new-cases/index.php?cid=".$cide."&fid=".$message->form_id."&uid=".$message->user_id."'>Read More</a>";
									
									
							}

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
