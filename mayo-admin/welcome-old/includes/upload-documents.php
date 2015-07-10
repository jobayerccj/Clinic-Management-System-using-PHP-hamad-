<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $row['plantiff_name']; ?>"/></a>
</div>
<div class="attorney_client_info"><h1>Upload Documents</h1></div>
			<div class="view_application">
				<div class="attorney_row">
					<div class="attorney_documents_left">
					<form name="upload-form" method="post" enctype="multipart/form-data" id="uploadForm" action="">
						<div class="attorney_row">
							<label>Document Type</label>
							<select name="relate_to" required>
								<option value="">...Select...</option>
								<option value="Medical Bill">Medical Bill</option>
								<option value="Medical Record">Medical Record</option>
								<option value="Police Record">Police Record</option>
								<option value="Product Label">Product Label</option>
								<option value="Release of Medical Records">Release of Medical Records</option>
								<option value="Travel Expense">Travel Expense</option>
								<option value="Other">Other</option>
							</select>
						</div>
						<div class="attorney_row">
							<label>Type of Case</label>
							<input type="text" name="case" value="<?php
									$case = mysql_query("SELECT * FROM `type_of_cases` where `case_id`='".$_GET['cid']."'") or die(mysql_error());
									$caselist = mysql_fetch_array($case);
									echo $caselist['name_of_case'];
									
								?>" readonly/>
							<input type="hidden" name="case" value=<?php echo $_GET['case_id']; ?>>
						</div>
						<div class="attorney_row">
							<label>Name of Document</label>
							<input type="text" name="document_name" value="" required/> 
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
					<div class="attorney_row">
						<input type="submit" name="up_user_documents" value="Upload Documents" id=""/>
					</div>
				</form>	
				<div class="view_application">
                <div class="attorney_client_info"><h1>Uploaded Documents</h1></div>
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
								$temp_docs = mysql_query("SELECT * FROM `upload_documents` where `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
								while($docs= mysql_fetch_object($temp_docs))
								{
							?>
										<div class="client_row_content">
											<div class="client_span_1"><?php echo $i; ?></div>
											<div class="client_span_2"><?php echo $docs->name_of_document; ?></div>
											<div class="client_span_3"><?php echo $docs->message; ?></div>
											<div class="client_span_4"><?php echo $docs->related_to; ?></div>
											<div class="client_span_5"><?php echo $docs->upload_date; ?></div>
											<div class="client_span_6">
												<a target="_blank" href="<?php echo $sitepath;?>/uploads/<?php echo $docs->upload_document_path; ?>">view</a>
											</div>
										</div>
							<?php	
								$i++;
								}
							?>
							</div>
							</div>
						</div>
				<?php
					if(isset($_POST['up_user_documents']))
					{
						@$form_id      = $_REQUEST['fid'];
						@$user_id      = $_REQUEST['uid'];
						$related_to    = $_POST['relate_to']; 
						$case          = $_POST['case'];
						$document_name = $_POST['document_name'];
						$filename      = $_FILES["choose_file"]["name"];
						$temp_name     = $_FILES["choose_file"]["tmp_name"];
						$message       = $_POST['message'];
						$extension     = pathinfo($filename,PATHINFO_EXTENSION);
						$add_name      = rand(000000,999999);
						$newfilename   = date("y-m-d_h:m:s").$add_name.".".$extension;
						$upload_path   = $_SERVER['DOCUMENT_ROOT']."/uploads/".$newfilename;
						$move          = move_uploaded_file($temp_name,$upload_path);
						$current_date  = date("Y-m-d"); 
						$save_upload   = mysql_query("INSERT INTO `upload_documents` (`form_id`,`user_id`,`attorney_id`,`related_to`,`type_of_case`,
						`name_of_document`,`upload_document_path`,`message`,`upload_date`)VALUES 
						('$form_id','$user_id','$admin_id','$related_to','$case','$document_name','$newfilename','$message','$current_date')") or die(mysql_error());
						if($move)
						{
							echo "<div class='thank_message'>".$filename."Uploaded Successfully. </div>";
						}
						if(($save_upload) && ($move))
						{
							echo "<script type='text/javascript'> alert('Files Uploaded Successfully'); window.close();</script>";
						}
					}
				?>	
				</div>
			</div>