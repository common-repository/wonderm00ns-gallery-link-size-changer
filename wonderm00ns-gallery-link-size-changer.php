<?php
/**
 * @package Wonderm00n's Gallery Link Size Changer
 * @version 0.1.2
 */
/*
Plugin Name: Wonderm00n's Gallery Link Size Changer
Plugin URI: http://blog.wonderm00n.com/2012/11/23/wordpress-plugin-gallery-link-size-changer/
Description: This plugin allows to change the way the Wordpress gallery links. You can select to link to the thumbnail, medium or large size of the pictures instead of the full size. Based on the <a href="http://oikos.org.uk/2011/09/tech-notes-using-resized-images-in-wordpress-galleries-and-lightboxes/" target="_blank" onclick="window.open('http://oikos.org.uk/2011/09/tech-notes-using-resized-images-in-wordpress-galleries-and-lightboxes/'); return false;"/>oikos.org.uk solution</a>.
Author: Marco Almeida (Wonderm00n)
Version: 0.1.2
Author URI: http://wonderm00n.com
*/

/*
	Based on / Thanks to:
	http://oikos.org.uk/2011/09/tech-notes-using-resized-images-in-wordpress-galleries-and-lightboxes/
*/

	$wonderm00n_gallery_link_plugin_version='0.1.2';
	$wonderm00n_gallery_link_plugin_settings_prefix='wonderm00n_gallery_link_';
	$wonderm00n_gallery_link_plugin_settings=array(
		'settings_set',
		'default_size',
		'add_to_link'
	);
	function wonderm00n_gallery_link_default_values() {
		return array(
			'default_size' => 'medium'
		);
	}
	if (intval(get_option($wonderm00n_gallery_link_plugin_settings_prefix.'settings_set'))==1) {
		foreach($wonderm00n_gallery_link_plugin_settings as $key) {
			$wonderm00n_gallery_link_settings[$key]=get_option($wonderm00n_gallery_link_plugin_settings_prefix.$key);
		}
	} else {
		$wonderm00n_gallery_link_settings=wonderm00n_gallery_link_default_values();
	}

	function wonderm00n_gallery_link_get_attachment_link_filter( $content, $post_id, $size, $permalink ) {
		global $wonderm00n_gallery_link_settings;
    // Only do this if we're getting the file URL
    if (intval($permalink)==0) {
    		$link_size=$wonderm00n_gallery_link_settings['default_size']; //In the future we need not to use the dedafult value but a specific value per gallery
        // This returns an array of (url, width, height)
        $image = wp_get_attachment_image_src( $post_id, $link_size );
        //$new_content = preg_replace('/href=\'(.*?)\'/', 'href=\'' . $image[0] . '\'', $content );
        $new_content = preg_replace('/href=\'(.*?)\'/', 'href=\'' . $image[0] . '\''.trim(' '.$wonderm00n_gallery_link_settings['add_to_link']), $content );
        return $new_content;
    } else {
    		return $content;
    }
	}
	add_filter('wp_get_attachment_link', 'wonderm00n_gallery_link_get_attachment_link_filter', 10, 4);


	//Admin
	if ( is_admin() ) {
		
		add_action('admin_menu', 'wonderm00n_gallery_link_add_options');
		
		register_activation_hook(__FILE__, 'wonderm00n_gallery_link_activate');
		
		function wonderm00n_gallery_link_add_options() {
			if(function_exists('add_options_page')){
				add_options_page('Wonderm00n\'s Gallery Link Size Changer', 'Wonderm00n\'s Gallery Link Size Changer', 'manage_options', basename(__FILE__), 'wonderm00n_gallery_link_admin');
			}
		}
		
		function wonderm00n_gallery_link_activate() {
			// Let's not!
		}
		
		function wonderm00n_gallery_link_settings_link( $links, $file ) {
			if( $file == 'wonderm00ns-gallery-link-size-changer/wonderm00ns-gallery-link-size-changer.php' && function_exists( "admin_url" ) ) {
				$settings_link = '<a href="' . admin_url( 'options-general.php?page=wonderm00ns-gallery-link-size-changer.php' ) . '">' . __('Settings') . '</a>';
				array_push( $links, $settings_link ); // after other links
			}
			return $links;
		}
		add_filter('plugin_row_meta', 'wonderm00n_gallery_link_settings_link', 9, 2 );
		
		
		function wonderm00n_gallery_link_admin() {
			global $wonderm00n_gallery_link_plugin_settings, $wonderm00n_gallery_link_plugin_version, $wonderm00n_gallery_link_settings, $wonderm00n_gallery_link_plugin_settings_prefix;
			include_once 'includes/settings-page.php';
		}
	}
?>