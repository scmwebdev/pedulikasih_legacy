<?
$HTMLPageTitle = 'Index Tags';
$HTMLMetaDescription = 'Index Tags';
$HTMLMetaKeywords = 'Index Tags';

include (APPPATH."views/inc_header.php");

echo '
	<div style="float:left;width:640px;">
			<div class="JenisArtikel RoundedBox5px">Index Tags</div>';

$sql = "select * from ivmweb2009_artikel_jenis";
$query = $this->db->query($sql);
foreach ($query->result() as $row)
{
	echo '
		<div style="padding:10px;background:#efefef;margin-bottom:10px;" class="RoundedBox8px">
			<div class="JudulArtikelList">'.$row->jenis.'</div>
			<div style="text-align:center">';
	
	$sqlx = "select tags,tags_url from ivmweb2009_artikel_tags where jenis_id=".$row->id." group by tags order by rand() limit 100";
	$queryx = $this->db->query($sqlx);
	if ($queryx->num_rows() > 0) {
			foreach ($queryx->result() as $rowx)
			{
					$fontsize = rand(1, 5);
					echo '
					<span class="tag'.$fontsize.'"><a href="'.site_url('tags/'.$rowx->tags_url).'" class="tag'.$fontsize.'" title="'.$rowx->tags.'">'.$rowx->tags.'</a></span> ';
			}
	}
	$queryx->free_result();
	
	echo '
			</div>
		</div>';
}
$query->free_result();


echo '
	</div>
	<div style="float:right;width:260px;">
		<div style="padding:10px;background:#efefef;margin-bottom:10px;" class="RoundedBox8px">
			<b>Tags:</b>';
		
$sql = "select tags,tags_url from ivmweb2009_artikel_tags group by tags order by rand() limit 30";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
				$fontsize = rand(1, 5);
				echo '
				<span class="tag'.$fontsize.'"><a href="'.site_url('tags/'.$row->tags_url).'" class="tag'.$fontsize.'" title="'.$row->tags.'">'.$row->tags.'</a></span> ';
		}
}
$query->free_result();

echo '
		</div>
	</div>
';

include (APPPATH."views/inc_footer.php");
?>