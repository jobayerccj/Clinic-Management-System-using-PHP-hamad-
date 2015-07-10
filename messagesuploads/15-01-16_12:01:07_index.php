<?php
include('db.php');
session_start();
$session_id='1'; //$session id
?>
<html>
<head>
<title>Ajax Image Upload 9lessons blog</title>
</head>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>

<script type="text/javascript" >
 $(document).ready(function() { 
		
            $('#photoimg').die('click').live('change', function()			{ 
			           //$("#preview").html('');
			    
				$("#imageform").ajaxForm({target: '#preview', 
				     beforeSubmit:function(){ 
				
					$("#imageloadstatus").show();
					 $("#imageloadbutton").hide();
					 }, 
					success:function(){ 
				
					 $("#imageloadstatus").hide();
					 $("#imageloadbutton").show();
					}, 
					error:function(){ 
					
					 $("#imageloadstatus").hide();
					$("#imageloadbutton").show();
					} }).submit();
					
		
			});
        }); 
</script>

<style>

body
{
font-family:arial;
font-size:12px;
}
.preview
{
width:300px;
border:solid 1px #dedede;
padding:6px;
margin-right:10px;
}
.img
{
border:solid 1px #dedede;
padding:6px;
margin-right:10px;
}
#preview
{
font-size:12px;
}


</style>
<body>
<table width="100%">
<tr>
<td>
<h1>Ajax Upload and Resize an Image with PHP.</h1>
9lessons Programming Blog <a href='http://www.9lessons.info'>9lessons.info</a><br/><br/>

<div id='preview'>
</div>

<br/>
<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
<h3>Upload your image</h3>
<div id='imageloadstatus' style='display:none'><img src="loader.gif" alt="Uploading...."/></div>
<div id='imageloadbutton'>
<input type="file" name="photoimg" id="photoimg" />
</div>
</form>
<td>
<td width="360px">

</td>
</tr></table>


</body>
</html>