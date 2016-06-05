<?php
/***************************************************************************
 *                      album.php
 *                      -------------------
 *  begin               : Tuesday, February 04, 2003
 *  copyright           : (C) 2003 Smartor
 *  email               : smartor_xp@hotmail.com
 *  modification        : (C) 2003 Przemo http://www.przemo.org
 *  date modification   : ver. 1.12.0 2005/10/9 23:24
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

define('IN_PHPBB', true);
$phpbb_root_path = './';
$album_root_path = $phpbb_root_path . 'album_mod/';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);

//
// Start session management
//
$userdata = session_pagestart($user_ip, PAGE_ALBUM);
init_userprefs($userdata);

//
// End session management
//


if ( $board_config['login_require'] && !$userdata['session_logged_in'] )
{
	$message = $lang['login_require'] . '<br /><br />' . sprintf($lang['login_require_register'], '<a href="' . append_sid("profile.$phpEx?mode=register") . '">', '</a>');
	message_die(GENERAL_MESSAGE, $message);
}

//
// Get general album information
//
include($album_root_path . 'album_common.'.$phpEx);

/*
+----------------------------------------------------------
| Build Categories Index
+----------------------------------------------------------
*/

$cat_id = $_POST['c'] ? $_POST['c'] : ( $_GET['c'] ? $_GET['c'] : 0 );
$cat_id = intval($cat_id);
$cat_where = "cat_parent = $cat_id";
 
if ($cat_id != 0)
{
	$sql = "SELECT cat_id,cat_title 
		FROM " . ALBUM_CAT_TABLE . "
		WHERE cat_id = $cat_id";

	if ( $result = $db->sql_query($sql) )
	{
		$row = $db->sql_fetchrow($result);

		$template->assign_vars(array(
			'SUBCAT_NAV' => '-> <a href="album.'.$phpEx.'?c=' . $row['cat_id'] . '" class="nav">' . $row['cat_title'] . '</a>')
		);
	}
}

$sql = "SELECT c.*, COUNT(p.pic_id) AS count
	FROM " . ALBUM_CAT_TABLE . " AS c
	LEFT JOIN " . ALBUM_TABLE . " AS p ON (c.cat_id = p.pic_cat_id)
	WHERE $cat_where
		GROUP BY cat_id
		ORDER BY cat_order ASC";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query categories list', '', __LINE__, __FILE__, $sql);
}

$catrows = array();

while( $row = $db->sql_fetchrow($result) )
{
	$album_user_access = album_user_access($row['cat_id'], $row, 1, 0, 0, 0, 0, 0); // VIEW
	if ($album_user_access['view'] == 1)
	{
		$catrows[] = $row;
	}
}

$allowed_cat = ''; // For Recent Public Pics below

