<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pendaftar_model extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function json($keyword,$start,$limit,$page) {
        if ($keyword == "") {
            $total = $this->db->where('status','0')->count_all_results('aksi_registrasi');
        } else {
            $total = $this->db->where('status','0')->like('nama_lengkap',$keyword)->count_all_results('aksi_registrasi');
        }

        if ($total == 0) {
            $json = '{"success":true, "results":0, "rows": []}';
        } else {
            $json = '{"success":true,"results":'.$total.',"rows":';

            if ($keyword == "") {
                $sql = "select * from aksi_registrasi where status=0 order by id desc limit $start,$limit";
            } else {
                $sql = "select * from aksi_registrasi where status=0 and nama_lengkap like '%$keyword%' order by id desc limit $start,$limit";
            }

            $data = $this->db->query($sql)->result_array();

            $json .= json_encode($data);
            $json .= '}';
        }
        return $json;
    }

    function jsonok($keyword,$start,$limit,$page) {
        if ($keyword == "") {
            $total = $this->db->where('status','1')->count_all_results('aksi_registrasi');
        } else {
            $total = $this->db->where('status','1')->like('nama_lengkap',$keyword)->count_all_results('aksi_registrasi');
        }

        if ($total == 0) {
            $json = '{"success":true, "results":0, "rows": []}';
        } else {
            $json = '{"success":true,"results":'.$total.',"rows":';

            if ($keyword == "") {
                $sql = "select * from aksi_registrasi where status=1 order by id desc limit $start,$limit";
            } else {
                $sql = "select * from aksi_registrasi where status=1 and nama_lengkap like '%$keyword%' order by id desc limit $start,$limit";
            }

            $data = $this->db->query($sql)->result_array();

            $json .= json_encode($data);
            $json .= '}';
        }
        return $json;
    }

    function jsonko($keyword,$start,$limit,$page) {
        if ($keyword == "") {
            $total = $this->db->where('status','2')->count_all_results('aksi_registrasi');
        } else {
            $total = $this->db->where('status','2')->like('nama_lengkap',$keyword)->count_all_results('aksi_registrasi');
        }

        if ($total == 0) {
            $json = '{"success":true, "results":0, "rows": []}';
        } else {
            $json = '{"success":true,"results":'.$total.',"rows":';

            if ($keyword == "") {
                $sql = "select * from aksi_registrasi where status=2 order by id desc limit $start,$limit";
            } else {
                $sql = "select * from aksi_registrasi where status=2 and nama_lengkap like '%$keyword%' order by id desc limit $start,$limit";
            }

            $data = $this->db->query($sql)->result_array();

            $json .= json_encode($data);
            $json .= '}';
        }
        
        return $json;
    }
    
    function jsoncontent($keyword,$start,$limit,$page) {
        if ($keyword == "") {
            $total = $this->db->where('status','3')->count_all_results('aksi_registrasi');
        } else {
            $total = $this->db->where('status','3')->like('nama_lengkap',$keyword)->count_all_results('aksi_registrasi');
        }

        if ($total == 0) {
            $json = '{"success":true, "results":0, "rows": []}';
        } else {
            $json = '{"success":true,"results":'.$total.',"rows":';

            if ($keyword == "") {
                $sql = "select * from aksi_registrasi where status=3 order by id desc limit $start,$limit";
            } else {
                $sql = "select * from aksi_registrasi where status=3 and nama_lengkap like '%$keyword%' order by id desc limit $start,$limit";
            }

            $data = $this->db->query($sql)->result_array();

            $json .= json_encode($data);
            $json .= '}';
        }
        
        return $json;
    }
    
    function submitData($data_id) {
        $this->db->where('id', $data_id);
        $this->db->update('aksi_registrasi', array('catatan' => $this->input->post('catatan')));
    }
    
    function publishData($data_id,$set) {
        $sql = "update aksi_registrasi set status=$set where id=$data_id";
        $this->db->query($sql);
    }

    function getData($data_id) {
        if (is_numeric($data_id)) {
            $sql = "select * from aksi_registrasi where id=$data_id";
            $data = $this->db->query($sql)->row_array();
            /*if (count($data) > 0) {
                $data['video']          = STATIC_URL.'aksi/registrasi/'.$data['video'];
                $data['foto_full']      = STATIC_URL.'aksi/registrasi/'.$data['foto_full'];
                $data['foto_closeup']   = STATIC_URL.'aksi/registrasi/'.$data['foto_closeup'];
            }*/
            return $data;
        }
    }
}