<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftar extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('thevoiceindonesia/pendaftar_model');
    }

    public function index(){
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
        if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

        $this->load->model('modules');
        $viewVars = array();
        $viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
        $this->load->view('thevoiceindonesia/pendaftar_views', $viewVars);
    }

    public function json(){
        if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "") {
            $page   = (isset($_GET['page'])) ? $_GET['page'] : 1;
            $start  = (isset($_GET['start'])) ? $_GET['start'] : 0;
            $limit  = (isset($_GET['limit'])) ? $_GET['limit'] : 50;
        } else {
            $page   = 1;
            $start  = 0;
            $limit  = 50;
        }

        $keyword = (isset($_GET['q'])) ? $_GET['q'] : "";
        echo $this->pendaftar_model->json($keyword,$start,$limit,$page);
    }

    public function jsonok(){
        if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "") {
                $page   = (isset($_GET['page'])) ? $_GET['page'] : 1;
                $start  = (isset($_GET['start'])) ? $_GET['start'] : 0;
                $limit  = (isset($_GET['limit'])) ? $_GET['limit'] : 50;
        } else {
                $page   = 1;
                $start  = 0;
                $limit  = 50;
        }

        $keyword = (isset($_GET['q'])) ? $_GET['q'] : "";
        echo $this->pendaftar_model->jsonok($keyword,$start,$limit,$page);
    }

    public function jsonitem(){
        $data_id = (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
        $data    = $this->pendaftar_model->getData($data_id);
        echo json_encode($data);
    }

    public function publishdata(){
        if ($this->input->post('postdata')) {
            $set = $this->input->post('set');
            $arrdata = explode("|", $this->input->post('postdata'));
            foreach($arrdata as $data_id) if ($data_id != "") $this->pendaftar_model->publishData($data_id,$set);
        }
    }
}
