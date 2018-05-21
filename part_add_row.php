<?php
//Function used to add component to database

  require 'db_connect.php';

  $supplier = $_POST["supplier"];
  $id_code = $_POST["id_code"];
  $main_type = $_POST["main_type"];
  $part_id = $_POST["part_id"];
  

 $stmt = $db->prepare("INSERT INTO component_list(full_id,comp_type,supplier_id,code_id) VALUES (?,?,?,?)");
 $stmt->execute([$id_code,$main_type,$supplier,$part_id]);   

 $stmt = $db->query("SELECT key_id FROM component_list ORDER BY key_id DESC LIMIT 1");
 while ($row = $stmt->fetch())
 	{
	$last = $row['key_id'];
	}  
echo $last;


?> 


