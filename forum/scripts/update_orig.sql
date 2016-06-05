INSERT INTO phpbb_album VALUES (6, 'af8a9f4b3bc6ef0c9174b2b46051f5a7.jpg', 'af8a9f4b3bc6ef0c9174b2b46051f5a7.jpg', 'Zdjecie 4', 'opis zdjecia opis zdjecia opis zdjecia opis zdjecia', 2, 'Przemo', '7f000001', 1055091404, 1, 5, 0, 1);
INSERT INTO phpbb_album VALUES (3, '324c3dcd885b202cbe12358ab21e3073.jpg', '324c3dcd885b202cbe12358ab21e3073.jpg', 'Zdjecie 2', '', 2, 'Przemo', '7f000001', 1055091316, 1, 0, 0, 1);
INSERT INTO phpbb_album VALUES (5, '66738c6936cc0a48670409a2a85dcf7a.jpg', '66738c6936cc0a48670409a2a85dcf7a.jpg', 'Las', 'LasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLasLas', 2, 'Przemo', '7f000001', 1055091390, 1, 0, 0, 1);

INSERT INTO phpbb_album_cat VALUES (1, 0, 0, 'Przyroda', 'Tutaj dajemy zdjêcia krajobrazów :)', 10, -1, 0, 0, 0, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (1,'Images',1,1,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (2,'Archives',0,1,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (3,'Plain Text',0,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (4,'Documents',0,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (5,'Real Media',0,0,2,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (6,'Streams',2,0,1,'',0,'');
INSERT INTO phpbb_extension_groups (group_id, group_name, cat_id, allow_group, download_mode, upload_icon, max_filesize, forum_permissions) VALUES (7,'Flash Files',3,0,1,'',0,'');

INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (1, 1, 'gif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (2, 1, 'png', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (3, 1, 'jpeg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (4, 1, 'jpg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (5, 1, 'tif', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (6, 1, 'tga', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (7, 2, 'gtar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (8, 2, 'gz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (9, 2, 'tar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (10, 2, 'zip', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (11, 2, 'rar', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (12, 2, 'ace', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (13, 3, 'txt', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (14, 3, 'c', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (15, 3, 'h', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (16, 3, 'cpp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (17, 3, 'hpp', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (18, 3, 'diz', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (19, 4, 'xls', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (20, 4, 'doc', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (21, 4, 'dot', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (22, 4, 'pdf', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (23, 4, 'ai', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (24, 4, 'ps', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (25, 4, 'ppt', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (26, 5, 'rm', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (27, 6, 'wma', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (31, 6, 'avi', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (32, 6, 'mpg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (33, 6, 'mpeg', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (34, 6, 'mp3', '');
INSERT INTO phpbb_extensions (ext_id, group_id, extension, comment) VALUES (35, 6, 'wav', '');

INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (1,'php');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (2,'php3');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (3,'php4');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (4,'phtml');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (5,'pl');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (6,'asp');
INSERT INTO phpbb_forbidden_extensions (ext_id, extension) VALUES (7,'cgi');

INSERT INTO phpbb_pa_cat VALUES (1, 'Test Category', 'Test category', 0, 0, 0, 1);
INSERT INTO phpbb_pa_settings (settings_id, settings_dbname, settings_sitename, settings_dburl, settings_topnumber, settings_homeurl, settings_newdays, settings_stats, settings_viewall, settings_showss, settings_disable, allow_html, allow_bbcode, allow_smilies, allow_comment_links, no_comment_link_message, allow_comment_images, no_comment_image_message, max_comment_chars, directly_linked) VALUES ('1', 'Download Index', 'My Site', 'http://yoursite_URL/phpBB2', '10', 'http://yoursite_URL', '5', '0', '1', '1', '0', '0', '1', '1', '0', 'No links please', '0', 'No images please', '1000', '0');

INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (1, 'Low', 262144);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (2, 'Medium', 2097152);
INSERT INTO phpbb_quota_limits (quota_limit_id, quota_desc, quota_limit) VALUES (3, 'High', 5242880);

INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('1', 'top_words', '1', '1', '10', '1440', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('2', 'top_smilies', '1', '1', '20', '1000', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('3', 'most_active_topics', '1', '1', '30', '0', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('4', 'most_viewed_topics', '1', '1', '40', '0', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('5', 'new_topics_by_month', '1', '1', '50', '0', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('6', 'latest_topics', '1', '1', '60', '0', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('7', 'new_posts_by_month', '1', '1', '70', '0', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('8', 'top_posters', '1', '1', '80', '0', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('9', 'last_active_users', '1', '1', '90', '0', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('10', 'new_users_by_month', '1', '1', '100', '0', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('11', 'users_from_where', '1', '1', '110', '0', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('12', 'age_statistics', '1', '1', '120', '0', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('13', 'users_gender', '1', '1', '130', '1440', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
INSERT INTO phpbb_stats_modules (module_id, name, active, installed, display_order, update_time, auth_value, module_info_cache, module_db_cache, module_result_cache, module_info_time, module_cache_time) VALUES ('14', 'priv_msgs', '1', '1', '140', '0', '0', '[BLOB]', '[BLOB]', '[BLOB]', '0', '0');
