<?php
//Creates new component details add form
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

  if(isset($_GET['main_type'])){
  $main_type = $_GET['main_type']; }
  else {
  $main_type = null;}


echo $twig->render('part_add_new.html', array(
		   'main_type' => $main_type,
		   'id' => $id));


