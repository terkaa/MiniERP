<?php

require 'vendor/autoload.php';
require 'db_connect.php';
 
$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

  if(isset($_GET['employee'])){
  $employee = $_GET['employee'];

  
$stamps = array();
$i = 0;

$stmt = $db->prepare("SELECT * FROM work_calendar WHERE employer_id = ? ORDER BY time");
$stmt->execute([$employee]);
  
while ($row = $stmt->fetch())
{

$stamps[] = array('key_id' => $row['key_id'],'at_work' => $row['event_id'],'time' => $row['time'],'no' => $i);
$i = $i + 1;
}


echo $twig->render('clockcard_get_stamps_employee.html', array(
    'stamps' => $stamps,
));

 }
 else {
 $employee = null;}

?>
