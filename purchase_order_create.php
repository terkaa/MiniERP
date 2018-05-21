<?php
//Creates a PDF purchase order for all components in cart from this supplier

require('./FPDF/sectors.php');
require_once('./dxf_reader_fpdf.php');
require 'vendor/autoload.php';

  if(isset($_GET['supplier_id'])){
  $supplier_id = $_GET['supplier_id']; }
  else {
  $supplier_id = null;}

  if(isset($_GET['time'])){
  $time = $_GET['time']; }
  else {
  $time = null;}

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));


$lang = ' '; 
$function = 0;
require_once('languages.php'); 
require 'db_connect.php';

$stmt = $db->query("SELECT name,street,postcode,city,vat,reply_to_email FROM company_details");

while ($row = $stmt->fetch())
{
$company_details = array('name' => $row['name'], 'street' => $row['street'],
                'postcode' => $row['postcode'],'city' => $row['city'],'vat' => $row['vat'],'reply_to_email' => $row['reply_to_email']);

}


$stmt = $db->query("SELECT max(order_no) AS last_order FROM order_history");

while ($row = $stmt->fetch())
{
$order_no = $row['last_order'] + 1 ;
} 

$stmt = $db->prepare("SELECT oh.code,oh.amount,cd_type,cd_code,cd_description,cd_baseunit,cd_unit,s_name,s_address,
			s_postcode,s_city,s_email,s.pay_days,s.deliveryterm,s.delivery_way,s.lang,
			cd_price,cd_amount_unit,ct.price_unit,cd_pricing_type,cl.full_id FROM order_history oh 
			inner join component_list cl on oh.code = cl.key_id
			inner join component_details cd on cl.code_id = cd.cd_key_id 
			inner join component_types ct on cd.cd_type = ct.key_id 
			inner join suppliers s on cl.supplier_id = s.id WHERE cl.supplier_id= ? AND order_no = 0");
			$stmt->execute([$supplier_id]);
/*
0 tk.type 
1 tk.code
2 tk.kuvaus
3 tk.perusm
4 tk.laatu
5 t.nimi 
6 t.osoite
7 t.pnro
8 t.ptoimip
9 t.sposti
10 maara
11 tuote_id
12 t.pay_days 
13 t.deliveryterm 
14 t.delivery_way
15 tk.price
16 tk.amount_unit
17 ot.price_unit
18 tk.pricing_type
19 offer_rowprice
20 offer_no
*/

$pos[] = array();
$type[] = array();
$product_id[] = array();
$code[] = array();
$description[] = array();
$perusm[] = array();
$unit[] = array();
$ordered_amount[] = array();
$amount_unit[] = array();
$price[] = array();
$price_row[] = array();
$weight_row[] = array();
$pricing_type[] = array();
$offer_price[] = array();
$offer_no[] = array();
$pay_days = 0;
$delivery_term = '';
$delivery_way = '';
$total_price = 0.0;
$lang = ' ';
$supplier_name = ' ';
$supplier_address = ' ';
$supplier_postcode = ' ';
$supplier_city = ' ';
$supplier_email = ' '; 

$i = 0;
while ($row = $stmt->fetch())
{
$code[$i] = $row['code'];
$type[$i] = $row['cd_type'];
$description[$i] = $row['cd_description'];
$unit[$i] = $row['cd_unit'];
$pricing_type[$i] = $row['cd_pricing_type'];
$supplier_name = $row['s_name'];
$supplier_address = $row['s_address'];
$supplier_postcode = $row['s_postcode'];
$supplier_city = $row['s_city'];
$supplier_email = $row['s_email']; 
//$pos[$i] = $row[11];
$product_id[$i] = $row['full_id'];
$pay_days = $row['pay_days'];
$delivery_term = $row['deliveryterm'];
$delivery_way = $row['delivery_way'];
$ordered_amount[$i] = $row['cd_baseunit'] * $row['amount'];
$lang = $row['lang'];

switch($pricing_type[$i])
{
case 0://Perus Kpl/M/litra
	$price_row[$i] = sprintf('%8.2f',($row['cd_price'] *($row['cd_baseunit'] * $row['amount'])));
	$price[$i] = sprintf('%8.2f E',$row['cd_price']);
	$amount_unit[$i] = sprintf('%s %s',$ordered_amount[$i],$unit[$i]);
	break;

case 1: //Raudat ym kg.

	
	$weight_row[$i] = sprintf('%8.2f',($row['cd_amount_unit'] * ($row['cd_baseunit'] * $row['amount']))); 
	$price[$i] = sprintf('%8.2f E',$row['price_unit']);
	$price_row[$i] = sprintf('%8.2f',(($row['cd_amount_unit'] * ($row['cd_baseunit'] * $row['amount'] * $row['price_unit']))));
	$amount_unit[$i] = sprintf('%s %s(%s KG)',$ordered_amount[$i],$unit[$i],$weight_row[$i]);
	break;
}


$i = $i + 1;
} 
$max = $i;

  
$date = date('d.m.Y');
$date_plus_3weeks = strtotime(date("d.m.Y", strtotime($date)) . " +$time day");
$delivery_date = date('d.m.Y', $date_plus_3weeks);
$date_ordered = sprintf('%s %s',$purchase_order_date_string,$date);
$purchase_order_no = sprintf('%s %s',$purchase_order_no_string,$order_no);
$pdf = new PDF_Sector();
$pdf->SetAutoPageBreak(false);
$pdf->AddPage('P','A4','mm');
$pdf->Setfont('Arial', 'B',12);
$pdf->Cell(190,20,'',1);
$pdf->Cell(80);
$pdf->ln();
$pdf->Cell(80);
$pdf->Cell(30,10,$company_details['name']);
$pdf->ln(4);
$pdf->Cell(80);
$pdf->Cell(30,10,$company_details['street']);
$pdf->ln(4);
$pdf->Cell(80);
$pdf->Cell(30,10,"{$company_details['postcode']} {$company_details['city']}");
$pdf->ln(4);
$pdf->Cell(80);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(30,10,"{$purchase_order_vat_string} {$company_details['vat']}",0,1);
$pdf->SetFont('Arial','B',22);
$pdf->ln(2);
//$pdf->ln();
$pdf->cell(80);
$pdf->Cell(40,10,$purchase_order_header_string,0,1,'C');
$pdf->ln();
$pdf->SetFont('Arial','B',11);
$pdf->Cell(95,5,$purchase_order_no,1,0);
$pdf->Cell(95,5,$date_ordered,1,0);
$pdf->ln(6);
//$pdf->Cell(10);
$pdf->Cell(95,25,'',1,0);
$pdf->Cell(95,25,'',1,0);
$pdf->ln(0);
$pdf->Cell(30,10,$purchase_order_supplier_string,0);
$pdf->Cell(65);
$pdf->Cell(30,10,$purchase_order_delivery_address_string,0);
$pdf->ln(6);
$pdf->Cell(22);
$pdf->Cell(30,10,$supplier_name);
$pdf->Cell(75);
$pdf->Cell(30,10,'Eka-Sorvaus OY');
$pdf->ln(4);
$pdf->Cell(22);
$pdf->Cell(30,10,$supplier_address);
$pdf->Cell(75);
$pdf->Cell(30,10,'Savenvalajantie 19');
$pdf->ln(4);
$pdf->Cell(22);
$pdf->Cell(30,10,$supplier_postcode." ".$supplier_city);
$pdf->Cell(75);
$pdf->Cell(30,10,'85500 Nivala',0,1);
$pdf->Cell(95,10,$purchase_order_delivery_term_string.' '.$delivery_term,1,0);
$pdf->Cell(95,10,$purchase_order_payment_term_string.' '.$pay_days.' '.$purchase_order_days_string,1,1);
$pdf->Cell(95,10,$purchase_order_delivery_way_string.' '.$delivery_way,1,0);
$pdf->Cell(95,10,$purchase_delivery_date_string.' '.$delivery_date,1,0);
$pdf->ln(10);
$pdf->Cell(190,180,'',1);
$pdf->ln(0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(16,10,$purchase_order_pos_string);
//$pdf->Cell(4);
$pdf->Cell(30,10,$purchase_order_code_string);
$pdf->Cell(2);
$pdf->Cell(30,10,$purchase_order_desc_string);
$pdf->Cell(18);
$pdf->Cell(30,10,$purchase_order_amount_string);
$pdf->Cell(10);
$pdf->Cell(20,10,$purchase_order_price_string,0,0);
$pdf->Cell(12);
$pdf->Cell(20,10,$purchase_order_row_price_string,0,1);
for($i=0;$i < $max;$i++){
$vaihto_pos = $pdf->GetY();
if($vaihto_pos > 240){
$pdf->Ln();
$pdf->AddPage();
$pdf->Cell(190,250,'',1);
$pdf->Cell(100,5,'',0,1);
}
$pdf->Cell(16,10,$i+1);
$pdf->Cell(30,10,$code[$i]);
$pdf->Cell(2);
$description_length = strlen($description[$i]);
if($description_length > 19){
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();
$pdf->MultiCell(40,5,$description[$i]);
$pdf->SetXY($current_x+30,$current_y);
}
else {                   
$pdf->Cell(30,10,$description[$i]);
}
$pdf->Cell(20);
$pdf->Cell(10,10,$amount_unit[$i]);
$pdf->Cell(18);
//$pdf->Cell(30,10,$laatu[$i]);
$pdf->Cell(6);
//$pdf->Cell(30,10,$toimituspvm);
//if($hinta[$i]> 0){
$pdf->Cell(30,10,$price[$i],0,0);
$pdf->Cell(2);
$pdf->Cell(30,10,$price_row[$i].' E',0,1);
$total_price = $total_price + $price_row[$i];// }
//else{
//$pdf->Cell(30,10,'',0,1);}
if($description_length > 19){
$current_y = $pdf->GetY();
$pdf->SetY($current_y + 5);
}
}
if($total_price > 0){
$pdf->Cell(100);
$pdf->Cell(10,10,$purchase_order_total_price_string.' '.$total_price.' E');
}
for($i=0;$i < $max;$i++){
if($type[$i] == 1){
$dxf_file = sprintf("./dxfs/%s.dxf",$product_id[$i]);
if(file_exists($dxf_file)){
add_dxf($product_id[$i],$pdf,0);
$k = $i;
}
}}


switch($function){
case 0:
$doc_name = sprintf("./purchase_orders/order_%s.pdf",$order_no);
$pdf->Output($doc_name,'F');
echo $twig->render('pdf_document.html', array(
    'link' => $doc_name,
    'is_order' => true,
    'order_no' => $order_no
)); 
break;

case 1:
// email stuff (change data below)
$to = $toimittaja_sposti;
$from = $reply_to_email;
$subject = $tilausnro;
$message = $purchase_order_message_string;
// a random hash will be necessary to send mixed content
$separator = md5(time());
// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;
// attachment name
$filename = $purchase_order_filename_string;
//$filename2 = sprintf('%s.dxf',$id);
// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));
//$attachment2 = chunk_split(base64_encode($pdfdoc)); 

//chunk_split(base64_encode(file_get_contents('pdfs/%s.pdf',$id)));
// main header (multipart mandatory)
$headers  = "From: {$from}".$eol;
$headers .= "Reply-To: {$from}".$eol;
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol;
$headers .= "Content-Transfer-Encoding: 7bit".$eol;
$headers .= "This is a MIME encoded message.".$eol.$eol;

// message
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"".$eol;
$headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$headers .= $message.$eol.$eol;
// attachment pdf
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
$headers .= "Content-Transfer-Encoding: base64".$eol;
$headers .= "Content-Disposition: attachment".$eol.$eol;
$headers .= $attachment.$eol.$eol;
$headers .= "--".$separator."--";

// send message
mail($to, $subject, "", $headers);

//register order in DB
$stmt = $db->prepare("UPDATE order_history set order_no = ?,pvm = now() WHERE toimittaja = ? AND order_no = '0'");
$stmt->execute([$order_no,$toimittaja]);

//header("Location: index_ohjaaja_cssdivs.php?workspace_content_type=14");
break;
}
?>

          
