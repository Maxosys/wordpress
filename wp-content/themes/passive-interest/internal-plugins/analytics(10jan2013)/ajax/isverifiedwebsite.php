<?php
require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/../../../wp-load.php');
if(isset($_REQUEST['verifilename']))
{

	$verifilename = $_REQUEST['verifilename'];
	$websitelink  = $_REQUEST['websitelink'];
	$uid  = $_REQUEST['uid'];
	
	$metatag_type_id = $_REQUEST['metatag_type_id'];
	
	if($metatag_type_id=='upload_type')
	{
		 $url = $websitelink.'/'.$verifilename;	
	}
	else
	{
		 $url = $websitelink;	
	}
	$file = $url;
	
	function is_url_exist($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    }else{
      $status = false;
    }
    curl_close($ch);
   return $status;
}
	$dataurl = is_url_exist($file);

		if($dataurl==1)
		{
			$tags = get_meta_tags($url);
			
			//print_r($tags);
			global  $wpdb;
			$domain_verify =  $tags['p:domain_verify']; 
			
			$qry = 'select * from wp_usermeta where user_id="'.$uid.'" and meta_key="meta_code" and meta_value="'.$domain_verify.'" ';	
			$wpdb->query($qry);
			$cntrows = $wpdb->num_rows;	
			
				if($cntrows==0)
				{
					echo 'Not Verified , try again';
				}
				else
				{
					echo 'Verified';
					$z33='update wp_usermeta set meta_value="yes" where meta_key="url_verified" and user_id="'.$uid.'"';
					$wpdb->query($z33);
				}
		}
		else
		{				
			$file_headers = @get_headers($file);
			echo 'ERROR : '.$file;	
			echo '&nbsp'.$file_headers[0];
			$data;
		}
}

?>