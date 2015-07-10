<?php 
	$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
	include($path);
	include($config);
	include('../../../../../classes/functions.php');
	$getdata = new Allfunctions();

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
				if($k%2==0)
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
				if($m%2==1)
				{	
$table44 .=	'<td width="10">'.$m.'.</td>
			 <td width="175">'.$cptCodessd->cpt_code.'</td>';
				}
				$m++;
			}
$table44 .=	'</tr>';
$table44 .=	'</table>';
			echo $table44;
?>