//
// $catrows now stores all categories which this user can view. Dump them out!
//
for ($i = 0; $i < count($catrows); $i++)
{
	// --------------------------------
	// Build allowed category-list (for recent pics after here)
	// --------------------------------

	$allowed_cat .= ($allowed_cat == '') ? $catrows[$i]['cat_id'] : ',' . $catrows[$i]['cat_id'];


	// --------------------------------
	// Build moderators list
	// --------------------------------

	$l_moderators = '';
	$moderators_list = '';

	$grouprows= array();

	if( $catrows[$i]['cat_moderator_groups'] != '')
	{
		// We have usergroup_ID, now we need usergroup name
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

	if( count($grouprows) > 0 )
	{
		$l_moderators = $lang['Moderators'];

		for ($j = 0; $j < count($grouprows); $j++)
		{
			$group_link = '<a href="'. append_sid("groupcp.$phpEx?". POST_GROUPS_URL .'='. $grouprows[$j]['group_id']) .'">'. $grouprows[$j]['group_name'] .'</a>';

			$moderators_list .= ($moderators_list == '') ? $group_link : ', ' . $group_link;
		}
	}


	// ------------------------------------------
	// Get Last Pic of this Category
	// ------------------------------------------

	if ( $catrows[$i]['cat_type'] == 0 )
	{
		if ( $catrows[$i]['count'] == 0 )
		{
			//
			// Oh, this category is empty
			//
			$last_pic_info = $lang['No_Pics'];
			$u_last_pic = '';
			$last_pic_title = '';
		}
		else
		{
			// ----------------------------
			// Check Pic Approval
			// ----------------------------

			if(($catrows[$i]['cat_approval'] == ALBUM_ADMIN) or ($catrows[$i]['cat_approval'] == ALBUM_MOD))
			{
				$pic_approval_sql = 'AND p.pic_approval = 1'; // Pic Approval ON
			}
			else
			{
				$pic_approval_sql = ''; // Pic Approval OFF
			}

			// ----------------------------
			// OK, we may do a query now...
			// ----------------------------

			$sql = "SELECT p.pic_id, p.pic_filename, p.pic_title, p.pic_user_id, p.pic_username, p.pic_time, p.pic_cat_id, u.user_id, u.username
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

			// ----------------------------
			// Write the Date
			// ----------------------------

			$last_pic_info = create_date($board_config['default_dateformat'], $lastrow['pic_time'], $board_config['board_timezone']);

			$last_pic_info .= '<br />';

			// ----------------------------
			// Write username of last poster
			// ----------------------------

			if( ($lastrow['user_id'] == ALBUM_GUEST) or ($lastrow['username'] == '') )
			{
				$last_pic_info .= ($lastrow['pic_username'] == '') ? $lang['Guest'] : $lastrow['pic_username'];
			}
			else
			{
				$last_pic_info .= $lang['Poster'] .': <a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $lastrow['user_id']) .'" class="name">'. $lastrow['username'] .'</a>';
			}

			// ----------------------------
			// Write the last pic's title.
			// Truncate it if it's too long
			// ----------------------------

			if( !isset($album_config['last_pic_title_length']) )
			{
				$album_config['last_pic_title_length'] = 25;
			}

			$lastrow['pic_title'] = $lastrow['pic_title'];

			if (strlen($lastrow['pic_title']) > $album_config['last_pic_title_length'])
			{
				$lastrow['pic_title'] = substr($lastrow['pic_title'], 0, $album_config['last_pic_title_length']) . '...';
			}

			$last_pic_info .= '<br />'. $lang['Pic_Title'] .': <a href="';

			$pic_size = @getimagesize(ALBUM_UPLOAD_PATH . $lastrow['pic_filename']);
			$pic_width = ($pic_size[0] + 20);
			$pic_height = ($pic_size[1] + 25);

			if ( $album_config['fullpic_popup'] )
			{
				$u_pic = append_sid("album_pic.$phpEx?pic_id=". $lastrow['pic_id']);
				if ( $pic_size )
				{
					$u_pic = "javascript:displayWindow('$u_pic',$pic_width,$pic_height)";
				}
				else if ($album_config['fullpic_popup'])
				{
					$target_blank = 'target="_blank"';
				}
			}
			else
			{
				$u_pic = append_sid("album_page.$phpEx?pic_id=". $lastrow['pic_id']);
			}

			$last_pic_info .= '' . $u_pic . '">';

			$last_pic_info .= $lastrow['pic_title'] .'</a>';
		}
		// END of Last Pic
	}
	else
	{
		// this is a parent category
		$sc_sql = "SELECT *
			FROM " . ALBUM_CAT_TABLE . "
			WHERE cat_parent = " . $catrows[$i]['cat_id'] . "
				GROUP BY cat_id
				ORDER BY cat_order ASC";
 
		if ( !($sc_result = $db->sql_query($sc_sql)) )
		{
			message_die(GENERAL_ERROR, 'Could not query sub categories', '', __LINE__, __FILE__, $sql);
		}
 
		$sql_count = "SELECT count(cat_id) as count
			FROM " . ALBUM_CAT_TABLE . "
			WHERE cat_parent = " . $catrows[$i]['cat_id'];
		if ( ($result_count = $db->sql_query($sql_count)) )
		{
			$subcat_count = $db->sql_fetchrow($result_count);
			$subcat_count = $lang['Sub-catagories'] . ': ' . $subcat_count['count'];
		}
		else
		{
			$subcat_count = "";
		}
 
		$subcats = '<br /><span class="gensmall"><b>' . $lang['Sub-catagories'] . ':</b><br />';
		while ( $subcatrow = $db->sql_fetchrow($sc_result) )
		{
			$subcats .= ' - <a href="' . append_sid("album_cat.$phpEx?cat_id=" . $subcatrow['cat_id']) . '" class="gensmall">' . $subcatrow['cat_title'] . '</a><br />';
		}
		$subcats .= '</span><br />';
 
		$template->assign_block_vars('catrow', array(
			'U_VIEW_CAT' => append_sid("album.php?c=" . $catrows[$i]['cat_id']),
			'CAT_TITLE' => $catrows[$i]['cat_title'],
			'CAT_DESC' => $catrows[$i]['cat_desc'],
			'PICS' => $subcat_count,
			'SUBCATS' => $subcats,
			)
		);
	}

	// ------------------------------------------
	// Parse to template the info of the current Category
	// ------------------------------------------
	if ($catrows[$i]['cat_type'] == 0)
	{
	$template->assign_block_vars('catrow', array(
		'U_VIEW_CAT' => append_sid("album_cat.$phpEx?cat_id=". $catrows[$i]['cat_id']),
		'CAT_TITLE' => $catrows[$i]['cat_title'],
		'CAT_DESC' => $catrows[$i]['cat_desc'],
		'L_MODERATORS' => $l_moderators,
		'MODERATORS' => $moderators_list,
		'PICS' => $catrows[$i]['count'],
		'LAST_PIC_INFO' => $last_pic_info)
	);
	}
}
// END of Categories Index

/*
+----------------------------------------------------------
| Recent Public Pics
+----------------------------------------------------------
*/

if ($allowed_cat != '')
{
	$sql = "SELECT p.pic_id, p.pic_filename, p.pic_title, p.pic_desc, p.pic_user_id, p.pic_user_ip, p.pic_username, p.pic_time, p.pic_cat_id, p.pic_view_count, u.user_id, u.username, r.rate_pic_id, AVG(r.rate_point) AS rating, COUNT(DISTINCT c.comment_id) AS comments
			FROM " . ALBUM_TABLE . " AS p
				LEFT JOIN ". USERS_TABLE ." AS u ON (p.pic_user_id = u.user_id)
				LEFT JOIN ". ALBUM_CAT_TABLE ." AS ct ON (p.pic_cat_id = ct.cat_id)
				LEFT JOIN ". ALBUM_RATE_TABLE ." AS r ON (p.pic_id = r.rate_pic_id)
				LEFT JOIN ". ALBUM_COMMENT_TABLE ." AS c ON (p.pic_id = c.comment_pic_id)
			WHERE p.pic_cat_id IN ($allowed_cat) AND ( p.pic_approval = 1 OR ct.cat_approval = 0 )
			GROUP BY p.pic_id
			ORDER BY pic_time DESC
			LIMIT ". $album_config['cols_per_page'];
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query recent pics information', '', __LINE__, __FILE__, $sql);
	}

	$recentrow = array();

	while( $row = $db->sql_fetchrow($result) )
	{
		$recentrow[] = $row;
	}


	if (count($recentrow) > 0)
	{
		for ($i = 0; $i < count($recentrow); $i += $album_config['cols_per_page'])
		{
			$template->assign_block_vars('recent_pics', array());

			for ($j = $i; $j < ($i + $album_config['cols_per_page']); $j++)
			{
				if( $j >= count($recentrow) )
				{
					break;
				}

				if(!$recentrow[$j]['rating'])
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
					if ( $pic_size ) $u_pic = "javascript:displayWindow('$u_pic',$pic_width,$pic_height)";
					else if ($album_config['fullpic_popup']) $target_blank = 'target="_blank"';

				}
				else $u_pic = append_sid("album_page.$phpEx?pic_id=". $recentrow[$j]['pic_id']);

				$template->assign_block_vars('recent_pics.recent_col', array(
					'U_PIC' => $u_pic,
					'THUMBNAIL' => append_sid("album_thumbnail.$phpEx?pic_id=". $recentrow[$j]['pic_id']),
					'DESC' => $recentrow[$j]['pic_desc']
					)
				);

				if( ($recentrow[$j]['user_id'] == ALBUM_GUEST) or ($recentrow[$j]['username'] == '') )
				{
					$recent_poster = ($recentrow[$j]['pic_username'] == '') ? $lang['Guest'] : $recentrow[$j]['pic_username'];
				}
				else
				{
					$recent_poster = '<a href="'. append_sid("profile.$phpEx?mode=viewprofile&amp;". POST_USERS_URL .'='. $recentrow[$j]['user_id']) .'" class="name">'. $recentrow[$j]['username'] .'</a>';
				}

				$template->assign_block_vars('recent_pics.recent_detail', array(
					'TITLE' => $recentrow[$j]['pic_title'],
					'POSTER' => $recent_poster,
					'TIME' => create_date($board_config['default_dateformat'], $recentrow[$j]['pic_time'], $board_config['board_timezone']),

					'VIEW' => $recentrow[$j]['pic_view_count'],

					'RATING' => ($album_config['rate'] == 1) ? ( '<a href="'. append_sid("album_rate.$phpEx?pic_id=". $recentrow[$j]['pic_id']) . '">' . $lang['Rating'] . '</a>: ' . $recentrow[$j]['rating'] . '<br />') : '',

					'COMMENTS' => ($album_config['comment'] == 1) ? ( '<a href="'. append_sid("album_comment.$phpEx?pic_id=". $recentrow[$j]['pic_id']) . '">' . $lang['Comments'] . '</a>: ' . $recentrow[$j]['comments'] . '<br />') : '',

					'IP' => ($userdata['user_level'] == ADMIN) ? '' . $lang['IP_Address'] . ': <a href="' . $board_config['address_whois'] . '' . decode_ip($recentrow[$j]['pic_user_ip']) . '" target="_blank">' . decode_ip($recentrow[$j]['pic_user_ip']) .'</a><br />' : ''
					)
				);
			}
		}
	}
	else
	{
		//
		// No Pics Found
		//
		$template->assign_block_vars('no_pics', array());
	}
}
else
{
	//
	// No Cats Found
	//
	$template->assign_block_vars('no_pics', array());
}

