<?php
/***************************************************************************
 *                portal.php
 *                -------------------
 *   author       : (C) 2005 Przemo http://www.przemo.org
 *   begin        : 2005/10/06 11:12
 *   version      : 1.12.4
 *
 ***************************************************************************/

/***************************************************************************
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 ***************************************************************************/

define('IN_PHPBB', true);
define('PORTAL', true);
define('ATTACH', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
include($phpbb_root_path . 'fetchposts.'.$phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);

$userdata = session_pagestart($user_ip, PAGE_INDEX);
init_userprefs($userdata);

if ( $board_config['login_require'] && !$userdata['session_logged_in'] )
{
	$message = $lang['login_require'] . '<br /><br />' . sprintf($lang['login_require_register'], '<a href="' . append_sid("profile.$phpEx?mode=register") . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
}

if ( !$portal_config_portal_on )
{
	redirect(append_sid("index.$phpEx?redirect=index.$phpEx", true));
}

if ( isset($HTTP_POST_VARS['fpage_theme']) && $userdata['session_logged_in'] )
{
	$fpage_theme = intval($HTTP_POST_VARS['fpage_theme']);
	$fp_sql = "UPDATE " . USERS_TABLE . "
		SET user_style = '$fpage_theme'
		WHERE user_id = '" . $userdata['user_id'] . "'";
	if ( !($fp_result = $db->sql_query($fp_sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not update users table ' . $user_id . $fpage_theme, '', __LINE__, __FILE__, $sql);
	}
	redirect(append_sid("portal.$phpEx", true));
}

$portal_page = 1;

include('includes/page_header.'.$phpEx);

require($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_portal.' . $phpEx);

$modules = array();
foreach($portal_config as $key => $value) 
{
	if ( strpos($key, 'module') !== false )
	{
		$modules[] = $value;
		$module_names[$value] = $key;
	}
}

if ( in_array('stats_user_menu', $modules) )
{
	$template->set_filenames(array(
		'stats_user_menu' => 'portal_modules/stats_user_menu.tpl')
	);

	$newest_userdata = get_db_stat('newestuser');

	$template->assign_vars(array(
		'L_STATISTICS' => $lang['Statistics'],
		'L_USERS_WRITE' => $lang['users_write'],
		'L_POSTS' => $lang['posts'],
		'L_TOPICS' => $lang['topics'],
		'L_REGISTERED_HAVE' => $lang['registered_have'],
		'L_REGISTERED_USERS' => $lang['registered_users'],

		'STATS_ALIGN' => $portal_config['stat_a'],
		'TOTAL_POSTS' => get_db_stat('postcount'),
		'TOTAL_TOPICS' => get_db_stat('topiccount'),
		'TOTAL_USERS' => get_db_stat('usercount'),
		'NEWEST_USERNAME' => sprintf($lang['Newest_user'], '<a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $newest_userdata['user_id']) . '" class="gensmall">', $newest_userdata['username'], '</a>')
	));

	$template->assign_var_from_handle($module_names['stats_user_menu'], 'stats_user_menu');
}

if ( in_array('recent_topics_menu', $modules) && $portal_config['value_recent_topics'] > 0 )
{
	$template->set_filenames(array(
		'recent_topics_menu' => 'portal_modules/recent_topics_menu.tpl')
	);

	$sql = "SELECT forum_id FROM " . FORUMS_TABLE;
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not query forums information', '', __LINE__, __FILE__, $sql);
	}
    $except_forums_ids = array();
    while( $row = $db->sql_fetchrow($result) )
    {
        $is_auth = array();
        $is_auth = $tree['auth'][POST_FORUM_URL . $row['forum_id']];

        if ( !$is_auth['auth_read'] || !$is_auth['auth_view'] )
        {
            array_push( $except_forums_ids, $row['forum_id'] );
        }
    }

    $except_forums = sizeof($except_forums_ids) > 0 ? "AND forum_id NOT IN (" . implode(',', $except_forums_ids) . ")" : '';

	$sql = "SELECT topic_id, topic_title
		FROM " . TOPICS_TABLE . "
		WHERE topic_status <> 2
		$except_forums
		ORDER BY topic_time DESC
		LIMIT " . $portal_config['value_recent_topics'];
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not query recent topics information', '', __LINE__, __FILE__, $sql);
	}

	$recent_topic_row = array();

	$template->assign_vars(array(
		'RT_ALIGN' => $portal_config['recent_topics_a'],
		'L_RECENT_TOPICS' => $lang['Recent_topics'],
		)
	);

	$i = 1;
	while ($row = $db->sql_fetchrow($result))
	{
		$template->assign_block_vars('topics', array(
			'ROW' => (!($i % 2)) ? 1 : 2,
			'TOPIC_URL' => append_sid("viewtopic.$phpEx?" . POST_TOPIC_URL . '=' . $row['topic_id']),
			'TOPIC_TITLE' => xhtmlspecialchars($row['topic_title']))
		);
		$i++;
	}
	$template->assign_var_from_handle($module_names['recent_topics_menu'], 'recent_topics_menu');
}

if ( in_array('whoonline_menu', $modules) )
{
	$template->set_filenames(array(
		'whoonline_menu' => 'portal_modules/whoonline_menu.tpl')
	);

	$users_lasthour = 0;
	$sql = "SELECT session_ip, MAX(session_time) as session_time FROM " . SESSIONS_TABLE . "
		WHERE session_user_id = '" . ANONYMOUS . "'
			AND session_time >= " . ( CR_TIME - 86400 ) . "
		GROUP BY session_ip";

	if ( !$result = $db->sql_query($sql))
	{
		message_die(GENERAL_ERROR, 'Couldn\'t retrieve guest user today data', '', __LINE__, __FILE__, $sql);
	}

	while( $guest_list = $db->sql_fetchrow($result))
	{ 
		if ( $guest_list['session_time'] > ( CR_TIME - 3600 ) )
		{
			$users_lasthour++;
		}
	}
	$guests_today = $db->sql_numrows($result);

	$time_to_show = ( CR_TIME - ( $board_config['last_visitors_time'] * 3600 ) );

	$sql = "SELECT user_id, username, user_allow_viewonline, user_level, user_jr, user_lastvisit
		FROM " . USERS_TABLE . " u
		WHERE user_id != " . ANONYMOUS . "
			AND user_session_time >= $time_to_show
		ORDER BY user_level = 1 DESC, user_jr DESC, user_level = 2 DESC, user_level = 0 DESC, username";
	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Couldn\'t retrieve user today data', '', __LINE__, __FILE__, $sql); 
	}

	while( $todayrow = $db->sql_fetchrow($result)) 
	{
		if ( $todayrow['user_lastvisit'] >= ( CR_TIME - 3600 ) )
		{
			$users_lasthour++;
		}

		$colored_username = color_username($todayrow['user_level'], $todayrow['user_jr'], $todayrow['user_id'], $todayrow['username']);
		$todayrow['username'] = $colored_username[0];

		$users_today_list .= ($todayrow['user_allow_viewonline']) ? ' <a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $todayrow['user_id']) . '" ' . $colored_username[1] . ' class="gensmall">' . $todayrow['username'] . '</a>,' : (($userdata['user_level']==ADMIN) ? ' <a href="' . append_sid("profile.$phpEx?mode=viewprofile&amp;" . POST_USERS_URL . "=" . $todayrow['user_id']) . '"' . $colored_username[1] . ' class="gensmall"><i>' . $todayrow['username'] . '</i></a>,' : '');
		if ( !$todayrow['user_allow_viewonline'] )
		{
			$logged_hidden_today++;
		}
		else
		{
			$logged_visible_today++;
		}
	}

	if ( $users_today_list )
	{
		$users_today_list[ strlen( $users_today_list)-1] = ' '; 
	}
	else
	{
		$users_today_list = $lang['None'];
	}
	$total_users_today = $db->sql_numrows($result) + $guests_today;

	$l_today_r_user_s = ($logged_visible_today) ? ( ( $logged_visible_today == 1 ) ? $lang['Reg_user_total'] : $lang['Reg_users_total'] ) : $lang['Reg_users_zero_total'];
	$l_today_h_user_s = ($logged_hidden_today) ? (($logged_hidden_today == 1) ? $lang['Hidden_user_total'] : $lang['Hidden_users_total'] ) : $lang['Hidden_users_zero_total'];
	$l_today_g_user_s = ($guests_today) ? (($guests_today == 1) ? $lang['Guest_user_total'] : $lang['Guest_users_total']) : $lang['Guest_users_zero_total'];
	$l_today_users = sprintf($l_today_user_s, $total_users_today);
	$l_today_users .= sprintf($l_today_r_user_s, $logged_visible_today);
	$l_today_users .= sprintf($l_today_h_user_s, $logged_hidden_today);
	$l_today_users .= sprintf($l_today_g_user_s, $guests_today);

	$users_lasthour_info = ($users_lasthour) ? $lang['Users_lasthour_explain'] . ':<b>' . $users_lasthour . '</b>' : $lang['Users_lasthour_none_explain'];

	if ( !(@function_exists('users_online')) )
	{
		include($phpbb_root_path . 'includes/functions_add.'.$phpEx);
	}

	$generate_online = users_online('portal');
	$online_userlist = $generate_online[0];
	$l_online_users = $generate_online[1];

	$template->assign_vars(array(
		'WHO_ALIGN' => $portal_config['whoonline_a'],
		'TODAY_USERS' => $l_today_users,
		'USERS_TODAY_LIST' => $users_today_list,
		'USERS_LAST_HOUR_INFO' => $users_lasthour_info,
		'U_VIEWONLINE' => append_sid('viewonline.'.$phpEx),
		'WHOONLINE' => sprintf($lang['Record_online_users'], $board_config['record_online_users'], create_date($board_config['default_dateformat'], $board_config['record_online_date'], $board_config['board_timezone'])),
		'TOTAL_USERS_ONLINE' => $l_online_users,
		'LOGGED_IN_USER_LIST' => $online_userlist,


		'L_ONLINE_USERS' => $l_online_users,
		'L_DAY_USERS' => sprintf($lang['Day_users'], $board_config['last_visitors_time']),
		'L_TODAY_REGISTER' => $lang['today_register'],
		'L_WHOONLINE' => $lang['Who_is_Online'])
	);

	$template->assign_var_from_handle($module_names['whoonline_menu'], 'whoonline_menu');
}

if ( in_array('top_posters_menu', $modules) && $portal_config['value_top_posters'] > 0 )
{
	$template->set_filenames(array(
		'top_posters_menu' => 'portal_modules/top_posters_menu.tpl')
	);

	$template->assign_vars(array(
		'L_TOP_POSTERS' => $lang['top_posters'],
		'L_POSTS' => $lang['posts'],
		'TOP_ALIGN' => $portal_config['top_posters_a'],
		)
	);

	$sql = "SELECT user_id, username, user_posts
		FROM " . USERS_TABLE . "
		WHERE user_id > 0
		ORDER BY user_posts DESC
		LIMIT " . $portal_config['value_top_posters'];

	if ( !$result = $db->sql_query($sql) )
	{
		message_die(GENERAL_ERROR, 'Could not query top posters information', '', __LINE__, __FILE__, $sql);
	}
	$i = 0;
	while ($row = $db->sql_fetchrow($result))
	{
		if ( $row['user_posts'] > 0 )
		{
			$template->assign_block_vars('top_posters', array(
				'ROW' => (!($i % 2)) ? 1 : 2,
				'USER_URL' => append_sid("profile.$phpEx?mode=viewprofile&amp;u=" . $row['user_id']),
				'USERNAME' => $row['username'],
				'SEARCH_POSTS_URL' => append_sid("search.$phpEx?search_author=" . $row['username']),
				'USER_POSTS' => $row['user_posts'])
			);
			$i++;
		}
	}
	$template->assign_var_from_handle($module_names['top_posters_menu'], 'top_posters_menu');
}

if ( in_array('info_menu', $modules) )
{
	$template->set_filenames(array(
		'info_menu' => 'portal_modules/info_menu.tpl')
	);

	if ( $board_config['cstyles'] )
	{
		$template->assign_block_vars('change_style', array(
			'L_CHANGE_STYLE' => $lang['Board_style'],
			'STYLE_SELECT' => ($userdata['session_logged_in']) ? style_select($userdata['user_style'], 'fpage_theme') : style_select($board_config['default_style'], 'template'),
			'S_ACTION' => append_sid("portal.$phpEx"))
		);
	}

	if ( $userdata['session_logged_in'] )
	{
		$avatar_img = '';
		if ( $userdata['user_avatar_type'] && $userdata['user_allowavatar'] )
		{
			switch( $userdata['user_avatar_type'] )
			{
				case USER_AVATAR_UPLOAD:
					$avatar_img = ($board_config['allow_avatar_upload']) ? '<img src="' . $board_config['avatar_path'] . '/' . $userdata['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_REMOTE:
					$avatar_img = ($board_config['allow_avatar_remote']) ? '<img src="' . $userdata['user_avatar'] . '" alt="" border="0" />' : '';
					break;
				case USER_AVATAR_GALLERY:
					$avatar_img = ($board_config['allow_avatar_local']) ? '<img src="' . $board_config['avatar_gallery_path'] . '/' . $userdata['user_avatar'] . '" alt="" border="0" />' : '';
					break;
			}
		}

		$template->assign_block_vars('user_inf', array(
			'AVATAR_IMG' => $avatar_img)
		);
	}

	$template->assign_vars(array(
		'L_WELCOME' => $lang['Welcome'],
		'CURRENT_TIME' => sprintf($lang['Current_time'], create_date($board_config['default_dateformat'], CR_TIME, $board_config['board_timezone'], true)),
		'USERNAME' => ($userdata['session_logged_in']) ? $userdata['username'] : $lang['Guest'],
		'INFO_ALIGN' => $portal_config['info_a'])
	);

	if ( $userdata['session_logged_in'] )
	{
		include($phpbb_root_path . 'includes/read_history.'.$phpEx);
		$userdata = user_unread_posts();
		$count_unread_posts = unread_forums_posts('count');
		if ( $count_unread_posts )
		{
			$template->assign_block_vars('user_inf.unread', array());
			$template->assign_vars(array(
				'L_SEARCH_NEW' => $lang['Search_new_unread'],
				'COUNT_NEW_POSTS' => $count_unread_posts)
			);
		}

		$template->assign_vars(array(
			'L_SEARCH_LASTVISIT' => $lang['Search_new'],
			'U_SEARCH_LASTVISIT' => append_sid('search.'.$phpEx.'?search_id=newposts'),
			'U_SEARCH_NEW' => append_sid('search.'.$phpEx.'?search_id=lastvisit'))
		);
		$template->assign_block_vars('user_inf.lastvisit', array());
	}

	$template->assign_var_from_handle($module_names['info_menu'], 'info_menu');
}

if ( $board_config['cbirth'] && in_array('birthday_menu', $modules) && $userdata['cbirth'])
{
	$template->set_filenames(array(
		'birthday_menu' => 'portal_modules/birthday_menu.tpl')
	);

	$birthday_list = birthday_list();

	$dm = create_date('j', CR_TIME, $board_config['board_timezone'], true);
	$rok = create_date('Y', CR_TIME, $board_config['board_timezone'], true);
	$godz = create_date('G:i', CR_TIME, $board_config['board_timezone'], true);
	$mc = create_date('n', CR_TIME, $board_config['board_timezone'], true);
	$data = "$mc-$dm";
	$md = $birth_name = $td = '';
	include($phpbb_root_path . 'includes/portal_data.'.$phpEx);

	$template->assign_vars(array(
		'BIRTH_ALIGN' => $portal_config['birthday_a'],
		'L_TODAY' => $lang['Today'],
		'L_TIME' => $lang['Time'],
		'HOUR' => $godz,
		'DAY' => $dm,
		'MONTH' => $mc,
		'YEAR' => $rok,
		'YEAR_LEFT' => 365 - create_date('z', CR_TIME, $board_config['board_timezone'], true) + create_date('L', CR_TIME, $board_config['board_timezone'], true),
		'IM_NAME' => $birth_name,
		'L_BIRTHDAY_TODAY' => ($birthday_list[0]) ? $lang['Birthday_today'] : $lang['Nobirthday_today'],
		'L_YEAR_LEFT' => $lang['year_left'],
		'L_DAYS' => $lang['days'],
		'L_IMIENINY' => $lang['kto_imieniny'],
		'BIRTHDAY_TODAY' => $birthday_list[0],
		'BIRTHDAY_WEEK' => sprintf((($birthday_list[1]) ? $lang['Birthday_week'] . ' <br />' . $birthday_list[1] : $lang ['Nobirthday_week']), $board_config['birthday_check_day']))
	);

	$template->assign_var_from_handle($module_names['birthday_menu'], 'birthday_menu');
}

$template->set_filenames(array(
	'body' => 'portal_body.tpl')
);

// Fetch Posts from Announcements Forum
$open_bracket = '';
$close_bracket = '';
$read_full = '';
if ( (!$portal_config['own_body'] && $portal_config_witch_news_forum != '') || isset($HTTP_GET_VARS['s']) )
{
	if ( isset($HTTP_GET_VARS['s']) )
	{
		$show_forum = intval($HTTP_GET_VARS['s']);
		$is_auth = array();
		$is_auth = $tree['auth'][POST_FORUM_URL . $show_forum];

		if ( !empty($show_forum) )
		{
			$cache_name = 'multisqlcache_forum_' . $show_forum;
			$forum_row = sql_cache('check', $cache_name);
			if (empty($forum_row))
			{
				$sql = "SELECT *
					FROM " . FORUMS_TABLE . "
					WHERE forum_id = $show_forum";
				if ( !($result = $db->sql_query($sql)) )
				{
					message_die(GENERAL_ERROR, 'Could not obtain forums information', '', __LINE__, __FILE__, $sql);
				}
				if ( !($forum_row = $db->sql_fetchrow($result)) )
				{
					message_die(GENERAL_MESSAGE, 'Could not retrieve forum information', '', __LINE__, __FILE__, $sql);
				}
				sql_cache('write', $cache_name, $forum_row); 
			}
		}
		else
		{
			message_die(GENERAL_MESSAGE, 'Forum_not_exist');
		}

		$portal_config_witch_news_forum = (!empty($show_forum) && $is_auth['auth_read'] && !$forum_row['password']) ? $show_forum : $portal_config_witch_news_forum;
	}

	if ( !isset($HTTP_GET_VARS['article']) )
	{
		$fetchposts = phpbb_fetch_posts($portal_config_witch_news_forum, $portal_config['number_of_news'], $portal_config['news_length']);

		for ($i = 0; $i < count($fetchposts); $i++)
		{
			if ( $fetchposts[$i]['striped'] == 1 )
			{
				$open_bracket = '[ ';
				$close_bracket = ' ]';
				$read_full = $lang['Read_Full'];
			}
			else
			{
				$open_bracket = '';
				$close_bracket = '';
				$read_full = '';
			}

			$fp_text = preg_replace("#\[mod\](.*?)\[/mod\]#si", "", $fetchposts[$i]['post_text']);
			$fp_text = preg_replace("#\[hide(.*?)\[\/hide#si","", $fp_text);

			$template->assign_block_vars('fetchpost_row', array(
				'TITLE' => $fetchposts[$i]['topic_title'],
				'POSTER' => $fetchposts[$i]['username'],
				'TIME' => $fetchposts[$i]['topic_time'],
				'TEXT' => $fp_text,
				'REPLIES' => $fetchposts[$i]['topic_replies'],
				'U_VIEW_COMMENTS' => append_sid('viewtopic.'.$phpEx . '?t=' . $fetchposts[$i]['topic_id']),
				'U_POST_COMMENT' => append_sid('posting.'.$phpEx . '?mode=reply&amp;t=' . $fetchposts[$i]['topic_id']),
				'U_READ_FULL' => append_sid('portal.'.$phpEx.'?article=' . $i . ( ($show_forum) ? '&s=' . $show_forum : '')),
				'L_READ_FULL' => $read_full,
				'OPEN' => $open_bracket,
				'CLOSE' => $close_bracket)
			);

			// Portal Attachment image by Crack
			if ( defined('ATTACHMENTS_ON') && $fetchposts[$i]['post_attachment'] )
			{
				$attachments = get_attachments_from_post($fetchposts[$i]['post_id']);
				foreach( $attachments as $attachment )
				{
					if( strpos($attachment['mimetype'], 'image') !== false )
					{
						if( intval($attach_config['allow_ftp_upload']) && !$attachment['thumbnail'] )
						{
							if( trim($attach_config['download_path']) == '' )
							{
								message_die(GENERAL_ERROR, 'Physical Download not possible with the current Attachment Setting');
							}
							$img_path = trim($attach_config['download_path']) . '/' . $attachment['physical_filename'];
						}
						else
						{
							$server_protocol = ($board_config['cookie_secure']) ? 'https://' : 'http://';
							$server_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['server_name']));
							$server_port = ($board_config['server_port'] <> 80) ? ':' . trim($board_config['server_port']) : '';
							$script_name = preg_replace('/^\/?(.*?)\/?$/', '/\1', trim($board_config['script_path']));
							if ($script_name[strlen($script_name)] != '/')
							{
								$script_name .= '/';
							}
							$image_path = $server_protocol . $server_name . $server_port . $script_name . $upload_dir . '/' 
								. ( $attachment['thumbnail'] ? 'thumbs/t_' : '')
								. $attachment['physical_filename'];
						}
						$img_size = array(200, 0); // szerokoœæ, wysokoœæ
						if( $attachment['comment'] && preg_match('#(\d+)x(\d+)#', $attachment['comment'], $match) )
						{
							$img_size = array(intval($match[1]), intval($match[2]));
						}
						$img_size = ( $img_size[0] ? 'width="' . $img_size[0] . '" ' : '' )
							. ( $img_size[1] ? 'heigh="' . $img_size[1] . '" ' : '' );
						$image = '<img ' . $img_size . 'src="' . $image_path
							. '" alt="' . xhtmlspecialchars($attachment['comment'])
							. '" style="border:0px" />';
						if( $attachment['thumbnail'] )
						{
							$image = '<a href="'. append_sid("download.$phpEx?id=".$attachment['attach_id'])
								. '" target="_blank">' . $image . '</a>';
						}
						$template->assign_block_vars('fetchpost_row.image', array(
							'IMAGE' => $image,
							'COMMENT' => xhtmlspecialchars($attachment['comment']) )
						);
						break;
					}
				}
			} // Attachment image end
		}
	}
	else
	{
		$fetchposts = phpbb_fetch_posts($portal_config_witch_news_forum, $portal_config['number_of_news'], 0);

		$i = intval($HTTP_GET_VARS['article']);

		$template->assign_block_vars('fetchpost_row', array(
			'TITLE' => $fetchposts[$i]['topic_title'],
			'POSTER' => $fetchposts[$i]['username'],
			'TIME' => $fetchposts[$i]['topic_time'],
			'TEXT' => $fetchposts[$i]['post_text'],
			'REPLIES' => $fetchposts[$i]['topic_replies'],
			'U_VIEW_COMMENTS' => append_sid('viewtopic.'.$phpEx.'?t=' . $fetchposts[$i]['topic_id']),
			'U_POST_COMMENT' => append_sid('posting.'.$phpEx.'?mode=reply&amp;t=' . $fetchposts[$i]['topic_id']))
		);
	}
}
// END: Fetch Announcements

// Fetch Poll

$fetchpoll = ($portal_config['witch_poll_forum'] != '') ? phpbb_fetch_poll($portal_config['witch_poll_forum']) : '';
if ( !empty($fetchpoll) )
{
	$template->set_filenames(array(
		'poll_menu' => 'portal_modules/poll_body.tpl')
	);

	if ( $portal_config['poll'] == 1 )
	{
		$poll_align = 'left';
	}
	else if ( $portal_config['poll'] == 0 )
	{
		$poll_align = 'center';
	}
	else
	{
		$poll_align = 'right';
	}

	$template->assign_vars(array(
		'L_POLL' => $lang['Poll'],
		'POLL_ALIGN' => $poll_align)
	);

	$sql = "SELECT vote_id
		FROM " . VOTE_USERS_TABLE . "
		WHERE vote_id = " . $fetchpoll['vote_id'] . "
			AND vote_user_id = " . $userdata['user_id'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not obtain user vote data for this topic', '', __LINE__, __FILE__, $sql);
	}

	$user_voted = ($row = $db->sql_fetchrow($result)) ? TRUE : 0;

	if ( $user_voted )
	{
		if ( $fetchpoll['vote_hide'] == 0 )
		{
			$vote_options = count($fetchpoll['options']);
			$vote_results_sum = 0;

			for($i = 0; $i < $vote_options; $i++)
			{
				$vote_results_sum += $fetchpoll['options'][$i]['vote_result'];
			}

			$vote_graphic = 0;
			$vote_graphic_max = count($images['voting_graphic']);

			for($i = 0; $i < $vote_options; $i++)
			{
				$vote_percent = ($vote_results_sum > 0) ? $fetchpoll['options'][$i]['vote_result'] / $vote_results_sum : 0;
				$vote_graphic_length = round($vote_percent * 165);

				$vote_graphic_img = $images['voting_graphic'][$vote_graphic];
				$vote_graphic = ($vote_graphic < $vote_graphic_max - 1) ? $vote_graphic + 1 : 0;

				$hide_vote_bl = '';
				$hide_vote_zr = '0';

				if ( ( $poll_expired == 0 ) && ( $fetchpoll['vote_hide'] == 1 ) && ( $fetchpoll['options'][0]['vote_length'] <> 0 ) )
				{
					if ( $fetchpoll['vote_tothide'] == 0 )
					{
						$total_votes_1 = '' ;
						$total_votes_2 = '' ;
					}
					$poll_expires_c = $lang['Results_after'];

					$template->assign_block_vars('poll_option', array(
						'TOTAL_VOTES' => $lang['Total_vots'],
						'POLL_OPTION_CAPTION' => $fetchpoll['options'][$i]['vote_option_text'],
						'POLL_OPTION_RESULT' => $hide_vote_bl,
						'POLL_OPTION_PERCENT' => $hide_vote_bl,
						'POLL_OPTION_IMG' => $vote_graphic_img,
						'POLL_OPTION_IMG_WIDTH' => $hide_vote_zr)
					);
				}
				else
				{
					$poll_expires_c = '';
					$template->assign_block_vars('poll_option', array(
						'TOTAL_VOTES' => $lang['Total_vots'],
						'POLL_OPTION_CAPTION' => $fetchpoll['options'][$i]['vote_option_text'],
						'POLL_OPTION_RESULT' => $fetchpoll['options'][$i]['vote_result'],
						'POLL_OPTION_PERCENT' => sprintf("%.1d%%", ($vote_percent * 100)),

						'POLL_OPTION_IMG' => $vote_graphic_img,
						'POLL_OPTION_IMG_WIDTH' => $vote_graphic_length)
					);
				}
			}
		}
		$template->assign_vars(array(
			'S_POLL_QUESTION' => $fetchpoll['vote_text'])
		);
	}
	else
	{
		$template->assign_block_vars('poll_vote', array());

		$max_vote = $fetchpoll['vote_max'];
		$vote_box = ($max_vote > 1) ? 'checkbox' : 'radio';

		if ( $max_vote > 1 )
		{
			$template->assign_block_vars('max_voting', array());
			$vote_br = '<br />';
			$max_vote_nb = $max_vote;
		}
		else
		{
			$vote_br = '';
			$lang['Max_voting_1_explain'] = '';
			$lang['Max_voting_2_explain'] = '';
			$lang['Max_voting_3_explain'] = '';
			$max_vote_nb = '';
		}

		$template->assign_vars(array(
			'S_POLL_QUESTION' => $fetchpoll['vote_text'],
			'S_POLL_ACTION' => append_sid('posting.'.$phpEx.'?' . POST_TOPIC_URL . '=' . $fetchpoll['topic_id']),
			'S_TOPIC_ID' => $fetchpoll['topic_id'],
			'L_VOTE_BUTTON' => $lang['Vote'],
			'POLL_VOTE_BOX' => $vote_box,
			'MAX_VOTING_1_EXPLAIN' => $lang['Max_voting_1_explain'],
			'MAX_VOTING_2_EXPLAIN' => $lang['Max_voting_2_explain'],
			'MAX_VOTING_3_EXPLAIN' => $lang['Max_voting_3_explain'],
			'max_vote' => $max_vote_nb,
			'L_SUBMIT_VOTE' => $lang['Submit_vote'],
			'L_LOGIN_TO_VOTE' => $lang['Login_to_vote'])
		);

		for ($i = 0; $i < count($fetchpoll['options']); $i++)
		{
			$template->assign_block_vars('poll_option_row', array(
				'OPTION_ID' => $fetchpoll['options'][$i]['vote_option_id'],
				'OPTION_TEXT' => $fetchpoll['options'][$i]['vote_option_text'],
				'VOTE_RESULT' => (!$fetchpoll['vote_hide'] && !$fetchpoll['vote_tothide']) ? $fetchpoll['options'][$i]['vote_result'] : '*')
			);
		}
	}
	$template->assign_var_from_handle($module_names['poll_menu'], 'poll_menu');
}

