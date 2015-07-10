<?php
session_start();

require_once('../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include($config);

include '../functions.php';

include 'class.php';

if(loggedin())
{
	include('header.php');
?>
<section class="row">
	<div class="container dashboard_bg">
		<div class="slide_left">
			<h1>Case History</h1>
			<div class="slide_top_bar">
				<div class="side_row">
					<div class="slide_row_left">
						<label>Client Name</label>
					</div>
					<div class="slide_row_right">
						<label>John William</label>
					</div>
				</div>
				<div class="side_row">
					<div class="slide_row_left">
						<label>Email Address</label>
					</div>
					<div class="slide_row_right">
						<label>william_john@gmail.com</label>
					</div>
				</div>
				<div class="side_row">
					<div class="slide_row_left">
						<label>Contact No.</label>
					</div>
					<div class="slide_row_right">
						<label>21354879</label>
					</div>
				</div>
				<div class="side_row">
					<div class="slide_row_left">
						<label>Starting Date</label>
					</div>
					<div class="slide_row_right">
						<label>21-Sep-2014</label>
					</div>
				</div>
				<div class="side_row">
					<div class="slide_row_left">
						<label>Address</label>
					</div>
					<div class="slide_row_right">
						<label>William</label>
					</div>
				</div>
			</div>
		</div>
		<div class="slide_right" style="float:right;">
			<h1>Doctors List</h1>
			<div class="attorney_box_bg">
				<div class="attorney_row_heading">
					<div class="attorney_monitor_1">Name</div>
					<div class="attorney_monitor_2">Contact No</div>
					<div class="attorney_monitor_3">State</div>
					<div class="attorney_monitor_4">City</div>
					<div class="attorney_monitor_5">Address</div>
					<div class="attorney_monitor_5">Contact No</div>
				</div>
				<?php
					$sql = mysql_query("SELECT * FROM `members` WHERE `designation`='7'") or die(mysql_error());
					while($row = mysql_fetch_object($sql))
					{
				?>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">
						<?php 
							$fname =  $row->first_name; $lname = $row->last_name; 
							echo ucwords($fname)."&nbsp";
							echo ucwords($lname);
					?></div>
					<div class="attorney_monitor_2"><?php $row->state; ?></div>
					<div class="attorney_monitor_3"><?php $row->city;?></div>
					<div class="attorney_monitor_4">
						<span class="approve_status">View</span>
					</div>
					
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<div id="light" class="white_content">
	<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'" class="close_icon">Close</a>
	<h1>Send Request</h1>
	<div class="popup_row">
		<input type="text" name="" id="" placeholder="Request Send To"/>
	</div>
	<div class="popup_row">
		<textarea placeholder="Enter Message"></textarea>
	</div>
	<div class="popup_row">
		<textarea placeholder="Enter Message"></textarea>
	</div>
	<div class="popup_row">
		<textarea placeholder="Enter Message"></textarea>
	</div>
	<div class="popup_row">
		<input type="submit" name="" id="" value="Submit"/>
	</div>
</div>
<div id="fade" class="black_overlay"></div>
<?php
require($get_footer);
}
else
{
	header("location:../../index.php");
}
?>
