<?php
ob_start();
require_once('../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";

require_once($path);
include($config);
include '../functions.php';
$classfile = $_SERVER['DOCUMENT_ROOT']."/classes/functions.php";
include($classfile);
include('header.php');
if(loggedin())
{
	$desg  = new Allfunctions();
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript">

// Roshan's Ajax dropdown code with php

// This notice must stay intact for legal use

// Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com

// If you have any problem contact me at http://roshanbh.com.np

function getXMLHTTP() { //fuction to return the xml http object
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
	function getProfessionals(designations) {	
		var strURL="findprofessional.php?designation="+designations;
		var req = getXMLHTTP();
		if (req) {		
		req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {						
						document.getElementById('professionals_data').innerHTML=req.responseText;						
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
 <script type="text/javascript">

    	jQuery(document).ready(function($) {

    		$('#search_data').click(function(){

    			makeAjaxRequest();

    		});



            $('form').submit(function(e){

                e.preventDefault();

                makeAjaxRequest();

                return false;

            });



            function makeAjaxRequest() {

                $.ajax({

                    url: 'findprofessional.php',

                    type: 'get',

                    data: {designation: $('#desgnation option:selected').val(),fname: $('input#fname').val(),lname:$('input#lname').val(),email: $('input#email_id').val()},

                    success: function(response) {

                        $('#professionals_data').html(response);

                    }

                });

            }

    	});

    </script>
<section class="row">
	<div class="container">
		<div class="form_section_content">
		<h1 class="add_user">Manage Professionals</h1>
		<form name="userinfo" method="get" action="" id="regform">	
				<div class="mang_prof">
					<input type="text" name="fname" id="fname" placeholder="First Name"/>
					<input type="text" name="lname" id="lname" placeholder="Last Name"/>
					<input type="text" name="email" id="email_id" placeholder="Email ID"/>
                    <select name="designation" id="desgnation" class="sel_reg_form">
						<option value="">Designation</option>
						<?php
							$sql = mysql_query("select * from designation where id!=5 and id!=8") or die(mysql_error());
							while($data = mysql_fetch_object($sql))
							{
						?>
							<option value="<?php echo $data->id; ?>"><?php echo $data->designation; ?></option>
						<?php
							}
						?>
					</select>
					<input type="Submit" name="search" id="search_data" value="Search"/>
					<a class="reset_button" href="javascript:location.reload(true)">Reset</a>
                    </div>
				<div id="professionals_data">
					<div class="view_log_details">
	<div class="log_heading">
		<div class="serial_no">Name</div>
		<div class="user_name">Email Address</div>
		<div class="first_name">Contact Number</div>
		<div class="last_name">Address</div>
		<div class="email_address">Designation</div>
		<div class="organisation">Organisation</div>
		<div class="department">Date</div>
		<div class="action">Action</div>
	</div>
<?php
$data = mysql_query("select * from `members` where `activated`='1' && designation!=5 and designation!=8") or die(mysql_error());
if(mysql_num_rows($data)>0)
{
while($row = mysql_fetch_object($data))
{
?>
<div class="log_row">
	<div class="serial_no"><?php $fname = $row->first_name; $lname=$row->last_name; echo ucwords($fname); echo "&nbsp"; echo "&nbsp"; echo ucwords($lname); ?></div>
	<div class="user_name"><?php echo $row->email_id; ?></div>
	<div class="first_name"><?php $contact = $row->contact_number; if($contact!=""){echo $contact;}else{echo "Not Avail";} ?></div>
	<div class="last_name"><?php $city=$row->state; if($city!="") {echo $desg->GetStatebyStateCode($city).","; echo $row->city.","; echo $row->address.","; echo $row->zip_code.","; }else{echo "Not Avail";}?></div>
	<div class="email_address"><?php $desgd= $row->designation; echo $desg->getRoleByRoleId($desgd); ?></div>
	<div class="organisation"><?php $org = $row->organisation; if($org!=""){echo $org;}else{echo "Not Avail";} ?></div>
	<div class="department"><?php $date_time = $row->date_time; echo date('m-d-Y h:i:s:a',strtotime($date_time)); ?></div>
	<div class="department"><a href="action.php?data=<?=$row->id?>">Delete/Update</a></div>
</div>
<?php
}
?>
</div>
<?php
}
else
{
	echo "<h1>Not Found</h1>";
}
?>
				</div>
			
		</form>
<?php 
	}else { 
header('Location:../login.php');
	}	 
	?>

	</div>
</section>
<?php
require($get_footer);
?>
