<?php
header("Content-Type: text/xml;charset=UTF-8");  
echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";

if ($jenis_url == "sitemap") {
$channel = array('gossip', 'sinopsis', 'talk-show', 'fokus', 'patroli', 'ragam', 'budaya', 'berita-terkini', 'safari-resep', 'videofiesta');

echo '
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    foreach ($channel as $k) {
        echo '
    <sitemap>
        <loc>http://www.indosiar.com/sitemap-'.$k.'.xml</loc>
        <lastmod>'.date('c').'</lastmod>
    </sitemap>';
    }
echo '
</sitemapindex>';

} elseif ($jenis_url == "videofiesta") {
    
    echo '
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
    xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    
	$query = $this->sitemapxml_model->showVideoFiesta();
	foreach ($query->result() as $row) {
		echo '
	 <url>
	    <loc>'.$this->config->item('URL_VIDEOFIESTA').$row->id.'/'.$this->allfunction->judul2url($row->judul).'</loc>
	    <changefreq>weekly</changefreq>
	    <priority>0.5</priority>
	 </url>';
	}

    echo '
</urlset>';
	
} else {
    
    echo '
<urlset
    xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
    xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
    xmlns:video="http://www.google.com/schemas/sitemap-video/1.1"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    
	$query = $this->sitemapxml_model->showArticle($jenis_url);
	foreach ($query->result() as $row) {
	    $img = base_url().'assets/images/logo-96.png';
	    if ($row->img_list != '') $img = $this->config->item('URL_IMAGES_V09').$row->folder.'/'.$row->img_list;
	    if ($row->img_artikel != '') $img = $this->config->item('URL_IMAGES_V09').$row->folder.'/'.$row->img_artikel;
	    if ($row->img_index != '') $img = $this->config->item('URL_IMAGES_V09').$row->folder.'/'.$row->img_index;
	    
		echo '
	 <url>
	    <loc>'.$this->allfunction->makeArticleURL($row->id,$row->judul_url,$row->jenis_url).'</loc>
        <image:image>
           <image:loc>'.$img.'</image:loc>
        </image:image>';
	    
	    if ($row->video != '') {
        	if (preg_match('@^((?:http\:\/\/)?(?:www\.)?indosiar.com/)(.*)@', $row->video, $match))
        		$vurl = 'http://static.indosiar.com/'.$match[2];
        	elseif (substr($row->video, 0 , 1) == "/")
        		$vurl = 'http://static.indosiar.com'.$row->video;
        	else
        		$vurl = $row->video;
        		
	        echo '
        <video:video>
            <video:content_loc>'.$vurl.'</video:content_loc>
            <video:player_loc allow_embed="yes" autoplay="ap=1">'.$vurl.'</video:player_loc>
            <video:thumbnail_loc>'.$img.'</video:thumbnail_loc>
            <video:title>'.htmlspecialchars(strip_tags($row->judul),ENT_QUOTES).'</video:title>
            <video:description>'.htmlspecialchars(strip_tags(trim($row->ringkasan)),ENT_QUOTES).'</video:description>
        </video:video>';
        }
        
	    echo '
	    <lastmod>'.date('c', strtotime($row->tgl_robot)).'</lastmod>
	    <changefreq>daily</changefreq>
	    <priority>0.8</priority>
	 </url>';
	}
	
    echo '
</urlset>';
}
?>