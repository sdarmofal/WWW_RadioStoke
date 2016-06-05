<?php
/*
  paFileDB 3.0
  ©2001/2002 PHP Arena
  Written by Todd
  todd@phparena.net
  http://www.phparena.net
  Keep all copyright links on the script visible
  Please read the license included with this script for more information.
*/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

$template->set_filenames(array(
	'email_output' => 'pa_email_body.tpl')
);

if ( isset($HTTP_GET_VARS['id']) || isset($HTTP_POST_VARS['id']) )
{
	$id = ( isset($HTTP_GET_VARS['id']) ) ? intval($HTTP_GET_VARS['id']) : intval($HTTP_POST_VARS['id']);
}

$f = $id;

if ( isset($HTTP_GET_VARS['act']) || isset($HTTP_POST_VARS['act']) )
{
	$act = ( isset($HTTP_GET_VARS['act']) ) ? $HTTP_GET_VARS['act'] : $HTTP_POST_VARS['act'];
}

if ($act == 'send')
{

	if ( !$userdata['session_logged_in'] )
	{
		$message = $lang['login_require'] . '<br /><br />' . sprintf($lang['login_require_register'], '<a href="' . append_sid("profile.$phpEx?mode=register") . '">', '</a>');
		message_die(GENERAL_MESSAGE, $message);
	}

	$error = FALSE;

	if ( !empty($HTTP_POST_VARS['femail']) )
	{
		$user_email = trim(stripslashes($HTTP_POST_VARS['femail']));
	}
	else
	{
		$error = TRUE;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Email_invalid'] : $lang['Email_invalid'];
	}

	$username = trim(stripslashes($HTTP_POST_VARS['fname']));
	$sender_name = trim(stripslashes($HTTP_POST_VARS['sname']));
	$sender_email = trim(stripslashes($HTTP_POST_VARS['semail']));
  
	if ( !empty($HTTP_POST_VARS['subject']) )
	{
		$subject = trim(stripslashes($HTTP_POST_VARS['subject']));
	}
	else
	{
		$error = TRUE;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Empty_subject_email'] : $lang['Empty_subject_email'];
	}

	if ( !empty($HTTP_POST_VARS['message']) )
	{
		$message = trim(stripslashes($HTTP_POST_VARS['message']));
	}
	else
	{
		$error = TRUE;
		$error_msg = ( !empty($error_msg) ) ? $error_msg . '<br />' . $lang['Empty_message_email'] : $lang['Empty_message_email'];
	}

	if ( !$error )
	{
		global $client_ip;
		include($phpbb_root_path . 'includes/emailer.'.$phpEx);
		$emailer = new emailer($board_config['smtp_delivery']);

		$emailer->from($board_config['email_from']);
		$emailer->replyto($sender_email);

		$emailer->use_template('profile_send_email', $user_lang);
		$emailer->email_address($user_email);
		$emailer->set_subject($subject);
		$emailer->extra_headers("X-AntiAbuse: User IP - " . $client_ip . ((isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? ' by ' . $_SERVER['HTTP_X_FORWARDED_FOR'] : ''));

		$emailer->assign_vars(array(
			'SITENAME' => $board_config['sitename'], 
			'BOARD_EMAIL' => $board_config['board_email'], 
			'FROM_USERNAME' => $userdata['username'],
			'TO_USERNAME' => $username, 
			'MESSAGE' => $message)
		);

		$emailer->send();
		$emailer->reset();

		$template->assign_vars(array(
			'META' => '<meta http-equiv="refresh" content="5;url=' . append_sid("dload.php?action=file&amp;id=$f") . '">')
		);

		$message = $lang['Econf'] . "<br /><br />" . sprintf($lang['Click_return'], "<a href=\"" . append_sid("dload.php?action=file&amp;id=$f") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_forum'], "<a href=\"" . append_sid("index.$phpEx") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);
	}

	if ( $error )
	{
		$message = $error_msg . "<br /><br />" . sprintf($lang['Click_return'], "<a href=\"" . append_sid("dload.php?action=email&amp;id=$f") . "\">", "</a>");

		message_die(GENERAL_MESSAGE, $message);  
	}

}

$sql = "SELECT * FROM " . PA_FILES_TABLE . " WHERE file_id = '" . $f . "'";

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldnt Query file info', '', __LINE__, __FILE__, $sql);
}

$file = $db->sql_fetchrow($result);

$sql = "SELECT * FROM " . PA_CATEGORY_TABLE . " WHERE cat_id = '" . $file['file_catid'] . "'";

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldnt Query category info for this file', '', __LINE__, __FILE__, $sql);
}

$category = $db->sql_fetchrow($result);
if ($category['cat_parent'] == 0) 
{
	$locbar = '<span class="nav"><a href="' . append_sid("index.$phpEx") . '" class="nav">' . $board_config['sitename'] . '</a> &raquo; <a href="dload.php" class="nav">Download</a> &raquo; <a href="dload.php?action=category&amp;id=' . $file['file_catid'] . '" class="nav">' . $category['cat_name'] . '</a> &raquo; <a href="dload.php?action=file&amp;id=' . $f . '" class="nav">' . $file['file_name'] . '</a> &raquo; ' . $lang['Emailfile'] . '</span>';
}
if ($category['cat_parent'] > 0) 
{
	$sql = "SELECT * FROM " . PA_CATEGORY_TABLE . " WHERE cat_id = '" . $category['cat_parent'] . "'";

	if ( !($result = $db->sql_query($sql)) )
    {
    	message_die(GENERAL_ERROR, 'Couldnt Query parent category info for this file', '', __LINE__, __FILE__, $sql);
    }

	$parent = $db->sql_fetchrow($result);

	$locbar = '<span class="nav"><a href="' . append_sid("index.$phpEx") . '" class="nav">' . $board_config['sitename'] . '</a> &raquo; <a href="' . append_sid("dload.php?action=category&amp;id=" . $parent['cat_id']) . '" class="nav">' . $parent['cat_name'] . '</a> &raquo; <a href="' . append_sid("dload.php?action=category&amp;id=" . $category['cat_id']) . '" class="nav">' . $category['cat_name'] . '</a> &raquo; <a href="' . append_sid("dload.php?action=file&amp;id=" . $f) . '" class="nav">' . $file['file_name'] . '</a> &raquo; ' . $lang['Emailfile'] . '</span>';
}

$template->assign_vars(array(
	'LOCBAR' => locbar($locbar))
);

if (empty($act)) 
{
	$template->assign_block_vars("email", array());

 	$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
	$server_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['server_name']));
	$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) : '';
	$script_name = preg_replace('#^\/?(.*?)\/?$#', '\1', trim($board_config['script_path']));

	$template->assign_vars(array(
		'S_EMAIL_ACTION' => append_sid("dload.php"),
		'L_EMAIL' => $lang['Emailfile'],
		'L_EMAILINFO' => $lang['Emailinfo'],
		'L_YNAME' => $lang['Yname'],
		'L_YEMAIL' => $lang['Yemail'],
		'L_FNAME' => $lang['Fname'],
		'FILE_NAME' => $file['file_name'],
		'L_FEMAIL' => $lang['Femail'],
		'L_ETEXT' => $lang['Etext'],
		'L_DEFAULTMAIL' => $lang['Defaultmail'],
		'URL' => $server_protocol . $server_name . $server_port . $script_name . $PHP_SELF,
		'ID' => $id,
		'L_SEMAIL' => $lang['Semail'],
		'L_ESUB' => $lang['Esub']) 
	);
}

$template->assign_var_from_handle("ACTION_INCLUDE", "email_output");

?>