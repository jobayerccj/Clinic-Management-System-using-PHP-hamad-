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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
		<div class="slide_right_pane">
		
		<!---- tabs ---->
		
		<div id="tabs">
			<ul class="tabbernav">
				<li><a href="#application">Application</a></li>
				<li><a href="#documents">Documents</a></li>
				<li><a href="#assign-professional">Assign Professionals</a></li>
				<li><a href="#work-flow">Work Flow/Status Update</a></li>
				<li><a href="#messages">Messages</a></li>
				<li><a href="#billing">Billing</a></li>
				<li><a href="#forward-billing">Forward Billing</a></li>
				<li><a href="#final-billing">Final Billing</a></li>
				<li><a href="#close-case">Close Case</a></li>
			</ul>
		<div id="application">
		<?php
			$qry = "select a.*,b.*,d.* from plantiff_information a 
			inner join plantiff_case_type_info b on a.form_id=b.form_id and a.id=b.id
			inner join members d on a.id=d.id and b.id=d.id
			where b.admin_approved=1 and b.case_closed=0 && a.form_id='$_REQUEST[fid]' && b.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]' && b.id='$_REQUEST[uid]'";
			$sql = mysql_query($qry) or die(mysql_error());
			$row = mysql_fetch_array($sql);
		?>
				<?php
					$getdata->meshedView($row);
				?>
			
		</div>
		<div id="documents">
		<?php
				$admin    = $_SESSION['username'];
				$admin_id = $getdata->GetDetailsByUsername($admin,"id");
				include('../includes/upload-documents.php');
			?>
		</div>
		<div id="assign-professional">
		<?php
				include('../includes/assign-proffessional.php');
			?>
		</div>
		<div id="work-flow">
		<?php
				include('../includes/update-status.php');
			?>
		</div>
		<div id="messages">
		
		<?php include('../includes/messages.php'); ?>
		</div>
		<div id="billing">
			<?php include('../includes/billing.php'); ?>
		</div>
		<div id="forward-billing">
			<?php include('../includes/forward-billing.php'); ?>
		</div>
		<div id="final-billing">
			<?php 
				//include('../includes/final-billing-document.php'); 
				//include('../includes/pdf-generator/final-billing.php'); 	
				include('../includes/tcpdf/examples/final-billing.php');
				include('../includes/forward-final-billing.php');
			?>
		</div>
		<div id="close-case">
			<div class="dashbord_client">
				<div class="billing_box_bg">
					<?php include('../includes/close-case.php'); ?>
				</div>
			</div>
		</div>
		
		<!---- End tabs ---->
		
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
		
		<script>
		$(function() {
			//  jQueryUI 1.10 and HTML5 ready
			//      http://jqueryui.com/upgrade-guide/1.10/#removed-cookie-option 
			//  Documentation
			//      http://api.jqueryui.com/tabs/#option-active
			//      http://api.jqueryui.com/tabs/#event-activate
			//      http://balaarjunan.wordpress.com/2010/11/10/html5-session-storage-key-things-to-consider/
			//
			//  Define friendly index name
			var index = 'key';
			//  Define friendly data store name
			var dataStore = window.sessionStorage;
			//  Start magic!
			try {
				// getter: Fetch previous value
				var oldIndex = dataStore.getItem(index);
			} catch(e) {
				// getter: Always default to first tab in error state
				var oldIndex = 0;
			}
			$('#tabs').tabs({
				// The zero-based index of the panel that is active (open)
				active : oldIndex,
				// Triggered after a tab has been activated
				activate : function( event, ui ){
					//  Get future value
					var newIndex = ui.newTab.parent().children().index(ui.newTab);
					//  Set future value
					dataStore.setItem( index, newIndex ) 
				}
			}); 
		}); 
		</script>
		<?php
		}
		else
		{
		?>
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
