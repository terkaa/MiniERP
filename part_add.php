<?php
//Function used to list components under specific main type
require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));
$list = array();

  if(isset($_GET['id'])){
  $id = $_GET['id']; }
  else {
  $id = null;}

$stmt = $db->query('SELECT key_id,description FROM component_types');


$i = 0;
while ($row = $stmt->fetch())
{
$main_types[] = array('id' => $row['key_id'],'desc' => $row['description']);
}

echo $twig->render('part_add.html', array(
    'main_types' => $main_types,
    'id' => $id
));
