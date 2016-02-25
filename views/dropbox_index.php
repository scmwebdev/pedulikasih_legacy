<?
include (APPPATH."views/dropbox_header.php");
?>
	<div class="RoundedBox5px" style="margin-bottom:10px;padding:20px;background:#DFDBCB;">
		<div class="RoundedBox5px" style="float:left;width:680px;">
			<div style="margin-bottom:5px;padding:5px;background:#F7EFDF;" class="RoundedBox5px JudulKanal">Resensi Buku</div>
			
<?	
$sql = "SELECT ringkasan,jenis,tanggal,id,subjudul,judul,judul_url,jenis_judul,jenis_url,img_menu,folder,img_artikel FROM ivmweb_artikel_main WHERE UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and img_menu<>'' and kategori=1 and jenis=54 order by tgl_robot desc limit 2";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
					echo '
					<br />
					<a href="'.site_url('/news/'.$row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><img src="'.URL_NEWS_IMAGES.$row->folder.'/'.$row->img_menu.'" border="0" alt="'.$row->judul.'" align="left" style="margin-right:5px" /></a>
					<div class="JudulArtikelList"><a href="'.site_url('/news/'.$row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'" class="JudulArtikelList">'.$row->judul.'</a></div>
					'.$row->ringkasan.'
					<div style="clear:left"></div>
					
					';
		}
}
$query->free_result();
?>
		</div>
		<div class="RoundedBox5px" style="float:right;width:200px;">
			<a href="http://www.indosiar.com/news/buku/77548/perempuan--cerita-dan-cinta"><img src="http://www.indosiar.com/images/news/buku/12300081491.jpg" alt="" border="0" /></a>
		</div>
		<div style="clear:both"></div>
	</div>
	
	<div style="float:left;width:310px;margin-right:10px;">
		<div style="margin-bottom:5px;padding:5px;background:#DFDBCB;" class="RoundedBox5px JudulKanal">Miracle Management</div>
<?
	$koneksidb = mysql_connect ("localhost", "myidc", "ivmindocemen2008");
	if (!$koneksidb) die('Could not connect: ' . mysql_error());
	mysql_select_db("gunadigetol_com") or die ('Can not use gunadigetol_com : ' . mysql_error());
	
	$sql = "select post_title,post_name from wp_posts where post_status = 'publish' order by post_date desc limit 5";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		echo '
		<div style="padding:3px 0;border-bottom:1px dashed #ccc;">
			<a href="http://www.gunadigetol.com/'.$row['post_name'].'">'.$row['post_title'].'</a>
		</div>';
	}
	mysql_free_result($result);
	
	mysql_close($koneksidb);
?>
		
	</div>
	
	<div style="float:left;width:310px;margin-right:10px;">
		<div style="margin-bottom:5px;padding:5px;background:#DFDBCB;" class="RoundedBox5px JudulKanal">Forum Lautan Penulis</div>
		<?=grab_url("http://www.lautanindonesia.com/phpx/ajax_forum_lautan_penulis.php")?>
	</div>
	
	<div style="float:left;width:330px">
		<div style="margin-bottom:5px;padding:5px;background:#DFDBCB;" class="RoundedBox5px JudulKanal">Gallery Photo</div>
<?
$sql = "SELECT a.jenis_url,a.judul,a.judul_url,a.id,p.namafile FROM dropbox_artikel a INNER JOIN dropbox_artikel_photo p ON a.id=p.id_artikel WHERE UNIX_TIMESTAMP(a.tanggal_robot)<=UNIX_TIMESTAMP() and a.jenis_id=2 order by p.id desc limit 8";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
					echo '
					<div style="margin:0 4px; float:left; width:74px;">
						<a href="'.site_url('/dropbox/'.$row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'" title="'.htmlspecialchars($row->judul).'"><img src="/images/dropbox/photo/k_'.$row->namafile.'" border="0" alt="'.htmlspecialchars($row->judul).'" style="padding:1px;border:1px solid #000;" /></a>
					</div>';
		}
}
$query->free_result();
?>
		<div style="clear:both"></div>
	</div>
<?
include (APPPATH."views/dropbox_footer.php");
?>