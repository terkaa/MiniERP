<?php
//function used to list components under specific main_type 
require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));
$parts = array();

  if(isset($_GET['main_type'])){
  $main_type = $_GET['main_type']; }
  else {
  $main_type = null;}

  if(isset($_GET['id'])){
  $id = $_GET['id']; }
  else {
  $id = null;}

$stmt = $db->prepare('SELECT cd_key_id,cd_code,cd_description FROM component_details WHERE cd_type = ?');
$stmt->execute([$main_type]);


$i = 0;
while ($row = $stmt->fetch())
{
$parts[] = array('id' => $row['cd_key_id'],'desc' => $row['cd_description'], 'code' => $row['cd_code'], 'no' => $i);
$i = $i + 1;
}

echo $twig->render('parts_show.html', array(
    'parts' => $parts,
    'id' => $id
));
