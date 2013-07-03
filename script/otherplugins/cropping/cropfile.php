<?php
include("../dbw.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
	$tw =  $_GET['tw'];
	$th = $_GET['th'];
	$jpeg_quality = 90;
	$x = $_GET['x'];
	$y = $_GET['y'];
	$w = $_GET['w'];
	$h = $_GET['h'];
	if($_GET['t'] == 1)
	{
	$src = 'images/'.$_GET['f'];
	list($width, $height, $type, $attr) = getimagesize($src);
	}
	else
	{
	$src = 'autoresizeimages/'.$_GET['f'];
	list($width, $height, $type, $attr) = getimagesize($src);
	}

	// $src = 'images/'.$_GET['f'];
	$target = "resize/";
	$img_r = imagecreatefromjpeg($src);
	$dst_r = imagecreatetruecolor($tw,$th);

	imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$tw,$th,$w,$h);

	header('Content-type: image/jpeg');
	imagejpeg($dst_r,$target.$_GET['f'],$jpeg_quality);
}
$imagelocation  = $target.$_GET['f'];
$don = fitimage($imagelocation);
// If not a POST request, display page below:
$filename = $_GET['f'];
$imageid = $_GET['imgid'];
mysql_query("UPDATE `product_images` SET `fileplacement` = '2', `imagedone` = '1' WHERE `img_id` =$imageid");
?>

<?php
function fitimage($imagelocation)
{
// Input parametres check
$w = 500;
$h = 500;
$mode = 'fit';
if ($w <= 1 || $w >= 1000) $w = 100;
if ($h <= 1 || $h >= 1000) $h = 100;
 
// Source image
$src = imagecreatefromjpeg($imagelocation);
 
// Destination image with white background
$dst = imagecreatetruecolor($w, $h);
imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255));
 
// All Magic is here
scale_image($imagelocation,$src, $dst, $mode);
 
// Output to the browser
// Header('Content-Type: image/jpeg');
// imagejpeg($dst); 
}

function scale_image($imagelocation,$src_image, $dst_image, $op = 'fit') {
	$jpeg_quality = 90;
    $src_width = imagesx($src_image);
    $src_height = imagesy($src_image);
 
    $dst_width = imagesx($dst_image);
    $dst_height = imagesy($dst_image);
 
    // Try to match destination image by width
    $new_width = $dst_width;
    $new_height = round($new_width*($src_height/$src_width));
    $new_x = 0;
    $new_y = round(($dst_height-$new_height)/2);
 
    // FILL and FIT mode are mutually exclusive
    if ($op =='fill')
        $next = $new_height < $dst_height;
     else
        $next = $new_height > $dst_height;
 
    // If match by width failed and destination image does not fit, try by height 
    if ($next) {
        $new_height = $dst_height;
        $new_width = round($new_height*($src_width/$src_height));
        $new_x = round(($dst_width - $new_width)/2);
        $new_y = 0;
    }
 
    // Copy image on right place
    imagecopyresampled($dst_image, $src_image , $new_x, $new_y, 0, 0, $new_width, $new_height, $src_width, $src_height);
	header('Content-type: image/jpeg');
	imagejpeg($dst_image,$imagelocation,$jpeg_quality);
}

?>
<strong>Image Cropping DONE</strong>