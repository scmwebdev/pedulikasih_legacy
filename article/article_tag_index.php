<?
$HTMLPageTitle = 'Index Tags';
$HTMLMetaDescription = 'Index Tags';
$HTMLMetaKeywords = 'Index Tags';
$HTMLCanonical = site_url('tag');

include (APPPATH."views/inc_header.php");

echo '
	<div class="content-container">
			<h1>Index Tags</h1>
			<br /><br />';

$query = $this->article_model->getAllArticleJenis();
foreach ($query->result() as $row)
{
	echo '
		<div class="ContentJenisList RoundedBox8px">
			<h2><a href="'.site_url($row->jenis_url).'">'.$row->jenis.'</a></h2>
			<div style="text-align:center">';
	
	$queryx = $this->article_model->getAllArticleJenisTag($row->id);
	foreach ($queryx->result() as $rowx){
			$fontsize = rand(1, 5);
			echo '
			<span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$rowx->tags_url).'" class="tag'.$fontsize.'" title="'.$rowx->tags.'">'.stripslashes($rowx->tags).'</a></span> ';
	}
	
	echo '
			</div>
		</div>';
}

echo '
	</div>
	<div class="side-container">';
	
include (APPPATH."views/inc_sidecontent.php");

echo '
	</div>
	<div style="clear:both"></div>';

include (APPPATH."views/inc_footer.php");
?>