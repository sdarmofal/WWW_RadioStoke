<?php
define('IN_PHPBB', true);
define('IN_DOWNLOAD', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_DOWNLOAD);
init_userprefs($userdata);
//
// End session management
//

if ( $board_config['login_require'] && !$userdata['session_logged_in'] )
{
	$message = $lang['login_require'] . '<br /><br />' . sprintf($lang['login_require_register'], '<a href="' . append_sid("profile.$phpEx?mode=register") . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
}

require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_pafiledb.' . $phpEx);

//
// Lets build a page ...
//
$page_title = $lang['Download'];
$template->set_filenames(array(
	'body' => 'pafiledb.tpl')
);

make_jumpbox('viewforum.'.$phpEx, $forum_id); 

$template->assign_vars(array(
	'S_TIMEZONE' => sprintf($lang['All_times'], $lang[number_format($board_config['board_timezone'])]))
);


include($phpbb_root_path . 'pafiledb/pafiledb.'.$phpEx);
include($phpbb_root_path . 'includes/page_header.'.$phpEx);
$template->pparse('body');
include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>