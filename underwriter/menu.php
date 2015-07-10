<div class="menu_bg">
	<div class="menu_bg">
	<ul>
		<li><a href="<?php echo $sitepath; ?>/underwriter/">Home</a></li>
		<li><a href="#">Add Staff</a>
			<ul>
				<li><a href="<?php echo $sitepath; ?>/underwriter/add-staff.php">Add Staff</a></li>
				<li><a href="<?php echo $sitepath; ?>/underwriter/client-list.php">View Staff</a></li>
			</ul>
		</li>
		<li><li><a href="<?php echo $sitepath; ?>/underwriter/invoices.php">Invoices<span class="menu_counter"><?php $countBUnder = mysql_query("select a.*,b.*,c.* from `u_fwd_final_billing` as a, `plantiff_information` as b,`plantiff_case_type_info` as c where underwriter_id='$doctor_id' and a.fid=b.form_id and b.form_id=c.form_id and a.fid=c.form_id and c.case_closed=0 and flag_accept=0 group by a.fid") or die(mysql_error());
echo mysql_num_rows($countBUnder);		?></span></a></li></li>
		<li>
				<a href="<?php echo $sitepath;?>/underwriter/billing.php">Funding Requests<span class="menu_counter">
				&nbsp;&nbsp;<?php
					$temp_newcases  = mysql_query("SELECT COUNT( * ) AS total_records FROM `bill_forward_underwriter` WHERE `underwriter_id`='$doctor_id' and not (`underwriter_message` = 1 || `underwriter_message` = 3)") or die(mysql_error());
					$newcases       = mysql_fetch_object($temp_newcases);
					echo $newcasesrecord = $newcases->total_records;
			    ?></a>
			 </span>
		</li>
		<!--<li><a href="<?php //echo $sitepath; ?>/underwriter/upload-reports.php">Upload Reports</a></li>-->
	</ul>
</div>
</div>