if ( in_array('custom_module1', $modules) && $portal_config['custom1_body'] )
{
	$template->assign_vars(array(
		'CUSTOM_MODULE1_ALIGN' => $portal_config['custom1_body_a'],
		'CUSTOM_MODULE1_NAME' => $portal_config['custom1_name'],
		'CUSTOM_MODULE1_BODY' => $portal_config['custom1_body'])
	);
	
	$template->set_filenames(array(
		'custom_module1' => 'portal_modules/custom_module1.tpl')
	);
	$template->assign_var_from_handle($module_names['custom_module1'], 'custom_module1');
}
if ( in_array('custom_module2', $modules) && $portal_config['custom2_body'] )
{
	$template->assign_vars(array(
		'CUSTOM_MODULE2_ALIGN' => $portal_config['custom2_body_a'],
		'CUSTOM_MODULE2_NAME' => $portal_config['custom2_name'],
		'CUSTOM_MODULE2_BODY' => $portal_config['custom2_body'])
	);
	
	$template->set_filenames(array(
		'custom_module2' => 'portal_modules/custom_module2.tpl')
	);
	$template->assign_var_from_handle($module_names['custom_module2'], 'custom_module2');
}

if ( in_array('blank_module1', $modules) && $portal_config['blank1_body'] && $portal_config['blank1_body_on'] )
{
	$template->assign_vars(array($module_names['blank_module1'] => $portal_config['blank1_body']));
}
if ( in_array('blank_module2', $modules) && $portal_config['blank2_body'] && $portal_config['blank2_body_on'] )
{
	$template->assign_vars(array($module_names['blank_module2'] => $portal_config['blank2_body']));
}
if ( in_array('blank_module3', $modules) && $portal_config['blank3_body'] && $portal_config['blank3_body_on'] )
{
	$template->assign_vars(array($module_names['blank_module3'] => $portal_config['blank3_body']));
}
if ( in_array('blank_module4', $modules) && $portal_config['blank4_body'] && $portal_config['blank4_body_on'] )
{
	$template->assign_vars(array($module_names['blank_module4'] => $portal_config['blank4_body']));
}

