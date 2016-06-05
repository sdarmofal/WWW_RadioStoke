<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<td class="catHead" align="{INFO_ALIGN}" height="25"><span class="genmed"><b>{L_WELCOME} {USERNAME}</b></span></td>
	</tr>
	<tr>
		<td class="row1" align="{INFO_ALIGN}"><span class="gensmall">{CURRENT_TIME}</span></td>
	</tr>
	<!-- BEGIN user_inf -->
	<tr>
		<td class="row2" align="center"><span class="gensmall">{user_inf.AVATAR_IMG}</span></td>
	</tr>
	<tr>
		<td class="row1" align="{INFO_ALIGN}"><span class="gensmall">{user_inf.LAST_VISIT}</td>
	</tr>
	<!-- BEGIN unread -->
	<tr>
		<td class="row2" align="{INFO_ALIGN}"><span class="gensmall"><a href="{U_SEARCH_NEW}" class="gensmall">{L_SEARCH_NEW} [{COUNT_NEW_POSTS}]</a></td>
	</tr>
	<!-- END unread -->
	<!-- BEGIN lastvisit -->
	<tr>
		<td class="row2" align="{INFO_ALIGN}"><span class="gensmall"><a href="{U_SEARCH_LASTVISIT}" class="gensmall">{L_SEARCH_LASTVISIT}</a></td>
	</tr>
	<!-- END lastvisit -->
	<!-- END user_inf -->
	<!-- BEGIN change_style -->
	<tr>
		<td class="row1" align="{INFO_ALIGN}"><form method="post" name="quickchange" action="{change_style.S_ACTION}"><span class="gensmall">{change_style.L_CHANGE_STYLE}: {change_style.STYLE_SELECT}</span></form></td>
	</tr>
	<!-- END change_style -->
</table>
<br>
