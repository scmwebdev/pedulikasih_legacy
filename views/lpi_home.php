<?php
$sitename = "Liga Primer Indonesia";
$HTMLPageTitle = "Liga Primer Indonesia - Jadwal Pertandingan";
$HTMLMetaDescription = "Jadwal Pertandingan Liga Primer Indonesia";
$HTMLMetaKeywords = "Jadwal, Pertandingan, Liga, Primer, Indonesia";

include (APPPATH."views/inc_header.php");
include (APPPATH."views/lpi_top.php");
?>

	<div class="JudulArtikel">Jadwal Pertandingan Liga Primer Indonesia</div>
	<p>&nbsp;</p>
<?
include (ROOTBASEPATH."inc/score_lpi.php");
?>
  <p>&nbsp;</p>
<?
include (APPPATH."views/lpi_bottom.php");
include (APPPATH."views/inc_footer.php");
?>