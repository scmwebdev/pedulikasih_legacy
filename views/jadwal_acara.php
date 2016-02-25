<?
$tgljadwal = date("Y-m-d");
$HTMLPageTitle = "Jadwal Acara";
$HTMLMetaDescription = 'Jadwal Acara '.date("j F Y",strtotime($tgljadwal));
$HTMLMetaKeywords = "Jadwal, Acara";

include (APPPATH."views/inc_header.php");

echo '
	<div class="content-container">
		<h1>Jadwal Acara - '.strtoupper(date("j F Y",strtotime($tgljadwal))).'</h1>
		<br /><br />';
		
		$query = $this->jadwalacara_model->showJadwalAcara($tgljadwal);
		if (count($query) > 0) {
			foreach ($query as $row)
			{
				$dataArticle = $this->jadwalacara_model->getJadwalAcaraArticle($row['tanggal']);
				if (count($dataArticle) > 0) {
					echo '
						<b><span class="tgl">'.date("H:i", strtotime($row['tanggal'])).'</span> - <a href="'.$this->allfunction->makeArticleURL($dataArticle['id'],$dataArticle['judul_url'],$dataArticle['jenis_url']).'">'.$row['keterangan'].'</a></b><hr size=1 noshade />';
				} else {
					echo '
						<span class="tgl">'.date("H:i", strtotime($row['tanggal'])).'</span> - '.$row['keterangan'].'<hr size=1 noshade />';
				}
			}
		} else {
			echo '<p align="center">Jadwal Acara Belum Tersedia</p>';
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