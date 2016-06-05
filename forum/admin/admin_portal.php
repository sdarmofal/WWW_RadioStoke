<?php
/***************************************************************************
 *                      admin_portal.php
 *                      -------------------
 *   begin              : 2004/04/14
 *   copyright          : (C) 2003 Przemo http://www.przemo.org
 *   email				: przemo@przemo.org
 *
 ***************************************************************************/
define('MODULE_ID', 2);
define('IN_PHPBB', 1);

if ( !empty($setmodules) )
{
	$file = basename(__FILE__);
	$module['General']['portal_config'] = "$file?mode=config";
	return;
}

// Let's set the root dir for phpBB
$phpbb_root_path = "./../";
require($phpbb_root_path . 'extension.inc');
require('./pagestart.' . $phpEx);
include($phpbb_root_path . 'includes/functions_selects.'.$phpEx);
include($phpbb_root_path . 'language/lang_' . $board_config['default_lang'] . '/lang_portal.' . $phpEx);

// Pull all config data
if(empty($portal_config))
{
    $portal_config = array();
    $sql = "SELECT * FROM " . PORTAL_CONFIG_TABLE;
    if ( !$result = $db->sql_query($sql) )
    {
        message_die(CRITICAL_ERROR, "Could not query portal config information in admin_portal", "", __LINE__, __FILE__, $sql);
    }
    while( $row = $db->sql_fetchrow($result) )
    {
        $portal_config[$row['config_name']] = $row['config_value'];
    }
}

$clear_cache = false;
foreach( $portal_config as $config_name => $config_value)
{
    $new[$config_name] = get_vars($config_name, $config_value, 'POST', '', 1);

    if ( isset($HTTP_POST_VARS['submit']) )
    {
        if ( ($config_name == 'witch_poll_forum' || $config_name == 'witch_news_forum') && is_array($new[$config_name]) )
        {
            $f_forums_id = array();
            for($i = 0; $i < count($new[$config_name]); $i++)
            {
                if ( $new[$config_name][$i] && @$new[$config_name][$i]{0} == POST_FORUM_URL )
                {
                    $f_forums_id[] = substr($new[$config_name][$i], 1);
                }
            }
            $new[$config_name] = implode(',', $f_forums_id);
        }

        $new_value = str_replace("\'", "''", $new[$config_name]);
        if($new_value != $config_value)
        {
            $sql = "UPDATE " . PORTAL_CONFIG_TABLE . " SET config_value = '".$new_value."' WHERE config_name = '$config_name'";
            if ( !$db->sql_query($sql) ){
                message_die(GENERAL_ERROR, "Failed to update general configuration for $config_name", "", __LINE__, __FILE__, $sql);
            }
            $clear_cache = true;
        }
    }

    $list_html_forms = array(
        'body_news_forum',
        'portal_header_body',
        'portal_footer_body',
        'own_body',
        'custom_address1',
        'custom_address2',
        'custom_address3',
        'custom_address4',
        'custom_address5',
        'custom_address6',
        'custom_address7',
        'custom_address8',
        'custom1_body',
        'custom2_body',
        'blank1_body',
        'blank2_body',
        'blank3_body',
        'blank4_body',
        'links_body'
    );

    if(in_array($config_name, $list_html_forms))
    {
        $new[$config_name] = xhtmlspecialchars($new[$config_name]);
    }
}

if ( $clear_cache )
{
    sql_cache('clear', 'portal_config');
}

if ( isset($HTTP_POST_VARS['submit']) )
{
    $message = $lang['Config_portal_updated'] . "<br /><br />" . sprintf($lang['Click_return_portal_config'], "<a href=\"" . append_sid("admin_portal.$phpEx") . "\">", "</a>") . "<br /><br />" . sprintf($lang['Click_return_admin_index'], "<a href=\"" . append_sid("index.$phpEx?pane=right") . "\">", "</a>");
    message_die(GENERAL_MESSAGE, $message);
}

