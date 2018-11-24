<?php
/**
 */
echo ossn_view_form('administrator/settings', array(
    'action' => ossn_site_url() . 'action/googlesheetsbilling/administrator/settings',
    'component' => 'GoogleSheetsBilling',
    'params' => $params,
), false);
?>
