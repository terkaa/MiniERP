<?php
//List shopping carts grouped by suppliers if order_no = 0 parts are unordered after order is made order no is added
require 'vendor/autoload.php';
require 'db_connect.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));



$stmt = $db->query("SELECT DISTINCT s_name,s.id AS sid,order_state FROM order_history oh
            inner join component_list cl on oh.code = cl.key_id
            inner join component_details cd on cl.code_id = cd.cd_key_id
            inner join suppliers s on cl.supplier_id = s.id WHERE order_no = 0");

$i=0;

while ($row = $stmt->fetch()){
    $list[] = array('no' => $row['sid'],'id' => $row['s_name']);
    $i++;
}

echo $twig->render('list.html', array(
    'list' => $list,
    'link_class' => 'basket_link'
));

?>
