<?php
//Function used to list specific order by order_no
require 'vendor/autoload.php';
require 'db_connect.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(

));

  if(isset($_GET['order_id'])){
  $order_id = $_GET['order_id']; }
  else {
  $order_id = null;}

  
//$order_id = "%$order_id%";
$order_date = '';
$ei_lah = 'aaa';
$i = 1;

$stmt = $db->prepare("SELECT * FROM order_list WHERE order_id = ?");
$stmt->execute([$order_id]);
$row = $stmt->fetch();
if( ! $row)
{
	
}
else {

$stmt = $db->prepare("SELECT * FROM order_list ol 
		      INNER JOIN customers cust on ol.c_id = cust.key_id
                      INNER JOIN products prod on ol.pc_id_code = prod.p_full_id
		      WHERE order_id LIKE ?");
$stmt->execute([$order_id]);



  
$all_rows_sent = 1;
$sent_pvm = ' ';

while ($row = $stmt->fetch())
{
if($row['date_sent'] == "0000-00-00" | $row['date_sent'] == NULL ){
	$sent_pvm = 'ei';
	$all_rows_sent = 0;
}
else {
	$sent_pvm = date("d.m.Y", strtotime($row['date_sent']));
}

$order_row[] = array('pos' => $i,'order_id' => $row['order_id'],'ordered_date' => $row['ordered_date'], 'c_name' => $row['c_name'],
			 'c_address' => $row['c_address'],'c_postcode' => $row['c_postcode'], 'c_city' => $row['c_city'], 'pc_id_code' => $row['pc_id_code'],
			 'descript' => $row['p_description'],'date_wanted' => $row['date_wanted'],'pcs' => $row['pcs'],
			 'date_sent' => $sent_pvm, 'invoiced' => $row['invoiced'], 'c_warehouse' => $row['c_warehouse'], 'c_id' => $row['key_id'] );
 $i = $i + 1;

}

$order_details = array('order_id' => $order_row[0]['order_id'], 'order_date' => date("d.m.Y", strtotime($order_row[0]['ordered_date'])), 
		'c_name' => $order_row[0]['c_name'], 'c_address' => $order_row[0]['c_address'], 'c_postcode' => $order_row[0]['c_postcode'], 'c_city' => $order_row[0]['c_city'], 'c_id' => $order_row[0]['c_id']);


echo $twig->render('order.html', array(
    'order_row' => $order_row,
    'order_details' => $order_details,
    'all_rows_sent' => $all_rows_sent,
    'order_id' => $order_id
));  
}
?>
