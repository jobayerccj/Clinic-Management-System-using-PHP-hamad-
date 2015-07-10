<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
//echo $contentfile = "../final-billing-document.php";
//$functions  = $_SERVER['DOCUMENT_ROOT']."/classes/functions.php";
//include($functions);
//$meshedfile = $_SERVER['DOCUMENT_ROOT']."/attorney/classes/meshed.php";
//require_once($meshedfile);
//$getdata = new Meshed();
?>
<form name="forms1" method="post" action="">
	<input type="submit" name="generatepdf" value="Generate Pdf" />
</form>	
<?php
	if(isset($_POST['generatepdf']))
	{
	//echo $contentfile = $_SERVER['DOCUMENT_ROOT']."/mayo-admin/includes/final-billing-document.php";
	$table1 = '<style>
			.table-border{border:1px solid #000;}
			.border_bottom{border-bottom:1px solid #000;} 
			.border_right{border-right:1px solid #000;}
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
					<td align="center" class="border_bottom border_right">&nbsp;</td>
					<td align="center" class="border_bottom border_right">&nbsp;</td>
				</tr>
			</table>';
$table4 = '<table width="170">
				<tr>
					<td width="9" class="border_bottom border_right" align="center">8</td>
					<td width="99" class="border_bottom border_right">PATIENT NAME </td>
					<td width="17" class="border_bottom border_right" align="center">a</td>
					<td width="50" class="border_bottom border_right" align="center">&nbsp;</td>
				</tr>
				<tr>
					<td class="border_bottom border_right" align="center">b</td>
					<td colspan="3" class="border_bottom border_right" align="center">&nbsp;</td>
				</tr>
			</table>';
$table5 = '<table width="395">
				<tr>
					<td width="10" align="center" class="border_bottom border_right">8</td>
					<td width="160" class="border_bottom border_right">PATIENT NAME </td>
					<td width="10" align="center" class="border_bottom border_right">a</td>
					<td width="215" colspan="5" class="border_bottom border_right" align="center">&nbsp;</td>
				</tr>
				<tr>
					<td width="10" class="border_right" align="center">b</td>
					<td width="160" class="border_right" align="center">&nbsp;</td>
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
					<td width="25" rowspan="2" align="center" class="border_bottom border_right" valign="middle">16 DHR </td>
					<td width="25" rowspan="2" align="center" class="border_bottom border_right" valign="middle">17 SAT </td>
					<td width="275" colspan="11" align="center" class="border_bottom border_right" valign="middle">CONDITION CODES </td>
					<td width="20" rowspan="2" align="center" class="border_bottom border_right" valign="middle">29 ACDT STATE </td>
					<td width="20" rowspan="2" align="center" class="border_bottom border_right" valign="middle">30</td>
				</tr>
				<tr>
					<td width="70" align="center" class="border_bottom border_right" valign="middle">&nbsp;</td>
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
					<td width="20" align="center" class="border_right" valign="middle">&nbsp;</td>
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
					<td align="center" class="border_right">&nbsp;</td>
				</tr>
			</table>';
$table8 = '<table width="570">
			  <tr>
				<td width="150" rowspan="6" valign="top" class="border_bottom border_right">38</td>
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
				<td width="25" align="center" class="border_right">&nbsp;</td>
			  </tr>
			</table>';
$table9 = '<table width="570">
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">42 REV. CD. </td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">43 DESCRIPTION</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">44 HCPCS / RATE / HIPPS CODE </td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">45 SERV. DATE </td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">45 SERV. UNITS </td>
					<td width="100" align="center" colspan="2" valign="middle" class="border_bottom border_right">47 TOTAL CHARGES </td>
					<td width="100" align="center" colspan="2" valign="middle" class="border_bottom border_right">48 NON-COVERED CHARGES </td>
					<td width="25" align="center" class="border_bottom">49</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="65" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="60" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_bottom border_right">&nbsp;</td>
					<td width="25" align="center" valign="middle" class="border_bottom">&nbsp;</td>
				</tr>
				<tr>
					<td width="25" align="center" valign="middle" class="border_right">&nbsp;</td>
					<td width="175" align="center" valign="middle" class="border_right">Page _________ of _______</td>
					<td width="65" align="center" valign="middle" class="border_right">CREATION DATE</td>
					<td width="40" align="center" valign="middle" class="border_right">&nbsp;</td>
					<td width="40" align="center" valign="middle" class="border_right">TOTAL</td>
					<td width="60" align="center" valign="middle" class="border_right">0</td>
					<td width="40" align="center" valign="middle" class="border_right">00</td>
					<td width="60" align="center" valign="middle" class="border_right">0</td>
					<td width="40" align="center" valign="middle" class="border_right">00</td>
					<td width="25" align="center" valign="middle">&nbsp;</td>
				</tr>
			</table>';
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
		</table>';
		echo $html;
		/*define('FPDF_FONTPATH','font/');
		require('fpdf.php');
		require('html2fpdf.php');
		$pdf2 = new HTML2FPDF();
		$pdf = new FPDF();
		$pdf->SetFont('Arial','B',16);
		$pdf->AddPage();
		//$pdf->Cell(40,10,'This one is my Testing.I hate this code. It is very tough code.Creating the pdf but not generated automatically.');
		//$pdf->WriteHTML2($contentfile);
		$pdf2->WriteHTML($contentfile);
		echo $docs = $_SERVER['DOCUMENT_ROOT']."/mayo-admin/welcome/includes/pdf-generator/caseno-".$_REQUEST['fid']."-".date('d-m-y-s').".pdf";
		
		$pdf->Output($docs);*/
		
		require('html2fpdf.php');
		$pdf=new HTML2FPDF('P','mm','A4');
		//$pdf->SetFont('Arial','',8);
		$pdf->AddPage();
		
		//echo $fp = fopen("$contentfile","r");
		//$strContent = fread($fp, filesize("$contentfile"));
		//fclose($fp);
		//$pdf = new HTML2PDF();
		$pdf->WriteHTML($html);
		echo $docs = $_SERVER['DOCUMENT_ROOT']."/mayo-admin/welcome/includes/pdf-generator/caseno-".$_REQUEST['fid']."-".date('d-m-y-s').".pdf";
		
		$pdf->Output($docs);
		
		echo "PDF file is generated successfully!";
		
		echo $sql = "INSERT INTO `final_billing` (`user_id`,`form_id`,`pdf_name`) VALUES ('$_REQUEST[uid]','$_REQUEST[fid]','caseno-".$_REQUEST['fid']."-".date('d-m-y-s').".pdf')";
		
		$data = mysql_query($sql);
		$page = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	//	header("Refresh: 2; url=$page");		
	}
	echo $query = "SELECT * FROM  `final_billing` WHERE  `user_id` = '$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]' && id = (SELECT MAX(id))";
	$getPdf = mysql_query($query) or die(mysql_error());
	echo $count = mysql_num_rows($getPdf);
	if(mysql_num_rows($getPdf)>=1)
	{
		$pdfOfUser = mysql_fetch_object($getPdf);
?>
		<h1><a href="../includes/pdf-generator/<?php echo $pdfOfUser->pdf_name; ?>" target="_blank">Click Here to Download the Pdf.</h1>
<?php
	}
?>



				
				
