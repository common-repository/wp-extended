<?php

/**
 * XML Library: Outputs XML from Associative Array
 *
 */
class xt_xml
{
	
	public function __construct(){
		
	}


	/**
	 * xt_xml_data::xml_from_array()
	 * 
	  @access	public
	 * @param	object	The query result object
	 * @param	array	Any preferences
	 * @return	string
	 */
	function xml_array($array= array(), $params = array())
	{
		$post = $array;
	
		// Set our default values
		foreach (array('root' => 'root', 'element' => 'element', 'newline' => "\n", 'tab' => "\t") as $key => $val)
		{
			
			if ( ! isset($params[$key]))
			{
				$params[$key] = $val;
			}
		}
		
		// Create variables for convenience
		extract($params);

		// Generate the result
		$xml = "<{$root}>".$newline;
		
		
	
		foreach ($array  as $row)
		{			
			
			$xml .= $tab."<{$element}>".$newline;
			
			//$xml .= $tab."<server_url>".url::base()."</server_url>".$newline;
			//include videoo url
			
			/**
			 * foreach($post as $p){
			 * 			//echo $p->ID;
			 * 			$xml .= $tab."<server_url>".$p->ID."</server_url>".$newline;
			 * 			}
			 */			
			
			foreach ($row as $key => $val)
			{
				$xml .= $tab.$tab."<{$key}>".self::xml_convert($val)."</{$key}>".$newline;
			}
			$xml .= $tab."</{$element}>".$newline;
		}
		$xml .= "</$root>".$newline;
		
		return $xml;
	}
	

function xml_convert($str)
{
	$temp = '__TEMP_AMPERSANDS__';

	// Replace entities to temporary markers so that 
	// ampersands won't get messed up
	$str = preg_replace("/&#(\d+);/", "$temp\\1;", $str);
	$str = preg_replace("/&(\w+);/",  "$temp\\1;", $str);
	
	$str = str_replace(array("&","<",">","\"", "'", "-"),
					   array("&amp;", "&lt;", "&gt;", "&quot;", "&#39;", "&#45;"),
					   $str);

	// Decode the temp markers back to entities		
	$str = preg_replace("/$temp(\d+);/","&#\\1;",$str);
	$str = preg_replace("/$temp(\w+);/","&\\1;", $str);
		
	return $str;
}



}
?>