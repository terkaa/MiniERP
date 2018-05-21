<?php
//Function used to add new row to order
  require 'db_connect.php';

  $order_id = $_POST["order_id"];
  $product_id = $_POST["product_id"];
  $amount = $_POST["amount"];
  $date_wanted = $_POST["date_wanted"];
  $date_ordered = $_POST["date_ordered"];
  $customer = $_POST["customer"];
  $pos = 2;


 $stmt = $db->prepare("INSERT INTO order_list(order_id,pc_id_code,pcs,date_wanted,ordered_date,c_id,visible_warehouse,invoiced) VALUES (?,?,?,?,?,?,?,?)");
 $stmt->execute([$order_id,$product_id,$amount,$date_wanted,$date_ordered,$customer,1,0]);    

?> 

