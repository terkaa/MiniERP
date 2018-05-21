<?php
//function used to get stock amount for ID
require 'db_connect.php';

$key= $_POST["key"];

$stmt = $db->prepare('SELECT p_instock FROM products WHERE p_full_id = ?');
$stmt->execute([$key]);

$row = $stmt->fetch();
$saldo = $row['p_instock'];

echo $saldo;

?>
