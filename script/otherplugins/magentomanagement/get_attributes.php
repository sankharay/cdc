<?php
set_time_limit(0);
	ini_set('display_errors',1);
	error_reporting(E_ALL);
	require_once('../dbw.php');
	require_once('../urls.php');

	require_once(MAGE_FILE_URL);
Varien_Profiler::enable();
Mage::setIsDeveloperMode(true);


umask(0);
Mage::app('default'); 
	$currentStore = Mage::app()->getStore()->getId();
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
	
	
function toOptionArray()
{
    $attributes = Mage::getModel('catalog/product')->getAttributes();
    $attributeArray = array();
    foreach($attributes as $a){
        foreach ($a->getEntityType()->getAttributeCodes() as $attributeName) {
            $attributeArray[$attributeName] = $attributeName;
			echo $attributeName;
			$attid = insert_attributes($attributeName);
			$options = getattributesub($attributeName);
print_r($options);
if($options != FALSE)
{
echo $getsize = sizeof($options);
for($i=0;$i< $getsize ; $i++)
{
print_r($options[$i]);
$label = $options[$i]['label'];
$value = $options[$i]['value'];
echo "INSERT INTO `attribute_types_sub` (`id`, `attributeid`, `name`, `value`, `status`, `dateandtime`) VALUES (NULL, '$attid', '$label', '$value', '1', CURRENT_TIMESTAMP)";
$data = mysql_query("INSERT INTO `attribute_types_sub` (`id`, `attributeid`, `name`, `value`, `status`, `dateandtime`) VALUES (NULL, '$attid', '$label', '$value', '1', CURRENT_TIMESTAMP)");
}
}
			echo "<br><br><br><br><br><br><br><br><br>";
        }
         break;         
    }
    return $attributeArray; 
}


echo "<pre>";
print_r(toOptionArray(1));
echo "</pre>";

function insert_attributes($attributeName)
{
// echo $attributeName."<br>";
$data = mysql_query("INSERT INTO `attribute_types` (`id`, `categoryid`, `attributename`, `section_scope`, `status`, `dateandtime`) VALUES (NULL, '1', '$attributeName', '1', '1', CURRENT_TIMESTAMP)");
return mysql_insert_id();
}


function getattributesub($attributename)
{
$attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', "$attributename");
if ($attribute->usesSource()) {
    $options = $attribute->getSource()->getAllOptions(false);
}
else
{
$options = FALSE;
}
return $options;
}


	?>