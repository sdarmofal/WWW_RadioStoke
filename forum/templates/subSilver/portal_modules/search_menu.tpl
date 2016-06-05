<script language="JavaScript" type="text/javascript">
<!--
	function checkSearch()
	{
		if (document.search_block.search_engine.value == "google")
		{
			window.open("http://www.google.com/search?q=" + document.search_block.search_keywords.value, "_google", "");
			return false;
		}
		else
		{
			return true;
		}
	}
//-->
</script>
<form name="search_block" method="post" action="{S_SEARCH_ACTION}" onSubmit="return checkSearch()">
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<td class="catHead" align="{SEARCH_ALIGN}" height="25"><span class="genmed"><b>{L_SEARCH}</b></span></td>
	</tr>
	<tr>
		<td class="row1" align="{LINKS_ALIGN}"><span class="gensmall" style="line-height=150%">{L_SEARCH}:<br><input class="post" type="text" name="search_keywords" size="15"></span>
	</td>
	</tr>
	<tr>
		<td class="row2" align="{LINKS_ALIGN}"><span class="gensmall" style="line-height=150%">{L_SEARCH_AT}:<br><select class="post" name="search_engine"><option value="site">Forum</option><option value="google">Google</option></select><br><a href="{U_SEARCH}" class="mainmenu">{L_ADVANCED_SEARCH}</a></span></td>
	</tr>
	<tr>
		<td class="row1" align="center"><input type="hidden" name="search_fields" value="all"><input type="hidden" name="show_results" value="topics"><input class="mainoption" type="submit" value="{L_SEARCH}"></td>
	</tr>
</table>
</form>
<br>
