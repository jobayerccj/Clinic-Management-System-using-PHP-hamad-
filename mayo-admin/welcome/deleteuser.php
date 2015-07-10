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
<link rel="stylesheet" href="admin-style.css" type="text/css">

	<section class="row">
	<div class="container">
		<div class="login_section_content">
			<h1 class="add_user">Delete User</h1>
			<form name="form1" method="post" action="">
				<ul>
					<li>
						<label>User Name</label>
						<input type="text" name="user_name" id="" required/>
					</li>	
					<li>
						<label>Email Address</label>
						<input type="text" name="email_id" id="" required/>
					</li>
					<li>
						<input type="submit" name="deleteuser" id="" value="Submit"/>
					</li>					
				</ul>
			</form>
			
			<?php
			
			$user_name = mysql_real_escape_string($_POST['user_name']);
			
			$user_email = mysql_real_escape_string($_POST['email_id']);
			
			$seprator = "|";
			
			if(isset($_POST['deleteuser']))
			{
			
				$delete = new users();
				
				$delete->deleteUser("members","user_name='$user_name' && email_id='$user_email'");
				
				if($delete)
				{
					
					echo "Record Successfully Deleted";
					
					$data = "Deleted" .$seprator." ".$user_name.",".$user_email;
		
					$log = new File_log();
	
					$log-> Write("../../test.txt",$data);
					
				}
				else
				{
					
					echo "Record does not Exit";
					
				}
				
				
			}
			?>
			
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
