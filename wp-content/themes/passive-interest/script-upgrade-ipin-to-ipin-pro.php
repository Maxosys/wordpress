<?php
define('WP_USE_THEMES', false); 
require('../../../wp-load.php');
?>
<html>
<head>
<title>Upgrade iPin to iPin Pro</title>
<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel="stylesheet">
<style>
body {
padding: 30px;	
}
</style>
</head>
<body>
<div class="hero-unit">
<?php
if (current_user_can('manage_options')) {
	global $wpdb;
	
	echo '<h3>Upgrade iPin to iPin Pro</h3>';
	
	//Create boards from categories
	$ipin_upgrade_categories = get_option('ipin_upgrade_categories');
	if (empty($ipin_upgrade_categories)) {
		$ipin_users = get_users('orderby=ID');
		foreach ($ipin_users as $user) {
			$board_parent_id = get_user_meta($user->ID, '_Board Parent ID', true);
			$categories =  get_categories();
			$boards_name = array();
			$category_id = array();
			
			foreach ($categories as $category) {
				array_push($boards_name, $category->cat_name);
				array_push($category_id, $category->cat_ID);
			}
			
			$count = 0;
	
			if (empty($board_ids)) {
				$board_ids = array();
			}
	
			foreach($boards_name as $board_name) {
				$board_id = wp_insert_term (
					$board_name,
					'board',
					array(
						'description' => $category_id[$count],
						'parent' => $board_parent_id,
						'slug' => wp_unique_term_slug($board_name . '__ipinboard', 'board')
					)
				);
				$count++;
				array_push($board_ids, $board_id['term_id']);
			}
			
			delete_option("board_children");
			update_option('ipin_upgrade_categories', $board_ids);
		}

		echo '<p>Remember to backup your database first!</p>';
		echo '<br /><p><a class="btn" href="' . $_SERVER['REQUEST_URI'] . '"><strong>Click to start...</strong></a></p>';
	} else {

		//get all posts without boards
		$posts = new wp_Query(array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => '50',
			'tax_query' => array(
				array(
					'taxonomy' => 'board',
					'field' => 'id',
					'terms' => get_option('ipin_upgrade_categories'),
					'operator' => 'NOT IN'
				)
			)
		));
	
		if ($posts->post_count) {
			foreach($posts->posts as $post) {
				echo 'Post ID: ' . $post->ID .'<br>';
				
				$board_parent_id = get_user_meta($post->post_author, '_Board Parent ID', true);
				$board_children = get_term_children($board_parent_id, 'board');
				$found = '0';
				
				$post_category = get_the_category($post->ID);	
				
				foreach ($board_children as $board_child) {
					$board_child_term = get_term_by('id', $board_child, 'board');
					if ($board_child_term->name == $post_category[0]->cat_name) {
						$found = '1';
						$found_board_id = $board_child_term->term_id;
						break;
					}
				}
				
				if ($found == '0') {
					$slug = wp_unique_term_slug($post_category[0]->cat_name . '__ipinboard', 'board'); //append __ipinboard to solve slug conflict with category and 0 in title
		
					$new_board_id = wp_insert_term (
						$post_category[0]->cat_name,
						'board',
						array(
							'description' => $post_category[0]->cat_ID,
							'parent' => $board_parent_id,
							'slug' => $slug
						)
					);
					$postdata_board = $new_board_id['term_id'];
				} else {
					$postdata_board = $found_board_id;
				}
				
				//set board
				wp_set_post_terms($post->ID, array($postdata_board), 'board');
				
				//category ID is stored in the board description field
				$category_id = get_term_by('id', $postdata_board, 'board');
				
				//set category
				wp_set_object_terms($post->ID, array(intval($category_id->description)), 'category');
			}
			
			echo '<br /><p><a class="btn" href="' . $_SERVER['REQUEST_URI'] . '"><strong>Click to continue next batch...</strong></a></p>';
		} else {
			//delete empty boards
			$ipin_users = get_users('orderby=ID');
			foreach ($ipin_users as $user) {
				$board_parent_id = get_user_meta($user->ID, '_Board Parent ID', true);
				$boards = get_terms('board', array('parent' => $board_parent_id, 'hide_empty' => false));
	
				foreach($boards as $board) {
					if ($board->count == 0) {
						wp_delete_term($board->term_id, 'board');
					}
				}
			}
			delete_option("board_children");
			
			echo '<br /><span class="alert alert-success">Upgrade Completed!</span>';
		}
	}
} else {
	echo '<span class="alert alert-warning">Please login as Administrator first...</span>';	
}
?>
</div>
</body>
</html>