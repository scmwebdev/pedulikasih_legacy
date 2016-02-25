<?
$HTMLPageTitle = "PT. Indosiar Visual Mandiri Memang Untuk Anda | Tv Indonesia";
$HTMLMetaDescription = "PT. Indosiar Visual Mandiri Memang Untuk Anda | Tv Indonesia";
$HTMLMetaKeywords = "Indosiar Community";
		
include (APPPATH."views/inc_header.php");
?>
	<div style="float:right;width:610px;">
		<div class="RoundedBox5px" style="width:590px;background:#E9E9E9;padding:10px;">
			<div class="RoundedBox5px" style="float:left;width:260px;height:300px;padding:10px;background:#fff;"><div id="hlBOX"></div></div>
			<div style="float:left; width:310px;">
				<div style="padding:0 0 5px 10px;" class="JudulKanal">What's On The Week</div>
<?
$strID = "";
$sql = "select id,isi,subjudul,judul,judul_url,ringkasan,jenis_judul,jenis_url,tanggal,img_index,folder,tags,tgl_tayang from ivmweb2009_artikel_data where tgl_tayang<>'0000-00-00 00:00:00' and  UNIX_TIMESTAMP(tgl_robot)>=UNIX_TIMESTAMP() and img_index<>'' and kategori_id=2 order by tgl_robot limit 4";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		$i = 1;
		foreach ($query->result() as $row)
		{
				$array_isi="";
				$strID .= " and id<>".$row->id;
				//$array_isi=explode("<!-- pagebreak -->",$row->isi);
				//if (count($array_isi)==0) {
					$ringkasan=$row->ringkasan;						
				//}else {
				//	$ringkasan=$array_isi[0];
				//}	
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
						<div style="font-size:11px;margin-top:5px;">'.(($row->subjudul == "") ? '' : '<b>'.$row->subjudul.'</b><br />').$ringkasan.'...[ <a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'">more</a> ]</div>
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
<div align=center style="margin-top:10px;"><script src="http://adlink.indosiar.com/inc.php?idc=324" type="text/javascript"></script></div>				
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
		<div><script src="http://adlink.indosiar.com/inc.php?idc=303" type="text/javascript"></script></div>
		<div style="margin-top:10px"><script src="http://adlink.indosiar.com/inc.php?idc=304" type="text/javascript"></script></div>
	</div>
	<div style="clear:both;padding-top:10px;"></div>
	<div style="float:right;width:610px;">
		<div style="float:left;width:300px;">
			<div class="JudulKanal">Sinopsis</div>
<?
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,img_list,folder,tags,tgl_tayang from ivmweb2009_artikel_data where tgl_tayang<>'0000-00-00 00:00:00' and UNIX_TIMESTAMP(tgl_robot)>=UNIX_TIMESTAMP() and img_list<>'' and jenis_id=1 $strID order by tgl_robot limit 3";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$strID .= " and id<>".$row->id;

				echo '
				<div style="clear:both;margin-top:10px;">
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><img src="'.URL_IMAGES_V09.$row->folder.'/'.$row->img_list.'" width="100" height="85" align="left" border="0" alt="'.$row->judul.'" title="'.$row->judul.'" style="margin-right:5px;" /></a>
					'.(($row->subjudul == "") ? '' : '<div class="SubJudulList">'.$row->subjudul.'</div>').'
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><b>'.$row->judul.'</b></a><br />
					<div class="TglTayang">Tayang: '.UbahTglTayang($row->tgl_tayang).'</div>
					<div style="clear:both;"></div>
				</div>';
		}
}
$query->free_result();
?>			
		</div>
		<div style="float:right;width:300px;">
			<script src="http://adlink.indosiar.com/inc.php?idc=328" type="text/javascript"></script>
