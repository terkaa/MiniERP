<?php
//Function used to render order add form
require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));
$list = array();

  if(isset($_GET['order_id'])){
  $order_id = $_GET['order_id']; }
  else {
  $order_id = null;}

  if(isset($_GET['customer_id'])){
  $customer_id = $_GET['customer_id']; }
  else {
  $customer_id = 0;}

$stmt = $db->query('SELECT key_id,c_name FROM customers');


$i = 0;
while ($row = $stmt->fetch())
{
$list[] = array('id' => $row['key_id'],'name' => $row['c_name']);
}

echo $twig->render('order_add.html', array(
    'list' => $list,
    'order_id' => $order_id,
    'customer_id' => $customer_id
));
