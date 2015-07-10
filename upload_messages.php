<?php
	/*$files = array();
	echo $file_name		= $_FILES['upload_file']['name'];
	echo $file_id 		=$_POST['upload_file_ids'];
	$temp_name     = $_FILES["upload_file"]["tmp_name"];
	//$files_path		= $_SERVER['DOCUMENT_ROOT'].'/rao/messagesuploads/';
	//$file_location 	= $files_path . $file_name;
	$extension     = pathinfo($file_name,PATHINFO_EXTENSION);
	$add_name      = rand(000000,999999);
	$newfilename   = date("y-m-d_h:m:s").$add_name.".".$extension;
	$upload_path   = $_SERVER['DOCUMENT_ROOT'].'/rao/messagesuploads/'.$newfilename;
	$move          = move_uploaded_file($temp_name,$upload_path);
	if($move)
	{
		foreach($newfilename as $i=>$files)
		{
			echo $sql = mysql_query("INSERT INTO `messages_uploads` (`upload_name`) VALUES ('$newfilename')") or die(mysql_error());
		}
	}*/
	

foreach ($_FILES["images"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $name = $_FILES["images"]["name"][$key];
        move_uploaded_file( $_FILES["images"]["tmp_name"][$key], $_SERVER['DOCUMENT_ROOT'].'/rao/messagesuploads/'. $_FILES['images']['name'][$key]);
    }
}


echo "<h2>Successfully Uploaded Images</h2>";


?>

