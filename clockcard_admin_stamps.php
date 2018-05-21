<?php

require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

  if(isset($_GET['tag'])){
  $tag = $_GET['tag']; }
  else {
  $tag = null;}

  
$tag = "%$tag%";
$employees = array();

$stmt = $db->query("SELECT key_id,name FROM employers");
$i = 0;	
  
while ($row = $stmt->fetch())
{

$employees[] = array('key_id' => $row['key_id'],'name' => $row['name']); 

}


echo $twig->render('clockcard_admin_stamps.html', array(
    'employees' => $employees,
));

?>
