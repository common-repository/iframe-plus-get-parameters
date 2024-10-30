<?php 
/*
 # Written 2022-2023
 #	 by Jeffrey Quade 
**/
?>
<?php
/////
// Register JavaScript and CSS file(s). 
/////
if (!function_exists('wpp_tron_iframe_plus_admin_load_js')) { 
function wpp_tron_iframe_plus_admin_load_js() {
		
	wp_enqueue_script("jquery");
		
	$url = plugin_dir_url(__FILE__);
	wp_enqueue_script(
		'custom_js_20230425', // handle, unique
		$url . '/asets/js/wpp.js', 
		array('jquery'), // this script depends on.
		'1.0.0', //$ver, 
		false //, $in_footer? <-default is in head 
	); 
	//mail('webmaster@webtronusa.net', 'loaded', $url, "From: <webmaster@webtronusa.net>\r\n\r\n"); 
	//wp_register_style('my_css_20230425', plugins_url('style.css',	__FILE__), false, $my_css_ver );
	//wp_enqueue_style ('my_css_20230425');
	// wp_register_style( string $handle, string|false $src, string[] $deps = array(), string|bool|null $ver = false, string $media = 'all' ): bool
}
add_action('wp_enqueue_scripts', 'wpp_tron_iframe_plus_admin_load_js'); 
add_action('admin_enqueue_scripts', 'wpp_tron_iframe_plus_admin_load_js'); // <== ??? 

}
