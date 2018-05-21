<?php
//Creates exploded list of part components for adding to shopping cart. Also has links to add components and open/add DXF file
require 'vendor/autoload.php';
require 'db_connect.php';

$loader = new Twig_Loader_Filesystem('templates/');
$twig = new Twig_Environment($loader, array(

));

if(isset($_GET['id'])){
    $id = $_GET['id']; }
else {
    $id = null;}
$dxf_exists = false;
$i = 0;
$parts = array();
$full_id = ' ';


$polttokuva = sprintf("./dxfs/%s.dxf",$id);
if (file_exists($polttokuva)){
    $dxf_exists = true; }

$stmt = $db->prepare("SELECT ct.description AS part_desc,s_name,cd_description AS order_code,cd_code,cd_baseunit,cd_unit,supplier_id,cd_key_id,cd_price,cl.key_id FROM component_list cl
inner join component_types ct on cl.comp_type = ct.key_id
inner join suppliers s on cl.supplier_id = s.id
inner join component_details cd on cl.code_id = cd.cd_key_id
WHERE cl.full_id = ?");
$stmt->execute([$id]);


$i = 1;
while ($row = $stmt->fetch())   //Vietava FORM
{
    $parts[] =  array('part_desc' => $row['part_desc'], 'order_code' => $row['order_code'],
                      'code' => $row['cd_code'], 'name' => $row['s_name'], 'lot' => $row['cd_baseunit'],
                      'unit' => $row['cd_unit'], 'supplier_id' => $row['supplier_id'], 'id' => $row['cd_key_id'],
                      'price' => $row['cd_price'], 'key' => $row['key_id'],'i' => $i);
    $i = $i + 1;

}
echo $twig->render('exploded_list.html', array(
    'parts' => $parts,
    'id' => $id,
    'dxf_exists' => $dxf_exists
));
?>