if ( in_array('portal_menu', $modules) )
{
	$template->set_filenames(array(
		'portal_menu' => 'portal_modules/portal_menu.tpl')
	);

	$template->assign_vars(array(
		'PORTAL_MENU_ALIGN' => $portal_config['portal_menu_a'],
		'L_PORTAL_MENU' => $lang['Board_navigation'],
	));

	if ( $portal_config['custom_desc1'] && $portal_config['custom_address1'] )
	{
		$template->assign_block_vars('custom_links1', array(
			'CUSTOM_LINKS1_ADDRESS' => $portal_config['custom_address1'],
			'CUSTOM_LINKS1_DESC' => $portal_config['custom_desc1'])
		);
	}
	if ( $portal_config['custom_desc2'] && $portal_config['custom_address2'] )
	{
		$template->assign_block_vars('custom_links2', array(
			'CUSTOM_LINKS2_ADDRESS' => $portal_config['custom_address2'],
			'CUSTOM_LINKS2_DESC' => $portal_config['custom_desc2'])
		);
	}
	if ( $portal_config['custom_desc3'] && $portal_config['custom_address3'] )
	{
		$template->assign_block_vars('custom_links3', array(
			'CUSTOM_LINKS3_ADDRESS' => $portal_config['custom_address3'],
			'CUSTOM_LINKS3_DESC' => $portal_config['custom_desc3'])
		);
	}
	if ( $portal_config['custom_desc4'] && $portal_config['custom_address4'] )
	{
		$template->assign_block_vars('custom_links4', array(
			'CUSTOM_LINKS4_ADDRESS' => $portal_config['custom_address4'],
			'CUSTOM_LINKS4_DESC' => $portal_config['custom_desc4'])
		);
	}
	if ( $portal_config['custom_desc5'] && $portal_config['custom_address5'] )
	{
		$template->assign_block_vars('custom_links5', array(
			'CUSTOM_LINKS5_ADDRESS' => $portal_config['custom_address5'],
			'CUSTOM_LINKS5_DESC' => $portal_config['custom_desc5'])
		);
	}
	if ( $portal_config['custom_desc6'] && $portal_config['custom_address6'] )
	{
		$template->assign_block_vars('custom_links6', array(
			'CUSTOM_LINKS6_ADDRESS' => $portal_config['custom_address6'],
			'CUSTOM_LINKS6_DESC' => $portal_config['custom_desc6'])
		);
	}
	if ( $portal_config['custom_desc7'] && $portal_config['custom_address7'] )
	{
		$template->assign_block_vars('custom_links7', array(
			'CUSTOM_LINKS7_ADDRESS' => $portal_config['custom_address7'],
			'CUSTOM_LINKS7_DESC' => $portal_config['custom_desc7'])
		);
	}
	if ( $portal_config['custom_desc8'] && $portal_config['custom_address8'] )
	{
		$template->assign_block_vars('custom_links8', array(
			'CUSTOM_LINKS8_ADDRESS' => $portal_config['custom_address8'],
			'CUSTOM_LINKS8_DESC' => $portal_config['custom_desc8'])
		);
	}

	if ( $portal_config['links1'] )
	{
		$template->assign_block_vars('own_links1', array(
			'OWN_LINKS1_DESC' => $lang['Forum'])
		);
	}
	if ( $portal_config['links2'] )
	{
		$template->assign_block_vars('own_links2', array());
	}
	if ( $portal_config['links3'] )
	{
		$template->assign_block_vars('own_links3', array());
	}
	if ( $portal_config['links4'] )
	{
		$template->assign_block_vars('own_links4', array());
	}
	if ( $portal_config['links5'] )
	{
		$template->assign_block_vars('own_links5', array());
	}
	if ( $portal_config['links6'] && $userdata['session_logged_in'] )
	{
		$template->assign_block_vars('own_links6', array());
	}
	if ( $portal_config['links7'] && $userdata['session_logged_in'] )
	{
		$template->assign_block_vars('own_links7', array(
			'U_LOGIN_PORTAL_REDIRECT' => 'login.'.$phpEx.'?logout=true&amp;sid=' . $userdata['session_id'] . '&redirect=portal.'.$phpEx)
		);
	}
	if ( $portal_config['links8'] && !$userdata['session_logged_in'] )
	{
		$template->assign_block_vars('own_links8', array());
	}

	$template->assign_var_from_handle($module_names['portal_menu'], 'portal_menu');
}

