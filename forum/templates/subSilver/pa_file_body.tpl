{LOCBAR}
<table width="100%" cellpadding="3" cellspacing="1" class="forumline">
  <tr> 
	<th class="thHead" colspan="2">{L_FILE} - {FILE_NAME}</th>
  </tr>
<tr> 
	<td class="row2" valign="middle" width="20%"><span class="gen">{L_DESC}:</span></td>
	<td class="row1" valign="middle" width="80%"><span class="gen">{FILE_LONGDESC}</td>
  </tr>
{CREATOR}
{VERSION}
{SSURL}
{DOCSURL} 
<tr> 
	<td class="row2" valign="middle"><span class="gen">{L_DATE}:</span></td>
	<td class="row1" valign="middle"><span class="gen">{TIME}</span></td>
  </tr>
  <tr> 
	<td class="row2" valign="middle"><span class="gen">{L_LASTTDL}:</span></td>
	<td class="row1" valign="middle"><span class="gen">{LAST}</span></td>
  </tr>
  <tr> 
	<td class="row2" valign="middle"><span class="gen">{L_RATING}:</span></td>
	<td class="row1" valign="middle"><span class="gen">{RATING}/10 ({FILE_VOTES} {L_VOTES})</span></td>
  </tr>
  <tr> 
	<td class="row2" valign="middle"><span class="gen">{L_DLS}:</span></td>
	<td class="row1" valign="middle"><span class="gen">{FILE_DLS}</span></td>
  </tr>
<!-- BEGIN custom_field -->
  <tr>
	<td class="row2" valign="middle"><span class="gen">{custom_field.CUSTOM_NAME}:</span></td>
	<td class="row1" valign="middle"><span class="gen">{custom_field.DATA}</span></td>
  </tr>
<!-- END custom_field -->
{MUST_LOGIN}
</table>

<table width="100%" cellpadding="2" cellspacing="0">
  <tr>
<!-- BEGIN auth_post -->
	<td width="33%" align="center"><a href="{U_DOWNLOAD}"><img src="{DOWNLOAD_IMG}" border="0" alt="{L_DOWNLOAD}"></a></td>
<!-- END auth_post -->
	<td width="34%" align="center"><a href="{U_RATE}"><img src="{RATE_IMG}" border="0" alt="{L_RATE}"></a></td>
	<td width="33%" align="center"><a href="{U_EMAIL}"><img src="{EMAIL_IMG}" border="0" alt="{L_EMAIL}"></a></td>
  </tr>
</table>
<br>
{COMMENT}
