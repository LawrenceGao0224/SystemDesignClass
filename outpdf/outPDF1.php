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


// add a page
$pdf->AddPage();




$pdf->SetFont('cid0jp', '', 30);
$txt = '                                                                 104年台中市警政轄區事故統計
';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

// set font
$pdf->SetFont('cid0jp', '', 20);
$txt = '

';
$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);

// set font
$pdf->SetFont('cid0jp', '', 10);
$tbl = '';


	
$tbl = '
<table border="1">
    <tr bgcolor="#0099ff">
        <th rowspan="2">警政區</th>
        <th rowspan="2">行政區</th>
        <th colspan="4">104年</th>
        <th rowspan="2">警政區排名</th>
        <th rowspan="2">行政區排名</th>
    </tr>
    <tr bgcolor="#0099ff">
        <th>死亡</th>
        <th>受傷</th>
        <th>財損</th>
        <th>總計</th>
    </tr>
    <tr>
        <th rowspan="2">第一分局</th>
        <th>中區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td rowspan="2"></td>
        <td></td>
    </tr>
    <tr>
        <th>西區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>第二分局</th>
        <td>北區</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th rowspan="2">第三分局</th>
        <th>東區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td rowspan="2"></td>
        <td></td>
    </tr>
    <tr>
        <th>南區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>第四分局</th>
        <th>南屯區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>第五分局</th>
        <th>北屯區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>第六分局</th>
        <th>西屯區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th rowspan="4">豐原分局</th>
        <th>大雅區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td rowspan="4"></td>
        <td></td>
    </tr>
    <tr>
        <th>潭子區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>神岡區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>豐原區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th rowspan="2">霧峰分局</th>
        <th>霧峰區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td rowspan="2"></td>
        <td></td>
    </tr>
    <tr>
        <th>大里區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th rowspan="3">烏日分局</th>
        <th>烏日區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td rowspan="3"></td>
        <td></td>
    </tr>
    <tr>
        <th>大肚區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>龍井區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th rowspan="3">清水分局</th>
        <th>清水區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td rowspan="3"></td>
        <td></td>
    </tr>
    <tr>
        <th>沙鹿區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>梧棲區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th rowspan="4">大甲分局</th>
        <th>大甲區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td rowspan="4"></td>
        <td></td>
    </tr>
    <tr>
        <th>大安區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>外埔區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>后里區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>太平分局</th>
        <th>太平區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th rowspan="3">東勢分局</th>
        <th>東勢區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td rowspan="3"></td>
        <td></td>
    </tr>
    <tr>
        <th>石岡區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>新社區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <th>和平分局</th>
        <th>和平區</th>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2">統計</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>';		


$pdf->writeHTML($tbl, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('example_038.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+



