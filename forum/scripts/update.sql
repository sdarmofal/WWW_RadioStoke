CREATE TABLE phpbb_advertisement (
  id mediumint(9) NOT NULL auto_increment,
  html text DEFAULT '' NULL,
  email varchar(128) default '' NULL,
  clicks int(9) default '0' NOT NULL,
  position tinyint(1) default '0' NOT NULL,
  porder mediumint(4) default '0' NOT NULL,
  added int(11) default '0' NOT NULL,
  expire int(11) default '0' NOT NULL,
  last_update int(11) default '0' NOT NULL,
  notify tinyint(1) default '0' NOT NULL,
  type tinyint(1) default '0' NOT NULL,
  PRIMARY KEY (id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_adv_person (
  user_id mediumint(9) default '0' NOT NULL,
  person_id mediumint(9) default '0' NOT NULL,
  person_ip char(8) default '',
  PRIMARY KEY (user_id, person_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_album (
  pic_id int(11) UNSIGNED NOT NULL auto_increment,
  pic_filename varchar(255) NOT NULL,
  pic_thumbnail varchar(255),
  pic_title varchar(255) NOT NULL default '',
  pic_desc text,
  pic_user_id mediumint(8) NOT NULL default '0',
  pic_username varchar(32) default NULL,
  pic_user_ip char(8) NOT NULL default '0',
  pic_time int(11) UNSIGNED NOT NULL default '0',
  pic_cat_id mediumint(8) UNSIGNED NOT NULL default '1',
  pic_view_count int(11) UNSIGNED NOT NULL default '0',
  pic_lock tinyint(3) NOT NULL default '0',
  pic_approval tinyint(3) NOT NULL default '1',
  PRIMARY KEY (pic_id),
  KEY pic_cat_id (pic_cat_id),
  KEY pic_user_id (pic_user_id),
  KEY pic_time (pic_time)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_album_cat (
  cat_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  cat_parent mediumint(8) UNSIGNED NOT NULL default '0',
  cat_type tinyint(2) NOT NULL default '0',
  cat_title varchar(255) NOT NULL default '',
  cat_desc text,
  cat_order mediumint(8) NOT NULL default '0',
  cat_view_level tinyint(3) NOT NULL default '-1',
  cat_upload_level tinyint(3) NOT NULL default '0',
  cat_rate_level tinyint(3) NOT NULL default '0',
  cat_comment_level tinyint(3) NOT NULL default '0',
  cat_edit_level tinyint(3) NOT NULL default '0',
  cat_delete_level tinyint(3) NOT NULL default '2',
  cat_view_groups varchar(255) default NULL,
  cat_upload_groups varchar(255) default NULL,
  cat_rate_groups varchar(255) default NULL,
  cat_comment_groups varchar(255) default NULL,
  cat_edit_groups varchar(255) default NULL,
  cat_delete_groups varchar(255) default NULL,
  cat_moderator_groups varchar(255) default NULL,
  cat_approval tinyint(3) NOT NULL default '0',
  PRIMARY KEY (cat_id),
  KEY cat_order (cat_order)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_album_comment (
  comment_id int(11) UNSIGNED NOT NULL auto_increment,
  comment_pic_id int(11) UNSIGNED NOT NULL default '0',
  comment_user_id mediumint(8) NOT NULL default '0',
  comment_username varchar(32) default NULL,
  comment_user_ip char(8) NOT NULL default '',
  comment_time int(11) UNSIGNED NOT NULL default '0',
  comment_text text,
  comment_edit_time int(11) UNSIGNED default NULL,
  comment_edit_count smallint(5) UNSIGNED NOT NULL default '0',
  comment_edit_user_id mediumint(8) default NULL,
  PRIMARY KEY(comment_id),
  KEY comment_pic_id (comment_pic_id),
  KEY comment_user_id (comment_user_id),
  KEY comment_user_ip (comment_user_ip),
  KEY comment_time (comment_time)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_album_config (
  config_name varchar(255) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY (config_name)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_album_rate (
  rate_pic_id int(11) UNSIGNED NOT NULL default '0',
  rate_user_id mediumint(8) NOT NULL default '0',
  rate_user_ip char(8) NOT NULL default '',
  rate_point tinyint(3) UNSIGNED NOT NULL default '0',
  KEY rate_pic_id (rate_pic_id),
  KEY rate_user_id (rate_user_id),
  KEY rate_user_ip (rate_user_ip),
  KEY rate_point (rate_point)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_anti_robotic_reg (
  session_id char(32) default '' NOT NULL,
  reg_key char(4) NOT NULL default '',
  timestamp int(10) UNSIGNED NOT NULL default '0',
  PRIMARY KEY (session_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_attachments (
  attach_id mediumint(8) UNSIGNED default '0' NOT NULL, 
  post_id mediumint(8) UNSIGNED default '0' NOT NULL, 
  privmsgs_id mediumint(8) UNSIGNED default '0' NOT NULL,
  user_id_1 mediumint(8) NOT NULL default '0',
  user_id_2 mediumint(8) NOT NULL default '0',
  KEY attach_id_post_id (attach_id, post_id),
  KEY attach_id_privmsgs_id (attach_id, privmsgs_id),
  KEY user_id_1 (user_id_1),
  KEY user_id_2 (user_id_2)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci; 

CREATE TABLE phpbb_attachments_config (
  config_name varchar(255) NOT NULL default '',
  config_value varchar(255) NOT NULL default '',
  PRIMARY KEY (config_name)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_attachments_desc (
  attach_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  physical_filename varchar(255) NOT NULL default '',
  real_filename varchar(255) NOT NULL default '',
  download_count mediumint(8) UNSIGNED default '0' NOT NULL,
  comment varchar(255) default NULL,
  extension varchar(100) default NULL,
  mimetype varchar(100) default NULL,
  filesize int(20) NOT NULL default '0',
  filetime int(11) default '0' NOT NULL,
  thumbnail tinyint(1) default '0' NOT NULL,
  PRIMARY KEY (attach_id),
  KEY filetime (filetime),
  KEY physical_filename (physical_filename(10)),
  KEY filesize (filesize)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_attach_quota (
  user_id mediumint(8) UNSIGNED NOT NULL default '0',
  group_id mediumint(8) UNSIGNED NOT NULL default '0',
  quota_type smallint(2) NOT NULL default '0',
  quota_limit_id mediumint(8) UNSIGNED NOT NULL default '0',
  KEY quota_type (quota_type)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_birthday ( 
   user_id mediumint(9) NOT NULL default '0',
   send_user_id mediumint(9) NOT NULL default '0',
   send_year int(11) NOT NULL default '0',
   PRIMARY KEY (user_id, send_user_id, send_year)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_chatbox (
  id int(11) NOT NULL auto_increment,
  name varchar(99) NOT NULL default '',
  msg varchar(255) NOT NULL default '',
  timestamp int(10) UNSIGNED NOT NULL default '0',
  PRIMARY KEY (id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_chatbox_session (
  username varchar(99) NOT NULL default '',
  lastactive int(10) default '0' NOT NULL,
  laststatus varchar(8) NOT NULL default '',
  UNIQUE KEY username (username)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  group_id mediumint(8) UNSIGNED default '0' NOT NULL,
  extension varchar(100) NOT NULL default '',
  comment varchar(100) default '',
  PRIMARY KEY ext_id (ext_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_extension_groups (
  group_id mediumint(8) NOT NULL auto_increment,
  group_name char(20) NOT NULL default '',
  cat_id tinyint(2) default '0' NOT NULL, 
  allow_group tinyint(1) default '0' NOT NULL,
  download_mode tinyint(1) UNSIGNED default '1' NOT NULL,
  upload_icon varchar(100) default '',
  max_filesize int(20) default '0' NOT NULL,
  forum_permissions varchar(255) default '' NOT NULL,
  PRIMARY KEY group_id (group_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_forbidden_extensions (
  ext_id mediumint(8) UNSIGNED NOT NULL auto_increment, 
  extension varchar(100) NOT NULL default '', 
  PRIMARY KEY (ext_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

ALTER TABLE phpbb_ignore RENAME phpbb_ignores;
CREATE TABLE phpbb_ignores (
  user_id mediumint(8) NOT NULL default '0',
  user_ignore mediumint(8) NOT NULL default '0',
  PRIMARY KEY (user_id, user_ignore)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_jr_admin_users (
  user_id mediumint(9) NOT NULL default '0',
  user_jr_admin varchar(254) default '' NOT NULL,
  PRIMARY KEY (user_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_logs (
  id_log mediumint(10) NOT NULL auto_increment,
  mode varchar(50) NULL default '', 
  topic_id mediumint(10) NULL default '0',
  user_id mediumint(8) NULL default '0',
  username varchar(25) NULL default '',
  user_ip char(8) default '0' NOT NULL,
  time int(11) default '0',
  PRIMARY KEY (id_log)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_mass_email (
  mass_email_user_id mediumint(8) default '0' NOT NULL,
  mass_email_text longtext default '' NULL, 
  mass_email_subject text default '' NULL,
  mass_email_bcc longtext default '' NULL,
  mass_email_html tinyint(1) default '0' NOT NULL,
  mass_email_to varchar(128) default '' NULL,
  PRIMARY KEY (mass_email_user_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_pa_cat (
  cat_id int(10) NOT NULL auto_increment,
  cat_name text,
  cat_desc text,
  cat_files int(10) default NULL,
  cat_1xid int(10) default NULL,
  cat_parent int(50) default NULL,
  cat_order int(50) default NULL,
  PRIMARY KEY  (cat_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_pa_comments (
  comments_id int(10) NOT NULL auto_increment,
  file_id int(10) NOT NULL default '0',
  comments_text text NOT NULL,
  comments_title text NOT NULL,
  comments_time int(50) NOT NULL default '0',
  comment_bbcode_uid varchar(10) default NULL,
  poster_id mediumint(8) NOT NULL default '0',
  PRIMARY KEY  (comments_id),
  KEY comments_id (comments_id),
  KEY comment_bbcode_uid (comment_bbcode_uid)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_pa_custom (
  custom_id int(50) NOT NULL auto_increment,
  custom_name text NOT NULL,
  custom_description text NOT NULL,
  PRIMARY KEY  (custom_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_pa_customdata (
  customdata_file int(50) NOT NULL default '0',
  customdata_custom int(50) NOT NULL default '0',
  data text NOT NULL
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_pa_files (
  file_id int(10) NOT NULL auto_increment,
  file_name text,
  file_desc text,
  file_creator text,
  file_version text,
  file_longdesc text,
  file_ssurl text,
  file_dlurl text,
  file_time int(50) default NULL,
  file_catid int(10) default NULL,
  file_posticon text,
  file_license int(10) default NULL,
  file_dls int(10) default NULL,
  file_last int(50) default NULL,
  file_pin int(2) default NULL,
  file_docsurl text,
  file_rating double(6,4) NOT NULL default '0.0000',
  file_totalvotes int(255) NOT NULL default '0',
  PRIMARY KEY  (file_id),
  KEY group_id (file_catid)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_pa_license (
  license_id int(10) NOT NULL auto_increment,
  license_name text,
  license_text text,
  PRIMARY KEY  (license_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_pa_settings (
  settings_id int(1) NOT NULL default '1',
  settings_dbname text NOT NULL,
  settings_sitename text NOT NULL,
  settings_dbdescription text NOT NULL default '',
  settings_dburl text NOT NULL,
  settings_topnumber int(5) NOT NULL default '0',
  settings_homeurl text NOT NULL,
  settings_newdays int(5) NOT NULL default '0',
  settings_stats int(5) NOT NULL default '0',
  settings_viewall int(5) NOT NULL default '0',
  settings_showss int(5) NOT NULL default '0',
  settings_disable int(5) NOT NULL default '0',
  allow_html int(5) NOT NULL default '0',
  allow_bbcode int(5) NOT NULL default '0',
  allow_smilies int(5) NOT NULL default '0',
  allow_comment_links int(5) NOT NULL default '0',
  no_comment_link_message varchar(255) NOT NULL default '',
  allow_comment_images int(5) NOT NULL default '0',
  no_comment_image_message varchar(255) NOT NULL default '',
  max_comment_chars int(255) NOT NULL default '0',
  directly_linked int(5) NOT NULL default '0'
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_pa_votes (
  votes_ip varchar(50) NOT NULL default '0',
  votes_file int(50) NOT NULL default '0'
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_portal_config (
   config_name varchar(255) NOT NULL default '',
   config_value text NOT NULL,
   PRIMARY KEY (config_name)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_posts_text_history (
  th_id mediumint(9) NOT NULL auto_increment,
  th_post_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
  th_post_text text,
  th_user_id mediumint(8) DEFAULT '0' NOT NULL,
  th_time int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (th_id),
  KEY th_post_id (th_post_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_quota_limits (
  quota_limit_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  quota_desc varchar(20) NOT NULL DEFAULT '',
  quota_limit bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY  (quota_limit_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_read_history (
  user_id mediumint(8) NOT NULL DEFAULT '0',
  post_id mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  topic_id mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  forum_id smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
  KEY user_id (user_id),
  KEY post_id (post_id),
  KEY topic_id (topic_id),
  KEY forum_id (forum_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_sessions_keys (
  key_id varchar(32) DEFAULT '0' NOT NULL,
  user_id mediumint(8) DEFAULT '0' NOT NULL,
  last_ip varchar(8) DEFAULT '0' NOT NULL,
  last_login int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (key_id, user_id),
  KEY last_login (last_login)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_shoutbox (
  id int(11) NOT NULL auto_increment,
  sb_user_id int(11) NOT NULL default '0',
  msg text NOT NULL,
  timestamp int(10) UNSIGNED NOT NULL default '0',
  PRIMARY KEY (id),
  KEY sb_user_id (sb_user_id),
  KEY timestamp (timestamp)
);

CREATE TABLE phpbb_shoutbox_config ( 
   config_name varchar(255) NOT NULL default '', 
   config_value varchar(255) NOT NULL default '', 
   PRIMARY KEY (config_name)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_stats_config (
  config_name varchar(50) NOT NULL DEFAULT '',
  config_value varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (config_name)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_stats_modules (
  module_id tinyint(8) NOT NULL DEFAULT '0',
  name varchar(150) NOT NULL DEFAULT '',
  active tinyint(1) NOT NULL DEFAULT '0',
  installed tinyint(1) NOT NULL DEFAULT '0',
  display_order mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  update_time mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  auth_value tinyint(2) NOT NULL DEFAULT '0',
  module_info_cache blob,
  module_db_cache blob,
  module_result_cache blob,
  module_info_time int(10) UNSIGNED NOT NULL DEFAULT '0',
  module_cache_time int(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (module_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_topics_ignore (
  topic_id mediumint(8) UNSIGNED NOT NULL auto_increment,
  user_id mediumint(8) DEFAULT '0' NOT NULL,
  PRIMARY KEY (topic_id, user_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_topic_view ( 
  topic_id mediumint(8) NOT NULL default '0', 
  user_id mediumint(8) NOT NULL default '0', 
  view_time int(11) NOT NULL default '0', 
  view_count int(11) NOT NULL default '0',
  PRIMARY KEY (topic_id, user_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_themes_name (
  themes_id smallint(5) UNSIGNED DEFAULT '0' NOT NULL,
  tr_color1_name char(50),
  tr_color2_name char(50),
  tr_color3_name char(50),
  tr_class1_name char(50),
  tr_class2_name char(50),
  tr_class3_name char(50),
  th_color1_name char(50),
  th_color2_name char(50),
  th_color3_name char(50),
  th_class1_name char(50),
  th_class2_name char(50),
  th_class3_name char(50),
  td_color1_name char(50),
  td_color2_name char(50),
  td_color3_name char(50),
  td_class1_name char(50),
  td_class2_name char(50),
  td_class3_name char(50),
  fontface1_name char(50),
  fontface2_name char(50),
  fontface3_name char(50),
  fontsize1_name char(50),
  fontsize2_name char(50),
  fontsize3_name char(50),
  fontcolor1_name char(50),
  fontcolor2_name char(50),
  fontcolor3_name char(50),
  span_class1_name char(50),
  span_class2_name char(50),
  span_class3_name char(50),
  PRIMARY KEY (themes_id)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

CREATE TABLE phpbb_users_warnings (
  id mediumint(8) UNSIGNED NOT NULL auto_increment,
  userid mediumint(8) NOT NULL DEFAULT '0',
  modid mediumint(8) NOT NULL DEFAULT '0',
  date int(11) NOT NULL DEFAULT '0',
  value mediumint(8) NOT NULL DEFAULT '0',
  reason text,
  archive tinyint(1) DEFAULT '0' NOT NULL,
  warning_viewed smallint(1) DEFAULT '0' NOT NULL,
  PRIMARY KEY (id),
  KEY archive (archive),
  KEY warning_viewed (warning_viewed),
  KEY date (date),
  KEY userid (userid),
  KEY modid (modid)
) DEFAULT CHARSET latin2 COLLATE latin2_general_ci;

TRUNCATE TABLE phpbb_shoutbox;
TRUNCATE TABLE phpbb_sessions_keys;

DROP TABLE phpbb_cat_rel_cat_parents;
DROP TABLE phpbb_cat_rel_forum_parents;
DROP TABLE phpbb_chat2box;
DROP TABLE phpbb_chat2box_session;
DROP TABLE phpbb_counter;
DROP TABLE phpbb_junior_auth_panel;
DROP TABLE phpbb_quickstats;
DROP TABLE phpbb_rate_results;
DROP TABLE phpbb_rate_config;
DROP TABLE phpbb_rate_result;
DROP TABLE phpbb_rate_config;

ALTER TABLE phpbb_album_cat ADD cat_parent mediumint(8) unsigned NOT NULL default '0' AFTER cat_id;
ALTER TABLE phpbb_album_cat ADD cat_type tinyint(2) NOT NULL default '0' AFTER cat_parent;

ALTER TABLE phpbb_auth_access ADD auth_globalannounce tinyint(1) default '0' NOT NULL AFTER auth_announce;
ALTER TABLE phpbb_auth_access ADD auth_download tinyint(1) default '0' NOT NULL;

ALTER TABLE phpbb_banlist DROP ban_by;
ALTER TABLE phpbb_banlist DROP ban_reason;
ALTER TABLE phpbb_banlist ADD ban_time int(11) default NULL;
ALTER TABLE phpbb_banlist ADD ban_expire_time int(11) default NULL;
ALTER TABLE phpbb_banlist ADD ban_by_userid mediumint(8) default NULL;
ALTER TABLE phpbb_banlist ADD ban_priv_reason text;
ALTER TABLE phpbb_banlist ADD ban_pub_reason_mode tinyint(1) default NULL;
ALTER TABLE phpbb_banlist ADD ban_pub_reason text;
ALTER TABLE phpbb_banlist ADD ban_host varchar(255) default '';

ALTER TABLE phpbb_categories DROP parent_forum_id;
ALTER TABLE phpbb_categories DROP cat_hier_level;
ALTER TABLE phpbb_categories ADD cat_main_type char(1) default NULL;
ALTER TABLE phpbb_categories ADD cat_main mediumint(8) UNSIGNED default '0' NOT NULL;
ALTER TABLE phpbb_categories ADD cat_desc text NOT NULL;

ALTER TABLE phpbb_forums DROP forum_hier_level;
ALTER TABLE phpbb_forums DROP forum_issub;
ALTER TABLE phpbb_forums DROP auth_rate;
ALTER TABLE phpbb_forums ADD auth_globalannounce tinyint(2) default '3' NOT NULL AFTER auth_announce;
ALTER TABLE phpbb_forums ADD auth_download tinyint(2) default '0' NOT NULL;
ALTER TABLE phpbb_forums ADD password varchar(20) NOT NULL default '';
ALTER TABLE phpbb_forums ADD forum_sort varchar(12) NOT NULL;
ALTER TABLE phpbb_forums ADD forum_color varchar(6) NOT NULL default  '';
ALTER TABLE phpbb_forums ADD forum_link varchar(255) default NULL;
ALTER TABLE phpbb_forums ADD forum_link_internal tinyint(1) NOT NULL default '0';
ALTER TABLE phpbb_forums ADD forum_link_hit_count tinyint(1) NOT NULL default '0';
ALTER TABLE phpbb_forums ADD forum_link_hit bigint(20) UNSIGNED NOT NULL default '0';
ALTER TABLE phpbb_forums ADD main_type char(1) default NULL;
ALTER TABLE phpbb_forums ADD forum_moderate tinyint(1) default '0' NOT NULL;
ALTER TABLE phpbb_forums ADD no_count tinyint(1) default '0' NOT NULL;
ALTER TABLE phpbb_forums ADD forum_trash smallint(1) default '0' NOT NULL;
ALTER TABLE phpbb_forums ADD forum_separate smallint(1) default '2' NOT NULL;
ALTER TABLE phpbb_forums ADD forum_show_ga smallint(1) default '1' NOT NULL;
ALTER TABLE phpbb_forums ADD forum_tree_grade tinyint(1) default '3' NOT NULL;
ALTER TABLE phpbb_forums ADD forum_tree_req tinyint(1) default '0' NOT NULL;
ALTER TABLE phpbb_forums ADD forum_no_split tinyint(1) default '0' NOT NULL;
ALTER TABLE phpbb_forums ADD forum_no_helped tinyint(1) default '0' NOT NULL;
ALTER TABLE phpbb_forums ADD topic_tags varchar(255) default '' NULL;
ALTER TABLE phpbb_forums ADD locked_bottom tinyint(1) default '0' NULL;

ALTER TABLE phpbb_groups ADD group_order mediumint(8) default '0' NOT NULL;
ALTER TABLE phpbb_groups ADD group_count int(4) UNSIGNED default '99999999';
ALTER TABLE phpbb_groups ADD group_count_enable smallint(2) UNSIGNED default '0';
ALTER TABLE phpbb_groups ADD group_mail_enable smallint(1) default '0' NULL;
ALTER TABLE phpbb_groups ADD group_no_unsub smallint(1) default '0' NULL;
ALTER TABLE phpbb_groups ADD group_color varchar(6) default NULL;
ALTER TABLE phpbb_groups ADD group_prefix varchar(8) default NULL;
ALTER TABLE phpbb_groups ADD group_style varchar(255) default NULL;

ALTER TABLE phpbb_jr_admin_users DROP start_date;
ALTER TABLE phpbb_jr_admin_users DROP update_date;
ALTER TABLE phpbb_jr_admin_users DROP admin_notes;
ALTER TABLE phpbb_jr_admin_users DROP notes_view;


ALTER TABLE phpbb_pa_settings ADD directly_linked int(5) NOT NULL default '0';

ALTER TABLE phpbb_posts ADD post_attachment tinyint(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_posts ADD user_agent varchar(255) DEFAULT '' NOT NULL;
ALTER TABLE phpbb_posts ADD post_icon tinyint(2) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE phpbb_posts ADD post_expire int(11) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_posts ADD reporter_id mediumint(8) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_posts ADD post_marked enum('n','y') default NULL;
ALTER TABLE phpbb_posts ADD post_approve tinyint(1) DEFAULT '1' NOT NULL;
ALTER TABLE phpbb_posts ADD poster_delete tinyint(1) DEFAULT '0';
ALTER TABLE phpbb_posts ADD post_edit_by mediumint(8) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_posts ADD post_parent mediumint(8) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_posts ADD post_order mediumint(8) DEFAULT '0' NOT NULL;

ALTER TABLE phpbb_profile_fields ADD prefix varchar(255) DEFAULT '' NOT NULL;
ALTER TABLE phpbb_profile_fields ADD suffix varchar(255) DEFAULT '' NOT NULL;
ALTER TABLE phpbb_profile_fields ADD editable tinyint(1) DEFAULT '1' NOT NULL;
ALTER TABLE phpbb_profile_fields ADD view_by tinyint(1) DEFAULT '0' NOT NULL;

ALTER TABLE phpbb_privmsgs ADD privmsgs_attachment tinyint(1) DEFAULT '0' NOT NULL;

ALTER TABLE phpbb_ranks ADD rank_group mediumint(8) DEFAULT '0' NOT NULL;

ALTER TABLE phpbb_search_results ADD search_time int NOT NULL;
ALTER TABLE phpbb_search_results CHANGE search_id search_id int(11) NOT NULL auto_increment;

ALTER TABLE phpbb_sessions ADD session_admin tinyint(2) DEFAULT '0' NOT NULL;

ALTER TABLE phpbb_smilies ADD smile_order mediumint(8) UNSIGNED DEFAULT '1' NOT NULL;

UPDATE phpbb_stats_modules SET update_time = '24' WHERE name = 'new_posts_by_month';
UPDATE phpbb_stats_modules SET update_time = '24' WHERE name = 'new_topics_by_month';
UPDATE phpbb_stats_modules SET update_time = '24' WHERE name = 'new_users_by_month';
UPDATE phpbb_stats_modules SET update_time = '0' WHERE name = 'most_active_topics';
UPDATE phpbb_stats_modules SET update_time = '0' WHERE name = 'most_viewed_topics';
UPDATE phpbb_stats_modules SET update_time = '0' WHERE name = 'latest_topics';
UPDATE phpbb_stats_modules SET update_time = '48' WHERE name = 'priv_msgs';
UPDATE phpbb_stats_modules SET update_time = '24' WHERE name = 'top_posters';
UPDATE phpbb_stats_modules SET update_time = '0' WHERE name = 'last_active_users';
UPDATE phpbb_stats_modules SET update_time = '48' WHERE name = 'users_from_where';
UPDATE phpbb_stats_modules SET update_time = '48' WHERE name = 'age_statistics';
UPDATE phpbb_stats_modules SET update_time = '48' WHERE name = 'users_gender';
UPDATE phpbb_stats_modules SET update_time = '64' WHERE name = 'top_smilies';
UPDATE phpbb_stats_modules SET update_time = '64' WHERE name = 'top_words';
UPDATE phpbb_stats_modules SET update_time = '64' WHERE name = 'user_agent';
UPDATE phpbb_stats_modules SET update_time = '24' WHERE name = 'top_helpful';

ALTER TABLE phpbb_themes ADD tr_color_helped varchar(6) DEFAULT '' AFTER tr_color3;
ALTER TABLE phpbb_themes ADD fontcolor_admin varchar(6) DEFAULT '' AFTER fontcolor3;
ALTER TABLE phpbb_themes ADD fontcolor_jradmin varchar(6) DEFAULT '' AFTER fontcolor_admin;
ALTER TABLE phpbb_themes ADD fontcolor_mod varchar(6) DEFAULT '' AFTER fontcolor_jradmin;
ALTER TABLE phpbb_themes ADD factive_color varchar(6) DEFAULT '' AFTER fontcolor_mod;
ALTER TABLE phpbb_themes ADD faonmouse_color varchar(6) DEFAULT '' AFTER factive_color;
ALTER TABLE phpbb_themes ADD faonmouse2_color varchar(6) DEFAULT '' AFTER faonmouse_color;
UPDATE phpbb_themes SET td_class2 = 'row2' WHERE template_name = 'Appalachia';
UPDATE phpbb_themes SET fontcolor_admin = 'FFA34F' WHERE fontcolor_admin = '';
UPDATE phpbb_themes SET fontcolor_jradmin = '993333' WHERE fontcolor_jradmin = '';
UPDATE phpbb_themes SET fontcolor_mod = '006600' WHERE fontcolor_mod = '';
UPDATE phpbb_themes SET factive_color = 'F9F9F0' WHERE factive_color = '';
UPDATE phpbb_themes SET faonmouse_color = 'DEE3E7' WHERE faonmouse_color = '';
UPDATE phpbb_themes SET faonmouse2_color = 'EFEFEF' WHERE faonmouse2_color = '';
UPDATE phpbb_themes SET tr_color_helped = 'F0EDDE' WHERE tr_color_helped = '';

ALTER TABLE phpbb_topics ADD topic_attachment tinyint(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_topics ADD topic_icon tinyint(2) UNSIGNED DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_topics ADD topic_expire int(11) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_topics ADD topic_color varchar(8) DEFAULT NULL;
ALTER TABLE phpbb_topics ADD topic_title_e char(100) NOT NULL DEFAULT '';
ALTER TABLE phpbb_topics ADD topic_action tinyint(1) DEFAULT '0';
ALTER TABLE phpbb_topics ADD topic_action_user mediumint(8) NOT NULL DEFAULT '0';
ALTER TABLE phpbb_topics ADD topic_action_date int(11) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_topics ADD topic_tree_width smallint(2) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_topics ADD topic_accept TINYINT( 1 ) NOT NULL DEFAULT '1';

ALTER TABLE phpbb_users DROP user_login_tries;
ALTER TABLE phpbb_users DROP user_last_login_try;
ALTER TABLE phpbb_users DROP user_dateformat;
ALTER TABLE phpbb_users DROP custom_form;
ALTER TABLE phpbb_users DROP can_custom_form;
ALTER TABLE phpbb_users DROP page_avatar;
ALTER TABLE phpbb_users DROP user_traffic;
ALTER TABLE phpbb_users DROP user_allow_sig_image;
ALTER TABLE phpbb_users DROP user_allow_signature;
ALTER TABLE phpbb_users DROP user_posts_per_page;
ALTER TABLE phpbb_users DROP user_topics_per_page;
ALTER TABLE phpbb_users DROP user_hot_threshold;
ALTER TABLE phpbb_users DROP user_sub_forum;
ALTER TABLE phpbb_users DROP user_split_cat;
ALTER TABLE phpbb_users DROP user_last_topic_title;
ALTER TABLE phpbb_users DROP user_sub_level_links;
ALTER TABLE phpbb_users DROP user_display_viewonline;
ALTER TABLE phpbb_users DROP view_ignore_topics;
ALTER TABLE phpbb_users DROP user_showavatars;
ALTER TABLE phpbb_users ADD user_allowsig tinyint(1) DEFAULT '1' NOT NULL AFTER user_allowavatar;
ALTER TABLE phpbb_users ADD user_viewaim tinyint(1) DEFAULT '1' AFTER user_viewemail;
ALTER TABLE phpbb_users ADD user_sig_image varchar(100) NOT NULL DEFAULT '' AFTER user_sig_bbcode_uid;
ALTER TABLE phpbb_users ADD user_birthday int(6) DEFAULT '999999' NOT NULL;
ALTER TABLE phpbb_users ADD user_next_birthday_greeting int(4) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD user_custom_rank varchar(100) default '';
ALTER TABLE phpbb_users ADD user_photo varchar(100) default '';
ALTER TABLE phpbb_users ADD user_photo_type tinyint(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD user_custom_color varchar(6) default '';
ALTER TABLE phpbb_users ADD user_badlogin smallint(2) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD user_blocktime int(11) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD user_block_by char(8) default '';
ALTER TABLE phpbb_users ADD disallow_forums varchar(254) default '';
ALTER TABLE phpbb_users ADD can_custom_ranks tinyint(1) DEFAULT '1' NOT NULL;
ALTER TABLE phpbb_users ADD can_custom_color tinyint(1) DEFAULT '1' NOT NULL;
ALTER TABLE phpbb_users ADD user_gender tinyint(1) NOT NULL DEFAULT '0';
ALTER TABLE phpbb_users ADD can_topic_color tinyint(1) DEFAULT '1' NOT NULL;
ALTER TABLE phpbb_users ADD user_notify_gg tinyint(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD allowpm tinyint(1) DEFAULT '1';
ALTER TABLE phpbb_users ADD no_report_popup tinyint(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD refresh_report_popup tinyint(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD no_report_mail tinyint(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD user_avatar_width smallint(3) default NULL;
ALTER TABLE phpbb_users ADD user_avatar_height smallint(3) default NULL;
ALTER TABLE phpbb_users ADD special_rank mediumint(8) UNSIGNED DEFAULT NULL;
ALTER TABLE phpbb_users ADD user_allow_helped tinyint(1) UNSIGNED NOT NULL DEFAULT '1';
ALTER TABLE phpbb_users ADD user_ip char(8) DEFAULT NULL;
ALTER TABLE phpbb_users ADD user_ip_login_check tinyint(1) DEFAULT '1' NOT NULL;
ALTER TABLE phpbb_users ADD user_spend_time int(8) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD user_visit int(7) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_users ADD user_session_start  int(11) NOT NULL DEFAULT '0';
ALTER TABLE phpbb_users ADD read_tracking_last_update int(11) NOT NULL DEFAULT '0';
ALTER TABLE phpbb_users ADD user_jr tinyint(1) DEFAULT '0';
ALTER TABLE phpbb_users CHANGE user_password user_password VARCHAR( 40 ) NOT NULL DEFAULT  '';
ALTER TABLE phpbb_users CHANGE user_newpasswd user_newpasswd VARCHAR( 40 ) NOT NULL DEFAULT  '';
ALTER TABLE `phpbb_users` CHANGE `user_id` `user_id` MEDIUMINT( 8 ) NOT NULL AUTO_INCREMENT;

ALTER TABLE phpbb_users_warnings ADD warning_viewed smallint(1) DEFAULT '0' NOT NULL;

ALTER TABLE phpbb_vote_desc ADD vote_max int(3) DEFAULT '1' NOT NULL;
ALTER TABLE phpbb_vote_desc ADD vote_voted int(7) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_vote_desc ADD vote_hide tinyint(1) DEFAULT '0' NOT NULL;
ALTER TABLE phpbb_vote_desc ADD vote_tothide tinyint(1) DEFAULT '0' NOT NULL;

ALTER TABLE phpbb_vote_voters ADD vote_cast tinyint(4) UNSIGNED DEFAULT '0' NOT NULL;

ALTER TABLE phpbb_shoutbox DROP sb_username;
DELETE FROM phpbb_shoutbox_config WHERE config_name = 'color_admin';
DELETE FROM phpbb_shoutbox_config WHERE config_name = 'color_mod';

DELETE FROM phpbb_attachments_config WHERE config_name = 'wma_autoplay';
DELETE FROM phpbb_attachments_config WHERE config_name = 'attach_version';
DELETE FROM phpbb_attachments_config WHERE config_name = 'flash_autoplay';

DELETE FROM phpbb_config WHERE config_name = 'cglow';
DELETE FROM phpbb_config WHERE config_name = 'cfreak';
DELETE FROM phpbb_config WHERE config_name = 'admin_files';
DELETE FROM phpbb_config WHERE config_name = 'allow_theme_create';
DELETE FROM phpbb_config WHERE config_name = 'cpppage';
DELETE FROM phpbb_config WHERE config_name = 'cdatefor';
DELETE FROM phpbb_config WHERE config_name = 'google';
DELETE FROM phpbb_config WHERE config_name = 'sort_methods';
DELETE FROM phpbb_config WHERE config_name = 'redirect_after_registering';
DELETE FROM phpbb_config WHERE config_name = 'redirect_address';
DELETE FROM phpbb_config WHERE config_name = 'jump_value_arr';
DELETE FROM phpbb_config WHERE config_name = 'report_post_hack_version';
DELETE FROM phpbb_config WHERE config_name = 'all_time_ban_check';
DELETE FROM phpbb_config WHERE config_name = 'split_messages_except';
DELETE FROM phpbb_config WHERE config_name = 'lastvisit_days';
DELETE FROM phpbb_config WHERE config_name = 'helped_forums';
DELETE FROM phpbb_config WHERE config_name = 'enable_confirm';
DELETE FROM phpbb_config WHERE config_name = 'max_login_attempts';
DELETE FROM phpbb_config WHERE config_name = 'login_reset_time';
DELETE FROM phpbb_config WHERE config_name = 'button_fl';
DELETE FROM phpbb_config WHERE config_name = 'button_st';
DELETE FROM phpbb_config WHERE config_name = 'edit_post_date';
DELETE FROM phpbb_config WHERE config_name = 'cforum';
DELETE FROM phpbb_config WHERE config_name = 'cdelay';
DELETE FROM phpbb_config WHERE config_name = 'cfontsize';
DELETE FROM phpbb_config WHERE config_name = 'ctext0';
DELETE FROM phpbb_config WHERE config_name = 'ctext1';
DELETE FROM phpbb_config WHERE config_name = 'ctext2';
DELETE FROM phpbb_config WHERE config_name = 'ctext3';
DELETE FROM phpbb_config WHERE config_name = 'ctext4';
DELETE FROM phpbb_config WHERE config_name = 'ctext5';
DELETE FROM phpbb_config WHERE config_name = 'ctext6';
DELETE FROM phpbb_config WHERE config_name = 'ctext7';
DELETE FROM phpbb_config WHERE config_name = 'ctext8';
DELETE FROM phpbb_config WHERE config_name = 'ctext9';
DELETE FROM phpbb_config WHERE config_name = 'cframe';
DELETE FROM phpbb_config WHERE config_name = 'cwait';
DELETE FROM phpbb_config WHERE config_name = 'cprivmsg';
DELETE FROM phpbb_config WHERE config_name = 'moderators_can_ban';
DELETE FROM phpbb_config WHERE config_name = 'no_post_count_forum_id';
DELETE FROM phpbb_config WHERE config_name = 'read_tracking';

UPDATE phpbb_config SET config_value = '1.12.7' WHERE config_name = 'version';
UPDATE phpbb_config SET config_value = '900' WHERE config_name = 'session_length';

DELETE FROM phpbb_portal_config WHERE config_name = 'scroll_recent_topics';
DELETE FROM phpbb_portal_config WHERE config_name = 'quick_stats_a';
DELETE FROM phpbb_portal_config WHERE config_name = 'album_on';
UPDATE phpbb_portal_config SET config_value = '' WHERE config_name = 'ri_time';
UPDATE phpbb_portal_config SET config_value = '' WHERE config_name = 'ri_data';

DELETE FROM phpbb_stats_modules WHERE name = 'admin_statistics';
DELETE FROM phpbb_stats_modules WHERE name = 'forum_index';

INSERT INTO phpbb_album_config VALUES ('max_pics', '1024');
INSERT INTO phpbb_album_config VALUES ('user_pics_limit', '50');
INSERT INTO phpbb_album_config VALUES ('mod_pics_limit', '250');
INSERT INTO phpbb_album_config VALUES ('max_file_size', '128000');
INSERT INTO phpbb_album_config VALUES ('max_width', '800');
INSERT INTO phpbb_album_config VALUES ('max_height', '600');
INSERT INTO phpbb_album_config VALUES ('rows_per_page', '3');
INSERT INTO phpbb_album_config VALUES ('cols_per_page', '4');
INSERT INTO phpbb_album_config VALUES ('fullpic_popup', '1');
INSERT INTO phpbb_album_config VALUES ('thumbnail_quality', '50');
INSERT INTO phpbb_album_config VALUES ('thumbnail_size', '125');
INSERT INTO phpbb_album_config VALUES ('thumbnail_cache', '1');
INSERT INTO phpbb_album_config VALUES ('sort_method', 'pic_time');
INSERT INTO phpbb_album_config VALUES ('sort_order', 'DESC');
INSERT INTO phpbb_album_config VALUES ('jpg_allowed', '1');
INSERT INTO phpbb_album_config VALUES ('png_allowed', '1');
INSERT INTO phpbb_album_config VALUES ('gif_allowed', '0');
INSERT INTO phpbb_album_config VALUES ('desc_length', '512');
INSERT INTO phpbb_album_config VALUES ('hotlink_prevent', '0');
INSERT INTO phpbb_album_config VALUES ('hotlink_allowed', '');
INSERT INTO phpbb_album_config VALUES ('personal_gallery', '0');
INSERT INTO phpbb_album_config VALUES ('personal_gallery_private', '0');
INSERT INTO phpbb_album_config VALUES ('personal_gallery_limit', '10');
INSERT INTO phpbb_album_config VALUES ('personal_gallery_view', '-1');
INSERT INTO phpbb_album_config VALUES ('rate', '1');
INSERT INTO phpbb_album_config VALUES ('rate_scale', '10');
INSERT INTO phpbb_album_config VALUES ('comment', '1');
INSERT INTO phpbb_album_config VALUES ('gd_version', '1');
INSERT INTO phpbb_album_config VALUES ('album_version', '.0.51');
INSERT INTO phpbb_album_config VALUES ('watermark_width', '10');
INSERT INTO phpbb_album_config VALUES ('watermark_height', '10');
INSERT INTO phpbb_album_config VALUES ('watermark_transparent', '0');

INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_dir', 'files');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('upload_img', 'images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('topic_icon', 'images/icon_clip.gif');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('display_order', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize', '262144');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_quota', '52428800');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_filesize_pm', '262144');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments', '10');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('max_attachments_pm', '1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('disable_mod', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_pm_attach', '1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('attachment_topic_review', '1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('allow_ftp_upload', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('show_apcp', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_server', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_path', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('download_path', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_user', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pass', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_display_inlined', '1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_width', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_max_height', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_width', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_link_height', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_create_thumbnail', '1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_min_thumb_filesize', '12000');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('img_imagick', '');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_upload_quota', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('default_pm_quota', '0');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('ftp_pasv_mode', '1');
INSERT INTO phpbb_attachments_config (config_name, config_value) VALUES ('use_gd2', '0');

INSERT INTO phpbb_config (config_name, config_value) VALUES ('sendmail_fix', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_autologin', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_photo_remote', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_photo_upload', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('photo_filesize', '40000');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('photo_max_height', '200');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('photo_max_width', '200');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('photo_path', 'images/photos');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_custom_rank', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('birthday_greeting', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_user_age', '100');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('min_user_age', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('birthday_check_day', '7');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cload', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cchat', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cstat', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cregist', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cstyles', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ccount', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cchat2', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cbirth', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cpost', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ctop', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cfriend', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cage', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cjoin', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cfrom', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cposts', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('clevell', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cleveld', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cignore', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cquick', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cgg', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('csearch', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cicq', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cllogin', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('clevelp', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cyahoo', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cmsn', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cjob', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cinter', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cemail', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cbbcode', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('chtml', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('csmiles', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('clang', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ctimezone', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cbstyle', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('refresh', '0' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_keywords', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('meta_description', '' );
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cavatar', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('clog', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cagent', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('login_require', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('crestrict', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('validate', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_b', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_i', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_u', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_q', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_c', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_l', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_im', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_ur', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_ce', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_f', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_s', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('button_hi', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('color_box', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('size_box', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('glow_box', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('freak', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_bbcode_quest', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sql', 'http://');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('cregist_b', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_custom_color', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('custom_color_view', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('custom_color_use', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('post_icon', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('auto_date', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('newest', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('download', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ipview', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_badwords', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('album_gallery', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('address_whois', 'http://www.dnsstuff.com/tools/whois.ch?ip=');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('u_o_t_d', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('expire', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('expire_value', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('numer_gg', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('haslo_gg', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('block_time', '40');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_login_error', '10');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('min_password_len', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('force_complex_password', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('password_not_login', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('del_user_notify', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('require_aim', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('require_website', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('require_location', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('post_footer', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('graphic', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_custom_rank', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_location', '20');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('custom_color_mod', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('custom_rank_mod', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig_image', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_images_path', 'images/signatures');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_image_filesize', '30000');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_image_max_width', '400');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sig_image_max_height', '50');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('hide_viewed_admin', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('hide_edited_admin', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('who_viewed', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('who_viewed_admin', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('edit_time', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('gender', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('require_gender', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('main_admin_id', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('day_to_prune', '120');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('banner_top', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('banner_top_enable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('banner_bottom', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('banner_bottom_enable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('header_enable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('not_edit_admin', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('staff_forums', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('staff_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilies_columns', '4');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilies_rows', '8');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('smilies_w_columns', '8');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('generate_time', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('name_color', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('desc_color', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mod_nick_color', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('warnings_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mod_warnings', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mod_edit_warnings', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mod_value_warning', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('write_warnings', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ban_warnings', '6');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('expire_warnings', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('warnings_mods_public', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('viewtopic_warnings', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_msg_enable', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('board_msg', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('width_forum', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('width_table', '800');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('width_color1', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('width_color2', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('table_border', '6');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rebuild_search', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('generate_time_admin', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('r_a_r_time', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('visitors', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('email_return_path', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('email_from', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('poster_posts', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sub_forum', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sub_forum_over', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('split_cat', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('split_cat_over', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('last_topic_title', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('last_topic_title_over', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('last_topic_title_length', '24');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sub_level_links', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('sub_level_links_over', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('display_viewonline', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('display_viewonline_over', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ignore_topics', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topic_color', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topic_color_all', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topic_color_mod', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_sig_image_img', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('last_dtable_notify', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rand_seed_last_update', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rand_seed', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_no_guestes', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_no_auth_users', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_no_auth_groups', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_disabled_users', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_disabled_groups', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_only_admin', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_popup_height', '250');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_popup_width', '700');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_popup_links_target', '2');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('report_disable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_avatar', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('last_visitors_time', '24');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_chars_admin', '6');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_sig_chars_mod', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('viewonline', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('restrict_smilies', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topic_preview', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('not_anonymous_posting', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('not_anonymous_quickreply', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('max_smilies', '24');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('portal_link', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('overlib',	'1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('notify_gg', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('admin_notify_gg',	'');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('admin_notify_reply', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('admin_notify_message', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topic_start_date', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topic_start_dateformat', 'd-m-y');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('autorepair_tables', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('check_address', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('echange_banner', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('banners_list', '<center><a href="http://phpbb.com" target="_blank"><img src="images/link_phpbb.gif" alt="" border="0" /></a></center><br />[banner]<center><a href="http://forumimages.com" target="_blank"><img src="images/link_forumimages.gif" alt="" border="0" /></a></center><br />[banner]<center><embed src="images/clock.swf" quality=high type="application/x-shockwave-flash" width="80" height="80" /></center>');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('split_messages', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('split_messages_admin', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('split_messages_mod', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('admin_html', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('jr_admin_html', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mod_html', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('helped', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('del_notify_method', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('del_notify_enable', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('del_notify_choice', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('open_in_windows', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('title_explain', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_action_unlocked', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_action_locked', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_action_moved', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_action_expired', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_action_edited_by_others', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_action_edited_self', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_action_edited_self_all', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('allow_mod_delete_actions', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('show_rules', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mod_spy', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('mod_spy_admin', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('post_overlib', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ph_days', '14');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ph_len', '8');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ph_mod', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('ph_mod_delete', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('newestuser', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('topiccount', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('postcount', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('usercount', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('lastpost', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('anonymous_simple', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('onmouse', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('birthday_data', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('data', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('last_resync', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('advert', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('advert_foot', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('view_ad_by', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('advert_width', '150');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('advert_separator', ' &bull; ');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('advert_separator_l', '<br /><hr />');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('adv_person_time', '30');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('group_rank_hack_version', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('disable_type', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rh_without_days', '3');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('rh_max_posts', '1000');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('public_category', '');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('last_visitors_time_count', '0');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('search_keywords_max', '5');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('protection_get', '1');
INSERT INTO phpbb_config (config_name, config_value) VALUES ('last_prune', '0');

INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_on', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('link_logo', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('own_header', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_header_body', '<table class="topbkg" width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td align="center"><a href="index.php"><img src="images/portal_logo.jpg" border="0" alt="Forum" /></a></td><td align="center"><span class="gensmall">To jest w³asny nag³ówek. Mo¿esz go ca³kowicie zmieniæ w panelu admina, prawdopodobnie kolorystyka jest nieodpowiednia, mo¿esz j± dobraæ w zale¿no¶ci jakiego stylu u¿ywasz. Jezeli w kodzie HTML nag³ówka wpiszesz tylko: <b>get_from_template</b> nag³ówek portalu bêdzie pobierany z pliku <b>portal_header.tpl</b> w katalogu aktualnego stylu, dzia³aj± w nim {ZMIENNE} stylów dok³adnie tak samo jak w nag³ówku forum.</span></td><td align="right"><img src="images/phpbb2_logor.jpg" alt="" /></td></tr></table><table width="100%" border="0" cellspacing="0" cellpadding="2"><tr><td class="topnav"><a href="index.php" class="mainmenu">Forum</a>  &#8226;  <a href="chatbox_mod/chatbox.php" class="mainmenu">Chat</a>  &#8226;  <a href="faq.php" class="mainmenu">Pomoc</a>  &#8226;  <a href="search.php" class="mainmenu">Szukaj</a>  &#8226;  <a href="memberlist.php" class="mainmenu">U¿ytkownicy</a>  &#8226;  <a href="groupcp.php" class="mainmenu">Grupy</a>  &#8226;  <a href="statistics.php" class="mainmenu">Statystyki</a>  &#8226;  <a href="album.php" class="mainmenu">Album</a>  &#8226;  <a href="dload.php" class="mainmenu">Download</a></td></tr></table><br />');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_footer_body', '<table class="topbkg" width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td align="center"><span class="gensmall">W tym miejscu mo¿esz ustawiæ w³asn± stopkê portalu</span></td></tr></table>');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('news_forum', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('body_news_forum', '<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline"><tr><td class="catHead" height="25"><span class="genmed"><b>Tytu³ newsów lub strony</b></span></td>\r\n</tr><tr><td class="row1" align="left"><span class="gensmall" style="line-height:150%">Dowolna tresc opisuj±ca portal, strone, forum ...<br /> </span></td></tr></table><br />');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('number_of_news', '20');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('news_length', '2000');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('witch_news_forum', '6');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('witch_poll_forum', '7');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('except_forum', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('poll', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('download_pos', 'right');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('portal_menu_a', 'left');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('links_a', 'left');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('links_a2', 'right');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('search_a', 'left');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('stat_a', 'left');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('recent_topics_a', 'right');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('top_posters_a', 'right');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('links1', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('links2', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('links3', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('links4', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('links5', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('links6', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('links7', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('links8', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module1', 'portal_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module2', 'register_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module3', 'info_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module4', 'search_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module5', 'stats_user_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module6', 'whoonline_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module7', 'poll_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module8', 'links_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module9', 'clock_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module10', 'custom_module1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module11', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module12', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module13', 'birthday_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module14', 'recent_topics_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module15', 'login_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module16', 'album_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module17', 'download');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module18', 'top_posters_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module19', 'chat_menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module20', 'blank_module1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module21', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module22', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module23', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('module24', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('links_body', '<object><center><br /><a href="http://phpbb.com" target="_blank"><img src="images/link_phpbb.gif" alt="" border="0" title="phpBB" /></a><br /><br /><a href="http://www.forumimages.com/" target="_blank"><img src="images/link_forumimages.gif" alt="" border="0" title="ForumImages" /></a><br /><br /><a href="http://phpbb.com/" target="_blank"><img src="images/links_google.gif" alt="" border="0" title="Google" /></a><br /><br /><a href="http://www.apache.org/" target="_blank"><img src="images/link_apache.gif" alt="" border="0" title="Apache Software Foundation" /></a></center></object><br /><br />');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom1_body', 'jaka¶ tre¶æ, lub tre¶æ i html');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom1_name', 'W³asne menu');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom1_body_a', 'left');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom1_body_on', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom2_body', 'jaka¶ tre¶æ, lub tre¶æ i html');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom2_name', 'W³asne menu 2');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom2_body_a', 'right');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom2_body_on', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_desc1', 'w³asny link');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_address1', 'http://www.przemo.org');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_desc2', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_address2', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_desc3', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_address3', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_desc4', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_address4', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_desc5', 'Statystyki');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_address5', 'statistics.php');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_desc6', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_address6', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_desc7', 'Kto tu rzadzi :)');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_address7', 'staff.php');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_desc8', 'wlasny link2');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('custom_address8', 'http://www.phpbb.com');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('blank1_body_on', '1');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('blank1_body', '<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline"><tr><td class="catHead" height="25" align="right"><span class="genmed"><b>Wlasny modul</b></span></td></tr><tr><td class="row1" align="right"><span class="genmed" style="line-height: 150%"><iframe src="http://phpbb.com" width="100%" height="300"></iframe></span></td></tr></table><br />');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('blank2_body_on', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('blank2_body', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('blank3_body_on', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('blank3_body', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('blank4_body_on', '0');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('blank4_body', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('birthday_a', 'right');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('info_a', 'left');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('login_a', 'right');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('whoonline_a', 'left');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('chat_a', 'right');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('register_a', 'right');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('album_recent_pics', '2');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('album_a', 'left');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('recent_pics', '2');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('album_pos', 'right');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('own_body', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('value_recent_topics', '10');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('value_top_posters', '10');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('ri_time', '');
INSERT INTO phpbb_portal_config (config_name, config_value) VALUES ('ri_data', '');

INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('install_date', 'time()');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('return_limit', '10');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('version', '2.1.3');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('modules_dir', 'stat_modules');
INSERT INTO phpbb_stats_config (config_name, config_value) VALUES ('page_views', '0');

INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_guest_view', '1');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_guest', '0');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_users_view', '1');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_users', '1');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_delete_all', '0');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_delete', '0');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_delete_m', '0');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_edit_all', '0');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_edit', '0');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_edit_m', '0');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_bbcode', '1');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('allow_smilies', '1');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('links_names', '1');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('make_links', '1');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('count_msg', '30');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('delete_days', '30');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('text_lenght', '500');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('word_lenght', '80');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('date_format', 'd.m.y, H:i:s');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('date_on', '1');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('shoutbox_on', '1');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('shout_width', '630');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('shout_height', '130');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('banned_user_id', '');
INSERT INTO phpbb_shoutbox_config (config_name, config_value) VALUES ('banned_user_id_view', '');
INSERT INTO	phpbb_shoutbox_config (config_name, config_value) VALUES ('shout_refresh', '5');
INSERT INTO	phpbb_shoutbox_config (config_name, config_value) VALUES ('sb_group_sel', 'all');
INSERT INTO	phpbb_shoutbox_config (config_name, config_value) VALUES ('usercall', '0');
INSERT INTO	phpbb_shoutbox_config (config_name, config_value) VALUES ('shoutbox_smilies', '0');

UPDATE phpbb_shoutbox_config SET config_value = 'd.m.y, H:i:s' WHERE config_name = 'date_format';
UPDATE phpbb_shoutbox_config SET config_value = '30' WHERE config_name = 'count_msg';

UPDATE phpbb_config SET config_value = '1.12.8' WHERE  config_name = 'version';
UPDATE phpbb_config SET config_value = 'http://whois.domaintools.com/' WHERE config_name = 'address_whois';

ALTER TABLE `phpbb_posts` ADD `post_start_time` INT NOT NULL DEFAULT '0' AFTER `post_time`;