$list_modules = array('poll_menu', 'portal_menu', 'download', 'album_menu', 'info_menu', 'recent_topics_menu', 'top_posters_menu', 'stats_user_menu', 'whoonline_menu', 'search_menu', 'login_menu', 'register_menu', 'links_menu', 'birthday_menu', 'chat_menu', 'clock_menu', 'custom_module1', 'custom_module2', 'blank_module1', 'blank_module2', 'blank_module3', 'blank_module4', '');

$lang_modules = array($lang['Poll'], $lang['Board_navigation'], $lang['Downloads2'], $lang['album_pics'], $lang['info_menu'], $lang['Recent_topics'], $lang['top_posters'], $lang['stats_user'], $lang['Who_is_Online'], $lang['Search'], $lang['login'], $lang['Quick_register'], $lang['links'], $lang['Today'], $lang['Who_is_Chatting'], $lang['clock'], $lang['custom_mod'] . ' 1', $lang['custom_mod'] . ' 2', $lang['custom_blank_mod'] . ' 1', $lang['custom_blank_mod'] . ' 2', $lang['custom_blank_mod'] . ' 3', $lang['custom_blank_mod'] . ' 4', $lang['blank'], );

$portal_on_yes = ( $new['portal_on'] ) ? "checked=\"checked\"" : "";
$portal_on_no = ( !$new['portal_on'] ) ? "checked=\"checked\"" : "";

$link_logo_yes = ( $new['link_logo'] ) ? "checked=\"checked\"" : "";
$link_logo_no = ( !$new['link_logo'] ) ? "checked=\"checked\"" : "";

$own_header_yes = ( $new['own_header'] ) ? "checked=\"checked\"" : "";
$own_header_no = ( !$new['own_header'] ) ? "checked=\"checked\"" : "";

$news_forum_yes = ( $new['news_forum'] ) ? "checked=\"checked\"" : "";
$news_forum_no = ( !$new['news_forum'] ) ? "checked=\"checked\"" : "";

$poll_left = ( $new['poll'] == "1" ) ? "checked=\"checked\"" : "";
$poll_none = ( $new['poll'] == "0" ) ? "checked=\"checked\"" : "";
$poll_right = ( $new['poll'] == "2" ) ? "checked=\"checked\"" : "";

$download_pos_left = ( $new['download_pos'] == "left" ) ? "checked=\"checked\"" : "";
$download_pos_center = ( $new['download_pos'] == "center" ) ? "checked=\"checked\"" : "";
$download_pos_right = ( $new['download_pos'] == "right" ) ? "checked=\"checked\"" : "";

$portal_menu_a_left = ( $new['portal_menu_a'] == "left" ) ? "checked=\"checked\"" : "";
$portal_menu_a_center = ( $new['portal_menu_a'] == "center" ) ? "checked=\"checked\"" : "";
$portal_menu_a_right = ( $new['portal_menu_a'] == "right" ) ? "checked=\"checked\"" : "";

$album_pos_left = ( $new['album_pos'] == "left" ) ? "checked=\"checked\"" : "";
$album_pos_center = ( $new['album_pos'] == "center" ) ? "checked=\"checked\"" : "";
$album_pos_right = ( $new['album_pos'] == "right" ) ? "checked=\"checked\"" : "";

$links_a_left = ( $new['links_a'] == "left" ) ? "checked=\"checked\"" : "";
$links_a_center = ( $new['links_a'] == "center" ) ? "checked=\"checked\"" : "";
$links_a_right = ( $new['links_a'] == "right" ) ? "checked=\"checked\"" : "";

$links_a2_left = ( $new['links_a2'] == "left" ) ? "checked=\"checked\"" : "";
$links_a2_center = ( $new['links_a2'] == "center" ) ? "checked=\"checked\"" : "";
$links_a2_right = ( $new['links_a2'] == "right" ) ? "checked=\"checked\"" : "";

