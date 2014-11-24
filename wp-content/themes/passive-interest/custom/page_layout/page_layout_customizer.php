<?php
/*********************************************************************/
/*						PAGE LAYOUT META BOX						 */
/*********************************************************************/
function myplugin_add_custom_box() {
    $screens = array( 'post', 'page' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'myplugin_sectionid',
            __( 'Page Layout', 'myplugin_textdomain' ),
            'myplugin_inner_custom_box',
            $screen,
			'side',
			'low'
        );
    }
}
add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );
function myplugin_inner_custom_box( $post ) {
  	wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );
	$value = get_post_meta( $post->ID, '_my_meta_value_key', true );
	echo '<select name="myplugin_new_field">';
	switch ($value)
	{
		case "title":
			echo '<option selected="selected" value="title">Title</option>';
			echo '<option value="image">Image</option>';
			echo '<option value="video">Video</option>';
			echo '<option value="title_and_image">Title &#38; Image</option>';
			echo '<option value="title_and_video">Title &#38; Video</option>';
			echo '<option value="image_and_video">Image &#38; Video</option>';
			echo '<option value="t_i_m">Title &#38; Image &#38; Video</option>';
			break;
			
		case "image":
			echo '<option value="title">Title</option>';
			echo '<option selected="selected" value="image">Image</option>';
			echo '<option value="video">Video</option>';
			echo '<option value="title_and_image">Title &#38; Image</option>';
			echo '<option value="title_and_video">Title &#38; Video</option>';
			echo '<option value="image_and_video">Image &#38; Video</option>';
			echo '<option value="t_i_m">Title &#38; Image &#38; Video</option>';
			break;
			
		case "video":
			echo '<option value="title">Title</option>';
			echo '<option value="image">Image</option>';
			echo '<option selected="selected" value="video">Video</option>';
			echo '<option value="title_and_image">Title &#38; Image</option>';
			echo '<option value="title_and_video">Title &#38; Video</option>';
			echo '<option value="image_and_video">Image &#38; Video</option>';
			echo '<option value="t_i_m">Title &#38; Image &#38; Video</option>';
			break;
			
		case "title_and_image":
			echo '<option value="title">Title</option>';
			echo '<option value="image">Image</option>';
			echo '<option value="video">Video</option>';
			echo '<option selected="selected" value="title_and_image">Title &#38; Image</option>';
			echo '<option value="title_and_video">Title &#38; Video</option>';
			echo '<option value="image_and_video">Image &#38; Video</option>';
			echo '<option value="t_i_m">Title &#38; Image &#38; Video</option>';
			break;
			
		case "title_and_video":
			echo '<option value="title">Title</option>';
			echo '<option value="image">Image</option>';
			echo '<option value="video">Video</option>';
			echo '<option value="title_and_image">Title &#38; Image</option>';
			echo '<option selected="selected" value="title_and_video">Title &#38; Video</option>';
			echo '<option value="image_and_video">Image &#38; Video</option>';
			echo '<option value="t_i_m">Title &#38; Image &#38; Video</option>';
			break;
			
		case "image_and_video":
			echo '<option value="title">Title</option>';
			echo '<option value="image">Image</option>';
			echo '<option value="video">Video</option>';
			echo '<option value="title_and_image">Title &#38; Image</option>';
			echo '<option value="title_and_video">Title &#38; Video</option>';
			echo '<option selected="selected" value="image_and_video">Image &#38; Video</option>';
			echo '<option value="t_i_m">Title &#38; Image &#38; Video</option>';
			break;
			
		case "t_i_m":
			echo '<option value="title">Title</option>';
			echo '<option value="image">Image</option>';
			echo '<option value="video">Video</option>';
			echo '<option value="title_and_image">Title &#38; Image</option>';
			echo '<option value="title_and_video">Title &#38; Video</option>';
			echo '<option value="image_and_video">Image &#38; Video</option>';
			echo '<option selected="selected" value="t_i_m">Title &#38; Image &#38; Video</option>';
			break;
			
		default:
			echo '<option value="title">Title</option>';
			echo '<option value="image">Image</option>';
			echo '<option value="video">Video</option>';
			echo '<option selected="selected" value="title_and_image">Title &#38; Image</option>';
			echo '<option value="title_and_video">Title &#38; Video</option>';
			echo '<option value="image_and_video">Image &#38; Video</option>';
			echo '<option value="t_i_m">Title &#38; Image &#38; Video</option>';
			break;
	}
	echo '</select>';
}
function myplugin_save_postdata( $post_id ) {
	 $mydata = $_POST['myplugin_new_field'];
	 update_post_meta( $post_id, '_my_meta_value_key', $mydata );
}
add_action( 'save_post', 'myplugin_save_postdata' );
/*********************************************************************/
/*						  PAGE LAYOUT META BOX						 */
/*********************************************************************/
?>