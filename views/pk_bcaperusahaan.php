<?php
$sitename = "Peduli Kasih";
$HTMLPageTitle = "Peduli Kasih - Transfer BCA Perusahaan";
$HTMLMetaDescription = "Transfer BCA Perusahaa Peduli Kasih";
$HTMLMetaKeywords = "Transfer BCA Perusahaan, peduli kasih";

include (APPPATH."views/dbpk.php");
include (APPPATH."views/inc_header.php");
include (APPPATH."views/pk_top.php");
?>

	<div class="JudulArtikel">Transfer BCA Perusahaan Peduli Kasih</div>
	<p>&nbsp;</p>

<?
dbconnectpk();
$sql = "select * from jos_content where id=46";
$result = mysql_query($sql);
if (mysql_num_rows($result) > 0) {
	while ($row = mysql_fetch_assoc($result)) {
		echo '
				<div style="padding:10px;margin-bottom:10px;">
					'.$row['introtext'].'
					<div style="clear:both"></div>
				</div>';
	}
}
mysql_free_result($result);
dbclosepk();
include (APPPATH."views/pk_bottom.php");
include (APPPATH."views/inc_footer.php");
?>