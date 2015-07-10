<?php
$path = $_SERVER['DOCUMENT_ROOT']."/rao/path.php";

require_once($path);
include($config);
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
$query =mysql_query("SELECT a . * , b. * , c . * , d.designation AS desg
FROM plantiff_information a
RIGHT JOIN plantiff_case_type_info b ON a.form_id = b.form_id
AND a.id = b.id
LEFT JOIN members c ON c.id = b.id
LEFT JOIN designation d ON c.designation = d.id
WHERE a.case_type = '1'
AND b.case_type = '1'
AND b.admin_approved = 1
ORDER BY a.`form_id` DESC LIMIT $start, $per_page") or die(mysql_error());
$msg = "";
$ij=0;
while ($row = mysql_fetch_array($query)) {
?>
<form name="verify" method="post" action="">
<div class="log_row">
	<?php 
	$ij++;
	if($ij>=1)
	{
	?>
			<div class="serial_no"><?php  echo $ij; ?>&nbsp;</div>
			<div class="user_name"><?php  echo $row['user_name'];?>
			<input type="hidden" name="user_id" id="user_id" value="<?php echo $row['id']; ?>">&nbsp;</div>
			<div class="user_name"><?php  $fname = $row['first_name']; echo ucwords($fname);?>&nbsp;</div>
			<div class="user_name"><?php  $lname = $row['last_name']; echo ucwords($lname);?>&nbsp;</div>
			<div class="user_name"><?php  echo $row['desg']; ?>&nbsp;</div>
			<div class="user_name"><?php  $organisation = $row['organisation']; echo ucwords($organisation);?>&nbsp;</div>
			<div class="user_name1"><?php echo $row['email_id'];?>&nbsp;</div>
			<div class="user_name">
				<?php 
					if($row['admin_approved'] == '0')
					{
						echo "Pending";
					}
					elseif($row['admin_approved'] == '1')
					{
						echo "Approved";
					}
					else
					{
						echo "Declined";
					}
				?>
				&nbsp;
			</div>
			<div class="user_name">
			<div class="verified">
				<a href="ortho.php?id=<?php echo $row['form_id']; ?>&&uid=<?php echo $row['id'];?>" onclick="">View</a>
			</div>
&nbsp;
		</div>
		<?php }else{ ?>
		No Mesh Record
		<?php } ?>
	</div>
<form>
<?php
 $ij++;
}

$msg = "<div class='user_name'>".$msg."</div>";


$result = mysql_query("SELECT COUNT( a.form_id ) AS countform, a . * , b. * , c . * , d.designation AS desg
FROM plantiff_information a
RIGHT JOIN plantiff_case_type_info b ON a.form_id = b.form_id
AND a.id = b.id
LEFT JOIN members c ON c.id = b.id
LEFT JOIN designation d ON c.designation = d.id
WHERE a.case_type = 1
AND b.case_type   = 1
AND b.admin_approved = 1
ORDER BY a.`form_id`
 DESC LIMIT $start, $per_page") or die(mysql_error());
$row = mysql_fetch_array($result);
$count = $row['countform'];
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

