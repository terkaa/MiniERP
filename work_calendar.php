<?php
//error_reporting(E_ALL ^ E_WARNING);
//Hae perustiedot
require 'db_connect.php';

require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));

if(isset($_GET['id'])){
$id = $_GET['id']; }
else {
$id = null;}

if($id == null)
    $disable = "disabled";
else
    $disable = "";

$stmt2 = $db->query("SELECT key_id,make,type FROM machine_list"); //Get machine list to be used as headers of work table

while ($row2 = $stmt2->fetch()){

$machines[] = array('make' => $row2['make'], 'type' => $row2['type']); 

}

$current_day = date("d.m",strtotime(date('m/d/y')));

for($i = 0; $i <= 60; $i++){  //build working table for next 60 days
	$day = date("d.m",strtotime(date('m/d/y') . "+$i day"));
	$day_number = date("N",strtotime(date('m/d/y') . "+$i day"));
	$day_sql =  date("Y-m-d",strtotime(date('m/d/y') . "+$i day"));
	$date = new DateTime($day_sql);
	$week_number = $date->format("W");
	
        $days[$i] = array('day' => $day, 'day_sql' => $day_sql, 'machine' => array());

	
}







echo $twig->render('work_calendar.html', array(
   'machines' => $machines,
   'days' => $days,
   'current_day' => $current_day,
   'id'		 => $id,
   'disable'     => $disable 
));
