<?php
session_start();
require_once('../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);

include '../functions.php';

include 'class.php';

if(loggedin())
{
	include('header.php');
	
	$username = $_SESSION['username'];
	
	//$data  = $_COOKIE['username'];
	
	$userinfo = $username;
?>
<!-- For validations -->
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>
<script>
	setTimeout(function(){ $('.messages').fadeOut('slow'); }, 5000);
$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
    $("#changepassword").validate({
    
        // Specify the validation rules
        rules: {
           old_password: {
                required: true,
                noSpace:true
            },
           new_password:{
				required: true,
				minlength: 5,
				noSpace:true
				},
		   confirm_password:{
			   equalTo:"#newpassw"
			   }
				
        },
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            old_password:{
				required: "Please Enter Your Old Password",
				noSpace: "Spaces are not allowed"
			},
            new_password:{
				required: "Please enter New Password",
				noSpace: "Spaces are not allowed"
			},
            confirm_password:"Password don not Match"
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<h1 class="add_user">Reset Password</h1>
			<form name="changep" method="post" id="changepassword" action="">
				<ul>
					<li>
						<div class="fieldgroup">
						<label>Old Password</label>
						<input type="password" name="old_password" id="password"/>
						</div>
					</li>	

					<li>
						<label>New Password</label>
						<input type="password" name="new_password" id="newpassw"/>
					</li>
					<li>
						<label>Confirmed Password</label>
						<input type="password" name="confirm_password" id=""/>
					</li>
					<li>
						<input type="submit" name="changepassword" id="" value="Submit"/>
					</li>					
				</ul>
			</form>
			<?php
			
				if(isset($_POST['changepassword']))
				{
					
					$oldpassword = mysql_real_escape_string($_POST['old_password']);
					
					$newpassword = mysql_real_escape_string($_POST['new_password']);
					
					$npassword   = md5($newpassword);

					$opassword   = md5($oldpassword);
					
					$confirmpassword = mysql_real_escape_string($_POST['confirm_password']);
					
					$sql = mysql_query("SELECT `id` FROM `members` where `user_name`='$userinfo' && `password`='$opassword'")or die(mysql_error());
					
					if(mysql_num_rows($sql)>=1)
					{
						$updateP = mysql_query("UPDATE `members` SET `password` = '$npassword' WHERE `user_name`='$userinfo'") or die(mysql_error());
						
						if($updateP)
						{
							echo "<div class='thank_message'>Password Updated Successfully.</div>";
						}
						else
						{
							echo "<div class='thank_message'>Some thing went wrong.</div>";
						}
					}
					else
					{
						
						echo "<div class='thank_message'>Old Password is not Matched.</div>";
						
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