if ( in_array('links_menu', $modules) && $portal_config['links_body'] )
{
	$template->assign_vars(array(
		'L_LINKS_TITLE' => $lang['links'],
		'LINKS_ALIGN' => $portal_config['links_a'],
		'LINKS_BODY' => $portal_config['links_body'])
	);
	$template->set_filenames(array(
		'links_menu' => 'portal_modules/links_menu.tpl')
	);
	$template->assign_var_from_handle($module_names['links_menu'], 'links_menu');
}

if ( in_array('search_menu', $modules) )
{
	$template->assign_vars(array(
		'L_SEARCH_AT' => $lang['Search_at'],
		'L_ADVANCED_SEARCH' => $lang['Advanced_search'],
		'S_SEARCH_ACTION' => append_sid('search.'.$phpEx),
		'SEARCH_ALIGN' => $portal_config['search_a'])
	);
	$template->set_filenames(array(
		'search_menu' => 'portal_modules/search_menu.tpl')
	);
	$template->assign_var_from_handle($module_names['search_menu'], 'search_menu');
}

if ( in_array('login_menu', $modules) && !$userdata['session_logged_in'] )
{
	$template->assign_vars(array(
		'L_REMEMBER_LOGIN' => $lang['Remember_me'],
		'L_FORGOTTEN_PASSWORD' => $lang['Forgotten_password'],
		'U_SENDPASSWORD' => append_sid("profile.$phpEx?mode=sendpassword"),
		'S_LOGIN_ACTION' => append_sid("login.$phpEx"),
		'LOGIN_ALIGN' => $portal_config['login_a'])
	);
	$template->set_filenames(array(
		'login_menu' => 'portal_modules/login_menu.tpl')
	);
	$template->assign_var_from_handle($module_names['login_menu'], 'login_menu');
}

