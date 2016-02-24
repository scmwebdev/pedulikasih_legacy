<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class photo_kategori extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('thevoiceindonesia/photo_kategori_model');
    }

    public function index(){
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
        if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

        $this->load->model('modules');
        $viewVars = array();
        $viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
        $this->load->view('thevoiceindonesia/photo_kategori_views', $viewVars);
    }

    public function jsonphoto_kategori(){
        echo $this->photo_kategori_model->jsonphoto_kategori();
    }

    public function jsonitemphoto_kategori(){
        $data_id    = (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
        $data = $this->photo_kategori_model->getDataPhoto_kategori($data_id);
        echo json_encode($data);
    }

    public function submitphoto_kategori(){
        if ($this->input->post('kategori')) {
                $this->photo_kategori_model->submitDataPhoto_kategori();
                echo "{success: true}";
        }
    }

    public function deletedataphoto_kategori(){

        if ($this->input->post('postdata')) {
                $arrdata = explode("|", $this->input->post('postdata'));
                foreach($arrdata as $data_id) if ($data_id != "") $this->photo_kategori_model->deleteDataPhoto_kategori($data_id);
        }
    }

    public function publishdataphoto_kategori(){
        if ($this->input->post('postdata')) {
                $set = $this->input->post('set');
                $arrdata = explode("|", $this->input->post('postdata'));
                foreach($arrdata as $data_id) if ($data_id != "") $this->photo_kategori_model->publishDataPhoto_kategori($data_id,$set);
        }
    }
}
