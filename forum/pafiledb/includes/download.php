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

if ( isset($HTTP_GET_VARS['id']) || isset($HTTP_POST_VARS['id']) )
{
	$id = ( isset($HTTP_GET_VARS['id']) ) ? intval($HTTP_GET_VARS['id']) : intval($HTTP_POST_VARS['id']);
}

if ( !$userdata['session_logged_in'] )
{
	$message = $lang['login_require'] . '<br /><br />' . sprintf($lang['login_require_register'], '<a href="' . append_sid("profile.$phpEx?mode=register") . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
}

$sql = "SELECT * FROM " . PA_FILES_TABLE . " WHERE file_id = '" . $id . "'";

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldnt select download', '', __LINE__, __FILE__, $sql);
}

$file = $db->sql_fetchrow($result);

$sql = "UPDATE " . PA_FILES_TABLE . " SET file_dls=file_dls+1, file_last=" . CR_TIME . " WHERE file_id = '" . $id . "'";

if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldnt Update Files table', '', __LINE__, __FILE__, $sql);
}

if ($config['directly_linked'])
{
	$url = $board_config['server_name'];
	if (!preg_match('/'.preg_quote($url,'/').'/i',$_SERVER['HTTP_REFERER']))
	{
		$template->assign_vars(array(
			"META" => '<meta http-equiv="refresh" content="3;url=' . append_sid("dload.php?action=file&amp;id=" . $id) . '">')
		);
		$message = $lang['Directly_linked'];
		message_die(GENERAL_MESSAGE, $message);
	}
}
header("Location: " . $file['file_dlurl']);

?>