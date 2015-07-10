<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
//echo $contentfile = "../final-billing-document.php";
$functions  = $_SERVER['DOCUMENT_ROOT']."/rao/classes/functions.php";
include($functions);
$meshedfile = $_SERVER['DOCUMENT_ROOT']."/rao/attorney/classes/meshed.php";
require_once($meshedfile);
$getdata = new Meshed();
	$admin       = $_SESSION['username'];
	$admin_id    = $getdata->GetDetailsByUsername($admin,"id");
	$clientfname = $getdata->GetObjectById($_REQUEST['uid'],"first_name");
	$clientlname = $getdata->GetObjectById($_REQUEST['uid'],"last_name");
	$dattime = date('d-M-Y h:i:s a');
	global $uid;
?>
<div class="billing_box_bg">
	<div class="view_client_row">
		<div class="attorney_client_info"><h1>Final Billing</h1></div>
	</div>
<form name="forms1" method="post" action="">
	<input type="submit" name="generatepdf" value="Generate Pdf"/>
</form>	
<?php
	/*if(isset($_POST['generatepdf']))
	{
		define('FPDF_FONTPATH','/var/www/rao/mayo-admin/welcome/includes/pdf-generator/font/');
		require('/var/www/rao/mayo-admin/welcome/includes/pdf-generator/fpdf.php');
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'This is my testing.');
		$pdf->Output();
		echo $sql = "
		$storePdf = mysql_query("INSERT INTO `final_billing` (`user_id`,`form_id`,`pdf_name`) VALUES ('$_REQUEST[uid]','$_REQUEST[fid]','$_REQUEST['fid'].".pdf"') "";
		$storePdf = mysql_query("INSERT INTO `final_billing` (`user_id`,`form_id`,`pdf_name`) VALUES ('$_REQUEST[uid]','$_REQUEST[fid]','$_REQUEST['fid'].".pdf"') ") or die(mysql_error());
	}
	
	$getPdf = mysql_query("SELECT * FROM `final_billing` WHERE `user_id`='$_REQUEST[uid]'") or die(mysql_error());
	if(mysql_num_rows($getPdf)>0)
	{
		$pdfOfUser = mysql_fetch_object($getPdf);
		header("Content-disposition: attachment; filename='$row->pdf_name'");
		header("Content-type:application/pdf");
		readfile($pdfOfUser->pdf_name);
?>
		<h1><a href="<?php $pdfOfUser->pdf_name; ?>">Click Here to Download the Pdf.</h1>
<?php
	}*/
?>

<?php
	$query = "SELECT a.*,b.* from `plantiff_information` as a,`plantiff_case_type_info` as b WHERE a.form_id=b.form_id && a.id=b.id && a.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]'&& b.form_id='$_REQUEST[fid]' && b.id='$_REQUEST[uid]'";
	$finalFormTemp = mysql_query("SELECT a.*,b.* from `plantiff_information` as a,`plantiff_case_type_info` as b WHERE a.form_id=b.form_id && a.id=b.id && a.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]'&& b.form_id='$_REQUEST[fid]' && b.id='$_REQUEST[uid]'") or die(mysql_error());
	$finalForm     = mysql_fetch_object($finalFormTemp);
