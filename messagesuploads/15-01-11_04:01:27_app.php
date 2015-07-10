<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0">
	<title>:: Home Page :</title>

	<link rel="stylesheet" href="style.css" type="text/css"/>
	<link rel="stylesheet" href="css/media.css" type="text/css"/>
    <link href="css/application.css" rel="stylesheet" type="text/css" />
</head>
<script type="text/javascript" src="http://www.mayosurgical.com/rao/jquery-validations/jquery.validate.min.js"></script>
<script type="text/javascript" src="http://www.mayosurgical.com/rao/jquery-validations/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		
    	$("#um_uim_y").click(function()
		{
			$("#um_uim_l").show('slow');
		});
		$("#um_uim_n").click(function()
		{
			$("#um_uim_l").hide('slow');
		});
		$("#bankrupty_y").click(function()
		{
			$("#bankrupty_w").show('slow');
		});
		$("#bankrupty_n").click(function()
		{
			$("#bankrupty_w").hide('slow');
		});
		

		$("#report_y").click(function()
		{
			$("#attach_copy").show('slow');
		});
		$("#report_n").click(function()
		{
			$("#attach_copy").hide('slow');
		});
		
		$("#injured_y").click(function()
		{
			$("#claim").show('slow');
		});
		$("#injured_n").click(function()
		{
			$("#claim").hide('slow');
		});
		
		
		$("#witness_y").click(function()
		{
			$("#witness_name").show('slow');
		});
		$("#witness_n").click(function()
		{
			$("#witness_name").hide('slow');
		});
		
		$("#surgury_y").click(function()
		{
			$("#surgery1").show('slow');
		});
		$("#surgury_n").click(function()
		{
			$("#surgery1").hide('slow');
		});
		
		$("#diagnostic_y").click(function()
		{
			$("#diagnostic_tests").show('slow');
		});
		$("#diagnostic_n").click(function()
		{
			$("#diagnostic_tests").hide('slow');
		});
		
		$("#health_insurance_y").click(function()
		{
			$("#health_insurance").show('slow');
		});
		$("#health_insurance_n").click(function()
		{
			$("#health_insurance").hide('slow');
		});
		
		$("#expenses_y").click(function()
		{
			$("#insurance_amount").show('slow');
		});
		$("#expenses_n").click(function()
		{
			$("#insurance_amount").hide('slow');
		});
		
		$("#trial_date_y").click(function()
		{
			$("#date_trial").show('slow');
			$("#projected_date").hide('slow');
		});
		$("#trial_date_n").click(function()
		{
			$("#projected_date").show('slow');
			$("#date_trial").hide('slow');
		});
		
		$("#suit_y").click(function()
		{
			$("#suit_y_y").show('slow');
		});
		$("#suit_n").click(function()
		{
			$("#suit_y_y").hide('slow');
			
		});
	});
