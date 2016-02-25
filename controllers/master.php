<?php
class Master extends CI_Controller {
	function index()
	{
		$this->load->view('master');
	}
	
	function news()
	{
		$this->load->view('master_news');
	}
	
	function programme()
	{
		$this->load->view('master_programme');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */