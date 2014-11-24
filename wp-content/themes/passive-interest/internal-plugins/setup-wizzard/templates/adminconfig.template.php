<style>
div.tabbed-menu {
	width:150px;
	float:left;	
	margin-top:40px;
	background: #373737;
	color: #fff;
	
	border-top-left-radius: 4px;
	-moz-border-top-left-radius: 4px;
	-webkit-border-top-left-radius: 4px;
	
	border-bottom-left-radius: 4px;
	-moz-border-bottom-left-radius: 4px;
	-webkit-border-bottom-left-radius: 4px;
	
}
div.tabbed-menu li a {
	color: #fff;
	padding:10px;
	display:block;
	text-decoration: none;	
}
div.tabbed-menu .selected {
	background: #414141 !important;	
}
div.tabbed-menu li:hover > a{
	background: #414141;
}
div.tabbed-content {
	width:500px;
	float:left;	
	padding:10px;
	margin-top:20px;
	min-height:280px;
	padding-bottom:44px;
	position:relative;
	border:1px solid #ccc;
	border-radius: 4px;
}
div.tabbed-content .intro,
div.tabbed-content .video,
div.tabbed-content .paypal,
div.tabbed-content .affiliate,
div.tabbed-content .stores,
div.tabbed-content .promote,
div.tabbed-content .emaillist {
	display:none;	
}
div.tabbed-content .active {
	display:block;	
}
div.tabbed-content input[type=text] {
	padding: 10px;
	box-sizing:content-box;	
	width: 95%;	
}
div.tabbed-content textarea {
	min-height:120px;	
	width: 100%;	
}
</style>
<?php
if(!$tab) $tab = "intro";
?>
<div class="tabbed-menu">

    <ul>
        <li <?php echo ($tab == "video") ? 'class="video selected"' : 'class="video"'; ?>><a href="admin.php?page=wizardsetup&tab=video">Welcome Video</a></li>
        <li <?php echo ($tab == "paypal") ? 'class="paypal selected"' : 'class="paypal"'; ?>><a href="admin.php?page=wizardsetup&tab=paypal">Paypal Signup</a></li>
        <li <?php echo ($tab == "affiliate") ? 'class="affiliate selected"' : 'class="affiliate"'; ?>><a href="admin.php?page=wizardsetup&tab=affiliate">Affiliate Link</a></li>
        <li <?php echo ($tab == "stores") ? 'class="stores selected"' : 'class="stores"'; ?>><a href="admin.php?page=wizardsetup&tab=stores">Our Stores</a></li>
        <li <?php echo ($tab == "promote") ? 'class="promote selected"' : 'class="promote"'; ?>><a href="admin.php?page=wizardsetup&tab=promote">Howto Promote</a></li>
        <li <?php echo ($tab == "emaillist") ? 'class="emaillist selected"' : 'class="emaillist"'; ?>><a href="admin.php?page=wizardsetup&tab=emaillist">Email List</a></li>
    </ul>

</div>

<div class="tabbed-content">
    <form action="" method="post">
    <ul>
        <li <?php echo ($tab == "intro") ? 'class="intro active"' : 'class="intro"'; ?>>
            <p>Welcome to the Setup Wizzard Administration panel. Here you can change content on the wizzard and on the manual process so that users can have an updated version of the tutorial.</p> 
           <p>This feature has its own limitations but it will allow quite some customization into the process.</p>
        </li>
        
        <li <?php echo ($tab == "video") ? 'class="video active"' : 'class="video"'; ?>>
            <p>On our Welcome video setup page we have two changable variables, those are the video link and a description that we can choose to have or not. The description will follow immediately under the video.</p>
           <p><strong>Welcome video link</strong></p> 
           <p><input type="text" name="pif_welcome_video" value="<?php echo get_option("pif_welcome_video") ?>" placeholder="Video Link" /></p>
           <p><strong>Welcome video description</strong></p>
           <p><textarea name="pif_welcome_video_extra" placeholder="Video description"><?php echo get_option("pif_welcome_video_extra"); ?></textarea></p>           
           
        </li>
        
        <li <?php echo ($tab == "paypal") ? 'class="paypal active"' : 'class="paypal"'; ?>>
            <h2>Update Paypal Message</h2>
            <p>In this area we can write a message to let our users know how the Paypal email is used and how this is important to them. Valid html will result into styling the page as you would like it to be.</p>
            <p><font color="#f00">The content of this box needs to be valid HTML format.</font></p>
            <p><font color="#FFCC33">For assistance please contact your developer.</font></p>
            <p><textarea name="pif_paypal_description" placeholder="PayPal description"><?php echo get_option("pif_paypal_description"); ?></textarea></p> 
        </li>
        
        <li <?php echo ($tab == "affiliate") ? 'class="affiliate active"' : 'class="affiliate"'; ?>>
        
        <h2>Update Affiliate Link Description</h2>
        <p>In this area we can write a message to let our users know how they can use the affiliate link. Valid html will result into styling the page as you would like it to be.</p>
        <p><font color="#f00">The content of this box needs to be valid HTML format.</font></p>
        <p><font color="#FFCC33">For assistance please contact your developer.</font></p>
        
        <p><textarea name="pif_afiliate_link" placeholder="Affiliate Link Description"><?php echo get_option("pif_afiliate_link") ?></textarea></p>
        </li>
        
        <li <?php echo ($tab == "stores") ? 'class="stores active"' : 'class="stores"'; ?>>
        <h2>Update Our Stores</h2>
        <p>In this area we can set our store links so people can easily access all the stores that we currently run with.</p>
        <p><font color="#f00">The content of this box needs to be valid HTML format.</font></p>
        <p><font color="#FFCC33">For assistance please contact your developer.</font></p>
        <p><textarea name="pif_our_stores" placeholder="Our Stores"><?php echo get_option("pif_our_stores") ?></textarea></p>
        </li>
        
        <li <?php echo ($tab == "promote") ? 'class="promote active"' : 'class="promote"'; ?>>
        <h2>Update How To Promote</h2>
        <p>In this area we can write a message to let our users know how they can promote their store. Valid html will result into styling the page as you would like it to be.</p>
        <p><font color="#f00">The content of this box needs to be valid HTML format.</font></p>
        <p><font color="#FFCC33">For assistance please contact your developer.</font></p>
        <p><textarea name="pif_howto_promote" placeholder="Promote Store"><?php echo get_option("pif_howto_promote") ?></textarea></p>
        </li>
        
        <li <?php echo ($tab == "emaillist") ? 'class="emaillist active"' : 'class="emaillist"'; ?>>
        <h2>Update Email Listing</h2>
        <p>In this area we can update the email listing code that we are using. For example : Aweber, mailchimp.</p>
        <p><font color="#f00">The content of this box needs to be valid HTML format.</font></p>
        <p><font color="#FFCC33">For assistance please contact your developer.</font></p>
        
        <p><textarea name="pif_email_listing" placeholder="Place your snippet here"><?php echo html_entity_decode(get_option("pif_email_listing"), ENT_HTML5 | ENT_NOQUOTES) ?></textarea></p>
        </li>
    </ul>
    <div style="position:absolute;bottom:10px;"><input name="pif_admin_update" type="hidden" value="1" />
    <input type="submit" class="button button-primary" value="Update" />
    
    </form></div>
</div>
<div style="clear:both;"></div>
