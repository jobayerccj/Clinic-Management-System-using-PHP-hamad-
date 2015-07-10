<div class="menu_bg">
<ul>
	<li><a href="<?php echo $sitepath; ?>/medical-facility/index.php">Home</a></li>
	<li>
		<a href="<?php echo $sitepath; ?>/medical-facility/add-staff.php">Add Staff</a>
		<ul>
			<li><a href="<?php echo $sitepath; ?>/medical-facility/client-list.php">View Staff</a></li>
		</ul>
	</li>
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
