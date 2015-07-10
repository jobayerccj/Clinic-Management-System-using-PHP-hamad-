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
 include($config);
?>
<style>
.mess_msg_form_div{width: 100%;
	overflow: hidden;
	margin-bottom: 5px;
	padding:10px 0;
}
.mess_msg_lft {
	width: 2%;
	float: left;
}
.mess_msg_rgt {
	width: 80%;
	float: left;
	padding-left: 2px;
	border-left:1px solid #1b86e3;
}

.mess_msg_rgt label{border-left: 2px solid #f68220;}

.back_btn_area{width:12%;}
.back_btn {
    background-color: #FF8F22;
    border: medium none;
    border-radius: 4px 4px 4px 4px;
    color: #FFFFFF;
    cursor: pointer;
    font-family: 'open_sansregular';
    font-size: 16px;
    margin: 10px 0;
    padding: 10px;
    text-decoration: none;
	width:100%;
}
</style>
<div class="attorney_client_info"><h1>Select the Form to generate the final billling</h1></div>
<form name="form1" method="post" action="">
	<div class="mess_msg_form_div">
	<div class="mess_msg_lft"><input type="radio" name="billing" value="ub-04" checked /></div>
	<div class="mess_msg_rgt"><label>Generate Bill Using UB-04</label></div>
	</div>
	<div class="mess_msg_form_div">
	<div class="mess_msg_lft"><input type="radio" name="billing" value="hcfa-1500"/></div>
	<div class="mess_msg_rgt"><label>Generate Bill Using HCFA</label></div>
	</div>
	<div class="back_btn_area"><input type="submit" name="generatepdf" value="Generate Pdf" class="back_btn" /></div>
</form>
<?php
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
$pdf->SetMargins(5, 5, 5);
$pdf->SetHeaderMargin(5);
$pdf->SetFooterMargin(5);
// set font
$pdf->SetFont('dejavusans','','7');
// test custom bullet points for list

// add a page
$pdf->AddPage();

$informationp = mysql_query("SELECT a.*,b.* from `plantiff_information` as a, `plantiff_case_type_info` as b WHERE a.id=b.id and a.form_id=b.form_id and a.id='$_REQUEST[uid]' && a.form_id='$_REQUEST[fid]' ") or die(mysql_error());
$infoAll      = mysql_fetch_object($informationp);
$state        = $infoAll->p_state;
$origstate    = $getdata->GetStatebyStateCode($state);
$table1 = '<style>
			.table-border{border:0.5px solid #000;}
			.border_bottom{border-bottom:0.5px solid #000;} 
			.border_right{border-right:0.5px solid #000;}
		</style>
		<table>
			<tr>
				<td class="border_bottom">1 BANNER SURGICAL </td>
			</tr>
			<tr>
				<td class="border_bottom">3600 DALLAS HIGHWAY </td>
			</tr>
			<tr>
				<td class="border_bottom">SUITE 230-282 </td>
			</tr>
			<tr>
				<td class="border_bottom">MARIETTA, GA 30064 </td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>';
$table2 = '<table>
				<tr>
					<td class="border_bottom">2 866-411-2525 PHONE </td>
				</tr>
				<tr>
					<td class="border_bottom">800-865-8691 FAX </td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			</table>';
$table3 = '<table>
				<tr>
					<td class="border_bottom border_right">3a PAT. CNTL# </td>
					<td colspan="2" class="border_bottom border_right">&nbsp;</td>
					<td bgcolor="#000000" style="color:#FFFFFF;">4 TYPE OF BILL </td>
				</tr>
				<tr>
					<td class="border_bottom border_right">b.MED REC # </td>
					<td colspan="2" class="border_bottom border_right">&nbsp;</td>
					<td class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td class="border_bottom border_right">5 FEED TAX No. </td>
					<td colspan="2" class="border_bottom border_right">6 STATEMENT COVERS PERIOD </td>
					<td rowspan="3" valign="top">7</td>
				</tr>
				<tr>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_bottom border_right">FROM</td>
					<td align="center" class="border_bottom border_right">THROUGH</td>
				</tr>
				<tr>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center" class="border_right">&nbsp;</td>
					<td align="center">&nbsp;</td>
				</tr>
			</table>';
$table4 = '<table width="170">
				<tr>
					<td width="9" class="border_bottom border_right" align="center">8</td>
					<td width="99" class="border_bottom border_right">PATIENT NAME </td>
					<td width="17" class="border_bottom border_right" align="center">a</td>
					<td width="50" class="border_bottom" align="center"></td>
				</tr>
				<tr>
					<td class="border_right" align="center">b</td>
					<td colspan="3">'.$infoAll->plantiff_name.'</td>
				</tr>
			</table>';
$table5 = '<table width="395">
				<tr>
					<td width="10" align="center" class="border_bottom border_right">8</td>
					<td width="160" class="border_bottom border_right">PATIENT ADDRESS </td>
					<td width="10" align="center" class="border_bottom border_right">a</td>
					<td width="215" colspan="5" class="border_bottom border_right" align="center">&nbsp;</td>
				</tr>
				<tr>
					<td width="10" class="border_right" align="center">b</td>
					<td width="160" class="border_right border_right">'.$infoAll->p_city.'</td>
					<td width="10" class="border_right" align="center">c</td>
					<td width="65" align="center" class="border_right">&nbsp;</td>
					<td width="10" align="center" class="border_right">d</td>
					<td width="65" align="center" class="border_right">&nbsp;</td>
					<td width="10" align="center" class="border_right">e</td>
					<td width="65" align="center" class="border_right">&nbsp;</td>
				</tr>
			</table>';
$table6 = '<table width="570">
				<tr>
					<td width="70" class="border_bottom border_right" valign="middle">10 BIRTHDATE</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">11 SEX </td>
					<td width="110" colspan="4" align="center" class="border_bottom border_right" valign="middle">ADMISSION</td>
					<td width="25" rowspan="2" align="center" class="border_bottom border_right" style="display:block; padding:10px 0px 0px 0px; vertical-align:middle;">16 DHR </td>
					<td width="25" rowspan="2" align="center" class="border_bottom border_right" valign="middle">17 SAT </td>
					<td width="275" colspan="11" align="center" class="border_bottom border_right" valign="middle">CONDITION CODES </td>
					<td width="20" rowspan="2" align="center" class="border_bottom border_right" valign="middle">29 ACDT STATE </td>
					<td width="20" rowspan="2" align="center" class="border_bottom border_right" valign="middle">30</td>
				</tr>
				<tr>
					<td width="70" align="center" class="border_bottom border_right" valign="middle">'.$infoAll->p_d_o_b.'</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
					<td width="35" align="center" class="border_bottom border_right" valign="middle">12 Date</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">13 HR </td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">14 TYPE </td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">15 SRC </td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">18</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">19</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">20</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">21</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">22</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">23</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">24</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">25</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">26</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">27</td>
					<td width="25" align="center" class="border_bottom border_right" valign="middle">28</td>
				</tr>
				<tr>
					<td width="70" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
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
					<td colspan="2" align="center" class="border_bottom border_right">31 OCCURRENCE</td>
					<td colspan="2" align="center" class="border_bottom border_right">32 OCCURRENCE</td>
					<td colspan="2" align="center" class="border_bottom border_right">33 OCCURRENCE</td>
					<td colspan="2" align="center" class="border_bottom border_right">34 OCCURRENCE</td>
					<td colspan="3" align="center" class="border_bottom border_right">35 OCCURRENCE</td>
					<td colspan="3" align="center" class="border_bottom">36 OCCURRENCE </td>
					<td>37</td>
				</tr>
				<tr>
					<td align="center" class="border_bottom border_right">CODE</td>
					<td align="center" class="border_bottom border_right">DATE</td>
					<td align="center" class="border_bottom border_right">CODE</td>
					<td align="center" class="border_bottom border_right">DATE</td>
					<td align="center" class="border_bottom border_right">CODE</td>
					<td align="center" class="border_bottom border_right">DATE</td>
					<td align="center" class="border_bottom border_right">CODE</td>
					<td align="center" class="border_bottom border_right">DATE</td>
					<td align="center" class="border_bottom border_right">CODE</td>
					<td align="center" class="border_bottom border_right">FROM</td>
					<td align="center" class="border_bottom border_right">THROUGH</td>
					<td align="center" class="border_bottom border_right">CODE  </td>
					<td align="center" class="border_bottom border_right">FROM</td>
					<td align="center" class="border_bottom border_right">THROUGH</td>
					<td align="center" class="border_bottom border_right">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" class="border_right">CODE</td>
					<td align="center" class="border_right">DATE</td>
					<td align="center" class="border_right">CODE</td>
					<td align="center" class="border_right">DATE</td>
					<td align="center" class="border_right">CODE</td>
					<td align="center" class="border_right">DATE</td>
					<td align="center" class="border_right">CODE</td>
					<td align="center" class="border_right">DATE</td>
					<td align="center" class="border_right">CODE</td>
					<td align="center" class="border_right">FROM</td>
					<td align="center" class="border_right">THROUGH</td>
					<td align="center" class="border_right">CODE  </td>
					<td align="center" class="border_right">FROM</td>
					<td align="center" class="border_right">THROUGH</td>
					<td align="center">&nbsp;</td>
				</tr>
			</table>';
$table8 = '<table width="570">
			  <tr>
				<td width="150" rowspan="6" valign="top" class="border_bottom border_right">
				'.$infoAll->p_address.'&nbsp;'.$origstate.'&nbsp;'.$infoAll->p_city.'&nbsp;'.$infoAll->p_zip_code.'<br/>
				Mob. No.'.$infoAll->p_mob_no.'<br/>Office. No.'.$infoAll->p_office_no.'</td>
				<td width="15" class="border_bottom border_right">&nbsp;</td>
				<td width="135" colspan="3" align="center" class="border_bottom border_right">VALUE CODES </td>
				<td width="135" colspan="3" align="center" class="border_bottom border_right">VALUE CODES</td>
				<td width="135" colspan="3" align="center" class="border_bottom border_right">VALUE CODES</td>
			  </tr>
			  <tr>
				<td width="15" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">CODE</td>
				<td width="75" align="center" class="border_bottom border_right">AMOUNT</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">CODE</td>
				<td width="75" align="center" class="border_bottom border_right">AMOUNT</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">CODE</td>
				<td width="75" align="center" class="border_bottom border_right">AMONT</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="15" align="center" class="border_bottom border_right">a</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="75" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="75" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center"class="border_bottom border_right">&nbsp;</td>
				<td width="75" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="15" align="center" class="border_bottom border_right">b</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="75" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="75" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="75" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="15" align="center" class="border_bottom border_right">d</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="75" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="75" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="75" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="25" align="center" class="border_bottom border_right">&nbsp;</td>
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
				<td width="25" align="center">&nbsp;</td>
			  </tr>
			</table>';
$table9 = '<table width="570">';
$table9 .='<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">42 REV. CD. </td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">43 DESCRIPTION</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">44 HCPCS / RATE / HIPPS CODE </td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">45 SERV. DATE </td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">45 SERV. UNITS </td>
					<td width="100" align="center" colspan="2" valign="middle" class="border_bottom border_right">47 TOTAL CHARGES </td>
					<td width="100" align="center" colspan="2" valign="middle" class="border_bottom border_right">48 NON-COVERED CHARGES </td>
					<td width="25" align="center" class="border_bottom">49</td>
				</tr>';
$billingTemp = mysql_query("SELECT * , SUM((doctor_cost)+(doctor_price)+(facility_price)+(facility_cost)+(anes_cost)+( anes_price)) AS `total` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]' AND `user_id` =$_REQUEST[uid] GROUP BY `billing_id`") or die(mysql_error());
while($billingfinal = mysql_fetch_object($billingTemp))
{
	$table9 .= '<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">'.$billingfinal->cpt_code.'</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">'.$billingfinal->description.'</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">'.$billingfinal->cpt_code.'</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">'.$billingfinal->date_bill.'</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">'.number_format($billingfinal->total,2).'</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>';
}

$billingTemptotal = mysql_query("SELECT * , SUM((doctor_cost)+(doctor_price)+(facility_price)+(facility_cost)+(anes_cost)+( anes_price)) AS `totals` FROM `billing_info` WHERE `form_id` ='$_REQUEST[fid]' AND `user_id` =$_REQUEST[uid]") or die(mysql_error());
$billingtotal = mysql_fetch_object($billingTemptotal);

$table9 .='<tr>
			<td width="25" align="center" valign="middle" class="border_right">&nbsp;</td>
			<td width="175" align="center" valign="middle" class="border_right">Page _________ of _______</td>
			<td width="65" align="center" valign="middle" class="border_right">CREATION DATE</td>
			<td width="40" align="center" valign="middle" class="border_right">'.date('d/m/Y').'</td>
			<td width="40" align="center" valign="middle" class="border_right">TOTAL</td>
			<td width="60" align="center" valign="middle" class="border_right">'.number_format($billingtotal->totals,2).'</td>
			<td width="40" align="center" valign="middle" class="border_right">00</td>
			<td width="60" align="center" valign="middle" class="border_right">0</td>
			<td width="40" align="center" valign="middle" class="border_right">00</td>
			<td width="25" align="center" valign="middle">&nbsp;</td>
		</tr>';
$table9 .= '</table>';

$table10 = '<table width="570" border="0">
			  <tr>
				<td width="150" align="left" class="border_bottom border_right">50 PAYER NAME </td>
				<td width="60" align="center" class="border_bottom border_right">51 HEALTH PLAN ID </td>
				<td width="35" align="center" class="border_bottom border_right">52 REL INFO </td>
				<td width="15" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">53 ASG. BEN </td>
				<td width="80" align="center" class="border_bottom border_right" colspan="2">54 PRIOR PAYMENT </td>
				<td width="80" align="center" class="border_bottom border_right" colspan="2">55 EST. AMOUNT DUE </td>
				<td width="50" align="center" class="border_bottom border_right" >56 NPL </td>
				<td width="65" align="center" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="150" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="60" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="15" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="50" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="30" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="50" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="30" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="50" align="center" class="border_bottom border_right">57</td>
				<td width="65" align="center" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="150" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="60" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="15" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="35" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="50" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="30" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="50" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="30" align="center" class="border_bottom border_right">&nbsp;</td>
				<td width="50" align="center" class="border_bottom border_right">OTHER</td>
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
				<td width="50" align="center" class="border_right">PRV ID </td>
				<td width="65" align="center">&nbsp;</td>
			  </tr>
			</table>';
$table11 = '<table width="570" border="0">
			  <tr>
				<td width="175" class="border_bottom border_right">58 INSUREDS NAME </td>
				<td width="65" class="border_bottom border_right">59 P. REL </td>
				<td width="105" class="border_bottom border_right">60 INSUREDS UNIQUE ID </td>
				<td width="100" class="border_bottom border_right">61 GROUP NAME </td>
				<td width="125" class="border_bottom border_right">62 INSURANCE GROUP NO. </td>
			  </tr>
			  <tr>
				<td width="175" class="border_bottom border_right">&nbsp;</td>
				<td width="65" class="border_bottom border_right">&nbsp;</td>
				<td width="105" class="border_bottom border_right">&nbsp;</td>
				<td width="100" class="border_bottom border_right">&nbsp;</td>
				<td width="125" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="175" class="border_bottom border_right">&nbsp;</td>
				<td width="65" class="border_bottom border_right">&nbsp;</td>
				<td width="105" class="border_bottom border_right">&nbsp;</td>
				<td width="100" class="border_bottom border_right">&nbsp;</td>
				<td width="125" class="border_bottom">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="175" class="border_right">&nbsp;</td>
				<td width="65" class="border_right">&nbsp;</td>
				<td width="105" class="border_right">&nbsp;</td>
				<td width="100" class="border_right">&nbsp;</td>
				<td width="125">&nbsp;</td>
			  </tr>
			</table>';
$table12 ='<table width="570" border="0">
			  <tr>
				<td width="200" class="border_bottom border_right">63 TREATMENT AUTHORIZATION CODES </td>
				<td width="200" class="border_bottom border_right">64 DOCUMENT CONTROL NUMBER </td>
				<td width="170" class="border_bottom">65 EMPLOYER NAME </td>
			  </tr>
			  <tr>
				<td width="200" class="border_bottom border_right">&nbsp;</td>
				<td width="200" class="border_bottom border_right">&nbsp;</td>
				<td width="170" class="border_bottom">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="200" class="border_bottom border_right">&nbsp;</td>
				<td width="200" class="border_bottom border_right">&nbsp;</td>
				<td width="170" class="border_bottom">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="200" class="border_right">&nbsp;</td>
				<td width="200" class="border_right">&nbsp;</td>
				<td width="170">&nbsp;</td>
			  </tr>
			</table>';
$table13 ='<table width="570" border="0">
			  <tr>
				<td width="15" class="border_bottom border_right">66 DX </td>
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
				<td width="40" class="border_bottom border_right" align="center">69 ADMIT DX </td>
				<td width="85" class="border_bottom border_right">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">70 PATIENT REASON DX </td>
				<td width="40" class="border_bottom border_right">&nbsp;</td>
				<td width="40" class="border_bottom border_right">&nbsp;</td>
				<td width="40" class="border_bottom border_right">&nbsp;</td>
				<td width="40" class="border_bottom border_right" align="center">71 PPS CODE </td>
				<td width="40" class="border_bottom border_right">&nbsp;</td>
				<td width="25" class="border_bottom border_right" align="center">72 ECI </td>
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
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#cccccc" style="color:#000000;">74</td>
				<td width="100" class="border_bottom border_right" colspan="2" align="center" bgcolor="#CCCCCC" style="color:#000000;">PRINCIPAL PROCEDURE </td>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">a</td>
				<td width="100" class="border_bottom border_right" colspan="2" align="center" bgcolor="#000000" style="color:#FFFFFF;">OTHER PROCEDURE </td>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#cccccc" style="color:#000000;">b</td>
				<td width="100" class="border_bottom border_right" colspan="2" align="center" bgcolor="#cccccc" style="color:#000000;">OTHER  PROCEDURE </td>
				<td width="65" class="border_bottom" rowspan="6" valign="top">75</td>
			  </tr>
			  <tr>
				<td width="10" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">CODE</td>
				<td width="50" class="border_bottom border_right" align="center">DATE</td>
				<td width="10" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">CODE</td>
				<td width="50" class="border_bottom border_right" align="center">DATE</td>
				<td width="10" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">CODE</td>
				<td width="50" class="border_bottom border_right" align="center">DATE</td>
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
				<td width="100" class="border_bottom border_right" colspan="2" align="center" bgcolor="#cccccc" style="color:#000000;">OTHER PROCEDURE </td>
				<td width="10" class="border_bottom border_right" align="center" bgcolor="#000000" style="color:#FFFFFF;">b</td>
				<td width="100" class="border_bottom border_right" colspan="2" align="center" bgcolor="#000000" style="color:#FFFFFF;">OTHER  PROCEDURE </td>
			  </tr>
			  <tr>
				<td width="10" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">CODE</td>
				<td width="50" class="border_bottom border_right" align="center">DATE</td>
				<td width="10" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">CODE</td>
				<td width="50" class="border_bottom border_right" align="center">DATE</td>
				<td width="10" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="50" class="border_bottom border_right" align="center">CODE</td>
				<td width="50" class="border_bottom border_right" align="center">DATE</td>
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
				<td width="55" class="border_bottom border_right">76 ATTENDING </td>
				<td width="30" class="border_bottom border_right">NPL</td>
				<td width="25" class="border_bottom border_right">QUAL</td>
				<td width="20" class="border_bottom border_right">&nbsp;</td>
				<td width="45" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="85" class="border_bottom border_right" colspan="2">LAST</td>
				<td width="90" class="border_bottom border_right" colspan="3">FIRST</td>
			  </tr>
			  <tr>
				<td width="55" class="border_bottom border_right">77 OPERATING </td>
				<td width="30" class="border_bottom border_right">NPL</td>
				<td width="25" class="border_bottom border_right">QUAL</td>
				<td width="20" class="border_bottom border_right">&nbsp;</td>
				<td width="45" class="border_bottom border_right">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="85" class="border_right" colspan="2">LAST</td>
				<td width="90" class="border_right" colspan="3">FIRST</td>
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
				<td width="145" class="border_bottom border_right" align="left">&nbsp;</td>
				<td width="25" class="border_bottom border_right" align="center">b</td>
				<td width="75" class="border_bottom border_right" align="center">&nbsp;</td>
				<td width="75" class="border_bottom border_right" align="center">&nbsp;</td>
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
				<td width="145" class="border_right" align="left">&nbsp;</td>
				<td width="25" class="border_right" align="center">d</td>
				<td width="75" class="border_right" align="center">&nbsp;</td>
				<td width="75" class="border_right" align="center">&nbsp;</td>
				<td width="75" align="center">&nbsp;</td>
			  </tr>
			</table>';
$table18 ='<table width="175" border="0">
			  <tr>
				<td width="40" class="border_bottom border_right">78 OTHER </td>
				<td width="25" class="border_bottom border_right">&nbsp;</td>
				<td width="30" class="border_bottom border_right">NPL</td>
				<td width="40" class="border_bottom border_right">QUAL</td>
				<td width="20" class="border_bottom border_right">&nbsp;</td>
				<td width="20" class="border_bottom">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="95" class="border_bottom border_right" colspan="3">LAST</td>
				<td width="80" class="border_bottom" colspan="3">FAST</td>
			  </tr>
			  <tr>
				<td width="40" class="border_bottom border_right">79 OTHER </td>
				<td width="25" class="border_bottom border_right">&nbsp;</td>
				<td width="30" class="border_bottom border_right">NPL</td>
				<td width="40" class="border_bottom border_right">QUAL</td>
				<td width="20" class="border_bottom border_right">&nbsp;</td>
				<td width="20" class="border_bottom">&nbsp;</td>
			  </tr>
			  <tr>
				<td width="95" class="border_right" colspan="3">LAST</td>
				<td width="80" colspan="3">FAST</td>
			  </tr>
			</table>';
$html = '<table border="1">
			<tr>
				<td width="175" colspan="2">'.$table1.'</td>
				<td width="220" colspan="2">'.$table2.'</td>
				<td width="175" colspan="2">'.$table3.'</td>
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
	$pdf->Output('vikram.pdf', 'I');
//Close and output PDF document

//============================================================+
// END OF FILE
//============================================================+

?>