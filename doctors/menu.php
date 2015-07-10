<div class="menu_bg">
	<ul>
		<li><a href="<?php echo $sitepath; ?>/doctors/index.php">Home</a></li>
			<li>
				<a href="#">Add Staff</a>
				<ul>
					<li><a href="<?php echo $sitepath; ?>/doctors/add-staff.php">Add Staff</a></li>
					<li><a href="<?php echo $sitepath; ?>/doctors/client-list.php">Staff List</a></li>
				</ul>
			</li>
		
		<li><a href="<?php echo $sitepath; ?>/doctors/appointments.php">Appointment</a></li>
		<!--<li><a href="<?php //echo $sitepath; ?>/doctors/schedulling.php">Email Admin</a></li>-->
		<li><a href="#">Forms</a>
			<ul>
				<?php
					$sql        = mysql_query("SELECT * FROM `site_forms` ORDER BY `id` DESC") or die(mysql_error());
					while($data = mysql_fetch_array($sql))
					{
				?>
					<li><a href="<?php echo $sitepath; ?>/forms/<?=$data['path_form'];?>" target='_blank'><?=$data['form_name'];?></a></li>
				<?php
					}
				?>
			</ul>
		</li>
	</ul>
</div>
