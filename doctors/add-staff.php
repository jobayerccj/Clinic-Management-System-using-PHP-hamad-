<?php 
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include('header.php');
require_once($config);
include('../classes/login-functions.php');
include('../allpanels/subusers.php');
if(loggedin()) 
{
/*Class file to call the functions*/
?>
<script src="https://<?php echo $jqueryminjs; ?>"></script>
<script src="https://<?php echo $validateminjs; ?>"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
		$("#sub_registration").validate({
			rules: {
				user_name: {required:true,minlength:5,noSpace: true},
				email_address: {required: true,email: true},
				password: {required: true,minlength: 5,noSpace: true},
				choose_password:{required:true,equalTo:"#uppassword"},
				first_name:{required: true,minlength: 3,alpha:true},
				phone_no:{required:true,minlength:10,maxlength:10,number:true},
				address:{required:true},
				city:{required:true},
				state:{required:true},
				zip_code:{required:true,number:true},
				last_name:{required:true,minlength: 3,alpha: true},
				subgroup:{required:true},
				organisation:{required:true}
				},
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            user_name: {required: "Please choose Username",noSpace: "Spaces are not allowed in Username"},
            phone_no:{required:"Please Enter Your Mobile Number",number:"Please Enter the correct Phone Number"},
            state:{required:"Please Select the State"},
            zip_code:{required:"Please Enter the Zip Code",number:"Please Enter the Correct Zip Code"},
            first_name:{required: "Please Enter your Name",alpha: "Only Characters are allowed"},
            last_name:{required: "Please enter your Last Name",alpha: "Only Characters are allowed"},
            subgroup:"Please Select the Sub Designation",
            choose_password:"Password doesn't Match",
            organisation:"Field is required",
            email_address:{required:"Please Enter the Email Address", email:"Please Enter a valid email address"},
            password: {required: "Please provide a password",minlength: "Your password must be at least 5 characters long",noSpace: "Spaces are not allowed in Password"}
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
	});
</script>
<section class="row">
	<div class="container dashboard_bg">
		<div class="dr_upload_doc_slide">
			<div class="dr_message_side_bg">
			<div class="dr_message_side">
				<script>
					 $(document).ready(function() 
					 {
						 $(".view").load("latestmessages.php?doctor_id=<?php echo $doctor_id; ?>");
					   var refreshId = setInterval(function() {
						  $(".view").load('latestmessages.php?doctor_id=<?php echo $doctor_id; ?>');
					   }, 5000);
					   $.ajaxSetup({ cache: false });
					});
				</script>
				<div class="view"></div>
			</div>
		</div>
		</div>
			
		
		<div class="slide_right">
			<div class="add_new_clients">
				<div class="back_btn_area">
					<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
				</div>  
				<?php $subusers->registerSubuser($doctor_id,$username); ?>
			</div>
		</div>
	</div>
</section>
<?php
require($get_footer);
}
else
{
	
header('Location:../../login.php');
	
}
?>
