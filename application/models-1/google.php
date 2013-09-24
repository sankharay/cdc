<?php
class google extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		require_once(PLUGINS_URL.'/apiClient.php');
		require_once(PLUGINS_URL.'/contrib/apiTranslateService.php');
		require_once(PLUGINS_URL.'/LanguageTranslator.php');
    }
	
	function splitdesc($desc){
		
		
 
		$yourApiKey = 'AIzaSyAqfTrkUwYqrULHJudzwC5FjE11fT5REUQ';
	 
		$sourceData = $desc;
		$source = 'en';
	 
		$target = 'es';
	 
		$translator = new LanguageTranslator($yourApiKey);
	 
		$targetData = $translator->translate($sourceData, $target, $source);
		
		echo $targetData;	
		exit;
	}
	
	
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


	function splitstring($str){
		
		$client = new apiClient();
		$client->setApplicationName('Google Translate PHP Starter Application');
		
		// Visit https://code.google.com/apis/console?api=translate to generate your
		// client id, client secret, and to register your redirect uri.
		$client->setDeveloperKey('AIzaSyAqfTrkUwYqrULHJudzwC5FjE11fT5REUQ');
		$service = new apiTranslateService($client);
		$s = preg_split ('/$\R?^/m', $str);
		$v = array();
		for($i=0;$i<sizeof($s);$i++){
			
			$translations = $service->translations->listTranslations($s[$i], 'es');
			
			$v[] = $translations['translations'][0]['translatedText'];
						
			//$v[] = $this->translate(htmlspecialchars_decode($s[$i]));
		}
		
		$string =  implode('<br>',$v);
		
		return $string;

	}


	function processhtml($htmlContent){
		
			
		if(str_replace("<","",str_replace(">","",str_replace("/","",substr(trim($htmlContent),0,5))))=='br'){
			return '';
		}
		$html_tag = substr(trim($htmlContent),1,strpos($htmlContent,'>'));
		
		
		
		$result = '';
//		if(str_replace(">","",$html_tag)=='table'){
		if(substr($html_tag,0,5)=='table'){
		
			$dom = new DOMDocument;
			$dom->loadHTML( $htmlContent );
			$rows = array();
			foreach( $dom->getElementsByTagName( 'tr' ) as $tr ) {
				$cells = array();
				foreach( $tr->getElementsByTagName( 'td' ) as $td ) {
					$cells[] = $td->nodeValue;
				}
				$rows[] = $cells;
			}
		}
			$result .= '<table>';
			for($i=0;$i<sizeof($rows);$i++){
				$result .= '<tr>';
				
				for($j=0;$j<sizeof($rows[$i]);$j++){
					
					$String = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $rows[$i][$j]);
					
					$result .= '<td>'.$this->translate($String).'</td>';
					//exit;
				}
					
				$result .= '</tr>';
			}
			
			$result .= '</table>';
			
			return $result;
	}

}
?>
