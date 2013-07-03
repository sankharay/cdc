<?php
header('Content-type: text/html; charset=UTF-8');
include("../otherplugins/dbw.php");
include("functions.php");
$productid = $_GET['fpl_id'];
$productdetails = get_product_details_spanish($productid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" lang="da">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<meta content="utf-8" http-equiv="encoding">
<title>Spanish Content</title>
<link href="css/template.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$(function() {
$( "#tabs" ).tabs();
});
</script>
</head>

<body>
<div class="main-header">
<img src="images/top-header.jpg" /> </div>
<div class="maincontainer">
<div class="left">
<?php $images = get_product_spanish_images($_GET['fpl_id']);
$image = 1;
$otherimg = array();
$otherimgresize = array();
while($imagesrow = mysql_fetch_object($images))
{
	if($image ==1 )
	{
	if($imagesrow->fileplacement == 1 OR $imagesrow->fileplacement == 0)
	{
	?>
<img src="../otherplugins/cropping/images/<?php echo $imagesrow->img_name; ?>" class="mainimg" />
    <?php
	}
	else
	{
		?>
<img src="../otherplugins/cropping/resize/<?php echo $imagesrow->img_name; ?>" class="mainimg" />
	<?php	
	}
	}
	$image = 2;
	$otherimg[] = $imagesrow->img_name;
	$otherimgresize[] = $imagesrow->fileplacement;
}

?>

<div class="smallimages" align="center">
<?php $numimg = sizeof($otherimg);
for($i=0;$i<$numimg;$i++)
{
if($otherimgresize[$i] == 1 OR $otherimgresize[$i] == 0)
{
 ?>
<img src="../otherplugins/cropping/images/<?php echo $otherimg[$i]; ?>" width="65" height="65" />
<?php
}
else
{
?>
<img src="../otherplugins/cropping/resize/<?php echo $otherimg[$i]; ?>"  width="65" height="65" />
<?php
	
}
	?>
<?php
}
?>
</div>
</div>
<div class="right">
<h1 class="product-name"><?php echo $productdetails->prduct_name; ?></h1>
<div class="ratingreview">
<div class="rating"><a href="#">Be the first to review this product</a></div>
</div>
<!-- sku starts -->
<h4 class="product-sku">Sku : <?php echo $productdetails->product_sku; ?></h4>
<!-- sku ends -->
<!-- price starts -->
<div class="price-box">
<span id="product-price-7027" class="regular-price">
<span class="price">$<?php echo $productdetails->product_msrp; ?></span></span><br>
<span class="credit-payment"><span class="price-or">As low as</span><span class="credit-price">$45</span>/mo<span class="credit-payment-withcc"> with Curacao Credit</span></span>
</div>
<!-- price ends -->
<!-- shipping free starts -->
<div class="shipping-free">
<img src="images/shippingfree.jpg" width="192" height="18" />
<br /><br />
<img src="images/colors.jpg" width="433" height="83" /><br />
<img src="images/warranty.jpg" width="589" height="130" /><br />
<img src="images/addtocart.jpg" /></div>
<!-- shipping free ends -->
<div class="clr"></div>
</div>
<div class="clr"></div>
<!-- tabs starts -->
<div id="tabs">
<ul>
<li><a href="#tabs-1">Details</a></li>
<li><a href="#tabs-2">Videos</a></li>
<li><a href="#tabs-3">Reviews</a></li>
</ul>
<div id="tabs-1">
      <?php 
	  
echo $htmlcontent = htmlspecialchars_decode((htmlspecialchars($productdetails->product_description)));
 ?><br /><?php $datad = "&lt;ul&gt;&lt;li&gt; Bloqueo de la tapa flip-top con 1 mano Push Button &lt;/li&gt;&lt;li&gt; Operación patentado Thermos &lt;/li&gt;&lt;li&gt; Aislamiento al vacío para una máxima &lt;/li&gt;&lt;li&gt; Retención Temperatura Unbreakable &lt;/li&gt;&lt;li&gt; Acero inoxidable Interior y exterior abatible &lt;/li&gt;&lt;li&gt; Llevar Loop silicona Soft Touch &lt;/li&gt;&lt;li&gt; Grip ergonómico diseño a prueba de fugas de acero&amp;nbsp;&amp;nbsp;&amp;nbsp; &lt;br&gt;&lt;/li&gt;&lt;/ul&gt;";
 echo htmlspecialchars_decode($datad);
  ?>
      <?php
	  echo htmlentities($productdetails->product_specs);
	   echo htmlspecialchars_decode($productdetails->product_specs);
	  // echo htmlentities($productdetails->product_specs, ENT_QUOTES, "UTF-8");
?><br /><br />
      <div style="font-size:10px; color:#999;"><?php
$dis = fisclaimer(1);
echo htmlspecialchars_decode($dis->spanish); ?></div>
</div>
<div id="tabs-2">
<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis.</p>
</div>
<div id="tabs-3">
<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti.</p>
<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna.</p>
</div>
</div>
<!-- tabs ends -->
</div>
<div class="bottom-padding"></div>
</body>
</html>
