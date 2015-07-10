<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);

require_once('../../includes/functions.php');
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";

require_once($path);
include($config);
include '../functions.php';
$classfile = $pathofmayo."/classes/functions.php";
include($classfile);
include('header.php');

if(loggedin())
{
	$desg  = new Allfunctions();
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function selectProvider(providersId) {		
		
		var strURL="includes/providers.php?providersid="+providersId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('providers').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	
	function getDescription(cptId) {		
		
		var strURL="includes/cptdesc.php?cptId="+cptId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('desc').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
</script>
<script>
$(document).ready(function()
{
	$("#addcpt").click(function()
	{
		$(".thank_message").fadeOut(3000);
	});
});
</script>
<section class="row">		
	<div class="container">
		<div class="form_section_content">
			<?php
			if(isset($_POST['add-role']))
			{
				$data      = array('id'=>$_POST['choose_provider'],'user_desig'=>$_POST['choose_type'],'cpt_code'=>$_POST['cpt'],'description'=>$_POST['description'],'doctor_cost'=>$_POST['d_cost'],'doctor_price'=>$_POST['d_price'],'facility_cost'=>$_POST['f_cost'],'facility_price'=>$_POST['f_price'],'anes_cost'=>$_POST['a_cost'],'anes_price'=>$_POST['a_price']);
				$tablename = "admin_billing";
				$desg->INSERT($data,$tablename);
				if($desg)
				{
					$first_name = $desg->GetObjectById($_POST['choose_provider'],'first_name');
					$last_name  = $desg->GetObjectById($_POST['choose_provider'],'last_name');
					
					$allinfo    = ucwords($first_name)."&nbsp;".ucwords($last_name);
					echo "<div class='thank_message'>CPT Code ".$_POST['cpt']." Added Successfully for".$allinfo."</div>";
				}
			}
			?>
		</div>
		<div class="form_section_content">
			<?php 
				if(isset($_REQUEST['ad_id']) && $_REQUEST['action'] == "edit")
				{
					$temp_getcpt = mysql_query("SELECT * FROM `admin_billing` WHERE `ad_id`='$_REQUEST[ad_id]' && `user_desig`='$_REQUEST[user_desig]'") or die(mysql_error());
					$getcpt      = mysql_fetch_object($temp_getcpt);
			?>
			<h1 class="add_user">Update CPT Codes</h1>
			<form name="updatecpt" method="post" action="" id="regform">
						<ul>
							<li>
								<span class="form_label">	
									<label>CPT Code</label>
								</span>
								<?php $a = $getcpt->cpt_code;?>
								<span class="form_input">
									<select name="cpt" class="sel_reg_form" onchnage="getDescription(this.value);" required>
										<option value="">...CPT Code...</option>
										<?php
											$dataTemp   = mysql_query("SELECT * FROM `cpt_codes` order by id") or die(mysql_error());
											while($data = mysql_fetch_object($dataTemp))
											{
										?>
											<option value="<?=$data->cpt_code?>" <?php if($a==$data->cpt_code){echo 'selected=selected';}?>><?=$data->cpt_code?></option>
										<?php
											}
										?>
									</select>
									<span class="error"></span>
								</span>
							</li>
							<div id="desc">
							   <li>
								   <span class="form_label">
										<label>Description</label>
									</span>
									<span class="form_input">
										<textarea name="description" rows="10" cols="50"><?php  echo $getcpt->description;?></textarea>
										<span class="error"></span>
									</span>
							   </li>
							 </div>
							<?php 
							if(($_REQUEST['user_desig']==1))
							{ 
							?>
								<li>
									<span class="form_label">	
										<label>Anesthesiologist Cost</label>
									</span>
									<span class="form_input">
										<input type="text" name="a_cost" value="<?php echo $getcpt->anes_cost; ?>" required />
										<span class="error"></span>
									</span>
								</li>
								<li>
									<span class="form_label">	
										<label>Anesthesiologist Price</label>
									</span>
									<span class="form_input">
										<input type="text" name="a_price" value="<?php echo $getcpt->anes_price; ?>" required />
										<span class="error"></span>
									</span>
								</li>
							<?php
							} 
							elseif(($_REQUEST['user_desig']==3))
							{
							?>
								<li>
									<span class="form_label">	
										<label>Doctor Cost</label>
									</span>
									<span class="form_input">
										<input type="text" name="d_cost" value="<?php echo $getcpt->doctor_cost; ?>" required />
										<span class="error"></span>
									</span>
								</li>
								
								<li>
									<span class="form_label">	
										<label>Doctor Price</label>
									</span>
									<span class="form_input">
										<input type="text" name="d_price" value="<?php echo $getcpt->doctor_price; ?>" required />
										<span class="error"></span>
									</span>
								</li>
							<?php
							}
							else
							{
							?>
								<li>
									<span class="form_label">	
										<label>Medical Facility Cost</label>
									</span>
									<span class="form_input">
										<input type="text" name="f_cost" value="<?php echo $getcpt->facility_cost; ?>" required />
										<span class="error"></span>
									</span>
								</li>
								<li>
									<span class="form_label">	
										<label>Medical Facility Price</label>
									</span>
									<span class="form_input">
										<input type="text" name="f_price" value="<?php echo $getcpt->facility_price; ?>" required />
										<span class="error"></span>
									</span>
								</li>
									
							<?php
							}
							?>
							<input type="submit" id="addcpt" name="update_cpt" value="Update CPT Code"/>
						</ul>
				</form>
				<?php
					if(isset($_POST['update_cpt']))
					{
						@$cpt = $_POST['cpt'];
						@$desc = $_POST['description'];
						@$d_cost  = $_POST['doctor_cost'];
						@$d_price = $_POST['doctor_price'];
						@$f_cost = $_POST['f_cost'];
						@$f_price = $_POST['f_price'];
						@$a_cost = $_POST['a_cost'];
						@$a_price = $_POST['a_price'];
						
						$update_temp = mysql_query("UPDATE `admin_billing` SET `cpt_code`='$cpt',`description`='$desc',`doctor_cost`='$d_cost',`doctor_price`='$d_price',`facility_cost`='$f_cost',`facility_price`='$f_price',`anes_cost`='$a_cost',`anes_price`='$a_price' WHERE `ad_id`='$_REQUEST[ad_id]'") or die(mysql_error());
						if($update_temp)
						{
							echo "<div class='thank_message'>CPT Updated Successfully</div>";
							header("refresh:2; url=add-billing.php");
						}
						else
						{
							echo "<div class='thank_message'>There is Error. Some thing going Wrong. Please try again Later</div>";
						}
						
					}
				?>
				<?php
					}
					else
					{
				?>
					<h1 class="add_user">Add CPT Codes</h1>
					<form name="userinfo" method="post" action="" id="regform">
						<ul>
							<li>
								<span class="form_label">	
									<label>Choose Type</label>
								</span>
								<span class="form_input">
									<select name="choose_type" class="sel_reg_form" onchange="selectProvider(this.value);" required>
										<option value="">...Please Select...</option>
										<?php
											$providerTemp = mysql_query("SELECT * FROM  `designation` WHERE id =1 OR id =3 OR id =4") or die(mysql_error());
											while($provider     = mysql_fetch_object($providerTemp))
											{
										?>
											<option value="<?php echo $provider->id; ?>" <?php //if(isset($_POST['choose_type']) && ($_POST['choose_type'])==$provider->id) { echo "Selected"; } ?>><?php echo $provider->designation; ?></option>
										<?php
											}
										?>
									</select>
									<span class="error"></span>
								</span>
							</li>
							
							<div id="providers">
								<li>
									<span class="form_label">	
										<label>Choose Provider</label>
									</span>
									<span class="form_input">
										<select name="choose_provider" class="sel_reg_form" onchange="getFields(this.value);">
											<option value="">...Please Select...</option>
										</select>
										<span class="error"></span>
									</span>
								</li>
							</div>
							
						   <!--<li>
							   <span class="form_label">
									<label>Description</label>
								</span>
								<span class="form_input">
									<textarea name="description" rows="10" cols="50" required ></textarea>
									<span class="error"></span>
								</span>
						   </li>
							<li>
								<span class="form_label">	
									<label>Loc</label>
								</span>
								<span class="form_input">
									<input type="text" name="loc" required />
									<span class="error"></span>
								</span>
							</li>
							<li>
								<span class="form_label">	
									<label>Ortho Group</label>
								</span>
								<span class="form_input">
									<input type="text" name="ortho_group" required />
									<span class="error"></span>
								</span>
							</li>	
							<li>
								<span class="form_label">	
									<label>Phoenix</label>
								</span>
								<span class="form_input">
									<input type="text" name="phoenix" required />
									<span class="error"></span>
								</span>
							</li>
							<li>
								<span class="form_label">	
									<label>St. Matthews SC</label>
								</span>
								<span class="form_input">
									<input type="text" name="mathews" required />
									<span class="error"></span>
								</span>
							</li>-->
							<span class="form_label"></span>
							<input type="submit" id="addcpt" name="add-role" value="Add CPT Code"/>
						</ul>
						
					</form>	
			
			<div class="view_log_details">
				<div class="log_heading">
					<div class="type">Type</div>
					<div class="provider">Provider</div>
					<div class="cpt_code">CPT Code</div>
					<div class="description">Description</div>
					<div class="orthogroup">D Cost</div>
					<div class="orthogroup">D Price</div>
					<div class="orthogroup">F Cost</div>
					<div class="orthogroup">F Price</div>
					<div class="orthogroup">A Cost</div>
					<div class="orthogroup">A Price</div>
					<div class="orthogroup">Update/Delete</div>
				</div>
				<?php 
					$query =mysql_query("SELECT * FROM `admin_billing`") or die(mysql_error());
					$ij=1;
					while ($row = mysql_fetch_array($query)) 
					{
				?>
					<div class="log_row">
						<div class="type"><?php $designation = $row['user_desig']; echo $desg->GetDesgBydesId($designation); ?></div>
						<div class="provider"><?php    $uid = $row['id']; echo ucwords($desg->GetObjectById($uid,"first_name"))."&nbsp".ucwords($desg->GetObjectById($uid,"last_name")); ?></div>
						<div class="cpt_code"><?php echo $cptcCode=$row['cpt_code']; ?></div>
						<div class="description"><?php echo $row['description']; ?></div>
						<div class="orthogroup">$<?php echo number_format($row['doctor_cost'],2); ?></div>
						<div class="orthogroup">$<?php echo number_format($row['doctor_price'],2); ?></div>
						<div class="orthogroup">$<?php echo number_format($row['facility_cost'],2); ?></div>
						<div class="orthogroup">$<?php echo number_format($row['facility_price'],2); ?></div>
						<div class="orthogroup">$<?php echo number_format($row['anes_cost'],2); ?></div>
						<div class="orthogroup">$<?php echo number_format($row['anes_price'],2); ?></div>
						<div class="orthogroup"><a href="add-billing.php?ad_id=<?php echo $row['ad_id']; ?>&user_desig=<?php echo $row['user_desig']; ?>&action=edit">Edit</a>&nbsp;<a class="confirmation<?php echo $row['ad_id']; ?>" href="add-billing.php?ad_id=<?php echo $row['ad_id']; ?>&action=delete">Delete</a></div>
					</div>
					<script type="text/javascript">
						$('.confirmation<?php echo $row['ad_id']; ?>').on('click', function () {
						return confirm('Are you sure?');
						});
					</script>
				<?php 
					} 
				}
				?>
				<?php
					if(isset($_REQUEST['ad_id']) && $_REQUEST['action']=="delete")
					{
						$delete = mysql_query("DELETE FROM `admin_billing` WHERE `ad_id`='$_REQUEST[ad_id]'") or die(mysql_error());
						if($delete)
						{
							echo "Record Deleted Successfully";
							header("refresh:1;url=add-billing.php");
						}
						else
						{
							echo "There is error. Please try it later";
						}
					}
				?>
				
			</div>
</div>

<?php 
}
else 
{ 
header('Location:../login.php');
}
?>
<script src="http://<?php echo $jqueryminjs; ?>"></script>
<script src="http://<?php echo $validateminjs; ?>"></script>
</div>
</section>
<?php
require($get_footer);
?>
