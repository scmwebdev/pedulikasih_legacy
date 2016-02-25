<?
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache"); 

$artikel_id = $this->uri->segment(2);
$page = $this->uri->segment(3);
$batas = 10;
if ($page == "") $page = 1;

if (is_numeric($artikel_id)) {
		// --- LIST KOMENTAR ---- //
		$sql = "select id from ivmweb_artikel_komentar where id_artikel=$artikel_id";
		$query = $this->db->query($sql);
		$totrecord = $query->num_rows();
		if ($totrecord > 0) {
				$totpage = ceil($totrecord/$batas);
				$strurlpage = "";
				for ($i = 1; $i <= $totpage; $i++) {
						if ($page == $i)
				    	$strurlpage .= " <b>$i</b> ";
				    else
				    	$strurlpage .= " <a href=\"javascript:ShowCommentsList($i)\">$i</a> ";
				}
				
				if ($page == 1)
					$sql = "select nama,komentar,tanggal from ivmweb_artikel_komentar  where id_artikel=$artikel_id order by id desc limit 0, $batas";
				else
					$sql = "select nama,komentar,tanggal from ivmweb_artikel_komentar  where id_artikel=$artikel_id order by id desc limit ". ($page-1) * $batas .", $batas";

				$query = $this->db->query($sql);
				$totresult = $query->num_rows();
				
				$showing = ($page*$batas)-$batas+1;
				$showingto = ($page*$batas)-$batas+$totresult;
			
			  echo "                <table cellpadding=\"3\" width=\"100%\" border=\"0\">";
			  echo "                  <tr>";
			  echo "                    <td align=\"left\">Showing ".$showing." to ".$showingto." of ".$totrecord." comments</td>";
			  echo "                    <td align=\"right\">Page: ".$strurlpage."</td>";
			  echo "                  </tr>";
			  echo "                </table>";
			  
				foreach ($query->result() as $row)
				{
						$pengirim = $row->nama;
						echo '<div style="padding:5 0 5 0; border-top:1px dashed #91C100;"><span class="tgl">'.$this->allfunction->UbahTglJam($row->tanggal).'</span> by <b>'.$pengirim.'</b><br />'.nl2br($row->komentar).'</div>'."\r\n";
				}

		}
		$query->free_result();
		// --- END LIST KOMENTAR ---- //
}
?>
<!--<p align="center">Page rendered in <?=$this->benchmark->elapsed_time();?> seconds - <?=$this->benchmark->memory_usage();?></p>-->