<?
//include (ROOTBASEPATH."inc/index_v09_news.php");

$HTMLPageTitle = "Berita Terbaru, Tentang Indonesia, Berita Indonesia";
$HTMLMetaDescription = "Berita Terbaru, Tentang Indonesia, Berita Indonesia";
$HTMLMetaKeywords = "Lautan Indonesia - Indonesian Portal Community";
		
include (APPPATH."views/inc_header.php");
?>
	<div style="float:right;width:610px;">
		<div class="RoundedBox5px" style="width:590px;background:#E9E9E9;padding:10px;">
			<div class="RoundedBox5px" style="float:left;width:260px;height:300px;padding:10px;background:#fff;"><div id="hlBOX"></div></div>
			<div style="float:left; width:310px;">
				<div style="padding:0 0 5px 10px;" class="JudulKanal">News On The Week</div>
<?
$strID = "";
$sql = "select id,subjudul,judul,judul_url,ringkasan,jenis_judul,jenis_url,tanggal,img_index,folder,tags,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and img_index<>'' and kategori_id=1 order by tgl_robot desc limit 4";
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
						<div style="font-size:11px;margin-top:5px;">'.(($row->subjudul == "") ? '' : '<b>'.$row->subjudul.'</b><br />').$row->ringkasan.'...[ <a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'">more</a> ]</div>
					</div>
					<div class="RoundedBoxTRBR5px" id="hlr'.$i.'" style="margin:2px 0;background:#B6B6B6;padding:8px;cursor:Pointer;" onMouseOver="ShowNews('.$i.')">
						<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><b>'.$row->judul.'</b></a>
					</div>
				';
				$i++;
		}
}
$query->free_result();
?>
				<!--<div style="margin:10px 0 0 10px"><a href="<?=site_url('jadwal-acara')?>"><img src="<?=URL_IMG?>v9-jadwal.gif" border="0" alt="jadwal acara" title="jadwal acara" /></a></div>-->
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
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,img_list,folder,tags,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and img_list<>'' and kategori_id=1 $strID order by tgl_robot desc limit 3";
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
	<div style="float:right;width:610px;">
		<div style="float:left;width:300px;">
<?
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,img_list,folder,tags,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id=12 $strID order by tgl_robot desc limit 3";
//$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,img_list,folder,tags,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and img_list<>'' and jenis_id=12 $strID order by tgl_robot desc limit 3";
//$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,img_list,folder,tags,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and img_list<>'' and jenis_id=12 $strID order by id desc limit 3";
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
					<div style="clear:both;"></div>
				</div>';
		}
}
$query->free_result();
?>	
			<div style="margin-top:10px"><script src="http://adlink.indosiar.com/inc.php?idc=304" type="text/javascript"></script></div>
		</div>
		<div style="float:right;width:300px;">
<?
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,img_list,folder,tags,tgl_tayang from ivmweb2009_artikel_data where img_list<>'' and UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and kategori_id=1 $strID order by tgl_robot desc limit 2";
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
			<div><script src="http://adlink.indosiar.com/inc.php?idc=318" type="text/javascript"></script></div>
		</div>
		<div style="clear:both"></div>
	</div>
	<div style="float:left;width:300px;">
<?
$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and kategori_id=1 $strID order by tgl_robot desc limit 9";
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
	<!-- END ROW 2 -->	
	<!-- START ROW 3 -->
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
	<!-- END ROW 3 -->	
</div>
<div class="container" style="background:#E9E9E9">
	<div style="float:left;width:300px;margin-right:10px;">
		<div class="JudulKanal">Kolom</div>
	<?
	$sql = "select id,subjudul,judul,judul_url,jenis_judul,jenis_url,tanggal,tgl_tayang from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id=7 $strID order by tgl_robot desc limit 3";
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
	
	
	$res = mysql_query("select * from poller where kategori='index-news' and status=1");	
	if($inf = mysql_fetch_array($res)){
			$pollerId = $inf["ID"];
			
	?>
				<div class="RoundedBox5px" style="margin-top:10px;background:#ddd;padding:5px;">
					<div class="RoundedBoxTop5px" style="background:#bbb;padding:5px;">Polling</div>
					<div class="RoundedBoxBottom5px" style="background:#fff;padding:5px;">
						

				<form action="<? echo $_SERVER['PHP_SELF']; ?>" onsubmit="return false" method="post" name="frmPoll">
						<!-- START OF POLLER -->
						<div class="pollerx">
						
							<div class="poller_question" id="poller_question<? echo $pollerId; ?>">
							<?			
				
							// Retreving poll from database
							echo "<p class=\"pollerTitle\">".$inf["pollerTitle"]."</p>";	// Output poller title
								
								$resOptions = mysql_query("select * from poller_option where pollerID='$pollerId' order by pollerOrder") or die(mysql_error());	// Find poll options, i.e. radio buttons
								while($infOptions = mysql_fetch_array($resOptions)){
									if($infOptions["defaultChecked"])$checked=" checked"; else $checked = "";
									echo "<p class=\"pollerOption\"><input$checked type=\"radio\" value=\"".$infOptions["ID"]."\" name=\"vote[".$inf["ID"]."]\" id=\"pollerOption".$infOptions["ID"]."\"><label for=\"pollerOption".$infOptions["ID"]."\" id=\"optionLabel".$infOptions["ID"]."\">".$infOptions["optionText"]."</label></p>";	
							
								}
								mysql_free_result($resOptions);
							?><br />			
							<div align="center"><a href="javascript:;" onmousedown="castMyVote(<? echo $pollerId; ?>,document.frmPoll)"><img src="http://www.indosiar.com/images/vote_button.gif" border=0></a></div>
							</div>
							<div class="poller_waitMessage" id="poller_waitMessage<? echo $pollerId; ?>">
								Getting poll results. Please wait...
							</div>
							<div class="poller_results" id="poller_results<? echo $pollerId; ?>">
							<!-- This div will be filled from Ajax, so leave it empty --></div>
						</div>
						<!-- END OF POLLER -->
						<script type="text/javascript">
						if(useCookiesToRememberCastedVotes){
							var cookieValue = Poller_Get_Cookie('dhtmlgoodies_poller_<? echo $pollerId; ?>');
							if(cookieValue && cookieValue.length>0)displayResultsWithoutVoting(<? echo $pollerId; ?>); // This is the code you can use to prevent someone from casting a vote. You should check on cookie or ip address
						
						}
						</script>
				
					<br />
					<br />
				</form>

					</div>
				</div>
				
				<?
				}
				mysql_free_result($res);
				?>

	</div>
	<div style="float:left;width:300px;margin-right:10px;">
		<div class="JudulKanal">Video</div>
<?
$sql="select tblv.*,tblk.kategori from tbl_video as tblv inner join tbl_video_kategori as tblk on tblv.id_kategori=tblk.id order by tblv.id desc limit 6";
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
?>
	</div>
	<div style="float:left;width:300px;">
		<div class="JudulKanal">Quick Links</div>
		<div style="float:left;width:48%;">
			<div class="QuickLinkList"><a href="http://www.bloggaul.com">Blog Gaul</a></div>
		</div>
		<div style="float:right;width:48%;">
			<div class="QuickLinkList"><a href="http://www.indosiar.com/videofiesta">Video Fiesta</a></div>
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
?>