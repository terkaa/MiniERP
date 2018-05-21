<?php
//Function used to upload DXF file to server
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

$content = array();

  $content[] = sprintf("Ladataan: " . $_POST["id"]);
  $content[] = sprintf("Tyyppi: " . $_FILES["dxf_input"]["type"]);
  $content[] = sprintf("Koko: " . ($_FILES["dxf_input"]["size"] / 1024) . " Kb");
  $content[] = sprintf("Temppi: " . $_FILES["dxf_input"]["tmp_name"]);
  
  if (file_exists("./dxfs/" . $_POST["id"].".dxf"))
      {
      $content[] = sprintf($_POST["id"] . " already exists. ");
      }
    else
      {
      move_uploaded_file($_FILES["dxf_input"]["tmp_name"],
      "./dxfs/" . $_POST["id"].".dxf");
      $content[] = sprintf("Talletettiin: " . "./dxfs/" . $_POST["id"].".dxf");
      }
  $content[] = sprintf("-----------------------------------------");

echo $twig->render('insert_file.html', array(
    'content' => $content,
    'id' => $_POST["id"],
    'dxf' => true
));
?>
