<?php 
/*
 # Written 2021-2022
 # by Jeffrey Quade 
**/
?>
<?php

if (!function_exists('wpp_tron_iframe_plugin_row_meta')) { 
function wpp_tron_iframe_plugin_row_meta($links_array, $plugin_file_name, $plugin_data, $status) { 

	// Auto detect plugin folder for this file. 
	$this_file = dirname(__FILE__);
	$this_file = str_replace('\\', '/', $this_file); // For Windows Servers, do not forget IIS. 
	$dir_r = array(); 
	$dir_r = explode("/", $this_file);
	$this_path = end($dir_r); 
	
	// Get the directory name of the argument. 
	$plugin_dir_name = str_replace('\\', '/', $plugin_file_name); 
	$dir_r = array(); 
	$dir_r = explode("/", $plugin_file_name);
	$plugin_file_path = $dir_r[0]; 
	
	if ($plugin_file_path == $this_path) {
		return array_merge(
			$links_array, 
			array(
			// PayPal Donate Button https://www.paypal.com/buttons/
			'<a href="https://www.paypal.com/cgi-bin/webscr?' . 
			'cmd=_s-xclick&hosted_button_id=AEX4MXWZPR6K2" target="_blank">Donate</a>' 
			)
		);
	}
	return $links_array;
}
// int $priority = 10, int $accepted_args = 4
add_filter('plugin_row_meta', 'wpp_tron_iframe_plugin_row_meta', 10, 4); 
}
