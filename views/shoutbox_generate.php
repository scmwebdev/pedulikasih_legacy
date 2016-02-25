<?
$tmpText = '
<marquee direction="up" height="300" id="ox" onmouseout="ox.start();" onmouseover="ox.stop();" scrollamount="1" scrolldelay="70" truespeed="trueSpeed">';
$sql = "select * from shoutbox where status_aktif=1 and jenis='hut14' order by id desc limit 20";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
	foreach ($query->result() as $row)
	{
			$tmpText .= '
			<div class="shoutbox-list">
				<div class="shoutbox-sender">'.(($row->website != "") ? '<a href="http://'.$row->website.'" target="_blank">'.$row->nama.'</a>' : $row->nama).'</div>
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

redirect("/");
?>