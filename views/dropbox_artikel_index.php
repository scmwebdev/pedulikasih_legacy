<?
$HTMLPageTitle = $jenis_judul;
include (APPPATH."views/dropbox_header.php");

echo '
	<div style="float:left; width:650px;">
		<div style="margin-bottom:10px;padding:5px;background:#F7EFDF;" class="RoundedBox5px JudulKanal">'.$jenis_judul.'</div>';
		
$sqltot = "select id from dropbox_artikel where status_aktif=1 and jenis_id=$jenis_id";
$query = $this->db->query($sqltot);
$totrecord = $query->num_rows();
$query->free_result();

if ($totrecord > 0) {
	$batas = 3;
	$page = $this->uri->segment(3);
	if ($page == "" || !is_numeric($page)) $page = 0;
	
	$config['base_url'] = site_url($jenis_url.'/page');
	$config['total_rows'] = $totrecord;
	$config['per_page'] = $batas;
	$config['uri_segment'] = 3;
	$config['num_links'] = 5;
	
	$this->pagination->initialize($config); 
		
	$sql = "select id,judul,judul_url,ringkasan,img_list,jenis_url from dropbox_artikel where status_aktif=1 and jenis_id=$jenis_id order by tanggal_robot desc limit $page, $batas";
	$query = $this->db->query($sql);
	if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
			echo '
				<div class="RoundedBox5px" style="padding:5px; background:#eee; margin:3px 0;">
					'.(($row->img_list == "") ? '' : '<a href="'.site_url('/dropbox/'.$row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><img src="/images/dropbox/'.$row->img_list.'" border="0" alt="" style="float:left; margin-right:5px; border:1px solid #999;" /></a>').
					'<a href="'.site_url('/dropbox/'.$row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'" class="JudulArtikelList">'.$row->judul.'</a><br />
					'.$row->ringkasan.'
					<div style="clear:both"></div>
				</div>';
		}
	}
	$query->free_result();
	
		echo '
				<div id="paging">
					'.$this->pagination->create_links().'
				</div>';
}

echo '
	</div>
	<div style="float:right; width:270px;">
';

include (APPPATH."views/dropbox_inc_samping.php");

echo '
	</div>';
	
include (APPPATH."views/dropbox_footer.php");
?>