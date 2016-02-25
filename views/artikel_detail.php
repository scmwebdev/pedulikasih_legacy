<?
session_start();
$sql = "select * from ivmweb2009_artikel_data where id=$artikel_id";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		$row = $query->row();
		$artikel_id = $row->id;
		$artikel_judul = $row->judul;
		$artikel_judul_url = $row->judul_url;
		$artikel_subjudul = $row->subjudul;
		$artikel_isi = stripslashes($row->isi);
		$artikel_jenis_id = $row->jenis_id;
		$artikel_img_artikel = $row->img_artikel;
		$artikel_img_list = $row->img_list;
		$artikel_img_index = $row->img_index;
		$artikel_tanggal = $row->tanggal;
		$artikel_tanggal_tayang = $row->tgl_tayang;
		$artikel_tags = trim($row->tags);
		$artikel_folder = $row->folder;
		
		$HTMLPageTitle = $artikel_judul.(((strlen($artikel_judul)+strlen($artikel_jenis_judul)+3) <= 62) ? " - $artikel_jenis_judul" : "");
		$HTMLMetaDescription = $row->ringkasan;
		$HTMLMetaKeywords = $artikel_tags;

		//$this->db->query("update ivmweb2009_artikel_data set counter=counter+1 where id=".$artikel_id);
} else {
	redirect($artikel_jenis_url);
}
$query->free_result();

include (APPPATH."views/inc_header.php");

		echo '
		<div class="content-container">
			<div class="RoundedBox5px" style="font:bold 18px Lucida Sans,Lucida Grande,Trebuchet MS;letter-spacing:-1px;color:#fff;background:#CFCFCF;padding:5px 10px;margin-bottom:10px;">'.strtoupper($artikel_jenis_judul).'</div>
		';
		if ($artikel_subjudul != "") echo '<div class="SubJudulArtikel">'.$artikel_subjudul.'</div>'."\r\n";
		echo '
			<h1>'.$artikel_judul.'</h1>
			'.(($artikel_tanggal_tayang == "0000-00-00 00:00:00") ? '' : 'Tayang: '.$this->allfunction->UbahTglTayang($artikel_tanggal_tayang)).'<br /><br />
		';
		
		$strDivKiri = "";
		$strID = " id<>".$artikel_id;
		
		if ($artikel_img_artikel != "") {
			echo '
			<div class="FloatArtikelDetail RoundedBox8px">
				<div align="center"><img src="'.$this->config->item('URL_IMAGES_V09').$artikel_folder.'/'.$artikel_img_artikel.'" /></div>
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
					$tags_url .= '<span class="tag'.$fontsize.'"><a href="'.site_url('tags/'.$this->allfunction->judul2url($val)).'" class="tag'.$fontsize.'" title="'.$val.'">'.str_replace("\\","",$val).'</a></span> ';
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
			
			$sql = "select id,judul,judul_url,jenis_url from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and $strID and ($tags_sql) order by tgl_robot desc limit 3";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {			
				echo '
					<h2>Baca Juga:</h2>
					<ul>
				';
				foreach ($query->result() as $row)
				{
					echo '
						<li><a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'" class="ArtikelTerkait">'.$row->judul.'</a></li>
					';
					$strID .= " and id<>".$row->id;
				}
			}
			$query->free_result();
			
			echo '
					</ul>
					<br />
					<h2>Tags:</h2> '.$tags_url.'<br /><br />';

/*
			$sql = "select tags,tags_url from ivmweb2009_artikel_tags where data_id=$artikel_id group by tags order by rand() limit 10";
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
*/

			//echo '
			//		</div>
			//	</div>
			//';
		}
		// END TAGS //
		
		$sql = "select id,jenis_url,subjudul,judul,judul_url,jenis_url from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and $strID order by tgl_robot desc limit 5";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			if ($strDivKiri == "") {
				echo '
				<div class="FloatArtikelDetail RoundedBox8px">
				';
				$strDivKiri = 1;
			}
			
			echo '
				<div style="margin-top:5px; padding:5px; border:1px solid #ccc;">
					<h2>Berita HOT:</h2>
					<ul>
			';
			foreach ($query->result() as $row)
			{
				
				echo '
						<li>'.(($row->subjudul == "") ? '' : '<div>'.$row->subjudul.'</div>').'<a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'" class="ArtikelTerkait">'.$row->judul.'</a></li>
				';
				$strID .= " and id<>".$row->id;
			}
			echo '
					</ul>
				</div>
			';
		}
		$query->free_result();
			
		if ($strDivKiri != "") echo "</div>\n";
		
		$artikel_isi = str_replace(array("../../swf/",'\\',"indosiar.com/video/","http://www.indosiar.com/swf/jw/player.swf?"), array("/swf/","","indosiar.com/static/video/","http://player.longtailvideo.com/player.swf?autostart=true&skin=http://content.longtailvideo.com/skins/glow/glow.zip&"), $artikel_isi);
		$r = array('src="images/', 'src="../images/"', 'src="../../images/"');
		echo str_replace($r,'src="'.$this->config->item('URL_IMAGES_V09'),$artikel_isi)."\r\n";
		echo ($artikel_tanggal_tayang == "0000-00-00 00:00:00") ? '' : '<br /><b>Tayang: '.UbahTglTayang($artikel_tanggal_tayang).'</b><br /><br />';

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
						</div><div style="clear:both"></div><br><br>';
						
				}
				$query->free_result();	
		}					
