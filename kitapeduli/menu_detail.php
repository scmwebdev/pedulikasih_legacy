<?php
if (count($pk_data) > 0) {
	$sitename = "Kita Peduli";
	$HTMLPageTitle = $pk_data['judul']." - Kita Peduli";
	$HTMLMetaDescription =  $pk_data['judul']." - Kita Peduli";
	$HTMLMetaKeywords =  $pk_data['judul_menu'];
	
	include (APPPATH."views/kitapeduli/header.php");

	echo '
	<h1>'.$pk_data['judul'].'</h1>
	<p>&nbsp;</p>';
		
	echo '
	'.$pk_data['isi'];
	
	include (APPPATH."views/kitapeduli/footer.php");
}
?>