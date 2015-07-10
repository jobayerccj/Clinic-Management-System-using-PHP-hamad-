<?php
require_once('../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);

include '../functions.php';

include 'class.php';

if(loggedin())
{
	include('header.php');
?><script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
<script type="text/javascript">
	 function update(id)
	 {
		 
		 $.ajax({
			 
				type:"POST",
				url:"activate-user.php",
				data:"id="+id,
			 });
			 alert("User Activated Successfully");
		 
	 }
</script>
<section class="row">
	<div class="form_section_content">
		<h1 class="welcome_heading">Welcome to Mayo Surgical</h1>
		<h2 class="welcome_start">Admin Panel</h2>
	</div>
	<div class="container">
		<div class="form_section_content">
			<h1 class="add_user">Pending Actions</h1>
			<div class="view_log_details">
				<div class="log_heading">
					<div class="log_heading">
						<div class="serial_no_12">S.No.</div>
						<div class="user_name_12">User Name</div>
						<div class="first_name_12">Name</div>
						<div class="last_name_12">Email</div>
						<div class="status_12">Application Status</div>
						<div class="action_12">Action</div>
					</div>
				</div>
				<?php 
					$query =mysql_query("SELECT * FROM `members` where `activated`=0") or die(mysql_error());
					$ij=1;
					while ($row = mysql_fetch_array($query)) 
					{
				?>
					<div class="log_row row<?php echo $row['id']; ?>">
						<div class="serial_no_12"><?php  echo $ij; ?></div>
						<div class="user_name_12"><?php  echo $row['user_name'];?>
						<input type="hidden" name="user_id" id="user_id" value="<?php echo $row['id']; ?>"></div>
						<div class="first_name_12"><?php  $fname = $row['first_name']; echo ucwords($fname);?>&nbsp;<?php  $lname = $row['last_name']; echo ucwords($lname);?></div>
						<div class="last_name_12"><?php echo $row['email_id'];?></div>
						<div class="status_12">
							<?php 
									$activat = $row['activated']; 
									if($activat == 1)
									{
										echo "Verified";
									}
									else
									{
										echo "Not Verified";
									}
								?>
								</div>
						<div class="action_12">
							<div class="verified">
								<a href="" onclick="update(<?php echo $row['id']; ?>)"><img src="images/verify.jpg" alt="Verify"></a>
							</div>	
						</div>
					</div>
					<?php 
						$ij++;
					}
					?>
			</div>
		</div>
	</div>
</section>
<?php 
}
else 
{ 
header('Location:../login.php');
}
?>
<script src="http://<?php echo $jqueryminjs; ?>"></script>
<script src="http://<?php echo $validateminjs; ?>"></script>
</div>
	</div>
</section>
<?php

require($get_footer);
?>
