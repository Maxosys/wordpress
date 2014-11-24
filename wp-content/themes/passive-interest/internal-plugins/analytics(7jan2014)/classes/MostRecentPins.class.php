<?php

/********************** MOST RECENT PINS CLASS ***********************/
 
class MostRecentPins {  
	
	public function __construct() {  // MostRecent class constructor
	
	}
	
	// get most recent pins
	public function view_most_recent_pins() {
		
	global $wpdb;
	$user_id = get_current_user_id(); // get current logged in userid
	$userwebsite =  $this->get_user_website_by_userid($user_id); // fetch the verified website of logged in user.
	$post_meta_details =  $this->get_postmeta_by_website($userwebsite); // get postmeta information by website
	
	$postids=array();
	foreach($post_meta_details as $key => $value):
	$postids[] = $value->post_id;      // post ids
	endforeach;
	
	$uni_data = array_unique($postids);
	$validpostids = array_values($uni_data);
	$allpinsdetail =  $this->get_post_by_postid($validpostids);
	$upostids_first = $this->getextractedvalues($allpinsdetail);
	
	$repinarr= array();
	$freshpin_arry =  array();
	for($j=0;$j<count($upostids_first);$j++) {
	
		$repinarr_val = $this->fetch_recent_postmeta_byid ($upostids_first[$j]); // get post by post id
	
		if(!empty($repinarr_val))
		{
			$repinarr[] =$repinarr_val;
		}
		else
		{
			$freshpin_arry[] = $upostids_first[$j];
		}
	}
	
	
	
	
	$fill_repin_arr = array_filter($repinarr);
	$rparr   = array_values($fill_repin_arr);
	

	$postids2=array();
	foreach ($rparr as $key => $value) {
		$postids2[] = $value[0]->post_id;
	
	}
	
	
	$result_new = array_diff($upostids_first, $postids2);
	
	$newval_arr = array();
	
	$result_new = array_values($result_new);
	
	for($j=0;$j<count($result_new);$j++) {
		
		$repinarr_val = $this->fetch_origpost_postmeta_detail($result_new[$j]);
			
		if(empty($repinarr_val))
		{
			$newval_arr[] =$result_new[$j];
		}
	}
	
	$upostids = array_merge($newval_arr,$postids2);
	
	$most_recent_pins=array();
	for($s=0;$s<count($upostids);$s++) {
		
		$most_recent_pins[] = $this->get_recent_posts_by_id($upostids[$s]);
		
	}
	
	
	for($v=0;$v<count($most_recent_pins);$v++) {
		$mrp[] = $most_recent_pins[$v][0];
	}
	return $mrp;
	
	}
	
	
	
	
	public function get_recent_posts_by_id($postid) {  // get recent posts by post id
		global $wpdb;
		$qqq = "SELECT * FROM $wpdb->posts WHERE `ID` = '".$postid."' ";
		return $wpdb->get_results($qqq);
	}
	
	
	
	public function fetch_origpost_postmeta_detail($pid) // get post meta by post id
	{
		global $wpdb;
		$query = "select * from wp_postmeta where meta_key='_Original Post ID' and post_id='".$pid."' ";
		return  $wpdb->get_results($query);
	
	
	}
	
	
	public function fetch_recent_postmeta_byid($pid)
	{ 
		global $wpdb;
		$query = "select * from wp_postmeta where meta_key='_Repin Post ID' and post_id='".$pid."' ";
		return $repinarr_val = $wpdb->get_results($query);
		
	
	}
	
	public function getextractedvalues($allpinsdetail) {  // get all post ids from from post array
		
		$temp = array();
		for($i=0;$i<count($allpinsdetail);$i++) {
			$temp[]=$allpinsdetail[$i][0]->ID;
		}
		return $temp;
	}
	
	public function get_post_by_postid($validpostids){ 
	
		global $wpdb;
		
		$post_data = array();
		for($i=0;$i<count($validpostids);$i++) {
			 $qqq = "SELECT * FROM $wpdb->posts WHERE `ID` = '".$validpostids[$i]."' and post_status='publish' ";
		
			$post_data[] = $wpdb->get_results($qqq);
		}
		
		return $post_data;
	
	}
	
	public function get_postmeta_by_website($userwebsite){
		
		global $wpdb;
		$query = "SELECT * FROM $wpdb->postmeta WHERE meta_value like '%".$userwebsite."%' and meta_key='_Photo Source' ";
		return $post_meta_details = $wpdb->get_results($query);
		
	}
	

	public  function get_user_website_by_userid($user_id) { // get user website by user id from usermeta 
	
	$userdomain =  get_user_meta($user_id, 'website_url', true);
	 

	$ddurl = explode('://',$userdomain); 
	
	$ext_url = explode('.',$ddurl[1]);
	
	$make_url = '';
	
	if($ext_url[0]=="www") {
	
	for($i=1;$i<count($ext_url);$i++) {
	$make_url .=$ext_url[$i].'.';
	}
	
		return  rtrim($make_url,'.');  
	
	}
	
	else  { 
	for($i=0;$i<count($ext_url);$i++) {
	$make_url .=$ext_url[$i].'.';
	}
	
	return rtrim($make_url,'.'); 
				
	}

	}
	
		
}


/****************************** END MOST RECENT PINS CLASS ***********************/

?>