?>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="font-size:14px;">

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

        <tr>

          <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>1</sup> BANNER SURGICAL</td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">3600 DALLAS HIGHWAY</td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">SUITE 230-282</td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">MARIETTA, GA 30064</td>

              </tr>

            </table></td>

          <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>2</sup> 866-411-2525 <strong>PHONE</strong></td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">800-865-8691 <strong>FAX</strong></td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

            </table></td>

          <td align="left" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">

              <tr>

                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td align="left" width="20%" valign="middle" style="border-bottom:1px solid #d2d3d5;border-right:1px solid #999a9e; padding:2px;font-size:11px;"><sup>3a</sup> PAT.CNTL#</td>

                      <td align="left" width="40%" valign="middle" style="border-bottom:1px solid #d2d3d5;border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td align="left" valign="middle"  style="background:#525254; color:#FFF;border-bottom:1px solid #d2d3d5;"><sup>4</sup> TYPE OF BILL</td>

                    </tr>

                    <tr>

                      <td width="20%" align="left" valign="middle" bgcolor="#efeff0" style="border-bottom:1px solid #d2d3d5;border-right:1px solid #999a9e; padding:2px;font-size:11px;"><sup>b</sup> MED.REC#</td>

                      <td  width="20%" align="left" valign="middle" bgcolor="#efeff0" style="border-bottom:1px solid #d2d3d5;border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td align="left" valign="middle" style="border-bottom:1px solid #d2d3d5;">&nbsp;</td>

                    </tr>

                    <tr>

                      <td colspan="3" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">

                          <tr>

                            <td width="30%" align="left" valign="top" style="border-bottom:1px solid #d2d3d5;border-right:1px solid #999a9e; padding:2px;"><sup>5</sup> FED. TAX NO.</td>

                            <td align="left" valign="top" width="30%" style="border-bottom:1px solid #d2d3d5;"><sup>6</sup> STATEMENT FROM</td>

                            <td align="left" valign="top" width="30%" style="border-bottom:1px solid #d2d3d5;border-right:1px solid #999a9e; padding:2px;">COVERED PERIOD THROUGH</td>

                            <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><sup>7</sup></td>

                          </tr>

                          <tr>

                            <td height="16" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;"></td>

                            <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><input type="text" name="date" value="1-2-333" /></td>

                            <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><input type="text" name="date" value="1-2-333" /></td>

                            <td align="left" valign="top"></td>

                          </tr>

                        </table></td>

                    </tr>

                  </table></td>

              </tr>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;"><sup>8</sup> PATIENT NAME</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">a</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">CONTRERAS, CONCEPCION</td>

              </tr>

            </table></td>

          <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;"><sup>9</sup>	</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">a</td>

                <td align="left" valign="top"><b><?=$finalForm->p_address?></b></td>

                <td width="30%" align="left" valign="top">&nbsp;</td>

              </tr>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;"><b><?=$finalForm->plantiff_name?></b></td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

            </table></td>

          <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">b</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><b><?=$getdata->GetStatebyStateCode($finalForm->p_state)?></b></td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">c</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><b><?=$finalForm->p_city?></b></td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">d</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><b><?=$finalForm->p_zip_code?></b></td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">e</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>10</sup> BIRTHDATE</td>

                <td align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>11</sup> SEX</td>

                <td align="center" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"> ADMISSION

                  <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td width="25%" align="center" valign="top"><sup>12</sup> DATE</td>

                      <td width="25%" align="center" valign="top"><sup>13</sup> HR</td>

                      <td width="25%" align="center" valign="top"><sup>14</sup> TYPE</td>

                      <td width="25%" align="center" valign="top"><sup>15</sup> SRC</td>

                    </tr>

                  </table></td>

                <td align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>16</sup> DHR</td>

              </tr>

              <tr>

                <td align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><b><?=$finalForm->p_d_o_b?></b></td>

                <td align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">F</td>

                <td align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td width="25%"  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><b><?=$finalForm->date_time?></b></td>

                      <td width="25%"  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">11</td>

                      <td width="25%"  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">3</td>

                      <td width="25%" align="center" valign="top" >1</td>

                    </tr>

                  </table></td>

                <td align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">20</td>

              </tr>

            </table></td>

          <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="center" valign="top" style="border-bottom:1px solid #d2d3d5;"><sup>17</sup> STAT</td>

                <td align="center" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;" >ADMISSION

                  <table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td height="22"  align="center" valign="top"><sup>18</sup></td>

                      <td  align="center" valign="top"><sup>19</sup></td>

                      <td  align="center" valign="top"><sup>20</sup></td>

                      <td  align="center" valign="top"><sup>21</sup></td>

                      <td  align="center" valign="top"><sup>22</sup></td>

                      <td  align="center" valign="top"><sup>23</sup></td>

                      <td  align="center" valign="top"><sup>24</sup></td>

                      <td  align="center" valign="top"><sup>25</sup></td>

                      <td  align="center" valign="top"><sup>26</sup></td>

                      <td  align="center" valign="top"><sup>27</sup></td>

                      <td  align="center" valign="top"><sup>28</sup></td>

                    </tr>

                  </table></td>

                <td align="center" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;"><sup>29</sup> ACDT STATE</td>

                <td align="center" valign="top" bgcolor="#efeff0"><sup>30</sup></td>

              </tr>

              <tr>

                <td align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td  align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                    </tr>

                  </table></td>

                <td align="center" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="center" valign="top">&nbsp;</td>

              </tr>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;"><sup>31</sup></td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">OCCURRENCE</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">CODE</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">DATE</td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

            </table></td>

          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;background:#525254; color:#FFF;"><sup>32</sup></td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;background:#525254; color:#FFF;">OCCURRENCE</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;background:#525254; color:#FFF;">CODE</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;background:#525254; color:#FFF;">DATE</td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

            </table></td>

          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;"><sup>33</sup></td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">OCCURRENCE</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">CODE</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">DATE</td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

            </table></td>

          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;background:#525254; color:#FFF;"><sup>34</sup></td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;background:#525254; color:#FFF;">OCCURRENCE</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;background:#525254; color:#FFF;">CODE</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;background:#525254; color:#FFF;">DATE</td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

            </table></td>

          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;"><sup>35</sup></td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">OCCURRENCE SPAN</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">CODE</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">FROM</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">THROUGH</td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

            </table></td>

          <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;"><sup>36</sup></td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">OCCURRENCE SPAN</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">CODE</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">FROM</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">THROUGH</td>

              </tr>

              <tr>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

              <tr>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

              </tr>

            </table></td>

          <td align="left" valign="top"><sup>37</sup></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td width="50%" align="left" valign="top"><sup>38</sup>CONTRERAS, CONCEPCION<br />

            4833 LARCADE DRIVE<br />

            CORPUS CHRISTI, TX 78415<br />

            (361) 945-1203</td>

          <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">a</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">b</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">c</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">d</td>

                    </tr>

                  </table></td>

                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;"><sup>39</sup></td>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">VALUE CODES</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">CODE</td>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">AMOUNT</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                    </tr>

                  </table></td>

                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;background:#525254; color:#FFF;"><sup>40</sup></td>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;background:#525254; color:#FFF;">VALUE CODE</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;background:#525254; color:#FFF;">CODE</td>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;background:#525254; color:#FFF;">AMOUNT</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                    </tr>

                  </table></td>

                <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;"><sup>41</sup></td>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">VALUE CODES</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">CODE</td>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">AMOUNT</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                    </tr>

                    <tr>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                      <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

                    </tr>

                  </table></td>

              </tr>

            </table></td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>42</sup> REV.CD.</td>

          <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>43</sup> DESCRIPTION</td>

          <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>44</sup> HCPCS/RATE/HIPPS CODE</td>

          <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>45</sup> SERV.DATE</td>

          <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>46</sup> SERV.UNITS</td>

          <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>47</sup> TOTAL CHARGES</td>

          <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>48</sup> NON-COVERED CHARGES</td>

          <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>49</sup></td>

        </tr>
		
		
		
		
		<?php
			$que = "SELECT * , SUM( doctor_cost + facility_cost + anes_cost + doctor_price + facility_price + anes_price ) AS totalcost FROM  `billing_info`  WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]'";
			$billingTemp = mysql_query("SELECT * , SUM( doctor_cost + facility_cost + anes_cost + doctor_price + facility_price + anes_price ) AS totalcost FROM  `billing_info`  WHERE `form_id`='$_REQUEST[fid]' && `user_id`='$_REQUEST[uid]' group by cpt_code	") or die(mysql_error());
			$i=0;
			while($billing = mysql_fetch_object($billingTemp))
			{
			
		?>
			<tr>
			  <td align="left" valign="top" bgcolor="<?php if($i%2 == 0){echo "#efeff0";} ?>" style="border-right:1px solid #999a9e; padding:2px;"><?=$billing->cpt_code?></td>
			  <td align="left" valign="top" bgcolor="<?php if($i%2 == 0){echo "#efeff0";} ?>" style="border-right:1px solid #999a9e; padding:2px;"><?=$billing->description?></td>
			  <td align="left" valign="top" bgcolor="<?php if($i%2 == 0){echo "#efeff0";} ?>" style="border-right:1px solid #999a9e; padding:2px;"><?=$billing->cpt_code?></td>
			  <td align="left" valign="top" bgcolor="<?php if($i%2 == 0){echo "#efeff0";} ?>" style="border-right:1px solid #999a9e; padding:2px;"><?=$billing->date_bill?></td>
			  <td align="left" valign="top" bgcolor="<?php if($i%2 == 0){echo "#efeff0";} ?>" style="border-right:1px solid #999a9e; padding:2px;">1</td>
			  <td align="left" valign="top" bgcolor="<?php if($i%2 == 0){echo "#efeff0";} ?>" style="border-right:1px solid #999a9e; padding:2px;"><b>$<?=$billing->totalcost?></b></td>
			  <td align="left" valign="top" bgcolor="<?php if($i%2 == 0){echo "#efeff0";} ?>" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>
			  <td align="left" valign="top" bgcolor="<?php if($i%2 == 0){echo "#efeff0";} ?>" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>
			</tr>
		<?php
			$i++;
			}
		?>
		 <tr>

          <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

          <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

          <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

          <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

          <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

          <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

          <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

          <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

        </tr>
        <tr>

          <td align="right" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

          <td align="right" valign="top" style="font-size:25px; font-style:italic;border-right:1px solid #999a9e; padding:2px; font-weight:bold;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>

                <td align="right" valign="middle" style="font-size:25px; font-style:italic; font-weight:bold;">PAGE</td>

                <td align="right" valign="middle" style="border-bottom:1px solid #333; width:30%; font-size:18px; font-style:italic;">1</td>

                <td align="right" valign="middle">OF</td>

                <td align="right" valign="middle" style="border-bottom:1px solid #333; width:30%; font-size:18px; font-style:italic;">1</td>

              </tr>

            </table></td>

          <td align="right" valign="top" style="font-size:25px; font-style:italic;border-right:1px solid #999a9e; padding:2px; font-weight:bold;"><em>CREATION DATE</em></td>

          <td align="right" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><b><?php echo date('d-m-y h:i:s A'); ?></b></td>

          <td align="right" valign="top" style="border-right:1px solid #999a9e; padding:2px;background:#525254; font-size:25px; font-style:italic; font-weight:bold; color:#FFF;">TOTALS <img src="../images/white_arrw.png" alt="" align="absolute-middle" /></td>

          <td align="right" valign="top" style="border-right:1px solid #999a9e; padding:2px;">
		  <b><?php
			$dataTemp = mysql_query("SELECT (SUM(doctor_cost)+SUM(facility_cost)+SUM(anes_cost)+SUM(doctor_price)+SUM(facility_price)+SUM(anes_price)) as total FROM `billing_info` WHERE form_id = '$_REQUEST[fid]' && user_id = '$_REQUEST[uid]'") or die(mysql_error());
			$data = mysql_fetch_object($dataTemp);
			echo "$".$data->total;
		  ?></b>
		  </td>

          <td align="right" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

          <td align="right" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

        </tr>

      </table></td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>50</sup> PLAYER NAME</td>

    <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>51</sup> HEALTH PLAN ID</td>

