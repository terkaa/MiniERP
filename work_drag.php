<?php


  
  $machine = $_POST["machine"];
  $key = $_POST["key"];
  $date = $_POST["date"];
  
//  $id = $_POST["id"];

  require 'db_connect.php';
  $stmt = $db->prepare("UPDATE work_load SET wlo_day=?,wlo_machine=? WHERE wlo_key_id=?");
  $stmt->execute([$date,$machine,$key]);	
  
  
?> 
