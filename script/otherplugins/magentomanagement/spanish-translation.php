<?php
	set_time_limit(0);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
include("../urls.php");
include("../dbw.php");
include("Mfunctions.php");
require_once(PLUGINS_URL.'/apiClient.php');
require_once(PLUGINS_URL.'/contrib/apiTranslateService.php');
require_once(PLUGINS_URL.'/LanguageTranslator.php');

function translateplaintext($str){
	
		$client = new apiClient();
		$client->setApplicationName('Google Translate PHP Starter Application');
		
		// Visit https://code.google.com/apis/console?api=translate to generate your
		// client id, client secret, and to register your redirect uri.
		$client->setDeveloperKey('AIzaSyAqfTrkUwYqrULHJudzwC5FjE11fT5REUQ');
		$service = new apiTranslateService($client);
		
		$translations = $service->translations->listTranslations($str, 'es');
		//print "<h1>Translations</h1><pre>" . print_r($translations, true) . "</pre>";
		
		
		return $translations['translations'][0]['translatedText'];
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="INDEX,FOLLOW"/>
<meta http-equiv="Content-Language" content="es"/>
</head>


<body>
<?php

$list = get_html_translation_table(HTML_ENTITIES);
		
		unset($list['"']);
		unset($list['<']);
		unset($list['>']);
		unset($list['&']);
		
		$search = array_keys($list);
		$values = array_values($list);

$scontent = get_mossee_translation_data();
while($content = mysql_fetch_object($scontent))
{
echo $content->SKU;

if($content->Product_Description != NULL)
{
$text = $content->Product_Description;
$description = htmlspecialchars(translateplaintext($text));
$description = str_replace($search, $values, $description);
}
else
$description="";
if($content->Size != "")
{
$size = htmlspecialchars(translateplaintext($content->Size));
$size = str_replace($search, $values, $size);
}
else
{
$size="";
}
if($content->Product_Name != "")
{
$sp_Product_Name = htmlspecialchars(translateplaintext($content->Product_Name));
$sp_Product_Name = str_replace($search, $values, $sp_Product_Name);
}
else
{
$sp_Product_Name="";
}
if($size != "")
{
echo $productspecs = "<ul><li>Talla:".$size."</li><li>Dimensiones:".$content->Dimensions_Height." H&quot; x ".$content->Dimensions_Width." W&quot; x ".$content->Dimensions_Depth." L&quot; </li><li>Peso:".ceil($content->Weight)." Libras</li></ul>";
}
else
{
echo $productspecs = "<ul><li>Dimensiones:".$content->Dimensions_Height." H&quot; x ".$content->Dimensions_Width." W&quot; x ".$content->Dimensions_Depth." L&quot; </li><li>Peso:".ceil($content->Weight)." Libras</li></ul>";
}
$updatespanish = updatespanishdata($sp_Product_Name,$description,$productspecs,$content->SKU);
sleep(3);
}
?>
</body>
</html>