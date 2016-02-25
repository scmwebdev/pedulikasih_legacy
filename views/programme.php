<?
//include (ROOTBASEPATH."inc/index_v09_programme.php");

$HTMLPageTitle = "Informasi Terbaru Indonesia";
$HTMLMetaDescription = "Informasi Terbaru Indonesia";
$HTMLMetaKeywords = "Lautan Indonesia - Indonesian Portal Community";
		
include (APPPATH."views/inc_header.php");
?>
	<div style="float:right;width:610px;">
		<div class="RoundedBox5px" style="width:590px;background:#E9E9E9;padding:10px;">
			<div class="RoundedBox5px" style="float:left;width:260px;height:300px;padding:10px;background:#fff;"><div id="hlBOX"></div></div>
			<div style="float:left; width:310px;">
				<div style="padding:0 0 5px 10px;" class="JudulKanal">What's On The Week</div>
<?
$strID = "";
$sql = "select id,subjudul,judul,judul_url,ringkasan,jenis_judul,jenis_url,tanggal,img_index,folder,tags,tgl_tayang from ivmweb2009_artikel_data where tgl_tayang<>'0000-00-00 00:00:00' and  UNIX_TIMESTAMP(tgl_robot)>=UNIX_TIMESTAMP() and img_index<>'' and kategori_id=2 order by tgl_robot limit 4";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		$i = 1;
		foreach ($query->result() as $row)
		{
				$strID .= " and id<>".$row->id;

				echo '
					<div id="hl'.$i.'" style="display:none;visibility:hidden;">
						<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><div class="SubHeader" style="cursor:Pointer;background:url('.URL_IMAGES_V09.$row->folder.'/'.$row->img_index.') no-repeat top left">
							<div class="SubHeader-BoxM">
								<div class="SubHeader-Box">
									<div class="SubHeader-Judul">'.$row->judul.'</div>
								</div>
							</div>
						</div></a>
						<div style="text-align:center;font-size:11px;">[ Tayang: '.UbahTglTayang($row->tgl_tayang).' ]</div>
						<div style="font-size:11px;margin-top:5px;">'.(($row->subjudul == "") ? '' : '<b>'.$row->subjudul.'</b><br />').$row->ringkasan.'...[ <a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'">more</a> ]</div>
					</div>
					<div class="RoundedBoxTRBR5px" id="hlr'.$i.'" style="margin:2px 0;background:#B6B6B6;padding:8px;cursor:Pointer;" onMouseOver="ShowNews('.$i.')">
						<div style="font-size:10px">'.UbahTglTayang($row->tgl_tayang).'</div>
						<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><b>'.$row->judul.'</b></a>
					</div>
				';
				$i++;
		}
}
$query->free_result();
?>
				<div style="margin:10px 0 0 10px"><a href="<?=site_url('jadwal-acara')?>"><img src="<?=URL_IMG?>v9-jadwal.gif" border="0" alt="jadwal acara" title="jadwal acara" /></a></div>
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
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,img_list,folder,tags,tgl_tayang from ivmweb2009_artikel_data where tgl_tayang<>'0000-00-00 00:00:00' and UNIX_TIMESTAMP(tgl_robot)>=UNIX_TIMESTAMP() and img_list<>'' and jenis_id=1 $strID order by tgl_robot limit 3";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$strID .= " and id<>".$row->id;

				echo '
				<div class="RoundedBox5px" style="padding:5px;background:#fff;clear:both;margin-top:10px;">
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><img src="'.URL_IMAGES_V09.$row->folder.'/'.$row->img_list.'" width="100" height="85" align="left" border="0" alt="'.$row->judul.'" title="'.$row->judul.'" style="margin-right:5px;" /></a>
					'.(($row->subjudul == "") ? '' : '<div class="SubJudulList">'.$row->subjudul.'</div>').'
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><b>'.$row->judul.'</b></a>
					<div class="TglTayang">Tayang: '.UbahTglTayang($row->tgl_tayang).'</div>
					<div style="clear:both;"></div>
				</div>';
		}
}
$query->free_result();
?>			
		</div>
	</div>
	<!-- END ROW 1 -->
	<!-- START ROW 2 -->
	<div style="clear:both;padding-top:10px;"></div>
	<div style="float:left;width:300px;margin-right:10px;">
		<div><a href="<?=site_url('gossip')?>"><img src="<?=URL_IMG?>v9-col-gossip.gif" border="0" alt="gossip" title="gossip" /></a></div>
		<div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;">
			<div style="padding:10px 0;">
				<b>Tags:</b> 
