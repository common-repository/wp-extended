<?php 


function xt_geshi($atts,$content=null){
	extract(shortcode_atts(
	array(
	'lang' => 'php',
	'line' => '0',
	),$atts
	));
	//$patterns[1] = '/brown/';
	$patterns[0] = '/<code>/';
	$patterns[1] = '/</code>/';
	$replacements[0] = '';
	$replacements[1] = '';
	//echo preg_replace($patterns, $replacements, $string)
	$code = preg_replace($patterns, $replacements, $content);
	return "<pre lang='".$lang."' line='".$line."'>". $code ."</pre>";
}