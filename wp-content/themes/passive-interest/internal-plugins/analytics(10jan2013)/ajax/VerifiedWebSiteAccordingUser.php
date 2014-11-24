<?php
//include_once("db.php");
//error_reporting(0);
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/../../../wp-load.php');
//if (!is_user_logged_in() || !wp_verify_nonce($_GET['nonce'], 'ajax-nonce')) { die(); }
if(isset($_REQUEST['domainurlname']))
{
	$sitename = trim($_REQUEST['domainurlname']);
	$uid  = $_REQUEST['uid'];

	//print_r($tags);
	
	
$ddurl = explode('://',$sitename);
$ext_url = explode('.',$ddurl[1]);
$make_url = '';

if($ext_url[0]=='www')
{
	for($i=1;$i<count($ext_url);$i++)
	{
		$make_url .=$ext_url[$i].'.';
	}
}
else
{
	for($i=0;$i<count($ext_url);$i++)
	{
		$make_url .=$ext_url[$i].'.';
	}	
}

	$userdomain = rtrim($make_url,'.');	
	$domain_verify =  $tags['p:domain_verify']; 	
	//echo 'select * from wp_usermeta where meta_key="website_url" and meta_value LIKE  "%'.$userdomain.'%" ';
	
	$myrows = $wpdb->get_results('select * from wp_usermeta where meta_key="website_url" and meta_value LIKE  "%'.$userdomain.'%" ' );	
	$rowCount = $wpdb->num_rows;
	
	if($rowCount==1)
	{
		//print_r($myrows);		
	
		
  $myrowsf = $wpdb->get_results('select * from wp_usermeta where user_id="'.$myrows[0]->user_id.'" and  meta_key="url_verified" and meta_value="yes" ' );
	$rowCountf = $wpdb->num_rows;
	if($rowCountf==1)
	{
			// already regisered 
			echo '0';
	}
	else
	{
			// not verified  
			echo '1';
	}		
	}
	else
	{
		echo '1';
	}
}

?>