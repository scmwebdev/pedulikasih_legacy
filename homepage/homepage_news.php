<?
//include (ROOTBASEPATH."inc/index_v09_news.php");

$HTMLPageTitle = "Berita Terbaru, Tentang Indonesia, Berita Indonesia";
$HTMLMetaDescription = "Berita Terbaru, Tentang Indonesia, Berita Indonesia";
$HTMLMetaKeywords = "Lautan Indonesia - Indonesian Portal Community";
$HTMLCanonical = site_url('berita');

include (APPPATH."views/inc_header.php");
?>
	<div style="float:right;width:610px;">
		<div class="RoundedBox5px" style="width:590px;background:#E9E9E9;padding:10px;">
			<div class="RoundedBox5px" style="float:left;width:260px;height:300px;padding:10px;background:#fff;"><div id="hlBOX"></div></div>
			<div style="float:left; width:310px;">
				<div style="padding:0 0 5px 10px;" class="JudulKanal">News On The Week</div>
<?
$strID = "";
$i = 1;
$query = $this->homepage_model->showWhatsOnTheWeek(1,$strID,4,false);
foreach ($query as $row)
{
				$strID .= " and id<>".$row['id'];
				$url = $this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']);
				echo '
					<div id="hl'.$i.'" style="display:none;visibility:hidden;">
						<a href="'.$url.'"><div class="SubHeader" style="cursor:Pointer;background:url('.$this->config->item('URL_IMAGES_V09').$row['folder'].'/'.$row['img_index'].') no-repeat top left">
							<div class="SubHeader-BoxM">
								<div class="SubHeader-Box">
									<div class="SubHeader-Judul">'.$row['judul'].'</div>
								</div>
							</div>
						</div></a>
						<div style="font-size:11px;margin-top:5px;">'.(($row['subjudul'] == "") ? '' : '<b>'.$row['subjudul'].'</b><br />').$row['ringkasan'].'...[ <a href="'.$url.'">more</a> ]</div>
					</div>
					<div class="RoundedBoxTRBR5px" id="hlr'.$i.'" style="margin:2px 0;background:#B6B6B6;padding:8px;cursor:Pointer;" onMouseOver="ShowNews('.$i.')">
						<a href="'.$url.'"><b>'.$row['judul'].'</b></a>
					</div>';
				$i++;
}
?>
				<!--<div style="margin:10px 0 0 10px"><a href="<?=site_url('jadwal-acara')?>"><img src="<?=$this->config->item('URL_IMG')?>v9-jadwal.gif" border="0" alt="jadwal acara" title="jadwal acara" /></a></div>-->
				<div style="text-align:center;margin-top:10px;"><a href="/jadwal-acara/"><img src="/img/v9-jadwal-cut.gif" border="0" alt="jadwal acara" title="jadwal acara" /></a><a href="/program-change/"><img src="/img/v9-jadwal-change.gif" border="0" alt="program change" title="program change" /></a></div>
			</div>
			<div style="clear:both"></div>
			<script type="text/javascript">
			var hlactive = 1;
			
			$("#hlBOX").html($("#hl1").html());
			$("#hlr1").css({backgroundColor:"#fff"});
			
			function ShowNews(idx) {
				$("#hlBOX").html($("#hl"+idx).html());
				$("#hlr"+idx).css({backgroundColor:"#fff"});
				
				if (hlactive != idx) {
					$("#hlr"+hlactive).css({backgroundColor:"#B6B6B6"});
					hlactive = idx;
				}
			}
			</script>
		</div>
	</div>
	<div style="float:left;width:300px;">
		<div class="RoundedBox5px" style="background:#B6B6B6;padding:10px;height:320px;">
<?
$query = $this->homepage_model->showWhatsOnTheWeek(1,$strID,3,false,'img_list');
foreach ($query as $row)
{
		if (isset($row['id'])) {		
				$strID .= " and id<>".$row['id'];
				$url = $this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']);
				echo '
				<div class="RoundedBox5px" style="padding:5px;background:#fff;clear:both;margin-top:10px;">
					<a href="'.$url.'"><img src="'.$this->config->item('URL_IMAGES_V09').$row['folder'].'/'.$row['img_list'].'" width="100" height="85" align="left" border="0" alt="'.$row['judul'].'" title="'.$row['judul'].'" style="margin-right:5px;" /></a>
					'.(($row['subjudul'] == "") ? '' : '<div class="SubJudulList">'.$row['subjudul'].'</div>').'
					<a href="'.$url.'"><b>'.$row['judul'].'</b></a>
					<div style="clear:both;"></div>
				</div>';
		}
}
?>			
		</div>
	</div>
	<!-- END ROW 1 -->
	<!-- START ROW 2 -->
	<div style="clear:both;padding-top:10px;"></div>
	<div style="float:right;width:610px;">
		<div style="float:left;width:300px;">
