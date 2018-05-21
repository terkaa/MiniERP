<?php


  require 'db_connect.php';
  $key = $_POST["key"];
  $work_id = $_POST["work_id"];
  
//  $id = $_POST["id"];
  $stmt = $db->prepare("UPDATE work_load SET wlo_work_id=? WHERE wlo_key_id=?");
  $stmt->execute([$work_id,$key]);

 
   
  
?> 
