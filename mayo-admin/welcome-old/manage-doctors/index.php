<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";

include($path);

require_once('../../../includes/functions.php');

include($config);

include '../../functions.php';

$header_admin = $_SERVER['DOCUMENT_ROOT']."/rao/mayo-admin/welcome/header.php";
require_once($header_admin);

if(loggedin())
{
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
		<div class="slide_right">
			<div class="attorney_box_bg">
				<h1>Meshed Case Type</h1>
				<div class="attorney_row_heading">
					<div class="attorney_monitor_1">Date</div>
					<div class="attorney_monitor_2">Applciation Stage</div>
					<div class="attorney_monitor_3">Discription</div>
					<div class="attorney_monitor_4">Status Type</div>
					<div class="attorney_monitor_5">Action</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="approve_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>	
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="pending_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="approve_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="pending_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="approve_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="pending_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="approve_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" 
						onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="pending_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="slide_right" style="float:right;">
			<h1>Ortho Cases</h1>
			<div class="attorney_box_bg">
				<div class="attorney_row_heading">
					<div class="attorney_monitor_1">Date</div>
					<div class="attorney_monitor_2">Applciation Stage</div>
					<div class="attorney_monitor_3">Discription</div>
					<div class="attorney_monitor_4">Status Type</div>
					<div class="attorney_monitor_5">Action</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="approve_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>	
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="pending_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="approve_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="pending_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="approve_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="pending_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="approve_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" 
						onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
				<div class="attorney_row_content">
					<div class="attorney_monitor_1">10-Sep-2014</div>
					<div class="attorney_monitor_2">Mayo Surgical</div>
					<div class="attorney_monitor_3">joham_william gmail com joham_william </div>
					<div class="attorney_monitor_4">
						<span class="pending_status">Approve</span>
					</div>
					<div class="attorney_monitor_5">
						<a href="javascript:void(0)" onclick="document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">
							<button class="message_button">view</button>
						</a>
					</div>
				</div>
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
