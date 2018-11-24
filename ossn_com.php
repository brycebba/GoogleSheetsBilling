<?php
/**
 * @package   Google Sheets Billing
 * @author    balfred
 */
define('__BILLING__', ossn_route()->com . 'GoogleSheetsBilling/');
/**
 * Initialize component
 * @return void
 */
function billing_user() {
	ossn_profile_subpage('billing');	
	ossn_register_callback('page', 'load:profile', 'profile_billing_user');
	ossn_add_hook('profile', 'subpage', 'profile_billing_user_page');
	ossn_register_com_panel('GoogleSheetsBilling', 'settings');
	if (ossn_isAdminLoggedin()) {
        ossn_register_action('googlesheetsbilling/settings', __BILLING__ . 'actions/GoogleSheetsBilling/administrator/settings.php');
	}
}

/**
 * @return void
 */
function profile_billing_user() {
	$owner = ossn_user_by_guid(ossn_get_page_owner_guid());
	$url   = ossn_site_url();

	if(ossn_isLoggedin()) {
		ossn_register_menu_link('googlesheetsbillinguser', 'Billing', $owner->profileURL('/billing'), 'user_timeline');
	}
}

/**
 * @return string
 */
function profile_billing_user_page($hook, $type, $return, $params) {
	$page = $params['subpage'];
	if($page == 'billing') {
		$content = ossn_plugin_view('profile/billing', $params);
		echo ossn_set_page_layout('module', array(
			'title' => ossn_print('Billing'),
			'content' => $content
		));
	}
}

/**
 * billing_user_balance
 * summary = Call the google sheets API and get a JSON object back of accounts
 *           and their balances to report to thr front end the balance of the 
 *           logged in user.
 * param $last = last_name of logged in user
 * param $first = first_name of logged in user
 * returns $balance = balance for that user from API call
*/
function billing_user_balance($last = '', $first = '') {
	// initialize working variables
	$balance = '*ERROR* Contact Admin'; // PUT WHATEVER ERROR YOU WANT HERE
	try {
		$ch = curl_init();
	
		// Check if initialization had gone wrong*    
		if ($ch === false) {
			throw new Exception('failed to initialize');
		}
	
		curl_setopt($ch, CURLOPT_URL, 'https://sheets.googleapis.com/v4/spreadsheets/1bH6LmIsDQQdd1Beiq1s9fI-SuYRoGYmBc-_IYrpux_g/values/A1:B40?key=AIzaSyCGDFEmXaIUpDrgN6hx9Uq8MrtIzPqQAT0');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);	
		$response = curl_exec($ch);
	
		// Check the return value of curl_exec(), too
		if ($response === false || $response == 1) {
			throw new Exception(curl_error($ch), curl_errno($ch));
		}
		// get JSON object into arrays that we can work with
		$accounts = json_decode($response, true);
		$accounts = $accounts['values'];

		// loop through unnamed arrays to find the array we care about
		// once found, we will set $balance to the balance which is [1]
		foreach($accounts as $account) {
			if (trim($account[0]) == trim($last) . ',' . trim($first)) {
				$balance = $account[1];
			}
		}
		return $balance;	
		
		// Close curl handle
		curl_close($ch);
	} catch(Exception $e) {
	
		return var_dump(sprintf(
					'Curl failed with error #%d: %s',
					$e->getCode(), $e->getMessage()),
					E_USER_ERROR);
	}
}
ossn_register_callback('ossn', 'init', 'billing_user');

