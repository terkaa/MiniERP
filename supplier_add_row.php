<?php
//Function used to add supplier to database
  require 'db_connect.php';

  $name = $_POST["name"]; 
  $address = $_POST["address"]; 
  $postcode = $_POST["postcode"]; 
  $city = $_POST["city"]; 
  $phone = $_POST["phone_no"]; 
  $email = $_POST["email"];
  $delivery_way = $_POST["delivery_way"];
  $deliveryterm = $_POST["deliveryterm"];
  $paydays = $_POST["paydays"];


 $stmt = $db->prepare("INSERT INTO suppliers(s_name,s_address,s_postcode,s_city,s_email,s_phone,pay_days,deliveryterm,delivery_way) VALUES (?,?,?,?,?,?,?,?,?)");
 $stmt->execute([$name,$address,$postcode,$city,$email,$phone,$paydays,$deliveryterm,$delivery_way]);   

 $stmt = $db->query("SELECT id FROM suppliers ORDER BY id DESC LIMIT 1");
 while ($row = $stmt->fetch())
 	{
	$last = $row['id'];
	}  
echo $last;


?> 