<td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>52</sup> REL INFO</td>

    <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>53</sup> ASG BEN.</td>

<td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>55</sup> PRIOR PAYMENTS</td>

    <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>55</sup> EST. AMOUNT DUE</td>

    <td align="left" valign="top" bgcolor="#efeff0" style="border-bottom:1px solid #d2d3d5;border-right:1px solid #999a9e; padding:2px;"><sup>56</sup> NPI</td>

     <td width="20%" align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" bgcolor="#FFFFFF" style="border-right:1px solid #999a9e; padding:2px;"><sup>57</sup></td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top"  style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" bgcolor="#FFFFFF" style="border-right:1px solid #999a9e; padding:2px;">OTHER</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" bgcolor="#FFFFFF" style="border-right:1px solid #999a9e; padding:2px;">PRV ID</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top"  style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" bgcolor="#FFFFFF" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" bgcolor="#FFFFFF" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top"  style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" bgcolor="#FFFFFF" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" bgcolor="#FFFFFF" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top"  style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" bgcolor="#FFFFFF" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

  </tr>

</table>

</td>

  </tr>

 <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>58</sup> INSURED'S NAME</td>

    <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>59</sup>P.REL</td>

<td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>60</sup> INSURED'S UNIQUE ID</td>

    <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>61</sup> GROUP NAME</td>

