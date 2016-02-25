<?
echo '
				<div style="margin-bottom:10px">'.$this->banner_model->getBanner(303).'</div>
				<h3>Berita HOT:</h3>
				<ul>';
		
		if (!isset($strID)) $strID = "id<>0";
		$hotArticle = $this->article_model->showHotArticle($strID,10);
		foreach ($hotArticle as $row) {				
			echo '
					<li>'.(($row['subjudul'] == "") ? '' : '<div>'.$row['subjudul'].'</div>').'<a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'" class="ArtikelTerkait">'.$row['judul'].'</a></li>';
			$strID .= " and id<>".$row['id'];
		}

echo '
				</ul>
				<br />
				<div style="padding:10px;background:#efefef;margin-bottom:10px;" class="RoundedBox8px">
					<h3>Random Tags:</3>';
				
		$randomTags = $this->article_model->showRandomTags();
		foreach ($randomTags as $row) {
				$fontsize = rand(1, 5);
				echo '
				<span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$row['tags_url']).'" class="tag'.$fontsize.'" title="'.$row['tags'].'">'.stripslashes($row['tags']).'</a></span> ';
		}

		echo '
				</div>';
?>