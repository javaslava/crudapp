
<div class="form_container">
		
	<form method="post" action="">
		
		<fieldset id="login">
			<legend>Log In</legend>
			<input class="auth_button" type="button" value="Register new user" onclick="reg_visible()" title="Press to register new account" />
			
				<p><label for="email">Your E-mail: <em>*</em></label>
				<input id="email" type="email" size="30" maxlength="50" name="log_email">
				</p>
				<p><label for="password">Your password: <em>*</em></label>
				<input id="password" type="password" size="25" maxlength="25" name="log_password">
				</p>
		</fieldset>
		
		<fieldset id="register">
			<legend>Register</legend>
			<input class="auth_button" type="button" value="Log In" onclick="log_visible()" title="If already registered" />
			
			<p><label for="userName">Your name: <em>*</em></label>
				<input id="userName" type="text" size="25" maxlength="25" name="reg_userName">
			</p>
			<p><label for="email">Your E-mail: <em>*</em></label>
				<input id="email" type="email" size="30" maxlength="50" name="reg_email">
			</p>
			<p><label for="password">Your password: <em>*</em></label>
				<input id="password" type="password" size="25" maxlength="25" name="reg_password">
			</p>
			<p><label for="confirm">Confirm password: <em>*</em></label>
				<input id="confirm" type="password" size="25" maxlength="25" name="confirm_pass">
			</p>
			<input type='hidden' name='loginout' value='Logged'>
		</fieldset>
		
		<p><button class="button_set" type="reset">Reset</button>
		<input class="button_set" type="submit" value="Send" name="data_submit">
		<input class="button_set" type="button" onclick="history.back();" value="Back"/>
		<input class="button_set" type="submit" name="cancel" value="Cancel">    
		</p>     
		<?php
		
	if (isset($data['login_message']) && $data['login_message'])
    {
      printf('<div class="message">%s</div>', $data['login_message']);
    }
		?>
		</form>
</div>