<?
$sql = "select tags,tags_url from ivmweb2009_artikel_tags where jenis_id=2 group by tags order by rand() limit 10";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$fontsize = rand(1, 5);
				echo '
				<span class="tag'.$fontsize.'"><a href="'.site_url('tags/'.$row->tags_url).'" class="tag'.$fontsize.'" title="'.$row->tags.'">'.$row->tags.'</a></span> ';
		}
}
$query->free_result();
?>
		</div>
<?
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id=2 $strID order by tgl_robot desc limit 5";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$strID .= " and id<>".$row->id;

				echo '
				<div class="ListJudul01">
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><b>'.$row->judul.'</b></a>
				</div>';
		}
}
$query->free_result();
?>
		</div>
		<div><img src="<?=URL_IMG?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
	</div>
	<div style="float:left;width:300px;margin-right:10px;">
		<div><a href="<?=site_url('sinopsis')?>"><img src="<?=URL_IMG?>v9-col-sinopsis.gif" border="0" alt="sinopsis" title="sinopsis" /></a></div>
		<div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;">
			<div style="padding:10px 0;">
				<b>Tags:</b> 
<?
$sql = "select tags,tags_url from ivmweb2009_artikel_tags where jenis_id=1 group by tags order by rand() limit 10";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$fontsize = rand(1, 5);
				echo '
				<span class="tag'.$fontsize.'"><a href="'.site_url('tags/'.$row->tags_url).'" class="tag'.$fontsize.'" title="'.$row->tags.'">'.$row->tags.'</a></span> ';
		}
}
$query->free_result();
?>
		</div>
<?
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)>=UNIX_TIMESTAMP() and jenis_id=1 $strID order by tgl_robot limit 5";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$strID .= " and id<>".$row->id;

				echo '
				<div class="ListJudul01">
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><b>'.$row->judul.'</b></a>
				</div>';
		}
}
$query->free_result();
?>
		</div>
		<div><img src="<?=URL_IMG?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
	</div>
	<div style="float:left;width:300px;">
		<div><a href="<?=site_url('talk-show')?>"><img src="<?=URL_IMG?>v9-col-talkshow.gif" border="0" alt="talkshow" title="talkshow" /></a></div>
		<div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;">
			<div style="padding:10px 0;">
				<b>Tags:</b> 
<?
$sql = "select tags,tags_url from ivmweb2009_artikel_tags where jenis_id=4 group by tags order by rand() limit 10";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$fontsize = rand(1, 5);
				echo '
				<span class="tag'.$fontsize.'"><a href="'.site_url('tags/'.$row->tags_url).'" class="tag'.$fontsize.'" title="'.$row->tags.'">'.$row->tags.'</a></span> ';
		}
}
$query->free_result();
?>
		</div>
<?
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id=4 $strID order by tgl_robot desc limit 5";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$strID .= " and id<>".$row->id;

				echo '
				<div class="ListJudul01">
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><b>'.$row->judul.'</b></a>
				</div>';
		}
}
$query->free_result();
?>
		</div>
		<div><img src="<?=URL_IMG?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
	</div>
	<!-- END ROW 2 -->
	<!-- START ROW 3 -->
	<div style="clear:both;padding-top:10px;"></div>
	<div style="float:right;width:610px;">
		<div style="float:left;width:300px;">
			<div><script src="http://adlink.indosiar.com/inc.php?idc=303" type="text/javascript"></script></div>
			<div style="margin-top:10px"><script src="http://adlink.indosiar.com/inc.php?idc=304" type="text/javascript"></script></div>
			<div style="margin-top:10px"><script src="http://adlink.indosiar.com/inc.php?idc=305" type="text/javascript"></script></div>
		</div>
		<div style="float:right;width:300px;">
