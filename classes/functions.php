<?php
	$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
	require_once($path);
	require_once($config);
	class Allfunctions
	{
			public function GetRoles($var)
			{
				$tempdesignation = mysql_query("SELECT * FROM $var") or die(mysql_error());
				echo '<select name="designation" class="sel_reg_form" required />'; 
				echo '<option value="">...Select...</option>';
				while($designation=mysql_fetch_object($tempdesignation))
				{
					echo '<option value="'.$designation->id.'">'.$designation->designation.'</option>';
				}
				echo  '</select>';
				
			}
			
			public function GetDetailsByUsername($username1,$prof)
			{
				$tempinfo = mysql_query("SELECT $prof FROM `members` where `user_name`='$username1'") or die(mysql_error());
				$userinfo = mysql_fetch_object($tempinfo);
				return $userinfo->$prof;
			}
			
			public function Getcidbyformid($form_id)
			{
				$tempinfo = mysql_query("SELECT case_type FROM `plantiff_case_type_info` where `form_id`='$form_id'") or die(mysql_error());
				$userinfo = mysql_fetch_object($tempinfo);
				return $userinfo->case_type;
			}
			
			public function GetRoleNames($username1)
			{
				$tempgetrole = mysql_query("SELECT a.designation, b.designation AS namedes FROM  `members` AS a,  `designation` AS b WHERE a.user_name = '$username1' && a.designation = b.id") or die(mysql_error());
				$getrolename = mysql_fetch_object($tempgetrole);
				return $getrolename->namedes;
			}
			
			public function Subgroup($var)
			{
				$tempsubgroup    = mysql_query("SELECT * FROM `sub_designation` where `designation_id`='$var'") or die(mysql_error());
				echo '<select name="subgroup">';
				echo '<option value="">...Select...</option>';
				while($subgroup  = mysql_fetch_object($tempsubgroup))
				{
					echo '<option value="'.$subgroup->id.'">'.$subgroup->sub_designation_name.'</option>';
				}
				echo '</select>';
			}
			
			public function GetStates()
			{
				$tempgetstates = mysql_query("SELECT * FROM `states`") or die(mysql_error());
				echo '<select name="state" class="sel_reg_form" required />';
				echo '<option value="">...Select...</option>';
				while($getstates = mysql_fetch_object($tempgetstates))
				{
					echo '<option value="'.$getstates->state_code.'">'.$getstates->state.'</option>';
				}
				echo '</select>';
			}
			
			public function GetStatebyStateCode($var)
			{
				$temp_get_states = mysql_query("SELECT `state` FROM `states` WHERE `state_code`='$var'") or die(mysql_error());
				$get_states_id     = mysql_fetch_object($temp_get_states);
				if(mysql_num_rows($temp_get_states)>0)
				{
					return $get_states_id->state;
				}
			}
			
			public function GetObjectById($id,$var)
			{
				
				$tempobjbyid = mysql_query("SELECT $var from `members` where id='$id'") or die(mysql_error());
				$objbyid     = mysql_fetch_object($tempobjbyid);
				return $objbyid->$var;
				
			}
			
			public function getDataAllTables($var1,$var2,$var3)
			{
				$tempdata = mysql_query("SELECT $var1 FROM $var2 WHERE `id` = '$var3'") or die(mysql_error());
				$data = mysql_fetch_object($tempdata);
				return $data->$var1;
			}
			
			Public function GetObjectByUsername($var,$uname)
			{
				$tempgetrole = mysql_query("SELECT $var FROM `members` where `user_name` = '$uname' ") or die(mysql_error());
				$getrole=mysql_fetch_object($tempgetrole);
				return $getrole->$var;
				
			}
			
			public function SendEmail($to,$subject,$messaged,$extravalues)
			{
				$headers="";
				$message = '<html><body>';
				$message .= '<a href="http://mayosurgical.com/login.php"><img src="http://mayosurgical.com/images/logo.png" alt="Contact Email" /></a>';
				$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
				foreach($extravalues as $key=>$values)
				{
					$message .= "<tr style='background: #eee;'><td><strong>$key:</strong> </td><td>".$values."</td></tr>";
				}
				$message .= "<tr style='background:#eee;'><td><strong>Message From Admin:</strong></td><td>".$messaged."</td></tr>";
				$message .= "</table>";
				$message .= "</body></html>";
				$headers .= "From: MayoSurgical\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$mail     = mail($to,$subject,$message,$headers);
				
			}
			
			function getstats($state){
			$state_d = mysql_query("SELECT * FROM `states`") or die(mysql_error());
			while($stateslist = mysql_fetch_object($state_d))
			{
			?>
			<option value="<?php echo $stateslist->state_code; ?>" <?php if(isset($state) && $state == $stateslist->state_code) { echo "selected=selected" ;} ?>><?php echo $stateslist->state; ?></option>
			<?php
					} 
				}
				function getdesignation($designation){
					$qrudesg = mysql_query("SELECT * FROM `sub_designation`") or die(mysql_error());
					while($desig = mysql_fetch_object($qrudesg))
					{
				?>
			<option value="<?php echo $desig->id; ?>" <?php if(isset($designation) && $designation == $desig->id) { echo "selected=selected" ;} ?>><?php echo $desig->sub_designation_name; ?></option>
			<?php
					} 
				}
	
			public function GetPanel($username)
			{
				$var = "first_name";
				$date     = date("d-m-Y,h:i:s A");
				$username1= $_SESSION['username'];
				$f_name   = $this->GetDetailsByUsername($username1,"first_name");
				$l_name   = $this->GetDetailsByUsername($username1,"last_name");
				$rolenames= $this->GetRoleNames($username1);
				return '<div class="toll_free">
					<h1>1-866-411-2525</h1>
					 <span class="profile_left">
						<img src="https://'.$_SERVER['HTTP_HOST'].'/images/user_icon.png" alt="profile_icon"/>
					</span>
					<span class="profile_right">
						<h3>'.$rolenames.' Panel</h3>
						<p>Logged In As : '.$f_name.' '.$l_name.'</p>
						<p>Time:-'.$date.'</p>
						<p><a href="http://'.$_SERVER['HTTP_HOST'].'/logout.php">Logout</a></p>
					</span>
				</div>';
			}
			
			public function GetDesgBydesId($var)
			{
				$tempgetdesg = mysql_query("SELECT * FROM `designation` where `id`='$var'") or die(mysql_error());
				$getdesg     = mysql_fetch_object($tempgetdesg);
				return $getdesg->designation;
			}
			
			public function GetMessage($var1,$var2)
			{
				$tempmessage = mysql_query("SELECT $var1 FROM `message_sent` where `user_id`='$var2'") or die(mysql_error());
				$message     = mysql_fetch_object($tempmessage);
				return $message->$var1;
			}
			public function GetMessageByUidAndMid($var1,$var2,$var3)
			{
				$tempmessage = mysql_query("SELECT $var1 FROM `message_sent` where `user_id`='$var2' and `main_user_id`='$var3'") or die(mysql_error());
				$message1    = mysql_fetch_object($tempmessage);
				return $message1->$var1;
			}
			
			public function GetCaseTypeByFormID($var1,$var2)
			{
				$query = mysql_query("SELECT $var1 FROM `plantiff_information` WHERE `form_id`='$var2'") or die(mysql_error());
				$getcase = mysql_fetch_object($query);
				return $getcase->case_type;
			}
			
			public function GetInfoFrompi($var1,$var2)
			{
				$query = mysql_query("SELECT $var1 FROM `plantiff_information` WHERE `id`='$var2'") or die(mysql_error());
				$getcase = mysql_fetch_object($query);
				return $getcase->$var1;
			}
			
			public function GetInfoPlantiffInformation($var1,$var2)
			{
				$query = mysql_query("SELECT $var1 FROM `plantiff_information` WHERE `form_id`='$var2'") or die(mysql_error());
				$getcase = mysql_fetch_object($query);
				if(mysql_num_rows($query)>0)
				{
					return $getcase->$var1;
				}
			}
			
			public function GetD_O_B($var1,$var2)
			{
				$temp_query = mysql_query("SELECT $var1 from `plantiff_information` where `id`='$var2'") or die(mysql_error());
				$query      = mysql_fetch_object($temp_query);
				return $query->$var1;
			}
			
			public function GetObjectFromPCTI($var1,$var2)
			{
				$temp_query = mysql_query("SELECT $var1 from `plantiff_case_type_info` where `form_id`='$var2'") or die(mysql_error());
				$query      = mysql_fetch_object($temp_query);
				return $query->$var1;
			}
			
			public function Insert($fields,$table_name)
			{
			
				foreach($fields as $key=>$values)
				{ 
					$temp_tablev[]      = mysql_real_escape_string($values);
					$temp_tablef[]      = $key;
				}
				$tablef                 = implode(",",$temp_tablef);
				$tablev                 = "'".implode("',' ", $temp_tablev)."'";
				$temp_query             = "INSERT INTO $table_name ($tablef) VALUES ($tablev)";
				$query                  = mysql_query($temp_query) or die(mysql_error());
				return true;
			}
			
			public function GetAppointments()
			{
				$sql = mysql_query("SELECT * FROM `appt_type`") or die(mysql_error());
				echo "<select name='app_type' required>";
				echo "<option value=''>...Select...</option>";
				while($app = mysql_fetch_object($sql))
				{
					echo' <option value='.$app->id.'>'.$app->type.'</option>';
				}
				echo '</select>';
			}
			
			public function GetAppById($var)
			{
				$sql = mysql_query("SELECT * FROM `appt_type` WHERE `id`='$var'") or die(mysql_error());
				$app = mysql_fetch_object($sql);
				return $app->type;
			}
			
			function getRoleByRoleId($var)
			{
				$sql = mysql_query("SELECT `designation` FROM `designation` WHERE `id`='$var'") or die(mysql_error());
				$app = mysql_fetch_object($sql);
				return $app->designation;
			}
			
			function consultationDate($vara,$varb,$varc)
			{
				$sql = mysql_query("SELECT * FROM `appointment_doctor` WHERE app_type='$vara' and form_id='$varb'") or die(mysql_error());
				if(mysql_num_rows($sql)>0)
				{
					$app = mysql_fetch_object($sql);
					return $app->$varc;
				}
			}
			
			function getNameCase($var)
			{
				$sql = mysql_query("SELECT `name_of_case` FROM `type_of_cases` WHERE `case_id`='$var'") or die(mysql_error());
				$app = mysql_fetch_object($sql);
				return $app->name_of_case;
			}
			
			function getInfoAppointment($var1,$var2)
			{
				$sqll = mysql_query("SELECT $var1 FROM `appointment_doctor` WHERE `appt_id`='$var2'") or die(mysql_error());
				$appl = mysql_fetch_object($sqll);
				return $appl->$var1;
			}
			
			function getHiredStaff($var1)
			{
				$sql = mysql_query("SELECT * FROM `hire_staff` WHERE `form_id`='$var1'") or die(mysql_error());
				while($hireStaff = mysql_fetch_object($sql))
				{
					$hireId[] = $hireStaff->hire_id;
				}
				
				return @$hiresIds = implode(',',$hireId);
			}
			
			function approvalDate($vara,$varb)
			{
				$sql = mysql_query("SELECT $vara FROM `bill_forward_underwriter` where form_id='$varb'") or die(mysql_error());
				if(mysql_num_rows($sql)>0)
				{
					$row = mysql_fetch_object($sql);
					return $row->$vara;
				}
				
			}
			
			public function GetCasesList()
			{
				$tempgetstates = mysql_query("SELECT * FROM `type_of_cases` order by `case_id` asc") or die(mysql_error());
				echo '<select name="type_of_cases" class="case_list" />';
				echo '<option value="">...Select...</option>';
				while($getstates = mysql_fetch_object($tempgetstates))
				{
					echo '<option value="'.$getstates->case_id.'">'.$getstates->name_of_case.'</option>';
				}
				echo '</select>';
			}
			
			function GetCasesByProfessId($id){
				$qry = "SELECT a.id AS hireid, a.form_id AS formsid, a.hire_id AS doc_id, a.user_id AS use_id, a.date_time AS h_date, b. * , c . * 
						FROM hire_staff AS a, plantiff_case_type_info AS b, plantiff_information AS c
						WHERE a.form_id = b.form_id
						&& a.user_id = b.id
						&& a.form_id = c.form_id
						&& a.user_id = c.id
						&& c.form_id = b.form_id
						&& c.id = b.id
						&& hire_id =  $id ";
				$sql = mysql_query($qry) or die(mysql_error());
				while($row = mysql_fetch_array($sql)){
						$arr[] = $row; 
				}
				return $arr;
			}
			
	}
?>
