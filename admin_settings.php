<?php


add_action('admin_menu', 'adding_settings_pageWFC'); 

function adding_settings_pageWFC(){
    add_options_page('Facebook Settings', 'Facebook Settings', 'manage_options', 'wp-facebook-comments', 'settings_pageWFC');
    add_plugins_page('Facebook Settings', 'Facebook Settings', 'manage_options', 'wp-facebook-comments', 'settings_pageWFC');
    add_action('admin_init', 'register_settingsWFC');
}

function register_settingsWFC() {
    register_setting('wfc_globalform', 'wfc_global');
    register_setting('wfc_commentform', 'wfc_com');
    register_setting('wfc_likeform', 'wfc_like');

}
    
function settings_pageWFC() {
    ?>
<style type='text/css'>
h3 { padding: 10px;  }
.fbds {padding: 5px 0 15px 15px; }
.in1{ width: 300px; }
.in2{width: 150px; }
.copr { font-weight: bold; line-height: 15px }
.note { color: #B93217; font-weight: bold; }

</style>
    <div class='wrap'>
    <?php
    /* =======================================
    //      Global Settings 
    //======================================== */ ?>
        <div class='postbox'>
            <h3>Global Settings</h3>
            <div class='fbds'>
                <form method='post' action='options.php'>
                        <?php settings_fields('wfc_globalform'); ?>
                        <?php $wfc_global = get_option('wfc_global'); ?>
<span class='note'>NOTE:<br/>
If you don't understand any of these options, please visit <a href="http://hasnath.net/total-facebook-plugin-for-wordpress.php">Official Plugins Page</a>  to learn more..    </span><br/><br/>


                 <input type='checkbox' name="wfc_global[includesdk]" <?php checked($wfc_global['includesdk'], 'on'); ?> />
                 <label for='wfc_global[includesdk]'>Include Facebook JS SDK (*required , if not already included manually or by another plugin, select 

it)</label><br/><br/>
                <table><tr>
                <td>Facebook App ID:</td>
                 <td><input type='text' class='in1' name='wfc_global[appid]' value='<?=$wfc_global['appid']?>' /> (whats this? visit <a href="http://hasnath.net/total-facebook-plugin-for-wordpress.php">Official Plugin's Page</a></td></tr>
                <?php if(strlen($wfc_global['lang']) < 2) $wfc_global['lang'] = "en_US"; ?>
               <tr><td> Language:</td>
                 <td><input type='text' class='in1' name='wfc_global[lang]' value='<?=$wfc_global['lang']?>' /> (en_US for English)

</td></tr></table>
                <br/><br/>
                <input  type="submit" class="button-primary" value="<?php _e('Update Global Settings'); ?>" />
    
                </form>
            </div>
         </div> <!-- postbox -->
         <?php 
         /*================================
         //             Comment Settings
         //================================ */ ?>
         <div class='postbox'>
            <h3>Facebook Comment Settings</h3>
            <div class='fbds'>
                <form method='post' action='options.php'>
                        <?php settings_fields('wfc_commentform'); ?>
                        <?php $wfc_com = get_option('wfc_com'); ?>
                <table>
                    <tr>
                        <td>Position of comment box: </td>
                        <td>
                        <select name='wfc_com[pos]' class='in1'>' 
                            <option value='before_wp' <?=selected($wfc_com['pos'], 'before_wp')?> >Before Wordpress Comments</option>
                            <option value='after_wp' <?=selected($wfc_com['pos'], 'after_wp')?> > After Wordpress Comments </option>
                            <option value='after_form' <?=selected($wfc_com['pos'], 'after_form')?> >After Wordpress Comment Form</option>
                       </select>
                       </td>
                    </tr>
                    <tr>
                        <td>Options: </td>
                        <td>
                        <select name='wfc_com[option]' class='in1'>
                            <option value='individual' <?=selected($wfc_com['option'], 'individual')?> >Individual Setting is the best</option>
                            <option value='enable_all' <?=selected($wfc_com['option'], 'enable_all')?> >Enable Comment for all pages/posts</option>
                            <option value='disable_all' <?=selected($wfc_com['option'], 'disable_all')?> >Disable Comment for all pages/posts</option>
                            <option value='enpage' <?=selected($wfc_com['option'], 'enpage')?> >Enable for all pages</option>
                            <option value='enpost' <?=selected($wfc_com['option'], 'enpost')?> >Enable for posts</option>
                       </select> when enabled/disabled for one type, individual setting will work for another
                       </td>
                       </tr>
                       <tr>
                            <td>
                   <?php if(strlen($wfc_com['width']) < 2) $wfc_com['width'] = 470; ?>
               <tr><td>Comment Box Width:</td>
                 <td><input type='text' class='in2' name='wfc_com[width]' value='<?=$wfc_com['width']?>' /> (default: 470)</td>
                 </tr>
                 <tr>
                          <td>
                   <?php if(strlen($wfc_com['numpost']) < 2) $wfc_com['numpost'] = 10; ?>
               <tr><td>Number of posts:</td>
                 <td><input type='text' class='in2' name='wfc_com[numpost]' value='<?=$wfc_com['numpost']?>' /> (default: 10)</td>
                 </tr>
                 <tr>
                        <td>Color Scheme: </td>
                        <td>
                        <select name='wfc_com[schm]' class='in2'>
                            <option value='light' <?=selected($wfc_com['schm'], 'light')?> >Light</option>
                            <option value='dark' <?=selected($wfc_com['schm'], 'dark')?> >Dark</option>
                       </select>
                       </td>
                       </tr>
                       <tr>
                            <td>Comment Count Text: </td><td>
                            <input type='text' class='in2' name='wfc_com[txtpre]' value='<?=$wfc_com['txtpre'] ?>'>
                            344
                            <input type='text' class='in2' name='wfc_com[txtpost]' value='<?=$wfc_com['txtpost'] ?>'>
                            leave two box blank if you don't want to show comment count text
                            </td>
                         </tr>
                         <tr>
                            <td>Text Before(Title) Comment Box: </td><td>
                            <input type='text' class='in1' name='wfc_com[title]' value='<?=$wfc_com['title'] ?>'>
                            </td>
                         </tr>
                         <tr>
                            <td>Comment box css style: </td><td>
                            <input type='text' class='in1' name='wfc_com[css]' value='<?=$wfc_com['css'] ?>'>
                            </td>
                         </tr>
                         <tr>
                            <td>Comment Moderators Facebook ID</td><td>
                            <input type='text' class='in1' name='wfc_com[mods]' value='<?=$wfc_com['mods'] ?>'>
                            </td>
                         </tr>
                            
                         
                       </table><br/><br/>
                       
                       <input  type="submit" class="button-primary" value="<?php _e('Update Comment Settings'); ?>" />
    
                </form>
		</div>
	</div> <!-- postbox -->
    <?php
    /* =======================================
    //      Like button setting
    //======================================== */ ?>
        <div class='postbox'>
            <h3>Like & Share Button Settings</h3>
            <div class='fbds'>
                <form method='post' action='options.php'>
                        <?php settings_fields('wfc_likeform'); ?>
                        <?php $wfc_like = get_option('wfc_like'); ?>
                 <table>
                    <tr>
                        <td>Position of Like button: </td>
                        <td>
                        <select name='wfc_like[pos]' class='in1'>' 
                            <option value='after_title' <?=selected($wfc_like['pos'], 'after_title')?> >After Post Title</option>
                            <option value='after_content' <?=selected($wfc_like['pos'], 'after_content')?> > After Post </option>
                            <option value='after_tags' <?=selected($wfc_like['pos'], 'after_tags')?> >After Post Tags</option>
                       </select>
                       </td>
                    </tr>
                    <tr>
                    <td>Options: </td>
                        <td>
                        <select name='wfc_like[option]' class='in1'>
                            <option value='individual' <?=selected($wfc_like['option'], 'individual')?> >Individual Setting is the best</option>
                            <option value='enable_all' <?=selected($wfc_like['option'], 'enable_all')?> >Enable Like Button for all pages/posts</option>
                            <option value='disable_all' <?=selected($wfc_like['option'], 'disable_all')?> >Disable Like Button for all pages/posts</option>
                            <option value='enpage' <?=selected($wfc_like['option'], 'enpage')?> >Enable for all pages</option>
                            <option value='enpost' <?=selected($wfc_like['option'], 'enpost')?> >Enable for posts</option>
                       </select> when enabled/disabled for one type, individual setting will work for another
                       </td>
                   </tr>
                    <tr>
                        <td><label for='wfc_like[send]'>Add Send Button</label></td>
                        <td><input type='checkbox' name="wfc_like[send]" <?php checked($wfc_like['send'], 'on'); ?> /></td>
                  </tr>
                  <tr>
                    <td>Like Button layout: </td>
                        <td>
                        <select name='wfc_like[layout]' class='in2'>' 
                            <option value='standard' <?=selected($wfc_like['layout'], 'standard')?> >standard</option>
                            <option value='button_count' <?=selected($wfc_like['layout'], 'button_count')?> > button_count</option>
                            <option value='box_count' <?=selected($wfc_like['layout'], 'box_count')?> >box_count</option>
                       </select>
                       </td>
                    </tr>
                    <tr>
                         <td>Width: </td><td>
                            <input type='text' class='in1' name='wfc_like[width]' value='<?=$wfc_like['width'] ?>'>
                            </td>
                    </tr>
                    <tr>
                        <td><label for='wfc_like[faces]'>Show Faces</label></td>
                        <td><input type='checkbox' name="wfc_like[faces]" <?php checked($wfc_like['faces'], 'on'); ?> /></td>
                  </tr>
                  <tr>
                    <td>Verb to display: </td>
                        <td>
                        <select name='wfc_like[verb]' class='in2'>' 
                            <option value='like' <?=selected($wfc_like['verb'], 'like')?> >like</option>
                            <option value='recommend' <?=selected($wfc_like['verb'], 'recommend')?> >recommend</option>
                       </select>
                       </td>
                    </tr>
                    <tr>
                    <td>Color scheme: </td>
                        <td>
                        <select name='wfc_like[schm]' class='in2'>' 
                            <option value='light' <?=selected($wfc_like['schm'], 'light')?> >light</option>
                            <option value='dark' <?=selected($wfc_like['schm'], 'dark')?> >dark</option>
                       </select>
                       </td>
                    </tr>
                    <tr>
                    <td>Font: </td>
                        <td>
                        <select name='wfc_like[font]' class='in2'>' 
                            <option value='arial' <?=selected($wfc_like['font'], 'arial')?> >arial</option>
                            <option value='lucida grande' <?=selected($wfc_like['font'], 'lucida grande')?> >lucida grande</option>
                            <option value='segoe ui' <?=selected($wfc_like['font'], 'segoe ui')?> >segoe ui</option>
                            <option value='tahoma' <?=selected($wfc_like['font'], 'tahoma')?> >tahoma</option>
                            <option value='trebuchet ms' <?=selected($wfc_like['font'], 'trebuchet ms')?> >trebuchet ms</option>
                            <option value='verdana' <?=selected($wfc_like['font'], 'verdana')?> ></option>
                       </select>
                       </td>
                    </tr>
                    <tr>
                         <td>Like button container div style: </td><td>
                            <input type='text' class='in1' name='wfc_like[css]' value='<?=$wfc_like['css'] ?>'>
                            </td>
                    </tr>
			<tr><td><h4>Share Button Settings</h4></td></tr>
		<tr>
                        <td><label for='wfc_like[share_off]'>Exclude Share Button with share count</label></td>
                        <td><input type='checkbox' name="wfc_like[share_off]" <?php checked($wfc_like['share_off'], 'on'); ?> /></td>
                  </tr>
		
                    </table>
                    <br/><br/>
                <input  type="submit" class="button-primary" value="<?php _e('Update Like Button Settings'); ?>" />
    
                </form>
                 </div>
              </div> <!--postbox-->
		<div class='postbox'>
            <div class='copr fbds'>
      <br/><br/>
            
                Developer: Shamim Hasnath<br/>
                Email: shamim@hasnath.net<br/>
                Web: www.hasnath.net<br/>
                <br/>
                
                finally, cordial thanks to you for using this plugin<br/><br/><br/>
<?php 
//========================
//= Donation Link
//========================= ?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_donations">
<input type="hidden" name="business" value="sha404@ymail.com">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Hasnath.net">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

             </div>
       </div>
                 
        

</div> <!-- wrap -->
 <?php } ?>