<?php
require_once('/var/www/mayo-config.php');
//class file calling from attorney panel
require_once('/var/www/mayo-config.php');
require_once('/var/www/classes/functions.php');
require_once('/var/www/attorney/classes/meshed.php');
$getdata = new Meshed();
$document_messages = mysql_query("SELECT * FROM `documents_messages`") or die(mysql_error());
while($docs = mysql_fetch_object($document_messages))
{
	$attManId      = $docs->main_user_id;
	//name of the client
	$name          = $getdata->GetObjectById($docs->user_id,"email_id");
	$caseNo        = $docs->form_id;
	
	//attorney or case manager email
	
	$email_id      = $getdata->GetObjectById($attManId,"email_id");
	
	$message_docs  = "Your new client submission has been received. Unfortunately, the following documents are missing from your submission in order for us to process your referral.Please upload missing documents or fax to 800-865-8691. Once received, we will continue processing your referral. Thanks Mayo Surgical LLC and affliates.";
	$subject       = "Message Sent from Mayo Department"; 
	$message       = "Documents Missing";
	$extravalues   = array("Name of Client"=>$name,"Email"=>$email_id,"Case No"=>$caseNo,"Message" => $message,"Note:"=>"Related Documents","Description"=>"$message_docs");
	$getdata->SendEmail($email_id,$subject,$message_docs,$extravalues);
}

?>
