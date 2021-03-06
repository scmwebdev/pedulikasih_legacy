<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Video_kategori_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->DBW = $this->load->database('db_thevoiceindonesia_www_write', TRUE);
    }

    function submitDataVideo_kategori() {

        $kategori = trim($this->input->post('kategori'));
        $kategori_url = url_title($kategori, '-', TRUE);
        $sort = trim($this->input->post('sort'));

        $data = array(
                    'kategori'        =>    ucfirst($kategori),
                    'kategori_url'    =>    $kategori_url,
                    'sort'            =>    $sort,
                    'publish'         =>    $this->input->post('publish')
                );

        $data_id = $this->input->post('id');

        if ($data_id == "") {
            $this->DBW->insert('thevoiceindonesia_www.video_kategori', $data);
        } else {
            $this->DBW->where('id', $data_id);
            $this->DBW->update('thevoiceindonesia_www.video_kategori', $data);
        }
    }

    function deleteDataVideo_kategori($data_id) {
        $total = $this->DBW->where('id',$data_id)->count_all_results('thevoiceindonesia_www.video_kategori');
        if ($total > 0) {
                $sql = "delete from thevoiceindonesia_www.video_kategori where id=$data_id";
                $this->DBW->query($sql);
        }
    }


    function publishDataVideo_kategori($data_id,$set) {
            $sql = "update thevoiceindonesia_www.video_kategori set publish=$set where id=$data_id";
            $this->DBW->query($sql);
    }

    function getDataVideo_kategori($data_id) {
        $sql = "select * from thevoiceindonesia_www.video_kategori where id=$data_id";
        $query = $this->DBW->query($sql);
        $data = $query->row_array();
        $query->free_result();

        return $data;
    }

    function jsonvideo_kategori() {
        $total = $this->DBW->count_all_results('thevoiceindonesia_www.video_kategori');

        if ($total == 0) {
                $json = '{"success":true,"results":0,"rows":[]}';
        } else {
                $json = '{"success":true,"results":'.$total.',"rows":';

                $sql = "select id, kategori, kategori_url, sort, publish from thevoiceindonesia_www.video_kategori order by id";

            $data = array();
            $query = $this->DBW->query($sql);
            $data = $query->result_array();
            $query->free_result();

            $json .= json_encode($data);
            $json .= '}';
        }

        return $json;
    }
}
