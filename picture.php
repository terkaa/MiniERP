<?php
//Shows JPG file for specific ID
require 'vendor/autoload.php';
require 'db_connect.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

  if(isset($_GET['id'])){
  $id = $_GET['id']; }
  else {
  $id = null;}

$picture_exists = false;

$picture_file = sprintf("./pics/%s.jpg",$id);
if (file_exists($picture_file)){
	$picture_exists = true; }

echo $twig->render('picture.html', array(
    'id' => $id,
    'picture_exists' => $picture_exists
));
?>