?>
		<div><!-- AddThis Button BEGIN -->
<script type="text/javascript">var addthis_pub="kewell";</script>
<a href="http://www.addthis.com/bookmark.php?v=20" onmouseover="return addthis_open(this, '', 'http://<?=$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']?>', '<?=$artikel_judul?>')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/200/addthis_widget.js"></script>
<!-- AddThis Button END -->
	</div>
			<div style="clear:both"></div>
			<br /><br />
			<div style="padding:10px;border:1px solid #ccc;">
				<div id="theArtikelComments">
<?
		// --- LIST KOMENTAR ---- //
		$batas = 10;
		$page = 1;
		$sql = "select id from ivmweb_artikel_komentar where id_artikel=$artikel_id";
		$query = $this->db->query($sql);
		$totrecord = $query->num_rows();
		if ($totrecord > 0) {
				$totpage = ceil($totrecord/$batas);
				$strurlpage = "";
				for ($i = 1; $i <= $totpage; $i++) {
						if ($page == $i)
				    	$strurlpage .= " <b>$i</b> ";
				    else
				    	$strurlpage .= " <a href=\"javascript:ShowCommentsList($i)\">$i</a> ";
				}
				
				if ($page == 1)
					$sql = "select nama,komentar,tanggal from ivmweb_artikel_komentar  where id_artikel=$artikel_id order by id desc limit 0, $batas";
				else
					$sql = "select nama,komentar,tanggal from ivmweb_artikel_komentar  where id_artikel=$artikel_id order by id desc limit ". ($page-1) * $batas .", $batas";

				$query = $this->db->query($sql);
				$totresult = $query->num_rows();
				
				$showing = ($page*$batas)-$batas+1;
				$showingto = ($page*$batas)-$batas+$totresult;
			
			  echo "                <table cellpadding=\"3\" cellspacing=\"0\" width=\"100%\" border=\"0\" style=\"background:#efefef\">";
			  echo "                  <tr>";
			  echo "                    <td align=\"left\">Showing ".$showing." to ".$showingto." of ".$totrecord." comments</td>";
			  echo "                    <td align=\"right\">Page: ".$strurlpage."</td>";
			  echo "                  </tr>";
			  echo "                </table>";
			  
				foreach ($query->result() as $row)
				{
						$pengirim = $row->nama;
						$row->komentar=str_replace("<","&lt;",$row->komentar);
						$row->komentar=str_replace(">","&gt;",$row->komentar);
						echo '<div style="padding:5px 0; border-top:1px dashed #91C100;"><span class="tgl">'.$this->allfunction->UbahTglJam($row->tanggal).'</span> by <b>'.$pengirim.'</b><br />'.nl2br($row->komentar).'</div>'."\r\n";
				}

				echo '<p>&nbsp;</p>';
		}
		$query->free_result();
		// --- END LIST KOMENTAR ---- //
