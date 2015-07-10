	<?php
	ini_set('display_errors',1);  
	error_reporting(E_ALL);
	class AllPanels extends Allfunctions
	{
	
	public function getBilling($doctor_id)
		{
			$quefry = "select a.*,b.*,c.* from `u_fwd_final_billing` as a, `plantiff_information` as b,`plantiff_case_type_info` as c where underwriter_id='$doctor_id' and a.fid=b.form_id and b.form_id=c.form_id and a.fid=c.form_id and c.case_closed=0 group by a.fid";
			$appoint_temp = mysql_query($quefry) or die(mysql_error());
			if(mysql_num_rows($appoint_temp)>0)
			{	
		
?>

		<div class="anesth_dashbord_client">
			<h1>Invoices</h1>
			<div class="anesth_box_bg">
				<div class="anesth_row_heading">
					<div class="anesth_span_1">Client No.</div>
					<div class="anesth_span_2">Name of Document</div>
					<div class="anesth_span_3">Client Name</div>
					<div class="anesth_span_4">Date</div>
					<div class="anesth_span_5">View</div>
				</div>
			<?php		
					while($appt = mysql_fetch_object($appoint_temp))
					{
			?>
						<div class="anesth_row_content">
							<div class="anesth_span_1">
								<?php echo $form_id = $appt->fid; ?>
							</div>
							<div class="anesth_span_2">
								<?php 
									//$user_id = $appt->user_id; 
									echo $name = $appt->name_document;
									
								?>
							</div>
							<div class="anesth_span_3">
								<?php 
									//$user_id = $appt->user_id; 
									echo ucwords($this->GetInfoPlantiffInformation('plantiff_name',$form_id));
								?>
							</div>
							<div class="anesth_span_4">
								<?php $p=$appt->fwd_date; 
								echo date('m-d-Y',strtotime($p));?>
							</div>
							<div class="anesth_span_5">
								<a href="invoices.php?fid=<?php echo $appt->fid;?>&uid=<?php echo $appt->uid;?>&cid=<?php echo $appt->case_type; ?>" class="dr_check_status">View</a>
							</div>
						</div>				
			<?php
					}
			?>
			</div>
		</div>
		
		
<?php
}
else{
		echo "<h1>No Funding Request.</h1>";
}
		}
		
		public function acceptBilling($doctor_id,$b)
		{
			$quefry = "select * from `u_fwd_final_billing` where underwriter_id='$doctor_id' && fid='$b' and flag_accept=0 ";
			$appoint_temp = mysql_query($quefry) or die(mysql_error());
			if(mysql_num_rows($appoint_temp)>0)
			{
?>

		<!--<div class="anesth_dashbord_client">
			<h1>Payment Received</h1>
			<div class="anesth_box_bg">
				<form name="payment_release" method="post" action="">
					<input type="submit" name="paymentreceived" value="Payment Received" class="back_btn" />
				</form>
				<?php /*
					if(isset($_POST['paymentreceived']))
					{
						$u_fwd_final_billing = mysql_query("UPDATE `u_fwd_final_billing` SET `final_b_accept_date` = now(),`flag_accept`=1 WHERE `fid` = '$b' && `underwriter_id`='$doctor_id'") or die(mysql_error());
						if($u_fwd_final_billing)
						{
							echo "<div id='pdone' class='thank_message'>Final Billing Payment Received.</div>";
						}
					}*/
				?>
			</div>
		</div>-->
		
		
<?php
			}
			else
			{			
				$quefry = "select *, max(u_fid) from `u_fwd_final_billing` where underwriter_id='$doctor_id' && fid='$b' and u_fid=(select max(u_fid))";
				$appoint_temp = mysql_query($quefry) or die(mysql_error());
				$biiling_a_date = mysql_fetch_array($appoint_temp);
				$datetemp   =$biiling_a_date['final_b_accept_date'];
				//echo "hello";
				$date_acc = date("m-d-Y",strtotime($datetemp));
				echo "<div id='pdone' class='thank_message'>Final Billing Payment Received Date ".$date_acc.".</div>";
			}
		}
		
		public function getInnerBilling($doctor_id,$formId)
		{
			$updateFlag = mysql_query("UPDATE `u_fwd_final_billing` SET `flag_accept`=1 where underwriter_id='$doctor_id' && fid='$_REQUEST[fid]'") or die(mysql_error());
			$quefry = "select * from `u_fwd_final_billing` where underwriter_id='$doctor_id' and fid='$_REQUEST[fid]'";
			$appoint_temp = mysql_query($quefry) or die(mysql_error());
			if(mysql_num_rows($appoint_temp)>0)
			{
?>

		<div class="anesth_dashbord_client">
			<h1>Final Billing</h1>
			<div class="anesth_box_bg">
				<div class="anesth_row_heading">
					<div class="anesth_span_1">Client No.</div>
					<div class="anesth_span_2">Name of Document</div>
					<div class="anesth_span_3">Client Name</div>
					<div class="anesth_span_4">Date</div>
					<div class="anesth_span_5">Download</div>
				</div>
			<?php		
					while($appt = mysql_fetch_object($appoint_temp))
					{
			?>
						<div class="anesth_row_content">
							<div class="anesth_span_1">
								<?php echo $form_id = $appt->fid; ?>
							</div>
							<div class="anesth_span_2">
								<?php 
									//$user_id = $appt->user_id; 
									echo $name = $appt->name_document;
									
								?>
							</div>
							<div class="anesth_span_3">
								<?php 
									//$user_id = $appt->user_id; 
									echo ucwords($this->GetInfoPlantiffInformation('plantiff_name',$form_id));	
								?>
							</div>
							<div class="anesth_span_4">
								<?php $p=$appt->fwd_date; 
								echo date('m-d-Y',strtotime($p));?>
							</div>
							<div class="anesth_span_5">
								<a href="billing-docs.php?filename=<?php echo $appt->file_path; ?>" class="dr_check_status">Download</a>
							</div>
						</div>				
			<?php
					}
			?>
			</div>
		</div>
<?php
}
		}
		
		public function getAppointment($doctor_id)
		{
?>
		<div class="anesth_dashbord_client">
			<h1>Upcoming Appointments</h1>
			<div class="anesth_box_bg">
				<div class="anesth_row_heading">
					<div class="anesth_span_1">Client No.</div>
					<div class="anesth_span_2">Client Name</div>
					<div class="anesth_span_3">Date of Birth</div>
					<div class="anesth_span_4">Appointment Date</div>
					<div class="anesth_span_5">View Client Information</div>
				</div>
			<?php
				$date_time = date('Y-m-d');
				$finaldate = date('Y-m-d', strtotime($date_time. ' + 60 day'));
				$quefry = "SELECT a . * , b . * , c . * 
					FROM plantiff_information AS a, hire_staff AS b, appointment_doctor AS c,plantiff_case_type_info as d
					WHERE a.form_id = b.form_id
					AND a.form_id = c.form_id
					AND a.form_id=d.form_id
					AND d.case_closed=0
					AND b.hire_id ='$doctor_id'
					AND CAST( STR_TO_DATE( SUBSTRING( c.date_appt, 1, 11 ) ,  '%m-%d-%Y' ) AS DATE ) 
					BETWEEN  '$date_time'
					AND  '$finaldate' ORDER BY CAST( STR_TO_DATE( SUBSTRING( c.date_appt, 1, 11 ) ,  '%m-%d-%Y' ) AS DATE ) ASC ";
				$appoint_temp = mysql_query($quefry) or die(mysql_error());
				
				if(mysql_num_rows($appoint_temp)>0)
				{
					while($appt = mysql_fetch_object($appoint_temp))
					{
			?>
						<div class="anesth_row_content">
							<div class="anesth_span_1">
								<?php echo $form_id = $appt->form_id; ?>
							</div>
							<div class="anesth_span_2">
								<?php 
									$user_id = $appt->user_id; 
									$name = $this->GetInfoPlantiffInformation('plantiff_name',$form_id);
									echo ucwords($name);
								?>
							</div>
							<div class="anesth_span_3">
								<?php 
									$p_date = $this->GetInfoPlantiffInformation('p_d_o_b',$form_id); 
									echo $p_date;
								?>
							</div>
							<div class="anesth_span_4">
								<?php echo $appt->date_appt;?>
							</div>
							<div class="anesth_span_5">
								<a href="check-status.php?fid=<?php echo $appt->form_id; ?>&uid=<?php echo $appt->user_id; ?>&cid=<?php echo $appt->case_type;?>" class="dr_check_status">view</a>
							</div>
						</div>				
			<?php
					}
				}
				else
				{
					echo "<h1 style='text-align:center'>No Appointments Scheduled at this time.</h2>";
				}
			?>
			</div>
		</div>
<?php
		}
		public function searchFunction()
		{
?>
			<form name="search" method="post" action="">
				<input type="text" name="plantiffName" id="" value="<?php if(isset($_REQUEST['plantiffName'])) echo $_REQUEST['plantiffName']; ?>" placeholder="First Name"/>
				<input type="text" name="plantiflName" id="" value="<?php if(isset($_REQUEST['plantiflName'])) echo $_REQUEST['plantiflName']; ?>" placeholder="Last Name"/>
				<input type="text" name="dob" id="popupDatepicker" value="<?php if(isset($_REQUEST['dob'])) echo $_REQUEST['dob']; ?>" placeholder="Date of Birth"/>
				<?php //$this->GetCasesList(); ?>
				<?php
					$tempgetstates = mysql_query("SELECT * FROM `type_of_cases` order by `case_id` asc") or die(mysql_error());
					echo '<select name="type_of_cases" class="case_list" />';
					echo '<option value="">...Select...</option>';
					while($getstates = mysql_fetch_object($tempgetstates))
					{
				?>
						<option value="<?php echo $getstates->case_id; ?>" 
						<?php
							if($_REQUEST['type_of_cases'] == $getstates->case_id)
							{ 
							echo 'selected="selected"';
							}
							?>>
							<?php echo $getstates->name_of_case; ?>
						</option>;
				<?php
					}
					echo '</select>';
				?>
				<input type="Submit" name="search_data" id="" value="Search"/>
				<a class="reset_button" href="javascript:location.reload(true)">Reset</a>
			</form>
<?php
		}
		
		public function getClientRecords($doctor_id,$limit,$adjacent,$search)
		{	
?>
		<div class="anesth_search">
			<?php $this->searchFunction(); ?>
			<div class="anesth_dashbord_client">
				<h1>New Client Application</h1>
				<div class="anesth_box_bg">
					<div class="anesth_row_heading">
						<div class="dr_new_client_11">Client No.</div>
						<div class="dr_new_client_21">Client Name</div>
						<div class="dr_new_client_31">Date of Birth</div>
						<div class="dr_new_client_41">Application Date</div>
						<div class="dr_new_client_51">Case Type</div>
						<div class="dr_new_client_61">Schedule</div>
						<div class="dr_new_client_71">View Client Information</div>
					</div>
					<?php
					if(isset($_REQUEST['page']))
					{
						$page = $_REQUEST['page'];
						if($page==1)
						{
							$start = 0;  
						}
						else
						{
							$start = ($page-1)*$limit;
						}
					}
					else
					{
						$page = 0;
						$start = 0;
					}
					
					$tempQueryTotalRows      = "";
/*******************************                   Search Starts from here                 ******************************************/
					if(isset($search) && ($search!=""))
					{
						list($fname,$lname,$dob,$case_type) = $search;
						$fname;
						$lname;
						$fullname=$fname." ".$lname;
						$dob;
						$case_type;
						$tempQueryTotalRows ="SELECT a.id AS hireid, a.form_id AS formsid, a.hire_id AS doc_id, a.user_id AS use_id, a.date_time AS h_date, b. * , c . * 
						FROM hire_staff AS a, plantiff_case_type_info AS b, plantiff_information AS c
						WHERE a.form_id = b.form_id
						&& a.user_id = b.id
						&& a.form_id = c.form_id
						&& a.user_id = c.id
						&& c.form_id = b.form_id
						&& c.id = b.id
						&& b.case_closed=0
						&& hire_id =  $doctor_id";
						if($fname!="")
						{
							$tempQueryTotalRows .= " && c.plantiff_name LIKE '%".$fname."%'";
						}
						if($lname!="")
						{
							$tempQueryTotalRows .= " && c.plantiff_name LIKE '%".$lname."%'";
						}
						if($fname!="" && $lname!="")
						{
							$tempQueryTotalRows .= " && c.plantiff_name LIKE '%".$fullname."%'";
						}
						if($dob!="")
						{
							$tempQueryTotalRows .= " && c.p_d_o_b LIKE '%$dob%'";
						}
						if($case_type!="")
						{
							$tempQueryTotalRows .= " && b.case_type = '$case_type'";
						}
						else
						{
							$tempQueryTotalRows .= " ";
						}
						//echo $tempQueryTotalRows;
						
/***********************$toatal is used to count the no of the rows for the pagin ation to work************************************/

						$totalRo   		= mysql_query($tempQueryTotalRows) or die(mysql_error());
						$rows           = mysql_num_rows($totalRo);
						$temp_query     = mysql_query($tempQueryTotalRows."ORDER BY a.`form_id` desc limit $start,$limit");
					}
					else
					{
					
/******************************Part shown without any search in the home page that is the index.php*********************************/
						$q = "SELECT a.id AS hireid, a.form_id AS formsid, a.hire_id AS doc_id, a.user_id AS use_id, a.date_time AS h_date, b. * , c . * 
						FROM hire_staff AS a, plantiff_case_type_info AS b, plantiff_information AS c
						WHERE a.form_id = b.form_id
						AND a.user_id = b.id
						AND a.form_id = c.form_id
						AND a.user_id = c.id
						AND c.form_id = b.form_id
						AND c.id = b.id
						&& b.case_closed=0
						AND hire_id =  $doctor_id
						ORDER BY a.`form_id` ";
						$tempQueryTotalRows = mysql_query($q) or die(mysql_error());
						
						$rows = mysql_num_rows($tempQueryTotalRows);
						$srch = "SELECT a.id AS hireid, a.form_id AS formsid, a.hire_id AS doc_id, a.user_id AS use_id, a.date_time AS h_date, b. * , c . * 
						FROM hire_staff AS a, plantiff_case_type_info AS b, plantiff_information AS c
						WHERE a.form_id = b.form_id
						AND a.user_id = b.id
						AND a.form_id = c.form_id
						AND a.user_id = c.id
						AND c.form_id = b.form_id
						AND c.id = b.id
						&& b.case_closed=0
						AND hire_id =  $doctor_id
						ORDER BY a.`form_id` desc limit $start,$limit";
						$temp_query = mysql_query($srch) or die(mysql_error());
					}
						
						//$rows = mysql_num_rows($tempQueryTotalRows);
						
						if($rows>0)
						{
							while($hires = mysql_fetch_object($temp_query))
							{
							
								$form_id = $hires->formsid;
								$hires->use_id;
					?>
								<div class="anesth_row_content">
									<div class="dr_new_client_11">
										<?php 
											echo $hires->formsid; 
										?>
									</div>
									<div class="dr_new_client_21">
										<?php
											$user_id = $hires->formsid;
											$name = $this->GetInfoPlantiffInformation('plantiff_name',$form_id);
											echo ucwords($name);
										?>
									</div>
									<div class="dr_new_client_31">
										<?php
										 echo $temp_date_t = $this->GetInfoPlantiffInformation('p_d_o_b',$form_id);
										?>
									</div>
									<div class="dr_new_client_41">
										<?php
											$d_o_b          = $this->GetObjectFromPCTI("date_time",$form_id);
											echo $date_tiem = date('m-d	-Y',strtotime($d_o_b));
										?>
									</div>
									<div class="dr_new_client_51">
										<?php
											$case_type      = $this->GetObjectFromPCTI("case_type",$form_id);
											echo $this->getNameCase($case_type);
										?>
									</div>
										<?php
											$designation = $_SESSION['designation'];
											switch($designation)
											{
												case '6':
												echo '<div class="dr_new_client_61"><a href="messages.php?fid='.$hires->formsid.'&uid='.$hires->use_id.'&cid='.$hires->case_type.'" class="Messages">Messages</a></div><div class="dr_new_client_71">
												<a href="check-status.php?fid='.$hires->formsid.'&uid='.$hires->use_id.'&cid='.$hires->case_type.'" class="dr_check_status">Check Status</a>
												</div>';
												break;
												
												case '4';
												echo '<div class="dr_new_client_61"><a href="messages.php?fid='.$hires->formsid.'&uid='.$hires->use_id.'" class="Messages">Messages</a></div> 
												<div class="dr_new_client_71">
												<a href="check-status.php?fid='.$hires->formsid.'&uid='.$hires->use_id.'&cid='.$hires->case_type.'" class="dr_check_status">Check Status</a></div>';
												break;
												
												case '1';
												echo '<div class="dr_new_client_61"><a href="messages.php?fid='.$hires->formsid.'&uid='.$hires->use_id.'" class="Messages">Messages</a></div> 
												<div class="dr_new_client_71">
												<a href="check-status.php?fid='.$hires->formsid.'&uid='.$hires->use_id.'&cid='.$hires->case_type.'" class="dr_check_status">Check Status</a></div>';
												break;
												
												default;
												echo '<div class="dr_new_client_61"><a href="appointment-schedule.php?fid='.$hires->formsid.'&uid='.$hires->use_id.'" class="dr_appointment">Appointment</a></div><div class="dr_new_client_71"><a href="check-status.php?fid='.$hires->formsid.'&uid='.$hires->use_id.'" class="dr_check_status">Check Status</a>';
											}
										?>

											
									</div>
								</div>
					<?php
							}
						}
						else
						{
							echo "<h1 style='text-align:center;'>There is no Record</h1>";
						}
						$this->pagination($limit,$adjacent,$rows,$page);
					?>
				</div>
			</div>
		</div>			
<?php
	}
	function pagination($limit,$adjacents,$rows,$page){	
	$pagination='';
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$prev_='';
	$first='';
	$lastpage = ceil($rows/$limit);	
	$next_='';
	$last='';
	if($lastpage > 1)
	{
		//previous button
		if ($page > 1) 
			$prev_.= "<a class='page-numbers' href=\"?page=$prev\">previous</a>";
		else{
			//$pagination.= "<span class=\"disabled\">previous</span>";	
			}
		//pages	
		if ($lastpage < 5 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
		$first='';
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
			}
			$last='';
		}
		elseif($lastpage > 3 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			$first='';
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
			$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
		    $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last.= "<a class='page-numbers' href=\"?page=$lastpage\">Last</a>";			
			}
			//close to end; only hide early pages
			else
			{
			    $first.= "<a class='page-numbers' href=\"?page=1\">First</a>";	
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a class='page-numbers' href=\"?page=$counter\">$counter</a>";					
				}
				$last='';
			}
			}
		if ($page < $counter - 1) 
			$next_.= "<a class='page-numbers' href=\"?page=$next\">next</a>";
		else{
			//$pagination.= "<span class=\"disabled\">next</span>";
			}
		$pagination = "<div class=\"pagination\">".$first.$prev_.$pagination.$next_.$last;
		//next button
		$pagination.= "</div>\n";		
	}
	echo $pagination;  
}

	/* meshed case for case_id=2,4*/
	function meshedView($row)
	{
?>
<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="attorney_client_info">
  <h1>Client Information</h1>
<div class="view_client_row">
  <div class="client_left">
    <label>Client Name</label>
    <label class="filled_label"><?php echo $row['plantiff_name']; ?></label>
  </div>
  <div class="client_right">
    <label>Date</label>
    <label class="filled_label"><?php echo $row['p_date']; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Mobile No.</label>
    <label class="filled_label"><?php echo $row['p_mob_no']; ?></label>
  </div>
  <div class="client_right">
    <label>Home No.</label>
    <label class="filled_label"><?php echo $row['p_home_no']; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Office No.</label>
    <label class="filled_label"><?php echo $row['p_office_no']; ?></label>
  </div>
  <div class="client_right">
    <label>Email Address</label>
    <label class="filled_label"><?php echo $row['p_email_address']; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Date of Birth</label>
    <label class="filled_label"><?php echo $row['p_d_o_b']; ?></label>
  </div>
  <div class="client_right">
    <label>Driving License</label>
    <label class="filled_label"><?php echo $row['p_driving_licence']; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_right"><label>Address</label>
  <label class="filled_label"><?php echo $row['p_address']; ?></label>
</div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>State</label>
    <label class="filled_label">
    <?php 
		$m_state = $row['p_state']; 
		if($m_state!=""){ echo $state1 = $this->GetStatebyStateCode($m_state);}
	?>
    </label>
  </div>
  <div class="client_right">
    <label>City</label>
    <label class="filled_label"><?php echo $row['p_city']; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Zip Code</label>
    <label class="filled_label"><?php echo $row['p_zip_code']; ?></label>
  </div>
  <div class="client_right">
    <label>Preferred Choice of Doctor</label>
    <label class="filled_label"><?php echo $row['p_preferred_coice']; ?></label>
  </div>
</div>
  <div class="view_client_row">
    <h1>Attorney / Case Manager Information</h1>
    <div class="view_client_row">
      <div class="client_left">
      <label>Firm</label>
      <label class="filled_label"><?php echo $row['att_firm']; ?></label>
      </div>
    </div>
    <div class="view_client_row">
     <div class="client_left">
      <label>Address</label>
      <label class="filled_label"><?php echo $row['att_address']; ?></label>
      </div>
    </div>
    <div class="view_client_row">
      <div class="client_left">
        <label>Phone</label>
        <label class="filled_label"><?php echo $row['att_phone']; ?></label>
      </div>
      <div class="client_right">
        <label>Fax</label>
        <label class="filled_label"><?php echo $row['att_fax']; ?></label>
      </div>
    </div>
    <div class="view_client_row">
      <div class="client_left">
        <label>Firm Contact Person</label>
        <label class="filled_label"><?php echo $row['att_contact_person']; ?></label>
      </div>
      <div class="client_right">
        <label>Position</label>
        <label class="filled_label"><?php echo $row['att_position']; ?></label>
      </div>
    </div>
      <div class="client_left">
        <label>Contact E-mail</label>
        <label class="filled_label"><?php echo $row['att_email']; ?></label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Please also provide the following, if Available</h1>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Signed Medical Records Release Form</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php
		$signed_medical_records = $row['signed_medical_records'];
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	  ?>
        <input type="radio" name="signed_medical" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=sm')" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
        <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "Uploaded"; }else{echo "Upload";} ?>
	<?php
		}
		else
		{
	?>
		<input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
        <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "Uploaded"; }else{echo "Upload";} ?>
	<?php
		}
	?>
	  </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="n/a"){ echo "checked"; } ?> id=""/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="will fax"){ echo "checked"; } ?> id=""/>
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Product Label</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php 
		$product_label = $row['product_label'];
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	  ?>
        <input type="radio" name="police_report" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=pl')" value="<?=$product_label?>" id="" <?php if(isset($product_label) && $product_label=="download"){ echo "checked"; } ?> />
        <?php if(isset($product_label) && $product_label=="download"){ echo "Uploaded"; }else{echo "Upload";} ?> </label>
	<?php	
		}
		else
		{
	?>
		<input type="radio" name="police_report" value="<?=$product_label?>" id="" <?php if(isset($product_label) && $product_label=="download"){ echo "checked"; } ?> />
        <?php if(isset($product_label) && $product_label=="download"){ echo "Uploaded"; }else{ echo "Upload"; } ?> </label>
	<?php
		}
	?>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$product_label?>" id=""<?php if(isset($product_label) && $product_label=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$product_label?>" id="" <?php if(isset($product_label) && $product_label=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Bill</label>
    </div>

    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php 
		$medical_bi = $row['medial_bill']; 
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	?>
        <input type="radio" name="medical_bill" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ml')" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		 <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
       <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "Uploaded"; }else{echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="n/a"){ echo "checked"; } ?>/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Records</label>
    </div>
  
    <div class="form_field_right">
      <label class="checkbox_label">
	 <?php 
		$medical_record = $row['medical_record']; 
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	?>
        <input type="radio" name="medical_records" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=mr')" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
        <?php if(isset($medical_record) && $medical_record=="download"){ echo "Uploaded"; }else{echo "Upload";} ?> </label>
	<?php
		}
		else
		{
	?>
		<input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
        Download </label>
	<?php
		}
	?>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <h1>Optional Documents</h1>
    <div class="form_field_left">
      <label>Travel Bills</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php 
		$travel_bill=$row['travel_bills']; 
		if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	?>
        <input type="radio" name="travel_bills" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=tb')" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
       <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "Uploaded"; }else{echo "Upload";} ?></label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Other</label>
    </div>
   
    <div class="form_field_right">
      <label class="checkbox_label">
		 <?php 
			$other_bill = $row['other'];
			if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
			{
		?>
			<input type="radio" name="other_records" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ob')" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?>/>
		<?php
			}
		?>
        <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "Uploaded"; }else{ echo "Upload"; } ?></label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
