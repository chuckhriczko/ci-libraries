<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Common Functions Class
 *
 * Does all the common page load type functions
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Common Functions
 * @author		Charles Hriczko
 */
class CI_Common {	
	
	function CI_Common()
	{
		$site =& get_instance();
		$site->load->model('common_model');
		
		$site->common_model->init();
	}
	
}


/* End of file Common.php */
