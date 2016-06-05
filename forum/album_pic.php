<?php
/***************************************************************************
 *                               album_pic.php
 *                            -------------------
 *   begin                : Wednesday, February 05, 2003
 *   copyright            : (C) 2003 Smartor
 *   email                : smartor_xp@hotmail.com
 *
 *   $Id: album_pic.php,v 2.0.5 2003/02/28 14:33:12 ngoctu Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
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

include($album_root_path . 'album_common.'.$phpEx);

if( isset($HTTP_GET_VARS['pic_id']) )
{
	$pic_id = intval($HTTP_GET_VARS['pic_id']);
}
else if( isset($HTTP_POST_VARS['pic_id']) )
{
	$pic_id = intval($HTTP_POST_VARS['pic_id']);
}
else
{
	die('No pics specified');
}


// ------------------------------------
// Get this pic info
// ------------------------------------

$sql = "SELECT *
	FROM ". ALBUM_TABLE ."
	WHERE pic_id = '$pic_id'";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not query pic information', '', __LINE__, __FILE__, $sql);
}
$thispic = $db->sql_fetchrow($result);

$cat_id = $thispic['pic_cat_id'];
$user_id = $thispic['pic_user_id'];

$pic_filetype = substr($thispic['pic_filename'], strlen($thispic['pic_filename']) - 4, 4);
$pic_filename = $thispic['pic_filename'];
$pic_thumbnail = $thispic['pic_thumbnail'];

if( empty($thispic) or !file_exists(ALBUM_UPLOAD_PATH . $pic_filename) )
{
	die($lang['Pic_not_exist']);
}


// ------------------------------------
// Get the current Category Info
// ------------------------------------

if ($cat_id != 0)
{
	$sql = "SELECT *
		FROM ". ALBUM_CAT_TABLE ."
		WHERE cat_id = '$cat_id'";
	if( !($result = $db->sql_query($sql)) )
	{
		message_die(GENERAL_ERROR, 'Could not query category information', '', __LINE__, __FILE__, $sql);
	}

	$thiscat = $db->sql_fetchrow($result);
}
else
{
	$thiscat = init_personal_gallery_cat($user_id);
}

if (empty($thiscat))
{
	die($lang['Category_not_exist']);
}


// ------------------------------------
// Check the permissions
// ------------------------------------

$album_user_access = album_user_access($cat_id, $thiscat, 1, 0, 0, 0, 0, 0); // VIEW
if ($album_user_access['view'] == 0)
{
	die($lang['Not_Authorised']);
}


// ------------------------------------
// Check Pic Approval
// ------------------------------------

if ($userdata['user_level'] != ADMIN)
{
	if( ($thiscat['cat_approval'] == ADMIN) or (($thiscat['cat_approval'] == MOD) and !$album_user_access['moderator']) )
	{
		if ($thispic['pic_approval'] != 1)
		{
			die($lang['Not_Authorised']);
		}
	}
}


// ------------------------------------
// Check hotlink
// ------------------------------------

if( ($album_config['hotlink_prevent'] == 1) and (isset($HTTP_SERVER_VARS['HTTP_REFERER'])) )
{
	$check_referer = explode('?', $HTTP_SERVER_VARS['HTTP_REFERER']);
	$check_referer = trim($check_referer[0]);

	$good_referers = array();

	if ($album_config['hotlink_allowed'] != '')
	{
		$good_referers = explode(',', $album_config['hotlink_allowed']);
	}

	$good_referers[] = $board_config['server_name'] . $board_config['script_path'];

	$errored = TRUE;

	for ($i = 0; $i < count($good_referers); $i++)
	{
		$good_referers[$i] = trim($good_referers[$i]);

		if( (strstr($check_referer, $good_referers[$i])) and ($good_referers[$i] != '') )
		{
			$errored = FALSE;
		}
	}

	if ($errored)
	{
		die($lang['Not_Authorised']);
	}
}


/*
+----------------------------------------------------------
| Main work here...
+----------------------------------------------------------
*/


// ------------------------------------
// Increase view counter
// ------------------------------------

$sql = "UPDATE ". ALBUM_TABLE ."
		SET pic_view_count = pic_view_count + 1
		WHERE pic_id = '$pic_id'";
if( !($result = $db->sql_query($sql)) )
{
	message_die(GENERAL_ERROR, 'Could not update pic information', '', __LINE__, __FILE__, $sql);
}


// ------------------------------------
// Okay, now we can send image to the browser
// ------------------------------------

$image_type = '';
switch ( $pic_filetype )
{
	case '.png':
		$image_type = 'png';
		header('Content-type: image/png');
		break;

	case '.gif':
		$image_type = 'gif';
		header('Content-type: image/gif');

		break;
	case '.jpg':
		$image_type = 'jpeg';
		header('Content-type: image/jpeg');

		break;
	default:
		die('The filename data in the DB was corrupted');
}

if ( $album_config['watermark_transparent'] )
{
	$image_create_function = 'imagecreatefrom' . $image_type;
	$target_image = $image_create_function(ALBUM_UPLOAD_PATH . $thispic['pic_filename']);
	$target_width = imageSX($target_image);
	$target_height = imageSY($target_image);

	$watermark_image = imageCreateFromPNG($phpbb_root_path . 'images/wm.png');

	$watermark_width = imageSX($watermark_image);
	$watermark_height = imageSY($watermark_image);

	if ( $album_config['watermark_width'] == 'mid' )
	{
		$pos_x = $target_width / 2 -($watermark_width/2);
	}
	else
	{
		$pos_x = ($album_config['watermark_width'] < 0) ? $target_width - $watermark_width + intval($album_config['watermark_width']) : $album_config['watermark_width'];
	}
	if ( $album_config['watermark_height'] == 'mid' )
	{
		$pos_y = $target_height / 2 -($watermark_height/2);
	}
	else
	{
		$pos_y = ($album_config['watermark_height'] < 0) ? $target_height - $watermark_height + intval($album_config['watermark_height']) : $album_config['watermark_height'];
	}

	imageCopyMerge($target_image, $watermark_image, $pos_x, $pos_y, 0, 0, $watermark_width, $watermark_height, (($album_config['watermark_transparent']) ? $album_config['watermark_transparent'] : 50));

	if ( $image_type == 'jpeg' )
	{
		Imagejpeg($target_image, '', 86);
	}
	else if ( $image_type == 'gif' )
	{
		Imagegif($target_image);
	}
	else
	{
		Imagepng($target_image);
	}
	ImageDestroy($target_image);
	exit;
}

album_readfile(ALBUM_UPLOAD_PATH . $thispic['pic_filename']);

exit;

?>