<?php
//Function used to list open orders to left side orders div
require 'vendor/autoload.php';
require 'db_connect.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

$list = array();


//hae tilaukset listaan

$stmt = $db->query('SELECT order_id,ordered_date,invoiced FROM order_list WHERE invoiced=0 GROUP BY order_id,ordered_date Order by ordered_date');
$i = 0;

while ($row = $stmt->fetch()){
$list[] = array('no' => $i,'id' => $row['order_id']);
$i++;
    }


echo $twig->render('list.html', array(
    'list' => $list,
    'link_class' => 'order_link'
));
