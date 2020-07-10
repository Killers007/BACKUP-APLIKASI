<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

class MY_Loader extends MX_Loader {
	/**
	 * CI Object to Array translator
	 *
	 * Takes an object as input and converts the class variables to
	 * an associative array with key/value pairs.
	 *
	 * @param	object	$object	Object data to translate
	 * @return	array
	 */
	protected function _ci_object_to_array($object)
	{
		return is_object($object) ? get_object_vars($object) : $object;
	}
}