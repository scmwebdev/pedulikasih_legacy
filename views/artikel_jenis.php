<?
$batas = 10;
$page = $this->uri->segment(3);
if ($page == "" || !is_numeric($page)) {
	$page = 0;
	$spage = "";
} else {
	$spage = " - Page ".($page/$batas+1);
}

$HTMLMetaDescription = $HTMLPageTitle.$spage;
$HTMLPageTitle = $artikel_jenis_judul.$spage;
$HTMLMetaKeywords = $artikel_jenis_judul;

include (APPPATH."views/inc_header.php");

echo '
		<div class="content-container">
			<h1>'.strtoupper($artikel_jenis_judul).$spage.'</h1>
			<br /><br />';

$sql = "select id from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id='$artikel_jenis_id'";
$query = $this->db->query($sql);
$totrecord = $query->num_rows();
$query->free_result();

if ($totrecord > 0) {
	$config['base_url'] = site_url($artikel_jenis_url."/page");
	$config['total_rows'] = $totrecord;
	$config['per_page'] = $batas;
	$config['uri_segment'] = 3;
	$config['num_links'] = 5;

	$this->pagination->initialize($config); 
			
	$sql = "select img_list,folder,id,judul,judul_url,subjudul,ringkasan from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id='$artikel_jenis_id' order by tgl_robot desc limit $page, $batas";
	
	$i = 1;
	$query = $this->db->query($sql);
	foreach ($query->result() as $row)
	{
		echo '
				<div style="" class="ContentJenisList RoundedBox8px">
					'.(($row->subjudul == "") ? '' : '<div class="SubJudulArtikelList">'.$row->subjudul.'</div>').'
					<h2><a href="'.site_url($artikel_jenis_url.'/'.$row->id.'/'.$row->judul_url).'" title="'.$row->judul.'">'.$row->judul.'</a></h2>
					'.(($row->img_list != "" && file_exists(PATH_IMAGES_V09.$row->folder.'/'.$row->img_list)) ? '<img width="100" height="85" src="'.URL_IMAGES_V09.$row->folder.'/'.$row->img_list.'" align="left" alt="" title="" border="0" style="margin-right:5px" />' : '').$row->ringkasan.'
					<div style="clear:both"></div>
				</div>';
	}
	$query->free_result();
	
	echo '
				<div class="paging">'.$this->pagination->create_links().'</div>';
}

		echo '
			</div>
			<div class="side-container">
				<div style="margin-bottom:10px"><script src="http://adlink.indosiar.com/inc.php?idc=303" type="text/javascript"></script></div>
				<div style="margin-bottom:10px"><script src="http://adlink.indosiar.com/inc.php?idc=308" type="text/javascript"></script></div>
				<div style="padding:10px;background:#efefef;margin-bottom:10px;" class="RoundedBox8px">
					<h3>Random Tags:</3>';
				
		$sql = "select tags,tags_url from ivmweb2009_artikel_tags group by tags order by rand() limit 30";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
				foreach ($query->result() as $row)
				{
						$fontsize = rand(1, 5);
						echo '
						<span class="tag'.$fontsize.'"><a href="'.site_url('tags/'.$row->tags_url).'" class="tag'.$fontsize.'" title="'.$row->tags.'">'.$row->tags.'</a></span> ';
				}
		}
		$query->free_result();

		echo '
				</div>
			</div>
		';

include (APPPATH."views/inc_footer.php");
?>