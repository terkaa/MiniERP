<?php

require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',

));

if(isset($_GET['key_id'])){
  $key_id = $_GET['key_id'];
  $stmt = $db->prepare("SELECT ct.description AS part_desc,s_name,cd_description AS order_code,cd_code,cd_baseunit,cd_unit,supplier_id,cd_key_id,cd_price,cl.key_id,full_id FROM component_list cl 
			inner join component_types ct on cl.comp_type = ct.key_id 
			inner join suppliers s on cl.supplier_id = s.id
			inner join component_details cd on cl.code_id = cd.cd_key_id
			WHERE cl.key_id = ?");
  $stmt->execute([$key_id]);

  while ($row = $stmt->fetch())
	{
	$parts[] =  array('part_desc' => $row['part_desc'], 'order_code' => $row['order_code'], 
			'code' => $row['cd_code'], 'name' => $row['s_name'], 'lot' => $row['cd_baseunit'],
			'unit' => $row['cd_unit'], 'supplier_id' => $row['supplier_id'], 'id' => $row['cd_key_id'],
			'price' => $row['cd_price'], 'key' => $row['key_id'],'id' => $row['full_id']);	
	}




echo $twig->render('component_show.html', array(
   'parts' => $parts
	));  
 }
  else {
  $key_id = null;}


?>