<?
$query = $this->homepage_model->showArticleJenis(12,$strID,4);
foreach ($query as $row)
{
				$strID .= " and id<>".$row['id'];
				$url = $this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']);
				echo '
				<div class="RoundedBox5px" style="padding:5px;background:#fff;clear:both;margin-top:10px;">
					<a href="'.$url.'"><img src="'.$this->config->item('URL_IMAGES_V09').$row['folder'].'/'.$row['img_list'].'" width="100" height="85" align="left" border="0" alt="'.$row['judul'].'" title="'.$row['judul'].'" style="margin-right:5px;" /></a>
					'.(($row['subjudul'] == "") ? '' : '<div class="SubJudulList">'.$row['subjudul'].'</div>').'
					<a href="'.$url.'"><b>'.$row['judul'].'</b></a>
					<div style="clear:both;"></div>
				</div>';
}
?>	
			<div style="margin-top:10px"><?	echo	$this->banner_model->getBanner(304); ?></div>
		</div>
		<div style="float:right;width:300px;">
<?
$query = $this->homepage_model->showWhatsOnTheWeek(1,$strID,2,false,'img_list');
foreach ($query as $row)
{
		if (isset($row['id'])) {		
				$strID .= " and id<>".$row['id'];
				$url = $this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']);
				echo '
				<div style="clear:both;padding:10px 0;border-bottom:1px solid #ccc;">
					<a href="'.$url.'"><img src="'.$this->config->item('URL_IMAGES_V09').$row['folder'].'/'.$row['img_list'].'" width="100" height="85" align="left" border="0" alt="'.$row['judul'].'" title="'.$row['judul'].'" style="margin-right:5px;" /></a>
					'.(($row['subjudul'] == "") ? '' : '<div class="SubJudulList">'.$row['subjudul'].'</div>').'
					<a href="'.$url.'"><b>'.$row['judul'].'</b></a>
					<div style="clear:both"></div>
				</div>';
		}
}
?>						
			<div><?	echo	$this->banner_model->getBanner(318); ?></div>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="float:left;width:300px;">
<?
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and kategori_id=1 $strID order by tgl_robot desc limit 9";
$query = $this->homepage_model->showArticleKategori(1,$strID,9);
foreach ($query as $row)
{
				$strID .= " and id<>".$row['id'];

				echo '
				<div style="padding:5px 10px;margin-bottom:2px;background:#efefef;" class="RoundedBox5px">
					<div class="JenisList">'.$row['jenis_judul'].'</div>
					'.(($row['subjudul'] == "") ? '' : '<div class="SubJudulList">'.$row['subjudul'].'</div>').'
					<a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'"><b>'.$row['judul'].'</b></a>
				</div>';
}
?>
	</div>
	<div style="clear:both"></div>
	<!-- END ROW 2 -->	
	<!-- START ROW 3 -->
	<div style="clear:both;padding-top:10px;"></div>
	<div style="float:left;width:300px;margin-right:10px;">
		<div><a href="<?=site_url('fokus')?>"><img src="<?=$this->config->item('URL_IMG')?>v9-col-fokus.gif" border="0" alt="fokus" title="fokus" /></a></div>
		<div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;" class="ListHomeJudul">
			<ul>
<?
$query = $this->homepage_model->showArticleJenis(5,$strID);
foreach ($query as $row) {
				$strID .= " and id<>".$row['id'];
				echo '
					<li><a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'">'.$row['judul'].'</a></li>';
}
?>
			</ul>
			<div style="margin-top:5px">
				<b>Tags:</b> 
<?
$query = $this->homepage_model->showArticleJenisTag(5);
foreach ($query as $row) {
				$fontsize = rand(1, 5);
				echo '
				<span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$row['tags_url']).'" class="tag'.$fontsize.'" title="'.$row['tags'].'">'.stripslashes($row['tags']).'</a></span> ';
}
?>
			</div>
		</div>
		<div><img src="<?=$this->config->item('URL_IMG')?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
	</div>
	<div style="float:left;width:300px;margin-right:10px;">
		<div><a href="<?=site_url('patroli')?>"><img src="<?=$this->config->item('URL_IMG')?>v9-col-patroli.gif" border="0" alt="patroli" title="patroli" /></a></div>
		<div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;" class="ListHomeJudul">
			<ul>
