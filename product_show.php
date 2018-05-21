<?php
//Function used to get details of product with specific ID
require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',

));

if(isset($_GET['product_id'])){
  $product_id = $_GET['product_id'];
  $stmt = $db->prepare("SELECT * FROM products WHERE p_key_id = ?");
  $stmt->execute([$product_id]);

  while ($row = $stmt->fetch())
  {

 	$product = array('p_id' => $row['p_key_id'],'id_code' => $row['p_id_code'], 'weight' => $row['p_weight'],
			 'area' => $row['p_area'],'lot_size' => $row['p_lot_size'], 'price' => $row['p_share_qualifier'], 'desc' => $row['p_description']); 
 } 




echo $twig->render('product_show.html', array(
   'product' => $product,
   'disabled' => 'disabled'));  







 }
  else {
  $product_id = null;}


?>
