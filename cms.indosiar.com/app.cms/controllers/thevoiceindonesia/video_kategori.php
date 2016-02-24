<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class video_kategori extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('thevoiceindonesia/video_kategori_model');
    }

    public function index(){
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) redirect($this->config->item('base_url'), true);
        if ($_SERVER['HTTP_X_REQUESTED_WITH']!=='XMLHttpRequest') redirect($this->config->item('base_url'), true);

        $this->load->model('modules');
        $viewVars = array();
        $viewVars['modAuths'] = $this->modules->modAuths($this->session->idmodule);
        $this->load->view('thevoiceindonesia/video_kategori_views', $viewVars);
    }

    public function jsonvideo_kategori(){
        echo $this->video_kategori_model->jsonvideo_kategori();
    }

    public function jsonitemvideo_kategori(){
        $data_id    = (isset($_GET['data_id'])) ? $_GET['data_id'] : "";
        $data = $this->video_kategori_model->getDataVideo_kategori($data_id);
        echo json_encode($data);
    }

    public function submitvideo_kategori(){
        if ($this->input->post('kategori')) {
                $this->video_kategori_model->submitDataVideo_kategori();
                echo "{success: true}";
        }
    }

    public function deletedatavideo_kategori(){

        if ($this->input->post('postdata')) {
                $arrdata = explode("|", $this->input->post('postdata'));
                foreach($arrdata as $data_id) if ($data_id != "") $this->video_kategori_model->deleteDataVideo_kategori($data_id);
        }
    }

    public function publishdatavideo_kategori(){
        if ($this->input->post('postdata')) {
                $set = $this->input->post('set');
                $arrdata = explode("|", $this->input->post('postdata'));
                foreach($arrdata as $data_id) if ($data_id != "") $this->video_kategori_model->publishDataVideo_kategori($data_id,$set);
        }
    }
}
