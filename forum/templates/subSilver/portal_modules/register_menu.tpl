<form method="post" action="{U_REGISTER}">
<table width="100%" cellpadding="2" cellspacing="1" border="0" class="forumline">
	<tr>
		<td class="catHead" align="{REGISTER_ALIGN}" height="25"><span class="genmed"><b>{L_QUICK_REGISTER}</b></span></td>
	</tr>
	<tr>
		<td class="row1" align="{REGISTER_ALIGN}"><span class="gensmall">{L_USERNAME}: <input type="text" class="post" style="width:110px" name="username" size="20" maxlength="20" value=""></span></td>
	</tr>
	<tr>
		<td class="row2" align="center">
			<table>
				<tr>
					<td class="row2" align="left"><span class="gensmall">{L_PASSWORD}:</span></td>
					<td class="row2" align="left"><span class="gensmall">{L_CONFIRM_PASSWORD}:</span></td>
				</tr>
					<td class="row2" align="left"><input type="password" class="post" style="width: 70px" name="new_password" value=""></td>
					<td class="row2" align="right"><input type="password" class="post" style="width: 70px" name="password_confirm" value=""></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="row1" align="{REGISTER_ALIGN}"><span class="gensmall">{L_EMAIL}: <input type="text" class="post" name="email1" style="width:60px" maxlength="200" value="" /> <span class="genmed">@</span> <input type="text" class="post" name="email2" style="width:60px" maxlength="200" value="" /></span></td>
	</tr>
	<tr>
		<td class="row2" align="{REGISTER_ALIGN}">
			<!-- BEGIN gender_box -->
			<span class="gensmall">&nbsp;{L_GENDER}: {L_FEMALE}<input type="radio" name="gender" value="2"> {L_MALE}<input type="radio" name="gender" value="1"></span>
			<!-- END gender_box -->
		</td>
	</tr>
	<tr>
		<td class="row2" align="{REGISTER_ALIGN}">{CUSTOM_FIELDS}</td>
	</tr>
	<tr>
		<td class="row2" align="{REGISTER_ALIGN}">
			<!-- BEGIN validation -->
			<img src="{VALIDATION_IMAGE}" width="95" height="20" border="0" alt="">&nbsp;
			<input type="text" class="post" onFocus="Active(this); this.value=''" onBlur="NotActive(this)" name="reg_key" maxlength="4" size="4" value="{L_CODE}">&nbsp;&nbsp;&nbsp&nbsp;
			<!-- END validation -->
		</td>
	</tr>
	<tr>
		<td class="catBottom" align="center"><span class="gensmall">{S_REGISTER_HIDDEN_FIELDS}<input type="submit" name="submit" value="{L_REGISTER}" class="liteoption"></span></td>
	</tr>
</table>
</form>
<br>
