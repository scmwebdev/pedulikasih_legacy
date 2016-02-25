<?php
$sitename = "Liga Primer Indonesia";
$HTMLPageTitle = "Liga Primer Indonesia - Berita";
$HTMLMetaDescription = "Berita Liga Primer Indonesia";
$HTMLMetaKeywords = "Berita, Liga, Primer, Indonesia";

include (APPPATH."views/inc_header.php");
include (APPPATH."views/lpi_top.php");
?>

	<div class="JudulArtikel">Berita Liga Primer Indonesia</div>
	<p>&nbsp;</p>

<?
$sql = "select img_list,jenis_url,folder,id,judul,judul_url,subjudul,ringkasan from ivmweb2009_artikel_data where isi like '%liga primer%' and UNIX_TIMESTAMP(tgl_robot)<=UNIX_TIMESTAMP() order by id desc limit 10";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
	foreach ($query->result() as $row) {
		echo '
				<div style="padding:10px;background:#efefef;margin-bottom:10px;" class="RoundedBox8px">
					'.(($row->subjudul == "") ? '' : '<div class="SubJudulArtikelList">'.$row->subjudul.'</div>').'
					<div class="JudulArtikelList"><a href="'.site_url($row->jenis_url.'/'.$row->id.'/'.$row->judul_url).'" title="'.$row->judul.'"><b>'.$row->judul.'</b></a></div>
					'.(($row->img_list != "" && file_exists(PATH_IMAGES_V09.$row->folder.'/'.$row->img_list)) ? '<img width="100" height="85" src="'.URL_IMAGES_V09.$row->folder.'/'.$row->img_list.'" align="left" alt="" title="" border="0" style="margin-right:5px" />' : '').$row->ringkasan.'
					<div style="clear:both"></div>
				</div>';
	}
}
$query->free_result();

include (APPPATH."views/lpi_bottom.php");
include (APPPATH."views/inc_footer.php");
?>