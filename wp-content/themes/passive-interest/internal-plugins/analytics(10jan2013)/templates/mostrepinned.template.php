<?php 

	$user_id = get_current_user_id(); // current logged in user id
	$data = get_user_meta($user_id);
	if(!empty($data['website_url'][0])):
	$website_url = $data['website_url'][0]; // verified user website
	endif;
	
?>

<script type="text/javascript" src="<?php echo bloginfo('template_directory');?>/js/ipin_custom.js"></script>
<div class="analytics">
	<div class="analytics_con">
		<h1>
			<?php echo $website_url;?>
		</h1>
		<div class="analytic_head">
			<div class="anltic_date">
				
				
<script src="<?php echo bloginfo('template_directory');?>/js/calendar/jscal2.js"></script>
    <script src="<?php echo bloginfo('template_directory');?>/js/calendar/lang/en.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/calendar/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/calendar/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_directory');?>/css/calendar/steel/steel.css" />

    <style>
	.f_date1class{
	 background: none repeat scroll 0 0 #F8F8F8;
    border: 1px solid #D2D2D2;
    border-radius: 3px;
    color: #5F5F5F;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 12px;
    margin: 0 5px;
    padding: 8px 0;
    text-align: center;
    text-decoration: none;
    width: 226px; 
}
	</style> 
			
	
	<input size="30" id="f_date1" class="f_date1class" value="<?php echo $date_value;  ?>"  />	<br />
	<div id="info" style="text-align: center; margin-top: 1em;"></div>
	<script type="text/javascript">//<![CDATA[
	
	var SELECTED_RANGE = null;
	function getSelectionHandler() {
		var startDate = null;
		var ignoreEvent = false;
		return function(cal) {
			var selectionObject = cal.selection;
	
			// avoid recursion, since selectRange triggers onSelect
			if (ignoreEvent)
				return;
	
			var selectedDate = selectionObject.get();
			if (startDate == null) {
				startDate = selectedDate;
				SELECTED_RANGE = null;
				document.getElementById("info").innerHTML = ""; // "Click to select end date";
	
				// comment out the following two lines and the ones marked (*) in the else branch
				// if you wish to allow selection of an older date (will still select range)
				cal.args.min = Calendar.intToDate(selectedDate);
				cal.refresh();
			} else {
				ignoreEvent = true;
				selectionObject.selectRange(startDate, selectedDate);
				ignoreEvent = false;
				SELECTED_RANGE = selectionObject.sel[0];
	
				//   alert(SELECTED_RANGE.toSource());
				//
				// here SELECTED_RANGE contains two integer numbers: start date and end date.
				// you can get JS Date objects from them using Calendar.intToDate(number)
	
				startDate = null;
				document.getElementById("info").innerHTML = ""; //selectionObject.print("%Y-%m-%d") +"<br />Click again to select new start date";
					
				document.location.href="?analyticview=analyticsmetrics&date="+SELECTED_RANGE;
					
				// (*)
				cal.args.min = null;
				cal.refresh();
			}
		};
	};

	function getselhandler(dd) {
		document.location.href="?analyticview=mostrepinned&date="+dd;
	}
	
	Calendar.setup({
		inputField : "f_date1",
		trigger    : "f_date1",
		onSelect   : function() { getselhandler(this.selection.sel) },
		showTime   : 12,
		dateFormat : "%Y - %m - %d",
		selectionType : Calendar.SEL_SINGLE,
		//onSelect      : getSelectionHandler()
	});
	
	
	
		//]]></script>
	

				
		
			</div>
			<div class="anltic_nav">
				<ul>
					<li><a href="<?php echo bloginfo('siteurl');?>/analytics/?analyticview=analyticsmetrics" >Site Metrics</a></li>
<li><a href="<?php echo bloginfo('siteurl');?>/analytics/?analyticview=mostrecent" >Most Recent</a></li>
<li>
<a href="<?php echo bloginfo('siteurl');?>/analytics/?analyticview=mostrepinned" class="current">Most Repinned</a>
</li>
					<li><a href="#">Most Clicked</a></li>
					<?php  if(is_page('most-recent')) { ?>
	<li><input type="button" id="most_recent_csv" class="export_btn" value="export" /></li>
					<?php 	}
				?>
				</ul>
			</div>


		</div>
