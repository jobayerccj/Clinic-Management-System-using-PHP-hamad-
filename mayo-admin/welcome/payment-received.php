<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../includes/functions.php');
$path       = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
$SQL = "SELECT a.plantiff_name, a.p_d_o_b, b.date_appt, c.date_time AS billing_date, d.date_time AS application_date, e.d_b_amount, e.d_p_received, e.d_paid, e.m_f_b_amount, e.m_f_p_received, e.m_f_p_paid, e.anes_b_amount, e.anes_p_received, e.anes_p_paid, e.other_bill_amount, e.other_payment_received, e.other_paid
FROM plantiff_information AS a, appointment_doctor AS b, final_billing AS c,  `plantiff_case_type_info` AS d,  `billing_payment_information` AS e
WHERE a.form_id = b.form_id
AND a.form_id = c.form_id
AND a.form_id = d.form_id
AND a.form_id = e.form_id
AND c.id = ( 
SELECT MAX( id ) 
FROM final_billing AS c
WHERE c.form_id = a.form_id ) 
AND b.app_type =2
AND d.case_closed =0";
$header = '';
$result ='';
$exportData = mysql_query ($SQL ) or die ( "Sql error : " . mysql_error( ) );
 
//$fields = mysql_num_fields ( $exportData );

$fieldss = array("Client-Name","Date-of-Birth","Application-Date","Surgery-Date","Billing-Date","Doctor-Bill-Amount","Doctor-Payment-Received","Doctor-Paid","Medical-Facility-Bill-Amount","Medical-Facility-Payment-Received","Medical-Facility-Paid","Anaesthesiologist-Bill-Amount","Anaesthesiologist-Payment-Received","Anaesthesiologist-Paid","Other-Bill-Amount","Other-Payment-Received","Other-Paid");
$count = count($fieldss);

$fields = $fieldss;

 

for ( $i = 0; $i < $count; $i++ )

{

    $header .= $fieldss[$i]  . "\t";

}

while( $row = mysql_fetch_row( $exportData ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
 
if ( $result == "" )
{
    $result = "\nNo Record(s) Found!\n";                        
}
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$result";

?>