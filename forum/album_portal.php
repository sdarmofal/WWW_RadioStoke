<?php
/***************************************************************************
 *                      album_portal.php
 *                      ------------------
 *  begin               : Tuesday, February 04, 2003
 *  copyright           : (C) 2003 Smartor
 *  email               : smartor_xp@hotmail.com
 *  modification        : (C) 2003 Przemo http://www.przemo.org
 *  date modification   : ver. 1.12.0 2005/10/9 23:44
 *
 *  $Id: album.php,v 2.0.7 2003/03/15 10:16:30 ngoctu Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($album_root_path . 'album_common.'.$phpEx);

$sql = "SELECT c.*, COUNT(p.pic_id) AS count
	FROM " . ALBUM_CAT_TABLE . " AS c
		LEFT JOIN " . ALBUM_TABLE . " AS p ON (c.cat_id = p.pic_cat_id)
	WHERE cat_id <> 0
	GROUP BY cat_id
	ORDER BY cat_order ASC";
if ( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
}

$catrows = array();

while( $row = $db->sql_fetchrow($result) )
{
	$catrows[] = $row;
}

$allowed_cat = '';

// $catrows now stores all categories which this user can view. Dump them out!
for ($i = 0; $i < count($catrows); $i++)
{
	$allowed_cat .= ($allowed_cat == '') ? $catrows[$i]['cat_id'] : ',' . $catrows[$i]['cat_id'];
	$l_moderators = '';
	$moderators_list = '';

	$grouprows= array();

	if ( $catrows[$i]['cat_moderator_groups'] != '' )
	{
		$sql = "SELECT group_id, group_name
			FROM " . GROUPS_TABLE . "
			WHERE group_single_user <> 1
			AND group_type <> ". GROUP_HIDDEN ."
			AND group_id IN (". $catrows[$i]['cat_moderator_groups'] .")
			ORDER BY group_name ASC";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not obtain usergroups data', '', __LINE__, __FILE__, $sql);
		}

		while( $row = $db->sql_fetchrow($result) )
		{
			$grouprows[] = $row;
		}
	}

	if ( count($grouprows) > 0 )
	{
		$l_moderators = $lang['Moderators'];

		for ($j = 0; $j < count($grouprows); $j++)
		{
			$group_link = '<a href="'. append_sid("groupcp.$phpEx?". POST_GROUPS_URL .'='. $grouprows[$j]['group_id']) .'">'. $grouprows[$j]['group_name'] .'</a>';

			$moderators_list .= ($moderators_list == '') ? $group_link : ', ' . $group_link;
		}
	}

	// Get Last Pic of this Category
	if ( $catrows[$i]['count'] == 0 )
	{
		$last_pic_info = $lang['No_Pics'];
		$u_last_pic = '';
		$last_pic_title = '';
	}
	else
	{
		// Check Pic Approval
		if ( ($catrows[$i]['cat_approval'] == ALBUM_ADMIN) or ($catrows[$i]['cat_approval'] == ALBUM_MOD) )
		{
			$pic_approval_sql = 'AND p.pic_approval = 1';
		}
		else
		{
			$pic_approval_sql = '';
		}

		// OK, we may do a query now...
		$sql = "SELECT p.pic_id, p.pic_title, p.pic_user_id, p.pic_username, p.pic_time, p.pic_cat_id, u.user_id, u.username
			FROM " . ALBUM_TABLE . " AS p
				LEFT JOIN " . USERS_TABLE . " AS u ON (p.pic_user_id = u.user_id)
			WHERE p.pic_cat_id = '". $catrows[$i]['cat_id'] ."' $pic_approval_sql
			ORDER BY p.pic_time DESC
			LIMIT 1";
		if ( !$result = $db->sql_query($sql) )
		{
			message_die(GENERAL_ERROR, 'Could not get last pic information', '', __LINE__, __FILE__, $sql);
		}
		$lastrow = $db->sql_fetchrow($result);

		$last_pic_info = create_date($board_config['default_dateformat'], $lastrow['pic_time'], $board_config['board_timezone']);
		$last_pic_info .= '<br />';


		// Write username of last poster
		if ( ($lastrow['user_id'] == ALBUM_GUEST) or ($lastrow['username'] == '') )
		{
			$last_pic_info .= ($lastrow['pic_username'] == '') ? $lang['Guest'] : $lastrow['pic_username'];
		}
		else
		{
			$last_pic_info .= $lang['Poster'] .': <a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $lastrow['user_id']) .'">'. $lastrow['username'] .'</a>';
		}

		// Write the last pic's title. Truncate it if it's too long
		if ( !isset($album_config['last_pic_title_length']) )
		{
			$album_config['last_pic_title_length'] = 25;
		}

		$lastrow['pic_title'] = $lastrow['pic_title'];

		if (strlen($lastrow['pic_title']) > $album_config['last_pic_title_length'])
		{
			$lastrow['pic_title'] = substr($lastrow['pic_title'], 0, $album_config['last_pic_title_length']) . '...';
		}

		$last_pic_info .= '<br />'. $lang['Pic_Title'] .': <a href="';

		$last_pic_info .= ($album_config['fullpic_popup']) ? append_sid("album_pic.$phpEx?pic_id=". $lastrow['pic_id']) .'" target="_blank">' : append_sid("album_page.$phpEx?pic_id=". $lastrow['pic_id']) .'">' ;

		$last_pic_info .= $lastrow['pic_title'] .'</a>';
	}
}

if ( $portal_config['recent_pics'] < 2 )
{
	$lang_last_pics = $lang['Last_Pic'];
}
else
{
	$lang_last_pics = $lang['Recent_Public_Pics'];
}

if ( $allowed_cat != '' )
{
	$sql = "SELECT p.pic_id, pic_filename, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
		FROM " . ALBUM_TABLE . " AS p
			LEFT JOIN " . USERS_TABLE . " AS u ON (p.pic_user_id = u.user_id)
			LEFT JOIN " . ALBUM_CAT_TABLE . " AS ct ON (p.pic_cat_id = ct.cat_id)
			LEFT JOIN " . ALBUM_RATE_TABLE . " AS r ON (p.pic_id = r.rate_pic_id)
			LEFT JOIN " . ALBUM_COMMENT_TABLE . " AS c ON (p.pic_id = c.comment_pic_id)
		WHERE p.pic_cat_id IN ($allowed_cat) AND p.pic_approval = 1 OR ct.cat_approval = 0
		GROUP BY p.pic_id
		ORDER BY pic_time DESC
		LIMIT ". $portal_config['recent_pics'];
	if ( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query recent pics information', '', __LINE__, __FILE__, $sql);
	}

	$recentrow = array();

	while( $row = $db->sql_fetchrow($result) )
	{
		$recentrow[] = $row;
	}

	if ( count($recentrow) > 0 )
	{
		$template->assign_vars(array(
			'L_POSTER' => $lang['Poster'],
			'L_RATING' => $lang['Rating'],
			'L_COMMENTS' => $lang['Comments'],
			'ALBUM_ALIGN' => $portal_config['album_pos'],
			'L_LAST_PIC' => $lang_last_pics)
		);

		for ($i = 0; $i < count($recentrow); $i += $album_config['cols_per_page'])
		{
			for ($j = $i; $j < ($i + $album_config['cols_per_page']); $j++)
			{
				if ( $j >= count($recentrow) )
				{
					break;
				}

				if ( !$recentrow[$j]['rating'] )
				{
					$recentrow[$j]['rating'] = $lang['Not_rated'];
				}
				else
				{
					$recentrow[$j]['rating'] = round($recentrow[$j]['rating'], 2);
				}

				$pic_size = @getimagesize(ALBUM_UPLOAD_PATH . $recentrow[$j]['pic_filename']);
				$pic_width = ($pic_size[0] + 20);
				$pic_height = ($pic_size[1] + 25);

				if ( $album_config['fullpic_popup'] )
				{
					$u_pic = append_sid("album_pic.$phpEx?pic_id=". $recentrow[$j]['pic_id']);
					if ( $pic_size )
					{
						$u_pic = "javascript:displayWindow('$u_pic',$pic_width,$pic_height)";
					}
					else if ( $album_config['fullpic_popup'] )
					{
						$target_blank = ' target="_blank"';
					}
					else
					{
						$target_blank = '';
					}
				}
				else
				{
					$u_pic = append_sid("album_page.$phpEx?pic_id=". $recentrow[$j]['pic_id']);
				}

				if ( ($recentrow[$j]['user_id'] == ALBUM_GUEST) or ($recentrow[$j]['username'] == '') )
				{
					$recent_poster = ($recentrow[$j]['pic_username'] == '') ? $lang['Guest'] : $recentrow[$j]['pic_username'];
				}
				else
				{
					$recent_poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $recentrow[$j]['user_id']) .'">'. $recentrow[$j]['username'] .'</a>';
				}

				$template->assign_block_vars('album_pics', array(
					'PIC_TITLE' => $recentrow[$j]['pic_title'],
					'PIC_SRC' => $u_pic,
					'TARGET_B' => $target_blank,
					'PIC_DESC' => $recentrow[$j]['pic_desc'],
					'PIC_THUMB' => append_sid("album_thumbnail.$phpEx?pic_id=" . $recentrow[$j]['pic_id']),
					'RECENT_POSTER' => $recent_poster,
					'PIC_DATE' => create_date($board_config['default_dateformat'], $recentrow[$j]['pic_time'], $board_config['board_timezone']),
					'RATE_URL' => append_sid("album_rate.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
					'RATING' => $recentrow[$j]['rating'],
					'COMMENT_URL' => append_sid("album_comment.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
					'COMMENTS' => $recentrow[$j]['comments'])
				);
			}
		}
		$template->set_filenames(array(
			'album_menu' => 'portal_modules/album_menu.tpl')
		);
		$template->assign_var_from_handle($module_names['album_menu'], 'album_menu');
	}
}

?>