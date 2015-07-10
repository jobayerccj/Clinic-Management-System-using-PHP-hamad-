<div class="attorney_client_info"><h1>Forward Final Billing</h1></div>
<form name="foward-final-billing" method="post" action="" style="width:38%;float:left">
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
</form>
	
<div class="view_application">
	<div class="attorney_client_info"><h1>Uploaded Bills</h1></div>
	<div class="attorney_row">
		<div class="client_box_bg">
			<div class="client_row_heading">
				<div class="client_span_1">Sr. No.</div>
				<div class="client_span_2">Document Name</div>
				<div class="client_span_3">Description</div>
				<div class="client_span_4">Document Type</div>
				<div class="client_span_5">Date</div>
				<div class="client_span_6">View</div>
			</div>
			<?php
			$i=1;
				$temp_docs = mysql_query("SELECT * FROM `u_fwd_final_billing` where `fid`='$_REQUEST[fid]' && `uid`='$_REQUEST[uid]'") or die(mysql_error());
				while($docs= mysql_fetch_object($temp_docs))
				{
			?>
						<div class="client_row_content">
							<div class="client_span_1"><?php echo $i; ?></div>
							<div class="client_span_2"><?php echo $docs->document_type; ?></div>
							<div class="client_span_3"><?php echo $docs->message; ?></div>
							<div class="client_span_4"><?php echo $docs->name_document; ?></div>
							<div class="client_span_5"><?php echo date('m-d-Y',strtotime($docs->fwd_date)); ?></div>
							<div class="client_span_6">
								<a target="_blank" href="../download-billing.php?filename=<?php echo $docs->file_path; ?>">Download</a>
							</div>
						</div>
			<?php	
				$i++;
				}
			?>
		</div>
	</div>
</div>
