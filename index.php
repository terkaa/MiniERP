<?php
//Function used to create main window with all needed divs
require 'vendor/autoload.php';
require 'db_connect.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(
    // Uncomment the line below to cache compiled templates
    // 'cache' => __DIR__.'/../cache',
));


$stmt = $db->query("SELECT name,street,postcode,city,vat FROM company_details");

while ($row = $stmt->fetch())
{
$company_details = array('name' => $row['name'], 'street' => $row['street'],
                'postcode' => $row['postcode'],'city' => $row['city'],'vat' => $row['vat']);

}
echo $twig->render('index.html', array(
   'company_details' => $company_details
));
