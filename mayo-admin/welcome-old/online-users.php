<?php
ob_start();
require_once('../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);

include '../functions.php';

include 'class.php';

if(loggedin())
{
	include('header.php');
?>
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<?php 
			
				//exec("/usr/bin/vpnstatus", $output, $return);
				//var_dump($output);
				echo exec("/usr/bin/vpnstatus");	
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
header('Location:../login.php');
}
?>
