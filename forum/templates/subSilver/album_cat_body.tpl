<form action="{S_ALBUM_ACTION}" method="post">
<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td valign="bottom" width="100%"><a class="maintitle" href="{U_VIEW_CAT}">{CAT_TITLE}</a><br>
		<span class="gensmall"><b>{L_MODERATORS}: {MODERATORS}</b></span></td>
	<td align="right" valign="bottom" nowrap="nowrap"><span class="nav">{PAGINATION}</span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="2" border="0">
  <tr>
	<td><a href="{U_UPLOAD_PIC}"><b>{L_UPLOAD_PIC}</b></a></td>
  </tr>
<tr>
<td class="nav" width="100%"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a class="nav" href="{U_ALBUM}">{L_ALBUM}</a> -> <a class="nav" href="{U_VIEW_CAT}">{CAT_TITLE}</a></span></td>
</tr>
</table>
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thTop" height="25" align="center" colspan="{S_COLS}" nowrap="nowrap">{L_CATEGORY} :: {CAT_TITLE}</th>
  </tr>
  <!-- BEGIN no_pics -->
  <tr>
	<td class="row1" align="center" height="50"><span class="gen">{L_NO_PICS}</span></td>
  </tr>
  <!-- END no_pics -->
  <!-- BEGIN picrow -->
  <tr>
  <!-- BEGIN piccol -->
	<td align="center" width="{S_COL_WIDTH}" class="row1"><span class="genmed"><a href="{picrow.piccol.U_PIC}" {TARGET_BLANK}><img src="{picrow.piccol.THUMBNAIL}" border="0" alt="{picrow.piccol.DESC}" title="{picrow.piccol.DESC}" vspace="10"></a><br>{picrow.piccol.APPROVAL}</span></td>
  <!-- END piccol -->
  </tr>
  <tr>
  <!-- BEGIN pic_detail -->
	<td class="row2"><span class="gensmall">
	{L_PIC_TITLE}: {picrow.pic_detail.TITLE}<br>
	{L_POSTER}: {picrow.pic_detail.POSTER}<br>
	{L_POSTED}: {picrow.pic_detail.TIME}<br>
	{L_VIEW}: {picrow.pic_detail.VIEW}<br>
	{picrow.pic_detail.RATING}
	{picrow.pic_detail.COMMENTS}
	{picrow.pic_detail.IP}
	{picrow.pic_detail.EDIT}  {picrow.pic_detail.DELETE}  {picrow.pic_detail.LOCK}  {picrow.pic_detail.MOVE}</span>
	</td>
  <!-- END pic_detail -->
  </tr>
  <!-- END picrow -->
  <tr>
	<td class="catBottom" colspan="{S_COLS}" align="center" height="28">
		<span class="gensmall">{L_SELECT_SORT_METHOD}:
		<select name="sort_method">
			<option {SORT_TIME} value='pic_time'>{L_TIME}</option>
			<option {SORT_PIC_TITLE} value='pic_title'>{L_PIC_TITLE}</option>
			<option {SORT_USERNAME} value='username'>{L_USERNAME}</option>
			<option {SORT_VIEW} value='pic_view_count'>{L_VIEW}</option>
			{SORT_RATING_OPTION}
			{SORT_COMMENTS_OPTION}
			{SORT_NEW_COMMENT_OPTION}
		</select>
		&nbsp;{L_ORDER}:
		<select name="sort_order">
			<option {SORT_ASC} value='ASC'>{L_ASC}</option>
			<option {SORT_DESC} value='DESC'>{L_DESC}</option>
		</select>
		&nbsp;<input type="submit" name="submit" value="{L_SORT}" class="liteoption"></span>
	</td>
  </tr>
</table>

<table width="100%" cellspacing="2" border="0" cellpadding="2">
  <tr>
	<td><a href="{U_UPLOAD_PIC}"><b>{L_UPLOAD_PIC}</b></a></td>
	</tr>
	<tr>
	<td width="100%"><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a class="nav" href="{U_ALBUM}">{L_ALBUM}</a> -> <a class="nav" href="{U_VIEW_CAT}">{CAT_TITLE}</a></span></td>
	<span class="nav">{PAGINATION}</span></td>
  </tr>
  <tr>
	<td colspan="3"><span class="nav">{PAGE_NUMBER}</span></td>
  </tr>
</table>
</form>

<table width="100%" cellspacing="0" border="0" cellpadding="0">
  <tr>
	<td align="right" class="gensmall" nowrap="nowrap">{ALBUM_JUMPBOX}</td>
  </tr>
  <tr>
	<td align="right" class="gensmall">{S_AUTH_LIST}</td>
  </tr>
</table>

<br>

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Powered by Photo Album Addon {ALBUM_VERSION} &copy; 2002-2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a></div>