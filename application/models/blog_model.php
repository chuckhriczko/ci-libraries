<?php

class Blog_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function init(){
    	//Create table and structure if it doesn't already exist. This makes this class plug and play
		//Start by creating the blog posts table
    	if ($query = $this->db->query("
    		CREATE TABLE IF NOT EXISTS `blog_posts` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`author_id` int(11) NOT NULL DEFAULT '0',
				`post_title` text NOT NULL,
				`post_body` text NOT NULL,
				`post_excerpt` text NOT NULL,
				`post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				`post_rev_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
				`post_ip` text NOT NULL,
				`post_status` int(11) NOT NULL DEFAULT '1',
				PRIMARY KEY (`id`)
			  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    	")){
			//Blog authors table
			if ($query = $this->db->query("
				CREATE TABLE IF NOT EXISTS `blog_authors` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`first_name` text NOT NULL,
					`last_name` text NOT NULL,
					`email` text NOT NULL,
					`username` text NOT NULL,
					`password` text NOT NULL,
					`date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					`status` int(11) NOT NULL DEFAULT '1',
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
			")){
				//Blog comments table
				if ($query = $this->db->query("
					CREATE TABLE IF NOT EXISTS `blog_comments` (
					`id` int(11) NOT NULL AUTO_INCREMENT,
					`author_id` int(11) NOT NULL DEFAULT '0',
					`post_id` int(11) NOT NULL DEFAULT '0',
					`comment_title` text NOT NULL,
					`comment_body` text NOT NULL,
					`comment_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					`comment_date_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
					`comment_ip` text NOT NULL,
					`comment_status` int(11) NOT NULL DEFAULT '1',
					PRIMARY KEY (`id`)
				  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
				")){
					if ($query = $this->db->query("
						CREATE TABLE IF NOT EXISTS `blog_categories` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`category_title` text NOT NULL,
						`category_description` text NOT NULL,
						`category_status` int(11) NOT NULL DEFAULT '1',
						PRIMARY KEY (`id`)
					  ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
					")){
						return true;
					} else {
						error_log('There was an error creating the blog categories table');
					}
					return true;
				} else {
					error_log('There was an error creating the blog comments table');	
				}
			} else {
				error_log('There was an error creating the blog authors table');
			}
		} else {
			error_log('There was an error creating the blog posts table');
		}
    	
    	return false;
    }
}
?>