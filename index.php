<?php
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($get_header);
?>
<!-- For validations -->
<script src="http://<?php echo $jqueryminjs; ?>"></script>

<script src="http://<?php echo $validateminjs; ?>"></script>

<!-- validation end --> 

<!-- jQuery Form Validation code -->
<script>
	setTimeout(function(){ $('.messages').fadeOut('slow'); }, 5000);
$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
    $("#contact-form").validate({
    
        // Specify the validation rules
        rules: {
            fname:{
				required: true,
				minlength: 3,
				alpha: true
				},
			lname:{
				required:true,
				minlength: 3,
				alpha: true
				},
			email_address:{
					required:true,
					email:true
				},
			phoneno:{
				required:true,
				minlength:10,
				maxlength:10,
				digits:true
				}
				
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            fname:{
				required: "Please Enter your Name",
				alpha: "Only Characters are allowed"
			},
            lname:{
				required: "Please enter your Last Name",
				alpha: "Only Characters are allowed"
			},
            email_address:{
				required:"Please enter your Email Address",
				email:"Please enter correct Email Address"
			},
			phoneno:{
				required:"Please enter Phone Number",
				number:"Please Enter Correct Phone Number"
				}
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<section class="row slider_bg">
	<img src="images/slider-1.jpg" alt="image"/>
</section>
<section class="row">
	<div class="container services_box">
		<ul>
			<li>
				<div class="services_box_1">
					<h1>Attorney's Partners</h1>
					<!--<span class="services_icon_1"><h3>icon</h3></span>-->
					<p>Mayo has a large nationwide network of physicians and facilities ready to care for your...</p>
					<a href="services.php#attorney" target="_blank" class="services_read_more">read more</a>
				</div>
			</li>
			<li>
				<div class="services_box_2">
					<h1>Medical Providers</h1>
					<!--<span class="services_icon_2"><h3>icon</h3></span>-->
					<p>The oath you have taken to help those who need medical care means a great deal to you. This...</p>
					<a href="services.php#medical" target="_blank" class="services_read_more">read more</a>
				</div>
			</li>
			<li>
				<div class="services_box_3">
					<h1>Medical Financing</h1>
					<!--<span class="services_icon_3"><h3>icon</h3></span>-->
					<p>Mayo Surgical makes it easy for you to approve our claims. We are experienced in this area...</p>
					<a href="services.php#funders" target="_blank" class="services_read_more">read more</a>
				</div>
			</li>
		</ul>
	</div>
</section>
<section class="row">
	<div class="container">
		<div class="inner_pac">
			<h1>Give your clients the freedom to get the surgery they need</h1>
			<img src="images/images58746598.jpg" alt="image"/>
			<!--<h2>Mauris in erat justo. Nullam ac urna</h2>-->
			<p style="text-align: justify;">
				<strong>Mayo Surgical™</strong> facilitates the purchase of your lien-based medical care for physicians, Ambulatory Surgery Centers (“ASC’s”), hospitals and other types of medical providers prior to the care being rendered. Mayo Surgical provides a full range of services to support and initiate a Third Party Liability Program. These Programs can be customized to meet each healthcare provider's needs and requirements, to include all necessary underwriting, risk assessment, and on-going support. Mayo Surgical's Programs are easy to initiate, have no upfront fees and produce immediate bottom-line results. Our proprietary software allows you to track your claims and keeps you up to date with the status of your patients.
			</p><!--<a href="#" class="read_more">read more</a>-->
		</div>	
	</div>
</section>
<section class="row">
	<div class="container">
		<div class="section_center">
			<div class="video_bg">
				<h1>Learn more about Mayo Surgical</h1>
				<video id="video1" width="701" poster="video/poster.jpg" preload="none" height="493" style="border:1px solid #000;" controls="controls">
					<source src="video/mayo.mp4" onclick="playPause()" type="video/mp4">
				</video>
				<script> 
                var myVideo=document.getElementById("video1"); 
                var att=document.createAttribute("poster");
                if (myVideo.error) {
                     switch (myVideo.error.code) {
                       case MEDIA_ERR_NETWORK:alert("Network error - please try again later.");break;
                       case MEDIA_ERR_DECODE:alert("Video is broken.."); break;
                       case MEDIA_ERR_SRC_NOT_SUPPORTED:alert("Sorry, your browser can't play this video."); break;
                     }
                }
                else
                {
                    function playPause()
                    { 
                        if (myVideo.paused) 
                        {
                          myVideo.play();
                          att.value="";
                          myVideo.setAttributeNode(att);
                        }
                        else myVideo.pause();
                    }
                }                       
                </script>
			</div>
			
		</div>	
		<aside class="quote_form">
			<span class="image_icon">H1</span>
			<h1>HOW TO GET MORE INFORMATION</h1>
			<form name="form1" id="contact-form" method="post" action="">
				<input type="text" name="fname" id="" placeholder="First Name"/>
				<span class="error"></span>
				<input type="text" name="lname" id="" placeholder="Last Name"/>
				<span class="error"></span>
				<input type="email" name="email_address" id="" placeholder="Email Address"/>
				<span class="error"></span>
				<input type="text" name="phoneno" id="" placeholder="Phone Number"/>
				<span class="error"></span>
				<textarea placeholder="Additional Information" name="message"></textarea>
				<input type="submit" name="sendmail" id="" value="Submit"/>
			</form>
			<?php
			
				if(isset($_POST['sendmail']))
				{
					$fname = $_POST['fname'];
					$lname = $_POST['lname'];
					$email = $_POST['email_address'];
					$phoneno = $_POST['phoneno'];
					$message1 = $_POST['message'];
					$to = 'info@mayosurgical.com';
					$subject = 'Mayo Surgical';
					$message = '<html><body>';
					$message .= '<img src="http://mayosurgical.com/images/logo.png" alt="Contact Email" />';
					$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
					$message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>".$fname."</td></tr>";
					$message .= "<tr style='background: #eee;'><td><strong>Last Name:</strong> </td><td>".$lname."</td></tr>";
					$message .= "<tr><td><strong>Email Address:</strong> </td><td>".$email."</td></tr>";
					$message .= "<tr><td><strong>Phone No:</strong> </td><td>".$phoneno."</td></tr>";
					$message .= "<tr><td><strong>Message:</strong> </td><td>".$message1."</td></tr>";
					$message .= "</table>";
					$message .= "</body></html>";
					$headers = "From: info@mayosurgical.com";
					$headers .= "CC: nordiff.com\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					$mail = mail($to,$subject,$message,$headers);
					if($mail)
					{
						
						echo "<div class='messages'>Message Sent Successfully</div>";
						
					}
					else
					{
						
						echo "<div class='messages'>Error</div>";
							
					}
					
					
				}
			
			?>
		</aside>
	</div>
</section>
<?php
require($get_footer);
?>
