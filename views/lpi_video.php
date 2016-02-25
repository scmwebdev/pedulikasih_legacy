<?php
$judul = ucwords(str_replace("-"," ",$this->uri->segment(4)));

$sitename = "Liga Primer Indonesia";
$HTMLPageTitle = "Liga Primer Indonesia - $judul";
$HTMLMetaDescription = "Video $judul Liga Primer Indonesia";
$HTMLMetaKeywords = "$judul, video, liga, Primer, Indonesia";

include (APPPATH."views/inc_header.php");
include (APPPATH."views/lpi_top.php");
?>
	<style>
	.video-listbox {width:120px;height:160px;float:left;margin:4px;padding:3px;border:1px solid #666;font-size:10px;text-align:center;}
	</style>
	<div class="JudulArtikel">Video <?=$judul?></div>
	<p>&nbsp;</p>
	<div style="text-align:center"><div name="mediaspace" id="mediaspace">View Video</div></div>
	<script type="text/javascript" src="http://player.longtailvideo.com/swfobject.js"></script>
	<script type="text/javascript">
		var so = new SWFObject("http://player.longtailvideo.com/player.swf","mediaspace","600","450","8");			
	  so.addParam("allowfullscreen","true");
	  so.addParam("allowscriptaccess","always");
	  so.addParam("wmode","transparent");
		//so.addVariable("channel", "7124");
		so.addVariable("plugins", "ltas");
		so.addVariable("ltas.cc", "npxbtmlswnzpxts");
		so.addVariable("file","http://www.youtube.com/watch%3Fv%3D<?=$this->uri->segment(3)?>");
		so.addVariable("image","http://img.youtube.com/vi/<?=$this->uri->segment(3)?>/0.jpg");
		so.addVariable("skin","http://content.longtailvideo.com/skins/glow/glow.zip");
		so.write("mediaspace");
	</script>
	<p>&nbsp;</p>
	<p>Video Lainnya:</p>
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