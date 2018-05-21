<?php
//Function used to open DXF file from server and create PDF of it

if(isset($_GET['id'])){
$id = $_GET['id']; }
else {
$id = null;}

if(isset($_GET['mode'])){
$mode = $_GET['mode']; }
else {
$mode = null;          
}

if($mode ==1){
lisaa_dxf($id,0,$mode);}


function add_dxf($id,$pdf,$mode){
$file = fopen("./dxfs/".$id.".dxf",'r') ;
$rivi[] = array();
$line_start[] = array();
$arc_start[] = array();
$line_handle[] = array();
$line_x1[] = array();
$line_y1[] = array();
$line_x2[] =array();
$line_y2[] = array();
$arc_x_cen[] = array();
$arc_y_cen[] = array();
$arc_rad[] = array();
$arc_s_angle[] = array();
$arc_e_angle[] = array();
$arc_mirrored[] = array();
$circle_mirrored = array();
$circle_x_cen[] = array();
$circle_y_cen[] = array();
$circle_rad[] = array();
$text_x_start[] = array();
$text_y_start[] = array();
$text_height[] = array();
$text[] = array();
$mtext_x_start[] = array();
$mtext_y_start[] = array();
$mtext_height[] = array();
$mtext_draw_dir[] = array();
$mtext_attach_point[] = array();
$mtext[] = array();
$extmin = 0;
$extmax = 0;
$x_min = 0.0;
$y_min = 0.0;
$i = 0;
$k = 0;
$l = 0;
$m = 0;
$n = 0;
$o = 0;
$p = 0;



while(!feof($file))
  {
  $rivi[$i] =  fgets($file); 
  
  if(!strcmp(trim($rivi[$i]),'ENTITIES')){
  $entities_start[$o]= $i;
  //echo "teksti:".$entities_start[$o]."<br>";
  $o++;
  }
  else if(!strcmp(trim($rivi[$i]),'$EXTMIN'))
  {
  $extmin = $i;
  //echo "extmin:".$extmin."<br>";
  }
  else if(!strcmp(trim($rivi[$i]),'$EXTMAX'))
  {
  $extmax = $i;
  //echo "extmax:".$extmax."<br>";
  }
  
  if($o > 0){
  if(!strcmp(trim($rivi[$i]),'LINE')){
  $line_start[$k] = $i;
  //echo $line_start[$k]." ".$rivi[$i]."<br>";
  $k++;} 
  else if(!strcmp(trim($rivi[$i]),'ARC')){
  $arc_start[$l] = $i;
  $l++;}
  else if(!strcmp(trim($rivi[$i]),'CIRCLE')){
  //echo "circle".$i."<br>";
  $circle_start[$m] = $i; 
  $m++;}
  else if(!strcmp(trim($rivi[$i]),'TEXT')){
  $text_start[$n]= $i;
  //echo "teksti:".$text_start[$n]."<br>";
  $n++;
  }
  else if(!strcmp(trim($rivi[$i]),'MTEXT')){
  $mtext_start[$p]= $i;
  //echo "teksti:".$mtext_start[$p]." ".$p."<br>";
  $p++;
 }
}
  
$i = $i+1;

 } 
  
fclose($file); 

 

$k_max = $k;
$l_max= $l;
$m_max = $m;
$n_max= $n;
$o_max = $o;
$p_max = $p;          

// Kaivele viivat ulos
for($k=0;$k < $k_max;$k++){

$i = $line_start[$k];
$empty = chr(20);
do
{
  //echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'10'));
  //echo "x-start:".$rivi[$i]."<br>";
  $line_x1[$k] = floatval($rivi[$i]);
  //echo ord($y1)."<br>";
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'20'));
  //echo "y-start:".$rivi[$i]."<br>";
  $line_y1[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'11'));
  //echo "x-end:".$rivi[$i]."<br>";
  $line_x2[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'21'));
  //echo "y-end:".$rivi[$i]."<br>";
  $line_y2[$k] = floatval($rivi[$i]);
  $i++;
}

