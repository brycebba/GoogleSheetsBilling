<?php
/*
 */
$sheetsEditURL = input('sheetsEditURL');
$sheetsURL = input('sheetsURL');
$apiKey = input('apiKey');

$component = new OssnComponents;

$vars = array('sheetsEditURL' => $sheetsEditURL, 'sheetsURL' => $sheetsURL, 'apiKey' => $apiKey);

if($component->setSettings('GoogleSheetsBilling', $vars)){
	ossn_trigger_message(ossn_print('googlesheetsbilling:saved'));
	redirect(REF);
} else {
	ossn_trigger_message(ossn_print('googlesheetsbilling:save:error'), 'error');
	redirect(REF);
}
