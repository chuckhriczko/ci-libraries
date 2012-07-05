<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * External Strings Class
 *
 * Provides strings located in the DB for things such as labels, messages, etc.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	External Strings
 * @author		Charles Hriczko
 * @description:
 * Strings are seperated by type.class.key
 * e.g. $this->extstrings->strings->site->name would look like this in SQL:
 * INSERT INTO `strings` (`id`, `key`, `string`, `value`, `status`) VALUES(1, 'site', 'name', 'I.D.', 1);
 * Or like this using the get() method:
 * $this->extstrings->get('site', 'name')
 */
class CI_Extstrings {		
	function CI_Extstrings()
	{
		$extstrings = $this;
		$site =& get_instance();
		$site->load->model('extstrings_model');
		
		//Initialize the DB table, creating it if it doesn't exist
		$site->extstrings_model->init();
		
		//Get all the strings from the DB
		$strings = $site->extstrings_model->getAll();
		
		//Create the string object
		$this->strings = new stdClass();
		$this->JSON = new stdClass();
		
		//Loop through the strings and make them into objects
		foreach($strings as $string){
			//Add the new string to the Strings object
			@$this->strings->$string['key']->$string['string'] = $string['value'];
		}
		
		//Convert strings into a JSON string
		$this->JSON = json_encode($this->strings);
	}
	
	//Returns a string. If string does not exist then an empty string is returned
	public function get($key, $string){
		if (isset($this->strings->$key->$string))
			return $this->strings->$key->$string;
		else
			return '';
	}
}


/* End of file Extstrings.php */