</div>
<?php
	}
	
	/*ortho case for case_id=1,3,5*/
	
	function orthoView($row)
	{
?>
<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="attorney_client_info">
  <h1>Client Information</h1>
  <div class="view_client_row">
    <div class="client_left">
      <label>Client Name</label>
      <label class="filled_label"><?php echo $row['plantiff_name']; ?></label>
    </div>
    <div class="client_right">
      <label>Date</label>
      <label class="filled_label"><?php echo $row['p_date']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Mobile No.</label>
      <label class="filled_label"><?php echo $row['p_mob_no']; ?></label>
    </div>
    <div class="client_right">
      <label>Home No.</label>
      <label class="filled_label"><?php echo $row['p_home_no']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Office No.</label>
      <label class="filled_label"><?php echo $row['p_office_no']; ?></label>
    </div>
    <div class="client_right">
      <label>Email Address</label>
      <label class="filled_label"><?php echo $row['p_email_address']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Date of Birth</label>
      <label class="filled_label"><?php echo $row['p_d_o_b']; ?></label>
    </div>
    <div class="client_right">
      <label>Driving License</label>
      <label class="filled_label"><?php echo $row['p_driving_licence']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
    <label>Address</label>
    <label class="filled_label add_area"><?php echo $row['p_address']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>State</label>
      <label class="filled_label">
        <?php 
					$o_state = $row['p_state']; 
					if($o_state!=""){echo $statess = $this->GetStatebyStateCode($o_state);}
				?>
      </label>
    </div>
    <div class="client_right">
      <label>City</label>
      <label class="filled_label"><?php echo $row['p_city']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Zip Code</label>
      <label class="filled_label"><?php echo $row['p_zip_code']; ?></label>
    </div>
    <div class="client_right">
      <label>Preferred Choice of Doctor</label>
      <label class="filled_label"><?php echo $row['p_preferred_coice']; ?></label>
    </div>
  </div>
  <!--<div class="view_client_row">
    <div class="client_left">
    <label>Auto Insurance Carrier (Auto collision only)</label>
    <label class="filled_label">1<?php //echo $row['auto_insurance']; ?></label>
    </div>
  </div>-->
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Client Attorney&rsquo;s Information</h1>
  <div class="view_client_row">
   <div class="client_left">
    <label>Firm</label>
    <label class="filled_label"><?php echo $row['att_firm']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
    <label>Address</label>
    <label class="filled_label add_area"><?php echo $row['att_address']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Phone</label>
      <label class="filled_label"><?php echo $row['att_phone']; ?></label>
    </div>
    <div class="client_right">
      <label>Fax</label>
      <label class="filled_label"><?php echo $row['att_fax']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Firm Contact Person</label>
      <label class="filled_label"><?php echo $row['att_contact_person']; ?></label>
    </div>
    <div class="client_right">
      <label>Position</label>
      <label class="filled_label"><?php echo $row['att_position']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Contact E-mail</label>
      <label class="filled_label"><?php echo $row['att_email']; ?></label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Defendant Insurance Information ( information is neededwhether or not in suit)</h1>
  <div class="view_client_row">
    <div class="client_left">
    <label>Defendant Name</label>
    <label class="filled_label"><?php echo $row['defendant_name']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
    <label>Insurance Company</label>
    <label class="filled_label"><?php echo $row['insurance_company']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Claim No</label>
      <label class="filled_label"><?php echo $row['claim_no']; ?></label>
    </div>
    <div class="client_right">
      <label>Bodily Injury Limits</label>
      <label class="filled_label"><?php echo $row['d_limits']; ?></label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Incident Information</h1>
  <div class="view_client_row">
    <div class="client_left">
    <label>Date of Injury</label>
    <label class="filled_label"><?php echo $row['date_injury']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
   <div class="client_left">
    <label>Location of Event</label>
    <label class="filled_label"><?php echo $row['location_of_event']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Description of the Event</label>
      <label class="filled_label"><?php echo $row['description_of_event']; ?></label>
    </div>
    <div class="client_right">
      <label>Specify Body Part to be Evaluated</label>
      <label class="filled_label"><?php echo $row['description_of_injury']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="attorney_left">
      <div class="form_field_left">
        <label>UM / UIM</label>
      </div>
      <?php $check = $row['um_uim']; ?>
      <div class="form_field_right">
        <label class="checkbox_label">
          <input type="radio" name="um_uim1" value="<?= $check ?>" <?php if(isset($check) && $check == "yes"){ echo "checked";} ?> />
          Yes </label>
        <label class="checkbox_label">
          <input type="radio" name="um_uim2" value="<?= $check ?>" <?php if(isset($check) && $check =="no") { echo "checked"; } ?> />
          No </label>
        <label class="checkbox_label">
          <input type="radio" name="um_uim3" <?php if(isset($check) && $check =="n/a") echo "checked"; ?> value="<?php echo $row['um_uim'];?>"   id="" />
          N/A </label>
      </div>
    </div>
  </div>
  <div class="view_client_row">
    <div class="attorney_left">
      <div class="form_field_left">
        <label>Client ever claim bankruptcy ?</label>
      </div>
      <?php
		$bankrupty = $row['client_bankrupty'];
	  ?>
      <div class="form_field_right">
        <label class="checkbox_label">
          <input type="radio" name="bankruptcy1" value="<?= $bankrupty ?>" <?php if(isset($bankrupty) && $bankrupty == "yes"){echo "checked";}?>  />
          Yes </label>
        <label class="checkbox_label">
          <input type="radio" name="bankruptcy2" value="<?= $bankrupty ?>" <?php if(isset($bankrupty) && $bankrupty == "no"){echo "checked";}?> />
          No </label>
        <label class="checkbox_label">
          <input type="radio" name="bankruptcy3" value="<?= $bankrupty ?>" <?php if(isset($bankrupty) && $bankrupty == "n/a"){echo "checked";}?> />
          N/A </label>
      </div>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <h1>Please also provide the following, if Available</h1>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Signed Medical Records Release Form</label>
    </div>
    <div class="form_field_right">
      <label class="checkbox_label">
	  	<?php
			$signed_medical_records = $row['signed_medical_records'];
			if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
			{
		?>
			<input type="radio" name="signed_medical" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=sm')" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
		<?php 
			}
			else
			{ 
		?>
			<input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "checked"; } ?> />
		<?php 
			} 
		?>
        <?php if(isset($signed_medical_records) && $signed_medical_records=="download"){ echo "Uploaded"; }else{echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="n/a"){ echo "checked"; } ?> id=""/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="signed_medical" value="<?=$signed_medical_records?>" <?php if(isset($signed_medical_records) && $signed_medical_records=="will fax"){ echo "checked"; } ?> id=""/>
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Police Report</label>
    </div>
    <?php $polic_acc_rep = $row['police_accident_report']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	 <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=pr')" name="police_report" value="<?=$polic_acc_rep?>" id="" <?php if(isset($polic_acc_rep) && $polic_acc_rep=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="police_report" value="<?=$polic_acc_rep?>" id="" <?php if(isset($polic_acc_rep) && $polic_acc_rep=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        Download </label>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$polic_acc_rep?>" id=""<?php if(isset($polic_acc_rep) && $polic_acc_rep=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="police_report" value="<?=$polic_acc_rep?>" id="" <?php if(isset($polic_acc_rep) && $polic_acc_rep=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Bill</label>
    </div>
    <?php $medical_bi = $row['medial_bill']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	 <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" name="medical_bill" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ml')" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        <?php if(isset($medical_bi) && $medical_bi=="download"){ echo "Uploaded"; }else{echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="n/a"){ echo "checked"; } ?>/>
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_bill" value="<?=$polic_acc_rep?>" id="" <?php if(isset($medical_bi) && $medical_bi=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Medical Records</label>
    </div>
    <?php $medical_record = $row['medical_record']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
			<input type="radio" name="medical_records" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=mr')" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
			<input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="download"){ echo "checked"; } ?> />
	<?php 
		} 
	?>
        <?php if(isset($medical_record) && $medical_record=="download"){ echo "Uploaded"; }else{echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="medical_records" value="<?=$polic_acc_rep?>" <?php if(isset($medical_record) && $medical_record=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="attorney_client_info">
  <div class="view_client_row">
    <h1>Optional Documents</h1>
    <div class="form_field_left">
      <label>Travel Bills</label>
    </div>
    <?php $travel_bill=$row['travel_bills']; ?>
    <div class="form_field_right">
      <label class="checkbox_label"> 
	 <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" name="travel_bills" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=tb')" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "Uploaded"; }else{ echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="travel_bills" value="<?=$travel_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="form_field_left">
      <label>Other</label>
    </div>
    <?php $other_bill = $row['other']; ?>
    <div class="form_field_right">
      <label class="checkbox_label">
	  <?php
	  	if($_SESSION['designation']=='8' ||$_SESSION['designation']=='7' || $_SESSION['designation']=='2')
		{
	 ?>
        <input type="radio" onchange="window.open('<?php echo $path; ?>/upload-docs.php?fid=<?php echo $_REQUEST['fid']; ?>&uid=<?php echo $_REQUEST['uid']; ?>&mid=<?php echo $this->GetDetailsByUsername($_SESSION['username'],"id");?>&cid=2&name=ob')" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
		else
		{
	?>
		<input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "checked"; } ?> />
	<?php
		}
	?>
        <?php if(isset($travel_bill) && $travel_bill=="download"){ echo "Uploaded"; }else{echo "Upload";} ?> </label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="n/a"){ echo "checked"; } ?> />
        N/A </label>
      <label class="checkbox_label">
        <input type="radio" name="other_records" value="<?=$other_bill?>" <?php if(isset($travel_bill) && $travel_bill=="will fax"){ echo "checked"; } ?> />
        Will Fax </label>
    </div>
  </div>
</div>
<?php
}	
	/*Medical records Request case for case_id=6*/
	
	function medicalView($row)
	{
?>
<div class="back_btn_area">
<a href="index.php"><input name="" type="button" class="back_btn" value="<<Back"/></a>
</div>
<div class="attorney_client_info">
    <h1>Client Information</h1>
  <div class="view_client_row">
    <div class="client_left">
      <label>Client Name</label>
      <label class="filled_label"><?php echo $row['plantiff_name']; ?></label>
    </div>
    <div class="client_right">
      <label>Date</label>
      <label class="filled_label"><?php echo $row['p_date']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Mobile No.</label>
      <label class="filled_label"><?php echo $row['p_mob_no']; ?></label>
    </div>
    <div class="client_right">
      <label>Home No.</label>
      <label class="filled_label"><?php echo $row['p_home_no']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Office No.</label>
      <label class="filled_label"><?php echo $row['p_office_no']; ?></label>
    </div>
    <div class="client_right">
      <label>Email Address</label>
      <label class="filled_label"><?php echo $row['p_email_address']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Date of Birth</label>
      <label class="filled_label"><?php echo $row['p_d_o_b']; ?></label>
    </div>
    <div class="client_right">
      <label>Driving License</label>
      <label class="filled_label"><?php echo $row['p_driving_licence']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <label>Address</label>
    <label class="filled_label add_area"><?php echo $row['p_address']; ?></label>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>State</label>
      <label class="filled_label">
        <?php 
						$m_state = $row['p_state']; 
						if($m_state!=""){$state1 =$this->GetStatebyStateCode($m_state);}
					?>
      </label>
    </div>
    <div class="client_right">
      <label>City</label>
      <label class="filled_label"><?php echo $row['p_city']; ?></label>
    </div>
  </div>
  <div class="view_client_row">
    <div class="client_left">
      <label>Zip Code</label>
      <label class="filled_label"><?php echo $row['p_zip_code']; ?></label>
    </div>
    <div class="client_right">
      <label>Preferred Choice of Doctor</label>
      <label class="filled_label"><?php echo $row['p_preferred_coice']; ?></label>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->

<div class="attorney_client_info">
  <div class="view_client_row">
    <h1>Client Attorney&rsquo;s Information</h1>
    <div class="view_client_row">
      <label>Firm</label>
      <label class="filled_label"><?php echo $row['att_firm']; ?></label>
    </div>
    <div class="view_client_row">
      <label>Address</label>
      <label class="filled_label"><?php echo $row['att_address']; ?></label>
    </div>
    <div class="view_client_row">
      <div class="client_left">
        <label>Phone</label>
        <label class="filled_label"><?php echo $row['att_phone']; ?></label>
      </div>
      <div class="client_right">
        <label>Fax</label>
        <label class="filled_label"><?php echo $row['att_fax']; ?></label>
      </div>
    </div>
    <div class="view_client_row">
      <div class="client_left">
        <label>Firm Contact Person</label>
        <label class="filled_label"><?php echo $row['att_contact_person']; ?></label>
      </div>
      <div class="client_right">
        <label>Position</label>
        <label class="filled_label"><?php echo $row['att_position']; ?></label>
      </div>
    </div>
    <div class="view_client_row">
      <div class="client_left">
        <label>Contact E-mail</label>
        <label class="filled_label"><?php echo $row['att_email']; ?></label>
      </div>
    </div>
  </div>
</div>
<!--attorney_client_info_end-->
<div class="view_client_row">
<?php 
	$sql = mysql_query("SELECT * FROM `medial_records_request` WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'") or die(mysql_error());
	if(mysql_num_rows($sql)>0)
	{
		$i=1;
		while($data = mysql_fetch_object($sql))
		{
	?>
<h1>Start Date of Service Form (<?php echo $i; ?>)</h1>
<div class="view_client_row">
  <div class="client_left">
    <label>Start Date of Service</label>
    <label class="filled_label"><?php echo $data->s_date_service; ?></label>
  </div>
  <div class="client_right">
    <label>End Date of Service</label>
    <label class="filled_label"><?php echo $data->e_date_service; ?></label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Facility or Physician's Name</label>
    <label class="filled_label">
      <?php $facility = $data->facility_name; echo ucwords($facility); ?>
    </label>
  </div>
  <div class="client_right">
    <label>Office No</label>
    <label class="filled_label"><?php echo $data->office_no; ?></label>
  </div>
</div>
<div class="view_client_row">
  <label>Address</label>
  <label class="filled_label add_area"><?php echo $data->address; ?></label>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>State</label>
    <label class="filled_label">
      <?php $state = $data->state; echo ucwords($state); ?>
    </label>
  </div>
  <div class="client_right">
    <label>City</label>
    <label class="filled_label">
      <?php $city = $data->city; echo ucwords($city); ?>
    </label>
  </div>
</div>
<div class="view_client_row">
  <div class="client_left">
    <label>Zip Code</label>
    <label class="filled_label"><?php echo $data->zip_code; ?></label>
  </div>
  <div class="client_left">
    <label>Notes- Type of Records to Order</label>
    <label class="filled_label"><?php echo $data->type_of_records_other; ?></label>
  </div>
</div>
<?php
	$i++;
	}
}
else
{
	echo "No Medical Record Found";
}
?>
<?php
	}
	function statusShow()
	{
?>
		<div class="anesth_dashbord_client">
		<h1>Current Status</h1>
		<div class="anesth_box_bg">
			<div class="anesth_row_heading">
				<div class="anesth_span_1">Client No.</div>
				<div class="anesth_span_2">Client Name</div>
				<div class="anesth_span_3">Date of Birth</div>
				<div class="anesth_span_4">Status Date</div>
				<div class="anesth_span_5">Status</div>
			</div>
			<?php
				$temp_status = mysql_query("SELECT * FROM status_update WHERE form_id = '$_REQUEST[fid]' ORDER by id desc") or die(mysql_error());
				while($status = mysql_fetch_object($temp_status))
				{
			?>
				<div class="anesth_row_content">
					<div class="anesth_span_1"><?php echo $form_RID=$status->form_id?></div>
					<div class="anesth_span_2">
						<?php 
							$s_u_id = $status->user_id;
							$fname  = $this->GetInfoPlantiffInformation("plantiff_name",$form_RID);
							echo ucwords($fname);
						?>
					</div>
					<div class="anesth_span_3"><?php echo $this->GetInfoPlantiffInformation("p_d_o_b",$form_RID);?>
				 </div>
					<div class="anesth_span_4"><?php echo date('m-d-Y',strtotime($status->date_status)); ?> </div>
					<div class="anesth_span_4">
						<?=$status->status_messages?>
						<?php 
							if(!empty($status->status_notes))
							{
								echo '<div class="btn-group">
										<a class="btn btn-default" href="#" data-featherlight="#fl'.$status->id.'" data-featherlight-variant="fixwidth">See Notes</a>
									  </div>';
								echo '<div class="lightbox" id="fl'.$status->id.'">
											<h2>Note</h2>
											<p>'.$status->status_notes.'</p>
									  </div>';
							}
						?>
					</div>
				</div>
			<?php
				}
			?>
		</div>
	</div>
<?php
	}
	function popUp()
	{
?>	
		<script src="http://code.jquery.com/jquery-1.7.0.min.js"></script>
		<script src="../popup/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
		<link href="../popup/featherlight.min.css" rel="stylesheet" type="text/css"/>
		<link href="../popup/style.css" rel="stylesheet" type="text/css"/>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//stats.g.doubleclick.net/dc.js','ga');
			ga('create', 'UA-5342062-6', 'noelboss.github.io');
			ga('send', 'pageview');
		</script>
<?php
	}
}

?>
