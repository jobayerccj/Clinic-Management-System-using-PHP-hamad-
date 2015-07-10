<div class="attorney_client_info"><h1>Forward Final Billing</h1></div>
<form name="foward-final-billing" method="post" action="" style="width:38%;float:left">
<input type="checkbox" id="selectall"><b>Forward Bill (Select All)</b>
	<?php
	$pdfdata = mysql_query("SELECT * FROM `final_billing` WHERE `user_id`='$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]'") or die(mysql_error());
	if(mysql_num_rows($pdfdata))
	{
		while($fbilling     = mysql_fetch_object($pdfdata))
		{
			$hire_di        = $fbilling->hire_id;	
			$designation	= $getdata->GetObjectById($hire_di,"designation");
			$designations   = $getdata->GetDesgBydesId($designation);
			$dfirst_name	= ucwords($getdata->GetObjectById($hire_di,"first_name"));
			$last_name		= ucwords($getdata->GetObjectById($hire_di,"last_name"));
	?>
			<div class="pdf_down">
				<input type="checkbox" class="fwd_bill" name="fwdbilling[]" value="<?=$fbilling->pdf_name?>" />
				<input type="hidden" name="document_type[]" value="<?=$designations?> Bill" />
				<input type="hidden" name="name_document[]" value="<?=$designations?> Bill" />
				<input type="hidden" name="file_path[]" value="<?=$fbilling->pdf_name?>" />
				<input type="hidden" name="message[]" value="<?=$designations?> Bill" />
				<a href="<?php echo $sitepath;?>/billing/<?=$fbilling->pdf_name?>" target="_blank">Final Billing PDF</a>
				<div class="genrated_date">
					<b>
						<?=$designations?>: &nbsp;<?=$dfirst_name?>&nbsp;<?=$last_name?>
					</b>&nbsp;
					<br/>
					Generated On:&nbsp;<?=date('m-d-Y',strtotime($fbilling->date_time))?>
				</div>
			</div>
			
	<?php
		}
	}
	?>
	<?php
		$you = "SELECT a.form_id as pfid,b.hire_id,c.form_id as pcfid,d.* from plantiff_information as a, hire_staff as b, plantiff_case_type_info as c,members as d where a.form_id=b.form_id and a.form_id=c.form_id and b.form_id=c.form_id and a.form_id=$_REQUEST[fid] and b.form_id=$_REQUEST[fid] and c.form_id=$_REQUEST[fid] and d.id=b.hire_id and d.designation=6 and c.case_closed=0";
		$tempuId = mysql_query($you) or die(mysql_error());
		$underId = mysql_fetch_object($tempuId);
	?>
	<input type="hidden" name="underwriter_ida" value="<?php echo $underIds = $underId->hire_id;?>">
	<div class="attorney_row">
		<input type="submit" name="forward_bill" value="Forward Bill" />
	</div>
