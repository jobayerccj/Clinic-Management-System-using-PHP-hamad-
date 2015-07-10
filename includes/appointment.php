<?php
	class Appointment
	{
		private $tuserId;
		private $tformId;
		
		public function __construct($userId,$formId)
		{
			$this->tuserId = $userId;
			$this->tformId = $formId;
		}
		
		public function GetAppt()
		{
			echo $query = "SELECT * FROM `appointment_doctor` WHERE `form_id`='".$this->tformId."' && `user_id`='".$this->tuserId."'";
			$tempAppt = mysql_query("SELECT * FROM `appointment_doctor` WHERE `form_id`='".$this->tformId."' && `user_id`='".$this->tuserId."'") or die(mysql_error());
			if(mysql_num_rows($tempAppt)>0)
			{
				while($temp     = mysql_fetch_object($tempAppt))
				{
					echo "<h1>Appointment Status</h1>";
					echo $temp->appt_id;
					echo $temp->form_id;
					echo $temp->user_id;
					echo $temp->main_user_id;
				}
			}
		}
	}
?>