<?php
//Function used to list components with specific phrase 
require 'vendor/autoload.php';
require 'db_connect.php';

if(isset($_GET['phrase'])){
$phrase = $_GET['phrase']; }
else {
$phrase = null;}
$phrase = "%$phrase%";
$i = 0;
$list = array();

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

$stmt = $db->prepare("SELECT cd_key_id,cd_code,cd_description FROM component_details WHERE cd_description LIKE ?");
$stmt->execute([$phrase]);
$parts = array();

while ($row = $stmt->fetch())
{ 
$parts[] = array('no' => $i, 'id' => $row['cd_key_id'], 'code' => $row['cd_code'],'desc' => $row['cd_description']);
$i++;
}

echo $twig->render('parts_show.html', array(
    'parts' => $parts
    ));
