<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Blog Class
 *
 * Adds functions and capabilities for a blog feature
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Blog
 * @author		Charles Hriczko
 * @description:
 */
class CI_Blog {		
	function CI_Blog()
	{
		$blog = $this;
		$site =& get_instance();
		$site->load->model('blog_model');
		
		//Initialize the DB table, creating it if it doesn't exist
		$site->blog_model->init();
	}
}
/* End of file Blog.php */
