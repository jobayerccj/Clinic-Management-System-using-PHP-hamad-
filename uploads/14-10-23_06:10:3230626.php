<?php 
session_start();
$_SESSION['username']=$username;
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
require_once($config);
include 'functions.php'; //includes the functions.php - very important
if(loggedin()) 
{
$_SESSION['username']=$username;
header ('Location:welcome');
exit();
}
if (isset($_POST['login'])) //check if the submit button is pressed
{
//get data
$username = mysql_real_escape_string($_POST['username']);
$password = md5($_POST['password']);
$remember = $_POST['remember'];
$login = mysql_query("SELECT `id` FROM `members` WHERE user_name='$username' && `password`='$password' && `activated`='2' && `designation`='admin'") or die(mysql_error());
$data = mysql_num_rows($login);
if($data>=1)
{
$loginok = TRUE;
} 
else 
{
	$message = "Incorrect Username/Password";
	
}
 
if ($loginok==TRUE) //if it is the same password, script will continue.
{
	if ($remember == "yes") //if the Remember me is checked, it will create a cookie.
	{
		$server=$_SERVER['HTTP_HOST'];
		$_SESSION['username']=$username;
		setcookie("username", $username, time()+7600, "/", "/mayo-admin"); //here we are setting a cookie named username, with the Username on the database that will last 48 hours and will be set on the understandesign.com domain. This is an optional parameter.
	 
		header("Location:welcome");
		exit();
	}
	else if ($remember=="") //if the Remember me isn't checked, it will create a session.
	{
		$_SESSION['username']=$username;
		setcookie("username", $username, time()+7600, "/", "/mayo-admin");
		header('Location:welcome');
	}
}
} 
/*************************************/
require($headerwtlogin);
?>
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>

<script>
$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
    $("#regform").validate({
    
        // Specify the validation rules
        rules: {
            uname: {
				required:true
				},
            upassword: {
                required: true
            }
	
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            uname: {
				required: "Please enter username",
			},
            password: {
                required: "Please Enter password"
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<section class="row">
	<div class="container">
		<div class="login_section_content">
			<div class="login_left">
				<img src="../images/login_image.jpg" alt="image"/>
				<h1>Welcome to Mayo Surgical !</h1>
				<p>Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit</p>
			</div>
			<div class="login_right">
				<div class="login_right_inner">
					<h1>Login to Mayo Surgical</h1>
<form  action="" method="post" name="form-login" id="regform">
	<input required placeholder="Username" type="text" name="username"/>
	<span class="error"></span>
	<input required placeholder="Password" type="password" name="password"/>
	<span class="error"></span>
	<label for="remember">Remember Me:</label>
	<input type="checkbox" name="remember" value="yes">
	<span class="messages"><div class="messages"><?php if(!empty($message)){echo $message;}?></div></span>
	<input type="submit" name="login" value="LOG IN"/>
<label class="forgot_password"><a href="#">Forgot Password</a></label>
</form>
				</div>	
			</div>
		</div>
	</div>
</section>
<?php
require($get_footer);
?>
