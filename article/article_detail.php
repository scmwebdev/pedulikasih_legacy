<?
$dataArticle = $this->article_model->getArticleContent($artikel_id);
if (count($dataArticle) > 0) {
	$artikel_id = $dataArticle['id'];
	$artikel_judul = $dataArticle['judul'];
	$artikel_judul_url = $dataArticle['judul_url'];
	$artikel_subjudul = $dataArticle['subjudul'];
	$artikel_isi = stripslashes($dataArticle['isi']);
	$artikel_jenis_id = $dataArticle['jenis_id'];
	$artikel_img_artikel = $dataArticle['img_artikel'];
	$artikel_img_list = $dataArticle['img_list'];
	$artikel_img_index = $dataArticle['img_index'];
	$artikel_tanggal = $dataArticle['tanggal'];
	$artikel_tanggal_tayang = $dataArticle['tgl_tayang'];
	$artikel_tags = trim($dataArticle['tags']);
	$artikel_folder = $dataArticle['folder'];
	$artikel_video = trim($dataArticle['video']);
	
	//$HTMLPageTitle = $artikel_judul.(((strlen($artikel_judul)+strlen($artikel_jenis_judul)+3) <= 62) ? " - $artikel_jenis_judul" : "");
	$HTMLPageTitle = (($artikel_subjudul == '') ? $artikel_judul : $artikel_subjudul.' - '.$artikel_judul).' - '.$artikel_jenis_judul;
	
	$HTMLMetaDescription = $dataArticle['ringkasan'];
	$HTMLMetaKeywords = $artikel_tags;
	$HTMLCanonical = $this->allfunction->makeArticleURL($artikel_id,$artikel_judul_url,$dataArticle['jenis_url']);
} else 
    redirect($artikel_jenis_url);

if ($artikel_img_artikel != "") $HTMLPageImage = $this->config->item('URL_IMAGES_V09').$artikel_folder.'/'.$artikel_img_artikel;
if ($artikel_img_list != "") $HTMLPageImage = $this->config->item('URL_IMAGES_V09').$artikel_folder.'/'.$artikel_img_list;
$isNewsReads    = 1;
$page_id        = $artikel_id;
include (APPPATH."views/inc_header.php");

echo '
<div class="content-container">
	<div class="RoundedBox5px" style="font:bold 18px Lucida Sans,Lucida Grande,Trebuchet MS;letter-spacing:-1px;color:#fff;background:#CFCFCF;padding:5px 10px;margin-bottom:10px;">'.strtoupper($artikel_jenis_judul).'</div>
	<div style="margin-bottom:10px">
	    <fb:like href="http://www.facebook.com/pages/PT-Indosiar-Visual-Mandiri-Tbk/130125797101796" show_faces="false" width="450" font="arial"></fb:like><br />
        <a href="https://www.twitter.com/indosiartvtwit" class="twitter-follow-button" data-show-count="true">Follow @indosiartvtwit</a>
    </div>
';
if ($artikel_subjudul != "") echo '<div class="SubJudulArtikel">'.$artikel_subjudul.'</div>'."\r\n";
echo '
	<h1>'.$artikel_judul.'</h1>
	'.(($artikel_tanggal_tayang == "0000-00-00 00:00:00") ? '' : '<b>Tayang: '.$this->allfunction->UbahTglTayang($artikel_tanggal_tayang)).'</b><br /><br />
';

$strDivKiri = "";
$strID = " id<>".$artikel_id;

if ($artikel_img_artikel != "") {
	if (file_exists($this->config->item('PATH_IMAGES_V09').$artikel_folder.'/'.$artikel_img_artikel)) {            	
			list($width, $height, $oritype, $oriattr) = getimagesize($this->config->item('PATH_IMAGES_V09').$artikel_folder.'/'.$artikel_img_artikel);
			if ($width > 220) {
					$height = round(($height * 220) / $width);
					$width = 220;
			}

			$setsize = ' width="'.$width.'" height="'.$height.'"';
	} else
		$setsize = "";
	
	echo '
	<div class="FloatArtikelDetail RoundedBox8px">
		<div style="text-align:center;margin-bottom:10px;"><img alt="'.$artikel_judul.'" title="'.$artikel_judul.'" src="'.$this->config->item('URL_IMAGES_V09').$artikel_folder.'/'.$artikel_img_artikel.'"'.$setsize.' /></div>
	';
	$strDivKiri = 1;
}

