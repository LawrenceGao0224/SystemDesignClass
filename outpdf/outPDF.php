<?php
require_once '../php/db.php';
load_variables();
//$priceA_id=2;
$sql = "SELECT * FROM quoted_pricea where id='$priceA_id' ";
	$re = mysqli_query($link, $sql);
	if($row = mysqli_fetch_array($re)){
		$priceA_id=$row['id'];//流水編號
		$client_name=$row['client_name']; //客戶名稱
		$client_address=$row['client_address']; //客戶地址
		$client_window=$row['client_window']; //聯絡人/職稱
		$client_phone=$row['client_phone']; //客戶電話
		$client_date=$row['client_date']; //報價日期
		$client_num=$row['client_num']; //報價編號
		$client_mail=$row['client_mail']; //客戶信箱
		$bus_name=$row['bus_name']; //盟立業務姓名
		$bus_phone=$row['bus_phone']; //盟立業務電話
		$bus_cellphone=$row['bus_cellphone']; //盟立業務手機
		$bus_mail=$row['bus_mail']; //盟立業務信箱
	}	
function load_variables()//免用POST跟GET的方法
{
  while (list ($_key_,$_val_) = each ($_GET)) {
    global  $$_key_;
    $$_key_ = $_val_;
  } 
  while (list ($_key_,$_val_) = each ($_POST)) {
    global  $$_key_;
    $$_key_ = $_val_;
  } 
}
// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf_import.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 038');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, '測試繁體中文頁首標題', '測試繁體中文頁首字串內容');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'tcpdf/examples/lang/eng.php')) {
    require_once(dirname(__FILE__).'tcpdf/examples/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 20);

// add a page
$pdf->AddPage();

$pdf->Image('mLogo.png', 30, 20, 150, 20, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
$pdf->Image('01.png', 60, 50, 80, 10, 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);
//$pdf->Image('mac.png', 140, 120, 50, 30, 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);

$pdf->SetFont('cid0jp', '', 10);
$txt = '


						總公司 :新竹市科學工業園區30077研發二路3號TEL:03-578-3280  FAX:03-5782855
						◎台北辦事處 ：台北市信義路四段138號3F TEL:02-27541369  FAX:02-27018037';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

// set font
$pdf->SetFont('cid0jp', '', 20);
$txt = '

';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

// set font
$pdf->SetFont('cid0jp', '', 10);
$tbl_header = '<table cellspacing="0" cellpadding="1" border="0">';
$tbl_footer = '</table>';
$tbl = '';

$tbl .= '
    <tr>
        <td>客人名稱:'. $client_name.'</td>
        <td align="right">報價日期:'. $client_date.'</td>
    </tr>
    <tr>
       <td>客人地址: '.$client_address.'</td>
	   <td align="right">報價編號: '.$client_num.'</td>
    </tr>
	<tr>
       <td>連絡人／職稱： '.$client_window.'</td>
	   <td align="right">E-mail： '.$client_mail.'</td>
    </tr>
	<tr>
       <td>TEL：'.$client_phone.'</td>
    </tr>
</table>
<br><br>
<table cellspacing="0" cellpadding="1" border="1">
    <tr>
        <td > 項目</td>
        <td align="center">品名 / 規格</td>
        <td align="center">數量</td>
		<td align="center">單價</td>
		<td align="right">小計</td>
    </tr>
';
$sqlb = "SELECT * FROM quoted_priceb where qpid='$priceA_id' ";
$reb = mysqli_query($link,$sqlb);
	while($rob = mysqli_fetch_array($reb)){
		$priceB_id=$rob['id'];//流水編號
		$name_old=$rob['name'];
		$specification_old=$rob['specification'];
		$quantity_old=$rob['quantity'];
		$money_old=$rob['money'];
		$sum_money_old=$rob['sum_money'];	
		$sum_cash=$sum_cash+$sum_money_old;		
$tbl .= '
		<tr>
		   <td>'.$name_old.'</td>
		   <td align="center"> '.$specification_old.'</td>
		   <td align="center"> '.$quantity_old.'</td>
		   <td align="center"> '.$money_old.'</td>
		   <td align="right"> '.$sum_money_old.'</td>
    	</tr>
	';	
	}	
$sum_cash_tax=$sum_cash*1.05;	
$sum_cash=number_format($sum_cash); //加千分號
$sum_cash_tax=number_format($sum_cash_tax,0); //加千分號
$tbl .= '
	<tr>
       <td colspan="4">Total (未)</td>
	   <td align="right">'.$sum_cash.'元</td>
    </tr>
	<tr>
       <td colspan="4">Total (含)</td>
	   <td align="right">'.$sum_cash_tax.'元</td>
    </tr>
</table>
<br><br>
<table cellspacing="0" cellpadding="0" border="0">
	<tr>
        <td colspan="4">交易條件:</td>
		<td rowspan="8" align="right"><img src="mac.png" width="235" height="194" alt=""/></td>
    </tr>
	<tr>
        <td colspan="7">1.交貨期限：自簽約日起XX天內交貨。</td>
    </tr>
	<tr>
        <td colspan="7">2.付款方式：交貨後即付總價100%。</td>
    </tr>
	<tr>
        <td colspan="7">3.保固期限：依原廠保固標準</td>
    </tr>
	<tr>
        <td colspan="7">4.本報價有效期限：10天。</td>
    </tr>
	<tr>
        <td colspan="7">5.其它未盡事宜雙方得另行協議之。</td>
    </tr>
	<tr>
        <td colspan="7">6.本報價單所列價格及條件倘蒙  閣下之認可簽署後，視同正式訂購單。</td>
    </tr>
	<tr>
        <td colspan="7">7.超過保固後,維護費依零件與工資合併計算。</td>
    </tr>
</table>
<br><br>
<table cellspacing="0" cellpadding="1" border="0">
    <tr>
        <td rowspan="2" align="left"></td>
		<td align="right">盟立業務代表: '.$bus_name.'</td>
    </tr>
	<tr>
		<td align="right">聯絡電話: '.$bus_phone.'</td>
	</tr>
    <tr>
		<td rowspan="2" align="left">客人代表簽章:</td>
		<td align="right">手機: '.$bus_cellphone.'</td>
    </tr>
	<tr>
		<td align="right">E-MAIL: '.$bus_mail.'</td>
	</tr>
</table>

';

$pdf->writeHTML($tbl_header . $tbl . $tbl_footer, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('example_038.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+



