<?php

  require 'db_connect.php';
  $key = $_POST["key"];
  $name = $_POST["name"];


 $stmt = $db->prepare("UPDATE employers SET name = ? WHERE key_id = ?");
 $stmt->execute([$name,$key]);    

return $key;
  
?> 
