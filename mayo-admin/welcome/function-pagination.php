<?php
$path = $_SERVER['DOCUMENT_ROOT']."/path.php";

require_once($path);

require_once($vpndb);
?>
<?php
if($_POST['page'])
{
$page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = 5;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

$query =mysql_query("SELECT * FROM `conn_logs` LIMIT $start, $per_page") or die(mysql_error());

$msg = "";
if(mysql_num_rows($query)>0)
{
	$ij=1;
while ($row = mysql_fetch_array($query)) {
?>
<div class="log_row">
			<div class="serial_nol"><?php echo $ij; ?>&nbsp;</div>
			<div class="user_namel"><?php echo $row['user'];?>&nbsp;</div>
			<div class="user_namel"><?php echo $row['action'];?>&nbsp;</div>
			<div class="user_namel"><?php $realip = $row['Real_IP']; echo long2ip($realip);?>&nbsp;</div>
			<div class="user_namel"><?php $virtualip = $row['Virtual_IP']; echo long2ip($virtualip);?>&nbsp;</div>
			<div class="user_namel"><?php echo $row['Protocole'];?>&nbsp;</div>
			<div class="user_namel"><?php echo $row['Duration'];?>&nbsp;</div>
			<div class="user_namel"><?php echo date ('m-d-Y',strtotime($row['date']);?>&nbsp;</div>
			<div class="user_namel"><?php echo $row['recv'];?>&nbsp;</div>
			<div class="user_namel"><?php echo $row['sent'];?>&nbsp;</div>
	</div>
<?php
$ij++;
}
}
else
{
	echo "No Logs";
}

$msg = "<div class='user_name'>".$msg."</div>";


$result = mysql_query("SELECT COUNT(*) AS count FROM `conn_logs`") or die(mysql_error());
$row = mysql_fetch_array($result);
$count = $row['count'];
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

