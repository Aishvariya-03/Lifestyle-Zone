
<?php      
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "life";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}   
      
include_once('projgitub\tcpdf_6_3_2.zip\tcpdf/tcpdf.php');

$id=$_GET['user_id'];
$inv_mst_query = "SELECT T1.order_id, T1.user_id, T1.invoice_no, T2.fname, T2.contact FROM `user_order` T1 INNER JOIN user T2 ON T1.user_id = T2.user_id WHERE T1.user_id='".$id."'";          
$inv_mst_results = mysqli_query($conn,$inv_mst_query);  
$count = mysqli_num_rows($inv_mst_results);  
if($count>0)
{
$inv_mst_data_row = mysqli_fetch_array($inv_mst_results, MYSQLI_ASSOC);

//----- Code for generate pdf
$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);  
//$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
$pdf->SetDefaultMonospacedFont('helvetica');  
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
$pdf->setPrintHeader(false);  
$pdf->setPrintFooter(false);  
$pdf->SetAutoPageBreak(TRUE, 10);  
$pdf->SetFont('helvetica', '', 12);  
$pdf->AddPage(); //default A4
//$pdf->AddPage('P','A5'); //when you require custome page size

$content = '';

$content .= '
<style type="text/css">
body{
font-size:12px;
line-height:24px;
font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
color:#000;
}
</style>    
<table cellpadding="0" cellspacing="0" style="border:1px solid #ddc;width:100%;">
<table style="width:100%;" >
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td colspan="2" align="center"><b>LIFESTYLE ZONE</b></td></tr>
<tr><td colspan="2" align="center"><b>CONTACT: +91 89999 36804</b></td></tr>
<tr><td colspan="2" align="center"><b>WEBSITE: WWW.LIFESTYLE.COM</b></td></tr>
<tr><td colspan="2"><b>CUSTOMER NAME: '.$inv_mst_data_row['user_name'].' </b></td></tr>
<tr><td><b>MOBILE NO: '.$inv_mst_data_row['contact_no'].' </b></td>
    <td align="right"><b>BILL DATE: '.date("d-m-Y").'</b> </td></tr>
<tr><td>&nbsp;</td>
    <td align="right"><b>BILL NO.: '.$inv_mst_data_row['invoice_no'].'</b></td></tr>
<tr><td colspan="2" align="center"><b>INVOICE</b></td></tr>
<tr class="heading" style="background:#eee;border-bottom:1px solid #ddd;font-weight:bold;">
<td>
NUMBER OF PRODUCTS
</td>
<td align="right">
AMOUNT
</td>
</tr>';
$total=0;
$inv_det_query = "SELECT T1.total_products, T1.total_amount FROM `order` T1 WHERE T1.user_id='".$id."'";
$inv_det_results = mysqli_query($con,$inv_det_query);    
while($inv_det_data_row = mysqli_fetch_array($inv_det_results, MYSQLI_ASSOC))
{
$content .= '
 <tr class="itemrows">
 <td>
 <b>'.$inv_det_data_row['total_products'].'</b>
 </td>
 <td align="right"><b>
 '.$inv_det_data_row['total_amount'].'
 </b></td>
 </tr>';
$total=$total+$inv_det_data_row['total_amount'];
}
$content .= '<tr class="total"><td colspan="2" align="right">------------------------</td></tr>
<tr><td colspan="2" align="right"><b>GRAND&nbsp;TOTAL:&nbsp;'.$total.'</b></td></tr>
<tr><td colspan="2" align="right">------------------------</td></tr>
<tr><td colspan="2" align="right"><b>PAYMENT MODE: CASH/ONLINE </b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td colspan="2" align="center"><b>THANK YOU ! VISIT AGAIN</b></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
</table>
</table>';
$pdf->writeHTML($content);

//$file_location = "/home/fbi1glfa0j7p/public_html/examples/generate_pdf/uploads/"; //add your full path of your server
$file_location = "/opt/lampp/htdocs/examples/generate_pdf/uploads/"; //for local xampp server

$datetime=date('dmY_hms');
$file_name = "INV_".$datetime.".pdf";
ob_end_clean();

if($_GET['ACTION']=='VIEW')
{
$pdf->Output($file_name, 'I'); // I means Inline view
}
else if($_GET['ACTION']=='DOWNLOAD')
{
$pdf->Output($file_name, 'D'); // D means download
}
else if($_GET['ACTION']=='UPLOAD')
{
$pdf->Output($file_location.$file_name, 'F'); // F means upload PDF file on some folder
echo "Upload successfully!!";
}

//----- End Code for generate pdf

}
else
{
echo 'Record not found for PDF.';
}

?>