<?
include (ROOTBASEPATH."inc/program_change.php");
if ($progchange_judul == "") {
	echo '
				<div style="text-align:center;margin-top:10px;"><a href="/jadwal-acara/"><img src="/img/v9-jadwal-cut.gif" border="0" alt="jadwal acara" title="jadwal acara" /></a><a href="/program-change/"><img src="/img/v9-jadwal-change.gif" border="0" alt="program change" title="program change" /></a></div>';
} else {
	echo '<div style="text-align:center;margin-top:10px;"><a href="/jadwal-acara/"><img src="/img/v9-jadwal-cut.gif" border="0" alt="jadwal acara" title="jadwal acara" /></a><a href="/program-change/"><img src="/img/v9-jadwal-change.gif" border="0" alt="program change" title="program change" /></a></div>';
	//echo '<div style="text-align:center;margin-top:10px;"><a href="/jadwal-acara/"><img src="/img/v9-jadwal.gif" border="0" alt="jadwal acara" title="jadwal acara" /></a></div>';
}
?>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="float:left;width:300px;">
<?
$sql = "select id,subjudul,jenis_id,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and kategori_id=1 $strID order by tgl_robot desc limit 5";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$strID .= " and id<>".$row->id;

				echo '
				<div style="padding:5px 10px;margin-bottom:2px;background:#efefef;" class="RoundedBox5px">';
				if ($row->jenis_id==8) {
					echo '<div class="TglTayang">'.UbahTglTayang($row->tanggal).'</div>';
				}	
				echo '
					<div class="JenisList">'.$row->jenis_judul.'</div>
					'.(($row->subjudul == "") ? '' : '<div class="SubJudulList">'.$row->subjudul.'</div>').'
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><b>'.$row->judul.'</b></a>
				</div>';
		}
}
$query->free_result();
?>
		<script src="http://adlink.indosiar.com/inc.php?idc=326" type="text/javascript"></script>
	</div>
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
$gos=1;
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
		<div><a href="<?=site_url('videofiesta')?>"><img src="<?=URL_IMG?>v9-col-kiss.gif" border="0" alt="kiss" title="kiss" /></a></div>
		<div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;">
<?
//$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)>=UNIX_TIMESTAMP() and jenis_id=1 $strID order by tgl_robot limit 5";
$sql="select tblv.*,tblk.kategori from tbl_video as tblv inner join tbl_video_kategori as tblk on tblv.id_kategori=tblk.id and tblk.kategori_url='kiss' order by tblv.id desc limit 7";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				echo '
				<div class="ListJudul01">
					<a href="'.URL_VIDEO.$row->id.'/'.judul2url(htmlentities($row->judul)).'"><b>'.$row->judul.'</b></a>
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
					<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><b>'.$row->judul.'</b> <img src="/img/v9-icon-video.gif" alt="video" border="0" /></a> 
				</div>';
		}
}
$query->free_result();
?>
		</div>
		<div><img src="<?=URL_IMG?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
	</div>
	<div style="clear:both;padding-top:10px;"></div>
	<div style="float:left;width:300px;margin-right:10px;">
		<div><a href="<?=site_url('fokus')?>"><img src="<?=URL_IMG?>v9-col-fokus.gif" border="0" alt="fokus" title="fokus" /></a></div>
		<div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;">
			<div style="padding:10px 0;">
				<b>Tags:</b> 
<?

$sql = "select tags,tags_url from ivmweb2009_artikel_tags where jenis_id=5 group by tags order by rand() limit 10";
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
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id=5 $strID order by tgl_robot desc limit 5";
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
		<div><a href="<?=site_url('patroli')?>"><img src="<?=URL_IMG?>v9-col-patroli.gif" border="0" alt="patroli" title="patroli" /></a></div>
		<div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;">
			<div style="padding:10px 0;">
				<b>Tags:</b> 
<?
$sql = "select tags,tags_url from ivmweb2009_artikel_tags where jenis_id=6 group by tags order by rand() limit 10";
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
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id=6 $strID order by tgl_robot desc limit 5";
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
		<div><a href="<?=site_url('ragam')?>"><img src="<?=URL_IMG?>v9-col-ragam.gif" border="0" alt="ragam" title="ragam" /></a></div>
		<div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;">
			<div style="padding:10px 0;">
				<b>Tags:</b> 
