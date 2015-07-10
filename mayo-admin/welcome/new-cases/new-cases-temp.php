<?php
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";
require_once($path);
include($config);
include '../classes/Cases.php';
$desg = new Cases();
$functions  = $pathofmayo."/classes/functions.php";
include($functions);
$meshedfile = $pathofmayo."/attorney/classes/meshed.php";
require_once($meshedfile);
//class file calling from attorney panel
$getdata = new Meshed();
?>
<?php
if($_POST['page'])
{
$page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = 15;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;
$query =mysql_query("select a.*,b.*,d.* from plantiff_information a inner join plantiff_case_type_info b on a.form_id=b.form_id and a.id=b.id inner join members d on a.id=d.id and b.id=d.id where b.admin_approved=0 and b.case_closed=0 ORDER BY a.`form_id` DESC LIMIT $start, $per_page") or die(mysql_error());
$i=1;
while ($row = mysql_fetch_array($query)) {
?>
<form name="verify" method="post" action="">
<div class="log_row">

	<div class="serial_no_15"><?php  echo $i; ?>&nbsp;</div>
	<div class="user_name_15"><?php $att_id = $row['attorney_id']; $designation = $getdata->GetObjectById($att_id,"designation"); echo $getdata->GetDesgBydesId($designation); ?>&nbsp;(<?php echo ucwords($getdata->GetObjectById($att_id,"first_name"))."&nbsp".ucwords($getdata->GetObjectById($att_id,"last_name")); ?>)
	<input type="hidden" name="user_id" id="user_id" value="<?php echo $row['id']; ?>">&nbsp;</div>
	<div class="first_name_15"><?php  echo ucwords($row['plantiff_name']);?>&nbsp;</div>
	<div class="email_address_15"><?php echo $date_birth = $row['p_d_o_b'];?>&nbsp;</div>
	<div class="status_15">
		<?php 
			if($row['activated'] == '1')
			{
				echo "<img src='../images/approved.jpg' title='Account is Activated'>";
			}
			else
			{
				echo "<img src='../images/pending.jpg' title='Account is not Activated Yet'>";
			}
		?>
		&nbsp;
	</div>
	
	<div class="action_15">
		<div class="verified_newcases">
			<a href="index.php?fid=<?php echo $row['form_id']; ?>&uid=<?php echo $row['id'];?>&cid=<?=$row['case_type'];?>" onclick="">View</a>
		</div>
	</div>
</div>
<form>
<?php

$i++;}
$msg="";
$msg = "<div class='user_name'>".$msg."</div>";
$result = mysql_query("select a.*,b.*,d.* from plantiff_information a inner join plantiff_case_type_info b on a.form_id=b.form_id and a.id=b.id inner join members d on a.id=d.id and b.id=d.id where b.admin_approved=0 and b.case_closed=0 ORDER BY a.`form_id`") or die(mysql_error());
$count = mysql_num_rows($result);
$row = mysql_fetch_array($result);
$no_of_paginations = ceil($count / $per_page);
if ($cur_page >= 7) 
{
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} 
else 
{
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}

$msg .= "<div class='pagination'><ul>";
if ($first_btn && $cur_page > 1) 
{
    $msg .= "<li p='1' class='active'>First</li>";
} 
else if ($first_btn) 
{
    $msg .= "<li p='1' class='inactive'>First</li>";
}


if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'>Previous</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'>Previous</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
    else
        $msg .= "<li p='$i' class='active'>{$i}</li>";
}


if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'>Next</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>Next</li>";
}

if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
}
$goto = "<input type='text' class='goto' size='1'/>
<input type='button' id='go_btn' class='go_button' value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul>" . $goto . $total_string . "</div>";
echo $msg;
}

