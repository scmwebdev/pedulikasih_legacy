<?
session_start();

$qword = "";
if (isset($_SESSION['news_keyword'])) $qword = $_SESSION['news_keyword'];
if (isset($_REQUEST['qword']) && trim($_REQUEST['qword']) != "") {
	$qword = $this->input->post('qword', TRUE);
	$qword = strip_tags(trim($qword));
	$_SESSION['news_keyword'] = mysql_escape_string($qword);
}

$HTMLPageTitle = "Search - $qword";
$HTMLMetaDescription = "Search - $qword";
$HTMLMetaKeywords = "Search - $qword";

include (APPPATH."views/inc_header.php");

echo '
		<div style="float:left;width:600px;">
			<div class="JenisArtikel RoundedBox5px">Search: '.$qword.'</div>
		';



if (isset($_SESSION['news_keyword'])) {
	$q_keyword = $_SESSION['news_keyword'];
	$sql = "select id from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and (judul like '%$q_keyword%' or ringkasan like '%$q_keyword%')";
	$query = $this->db->query($sql);
	$totrecord = $query->num_rows();
	$query->free_result();
	
	if ($totrecord > 0) {
		$batas = 10;
		
		$config['base_url'] = site_url("search/page");
		$config['total_rows'] = $totrecord;
		$config['per_page'] = $batas;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
	
		$this->pagination->initialize($config); 
	
		$page = $this->uri->segment(3);
		if ($page == "") $page = 0;
				
		$sql = "select img_list,folder,id,subjudul,judul,judul_url,ringkasan,jenis_judul,jenis_url from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and (judul like '%$q_keyword%' or ringkasan like '%$q_keyword%') order by tgl_robot desc limit $page, $batas";
	
		$query = $this->db->query($sql);
		foreach ($query->result() as $row)
		{
			echo '
				<div style="padding:10px;background:#efefef;margin-bottom:10px;" class="RoundedBox8px">
					'.(($row->subjudul == "") ? '' : '<div class="SubJudulArtikelList">'.$row->subjudul.'</div>').'
					<div class="JudulArtikelList"><a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'" title="'.$row->judul.'"><b>'.$row->judul.'</b></a></div>
					'.(($row->img_list == "") ? '' : '<img width="100" height="85" src="'.URL_IMAGES_V09.$row->folder.'/'.$row->img_list.'" align="left" alt="" title="" border="0" style="margin-right:5px" />').$row->ringkasan.'
					<div style="clear:both"></div>
				</div>';
		}
		$query->free_result();
		
		echo '
				<div class="paging">'.$this->pagination->create_links().'</div>';
	}
}

echo '
	</div>
	<div style="float:right;width:300px;">
';

include (APPPATH."views/inc_sidecontent.php");

echo '
	</div>
	<div style="clear:both"></div>
';

include (APPPATH."views/inc_footer.php");
?>