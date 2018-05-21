<?php
//Function used to add product to database

  require 'db_connect.php';

  $id_code = $_POST["id_code"];
  $desc = $_POST["desc"];
  $weight = $_POST["weight"];
  $area = $_POST["area"];
  $lot_size = $_POST["lot_size"];
  $price = $_POST["price"];
  

 $stmt = $db->prepare("INSERT INTO products(p_id_code,p_full_id,p_area,p_weight,p_lot_size,p_share_qualifier,p_description) VALUES (?,?,?,?,?,?,?)");
 $stmt->execute([$id_code,$id_code,$area,$weight,$lot_size,$price,$desc]);   

 $stmt = $db->query("SELECT p_key_id FROM products ORDER BY p_key_id DESC LIMIT 1");
 while ($row = $stmt->fetch())
 	{
	$last = $row['p_key_id'];
	}  
echo $last;
