<?php

$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
if(isset($_REQUEST['action']) && $_REQUEST['action']=="deletedocs")
{
	echo $document_name = $_GET['filename'];
	$_GET['url'];
	$_REQUEST['fid'];
	 $_REQUEST['uid'];
	if(isset($_REQUEST['cid']))
	{
		echo $_REQUEST['cid'];
	}
	$url = $_GET['url']."?fid=".$_REQUEST['fid']."&uid=".$_REQUEST['uid']."&cid=".$_REQUEST['cid'];

	$query = mysql_query("DELETE FROM `upload_documents` where `upload_document_path` = '$document_name'");
	$deletefile = $_SERVER['DOCUMENT_ROOT']."/uploads/".$document_name;
	$unlink = unlink($deletefile);
	header('location:'.$url);
}
elseif(isset($_REQUEST['action']) && $_REQUEST['action']=="deletebills")
{
	
	echo $document_name = $_GET['filename'];
	$_GET['url'];
	$_REQUEST['fid'];
	 $_REQUEST['uid'];
	if(isset($_REQUEST['cid']))
	{
		echo $_REQUEST['cid'];
	}
	$url = $_GET['url']."?fid=".$_REQUEST['fid']."&uid=".$_REQUEST['uid']."&cid=".$_REQUEST['cid'];

	$query = mysql_query("DELETE FROM `u_fwd_final_billing` where `file_path` = '$document_name'");

	header('location:'.$url);
}
?>