<?php
/**
 */
?>
 <div>
	<label><?php echo ossn_print('GoogleSheetsBilling:entertext'); ?></label>
	<input type="text" name="sheetsEditURL" placeholder="Sheets Edit URL" value="<?php $component = new OssnComponents; $settings = $component->getSettings('GoogleSheetsBilling'); echo $settings->sheetsEditURL;?>" />
	<input type="text" name="sheetsURL" placeholder="Sheets URL not including API Key" value="<?php $component = new OssnComponents; $settings = $component->getSettings('GoogleSheetsBilling'); echo $settings->sheetsURL;?>" />
	<input type="text" name="apiKey" placeholder="API Key Only" value="<?php $component = new OssnComponents; $settings = $component->getSettings('GoogleSheetsBilling'); echo $settings->apiKey;?>" />
 </div>
 <div>
<input type="submit" class="ossn-admin-button button-dark-blue" value="<?php echo ossn_print('save'); ?>"/>
