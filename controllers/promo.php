<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Promo extends CI_Controller {
		public function __construct()
		{
				parent::__construct();
				$this->load->model('promo_model');
				$this->load->model('article_model');
		}
	
		function index()
		{
				if ($this->uri->segment(2) == "") {
						$data['promoList'] = $this->promo_model->listPromo();
						$this->load->view('promo/promo_index', $data);
				} else {
						$uri    = str_replace('.html','',$this->uri->segment(2));
						$promo  = $this->promo_model->getPromo($uri);
						if (count($promo) > 0) {
								$data['promoData'] = $promo;
								$this->load->view('promo/promo_detail', $data);
						} else
								redirect();
				}
				
				/*switch ($this->uri->segment(2)) {
				    case "iron-chef-kids":
				        $this->load->view('promo/promo_iron-chef-kids');
				        break;
				    case "fokus-pagi":
				        $this->load->view('promo/promo_fokus-pagi');
				        break;
				    case "akademi-indosiar-2012":
				        $this->load->view('promo/promo_akademi-indosiar-2012');
				        break;
				    case "pesta-semarak-indosiar":
				        $this->load->view('promo/promo_pesta-semarak-indosiar');
				        break;
				    default:
				    		redirect();
				}*/
		}
}