jQuery( document ).ready(function( $ ){

  /**
     * Default ajax setup
     */
      $.ajaxSetup({
        type: "POST",
        url: ajaxurl
    });

/**
     * Check that username is valid
     
    $( document ).on('blur', '#user_login', function()
	{
        if ( $.trim( $(this).val() ) == '' ) return;

        $.ajax({
            data: "action=validate_username&login=" + $( this ).val(),
            dataType: 'json',
            success: function( msg )
			{
               alert(msg);
            }
        });
    });	
*/
    function validateEmail(email) 
	{ 
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}

	$( document ).on('submit', '#loginform', function()
		{
		 $.ajax({
				   data: "action=login_submit&" + $( this ).serialize(),
				   dataType: 'json',
				   success: function(results)
				   {
						//console.log(results);						
						
						if(results==0)
						{
							alert(" Invalid Username or Password.... ");
						}
						else
						{							
							window.location.replace('http://localhost/wordpress/profile/');
						}
			       }
			 });	
		});

    $( document ).on('submit', '#register_form', function()
	{
		var msg =  "Please : ";
		
		var user_login =  $("#user_login").val();
		var user_email =  $("#user_email").val();
		var user_password =  $("#user_password").val();
		var user_confirm_password =  $("#user_confirm_password").val();
		
		var st  =  true;
		
		if(user_login=="")
		{
			msg  += "\n Enter UserName ";
			st =  false;
		}
		if(user_email=="")
		{
			msg  += "\n Enter Email ";			
			st =  false;
		}
		else
		{
			var emailst = validateEmail(user_email);
			if(emailst==false)
			{
				msg  += "\n Enter Valid Email Id ";			
				st =  false;
			}
		}
		
		if(user_password=="")
		{
			msg  += "\n Enter Password ";
			st =  false;
		}
		if(user_confirm_password=="")
		{
			msg  += "\n Enter Confirm Password ";
			st =  false;
		}
		if(user_password!=user_confirm_password)
		{
			msg  += "\n Password not matched";
			st =  false;
		}	
		if(st==false)
		{
			alert(msg);
		}
		else
		{	
		  
		  $.ajax({
				   data: "action=register_submit&" + $( this ).serialize(),
				   dataType: 'json',
				   success: function(res)
				   {						
						var ii = 0;
						 $.each( res, function( key, val ) {		
								//alert(val);
								if(val=="Successfully Register")
								{
									ii =1;
								}
							});							
							
														
					 if ( ii == 1 ) window.location.replace('http://localhost/wordpress/register-3/');				   
				   }
			  });
		}
	});
});
 

