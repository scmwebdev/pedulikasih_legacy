<?php
$sitename = "Liga Primer Indonesia";
$HTMLPageTitle = "Liga Primer Indonesia - Video";
$HTMLMetaDescription = "Video Liga Primer Indonesia";
$HTMLMetaKeywords = "video, Profil Tim, Primer, Indonesia";

include (APPPATH."views/inc_header.php");
include (APPPATH."views/lpi_top.php");
?>
	<style>
	.video-listbox {width:120px;height:160px;float:left;margin:4px;padding:3px;border:1px solid #666;font-size:10px;text-align:center;}
	</style>
	<div class="JudulArtikel">Video Liga Primer Indonesia</div>
	<p>&nbsp;</p>
	
<?
$url = 'http://gdata.youtube.com/feeds/api/videos?vq=%22liga+primer+indonesia%22&racy=exclude&orderby=relevance&start-index=1&max-results=10';
$data = grab_url($url);

$matches_judul = $matches_time = $matches_url = array();
preg_match_all('#<title type=\'text\'>(.*)<\/title>#msU', $data, $matches_judul);
preg_match_all('#<link rel=\'alternate\' type=\'text\/html\' href=\'(.*)\'\/>#msU', $data, $matches_url);
preg_match_all('#medium=\'video\' isDefault=\'true\' expression=\'full\' duration=\'([0-9]*)\' yt:format#msU', $data, $matches_time);
if (count($matches_judul) > 0 &&  count($matches_url) > 0) {
	for ($i=0; $i<count($matches_judul[1])-1; $i++) {
		$judul 	= $matches_judul[1][$i+1];
		$url 		= $matches_url[1][$i+1];
		$url 		= str_replace("&amp;feature=youtube_gdata", "", $url);
		$urlid 	=	md5($url);
		if (!isset($matches_time[1][$i])) $matches_time[1][$i] = 0;
		$time 	= floor($matches_time[1][$i]/60);
		$time 	= $time.':'.($matches_time[1][$i]-(60*$time));
		$vid 		= str_replace("http://www.youtube.com/watch?v=", "", $url);
		
		echo '
		<div class="video-listbox">
			<a href="/lpi/video/'.$vid.'/'.judul2url($judul).'" title="view video '.$judul.'"><img src="http://img.youtube.com/vi/'.$vid.'/2.jpg" width="120" height="90" alt="view video '.$judul.'" border="0" /></a><br />'.$judul.' ['.$time.']
		</div>';
	}
}

include (APPPATH."views/lpi_bottom.php");
include (APPPATH."views/inc_footer.php");
?>