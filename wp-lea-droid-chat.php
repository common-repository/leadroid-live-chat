<?php
/*
Plugin Name: LeaDroid Chat
Plugin URI: http://www.leadroid.com/leadroidchat
Description: Allows you to add LeaDroid Chat code into your Wordpress blog
Version: 1.1
Author: LeaDroid
Author URI: http://www.leadroid.com
License: GPLv2 or later
*/

/*  Copyright 2016  LeaDroid ltd  (email : info@leadroid.com)

    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define('wpldc_PLUGIN_DIR',str_replace('\\','/',dirname(__FILE__)));

if ( !class_exists( 'leadroidchat' ) ) {
	
	class leadroidchat {

		function leadroidchat() {
		
			add_action( 'init', array( &$this, 'init' ) );
			add_action( 'admin_init', array( &$this, 'admin_init' ) );
			add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
			add_action( 'wp_head', array( &$this, 'wp_head' ) );
			add_action( 'wp_footer', array( &$this, 'wp_footer' ) );
		
		}
		
	
		function init() {
			load_plugin_textdomain( 'wp-lea-droid-chat', false, dirname( plugin_basename ( __FILE__ ) ).'/lang' );
		}
	
		function admin_init() {
			register_setting( 'wp-lea-droid-chat', 'wpldc_insert_header', 'trim' );
			register_setting( 'wp-lea-droid-chat', 'wpldc_insert_footer', 'trim' );

			foreach (array('post','page') as $type) 
			{
				add_meta_box('wpldc_all_post_meta', 'Insert Script to &lt;head&gt;', 'wpldc_meta_setup', $type, 'normal', 'high');
			}
			
			add_action('save_post','wpldc_post_meta_save');
		}
	
		function admin_menu() {
			$page = add_submenu_page( 'options-general.php', 'LeaDroid Chat', 'LeaDroid Chat', 'manage_options', __FILE__, array( &$this, 'wpldc_options_panel' ) );
			}
	
		function wp_head() {
			$meta = get_option( 'wpldc_insert_header', '' );
				if ( $meta != '' ) {
					echo $meta, "\n";
				}

			$wpldc_post_meta = get_post_meta( get_the_ID(), '_inpost_head_script' , TRUE );
				if ( $wpldc_post_meta != '' ) {
					echo $wpldc_post_meta['synth_header_script'], "\n";
				}
			
		}
		   
		 function wp_footer() {
			$meta = get_option( 'wpldc_insert_footer', '' );
				if ( $meta != '' ) {
					echo $meta, "\n";
				}

			$wpldc_post_meta = get_post_meta( get_the_ID(), '_inpost_head_script' , TRUE );
				if ( $wpldc_post_meta != '' ) {
					echo $wpldc_post_meta['synth_header_script'], "\n";
				}
			
		}
				
		function wpldc_options_panel() { ?>
        
        
        
<div id="wpldc-wrap">
	<div class="wrap">
				<?php screen_icon(); ?>
					<h2>LeaDroid Chat</h2>
					<hr />
                    
                    
<table class="widefat" width="auto" border="0">
  <tr>
    <td valign="top"><form name="dofollow" action="options.php" method="post">
						
							<?php settings_fields( 'wp-lea-droid-chat' ); ?>
                        	
							<h3 class="wpldc-labels" for="wpldc_insert_header">Paste your LeaDroid Chat script here:</h3>
                            <textarea rows="5" cols="57" id="insert_header" name="wpldc_insert_header"><?php echo esc_html( get_option( 'wpldc_insert_header' ) ); ?></textarea><br />
                            <h3 class="wpldc-labels footerlabel" for="wpldc_insert_footer">
							  <input class="button button-primary" type="submit" name="Submit" value="Save settings" /> 
						</h3>

						</form></td>
    <td style="border:1px; border-color:#666"><div class="wpldc-sidebar" style="max-width: 270px;float: left;">
						<div class="wpldc-improve-site" style="padding: 1rem; background: rgba(0, 0, 0, .02);">
							<h2>Need a pro version?</h2>
							<p>By ordering a paid version of LeaDroid Chat, you also support further development.</p>
							<p><a href="https://www.leadroid.com/leadroidchat" class="button" target="_blank">LeaDroid Chat &raquo;</a></p>
						</div>

						<div class="wpldc-improve-site" style="padding: 1rem; background: rgba(0, 0, 0, .02);">
							<h2>Try Chrome Extension!</h2>
							<p>Monitor chat requests from LeaDroid Chat without opening a chat.</p>
							<p><a href="https://chrome.google.com/webstore/detail/leadroid-chat/dbdgddinjjglhepfgmidocichldfielo" class="button" target="_blank">Chrome Extension</a></p>
						</div>												
						
						<div class="wpldc-support" style="padding: 1rem; background: rgba(0, 0, 0, .02);">
							<h2>Need Support?</h2>
							<p>You can find detailed instructions from here:</p>
							<p><strong><a href="https://www.leadroid.com/chat.pdf" target="_blank">LeaDroid Chat Help</a></strong></p>
						</div>
						<div class="wpldc-donate" style="padding: 1rem; background: rgba(0, 0, 0, .02);">
						  
						  <a href="http://www.leadroid.com" title="Visit Us" target="new">www.leadroid.com</a>
							<p><a href="http://www.leadroid.com"><img src="images/leadroid.png" alt="Visit Us" longdesc="http://www.leadroid.com" /></a></p>
						</div>
	  </div></td>
  </tr>
</table>
                    
                    
                    
					<div class="wpldc-wrap" style="width: auto;float: left;margin-right: 2rem;"><hr />
					
						</div>
                        
					</div>
				</div>
				
							
				<?php
		}
	}

	
$WP_lea_droid_Chat = new leadroidchat();

}