if ( in_array('chat_menu', $modules) )
{
	include($phpbb_root_path . 'chatbox_front.'.$phpEx);
	$template->assign_vars(array(
		'L_CHAT_TITLE' => $lang['Who_is_Chatting'],
		'L_JOIN_CHAT' => $lang['Click_to_join_chat'],
		'L_LOGIN_TO_JOIN' => $lang['Login_to_join_chat'],
		'HOW_MANY_CHATTERS' => sprintf($lang['How_Many_Chatters'], $howmanychat),
		'U_CHAT' => append_sid("chatbox_mod/chatbox.$phpEx"),
		'CHATBOX_NAME' => $userdata['user_id'] . '_ChatBox',
		'CHAT_ALIGN' => $portal_config['chat_a'])
	);
	$template->set_filenames(array(
		'chat_menu' => 'portal_modules/chat_menu.tpl')
	);
	$template->assign_var_from_handle($module_names['chat_menu'], 'chat_menu');
}

if ( in_array('register_menu', $modules) && !$userdata['session_logged_in'])
{
	$template->set_filenames(array(
		'register_menu' => 'portal_modules/register_menu.tpl')
	);

	$custom_field_box = '';
	$custom_fields_exists = (custom_fields('quick_regist', '')) ? true : false;

	if ( $custom_fields_exists )
	{
		$custom_fields = custom_fields('', 'quick_regist');
		for($i = 0; $i < count($custom_fields[0]); $i++)
		{
			$split_field = 'user_field_' . $custom_fields[0][$i];
			$desc = (isset($lang[$custom_fields[1][$i]])) ? $lang[$custom_fields[1][$i]] : $custom_fields[1][$i];
			$desc = str_replace(array('-#', '<br>'), array('',''), $desc);

			if ( $custom_fields[3][$i] )
			{
				$options = explode(',', $custom_fields[3][$i]);
				if ( count($options) > 0 )
				{
					if ( strpos($options[count($options) -1 ], '.gif') || strpos($options[count($options) -1 ], '.jpg') )
					{
						$jumpbox = '<script language="javascript" type="text/javascript">
						<!--
							function update_rank(newimage){document.' . $split_field . '.src = \'' . $images['images'] . '/custom_fields/\'+newimage;}
						//-->
						</script>';
						$jumpbox .= '<select name="' . $split_field . '" onchange="update_rank(this.options[selectedIndex].value);"><option value="no_image.gif">' . $lang['None'] . '</option>';
						for ($j = 0; $j+1 <= count($options); $j++) 
						{
							$field_name = str_replace(array('_', '.gif', '.jpg'), array(' ', '', ''), $options[$j]);
							$cf_selected = ($options[$j] == $$split_field) ? 'selected="selected"' : '';
							$jumpbox .= '<option value="' . $options[$j] . '" ' . $cf_selected . '>' . $field_name . '</option>';
						}
						$jumpbox .= '</select>&nbsp;<img name="' . $split_field . '" src="' . $images['images'] . '/custom_fields/no_image.gif" border="0" alt="" align="top" />';
					}
					else
					{
						$jumpbox = '<select name="' . $split_field . '"><option value="" ' . $cf_selected . '>' . $lang['None'] . '</option>';
						for ($j = 0; $j+1 <= count($options); $j++) 
						{
							$cf_selected = ($options[$j] == $$split_field) ? 'selected="selected"' : '';
							$jumpbox .= '<option value="' . $options[$j] . '" ' . $cf_selected . '>' . $options[$j] . '</option>';
						}
						$jumpbox .= '</select>';
					}
					$custom_field_box .= (($custom_field_box) ? '<br />' : '') . $desc . ': ' . $jumpbox;
				}
			}
			else
			{
				$field_size = ($custom_fields[2][$i] < 20) ? ($custom_fields[2][$i] + 1) : '20';
				$custom_field_box .= (($custom_field_box) ? '<br />' : '') . $desc . ': <input type="text" name="' . $split_field . '" class="post" maxlength="' . $custom_fields[2][$i] . '" size="' . $field_size . '" onFocus="Active(this)" onBlur="NotActive(this)" />&nbsp;&nbsp;';
			}
		}
	}

	if ( $board_config['validate'] && @extension_loaded('zlib') )
	{
		$key = '';
		$max_length_reg_key = 4;
		$chars = array('1','2','3','4','5','6','7','8','9');

		$count = count($chars) - 1;
		srand((double)microtime()*1000000);

		for($i = 0; $i < $max_length_reg_key; $i++)
		{
			$key .= $chars[rand(0, $count)];
		}

		$sql = "DELETE FROM " . ANTI_ROBOT_TABLE . "
			WHERE timestamp < '" . (CR_TIME - 3600) . "'
			OR session_id = '" . $userdata['session_id'] . "'";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain registration information', '', __LINE__, __FILE__, $sql);
		}

		$sql = "INSERT INTO ". ANTI_ROBOT_TABLE . "
			VALUES ('" . $userdata['session_id'] . "', '" . $key . "', '" . CR_TIME . "')";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not check registration information', '', __LINE__, __FILE__, $sql);
		}
		$template->assign_block_vars('validation', array());
		$row_class = ($row_class == $row1) ? $row2 : $row1;
		$template->assign_vars(array(
			'VALIDATION_IMAGE' => append_sid("includes/confirm_register.$phpEx"),
			'L_CODE' => $lang['Code'])
		);
	}

	if ( $board_config['gender'] && $board_config['require_gender'] )
	{
		$template->assign_block_vars('gender_box', array());

		$template->assign_vars(array(
			'L_GENDER' => $lang['Gender'],
			'L_FEMALE' => $lang['Female'],
			'L_MALE' => $lang['Male'])
		);
	}

	$template->assign_vars(array(
		'L_QUICK_REGISTER' => $lang['Quick_register'],
		'L_CONFIRM_PASSWORD' => $lang['Confirm_password'],
		'L_EMAIL' => $lang['Email'],
		'CUSTOM_FIELDS' => $custom_field_box,
		'REGISTER_ALIGN' => $portal_config['register_a'],
		'S_REGISTER_HIDDEN_FIELDS' => '<input type="hidden" name="viewemail" value="1" checked="checked" /><input type="hidden" name="hideonline" value="0" checked="checked" /><input type="hidden" name="notifyreply" value="0" checked="checked" /><input type="hidden" name="notifypm" value="1" checked="checked" /><input type="hidden" name="popup_pm" value="1" checked="checked" /><input type="hidden" name="attachsig" value="1" checked="checked" /><input type="hidden" name="allowbbcode" value="1" checked="checked" /><input type="hidden" name="allowhtml" value="1" checked="checked" /><input type="hidden" name="allowsmilies" value="1" checked="checked" /><input type="hidden" name="dateformat" value="' . $board_config['default_dateformat'] . '" /><input type="hidden" name="mode" value="register" /><input type="hidden" name="agreed" value="true" /><input type="hidden" name="sid" value="' . $userdata['session_id'] . '"><input type="hidden" name="coppa" value="0" /><input type="hidden" name="przemo_hash" value="'.przemo_create_hash().'" />')
	);

	$template->assign_var_from_handle($module_names['register_menu'], 'register_menu');
}