// Kaivele kaaret ulos
for($k=0;$k < $l_max;$k++){

$i = $arc_start[$k];
do
{
  //echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'10'));
  //echo $i." arc_x_center:".$rivi[$i]."<bl>";
  $arc_x_cen[$k] = floatval($rivi[$i]);
  $i++;
do
{
  // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'20'));
  //echo "arc_y_center:".$rivi[$i]."<bl>";
  $arc_y_cen[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'40'));
  //echo "Arc_rad:".$rivi[$i]."<br>";
  $arc_rad[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  if(!strcmp(trim($y1), '50')){
	break;
	}
  $i++;
}
  while(strcmp(trim($y1),'230'));
  if(floatval($rivi[$i]) < 0){
	$arc_mirrored[$k] = true;}
  else{	
	$arc_mirrored[$k] = false;} 


do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  $i++;
}
  while(strcmp(trim($y1),'50'));
  //echo "Arc_start_angle:".$rivi[$i]."<br>";
  $arc_s_angle[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = floatval($rivi[$i]);
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'51'));
  //echo "Arc_end_angle:".$rivi[$i]."<br>";
  $arc_e_angle[$k] = floatval($rivi[$i]);
  $i++;
}

 


// Kaivele ympylat ulos
for($k=0;$k < $m_max;$k++){

$i = $circle_start[$k];
do
{
  //echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'10'));
  //echo "circle_x_center:".$rivi[$i]."<br>";
  $circle_x_cen[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'20'));
  //echo "circle_y_center:".$rivi[$i]."<br>";
  $circle_y_cen[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'40'));
  //echo "Circle_rad:".$rivi[$i]."<br>";
  $circle_rad[$k] = floatval($rivi[$i]);
  $i++;


do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  if(!strcmp(trim($y1), '0')){
	break;
	}
   //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'230'));
  if(floatval($rivi[$i]) < 0){
	$circle_mirrored[$k] = true;
  	}
  else{	
	$circle_mirrored[$k] = false;
	}
}



// Kaivele tekstit ulos
for($k=0;$k < $n_max;$k++){
//echo "teksteja<br>";

$i = $text_start[$k];
do
{
  //echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'10'));
  //echo "x-start_text:".$rivi[$i]."<br>";
  $text_x_start[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'20'));
  //echo "text_y-start:".$rivi[$i]."<br>";
  $text_y_start[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
 // echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'40'));
  //echo "text_height:".$rivi[$i]."<br>";
  $text_height[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'1'));
  //echo "text_itself:".$rivi[$i]."<br>";
  $text[$k] = trim($rivi[$i]);
  $i++;  
}