</form>
<?php
	if(isset($_POST['forward_bill']))
	{
		@$form_id      = $_REQUEST['fid'];
		@$user_id      = $_REQUEST['uid'];
		$document_type = $_POST['document_type'];
		$name_document = $_POST['name_document'];
		$file_path     = $_POST['file_path'];
		$message       = $_POST['message'];
		$underwId      = $_POST['underwriter_ida'];
		$loopStart     = $_POST['fwdbilling'];
		$count         = count($loopStart);
		//print_r($loopStart);
		
		for($key=0;$key<=$count-1;$key++)
		{			//echo $key;
			//echo "INSERT INTO `u_fwd_final_billing` (`fid`,`uid`,`underwriter_id`,`document_type`,`name_document`,`file_path`,`message`,`fwd_date`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$underwId[$key]','$document_type[$key]','$name_document[$key]','$file_path[$key]','$message[$key]',now())";
			
			$inserQuery    = mysql_query("INSERT INTO `u_fwd_final_billing` (`fid`,`uid`,`underwriter_id`,`document_type`,`name_document`,`file_path`,`message`,`fwd_date`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$underwId','$document_type[$key]','$name_document[$key]','$file_path[$key]','$message[$key]',now())") or die(mysql_error());
		}
		
		$ufname      = $getdata->GetObjectById($underwId,"first_name");
		$ulname      = $getdata->GetObjectById($underwId,"last_name");
		$emailUnder  = $getdata->GetObjectById($underwId,"email_id");
		$pName       = ucwords($getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']));
		
		$fullname    = ucwords($ufname).ucwords($ulname);
		
		$messToUnder = ' Mayo Surgical has forwarded the final billing for '.$pName.' for Payment. You can view and download the billing by clicking on "Check Status" and then page down to the Final Billing section. '.$fullname;
		
		$admin       = $_SESSION['username'];
		$admin_id    = $getdata->GetDetailsByUsername($admin,"id");
		
		$message     = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$form_id','$user_id','$admin_id','$underwId','$messToUnder',now())") or die(mysql_error());
		$message="";
		$message .= '<html><body>';
		$message .= '<img src="/images/logo.png" alt="From Mayo to Underwriter – Final billing" />';

		$message .='<table rules="all" cellpadding="0" cellspacing="5" border="0" style="font-size:17px;color:#000; border:1px solid #0665be; border-radius:5px;">';

		$message .='<tr><td style="background: none repeat scroll 0 0 #3a9df8;border-top-left-radius: 5px;border-top-right-radius: 5px;color: #fff;font: 15px MemphisLTStd-Medium;padding: 15px 0;text-align: center;">';
		
		$message .='<h1>From Mayo to '.$ufname.' '.$ulname.' – Final billing</h1></td></tr>';
		$message .='<tr><td><h2>Dear '.$ufname.' '.$ulname.'</h2></td></tr>';
		$message .='<tr><td align="center">Mayo Surgical has forwarded an invoice for '.$pName.' to you for payment. You can view and download the billing by clicking on "Check Status" an then page down to Final Billing Section. Please login to your <a href="mayosurgical.com">Mayo Surgical</a> account to view the invoices.  Please process these invoices and pay according to our terms.  Thank you Mayo Surgical.</td></tr>';	
		$message .='<tr><td>Mayo Surgical LLC and affiliates</td></tr>';
		$message .='<tr><td>Please login into <a href="mayosurgical.com">Mayo Surgical</a> for further information.</td></tr>';	
		$message .='<tr><td>DO NOT REPLY TO THIS MESSAGE. THIS EMAIL IS NOT MONITORED.</td></tr>';		
		$message .='</table>';
		$to       = $emailUnder; 
		//$getdata->GetObjectById($attManId,"email_id");
		$subject  ="New Invoice from Mayo Surgical";
		$headers  ="From: Mayo Surgical";
		$headers .="MIME-Version: 1.0\r\n";
		$headers .="Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		if(mail($to, $subject, $message, $headers))
		{
			echo "<div class='thank_message'>Bill is Forwarded Successfully.</div>";
		}
	}
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$("#selectall").click(function(event)
		{
			if(this.checked){
				$(".fwd_bill").each(function()
				{
					this.checked=true;
				});
			}else{
				$(".fwd_bill").each(function()
				{
					this.checked=false;
				});
			}
		});
	});
