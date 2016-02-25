<?php
$batas = 5;
$segment=4;
$spage = "";
$page = trim($this->uri->segment(4));
if ($page == "" || !is_numeric($page)) {
	$page = 1;
} else {
	$spage = " - Page ".($page/$batas+1);
}

$sitename = "Kita Peduli";
$HTMLPageTitle = "Kita Peduli - Berita".$spage;
$HTMLMetaDescription = "Berita Kita Peduli".$spage;
$HTMLMetaKeywords = "Berita, kita peduli".$spage;

include (APPPATH."views/inc_header.php");
include (APPPATH."views/kitapeduli/kp_top.php");
?>

	<div class="JudulArtikel">Berita Kita Peduli</div>
	<p>&nbsp;</p>

<?
$batas = 5;
$segment=4;
$page = trim($this->uri->segment(4));
/*
if ($page == "" || !is_numeric($page)) $page = 1;
$strlimit = ($page == 1) ? " limit 0, $batas" : " limit ". $page .", $batas";

$sqltot = "select * from ivmweb2009_artikel_data where (judul like '%kita peduli%' or isi like '%kita peduli%') and jenis_id=5";
$totrecord=$this->kitapeduli_model->totalrecord($sqltot);

if ($totrecord > 0) {
	$sql = "select * from ivmweb2009_artikel_data where (judul like '%kita peduli%' or isi like '%kita peduli%') and jenis_id=5 order by tanggal desc ".$strlimit;
	echo $this->kitapeduli_model->pagingberita("kitapeduli/berita/page",$sql,$totrecord,$batas,$segment);
}
*/
$query = $this->article_model->showArtikelSearch('kita peduli',$page,$batas,"pk_kp");
if ($query == 0) {
	echo '<p align="center">Not found</p>';
} else 	{
	$totrecord = $query["total_found"];
	
	$config['base_url'] = site_url("kitapeduli/berita/page");
	$config['total_rows'] = $totrecord;
	$config['per_page'] = $batas;
	$config['uri_segment'] = $segment;
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
					<h2><a href="'.$url.'" title="'.str_replace('"','',$dataArticle['judul']).'">'.$dataArticle['judul'].'</a></h2>
					'.(($dataArticle['img_list'] != "" && file_exists($this->config->item('PATH_IMAGES_V09').$dataArticle['folder'].'/'.$dataArticle['img_list'])) ? '<a href="'.$url.'" title="'.str_replace('"','',$dataArticle['judul']).'"><img width="100" height="85" src="'.$this->config->item('URL_IMAGES_V09').$dataArticle['folder'].'/'.$dataArticle['img_list'].'" align="left" alt="'.str_replace('"','',$dataArticle['judul']).'" title="'.str_replace('"','',$dataArticle['judul']).'" border="0" style="margin-right:5px" /></a>' : '').stripslashes($dataArticle['ringkasan']).'					
				</div>';
	}
	//$query->free_result();
	
	echo '
			<div class="paging">'.$this->pagination->create_links().'</div>';
}
include (APPPATH."views/kitapeduli/kp_bottom.php");
include (APPPATH."views/inc_footer.php");
?>