if ( in_array('clock_menu', $modules) )
{
	$template->set_filenames(array(
		'clock_menu' => 'portal_modules/clock_menu.tpl')
	);
	$template->assign_var_from_handle($module_names['clock_menu'], 'clock_menu');
}

$disable_download = true;
// Its not optimized so we disable it
if ( $board_config['download'] && in_array('download', $modules) && !$disable_download )
{
	$template->set_filenames(array(
		'download' => 'portal_modules/download_menu.tpl')
	);

	include($phpbb_root_path . 'pafiledb/includes/portal_stats.'.$phpEx);

	$template->assign_vars(array(
		'DOWNLOAD_ALIGN' => $portal_config['download_pos'],
		'L_DOWNLOAD_TITLE' => $lang['Downloads2'],
		'STATS_PORTAL' => $lang['Stats_portal'],
		'L_SEE_ALL_DOWNLOADS' => $lang['See_all'])
	);

	$template->assign_var_from_handle($module_names['download'], 'download');
}

if ( $board_config['album_gallery'] && $portal_config['recent_pics'] > 0 && in_array('album_menu', $modules))
{
	include($phpbb_root_path . 'album_portal.'.$phpEx);
}

$where = intval($HTTP_GET_VARS['show']);

if ( $where && file_exists('./portal_page' . $where . '.html') )
{
	if ( !function_exists('file_get_contents') )
	{
		function file_get_contents($filename)
		{
			$file = @fopen($filename, 'rb');
			if ( $file )
			{
				if ( $fsize = @filesize($filename) )
				{
					$data = @fread($file, $fsize);
				}
				else
				{
					$data = '';
					while (!@feof($file))
					{
						$data .= @fread($file, 1024);
					}
				}
				@fclose($file);
			}
			return $data;
		}
	}

	$template->assign_vars(array(
		'OWN_BODY' => file_get_contents('./portal_page' . $where . '.html'),
		'BEGIN_NEWS' => '<!--',
		'END_NEWS' => '-->')
	);
}
else
{
	$template->assign_vars(array(
		'OWN_BODY' => replace_vars($portal_config['own_body']),
		'BEGIN_NEWS' => ($portal_config['own_body']) ? '<!--' : '',
		'END_NEWS' => ($portal_config['own_body']) ? '-->' : '')
	);
}