</script>
<div class="bill_application">
	<div class="attorney_row">
		<div class="attorney_documents_left">
		<form name="upload-form" method="post" enctype="multipart/form-data" id="uploadForm" action="">
			<div class="attorney_row">
				<label>Document Type</label>
				<select name="document_type" required>
					<option value="">...Select...</option>
					<option value="Anesthesiologist Bill">Anesthesiologist Bill</option>
					<option value="Doctor Bill">Doctor Bill</option>
					<option value="Medical Facility Bill">Medical Facility Bill</option>
					<option value="Other">Other</option>
				</select>
			</div>

			<div class="attorney_row">
				<label>Name of Document</label>
				<input type="text" name="name_document" value="" required/> 
			</div>
			<div class="attorney_row">
				<label>Choose File</label>
				<input type="file" name="choose_file" id="" required/>
			</div>	
		</div>
		<div class="attorney_documents_right">		
			<div class="attorney_row">
				<label>Message</label>
				<textarea name="message"></textarea>
			</div>	
		</div>
		<div>
		<?php
			$you = "SELECT a.form_id as pfid,b.hire_id,c.form_id as pcfid,d.* from plantiff_information as a, hire_staff as b, plantiff_case_type_info as c,members as d where a.form_id=b.form_id and a.form_id=c.form_id and b.form_id=c.form_id and a.form_id=$_REQUEST[fid] and b.form_id=$_REQUEST[fid] and c.form_id=$_REQUEST[fid] and d.id=b.hire_id and d.designation=6 and c.case_closed=0";
			$tempuId = mysql_query($you) or die(mysql_error());
			$underId = mysql_fetch_object($tempuId);
		?>
			<input type="hidden" name="underwriter" value="<?php echo $underIds = $underId->hire_id;?>">
		</div>
		<div class="attorney_row">
			<input type="submit" name="up_user_documentsss" value="Forward Bill" id=""/>
		</div>
	</form>	
	<?php
		if(isset($_POST['up_user_documentsss']))
		{
			@$form_id      = $_REQUEST['fid'];
			@$user_id      = $_REQUEST['uid'];
			$document_type = $_POST['document_type']; 
			$document_name = $_POST['name_document'];
			$filename      = $_FILES["choose_file"]["name"];
			$temp_name     = $_FILES["choose_file"]["tmp_name"];
			$message       = $_POST['message'];
			$underwriterId = $_POST['underwriter'];
			$extension     = pathinfo($filename,PATHINFO_EXTENSION);
			$add_name      = rand(000000,999999);
			$newfilename   = date("y-m-d_h:m:s").$add_name.".".$extension;
			$chkDir        = $_SERVER['DOCUMENT_ROOT']."/billing/";
			if(!is_dir($chkDir))
			{
				mkdir($chkDir,0777,true);
			}
			$upload_path   = $_SERVER['DOCUMENT_ROOT']."/billing/".$newfilename;
			$move          = move_uploaded_file($temp_name,$upload_path);
			$save_upload   = mysql_query("INSERT INTO `u_fwd_final_billing` (`fid`,`uid`,`underwriter_id`,`document_type`,`name_document`,
			`file_path`,`message`,`fwd_date`)VALUES 
			('$form_id','$user_id','$underwriterId','$document_type','$document_name','$newfilename','$message',now())") or die(mysql_error());
			
			$ufname      = $getdata->GetObjectById($underwriterId,"first_name");
			$ulname      = $getdata->GetObjectById($underwriterId,"last_name");
			
			$fullname    = ucwords($ufname).ucwords($ulname);
			
			$messToUnder = $document_name. " is forwarded to Underwriter ".$fullname;
			
			$admin       = $_SESSION['username'];
			$admin_id    = $getdata->GetDetailsByUsername($admin,"id");
			
			$notifications = mysql_query("INSERT INTO `notifications` (`user_id`,`form_id`,`main_id`,`message`) VALUES ('$_REQUEST[uid]','$_REQUEST[fid]','$admin_id','$messToUnder')") or die(mysql_error());
			
			$message     = mysql_query("INSERT INTO `message_sent` (`form_id`,`user_id`,`sent_by`,`main_user_id`,`message`,`date_message`) VALUES ('$form_id','$user_id','$admin_id','$underwriterId','$messToUnder',now())") or die(mysql_error());
			if($move)
			{
				echo "<div class='thank_message'>".$filename." Uploaded Successfully. </div>";
			}
		}
	?>	
	</div>
</div>
<div class="view_application">
	<div class="attorney_client_info"><h1>Uploaded Bills</h1></div>
	<div class="attorney_row">
		<div class="client_box_bg">
			<div class="client_row_heading">
				<div class="client_span_v1">Sr. No.</div>
				<div class="client_span_v2">Document Name</div>
				<div class="client_span_v3">Description</div>
				<div class="client_span_v4">Document Type</div>
				<div class="client_span_v5">Date</div>
				<div class="client_span_v6">View</div>
				<div class="client_span_v7">Delete</div>
			</div>
			<?php
			$i=1;
				$temp_docs = mysql_query("SELECT * FROM `u_fwd_final_billing` where `fid`='$_REQUEST[fid]' && `uid`='$_REQUEST[uid]'") or die(mysql_error());
				while($docs= mysql_fetch_object($temp_docs))
				{
			?>
						<div class="client_row_content">
							<div class="client_span_v1"><?php echo $i; ?></div>
							<div class="client_span_v2"><?php echo $docs->document_type; ?></div>
							<div class="client_span_v3"><?php echo $docs->message; ?></div>
							<div class="client_span_v4"><?php echo $docs->name_document; ?></div>
							<div class="client_span_v5"><?php echo date('m-d-Y',strtotime($docs->fwd_date)); ?></div>
							<div class="client_span_v6">
								<a target="_blank" href="../download-billing.php?filename=<?php echo $docs->file_path; ?>">Download</a>
							</div>
							<div class="client_span_v6">
								<a href="/mayo-admin/welcome/delete-docs.php?filename=<?=$docs->file_path;?>&url=<?php echo "https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&fid=<?php echo $_REQUEST['fid'];?>&cid=<?php echo $_REQUEST['cid']; ?>&action=deletebills">Delete</a>
							</div>
						</div>
			<?php	
				$i++;
				}
			?>
		</div>
	</div>
</div>
