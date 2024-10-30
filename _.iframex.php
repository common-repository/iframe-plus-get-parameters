<?php
/**
  Plugin Name:        Iframe plus GET Parameters
  Description:        Pass GET parameters to your iframe. Shortcode like [iframex src="https://example.com" /]
  Version:            1.0.2 
  Author:             Tron 
  Author URI:         https://tronusa.businessshop.net
  Author URI:         mailto:tronusa@businessshop.net?&subject=Iframex
  License:            GPL v2, written 2022
  License URI:        https://www.gnu.org/licenses/gpl-2.0.html
**/

require_once('row_meta.php'); 
require_once('wp_enqueue_scripts.php'); 

if (!function_exists('iframex')) {
function iframex ($attrs_r, $content = null) { 

	$attrs_r = shortcode_atts( // default values if none passed
		array(
			'src' => '', 
			'name' => '',
			'id' => '', 
			//'title' => "An iframe", mabye add back in next version. 
			'sandbox' => '',
			'width' => '500',
			'height' => 'auto',
				'frameborder' => '0', // 1 | 0 Deprecated in HTML5, but browsers still seem to support
				'scrolling' => 'no', // auto | yes | no
			'marginwidth' => '', // User should just use CSS for the rest of these
			'marginheight' => '',
			'longdesc' => '',
			'align' => '',
			'vspace' => ''
		), $attrs_r
	);
	
	foreach($attrs_r as $key => $value) {
		$attrs_r[$key] = sanitize_text_field($value); 
	}
	
	if (empty(trim($attrs_r['src']))) 
		return "Please specify the URL.";

	// Get and santized all the variables in the URL. 
	$getVariables = "";
	foreach ($_GET as $key => $value) {
		$key = sanitize_text_field($key); 
		$value = sanitize_text_field(trim($value)); 
		if ( // Don't want to send these values to the page.
			$key == "submit" ||
			$key == "Submit" ||
			$key == "SUBMIT"  
		) continue;
		// Don't send empty fields. Need x_amount for special reasons. Even if empty. 
		// Maybe change this in next release. 
		if (empty($value) && $key != "x_amount") 
			continue;  
		$getVariables .= "$key=$value&";
	}

	$my_url = plugin_dir_url(__FILE__); 
	rtrim($my_url, '/'); // Have to add a / below. 
	
	if (!empty($attrs_r['name']) && empty($attrs_r['id'])) 
		$attrs_r['id'] = trim($attrs_r['name']);
	$attrs_r['height'] = '100%'; // Useless, set in JQuery.
	$iframe_html = "
	<iframe 
		src='{$attrs_r['src']}?$getVariables' 
		name='myIframe' 
		id='myIframe' 
		width='{$attrs_r['width']}' 
		height='{$attrs_r['height']}' 
		frameborder='{$attrs_r['frameborder']}' 
		scrolling='{$attrs_r['scrolling']}' 
		style='height:100%;'
	 /></iframe>

	<script src='$my_url/assets/js/wpp.js'></script>
	"; 

	$iframe_html .=<<<HEREDOC
	<script>
		jQuery(document).ready(function(){
			jQuery("#myIframe").find("iframe").attr("height", "100%");
			if (0) alert('jquery loaded'); 
		});
	</script>

HEREDOC;

	return $iframe_html; 
	
}
add_shortcode('iframex', 'iframex'); 
}
