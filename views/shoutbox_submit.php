<?
if (!isset($_REQUEST['SBKomentar']) || empty($_REQUEST['SBKomentar'])) {
	echo "Error!";
} else {
	$komentar = strip_tags(mysql_escape_string(trim($_REQUEST['SBKomentar'])));
	$nama 		= strip_tags(mysql_escape_string(trim($_REQUEST['SBNama'])));
	$email 		= strip_tags(mysql_escape_string(trim($_REQUEST['SBEmail'])));
	$website 	= strip_tags(mysql_escape_string(trim($_REQUEST['SBWebsite'])));
	
	if ($nama == "" || $komentar == "" || $email == "") {
		echo "Tanda * harus terisi";
	} elseif (!checkemail($email)) {
		echo "Alamat email tidak valid";
	} else {
		$sql 			= "INSERT INTO shoutbox (jenis,tanggal,nama,email,website,komentar) VALUES ('hut14',now(),'$nama','$email','$website','$komentar')";
		$this->db->query($sql);
		
		/*
		$tmpText = '
		<marquee direction="up" height="300" id="ox" onmouseout="ox.start();" onmouseover="ox.stop();" scrollamount="1" scrolldelay="70" truespeed="trueSpeed">';
		$sql = "select * from shoutbox where jenis='hut14' order by id desc limit 20";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row)
			{
				$tmpText .= '
				<div class="shoutbox-list">
					<div class="shoutbox-sender">'.$row->nama.'</div>
					'.$row->komentar.'
					<div class="shoutbox-tgl">'.UbahTglJam($row->tanggal).'</div>
				</div>';
			}
		}
		$query->free_result();
		
		$tmpText .= '</marquee>';
		
		
		$resource = fopen(ROOTBASEPATH."inc/shoutbox.php","w");
		fwrite($resource,$tmpText);
		fclose($resource);
		*/
		echo "SUKSES";
	}
}
?>