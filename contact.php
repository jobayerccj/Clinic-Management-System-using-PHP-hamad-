<?php
include('header.php');
?>

<div class="page">

<section class="row">
	<div class="container">
		<div class="form_section_content about_bg">
			<h1>Contact Us</h1>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>
<!-- validation end --> 

<!-- jQuery Form Validation code -->
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
            user_name: {
				required:true,
				},
            user_email: {
                required: true,
                email: true
            }
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            user_name: {
				required: "Please Enter Your Name"
			},
            fname:{
				required: "Please Enter your Email Address",
				email: "Please Enter the Valid Email Id"
			}
		},
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<script>
	$(function() 
	{
		setTimeout(function() 
		{ 
			$(".thank_messages").fadeOut(5000); }, 5000)
			$('#signUp').click(function() {
			setTimeout(function() { $(".thank_messages").fadeOut(5000); }, 5000)
		})
	})
</script>
<?php
	if(isset($_POST['sendmessage']))
	{
		$user_name = $_POST['user_name'];
		$email_id = $_POST['user_email'];
		$message1 = $_POST['message'];
		$to = 'info@mayosurgical.com';
		$subject = 'Mayo Surgical';
		$message = '<html><body>';
		$message .= '<img src="http://mayosurgical.com/images/logo.png" alt="Contact Email" />';
		$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
		$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>".$user_name."</td></tr>";
		$message .= "<tr><td><strong>Email Address:</strong> </td><td>".$email_id."</td></tr>";
		$message .= "<tr><td><strong>Message:</strong> </td><td>".$message1."</td></tr>";
		$message .= "</table>";
		$message .= "</body></html>";
		$headers = "From: mayosurgical.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$mail = mail($to,$subject,$message,$headers);
		if($mail)
		{
			
			echo "<div class='thank_messages'>Thanks for Contact. We will Contact you Soon.</div>";
			
		}
		else
		{
			
			echo "<div class='thank_messages'>Error</div>";
				
		}
		
		
	}

?>
<form name="contact-us" method="post" action="" id="regform" novalidate="novalidate">
	<ul>
		<li>
			<span class="form_label">	
				<label>Name</label>
			</span>
			<span class="form_input">
				<input type="text" name="user_name" placeholder="Name">
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">	
				<label>Email</label>
			</span>
			<span class="form_input">
				<input type="email" name="user_email" id="email_id" placeholder="Email">
				<span class="error"></span>
			</span>
		</li>
		
		<li>
			<span class="form_label">	
				<label>Message</label>
			</span>
			<span class="form_input">
				<textarea name="message" style="margin: 0px; height: 153px; width: 431px;" cols="4" rows="4" type="text" id="message" placeholder="Message"></textarea>
				<span class="error"></span>
			</span>
		</li>

		<li>	
			<input type="submit" name="sendmessage" value="send">
		</li>
		
		</ul>
	
</form>

</div>
	</div>
</section>

</div>


<?php
require($get_footer);
?>