// TAGS //
if ($artikel_tags != "") {
	$tags_arr = explode(",", $artikel_tags);
	$tags_url = $tags_sql = "";
	
	foreach ($tags_arr as $val) {
		$val = trim($val);
		if ($val != "") {
			$val=mysql_escape_string($val);
			$fontsize = rand(1, 5);
			$tags_url .= '<span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$this->allfunction->judul2url($val)).'" class="tag'.$fontsize.'" title="'.$val.'">'.str_replace("\\","",$val).'</a></span> ';
			$tags_sql .= "tags like '%$val%' or ";
		}
	}
	
	$tags_sql = substr($tags_sql, 0, -4);
	
	if ($strDivKiri == "") {
		/*echo '
		<div class="FloatArtikelDetail RoundedBox8px">
			<div style="margin-top:5px; padding:5px; border:1px solid #ccc;">
		';*/
		echo '
		<div class="FloatArtikelDetail RoundedBox8px">
		';
		$strDivKiri = 1;
	}			
	
	$BacaJuga =  $this->article_model->showBacaJuga($strID,$tags_sql);
	if ($BacaJuga->num_rows() > 0) {			
		echo '
			<h2>Baca Juga:</h2>
			<ul>';
		foreach ($BacaJuga->result() as $row)
		{
			echo '
				<li><a href="'.$this->allfunction->makeArticleURL($row->id,$row->judul_url,$row->jenis_url).'" class="ArtikelTerkait">'.$row->judul.'</a></li>';
			$strID .= " and id<>".$row->id;
		}
	}
	//$query->free_result();
	
	echo '
			</ul>
			<br />
			<h2>Tags:</h2> '.$tags_url.'<br /><br />';
}
// END TAGS //

if ($strDivKiri == "") {
	echo '
	<div class="FloatArtikelDetail RoundedBox8px">
	';
	$strDivKiri = 1;
}

echo '
	<div style="margin-top:5px; padding:5px; border:1px solid #ccc;">
		<h2>Berita HOT:</h2>
		<ul>';

$hotArticle = $this->article_model->showHotArticle($strID);
foreach ($hotArticle as $row) {				
	echo '
			<li>'.(($row['subjudul'] == "") ? '' : '<div>'.$row['subjudul'].'</div>').'<a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'" class="ArtikelTerkait">'.$row['judul'].'</a></li>';
	$strID .= " and id<>".$row['id'];
}

echo '
		</ul>
	</div>';
	
if ($strDivKiri != "") echo "</div>\n";

//$artikel_isi = str_replace(array("<strong><br /><br />","../../swf/",'\\',"indosiar.com/video/","http://www.indosiar.com/swf/jw/player.swf?"), array("<strong>","/swf/","","indosiar.com/static/video/","http://player.longtailvideo.com/player.swf?autostart=true&skin=http://content.longtailvideo.com/skins/glow/glow.zip&"), $artikel_isi);
//$artikel_isi = str_replace(array("<strong><br /><br />","../../swf/",'\\',"indosiar.com/video/","http://www.indosiar.com/swf/jw/player.swf?"), array("<strong>","/swf/","","indosiar.com/static/video/","http://www.indosiar.com/swf/jw/mediaplayer.swf?autostart=true&"), $artikel_isi);

if (preg_match('/<object (.*)file=(.*)"(.*)<\/object>/s', $artikel_isi, $match)) {
	$artikel_video = str_replace('\\', '', $match[2]);
	$artikel_isi = preg_replace('/<object (.*)file=(.*)"(.*)<\/object>/s', '', $artikel_isi);
}	

if ($artikel_video != "") {
	if (preg_match('@^(?:http://(?:www\.)?youtube.com/)(watch\?v=|v/)([a-zA-Z0-9_\-]*)@', $artikel_video, $match)) $vurl = 'http://www.youtube.com/watch%3Fv%3D'.$match[2];
	if (preg_match('@^((?:http\:\/\/)?(?:www\.)?indosiar.com/)(.*)@', $artikel_video, $match))
		$vurl = 'http://static.indosiar.com/'.$match[2];
	elseif (substr($artikel_video, 0 , 1) == "/")
		$vurl = 'http://static.indosiar.com'.$artikel_video;
	else
		$vurl = $artikel_video;
	echo '
	<div style="text-align:center;margin-bottom:10px;"><embed src="http://www.indosiar.com/swf/jw/mediaplayer.swf" width="340" height="250" bgcolor="#FFFFFF" allowscriptaccess="always" allowfullscreen="true" flashvars="file='.$vurl.'&autostart=true" /></embed></div>';
}

$artikel_isi = str_replace(array("<strong><br /><br />"), array("<strong>"), $artikel_isi);
$r = array('src="images/', 'src="../images/"', 'src="../../images/"');
echo str_replace($r,'src="'.$this->config->item('URL_IMAGES_V09'),$artikel_isi)."\r\n";
//echo ($artikel_tanggal_tayang == "0000-00-00 00:00:00") ? '' : '<br /><b>Tayang: '.$this->allfunction->UbahTglTayang($artikel_tanggal_tayang).'</b><br /><br />';

