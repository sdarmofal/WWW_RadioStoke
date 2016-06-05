<table width="100%" cellspacing="0" cellpadding="2" border="0">
  <tr>
	<td><span class="gensmall">
	<!-- BEGIN switch_user_logged_in -->
	{LAST_VISIT_DATE}<br>
	<!-- END switch_user_logged_in -->
	{CURRENT_TIME}<br>
	</span><span class="nav"><a href="{U_INDEX}" class="nav">{L_INDEX}</a> -> <a href="{U_ALBUM}" class="nav">{L_ALBUM}</a> {SUBCAT_NAV}</span></td>
  </tr>
</table>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
	<th width="70%" class="thCornerL" height="25" nowrap="nowrap">&nbsp;{L_CATEGORY}&nbsp;</th>
	<th width="60" class="thTop" nowrap="nowrap">&nbsp;{L_PICS}&nbsp;</th>
	<th class="thCornerR" nowrap="nowrap">&nbsp;{L_LAST_PIC}&nbsp;</th>
  </tr>
  <tr>
	<td class="catLeft" colspan="3" height="28"><span class="cattitle">{L_PUBLIC_CATS} {SUBCAT_NAV}</span></td>
  </tr>
  <!-- BEGIN catrow -->
  <tr>
	<td class="row1" height="50"><span class="forumlink"> <a href="{catrow.U_VIEW_CAT}" class="forumlink">{catrow.CAT_TITLE}</a><br>
	  </span><span class="genmed">{catrow.CAT_DESC}<br>
	  </span><span class="gensmall">{catrow.L_MODERATORS} {catrow.MODERATORS}</span>{catrow.SUBCATS}</td>
	<td class="row2" align="center"><span class="gensmall">{catrow.PICS}</span></td>
	<td class="row2" align="center" nowrap="nowrap"><span class="gensmall">{catrow.LAST_PIC_INFO}</span></td>
  </tr>
  <!-- END catrow -->
  <tr>
	<td class="catbottom" colspan="3" height="28"><span class="cattitle"><a href="{U_USERS_PERSONAL_GALLERIES}" class="cattitle">{L_USERS_PERSONAL_GALLERIES}</a>&nbsp;&raquo;&nbsp;<a href="{U_YOUR_PERSONAL_GALLERY}" class="cattitle">{L_YOUR_PERSONAL_GALLERY}</a></span></td>
  </tr>
</table>

<table width="100%" cellspacing="2" cellpadding="1" border="0">
  <tr>
	<td align="right"><span class="gensmall">{S_TIMEZONE}</span></td>
  </tr>
</table>

<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
  <tr>
	<th class="thTop" height="25" colspan="{S_COLS}" nowrap="nowrap">{L_RECENT_PUBLIC_PICS}</th>
  </tr>
  <!-- BEGIN no_pics -->
  <tr>
	<td class="row1" align="center" colspan="{S_COLS}" height="50"><span class="gen">{L_NO_PICS}</span></td>
  </tr>
  <!-- END no_pics -->
  <!-- BEGIN recent_pics -->
  <tr>
  <!-- BEGIN recent_col -->
	<td class="row1" width="{S_COL_WIDTH}" align="center"><a href="{recent_pics.recent_col.U_PIC}"><img src="{recent_pics.recent_col.THUMBNAIL}" border="0" alt="{recent_pics.recent_col.DESC}" title="{recent_pics.recent_col.DESC}" vspace="10"></a></td>
  <!-- END recent_col -->
  </tr>
  <tr>
  <!-- BEGIN recent_detail -->
    <td class="row2"><span class="gensmall">{L_PIC_TITLE}: {recent_pics.recent_detail.TITLE}<br>
  	{L_POSTER}: {recent_pics.recent_detail.POSTER}<br>{L_POSTED}: {recent_pics.recent_detail.TIME}<br>
  	{L_VIEW}: {recent_pics.recent_detail.VIEW}<br>{recent_pics.recent_detail.RATING}{recent_pics.recent_detail.COMMENTS}{recent_pics.recent_detail.IP}</span></td>
  <!-- END recent_detail -->
  </tr>
  <!-- END recent_pics -->
</table>

<br clear="all">

<!--
You must keep my copyright notice visible with its original content
-->
<div align="center" style="font-family: Verdana; font-size: 10px; letter-spacing: -1px">Powered by Photo Album Addon {ALBUM_VERSION} &copy; 2002-2003 <a href="http://smartor.is-root.com" target="_blank">Smartor</a></div>