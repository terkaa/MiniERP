<?php
//Function used to delete parts from shopping cart
  require 'db_connect.php';
  $key = $_POST["key"];



 $stmt = $db->prepare("DELETE FROM order_history WHERE key_id = ?");
 $stmt->execute([$key]);    

return $key;
  
?> 
