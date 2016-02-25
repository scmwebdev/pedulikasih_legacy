<?
if ($this->uri->segment(2) == "profil") {
	if ($this->uri->segment(3) == "")
		include (APPPATH."views/lpi_profil_index.php");
	else
		include (APPPATH."views/lpi_profil.php");
} elseif ($this->uri->segment(2) == "berita") {
		include (APPPATH."views/lpi_berita_index.php");
} elseif ($this->uri->segment(2) == "video") {
	if ($this->uri->segment(3) == "")
		include (APPPATH."views/lpi_video_index.php");
	else
		include (APPPATH."views/lpi_video.php");
} else 
	include (APPPATH."views/lpi_home.php");
?>