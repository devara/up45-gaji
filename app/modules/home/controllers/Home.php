<?php defined('BASEPATH') OR exit('');
/**
* 
*/
class Home extends CI_Controller
{
	function index()
	{
		$this->load->view('home');
	}
}