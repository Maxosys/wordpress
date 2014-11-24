

<?php
		//$current_user = wp_get_current_user();	print_r($current_user);
?>
       <?php if ( is_user_logged_in() ) : ?>
            <p><?php printf('%s <a href="%s" title="Logout">%s</a>.', __('You are already Loggedin',''), wp_logout_url( site_url() ), __('Logout', 'ajax_login_register') ); ?></p>
        <?php else : 		
						//action="<?php echo site_url('/wp-login.php'); " method="post"		
		?>

<form name="loginform" id="loginform" action="javascript://"  class="ajax-login-default-form-container <?php print get_option('ajax_login_register_default_style'); ?>">
	<table width="80%">	
		<tr>  
		 <td>
		  <label> Username Name </label>
		 </td>
		 <td>
		  <input type="text" name="log" id="log">
		 </td>
		</tr>	
	    <tr>
		 <td>
		  <label> Password </label>
		 </td>
		 <td>
		  <input type="password" name="pwd" id="pwd">
		 </td>
	    </tr>		
	   <tr>
		  <td>
		    <label> Remember </label>
		  </td>
		  <td>
			<input type="checkbox" name="remember" id="remember" />
		  </td>
	   </tr>		
	   <tr>
		 <td></td>
		 <td>
		 <input type="submit" value="Submit" id="submitlogin"  >
		 </td>
	   </tr>
	</table>
</form>
 <?php endif; ?>