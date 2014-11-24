<?php
include_once("db.php");
if(isset($_REQUEST['verifilename']))
{
	$verifilename = $_REQUEST['verifilename'];
	$websitelink  = $_REQUEST['websitelink'];
	$uid  = $_REQUEST['uid'];
	
	$url = $websitelink.'/'.$verifilename;

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
					
					$domain_verify =  $tags['p:domain_verify'] ; 
					
					$qry = 'select * from wp_usermeta where user_id="'.$uid.'" and meta_key="meta_code" and meta_value="'.$domain_verify.'" ';
					$res = mysql_query($qry);
					$data = mysql_fetch_assoc($res);
					$cntrows = mysql_num_rows($res);
					if($cntrows==0)
					{
						echo 'Not Verified , try again';
					}
					else
					{
						echo 'Verified';
						$z33='update wp_usermeta set meta_value="yes" where meta_key="url_verified" and user_id="'.$uid.'"';
						mysql_query($z33);
					}					
	
	}
	else
	{
		echo 'NOT FOUND THIS PATH : '.$file;		
		
		$file_headers = @get_headers($file);
		echo $file_headers[0];
	}	
}

?>