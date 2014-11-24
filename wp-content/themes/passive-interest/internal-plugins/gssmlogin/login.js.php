<script>

function tw_login(){
	window.open("<?php echo GS_T_CALLBACK; ?>", "gstwitterlogin", "width=640, height=480");
}

window.fbAsyncInit = function() {
	FB.init({
		appId   : '<?php echo GS_FB_APP_ID; ?>',
		// channelUrl : '<?php echo GS_FB_CHANNEL_URL; ?>', // Channel File
		oauth   : true,
		status  : true, // check login status
		cookie  : true, // enable cookies to allow the server to access the session
		xfbml   : true // parse XFBML
	});

};

function fb_login(){
    FB.login(function(response) {

        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', function(response) {
                user_email = gsSendLoginRequest(response); //get user email
          // you can store this data into your database             
            });
	
		// Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
		// for any authentication related change, such as login, logout or session refresh.
		FB.Event.subscribe('auth.authResponseChange', function(response) { 
			if (response.status === 'connected') {
				// In this case, the person is logged into facebook and the app
				<?php if(is_user_logged_in()) { ?> gsFacebookLoggedOut(); <?php } // else do nothing, you're already logged in ?>
			} else if (response.status === 'not_authorized') {
				// In this case, the person is logged into Facebook, but not into the app
				// console.log(response);
			} else {
				// In this case, the person is not logged into Facebook
				// console.log(response);
			}
		});

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'publish_stream,email'
    });
}
// Load the SDK asynchronously
(function(d){
var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
if (d.getElementById(id)) {return;}
js = d.createElement('script'); js.id = id; js.async = true;
js.src = "//connect.facebook.net/en_US/all.js";
ref.parentNode.insertBefore(js, ref);
}(document));


// Log out
function gsFacebookLoggedOut() {

	FB.logout(); // Log out of fb ?

	/*
	FB.api('/me/permissions', 'delete', function(response) {
		// Revoked
	});
	*/
	
}

// Create a user and login, or login with existing user
function gsSendLoginRequest(response)
{
var xmlhttp;
if (window.XMLHttpRequest) { xmlhttp=new XMLHttpRequest(); }
else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    // User created, refresh.
	location.reload();
    }
  }
xmlhttp.open("POST","<?php echo GS_FB_CREATE_USER_URL; ?>",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("username="+response.username+"&id="+response.id+"&name="+response.name+"&email="+response.email);
}

</script>