<td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>62</sup> INSURANCE GROUP NO.</td>

    </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    </tr>

  <tr>

    <td align="left" valign="top"  style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    </tr>

</table>

</td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>63</sup>TREATMENT AUTHORIZATION CODES</td>

    <td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>64</sup>DOCUMENT CONTROL NUMBER</td>

<td align="left" valign="top" bgcolor="#efeff0" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>65</sup> EMPLOYER NAME</td>

    </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    </tr>

  <tr>

    <td align="left" valign="top"  style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" bgcolor="#efeff0">&nbsp;</td>

    </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    </tr>

</table>

</td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;"><sup>66</sup> DX</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><sup>68</sup></td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

  </tr>

</table>

    </td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;"><sup>69</sup> ADMIT DX</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;"><sup>70</sup> PATIENT REASON DX</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;"><sup>71</sup>PPS CODE</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;"><sup>72</sup> ECI</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><sup>73</sup></td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

  </tr>

</table>

    </td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="50%" align="left" valign="top" style="border-bottom:1px solid #d2d3d5;">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

   

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;" ><sup>75</sup></td>

  </tr>

</table></td>

  </tr>

  <tr>

    <td align="left" valign="top" style="font-size:11px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;"><sup>80</sup>REMARKS</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;"><sup>81CC</sup>a</td>

    <td width="10%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;">&nbsp;</td>

    <td width="10%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;">&nbsp;</td>

    <td width="10%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">TEXAS HEALTH CRAIG RANCH</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">b</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;">8080 STATE HIGHWAY 121 STE 100</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;">c</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;border-bottom:1px solid #d2d3d5;font-size:11px;">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">MCKINNEY, TX 75070</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">d</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

    <td align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

  </tr>

