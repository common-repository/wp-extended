<?php
if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300)
	die('PHP ActiveRecord requires PHP 5.3 or higher');

require_once XT_LIBS.'lib/Singleton.php';
require_once XT_LIBS.'lib/Config.php';
require_once XT_LIBS.'lib/Model.php';
require_once XT_LIBS.'lib/Utils.php';
require_once XT_LIBS.'lib/Exceptions.php';
require_once XT_LIBS.'lib/ConnectionManager.php';
require_once XT_LIBS.'lib/Connection.php';
require_once XT_LIBS.'lib/SQLBuilder.php';
require_once XT_LIBS.'lib/Table.php';
require_once XT_LIBS.'lib/Inflector.php';
require_once XT_LIBS.'lib/Validations.php';
require_once XT_LIBS.'lib/Serialization.php';
require_once XT_LIBS.'lib/Reflections.php';
require_once XT_LIBS.'lib/CallBack.php';

spl_autoload_register('activerecord_autoload');

function activerecord_autoload($class_name)
{
	$path = ActiveRecord\Config::instance()->get_model_directory();
	$root = realpath(isset($path) ? $path : '.');

	if (($namespaces = ActiveRecord\get_namespaces($class_name)))
	{
		$class_name = array_pop($namespaces);
		$directories = array();
		foreach ($namespaces as $directory)
			$directories[] = $directory;

		$root .= DIRECTORY_SEPARATOR .implode($directories, DIRECTORY_SEPARATOR);
	}

	$file = "$root/$class_name.php";

	if (file_exists($file))
		@include_once $file;
}
?>
