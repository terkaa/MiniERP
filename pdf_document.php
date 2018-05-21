<?php
//Show PDF file for ID or pdf file add form
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
$pdf_file = '';
$pdf_exists = false;
$pdf_file = sprintf("./pdf/%s.pdf",$id);
if (file_exists($pdf_file)){
	$pdf_exists = true; }


$link = $pdf_file;

echo $twig->render('pdf_document.html', array(
    'link' => $link,
    'id' => $id,
    'document_exists' => $pdf_exists
     
));
?>
