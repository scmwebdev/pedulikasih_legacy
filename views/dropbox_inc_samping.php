<style>
.ResensiBuku {margin:20px 0 10px 0;font-weight:bold;font-size:20px;}
.ResensiBukuList {margin-bottom:5px;padding:5px;background:#fff;}
.ResensiBukuList a {text-decoration:none;font-size:11px;font-family:verdana;}
.ResensiBukuList img {background:#DDDCDC;padding:3px;}
</style>	
<div style="padding:10px">
	<div align="center"><img src="http://www.indosiar.com/images/dropbox/logo-elex200.gif" width="200" height="133" /></div>
<?	
$sql = "SELECT jenis,tanggal,id,subjudul,judul,judul_url,jenis_judul,jenis_url,img_menu,folder FROM ivmweb_artikel_main WHERE UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() and img_menu<>'' and kategori=1 and jenis=54 order by tgl_robot desc limit 5";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		echo '
		<div class="ResensiBuku">RESENSI BUKU</div>';
		foreach ($query->result() as $row)
		{
					echo '
					<div class="ResensiBukuList">
							<a href="'.site_url('/news/'.$row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'"><img src="'.URL_NEWS_IMAGES.$row->folder.'/'.$row->img_menu.'" border="0" alt="'.$row->judul.'" align="left" style="margin-right:5px" /></a>
							<a href="'.site_url('/news/'.$row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'">'.$row->judul.'</a>
							<div style="clear:left"></div>
					</div>
					';
		}
}
$query->free_result();
?>
</div>