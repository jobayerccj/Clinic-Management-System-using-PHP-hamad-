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
$query =mysql_query("SELECT a . * , b . * 
FROM plantiff_information a
INNER JOIN plantiff_case_type_info b ON a.form_id = b.form_id
AND a.id = b.id
WHERE b.admin_approved =1
AND b.case_closed =0
AND b.case_type =3
AND a.case_type =3
ORDER BY a.`form_id` DESC LIMIT $start, $per_page") or die(mysql_error());
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
		<div class="first_name_16"><?php echo $dob_c = $row['p_d_o_b'];  //echo date('m-d-Y',strtotime($dob_c)); ?></div>
		<div class="workflow_16">
				<?php
					$comment_data = mysql_query("SELECT * FROM `work_comments` where form_id='".$row['form_id']."' and id=(select max(id) from work_comments where form_id='".$row['form_id']."')") or die(mysql_error());
					$dattas = mysql_fetch_object($comment_data);
					if(mysql_num_rows($comment_data)>0)
					{
						echo $dattas->work_comments;
						if(!empty($dattas->work_comments_area))
						{
							echo '<a class="work_comment_title tooltip animate" data-tool="'.$dattas->work_comments_area.'" href="">See Notes</a>';
						}
					}
					else
					{
						echo "Work Comment is not Updated Yet";
					}
				?>
			</div>
			<div class="status_16">
				<?php 
					$sqll = mysql_query("SELECT * FROM `status_update` where form_id='".$row['form_id']."' and id=(select max(id) from status_update WHERE form_id='".$row['form_id']."')") or die(mysql_error());
					$datta = mysql_fetch_object($sqll);
					if(mysql_num_rows($sqll)>0)
					{
						echo $datta->status_messages;
						if(!empty($datta->status_notes))
						{
							echo '<a class="work_comment_title tooltip animate" data-tool="'.$datta->status_notes.'" href="">See Notes</a>';
						}
					}
					else
					{
						echo "Status is not Updated Yet";
					}
				?>
				&nbsp;
			</div>
		<div class="action_16">
		<div class="verified">
			<a href="index.php?fid=<?php echo $row['form_id']; ?>&uid=<?php echo $row['id'];?>&cid=<?php echo $row['case_type']; ?>" onclick="">View</a>
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


$result = mysql_query("SELECT a . * , b . * 
FROM plantiff_information a
INNER JOIN plantiff_case_type_info b ON a.form_id = b.form_id
AND a.id = b.id
WHERE b.admin_approved =1
AND b.case_closed =0
AND b.case_type =3
AND a.case_type =3
ORDER BY a.`form_id`") or die(mysql_error());
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

