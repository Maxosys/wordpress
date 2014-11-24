<?php

			class Graphs extends MostRepinned
			{
			
// start pins

				public function pinsfunction($dateval)
				{
					
						global $wpdb;
						$most_recent_pins=array();
						$postids=array();
						$user_id = get_current_user_id();
						
							$user_id = get_current_user_id(); // get current logged in userid
							$userdomain =  $this->get_user_website_by_userid($user_id); // fetch the verified website of logged in user.	


						$qq = "SELECT * FROM `wp_postmeta` WHERE `meta_key` = '_Photo Source Domain' AND `meta_value` like '%".$userdomain."%'"; 
						$postsdetails = $wpdb->get_results($qq);

						foreach($postsdetails as $key => $value):
								$postids[] = $value->post_id;
						endforeach;	
						
						
						$repinarr= array();
				$freshpin_arry =  array();
				for($j=0;$j<count($postids);$j++) {
				
					$repinarr_val = $this->fetch_recent_postmeta_byid_pins($postids[$j]); // get post by post id
				
					if(!empty($repinarr_val))
					{
						$repinarr[] =$repinarr_val;
					}
					else
					{
						$freshpin_arry[] = $postids[$j];
					}
				}				
					
					$fill_repin_arr = array_filter($repinarr);					
					$rparr   = array_values($fill_repin_arr);					
					
					$postids2=array();
					foreach ($rparr as $key => $value) {
						$postids2[] = $value[0]->post_id;					
					}
					
					
					
					$result_new = array_diff($postids, $postids2);
	
	$newval_arr = array();
	
	$result_new = array_values($result_new);
	
	for($j=0;$j<count($result_new);$j++) {
		
		$repinarr_val = $this->fetch_origpost_postmeta_detail_pin($result_new[$j]);
			
		if(empty($repinarr_val))
		{
			$newval_arr[] =$result_new[$j];
		}
	}
	
	$upostids = array_merge($newval_arr,$postids2);
	
				
							for($i=0;$i<count($upostids);$i++)
							{
								$qqq = "SELECT * FROM $wpdb->posts WHERE `ID` = '".$upostids[$i]."' and post_date like '%".$dateval."%' "; 
								$most_recent_pins[] = $wpdb->get_results($qqq);
							}
							
							//echo '<pre>';
							
							//print_r($most_recent_pins);
							//exit;
							
							
						
							return $most_recent_pins;
				}

				public function countPinData($dateval)
				{
					$most_recent_pins = $this->pinsfunction($dateval);

					$recent_pins=array();
					$bb = count($most_recent_pins);

					for($z=0;$z<$bb;$z++)
					{
						$recent_pins[]=$most_recent_pins[$z][0];
					}						
					$pindatanew =  array_filter($recent_pins);
					$countpin = array_values($pindatanew);
					
					$countdata = count($countpin);
					
					// return number of pins	
					return $countdata;		
				}
	// End count pin function
	
	// Start count pinner function
	
	
				public function countPinnerData($dateval)
				{	
					$most_recent_pins = $this->pinsfunction($dateval);
					$recent_pins=array();
					$bb = count($most_recent_pins);				

					for($z=0;$z<$bb;$z++)
					{
						$recent_pins[]=$most_recent_pins[$z][0]->post_author;
					}
					
					$pindatanew =  array_filter($recent_pins);
					$countpin   =  array_values($pindatanew);
					$countdata = array_unique($countpin);				
					$countdata = count($countdata);			
					// return number of pinners	
					return $countdata;		
				}
				
				
	public function fetch_origpost_postmeta_detail_pin($pid) // get post meta by post id
	{
		global $wpdb;
		$query = "select * from wp_postmeta where meta_key='_Original Post ID' and post_id='".$pid."' ";
		return  $wpdb->get_results($query);
	
	
	}
	public function fetch_recent_postmeta_byid_pins($pid)
	{ 
		global $wpdb;
		$query = "select * from wp_postmeta where meta_key='_Repin Post ID' and post_id='".$pid."' ";
		return $repinarr_val = $wpdb->get_results($query);
		
	
	}
	


// end pins
			
			
// start repinns 			
			
				public function rePinfunction($dateval)
				{
						global $wpdb;
						$user_id = get_current_user_id(); // get current logged in userid
						$userdomain =  $this->get_user_website_by_userid($user_id); // fetch the verified website of logged in user.							


				$qq = "SELECT * FROM `wp_postmeta` WHERE `meta_key` = '_Photo Source Domain' and `meta_key` != '_Original Post ID' AND `meta_value` like '%".$userdomain."%'"; 
				$postsdetails = $wpdb->get_results($qq);

				foreach($postsdetails as $key => $value):
						$postids[] = $value->post_id;
				endforeach;	
				
				$repinarr= array();
				$freshpin_arry =  array();
				for($j=0;$j<count($postids);$j++) {
				
					$repinarr_val = $this->fetch_repin_postmeta_byid($postids[$j]); // get post by post id
				
					if(!empty($repinarr_val))
					{
						$repinarr[] =$repinarr_val;
					}
					else
					{
						$freshpin_arry[] = $postids[$j];
					}
				}				
					
					$fill_repin_arr = array_filter($repinarr);					
					$rparr   = array_values($fill_repin_arr);					
					
					$postids2=array();
					foreach ($rparr as $key => $value) {
						$postids2[] = $value[0]->post_id;					
					}		

					//  get Repins ids
					
					$repin_ids_array =  array();
					
					for($i=0;$i<count($postids2);$i++)
					   {
							$repin_ids_array[] = $this->getReppinedIds($postids2[$i]);
					   }
					// end get Repins ids
					
					// arrange in single array					
	
					$repin_ids_array_single =  array();
					
					   for($i=0;$i<count($repin_ids_array);$i++)
					   {
							for($j=0;$j<count($repin_ids_array[$i]);$j++)
							{								
								$repin_ids_array_single[] = $repin_ids_array[$i][$j];
							}
					   }
					   
					   
					   
					   
					// arrange in single array
					
					// get date wise records

					for($i=0;$i<count($repin_ids_array_single);$i++)
					{
						$qqq = "SELECT * FROM $wpdb->posts WHERE `ID` = '".$repin_ids_array_single[$i]."' and post_date like '%".$dateval."%' "; 
						$most_recent_repins[] = $wpdb->get_results($qqq);
					}
					
					return $most_recent_repins;
				}
			
				 
				public function countRePinData($dateval)
				{
					
					$most_recent_repins = $this->rePinfunction($dateval);
					
					$recent_pins=array();
					
					$bb = count($most_recent_repins);						
						
					for($z=0;$z<$bb;$z++)
					{
						$recent_pins[]=$most_recent_repins[$z][0];
					}
					
					
					
					$pindatanew =  array_filter($recent_pins);
					$countpin = array_values($pindatanew);
					
					$countdata = count($countpin);
					
					// return number of pins	
					return $countdata;		
				}
// End count pin function
								
					public	function countRePinnerData($dateval)
					{
						$most_recent_repins = $this->rePinfunction($dateval);
							$recent_pins=array();
							$bb = count($most_recent_repins);				
									

							for($z=0;$z<$bb;$z++)
							{
								$recent_pins[]=$most_recent_repins[$z][0]->post_author;
							}
									
									$pindatanew =  array_filter($recent_pins);
									$countpin   =  array_values($pindatanew);
									$countdata = array_unique($countpin);				
									$countdata = count($countdata);			
									// return number of pinners	
									return $countdata;		
					}
							
						public function fetch_repin_postmeta_byid($pid)
							{ 
								global $wpdb;
								$query = "select * from wp_postmeta where post_id='".$pid."' and meta_key='_Repin Count' ";
								return $repinarr_val = $wpdb->get_results($query);							
							}
		// end repins
		
		

	/*********************************** COUNT CLICKS FUNCTION STARTS HERE *******************************************/

	public function countClicksData($dateval)
	{
		$most_clicked_pins = $this->fetchclicked($dateval);
			
		return count($most_clicked_pins);
			

	}

	/*********************************** COUNT CLICKS FUNCTION ENDS HERE ****************************************/

	public function fetchclicked($dateval) {


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
		
		foreach ($rparr as $key => $value)
		{			
			$new_generated_repin_ids = unserialize($value[0]->meta_value);
			$temp = $this->checkclicked_pin_according_to_seldate($new_generated_repin_ids,$dateval);
		
			for($kk=0;$kk<count($temp);$kk++) 
			{
					$postidacctoseldate[]= $temp[$kk][0]->ID;
			}
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
			$test[] = $mrp[$q][0];
		}

		if(is_array($test) && !empty($test)) {
			return $test;
		}
	}


	public function checkclicked_pin_according_to_seldate($pid,$seldate) {

		global $wpdb;
			
		$temp = array();
		for($j=0;$j<count($pid);$j++) {
			$qqq = "SELECT * FROM $wpdb->posts WHERE `ID` = '".$pid[$j]."' and post_date like '%".$seldate."%' ";
				
			$temp[] = $wpdb->get_results($qqq);
		}
		return $temp;

	}

		/************************************** clicker  ********************************/
	
	public function countclickerData($dateval)
	{
		$most_clicked_pins = $this->fetchclickers($dateval);
		
			return  count($most_clicked_pins);
	
	}
	
	/*********************************** COUNT CLICKS FUNCTION ENDS HERE ****************************************/
	
	public function fetchclickers($dateval) {
	
	
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
	
				
			$new_generated_repin_ids = unserialize($value[0]->meta_value);
	
			$temp = $this->checkclicked_pin_according_to_seldate($new_generated_repin_ids,$dateval);
	
			for($kk=0;$kk<count($temp);$kk++) {
				$postidacctoseldate[]= $temp[$kk][0]->ID;
			}
	
	
	
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
			$mrp[] = $this->get_recent_posts_by_postids($reindexidsfinal[$v]);
			
		}
	
	
		$test=array();
		for($q=0;$q<count($mrp);$q++) {
			$test[] = $mrp[$q][0]->post_author;
		}
	
	
		$uniqauthor = array_unique($test);
		$filterauthor = array_filter($uniqauthor);
		$reindexauthor = array_values($filterauthor);
		
		return $reindexauthor;
	
	
	
	}
	
	public function get_recent_posts_by_postids($postid) {  // get recent posts by post id
		global $wpdb;
		
			
			$qqq = "SELECT * FROM $wpdb->posts WHERE `ID` = '".$postid."'  ";
			return $wpdb->get_results($qqq);
		
	
	}
	public function get_recent_postsauthor_by_id($pid) {
		global $wpdb;
		
			
		$qqq = "SELECT post_author FROM $wpdb->posts WHERE `ID` = '".$postid."'  ";
		return $wpdb->get_results($qqq);
	}
	

}

?>