<!--<td class="catHead" height="25" align="' . $portal_config['album_pos'] . '"><span class="genmed"><b>' . $lang_last_pics . '</b></span>
</td></tr><tr><td>-->

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<td class="catHead" align="{ALBUM_ALIGN}" height="25"><span class="genmed"><b>{L_LAST_PIC}</b></span></td>
	</tr>
	<!-- BEGIN album_pics -->
	<tr>
		<td class="row1" align="{ALBUM_ALIGN}"><span class="gensmall" style="line-height: 150%">
		<center><b>{album_pics.PIC_TITLE}</b><br><a href="{album_pics.PIC_SRC}"{album_pics.TARGET_B} title="{album_pics.PIC_DESC}">
		<img src="{album_pics.PIC_THUMB}" border="0" alt=""></a></center>
		{L_POSTER}: {album_pics.RECENT_POSTER}<br>{album_pics.PIC_DATE}<br>
		<a href="{album_pics.RATE_URL}">{L_RATING}</a>: {album_pics.RATING}<br>
		<a href="{album_pics.COMMENT_URL}">{L_COMMENTS}</a>: {album_pics.COMMENTS}</span></td>
	</tr>
	<!-- END album_pics -->
</table>
<br>
