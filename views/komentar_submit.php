<?
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache"); 

$artikel_id = $this->input->post('artikel_id', TRUE);
$nama = mysql_escape_string(strip_tags(trim($this->input->post('nama', TRUE))));
$email = mysql_escape_string(trim($this->input->post('email', TRUE)));
$komentar = mysql_escape_string(strip_tags(trim($this->input->post('komentar', TRUE))));

if (is_numeric($artikel_id) && $nama != "" && $email != "" && $komentar != "") {
	$this->load->helper('email');
	if (!valid_email($email)) {
		echo "Invalid email address";
		exit();
	}
		
	require_once(ROOTBASEPATH.'phpx/recaptchalib.php');
	$resp = recaptcha_check_answer (RECAPTCHA_PRIVATE_KEY,$_SERVER["REMOTE_ADDR"],$_POST["recaptcha_challenge_field"],$_POST["recaptcha_response_field"]);

	if (!$resp->is_valid) {
		echo "The Security Code wasn't entered correctly. Go back and try it again.";
		exit();
	}

	$sql = "select 	kategori_id,jenis_id from ivmweb2009_artikel_data where id=$artikel_id";
	$query = $this->db->query($sql);
	if ($query->num_rows() > 0) {
		$row = $query->row();
		
		require_once(ROOTBASEPATH.'phpx/inc_badwords.php');
		$nama = str_ireplace($arrBadWords, '', $nama);
		$komentar = str_ireplace($arrBadWords, '', $komentar);
		
		$DBW = $this->load->database('dbwrite', TRUE);
		$sql = "insert into ivmweb_artikel_komentar (tanggal,id_artikel,kategori,jenis,nama,email,komentar,ip) values (now(),$artikel_id,".$row->kategori_id.",".$row->jenis_id.",'$nama','$email','$komentar','".$_SERVER['REMOTE_ADDR']."')";
		$DBW->query($sql);
		
		echo 'SUKSES';
	} else {
		echo 'Error!';	
	}
	$query->free_result();
}
?>