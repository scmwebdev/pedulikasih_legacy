<?
$qword = ($keyword == "") ? "" : " - ".$keyword;
$spage = $upage = "";
$batas = 10;
if ($page == "" || !is_numeric($page)) {
	$page = 0;
} else {
	$spage = " - Page ".($page/$batas+1);
}

$HTMLPageTitle = "Search".$qword.$spage;
$HTMLMetaDescription = "Search".$qword.$spage;
$HTMLMetaKeywords = "Search".$qword.$spage;
$strID = "id>0";

include (APPPATH."views/inc_header.php");

echo '
	<div class="content-container">
			<h1>Search'.$qword.$spage.'</h1>
			<br /><br />';

if ($keyword != "") {
	//$numRows = $this->article_model->getArtikelSearchNumRows($keyword);
	//$totrecord= $numRows['num_rows'];
	
	$query = $this->article_model->showArtikelSearch($keyword,$page,$batas);
	if ($query == 0) {
		echo '<p align="center">Not found</p>';
	} else 	{
		$totrecord = $query["total_found"];
		
		$config['base_url'] = site_url("search/$keyword_url");
		$config['total_rows'] = $totrecord;
		$config['per_page'] = $batas;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
	
		$this->pagination->initialize($config); 
		
		//$query = $this->article_model->showArtikelSearch($keyword,$page,$batas);
		//foreach ($query->result() as $row) {
		foreach ($query['matches'] as $rowid => $docinfo) {
				$dataArticle = $this->article_model->getArticleContent($rowid);
				if (count($dataArticle) > 0) {
						$url = $this->allfunction->makeArticleURL($rowid,$dataArticle['judul_url'],$dataArticle['jenis_url']);
						echo '
								<div class="ContentJenisList RoundedBox8px">
									'.(($dataArticle['subjudul'] == "") ? '' : '<div class="SubJudulArtikelList">'.$dataArticle['subjudul'].'</div>').'
									<h2><a href="'.$url.'" title="'.$dataArticle['judul'].'">'.$dataArticle['judul'].'</a></h2>
									'.(($dataArticle['img_list'] != "" && file_exists($this->config->item('PATH_IMAGES_V09').$dataArticle['folder'].'/'.$dataArticle['img_list'])) ? '<a href="'.$url.'" title="'.$dataArticle['judul'].'"><img width="100" height="85" src="'.$this->config->item('URL_IMAGES_V09').$dataArticle['folder'].'/'.$dataArticle['img_list'].'" align="left" alt="'.$dataArticle['judul'].'" title="'.$dataArticle['judul'].'" border="0" style="margin-right:5px" /></a>' : '').stripslashes($dataArticle['ringkasan']).'
									<!--'.$dataArticle['tgl_robot'].'-->
									<div style="clear:both"></div>
								</div>';
				}
		}
		//$query->free_result();
		
		echo '
				<div class="paging">'.$this->pagination->create_links().'</div>';
	}
}

echo '
		<p>&nbsp;</p>
	</div>
	<div class="side-container">';
	
include (APPPATH."views/inc_sidecontent.php");

echo '
	</div>
	<div style="clear:both"></div>';

include (APPPATH."views/inc_footer.php");
?>