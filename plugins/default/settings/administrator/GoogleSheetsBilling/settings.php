<?php
/**
 */
echo ossn_view_form('settings', array(
    'action' => ossn_site_url() . 'action/googlesheetsbilling/settings',
    'component' => 'GoogleSheetsBilling',
    'params' => $params,
), false);
?>
