<?php
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

//
// Modules should be considered to already have access to the following variables which
// the parser will give out to it:
//
// $return_limit - Control Panel defined number of items to display
// $module_info['name'] - The module name specified in the info.txt file
// $module_info['email'] - The author email
// $module_info['author'] - The author name
// $module_info['version'] - The version
// $module_info['url'] - The author url
// $module_info['dname'] - The directory which the Module resides in
//
// To make the module more compatible, please do not use any functions here
// and put all your code inline to keep from redeclaring functions on accident.
//
// Use $lang['module_name'] for the Modules Name
// (For example, declare it in lang.php: $mod_lang('module_name', 'Top Posting Users');
// In lang.php the format to describe Language Variables is $mod_lang... but
// within the module.php just use $lang['something'] as you would do in any other script
// within phpBB2.
//

//
// All your code
//

//
// Age Statistics
//
if (!$statistics->result_cache_used)
{
	// Init Cache -- tells the Stats Mod that we want to use the result cache
	$result_cache->init_result_cache();

	// Young!
	$sql = "SELECT max(user_birthday) as max
		FROM " . USERS_TABLE . "
		WHERE user_birthday <> 999999
			AND user_id > 0";

	$result = $db->sql_query($sql);
	if ( !$result )
	{
		message_die(GENERAL_ERROR, "Could not find posts.", "",__LINE__, __FILE__, $sql);
	}
	$usermax = $db->sql_fetchrow($result);
	$poster_max = realdate('Y', (CR_TIME / 86400) ) - realdate ('Y', $usermax['max']);
	if ( date('md') < realdate('md',$usermax['max']) ) $poster_max--;

	$sql = "SELECT user_id,username
		FROM " . USERS_TABLE . "
		WHERE user_birthday = " . $usermax['max'];

	$result = $db->sql_query($sql);
	if ( !$result )
	{
	//	  message_die(GENERAL_ERROR, "Could not find posts.", "",__LINE__, __FILE__, $sql);
	}
	$usermaxid = $db->sql_fetchrow($result);

	// Old!
	$sql = "SELECT min(user_birthday) as min
		FROM " . USERS_TABLE . "
		WHERE user_birthday <> 999999";

	$result = $db->sql_query($sql);
	if ( !$result )
	{
		message_die(GENERAL_ERROR, "Could not find posts.", "",__LINE__, __FILE__, $sql);
	}
	$usermin = $db->sql_fetchrow($result);
	$poster_min = realdate('Y', (CR_TIME/86400)) - realdate ('Y',$usermin['min']);
	if (date('md')<realdate('md',$usermin['min'])) $poster_min--;

	$sql = "SELECT user_id,username
			FROM " . USERS_TABLE . "
			WHERE user_birthday =". $usermin['min'];

	$result = $db->sql_query($sql);
	if ( !$result )
	{
	//	  message_die(GENERAL_ERROR, "Could not find users.", "",__LINE__, __FILE__, $sql);
	}
	$userminid = $db->sql_fetchrow($result);

	$sql = "SELECT count(*) as pcount
			FROM " . USERS_TABLE . " u
			WHERE u.user_birthday <> 999999
				AND user_id > 0";

	$result = $db->sql_query($sql);
	if ( !$result )
	{
		message_die(GENERAL_ERROR, "Could not find users.", "",__LINE__, __FILE__, $sql);
	}
	$usercount = $db->sql_fetchrow($result);
	$sum_age = 0;


	$sql = "SELECT user_birthday
		FROM " . USERS_TABLE . " u
		WHERE u.user_birthday <> 999999
			AND user_id <> " . ANONYMOUS;
	$result = $db->sql_query($sql);
	if ( !$result )
	{
		message_die(GENERAL_ERROR, "Could not find posts.", "",__LINE__, __FILE__, $sql);
	}

	while( $row = $db->sql_fetchrow($result) )
	{
		$poster_age = realdate('Y', (CR_TIME/86400)) - realdate ('Y', $row['user_birthday']);
		if (date('md') < realdate('md', $row['user_birthday'])) $poster_age--;
		$sum_age = $sum_age + $poster_age;
	}

	$usermax = "<a href=". append_sid($phpbb_root_path . 'profile.php?mode=viewprofile&amp;u=' . $usermaxid['user_id']) .">". $usermaxid['username'] ."</a>";
	$usermin = "<a href=". append_sid($phpbb_root_path . 'profile.php?mode=viewprofile&amp;u=' . $userminid['user_id']) .">". $userminid['username'] ."</a>";

	$statistic_array = array($lang['Users_Age'],$lang['Average_Age'],$lang['Youngest_Member'],$lang['Youngest_Age'],$lang['Oldest_Member'],$lang['Oldest_Age']);
	@$value_array = array($usercount['pcount'],round($sum_age/$usercount['pcount'],2),$usermax,$poster_max,$usermin,$poster_min);

	for ($i = 0; $i < count($statistic_array); $i += 2)
	{
		$template->assign_block_vars('agerow', array(
			'STATISTIC' => $statistic_array[$i],
			'VALUE' => $value_array[$i],
			'STATISTIC2' => (isset($statistic_array[$i+1])) ? $statistic_array[$i + 1] : '',
			'VALUE2' => (isset($value_array[$i+1])) ? $value_array[$i + 1] : '')
		);
		$result_cache->assign_template_block_vars('agerow');
	}
}
else
{
	// Now use the result cache, with block_num_vars we are getting the number of variables within the block
	for ($i = 0; $i < $result_cache->block_num_vars('agerow'); $i++)
	{
		$template->assign_block_vars('agerow', $result_cache->get_block_array('agerow', $i));
	}

}


$template->assign_vars(array(
	'L_AGE_STATISTICS' => $lang['module_name'],
	'L_STATISTIC' => $lang['Statistic'],
	'L_VALUE' => $lang['Value'])
);

?>