?>
				</div>
									
	        <div style="padding:10px;background:#efefef;" id="CommentsBoxInput" class="RoundedBox8px">
							<form action="<?=site_url("komentarsubmit")?>" method="post" name="frmArtikelKomentar" id="frmArtikelKomentar"> 
		        <table border="0" cellpadding="2" cellspacing="0" align="center">
		      		<input name="artikel_id" type="hidden" value="<?=$artikel_id?>" />
		      		<tr>
		            <td><b>Nama:</b></td><td><input type="text" name="nama" size="40" /></td>
		          </tr>
		          <tr>
		            <td><b>Email:</b></td><td><input type="text" name="email" size="40" /></td>
		          </tr>
		          <tr>
		            <td colspan="2"><textarea id="komentar" name="komentar" cols="60" rows="5"></textarea></td>
		          </tr>
					<tr>
					<td valign="top"><b>Security Code:</b></td>
		            <td>
        <?php
          require_once($this->config->item('ROOTBASEPATH').'phpx/recaptchalib.php');
          echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
        ?>
		            </td>
		          </tr>
		          <tr>
		            <td colspan="2">
		              <div align="center"><br /><input type="submit" name="Submit" value="Kirim Komentar" /></div>
		            </td>
		          </tr>
		        </table>
				</form>
		      </div>
       </div>

				<script type="text/javascript" src="<?=$this->config->item('URL_JS')?>jquery.form.js"></script>
				<script type="text/javascript" src="<?=$this->config->item('URL_JS')?>jquery.blockUI.js"></script>
				<script language="javascript">
				$().ajaxStop($.unblockUI); 
				
				$(document).ready(function() {        
				    $('#frmArtikelKomentar').ajaxForm({
				        beforeSubmit: function(a,f,o) {
								    var theForm = f[0]; 
								    if (!theForm.komentar.value || !theForm.nama.value || !theForm.email.value) { 
								        alert('Semua field harus terisi!'); 
								        return false; 
								    }
								    
				            o.dataType = 'html';
				            $('#CommentsBoxInput').block(); 
				        },
				        success: function(data) {
										if (typeof data == 'object' && data.nodeType)
								        data = elementToString(data.documentElement, true);
								    else if (typeof data == 'object')
								        data = objToString(data);    

							    if (data == "SUKSES") {
							    	ShowCommentsList(1);
							    	$("#frmArtikelKomentar").clearForm();
							    	alert('Thank you');
							    } else {
							    	alert("Error:\n" + data);
							    }										

							    Recaptcha.reload();
								$('div#CommentsBoxInput').unblock();
				        }
				    });
				}); 
				
				function ShowCommentsList(page) {
					 
					 surl = "<?=site_url('komentarlist')."/"?>" + <?=$artikel_id?> + "/" + page;
					 $.ajax({
					   type: "GET",
					   url: surl,
					   dataType: "html",
					   beforeSend: function(){
								$('div#theArtikelComments').block('<b>Processing</b>', { border: '3px solid #1F4266' }); 
					   },
					   success: function(msg){
						   	$("#theArtikelComments").html(msg);
						   	$('div#theArtikelComments').unblock(); 
					   }
					 });
				}
						
				//ShowCommentsList(1);
				//ShowIklanKolomList();
				</script>
<?
		echo '
			</div>
			<div class="side-container">
				<div style="margin-bottom:10px"><script src="http://adlink.indosiar.com/inc.php?idc=303" type="text/javascript"></script></div>
				<div style="margin-bottom:10px"><script src="http://adlink.indosiar.com/inc.php?idc=328" type="text/javascript"></script></div>
		';

		// --- ARTIKEL LAINNYA ---- //
		$sql = "select id,judul,subjudul,judul_url from ivmweb2009_artikel_data where UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and jenis_id=$artikel_jenis_id and $strID order by tgl_robot desc limit 10";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
				echo '
						<h3>More '.strtoupper($artikel_jenis_judul).':</h3>
						<ul>';
	
				foreach ($query->result() as $row)
				{
						echo '<li>'.(($row->subjudul == "") ? '' : $row->subjudul.'<br />').'<a href="'.site_url($artikel_jenis_url.'/'.$row->id.'/'.$row->judul_url).'">'.$row->judul.'</a></li>';
				}
				
				echo '
						</ul>
						<div align="right">[ <a href="'.site_url($artikel_jenis_url).'">more '.$artikel_jenis_judul.'</a> ]</div>
						<br />
					';
		}
		$query->free_result();
		// --- END ARTIKEL LAINNYA ---- //
		

		echo '
				<div style="padding:10px;background:#efefef;margin-bottom:10px;" class="RoundedBox8px">
					<h3>Random Tags</h3>';
				
		$sql = "select tags,tags_url from ivmweb2009_artikel_tags group by tags order by rand() limit 30";
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

		echo '
				</div>
			</div>
			<div style="clear:both"></div>
		';
?>

<script language="javascript">
var w=screen.width;
var h=screen.height;
var r=document.referrer;
document.write('<ifr'+'ame src='+'"/phpx/stats.php?d=<?=$artikel_id?>&amp;w='+w+'&amp;h='+h+'&amp;r='+r+'"'+' marginwidth="0" marginheight="0" width='+'"1"'+' height='+'"1"'+' border="0" frameborder="0" style="border:none;" scrolling="no"></iframe>');
</script>

<?			
include (APPPATH."views/inc_footer.php");
?>