<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Backup_con extends CI_Controller
{

	function __construct()
	{

		parent::__construct();


	}

	function index()
	{

       $this->build_backups();
       redirect('/');

	}

	function build_backups()
	{
        $date = date("Y-m-d");	
        $this->database_backup($date);
        $this->project_backup($date);
        $this->send_backup($date);
	}

	function database_backup($date)
	{
		$this->load->helper('file');
		$this->load->dbutil();
		@$backup = $this->dbutil->backup();
		write_file('bin/database_'.$date.'.zip',$backup);
	}

	function project_backup($date)
	{


		
	}

	function send_backup($date)
	{
		$this->load->helper('email');
		$this->load->library('email');
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['newline'] = "\r\n";
		$config['crlf'] = "\r\n";
		$this->email->initialize($config);
		$this->email->from('aryalkrishna642@gmail.com','Krishna');
		$this->email->to('aryalkrishna642@gmail.com');
		$this->email->attach('bin/database_'.$date.'.zip');
		$this->email->subject('Backup database'.$date);
		$this->email->message('Backup database'.$date);
		if($this->email->send()) {

			unlink("../matutu1.hypms.com/bin/".'database_'.$date.'.zip');
		} else {

			show_error($this->email->print_debugger());
		}
 
	}
}