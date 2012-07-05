<?php

class Extstrings_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function init(){
    	//Create table and structure if it doesn't already exist. This makes this class plug and play
    	if ($query = $this->db->query("
    		CREATE TABLE IF NOT EXISTS `strings` (
  				`id` int(11) NOT NULL AUTO_INCREMENT,
  				`key` text NOT NULL,
  				`string` text NOT NULL,
  				`value` text NOT NULL,
  				`status` tinyint(4) NOT NULL DEFAULT '1',
  			PRIMARY KEY (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;
    	")){
			return true;
		} 
    	
    	return false;
    }
    
    function getAll(){
    	//Get all the strings from the DB
    	$query = $this->db->query('
    		SELECT
    			*
    		FROM
    			strings
    		WHERE
    			status > 0
    		ORDER BY strings.key ASC
    	');
    	
    	//Initialize data return array
    	$data = array();
    	
    	//Loop through all results and add them to the data array
    	foreach($query->result_array() as $row){
    		array_push($data, $row);
    	}
    	
    	return $data;
    }
}
?>