if ($artikel_jenis_id==9) {
	$sql = "select * from ivmweb_artikel_beritafoto where artikel_id='jwmerriott-".$artikel_id."' order by status_sort";
	$query = $this->db->query($sql);
	if ($query->num_rows() > 0) {
		echo '<br>
		<script type="text/javascript" src="'.URL_JS.'thickbox.js"></script>
		<link rel="stylesheet" href="'.URL_JS.'thickbox.css" type="text/css" media="screen" />
		<div style="padding-left:0px; border:1px solid #ccc; width:260px; float:left; margin-right:10px;">';
		foreach ($query->result() as $row)
		{
				echo '
				<div style="padding:2px; margin:2px; border:1px solid #999; float:left; width:120px;">
					<a href="'.URL_BERITAFOTO.'jwmerriott/'.$row->image.'" title="'.htmlspecialchars($row->keterangan).'" class="thickbox" rel="beritafoto"><img src="'.URL_BERITAFOTO.'jwmerriott/th'.$row->image.'" border="0"></a>
				</div>';
		}
		echo '
			<div style="clear:both"></div>
		</div>';	
	}
	$query->free_result();	
}					
?>
        <div style="clear:both"></div>
        <div style="float:right;width:200px;margin:0;">
            <div style="margin:8px 0 0 0px;float:left;">
                <div class="fb-like" data-send="false" data-layout="box_count" data-width="450" data-show-faces="false"></div>
            </div>
            <div style="margin:8px 0 0 15px;float:left;">
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?=current_url()?>" data-via="indosiartvtwit" data-lang="en" data-related="anywhereTheJavascriptAPI" data-count="vertical">Tweet</a>
            </div>
            <div style="margin:8px 0 0 15px;float:left;">
                <div class="g-plus" data-action="share" data-annotation="vertical-bubble" data-height="60" data-href="<?=current_url()?>"></div>
            </div>
            <div style="clear:both"></div>
        </div>
        <div>
            <script type="text/javascript">var addthis_pub="kewell";</script>
            <a href="http://www.addthis.com/bookmark.php?v=20" onmouseover="return addthis_open(this, '', '<?=$HTMLCanonical?>', '<?=$artikel_judul?>')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/200/addthis_widget.js"></script>
        </div>
        <div style="clear:both"></div>
        <br /><br />
        <div style="padding:10px;border:1px solid #ccc;">
        	<div id="theArtikelComments"></div>
        	<div id="theArtikelCommentForm"></div>
        </div>
		<script type="text/javascript" src="<?=$this->config->item('URL_JS')?>jquery.form.js"></script>
		<script type="text/javascript" src="<?=$this->config->item('URL_JS')?>jquery.blockUI.js"></script>
		<script language="javascript">		
		function ShowCommentsList(page) {
            surl = "/comment/paging/<?=$artikel_id?>/" + page;
            $.ajax({
                type: "GET",
                url: surl,
                dataType: "html",
                beforeSend: function(){
                    $("div#theArtikelComments").block('<b>Processing</b>', { border: '3px solid #1F4266' }); 
                },
                success: function(msg){
                   	$("#theArtikelComments").html(msg);
                   	$("#theArtikelComments").unblock();
                }
            });
		}
		
		ShowCommentsList(1);
		//$.post("/comment/formbox/<?=$artikel_id?>",function(data){$("#theArtikelCommentForm").html(data)});
		</script>
	</div>
	<div class="side-container">
		<div style="margin-bottom:10px"><?=$this->banner_model->getBanner(303)?></div>
		<div style="margin-bottom:10px"><?=$this->banner_model->getBanner(328)?></div>
<?
		// --- ARTIKEL LAINNYA ---- //
		$moreArticle = $this->article_model->showMoreArticle($artikel_jenis_id,$strID);		
		if (count($moreArticle) > 0) {
				echo '
						<h3>More '.strtoupper($artikel_jenis_judul).':</h3>
						<ul>';
	
				foreach ($moreArticle as $row) if (isset($row['id'])) echo '<li>'.(($row['subjudul'] == "") ? '' : $row['subjudul'].'<br />').'<a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$artikel_jenis_url).'">'.$row['judul'].'</a></li>';
				
				echo '
						</ul>
						<div align="right">[ <a href="'.site_url($artikel_jenis_url).'">more '.$artikel_jenis_judul.'</a> ]</div>
						<br />
					';
		}
		// --- END ARTIKEL LAINNYA ---- //
		

		echo '
				<div style="padding:10px;background:#efefef;margin-bottom:10px;" class="RoundedBox8px">
					<h3>Random Tags</h3>';
		
		$randomTags = $this->article_model->showRandomTags();
		foreach ($randomTags as $row)
		{
				$fontsize = rand(1, 5);
				echo '
				<span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$row['tags_url']).'" class="tag'.$fontsize.'" title="'.$row['tags'].'">'.stripslashes($row['tags']).'</a></span> ';
		}

		echo '
				</div>
			</div>
			<div style="clear:both"></div>
		';


/*<script language="javascript">
var w=screen.width;
var h=screen.height;
var r=document.referrer;
//document.write('<ifr'+'ame src='+'"/phpx/stats.php?d=<?=$artikel_id?>&amp;w='+w+'&amp;h='+h+'&amp;r='+r+'"'+' marginwidth="0" marginheight="0" width='+'"1"'+' height='+'"1"'+' border="0" frameborder="0" style="border:none;" scrolling="no"></iframe>');
</script>*/

include (APPPATH."views/inc_footer.php");
?>