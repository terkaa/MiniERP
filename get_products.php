<?php
//Function used to list products that contain specific phrase
require 'vendor/autoload.php';
require 'db_connect.php';

if(isset($_GET['phrase'])){
    $phrase = $_GET['phrase'];
} else {
    $phrase = null;
}
$phrase = "%$phrase%";
$i = 0;
$list = array();

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

$stmt = $db->prepare("SELECT p_key_id,p_id_code FROM products WHERE p_id_code LIKE ? ORDER by p_id_code");
$stmt->execute([$phrase]);
$products = array();

while ($row = $stmt->fetch())
{
    $list[] = array('no' => $i, 'id' => $row['p_id_code']);
    $i++;
}

echo $twig->render('list.html', array(
    'list' => $list,
    'link_class' => 'product_link' 
));
