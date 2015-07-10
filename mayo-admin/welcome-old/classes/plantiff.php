<?php
class PlantiffInfo
{
	public function PlantiffInfoShow()
	{
		$plantiff_info = mysql_query("SELECT members.`id`,`user_name`,`first_name`,`last_name`,`designation`,`organisation`,
		`email_id` from `members` RIGHT OUTER JOIN `plantiff_status_information` on members.`id` = `plantiff_status_information`.id")
		or die(mysql_error());
		$i = 1;
		while($get_info = mysql_fetch_array($plantiff_info))
		{	
 ?>		
		<div class="log_row">
			<div class="serial_no"><?php echo $i; ?></div>
			<div class="user_name"><?php echo $get_info['user_name'];?></div>
			<div class="first_name"><?php echo $get_info['first_name'];?></div>
			<div class="last_name"><?php echo $get_info['last_name'];?></div>
			<div class="email_address"><?php echo $get_info['email_id'];?></div>
			<div class="organisation"><?php echo $get_info['organisation'];?></div>
			<div class="department"><a href="verify.php?id=<?php echo $get_info['id'];?>">View</a></div>
		</div>
<?php
		$i++;

		}
	}
	public function AcceptPlantiff()
	{
		$accept = mysql_query("INSERT INTO `plantiff_status_information` (`admin_approved`) VALUES(1)") or die(mysql_error());
		
	}
	public function DeleteForm()
	{
		$deleteform = mysql_query("DELETE FROM `plantiff_status_information` where `id`='$get_info[id]'") or die(mysql_error());
		echo "Form Deleted Successfully";
	}
	
}
?>
