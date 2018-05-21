<?php
//Function used to upload PDF file to server
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

$content = array();

  //PDF    
  $content[] = sprintf("Ladataan: " . $_POST["id"]);
  $content[] = sprintf("Tyyppi: " . $_FILES["pdf_input"]["type"]);
  $content[] = sprintf("Koko: " . ($_FILES["pdf_input"]["size"] / 1024) . " Kb");
  $content[] = sprintf("Temppi: " . $_FILES["pdf_input"]["tmp_name"]);
  
  if (file_exists("./pdf/" . $_POST["id"].".pdf"))
      {
      $oontent[] = sprintf($_POST["id"] . " pdf on jo olemassa. ");
      }
    else
      {
      move_uploaded_file($_FILES["pdf_input"]["tmp_name"],
      "./pdf/" . $_POST["id"].".pdf");
      $content[] = sprintf("Talletettiin tiedostoon: " . "./pdf/" . $_POST["id"].".pdf");
      }
 $content[] = sprintf("-----------------------------------------");
 $content[] = sprintf("PDF lataus valmis");

echo $twig->render('insert_file.html', array(
    'content' => $content,
    'id' => $_POST["id"]
));
?>
