<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */
 ob_start();
 $html = ob_get_clean();
 error_reporting(E_ALL);
 $path = $_SERVER['DOCUMENT_ROOT']."/path.php";
 include($path);
 //include($config);
?>
<style>
	.mess_msg_form_div{width: 100%;overflow: hidden;margin-bottom: 5px;padding:10px 0;clear:both;}
	.mess_msg_lft {width: 2%;float: left;}
	.mess_msg_rgt {width: 80%;float: left;padding-left: 2px;border-left:1px solid #1b86e3;}
	.mess_msg_form_divi{width: 100%;overflow: hidden;margin-bottom:0;padding:5px 20px;clear:both;}
	.mess_msg_lfti {width: 2%;float: left;font-size:12px;}
	.mess_msg_rgti {width: 80%;float: left;padding-left: 2px;font-size:12px;border-left:1px solid #1b86e3;}
	.mess_msg_rgt label{border-left: 2px solid #f68220;}
	.back_btn_area{width:12%;}
	.back_btn {background-color: #FF8F22;border: medium none;border-radius: 4px 4px 4px 4px;color: #FFFFFF;cursor: pointer;
	  font-family: 'open_sansregular';font-size: 16px;margin: 10px 0;padding: 10px;text-decoration: none;width:100%;}
	.mess_msg_info{width:100%; float:left; margin:auto; display:block; padding:10px 0px 0px 0px;}
	.mess_msg_info a{float:left; text-indent:20px; font-size:12px;}
	#ub_grosss_income{float:left; margin:auto; display:block; margin:0px 0px 0px 8px;}
	#ub_grosss_income input[type="number"]{border:1px solid #ccc; height:25px;}
	#hb_grosss_income input[type="number"]{border:1px solid #ccc; height:25px;}
	.errors{width: 100%;float: left;color: red;font: normal 10px open_sansregular;}
</style>
<div class="back_btn_area">
 <a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
 <a href="#"><input name="" type="button" class="back_btn" value="<?php echo $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); ?>"/></a>
</div>
<div class="attorney_client_info"><h1>Select the Form to generate the final billing</h1></div>
<!-------------------------------------------------- toggle for gross income text box ------------------------------------------------>
<script type="text/javascript">
	$(document).ready(function()
	{
		$("#ub_grosss").click(function()
		{
			$("#ub_grosss_income").toggle("slow");
		});
		$("#hb_grosss").click(function()
		{
			$("#hb_grosss_income").toggle("slow");
		});
	});
</script>
<!------------------------------------------------------ Validations Part ------------------------------------------------------------>
<script type="text/javascript">
function validation()
{
	var checkbox = document.getElementsByName('staffinfo');
	var count = 0;
	for(var i=0;i<checkbox.length;i++)
	{
		if(checkbox[i].checked == true)
		{
			count++;
		}
	}
	//var staffinfo = document.getElementById("staffinfo").val();
	if(document.getElementById("ub_04").checked == true)
	{
		if(count<1)
		{
			document.getElementById("hcfaaV").innerHTML="Please Select Atleast One Profession";
			return false;
		}
		else
		{
			document.getElementById("hcfaaV").innerHTML="";
			return true;
		}
	}
	else if(document.getElementById("hcfaform").checked == true)
	{	
		if(count<1)
		{
			document.getElementById("hcfaV").innerHTML="Please Select Atleast One Profession";
			return false;
		}
		else
		{
			document.getElementById("hcfaV").innerHTML="";
			return true;
		}
	}
}
</script>
<form name="form1" method="post" action="">
	<div class="mess_msg_form_div">
	<div class="mess_msg_lft"><input type="radio" name="billing" id="ub_04" value="ub-04"/></div>
	<div class="mess_msg_rgt"><label>Generate Bill Using UB-04</label></div>
	<?php
		$h = 1;
		$hireTemp = mysql_query("SELECT a.id, a.designation,a.first_name,a.last_name, b . * FROM members AS a, hire_staff AS b WHERE a.id = b.hire_id AND (a.designation =1 || a.designation =3 || a.designation =4) AND form_id = '$_REQUEST[fid]'") or die(mysql_error());
		while($hireStaff = mysql_fetch_object($hireTemp))
		{
	?>
		<div class="mess_msg_form_divi">
			<div class="mess_msg_lfti">
				<input type="radio" id="staffinfod" name="staffinfo" value="<?php echo $hireStaff->hire_id; ?>"/>
			</div>
			<div class="mess_msg_rgti">
				<label>
					<?php echo $getdata->GetDesgBydesId($hireStaff->designation).'&nbsp;('.$hireStaff->first_name.'&nbsp'.$hireStaff->last_name.')'; ?>
				</label>
			</div>
		</div>
	<?php
		}
	?>
	<div class="mess_msg_info">
		<a id="ub_grosss">Use Gross Bill Amount</a>
		<div id="ub_grosss_income" style="display:none;">
			<input type="number" name="ubgrossincome" step="any" placeholder="Enter Gross Bill Amount" value="">
		</div>
	</div>
	<span id="hcfaaV" class="errors"></span>
	</div>
	<div class="mess_msg_form_div">
		<div class="mess_msg_lft">
			<input type="radio" id="hcfaform" name="billing" value="hcfa-1500"/>
		</div>
		<div class="mess_msg_rgt">
			<label>Generate Bill Using HCFA</label>
		</div>
	<?php
		$hireTemp = mysql_query("SELECT a.id, a.designation,a.first_name,a.last_name, b . * FROM members AS a, hire_staff AS b WHERE a.id = b.hire_id AND (a.designation =1 || a.designation =3 || a.designation =4) AND form_id = '$_REQUEST[fid]'") or die(mysql_error());
		while($hireStaff = mysql_fetch_object($hireTemp))
		{
	?>
			<div class="mess_msg_form_divi">
				<div class="mess_msg_lfti">
					<input type="radio" id="hbstaffinfo" name="staffinfo" value="<?php echo $hireStaff->hire_id; ?>"/>
				</div>
				<div class="mess_msg_rgti">
					<label>
						<?php echo $getdata->GetDesgBydesId($hireStaff->designation).'&nbsp;('.$hireStaff->first_name.'&nbsp'.$hireStaff->last_name.')'; ?>
					</label>
				</div>
			</div>
	<?php
		}
	?>
		
		<div class="mess_msg_info">
			<a id="hb_grosss">Use Gross Bill Amount</a>
			<div id="hb_grosss_income" style="display:none;">
				<input type="number" name="hbgrossincome" step="any" placeholder="Enter Gross Bill Amount" value="">
			</div>
		</div>
		<span id="hcfaV" class="errors"></span>
	</div>
	<div class="back_btn_area"><input type="submit" onclick="return validation();" name="generatepdf" value="Generate Pdf" class="back_btn" /></div>
</form>
<?php
	$checkFinalBillingTemp = mysql_query("SELECT * FROM `final_billing` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
	if(mysql_num_rows($checkFinalBillingTemp)>0)
	{
?>
		<div class="attorney_client_info"><h1>Payment Verification</h1></div>
		<form name="verify-payment" method="post" action="">	
			<div class="mess_msg_form_div">
				<div class="mess_msg_lft">
					<input type="radio" name="payment" value="1"> 
				</div>
				<div class="mess_msg_rgt">
					<label>Payment Received</label>
				</div>
			</div>
			<div class="mess_msg_form_div">
				<div class="mess_msg_lft">
					<input type="radio" name="payment" value="2"> 
				</div>
				<div class="mess_msg_rgt">
					<label>Payment Declined</label>
				</div>
				<div class="back_btn_area">
					<input type="submit" name="b_verified" value="Payment Received" class="back_btn">
				</div>
			</div>
		</form>
<?php
	if(isset($_POST['b_verified']))
	{
		$insertPayment = mysql_query("UPDATE `final_billing` SET `billing_accepted`='$_POST[payment]',`billing_accepted_date`=now() WHERE `form_id`='$_REQUEST[fid]' and `user_id`='$_REQUEST[uid]'") or die(mysql_error());
		if($insertPayment)
		{
			echo '<h2>Payment Status Verified Successfully</h2>';
		}
	}

	$showVerified = mysql_query("SELECT * FROM `final_billing` WHERE `form_id`='$_REQUEST[fid]' and `user_id`='$_REQUEST[uid]' and `billing_accepted` != 0") or die(mysql_error());
	$showVerifiedData = mysql_fetch_object($showVerified);
	//echo $billVerification = $showVerifiedData->billing_accepted;
	if(mysql_num_rows($showVerified)>0)
	{
		//echo $billVerification = $showVerifiedData->billing_accepted;
		//echo "<h1>Last Decision:".$showVerifiedData->billing_accepted."</h1>";
		if($billVerification=1)
		{
			echo "<h1>Last Decision: Payment Received</h1>";
		}
		else
		{
			echo "<h1>Last Decision: Payment Declined</h1>";
		}
	}
	else
	{
		echo "<h1>Decision is Pending</h1>";
	}
}
?>
<?php

if(isset($_POST['generatepdf']) && $_POST['billing']=="ub-04")
{
// Include the main TCPDF library (search for installation path).
$tcpdfpath = $pathofmayo."/mayo-admin/welcome/includes/tcpdf/examples/tcpdf_include.php";
//require_once('../includes/tcpdf/tcpdf_include.php');
require_once($tcpdfpath);

// create new PDF document
$pdf = new TCPDF('P','mm','A4', true, 'UTF-8', false);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$pdf->SetMargins(5, 5);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(5);
// set font
$pdf->SetFont('dejavusans','','8.3');
// test custom bullet points for list
// add a page
$pdf->AddPage();

$informationp   = mysql_query("SELECT a.*,b.* from `plantiff_information` as a, `plantiff_case_type_info` as b WHERE a.id=b.id and a.form_id=b.form_id and a.id='$_REQUEST[uid]' && a.form_id='$_REQUEST[fid]' ") or die(mysql_error());
$infoAll        = mysql_fetch_object($informationp);
$state          = $infoAll->p_state;
$origstate      = $getdata->GetStatebyStateCode($state);
$fnameoffac     = $getdata->GetObjectById($_REQUEST['staffinfo'],"first_name");
$lnameoffac     = $getdata->GetObjectById($_REQUEST['staffinfo'],"last_name");
$fullname       = ucwords($fnameoffac)." ".ucwords($lnameoffac);
$addressoffac   = $getdata->GetObjectById($_REQUEST['staffinfo'],"address"); 
$stateoffac     = $getdata->GetObjectById($_REQUEST['staffinfo'],"state");
$origstateoffac = $getdata->GetStatebyStateCode($stateoffac);
$cityoffac      = $getdata->GetObjectById($_REQUEST['staffinfo'],"city");
$zipoffac       = $getdata->GetObjectById($_REQUEST['staffinfo'],"zip_code");
$contactoffac   = $getdata->GetObjectById($_REQUEST['staffinfo'],"contact_number");
$npiNumber      = $getdata->GetObjectById($_REQUEST['staffinfo'],"npi_number");
$sergeryDateTemp= $getdata->consultationDate(2,$_REQUEST['fid'],"date_appt");
	list($av,$bv)  = explode(" / ",$sergeryDateTemp);
	echo $dateofSergery  = date('m-d-Y',strtotime($av));
$table1 = '<style>
			.table-border{border:0.5px solid #818181;}
			.border_bottom{border-bottom:0.5px solid #818181;} 
			.border_right{border-right:1px solid #818181; border-left:1px solid #818181;}
			.tot_image{background:url(images/arrw.png) no-repeat right center;}
		</style>
		<table>
			<tr>
				<td class="border_bottom">1 Mayo Surgical, LLC </td>
			</tr>
			<tr>
				<td class="border_bottom">600 Chastain Road, Suite 220 </td>
			</tr>
			<tr>
				<td class="border_bottom">Kennesaw, GA 30144</td>
			</tr>
			<tr>
				<td class="border_bottom">2 866-411-2525 PHONE </td>
			</tr>
			<tr>
				<td class="border_bottom">800-865-8691 FAX </td>
			</tr>
		</table>';
$table2 = '<table>
				<tr>
					<td class="border_bottom">'.$fullname.'</td>
				</tr>
				<tr>
					<td class="border_bottom">'.$addressoffac.', '.$origstateoffac.'</td>
				</tr>
				<tr>
					<td class="border_bottom">'.$cityoffac.', '.$zipoffac.'</td>
				</tr>
				<tr>
					<td class="border_bottom">'.$contactoffac.' Contact</td>
				</tr>
			</table>';
$table3 = '<table>
				<tr>
					<td class="border_bottom border_right">3a PAT. CNTL# </td>
					<td colspan="2" class="border_bottom border_right">&nbsp;</td>
					<td bgcolor="#000000" style="color:#FFFFFF;">4 TYPE OF BILL </td>
				</tr>
				<tr>
					<td class="border_bottom border_right" bgcolor="#efefef">b.MED REC # </td>
					<td colspan="2" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
				</tr>
				<tr>
					<td class="border_bottom border_right">5 FEED TAX No. </td>
					<td colspan="2" class="border_bottom border_right" bgcolor="#efefef">6 STATEMENT COVERS PERIOD </td>
					<td rowspan="3" valign="top">7</td>
				</tr>
				<tr>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">FROM</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">THROUGH</td>
				</tr>
				<tr>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center">&nbsp;</td>
				</tr>
			</table>';
$table4 = '<table width="170">
				<tr>
					<td width="9" class="border_bottom border_right" align="center" bgcolor="#efefef">8</td>
					<td width="80" class="border_bottom border_right" bgcolor="#efefef">PATIENT NAME </td>
					<td width="17" class="border_bottom border_right" align="center" bgcolor="#efefef">a</td>
					<td width="69" class="border_bottom" align="center">'.$infoAll->plantiff_name.'</td>
				</tr>
				<tr>
					<td class="border_right" align="center" bgcolor="#efefef">b</td>
					<td colspan="3">&nbsp;&nbsp;'.$infoAll->plantiff_name.'</td>
				</tr>
			</table>';
$table5 = '<table width="395">
				<tr>
					<td width="10" align="center" class="border_bottom border_right" bgcolor="#efefef">8</td>
					<td width="160" class="border_bottom border_right" bgcolor="#efefef">PATIENT ADDRESS </td>
					<td width="10" align="center" class="border_bottom border_right" bgcolor="#efefef">a</td>
					<td width="215" colspan="5" class="border_bottom border_right" align="center">'.$infoAll->p_address.'</td>
				</tr>
				<tr>
					<td width="10" class="border_right" align="center" bgcolor="#efefef">b</td>
					<td width="160" class="border_right border_right">'.$infoAll->p_city.'</td>
					<td width="10" class="border_right" align="center" bgcolor="#efefef">c</td>
					<td width="65" align="center" class="border_right">'.$infoAll->p_state.'</td>
					<td width="10" align="center" class="border_right" bgcolor="#efefef">d</td>
					<td width="65" align="center" class="border_right">'.$infoAll->p_zip_code.'</td>
					<td width="10" align="center" class="border_right" bgcolor="#efefef">e</td>
					<td width="65" align="center" class="border_right">&nbsp;</td>
				</tr>
			</table>';
$table6 = '<table width="570">
				<tr>
					<td width="70" class="border_bottom border_right" valign="middle">10 BIRTHDATE</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">11 SEX </td>
					<td width="110" colspan="4" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">ADMISSION</td>
					<td width="25" rowspan="2" align="center" class="border_bottom border_right" style="display:block; padding:10px 0px 0px 0px; vertical-align:middle;">16 DHR </td>
					<td width="25" rowspan="2" align="center" class="border_bottom border_right" valign="middle">17 SAT </td>
					<td width="275" colspan="11" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">CONDITION CODES </td>
					<td width="20" rowspan="2" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">29 ACDT STATE </td>
					<td width="20" rowspan="2" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">30</td>
				</tr>
				<tr>
					<td width="70" align="center" class="border_bottom border_right" valign="middle">'.$infoAll->p_d_o_b.'</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="35" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">12 Date</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">13 HR </td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">14 TYPE </td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">15 SRC </td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">18</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">19</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">20</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">21</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">22</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">23</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">24</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">25</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">26</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">27</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle" bgcolor="#efefef">28</td>
				</tr>
				<tr>
					<td width="70" align="center" class="border_bottom border_right" valign="middle">'.$dateofSergery.'</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="35" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="20" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="20" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
				</tr>
				<tr>
					<td width="70" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="35" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="25" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="20" align="center" class="border_right" valign="middle">&nbsp;</td>
					<td width="20" align="center" valign="middle">&nbsp;</td>
				</tr>
			</table>';
$table7 = '<table width="570">
				<tr>
					<td colspan="2" align="center" class="border_bottom border_right" bgcolor="#efefef">31 OCCURRENCE</td>
					<td colspan="2" align="center" bgcolor="#515151" style="color:#FFFFFF;">32 OCCURRENCE</td>
					<td colspan="2" align="center" class="border_bottom border_right" bgcolor="#efefef">33 OCCURRENCE</td>
					<td colspan="2" align="center" bgcolor="#515151" style="color:#FFFFFF;">34 OCCURRENCE</td>
					<td colspan="3" align="center" class="border_bottom border_right" bgcolor="#efefef">35 OCCURRENCE</td>
					<td colspan="3" align="center" class="border_bottom" bgcolor="#efefef">36 OCCURRENCE </td>
					<td class="border_right" bgcolor="#efefef">37</td>
				</tr>
				<tr>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">CODE</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">DATE</td>
					<td align="center" class="border_bottom border_right" bgcolor="#515151" style="color:#FFFFFF;">CODE</td>
					<td align="center" class="border_bottom border_right" bgcolor="#515151" style="color:#FFFFFF;">DATE</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">CODE</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">DATE</td>
					<td align="center" class="border_bottom border_right" bgcolor="#515151" style="color:#FFFFFF;">CODE</td>
					<td align="center" class="border_bottom border_right" bgcolor="#515151" style="color:#FFFFFF;">DATE</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">CODE</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">FROM</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">THROUGH</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">CODE</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">FROM</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">THROUGH</td>
					<td align="center" class="border_bottom border_right">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
					<td align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
				</tr>
			</table>';
$table8 = '<table width="570">
			  <tr>
				<td width="150" rowspan="6" valign="top" class="border_bottom border_right">
				'.ucwords($infoAll->plantiff_name).'<br/>'.$infoAll->p_address.'&nbsp;'.$origstate.'&nbsp;'.$infoAll->p_city.',&nbsp;'.$infoAll->p_zip_code.'<br/>
				Mob. No.'.$infoAll->p_mob_no.'<br/>Office. No.'.$infoAll->p_office_no.'</td>
				<td width="15" class="border_bottom border_right">&nbsp;</td>
				<td width="135" colspan="3" align="center" class="border_bottom border_right">VALUE CODES </td>
				<td width="135" colspan="3" align="center" class="border_bottom border_right" bgcolor="#515151" style="color:#FFFFFF;">VALUE CODES</td>
				<td width="135" colspan="3" align="center" class="border_bottom border_right">VALUE CODES</td>
			  </tr>
			  <tr>
				<td width="15" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">CODE</td>
				<td width="75" align="center" class="border_bottom border_right">AMOUNT</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right" bgcolor="#515151" style="color:#FFFFFF;">CODE</td>
				<td width="75" align="center" class="border_bottom border_right" bgcolor="#515151" style="color:#FFFFFF;">AMOUNT</td>
				<td width="25" align="center" class="border_bottom border_right" bgcolor="#515151" style="color:#FFFFFF;">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">CODE</td>
				<td width="75" align="center" class="border_bottom border_right">AMONT</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="15" align="center" class="border_right">a</td>
				<td width="35" align="center" class="border_right">&nbsp;</td>
				<td width="75" align="center" class="border_right">&nbsp;</td>
				<td width="25" align="center" class="border_right">&nbsp;</td>
				<td width="35" align="center" class="border_right">&nbsp;</td>
				<td width="75" align="center" class="border_right">&nbsp;</td>
				<td width="25" align="center" class="border_right">&nbsp;</td>
				<td width="35" align="center" class="border_right">&nbsp;</td>
				<td width="75" align="center" class="border_right">&nbsp;</td>
				<td width="25" align="center" class="border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="15" align="center" class="border_right" bgcolor="#efefef">b</td>
				<td width="35" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="75" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="25" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="35" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="75" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="25" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="35" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="75" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="25" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="15" align="center" class="border_right">c</td>
				<td width="35" align="center" class="border_right">&nbsp;</td>
				<td width="75" align="center" class="border_right">&nbsp;</td>
				<td width="25" align="center" class="border_right">&nbsp;</td>
				<td width="35" align="center" class="border_right">&nbsp;</td>
				<td width="75" align="center" class="border_right">&nbsp;</td>
				<td width="25" align="center" class="border_right">&nbsp;</td>
				<td width="35" align="center" class="border_right">&nbsp;</td>
				<td width="75" align="center" class="border_right">&nbsp;</td>
				<td width="25" align="center" class="border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="15" align="center" class="border_right" bgcolor="#efefef">d</td>
				<td width="35" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="75" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="25" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="35" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="75" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="25" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="35" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="75" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
			  </tr>
			</table>';
$table9 = '<table width="570">';
$table9 .='<tr>
					<td width="30" align="center" valign="middle" class="border_bottom border_right">42 REV. CD. </td>
					<td width="210" align="center" valign="middle" class="border_bottom border_right">43 DESCRIPTION</td>
					<td width="50" align="center" class="border_bottom border_right">44 HCPCS/RATE/HIPPS CODE </td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">45 SERV.DATE</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">45 SERV. UNITS </td>
					<td width="90" align="center" colspan="2" class="border_bottom border_right">47 TOTAL CHARGES </td>
					<td width="90" align="center" colspan="2" class="border_bottom border_right">48 NON-COVERED CHARGES </td>
					<td width="20" align="center" class="border_bottom">49</td>
				</tr>';
		if(isset($_REQUEST['ubgrossincome']) && $_REQUEST['ubgrossincome']!="")
		{
			$billingTemp = mysql_query("SELECT * , SUM((doctor_cost)+(doctor_price)+(facility_price)+(facility_cost)+(anes_cost)+( anes_price)) AS `total` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]' AND `user_id` =$_REQUEST[uid] GROUP BY `billing_id`") or die(mysql_error());
			$count = mysql_num_rows($billingTemp);
				$i=0;
				while($billingfinal = mysql_fetch_object($billingTemp))
				{
					if($i%2==0)
					{
						$table9 .= '<tr bgcolor="#efefef">';
					}
					else
					{
						$table9 .= '<tr>';
					}
				$table9 .= '<td width="30" align="center" valign="middle" class="border_right border_bottom">'.$billingfinal->cpt_code.'</td>
						<td width="210" align="center" valign="middle" class="border_right border_bottom">'.$billingfinal->description.'</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">'.$billingfinal->cpt_code.'</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">'.$dateofSergery.'</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">';
						if($count==$i+1)
						{
							$table9 .= number_format($_REQUEST['ubgrossincome'],2);
						}
				$table9 .='</td><td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="20" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
						</tr>';
			$i++;
		}
		/* Client want the 5 rows to be here whethere thet are filled or not; loop to set the unfilled columns here and also the loop to chan ge the design of the tr with in it */
		if($i<=5)
		{
			$j = 5-$i;
			for($k = 0;$k<$j;$k++)
			{
				if($j%2 == 0)
				{
					if($k%2 == 0)
					{
						$table9 .= '<tr>';
					}
					else
					{
						$table9 .= '<tr bgcolor="#efefef">';
					}
				}
				else{
						if($k%2 == 0)
						{
							$table9 .= '<tr bgcolor="#efefef">';
						}
						else
						{
							$table9 .= '<tr>';
						}
					}
					$table9 .= '<td width="30" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="210" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="20" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
						</tr>';
			}
		}
/****************************  Unfilled column ends here **********************************************************************/
		$billingTemptotal = mysql_query("SELECT * , SUM((doctor_cost)+(doctor_price)+(facility_price)+(facility_cost)+(anes_cost)+( anes_price)) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]' AND `user_id` =$_REQUEST[uid]") or die(mysql_error());
		$billingtotal = mysql_fetch_object($billingTemptotal);

		$table9 .='<tr>
					<td width="30" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="210" align="center" valign="middle" class="border_bottom border_right" style="font-style:italic; font-size:9px;">Page ____1_____ of ____1___</td>
					<td width="50" align="center" valign="middle" class="border_bottom border_right" style="font-style:italic; font-size:9px;">CREATION DATE</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">'.date('d-m-y').'</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right" bgcolor="#515151" style="color:#FFFFFF;font-style:italic; font-size:9px;"><span class="tot_image">TOTAL</span></td>
					<td width="50" align="center" valign="middle" class="border_bottom border_right">'.number_format($_REQUEST[ubgrossincome],2).'</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">00</td>
					<td width="50" align="center" valign="middle" class="border_bottom border_right">0</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">00</td>
					<td width="20" align="center" valign="middle">&nbsp;</td>
				</tr>';
		$table9 .= '</table>';
 }else{
 /******************* Here getting the hire id (profession id ) and get the designation on the basis of that id **********************/
	$userIdds      = $_REQUEST['staffinfo'];
	$designation   = $getdata->GetObjectById($userIdds,"designation");
	if($designation == '1')
	{
		$billingTemps = mysql_query("SELECT * , anes_price as total FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
	}
	elseif($designation == '3')
	{
		$billingTemps = mysql_query("SELECT * , doctor_price as total FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
	}
	elseif($designation == '4')
	{
		$billingTemps = mysql_query("SELECT * , facility_price as total FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
	}
	/*$billingTemps = mysql_query("SELECT * , SUM((doctor_cost)+(doctor_price)+(facility_price)+(facility_cost)+(anes_cost)+( anes_price)) AS `total` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]' AND `user_id` =$_REQUEST[uid] GROUP BY `billing_id`") or die(mysql_error());*/
				$i=0;
				while($billingfinals = mysql_fetch_object($billingTemps))
				{
					if($i%2==0)
					{
						$table9 .= '<tr bgcolor="#efefef">';
					}
					else
					{
						$table9 .= '<tr>';
					}
				$table9 .= '<td width="30" align="center" valign="middle" class="border_right border_bottom">'.$billingfinals->cpt_code.'</td>
						<td width="210" align="center" valign="middle" class="border_right border_bottom">'.$billingfinals->description.'</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">'.$billingfinals->cpt_code.'</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">'.date('d-m-y',strtotime($billingfinal->date_bill)).'</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">'.number_format($billingfinals->total,2).'</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="20" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
						</tr>';
			$i++;
		}
		if($i<=5)
		{
			$j = 5-$i;
			for($k=0;$k<$j;$k++)
			{
				if($j%2==0)
				{
					if($k%2==0)
					{
						$table9 .= '<tr>';
					}
					else
					{
						$table9 .= '<tr bgcolor="#efefef">';
					}
				}
				else{
						if($k%2==0)
						{
							$table9 .= '<tr bgcolor="#efefef">';
						}
						else
						{
							$table9 .= '<tr>';
						}
					}
						
					$table9 .= '<td width="30" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="210" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="50" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="40" align="center" valign="middle" class="border_right border_bottom">&nbsp;</td>
						<td width="20" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
						</tr>';
			}
		}
	if($designation == '1')
	{
		$billingTemptotals = mysql_query("SELECT * , SUM(anes_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
	}
	elseif($designation == '3')
	{
		$billingTemptotals = mysql_query("SELECT * , SUM(doctor_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
	}
	elseif($designation == '4')
	{
		$billingTemptotals = mysql_query("SELECT * , SUM(facility_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
	}
		//$billingTemptotals = mysql_query("SELECT * , SUM(doctor_cost)+(doctor_price)+(facility_price)+(facility_cost)+(anes_cost)+( anes_price)) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]' AND `user_id` =$_REQUEST[uid]") or die(mysql_error());
		$billingtotals = mysql_fetch_object($billingTemptotals);
					
		$table9 .='<tr>
					<td width="30" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="210" align="center" valign="middle" class="border_bottom border_right" style="font-style:italic; font-size:9px;">Page _____1____ of ___1____</td>
					<td width="50" align="center" valign="middle" class="border_bottom border_right" style="font-style:italic; font-size:9px;">CREATION DATE</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">'.date('d-m-y').'</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right" bgcolor="#515151" style="color:#FFFFFF;font-style:italic; font-size:9px;"><span class="tot_image">TOTAL</span></td>
					<td width="50" align="center" valign="middle" class="border_bottom border_right">'.number_format($billingtotals->totals,2).'</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">00</td>
					<td width="50" align="center" valign="middle" class="border_bottom border_right">0</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">00</td>
					<td width="20" align="center" valign="middle">&nbsp;</td>
				</tr>';
		$table9 .= '</table>';
 }

$table10 = '<table width="570" border="0">
			  <tr>
				<td width="150" align="left" class="border_bottom border_right" bgcolor="#efefef">50 PAYER NAME </td>
				<td width="60" align="center" class="border_bottom border_right" bgcolor="#efefef">51 HEALTH PLAN ID </td>
				<td width="35" align="center" class="border_bottom border_right" bgcolor="#efefef">52 REL INFO </td>
				<td width="15" align="center" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right" bgcolor="#efefef">53 ASG. BEN </td>
				<td width="80" align="center" class="border_bottom border_right" bgcolor="#efefef" colspan="2">54 PRIOR PAYMENT </td>
				<td width="80" align="center" class="border_bottom border_right" bgcolor="#efefef" colspan="2">55 EST. AMOUNT DUE </td>
				<td width="50" align="center" class="border_bottom border_right" bgcolor="#efefef">56 NPL </td>
				<td width="65" align="center" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="150" align="center" class="border_right">&nbsp;</td>
				<td width="60" align="center" class="border_right">&nbsp;</td>
				<td width="35" align="center" class="border_right">&nbsp;</td>
				<td width="15" align="center" class="border_right">&nbsp;</td>
				<td width="35" align="center" class="border_right">&nbsp;</td>
				<td width="50" align="center" class="border_right">&nbsp;</td>
				<td width="30" align="center" class="border_right">&nbsp;</td>
				<td width="50" align="center" class="border_right">&nbsp;</td>
				<td width="30" align="center" class="border_right">&nbsp;</td>
				<td width="50" align="center" class="border_right">57</td>
				<td width="65" align="center" class="border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="150" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="60" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="35" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="15" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="35" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="50" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="30" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="50" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="30" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="50" align="center" class="border_right" bgcolor="#efefef">OTHER</td>
				<td width="65" align="center" class="border_right" bgcolor="#efefef">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="150" align="center" class="border_right">&nbsp;</td>
				<td width="60" align="center" class="border_right">&nbsp;</td>
				<td width="35" align="center" class="border_right">&nbsp;</td>
				<td width="15" align="center" class="border_right">&nbsp;</td>
				<td width="35" align="center" class="border_right">&nbsp;</td>
				<td width="50" align="center" class="border_right">&nbsp;</td>
				<td width="30" align="center" class="border_right">&nbsp;</td>
				<td width="50" align="center" class="border_right">&nbsp;</td>
				<td width="30" align="center" class="border_right">&nbsp;</td>
				<td width="50" align="center" class="border_right">PRV ID </td>
				<td width="65" align="center">&nbsp;</td>
			  </tr>
			</table>';
$table11 = '<table width="570" border="0">
			  <tr>
				<td width="175" class="border_bottom border_right" bgcolor="#efefef">58 INSUREDS NAME </td>
				<td width="65" class="border_bottom border_right" bgcolor="#efefef">59 P. REL </td>
				<td width="105" class="border_bottom border_right" bgcolor="#efefef">60 INSUREDS UNIQUE ID </td>
				<td width="100" class="border_bottom border_right" bgcolor="#efefef">61 GROUP NAME </td>
				<td width="125" class="border_bottom border_right" bgcolor="#efefef">62 INSURANCE GROUP NO. </td>
			  </tr>
			  <tr>
				<td width="175" class="border_right">&nbsp;</td>
				<td width="65" class="border_right">&nbsp;</td>
				<td width="105" class="border_right">&nbsp;</td>
				<td width="100" class="border_right">&nbsp;</td>
				<td width="125" class="border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="175" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="65" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="105" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="100" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="125" class="border_bottom border_right" bgcolor="#efefef">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="175" class="border_right border_bottom">&nbsp;</td>
				<td width="65" class="border_right border_bottom">&nbsp;</td>
				<td width="105" class="border_right border_bottom">&nbsp;</td>
				<td width="100" class="border_right border_bottom">&nbsp;</td>
				<td width="125">&nbsp;</td>
			  </tr>
			</table>';
$table12 ='<table width="570" border="0">
			  <tr>
				<td width="200" class="border_bottom border_right"  bgcolor="#efefef">63 TREATMENT AUTHORIZATION CODES </td>
				<td width="200" class="border_bottom border_right"  bgcolor="#efefef">64 DOCUMENT CONTROL NUMBER </td>
				<td width="170" class="border_bottom border_right"  bgcolor="#efefef">65 EMPLOYER NAME </td>
			  </tr>
			  <tr>
				<td width="200" class="border_right">&nbsp;</td>
				<td width="200" class="border_right">&nbsp;</td>
				<td width="170" class="">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="200" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="200" class="border_right" bgcolor="#efefef">&nbsp;</td>
				<td width="170" class="" bgcolor="#efefef">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="200" class="border_right">&nbsp;</td>
				<td width="200" class="border_right">&nbsp;</td>
				<td width="170">&nbsp;</td>
			  </tr>
			</table>';
$table13 ='<table width="570" border="0">
			  <tr>
				<td width="15" class="border_bottom border_right" bgcolor="#efefef">66 DX </td>
				<td width="55" class="border_bottom border_right">&nbsp;</td>
				<td width="55" class="border_bottom border_right">&nbsp;</td>
				<td width="55" class="border_bottom border_right">&nbsp;</td>
				<td width="55" class="border_bottom border_right">&nbsp;</td>
				<td width="55" class="border_bottom border_right">&nbsp;</td>
				<td width="55" class="border_bottom border_right">&nbsp;</td>
				<td width="55" class="border_bottom border_right">&nbsp;</td>
				<td width="55" class="border_bottom border_right">&nbsp;</td>
				<td width="55" class="border_bottom border_right">&nbsp;</td>
				<td width="60" class="border_bottom border_right">68</td>
			  </tr>
			  <tr>
				<td width="15" class="border_right">&nbsp;</td>
				<td width="55" class="border_right">&nbsp;</td>
				<td width="55" class="border_right">&nbsp;</td>
				<td width="55" class="border_right">&nbsp;</td>
				<td width="55" class="border_right">&nbsp;</td>
				<td width="55" class="border_right">&nbsp;</td>
				<td width="55" class="border_right">&nbsp;</td>
				<td width="55" class="border_right">&nbsp;</td>
				<td width="55" class="border_right">&nbsp;</td>
				<td width="55" class="border_right">&nbsp;</td>
				<td width="60" class="border_right">&nbsp;</td>
			  </tr>
			</table>';
$table14 ='<table width="570" border="0">
			  <tr>
				<td width="40" class="border_bottom border_right" align="center" bgcolor="#efefef">69 ADMIT DX </td>
				<td width="85" class="border_bottom border_right">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#efefef">70 PATIENT REASON DX </td>
				<td width="40" class="border_bottom border_right">&nbsp;</td>
				<td width="40" class="border_bottom border_right">&nbsp;</td>
				<td width="40" class="border_bottom border_right">&nbsp;</td>
				<td width="40" class="border_bottom border_right" align="center" bgcolor="#efefef">71 PPS CODE </td>
				<td width="40" class="border_bottom border_right">&nbsp;</td>
				<td width="25" class="border_bottom border_right" align="center" bgcolor="#efefef">72 ECI </td>
				<td width="40" class="border_bottom border_right">&nbsp;</td>
				<td width="40" class="border_bottom border_right">&nbsp;</td>
				<td width="40" class="border_bottom border_right">&nbsp;</td>
				<td width="50" class="border_bottom">73</td>
			  </tr>
			  <tr>
				<td width="40" class="border_right" align="center">&nbsp;</td>
				<td width="85" class="border_right">&nbsp;</td>
				<td width="50" class="border_right" align="center">&nbsp;</td>
				<td width="40" class="border_right">&nbsp;</td>
				<td width="40" class="border_right">&nbsp;</td>
				<td width="40" class="border_right">&nbsp;</td>
				<td width="40" class="border_right" align="center">&nbsp;</td>
				<td width="40" class="border_right">&nbsp;</td>
				<td width="25" class="border_right" align="center">&nbsp;</td>
				<td width="40" class="border_right">&nbsp;</td>
				<td width="40" class="border_right">&nbsp;</td>
				<td width="40" class="border_right">&nbsp;</td>
				<td width="50">&nbsp;</td>
			  </tr>
			</table>';
$table15 ='<table width="395" border="0">
			  <tr>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#efefef">74</td>
				<td width="100" class="border_bottom border_right" colspan="2" align="center" bgcolor="#efefef">PRINCIPAL PROCEDURE </td>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">a</td>
				<td width="100" class="border_bottom border_right" colspan="2" align="center" bgcolor="#000000" style="color:#FFFFFF;">OTHER PROCEDURE </td>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#efefef">b</td>
				<td width="100" class="border_bottom border_right" colspan="2" align="center" bgcolor="#efefef">OTHER  PROCEDURE </td>
				<td width="65" class="border_bottom" rowspan="6" valign="top">75</td>
			  </tr>
			  <tr>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#efefef">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#efefef">CODE</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#efefef">DATE</td>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">CODE</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">DATE</td>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#efefef">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#efefef">CODE</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#efefef">DATE</td>
			  </tr>
			  <tr>
				<td width="10" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="10" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="10" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">74</td>
				<td width="100" class="border_bottom border_right" colspan="2" align="center" bgcolor="#000000" style="color:#FFFFFF;">OTHER PROCEDURE </td>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">a</td>
				<td width="100" class="border_bottom border_right" colspan="2" align="center" bgcolor="#efefef">OTHER PROCEDURE </td>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">b</td>
				<td width="100" class="border_bottom border_right" colspan="2" align="center" bgcolor="#000000" style="color:#FFFFFF;">OTHER  PROCEDURE </td>
			  </tr>
			  <tr>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">CODE</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">DATE</td>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#000000">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#efefef">CODE</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#efefef">DATE</td>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">CODE</td>
				<td width="50" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">DATE</td>
			  </tr>
			  <tr>
				<td width="10" class="border_right" align="center">&nbsp;</td>
				<td width="50" class="border_right" align="center">&nbsp;</td>
				<td width="50" class="border_right" align="center">&nbsp;</td>
				<td width="10" class="border_right" align="center">&nbsp;</td>
				<td width="50" class="border_right" align="center">&nbsp;</td>
				<td width="50" class="border_right" align="center">&nbsp;</td>
				<td width="10" class="border_right" align="center">&nbsp;</td>
				<td width="50" class="border_right" align="center">&nbsp;</td>
				<td width="50" class="border_right" align="center">&nbsp;</td>
			  </tr>
			</table>';
$table16 ='<table width="175" border="1">
			  <tr>
				<td width="55" class="border_bottom border_right" bgcolor="#efefef">76 ATTENDING </td>
				<td width="30" class="border_bottom border_right">NPL '.$npiNumber.'</td>
				<td width="25" class="border_bottom border_right" bgcolor="#efefef">QUAL</td>
				<td width="20" class="border_bottom border_right">&nbsp;</td>
				<td width="45" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="85" class="border_bottom border_right" colspan="2">LAST '.$lnameoffac.'</td>
				<td width="90" class="border_bottom border_right" colspan="3">FIRST '.$fnameoffac.'</td>
			  </tr>
			  <tr>
				<td width="55" class="border_bottom border_right" bgcolor="#efefef">77 OPERATING </td>
				<td width="30" class="border_bottom border_right">NPL '.$npiNumber.'</td>
				<td width="25" class="border_bottom border_right" bgcolor="#efefef">QUAL</td>
				<td width="20" class="border_bottom border_right">&nbsp;</td>
				<td width="45" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="85" class="border_right" colspan="2">LAST '.$lnameoffac.'</td>
				<td width="90" class="border_right" colspan="3">FIRST '.$fnameoffac.'</td>
			  </tr>
			</table>';
						
$table17 ='<table width="395" border="0">
			  <tr>
				<td width="145" class="border_bottom border_right" align="left">80 REMARKS </td>
				<td width="25" class="border_bottom border_right" align="center">81 CC a </td>
				<td width="75" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="75" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="75" class="border_bottom" align="center">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="145" class="border_bottom border_right" align="left" >&nbsp;</td>
				<td width="25" class="border_bottom border_right" align="center" bgcolor="#efefef">b</td>
				<td width="75" class="border_bottom border_right" align="center" bgcolor="#efefef">&nbsp;</td>
				<td width="75" class="border_bottom border_right" align="center" bgcolor="#efefef">&nbsp;</td>
				<td width="75" class="border_bottom" align="center">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="145" class="border_bottom border_right" align="left">&nbsp;</td>
				<td width="25" class="border_bottom border_right" align="center">c</td>
				<td width="75" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="75" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="75" class="border_bottom" align="center">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="145" class="border_right" align="left" >&nbsp;</td>
				<td width="25" class="border_right" align="center" bgcolor="#efefef">d</td>
				<td width="75" class="border_right" align="center" bgcolor="#efefef">&nbsp;</td>
				<td width="75" class="border_right" align="center" bgcolor="#efefef">&nbsp;</td>
				<td width="75" align="center">&nbsp;</td>
			  </tr>
			</table>';

$table18 ='<table width="175" border="0">
			  <tr>
				<td width="40" class="border_bottom border_right" bgcolor="#efefef">78 OTHER </td>
				<td width="25" class="border_bottom border_right">&nbsp;</td>
				<td width="30" class="border_bottom border_right">NPL '.$npiNumber.'</td>
				<td width="40" class="border_bottom border_right" bgcolor="#efefef">QUAL</td>
				<td width="20" class="border_bottom border_right">&nbsp;</td>
				<td width="20" class="border_bottom">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="95" class="border_bottom border_right" colspan="3">LAST '.$lnameoffac.'</td>
				<td width="80" class="border_bottom" colspan="3">FIRST '.$fnameoffac.'</td>
			  </tr>
			  <tr>
				<td width="40" class="border_bottom border_right" bgcolor="#efefef">79 OTHER</td>
				<td width="25" class="border_bottom border_right">&nbsp;</td>
				<td width="30" class="border_bottom border_right">NPL '.$npiNumber.'</td>
				<td width="40" class="border_bottom border_right" bgcolor="#efefef">QUAL</td>
				<td width="20" class="border_bottom border_right">&nbsp;</td>
				<td width="20" class="border_bottom">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="95" class="border_right" colspan="3">LAST '.$lnameoffac.'</td>
				<td width="80" colspan="3">FIRST '.$fnameoffac.'</td>
			  </tr>
			</table>';
$html = '<table border="1">
			<tr>
				<td width="175" colspan="2">'.$table1.'</td>
				<td width="150" colspan="2">'.$table2.'</td>
				<td width="245" colspan="2">'.$table3.'</td>
			</tr>
			<tr>
				<td width="175" colspan="2">'.$table4.'</td>
				<td width="395" colspan="4">'.$table5.'</td>
			</tr>
			<tr>
				<td width="570" colspan="6">'.$table6.'</td>
			</tr>
			<tr>
				<td width="570" colspan="6">'.$table7.'</td>
			</tr>
			<tr>
				<td width="570" colspan="6">'.$table8.'</td>
			</tr>
			<tr>
				<td width="570" colspan="6">'.$table9.'</td>
			</tr>
			<tr>
				<td width="570" colspan="6">'.$table10.'</td>
			</tr>
			<tr>
				<td width="570" colspan="6">'.$table11.'</td>
			</tr>
			<tr>
				<td width="570" colspan="6">'.$table12.'</td>
			</tr>
			<tr>
				<td width="570" colspan="6">'.$table13.'</td>
			</tr>
			<tr>
				<td width="570" colspan="6">'.$table14.'</td>
			</tr>
			<tr>
				<td width="395" colspan="4">'.$table15.'</td>
				<td width="175" colspan="2">'.$table16.'</td>
			</tr>
			<tr>
				<td width="395" colspan="4">'.$table17.'</td>
				<td width="175" colspan="2">'.$table18.'</td>
			</tr>
		</table>';
// output the HTML content

	$pdf->writeHTML($html, true, false, true, false, '');
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// reset pointer to the last page
	$pdf->lastPage();
// ---------------------------------------------------------
 $html = ob_get_clean();
 $docs = $pathofmayo."/billing/caseno-".$_REQUEST['fid']."-".date('d-m-y_h-m-s').".pdf";
//Close and output PDF document
if(isset($_REQUEST['ubgrossincome']) && $_REQUEST['ubgrossincome']!="")
{

		$totalmoney = $_REQUEST['ubgrossincome'];
}
else
{
	if($designation == '1')
		{
			$billingTemptotals = mysql_query("SELECT * , SUM(anes_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
		}
		elseif($designation == '3')
		{
			$billingTemptotals = mysql_query("SELECT * , SUM(doctor_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
		}
		elseif($designation == '4')
		{
			$billingTemptotals = mysql_query("SELECT * , SUM(facility_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
		}
		//$billingTemptotals = mysql_query("SELECT * , SUM(doctor_cost)+(doctor_price)+(facility_price)+(facility_cost)+(anes_cost)+( anes_price)) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]' AND `user_id` =$_REQUEST[uid]") or die(mysql_error());
		$billingtotals = mysql_fetch_object($billingTemptotals);
		$totalmoney  = $billingtotals->totals;
}
$checkbilling_payment_information = mysql_query("SELECT * FROM `billing_payment_information` where `form_id`='$_REQUEST[fid]'") or die(mysql_error());
if(mysql_num_rows($checkbilling_payment_information) < 1)
{
	
	$billingtotalk = mysql_query("SELECT * , SUM(doctor_price) as dp,SUM(facility_price) as fp,SUM(anes_price) as ap FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
	
	$billingT      = mysql_fetch_object($billingtotalk);
	
	$doctorprice   = $billingT->dp;
	$facilityprice = $billingT->fp;
	$anesprice     = $billingT->ap;
	
	
	$sql           = mysql_query("INSERT INTO `billing_payment_information` (`form_id`,`d_b_amount`,`m_f_b_amount`,`gross_charges`,`anes_b_amount`,`final_b_date`) VALUES ('$_REQUEST[fid]','$doctorprice','$facilityprice','$_REQUEST[ubgrossincome]','$anesprice',now())") or die(mysql_error());
	
}
$insertPdf = "INSERT INTO `final_billing` (`user_id`,`form_id`,`hire_id`,`pdf_name`,`billing_amount`,`date_time`) VALUES ('$_REQUEST[uid]','$_REQUEST[fid]','$_REQUEST[staffinfo]','caseno-".$_REQUEST['fid']."-".date('d-m-y_h-m-s').".pdf','$totalmoney',now())";
$data = mysql_query($insertPdf);	
echo $k_return_path = $pdf->Output($docs, 'F');
echo $returnpath = $_SERVER['REQUEST_URI'];
if($k_return_path == true)
{
	echo "There is something going wrong. Please Refresh the page and Try again Later. Thanks";
}
else
{
	header("refresh:0;url=$returnpath");
}

//============================================================+
// END OF FILE
//============================================================+
}
elseif(isset($_POST['generatepdf']) && $_POST['billing']=="hcfa-1500")
{
	$tcpdfpath = $pathofmayo."/mayo-admin/welcome/includes/tcpdf/examples/tcpdf_include.php";
//require_once('../includes/tcpdf/tcpdf_include.php');
require_once($tcpdfpath);

// create new PDF document
$pdf = new TCPDF('P','mm','A4', true, 'UTF-8', false);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$pdf->SetMargins(5, 5, 5);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(5);
// set font
$pdf->SetFont('dejavusans','','6.8');
// test custom bullet points for list

// add a page
$pdf->AddPage();
$informationp   = mysql_query("SELECT a.*,b.* from `plantiff_information` as a, `plantiff_case_type_info` as b WHERE a.id=b.id and a.form_id=b.form_id and a.id='$_REQUEST[uid]' && a.form_id='$_REQUEST[fid]' ") or die(mysql_error());
$infoAll        = mysql_fetch_object($informationp);
$state          = $infoAll->p_state;
$origstate      = $getdata->GetStatebyStateCode($state);
$fnameoffac     = $getdata->GetObjectById($_REQUEST['staffinfo'],"first_name");
$lnameoffac     = $getdata->GetObjectById($_REQUEST['staffinfo'],"last_name");
$fullname       = ucwords($fnameoffac)." ".ucwords($lnameoffac);
$addressoffac   = $getdata->GetObjectById($_REQUEST['staffinfo'],"address"); 
$stateoffac     = $getdata->GetObjectById($_REQUEST['staffinfo'],"state");
$origstateoffac = $getdata->GetStatebyStateCode($stateoffac);
$cityoffac      = $getdata->GetObjectById($_REQUEST['staffinfo'],"city");
$zipoffac       = $getdata->GetObjectById($_REQUEST['staffinfo'],"zip_code");
$contactoffac   = $getdata->GetObjectById($_REQUEST['staffinfo'],"contact_number");
$npiNumber      = $getdata->GetObjectById($_REQUEST['staffinfo'],"npi_number");

$dob            = $infoAll->p_d_o_b;
$dateofbirth    = date('d',strtotime($dob));
$monthofbirth   = date('m',strtotime($dob));
$yearofmonth    = date('Y',strtotime($dob)); 
$table1 = '<style>
			.border_bottom{border-bottom:0.5px solid #818181;} 
			.border_right{border-right:0.5px solid #818181;}
			.dashed-border{border-right:0.5px dashed #818181;}
			.box_dv{border:0.1px solid #000000; text-align:center;}
			.rnd_bor{border-radius:5px; border:1px solid #818181; width:50px; font-size:11px; text-align:center;}
			.bor_btm{border-bottom:0.5px dashed #818181;}
		</style>
		<table width="370" border="0">
			<tr>
				<td width="370">1500</td>
			</tr>
			<tr>
				<td width="370" style="font-size:10px;">HEALTH INSURANCE CLAIM FORM</td>
			</tr>
			<tr>
				<td width="370">APPROVED BY NATIONAL UNIFORM CLAIM COMMITTEE 08/05</td>
			</tr>
		</table>';
$table2 = '<table width="200" border="0">
				<tr>
					<td width="200">ORTHOGROUP</td>
				</tr>
				<tr>
					<td width="200">PO BOX 2311</td>
				</tr>
				<tr>
					<td width="200">ALPHARATTA, GA 30023</td>
				</tr>
			</table>';
$table3 = '<table width="370" border="0">
			  <tr>
				<td width="20" class="table-border">&nbsp;</td>
				<td width="20" class="table-border">&nbsp;</td>
				<td width="20" class="table-border">&nbsp;</td>
				<td width="310">PICA</td>
			  </tr>
			</table>';
$table4 = '<table width="200" border="0">
			  <tr>
				<td width="140" align="right">PICA</td>
				<td width="20" class="table-border">&nbsp;</td>
				<td width="20" class="table-border">&nbsp;</td>
				<td width="20" class="table-border">&nbsp;</td>
			  </tr>
			</table>';
$table5 = '<table width="370" border="0">
			   <tr>
				<td width="5" align="center">1</td>
				<td width="40" align="center">MEDICARE</td>
				<td width="15" align="center">&nbsp;</td>
				<td width="40" align="center">MEDICAID</td>
				<td width="15" align="center">&nbsp;</td>
				<td width="40" align="center">TRICARE CHAMPUS </td>
				<td width="15" align="center">&nbsp;</td>
				<td width="40" align="center">CHAMPVA</td>
				<td width="15" align="center">&nbsp;</td>
				<td width="40" align="center">GROUP HEALTH PLAN </td>
				<td width="15" align="center">&nbsp;</td>
				<td width="40" align="center">FECA BLK LUNG </td>
				<td width="15" align="center">&nbsp;</td>
				<td width="40" align="center">OTHER</td>
			  </tr>
			  <tr>
			  	<td width="5" align="center">&nbsp;</td>
				<td width="40" align="center" valign="middle" class="border_bottom" style="font-style:italic;">(Medicare #)</td>
				<td width="15" align="center" valign="bottom" class="border_bottom"><div class="box_dv">&nbsp;</div></td>
				<td width="40" align="center" valign="middle" class="border_bottom" style="font-style:italic;">(Mediciaid #)</td>
				<td width="15" align="center" valign="bottom" class="border_bottom"><div class="box_dv">&nbsp;</div></td>
				<td width="40" align="center" valign="middle" class="border_bottom" style="font-style:italic;">(Sponsor SSN) </td>
				<td width="15" align="center" valign="bottom" class="border_bottom"><div class="box_dv">&nbsp;</div></td>
				<td width="40" align="center" valign="middle" class="border_bottom" style="font-style:italic;">(Member ID#)</td>
				<td width="15" align="center" valign="bottom" class="border_bottom"><div class="box_dv">&nbsp;</div></td>
				<td width="40" align="center" valign="middle" class="border_bottom" style="font-style:italic;">(SSN or ID)</td>
				<td width="15" align="center" valign="bottom" class="border_bottom"><div class="box_dv">&nbsp;</div></td>
				<td width="40" align="center" valign="middle" class="border_bottom" style="font-style:italic;">(SSN)</td>
				<td width="15" align="center" valign="bottom" class="border_bottom"><div class="box_dv">&nbsp;</div></td>
				<td width="40" align="center" valign="middle" class="border_bottom" style="font-style:italic;">(ID)</td>
			  </tr>
			</table>';
$table6 = '<table width="200" border="0">
			  <tr>
				<td width="10">1a.</td>
				<td width="130">INSURED I.D. NUMBER </td>
				<td width="60">(For Program in item 1)</td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="190" colspan="2">&nbsp;</td>
			  </tr>
			</table>';
$table7 = '<table width="200" border="0">
			  <tr>
				<td width="200">2. PATIENT NAME (Last Name, First Name, Middle Initial) </td>
			  </tr>
			  <tr>
				<td width="200" align="center"><b>'.$infoAll->plantiff_name.'</b></td>
			  </tr>
			</table>';
$table8 = '<table width="170" border="0">
			  <tr>
				<td width="5" align="center">3.</td>
				<td width="99" colspan="3">PATIENT BIRTH DATE</td>
				<td width="66" colspan="2" align="center">SEX</td>
			  </tr>
			   <tr>
				<td width="5" align="center">&nbsp;</td>
				<td width="22" align="center">MM</td>
				<td width="22" align="center">DD</td>
				<td width="22" align="center">YY</td>
				<td width="22" align="center">M</td>
				<td align="center"><div class="box_dv">&nbsp;</div></td>
			    <td width="22" align="center">F</td>
			    <td align="center"><div class="box_dv">&nbsp;</div></td>
			  </tr>
			  <tr>
				<td width="5" align="center">&nbsp;</td>
				<td width="22" align="center">'.$monthofbirth.'</td>
				<td width="22" align="center">'.$dateofbirth.'</td>
				<td width="22" align="center">'.$yearofmonth.'</td>
				<td width="22" align="center">&nbsp;</td>
				<td align="center">&nbsp;</td>
			    <td width="22" align="center">&nbsp;</td>
			    <td align="center">&nbsp;</td>
			  </tr>
			</table>';
$table9 = '<table width="200" border="0">
			  <tr>
				<td width="200">4. INSURED NAME (Last Name, First Name, Middle Initial) </td>
			  </tr>
			  <tr>
				<td width="200">&nbsp;</td>
			  </tr>
			</table>';
$table10 = '<table width="200" border="0">
			  <tr>
				<td width="200">2. PATIENT ADDRESS (No., Street) </td>
			  </tr>
			  <tr>
				<td width="200"><b>'.$infoAll->p_address.'</b></td>
			  </tr>
			</table>';
$table11 = '<table width="170" border="0">
			  <tr>
				<td width="5">6.</td>
				<td width="165" colspan="8">PATIENT RELATIONSHIP TO INSURED</td>
			  </tr>
			    <tr>
				<td width="5">&nbsp;</td>
				<td width="22">Self</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="30">Spouse</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="22">Child</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="22">Other</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
			  </tr>
			</table>';
$table12 = '<table width="200" border="0">
			  <tr>
				<td width="200">7. INSURED ADDRESS (No., Street) </td>
			  </tr>
			  <tr>
				<td width="200">&nbsp;</td>
			  </tr>
			</table>';
$table13 = '<table width="200" border="0">
			  <tr>
				<td width="100" class="border_right">CITY</td>
				<td width="100">STATE</td>
			  </tr>
			  <tr>
				<td width="100" class="border_right"><b>'.$infoAll->p_city.'</b></td>
				<td width="100"><b>'.$origstate.'</b></td>
			  </tr>
			</table>';
$table14 = '<table width="170" border="0">
			  <tr>
				<td width="5">8</td>
				<td width="165" colspan="6" align="center">PATIENT STATUS</td>
			  </tr>
			  <tr>
				<td width="5">&nbsp;</td>
				<td width="30">Single</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="30">Married</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="30">Other</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
			  </tr>
			</table>';
$table15 = '<table width="200" border="0">
			  <tr>
				<td width="150" class="border_right">CITY</td>
				<td width="50">State</td>
			  </tr>
			  <tr>
				<td width="150">&nbsp;</td>
				<td width="50">&nbsp;</td>
			  </tr>
			</table>';
$table16 = '<table width="200" border="0">
			  <tr>
				<td width="100" class="border_right">ZIP CODE</td>
				<td width="100">TELEPHONE (Include Area Code)</td>
			  </tr>
			  <tr>
				<td width="100" class="border_right"><b>'.$infoAll->p_zip_code.'</b></td>
				<td width="100">('.$infoAll->p_mob_no.')</td>
			  </tr>
			</table>';
$table17 = '<table width="170" border="0">
			  <tr>
				<td width="40" align="center">Employed</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="40" align="center">Full-Time Student</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="40" align="center">Part-Time Student</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
			  </tr>
			</table>';
$table18 = '<table width="200" border="0">
			  <tr>
				<td width="100" class="border_right">ZIP CODE</td>
				<td width="100">TELEPHONE (Include Area Code)</td>
			  </tr>
			  <tr>
				<td width="100" class="border_right">40203</td>
				<td width="100">(&nbsp;&nbsp;&nbsp;&nbsp;)</td>
			  </tr>
			</table>';
$table19 = '<table width="200" border="0">
			  <tr>
				<td width="200">9. OTHER INSUREDS NAME (Last Name, First Name, Middle Initial)</td>
			  </tr>
			  <tr>
				<td width="200">&nbsp;</td>
			  </tr>
			</table>';
$table20 = '<table width="170" border="0">
			  <tr>
				<td width="170">10. IS PATIENT CONDITION RELATED TO:</td>
			  </tr>
			  <tr>
				<td width="170">&nbsp;</td>
			  </tr>
			</table>';
$table21 = '<table width="200" border="0">
			  <tr>
				<td width="100">11. INSURED POLICY GROUP OR FECA NUMBER</td>
			  </tr>
			  <tr>
				<td width="100">&nbsp;</td>
			  </tr>
			</table>';
$table22 = '<table width="200" border="0">
			  <tr>
				<td width="200">a. OTHER INSUREDS POLICY OR GROUP NUMBER</td>
			  </tr>
			  <tr>
				<td width="200">&nbsp;</td>
			  </tr>
			</table>';
$table23 = '<table width="170" border="0">
			  <tr>
				<td width="5">a.</td>
				<td width="165" colspan="8">EMPLOYEMENT ? (Current or Previous) </td>
			  </tr>
			  <tr>
				<td width="5">&nbsp;</td>
				<td width="20">&nbsp;</td>
				<td width="20">&nbsp;</td>
				<td width="25">YES</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20">NO</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20">&nbsp;</td>
				<td width="20">&nbsp;</td>
			  </tr>
			</table>';
$table24 = '<table width="200" border="0">
			  <tr>
				<td width="5" align="center">a.</td>
				<td width="125" colspan="3">INSURED DATE OF BIRTH </td>
				<td width="70" colspan="4" align="center">SEX</td>
			  </tr>
			  <tr>
				<td width="5" align="center">&nbsp;</td>
				<td width="40" align="center" class="dashed-border">MM</td>
				<td width="40" align="center" class="dashed-border">DD</td>
				<td width="45" align="center" class="dashed-border">YY</td>
				<td width="20" align="center">M</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20" align="center">F</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
			  </tr>
			  <tr>
				<td width="5" align="center">&nbsp;</td>
				<td width="40" align="center" class="dashed-border">&nbsp;</td>
				<td width="40" align="center" class="dashed-border">&nbsp;</td>
				<td width="45" align="center" class="dashed-border">&nbsp;</td>
				<td align="center">&nbsp;</td>
			  </tr>
			</table>';
$table25 = '<table width="200" border="0">
			  <tr>
				<td width="5" align="center">b.</td>
				<td width="125" colspan="3">OTHER INSURED DATE OF BIRTH </td>
				<td width="70" colspan="4" align="center">SEX</td>
			  </tr>
			  <tr>
				<td width="5" align="center">&nbsp;</td>
				<td width="40" align="center" class="dashed-border">MM</td>
				<td width="40" align="center" class="dashed-border">DD</td>
				<td width="45" align="center" class="dashed-border">YY</td>
				<td width="20" align="center">M</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20" align="center">F</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
			  </tr>
			  <tr>
				<td width="5" align="center">&nbsp;</td>
				<td width="40" align="center" class="dashed-border">&nbsp;</td>
				<td width="40" align="center" class="dashed-border">&nbsp;</td>
				<td width="45" align="center" class="dashed-border">&nbsp;</td>
				<td align="center">&nbsp;</td>
			  </tr>
			</table>';
$table26 = '<table width="170" border="0">
			  <tr>
				<td width="5">b.</td>
				<td width="165" colspan="8">AUTO ACCIDENT</td>
			  </tr>
			  <tr>
				<td width="5">&nbsp;</td>
				<td width="20">&nbsp;</td>
				<td width="20">&nbsp;</td>
				<td width="25">&nbsp;</td>
				<td width="20">YES</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20">NO</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20">&nbsp;</td>
			  </tr>
			</table>';
$table27 = '<table width="200" border="0">
			  <tr>
				<td width="5" align="center">b.</td>
				<td width="125" colspan="3">EMPLOYERS NAME OR SCHOOL NAME</td>
				<td width="70" colspan="4" align="center">SEX</td>
			  </tr>
			  <tr>
				<td width="5" align="center">&nbsp;</td>
				<td width="40" align="center" class="dashed-border">MM</td>
				<td width="40" align="center" class="dashed-border">DD</td>
				<td width="45" align="center">YY</td>
				<td width="20" align="center">M</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20" align="center">F</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
			  </tr>

			  <tr>
				<td width="5" align="center">&nbsp;</td>
				<td width="40" align="center" class="dashed-border">&nbsp;</td>
				<td width="40" align="center" class="dashed-border">&nbsp;</td>
				<td width="45" align="center">&nbsp;</td>
				<td width="20" align="center">&nbsp;</td>
				<td width="15" align="center">&nbsp;</td>
				<td width="20" align="center">&nbsp;</td>
				<td width="15" align="center">&nbsp;</td>
			  </tr>
			</table>';
$table28 = '<table width="200" border="0">
			  <tr>
				<td width="5" align="center">c.</td>
				<td width="195" colspan="3">EMPLOYERS NAME OR SCHOOL NAME</td>
			  </tr>
			  <tr>
				<td width="200">&nbsp;</td>
			  </tr>
			</table>';
$table29 = '<table width="170" border="0">
			  <tr>
				<td width="5">c.</td>
				<td width="165" colspan="8">OTHER ACCIDENT</td>
			  </tr>
			  <tr>
				<td width="5">&nbsp;</td>
				<td width="20">&nbsp;</td>
				<td width="20">&nbsp;</td>
				<td width="25">&nbsp;</td>
				<td width="20">YES</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20">NO</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20">&nbsp;</td>
			  </tr>
			</table>';
$table30 = '<table width="200" border="0">
			  <tr>
				<td width="5" align="center">c.</td>
				<td width="195">INSURANCE PLAN NAME OR PROGRAM NAME</td>
			  </tr>
			  <tr>
				<td width="5" align="center"></td>
				<td width="195">SELF</td>
			  </tr>
			</table>';
$table31 = '<table width="200" border="0">
			  <tr>
				<td width="200">d. INSURANCE PLAN NAME OR PROGRAM NAME</td>
			  </tr>
			  <tr>
				<td width="200">&nbsp;</td>
			  </tr>
			</table>';
$table32 = '<table width="170" border="0">
			  <tr>
				<td width="5">d.</td>
				<td width="165">RESERVED FOR LOCAL USE</td>
			  </tr>
			  <tr>
				<td width="170" colspan="2">&nbsp;</td>
			  </tr>
			</table>';
$table33 = '<table width="200" border="0">
			  <tr>
				<td width="5" align="center">d</td>
				<td width="195" colspan="5">IS THERE ANOTHER HEALTH BENEFIT PLAN ? </td>
			  </tr>
			  <tr>
				<td width="5" align="center">&nbsp;</td>
				<td width="30" align="center">&nbsp;</td>
				<td width="20" align="center">YES</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20" align="center">NO</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="95" align="center">If yes, return to &amp; compelete item 9 a-d </td>
			  </tr>
			</table>';
$table34 = '<table width="370" border="0">
			  <tr>
				<td width="10" align="center">&nbsp;</td>
				<td width="360" colspan="2"><strong>READ BACK OF FORM BEFORE COMPLETING &amp; SIGNING THIS FORM</strong></td>
			  </tr>
			  <tr>
				<td width="10" align="center">12</td>
				<td width="360" colspan="2">PATIENTS OR AUTHORIZES PERSONS SIGNATURE I authorize the release of any medical or other information necessary to process this claim. I also request payment of government benefits either to myself or to the party who accepts assignment below</td>
			  </tr>
			  <tr>
				<td width="10" align="center"></td>
				<td width="260">SIGNED ____________________</td>
				<td width="100">Date ________ </td>
			  </tr>
			</table>';
$table35 = '<table width="200" border="0">
			  <tr>
				<td width="5" align="center">b.</td>
				<td width="195">INSURED OR AUTHORIZED PERSONS SIGNATURE I authroize payment of medical benefits to the unsdersigned physician or supplier for services described below</td>
			  </tr>
			  <tr>
				<td width="5" align="center"></td>
				<td width="195">SIGNED ____________________________________ </td>
			  </tr>
			</table>';
$table36 = '<table width="200" border="0">
			  <tr>
				<td width="10">14</td>
				<td width="90" colspan="3">DATE OF CURRENT </td>
				<td width="100" rowspan="2" valign="top">ILLNESS (First symptom) OR INJURY (Accident) OR PREGNANCY (LMP)</td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="30" align="center" class="dashed-border">MM</td>
				<td width="30" align="center" class="dashed-border">DD</td>
				<td width="30" align="center">YY</td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="30">&nbsp;</td>
				<td width="30">&nbsp;</td>
				<td width="30">&nbsp;</td>
			  </tr>
			</table>';
$table37 = '<table width="170" border="0">
			  <tr>
				<td width="10">15</td>
				<td width="160" colspan="3">IF PATIENT HAS HAD SAME OR SIMILAR ILLNESS FIVE FIRST DATE</td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="40" align="center" class="dashed-border">MM</td>
				<td width="40" align="center" class="dashed-border">DD</td>
				<td width="40" align="center">YY</td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="40" align="center">&nbsp;</td>
				<td width="40" align="center">&nbsp;</td>
				<td width="40" align="center">&nbsp;</td>
			  </tr>
			</table>';
$table38 = '<table width="200" border="0">
			  <tr>
				<td width="10">16</td>
				<td width="190" colspan="8">DATES PATIENT UNABLE TO WORK IN CURRENT OCCUPATION </td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="25">FROM</td>
				<td width="25" align="center" class="dashed-border">MM</td>
				<td width="20" align="center" class="dashed-border">DD</td>
				<td width="20" align="center">YY</td>
				<td width="25">TO</td>
				<td width="25" align="center" class="dashed-border">MM</td>
				<td width="20" align="center" class="dashed-border">DD</td>
				<td width="20">YY</td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="25">&nbsp;</td>
				<td width="25">&nbsp;</td>
				<td width="20">&nbsp;</td>
				<td width="20">&nbsp;</td>
				<td width="25">&nbsp;</td>
				<td width="25">&nbsp;</td>
				<td width="20">&nbsp;</td>
				<td width="20">&nbsp;</td>
			  </tr>
			</table>';
$table39 = '<table width="200" border="0">
			  <tr>
				<td width="10">17.</td>
				<td width="190">NAME OF REFERRING PROVIDER OR OTHER SOURCE </td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="190">DR. NORMAN V LEWIS MD </td>
			  </tr>
			</table>';
$table40 = '<table width="170" border="0">
			  <tr bgcolor="#efefef">
				<td width="30" align="center" class="border_right bor_btm">17a.</td>
				<td width="30" align="center"  class="border_right bor_btm">1 G </td>
				<td width="110" align="left"  class="bor_btm"></td>
			  </tr>
			  <tr>
				<td width="30" align="center" class="border_right">17b.</td>
				<td width="30" align="center" class="border_right">NPL</td>
				<td width="110" align="left"></td>
			  </tr>
			</table>';
$table41 = '<table width="200" border="0">
			  <tr>
				<td width="10">18</td>
				<td width="190" colspan="8">HOSPITALIZATION DATES RELATED TO CURRENT SERVICES </td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="25">FROM</td>
				<td width="25" align="center" class="dashed-border">MM</td>
				<td width="20" align="center" class="dashed-border">DD</td>
				<td width="20" align="center">YY</td>
				<td width="25">TO</td>
				<td width="25" align="center" class="dashed-border">MM</td>
				<td width="20" align="center" class="dashed-border">DD</td>
				<td width="20" align="center">YY</td>
			  </tr>
			</table>';
$table42 = '<table width="370" border="0">
			  <tr>
				<td width="370">19. RESERVED FOR LOCAL USE</td>
			  </tr>
			  <tr>
				<td width="370">&nbsp;</td>
			  </tr>
			</table>';
$table43 = '<table width="200" border="0">
			  <tr>
				<td width="10">20.</td>
				<td width="130" colspan="4" align="left">OUTSIDE LAB ? </td>
				<td width="60" colspan="2" align="center">$ CHARGES </td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="30">&nbsp;</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="35">YES</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="35" class="border_right">NO</td>
				<td width="30">&nbsp;</td>
			  </tr>
			</table>';
$table44 = '<table width="370" border="0">
			  <tr>
				<td width="10">21.</td>
				<td  width="360"colspan="3">DIAGNOSIS OR NATURE OF ILLNESS OR INJURY (Relate items 1, 2, 3, or 4 item 24E by line) </td>
			  </tr>';
 		  
$table44 .=	'<tr>';
	$k = 1;
	$cptCodess = mysql_query("SELECT * FROM `billing_info` WHERE `form_id` = '$_REQUEST[fid]'") or die(mysql_error()); 
	while($cptCode = mysql_fetch_object($cptCodess))
			{
				if($k%2==1)
				{	
$table44 .=	'<td width="10">'.$k.'.</td>
			 <td width="175">'.$cptCode->cpt_code.'</td>';
				}
				$k++;
			}
$table44 .=	'</tr>';
			
$table44 .=	'<tr>';
$m=1;
$cptCodesd = mysql_query("SELECT * FROM `billing_info` WHERE `form_id` = '$_REQUEST[fid]'") or die(mysql_error()); 
	while($cptCodessd = mysql_fetch_object($cptCodesd))
			{
				if($m%2==0)
				{	
$table44 .=	'<td width="10">'.$m.'.</td>
			 <td width="175">'.$cptCodessd->cpt_code.'</td>';
				}
				$m++;
			}
$table44 .=	'</tr>';
$table44 .=	'</table>';
$table45 = '<table width="200" border="0">
			  <tr>
				<td width="10">22.</td>
				<td width="190" colspan="2">MEDICAID RESUBMISSION </td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="95" class="border_right">CODE</td>
				<td width="95">ORIGINAL REF NO.  </td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="95">&nbsp;</td>
				<td width="95">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="10">23</td>
				<td width="190"colspan="2">PRIOR AUTHORIZATION NUMBER </td>
			  </tr>
			  <tr>
				<td width="10">&nbsp;</td>
				<td width="95">&nbsp;</td>
				<td width="95">&nbsp;</td>
			  </tr>
			</table>';
$table46 = '<table width="570" border="0">
			  <tr>
				<td width="5">24</td>
				<td width="145" colspan="5" align="center" class="border_right">DATE(S) OF SERVICES </td>
				<td width="50" rowspan="3" align="center" class="border_right">B. PLACE OF SERVICE</td>
				<td width="50" rowspan="3" align="center" class="border_right">C. EMG</td>
				<td width="130" colspan="5" align="center" class="border_right">D. PROCEDURES SERVICES OR SUPPLIES </td>
				<td width="25" rowspan="3" align="center" class="border_right">E. DIAGNOSIS POINTER </td>
				<td width="40" colspan="2" rowspan="3" align="center" class="border_right">F. $ CHARGES</td>
				<td width="20" rowspan="3" align="center" class="border_right">G. DAYS OR UNITS</td>
				<td width="25" rowspan="3" align="center" class="border_right">H. EPSDIT FAMILY PLAM </td>
				<td width="20" rowspan="3" align="center" class="border_right">I ID QUAL</td>
				<td rowspan="3" width="60" align="center">J RENDERING PROVIDER ID. #</td>
			  </tr>
			  <tr>
				<td width="25">&nbsp;</td>
				<td width="25">FORM</td>
				<td width="25">&nbsp;</td>
				<td width="25">&nbsp;</td>
				<td width="25">TO</td>
				<td width="25">&nbsp;</td>
				<td width="160" colspan="5" align="center">(Explain Unusal Circumstance)</td>
			  </tr>
			  <tr>
				<td width="25" align="center">MM</td>
				<td width="25" align="center">DD</td>
				<td width="25" align="center">YY</td>
				<td width="25" align="center">MM</td>
				<td width="25" align="center">DD</td>
				<td width="25" align="center" class="border_right">YY</td>
				<td width="50" align="center">CPT/HCPCS</td>
				<td width="50" colspan="4" align="center">MODIFIER</td>
			  </tr>
			   <tr bgcolor="#efefef">
				<td width="25" align="center">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
				<td width="50" align="center">&nbsp;</td>
				<td width="50" align="center">&nbsp;</td>
				<td width="30" align="center">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
				<td width="20" align="center">&nbsp;</td>
				<td width="20" align="center">&nbsp;</td>
				<td width="20" align="center">&nbsp;</td>
				<td width="25" align="center">&nbsp;</td>
				<td width="20" align="center">&nbsp;</td>
				<td width="60" align="center">&nbsp;</td>
			  </tr>';

		if(isset($_REQUEST['hbgrossincome']) && ($_REQUEST['hbgrossincome']!=""))
		{
			$userIdds      = $_REQUEST['staffinfo'];
			$designation   = $getdata->GetObjectById($userIdds,"designation");
			$npiNumber     = $getdata->GetObjectById($userIdds,"npi_number");
			if($designation == '1')
			{
				$billingTeemptotals = mysql_query("SELECT * , anes_price AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
			}
			elseif($designation == '3')
			{
				$billingTeemptotals = mysql_query("SELECT * , doctor_price AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
			}
			elseif($designation == '4')
			{
				$billingTeemptotals = mysql_query("SELECT * , facility_price AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
			}
			$appointmentTempss = mysql_query("SELECT * FROM  `appointment_doctor` WHERE  `form_id` =  '$_REQUEST[fid]' AND  `app_type` =2 ORDER BY appt_id DESC LIMIT 0 , 1") or die(mysql_error());
			$appointmentDatass = mysql_fetch_array($appointmentTempss);


			$apptDate = $appointmentDatass->date_appt;
			$dateinArray = explode(" / ",$apptDate);
			list($apptDateonly,$appTime) = $dateinArray;
			
			$lastDate = $appointmentData->date_time;
			
			$count = mysql_num_rows($billingTeemptotals);
			$y = 0;
			
			while($billingData = mysql_fetch_object($billingTeemptotals))
			{	
				$totalTeemp = $billingData->totals;
				$tempData  = $_REQUEST['hbgrossincome'];
				list($ai,$bi)= $tempData;
				
				$table46 .='<tr>
					<td width="25" align="center" class="border_right"></td>
					<td width="25" align="center" class="border_right"></td>
					<td width="25" align="center" class="border_right"></td>
					<td width="25" align="center" class="border_right"></td>
					<td width="25" align="center" class="border_right"></td>
					<td width="25" align="center" class="border_right"></td>
					<td width="50" align="center" class="border_right">&nbsp;</td>
					<td width="50" align="center" class="border_right">&nbsp;</td>
					<td width="30" align="center" class="border_right">'.$billingData->cpt_code.'</td>
					<td width="25" align="center" class="border_right">LT</td>
					<td width="25" align="center" class="border_right">&nbsp;</td>
					<td width="25" align="center" class="border_right">&nbsp;</td>
					<td width="25" align="center" class="border_right">&nbsp;</td>
					<td width="25" align="center" class="border_right">AB</td>
					<td width="40" align="center" class="border_right">';
					 if($count==$y+1){ $table46 .= '$'.number_format($_REQUEST['hbgrossincome'],2); }
					$table46 .='</td><td width="20" align="center" class="border_right"></td>
					<td width="25" align="center" class="border_right"></td>
					<td width="20" align="center" class="border_right">NPL</td>
					<td width="60" align="center">'.$npiNumber.'</td>
				  </tr>
				   <tr bgcolor="#efefef">
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="50" align="center">&nbsp;</td>
					<td width="50" align="center">&nbsp;</td>
					<td width="30" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="20" align="center">&nbsp;</td>
					<td width="20" align="center">&nbsp;</td>
					<td width="20" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="20" align="center">&nbsp;</td>
					<td width="60" align="center">&nbsp;</td>
				  </tr>';
				$y++;
			}
		}
		else
		{
	
			$userIdds      = $_REQUEST['staffinfo'];
			$designation   = $getdata->GetObjectById($userIdds,"designation");
			$npiNumber     = $getdata->GetObjectById($userIdds,"npi_number");
			if($designation == '1')
			{
				$billingTemptotals = mysql_query("SELECT * , anes_price AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
			}
			elseif($designation == '3')
			{
				$billingTemptotals = mysql_query("SELECT * , doctor_price AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
			}
			elseif($designation == '4')
			{
				$billingTemptotals = mysql_query("SELECT * , facility_price AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
			}
			$appointmentTemp = mysql_query("SELECT * FROM  `appointment_doctor` WHERE  `form_id` =  '$_REQUEST[fid]' AND  `app_type` =2 ORDER BY appt_id DESC LIMIT 0 , 1") or die(mysql_error());
			$appointmentData = mysql_fetch_object($appointmentTemp);

			$apptDate = $appointmentData->date_appt;
			$dateinArray = explode(" / ",$apptDate);
			list($apptDateonly,$appTime) = $dateinArray;
			
			$lastDate = $appointmentData->date_time;

			while($billingData = mysql_fetch_object($billingTemptotals))
			{	
				$totalTemp = $billingData->totals;
				$tempData  = explode('.',$totalTemp);
				list($ai,$bi)= $tempData;
				$table46 .='<tr>
					<td width="25" align="center" class="border_right">'.date('m',strtotime($apptDateonly)).'</td>
					<td width="25" align="center" class="border_right">'.date('d',strtotime($apptDateonly)).'</td>
					<td width="25" align="center" class="border_right">'.date('y',strtotime($apptDateonly)).'</td>
					<td width="25" align="center" class="border_right">'.date('m',strtotime($lastDate)).'</td>
					<td width="25" align="center" class="border_right">'.date('d',strtotime($lastDate)).'</td>
					<td width="25" align="center" class="border_right">'.date('y',strtotime($lastDate)).'</td>
					<td width="50" align="center" class="border_right">&nbsp;</td>
					<td width="50" align="center" class="border_right">&nbsp;</td>
					<td width="30" align="center" class="border_right">'.$billingData->cpt_code.'</td>
					<td width="25" align="center" class="border_right">LT</td>
					<td width="25" align="center" class="border_right">&nbsp;</td>
					<td width="25" align="center" class="border_right">&nbsp;</td>
					<td width="25" align="center" class="border_right">&nbsp;</td>
					<td width="25" align="center" class="border_right">AB</td>
					<td width="20" align="center" class="border_right">'.number_format($ai,0).'</td>
					<td width="20" align="center" class="border_right">'.$bi.'</td>
					<td width="20" align="center" class="border_right">1</td>
					<td width="25" align="center" class="border_right">&nbsp;</td>
					<td width="20" align="center" class="border_right">NPL</td>
					<td width="60" align="center">'.$npiNumber.'</td>
				  </tr>
				   <tr bgcolor="#efefef">
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="50" align="center">&nbsp;</td>
					<td width="50" align="center">&nbsp;</td>
					<td width="30" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="20" align="center">&nbsp;</td>
					<td width="20" align="center">&nbsp;</td>
					<td width="20" align="center">&nbsp;</td>
					<td width="25" align="center">&nbsp;</td>
					<td width="20" align="center">&nbsp;</td>
					<td width="60" align="center">&nbsp;</td>
				  </tr>';
			}
		}
		$table46 .='<tr>
			<td width="25" align="center">&nbsp;</td>
			<td width="25" align="center">&nbsp;</td>
			<td width="25" align="center">&nbsp;</td>
			<td width="25" align="center">&nbsp;</td>
			<td width="25" align="center">&nbsp;</td>
			<td width="25" align="center">&nbsp;</td>
			<td width="50" align="center">&nbsp;</td>
			<td width="50" align="center">&nbsp;</td>
			<td width="30" align="center">&nbsp;</td>
			<td width="25" align="center">&nbsp;</td>
			<td width="25" align="center">&nbsp;</td>
			<td width="25" align="center">&nbsp;</td>
			<td width="25" align="center">&nbsp;</td>
			<td width="25" align="center">&nbsp;</td>
			<td width="20" align="center">&nbsp;</td>
			<td width="20" align="center">&nbsp;</td>
			<td width="20" align="center">&nbsp;</td>
			<td width="25" align="center">&nbsp;</td>
			<td width="20" align="center">&nbsp;</td>
			<td width="60" align="center">&nbsp;</td>
		  </tr>
		</table>';
$table47 = '<table width="200" border="0">
			  <tr>
				<td width="170">25. FEDERAL TAX. I.D. NUMBER </td>
				<td width="15">SSN</td>
				<td width="15">EIN</td>
			  </tr>
			  <tr>
				<td width="170"></td>
				<td width="15"><div class="box_dv">&nbsp;</div></td>
				<td width="15"><div class="box_dv">&nbsp;</div></td>
			  </tr>
			</table>';
$table48 = '<table width="170" border="0">
			  <tr>
				<td width="100">26. PATIENT ACCOOUNT NO. </td>
				<td width="70" colspan="4">27. ACCEPT ASSIGNMENT </td>
			  </tr>
			  <tr>
				<td width="100" >776188</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20">YES</td>
				<td width="10"><div class="box_dv">&nbsp;</div></td>
				<td width="20">NO</td>
			  </tr>
			</table>';
	
	if(isset($_REQUEST['hbgrossincome']) && ($_REQUEST['hbgrossincome']!=""))
	{

		$table49 = '<table width="200" border="0">
				  <tr>
					<td width="70" colspan="2" align="center" class="border_right">29. TOTAL CHARGES </td>
					<td width="60" colspan="2" align="center" class="border_right">29. AMOUNT PAID </td>
					<td width="70" colspan="2" align="center">30. BALANCE DUE </td>
				  </tr>
				  <tr>
					<td width="70" class="dashed-border" align="center">$'.number_format($_REQUEST['hbgrossincome'],2).'</td>
					
					<td width="60" class="dashed-border" align="center">$0.00</td>
					
					<td width="70" class="dashed-border" align="center">$'.number_format($_REQUEST['hbgrossincome'],2).'</td>
					
				  </tr>
				</table>';
	}
	else
	{
		if($designation == '1')
		{
			$billingTemptotals = mysql_query("SELECT * , SUM(anes_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
		}
		elseif($designation == '3')
		{
			$billingTemptotals = mysql_query("SELECT * , SUM(doctor_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
		}
		elseif($designation == '4')
		{
			$billingTemptotals = mysql_query("SELECT * , SUM(facility_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
		}
		
		$totalPayment = mysql_fetch_object($billingTemptotals);
		$table49 = '<table width="200" border="0">
				  <tr>
					<td width="70" colspan="2" align="center" class="border_right">29. TOTAL CHARGES </td>
					<td width="60" colspan="2" align="center" class="border_right">29. AMOUNT PAID </td>
					<td width="70" colspan="2" align="center">30. BALANCE DUE </td>
				  </tr>
				  <tr>
					<td width="70" class="dashed-border" align="center">$'.number_format($totalPayment->totals,2).'</td>
					
					<td width="60" class="dashed-border" align="center">$0.00</td>
					
					<td width="70" class="dashed-border" align="center">$'.number_format($totalPayment->totals,2).'</td>
					
				  </tr>
				</table>';
	}
$table50 = '<table width="200" border="0">
			  <tr>
				<td width="200" colspan="2">31. SIGNATURE OF PHYSICIAN OR SUPPILER INCLUDING DRGREES OR CREDENTIALS (I certify that the statements on the reverse apply to this bill and are made a part there of.)</td>
			  </tr>
			  <tr>
				<td width="100">&nbsp;</td>
				<td width="100">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="100">SIGNED</td>
				<td width="100">DATE</td>
			  </tr>
			</table>';
$table51 = '<table width="170" border="0">
			  <tr>
				<td width="170" colspan="2">32. SERVICE FACILITY LOCATION INFORMATION</td>
			  </tr>
			  <tr>
				<td width="170" colspan="2">'.$infoAll->p_address.'&nbsp;'.$origstate.'&nbsp;'.$infoAll->p_city.',&nbsp;'.$infoAll->p_zip_code.'<br/>
				Mob. No.'.$infoAll->p_mob_no.'<br/>Office. No.'.$infoAll->p_office_no.'</td>
			  </tr>
			  <tr>
				<td width="85">1407965015</td>
				<td width="85" bgcolor="#efefef"> DR. '.$fullname.'</td>
			  </tr>
			</table>';
$table52 = '<table width="200" border="0">
			  <tr>
				<td width="100">BILLING PROVIDER INFO &amp; PH #</td>
				<td width="100"> 866 411-2525</td>
			  </tr>
			  <tr>
				<td width="200" colspan="2">ORTHOGROUP P O BOX 2311 ALPHRETTA, GA 30023</td>
			  </tr>
			  <tr>
				<td width="100">a.</td>
				<td width="100" bgcolor="#efefef">b.</td>
			  </tr>
			</table>';
$html = '<table width="570" border="0.5">
			<tr>
				<td width="370" colspan="2">'.$table1.'</td>
				<td width="200">'.$table2.'</td>
			</tr>
			<tr>
				<td width="370" colspan="2">'.$table3.'</td>
				<td width="200">'.$table4.'</td>
			</tr>
			<tr>
				<td width="370" colspan="2">'.$table5.'</td>
				<td width="200">'.$table6.'</td>
			</tr>
			<tr>
				<td width="200">'.$table7.'</td>
				<td width="170">'.$table8.'</td>
				<td width="200">'.$table9.'</td>
			</tr>
			<tr>
				<td width="200">'.$table10.'</td>
				<td width="170">'.$table11.'</td>
				<td width="200">'.$table12.'</td>
			</tr>
			<tr>
				<td width="200">'.$table13.'</td>
				<td width="170">'.$table14.'</td>
				<td width="200">'.$table15.'</td>
			</tr>
			<tr>
				<td width="200">'.$table16.'</td>
				<td width="170">'.$table17.'</td>
				<td width="200">'.$table18.'</td>
			</tr>
			<tr>
				<td width="200">'.$table19.'</td>
				<td width="170">'.$table20.'</td>
				<td width="200">'.$table21.'</td>
			</tr>
			<tr>
				<td width="200">'.$table22.'</td>
				<td width="170">'.$table23.'</td>
				<td width="200">'.$table24.'</td>
			</tr>
			<tr>
				<td width="200">'.$table25.'</td>
				<td width="170">'.$table26.'</td>
				<td width="200">'.$table27.'</td>
			</tr>
			<tr>
				<td width="200">'.$table28.'</td>
				<td width="170">'.$table29.'</td>
				<td width="200">'.$table30.'</td>
			</tr>
			<tr>
				<td width="200">'.$table31.'</td>
				<td width="170">'.$table32.'</td>
				<td width="200">'.$table33.'</td>
			</tr>
			<tr>
				<td width="370">'.$table34.'</td>
				<td width="200">'.$table35.'</td>
			</tr>
			<tr>
				<td width="200">'.$table36.'</td>
				<td width="170">'.$table37.'</td>
				<td width="200">'.$table38.'</td>
			</tr>
			<tr>
				<td width="200">'.$table39.'</td>
				<td width="170">'.$table40.'</td>
				<td width="200">'.$table41.'</td>
			</tr>
			<tr>
				<td width="370" colspan="2">'.$table42.'</td>
				<td width="200">'.$table43.'</td>
			</tr>
			<tr>
				<td width="370" colspan="2">'.$table44.'</td>
				<td width="200">'.$table45.'</td>
			</tr>
			<tr>
				<td width="570" colspan="3">'.$table46.'</td>
			</tr>
			<tr>
				<td width="200">'.$table47.'</td>
				<td width="170">'.$table48.'</td>
				<td width="200">'.$table49.'</td>
			</tr>
			<tr>
				<td width="200">'.$table50.'</td>
				<td width="170">'.$table51.'</td>
				<td width="200">'.$table52.'</td>
			</tr>
		</table>';
// output the HTML content

	$pdf->writeHTML($html, true, false, true, false, '');
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// reset pointer to the last page
	$pdf->lastPage();
// ---------------------------------------------------------
 $html = ob_get_clean();
 $docs = $pathofmayo."/billing/caseno-".$_REQUEST['fid']."-".date('d-m-y_h-m-s').".pdf";
//Close and output PDF document
if(isset($_REQUEST['ubgrossincome']) && $_REQUEST['ubgrossincome']!="")
{

		$totalmoney = $_REQUEST['hbgrossincome'];
}
else
{
	if($designation == '1')
		{
			$billingTemptotals = mysql_query("SELECT * , SUM(anes_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
		}
		elseif($designation == '3')
		{
			$billingTemptotals = mysql_query("SELECT * , SUM(doctor_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
		}
		elseif($designation == '4')
		{
			$billingTemptotals = mysql_query("SELECT * , SUM(facility_price) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
		}
		//$billingTemptotals = mysql_query("SELECT * , SUM(doctor_cost)+(doctor_price)+(facility_price)+(facility_cost)+(anes_cost)+( anes_price)) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]' AND `user_id` =$_REQUEST[uid]") or die(mysql_error());
		$billingtotals = mysql_fetch_object($billingTemptotals);
		$totalmoney  = $billingtotals->totals;
}
$checkbilling_payment_information = mysql_query("SELECT * FROM `billing_payment_information` where `form_id`='$_REQUEST[fid]'") or die(mysql_error());
if(mysql_num_rows($checkbilling_payment_information)<1)
{
	
	$billingtotalk = mysql_query("SELECT * , SUM(doctor_price) as dp,SUM(facility_price) as fp,SUM(anes_price) as ap FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]'") or die(mysql_error());
	
	$billingT      = mysql_fetch_object($billingtotalk);
	
	$doctorprice   = $billingT->dp;
	$facilityprice = $billingT->fp;
	$anesprice     = $billing->ap;
	
	
	$sql           = mysql_query("INSERT INTO `billing_payment_information` (`form_id`,`d_b_amount`,`m_f_b_amount`,`gross_charges`,`anes_b_amount`,`final_b_date`) VALUES ('$_REQUEST[fid]','$doctorprice','$facilityprice','$_REQUEST[hbgrossincome]','$anesprice',now())") or die(mysql_error());
	
}

$insertPdf = "INSERT INTO `final_billing` (`user_id`,`form_id`,`hire_id`,`pdf_name`,`billing_amount`,`date_time`) VALUES ('$_REQUEST[uid]','$_REQUEST[fid]','$_REQUEST[staffinfo]','caseno-".$_REQUEST['fid']."-".date('d-m-y_h-m-s').".pdf','$totalmoney',now())";
$data = mysql_query($insertPdf);
echo $k_return_path = $pdf->Output($docs, 'F');
echo $returnpath = $_SERVER['REQUEST_URI'];
if($k_return_path == true)
{
	echo "There is something going wrong. Please Refresh the page and Try again Later. Thanks";
}
else
{
	header("refresh:0;url=$returnpath");
}
}
?>

