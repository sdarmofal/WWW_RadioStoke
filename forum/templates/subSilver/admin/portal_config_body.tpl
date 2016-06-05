
<h1>{L_CONFIGURATION_PORTAL_TITLE}</h1>

<p>{L_CONFIGURATION_PORTAL_E}</p>

<form action="{S_CONFIG_ACTION}" method="post"><table width="99%" cellpadding="4" cellspacing="1" border="0" align="center" class="forumline">
	<tr>
	  <th class="thHead" colspan="2">{L_GENERAL_PORTAL_SETTINGS}</th>
	</tr>
	<tr>
		<td class="row1">{L_PORTAL_ON}<br><span class="gensmall">{L_PORTAL_ON_E}</span></td>
		<td class="row2"><input type="radio" name="portal_on" value="1" {PORTAL_ON_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="portal_on" value="0" {PORTAL_ON_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LINK_LOGO}</td>
		<td class="row2"><input type="radio" name="link_logo" value="1" {LINK_LOGO_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="link_logo" value="0" {LINK_LOGO_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_OWN_HEADER}<br><span class="gensmall">{L_OWN_HEADER_E}</span></td>
		<td class="row2"><input type="radio" name="own_header" value="1" {OWN_HEADER_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="own_header" value="0" {OWN_HEADER_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_BODY_HEADER}<br><span class="gensmall">{L_BODY_HEADER_E}</span></td>
		<td class="row2"><textarea name="portal_header_body" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" rows="9" cols="60">{PORTAL_HEADER}</textarea></td>
	</tr>
	<tr>
		<td class="row1">{L_NEWS_FORUM}</td>
		<td class="row2"><input type="radio" name="news_forum" value="1" {NEWS_FORUM_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="news_forum" value="0" {NEWS_FORUM_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_BODY_NEWS_FORUM}<br><span class="gensmall">{L_BODY_NEWS_FORUM_E}</span></td>
		<td class="row2"><textarea name="body_news_forum" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" rows="5" cols="50">{BODY_NEWS_FORUM}</textarea></td>
	</tr>
	<tr>
		<td class="row1">{L_BODY_FOOTER}<br><span class="gensmall">{L_BODY_FOOTER_E}</span></td>
		<td class="row2"><textarea name="portal_footer_body" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" rows="9" cols="60">{PORTAL_FOOTER_BODY}</textarea></td>
	</tr>
	<tr>
		<td class="row1">{L_OWN_BODY}<br><span class="gensmall">{L_OWN_BODY_E}</span></td>
		<td class="row2"><textarea name="own_body" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" rows="9" cols="60">{OWN_BODY}</textarea></td>
	</tr>
	<tr>
		<td class="row1">{L_NUMBER_NEWS}</td>
		<td class="row2"><input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="number_of_news" size="4" value="{NUMBER_OF_NEWS}"></td>
	</tr>
	<tr>
		<td class="row1">{L_NEWS_LENGTH}</td>
		<td class="row2"><input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="news_length" size="5" value="{NEWS_LENGTH}"></td>
	</tr>
	<tr>
		<td class="row1">{L_WITCH_NEWS_FORUM}<br><span class="gensmall">{L_WITCH_NEWS_FORUM_E}</span></td>
		<td class="row2"><select class="post" name="witch_news_forum[]" size="7" multiple>{S_NEWS_FORUM}<option value="">--</option></select></td>
	</tr>
	<tr>
		<td class="row1">{L_WITCH_POLL_FORUM}</td>
		<td class="row2"><select class="post" name="witch_poll_forum[]" size="7" multiple>{S_POLL_OPTIONS}<option value="">--</option></select></td>
	</tr>
	<tr>
		<td class="row1">{L_ALBUM_RECENT_PICS}</td>
		<td class="row2"><input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="recent_pics" size="4" value="{RECENT_PICS}"></td>
	</tr>
	<tr>
		<td class="row1">{L_V_RECENT_TOPICS}</td>
		<td class="row2"><input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="value_recent_topics" size="4" value="{V_RECENT_TOPICS}"></td>
	</tr>
	<tr>
		<td class="row1">{L_V_TOP_POSTERS}</td>
		<td class="row2"><input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="value_top_posters" size="4" value="{V_TOP_POSTERS}"></td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS1}</td>
		<td class="row2"><input type="radio" name="links1" value="1" {LINKS1_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="links1" value="0" {LINKS1_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS2}</td>
		<td class="row2"><input type="radio" name="links2" value="1" {LINKS2_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="links2" value="0" {LINKS2_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS3}</td>
		<td class="row2"><input type="radio" name="links3" value="1" {LINKS3_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="links3" value="0" {LINKS3_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS4}</td>
		<td class="row2"><input type="radio" name="links4" value="1" {LINKS4_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="links4" value="0" {LINKS4_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS5}</td>
		<td class="row2"><input type="radio" name="links5" value="1" {LINKS5_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="links5" value="0" {LINKS5_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS6}</td>
		<td class="row2"><input type="radio" name="links6" value="1" {LINKS6_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="links6" value="0" {LINKS6_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS7}</td>
		<td class="row2"><input type="radio" name="links7" value="1" {LINKS7_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="links7" value="0" {LINKS7_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS8}</td>
		<td class="row2"><input type="radio" name="links8" value="1" {LINKS8_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="links8" value="0" {LINKS8_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS}</td>
		<td class="row2"><span class="gensmall">{L_LINKS_E}</span></td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_DESC} 1&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_desc1" size="20" maxlength="90" value="{CUSTOM_DESC1}"></td>
		<td class="row2">{L_CUSTOM_ADDRESS} 1&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_address1" size="20" maxlength="90" value="{CUSTOM_ADDRESS1}"></td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_DESC} 2&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_desc2" size="20" maxlength="90" value="{CUSTOM_DESC2}"></td>
		<td class="row2">{L_CUSTOM_ADDRESS} 2&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_address2" size="20" maxlength="90" value="{CUSTOM_ADDRESS2}"></td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_DESC} 3&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_desc3" size="20" maxlength="90" value="{CUSTOM_DESC3}"></td>
		<td class="row2">{L_CUSTOM_ADDRESS} 3&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_address3" size="20" maxlength="90" value="{CUSTOM_ADDRESS3}"></td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_DESC} 4&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_desc4" size="20" maxlength="90" value="{CUSTOM_DESC4}"></td>
		<td class="row2">{L_CUSTOM_ADDRESS} 4&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_address4" size="20" maxlength="90" value="{CUSTOM_ADDRESS4}"></td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_DESC} 5&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_desc5" size="20" maxlength="90" value="{CUSTOM_DESC5}"></td>
		<td class="row2">{L_CUSTOM_ADDRESS} 5&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_address5" size="20" maxlength="90" value="{CUSTOM_ADDRESS5}"></td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_DESC} 6&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_desc6" size="20" maxlength="90" value="{CUSTOM_DESC6}"></td>
		<td class="row2">{L_CUSTOM_ADDRESS} 6&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_address6" size="20" maxlength="90" value="{CUSTOM_ADDRESS6}"></td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_DESC} 7&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_desc7" size="20" maxlength="90" value="{CUSTOM_DESC7}"></td>
		<td class="row2">{L_CUSTOM_ADDRESS} 7&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_address7" size="20" maxlength="90" value="{CUSTOM_ADDRESS7}"></td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_DESC} 8&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_desc8" size="20" maxlength="90" value="{CUSTOM_DESC8}"></td>
		<td class="row2">{L_CUSTOM_ADDRESS} 8&nbsp;&nbsp;<input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom_address8" size="20" maxlength="90" value="{CUSTOM_ADDRESS8}"></td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_NAME} 1<br><span class="gensmall">{L_CUSTOM_NAME_E}</span></td>
		<td class="row2"><input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom1_name" size="40" maxlength="500" value="{CUSTOM1_NAME}"></td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_BODY} 1<br><span class="gensmall">{L_CUSTOM_BODY_E}</span></td>
		<td class="row2"><textarea name="custom1_body" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" rows="3" cols="40">{CUSTOM1_BODY}</textarea><br><input type="radio" name="custom1_body_a" value="left" {CUSTOM1_BODY_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="custom1_body_a" value="center" {CUSTOM1_BODY_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="custom1_body_a" value="right" {CUSTOM1_BODY_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_NAME} 2<br><span class="gensmall">{L_CUSTOM_NAME_E}</span></td>
		<td class="row2"><input type="text" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" name="custom2_name" size="40" maxlength="500" value="{CUSTOM2_NAME}"></td>
	</tr>
	<tr>
		<td class="row1">{L_CUSTOM_BODY} 2<br><span class="gensmall">{L_CUSTOM_BODY_E}</span></td>
		<td class="row2"><textarea name="custom2_body" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" rows="3" cols="40">{CUSTOM2_BODY}</textarea><br><input type="radio" name="custom2_body_a" value="left" {CUSTOM2_BODY_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="custom2_body_a" value="center" {CUSTOM2_BODY_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="custom2_body_a" value="right" {CUSTOM2_BODY_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_BLANK_BODY_ON}</td>
		<td class="row2"><span class="gensmall">{L_BLANK_BODY_ON_E}</span></td>
	</tr>
	<tr>
		<td class="row1" align="right">1 <textarea name="blank1_body" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" rows="5" cols="30">{BLANK1_BODY}</textarea><br>
		<input type="radio" name="blank1_body_on" value="1" {BLANK1_BODY_ON_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="blank1_body_on" value="0" {BLANK1_BODY_ON_NO}> {L_NO}</td>
		<td class="row2">2 <textarea name="blank2_body" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" rows="5" cols="30">{BLANK2_BODY}</textarea><br>
		&nbsp;&nbsp;<input type="radio" name="blank2_body_on" value="1" {BLANK2_BODY_ON_YES}>{L_YES}&nbsp;&nbsp;<input type="radio" name="blank2_body_on" value="0" {BLANK2_BODY_ON_NO}> {L_NO}</td>
	</tr>
		<tr>
		<td class="row1" align="right">3 <textarea name="blank3_body" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" rows="5" cols="30">{BLANK3_BODY}</textarea><br>
		<input type="radio" name="blank3_body_on" value="1" {BLANK3_BODY_ON_YES}> {L_YES}&nbsp;&nbsp;<input type="radio" name="blank3_body_on" value="0" {BLANK3_BODY_ON_NO}> {L_NO}</td>
		<td class="row2">4 <textarea name="blank4_body" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" rows="5" cols="30">{BLANK4_BODY}</textarea><br>
		&nbsp;&nbsp;<input type="radio" name="blank4_body_on" value="1" {BLANK4_BODY_ON_YES}>{L_YES}&nbsp;&nbsp;<input type="radio" name="blank4_body_on" value="0" {BLANK4_BODY_ON_NO}> {L_NO}</td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS_BODY}</td>
		<td class="row2"><textarea name="links_body" class="post2" onFocus="Active(this)" onBlur="NotActive(this)" rows="4" cols="40">{LINKS_BODY}</textarea></td>
	</tr>
	<tr>
		<td class="row1">{L_POLL}</td>
		<td class="row2"><input type="radio" name="poll" value="1" {POLL_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="poll" value="0" {POLL_NONE}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="poll" value="2" {POLL_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_DOWNLOAD_POS}</td>
		<td class="row2"><input type="radio" name="download_pos" value="left" {DOWNLOAD_POS_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="download_pos" value="center" {DOWNLOAD_POS_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="download_pos" value="right" {DOWNLOAD_POS_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_PORTAL_MENU_A}</td>
		<td class="row2"><input type="radio" name="portal_menu_a" value="left" {PORTAL_MENU_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="portal_menu_a" value="center" {PORTAL_MENU_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="portal_menu_a" value="right" {PORTAL_MENU_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_LINKS_A}</td>
		<td class="row2"><input type="radio" name="links_a" value="left" {LINKS_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="links_a" value="center" {LINKS_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="links_a" value="right" {LINKS_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_SEARCH_A}<br><span class="gensmall">{L_SEARCH_A_E}</span></td>
		<td class="row2"><input type="radio" name="search_a" value="left" {SEARCH_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="search_a" value="center" {SEARCH_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="search_a" value="right" {SEARCH_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_STAT_A}</td>
		<td class="row2"><input type="radio" name="stat_a" value="left" {STAT_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="stat_a" value="center" {STAT_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="stat_a" value="right" {STAT_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_ALBUM_POS}</td>
		<td class="row2"><input type="radio" name="album_pos" value="left" {ALBUM_POS_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="album_pos" value="center" {ALBUM_POS_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="album_pos" value="right" {ALBUM_POS_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_RECENT_TOPICS_A}</td>
		<td class="row2"><input type="radio" name="recent_topics_a" value="left" {RECENT_TOPICS_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="recent_topics_a" value="center" {RECENT_TOPICS_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="recent_topics_a" value="right" {RECENT_TOPICS_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_TOP_POSTERS_A}</td>
		<td class="row2"><input type="radio" name="top_posters_a" value="left" {TOP_POSTERS_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="top_posters_a" value="center" {TOP_POSTERS_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="top_posters_a" value="right" {TOP_POSTERS_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_BIRTHDAY_A}</td>
		<td class="row2"><input type="radio" name="birthday_a" value="left" {BIRTHDAY_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="birthday_a" value="center" {BIRTHDAY_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="birthday_a" value="right" {BIRTHDAY_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_INFO_A}</td>
		<td class="row2"><input type="radio" name="info_a" value="left" {INFO_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="info_a" value="center" {INFO_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="info_a" value="right" {INFO_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_LOGIN_A}</td>
		<td class="row2"><input type="radio" name="login_a" value="left" {LOGIN_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="login_a" value="center" {LOGIN_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="login_a" value="right" {LOGIN_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_WHOONLINE_A}</td>
		<td class="row2"><input type="radio" name="whoonline_a" value="left" {WHOONLINE_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="whoonline_a" value="center" {WHOONLINE_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="whoonline_a" value="right" {WHOONLINE_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_CHAT_A}</td>
		<td class="row2"><input type="radio" name="chat_a" value="left" {CHAT_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="chat_a" value="center" {CHAT_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="chat_a" value="right" {CHAT_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
		<td class="row1">{L_REGISTER_A}</td>
		<td class="row2"><input type="radio" name="register_a" value="left" {REGISTER_A_LEFT}> {L_ALIGN_LEFT}&nbsp;&nbsp;<input type="radio" name="register_a" value="center" {REGISTER_A_CENTER}> {L_ALIGN_CENTER}&nbsp;&nbsp;<input type="radio" name="register_a" value="right" {REGISTER_A_RIGHT}> {L_ALIGN_RIGHT}</td>
	</tr>
	<tr>
	  <th colspan="2" class="thHead">{L_MODULES}</th>
	 </tr>
	 <tr>
	  <td class="row1" colspan="2" align="center"><span class="gensmall">{L_MODULES_E}</span></td>
	</tr> 
		<tr>
		  <td class="row1" width="50%" align="right"><span class="gen">{L_LMODULE}</span></td>
		  <td class="row2" align="left" width="50%"><span class="gen">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{L_RMDULE}</span></td>
		</tr>
		<tr>
			<td class="row1" align="right"><span class="gen">1. {JUMP_MODULE1}</span></td>
			<td class="row2" align="left"><span class="gen">13. {JUMP_MODULE13}</span></td>
		</tr>
		<tr>
		        <td class="row1" align="right"><span class="gen">2. {JUMP_MODULE2}</span></td>
			<td class="row2" align="left"><span class="gen">14. {JUMP_MODULE14}</span></td>
		</tr>
		<tr>
		        <td class="row1" align="right"><span class="gen">3. {JUMP_MODULE3}</span></td>
			<td class="row2" align="left"><span class="gen">15. {JUMP_MODULE15}</span></td>
		</tr>
		<tr>
		        <td class="row1" align="right"><span class="gen">4. {JUMP_MODULE4}</span></td>
			<td class="row2" align="left"><span class="gen">16. {JUMP_MODULE16}</span></td>
		</tr>
		<tr>
		        <td class="row1" align="right"><span class="gen">5. {JUMP_MODULE5}</span></td>
			<td class="row2" align="left"><span class="gen">17. {JUMP_MODULE17}</span></td>
		</tr>
		<tr>
		        <td class="row1" align="right"><span class="gen">6. {JUMP_MODULE6}</span></td>
			<td class="row2" align="left"><span class="gen">18. {JUMP_MODULE18}</span></td>
		</tr>
		<tr>
		        <td class="row1" align="right"><span class="gen">7. {JUMP_MODULE7}</span></td>
			<td class="row2" align="left"><span class="gen">19. {JUMP_MODULE19}</span></td>
		</tr>
		<tr>
		        <td class="row1" align="right"><span class="gen">8. {JUMP_MODULE8}</span></td>
			<td class="row2" align="left"><span class="gen">20. {JUMP_MODULE20}</span></td>
		</tr>
		<tr>
		        <td class="row1" align="right"><span class="gen">9. {JUMP_MODULE9}</span></td>
			<td class="row2" align="left"><span class="gen">21. {JUMP_MODULE21}</span></td>
		</tr>
		<tr>
		        <td class="row1" align="right"><span class="gen">10. {JUMP_MODULE10}</span></td>
			<td class="row2" align="left"><span class="gen">22. {JUMP_MODULE22}</span></td>
		</tr>
		<tr>
		        <td class="row1" align="right"><span class="gen">11. {JUMP_MODULE11}</span></td>
			<td class="row2" align="left"><span class="gen">23. {JUMP_MODULE23}</span></td>
		</tr>
		<tr>
		        <td class="row1" align="right"><span class="gen">12. {JUMP_MODULE12}</span></td>
			<td class="row2" align="left"><span class="gen">24. {JUMP_MODULE24}</span></td>
		</tr>
		<tr>
			<td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_SUBMIT}" class="mainoption">&nbsp;&nbsp;<input type="reset" value="{L_RESET}" class="liteoption"></td>
		</tr>
</table></form>
<br clear="all">
