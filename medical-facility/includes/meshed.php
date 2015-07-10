<div class="anesth_search">
	<form>
		<input type="text" name="" id="" placeholder="First Name"/>
		<input type="text" name="" id="" placeholder="Last Name"/>
		<input type="text" name="" id="" placeholder="Date of Birth"/>
		<input type="Submit" name="" id="" value="Search"/>
	</form>
	<div class="anesth_dashbord_client">
		<h1>New Client Application</h1>
		<div class="anesth_box_bg">
			<div class="anesth_row_heading">
				<div class="anesth_span_1">Client No.</div>
				<div class="anesth_span_2">Client Name</div>
				<div class="anesth_span_3">Date of Birth</div>
				<div class="anesth_span_4">Application Date</div>
				<div class="anesth_span_5">Action</div>
			</div>
			<?php  $temp_quy = "SELECT a.id as hireid,a.form_id as formsid,a.hire_id as doc_id,a.user_id as use_id,
				a.date_time as h_date , b . * 
											FROM hire_staff AS a, plantiff_case_type_info AS b
											WHERE a.form_id = b.form_id
											AND a.user_id = b.id
											AND hire_id ='$doctor_id'
											AND b.case_type =2 order by `form_id` desc";
				$count = 0;
				
				$temp_query = mysql_query("SELECT a.id as hireid,a.form_id as formsid,a.hire_id as doc_id,a.user_id as use_id,
				a.date_time as h_date , b . * 
											FROM hire_staff AS a, plantiff_case_type_info AS b
											WHERE a.form_id = b.form_id
											AND a.user_id = b.id
											AND hire_id ='$doctor_id'
											AND b.case_type =2 order by `form_id` desc") or die(mysql_error());
				while($hires = mysql_fetch_object($temp_query))
				{
					$count++;
					
					$hires->formsid;
					$hires->use_id;
?>
				<div class="anesth_row_content">
					<?php 
						if($count>0)
						{
					?>
					<div class="anesth_span_1">
						<?php 
							echo $hires->formsid; 
						?>
					</div>
					<div class="anesth_span_2">
						<?php
							$user_id = $hires->use_id;
							$name = $functions->GetInfoFrompi('plantiff_name',$user_id,'plantiff_name');
							echo ucwords($name);
						?>
					</div>
					<div class="anesth_span_3">
						<?php
						 $temp_date_t = $hires->h_date;
						 echo $date_tiem   = date('Y-m-d',strtotime($temp_date_t));
						?>
					</div>
					<div class="anesth_span_4">
						<?php
							$d_o_b          = $functions->GetD_O_B("p_d_o_b",$user_id);
							echo $date_tiem = date('Y-M-d',strtotime($d_o_b));
						?>
					</div>
					<div class="anesth_span_5">
							<a href="index.php?fid=<?=$hires->formsid; ?>&uid=<?=$hires->use_id;?>" class="dr_check_status">view</a>
					</div>
					<?php
						}
						else
						{
							echo '<h2>There is not record.</h2>';
						}
					?>
				</div>
		<?php
				}
		 ?>
		</div>
	</div>
</div>