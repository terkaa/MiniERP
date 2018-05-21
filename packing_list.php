<?php
//List shopping carts grouped by suppliers if order_no = 0 parts are unordered after order is made order no is added
require 'vendor/autoload.php';
require 'db_connect.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));



$stmt = $db->query('SELECT c_id,c_name FROM order_list
            INNER JOIN customers cust on order_list.c_id = cust.key_id
            WHERE invoiced=0 GROUP BY c_name Order by ordered_date');

$i=0;

while ($row = $stmt->fetch()){
    $list[] = array('no' => $row['c_id'],'id' => $row['c_name']);
    $i++;
}

echo $twig->render('list.html', array(
    'list' => $list,
    'link_class' => 'packing_link'
));

?>