<?
$sql = "select tags,tags_url from ivmweb2009_artikel_tags where jenis_id=3 group by tags order by rand() limit 10";
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
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id=3 $strID order by tgl_robot desc limit 5";
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
	<div style="clear:both"></div>
</div>
<div class="container" style="background:#E9E9E9">
	<div style="float:left;width:300px;margin-right:10px;">
		<div class="JudulKanal">Corporate Info</div>

		<div style="margin-top:10px;">
			<b>Marketing Services</b><br />
			<div style="float:left;width:130px;margin-left:10px;">
				<div class="QuickLinkList"><a href="http://www.indosiar.com/transmisi">Coverage Area</a></div>
			</div>
			<div style="float:left;width:130px;margin-left:20px;">
			</div>
		</div>

		<div style="margin-top:10px;clear:both;">
			<b>Respond Online</b>
			<div style="float:left;width:130px;margin-left:10px;">
				<div class="QuickLinkList"><a href="http://www.indosiar.com/daua">HUMAS</a></div>
				<div class="QuickLinkList"><a href="http://www.indosiar.com/daua">PROGRAMME</a></div>
				<div class="QuickLinkList"><a href="http://www.indosiar.com/daua">NEWS</a></div>
				<div class="QuickLinkList"><a href="http://www.indosiar.com/daua">PRODUKSI</a></div>
				<div class="QuickLinkList"><a href="http://www.indosiar.com/daua">ENGINEERING</a></div>
			</div>
			<div style="float:left;width:130px;margin-left:20px;">
				<div class="QuickLinkList"><a href="http://www.indosiar.com/daua">SALES</a></div>
				<div class="QuickLinkList"><a href="http://www.indosiar.com/daua">MARKETING</a></div>
				<div class="QuickLinkList"><a href="http://www.indosiar.com/daua">FINANCE</a></div>
				<div class="QuickLinkList"><a href="http://www.indosiar.com/daua">WEBADMIN</a></div>
			</div>
		</div>
		<div style="margin-top:10px;clear:both;">
			<b>Peduli Kasih</b>
				<!--<a href="http://www.indosiar.com/pedulikasih/"><img width="80" src="http://www.indosiar.com/pedulikasih/images/stories/pedulikasih/04//tn_FOTO-28.jpg" border="0" alt="" /></a>-->
				<div class="QuickLinkList"><a href="http://www.indosiar.com/peduli-kasih/">Keuangan</a></div>
				<!--<div class="QuickLinkList"><a href="http://www.indosiar.com/pedulikasih/index.php?option=com_content&view=category&layout=blog&id=44&Itemid=66">Rumah Sakit</a></div>
				<div class="QuickLinkList"><a href="http://www.indosiar.com/pedulikasih/">Pasien</a></div>
				<div class="QuickLinkList"><a href="http://www.indosiar.com/pedulikasih/index.php?option=com_joomnik&Itemid=73">Gallery Photo</a></div>-->
		</div>
		<div style="margin-top:10px;clear:both;">
			<b>Kita Peduli</b>
			<div style="float:left;width:130px;margin-left:10px;">
				<a href="http://ww1.indosiar.com/v4/kitapeduli/"><img src="http://ww1.indosiar.com/albumfoto/news/20070212-163317/k_IMG_0051_resize1.jpg" border="0" alt="" /></a>
			</div>
			<div style="float:left;width:130px;margin-left:20px;">
				<a href="http://ww1.indosiar.com/v4/kitapeduli/"><img src="http://ww1.indosiar.com/albumfoto/news/20070212-163317/k_IMG_0020_resize1.jpg" border="0" alt="" /></a>
			</div>
		</div>
		<div style="margin-top:10px;clear:both;">
			<b>Investor Relation</b>
			<div style="float:left;width:130px;margin-left:10px;">
				<div class="QuickLinkList"><a href="http://ww1.indosiar.com/investor/">Corporate Action</a></div>
				<div class="QuickLinkList"><a href="http://ww1.indosiar.com/investor/">Shareholders Meeting</a></div>
			</div>
			<div style="float:left;width:130px;margin-left:20px;">
				<div class="QuickLinkList"><a href="http://ww1.indosiar.com/investor/">News</a></div>
				<div class="QuickLinkList"><a href="http://ww1.indosiar.com/investor/">Financials</a></div>
			</div>
		</div>
	</div>
	<div style="float:left;width:300px;margin-right:10px;">
		<div class="JudulKanal">Video</div>
