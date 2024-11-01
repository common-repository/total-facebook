<?php
/*
Plugin Name: Total Facebook
Plugin URI: http://hasnath.net/total-facebook-plugin-for-wordpress.php
Description: This is a very powerful plugin for impementing facebook comment & like in wordpress sites. It has lots of amazing options.
Version: 1.0
Author: Shamim Hasnath
Author URI: http://hasnath.net
*/

include('metabox.php');
include('admin_settings.php');
include('like_process.php'); // should be included before 'comment_process.php'
include('comment_process.php');

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'settings_linkWFC' );
function settings_linkWFC($x) {
  $settings_link = '<a href="options-general.php?page=wp-facebook-comments">Settings</a>';
  array_unshift($x, $settings_link);
  return $x;
}

?>
