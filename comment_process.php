<?php

// is_singular when $post is not loaded. so to make sure, we do it when at the
//time of attribute adding


add_filter('language_attributes', 'set_fbcom_position_and_place_sdkog');


function set_fbcom_position_and_place_sdkog($attrb) {

	if( is_singular() ) { // if its a post, page or attachment page, unless do nothing
		$cm_optn = get_option('wfc_com');
		$fxd = $cm_optn['option'];
		global $post;
		$mtx = get_post_meta($post->ID, 'wfbcomments_WFC', false);
		
        // COMMENTS
		// if not disable for all post 
		// then check if enable for all or enable for that post type or enable in individual setting
		// if comes this far, do what needs to be done
		if($fxd != "disable_all" && ($fxd == "enable_all" || $fxd == "en".$post->post_type || $mtx[0]['enable_fb_coms'] == "yes")) {
			if($cm_optn['pos'] == "before_wp" )
				add_filter('comments_array', 'add_comment_boxwrapper_for_filter', 12 );
			else if ($cm_optn['pos'] == "after_wp")
					add_action('comment_form_before', 'add_comment_boxWFC');
			 else if ($cm_optn['pos'] == "after_form")
					add_action('comment_form_after', 'add_comment_boxWFC');
		}
			//echo "<pre>";
			//print_r($cm_optn);
		//echo "</pre>";
        // LIKES
        $like_optn = get_option('wfc_like');
        $fxdm = $like_optn['option'];
        if($fxdm != "disable_all" && ($fxdm == "enable_all" || $fxdm == "en".$post->post_type || $mtx[0]['add_like_btn'] == "yes")) {
            if($like_optn['pos'] == "after_title")
                    add_filter('the_content', 'like_dis_after_title', 100); // very last
             else if($like_optn['pos'] == "after_content")
                     add_filter('the_content', 'like_dis_after_content', 1); // immediately after content
              else if($like_optn['pos'] == "after_tags")
                      add_filter('comments_array', 'like_dis_after_tags', 1);
        
        }
		     
     	if(strlen($cm_optn['mods']) > 0)
            add_action('wp_head', 'add_modWFC');
		
		

	$wfcglb = get_option('wfc_global');
    	if($wfcglb['includesdk'] == 'on' ){
            add_action('wp_footer', 'fbsdk_includeWFC');
		echo " xmlns:fb=\"http://ogp.me/ns/fb#\" ";
        }
	
	if($like_optn['share_off'] != 'on'){
		add_action('wp_footer', 'facebook_share', 15);
	
	}


    } // is singular

	return $attrb;
}   // set_fbcomm position


function add_comment_boxWFC() {
    $prm_link = wp_get_shortlink(); // better than permalink because doesn't affect if link structure changed
    $wfc = get_option('wfc_com');
    echo "<div id='fbcommentbox' style='".$wfc['css']."'>";
    if(strlen($wfc['title']) > 0 )
        echo "<h3>".$wfc['title']."</h3>";
    if(strlen($wfc['txtpre']) > 0 || strlen($wfc['txtpost'] > 0)){
        echo "<h4>".$wfc['txtpre'];
        echo "<fb:comments-count href=\"".$prm_link."\"></fb:comments-count>";
        echo $wfc['txtpost']."</h4>";
     }
     
     
     if($wfc['schm'] == "dark") $schmx = " colorscheme=\"dark\" "; else $schmx = "";
     
     echo "<fb:comments href=\"".$prm_link."\" num_posts=\"".$wfc['numpost'];
     echo "\" width=\"".$wfc['width']."\"".$schmx."></fb:comments>";
     echo "</div>";

	
    

}

function add_comment_boxwrapper_for_filter($comments) {

	add_comment_boxWFC();
	return $comments;

}

function fbsdk_includeWFC(){
    $wfcglb = get_option('wfc_global');
    echo  "
 <div id=\"fb-root\"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = \"//connect.facebook.net/".$wfcglb['lang']."/all.js#xfbml=1&appId=".$wfcglb['appid']."\";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>";


 echo "<!-- added by facebook total plugin -->";
}
function add_modWFC(){
    $wfc = get_option('wfc_com');
    echo "<meta property=\"fb:admins\" content=\"".$wfc['mods']."\"/>";
}

function facebook_share(){
	$wfcglb = get_option('wfc_global');
?>
<script>
      FB.init({appId: "<?=$wfcglb['appid']?>", status: true, cookie: true});

      function facebook_share() {

       FB.ui({
          method: 'feed',
          link: '<?=get_permalink();?>',
          name: '<?=htmlspecialchars(the_title());?>',
          caption: '<?=strip_tags(get_the_excerpt())?>',
        });


      }
   
    </script>
<?php

}

?>