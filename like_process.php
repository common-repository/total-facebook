<?php

//<fb:like href="http://faddd.com" send="true" layout="button_count" width="450" show_faces="true" action="recommend" font="tahoma"></fb:like>

function like_btn_display(){
    $wfc_like = get_option('wfc_like');
    $txt = "<div id='wfc_like' style=\"".$wfc_like['css']."\">";

	//Placing share button if not excluded
	if($wfc_like['share_off'] != 'on'){
		$mk = file_get_contents('http://graph.facebook.com/'.get_permalink());
    		$fook = json_decode($mk);
		$txt .= "<img onclick='facebook_share();' style='' src='".WP_PLUGIN_URL."/total-facebook/fbshare.jpg'/>    <span style='background: white;'><small>  $fook->shares</small>   </span>";
  
	}

	//Placing like button	
    $txt .= "<fb:like href=\"".wp_get_shortlink()."\" send=\"".($wfc_like['send'] == 'on' ? "true" : "false")."\" ";
    $txt .= ($wfc_like['layout'] != "standard" ? "layout=\"".$wfc_like['layout']."\" " : "");
    $txt .= "show_faces=\"".($wfc_like['faces'] == 'on' ? "true" : "false")."\" ";
    $txt .= ($wfc_like['verb'] != "like" ? "action=\"".$wfc_like['verb']."\" " : "");
    $txt .= "font=\"".$wfc_like['font']."\"></fb:like></div><br/>";
	
    return $txt;
}
    

function like_dis_after_title($content) {
    
    return like_btn_display().$content;
}

function like_dis_after_content($content){

    return $content.like_btn_display();
}

function like_dis_after_tags($comments){
    
    echo like_btn_display();
    return $comments;
}