<?php
//Function used to add component into database this component can then be added to specific product
  require 'db_connect.php';

  $desc = $_POST["desc"];
  $component_id = $_POST["id_code"];
  $base_size = $_POST["base_size"];
  $unit = $_POST["unit"];
  $price = $_POST["price"];
  $main_type = $_POST["main_type"];
  $part_id = $_POST["part_id"];
 

 $stmt = $db->prepare("INSERT INTO component_details(cd_type,cd_code,cd_description,cd_baseunit,cd_unit,cd_price) VALUES (?,?,?,?,?,?)");
 $stmt->execute([$main_type,$component_id,$desc,$base_size,$unit,$price]);   

 $stmt = $db->query("SELECT cd_key_id FROM component_details ORDER BY cd_key_id DESC LIMIT 1");
 while ($row = $stmt->fetch())
 	{
	$last = $row['cd_key_id'];
	}  
echo $last;


?> 


