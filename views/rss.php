<?php
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="iso-8859-1"?>' . "\r\n";
?>
<rss version="2.0" xmlns:media="<?=site_url('rss')?>">
	<channel>
		<title>Stasiun TV INDOSIAR</title>
		<copyright>Copyright (c) 2012 INDOSIAR. All rights reserved.</copyright>
		<link><?=base_url()?></link>
		<description>PT. Indosiar Visual Mandiri - Memang Untuk Anda - TV Indonesia</description>
		<language>en-us</language> 
		<lastBuildDate><?=date("D, j M Y H:i:s")?> GMT</lastBuildDate>
		<ttl>60</ttl> 
<?php
	$query = $this->rss_model->showRSS();
	foreach ($query as $row)
	{
		if ($row['subjudul'] != "") $row['judul'] = $row['subjudul'].' - '.$row['judul'];
		$judul = htmlspecialchars(strip_tags($row['judul']));
		$ringkasan 	= str_replace(array("<p>","</p>"),"",$row['ringkasan']);
        $ringkasan 	= htmlspecialchars(strip_tags($ringkasan));
        $url = $this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']);
    
    echo '
		<item>
			<title>'.$judul.'</title>
		 	<link>'.$url.'</link>
		 	<guid isPermaLink="false">'.$url.'</guid>';
			
		if ($row['img_list'] != "" && file_exists($this->config->item('PATH_IMAGES_V09').$row['folder'].'/'.$row['img_list'])) {
			echo '
			<description>&#60;a href="'.$url.'">&#60;img src="'.$this->config->item('URL_IMAGES_V09').$row['folder'].'/'.$row['img_list'].'" align="left" width="100" height="85" alt="'.$judul.'" border="0" />&#60;/a>&#60;p>'.$ringkasan.'&#60;/p>&#60;br clear="all"/></description>
			<media:content url="'.$this->config->item('URL_IMAGES_V09').$row['folder'].'/'.$row['img_list'].'" type="image/jpeg" width="100" height="85"/>
			<media:text type="html">&#60;p>&#60;a href="'.$url.'">&#60;img src="'.$this->config->item('URL_IMAGES_V09').$row['folder'].'/'.$row['img_list'].'" align="left" width="100" height="85" alt="'.$judul.'" border="0" />&#60;/a>&#60;p>'.$ringkasan.'&#60;/p>&#60;br clear="all"/></media:text>';
		} else {
			echo '
			<description>&#60;p>'.$ringkasan.'&#60;/p></description>
			<media:text type="html">&#60;p>'.$ringkasan.'&#60;/p></media:text>';
		}
		
		echo '
			<media:credit role="publishing company">www.indosiar.com</media:credit>
		</item>';
				
	}
?>
	</channel>
</rss>