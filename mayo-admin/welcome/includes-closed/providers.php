<?php
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
$providersId = $_GET['providersid'];
if(isset($_REQUEST['providersid']) && $_REQUEST['providersid']==1)
{
?>
<li>
	<span class="form_label">	
		<label>Choose Provider</label>
	</span>
	<span class="form_input">
		<select name="choose_provider" class="sel_reg_form" onchange="" required/>
			<option value=''>...Select...</option>
			<?php
				$tempgetusers = mysql_query("SELECT * FROM members WHERE members.designation ='$providersId' && members.activated =1") or die(mysql_error());
				while($getusers = mysql_fetch_object($tempgetusers))
				{
			?>
					<option value='<?php echo $getusers->id; ?>'><?php echo $getusers->first_name; ?></option>
			<?php
				}
			?>
		</select>
		<span class="error"></span>
	</span>
</li>
<li>
	<span class="form_label">	
		<label>CPT Code</label>
	</span>
	<span class="form_input">
		<select name="cpt" class="sel_reg_form" onchange="getDescription(this.value);" required>
			<option value="">...CPT Code...</option>
			<?php
				$dataTemp = mysql_query("SELECT * FROM `cpt_codes` order by id") or die(mysql_error());
				while($data = mysql_fetch_object($dataTemp))
				{
			?>
				<option value="<?=$data->cpt_code?>"><?=$data->cpt_code?></option>
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
			<textarea name="description" rows="10" cols="50"></textarea>
			<span class="error"></span>
		</span>
	</li>
</div>
<li>
	<span class="form_label">	
		<label>Anesthesiologist Cost</label>
	</span>
	<span class="form_input">
		<input type="text" name="a_cost" value="$00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}" required />
		<span class="error"></span>
	</span>
</li>
<li>
	<span class="form_label">	
		<label>Anesthesiologist Price</label>
	</span>
	<span class="form_input">
		<input type="text" name="a_price" value="$00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}" required />
		<span class="error"></span>
	</span>
</li>
<input type="hidden" name="d_cost" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<input type="hidden" name="d_price" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<input type="hidden" name="f_cost" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<input type="hidden" name="f_price" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<?php
}
elseif(isset($_REQUEST['providersid']) && $_REQUEST['providersid']==3)
{
?>
<li>
	<span class="form_label">	
		<label>Choose Provider</label>
	</span>
	<span class="form_input">
		<select name="choose_provider" class="sel_reg_form" onchange="" required>
			<option value=''>...Select...</option>
			<?php
				$tempgetusers = mysql_query("SELECT * FROM members WHERE members.designation ='$providersId' && members.activated =1") or die(mysql_error());
				while($getusers = mysql_fetch_object($tempgetusers))
				{
			?>
				<option value='<?php echo $getusers->id; ?>'><?php echo $getusers->first_name; ?></option>
			<?php
				}
			?>
		</select>
		<span class="error"></span>
	</span>
</li>
<li>
	<span class="form_label">	
		<label>CPT Code</label>
	</span>
	<span class="form_input">
		<select name="cpt" class="sel_reg_form" onchange="getDescription(this.value);" required>
			<option value="">...CPT Code...</option>
			<?php
				$dataTemp = mysql_query("SELECT * FROM `cpt_codes` order by id") or die(mysql_error());
				while($data = mysql_fetch_object($dataTemp))
				{
			?>
				<option value="<?=$data->cpt_code?>"><?=$data->cpt_code?></option>
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
			<textarea name="description" rows="10" cols="50"></textarea>
			<span class="error"></span>
		</span>
	</li>
</div>
<li>
	<span class="form_label">	
		<label>Cost</label>
	</span>
	<span class="form_input">
		<input type="text" name="d_cost" value="$00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}" required />
		<span class="error"></span>
	</span>
</li>
<li>
	<span class="form_label">	
		<label>Price</label>
	</span>
	<span class="form_input">
		<input type="text" name="d_price" value="$00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}" required />
		<span class="error"></span>
	</span>
</li>
<input type="hidden" name="f_cost" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<input type="hidden" name="f_price" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<input type="hidden" name="a_cost" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<input type="hidden" name="a_price" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<?php
}
else
{
?>
<li>
	<span class="form_label">	
		<label>Choose Provider</label>
	</span>
	<span class="form_input">
		<select name="choose_provider" class="sel_reg_form" onchange="" required/>
			<option value=''>...Select...</option>
			<?php
				$tempgetusers = mysql_query("SELECT * FROM members WHERE members.designation ='$providersId' && members.activated =1") or die(mysql_error());
				while($getusers = mysql_fetch_object($tempgetusers))
				{
			?>
					<option value='<?php echo $getusers->id; ?>'><?php echo $getusers->first_name; ?></option>
			<?php
				}
			?>
		</select>
		<span class="error"></span>
	</span>
</li>
<li>
   <span class="form_label">
		<label>CPT Code</label>
	</span>
	<select class="sel_reg_form" name="cpt" onchange="getDescription(this.value);" required>
		<option value="">...CPT Code...</option>
		<?php
			$dataTemp = mysql_query("SELECT * FROM `cpt_codes` order by id") or die(mysql_error());
			while($data = mysql_fetch_object($dataTemp))
			{
		?>
			<option value="<?=$data->cpt_code?>"><?=$data->cpt_code?></option>
		<?php
			}
		?>
	</select>
</li>
<div id="desc">
	<li>
	   <span class="form_label">
			<label>Description</label>
		</span>
		<span class="form_input">
			<textarea name="description" rows="10" cols="50"></textarea>
			<span class="error"></span>
		</span>
	</li>
</div>
<li>
	<span class="form_label">	
		<label>Medical Cost</label>
	</span>
	<span class="form_input">
		<input type="text" name="f_cost" value="$00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}" required />
		<span class="error"></span>
	</span>
</li>
<li>
	<span class="form_label">	
		<label>Medical Price</label>
	</span>
	<span class="form_input">
		<input type="text" name="f_price" value="$00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}" required />
		<span class="error"></span>
	</span>
</li>
<input type="hidden" name="a_cost" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<input type="hidden" name="a_price" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<input type="hidden" name="d_cost" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<input type="hidden" name="d_price" value="00.00" onclick="if(this.value=='$00.00'){this.value=''}" onblur="if(this.value==''){this.value='$00.00'}"/>
<?php
}
?>
