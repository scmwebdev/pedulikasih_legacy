<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class modules extends CI_Model {

    var $tbl_modules = 'cms_modules';
    var $tbl_auths = 'cms_auths';

    function __construct()
    {
        parent::__construct();
    }


    public function menuToolbars($parent=0, $modtype='TOP_MENU_BAR', $key_name='')
    {
        $res = array();
        $query = "SELECT 
                        a.id,
                        a.title,
                        a.desc,
                        a.iconcls,
                        a.folder,
                        a.controller,
                        a.method,
                        a.params,
                        a.url,
                        a.parent,
                        a.left_comp,
                        a.right_comp,
                        a.separator
                    FROM ".$this->tbl_modules." a INNER JOIN ".$this->tbl_auths." b  ON a.id=b.`mod` AND b.auth ='view'
                    WHERE a.parent=".$parent."
                        AND (b.grp = ". $this->session->userdata('grp')." OR b.uid = ". $this->session->userdata('id').")
                        AND a.modtype='".$modtype."'
                        AND a.status=1 ".(!empty($key_name) ? " AND a.key_name='".$key_name."' " : "" )."
                    GROUP BY a.id,
                        a.title,
                        a.desc,
                        a.iconcls,
                        a.folder,
                        a.controller,
                        a.method,
                        a.params,
                        a.url,
                        a.parent,
                        a.left_comp,
                        a.right_comp,
                        a.separator
                    ORDER BY a.sort ASC";

        foreach($this->db->query($query)->result_array() as $k=>$v)
        {
            $v['nodes'] = $this->menuToolbars($v['id']);
            $res[$k] = $v;
        }

        return $res;
    }

    public function leftMenuNodes($parent=0, $modtype='LEFT_TREE_PANEL', $key_name='')
    {
        $query = "SELECT
                        a.id,
                        a.title,
                        a.desc,
                        a.folder,
                        a.controller,
                        a.method,
                        a.params,
                        a.url,
                        a.left_comp,
                        a.right_comp,
                        a.menutype,
                        a.iconcls
                    FROM ".$this->tbl_modules." a INNER JOIN ".$this->tbl_auths." b ON a.id=b.`mod` AND b.auth ='view'
                    WHERE a.parent=".$parent."
                        AND (b.grp = ". $this->session->userdata('grp')." OR b.uid = ". $this->session->userdata('id').")
                        AND a.modtype='".$modtype."'
                        AND a.status=1 ".(!empty($key_name) ? " AND a.key_name='".$key_name."' " : "" )."
                    GROUP BY
                        a.id,
                        a.title,
                        a.desc,
                        a.folder,
                        a.controller,
                        a.method,
                        a.params,
                        a.url,
                        a.left_comp,
                        a.right_comp,
                        a.menutype,
                        a.iconcls
                    ORDER BY a.sort ASC";

        $res = $this->db->query($query)->result_array();
        return $res;
    }

    public function nodesAuth($parent=0)
    {
        $query = "SELECT id, title, `desc`, auth, menutype FROM ".$this->tbl_modules." WHERE ". ( $parent > 0 ? "parent=".$parent : "(parent=".$parent." OR parent=23)" ) ." AND status=1 ORDER BY sort";
        $result = $this->db->query($query);
        return $result->result_array() ;
    }

    public function modAuths($mods=0)
    {
        $row = array();
        $query = "SELECT auth FROM ".$this->tbl_auths." WHERE `mod`=".$mods." AND (grp = ". $this->session->userdata('grp')." OR uid = ". $this->session->userdata('id').")  GROUP BY auth";
        $result = $this->db->query($query);

        foreach($result->result_array() as $key=>$val)
        {
            $row[$val['auth']] = true;
        }
        return $row;
    }

    public function getIdFromKeyName($keyname='')
    {
        $query = "SELECT id FROM ".$this->tbl_modules." WHERE key_name='".trim($keyname)."'";
        $row = $this->db->query($query)->row_array();

        if (isset($row['id'])) {
            return $row['id'];
        } else {
            return 0;
        }
    }

    public function getKeyNameFromId($id=0)
    {
        $query = "SELECT key_name FROM ".$this->tbl_modules." WHERE id='".trim($id)."'";
        $row = $this->db->query($query)->row_array();

        if (isset($row['key_name'])) {
            return $row['key_name'];
        } else {
            return '';
        }
    }

    public function getFieldData($field=array("name", "key_name"), $condValue='', $condField='id')
    {
        $query = "SELECT ".implode(',', $field)." FROM ".$this->tbl_modules." WHERE ".trim($condField)."='".trim($condValue)."'";
        return $this->db->query($query)->row_array();
    }

}
