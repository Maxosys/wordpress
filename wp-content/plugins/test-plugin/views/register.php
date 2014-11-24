

<?php
		//$current_user = wp_get_current_user();	print_r($current_user);
?>
       <?php if ( is_user_logged_in() ) : ?>
            <p><?php printf('%s <a href="%s" title="Logout">%s</a>.', __('You are already registered',''), wp_logout_url( site_url() ), __('Logout', 'ajax_login_register') ); ?></p>
        <?php else : ?>



<form action="javascript://" id="register_form" name="registerform" class="ajax-login-default-form-container <?php print get_option('ajax_login_register_default_style'); ?>">
<table width="80%">	
	<tr>
	  <td>
		<label> Username Name </label>
	  </td>
	  <td>
		<input type="text" name="login" id="user_login">
	  </td>
	</tr>
	<tr>
	 <td>
	  <label> Email </label>
	 </td>
	 <td>
	  <input type="text" name="email" id="user_email">
	 </td>
	</tr>
	<tr>
	<td>
	 <label> Password </label>
	</td>
	<td>
	 <input type="password" name="password" id="user_password">
	</td>
	</tr>
	<tr>
		<td>
			<label> Confirm Password </label>
		</td>
		<td>
			<input type="password" name="confirm_password" id="user_confirm_password">
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<input type="submit" value="Submit" id="submitidr"  >
		</td>
	</tr>
</table>
</form>

 <?php endif; ?>