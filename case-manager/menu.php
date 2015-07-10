<div class="menu_bg">
	<ul>
		<li>
			<a href="#">Add a New Case</a>
			<ul>
				<li><a href="<?php echo $sitepath; ?>/case-manager/meshed-form">Mesh Case</a></li>
				<li><a href="<?php echo $sitepath; ?>/case-manager/ortho-form">Ortho Form</a></li>
				<li><a href="<?php echo $sitepath; ?>/case-manager/pain-management">Pain Management Case</a></li>
				<li><a href="<?php echo $sitepath; ?>/case-manager/general-surgery-case">General Surgery Case</a></li>
				<li><a href="<?php echo $sitepath; ?>/case-manager/neurology">Spine/Neuro Form</a></li>
				<li><a href="<?php echo $sitepath; ?>/case-manager/medical-records-request">Medical Records Request</a></li>
			</ul>
		</li>
		<li>
			<a href="<?php echo $sitepath; ?>/case-manager/#">Cases</a>
			<ul>
				<li>
					<a href="<?php echo $sitepath; ?>/case-manager/cases.php">View Cases</a>
				</li>
				<li>
					<a href="<?php echo $sitepath; ?>/case-manager/all-cases.php">Pending Cases</a>
				</li>
			</ul>
		</li>
		<!--<li>
			<a href="<?php //echo $sitepath; ?>/attorney/other-documents.php">Upload Documents</a>
		</li>-->
		<li>
			<a href="<?php echo $sitepath; ?>/case-manager/#">Add Staff</a>
			<ul>
				<li>
					<a href="<?php echo $sitepath; ?>/case-manager/add-new-client.php">Register New Staff</a>
				</li>
				<li>
					<a href="<?php echo $sitepath; ?>/case-manager/clients-list.php">View Staff</a>
				</li>
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
