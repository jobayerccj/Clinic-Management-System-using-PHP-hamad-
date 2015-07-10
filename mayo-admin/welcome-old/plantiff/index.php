<?php
session_start();

require_once('../../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include($config);
include_once '../../functions.php';
include_once '../class.php';
include_once '../classes/plantiff.php';
if(loggedin())
{
	include('../header.php');
?>
<link rel="stylesheet" href="../admin-style.css" type="text/css">
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<h1 class="add_user">Plantiff's Registration Form</h1>
			<div class="view_log_details">
				<div class="log_heading">
					<div class="serial_no">S.No.</div>
					<div class="user_name">User Name</div>
					<div class="first_name">First Name</div>
					<div class="last_name">Last Name</div>
					<div class="email_address">Email Address</div>
					<div class="organisation">Organisation</div>
					<div class="department">Action</div>
				</div>
			</div>
		</div>
			<?php
				/*Call to plantiff Information Class file*/
				$plantiff_information = new PlantiffInfo();
				$plantiff_data = $plantiff_information->PlantiffInfoShow();
			?>
		</div>
	</div>
</section>

</div>
	</div>
</section>
<?php
include($get_footer);
}
else
{
header('Location:../../login.php');
}
?>
