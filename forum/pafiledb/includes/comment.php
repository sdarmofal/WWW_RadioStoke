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

$cancel = ( isset($HTTP_POST_VARS['cancel']) ) ? TRUE : 0;

$confirm = ( isset($HTTP_POST_VARS['confirm']) ) ? TRUE : 0;

$template->set_filenames(array(
	'comment_output' => 'pa_comment_body.tpl')
);

if ( isset($HTTP_GET_VARS['id']) || isset($HTTP_POST_VARS['id']) )
{
	$id = ( isset($HTTP_GET_VARS['id']) ) ? intval($HTTP_GET_VARS['id']) : intval($HTTP_POST_VARS['id']);
}

if ( isset($HTTP_GET_VARS['cid']) || isset($HTTP_POST_VARS['cid']) )
{
	$cid = ( isset($HTTP_GET_VARS['cid']) ) ? intval($HTTP_GET_VARS['cid']) : intval($HTTP_POST_VARS['cid']);
}

if ( isset($HTTP_GET_VARS['delete']) || isset($HTTP_POST_VARS['delete']) )
{
	$delete = ( isset($HTTP_GET_VARS['delete']) ) ? $HTTP_GET_VARS['delete'] : $HTTP_POST_VARS['delete'];
}

include($phpbb_root_path . 'includes/bbcode.'.$phpEx);

//
// Define censored word matches
//

$orig_word = array();

$replacement_word = array();
$replacement_word_html = array();
obtain_word_list($orig_word, $replacement_word, $replacement_word_html);

if ($cancel)
{
	redirect(append_sid("dload.php?action=file&amp;id=" . $id, true));
}

