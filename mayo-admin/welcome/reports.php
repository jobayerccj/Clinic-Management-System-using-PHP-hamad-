<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../includes/functions.php');
$path       = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
include '../functions.php';
$functions  = $pathofmayo."/classes/functions.php";
include($functions);
$meshedfile = $pathofmayo."/attorney/classes/meshed.php";
require_once($meshedfile);
$getdata    = new Meshed();
?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
        <script type="text/javascript">
            $(document).ready(function(){
                function loading_show(){
                    $('#loading').html("<img src='images/loading.gif'/>").fadeIn('fast');
                }
                function loading_hide(){
                    $('#loading').fadeOut('fast');
                }                
                function loadData(page){
                    loading_show();                    
                    $.ajax
                    ({
                        type: "POST",
                        url: "reports-pag.php",
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
	<div class="container">
		
		<div class="form_section_content">
			<h1 class="add_user">Reports</h1>
			<a href='payment-received.php' class="back_btn">Generate XLS</a>
			<div class="view_log_details">
				<div class="log_heading">
					<div class="serial_no_16">S.No.</div>
					<div class="user_name_16">Name</div>
					<div class="first_name_16">D.O.B</div>
					<div class="workflow_16">Application Date</div>
					<div class="status_16">Surgery Date</div>
					<div class="action_16">Action</div>
				</div>
			</div>
		</div>
		
         <div id="loading"></div>
        <div id="container">
            <div class="data"></div>
            <div class="pagination"></div>
        </div>
</div>
<div class="clear"></div>
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
