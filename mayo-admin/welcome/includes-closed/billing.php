<div class="back_btn_area">
	<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="back_btn_area">
	<a href="#"><input name="" type="button" class="back_btn" value="<?php echo $getdata->GetInfoPlantiffInformation("plantiff_name",$_REQUEST['fid']); ?>"/></a>
</div>
<div class="attorney_client_info">
<h1>Billing</h1>
</div>
 <div class="dashbord_client">	
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
					<?php echo $dateb = date('m-d-Y',strtotime($getapp->date_bill));?>
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
