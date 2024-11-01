<?php

add_action('add_meta_boxes', 'adding_metaboxWFC');

function adding_metaboxWFC() {
// add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
// priority: high, default, low
// context: normal, side, advanced
// page: post, page
add_meta_box('wfc', "Facebook Comments/Like Options", 'metabox_contentoWFC', 'post', 'normal', 'high');
add_meta_box('wfc', "Facebook Comments/Like Options", 'metabox_contentoWFC', 'page', 'normal', 'high');

}

function metabox_contentoWFC($post){ // content to show in meta box
	// get_post_meta($postid, $key, $single);
	// if single true returns single string, if false returns array

    $get_dis_vals = get_post_meta($post->ID, 'wfbcomments_WFC', false);
	$dis_values = $get_dis_vals[0];
    //echo "<pre>".print_r($get_dis_vals)."</pre>";

?>  
    <input type="checkbox" id="enable_fb_coms" name="enable_fb_coms" <?php checked($dis_values['enable_fb_coms'], 'yes'); ?> />
    <label for='enable_fb_coms'>Enable Facebook Comments for this post.</label><br/>
    <input type='checkbox' id='add_like_btn' name='add_like_btn' <?php checked($dis_values['add_like_btn'], 'yes'); ?> />
    <label for='add_like_btn'> Add a Facebook Like button for this post </label><br/>
    
<?php
}

add_action('save_post', 'saving_meta_actionWFC');

function saving_meta_actionWFC($post_id){
    // auto saving, so we don't need to do anything
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
 
    // can you do this?
    //if( !current_user_can( 'edit_post' ) ) return;
    
    //$value_to_save = isset($_POST['comment_disabled'])? 'yes' : 'no';
    $val_save = array( 'enable_fb_coms'=>isset($_POST['enable_fb_coms'])? 'yes' : 'no',
                                'add_like_btn'=>isset($_POST['add_like_btn'])? 'yes' : 'no', 
                                );
    
    update_post_meta($post_id, 'wfbcomments_WFC', $val_save);

}
?>