/*
+----------------------------------------------------------
| Start output the page
+----------------------------------------------------------
*/


$page_title = $lang['Album'];
include($phpbb_root_path . 'includes/page_header.'.$phpEx);

$template->set_filenames(array(
	'body' => 'album_index_body.tpl')
);
$template->assign_vars(array(
	'L_CATEGORY' => $lang['Category'],
	'L_PICS' => $lang['Pics'],
	'L_LAST_PIC' => $lang['Last_Pic'],

	'U_YOUR_PERSONAL_GALLERY' => append_sid("album_personal.$phpEx?user_id=". $userdata['user_id']),
	'L_YOUR_PERSONAL_GALLERY' => $lang['Your_Personal_Gallery'],

	'U_USERS_PERSONAL_GALLERIES' => append_sid("album_personal_index.$phpEx"),
	'L_USERS_PERSONAL_GALLERIES' => $lang['Users_Personal_Galleries'],

	'CURRENT_TIME' => sprintf($lang['Current_time'], create_date($board_config['default_dateformat'], CR_TIME, $board_config['board_timezone'], true)),
	'LAST_VISIT_DATE' => sprintf($lang['You_last_visit'], $s_last_visit),
	'S_COLS' => $album_config['cols_per_page'],
	'S_COL_WIDTH' => (100/$album_config['cols_per_page']) . '%',
	'TARGET_BLANK' => $target_blank,
	'L_RECENT_PUBLIC_PICS' => $lang['Recent_Public_Pics'],
	'L_NO_PICS' => $lang['No_Pics'],
	'L_PIC_TITLE' => $lang['Pic_Title'],
	'L_VIEW' => $lang['View'],
	'L_POSTER' => $lang['Poster'],
	'L_POSTED' => $lang['Posted'],
	'L_PUBLIC_CATS' => $lang['Public_Categories'])
);
//
// Generate the page
//
if ($board_config['album_gallery'])
{
	$template->pparse('body');
}

include($phpbb_root_path . 'includes/page_tail.'.$phpEx);


// +----------------------------------------------------+
// | Powered by Photo Album 2.x.x (c) 2002-2003 Smartor |
// +----------------------------------------------------+

?>