<?
$sql="select tblv.*,tblk.kategori from tbl_video as tblv inner join tbl_video_kategori as tblk on tblv.id_kategori=tblk.id and tblk.kategori_url='dancing-with-the-stars' order by tblv.id desc limit 6";
//$sql="select tblv.*,tblk.kategori from tbl_video as tblv inner join tbl_video_kategori as tblk on tblv.id_kategori=tblk.id and lower(left(tblv.judul,10))='the dating' order by tblv.id desc limit 2"; 	 
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		$x=0;
		foreach ($query->result() as $row)
		{
						echo '
						<div style="float:left;width:139px;height:120px;margin:0 5px 5px 0;padding:3px;background:#fff;">
							<div><a target="_top" href="'.URL_VIDEO.$row->id.'/'.judul2url(htmlentities($row->judul)).'"><img width="139" src="'.URL_VIDEO_IMAGES.$row->image.'" border="0" alt="'.$row->judul.'" /></a></div>
							<a target="_top" href="'.URL_VIDEO.$row->id.'/'.judul2url(htmlentities($row->judul)).'" class="JudulSmall">'.$row->judul.'</a>
						</div>';
						$x++;
						if ($x==2) {
							echo '<div style="clear:both"></div>';
							$x=0;
						}
						
		}
}
$query->free_result();
/*
//$sql="select tblv.*,tblk.kategori from tbl_video as tblv inner join tbl_video_kategori as tblk on tblv.id_kategori=tblk.id and tblk.kategori_url='lain-lain' order by tblv.id desc limit 2";
$sql="select tblv.*,tblk.kategori from tbl_video as tblv inner join tbl_video_kategori as tblk on tblv.id_kategori=tblk.id and lower(left(tblv.judul,12))='take him out' order by tblv.id desc limit 2"; 	 
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

//$sql="select tblv.*,tblk.kategori from tbl_video as tblv inner join tbl_video_kategori as tblk on tblv.id_kategori=tblk.id and tblk.kategori_url='super_mama' order by tblv.id desc limit 2";
$sql="select tblv.*,tblk.kategori from tbl_video as tblv inner join tbl_video_kategori as tblk on tblv.id_kategori=tblk.id and lower(left(tblv.judul,21))='take me out indonesia' order by tblv.id desc limit 2";
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
*/
?>
	</div>
	<div style="float:left;width:300px;">
		<div class="JudulKanal">Quick Links</div>
		<div style="float:left;width:48%;">
			<div class="QuickLinkList"><a href="http://www.bloggaul.com">Blog Gaul</a></div>
			<div class="QuickLinkList"><a href="http://www.indosiar.com/videofiesta">Video Fiesta</a></div>
		</div>
		<div style="float:right;width:48%;">
		</div>
		<div style="clear:both;padding-top:10px;text-align:center;"> 
		  <div><script src="http://adlink.indosiar.com/inc.php?idc=308" type="text/javascript"></script></div>
		  <div style="margin-top:10px"><script src="http://adlink.indosiar.com/inc.php?idc=305" type="text/javascript"></script></div>
		</div>
	</div>
<?
include (APPPATH."views/inc_footer.php");
?>
<script language="JavaScript" src="http://www.ltassrv.com/serve/api5.4.asp?d=281&s=318&c=1295&v=1"></script>