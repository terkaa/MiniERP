<?php
//Show added component for verify purposes after adding it to database
require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',

));

if(isset($_GET['key_id'])){
  $key_id = $_GET['key_id'];
  $stmt = $db->prepare("SELECT cd_key_id,cd_type,cd_code,cd_description,cd_baseunit,cd_unit,cd_price FROM component_details WHERE cd_key_id = ?");
  $stmt->execute([$key_id]);

  while ($row = $stmt->fetch())
	{
	$parts[] =  array('part_desc' => $row['cd_description'],'code' => $row['cd_code'], 
			'lot' => $row['cd_baseunit'],'unit' => $row['cd_unit'],'price' => $row['cd_price'], 'key' => $row['cd_key_id']);	
	}




echo $twig->render('component_show.html', array(
   'parts' => $parts
	));  
 }
  else {
  $key_id = null;}


?>
