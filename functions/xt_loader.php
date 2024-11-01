<?php 
/**
 * Create the xtended autoloader(s)
 */

function xt_loaders()
{
    if (function_exists('__autoload'))
    {
        spl_autoload_register('__autoload');
    }

    spl_autoload_register('xt_Flourish');

    spl_autoload_register('xt_Zend');
    
    spl_autoload_register('xt_Libs');

}


function xt_load_functions($file='xt_functions'){
	
	require_once(XT_FUNCTIONS.'/'.$file.'.php');	
	
}



/**
 * Load flourish Libaries
 */
function xt_Flourish($class_name)
{
    if (file_exists(FLOURISH_DIR . $class_name . '.php'))
    {
        require_once (FLOURISH_DIR . 'flourish/' . $class_name . '.php');
    }
}

/**
 * Load Zend Libaries
 */
function xt_Zend($class_name)
{
	
	$pt= '/\_/';
	$class = preg_replace($pt,"/",$class_name);
	
    if (file_exists(ZEND_DIR . '/Zend/'.$class_name . '.php'))
    {
        require_once (ZEND_DIR . '/Zend/'.$class_name . '.php');
    }    
    
    if(file_exists(ZEND_DIR .'/'. $class . '.php')){
    	
    	set_include_path(get_include_path() . PATH_SEPARATOR . ZEND_DIR);
    	
    	require_once ($class . '.php');
    	
    }

}

/**
 * Load Other/Custom Libaries
 */
function xt_Libs($class_name)
{	
    if (file_exists(XT_LIBS . $class_name . '.php'))
    {
        require_once (XT_LIBS . $class_name . '.php');
    }
}


/**
 * Load at init
 */
add_action('init', 'xt_loaders');