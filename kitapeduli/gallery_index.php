<?php
$sitename = "Kita Peduli";
$HTMLPageTitle = $pk_menu_judul." - Kita Peduli";
$HTMLMetaDescription =  substr(str_replace(array("\r","\n"),"",htmlspecialchars(strip_tags($pk_menu_desc))),0,156);
$HTMLMetaKeywords =  'gallery,photo';

include (APPPATH."views/kitapeduli/header.php");

echo '
<h1>'.$pk_menu_judul.'</h1>
<p>&nbsp;</p>';

if ($pk_totrecord > 0) {
	echo '<div class="list-paging"><ul>';
	foreach($pk_data as $row) {
		$foto = $this->kitapeduli_model->getLastPhoto($row['id']);
		$image = (empty($foto)) ? '' : '<a href="/kitapeduli/gallery/'.$row['judul_url'].'"><img align="left" style="margin-right:8px" src="'.$this->config->item('URL_IMAGES').'kitapeduli/gallery/th_'.$foto['image'].'" width="150" border="0" alt="" /></a>';
		echo '<li>'.$image.'<div style="font-weight:bold;" class="csr_date">'.strtoupper(date("j F Y", strtotime($row['tanggal']))).'</div><h2><a href="/kitapeduli/gallery/'.$row['judul_url'].'">'.$row['judul'].'</a></h2>'.$row['ringkasan'].'<br/><a href="/kitapeduli/gallery/'.$row['judul_url'].'">READ MORE &raquo;</a><div style="clear:both"></div></li>';
	}
	echo '</ul></div>';
	
	echo $pk_paging;
}

include (APPPATH."views/kitapeduli/footer.php");
?>