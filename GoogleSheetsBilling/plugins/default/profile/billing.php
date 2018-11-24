<?php
/**
 * @package   Google Sheets Billing
 * @author    balfred
 */
 ?>
<table class="googlesheetsbillinguser">
  <tr>
    <th scope="row"><?php echo ossn_print('name');?></th>
    <td><?php echo $params['user']->fullname;?></td>
  </tr>
  <tr <?php if (ossn_isAdminLoggedin()) {echo 'hidden="hidden"';}?>>
    <th scope="row"><?php echo ossn_print('balance');?></th>
    <td><?php echo billing_user_balance($params['user']->last_name, $params['user']->first_name);?></td>
  </tr>
</table>
<div <?php if (ossn_isAdminLoggedin()) {echo 'display="display"';} else {echo 'hidden="hidden"';}?>>
  <iframe src="<?php if (ossn_isAdminLoggedin()) {$component = new OssnComponents; $settings = $component->getSettings('GoogleSheetsBilling'); echo $settings->sheetsEditURL;}?>" style="width: 100%;" onload="this.height=screen.height*0.45;" ></iframe>
</div>
