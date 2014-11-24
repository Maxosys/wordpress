<?php
/*********************************************************************/
/*						FEATURED VIDEO META BOX						 */
/*********************************************************************/
function featured_video_meta_box() {
    $screens = array( 'post', 'page' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'featured_video',
            __( 'Featured Video', 'myplugin_textdomain' ),
            'featured_video_inner_box',
            $screen,
			'side',
			'low'
        );
    }
}
add_action( 'add_meta_boxes', 'featured_video_meta_box' );
function featured_video_inner_box( $post ) {
  	wp_nonce_field( 'featured_video_inner_box', 'featured_video_inner_box_nonce' );
	$video_url = get_post_meta( $post->ID, '_featured_video_url_key', true);
	
	echo '<label>Video URL: </label>';
	echo '<br />';
	echo '<input type="text" name="video_url" value="' . esc_attr(base64_decode($video_url)) .'" size="40" />'; 
}
function featured_video_save_postdata( $post_id )
{
	 $video_url = $_POST['video_url'];
	 $video_url = base64_encode($video_url);
	 update_post_meta( $post_id, '_featured_video_url_key', $video_url);
}
add_action( 'save_post', 'featured_video_save_postdata' );

?>