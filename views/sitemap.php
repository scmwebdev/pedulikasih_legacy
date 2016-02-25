<?php
$sitename = "home";
$HTMLPageTitle = "Site Map";
include (APPPATH."views/inc_header.php");

echo '
	<div class="content-container">
<h1>Site Map</h1>
<br />
<ul>
	<li>
		<a href="'.site_url('berita').'">BERITA</a>';
	
$sql = "select jenis,jenis_url from ivmweb2009_artikel_jenis where kategori_id=1";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
	echo '
		<ul>';

	foreach ($query->result() as $row)
	{
		echo '
			<li><a href="'.site_url($row->jenis_url).'">'.$row->jenis.'</a></li>
		';
	}
	echo '
		</ul>';
}
$query->free_result();

echo '
	</li>
	<li>
		<a href="'.site_url('info-dari-anda').'">INFO DARI ANDA</a>';
		
$sql = "select jenis,jenis_url from ivmweb2009_artikel_jenis where kategori_id=2";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
	echo '
		<ul>';

	foreach ($query->result() as $row)
	{
		echo '
			<li><a href="'.site_url($row->jenis_url).'">'.$row->jenis.'</a></li>
		';
	}
	echo '
		</ul>';
}
$query->free_result();



echo '
	</li>
	<li><a href="'.site_url('daua').'">RESPOND ONLINE</a></li>
	<li><a href="'.site_url('investor').'">INVESTOR RELATION</a></li>
	<li><a href="'.site_url('pedulikasih').'">PEDULI KASIH</a></li>
	<li><a href="'.site_url('kitapeduli').'">KITA PEDULI</a></li>
	<li><a href="'.site_url('videofiesta').'">VIDEO FIESTA</a></li>
	<li><a href="http://m.indosiar.com">MOBILE VERSION</a></li>
</ul>';

echo '
	</div>
	<div class="side-container">';

include (APPPATH."views/inc_sidecontent.php");

echo '
	</div>
	<div style="clear:both"></div>
';

include (APPPATH."views/inc_footer.php");
?>