if ( !$portal_config['module1'] && !$portal_config['module2'] && !$portal_config['module3'] && !$portal_config['module4'] && !$portal_config['module5'] && !$portal_config['module6'] && !$portal_config['module7'] && !$portal_config['module8'] && !$portal_config['module9'] && !$portal_config['module10'] && !$portal_config['module11'] && !$portal_config['module12'] && $portal_config['poll'] != '1' )
{
	$begin_left_panel_off = '<!--';
	$end_left_panel_off = '-->';
}

if ( !$portal_config['module13'] && !$portal_config['module14'] && !$portal_config['module15'] && !$portal_config['module16'] && !$portal_config['module17'] && !$portal_config['module18'] && !$portal_config['module19'] && !$portal_config['module20'] && !$portal_config['module21'] && !$portal_config['module22'] && !$portal_config['module23'] && !$portal_config['module24'] && $portal_config['poll'] != '2' )
{
	$begin_right_panel_off = '<!--';
	$end_right_panel_off = '-->';
}

$template->assign_vars(array(
	'NEWS_HEADER' => ($portal_config['news_forum']) ? replace_vars($portal_config['body_news_forum']) : '',
	'L_FORUM' => $lang['Forum'],
	'L_BOARD_NAVIGATION' => $lang['Board_navigation'],
	'L_ANNOUNCEMENT' => $lang['Post_Announcement'],
	'L_POSTED' => $lang['Author'],
	'L_COMMENTS' => $lang['Comments'],
	'L_VIEW_COMMENTS' => $lang['View_comments'],
	'L_POST_COMMENT' => $lang['Post_your_comment'],
	'L_RECENT_TOPICS' => $lang['Recent_topics'],

	'CURRENT_TIME' => sprintf($lang['Current_time'], create_date($board_config['default_dateformat'], CR_TIME, $board_config['board_timezone'], true)),
	'BEGIN_LEFT_PANEL_OFF' => $begin_left_panel_off,
	'END_LEFT_PANEL_OFF' => $end_left_panel_off,
	'BEGIN_RIGHT_PANEL_OFF' => $begin_right_panel_off,
	'END_RIGHT_PANEL_OFF' => $end_right_panel_off)
);

// Generate the page
if ( !$userdata['session_logged_in'] )
{
	$template->assign_block_vars('logged_out', array());
}
else
{
	$template->assign_block_vars('logged_in', array());
}

$template->pparse('body');

$custom_footer = $portal_config['portal_footer_body'];

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);

?>