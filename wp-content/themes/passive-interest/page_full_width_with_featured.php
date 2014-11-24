<?php
/*
Template Name: Page full-wdith with Featured
*/
?>

<?php get_header(); ?>

<?php

$video_url = get_post_meta( $post->ID, '_featured_video_url_key', true);
$video_url = base64_decode($video_url);
$video_embeded = wp_oembed_get($video_url,array('width' => 1200));		

if(!empty($video_url)){
?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$("iframe").each(resize);
		$(window).resize(function(){
			$("iframe").each(resize);
		});
	
		function resize(){															
			var ifWidth = $(this).width();
			var ifHeight = $(this).height();
			var ratio = 1.5;
		
			if($(this).length > 0){
				var newWidth = $(this).width();
				var newHeight = newWidth/ratio;	
			}
			$(this).height(newHeight);	
		}
	});
</script>
<?php
}
?>

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="row">
					<?php while (have_posts()) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" <?php post_class('post-wrapper'); ?>>
						<div class="h1-wrapper">
                        
						<?php $value = get_post_meta( $post->ID, '_my_meta_value_key', true );
						
						switch ($value)
						{
							case "title":
								echo '<h1>';
								echo the_title();
								echo '</h1>';
								break;
							
							case "image":
								echo '<div class="thumbnail-wrapper">';
								echo the_post_thumbnail(array(1200,999999));
								echo '</div>';
								break;
							
							case "video":
								echo '<div class="video-wrapper">' . $video_embeded . '</div>'; 
                                break;
								
							case "title_and_image":
								echo '<h1>';
								echo the_title();
								echo '</h1>';
								echo '<div class="thumbnail-wrapper">';
								echo the_post_thumbnail(array(1200,999999));
								echo '</div>';
								break;
							
							case "title_and_video":
								echo '<h1>';
								echo the_title();
								echo '</h1>';
								echo '<div class="video-wrapper">' . $video_embeded . '</div>';
								break;
								
							case "image_and_video":
								echo '<div class="thumbnail-wrapper">';
								echo the_post_thumbnail(array(1200,999999));
								echo '</div>';
								echo '<div class="video-wrapper">' . $video_embeded . '</div>';
								break;
								
							case "t_i_m":
								echo '<h1>';
								echo the_title();
								echo '</h1>';
								echo '<div class="thumbnail-wrapper">';
								echo the_post_thumbnail(array(1200,999999));
								echo '</div>';
								echo '<div class="video-wrapper">' . $video_embeded . '</div>';
								break;
								
							default :
								echo '<h1>';
								echo the_title();
								echo '</h1>';
								echo '<div class="thumbnail-wrapper">';
								echo the_post_thumbnail(array(1200,999999));
								echo '</div>';
								break;
						}
						?>

						</div><!--end h1-wrapper-->
                        
						<div class="post-content">
							<div class="thecontent">
							<?php the_content(); ?>
							</div>
							<?php
							wp_link_pages( array( 'before' => '<p><strong>' . __('Pages:', 'ipin') . '</strong>', 'after' => '</p>' ) );
							edit_post_link(__('Edit Page', 'ipin'),'<p>[ ',' ]</p>');
							?>
						</div>
						
						<div class="post-comments">
							<div class="post-comments-wrapper">
								<?php comments_template(); ?>
							</div>
						</div>
						
					</div>
					<?php endwhile; ?>
			</div>
		</div>
	</div>

	<div id="scrolltotop"><a href="#"><i class="icon-chevron-up"></i><br /><?php _e('Top', 'ipin'); ?></a></div>
</div>



<?php get_footer(); ?>