<?
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,img_list,folder,tags,tgl_tayang from ivmweb2009_artikel_data where img_list<>'' and UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and (jenis_id=2 or jenis_id=4) $strID order by tgl_robot desc limit 4";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$strID .= " and id<>".$row->id;

				echo '
				<div style="clear:both;padding:10px 0;border-bottom:1px solid #ccc;">
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><img src="'.URL_IMAGES_V09.$row->folder.'/'.$row->img_list.'" width="100" height="85" align="left" border="0" alt="'.$row->judul.'" title="'.$row->judul.'" style="margin-right:5px;" /></a>
					'.(($row->subjudul == "") ? '' : '<div class="SubJudulList">'.$row->subjudul.'</div>').'
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><b>'.$row->judul.'</b></a>
					<div style="clear:both"></div>
				</div>';
		}
}
$query->free_result();
?>						
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="float:left;width:300px;">
<?
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and (jenis_id=2 or jenis_id=4) $strID order by tgl_robot desc limit 8";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$strID .= " and id<>".$row->id;

				echo '
				<div style="padding:5px 10px;margin-bottom:2px;background:#efefef;" class="RoundedBox5px">
					<div class="JenisList">'.$row->jenis_judul.'</div>
					'.(($row->subjudul == "") ? '' : '<div class="SubJudulList">'.$row->subjudul.'</div>').'
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><b>'.$row->judul.'</b></a>
				</div>';
		}
}
$query->free_result();
?>
	</div>
	<div style="clear:both"></div>
	<!-- END ROW 3 -->
</div>
<div class="container" style="background:#E9E9E9">
	<div style="float:left;width:300px;margin-right:10px;">
		<div class="JudulKanal">Blog</div>
<?=grab_url("http://ww1.indosiar.com/ajax/ajax_bloggaul.htm")?>
		<div class="JudulKanal">Quick Links</div>
		<div style="float:left;width:48%;">
			<div class="QuickLinkList"><a href="http://www.bloggaul.com">Blog Gaul</a></div>
			<div class="QuickLinkList"><a href="http://www.indosiar.com/videofiesta">Video Fiesta</a></div>
		</div>
		<div style="float:right;width:48%;">&nbsp;</div>
	</div>
	<div style="float:left;width:300px;margin-right:10px;">
		<div class="JudulKanal">Video</div>
<?
$sql="select tblv.*,tblk.kategori from tbl_video as tblv inner join tbl_video_kategori as tblk on tblv.id_kategori=tblk.id and tblk.kategori_url='kiss' order by tblv.id desc limit 4";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
						echo '
						<div style="float:left;width:139px;height:120px;margin:0 5px 5px 0;padding:3px;background:#fff;">
							<div><a target="_top" href="'.URL_VIDEO.$row->id.'/'.judul2url(htmlentities($row->judul)).'"><img width="139" src="'.URL_VIDEO_IMAGES.$row->image.'" border="0" alt="'.$row->judul.'" /></a></div>
							<a target="_top" href="'.URL_VIDEO.$row->id.'/'.judul2url(htmlentities($row->judul)).'" class="JudulSmall">'.$row->judul.'</a>
						</div>';
		}
}
$query->free_result();
?>
	</div>
	<div style="float:left;width:300px;">
		  <div><script src="http://adlink.indosiar.com/inc.php?idc=308" type="text/javascript"></script></div>
		  <div style="margin-top:10px"><script src="http://adlink.indosiar.com/inc.php?idc=305" type="text/javascript"></script></div>
	</div>
<?
include (APPPATH."views/inc_footer.php");
?>
<script language="JavaScript" src="http://www.ltassrv.com/serve/api5.4.asp?d=281&s=318&c=1295&v=1"></script>
?>