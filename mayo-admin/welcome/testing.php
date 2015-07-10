<?php
$header="";
$fields = array('Client Name','Date of Birth','Application Date','Surgery Date','Billing Date','Doctor Bill Amount','Doctor Payment Received','Doctor Paid','Medical Facility Bill Amount','Medical Facility Payment Received','Medical Facility Paid','Anaesthesiologist Bill Amount','Anaesthesiologist Payment Received','Anaesthesiologist Paid','Other Bill Amount','Other Payment Received','Other Paid');
echo $count = count($fields);
for($i=0;$i<$count;$i++)
{	
	$header .= $fields[$i];
}
echo $header;

?>