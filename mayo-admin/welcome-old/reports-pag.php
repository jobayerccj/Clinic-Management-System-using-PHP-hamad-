<?php
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";

require_once($path);
include($config);
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
$query =mysql_query("SELECT a.plantiff_name, a.p_d_o_b,a.form_id,a.case_type, b.date_appt, c.date_time AS billing_date, d.date_time AS application_date, e.d_b_amount, e.d_p_received, e.d_paid, e.m_f_b_amount, e.m_f_p_received, e.m_f_p_paid, e.anes_b_amount, e.anes_p_received, e.anes_p_paid, e.other_bill_amount, e.other_payment_received, e.other_paid
FROM plantiff_information AS a, appointment_doctor AS b, final_billing AS c,  `plantiff_case_type_info` AS d,  `billing_payment_information` AS e
WHERE a.form_id = b.form_id
AND a.form_id = c.form_id
AND a.form_id = d.form_id
AND a.form_id = e.form_id
AND c.id = ( 
SELECT MAX( id ) 
FROM final_billing AS c
WHERE c.form_id = a.form_id ) 
AND b.app_type =2
AND d.case_closed =0 order by a.id DESC LIMIT $start, $per_page") or die(mysql_error());
$msg = "";
if(mysql_num_rows($query)>0)
{
$i=1;

while ($row = mysql_fetch_array($query)) {
?>
<form name="verify" method="post" action="">
<div class="log_row">
			<div class="serial_no_16"><?php  echo $i; ?>&nbsp;</div>
			<div class="user_name_16"><?php  echo ucwords($fname = $row['plantiff_name']); ?>&nbsp;
			<input type="hidden" name="user_id" id="user_id" value="<?php echo $row['id']; ?>">&nbsp;</div>
			<div class="first_name_16"><?php $dob_c = $row['p_d_o_b'];  echo date('d-m-Y',strtotime($dob_c)); ?></div>
			<div class="workflow_16">
				<?php $dob_cd = $row['date_time'];  echo date('d-m-Y',strtotime($dob_cd)); ?>
			</div>
			<div class="status_16">
				<?php $dateSurgury = explode('/',$row['date_appt']); list($a,$b)=$dateSurgury; echo date('d-m-Y',strtotime($a)) ;?>
			</div>
			<div class="action_16">
			<div class="verified">
				<a href="update-report.php?fid=<?php echo $row['form_id']; ?>&cid=<?php echo $row['case_type']; ?>" onclick="">View</a>
			</div>
&nbsp;
		</div>

	</div>
<form>
<?php
$i++;
}
}
else{ echo "<div class='log_row'><h1>There is no Case</h1></div>";}

$msg = "<div class='user_name'>".$msg."</div>";


$result = mysql_query("SELECT a . * , b . * , c.date_time AS billing_date, d . *,e.*
FROM plantiff_information AS a, appointment_doctor AS b, final_billing AS c, `plantiff_case_type_info` AS d, `billing_payment_information` as e
WHERE a.form_id = b.form_id
AND d.form_id = a.form_id
AND d.form_id = b.form_id
AND d.form_id = c.form_id
AND c.form_id = b.form_id
AND c.form_id = a.form_id
AND a.form_id = e.form_id
AND b.form_id = e.form_id
AND c.form_id = e.form_id
AND d.form_id = e.form_id
AND b.app_type =2 And d.case_closed=0") or die(mysql_error());
$row = mysql_fetch_array($result);
$count = mysql_num_rows($result);
$no_of_paginations = ceil($count / $per_page);

if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}

$msg .= "<div class='pagination'><ul>";

if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'>First</li>";
} else if ($first_btn) {
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

