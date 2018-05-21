<?php
//Customer details add form
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


echo $twig->render('customer_add.html', array(
		   'order_id' => $order_id));


