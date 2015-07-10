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
$getdata    = new Allfunctions();
?>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> 
<?php
if(loggedin())
{
	include('header.php');
	$form_id= $_REQUEST['fid'];
?>
<script type="text/javascript">

var tableToExcel = (function() {

  var uri = 'data:application/vnd.ms-excel;base64,'

    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'

    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }

    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }

  return function(table, name) {

    if (!table.nodeType) table = document.getElementById(table)

    var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}

    window.location.href = uri + base64(format(template, ctx))

  }

})()

</script>
<input type="button" onclick="tableToExcel('testTable', 'W3C Example Table')" value="Export to Excel">
<section class="row">
	<div class="container">
		<div class="form_section_content">
			 <h1 class="add_user">Download Reports</h1>
			 <table id="testTable" summary="Code page support in different versions of MS Windows." rules="groups" frame="hsides" border="2">
			 <?php
				$sql = mysql_query("select * from `billing_payment_information` where `form_id`='$_REQUEST[fid]'") or die(mysql_error());
				$reports = mysql_fetch_object($sql);
			 ?>
			 <tr>
				 <td>
					Name
				</td>
				<td>
					<?php echo $getdata->GetInfoPlantiffInformation('plantiff_name',$form_id);?>
				</td>
			</tr>
			<tr>
				 <td>
					Date of Birth
				</td>
				<td><?php echo $getdata->GetInfoPlantiffInformation('p_d_o_b',$form_id);?></td>
			</tr>
			<tr>
				<td>
					Type of Case
				</td>
				<td>
					<?php
							$caseId = $getdata->GetInfoPlantiffInformation('case_type',$form_id);
							echo $getdata->getNameCase($caseId);
							
					?>
				</td>
			</tr>
			<tr>
				<td>
					Application Date
				</td>
				<td>
					<?php echo $getdata->GetObjectFromPCTI('date_time',$form_id)?>
				</td>
			</tr>
			
			<?php
				$hireInfo = mysql_query("SELECT a . * , b.id AS user_id, b.first_name, b.last_name, c.id AS desgId, c.designation
FROM hire_staff AS a, members AS b, designation AS c
WHERE form_id =392
AND a.hire_id = b.id
AND b.designation = c.id") or die(mysql_error());
while($hireStaff = mysql_fetch_object($hireInfo))
{	
?>			<tr>
			  <td>
				<?php echo $hireStaff->designation; ?>
				</td>
				<td>
					<?php $fname = $hireStaff->first_name; $lname = $hireStaff->last_name; echo $fname?>&nbsp;<?php echo $lname; ?>
				</td>
			</tr>
<?php
}
?>
			<tr>
			   <td>
				Consultation Date
			   </td>
				<td>
					<?php echo $getdata->consultationDate(1,$form_id,'date_appt');?>
				</td>
			</tr>
			<tr>
			   <td>
					Underwriter Approval Date
			   </td>
				<td>
					<?php echo $getdata->approvalDate('approved_date',$form_id)?>
				</td>
			</tr>
			<tr>
			    <td>
					Surgery Date
				</td>
				<td>
					<?php echo $getdata->consultationDate(2,$form_id,'date_appt');?>
				</td>
			</tr>
			<tr>
					<td>
						Post Surgery Consultation Date
				     </td>
					<td>
						<?php echo $getdata->consultationDate(3,$form_id,'date_appt');?>
					</td>
			</tr>
			<tr>
			   
					<td>Final Billing Date</td>
					<td>
						<?php echo $reports->final_b_date;?>
					</td>
			</tr>
			<tr>
				<td>Gross Charges</td>
				<td>
					<?php echo $reports->gross_charges;?>
				</td>
			</tr>
			<?php
				$billingDetailsTemp = mysql_query("SELECT SUM( doctor_cost ) AS dcost, SUM( facility_cost ) AS fcost, SUM( anes_cost ) AS acost, SUM( doctor_price ) AS dprice, SUM( facility_price ) AS fprice, SUM( anes_price ) AS aprice, (
SUM( doctor_cost ) + SUM( facility_cost ) + SUM( anes_cost )
) AS totalcost, (
SUM( doctor_price ) + SUM( facility_price ) + SUM( anes_price )
) AS totalprice, (
SUM( doctor_cost ) + SUM( facility_cost ) + SUM( anes_cost ) + SUM( doctor_price ) + SUM( facility_price ) + SUM( anes_price )
) AS total
FROM  `billing_info` 
WHERE form_id =$_REQUEST[fid]") or die(mysql_error());
				$billingDetails     = mysql_fetch_object($billingDetailsTemp);
			?>
			<tr>
				<td>
					Doctor Cost
				</td>
				<td>
					<?php echo $billingDetails->dcost?>
				</td>
			</tr>
			<tr>
			   <td>
					Anesthesiologist Cost
				</td>
				<td>
					<?php echo $billingDetails->acost?>
				</td>
			</tr>
			<tr>
			   <td>
					Anesthesiologist Price
				</td>
				<td>
					<?php echo $billingDetails->aprice?>
				</td>
			</tr>
			<tr>
				<td>Medical Facility Cost</td>
				<td><?php echo $billingDetails->fcost?></td>
			</tr>
			<tr>
				<td>Medical Facility Price</td>
				<td>
					<?php echo $billingDetails->fprice?>
				</td>
			</tr>
			<tr>
				<td>Total Price</td>
				<td>
					<?php echo $billingDetails->totalprice?>
				</td>
			</tr>
			<tr>
					<td>Total Cost</td>
				<td>
					<?php echo $billingDetails->totalcost?>
				</td>
			</tr>
			<tr>
				<td>Date Doctor Payment Received</td>
				<td>
					<?php echo $reports->d_p_received;?>
				</td>
			</tr>
			<tr>
			   <td>
					Date Anesthes Payment Received
				</td>
				<td>
					<?php echo $reports->anes_p_received;?>
				</td>
			</tr>
			<tr>
			   <td>
					Date Medical Facility Received
				</td>
				<td><?php echo $reports->m_f_p_received;?></td>
			</tr>
			<tr>
				<td>Date Doctor Paid</td>
				<td><?php echo $reports->d_paid?></td>
			</tr>
			<tr>
					<td>Date Anesthesiologist Paid</td>
					<td>
						<?php echo $reports->anes_p_paid;?>
					</td>
			</tr>
			<tr>
				<td>Date Medical Facility Paid</td>
				<td><?php echo $reports->m_f_p_paid;?>
				</td>
			</tr>
			<tr>
				<td>Date Case Closed</td>
				<td>
					<?php echo $reports->other_paid?>
				</td>
			</tr>
			</table>
		</div>
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
