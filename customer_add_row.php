<?php
//Function used to add customer details to database
  require 'db_connect.php';

  $c_name = $_POST["c_name"];
  $c_address = $_POST["c_address"];
  $c_postcode = $_POST["c_postcode"];
  $c_city = $_POST["c_city"];
  $c_vat = $_POST["c_vat"];
  $c_contact = $_POST["c_contact"];
  $c_email = $_POST["c_email"];
  $c_delivery_way = $_POST["c_delivery_way"];
  $c_delivery_custno = $_POST["c_delivery_custno"];


 $stmt = $db->prepare("INSERT INTO customers(c_name,c_address,c_postcode,c_city,c_vat,c_email,c_buyer,c_delivery_way,c_delivery_custno) VALUES (?,?,?,?,?,?,?,?,?)");
 $stmt->execute([$c_name,$c_address,$c_postcode,$c_city,$c_vat,$c_email,$c_contact,$c_delivery_way,$c_delivery_custno]);   

 $stmt = $db->query("SELECT key_id FROM customers ORDER BY key_id DESC LIMIT 1");
 while ($row = $stmt->fetch())
 	{
	$last = $row['key_id'];
	}  
echo $last;


?> 

