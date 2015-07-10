<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
require_once('../../includes/functions.php');
$path       = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);

$SQL = "select p.plantiff_name AS Full_Name, p.p_d_o_b As DOB, toc.name_of_case as Type_of_Case, w.work_comments as Workflow_Status, date(p.p_date)
  as Application_Date, concat (m.first_name, ' ', m.last_name) AS 'Attorney / Case Manager'
 from plantiff_information as p, work_comments as w, type_of_cases as toc, members as m
where p.form_id = w.form_id and p.case_type = toc.case_id and  p.id = m.id";

$sepline = 'sep=;';

$header = '';

$result ='';

$exportData = mysql_query ($SQL ) or die ( "Sql error : " . mysql_error( ) );

 

$fields = mysql_num_fields ( $exportData );

 

for ( $i = 0; $i < $fields; $i++ )

{

    $header .= mysql_field_name( $exportData , $i ) . ";";

}

 

while( $row = mysql_fetch_row( $exportData ) )

{

    $line = '';

    foreach( $row as $value )

    {                                            

        if ( ( !isset( $value ) ) || ( $value == "" ) )

        {

            $value = ";";

        }

        else

        {

            $value = str_replace( '"' , '""' , $value );

            $value = '"' . $value . '"' . ";";

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

header("Content-Disposition: attachment; filename=general-report.csv");

header("Pragma: no-cache");

header("Expires: 0");

print "$header\n$result";

 

?>