<?
$query = $this->homepage_model->showArticleJenis(6,$strID);
foreach ($query as $row) {
				$strID .= " and id<>".$row['id'];
				echo '
					<li><a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'">'.$row['judul'].'</a></li>';
}
?>
			</ul>
			<div style="margin-top:5px">
				<b>Tags:</b> 
<?
$query = $this->homepage_model->showArticleJenisTag(6);
foreach ($query as $row) {
				$fontsize = rand(1, 5);
				echo '
				<span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$row['tags_url']).'" class="tag'.$fontsize.'" title="'.$row['tags'].'">'.stripslashes($row['tags']).'</a></span> ';
}
?>
			</div>
		</div>
		<div><img src="<?=$this->config->item('URL_IMG')?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
	</div>
	<div style="float:left;width:300px;">
		<div><a href="<?=site_url('ragam')?>"><img src="<?=$this->config->item('URL_IMG')?>v9-col-ragam.gif" border="0" alt="ragam" title="ragam" /></a></div>
		<div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;" class="ListHomeJudul">
			<ul>
<?
$query = $this->homepage_model->showArticleJenis(3,$strID);
foreach ($query as $row) {
				$strID .= " and id<>".$row['id'];
				echo '
					<li><a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'">'.$row['judul'].'</a></li>';
}
?>
			</ul>
			<div style="margin-top:5px">
				<b>Tags:</b> 
<?
$query = $this->homepage_model->showArticleJenisTag(3);
foreach ($query as $row) {
				$fontsize = rand(1, 5);
				echo '
				<span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$row['tags_url']).'" class="tag'.$fontsize.'" title="'.$row['tags'].'">'.stripslashes($row['tags']).'</a></span> ';
}
?>
			</div>
		</div>
		<div><img src="<?=$this->config->item('URL_IMG')?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
	</div>
	<div style="clear:both"></div>
	<!-- END ROW 3 -->	
</div>
<div class="container" style="background:#E9E9E9">
	<div style="float:left;width:300px;margin-right:10px;">
		<div class="JudulKanal">Kolom</div>
<?
$query = $this->homepage_model->showArticleJenis(7,$strID,8);
foreach ($query as $row)
{
				$strID .= " and id<>".$row['id'];

				echo '
				<div class="ListJudul01">
					<a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'"><b>'.$row['judul'].'</b></a>
				</div>';
}
?>
	</div>
	<div style="float:left;width:300px;margin-right:10px;">
		<div class="JudulKanal">Video Fiesta</div>
<?
$x = 0;
$query = $this->homepage_model->showVideoFiesta('',6);
foreach ($query->result() as $row) {
						echo '
						<div style="float:left;width:139px;height:100px;margin:0 5px 5px 0;padding:3px;background:#fff;">
							<div><a target="_top" href="'.$this->config->item('URL_VIDEOFIESTA').$row->id.'/'.$this->allfunction->judul2url($row->judul).'"><img width="139" src="'.$this->config->item('URL_VIDEOFIESTA_IMAGES').$row->image.'" border="0" alt="'.$row->judul.'" /></a></div>
							<a target="_top" href="'.$this->config->item('URL_VIDEOFIESTA').$row->id.'/'.$this->allfunction->judul2url($row->judul).'" class="JudulSmall">'.$row->judul.'</a>
						</div>';
						$x++;
						if ($x == 2) {
							echo '<div style="clear:both"></div>';
							$x = 0;
						}
}
$query->free_result();
?>
	</div>
	<div style="float:left;width:300px;">
		<div class="JudulKanal">Quick Links</div>
		<div style="float:left;width:48%;" class="footLinkList">
			<ul>
				<li><a href="http://www.indosiar.com/videofiesta">Video Fiesta</a></li>
			</ul>
		</div>
		<div style="float:right;width:48%;">
		</div>
		<div style="clear:both;padding-top:10px;text-align:center;"> 
		  <div><?	echo	$this->banner_model->getBanner(308); ?></div>
		  <div style="margin-top:10px"><?	echo	$this->banner_model->getBanner(305); ?></div>
		</div>
	</div>
<?
include (APPPATH."views/inc_footer.php");
?>