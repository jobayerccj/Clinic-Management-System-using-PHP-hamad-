<?php
ob_start();
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
include '../functions.php';
$classfile = $_SERVER['DOCUMENT_ROOT']."/classes/functions.php";
include($classfile);
include('header.php');

if(loggedin())
{
	$desg  = new Allfunctions();
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<section class="row">		
	<div class="container">
		<div class="form_section_content">
			<?php
			if(isset($_POST['add-role']))
			{
				$data      = array('name_email'=>$_POST['name_email'],'email_format'=>$_POST['email_format']);
				$tablename = "email_formats";
				$desg->INSERT($data,$tablename);
				if($desg)
				{
					echo "CPT Code Added Successfully";
				}
			}
			?>
		</div>
		<div class="form_section_content">
		<?php 
			if(isset($_REQUEST['eid']) && $_REQUEST['action'] == "edit")
			{
				$temp_getcpt = mysql_query("SELECT * FROM `email_formats` WHERE `id`='$_REQUEST[eid]'") or die(mysql_error());
				$getcpt      = mysql_fetch_object($temp_getcpt);
		?>
				<h1 class="add_user">Update Email Format</h1>
				<form name="updatecpt" method="post" action="" id="regform">
						<ul>
							<li>
								<span class="form_label">	
									<label>Name</label>
								</span>
								<span class="form_input">
									<input type="text" name="name_email" value="<?php echo $getcpt->name_email; ?>" required />
									<span class="error"></span>
								</span>
							</li>
						   <li>
							   <span class="form_label">
									<label>Email Format</label>
								</span>
								<span class="form_input">
									<textarea name="email_forma" rows="25" cols="80"><?php  echo $getcpt->email_format;?></textarea>
									<span class="error"></span>
								</span>
						   </li>
							<li>	
								<span class="form_label">&nbsp;</span>
								<input type="submit" name="update_cpt" value="Update Email" required />
							</li>
						</ul>
				</form>	
				<?php
					if(isset($_POST['update_cpt']))
					{
						$cpt = $_POST['name_email'];
						$desc = $_POST['email_forma'];
						
						$update_temp = mysql_query("UPDATE `email_formats` SET `name_email`='$cpt',`email_format`='$desc' WHERE `id`='$_REQUEST[eid]'") or die(mysql_error());
						if($update_temp)
						{
							echo "<div class='thank_message'>Email Updated Successfully</div>";
							header("refresh:2; url=insert-email.php");
						}
						else
						{
							echo "<div class='thank_message'>There is Error. Some thing going Wrong. Please try again Later</div>";
						}
						
					}
				?>
				<?php
					}
					else
					{
				?>
					<h1 class="add_user">Add Email Format</h1>
					<form name="userinfo" method="post" action="" id="regform">
						<ul>
							<li>
								<span class="form_label">	
									<label>Name</label>
								</span>
								<span class="form_input">
									<input type="text" name="name_email" required />
									<span class="error"></span>
								</span>
							</li>
						  
						   <li>
							   <span class="form_label">
									<label>Email Format</label>
								</span>
								<span class="form_input">
									<textarea name="email_format" rows="10" cols="50" required ></textarea>
									<span class="error"></span>
								</span>
						   </li>
							<span class="form_label">&nbsp;</span>
								<input type="submit" name="add-role" value="Add Email" required />
							</li>
							</ul>
						
					</form>	
			
			<div class="view_log_details">
				<div class="log_heading">
					<div class="name_1">Name</div>
					<div class="desc_1">Description</div>
					<div class="edit_1">Edit</div>
					<div class="delete_1">Delete</div>
				</div>
				<?php 
					$query =mysql_query("SELECT * FROM `email_formats`") or die(mysql_error());
					$ij=1;
					while ($row = mysql_fetch_array($query)) 
					{
				?>
					<div class="log_row">
						<div class="name_1"><?php  echo $row['name_email']; ?></div>
						<div class="desc_1"><?php  echo $row['email_format'];?></div>
						<div class="edit_1"><a href="insert-email.php?eid=<?php echo $row['id']; ?>&action=edit">Edit</a></div>
						<div class="delete_1">
							<a class="confirmation" href="delete-email.php?eid=<?php echo $row['id']; ?>&action=delete">Delete</a>
						</div>
					</div>
					<script type="text/javascript">
						$('.confirmation').on('click', function () {
							return confirm('Are you sure?');
						});
					</script>
				<?php 
					} 
				}
				?>
				<?php
					if(isset($_REQUEST['cptid']) && $_REQUEST['action']=="delete")
					{
						$delete = mysql_query("DELETE FROM `cpt_codes` WHERE `id`='$_REQUEST[cptid]'") or die(mysql_error());
						if($delete)
						{
							echo "Record Deleted Successfully";
							header("refresh:1;url=insert-cpt-code.php");
						}
						else
						{
							echo "There is error. Please try it later";
						}
					}
				?>
				
			</div>
</div>

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
</section>
<?php
require($get_footer);
?>
