<?php


  require 'db_connect.php';
  $key = $_POST["key"];

  $stmt = $db->prepare("DELETE from work_load WHERE wlo_key_id=?");
  $stmt->execute([$key]);
   
   
  
?> 
