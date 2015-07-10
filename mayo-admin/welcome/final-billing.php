<?php
ob_start();
ini_set('display_errors',1);  
error_reporting(E_ALL);
//echo $contentfile = "../final-billing-document.php";
//$functions  = $_SERVER['DOCUMENT_ROOT']."/rao/classes/functions.php";
//include($functions);
//$meshedfile = $_SERVER['DOCUMENT_ROOT']."/rao/attorney/classes/meshed.php";
//require_once($meshedfile);
//$getdata = new Meshed();
?>
<form name="forms1" method="post" action="">
	<input type="submit" name="generatepdf" value="Generate Pdf" />
</form>	
<?php
	if(isset($_POST['generatepdf']))
	{
	//echo $contentfile = $_SERVER['DOCUMENT_ROOT']."/rao/mayo-admin/includes/final-billing-document.php";
	$query = "SELECT a.*,b.* from `plantiff_information` as a,`plantiff_case_type_info` as b WHERE a.form_id=b.form_id && a.id=b.id && a.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]'&& b.form_id='$_REQUEST[fid]' && b.id='$_REQUEST[uid]'";
	$finalFormTemp = mysql_query("SELECT a.*,b.* from `plantiff_information` as a,`plantiff_case_type_info` as b WHERE a.form_id=b.form_id && a.id=b.id && a.form_id='$_REQUEST[fid]' && a.id='$_REQUEST[uid]'&& b.form_id='$_REQUEST[fid]' && b.id='$_REQUEST[uid]'") or die(mysql_error());
	$finalForm     = mysql_fetch_object($finalFormTemp);
	$contentfile = " "; 
	$contentfile .= '<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="font-size:14px;">

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

  </tr></table>';
		echo $contentfile;
		/*define('FPDF_FONTPATH','font/');
		require('fpdf.php');
		require('html2fpdf.php');
		$pdf2 = new HTML2FPDF();
		$pdf = new FPDF();
		$pdf->SetFont('Arial','B',16);
		$pdf->AddPage();
		//$pdf->Cell(40,10,'This one is my Testing.I hate this code. It is very tough code.Creating the pdf but not generated automatically.');
		//$pdf->WriteHTML2($contentfile);
		$pdf2->WriteHTML($contentfile);
		echo $docs = $_SERVER['DOCUMENT_ROOT']."/rao/mayo-admin/welcome/includes/pdf-generator/caseno-".$_REQUEST['fid']."-".date('d-m-y-s').".pdf";
		
		$pdf->Output($docs);*/
		
		require('html2fpdf.php');
		$pdf=new HTML2FPDF();
		$pdf->AddPage();
		//echo $fp = fopen("$contentfile","r");
		//$strContent = fread($fp, filesize("$contentfile"));
		//fclose($fp);
		//$pdf = new HTML2PDF();
		$pdf->WriteHTML($contentfile);
		echo $docs = $_SERVER['DOCUMENT_ROOT']."/rao/mayo-admin/welcome/includes/pdf-generator/caseno-".$_REQUEST['fid']."-".date('d-m-y-s').".pdf";
		$pdf->Output($docs);
		echo "PDF file is generated successfully!";
		
		echo $sql = "INSERT INTO `final_billing` (`user_id`,`form_id`,`pdf_name`) VALUES ('$_REQUEST[uid]','$_REQUEST[fid]','caseno-".$_REQUEST['fid']."-".date('d-m-y-s').".pdf')";
		
		$data = mysql_query($sql);
		$page = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	//	header("Refresh: 2; url=$page");		
	}
	echo $query = "SELECT * FROM  `final_billing` WHERE  `user_id` = '$_REQUEST[uid]' && `form_id`='$_REQUEST[fid]' && id = (SELECT MAX(id))";
	$getPdf = mysql_query($query) or die(mysql_error());
	echo $count = mysql_num_rows($getPdf);
	if(mysql_num_rows($getPdf)>=1)
	{
		$pdfOfUser = mysql_fetch_object($getPdf);
?>
		<h1><a href="../includes/pdf-generator/<?php echo $pdfOfUser->pdf_name; ?>" target="_blank">Click Here to Download the Pdf.</h1>
<?php
	}
?>



				
				
