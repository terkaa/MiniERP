<?php

  require 'db_connect.php';
  $key = $_POST["key"];



 $stmt = $db->prepare("DELETE FROM work_calendar WHERE employer_id = ?");
 $stmt->execute([$key]);    

return $key;
  
?> 
