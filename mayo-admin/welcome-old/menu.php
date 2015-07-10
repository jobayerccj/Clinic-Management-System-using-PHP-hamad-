<div class="menu_bg">
<ul>
	<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/adduser.php">Manage Users</a>
		<ul>
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/adduser.php">Add User</a></li>
			<!--<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/modify-user.php">Modify User</a></li>-->
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/verify-users.php">Verify Users</a></li>
			<!--<li><a href="<?php //echo $sitepath; ?>/mayo-admin/welcome/online-users.php">Online Users</a></li>-->
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/add-subroles.php">Add Sub Roles</a></li>
		</ul>
	</li>
	<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/manage-professionals.php">Manage Professionals</a></li>
	<li>
		<a href="#">Cases</a>
		<ul>
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/new-cases">New Cases
			<span class="menu_counter">
			<?php
				if(basename($_SERVER['PHP_SELF'])!="view-logs.php")
				{
					$temp_newcases  = mysql_query("SELECT COUNT( * ) AS total_records, b.id FROM plantiff_case_type_info AS a, members AS b WHERE a.id = b.id AND a.admin_approved =0") or die(mysql_error());
					$newcases       = mysql_fetch_object($temp_newcases);
					echo $newcasesrecord = $newcases->total_records;
				}
			?>
			 </span>
			 </a></li>
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/mesh-case">Mesh Cases</a></li>
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/ortho-case">Ortho Case</a></li>
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/pain-management-case">Pain Management</a></li>
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/general-surgery-case">General Surgery</a></li>
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/neurology-case">Neurology</a></li>
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/medical-release">Medical Record Request</a></li>
			<!--<li><a href="<?php //echo $sitepath; ?>/mayo-admin/welcome/cases/case-history.php">Case History</a></li>-->
		</ul>
	</li>
	<li><a href="#">Admin Features</a>
		<ul>
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/view-logs.php">View Logs</a></li>
			<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/reset-password.php">Change Password</a></li>
		</ul>
	</li>
	<li>
		<a href="#">Other Features</a>
	<ul>
		<li><a href="<?php echo $sitepath;?>/mayo-admin/welcome/insert-cpt-code.php">Insert CPT Code</a></li>
		<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/insert-email.php">Insert Email Format</a></li>
		<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/add-billing.php">Add Billing System</a></li>
		<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/reports.php">Reports</a></li>
		<li><a href="<?php echo $sitepath; ?>/mayo-admin/welcome/forms.php">Forms</a></li>
	</ul>
</ul>
</div>
