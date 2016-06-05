
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr>
	<th class="thCornerL">{L_AUTHOR}</th>
	<th class="thCornerR">{L_COMMENTS}</th>
  </tr>
<!-- BEGIN no_comment -->
  <tr>
	<td colspan="2" class="row1" align="center"><span class="gen">{L_NO_COMMENTS}</span></td>
  </tr>
<!-- END no_comment -->
<!-- BEGIN text -->
  <tr>
	<td width="150" align="left" valign="top" class="row1"><span class="name"><b>{text.POSTER}</b></span><br><span class="postdetails">{text.POSTER_RANK}<br>{text.RANK_IMAGE}{text.POSTER_AVATAR}<br><br>{text.POSTER_JOINED}<br>{text.POSTER_POSTS}<br>{text.POSTER_FROM}</span><br>&nbsp;</td>
	<td class="row1" height="28" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%" valign="middle"><span class="postdetails"><img src="{IMG_POST}" border="0">{L_POSTED}: {text.TIME}<span class="gen">&nbsp;</span>&nbsp; &nbsp;{L_COMMENT_SUBJECT}: {text.TITLE}</span></td>
				<td align="right">
				<!-- BEGIN is_admin -->
				<a href="{text.is_admin.U_COMMENT_DELETE}"><img src="{DELETE_IMG}" alt="{L_COMMENT_DELETE}" title="{L_COMMENT_DELETE}" border="0"></a>
				<!-- END is_admin -->
				</td>
			</tr>
			<tr> 
				<td colspan="2"><hr></td>
			</tr>
			<tr>
				<td colspan="2"valign="top"><span class="postbody">{text.TEXT}</span></td>
			</tr>
		</table>
	</td>
  </tr>
  <tr>
	<td class="row1" width="150" align="left" valign="middle"><span class="nav"><a href="#top" class="nav">{L_BACK_TO_TOP}</a></span></td>
	<td class="row1"></td>
  </tr>
  <tr> 
	<td class="spaceRow" colspan="2" height="1"><img src="{SPACER}" alt="" width="1" height="1"></td>
  </tr>
<!-- END text -->
  <tr>
	<td colspan="2" class="catBottom">&nbsp;</td>
  </tr>
</table>
<!-- BEGIN auth_post -->
<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
  <tr>
	<td><a href="{U_COMMENT_DO}">{L_COMMENT_ADD}</a></td>
  </tr>
</table>
<br clear="all">
<!-- END auth_post -->




