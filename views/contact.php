<?
$HTMLPageTitle = "Kontak Indosiar";
$HTMLMetaDescription = "Contact Us";
$HTMLMetaKeywords = "Contact Us";

include (APPPATH."views/inc_header.php");

echo '
	<div class="content-container">
		<h1>Contact Us</h1>
		<p>
			<div class="JudulArtikel">PT. Indosiar Visual Mandiri</div>
			National Television Broadcasting Station<br />
			Jl. Damai No. 11 daan Mogot, Jakarta 11510 - Indonesia<br />
			Telp : (62-21) 567-2222, 568-8888<br />
			Fax  : (62-21) 565-5756<br />
			<a href="http://www.indosiar.com">www.indosiar.com</a>
		</p>
	
';


echo '
	</div>
	<div class="side-container">';

include (APPPATH."views/inc_sidecontent.php");

echo '
	</div>
	<div style="clear:both"></div>';

include (APPPATH."views/inc_footer.php");
?>