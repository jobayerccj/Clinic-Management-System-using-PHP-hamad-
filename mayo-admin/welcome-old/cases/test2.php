<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";
require_once($path);
include($config);
include '../../functions.php';
include '../classes/Cases.php';
$desg = new Cases();
$functions = $_SERVER['DOCUMENT_ROOT']."/rao/classes/functions.php";
require_once($functions);
$getinformation = new Allfunctions();
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
		
		var strURL="find-user.php?desgntn="+desgntnId;
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
		var strURL="getInfo.php?user_details="+usersId;
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
</script>
<form name="form1" method="post" action="">
	<div class="hire_left">
		<div class="dashboard_row">
			<label>Choose Department</label>
			<select name="desgntn" onclick="getUser(this.value)">
				<option>Select Department</option>
				<?php echo $desg->getdesignation(); ?>
			</select>
		</div>
		<div class="dashboard_row">
			<label>Employee Name</label>
			<div id="result"></div>
			<div id="result2"></div>
		</div>
	</div>
	<div class="hire_right">
		<div class="dashboard_row">
			<label>Message</label>
			<textarea></textarea>
		</div>
		<div class="dashboard_row">
			<input type="submit" name="" id="" value="Submit"/>
		</div>
	</div>	 
</form>
