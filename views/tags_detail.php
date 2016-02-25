<?
$sql = "select tags from ivmweb2009_artikel_tags where tags_url='$tags_url' limit 1";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		$row = $query->row();
		$tags_judul = $row->tags;
} else {
	$tags_judul = "Tags Not Found";
}
$query->free_result();

$HTMLPageTitle = 'Tag: '.$tags_judul;
$HTMLMetaDescription = $tags_judul;
$HTMLMetaKeywords = $tags_url;

include (APPPATH."views/inc_header.php");

echo '
	<div style="float:left;width:640px;">
		<div class="JenisArtikel RoundedBox5px">TAG: '.strtoupper($tags_judul).'</div>';

$sql = "select a.id from ivmweb2009_artikel_data a inner join ivmweb2009_artikel_tags t on t.data_id=a.id where UNIX_TIMESTAMP(a.tgl_robot)<=UNIX_TIMESTAMP() and t.tags_url='$tags_url'";
$query = $this->db->query($sql);
$totrecord = $query->num_rows();
$query->free_result();

if ($totrecord > 0) {
	$batas = 10;
	
	$config['base_url'] = site_url('tags/'.$tags_url."/page");
	$config['total_rows'] = $totrecord;
	$config['per_page'] = $batas;
	$config['uri_segment'] = 4;
	$config['num_links'] = 5;

	$this->pagination->initialize($config); 

	$page = $this->uri->segment(4);
	if ($page == "") $page = 0;
			
	$sql = "select a.id,a.judul,a.subjudul,a.judul_url,a.jenis_judul,a.jenis_url,a.ringkasan,a.img_list,a.folder from ivmweb2009_artikel_data a inner join ivmweb2009_artikel_tags t on t.data_id=a.id where UNIX_TIMESTAMP(a.tgl_robot)<=UNIX_TIMESTAMP() and t.tags_url='$tags_url' order by a.tgl_robot desc limit $page, $batas";
	
	$i = 1;
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

		echo '
			</div>
			<div style="float:right;width:260px;">
				<div style="padding:10px;background:#efefef;margin-bottom:10px;" class="RoundedBox8px">
					<b>Tags:</b>';
				
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