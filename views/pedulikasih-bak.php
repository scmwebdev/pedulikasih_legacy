<?
$HTMLPageTitle = "Peduli Kasih";
$HTMLMetaDescription = "Peduli Kasih Indosiar";
$HTMLMetaKeywords = "peduli kasih,humanity";

include (APPPATH."views/inc_header.php");
?>

	<div style="float:left;width:600px;">
		<div class="JenisArtikel RoundedBox5px">Peduli Kasih</div>
		<div class="JudulArtikel">Report BCA</div>
		<p>&nbsp;</p>
		<iframe src="/pedulikasih/phpx/reportbca.php" width="100%" height="700" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>
	</div>
	<div style="float:right;width:300px;">

<?
include (APPPATH."views/inc_sidecontent.php");

echo '
	</div>
	<div style="clear:both"></div>
';

include (APPPATH."views/inc_footer.php");
?>