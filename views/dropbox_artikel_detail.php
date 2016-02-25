<?
$artikel_id = $this->uri->segment(2);

$sql = "select * from worldcup2010_artikel where status_aktif=1 and id=$artikel_id and jenis_id=$jenis_id";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
	$row = $query->row();
	$artikel_judul	= $row->judul;
	$artikel_isi		= $row->isi;
	$artikel_image	= $row->img_artikel;
} else {
	redirect($jenis_url);
}
$query->free_result();

$HTMLPageTitle = $artikel_judul;
include (APPPATH."views/inc_header.php");

echo '
	<div style="float:left; width:650px;">
		<div style="margin-bottom:10px;padding:5px;background:#F7EFDF;" class="RoundedBox5px JudulKanal">'.$jenis_judul.'</div>
		<div class="JudulArtikel">'.$artikel_judul.'</div>
		'.(($artikel_image == "") ? '' : '<p><img src="'.URL_WORLDCUP2010_IMAGES.$artikel_image.'" border="0" alt="" style="float:left; margin-right:10px; padding:3px; border:1px solid #999;" />').
		$artikel_isi;

echo '
	</div>
	<div style="float:right; width:270px;">
';

$sql = "select id,judul,judul_url,img_list,jenis_url from worldcup2010_artikel where status_aktif=1 and id<>$artikel_id and jenis_id=$jenis_id order by tanggal_robot desc limit 5";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
	echo '
		<div style="padding:0px; margin-bottom:-7px;font:bold 24px Arial Black, Lucida Sans, Lucida Grande, Trebuchet MS;letter-spacing:-2px;color:#ccc;">More '.$jenis_judul.'</div>
		<div class="RoundedBox5px" style="padding:5px; background:#ccc;">';
	foreach ($query->result() as $row)
	{
		echo '
			<div class="RoundedBox5px" style="padding:3px; background:#fff; margin:3px 0;">
				'.(($row->img_list == "") ? '' : '<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><img src="'.URL_WORLDCUP2010_IMAGES.'50-'.$row->img_list.'" width="50" height="50" border="0" alt="" style="float:left; margin-right:5px; border:1px solid #999;" /></a>').
				'<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'">'.$row->judul.'</a>
				<div style="clear:both"></div>
			</div>';
	}
	echo '
		</div>';
}
$query->free_result();

//include (APPPATH."views/inc_artikel_terkait.php");

echo '
	</div>';
	
include (APPPATH."views/inc_footer.php");
?>