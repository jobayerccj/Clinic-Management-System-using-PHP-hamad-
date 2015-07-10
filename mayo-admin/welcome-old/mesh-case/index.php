<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../../includes/functions.php');
$path       = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
include '../../functions.php';
include '../classes/Cases.php';
$desg       = new Cases();
$functions  = $pathofmayo."/classes/functions.php";
include($functions);
$meshedfile = $pathofmayo."/attorney/classes/meshed.php";
require_once($meshedfile);
$getdata    = new Meshed();
?>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getUser(desgntnId) {		
		
		var strURL="../includes/find-user.php?desgntn="+desgntnId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('result').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
function getInfo(usersId) {		
		var strURL="../includes/getInfo.php?user_details="+usersId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('result2').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
function getValuesss(providerId) 
	{	
		var strURL="../includes/find-values.php?provider_id="+providerId;
		var req = getXMLHTTP();
		if (req) 
		{
			req.onreadystatechange = function() 
			{
				if (req.readyState == 4) 
				{
					// only if "OK"
					if (req.status == 200)
					{						
						document.getElementById('show_data').innerHTML=req.responseText;						
					} 
					else 
					{
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
	
	function getAllCpt(userId,cptId) 
	{	
		var strURL="../includes/find-department-cpt.php?userId="+userId+"&cptId="+cptId;
		var req = getXMLHTTP();
		if (req) 
		{
			req.onreadystatechange = function() 
			{
				if (req.readyState == 4) 
				{
					// only if "OK"
					if (req.status == 200)
					{						
						document.getElementById('final_area').innerHTML=req.responseText;						
					} 
					else 
					{
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}

	function getUnderwriterInfo(undrId) 
	{		
		var strURL="../includes/getInfo.php?user_details="+undrId;
		var req = getXMLHTTP();
			
		if (req) 
		{	
			req.onreadystatechange = function() 
			{
				if (req.readyState == 4) 
				{
					// only if "OK"
					if (req.status == 200) 
					{						
						document.getElementById('u_info').innerHTML=req.responseText;						
					} 
					else 
					{
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
				req.open("GET", strURL, true);
				req.send(null);
		}
				
	}
function getEmailsFormat(emailId) {		
		var strURL="../includes/getemailsformat.php?email_format="+emailId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('email_formats').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 

        <script type="text/javascript">
            $(document).ready(function(){
                function loading_show(){
                    $('#loading').html("<img src='../images/loading.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax
                    ({
                        type: "POST",
                        url: "meshed-pagin.php",
                        data: "page="+page,
                        success: function(msg)
                        {
                            $("#container").ajaxComplete(function(event, request, settings)
                            {
                                loading_hide();
                                $("#container").html(msg);
                            });
                        }
                    });
                }
                loadData(1);  // For first time page load default results
                $('#container .pagination li.active').live('click',function(){
                    var page = $(this).attr('p');
                    loadData(page);
                    
                });           
                $('#go_btn').live('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        loadData(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val("").focus();
                        return false;
                    }
                    
                });
            });
        </script>
<?php
if(loggedin())
{
	$header_admin = $pathofmayo."/mayo-admin/welcome/header.php";
	require_once($header_admin);
?>
<section class="row">
	<div class="container dashboard_bg">
		<?php if(isset($_REQUEST['fid']))
		{
		?>
		</div>
		<div class="container dashboard_bg">
		<div class="slide_left_pane">
			<script>
				 $(document).ready(function() 
				 {
					 $(".view").load("../includes/latest-messages.php");
				   var refreshId = setInterval(function() {
					  $(".view").load("../includes/latest-messages.php");
				   }, 30000);
				   $.ajaxSetup({ cache: false });
				});
			</script>
			<div class="view"></div>
		</div>
		<div class="slide_right_pane"><div class="dashboard_bg tabber" id="tab1">
		<div class="tabbertab">
		<?php
			$qry = "select a.*,b.*,d.* from plantiff_information a 
			inner join plantiff_case_type_info b on a.form_id=b.form_id and a.id=b.id
			inner join members d on a.id=d.id and b.id=d.id
			where b.admin_approved=1 and b.case_closed=0 && a.form_id='$_REQUEST[fid]' && b.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]' && b.id='$_REQUEST[uid]'";
			$sql = mysql_query($qry) or die(mysql_error());
			$row = mysql_fetch_array($sql);
		?>
			<h2><a name="tab1">Application</a></h2>
			<div class="view_application">
				<?php
					$getdata->meshedView($row);
				?>
			</div>
		</div>
			
		<div class="tabbertab">
			<?php
				$admin    = $_SESSION['username'];
				$admin_id = $getdata->GetDetailsByUsername($admin,"id");
				include('../includes/upload-documents.php');
			?>
		</div>
		
		<div class="tabbertab">
			<?php
				include('../includes/assign-proffessional.php');
			?>
		</div>
		
		<div class="tabbertab">
			<?php
				include('../includes/update-status.php');
			?>
		</div>
		
		
		
		<div class="tabbertab">
			<?php include('../includes/messages.php'); ?>
		</div>
		
		<div class="tabbertab">
			<h2>Billing</h2>
			<?php include('../includes/billing.php'); ?>
		</div>
		<div class="tabbertab">
			<h2>Forward Billing</h2>
			<?php include('../includes/forward-billing.php'); ?>
		</div>
		<div class="tabbertab">
			<h2>Final Billing</h2>
			<?php 
				//include('../includes/final-billing-document.php'); 
				//include('../includes/pdf-generator/final-billing.php'); 	
				include('../includes/tcpdf/examples/final-billing.php');
				
				$pdfdata = mysql_query("SELECT * FROM `final_billing` WHERE `user_id`='$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]'") or die(mysql_error());
				if(mysql_num_rows($pdfdata))
				{
					while($fbilling     = mysql_fetch_object($pdfdata))
					{
						$hire_di        = $fbilling->hire_id;	
						$designation	= $getdata->GetObjectById($hire_di,"designation");
						$designations   = $getdata->GetDesgBydesId($designation);
						$dfirst_name	= ucwords($getdata->GetObjectById($hire_di,"first_name"));
						$last_name		= ucwords($getdata->GetObjectById($hire_di,"first_name"));
			?>
						<div class="pdf_down">
							<a href="<?php echo $sitepath;?>/billing/<?=$fbilling->pdf_name?>" target="_blank">Final Billing PDF</a>
							<div class="genrated_date">
								<b>
									<?=$designations?>: &nbsp;<?=$dfirst_name?>&nbsp;<?=$last_name?>
								</b>&nbsp;
								<br/>
								Generated On:&nbsp;<?=date('d-M-y',strtotime($fbilling->date_time))?>
							</div>
						</div>
			<?php
					}
				}
			?>
		</div>
		<div class="tabbertab">
			<h2>Close Case</h2>
			<div class="dashbord_client">
				<div class="billing_box_bg">
					<?php include('../includes/close-case.php'); ?>
				</div>
			</div>
		</div>
		
		<?php
		}
		else
		{
		?>
		<div class="form_section_content">
			<h1 class="add_user">Mesh Cases</h1>
			<div class="view_log_details">
				<div class="log_heading">
					<div class="serial_no_16">S.No.</div>
					<div class="user_name_16">Name</div>
					<div class="first_name_16">D.O.B</div>
					<div class="workflow_16">Work Flow</div>
					<div class="status_16">Status</div>
					<div class="action_16">Action</div>
				</div>
			</div>
		</div>
		
         <div id="loading"></div>
        <div id="container">
            <div class="data"></div>
            <div class="pagination"></div>
        </div>
       <?php } ?>

<script src="http://<?php echo $jqueryminjs; ?>"></script>
<script src="http://<?php echo $validateminjs; ?>"></script>

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
<script type="text/javascript">
	tabberAutomatic(tabberOptions);
</script>
</div></div>
	<div class="clear"></div>
</div>
</section>
<?php
require($get_footer);
?>
<?php 
}
else 
{ 
header('Location:../../login.php');
}
?>
