<?php
class MostClicked  {

	public function __construct() {  // Most Clicked class constructor
	
	}
	
	// get most clicked pins
	public function view_most_clicked() {
		
	
	global $wpdb;
	$user_id = get_current_user_id(); // get current logged in userid

	$userwebsite =  $this->get_user_website_by_userid($user_id); // fetch the verified website of logged in user.
	$post_meta_details =  $this->get_postmeta_by_website($userwebsite); // get postmeta information by website
	
	
	
	$postids=array();
	foreach($post_meta_details as $key => $value):
	$postids[] = $value->post_id;      // post ids
	endforeach;
	
	
	$uniq_data = array_unique($postids);
	
	$validpostids = array_values($uniq_data);
	
	$allpinsdetail =  $this->get_post_by_postid($validpostids);
	$upostids_first = $this->getextractedvalues($allpinsdetail);
	
	
	
	$repinned_arr= array();
	
	for($j=0;$j<count($upostids_first);$j++) {
	
		$repinarr_val = $this->fetch_recent_postmeta_byid ($upostids_first[$j]);  //get post(pin) by post id
	
		if(!empty($repinarr_val))
		{
			$repinned_arr[] =$repinarr_val;
		}
		
	}
	
	
	
	$fill_repin_arr = array_filter($repinned_arr);
	
	$rparr   = array_values($fill_repin_arr);
	
	
	$postids2=array();
	$postidacctoseldate =array();
	foreach ($rparr as $key => $value) {
		
		//$postids2[] = $value[0]->post_id;
		
		
			$new_generated_repin_ids = unserialize($value[0]->meta_value);
			
			$temp = $this->check_pin_according_to_seldate($new_generated_repin_ids);

			for($kk=0;$kk<count($temp);$kk++) {
			//$postidacctoseldate[] = $temp[$kk][0]->ID;
				$postidacctoseldate[]= $temp[$kk][0]->ID;
			}
			
			
			/* if(isset($temp[0]) && !empty($temp[0]))  {
				$postids2[] = $value[0]->post_id;
			}
			*/
	
	}
	
	$removeemptyarr = array_filter($postidacctoseldate);
	$reindexarr = array_values($removeemptyarr);
	$uniqfinal = array_unique($reindexarr);
	
	
	
	
	/*********************** GET ORIGINAL POST ID FROM POST META ***********************/
	
	$mostclickedfinalids = array();
	for($e=0;$e<count($uniqfinal);$e++) {
		
 $sql="select * from $wpdb->postmeta where post_id='".$uniqfinal[$e]."' and meta_key='_Original Post ID'";

		$mostclickedfinalids[] = $wpdb->get_results($sql);
		
	}
	
	/*********************  GET ORIGINAL POST ID FROM POST META  ***********************/
	

	
	$final_most_clicked_result=array();
	
	for($p=0;$p<count($mostclickedfinalids);$p++) {
		$final_most_clicked_result[] = $mostclickedfinalids[$p][0]->meta_value;
	}
	
	
	
	$d = array_unique($final_most_clicked_result);
	$reindexidsfinal = array_values($d);
	
	for($v=0;$v<count($reindexidsfinal);$v++) {
		$mrp[] = $this->get_recent_posts_by_id($reindexidsfinal[$v]);
	}
	
	$test=array();
	
	for($q=0;$q<count($mrp);$q++) {
		$test[] =$mrp[$q][0];
	}
	
	if(is_array($test) && !empty($test)) {
			return $test;
	}
	
	}
	

	
	
	public function check_pin_according_to_seldate($pid) {
		
		global $wpdb;
		if(isset($_GET['date']))
		{
			$selected_date = $_GET['date'];
			$dd1_y = substr($selected_date,0,4);
			$dd1_m = substr($selected_date,4,2);
			$dd1_d = substr($selected_date,6,2);
			$seldate= $dd1_y.'-'.$dd1_m.'-'.$dd1_d;
		}
		else
		{
			$seldate = date('Y-m-d');
		}
			
			$temp = array();
			for($j=0;$j<count($pid);$j++) {
			$qqq = "SELECT * FROM $wpdb->posts WHERE `ID` = '".$pid[$j]."' and post_date like '%".$seldate."%' ";
			$temp[] = $wpdb->get_results($qqq);
			}
			return $temp;
		
	}
	
	public function get_recent_posts_by_id($postid) {  // get recent posts by post id
		global $wpdb;
		
			
			$qqq = "SELECT * FROM $wpdb->posts WHERE `ID` = '".$postid."'  ";
			return $wpdb->get_results($qqq);
		
	
	}
	
	
	
	/*
	public function fetch_origpost_postmeta_detail($pid) // get post meta by post id
	{
		global $wpdb;
		$query = "select * from wp_postmeta where meta_key='_Original Post ID' and post_id='".$pid."' ";
		return  $wpdb->get_results($query);
	
	
	}
	*/
	
	
	
	public function fetch_recent_postmeta_byid($pid)
	{ 
		global $wpdb;
		//$query = "select * from wp_postmeta where post_id='".$pid."' and meta_key='_Repin Count' ";
		$query = "select * from wp_postmeta where post_id='".$pid."' and meta_key='_Repin Post ID' ";
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
	
	public function getReppinedIds($postid)
	{
		 $repins_ids = get_post_meta($postid, '_Repin Post ID', true);			 
		 return $repins_ids ;
	} 

		
}


/****************************** END MOST CLICKED CLASS ***********************/

?>