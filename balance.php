<?php
//gets balances for products that are on order also gets dates for products that are out of stock
require 'db_connect.php';
require 'vendor/autoload.php';
require 'db_connect.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',

));
$balance[] = array();
$balance2[] = array();

$date = date('W');

$result_temptable = $db->query('DROP TEMPORARY TABLE IF EXISTS temp_table2');


$stmt = $db->query("CREATE TEMPORARY TABLE temp_table2 (
      `avain` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
      `full_id` varchar(25),
      `varastossa` int(11),
      `tilauksessa` int(11),
      `total` int(11),
      `pvm` date)");



$stmt = $db->query('SELECT p_full_id, p_instock FROM products ORDER by p_full_id');

$i = 0;
$id_code = ' ';

while ($row = $stmt->fetch())
{
$stmt2 = $db->prepare("SELECT pcs,date_wanted FROM order_list WHERE pc_id_code = ? AND date_sent IS NULL");
$stmt2->execute([$row['p_full_id']]);

$kok_maara = $row['p_instock'];
$tilauksessa = 0;
while ($row2 = $stmt2->fetch())
{
$kok_maara = $kok_maara - $row2['pcs'];
$tilauksessa = $tilauksessa + $row2['pcs'];
$tausta = 'red';
if($kok_maara < 0){

 $inserttemp = $db->prepare('INSERT INTO temp_table2 (`full_id`, `varastossa`, `tilauksessa`, `total`,`pvm`) VALUES (?,?,?,?,?)');
 $inserttemp->execute([$row['p_full_id'],$row['p_instock'],$tilauksessa,$kok_maara,$row2['date_wanted']]);

}
}

$kok_maara = 0;

$i = $i + 1;
}
$i = 0;
$stmt3 = $db->query('SELECT * FROM temp_table2 ORDER by pvm');

/*
 0 avain
 1 full_id
 2 varastossa
 3 tilauksessa
 4 total
 5 pvm
*/

$prev_week = 0;
while ($row3 = $stmt3->fetch())
{
$date = new DateTime($row3['pvm']);
$week = $date->format("W");

$balance[] =  array('date' => date("d.m.y", strtotime($row3['pvm'])), 'week' => $week, 'id' => $row3['full_id'], 'instock' => $row3['varastossa'],
                'onorder' => $row3['tilauksessa'],'left' => $row3['total']);




}

$stmt4 = $db->query("SELECT order_list.pc_id_code,SUM(pcs) AS onorder,p_key_id FROM order_list INNER JOIN products prod on order_list.pc_id_code = prod.p_full_id WHERE date_sent IS NULL GROUP by pc_id_code");

while ($row4 = $stmt4->fetch())
{
$stmt5 = $db->prepare('SELECT p_instock FROM products WHERE p_key_id = ?');
$stmt5->execute([$row4['p_key_id']]);
$instock = $stmt5->fetchColumn();
$left = $instock - $row4['onorder'];

$balance2[] = array('id' => $row4['pc_id_code'], 'instock' => $instock,
                'onorder' => $row4['onorder'],'left' => $left);
}




echo $twig->render('balance.html', array(
   'balance' => $balance,
   'balance2' => $balance2
));
