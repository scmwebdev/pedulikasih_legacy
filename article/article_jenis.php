<?
$batas = 10;
$spage = $upage = "";
$page = $this->uri->segment(3);
if ($page == "" || !is_numeric($page)) {
	$page = 0;
} else {
	$spage = " - Page ".($page/$batas+1);
	$upage = "/page/".$page;
}

$HTMLMetaDescription = (($artikel_jenis_desc == "") ? $artikel_jenis_judul : $artikel_jenis_desc).$spage;
$HTMLPageTitle = $artikel_jenis_judul.$spage;
$HTMLMetaKeywords = $artikel_jenis_judul;
$HTMLCanonical = site_url($artikel_jenis_url.$upage);
$strID = "id<>0";

include (APPPATH."views/inc_header.php");

echo '
		<div class="content-container">
			<h1>'.strtoupper($artikel_jenis_judul).$spage.'</h1>
			<br /><br />';

$numRows = $this->article_model->getPagingJenisNumRows($artikel_jenis_id);
$totrecord= $numRows['num_rows'];

if ($totrecord > 0) {
	$config['base_url'] = site_url($artikel_jenis_url."/page");
	$config['total_rows'] = $totrecord;
	$config['per_page'] = $batas;
	$config['uri_segment'] = 3;
	$config['num_links'] = 5;

	$this->pagination->initialize($config); 

	$query = $this->article_model->showPagingJenis($artikel_jenis_id,$page,$batas);
	foreach ($query->result() as $row)
	{
		$url = $this->allfunction->makeArticleURL($row->id,$row->judul_url,$artikel_jenis_url);
		echo '
				<div class="ContentJenisList RoundedBox8px">
					'.(($row->subjudul == "") ? '' : '<div class="SubJudulArtikelList">'.$row->subjudul.'</div>').'
					<h2><a href="'.$url.'" title="'.$row->judul.'">'.$row->judul.'</a></h2>
					'.(($row->img_list != "" && file_exists($this->config->item('PATH_IMAGES_V09').$row->folder.'/'.$row->img_list)) ? '<a href="'.$url.'" title="'.$row->judul.'"><img width="100" height="85" src="'.$this->config->item('URL_IMAGES_V09').$row->folder.'/'.$row->img_list.'" align="left" alt="'.$row->judul.'" title="'.$row->judul.'" border="0" style="margin-right:5px" /></a>' : '').stripslashes($row->ringkasan).'
					<div style="clear:both"></div>
				</div>';
		
		$strID .= " and id<>".$row->id;
	}
	
	echo '
				<div class="paging">'.$this->pagination->create_links().'</div>';
}

/*
$query = $this->article_model->showArtikelJenis($page,$batas,$artikel_jenis_id);
if ($query == 0) {
	echo '<p align="center">Not found</p>';
} else 	{
	$totrecord = $query["total_found"];
	
	$config['base_url'] = site_url($artikel_jenis_url."/page");
	$config['total_rows'] = $totrecord;
	$config['per_page'] = $batas;
	$config['uri_segment'] = 3;
	$config['num_links'] = 5;

	$this->pagination->initialize($config); 
	
	//$query = $this->article_model->showArtikelSearch($keyword,$page,$batas);
	//foreach ($query->result() as $row) {
	foreach ($query['matches'] as $rowid => $docinfo) {
		$dataArticle = $this->article_model->getArticleContent($rowid);
		$url = $this->allfunction->makeArticleURL($rowid,$dataArticle['judul_url'],$dataArticle['jenis_url']);
		echo '
				<div class="ContentJenisList RoundedBox8px">
					'.(($dataArticle['subjudul'] == "") ? '' : '<div class="SubJudulArtikelList">'.$dataArticle['subjudul'].'</div>').'
					<h2><a href="'.$url.'" title="'.$dataArticle['judul'].'">'.$dataArticle['judul'].'</a></h2>
					'.(($dataArticle['img_list'] != "" && file_exists($this->config->item('PATH_IMAGES_V09').$dataArticle['folder'].'/'.$dataArticle['img_list'])) ? '<a href="'.$url.'" title="'.$dataArticle['judul'].'"><img width="100" height="85" src="'.$this->config->item('URL_IMAGES_V09').$dataArticle['folder'].'/'.$dataArticle['img_list'].'" align="left" alt="'.$dataArticle['judul'].'" title="'.$dataArticle['judul'].'" border="0" style="margin-right:5px" /></a>' : '').stripslashes($dataArticle['ringkasan']).'
					<!--'.$dataArticle['tgl_robot'].'-->
				</div>';
	}
	//$query->free_result();
	
	echo '
			<div class="paging">'.$this->pagination->create_links().'</div>';
}
*/

		echo '
			</div>
			<div class="side-container">';
	
include (APPPATH."views/inc_sidecontent.php");

echo '
	</div>
	<div style="clear:both"></div>';

include (APPPATH."views/inc_footer.php");
?>