</script>
<script>
$(document).ready(function(){
	jQuery.validator.addMethod("noSpace", function(value, element)
    	{ return value.indexOf(" ") < 0; }, "No space in Password");
    	$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z ]*$/);
 });
    $("#plantiff_form").validate({
    
        // Specify the validation rules
        rules: {
            p_plantiff_name: {
				required:true
				}
        },
        
        // Specify the validation error messages
        errorElement: "span",
        messages: {
            p_plantiff_name: {
				required: "Please enter username"
			}
          
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
</script>
<body>
<header class="row">
	<div class="container">
		<div class="logo">
			<h1><a href="#">logo</a></h1>
		</div>
		<div class="social_right">
			<div class="social_feeds">
				<ul>
					<li class="social_facebook"><a href="#">F</a></li>
					<li class="social_twitter"><a href="#">t</a></li>
					<li class="social_linkedin"><a href="#">l</a></li>
				<ul>
			</div>
			<div class="toll_free">
				<h1>1-866-411-2525</h1>
			</div>
		</div>
	</div>
	<div class="primary_nav">
		<div class="container">
			<div class="primary_nav_left">
				<span class="nav_icon_left"></span>
				<div class="menu_bg">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Services</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Terms</a></li>
						<li><a href="#">Contact Us</a></li>
					</ul>
				</div>
				<span class="nav_icon_right"></span>
			</div>
			<div class="login_button">
				<span class="login_icon"></span>
				<h1><a href="#">Login</a></h1>
			</div>
		</div>
	</div>	
</header>
<section class="row">
	<div class="container">
		<div class="form_section_content">
			<div id="main_div">
<h2>APPLICATION</h2>
<h3>PLAINTIFF'S INFORMATION</h3>

<div id="application_form">
	<div class="row-fluid">
<form id="plantiff_form" name="plaintiff-form" method="post" action="">
		<div class="gen_app_div">
			<div class="span2">Plaintiff Name:</div>
			<div class="span4">
				<input name="p_plantiff_name" type="text" class="txt_field">
				<span class="error"></span>
			</div>
			<div class="span2">Date Completed:</div>
			<div class="span4">
				<input id="datepicker" name="p_date_completed" type="date" class="txt_field">
				<span class="error"></span>
			</div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Address:</div>
			<div class="span10"><input name="p_plantiff_address" type="text" class="txt_field"></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Work Phone:</div>
			<div class="span4"><input name="p_work_phone" type="text" class="txt_field"></div>
			<div class="span2">Date of Birth:</div>
			<div class="span4"><input name="p_date_of_birth" type="date" class="txt_field"></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Home Phone:</div>
			<div class="span4"><input name="p_home_phone" type="text" class="txt_field"></div>
			<div class="span2">Driver's License:</div>
			<div class="span4"><input name="p_driver_licence" type="text" class="txt_field"></div>
		</div>
		<div class="gen_app_div">
			<div class="span2">Mobile Phone:</div>
			<div class="span4"><input name="p_mobile_phone" type="text" class="txt_field"></div>
			<div class="span2">E-mail:</div>
			<div class="span4"><input name="p_email" type="text" class="txt_field"></div>
		</div>
		<div class="gen_app_div">
			<div class="span4">Auto Insurance Carrier (auto collisions only):</div>
			<div class="span8"><input name="p_insurance_carrier" type="text" class="txt_field"></div>
		</div>
		<div class="gen_app_div">
			<div class="span6 form_div_left">
			<p class="span3">UM/UIM</p>
			<p class="span2"><input id="um_uim_y" name="um_uim" type="radio" value="yes">Yes</p>
			<p class="span2"><input id="um_uim_n" name="um_uim" type="radio" value="no">No</p>
			<div id="um_uim_l" style="display:none;">
            <div class="span5">
            <p class="span3">Limits</p>
            <p class="span9"><input name="" type="text" class="txt_field"></p>
            </div>
            </div>
		</div>
		<div class="span6">
			<p class="span3">PIP/Med Pay?</p>
			<p class="span3"><input id="pipr" name="pip" type="radio" value="yes">Yes</p>
			<p class="span3"><input id="pipn" name="pip" type="radio" value="no">No</p>
			<div id="limitr" style="display:none;"><p class="span3">Limits <input name="limitpip" type="text" class="txt_field"></p></div>
		</div>
</div>
<div class="gen_app_div">
<div class="span3">Client ever claim bankruptcy?</div>
<div class="span1"><input id="bankrupty_y" name="bankrupty" type="radio" value="">Yes</div>
<div class="span1"><input id="bankrupty_n" name="bankrupty" type="radio" value="">No</div>
<div class="span7">
<div id="bankrupty_w" style="display:none;"><p class="span2">When:</p><p class="span10"><input name="bankrupty_when" type="text" class="txt_field"></p></div>
</div>
</div>
</div>
</div>
<h3>PLAINTIFF'S ATTORNEY'S INFORMATION</h3>
<div id="application_form">
<div class="row-fluid">
<div class="gen_app_div">
<div class="span2">Firm:</div>
<div class="span10"><input name="" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span2">Address:</div>
<div class="span10"><input name="" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span2">Phone: ( )</div>
<div class="span4"><input name="" type="text" class="txt_field"></div>
<div class="span2">Fax: ( )</div>
<div class="span4"><input name="" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span6">
<div class="span4">Firm Contact Person:</div>
<div class="span8"><input name="" type="text" class="txt_field"></div>
</div>
<div class="span6">
<div class="span4">Position:</div>
<div class="span4"><input name="" type="radio" value="">Attorney</div>
<div class="span4"><input name="" type="radio" value="">Non-attornev</div>
</div>
</div>
<div class="gen_app_div">
<div class="span2">Contact E-mail</div>
<div class="span10"><input name="" type="text" class="txt_field"></div>
</div>
</div>
</div>
<h3>DEFENDANT'S INFORMAATION (lnsurance information is needed whether or not in suit)</h3>
<div id="application_form">
<div class="row-fluid">
<div class="gen_app_div">
<div class="span2"><strong>Defendant Name (1):</strong></div>
<div class="span10"><input name="" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span3">Insurance Company (1):</div>
<div class="span2"><input name="" type="text" class="txt_field"></div>
<div class="span2">Claim No.:</div>
<div class="span2"><input name="" type="text" class="txt_field"></div>
<div class="span1">Limits:</div>
<div class="span2"><input name="" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span2"><strong>Defendant Name (2):</strong></div>
<div class="span10"><input name="" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span3">Insurance Company (1):</div>
<div class="span2"><input name="" type="text" class="txt_field"></div>
<div class="span2">Claim No.:</div>
<div class="span2"><input name="" type="text" class="txt_field"></div>
<div class="span1">Limits:</div>
<div class="span2"><input name="" type="text" class="txt_field"></div>
</div>
</div>
</div>
<h3>INCIDENT INFORMATION</h3>
<div id="application_form">
<div class="row-fluid">
<div class="gen_app_div">
<div class="span2">Date of Injury:</div>
<div class="span4"><input name="" type="text" class="txt_field"></div>
<div class="span2">Location of the Event:</div>
<div class="span4"><input name="" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span3">Description of the Event:</div>
<div class="span9"><input name="" type="text" class="txt_field"></div>
<div class="row-fluid"><input name="" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span3">Description of injuries :</div>
<div class="span9"><input name="" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span3">Was there a police report?</div>
<div class="span1"><input id="report_y" name="report_y" type="radio" value="yes">Yes</div>
<div class="span1"><input id="report_n" name="report_y" type="radio" value="no">No</div>
<div class="span7" id="attach_copy" style="display:none;">
	<input name="police_report" type="file">(if so, please attach a copy)</div>
</div>

<div class="gen_app_div">
<div class="span3">Others injured too?</div>
<div class="span1"><input id="injured_y" name="injured" type="radio" value="injuredy">Yes</div>
<div class="span1"><input id="injured_n" name="injured" type="radio" value="injuredn">No</div>
<div id="claim" style="display:none;"><div class="span7">
<p class="span9">lf yes, what's the value of his/her/their claim(s)?</p>
<p class="span3"><input name="" type="text" class="txt_field"></p></div></div>
</div>
<div class="gen_app_div">
<div class="span3">Witness(es)?</div>
<div class="span1"><input id="witness_y" name="witness" type="radio" value="">Yes</div>
<div class="span1"><input id="witness_n" name="witness" type="radio" value="">No</div>
<div id="witness_name" style="display:none;">
	<div class="span5">
	<p class="span4">Name(s):</p>
	<p class="span8"><input name="witnes_name" type="text" class="txt_field"></p>
</div>
</div>
</div>
</div>
</div>
<h3>MEDICAL TREATMENT &amp; BILLS TO DATE</h3>
<div id="application_form">
<div class="row-fluid">
<div class="gen_app_div">
<div class="span1">Date<br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"></div>
<div class="span2">Provider<br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"></div>
<div class="span2">Treatment<br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"></div>
<div class="span1">Cost<br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"></div>
<div class="span2">Amount Paid<br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"></div>
<div class="span2">By Whom?<br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"></div>
<div class="span2">Balance<br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"><br>
<input name="" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
<div class="span5 total_txt">Total</div>
<div class="span1"><input name="" type="text" class="txt_field"></div>
<div class="span2"><input name="" type="text" class="txt_field"></div>
<div class="span2"><input name="" type="text" class="txt_field"></div>
<div class="span2"><input name="" type="text" class="txt_field"></div>
</div>
<div class="gen_app_div">
		<p class="span2">Surgery(ies)?</p>
		<p class="span1"><input id="surgury_y" name="surgury" type="radio" value="">Yes</p>
		<p class="span1"><input id="surgury_n" name="surgury" type="radio" value="">No</p>
		<div id="surgery1" style="display:none;">
		<p class="span2">If Yes, Date(s):</p>
		<p class="span3"><input name="" type="text" class="txt_field"></p>
		<p class="span1">Type(s):</p>
		<p class="span2"><input name="" type="text" class="txt_field"></p>
		</div>
</div>
<div class="gen_app_div">
<p class="span2">Diagnostic Tests?</p>
<p class="span1"><input id="diagnostic_y" name="diagnostic" type="radio" value="yes">Yes</p>
<p class="span1"><input id="diagnostic_n" name="diagnostic" type="radio" value="no">No</p>
<div id="diagnostic_tests" style="display:none;"><p class="span2">Type of test:</p>
<p class="span2"><input name="" type="text" class="txt_field"></p>
<p class="span1">Result:</p>
<p class="span3"><input name="" type="text" class="txt_field"></p>
</div>
</div>
<div class="gen_app_div">
<p class="row-fluid">Prior collisions, incidents, injuries or pre-existing conditions, if any, regardless of whether resulted
in claimllawsuit:</p>
<p class="row-fluid"><input name="" type="text" class="txt_field"></p>
</div>
<div class="gen_app_div">
<p class="row-fluid">Subsequent collisions, incidents, or injuries, if any, regardiess of whether resulted claim/lawsuit:</p>
<p class="row-fluid"><input name="" type="text" class="txt_field"></p>
</div>
	<div class="gen_app_div">
		<p class="span4">Client have health insurance?</p>
		<p class="span1"><input id="health_insurance_y" name="health_insurance" type="radio" value="">Yes</p>
		<p class="span1 form_div_left"><input id="health_insurance_n" name="health_insurance" type="radio" value="">No</p>
		<div id="health_insurance" style="display:none">
			<p class="span4">If so, has it paid any of the expenses?</p>
			<p class="span1"><input id="expenses_y" name="expenses" type="radio" value="yes">Yes</p>
			<p class="span1"><input id="expenses_n" name="expenses" type="radio" value="no">No</p>
		</div>
	</div>
	<div id="insurance_amount" style="display:none;">
		<div class="gen_app_div">
			<div class="span7 form_div_left">
				List all current liens against the case (Medicare, Worker's Comp,
				Soc Sec, Settlement Advance Companies, VA, TriCare, etc.)?
			</div>
			<div class="span5">
				<p class="span4">Amount?</p>
				<p class="span8">
					<input name="" type="text" class="txt_field">
				</p>
			</div>
		</div>
	</div>
</div>
</div>	
<h3>STATUS OF CLAIM</h3>
<div id="application_form">
	<div class="row-fluid">
		<div class="gen_app_div">
			<p class="span2">ls case in suit?</p>
			<p class="span2"><input id="suit_y" name="suit" type="radio" value="">Yes</p>
			<p class="span2"><input id="suit_n" name="suit" type="radio" value="">No</p>
			
			<p class="span6">If Yes, please provide the following information:</p>
		</div>
		<div id="suit_y_y">
		<div class="gen_app_div">
			<p class="span4">Title of Action (if commenced):</p>
			<p class="span8"><input name="" type="text" class="txt_field"></p>
		</div>
		<div class="gen_app_div">
			<p class="span4">Index/Cause Number:</p>
			<p class="span8"><input name="" type="text" class="txt_field"></p>
		</div>
		<div class="gen_app_div">
			<p class="span1">Venue:</p>
			<p class="span2"><input name="" type="text" class="txt_field"></p>
			<p class="span1">State</p>
			<p class="span2"><input name="" type="text" class="txt_field"></p>
			<p class="span1">Supreme</p>
			<p class="span2"><input name="" type="text" class="txt_field"></p>
			<p class="span1">Federal</p>
			<p class="span2"><input name="" type="text" class="txt_field"></p>
		</div>
	
		<div class="gen_app_div">
			<p class="span2">Trial Date:</p>
			<p class="span1"><input id="trial_date_y" name="trial_date" type="radio" value="">Yes</p>
			<div style="display:none;" id="date_trial">
				<div class="span4">
					<p class="span4">Date:</p>
					<p class="span8"><input name="" type="text" class="txt_field"></p>
				</div>
			</div>
			<p class="span2"><input id="trial_date_n" name="trial_date" type="radio" value="">No</p>
			<div id="projected_date" style="display:none">
				<p class="span2">Projected Date</p>
				<p class="span2"><input name="" type="text" class="txt_field"></p>
			</div>
		</div>
		</div>
	</div>
</div>
	<div id="application_form">
		<div class="row-fluid">
			<div class="gen_app_div">
				<h3>PLEASE ALSO PROVIDE THE FOLLOWING, IF AVAILABLE:</h3>
				<strong>Main documents needed to moye the case to underwriting</strong><br>
				1. ACCIDENT ROPORTS<br>
				Z. ALL MEDICAL RECORDS<br>
				3. ALL MEDICAL BILLS<br><br>
				PLEASE FAX COMPLETED APPLICATION To: <strong>1-800-865-8691</strong><br>
				OR EMAIL TO: <a href="mailto:INFO@MAYOSURGICAL.COM">INFO@MAYOSURGICAL.COM</a>
				<div class="app_btn_area"><input type="submit" value="Submit" name="register" class="app_btn"></div>
			</div>
		</div>
	</div>
	</form>
</div>
</section>
<footer class="row">
	<div class="footer_upper">
		<div class="container">
			<div class="footer_span">
				<h1>Address</h1>
				<p>Mayo Surgical, LLC<br>
				600 Chastain Road, Suite 200<br>
				Kennesaw, GA 30144<br>
				Phone: 1-866-411-2525<br>
				Fax: 1-866-865-8691</p>
			</div>
			<div class="footer_span">
				<h1>Quieck Links</h1>
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Services</a></li>
				</ul>
			</div>
			<div class="footer_span">
				<h1>Legal</h1>
				<ul>
					<li><a href="#">FAQ</a></li>
					<li><a href="#">Terms</a></li>
					<li><a href="#">Contact us</a></li>
				</ul>
			</div>
			<div class="footer_social">
				<h1>Follow us</h1>
				<ul>
					<li class="social_facebook"><a href="#">Facebook</a></li>
					<li class="social_twitter"><a href="#">Twitter</a></li>
					<li class="social_linkedin"><a href="#">Linkedin</a></li>
				<ul>
			</div>
		</div>
	</div>
	<div class="footer_lower">
		<div class="container">
			<p>&copy; copyright 20104</p>
			<span class="scroll_top">
				<a href="#">Top</a>
			</span>
		</div>
	</div>
</footer>
</body>
</html>	
