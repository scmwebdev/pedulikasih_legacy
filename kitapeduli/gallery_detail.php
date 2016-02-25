<?php
if (count($pk_data) > 0) {
	$sitename = "Kita Peduli";
	$HTMLPageTitle = $pk_data['judul']." - Kita Peduli";
	$HTMLMetaDescription =  $pk_data['ringkasan'];
	$HTMLMetaKeywords =  'gallery,photo,foto';
	
	include (APPPATH."views/kitapeduli/header.php");

	echo '
	<link rel="stylesheet" href="/js/jquery.fancybox.css" type="text/css">
	<script type="text/javascript" src="/js/jquery.fancybox.pack.js"></script>
	<link rel="stylesheet" href="/js/helpers/jquery.fancybox-buttons.css?v=1.0.2" type="text/css" media="screen" />
	<script type="text/javascript" src="/js/helpers/jquery.fancybox-buttons.js?v=1.0.2"></script>
	<script type="text/javascript" src="/js/helpers/jquery.fancybox-media.js?v=1.0.0"></script>
	<link rel="stylesheet" href="/js/helpers/jquery.fancybox-thumbs.css?v=2.0.6" type="text/css" media="screen" />
	<script type="text/javascript" src="/js/helpers/jquery.fancybox-thumbs.js?v=2.0.6"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox-button").fancybox({
			prevEffect		: "none",
			nextEffect		: "none",
			closeBtn		: false,
			helpers		: {
				title	: { type : "inside" },
				buttons	: {}
			}
		});

    	$(".fancybox-media").fancybox({
    		openEffect  : "none",
    		closeEffect : "none",
    		helpers : {
    			media : {}
    		}
    	});
    });
    </script>
        
	<h1>'.$pk_data['judul'].'</h1>
	<div style="color:#000;font-weight:bold;" class="csr_date">'.strtoupper(date("j F Y", strtotime($pk_data['tanggal']))).'</div>
	<p>&nbsp;</p>';
	
	if (trim($pk_data['lokasi']) != '' || trim($pk_data['lokasi_gmap']) != '') {
	    echo '
	    <div class="csr_subtitle">LOKASI</div>
	    <div style="width:400px;float:left;">'.nl2br($pk_data['lokasi']).'</div>
	    <div style="width:280px;float:right;text-align:center;">';
	    
	    if (trim($pk_data['lokasi_gmap']) != '') echo '<iframe style="border:1px solid #666;padding:3px;" width="270" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.trim($pk_data['lokasi_gmap']).'&t=m&output=embed"></iframe><br /><small><a target="_blank" href="'.trim($pk_data['lokasi_gmap']).'">Lihat di peta yang lebih besar</a></small>';
	    
	    echo '
	    </div>
	    <div style="clear:both"></div>
	    <p>&nbsp;</p>';
	}
	
	echo '
	<div class="csr_subtitle">PELAKSANAAN KEGIATAN</div>
	'.$pk_data['isi'];
	
	if (count($pk_foto) > 0) {
		echo '
		<div class="list-foto"><ul>';
		foreach($pk_foto as $row) echo '<li><a class="fancybox-button" rel="fancybox-button" href="'.$this->config->item('URL_IMAGES').'kitapeduli/gallery/'.$row['image'].'" title="'.str_replace(array("\r","\n"),"",htmlspecialchars(strip_tags($row['keterangan']))).'"><img src="'.$this->config->item('URL_IMAGES').'kitapeduli/gallery/th_'.$row['image'].'" width="150" border="0" alt="" /></a></li>';
		echo '</ul></div>
		<div style="clear:both"></div>';
	}
	
	echo '<p>&nbsp;</p>';
	
	if (count($pk_video) > 0) {
		echo '
		<div class="csr_subtitle">VIDEO</div>
		<div class="list-foto"><ul>';
		foreach($pk_video as $row) echo '<li><a class="fancybox-media" href="http://www.youtube.com/watch?v='.$row['video_url_id'].'" title="'.str_replace(array("\r","\n"),"",htmlspecialchars(strip_tags($row['keterangan']))).'"><img src="http://i.ytimg.com/vi/'.$row['video_url_id'].'/default.jpg" width="150" border="0" alt="" /></a></li>';
		echo '</ul></div>
		<div style="clear:both"></div>';
	}
	
	echo '
	<p>&nbsp;</p>
	<div style="text-align:right"><span class="csr_clickhere" style="margin-bottom:0px;"><a href="'.site_url('kitapeduli/gallery').'">BACK</a></span></div>
	';
	
	include (APPPATH."views/kitapeduli/footer.php");
}
?>