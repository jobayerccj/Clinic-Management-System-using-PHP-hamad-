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
$query =mysql_query("SELECT * FROM `members` order by id desc LIMIT $start, $per_page") or die(mysql_error());
$msg = "";
$ij=1;
while ($row = mysql_fetch_array($query)) {
?>
<form name="verify" method="post" action="">
<div class="log_row">
			<div class="serial_no_14"><?php  echo $ij; ?>&nbsp;</div>
			<div class="user_name_14"><?php  echo $row['user_name'];?>
			<input type="hidden" name="user_id" id="user_id" value="<?php echo $row['id']; ?>">&nbsp;</div>
			<div class="first_name_14"><?php  $fname = $row['first_name']; echo ucwords($fname);?>&nbsp;<?php  $lname = $row['last_name']; echo ucwords($lname);?></div>
			<div class="email_address_14"><?php echo $row['email_id'];?>&nbsp;</div>
			<div class="status_14">
			<?php 
			
				$activat = $row['activated']; 
				
				if($activat == 1)
				{
					echo "Verified";
				}
				else
				{
					echo "Not Verified";
				}
			?>
			&nbsp;
			</div>
			<div class="action_14_a">
			<?php 
				if($activat == 0)
				{
			?>
			<div class="verified_a">
				<a href="" onclick="update(<?php echo $row['id']; ?>)"><img src="images/verify.jpg" alt="Verify"></a>
			</div>
			<?php
				}
			?>
			<div class="delete_a">
				<a href="" onclick="deleteuser(<?php echo $row['id']; ?>);"><img src="images/delete.jpg" alt="Verify"></a>
			</div>
			&nbsp;
		</div>
	</div>
<form>
<?php
$ij++;
}

$msg = "<div class='user_name'>".$msg."</div>";


$result = mysql_query("SELECT COUNT(*) AS count FROM `members` ") or die(mysql_error());
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

