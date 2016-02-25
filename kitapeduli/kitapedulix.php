<?
if ($this->uri->segment(2) == "berita") { 
		include (APPPATH."views/kitapeduli/kp_berita.php");
} elseif ($this->uri->segment(2) == "bcaperorangan") {
		include (APPPATH."views/kitapeduli/kp_bcaperorangan.php");
} else 
		include (APPPATH."views/kitapeduli/kp_bcaperorangan.php");
?>