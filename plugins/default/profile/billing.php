<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
 ?>
<table class="billinguser">
  <tr>
    <th scope="row"><?php echo ossn_print('name');?></th>
    <td><?php echo $params['user']->fullname;?></td>
  </tr>
  <tr>
    <th scope="row"><?php echo ossn_print('balanceh');?></th>
    <td>123456.66</td>
  </tr> 
  <tr>
    <th scope="row"><?php echo ossn_print('balance');?></th>
    <td><?php echo billing_user_balance($params['user']->last_name, $params['user']->first_name);?></td>
  </tr>
</table>
