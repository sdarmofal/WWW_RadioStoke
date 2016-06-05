<form method="post" action="{S_POLL_ACTION}">
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<td class="catHead" height="25" align="{POLL_ALIGN}"><span class="genmed"><b>{L_POLL}</b></span></td>
	</tr>
	<tr>
		<td class="row1" align="{POLL_ALIGN}"><span class="gensmall"><b>{S_POLL_QUESTION}</b></span></td>
	</tr>
	<!-- BEGIN max_voting -->
	<tr>
		<td align="center" class="row1"><span class="gensmall">{MAX_VOTING_1_EXPLAIN}{max_vote}{MAX_VOTING_2_EXPLAIN}
		{POLL_VOTE_BR}{MAX_VOTING_3_EXPLAIN}{POLL_VOTE_BR}</span></td>
	</tr>
	<!-- END max_voting -->
	<!-- BEGIN poll_option_row -->
	<tr>
		<td class="row2">
			<span class="genmed"><input type="{POLL_VOTE_BOX}" name="vote_id[]" value="{poll_option_row.OPTION_ID}">
			{poll_option_row.OPTION_TEXT}&nbsp;[{poll_option_row.VOTE_RESULT}]</span><br>
		</td>
	</tr>
	<!-- END poll_option_row -->
	<!-- BEGIN poll_option -->
	<tr>
		<td class="row1">
			<table width="100%" height="100%" border="0">
				<tr>
					<td colspan="3" class="row1" align="center"><span class="gensmall">{poll_option.POLL_OPTION_CAPTION}: <b>{poll_option.POLL_OPTION_RESULT}</b></span></td>
				</tr>
				<tr>
					<td class="row1">
						<table cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td><img src="templates/subSilver/images/vote_lcap.gif" width="4" alt="" height="12"></td>
								<td><img src="{poll_option.POLL_OPTION_IMG}" width="{poll_option.POLL_OPTION_IMG_WIDTH}" height="12"></td>
								<td><img src="templates/subSilver/images/vote_rcap.gif" width="4" alt="" height="12"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<!-- END poll_option -->
	<!-- BEGIN poll_vote -->
	<tr>
		<td class="row1" align="center">
			<input type="submit" class="mainoption" name="submit" value="{L_VOTE_BUTTON}">
			<input type="hidden" name="topic_id" value="{S_TOPIC_ID}"><input type="hidden" name="mode" value="vote">
		</td>
	</tr>
	<!-- END poll_vote -->
</table>
</form>
<br>