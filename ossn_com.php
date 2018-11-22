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
		
		// ossn_extend_view('css/ossn.default', 'css/billing');
}

/**
 * @return void
 */
function profile_billing_user() {
		$owner = ossn_user_by_guid(ossn_get_page_owner_guid());
		$url   = ossn_site_url();

		if(ossn_isLoggedin()) {
			ossn_register_menu_link('billinguser', 'Billing', $owner->profileURL('/billing'), 'user_timeline');
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
	$balance = '*ERROR* Contact Admin';
	$sheetsURL = 'https://sheets.googleapis.com/v4/spreadsheets/1bH6LmIsDQQdd1Beiq1s9fI-SuYRoGYmBc-_IYrpux_g/basic/A1%3AB40?key=AIzaSyCGDFEmXaIUpDrgN6hx9Uq8MrtIzPqQAT0';
	
	// set up cURL to make our call and return JSON
	$ch = curl_init($sheetsURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
	curl_close($ch);

	// get JSON object into arrays that we can work with
	$accounts = json_decode($response, true);
	$accounts = $accounts['values'];

	// loop through unnamed arrays to find the array we care about
	// once found, we will set $balance to the balance which is [1]
	foreach($accounts as $account) {
		if ($account[0] == trim($last) . ',' . trim($first)) {
			$balance = $account[1];
			break;
		}
	}
    return $balance;
}
ossn_register_callback('ossn', 'init', 'billing_user');

