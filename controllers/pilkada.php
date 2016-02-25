<?php
class Pilkada extends CI_Controller {	
		public function __construct()
		{
				parent::__construct();
				$this->load->model('pilkada_model');
		}
		
		function index(){
				$data['hasil'] = $this->pilkada_model->getData();
				$this->load->view('pilkada/pilkada', $data);
		}
}