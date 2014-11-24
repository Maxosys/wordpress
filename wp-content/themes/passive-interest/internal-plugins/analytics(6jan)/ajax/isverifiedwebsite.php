<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/../../../wp-load.php');
if(isset($_REQUEST['verifilename']))
{

	$verifilename = $_REQUEST['verifilename'];
	$websitelink  = $_REQUEST['websitelink'];
	$uid  = $_REQUEST['uid'];
	
	echo $metatag_type_id = $_REQUEST['metatag_type_id'];
	
	if($metatag_type_id=='upload_type')
	{
		 $url = $websitelink.'/'.$verifilename;	
	}
	else
	{
		 $url = $websitelink;	
	}	
	echo $url;

	$tags = get_meta_tags($url);
	
	//print_r($tags);
	
	$domain_verify =  $tags['p:domain_verify']; 
	
	$qry = 'select * from wp_usermeta where user_id="'.$uid.'" and meta_key="meta_code" and meta_value="'.$domain_verify.'" ';
	$res = mysql_query($qry);
	$data = mysql_fetch_assoc($res);
	$cntrows = mysql_num_rows($res);
	if($cntrows==0)
	{
		echo 'NotVerified';
	}
	else
	{
		echo 'Verified';
		$z33='update wp_usermeta set meta_value="yes" where meta_key="url_verified" and user_id="'.$uid.'"';
		mysql_query($z33);
	}
}

?>