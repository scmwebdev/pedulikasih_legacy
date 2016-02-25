<?
if (!isset($_REQUEST['nama']) || empty($_REQUEST['nama']) || !isset($_REQUEST['subjek']) || empty($_REQUEST['subjek']) || !isset($_REQUEST['pertanyaan']) || empty($_REQUEST['pertanyaan'])) {
	echo "Error!";
} else {
	$pertanyaan = strip_tags(mysql_escape_string(trim($_REQUEST['pertanyaan'])));
	$nama 		= strip_tags(mysql_escape_string(trim($_REQUEST['nama'])));
	$subjek 		= strip_tags(mysql_escape_string(trim($_REQUEST['subjek'])));
	$to 	= strip_tags(mysql_escape_string(trim($_REQUEST['to'])));
	$email 	= strip_tags(mysql_escape_string(trim($_REQUEST['email'])));	
	if (isset($_REQUEST['no_email'])) {
		$no_email 	= trim($_REQUEST['no_email']);
	}else {
		$no_email 	= "1";
	}
	$alamat 	= strip_tags(mysql_escape_string(trim($_REQUEST['alamat'])));
	
	$kota 	= strip_tags(mysql_escape_string(trim($_REQUEST['kota'])));  
	$kota_lain 	= strip_tags(mysql_escape_string(trim($_REQUEST['kota_lain'])));
	if ($kota_lain!="") {
		$kota=$kota_lain;
	}
	$kodepos 	= strip_tags(mysql_escape_string(trim($_REQUEST['kodepos'])));
	$telepon 	= strip_tags(mysql_escape_string(trim($_REQUEST['telepon'])));

	
	if ($nama == "" || $pertanyaan == "" || $subjek == "") {
		echo "Tanda * harus terisi";
	} elseif (!$this->allfunction->checkemail($email)) {
		echo "Alamat email tidak valid";
	} else {
		$sql 			= "INSERT INTO newdaua (tanggal,dari,subject,email,pertanyaan,kepada,ip,kota,telp,alamat,kodepos,email_tampil) VALUES (now(),'$nama','$subjek','$email','$pertanyaan','$to','".$_SERVER['REMOTE_ADDR']."','$kota','$telepon','$alamat','$kodepos',$no_email)";
		$this->db->query($sql);
		echo "SUKSES";
	}
}
?>