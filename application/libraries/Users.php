<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * Users Class
 *
 * Provides functions to manager users in a database table
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Users
 * @author		Charles Hriczko
 * @description:
 */
class CI_Users {		
	function CI_Users()
	{
		$extstrings = $this;
		$site =& get_instance();
		$site->load->model('users_model');
		
		//Initialize the DB table, creating it if it doesn't exist
		$site->users_model->init();
		$site->users_model->addUser('Admin', 'User', 'admin@user.com', 'admin', 'admin');
	}
	
	//Adds a user to the system
	public function addUser($first_name, $last_name, $email, $username, $password){
		return $this->users_model->addUser($first_name, $last_name, $email, $username, $password);
	}
	
	//Updates a user in the system
	public function updateUser($user_data = array('first_name' => '', 'last_name' => '', 'email' => '', 'username' => '', 'password' => '')){
		return $this->users_model->updateUser($user_data);
	}
	
	//Removes a user from the system
	public function removeUser($user_id){
		return $this->users_model->removeUser($user_id);
	}
}


/* End of file Users.php */
