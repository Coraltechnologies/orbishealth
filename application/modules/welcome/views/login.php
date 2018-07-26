<form name="login_form" id="login_form" method="post" action="login_check" enctype="multipart/form-data">
<table width="50%" cellpadding="3" cellspacing="3" align="left">
<tr><td align="center" colspan="2"><strong>Login Form</strong></td></tr>
<?php if(@$errors){ ?><tr><td align="center" colspan="2"><?php echo $errors; ?></td></tr><?php } ?>
<tr>
<td align="left"><strong>Username </strong></td>
<td><input type="text" name="u_login" id="u_login" value=""></td>
</tr>
<tr>
<td align="left"><strong>Password </strong></td>
<td><input type="password" name="u_pass" id="u_pass" value=""></td>
</tr>
<tr><td align="center" colspan="2"><input type="submit" name="submit" id="submit" value="Login"></td></tr>
</table>
</form>