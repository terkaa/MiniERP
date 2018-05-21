<?php
//Lists details of specific supplier
require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',

));

if(isset($_GET['supplier_id'])){
  $supplier_id = $_GET['supplier_id'];
  $stmt = $db->prepare("SELECT * FROM suppliers WHERE id = ?");
  $stmt->execute([$supplier_id]);

  while ($row = $stmt->fetch())
  {

 	$supplier = array('s_id' => $row['id'],'s_name' => $row['s_name'], 's_address' => $row['s_address'],
			 's_postcode' => $row['s_postcode'],'s_city' => $row['s_city'],'s_email' => $row['s_email'],
		         's_delivery_way' => $row['delivery_way'],'s_delivery_term' => $row['deliveryterm']); 
 } 




echo $twig->render('supplier_show.html', array(
   'supplier' => $supplier,
   'disabled' => 'disabled'));  







 }
  else {
  $supplier_id = null;}


?>
