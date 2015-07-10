<?php 
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../includes/functions.php');
$path       = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);

$query = "select * from plantiff_information";
$q = mysql_query($query);
//$res = mysql_fetch_array($q);
echo ("sep=;
Full Name;DOB;Type of Case;Workflow Status;Application Date;Attorney / Case Manager;Doctor;Underwriter;Anesthesiologist;Medical Facility;Consultation Date;Underwriting Approval Date;Surgery Date;Post Surgery Consultation Date;Final Billing Date;Gross Charges;Doctor Cost;Doctor Price;Anesthesiologist Cost;Anesthesiologist Price;Medical Facility Cost;Medical Facility Price;Total Price;Total Cost;Date Doctor Payment Received;Date Anesthesiologist Payment Received;Date Medical Facility Payment Received;Date Doctor Paid;Date Anesthesiologist Paid;Date Medical Facility Paid;Date Case Closed\n");

while($row1=mysql_fetch_array($q)){
//Full Name
echo ($row1[2].";");

//DOB
echo ($row1[8].";");

//Type of Case
$toc = mysql_query("select name_of_case from type_of_cases where case_id = ".$row1[15]);
$toc1=mysql_fetch_array($toc);
echo ($toc1[0].";");

//Workflow Status
$wc = mysql_query("select work_comments from work_comments where form_id = ".$row1[0]." order by id desc limit 1") or die(mysql_error());
$wc1 = mysql_fetch_array($wc);
echo ($wc1[0].";");

//Application Date
$adate = explode(" ",$row1[3]);
echo ($adate[0].";");

//Attorney / Case Manager
$acm = mysql_query("select concat (first_name, ' ', last_name) from members where id = ".$row1[1]);
$acm1 = mysql_fetch_array($acm);
echo ($acm1[0].";");

//Doctor
$dr = mysql_query("select DISTINCT(p.plantiff_name), ad.main_user_id, concat (m.first_name, ' ', m.last_name) As Doctor from members as m, appointment_doctor ad
INNER JOIN plantiff_information p ON ad.form_id = p.form_id where m.id= ad.main_user_id and p.form_id = ".$row1[0]);
$dr1 = mysql_fetch_array($dr);
echo ($dr1[2].";");

//Underwriter
$uw = mysql_query("select concat (m.first_name, ' ', m.last_name) As Underwriter from members as m, bill_forward_underwriter bu INNER JOIN plantiff_information p ON bu.form_id = p.form_id and bu.user_id = p.id where m.id= bu.underwriter_id and p.form_id = ".$row1[0]);
$uw1 = mysql_fetch_array($uw);
echo ($uw1[0].";");

//Anesthesiologist
$ans = mysql_query("select DISTINCT(p.plantiff_name), hs.hire_id, concat (m.first_name, ' ', m.last_name) As ANS from  hire_staff hs 
INNER JOIN plantiff_information p ON hs.form_id = p.form_id and hs.user_id = p.id
INNER JOIN members m ON hs.hire_id = m.id where m.designation = 1 and p.form_id = ".$row1[0]);
$ans1 = mysql_fetch_array($ans);
echo ($ans1[2].";");

// Medical Facility
$med = mysql_query("select DISTINCT(p.plantiff_name), hs.hire_id, concat (m.first_name, ' ', m.last_name) As ANS from  hire_staff hs 
INNER JOIN plantiff_information p ON hs.form_id = p.form_id and hs.user_id = p.id
INNER JOIN members m ON hs.hire_id = m.id where m.designation = 4 and p.form_id = ".$row1[0]);
$med1 = mysql_fetch_array($med);
echo ($med1[2].";");

//Consultation Date
$condate = mysql_query("select ad.date_appt As 'Consultation Date' from members as m, appointment_doctor ad INNER JOIN plantiff_information p ON ad.form_id = p.form_id where ad.app_type = 1 and m.id= ad.main_user_id and p.form_id = ".$row1[0]);
$condate1 = mysql_fetch_array($condate);
echo ($condate1[0].";");

//Underwriting Approval Date
$uad  = mysql_query("select concat (m.first_name, ' ', m.last_name) As Underwriter, bu.approved_date AS 'Underwriting Approval Date' from members as m, bill_forward_underwriter bu INNER JOIN plantiff_information p ON bu.form_id = p.form_id and bu.user_id = p.id where m.id= bu.underwriter_id and p.form_id = ".$row1[0]);
$uad1 = mysql_fetch_array($uad);
echo ($uad1[1] . ";");


//Surgery Date
$surgdate = mysql_query("select ad.date_appt As 'Consultation Date' from members as m, appointment_doctor ad INNER JOIN plantiff_information p ON ad.form_id = p.form_id where ad.app_type = 2 and m.id= ad.main_user_id and p.form_id = ".$row1[0]);
$surgdate1 = mysql_fetch_array($surgdate);
echo ($surgdate1[0].";");

//Post Surgery Con. Date
$psurgdate = mysql_query("select ad.date_appt As 'Post Surgery Consultation Date' from members as m, appointment_doctor ad INNER JOIN plantiff_information p ON ad.form_id = p.form_id where ad.app_type = 3 and m.id= ad.main_user_id and p.form_id = ".$row1[0]);
$psurgdate1 = mysql_fetch_array($psurgdate);
echo ($psurgdate1[0].";");

//Final Billing
$fb = mysql_query("select b.final_b_date from plantiff_information p inner join billing_payment_information b on p.form_id = b.form_id where p.form_id = ".$row1[0]);
$fb1 = mysql_fetch_array($fb);
echo ($fb1[0] . ";");

//Gross Charges
$gc = mysql_query("select b.gross_charges from plantiff_information p inner join billing_payment_information b on p.form_id = b.form_id where p.form_id = ".$row1[0]);
$gc1 = mysql_fetch_array($gc);
echo ($gc1[0] . ";");

//Doctor Cost
$drc  = mysql_query("SELECT p.plantiff_name,  SUM(doctor_cost),SUM(doctor_price),SUM(anes_cost),SUM(anes_price),SUM(facility_cost),SUM(facility_price),SUM(doctor_cost)+SUM(facility_cost)+SUM(anes_cost) AS TotalCost,SUM(doctor_price)+SUM(facility_price)+SUM(anes_price) as TotalPrice , d_p_received, anes_p_received,	m_f_p_received,	d_paid,	anes_p_paid,	m_f_p_paid  FROM billing_info bi inner join plantiff_information p on p.form_id = bi.form_id and p.id = bi.user_id
 inner join billing_payment_information bp on p.form_id = bp.form_id
  where p.form_id = ".$row1[0]);
$drc1 = mysql_fetch_array($drc);
echo ($drc1[1] . ";");

//Doctor Price
echo ($drc1[2] . ";");

//Anesthesiologist Cost	
echo ($drc1[3] . ";");


//Anesthesiologist Price	
echo ($drc1[4] . ";");


//Medical Facility Cost	
echo ($drc1[5] . ";");


//Medical Facility Price
echo ($drc1[6] . ";");

//Total Cost
echo ($drc1[7] . ";");

//Total Price
echo ($drc1[8] . ";");

//Date Doctor Payment Received	
echo ($drc1[9] . ";");

//Date Anesthesiologist Payment Received	
echo ($drc1[10] . ";");

//Date Medical Facility Payment Received	
echo ($drc1[11] . ";");

//Date Doctor Paid	
echo ($drc1[12] . ";");

//Date Anesthesiologist Paid	
echo ($drc1[13] . ";");

//Date Medical Facility Paid	
echo ($drc1[14] . ";");

//Date Case Closed



//End of Line
echo "\n";
}
#die();
header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=general-report.csv");

header("Pragma: no-cache");

header("Expires: 0");

?>