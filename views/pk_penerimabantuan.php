<?php
$sitename = "Peduli Kasih";
$HTMLPageTitle = "Peduli Kasih - Daftar Laporan Penerima Bantuan";
$HTMLMetaDescription = "Daftar Laporan Penerima Bantuan Peduli Kasih";
$HTMLMetaKeywords = "Daftar Laporan Penerima Bantuan, peduli kasih";

include (APPPATH."views/dbpk.php");
include (APPPATH."views/inc_header.php");
include (APPPATH."views/pk_top.php");
?>

	<div class="JudulArtikel">Daftar Laporan Penerima Bantuan Peduli Kasih</div>
	<p>&nbsp;</p>

<?
dbconnectpk();
$sql = "select * from jos_content where trim(left(title,31))='Laporan Pasien Penerima Bantuan' and length(trim(introtext))<350 order by id desc limit 40";
$result = mysql_query($sql);
if (mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
		echo '
				<div style="padding:10px;background:#efefef;margin-bottom:10px;" class="RoundedBox8px">
					<div class="JudulArtikelList"><b>'.$row['title'].'</b></div>
					'.utf8_encode($row['introtext']).'
					<div style="clear:both"></div>
				</div>';
	}
}
mysql_free_result($result);
dbclosepk();
include (APPPATH."views/pk_bottom.php");
include (APPPATH."views/inc_footer.php");
?>