// Kaivele Mtekstit ulos
for($k=0;$k < $p_max;$k++){
//echo "teksteja<br>";

$i = $mtext_start[$k];
do
{
  //echo $rivi[$i]."<br>";
  $y1 = $rivi[$i]; 
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'10'));
  //echo "x-start_text:".$rivi[$i]."<br>";
  $mtext_x_start[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'20'));
  //echo "text_y-start:".$rivi[$i]."<br>";
  $mtext_y_start[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
 // echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'40'));
  //echo "text_height:".$rivi[$i]."<br>";
  $mtext_height[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  // echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'71'));
  $mtext_attach_point[$k] = floatval($rivi[$i]);
  $i++;
do
{
  //echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'72'));
  //echo "text_height:".$rivi[$i]."<br>";
  $mtext_draw_dir[$k] = floatval($rivi[$i]);
  $i++;
do
{
 // echo $rivi[$i]."<br>";
  $y1 = $rivi[$i];
  //echo $y1."<br>";
  $i++;
}
  while(strcmp(trim($y1),'1'));
  //echo "text_itself:".$rivi[$i]."<br>";
  $mtext[$k] = trim($rivi[$i]);
  $i++;  
}




//echo $extmin;


$width = floatval($rivi[$extmax+2]) - floatval($rivi[$extmin+2]) +5;
$height =  floatval($rivi[$extmax+4]) - floatval($rivi[$extmin+4]) +5;
$x_center = floatval($rivi[$extmin+2]) + $width/2;
$y_center = floatval($rivi[$extmin+4]) + $height/2;
$x_min = floatval($rivi[$extmin+2])-4;
$y_min = floatval($rivi[$extmin+4])-2;
$scale_x = 210 / $width;
$scale_y = 470 / $height;

if ($width < 298){
$scale = 1;
}
else {
$scale = 290 / $width;
}
if ($height * $scale > 210){
$scale = 170 / $height;
}   


if($mode == 1){
require('FPDF/sectors.php');
define('FPDF_FONTPATH', 'FPDF/font/');
$pdf=new PDF_Sector(); }
$pdf->AddPage('L','A4');
$pdf->SetFillColor(120, 120, 255);
$pdf->SetXY(220,170);
$pdf->Setfont('Arial', 'B',18);
$pdf->Cell(40,15,'ID:'.$id,0);
if($x_min < 0){
$x_min = ($x_min + 1);
}
else{
$x_min = round(abs($x_min) + 1);
}

if($y_min < 0){
$y_min = ($y_min + 1);
}
else{
$y_min = round(abs($y_min) + 1);
}

for ($i=0; $i < $k_max;$i++){     
$pdf->Line(($line_x1[$i] - $x_min)*$scale, ($line_y1[$i]-$y_min)*$scale, ($line_x2[$i]-$x_min)*$scale, ($line_y2[$i]-$y_min)*$scale);
} 
for ($i=0; $i < $l_max;$i++){
if(!$arc_mirrored[$i]){
$pdf->Sector(($arc_x_cen[$i]-$x_min)*$scale, ($arc_y_cen[$i]-$y_min)*$scale, $arc_rad[$i]*$scale, $arc_s_angle[$i], $arc_e_angle[$i],'D',true,0);}
else{
$pdf->Sector((abs($arc_x_cen[$i])-$x_min)*$scale, ($arc_y_cen[$i]-$y_min)*$scale, $arc_rad[$i]*$scale, $arc_s_angle[$i], $arc_e_angle[$i],'D',false,180);}
}
for ($i=0; $i < $m_max;$i++){
if(!$circle_mirrored[$i]){
$pdf->Sector(($circle_x_cen[$i]-$x_min)*$scale, ($circle_y_cen[$i]-$y_min)*$scale, ($circle_rad[$i]*$scale), 0, 360,'D');}
//imagearc($img,  $circle_x_cen[$i]-$x_min,$circle_y_cen[$i]-$y_min, ($circle_rad[$i]*2),($circle_rad[$i]*2),0,360, $black);
else{
$pdf->Sector((abs($circle_x_cen[$i])-$x_min)*$scale, ($circle_y_cen[$i]-$y_min)*$scale, ($circle_rad[$i]*$scale), 0, 360,'D');}
}
//$pdf->SetXY(0,0);
//$pdf->Setfont('Arial', 'B',12);
//$pdf->Cell(30,15,'0,0',0);

for ($i=0; $i < $n_max;$i++){
$startX=($text_x_start[$i]-$x_min)*$scale;
$startY=($text_y_start[$i]-$y_min)*$scale;
//echo $startX;
$pdf->SetXY($startX,$startY);
$pdf->Setfont('Arial', 'B',12);
$pdf->Cell(30,15,$text[$i],0);
//imagestring($img, 4, $text_x_start[$i]-$x_min,$text_y_start[$i]-$y_min,$text[$i], $black);
} 
for ($i=0; $i < $p_max;$i++){
$startX=($mtext_x_start[$i]-$x_min)*$scale;
$startY=($mtext_y_start[$i]-$y_min)*$scale;
//echo $startX." Y: ".$startY."<br>";
$pdf->SetXY($startX,$startY);
$pdf->Setfont('Arial', 'B',12);
$pdf->Cell(30,15,$mtext[$i],0);
//imagestring($img, 4, $text_x_start[$i]-$x_min,$text_y_start[$i]-$y_min,$text[$i], $black);
} 


if($mode ==1){
$ip = $_SERVER['REMOTE_ADDR'];
$fname = "tmp/";
$fname .= $ip;
$fname = str_replace('.','',$fname);
//$fname = str_replace('/','',$fname);
$fname .= "dxf.pdf";    
//$filename = sprintf('tmp/%s.pdf',$id);
$pdf->Output('I',$fname);}
//header("Location: ".$fname);}
}
?> 