<style type="text/css">
.info, .success, .warning, .error, .validation {
border: 1px solid;
margin: 10px 0px;
padding:15px 10px 15px 50px;
background-repeat: no-repeat;
background-position: 10px center;
}
.error {
color: #D8000C;
background-color: #FFBABA;
background-image: url('error.png');
margin: 15px;
float:left;
width:500px;
}
</style>
		<div class="pi_analytic">

		<?php 
		$mostrepinnd = new MostRepinned();
		$repinned  =  $mostrepinnd->view_most_repinned_pins();
		$finalresult = array_filter($repinned);
		$rps = array_values($finalresult);
	
		?>	
        
		
		<div id="ajax-loader-masonry" class="ajax-loader"></div>


<!--working starts-->

<div id="masonry">

	<?php 		
if(!empty($rps)) {
		foreach ($rps as $post) {
		?>
	
    <div id="post-<?php echo $post->ID; ?>" <?php post_class('thumb'); ?>>
		<div class="thumb-holder">
			<div class="masonry-actionbar">
				<?php if (current_user_can('administrator') || current_user_can('editor') || current_user_can('author') || !is_user_logged_in()) { ?>
				<a class="ipin-repin btn btn-mini"
					data-post_id="<?php echo $post->ID ?>" href="#"><i
					class="icon-pushpin"></i> <?php _e('Repin', 'ipin'); ?> </a>
				<?php } ?>
				<?php if ($post->post_author != $user_ID) { ?>
				<button
					class="ipin-like btn btn-mini<?php if(ipin_liked($post->ID)) { echo ' disabled'; } ?>"
					data-post_id="<?php echo $post->ID ?>"
					data-post_author="<?php echo $post->post_author; ?>" type="button">
					<i class="icon-heart"></i>
					<?php _e('Like', 'ipin'); ?>
				</button>
				<?php } else { ?>
				<a class="btn btn-mini"
					href="<?php echo home_url('/pins-settings/'); ?>?i=<?php echo $post->ID ?>"><?php _e('Edit', 'ipin'); ?>
				</a>
				<?php } ?>
				<a class="ipin-comment btn btn-mini"
					href="<?php the_permalink(); ?>#respond"
					data-post_id="<?php echo $post->ID ?>"><i class="icon-comment"></i>
					<?php _e('Comment', 'ipin'); ?> </a>
			</div>

			<a class="featured-thumb-link" href="<?php the_permalink(); ?>"> <?php
			if (of_get_option('price_currency') != '') {
						$post_price = get_post_meta($post->ID, '_Price', true);
						if ($post_price) {
							if (of_get_option('price_currency_position') == 'left') {
								$post_price_tag = of_get_option('price_currency') . $post_price;
							} else {
								$post_price_tag = $post_price . of_get_option('price_currency');
							}
							?>
				<div class="pricewrapper">
					<div class="pricewrapper-inner">
						<?php echo $post_price_tag; ?>
					</div>
				</div> <?php
						}
					}
					?> <?php
					//if is youtube or vimeo video


					$photo_source = get_post_meta($post->ID, "_Photo Source", true);



					if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', str_replace('&#038;', '&', $photo_source), $match) || (strpos(parse_url($photo_source, PHP_URL_HOST), 'vimeo.com') !== FALSE && sscanf(parse_url($photo_source, PHP_URL_PATH), '/%d', $video_id))) {
					?>
				<div class="featured-thumb-video"></div> <?php } ?> <?php
				$imgsrc = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium');
				if ($imgsrc[0] == '') {
						$imgsrc[0] = get_template_directory_uri() . '/img/blank.gif';
					}

					//if is animted gif
					$animated_gif = false;
					if (substr($imgsrc[0], -4) == '.gif' && get_post_meta(get_post_thumbnail_id($post->ID), 'a_gif', true) == 'yes') {
							$animated_gif = true;
							$animated_gif_imgsrc_full = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
							echo '<div class="featured-thumb-gif"></div>';

					}
					?> <img class="featured-thumb<?php if ($animated_gif) echo ' featured-thumb-gif-class" data-animated-gif-src-medium="' . $imgsrc[0] .  '" data-animated-gif-src-full="' . $animated_gif_imgsrc_full[0]; ?>" src="<?php echo $imgsrc[0]; ?>" alt="<?php the_title_attribute(); ?>" style="width:<?php echo $imgsrc[1] ?>px;height:<?php echo $imgsrc[2] ?>px" />
			</a>

			<?php
			$tags = '';
			if (of_get_option('posttags') == 'enable') {
					$the_tags = get_the_tags();
					if ($the_tags) {
						foreach($the_tags as $the_tags) {
							$tags .= $the_tags->name . ', ';
						}
					}
				}
				?>

			<div class="post-title"
				data-title="<?php esc_attr_e($post->post_title); ?>"
				data-tags="<?php esc_attr_e(substr($tags, 0, -2)); ?>"
				data-price="<?php esc_attr_e($post_price); ?>"
				data-content="<?php esc_attr_e($post->post_content); ?>">
				<?php
				//echo mb_strimwidth(strip_tags(get_the_title()), 0, 255, ' ...');
				echo mb_strimwidth(strip_tags(get_the_title($post->ID)), 0, 255, ' ...');

				$posttags = get_the_tags();
				if ($posttags) {
						echo '<div id="thetags">';

						foreach($posttags as $tag) {
							echo '<a href="' . get_tag_link($tag->term_id). '">' . $tag->name . '</a> ';
						}

						echo '</div>';
					}
					?>
			</div>
		</div>

		<?php 
		$likes_number = get_post_meta($post->ID, '_Likes Count', true);
		$repins_number = get_post_meta($post->ID, '_Repin Count', true);
		$comments_number = get_comments_number();
		?>
		<div class="masonry-meta masonry-meta-comment-likes text-align-center">
			<?php
			if ($likes_number == '' || $likes_number == '0') {
					echo '<span id="likes-count-' . $post->ID . '" class="likes-count hide"></span>';
				} elseif ($likes_number == '1') {
					echo '<span id="likes-count-' . $post->ID . '" class="likes-count">1 ' . __('like', 'ipin') . '</span>';
				} else {
					echo '<span id="likes-count-' . $post->ID . '" class="likes-count">' . $likes_number . ' ' . __('likes', 'ipin') . '</span>';
				}

				if ($comments_number == '0') {
					echo '<span id="comments-count-' . $post->ID . '" class="comments-count hide"></span>';
				} elseif ($comments_number == '1') {
					echo '<span id="comments-count-' . $post->ID . '" class="comments-count">1 ' . __('comment', 'ipin') . '</span>';
				} else {
					echo '<span id="comments-count-' . $post->ID . '" class="comments-count">' . $comments_number . ' ' . __('comments', 'ipin') . '</span>';
				}

				if ($repins_number == '' || $repins_number == '0') {
					echo '<span id="repins-count-' . $post->ID . '" class="repins-count hide"></span>';
				} elseif ($repins_number == '1') {
					echo '<span id="repins-count-' . $post->ID . '" class="repins-count">1 ' . __('repin', 'ipin') . '</span>';
				} else {
					echo '<span id="repins-count-' . $post->ID . '" class="repins-count">' . $repins_number . ' ' . __('repins', 'ipin') . '</span>';
				}
				?>
		</div>

		<div class="masonry-actionbar-mobile">
			<?php if (current_user_can('administrator') || current_user_can('editor') || current_user_can('author') || !is_user_logged_in()) { ?>
			<a class="ipin-repin btn btn-small"
				data-post_id="<?php echo $post->ID ?>" href="#"><?php _e('Repin', 'ipin'); ?>
			</a>
			<?php } ?>
			<?php if ($post->post_author != $user_ID) { ?>
			<button
				class="ipin-like btn btn-small<?php if(ipin_liked($post->ID)) { echo ' disabled'; } ?>"
				data-post_id="<?php echo $post->ID ?>"
				data-post_author="<?php echo $post->post_author; ?>" type="button">
				<?php _e('Like', 'ipin'); ?>
			</button>
			<?php } else { ?>
			<a class="btn btn-small"
				href="<?php echo home_url('/pins-settings/'); ?>?i=<?php echo $post->ID; ?>"><?php _e('Edit', 'ipin'); ?>
			</a>
			<?php } ?>
			<a class="ipin-comment btn btn-small"
				href="<?php the_permalink(); ?>#respond"
				data-post_id="<?php echo $post->ID ?>"><?php _e('Comment', 'ipin'); ?>
			</a>
		</div>

		<div class="masonry-meta">
			<div class="masonry-meta-avatar">
				<a
					href="<?php echo home_url('/' . $wp_rewrite->author_base . '/') . get_the_author_meta('user_nicename'); ?>/"><?php echo get_avatar(get_the_author_meta('ID') , '30'); ?>
				</a>
			</div>
			<div class="masonry-meta-comment">
				<span class="masonry-meta-author"><?php the_author_posts_link(); ?>
				</span>
				<?php 
				$original_post_id = get_post_meta($post->ID, "_Original Post ID", true);
				if ($original_post_id != '' && $original_post_id != 'deleted') {
							$original_postdata = get_post($original_post_id, 'ARRAY_A');
							$original_author = get_user_by('id', $original_postdata['post_author']);
							?>
				<?php _e('via', 'ipin'); ?>
				<a
					href="<?php echo home_url('/' . $wp_rewrite->author_base . '/') . $original_author->user_nicename; ?>/"><strong><?php echo $original_author->display_name; ?>
				</strong> </a>
				<?php
						}


						if ($board_info = get_the_terms($post->ID, 'board')) {
							_e('onto', 'ipin');
							foreach ($board_info as $board) {
							?>
				<span class="masonry-meta-content"><strong><a
						href="<?php echo home_url('/board/'); ?><?php echo $board->term_id ?>/"><?php echo $board->name; ?>
					</a> </strong> </span>
				<?php
							}
						}
						?>
			</div>
		</div>

		<?php
		if ('0' != $frontpage_comments_number = of_get_option('frontpage_comments_number')) {
			?>
		<div id="masonry-meta-comment-wrapper-<?php echo $post->ID; ?>">
			<?php
			if ($comments_number >  $frontpage_comments_number) {
					$offset = $comments_number - $frontpage_comments_number;
				} else {
					$offset = 0;
				}

				$args = array(
					'number' => $frontpage_comments_number,
					'post_id' => $post->ID,
					'order' => 'asc',
					'offset' => $offset,
					'status' => 'approve'
				);
				$comments = get_comments($args);
				foreach($comments as $comment) {
				?>
			<div class="masonry-meta">
				<?php $comment_author = get_user_by('id', $comment->user_id); ?>
				<div class="masonry-meta-avatar">
					<?php if ($comment_author) { ?>
					<a
						href="<?php echo home_url('/' . $wp_rewrite->author_base . '/') . $comment_author->user_nicename; ?>/">
						<?php } ?> <?php echo get_avatar($comment->user_id, '30'); ?> <?php if ($comment_author) { ?>
					</a>
					<?php } ?>
				</div>
				<div class="masonry-meta-comment">
					<span class="masonry-meta-author"> <?php if ($comment_author) { ?><a
						href="<?php echo home_url('/' . $wp_rewrite->author_base . '/') . $comment_author->user_nicename; ?>/"><?php } ?>
							<?php echo $comment->comment_author; ?> <?php if ($comment_author) { ?>
					</a> <?php } ?>
					</span> <span class="masonry-meta-comment-content"><?php echo $comment->comment_content; ?>
					</span>
				</div>
			</div>
			<?php 
				}
				?>
		</div>
		<?php
			}

			if (is_user_logged_in()) {
			?>
		<div id="masonry-meta-commentform-<?php echo $post->ID ?>"
			class="masonry-meta hide">
			<div class="masonry-meta-avatar">
				<?php echo get_avatar($user_ID, '30'); ?>
			</div>
			<div class="masonry-meta-comment">
				<?php 
				$id_form = 'commentform-' . $post->ID;
				$id_submit = 'submit-' . $post->ID;

				comment_form(array(
				'id_form' => $id_form,
				'id_submit' => $id_submit,
				'title_reply' => '',
				'cancel_reply_link' => __('X Cancel reply', 'ipin'),
				'comment_notes_before' => '',
				'comment_notes_after' => '',
				'logged_in_as' => '',
				'label_submit' => __('Post Comment', 'ipin'),
				'comment_field' => '<textarea placeholder="' . __('Add a comment...', 'ipin') . '" id="comment" name="comment" aria-required="true"></textarea>'
 		));
 		?>
			</div>
		</div>
		<?php } ?>
	</div>





	<!--working ends-->








	<?php 


		}
	}
	else {
		
		echo '<div class="error">We don\'t have any data for this date.</div>';
		
	}
		?>
</div>



<div class="modal hide" id="post-lightbox"
	tabindex="-1" role="dialog" aria-hidden="true"></div>
		

		</div>
	</div>
