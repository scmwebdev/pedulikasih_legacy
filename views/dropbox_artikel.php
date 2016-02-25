<?
$jenis_url = $this->uri->segment(1);

$sql = "select id,jenis from worldcup2010_artikel_jenis where jenis_url='$jenis_url'";
$query = $this->db->query($sql);

if ($query->num_rows() > 0) {
	$row = $query->row();
	$jenis_id 					= $row->id;
	$jenis_judul 				= $row->jenis;
	
	if (is_numeric($this->uri->segment(2)))
		include (APPPATH."views/artikel_detail.php");
	else
		include (APPPATH."views/artikel_index.php");
	
}	else {
	include (APPPATH."views/home.php");
}
$query->free_result();
?>