<?php

  require 'db_connect.php';
  
  $work_id = $_POST["work_id"];
  $date = $_POST["date"];
  $machine = $_POST["machine"];
  
//  $id = $_POST["id"];

  $stmt = $db->prepare("INSERT INTO work_load(wlo_machine,wlo_work_id,wlo_day) VALUES (?,?,?)");
  $stmt->execute([$machine,$work_id,$date]);
  
  
?> 
