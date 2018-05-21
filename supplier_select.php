<?php
//Creates supplier select form
require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));
$suppliers = array();

  if(isset($_GET['id'])){
  $id = $_GET['id']; }
  else {
  $id = null;}

  if(isset($_GET['main_type'])){
  $main_type = $_GET['main_type']; }
  else {
  $main_type = null;}

  if(isset($_GET['part_id'])){
  $part_id = $_GET['part_id']; }
  else {
  $part_id = null;}

$stmt = $db->query('SELECT id,s_name FROM suppliers');


$i = 0;
while ($row = $stmt->fetch())
{
$suppliers[] = array('id' => $row['id'],'name' => $row['s_name']);
}

echo $twig->render('supplier_select.html', array(
    'suppliers' => $suppliers,
    'part_id' => $part_id,
    'id_code' => $id,
    'main_type' => $main_type
));
