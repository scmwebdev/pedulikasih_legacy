<?
if ($this->uri->segment(2) == "berita") {
		include (APPPATH."views/pk_berita.php");
} elseif ($this->uri->segment(2) == "penerimabantuan") {
		include (APPPATH."views/pk_penerimabantuan.php");
} elseif ($this->uri->segment(2) == "rumahsakit") {
		include (APPPATH."views/pk_rumahsakit.php");
} elseif ($this->uri->segment(2) == "bcaperorangan") {
		include (APPPATH."views/pk_bcaperorangan.php");
} elseif ($this->uri->segment(2) == "bcaperusahaan") {
		include (APPPATH."views/pk_bcaperusahaan.php");
} else 
		include (APPPATH."views/pk_bcaperorangan.php");
?>