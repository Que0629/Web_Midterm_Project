<?php

require_once('../TCPDF/tcpdf_import.php');

$mail= $_POST['mail'];
$firstName = $_POST['firstName'];
$last = $_POST['last'];
$address = $_POST['address'];
$tel = $_POST['tel'];
$number=589*($_POST['number1']+$_POST['number2']+$_POST['number3']+$_POST['number4']+$_POST['number5']+$_POST['number6']+$_POST['number7']+$_POST['number8']+$_POST['number9']+$_POST['number10']);

/*---------------- Sent Mail Start -----------------*/
$to=$mail;
$subject='購物清單';

$message="
姓氏：$firstName
名字:$last
電話：$tel
電子信箱：$mail
地址：$address
金額:$number
";


$headers.="From:s10355012@ms2.msjh.tp.edu.tw\r\n";
mail($to, $subject, $message, $headers);

/*---------------- Sent Mail End -------------------*/


/*---------------- Print PDF Start -----------------*/
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetFont('cid0jp','', 18); 
$pdf->AddPage();

$html = <<<EOF
<table border="1" cellspacing="3" cellpadding="4">
<tr> 
  <td>姓氏</td>
	<td>$firstName</td>
	<td>名字</td>
	<td>$last</td>
</tr>
<tr>
  <td>電話</td>
	<td>$tel</td>
	<td>信箱</td>
	<td>$mail</td>
</tr>
<tr>
  <td>地址</td>
	<td colspan = "3"><p style="color:blue; background-color:yellow;">$address</p></td>
</tr>
<tr>
	<td>總金額</td>
	<td>$number</td>
</tr>


</table>

EOF;
/*---------------- Print PDF End -------------------*/

$pdf->writeHTML($html);
$pdf->lastPage();
$pdf->Output('order.pdf', 'I');


?>
