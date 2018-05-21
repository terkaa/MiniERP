<?php
//This show shopping cart for specific supplier where order_no = 0
require 'vendor/autoload.php';
require 'db_connect.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

if(isset($_GET['supplier'])){
    $supplier = $_GET['supplier']; }
else {
    $supplier = null;}
$lang = 0;
$basket_row = array();
$supplier_details = array();

$stmt = $db->prepare("SELECT cd_code,cd_description,cd_baseunit,cd_unit,s_name,s_address,s_postcode,s_city,s_email,oh.amount,oh.key_id,s.lang,s.id FROM order_history oh
inner join component_list cl on oh.code = cl.key_id
inner join component_details cd on cl.code_id = cd.cd_key_id
inner join suppliers s on cl.supplier_id = s.id WHERE s.id = ? AND oh.order_no = '0'");
$stmt->execute([$supplier]);

$i = 1;
while ($row = $stmt->fetch())
{

    $basket_row[] = array('pos' => $i,'code' => $row['cd_code'],'desc' => $row['cd_description'], 'amount' => $row['amount'],
                          'unit' => $row['cd_unit'], 's_name' => $row['s_name'], 's_address' => $row['s_address'], 's_postcode' => $row['s_postcode'],
                          's_city' => $row['s_city'], 's_email' => $row['s_email'], 'lang' => $row['lang'], 'key' => $row['key_id'], 'supplier_id' => $row['id']);
    $i = $i + 1;

}

if($i > 1) {
$supplier_details = array('name' => $basket_row[0]['s_name'], 'address' => $basket_row[0]['s_address'],
                          'postcode' => $basket_row[0]['s_postcode'], 'city' => $basket_row[0]['s_city'],
                          'email' => $basket_row[0]['s_email'],'lang' => $basket_row[0]['lang'], 'id' => $basket_row[0]['supplier_id']);
}

echo $twig->render('basket_show.html', array(
    'basket_row' => $basket_row,
    'supplier_details' => $supplier_details
));


?>