</table></td>

  </tr>

</table>

</td>

    <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td height="20" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><sup>76</sup> ATTENDING</td>

            <td width="30%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">NPI</td>

            <td width="10%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">QUAL</td>

            <td width="10%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

            <td width="30%" align="left" valign="top">&nbsp;</td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td height="20" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">LAST</td>

            <td align="left" valign="top">FIRST</td>

          </tr>

        </table></td>

      </tr>

         <tr>

        <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td height="20" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><sup>77</sup> OPERATING</td>

            <td width="30%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">NPI</td>

            <td width="10%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">QUAL</td>

            <td width="10%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

            <td width="30%" align="left" valign="top">&nbsp;</td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td height="20" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">LAST</td>

            <td align="left" valign="top">FIRST</td>

          </tr>

        </table></td>

      </tr>

         <tr>

        <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td height="20" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><sup>78</sup> OTHER</td>

            <td width="30%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">NPI</td>

            <td width="10%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">QUAL</td>

            <td width="10%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

            <td width="30%" align="left" valign="top">&nbsp;</td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td height="20" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">LAST</td>

            <td align="left" valign="top">FIRST</td>

          </tr>

        </table></td>

      </tr>

         <tr>

        <td align="left" valign="top" style="border-bottom:1px solid #d2d3d5;"><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td height="20" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;"><sup>79</sup> OTHER</td>

            <td width="30%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">NPI</td>

            <td width="10%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">QUAL</td>

            <td width="10%" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">&nbsp;</td>

            <td width="30%" align="left" valign="top">&nbsp;</td>

          </tr>

        </table></td>

      </tr>

      <tr>

        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">

          <tr>

            <td height="20" align="left" valign="top" style="border-right:1px solid #999a9e; padding:2px;">LAST</td>

            <td align="left" valign="top">FIRST</td>

          </tr>

        </table></td>

      </tr>

    </table></td>

  </tr>

</table>

</td>

  </tr>

  <tr>

    <td align="left" valign="top">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top">&nbsp;</td>

  </tr>

</table>		
</div>
				
				
