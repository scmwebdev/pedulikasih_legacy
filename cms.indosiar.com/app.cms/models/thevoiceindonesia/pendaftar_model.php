<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftar_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->DBT = $this->load->database('db_thevoiceindonesia_tools_write', TRUE);
        $this->DBW = $this->load->database('db_thevoiceindonesia_www_write', TRUE);
    }

    function json($keyword,$start,$limit,$page) {
        if ($keyword == "") {
            $total = $this->DBT->count_all_results('thevoiceindonesia');
        } else {
            $total = $this->DBT->like('nama_depan',$keyword)->count_all_results('thevoiceindonesia');
        }

        if ($total == 0) {
            $json = '{"success":true, "results":0, "rows": []}';
        } else {
            $json = '{"success":true,"results":'.$total.',"rows":';

            if ($keyword == "") {
                $sql = "select * from thevoiceindonesia where status=0 or status=1 order by id desc limit $start,$limit";
            } else {
                $sql = "select * from thevoiceindonesia where (status=0 or status=1) and nama_depan like '%$keyword%' order by id desc limit $start,$limit";
            }

            $data = $this->DBT->query($sql)->result_array();

            $json .= json_encode($data);
            $json .= '}';
        }
        return $json;
    }

    function jsonok($keyword,$start,$limit,$page) {
        if ($keyword == "") {
            $total = $this->DBW->count_all_results('thevoiceindonesia');
        } else {
            $total = $this->DBW->like('nama_depan',$keyword)->count_all_results('thevoiceindonesia');
        }

        if ($total == 0) {
            $json = '{"success":true, "results":0, "rows": []}';
        } else {
            $json = '{"success":true,"results":'.$total.',"rows":';

            if ($keyword == "") {
                $sql = "select * from thevoiceindonesia where status=2 order by id desc limit $start,$limit";
            } else {
                $sql = "select * from thevoiceindonesia where status=2 and nama_depan like '%$keyword%' order by id desc limit $start,$limit";
            }

            $data = $this->DBW->query($sql)->result_array();

            $json .= json_encode($data);
            $json .= '}';
        }

        return $json;
    }

    function publishData($data_id,$set) {
        if($set==0){
            $sql = "Update thevoiceindonesia set status=0 where id=$data_id";
            $data = $this->DBT->query($sql);
        }else{
            $sql = "select * from thevoiceindonesia where id=$data_id";
            $data = $this->DBT->query($sql)->row_array();

            if(!empty($data)){
                $data['status']=2;
                $this->DBW->insert('thevoiceindonesia', $data);

                $this->DBT->where('id', $data['id']);
                $this->DBT->delete('thevoiceindonesia');
            }
        }
    }

    function getData($data_id) {
            if (is_numeric($data_id)) {
                        $sql = "select * from thevoiceindonesia where id=$data_id";
                        $data = $this->DBT->query($sql)->row_array();
                        if (count($data) > 0) {
                            $data['video']  = STATIC_URL.'video/thevoiceindonesia/'.$data['video'];
                            $data['alamat'] = nl2br($data['alamat']);
                            $data['musical_link'] = nl2br($data['musical_link']);
                        }
                        return $data;
            }
    }
}
