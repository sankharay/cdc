<?php
include("../dbw.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
	$targ_w =  500;
	$targ_h = 500;
	$jpeg_quality = 90;

	if($_GET['t'] == 1)
	$src = 'images/'.$_GET['f'];
	else
	$src = 'autoresizeimages/'.$_GET['f'];

	// $src = 'images/'.$_GET['f'];
	$target = "resize/";
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,$_GET['x'],$_GET['y'],
	$targ_w,$targ_h,$_GET['w'],$_GET['h']);

	header('Content-type: image/jpeg');
	imagejpeg($dst_r,$target.$_GET['f'],$jpeg_quality);
}

// If not a POST request, display page below:
$filename = $_GET['f'];
$imageid = $_GET['imgid'];
mysql_query("UPDATE `product_images` SET `fileplacement` = '2' WHERE `img_id` =$imageid");
?>
<strong>Image Cropping DONE</strong>