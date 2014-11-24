<?php
/*********************************************************************/
/*					SECOND FEATURED IMAGE META BOX					 */
/*********************************************************************/


function second_featured_image_meta_box() {
    $screens = array( 'post', 'page' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'second_featured_image',
            __( 'Featured Image 2', 'myplugin_textdomain' ),
            'second_featured_image_inner_box',
            $screen,
			'side',
			'low'
        );
    }
}
add_action( 'add_meta_boxes', 'second_featured_image_meta_box' );


function wp_gear_manager_admin_scripts() {
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_script('jquery');
}

function wp_gear_manager_admin_styles() {
wp_enqueue_style('thickbox');
}

add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
add_action('admin_print_styles', 'wp_gear_manager_admin_styles');



function second_featured_image_inner_box( $post ) {
	
?>		
	<script language="JavaScript">
	
    jQuery(document).ready(function() {
		jQuery('#upload_image_button').click(function() {
			formfield = jQuery('#upload_image').attr('name');
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			return false;
		});
		
		window.send_to_editor = function(html) {
			imgurl = jQuery('img',html).attr('src');
			jQuery('#upload_image').val(imgurl);
			tb_remove();
		}
    });
	
    </script>		
<?php
	
	$featured2_url = get_post_meta( $post->ID, '_second_featured_image_url_key', true);
	
	echo '<input id="upload_image" type="hidden" size="36" name="upload_image" value="' . esc_attr(base64_decode($featured2_url)) . '" />';
	
	if(!empty($featured2_url)){
		$featured2_embeded = '<img src="' . esc_attr(base64_decode($featured2_url)) . '" width="100%" />';
		echo $featured2_embeded;
	}
	echo '<p><a href="#" id="upload_image_button">Set featured image 2</a></p>';


}
function second_featured_image_save_postdata( $post_id ) {
	$featured2_url = $_POST['upload_image'];
	$featured2_url = base64_encode($featured2_url);
	update_post_meta( $post_id, '_second_featured_image_url_key', $featured2_url);
}
add_action( 'save_post', 'second_featured_image_save_postdata' );







?>