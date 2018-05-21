<?php

require 'db_connect.php';


  $date = $_POST["date"];
  $machine = $_POST["machine"];
  $id = $_POST["id"];

$json_string = '';


$stmt = $db->prepare("SELECT wlo.wlo_machine,wlo.wlo_work_id,wl.wl_description,wl.wl_full_id,wlo.wlo_key_id FROM work_load wlo 
	     INNER JOIN work_list wl on wlo.wlo_work_id = wl.wl_key_id WHERE wlo.wlo_day =? and wlo.wlo_machine =?");
$stmt->execute([$date,$machine]);
	



  $json_string .= "{\"processes\":[ ";
$i = 0;
  while ($row = $stmt->fetch()){
  $json_string .= "{";
  $json_string .= "\"key\":".$row['wlo_key_id'].",";
  $json_string .= "\"full_id\":".$row['wl_full_id'].",";
  $json_string .= "\"work_id\":".$row['wlo_key_id'].",";
  $json_string .= "\"description\":\"".$row['wl_description']."\"";
  $json_string .= "},";
  $i = $i + 1;
   }

if($i == 0){

  $json_string .= "{";	
  $json_string .= "\"key\":\"\",";
  $json_string .= "\"full_id\":\"\",";
  $json_string .= "\"description\":\"Vapaana\"";
  $json_string .= "},";
}
else{
  $json_string .= "{";	
  $json_string .= "\"key\":\"0\",";
  $json_string .= "\"full_id\":\"\",";
  $json_string .= "\"description\":\"Vapauta\"";
  $json_string .= "},";
}

if($id != null){

$stmt = $db->prepare("SELECT wl_order_no,wt.wt_description,wl_amount_per_set,wl.wl_work_type,wt.wt_multiplier,prod.p_weight,prod.p_area,prod.p_lot_size,wl.wl_description,wl.wl_key_id  FROM work_list wl
		inner join work_types wt on wl.wl_work_type = wt.wt_key_id
		inner join products prod on wl.wl_full_id = prod.p_id_code
		inner join component_types ct on wl.wl_order_code = ct.key_id
		WHERE wl.wl_full_id = ? AND wl.wl_work_type BETWEEN 17 AND 18 ORDER BY wl_order_no");
$stmt->execute([$id]);



while ($row = $stmt->fetch()){
  $json_string .= "{";	
  $json_string .= "\"key\":".$row['wl_key_id'].",";
  $json_string .= "\"full_id\":".$id.",";
  $json_string .= "\"description\":\"".$row['wl_description']."\"";
  $json_string .= "},";
  }
}
 $json_string = substr($json_string, 0, -1);
 
  $json_string .= "]}";



  echo $json_string;
  
  
?> 
