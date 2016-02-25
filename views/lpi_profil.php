<?php
$tim_file = str_replace("_html",".html",$this->uri->segment(3));

if (!file_exists(APPPATH."views/lpi/".$tim_file)) redirect("/lpi/profil");

$tim_nama = str_replace(".html","",$tim_file);
$tim_nama = str_replace("-"," ",$tim_nama);
$tim_nama = ucwords(strtolower($tim_nama));

$sitename = "Liga Primer Indonesia";
$HTMLPageTitle = "Liga Primer Indonesia - $tim_nama";
$HTMLMetaDescription = "Profil Tim $tim_nama Liga Primer Indonesia";
$HTMLMetaKeywords = "$tim_nama, Profil Tim, Primer, Indonesia";

include (APPPATH."views/inc_header.php");
include (APPPATH."views/lpi_top.php");
?>

	<div class="JudulArtikel">Profil Tim <?=$tim_nama?></div>
	<p>&nbsp;</p>
	
<?
echo file_get_contents(APPPATH."views/lpi/".$tim_file);

include (APPPATH."views/lpi_bottom.php");
include (APPPATH."views/inc_footer.php");
?>