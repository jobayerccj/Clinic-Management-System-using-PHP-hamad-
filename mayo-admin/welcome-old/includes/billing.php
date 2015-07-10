<h2>Billing</h2>
<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); ?>"/></a>
</div>
<div class="attorney_client_info">
<h1>Add Billing</h1>
</div>
 <script src="<?php echo $sitepath; ?>/js/jquery.js"></script>
<script type="text/javascript">
						$(function()
						{
							$(".delete_billing").click(function()
							{
								var element = $(this);
								var del_id = element.attr("bid");
								var info = 'bid='+del_id;
								if(confirm("Sure you want to delete this update? There is no undo"))
								{
									$.ajax({
										type:"POST",
										url:"../includes/delete-billing.php",
										data:info,
										success:function()
										{
										}
									});
								$(this).parents(".anesth_row_content").animate({ backgroundColor: "#fbc7c7" }, "fast")
.animate({ opacity: "hide" }, "slow");
								}
								return false;
							});
						});
					</script>
<div class="dashbord_client">
				<div class="billing_box_bg">
					<?php /* Add Biiling Code */ ?>
					
					<form name="addcpt" id="otho_group" method="post" action="">
						<select name="user" id="choose_user" onchange="getValuesss(this.value);" required >
						<?php
							$temp_cpt = mysql_query("SELECT a.id, a.user_name, a.first_name, a.last_name, b . * FROM members AS a, hire_staff AS b WHERE a.id = b.hire_id AND a.designation !=6 && b.`form_id`='$_REQUEST[fid]' && b.`user_id`='$_REQUEST[uid]'") or die(mysql_error());
							echo '<option value="">...Select List...</option>';
							while($cpt= mysql_fetch_object($temp_cpt))
							{
						?>
						<option value=<?php echo $cpt->hire_id;?>><?php echo ucwords($getdata->GetObjectById($cpt->hire_id,"first_name"))."&nbsp;".ucwords($getdata->GetObjectById($cpt->hire_id,"last_name"));?></option>
						<?php
							}
						?>
						</select>
						<div id="show_data"></div>
						<!--<textarea name="description" placeholder="Description" required /></textarea>
						<input type="text" name="physician" placeholder="Physician" required />
						<input type="text" name="facility" placeholder="Facility" required />
						<input type="text" name="other" placeholder="Other" required />
						<input type="submit" name="add_cpt" value="Add Bill">-->
					</form>
					<?php
						if(isset($_POST['add_cpt']))
						{
							$ctp_code    = $_POST['cpt'];	
							$description = mysql_real_escape_string($_POST['description']);
							$d_cost      = mysql_real_escape_string($_POST['d_cost']);
							$d_price     = mysql_real_escape_string($_POST['d_price']);
							$f_cost      = mysql_real_escape_string($_POST['f_cost']);
							$f_price     = mysql_real_escape_string($_POST['f_price']);
							$a_cost      = mysql_real_escape_string($_POST['a_cost']);	
							$a_price     = mysql_real_escape_string($_POST['a_price']);
							$query_bill  = mysql_query("INSERT INTO `billing_info` (`form_id`,`user_id`,`cpt_code`,`description`,`doctor_cost`,`doctor_price`,`facility_cost`,`facility_price`,
							`anes_cost`,`anes_price`,`date_bill`) VALUES ('$_REQUEST[fid]','$_REQUEST[uid]','$ctp_code','$description','$d_cost','$d_price','$f_cost','$f_price','$a_cost','$a_price',now())")  or die(mysql_error());
							if($query_bill)
							{
								echo "<div class='thank_message'>Billing is Inserted Successfully</div>";
							}
							else
							{
								echo "<div class='thank_message'>There is something going wrong. Please try again Later.</div>";
							}							
						}
					?>
				</div>
				
	<div class="anesth_box_bg">
		<div class="anesth_row_heading">
			<div class="anesth_span_1">Date</div>
			<div class="anesth_span_2">Code</div>
			<div class="anesth_span_3">Description</div>
			<div class="anesth_span_4">Phy Cost</div>
			<div class="anesth_span_5">Fac Cost</div>
			<div class="anesth_span_6">Anes Cost</div>
			<div class="anesth_span_7">Total Cost</div>
			<div class="anesth_span_8">Phy</div>
			<div class="anesth_span_9">Fac</div>
			<div class="anesth_span_10">Anes</div>
			<div class="anesth_span_11">Total Price</div>
			<div class="anesth_span_12">Action</div>	
		</div>
	<?php
		//echo $queyr="SELECT * , SUM( doctor_cost + doctor_price + facility_cost+facility_price+anes_cost+anes_price) AS total FROM `billing_info`WHERE form_id = '$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'  GROUP BY cpt_code";
		$query = mysql_query("SELECT * , SUM( doctor_cost + anes_cost+anes_cost + facility_cost) AS totalcost, sum(doctor_price + anes_price +facility_price ) AS totalprice
FROM  `billing_info` 
WHERE form_id =  '$_REQUEST[fid]' &&  `user_id` =  '$_REQUEST[uid]'
GROUP BY billing_id") 
		or die(mysql_error());
		while($getapp = mysql_fetch_object($query))
		{
			$uid  = $_REQUEST['fid'];
			$f_id = $_REQUEST['uid']; 
	?>
			<div class="anesth_row_content">
				<div class="anesth_span_1">
					<?php echo "$".$dateb = $getapp->date_bill?>
				</div>
				<div class="anesth_span_2">
					<?php 
						$cpt = $getapp->cpt_code;
						echo $cpt;
					?>
				</div>
				<div class="anesth_span_3">
					<?php 
						echo $des = $getapp->description;
					?>
				</div>
				<div class="anesth_span_4">
					<?php 
						echo "$".number_format($getapp->doctor_cost,2); 
					?>
				</div>
				<div class="anesth_span_5">
					<?php 
						echo "$".number_format($getapp->facility_cost,2);
					?>
				</div>
				<div class="anesth_span_6">
					<?php 
						echo "$".number_format($getapp->anes_cost,2);
					?>
				</div>
				<div class="anesth_span_7">
					<?php 
						echo "$".number_format($getapp->totalcost,2);
					?>
				</div>
				<div class="anesth_span_8">
					<?php 
						echo "$".number_format($getapp->doctor_price,2);
					?>
				</div>
				<div class="anesth_span_9">
					<?php 
						echo "$".number_format($getapp->facility_price,2);
					?>
				</div>
				<div class="anesth_span_10">
					<?php 
						echo "$".number_format($getapp->anes_price,2);
					?>
				</div>
				<div class="anesth_span_11">
					<?php 
						$total = $getapp->totalprice; 
						echo "$".number_format($total,2);
					?>
				</div>
				<div class="anesth_span_12">
					<a href="update-billing.php?fid=<?=$_REQUEST['fid']?>&uid=<?=$_REQUEST['uid']?>&billing_id=<?=$getapp->billing_id?>&action=update">Update</a>/
					<a class="delete_billing" bid=<?=$getapp->billing_id?> href="#" alt="Delete Billing">Delete</a>
				</div>
			</div>
		<?php
		 }
		?>
		<div class="anesth_box_bg">
			<?php 
				//echo $querys= "SELECT SUM(doctor_cost) AS dcost, SUM(facility_cost) AS fcost, SUM(anes_cost) as acost,SUM(doctor_price) AS dprice, SUM(facility_price) AS fprice, SUM(anes_price) as aprice, (SUM(doctor_cost)+SUM(facility_cost)+SUM(anes_cost)) AS totalcost,(SUM(doctor_price)+SUM(facility_price)+SUM(anes_price)) as totalprice,(SUM(doctor_cost)+SUM(facility_cost)+SUM(anes_cost)+SUM(doctor_price)+SUM(facility_price)+SUM(anes_price)) as total FROM `billing_info` WHERE form_id = '$_REQUEST[fid]' && user_id = '$_REQUEST[uid]'";
				$sql = mysql_query("SELECT SUM(doctor_cost) AS dcost, SUM(facility_cost) AS fcost, SUM(anes_cost) as acost,SUM(doctor_price) AS dprice, SUM(facility_price) AS fprice, SUM(anes_price) as aprice, (SUM(doctor_cost)+SUM(facility_cost)+SUM(anes_cost)) AS totalcost,(SUM(doctor_price)+SUM(facility_price)+SUM(anes_price)) as totalprice,(SUM(doctor_cost)+SUM(facility_cost)+SUM(anes_cost)+SUM(doctor_price)+SUM(facility_price)+SUM(anes_price)) as total FROM `billing_info` WHERE form_id = '$_REQUEST[fid]' && user_id = '$_REQUEST[uid]'") or die(mysql_error()); 
				$row = mysql_fetch_object($sql);
			?>
			<div class="anesth_row_heading">
				<div class="anesth_span_1"></div>
				<div class="anesth_span_2"></div>
				<div class="anesth_span_3">
				</div>
				<div class="anesth_span_4"><b>
				$<?php 
					echo number_format($row->dcost,2);
				?>
				</b></div>
				<div class="anesth_span_5"><b>
				$<?php 
					echo number_format($row->fcost,2);
				?>
				</b></div>
				<div class="anesth_span_6"><b>
				$<?php 
					echo number_format($row->acost,2);
				?>
				</b></div>
				<div class="anesth_span_7"><b>
				$<?php 
					echo number_format($row->totalcost,2);
				?>
				</b></div>
				<div class="anesth_span_8">
				<b>
				$<?php 
					echo number_format($row->dprice,2);
				?>
				</b></div>
				<div class="anesth_span_9">
				<b>
					$<?php 
						echo number_format($row->fprice,2);
					?>
				</b>
				</div>
				<div class="anesth_span_10">
				$<?php 
					echo number_format($row->aprice,2);
				?>
				</div>
				<div class="anesth_span_11">
				$<?php 
					echo number_format($row->totalprice,2);
				?>
				</div>
				<div class="anesth_span_12">
				<?php 
					//echo number_format($row->total,2);
				?>
				</div>
				<!--<div class="anesth_span_11">
					<a href="forward-bill.php?fid=<?php//$_REQUEST['fid']?>&uid=<?php //$_REQUEST['uid']?>&action=update">Forward</a>
				</div>-->
			</div>
			<div class="anesth_row_content">
				<div class="anesth_span_1">
					
				</div>
			</div>
		</div>
		<div class="under_decisions">
			<div class="under_dec_bg">
			</div>
		</div>
	</div>
</div>