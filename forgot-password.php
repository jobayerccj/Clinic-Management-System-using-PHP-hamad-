<?php 

session_start();

$_SESSION['username']= $username;

$path = $_SERVER['DOCUMENT_ROOT']."/path.php";

require_once($path);

require_once($config);

require($get_header);

?>

<script src="https://<?php echo $jqueryminjs; ?>"></script>

<script src="https://<?php echo $validateminjs; ?>"></script>

<script>
	setTimeout(function(){ $('.messages').fadeOut('slow'); }, 5000);
$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
    $("#regform").validate({
    
        // Specify the validation rules
        rules: {
            email_id: {
				required:true,
				email: true
				},
	
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            email_id: {
				required: "Please enter your Email ID",
				email: "Please Enter Valid Email ID"
			}
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<?php			
function getRandomString($length) 
{
	$validCharacters = "1080nordiff00123456vikas09084abcdefghijklmnopqrstuvwxyz";
	
	$validCharNumber = strlen($validCharacters);
	
	$result = "";

	for ($i = 0; $i < $length; $i++) 
	{
		$index = mt_rand(0, $validCharNumber - 1);
		
		$result .= $validCharacters[$index];
	}
	
	return $result;
}
$token=getRandomString(50);

if(isset($_POST['forget-password']))
{
	
	$email_id = mysql_real_escape_string($_POST['email_id']);
	
	$checkemail = mysql_query("SELECT * FROM `members` where `email_id`='$email_id'") or die(mysql_error());
	$getInfo = mysql_fetch_object($checkemail);
	
	$success = mysql_num_rows( $checkemail );
	
	if ($success >= 1)
	{
			
			$to = $email_id;
			
			$authormail = "info@mayo.com";
										
			$activation = mysql_query("UPDATE `members` set `activation_code`='$token',`p_c_datetime`=now() where `email_id`='$email_id'") or die(mysql_error());
			
			$headers = "From: Mayo " . $authormail . "\r\n";
			
			$headers .= "MIME-Version: 1.0\r\n";
			
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
			$subject = "Password Change Link";
			
			$link = $_SERVER['HTTP_HOST'];
			
			$message = '<html><body>';
			
			$message.= '<table rules="all" style="border-color: #666;" cellpadding="10">';
			
			$message.= '<tr><td><img src="https://mayosurgical.com/images/logo.png" alt="Password Change Request"/></td></tr>';
			
			$message.= '<tr><td>Dear '.ucwords($getInfo->first_name).'&nbsp;'.ucwords($getInfo->last_name).',</td></tr>';
			
			$message.= '<tr><td>If you requested this password change, please click on the following link to reset your password:</td></tr>';
			
			$message.= '<tr><td>Link will expired after 30 minutes.</td></tr>';
			
			$message .='<tr><td>'.$sitepath.'/forget-password.php?activation_code='.$token.'</td></tr>';
			
			$message .='<tr><td>If clicking the link does not work, please copy and paste the URL into your browser instead.</tr></td>';
			
			$message .='<tr><td>If you did not make this request, you can ignore this message and your password will remain the same. </tr></td>';
			$message .='<tr><td>Thank you,</tr></td>';
			
			$message .='<tr><td>Mayo Surgical.</tr></td>';
			
			$message .= "</table>";
			
			$message .= "</body></html>";
			
			$mail=mail($to,$subject,$message,$headers);
			
			if($mail)
			{
				
				$smessage = "Mail Successfully Send.";
				
			}
			else
			{
				
				$smessage = "Error";
				
			}

	}
	else
	{
		
		$smessage = "Email does not Exist";
		
	}								
	
}
?>
<section class="row">
	<div class="container">
		<div class="login_section_content">
			<div class="login_left">
				<img src="../images/login_image.jpg" alt="image"/>
				<h1>Welcome to Mayo Surgical !</h1>
				
			</div>
			<div class="login_right">
				<div class="login_right_inner">
					<h1>Forgot Password</h1>
					<form  action="" method="post" name="forgot-password" id="regform">
						<input placeholder="Email" type="text" name="email_id"/>
						<span class="error"></span>
						<?php
							if(isset($smessage))
							{
								echo "<span class='login_error'>".$smessage."</span>";
							}
						?>
						<input type="submit" name="forget-password" value="Reset Password"/>
					<form>
				</div>	
			</div>

		</div>
	</div>
</section>
<?php
require($get_footer);
?>