$search_a_left = ( $new['search_a'] == "left" ) ? "checked=\"checked\"" : "";
$search_a_center = ( $new['search_a'] == "center" ) ? "checked=\"checked\"" : "";
$search_a_right = ( $new['search_a'] == "right" ) ? "checked=\"checked\"" : "";

$stat_a_left = ( $new['stat_a'] == "left" ) ? "checked=\"checked\"" : "";
$stat_a_center = ( $new['stat_a'] == "center" ) ? "checked=\"checked\"" : "";
$stat_a_right = ( $new['stat_a'] == "right" ) ? "checked=\"checked\"" : "";

$recent_topics_a_left = ( $new['recent_topics_a'] == "left" ) ? "checked=\"checked\"" : "";
$recent_topics_a_center = ( $new['recent_topics_a'] == "center" ) ? "checked=\"checked\"" : "";
$recent_topics_a_right = ( $new['recent_topics_a'] == "right" ) ? "checked=\"checked\"" : "";

$top_posters_a_left = ( $new['top_posters_a'] == "left" ) ? "checked=\"checked\"" : "";
$top_posters_a_center = ( $new['top_posters_a'] == "center" ) ? "checked=\"checked\"" : "";
$top_posters_a_right = ( $new['top_posters_a'] == "right" ) ? "checked=\"checked\"" : "";

$custom1_body_a_left = ( $new['custom1_body_a'] == "left" ) ? "checked=\"checked\"" : "";
$custom1_body_a_center = ( $new['custom1_body_a'] == "center" ) ? "checked=\"checked\"" : "";
$custom1_body_a_right = ( $new['custom1_body_a'] == "right" ) ? "checked=\"checked\"" : "";

$custom2_body_a_left = ( $new['custom2_body_a'] == "left" ) ? "checked=\"checked\"" : "";
$custom2_body_a_center = ( $new['custom2_body_a'] == "center" ) ? "checked=\"checked\"" : "";
$custom2_body_a_right = ( $new['custom2_body_a'] == "right" ) ? "checked=\"checked\"" : "";

$links1_yes = ( $new['links1'] ) ? "checked=\"checked\"" : "";
$links1_no = ( !$new['links1'] ) ? "checked=\"checked\"" : "";

$links2_yes = ( $new['links2'] ) ? "checked=\"checked\"" : "";
$links2_no = ( !$new['links2'] ) ? "checked=\"checked\"" : "";

$links3_yes = ( $new['links3'] ) ? "checked=\"checked\"" : "";
$links3_no = ( !$new['links3'] ) ? "checked=\"checked\"" : "";

$links4_yes = ( $new['links4'] ) ? "checked=\"checked\"" : "";
$links4_no = ( !$new['links4'] ) ? "checked=\"checked\"" : "";

$links5_yes = ( $new['links5'] ) ? "checked=\"checked\"" : "";
$links5_no = ( !$new['links5'] ) ? "checked=\"checked\"" : "";

$links6_yes = ( $new['links6'] ) ? "checked=\"checked\"" : "";
$links6_no = ( !$new['links6'] ) ? "checked=\"checked\"" : "";

$links7_yes = ( $new['links7'] ) ? "checked=\"checked\"" : "";
$links7_no = ( !$new['links7'] ) ? "checked=\"checked\"" : "";

$links8_yes = ( $new['links8'] ) ? "checked=\"checked\"" : "";
$links8_no = ( !$new['links8'] ) ? "checked=\"checked\"" : "";

$blank1_body_on_yes = ( $new['blank1_body_on'] ) ? "checked=\"checked\"" : "";
$blank1_body_on_no = ( !$new['blank1_body_on'] ) ? "checked=\"checked\"" : "";

$blank2_body_on_yes = ( $new['blank2_body_on'] ) ? "checked=\"checked\"" : "";
$blank2_body_on_no = ( !$new['blank2_body_on'] ) ? "checked=\"checked\"" : "";

