<?php

class ftpserverm extends CI_Model
{
    function __construct()
    {
        parent::__construct();
	    $this->load->library('ftp');
    }
	
    function getfile($hostname,$username,$password)
    {
	$config['hostname'] = $hostname;
	$config['username'] = $username;
	$config['password'] = $password;
	$config['debug'] = TRUE;
	
	$this->ftp->connect($config);
	
	$list = $this->ftp->list_files('/public_html/');
	
	print_r($list);
	
	$this->ftp->close();        
	}
}
?>
