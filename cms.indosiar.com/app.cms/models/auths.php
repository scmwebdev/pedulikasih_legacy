<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class auths extends CI_Model {
	
	var $tbl_group = 'cms_groups';
	var $tbl_auths = 'cms_auths';
	var $tbl_users = 'cms_users';
  var $ttlRows = 0;
    
	public function __construct()
    {
        parent::__construct();
    }
	
	public function lastId()
	{
		return $this->db->insert_id();
	}
	
	public function addGroup()
	{
		return $this->db->query("INSERT INTO ".$this->tbl_group." (name, description) VALUES('".trim($_POST['name'])."', '".trim($_POST['description'])."')");
	}
	
	public function addUser()
	{
		return $this->db->query("INSERT INTO ".$this->tbl_users." (uid, pass, name, grp, status, email) VALUES('".strtolower(trim($_POST['uid']))."', '".trim($_POST['pass'])."', '".trim($_POST['name'])."', ".(!empty($_POST['grp']) ? trim($_POST['grp']) : 0).", ".trim($_POST['status']).", '".trim($_POST['email'])."')");
	}
	
	public function editGroup()
	{
		return $this->db->query("UPDATE ".$this->tbl_group." SET name='".trim($_POST['name'])."', description='".trim($_POST['description'])."' WHERE id=".trim($_POST['id']));
	}
	
	public function editUser()
	{
		return $this->db->query("UPDATE ".$this->tbl_users." SET uid='".strtolower(trim($_POST['uid']))."'". ( !empty($_POST['pass']) ? ", pass='".trim($_POST['pass'])."'" : "" ) .", name='".trim($_POST['name'])."', grp=".(!empty($_POST['grp']) ? trim($_POST['grp']) : 0).", status=".trim($_POST['status']).", email='".trim($_POST['email'])."' WHERE id=".trim($_POST['id']));
	}
	
	public function editProfile()
	{
		return $this->db->query("UPDATE ".$this->tbl_users." SET name='".trim($_POST['name'])."'". ( !empty($_POST['pass']) ? ", pass='".trim($_POST['pass'])."'" : "" ) .", email='".trim($_POST['email'])."' WHERE id=".trim($_POST['id']));
	}
	
	public function deleteGroup($id='') 
	{
		$this->db->query("DELETE FROM ".$this->tbl_group." WHERE id IN (".$id.")");
		$this->deleteAuth($id, false);
	}
	
	public function deleteUser($id='') 
	{
		$this->db->query("DELETE FROM ".$this->tbl_users." WHERE id IN (".$id.")");
		$this->deleteAuth($id, true);
	}
	
	public function deleteAuth($id='', $isuser=true) 
	{
		$this->db->query("DELETE FROM ".$this->tbl_auths." WHERE ".($isuser==true ? 'uid' : 'grp')." IN (".$id.")");
	}
	
	public function marktodelAuth()
	{
		$exp1 = explode('|', $_POST['mod']);
		foreach($exp1 as $key=>$val)
		{
			$exp2 = explode('-', $val);
			if (@count($exp2)==2)
			{
				$this->db->query("UPDATE ".$this->tbl_auths." SET del='".trim($_POST['del'])."' WHERE `mod`=".$exp2[0]." AND auth='".trim($exp2[1])."' AND ".( isset($_POST['usr']) ? "uid=".$_POST['usr'] : "grp=".$_POST['grp'] ));
			}
		}
	}
	
	public function deleteMarkAuth($del='') 
	{
		$this->db->query("DELETE FROM ".$this->tbl_auths." WHERE del='".$del."'");
	}
	
	public function addAuth($id=0, $isuser=true)
	{
		$arrEpl = explode('|', trim($_POST['auths']));
		for($fx=0; $fx<@count($arrEpl); $fx++)
		{
			$arrAuth = explode('-', trim($arrEpl[$fx]));
			$this->db->query("INSERT INTO ".$this->tbl_auths." (".($isuser==true ? 'uid' : 'grp').", `mod`, auth) VALUES(".$id.", ".$arrAuth[0].", '".$arrAuth[1]."')");
		}

	}
	
	public function dataGroups($start=0, $limit=0, $sort=object, $filter=array())
	{
		$qsort = '';
		$qfilter = '';
		
		if(!empty($sort)) $qsort = "ORDER BY ".trim($sort[0]->property)." ".trim($sort[0]->direction); 
		if(!empty($filter))
		{
			foreach($filter as $k=>$v)
			{
				$qfilter .= " AND ".trim($v->field)." LIKE '%".trim($v->value)."%'";
			}			
		}
		
		$query = "SELECT COUNT(*) as total FROM ".$this->tbl_group." WHERE 1 ".$qfilter;
		$res = $this->db->query($query);
		$row = $res->row_array();
		$this->ttlRows = $row['total'];
		
		$query = "SELECT id, name, description FROM ".$this->tbl_group." WHERE 1 ".$qfilter." ".$qsort." LIMIT ".$start.",".$limit;
		$res1 = $this->db->query($query);
		return $res1->result_array();
	}
	
	public function dataUsers($start=0, $limit=0, $sort=object, $filter=array())
	{
		$qsort = '';
		$qfilter = '';
		
		if(isset($_REQUEST['grp'])) {
			if($_REQUEST['grp']>=0) $qfilter .= " AND a.grp=".trim($_REQUEST['grp']);
		}
		
		if(!empty($sort)) $qsort = "ORDER BY ".trim($sort[0]->property)." ".trim($sort[0]->direction); 
		if(!empty($filter))
		{
			foreach($filter as $k=>$v)
			{
				$qfilter .= " AND ".(trim($v->field)!=='grp' ? "a.".trim($v->field) : "b.name")." LIKE '%".trim($v->value)."%'";
			}			
		}
		
		$query = "SELECT COUNT(*) as total FROM ".$this->tbl_users." a LEFT JOIN ".$this->tbl_group." b ON a.grp=b.id WHERE 1 ".$qfilter;
		$res = $this->db->query($query);
		$row = $res->row_array();
		$this->ttlRows = $row['total'];
		
		$query = "SELECT a.id, a.uid, a.name, b.name as grp, a.status, a.email FROM ".$this->tbl_users." a LEFT JOIN ".$this->tbl_group." b ON a.grp=b.id WHERE 1 ".$qfilter." ".$qsort." LIMIT ".$start.",".$limit;
				
		$res1 = $this->db->query($query);
		return $res1->result_array();
	}
	
	public function getEditGroup($id=0) {
		$query = "SELECT id, name, description FROM ".$this->tbl_group." WHERE id=".$id;
		return $this->db->query($query)->row_array();
	}
	
	public function getEditUser($id=0) {
		$query = "SELECT a.id, a.uid, a.name, a.grp, b.name as grpname, a.status, a.email FROM ".$this->tbl_users." a LEFT JOIN ".$this->tbl_group." b ON a.grp=b.id WHERE a.id=".$id;
		return $this->db->query($query)->row_array();
	}
	
	public function getEditAuth($id=0, $listmod='', $isusers=true)
	{
		$row = array();
		$res = $this->db->query("SELECT `mod`, auth FROM ".$this->tbl_auths." WHERE ".($isusers==true ? 'uid' : 'grp')."=".$id." AND `mod` IN (".$listmod.")");
		foreach($res->result_array() as $k=>$v)
		{
			$row[(string) $v['mod']][$v['auth']] = true;
		}
		return $row;
	}
	
	public function getComboBoxGroup($disp='')
	{
		$res = $this->db->query("SELECT id, name FROM ".$this->tbl_group." ORDER BY name ASC");
		if ($disp=='grid') $row[] = array('id'=>'-1', 'name'=>'All Groups'); 
		$row[] = array('id'=>'0', 'name'=>'Personal');
		foreach($res->result_array() as $k=>$v)
		{
			$row[] = $v;
		}
		return $row;
	}
	
	public function checkUser($id=0) 
	{
		$res = $this->db->query("SELECT COUNT(*) as ttl FROM ".$this->tbl_users." WHERE uid='".strtolower(trim($_POST['uid']))."' ".(!empty($id) ? "AND id<>".trim($id) : ""))->row_array();
		return $res['ttl'];
	}
	
	
	public function login() 
	{
		return $this->db->query("SELECT id, name, grp, email, themes, pass FROM ".$this->tbl_users." WHERE uid='".strtolower(trim($_POST['uid']))."' AND status=1")->row_array();
	}
	
	public function setTheme()
	{
		$this->db->query("UPDATE ".$this->tbl_users." SET themes='".trim($_POST['theme'])."' WHERE id=".$this->session->userdata('id'));
	}
	
}


