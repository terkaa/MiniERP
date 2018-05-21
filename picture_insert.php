<?php
//Function used to upload & resize & create thumbnail of JPEG for specific ID
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

$content = array();

if ($_FILES["picture_input"]["error"] > 0)
  {
  $content[] = sprintf("Virhe: " . $_FILES["picture_input"]["error"]);
  }          
else
  {
  
  //JPEG
  $content[] = sprintf("Lataa: " . $_POST["id"]);
  $content[] = sprintf("Tyyppi: " . $_FILES["picture_input"]["type"]);
  $content[] = sprintf("Koko: " . ($_FILES["picture_input"]["size"] / 1024) . " Kb");
  $content[] = sprintf("Temppi: " . $_FILES["picture_input"]["tmp_name"]);
  
  //check that JPEG width is 640px
  list($width, $height) = getimagesize($_FILES["picture_input"]["tmp_name"]);
  if ($width != 640) {
  $content[] = sprintf("Leveys:".$width."  muutetaan...");
   $modwidth = 640; 
 $modheight = 480;
 $tn = imagecreatetruecolor($modwidth, $modheight) ;
 $image = imagecreatefromjpeg($_FILES["picture_input"]["tmp_name"]) ; 
 imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 
 // Here we are saving the .jpg, you can make this gif or png if you want //the file name is set above, and the quality is set to 100% 
 imagejpeg($tn, $_FILES["picture_input"]["tmp_name"], 100) ; 
}   
  if (file_exists("./pics/" . $_POST["id"].".jpg"))
      {
      $content[] = sprintf($_POST["id"] . " kuva on jo olemassa. ");
      }
    else
      {
      move_uploaded_file($_FILES["picture_input"]["tmp_name"],
      "./pics/" . $_POST["id"].".jpg");
      $content[] = sprintf("Talletettiin: " . "./pics/" . $_POST["id"].".jpg");
      }
   $content[] = sprintf("-----------------------------------------");
   
  // Thumbnail
   
 //Name you want to save your file as 
$save = "./pics/thumbs/" . $_POST["id"].".jpg";

$file = "./pics/" . $_POST["id"].".jpg"; 
$content[] = sprintf("Luodaan galleria kuvaa: ".$save); 
//$size = 0.45; 
//header('Content-type: image/jpeg') ; 
list($width, $height) = getimagesize($file) ;
 $modwidth = 100; 
 $modheight = 75;
 $tn = imagecreatetruecolor($modwidth, $modheight) ;
 $image = imagecreatefromjpeg($file) ; 
 imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 
 // Here we are saving the .jpg, you can make this gif or png if you want //the file name is set above, and the quality is set to 100% 
 imagejpeg($tn, $save, 100) ;
 $content[] = sprintf("Galleria kuva valmis");

echo $twig->render('insert_file.html', array(
    'content' => $content,
    'id' => $_POST["id"]
));


}
?>
