<?php
//Function used to add parts to shopping cart
  require 'db_connect.php';

  $key = $_POST["key"];
  $amount = $_POST["amount"];
  $state = 1;
  $order_no = 0;


 $stmt = $db->prepare("INSERT INTO order_history(code,amount,order_state,order_no) VALUES (?,?,?,?)");
 $stmt->execute([$key,$amount,$state,$order_no]);    

return "ok";
  
?> 
