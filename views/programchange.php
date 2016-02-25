<?
$HTMLPageTitle = "Program Change";
$HTMLMetaDescription = "Program Change";
$HTMLMetaKeywords = "Program Change";

include (APPPATH."views/inc_header.php");

echo '
	<div class="content-container">
		<div class="RoundedBox5px" style="font:bold 18px Lucida Sans,Lucida Grande,Trebuchet MS;letter-spacing:-1px;color:#fff;background:#CFCFCF;padding:5px 10px;margin-bottom:10px;">Program Change</div>
';

include ($this->config->item('ROOTBASEPATH')."inc/program_change.php");

if ($progchange_judul != "") {
	echo '
		<h1>'.$progchange_judul.'</h1>
		<p>&nbsp;</p>
		'.$progchange_isi;
}

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