<?
$batas = 10;
$spage = $upage = "";
$page = $this->uri->segment(4);
if ($page == "" || !is_numeric($page)) {
	$page = 0;
} else {
	$spage = " - Page ".($page/$batas+1);
	$upage = "/page/".$page;
}

$HTMLPageTitle = $tags_judul.' - Tag'.$spage;
$HTMLMetaDescription = $tags_judul.$spage;
$HTMLMetaKeywords = $tags_judul.',tag';
$HTMLCanonical = site_url('tag/'.$tags_url.$upage);
$strID = "id>0";

include (APPPATH."views/inc_header.php");

echo '
	<div class="content-container">
		<h1>TAG: '.$tags_judul.$spage.'</h1>
		<br /><br />';

$numRows = $this->article_model->getPagingTagNumRows($tags_url);
$totrecord= $numRows['num_rows'];

if ($totrecord > 0) {
	$batas = 10;
	
	$config['base_url'] = site_url('tags/'.$tags_url."/page");
	$config['total_rows'] = $totrecord;
	$config['per_page'] = $batas;
	$config['uri_segment'] = 4;
	$config['num_links'] = 5;

	$this->pagination->initialize($config); 

	$i = 1;
	$query = $this->article_model->showPagingTag($tags_url,$page,$batas);
	foreach ($query->result() as $row)
	{
		echo '
				<div style="padding:10px;background:#efefef;margin-bottom:10px;" class="RoundedBox8px">
					'.(($row->subjudul == "") ? '' : '<div class="SubJudulArtikelList">'.$row->subjudul.'</div>').'
					<div class="JudulArtikelList"><a href="'.$this->allfunction->makeArticleURL($row->id,$row->judul_url,$row->jenis_url).'" title="'.$row->judul.'"><b>'.$row->judul.'</b></a></div>
					'.(($row->img_list == "") ? '' : '<a href="'.$this->allfunction->makeArticleURL($row->id,$row->judul_url,$row->jenis_url).'" title="'.$row->judul.'"><img width="100" height="85" src="'.$this->config->item('URL_IMAGES_V09').$row->folder.'/'.$row->img_list.'" align="left" alt="'.$row->judul.'" title="" border="0" style="margin-right:5px" /></a>').$row->ringkasan.'
					<div style="clear:both"></div>
				</div>';
	}
	$query->free_result();
	
	echo '
				<div class="paging">'.$this->pagination->create_links().'</div>';
}

		echo '
			</div>
			<div class="side-container">';
	
include (APPPATH."views/inc_sidecontent.php");

echo '
	</div>
	<div style="clear:both"></div>';

include (APPPATH."views/inc_footer.php");
?>