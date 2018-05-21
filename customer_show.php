<?php
//Show customer details
require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',

));

if(isset($_GET['customer_id'])){
  $customer_id = $_GET['customer_id'];
  $stmt = $db->prepare("SELECT * FROM customers WHERE key_id = ?");
  $stmt->execute([$customer_id]);

  while ($row = $stmt->fetch())
  {

 	$customer = array('c_id' => $row['key_id'],'c_name' => $row['c_name'], 'c_address' => $row['c_address'],
			 'c_postcode' => $row['c_postcode'],'c_city' => $row['c_city'], 'c_vat' => $row['c_vat'], 'c_contact' => $row['c_buyer'],
			 'c_email' => $row['c_email'],'c_delivery_way' => $row['c_delivery_way'],'c_delivery_custno' => $row['c_delivery_custno']); 
 } 




echo $twig->render('customer_show.html', array(
   'customer' => $customer,
   'disabled' => 'disabled'));  







 }
  else {
  $customer_id = null;}


?>
