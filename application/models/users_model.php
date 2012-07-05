<?php

class Users_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function init(){
    	//Create table and structure if it doesn't already exist. This makes this class plug and play
    	if ($query = $this->db->query("
    		CREATE TABLE IF NOT EXISTS `users` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`first_name` text NOT NULL,
			`last_name` text NOT NULL,
			`email` text NOT NULL,
			`username` text NOT NULL,
			`password` text NOT NULL,
			`date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`date_last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
			`ip_last_login` text NOT NULL,
			`image_id` int(11) NOT NULL DEFAULT '1',
			`status` int(11) NOT NULL DEFAULT '1',
			CONSTRAINT UNIQUE (username(30), email(30)),
			PRIMARY KEY (`id`)
		  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    	")){
			return true;
		} else {
			error_log('There was an error creating the users table');
		}
    	
    	return false;
    }
	
	function addUser($first_name, $last_name, $email, $username, $password){
		if ($query = $this->db->query("
			INSERT IGNORE INTO
				users
			(first_name, last_name, email, username, password, ip_last_login)
			VALUES(".$this->db->escape($first_name).", ".$this->db->escape($last_name).",
				".$this->db->escape($email).", ".$this->db->escape($username).",
				".$this->db->escape(encode($password)).", ".$this->db->escape($this->session->userdata('ip_address')).")
		")){
			return true;
		} else {
			error_log('There was an error adding user '.$first_name.' '.$last_name);
		}
		
		return false;
	}
	
	function updateUser($user_data = array('first_name' => '', 'last_name' => '', 'email' => '', 'username' => '', 'password' => '')){
		$set_clause = '';
		
		foreach($user_data as $key=>$data){
			if ($data==$user_data[count($user_data)-1]) $seperator = ''; else $seperator = ', ';
			if ($key=='password') $data = encode($data);
			$set_clause .= 'SET '.$key.' = '.$this->db->escape($data).$seperator;
		}
		
		if ($query = $this->db->query("
			UPDATE
				users
			
			".$set_clause."
			WHERE
				id = ".$this->db->escape($user_data['id'])
		)){
			return true;
		} else {
			error_log('There was an error updating user '.$user_data['id']);
		}
		
		return false;
	}
	
	function removeUser($user_id){
		if ($query = $this->db->query("
			DELETE FROM
				users
			WHERE
				id = ".$this->db->escape($user_id)
		))
			return true;
		else
			error_log('There was an error removing user ID '.$user_id);
			
		return false;
	}
}
?>
