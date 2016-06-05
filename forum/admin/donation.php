<?php

define('IN_PHPBB', 1);

$phpbb_root_path = '../';
require($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_admin.' . $phpEx);

// Start session management
$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);
// End session management

if ( empty($no_page_header) )
{
	// Not including the pageheader can be neccesarry if META tags are
	// needed in the calling script.
	include('./page_header_admin.'.$phpEx);
}

$template->set_filenames(array(
	'body' => 'admin/donation.tpl')
);

$template->assign_vars(array(
	'L_DONATION_E' => $lang['Donation_e'])
);

$template->pparse('body');

include('page_footer_admin.'.$phpEx);

?>