$blank3_body_on_yes = ( $new['blank3_body_on'] ) ? "checked=\"checked\"" : "";
$blank3_body_on_no = ( !$new['blank3_body_on'] ) ? "checked=\"checked\"" : "";

$blank4_body_on_yes = ( $new['blank4_body_on'] ) ? "checked=\"checked\"" : "";
$blank4_body_on_no = ( !$new['blank4_body_on'] ) ? "checked=\"checked\"" : "";

$birthday_a_left = ( $new['birthday_a'] == "left" ) ? "checked=\"checked\"" : "";
$birthday_a_center = ( $new['birthday_a'] == "center" ) ? "checked=\"checked\"" : "";
$birthday_a_right = ( $new['birthday_a'] == "right" ) ? "checked=\"checked\"" : "";

$info_a_left = ( $new['info_a'] == "left" ) ? "checked=\"checked\"" : "";
$info_a_center = ( $new['info_a'] == "center" ) ? "checked=\"checked\"" : "";
$info_a_right = ( $new['info_a'] == "right" ) ? "checked=\"checked\"" : "";

$login_a_left = ( $new['login_a'] == "left" ) ? "checked=\"checked\"" : "";
$login_a_center = ( $new['login_a'] == "center" ) ? "checked=\"checked\"" : "";
$login_a_right = ( $new['login_a'] == "right" ) ? "checked=\"checked\"" : "";

$whoonline_a_left = ( $new['whoonline_a'] == "left" ) ? "checked=\"checked\"" : "";
$whoonline_a_center = ( $new['whoonline_a'] == "center" ) ? "checked=\"checked\"" : "";
$whoonline_a_right = ( $new['whoonline_a'] == "right" ) ? "checked=\"checked\"" : "";

$chat_a_left = ( $new['chat_a'] == "left" ) ? "checked=\"checked\"" : "";
$chat_a_center = ( $new['chat_a'] == "center" ) ? "checked=\"checked\"" : "";
$chat_a_right = ( $new['chat_a'] == "right" ) ? "checked=\"checked\"" : "";

$register_a_left = ( $new['register_a'] == "left" ) ? "checked=\"checked\"" : "";
$register_a_center = ( $new['register_a'] == "center" ) ? "checked=\"checked\"" : "";
$register_a_right = ( $new['register_a'] == "right" ) ? "checked=\"checked\"" : "";



$template->set_filenames(array(
	"body" => "admin/portal_config_body.tpl")
);

// Escape any quotes in the site description for proper display in the text
// box on the admin page 

