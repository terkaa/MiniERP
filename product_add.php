<?php
//Creates product details add form
require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

  if(isset($_GET['order_id'])){
  $order_id = $_GET['order_id']; }
  else {
  $order_id = null;}

  if(isset($_GET['customer_id'])){
  $customer_id = $_GET['customer_id']; }
  else {
  $customer_id = 0;}

  if(isset($_GET['product_id'])){
  $product_id = $_GET['product_id']; }
  else {
  $product_id = null;}


echo $twig->render('product_add.html', array(
		   'order_id' => $order_id,
	   	   'customer_id' => $customer_id,
		   'product_id' => $product_id
	));