if ($delete == 'do') 
{
	if( $userdata['user_level'] != ADMIN )
	{
		message_die(GENERAL_MESSAGE, $lang['Not_admin']);
	}
	else
	{

		if ( !$confirm )
		{

			$s_hidden_fields =  '<input type="hidden" name="action" value="file" /><input type="hidden" name="cid" value="' . $cid . '" /><input type="hidden" name="id" value="' . $id . '" /><input type="hidden" name="delete" value="do" />';

			include($phpbb_root_path . 'includes/page_header.'.$phpEx);

			$template->set_filenames(array(
				'confirm_body' => 'confirm_body.tpl')
			);

			$template->assign_vars(array(
				'MESSAGE_TITLE' => $lang['Information'],
				'MESSAGE_TEXT' =>  $lang['Confirm_delete_pm'],

				'L_YES' => $lang['Yes'],
				'L_NO' => $lang['No'],

				'S_CONFIRM_ACTION' => append_sid("dload.$phpEx"),
				'S_HIDDEN_FIELDS' => $s_hidden_fields)
			);

			$template->pparse('confirm_body');

			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}

		if ( $confirm )
		{ 
			$sql = "DELETE FROM " . PA_COMMENTS_TABLE . " WHERE comments_id = " . $cid;

			if ( !($db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Couldnt delete this comment', '', __LINE__, __FILE__, $sql);
			}

			$template->assign_vars(array(
				"META" => '<meta http-equiv="refresh" content="3;url='  .append_sid("dload.php?action=file&amp;id=" . $id) . '">')
			);

			$message = $lang['Comment_deleted'] . "<br /><br />" . sprintf($lang['Click_return'], "<a href=\"" . append_sid("dload.php?action=file&amp;id=" . $id) . "\">", "</a>");

			message_die(GENERAL_MESSAGE, $message);
		}
	}
}

$template->assign_vars(array(
	'L_COMMENTS' => $lang['Comments']) 
);

$sql = "SELECT p.*, u.* FROM (" . PA_COMMENTS_TABLE . " p, " . USERS_TABLE . " u)
	WHERE p.file_id = $id
	AND u.user_id = p.poster_id
	ORDER by p.comments_time ASC";

if ( !($comment = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Couldnt select comments', '', __LINE__, __FILE__, $sql);
}

if (!($comment_number = $db->sql_numrows($comment)))
{
	$template->assign_block_vars("no_comment", array());

	$template->assign_vars(array(
		'L_NO_COMMENTS' => $lang['No_comments']) 
	);
}

while ($r = $db->sql_fetchrow($comment)) 
{
	extract ($r);
      
	$time = create_date($board_config['default_dateformat'], $comments_time, $board_config['board_timezone']);

	if ( !$config['allow_html'] )
	{
		if ( $comments_text != '' && $userdata['user_allowhtml'] )
		{
			$comments_text = comment_suite($comments_text);

			$comments_text = preg_replace('#(<)([\/]?.*?)(>)#is', "&lt;\\2&gt;", $comments_text);
		}
	}

	if ( $config['allow_bbcode'] )
	{
		if ( $comments_text != '' && $comment_bbcode_uid != '' )
		{
			$comments_text = comment_suite($comments_text);

			$comments_text = ( $config['allow_bbcode'] ) ? bbencode_second_pass($comments_text, $comment_bbcode_uid, $userdata['username']) : preg_replace('/\:[0-9a-z\:]+\]/si', ']', $comments_text);
		}
	}

	$comments_text = comment_suite($comments_text);

	$comments_text = make_clickable($comments_text);

   	if ( count($orig_word) )
	{
		if ( $comments_text != '' )
		{
			$comments_text = preg_replace($orig_word, $replacement_word, $comments_text);
		}
	}

	if ( $config['allow_smilies'] && $userdata['show_smiles'] )
	{
		if ( $userdata['user_allowsmile'] && $comments_text != '' )
		{
			$comments_text = smilies_pass($comments_text);
		}
	}

	$colored_username = $colored_username = color_username($user_level, $user_jr, $user_id, $username);

	$poster_color_username = $colored_username[0];
	$username_color = $colored_username[1];

	$poster = ( $user_id == ANONYMOUS ) ? $lang['Guest'] : ($username) ? '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $user_id) . '"' . $username_color . '>' . $poster_color_username . '</a>' : '<i>' . $lang['User_deleted'] . '</i>';

	$poster_posts = ( $user_id != ANONYMOUS ) ? $lang['Posts'] . ': ' . $user_posts : '';

	$poster_from = ( $user_from && $user_id != ANONYMOUS ) ? $lang['Location'] . ': ' . $user_from : '';

	$poster_joined = ( $user_id != ANONYMOUS ) ? $lang['Joined'] . ': ' . create_date($lang['DATE_FORMAT'], $user_regdate, $board_config['board_timezone']) : '';

	$poster_avatar = '';
	if ( $user_avatar_type && $poster_id != ANONYMOUS && $user_allowavatar )
	{
		switch( $user_avatar_type )
		{
			case USER_AVATAR_UPLOAD:
				$poster_avatar = ( $board_config['allow_avatar_upload'] ) ? '<img src="' . $board_config['avatar_path'] . '/' . $user_avatar . '" alt="" border="0" />' : '';
				break;
			case USER_AVATAR_REMOTE:
				$poster_avatar = ( $board_config['allow_avatar_remote'] ) ? '<img src="' . $user_avatar . '" alt="" border="0" />' : '';
				break;
			case USER_AVATAR_GALLERY:
				$poster_avatar = ( $board_config['allow_avatar_local'] ) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $user_avatar . '" alt="" border="0" />' : '';
				break;
		}
	}
 
	//
	// Generate ranks, set them to empty string initially.
	//
	$poster_rank = '';
	$rank_image = '';
	if ( $user_id == ANONYMOUS )
	{
	}
	else if ( $user_rank )
	{
		$user_rank = $user_rank;
		$sql = "SELECT *
			FROM " . RANKS_TABLE . "
			WHERE rank_id = " . $user_rank;
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain user speical rank ', '', __LINE__, __FILE__, $sql);
		}
		if ( $row = $db->sql_fetchrow($result) )
		{
			$poster_rank = $row['rank_title'];
			if ( $poster_rank )
			{
				$poster_rank = $poster_rank . '<br />';
			}
			if ( strstr($poster_rank,'-#') )
			{
				$poster_rank = '';
			}
			$rank_image = ( $row['rank_image'] ) ? '<img src="' . $images['rank_path'] . $row['rank_image'] . '" alt="" border="0" /><br />' : '';
		}
		$db->sql_freeresult($result);
	}
	else
	{
		$sql = "SELECT *
		FROM " . RANKS_TABLE . "
			WHERE rank_special = 0
			ORDER BY rank_min DESC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain ranks information', '', __LINE__, __FILE__, $sql);
		}

		$ranksrow = array();
		while ( $row = $db->sql_fetchrow($result) )
		{
			$ranksrow[$row['rank_group']][] = $row;
			$ranksrow[$row['rank_group']]['count']++;
		}
		$db->sql_freeresult($result);

		$sql = "SELECT ug.group_id
			FROM (" . USER_GROUP_TABLE . " ug, " . GROUPS_TABLE . " g)
			WHERE ug.user_id = " . $user_id . "
				AND g.group_id = ug.group_id
				AND g.group_single_user = 0
				AND ug.user_pending <> 1
			ORDER BY g.group_order ASC";
		if ( !($result = $db->sql_query($sql)) )
		{
			message_die(GENERAL_MESSAGE, 'Can not find username');
		}
		$rank_group_id = 0;
		while ( $row = $db->sql_fetchrow($result) )
		{
			if ( isset($ranksrow[$row['group_id']]) )
			{
				$rank_group_id = $row['group_id'];
				break;
			}
		}
		$db->sql_freeresult($result);

		for($i = 0; $i < $ranksrow[$rank_group_id]['count']; $i++)
		{
			if ( $user_posts >= $ranksrow[$rank_group_id][$i]['rank_min'] )
			{
				$poster_rank = $ranksrow[$rank_group_id][$i]['rank_title'];
				if ( $poster_rank )
				{
					$poster_rank = $poster_rank . '<br />';
				}
				if ( strstr($poster_rank,'-#') )
				{
					$poster_rank = '';
				}
				$rank_image = ( $ranksrow[$rank_group_id][$i]['rank_image'] ) ? '<img src="' . $images['rank_path'] . $ranksrow[$rank_group_id][$i]['rank_image'] . '" alt="" border="0" /><br />' : '';
				break;
			}
		}
	}

	$comments_text = str_replace(array("\n", "\r"), array("<br />", ''), $comments_text);
	$reply_img = $images['reply_new'];

	$template->assign_block_vars("text", array(
		"POSTER" => $poster,
		'POSTER_RANK' => (strstr($poster_rank,'-#')) ? '' : $poster_rank,
		'RANK_IMAGE' => $rank_image,
		'POSTER_JOINED' => $poster_joined,
		'POSTER_POSTS' => $poster_posts,
		'POSTER_FROM' => $poster_from,
		'POSTER_AVATAR' => $poster_avatar,
		"TITLE" => $comments_title,
		"TIME" => $time,
		"TEXT" => $comments_text) 
	);

	if( $userdata['user_level'] == ADMIN )
	{
		
		$template->assign_block_vars("text.is_admin", array(
			"U_COMMENT_DELETE" => append_sid("dload.php?action=file&amp;cid=$comments_id&amp;delete=do&amp;id=$id"))
		);
	}
}

$template->assign_vars(array(
	'REPLY_IMG' => $reply_img,
	'IMG_POST' => $images['icon_minipost'],

	'L_COMMENTS' => $lang['Comments'],
	'L_AUTHOR' => $lang['Author'],
	'L_POSTED' => $lang['Posted'],
	'L_COMMENT_SUBJECT' => $lang['Comment_subject'],
	'L_COMMENT_ADD' => $lang['Comment_add'],
	'L_COMMENT_DELETE' => $lang['Comment_delete'],
	'L_COMMENTS_NAME' => $lang['Name'],
	'DELETE_IMG' => $images['icon_delpost'],
	'L_BACK_TO_TOP' => $lang['Back_to_top'],
	'ID' => $id)
);

if ( $userdata['session_logged_in'] )
{
	$template->assign_block_vars("auth_post", array());

	$template->assign_vars(array(
		'L_COMMENT_DO' => $lang['Comment_do'], 
		'U_COMMENT_DO' => append_sid("dload.php?action=file&amp;id=$id&amp;comment=post"))
	);
}

$template->assign_var_from_handle("COMMENT", "comment_output");

?>