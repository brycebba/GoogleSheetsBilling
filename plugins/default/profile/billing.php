<?php
/**
 * @package   Google Sheets Billing
 * @author    balfred
 */
 ?>
<table class="billinguser">
  <tr>
    <th scope="row"><?php echo ossn_print('name');?></th>
    <td><?php echo $params['user']->fullname;?></td>
  </tr>
  <tr>
    <th scope="row"><?php echo ossn_print('balance');?></th>
    <td><?php echo billing_user_balance($params['user']->last_name, $params['user']->first_name);?></td>
  </tr>
</table>