$template->assign_vars(array(
	"L_GENERAL_PORTAL_SETTINGS" => $lang['General_Portal_settings'],
	"L_YES" => $lang['Yes'],
	"L_NO" => $lang['No'],
	"L_CONFIGURATION_PORTAL_TITLE" => $lang['General_Portal_Config'],
	"L_CONFIGURATION_PORTAL_E" => $lang['Config_Portal_e'],
	"L_SUBMIT" => $lang['Submit'],
	"L_RESET" => $lang['Reset'],
	"PORTAL_ON_YES" => $portal_on_yes,
	"PORTAL_ON_NO" => $portal_on_no,
	"LINK_LOGO_YES" => $link_logo_yes,
	"LINK_LOGO_NO" => $link_logo_no,
	"OWN_HEADER_YES" => $own_header_yes,
	"OWN_HEADER_NO" => $own_header_no,
	"PORTAL_HEADER_BODY" => $new['portal_header_body'],
	"PORTAL_FOOTER_BODY" => $new['portal_footer_body'],
	"OWN_BODY" => $portal_config['own_body'],
	"NEWS_FORUM_YES" => $news_forum_yes,
	"NEWS_FORUM_NO" => $news_forum_no,
	"TITLE_NEWS_FORUM" => $new['title_news_forum'],
	"TTEXT_NEWS_FORUM" => $new['text_news_forum'],
	"NUMBER_OF_NEWS" => $new['number_of_news'],
	"RECENT_PICS" => $new['recent_pics'],
	"V_TOP_POSTERS" => $new['value_top_posters'],
	"V_RECENT_TOPICS" => $new['value_recent_topics'],
	"NEWS_LENGTH" => $new['news_length'],
	"S_NEWS_FORUM" => get_tree_option('', false, true, $new['witch_news_forum']),
	"S_POLL_OPTIONS" => get_tree_option('', false, true, $new['witch_poll_forum']),
	"EXCEPT_FORUM" => $new['except_forum'],
	"POLL_LEFT" => $poll_left,
	"POLL_NONE" => $poll_none,
	"POLL_RIGHT" => $poll_right,
	"DOWNLOAD_POS_LEFT" => $download_pos_left,
	"DOWNLOAD_POS_CENTER" => $download_pos_center,
	"DOWNLOAD_POS_RIGHT" => $download_pos_right,
	"PORTAL_MENU_A_LEFT" => $portal_menu_a_left,
	"PORTAL_MENU_A_CENTER" => $portal_menu_a_center,
	"PORTAL_MENU_A_RIGHT" => $portal_menu_a_right,
	"LINKS_A_LEFT" => $links_a_left,
	"LINKS_A_CENTER" => $links_a_center,
	"LINKS_A_RIGHT" => $links_a_right,
	"LINKS_A2_LEFT" => $links_a2_left,
	"LINKS_A2_CENTER" => $links_a2_center,
	"LINKS_A2_RIGHT" => $links_a2_right,
	"SEARCH_A_LEFT" => $search_a_left,
	"SEARCH_A_CENTER" => $search_a_center,
	"SEARCH_A_RIGHT" => $search_a_right,
	"STAT_A_LEFT" => $stat_a_left,
	"STAT_A_CENTER" => $stat_a_center,
	"STAT_A_RIGHT" => $stat_a_right,
	"RECENT_TOPICS_A_LEFT" => $recent_topics_a_left,
	"RECENT_TOPICS_A_CENTER" => $recent_topics_a_center,
	"RECENT_TOPICS_A_RIGHT" => $recent_topics_a_right,
	"TOP_POSTERS_A_LEFT" => $top_posters_a_left,
	"TOP_POSTERS_A_CENTER" => $top_posters_a_center,
	"TOP_POSTERS_A_RIGHT" => $top_posters_a_right,
	"CUSTOM1_BODY_A_LEFT" => $custom1_body_a_left,
	"CUSTOM1_BODY_A_CENTER" => $custom1_body_a_center,
	"CUSTOM1_BODY_A_RIGHT" => $custom1_body_a_right,
	"CUSTOM2_BODY_A_LEFT" => $custom2_body_a_left,
	"CUSTOM2_BODY_A_CENTER" => $custom2_body_a_center,
	"CUSTOM2_BODY_A_RIGHT" => $custom2_body_a_right,
	"LINKS1_YES" => $links1_yes,
	"LINKS1_NO" => $links1_no,
	"LINKS2_YES" => $links2_yes,
	"LINKS2_NO" => $links2_no,
	"LINKS3_YES" => $links3_yes,
	"LINKS3_NO" => $links3_no,
	"LINKS4_YES" => $links4_yes,
	"LINKS4_NO" => $links4_no,
	"LINKS5_YES" => $links5_yes,
	"LINKS5_NO" => $links5_no,
	"LINKS6_YES" => $links6_yes,
	"LINKS6_NO" => $links6_no,
	"LINKS7_YES" => $links7_yes,
	"LINKS7_NO" => $links7_no,
	"LINKS8_YES" => $links8_yes,
	"LINKS8_NO" => $links8_no,
	"L_MODULES" => $lang['modules'],
	"L_MODULES_E" => $lang['modules_e'],
	"L_RMDULE" => $lang['rmodule'],
	"L_LMODULE" => $lang['lmodule'],
	"ALBUM_POS_LEFT" => $album_pos_left,
	"ALBUM_POS_CENTER" => $album_pos_center,
	"ALBUM_POS_RIGHT" => $album_pos_right,
	"LINKS_BODY" => $new['links_body'],
	"CUSTOM1_BODY" => $new['custom1_body'],
	"CUSTOM1_NAME" => $new['custom1_name'],
	"CUSTOM2_BODY" => $new['custom2_body'],
	"CUSTOM2_NAME" => $new['custom2_name'],
	"CUSTOM_DESC1" => $new['custom_desc1'],
	"CUSTOM_DESC2" => $new['custom_desc2'],
	"CUSTOM_DESC3" => $new['custom_desc3'],
	"CUSTOM_DESC4" => $new['custom_desc4'],
	"CUSTOM_DESC5" => $new['custom_desc5'],
	"CUSTOM_DESC6" => $new['custom_desc6'],
	"CUSTOM_DESC7" => $new['custom_desc7'],
	"CUSTOM_DESC8" => $new['custom_desc8'],
	"CUSTOM_ADDRESS1" => $new['custom_address1'],
	"CUSTOM_ADDRESS2" => $new['custom_address2'],
	"CUSTOM_ADDRESS3" => $new['custom_address3'],
	"CUSTOM_ADDRESS4" => $new['custom_address4'],
	"CUSTOM_ADDRESS5" => $new['custom_address5'],
	"CUSTOM_ADDRESS6" => $new['custom_address6'],
	"CUSTOM_ADDRESS7" => $new['custom_address7'],
	"CUSTOM_ADDRESS8" => $new['custom_address8'],
	"BLANK1_BODY_ON_YES" => $blank1_body_on_yes,
	"BLANK1_BODY_ON_NO" => $blank1_body_on_no,
	"BLANK2_BODY_ON_YES" => $blank2_body_on_yes,
	"BLANK2_BODY_ON_NO" => $blank2_body_on_no,
	"BLANK3_BODY_ON_YES" => $blank3_body_on_yes,
	"BLANK3_BODY_ON_NO" => $blank3_body_on_no,
	"BLANK4_BODY_ON_YES" => $blank4_body_on_yes,
	"BLANK4_BODY_ON_NO" => $blank4_body_on_no,
	"BLANK1_BODY" => $new['blank1_body'],
	"BLANK2_BODY" => $new['blank2_body'],
	"BLANK3_BODY" => $new['blank3_body'],
	"BLANK4_BODY" => $new['blank4_body'],
	"BIRTHDAY_A_LEFT" => $birthday_a_left,
	"BIRTHDAY_A_CENTER" => $birthday_a_center,
	"BIRTHDAY_A_RIGHT" => $birthday_a_right,
	"INFO_A_LEFT" => $info_a_left,
	"INFO_A_CENTER" => $info_a_center,
	"INFO_A_RIGHT" => $info_a_right,
	"LOGIN_A_LEFT" => $login_a_left,
	"LOGIN_A_CENTER" => $login_a_center,
	"LOGIN_A_RIGHT" => $login_a_right,
	"WHOONLINE_A_LEFT" => $whoonline_a_left,
	"WHOONLINE_A_CENTER" => $whoonline_a_center,
	"WHOONLINE_A_RIGHT" => $whoonline_a_right,
	"CHAT_A_LEFT" => $chat_a_left,
	"CHAT_A_CENTER" => $chat_a_center,
	"CHAT_A_RIGHT" => $chat_a_right,
	"REGISTER_A_LEFT" => $register_a_left,
	"REGISTER_A_CENTER" => $register_a_center,
	"REGISTER_A_RIGHT" => $register_a_right,
	"PORTAL_HEADER" => $new['portal_header_body'],
	"BODY_NEWS_FORUM" => $new['body_news_forum'],
	"S_CONFIG_ACTION" => append_sid("admin_portal.$phpEx"),
	"CUSTOM_DESC1" => $new['custom_desc1'],
	"CUSTOM_DESC2" => $new['custom_desc2'],
	"CUSTOM_DESC3" => $new['custom_desc3'],
	"CUSTOM_DESC4" => $new['custom_desc4'],
	"CUSTOM_DESC5" => $new['custom_desc5'],
	"CUSTOM_DESC6" => $new['custom_desc6'],
	"CUSTOM_DESC7" => $new['custom_desc7'],
	"CUSTOM_DESC8" => $new['custom_desc8'],
	"CUSTOM_ADDRESS1" => $new['custom_address1'],
	"CUSTOM_ADDRESS2" => $new['custom_address2'],
	"CUSTOM_ADDRESS3" => $new['custom_address3'],
	"CUSTOM_ADDRESS4" => $new['custom_address4'],
	"CUSTOM_ADDRESS5" => $new['custom_address5'],
	"CUSTOM_ADDRESS6" => $new['custom_address6'],
	"CUSTOM_ADDRESS7" => $new['custom_address7'],
	"CUSTOM_ADDRESS8" => $new['custom_address8'],
	"L_ALBUM_POS" => $lang['album_pos'],
	"L_ALBUM_RECENT_PICS" => $lang['l_album_pics'],
	"L_BODY_HEADER" => $lang['body_header'],
	"L_BODY_HEADER_E" => $lang['body_header_e'],
	"L_BODY_FOOTER" => $lang['body_footer'],
	"L_BODY_FOOTER_E" => $lang['body_footer_e'],
	"L_BODY_NEWS_FORUM" => $lang['l_body_news_forum'],
	"L_BODY_NEWS_FORUM_E" => $lang['l_body_news_forum_e'],
	"L_LEFT" => $lang['left'],
	"L_CENTER" => $lang['center'],
	"L_RIGHT" => $lang['right'],
	"L_NONE" => $lang['none'],
	"L_LINKS_BODY" => $lang['links_body'],
	"L_NUMBER_NEWS" => $lang['l_number_of_news'],
	"L_NEWS_LENGTH" => $lang['l_news_length'],
	"L_WITCH_NEWS_FORUM" => $lang['l_witch_news_forum'],
	"L_WITCH_POLL_FORUM" => $lang['l_witch_poll_forum'],
	"L_EXCEPT_FORUM" => $lang['l_except_forum'],
	"L_WITCH_NEWS_FORUM_E" => $lang['l_witch_news_forum_e'],
	"L_EXCEPT_FORUM_E" => $lang['l_except_forum_e'],
	"L_PORTAL_ON" => $lang['l_portal_on'],
	"L_PORTAL_ON_E" => $lang['l_portal_on_e'],
	"L_LINK_LOGO" => $lang['l_link_logo'],
	"L_OWN_HEADER" => $lang['l_own_header'],
	"L_OWN_HEADER_E" => $lang['l_portal_on_e'],
	"L_OWN_BODY" => $lang['l_own_body'],
	"L_OWN_BODY_E" => $lang['l_own_body_e'],
	"L_NEWS_FORUM" => $lang['l_news_forum'],
	"L_POLL" => $lang['l_poll'],
	"L_DOWNLOAD_POS" => $lang['l_download_pos'],
	"L_PORTAL_MENU_A" => $lang['l_portal_menu_a'],
	"L_LINKS_A" => $lang['l_links_a'],
	"L_SEARCH_A" => $lang['l_search_a'],
	"L_STAT_A" => $lang['l_stat_a'],
	"L_RECENT_TOPICS_A" => $lang['l_recent_topics_a'],
	"L_TOP_POSTERS_A" => $lang['l_top_posters_a'],
	"L_LINKS" => $lang['l_links'],
	"L_LINKS_E" => $lang['l_links_e'],
	"L_LINKS1" => $lang['l_links1'],
	"L_LINKS2" => $lang['l_links2'],
	"L_LINKS3" => $lang['l_links3'],
	"L_LINKS4" => $lang['l_links4'],
	"L_LINKS5" => $lang['l_links5'],
	"L_LINKS6" => $lang['l_links6'],
	"L_LINKS7" => $lang['l_links7'],
	"L_LINKS8" => $lang['l_links8'],
	"L_BLANK_BODY_ON" => $lang['l_blank_body_on'],
	"L_BLANK_BODY_ON_E" => $lang['l_blank_body_on_e'],
	"L_BIRTHDAY_A" => $lang['l_birthday_a'],
	"L_V_TOP_POSTERS" => $lang['v_top_posters'],
	"L_V_RECENT_TOPICS" => $lang['v_recent_topics'],
	"L_INFO_A" => $lang['l_info_a'],
	"L_LOGIN_A" => $lang['l_login_a'],
	"L_WHOONLINE_A" => $lang['l_whoonline_a'],
	"L_CHAT_A" => $lang['l_chat_a'],
	"L_REGISTER_A" => $lang['l_register_a'],
	"L_ALIGN_RIGHT" => $lang['l_align_right'],
	"L_ALIGN_CENTER" => $lang['l_align_center'],
	"L_ALIGN_LEFT" => $lang['l_align_left'],
	"L_CUSTOM_DESC" => $lang['custom_desc'],
	"L_CUSTOM_ADDRESS" => $lang['custom_address'],
	"L_CUSTOM_NAME" => $lang['custom_name'],
	"L_CUSTOM_NAME_E" => $lang['custom_name_e'],
	"L_CUSTOM_BODY" => $lang['custom_body'],
	"JUMP_MODULE1" => module_jumpbox('module1', $list_modules, $lang_modules),
	"JUMP_MODULE2" => module_jumpbox('module2', $list_modules, $lang_modules),
	"JUMP_MODULE3" => module_jumpbox('module3', $list_modules, $lang_modules),
	"JUMP_MODULE4" => module_jumpbox('module4', $list_modules, $lang_modules),
	"JUMP_MODULE5" => module_jumpbox('module5', $list_modules, $lang_modules),
	"JUMP_MODULE6" => module_jumpbox('module6', $list_modules, $lang_modules),
	"JUMP_MODULE7" => module_jumpbox('module7', $list_modules, $lang_modules),
	"JUMP_MODULE8" => module_jumpbox('module8', $list_modules, $lang_modules),
	"JUMP_MODULE9" => module_jumpbox('module9', $list_modules, $lang_modules),
	"JUMP_MODULE10" => module_jumpbox('module10', $list_modules, $lang_modules),
	"JUMP_MODULE11" => module_jumpbox('module11', $list_modules, $lang_modules),
	"JUMP_MODULE12" => module_jumpbox('module12', $list_modules, $lang_modules),
	"JUMP_MODULE13" => module_jumpbox('module13', $list_modules, $lang_modules),
	"JUMP_MODULE14" => module_jumpbox('module14', $list_modules, $lang_modules),
	"JUMP_MODULE15" => module_jumpbox('module15', $list_modules, $lang_modules),
	"JUMP_MODULE16" => module_jumpbox('module16', $list_modules, $lang_modules),
	"JUMP_MODULE17" => module_jumpbox('module17', $list_modules, $lang_modules),
	"JUMP_MODULE18" => module_jumpbox('module18', $list_modules, $lang_modules),
	"JUMP_MODULE19" => module_jumpbox('module19', $list_modules, $lang_modules),
	"JUMP_MODULE20" => module_jumpbox('module20', $list_modules, $lang_modules),
	"JUMP_MODULE21" => module_jumpbox('module21', $list_modules, $lang_modules),
	"JUMP_MODULE22" => module_jumpbox('module22', $list_modules, $lang_modules),
	"JUMP_MODULE23" => module_jumpbox('module23', $list_modules, $lang_modules),
	"JUMP_MODULE24" => module_jumpbox('module24', $list_modules, $lang_modules),

	"L_CUSTOM_BODY_E" => $lang['custom_body_e'])
);

$template->pparse("body");

include('./page_footer_admin.'.$phpEx);

?>