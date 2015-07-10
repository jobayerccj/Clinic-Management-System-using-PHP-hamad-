<?php 
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
$path      = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
require_once($config);
include('header.php');

include('../classes/login-functions.php');
if(loggedin()) 
{
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
<link rel="stylesheet" href="<?php echo $sitepath; ?>/tabs/example.css" TYPE="text/css" MEDIA="screen">
<script type="text/javascript">
document.write('<style type="text/css">.tabber{display:none;}<\/style>');

var tabberOptions = {

  'manualStartup':true,

  'onLoad': function(argsObj) {
    /* Display an alert only after tab2 */
    if (argsObj.tabber.id == 'tab2') {
      alert('Finished loading tab2!');
    }
  },

  'onClick': function(argsObj) {

    var t = argsObj.tabber; /* Tabber object */
    var id = t.id; /* ID of the main tabber DIV */
    var i = argsObj.index; /* Which tab was clicked (0 is the first tab) */
    var e = argsObj.event; /* Event object */

    if (id == 'tab2') {
      return confirm('Swtich to '+t.tabs[i].headingText+'?\nEvent type: '+e.type);
    }
  },

  'addLinkId': true

};

</script>
<script type="text/javascript" src="<?php echo $sitepath; ?>/tabs/tabber.js"></script>
<section class="row">
	<div class="container dashboard_bg">
		<div class="dr_upload_doc_slide">
			<div class="dr_message_side_bg">
			<div class="dr_message_side">
				<script>
						 $(document).ready(function() 
						 {
							 $(".view").load("latestmessages.php?attorneys_id=<?php echo $attorneys_id; ?>");
						   var refreshId = setInterval(function() {
							  $(".view").load('latestmessages.php?attorneys_id=<?php echo $attorneys_id; ?>');
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
 <h1>Add Staff</h1></div>
				<div class="attorney_row">
					<form name="register-sub-group" id="sub_registration" method="post" action="">
					<div class="attorney_row_form">
						<label>First Name</label>
						<input type="text" name="first_name" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Last Name</label>
						<input type="text" name="last_name" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Choose Username</label>
						<input type="text" name="user_name" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Password</label>
						<input type="password" name="password" id="uppassword"/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Confirm Password</label>
						<input type="password" name="choose_password" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Email Address</label>
						<input type="text" name="email_address" id=""/>
						<span class="error"></span>
					</div>		
					<div class="attorney_row_form">
						<label>Phone No.</label>
						<input type="text" name="phone_no" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Address</label>
						<input type="text" name="address" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>City</label>
						<input type="text" name="city" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>State</label>
						<?php $temp_profile->GetStates(); ?>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Zip Code</label>
						<input type="text" name="zip_code" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Organisation</label>
						<input type="text" name="organisation" id=""/>
						<span class="error"></span>
					</div>
					<div class="attorney_row_form">
						<label>Sub Group</label>
						<?php 
							$designationid = $temp_profile->GetObjectById($attorneys_id,"designation");
							$temp_profile->Subgroup($designationid); 
						?>
						<span class="error"></span>
					</div>	
					<span class="form_input">
						<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="1" checked /></div>
						<div class="chk_txt"><label>Receive All Emails</label></div>
					</span>
					<span class="form_input">
						<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="2"/></div>
						<div class="chk_txt"><label>Receive Scheduling Emails</label></div>
					</span>
					<span class="form_input">
						<div class="chk_btn"><input name="all_emails" id="terms" type="radio" value="3"/></div>
						<div class="chk_txt"><label>Receive Billing Emails</label></div>
					</span>
					<div class="attorney_row_form">
						<input type="submit" name="addsubworker" id=""/>
					</div>
					</form>	
					<?php
						if(isset($_POST['addsubworker']))
						{
							$first_name    = mysql_real_escape_string($_POST['first_name']);
							$last_name	   = mysql_real_escape_string($_POST['last_name']);
							$user_name	   = mysql_real_escape_string($_POST['user_name']);
							$password	   = mysql_real_escape_string($_POST['password']);
							$encpassword   = md5($password);
							$email_address = mysql_real_escape_string($_POST['email_address']);
							$phone_no	   = mysql_real_escape_string($_POST['phone_no']);
							$address	   = mysql_real_escape_string($_POST['address']);
							$city		   = mysql_real_escape_string($_POST['city']);
							$state		   = mysql_real_escape_string($_POST['state']);
							$zip_code	   = mysql_real_escape_string($_POST['zip_code']);
							$subgroup	   = mysql_real_escape_string($_POST['subgroup']);
							$organisation  = mysql_real_escape_string($_POST['organisation']);
							$all_emails	   = mysql_real_escape_string($_POST['all_emails']);
							
							$id            = $temp_profile->GetObjectByUsername("id",$panel);
							$nameofatt     = $temp_profile->GetObjectByUsername("first_name",$panel);
							$lastnameofatt = $temp_profile->GetObjectByUsername("last_name",$panel);
							$att_id        = $temp_profile->GetObjectByUsername("email_id",$panel);
							
							$date          = date('m/d/Y h:i:s a', time());
							
							$to            = $email_address;
							$subject       = "Hi ".ucwords($first_name)." ".ucwords($last_name).". Your Account has been created by ".ucwords($nameofatt)." ".ucwords($lastnameofatt)." on ".$date."";
							$message       = "Your Login Information. Please keep it safe";
							$extravalues   = array("Name"=> $first_name , "Username"=> $user_name ,"Password" => $password);
							
							$subjectattor  = "Hi ".ucwords($nameofatt)." ".ucwords($lastnameofatt).". This Account ".ucwords($first_name)." ".ucwords($last_name)." has been created from your account on ".$date."";
							$messageatt    = "Your Sub Worker Login Information";
							$temp_profile->SendEmail($to,$subject,$message,$extravalues);
							$temp_profile->SendEmail($att_id,$subjectattor,$messageatt,$extravalues);
							$checkusername = mysql_query("SELECT `id` FROM `members` where `user_name`='$user_name' || `email_id`='$email_address'") or die(mysql_error());
							if(mysql_num_rows($checkusername)>=1)
							{
								echo "<div class='thank_message'>Username/Email Already Exists.</div>";
							}
							else
							{
								$insert     = mysql_query("INSERT INTO `members` (`user_name`,`password`,`first_name`,`last_name`,`state`,`city`,`address`,`zip_code`,`contact_number`,`designation`,`sub_designation`,`organisation`,`email_id`,`email_permissions`,`user_type`,`user_ip`,`date_time`)	VALUES ('$user_name','$encpassword','$first_name','$last_name','$state','$city','$address','$zip_code','$phone_no','$designationid','$subgroup','$organisation','$email_address','$all_emails','2','".$_SERVER['REMOTE_ADDR']."',now())") or die(mysql_error());
								
								$sub_worker_id = $temp_profile->GetObjectByUsername("id",$user_name);
								
								$insert2    = mysql_query("INSERT INTO `sub_members` (`user_id`,`main_user_id`) VALUES ('$sub_worker_id','$id')") or die(mysql_error());
								
								if($insert2)
								{
									echo  "<div class='thank_message'>Thank you for Registering with Mayo Surgical, your information has been sent for approval and you will receive an email when your account is active.</div>";
								}
							
							}
						}

					?>				
				</div>	
			</div>
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
