<?
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache"); 

if ($page == "") $page = 1;

$page = (int)$page;
if ($page > 20) $page = 20;
$artikel_id = (int)$artikel_id;

if (is_numeric($artikel_id)) {
	$numRows = $this->article_model->getPagingCommentNumRows($artikel_id);
	$totrecord= $numRows['num_rows'];
	
	if ($totrecord > 0) {
		$totpage = ceil($totrecord/$batas);
		if ($totpage > 1) {
    		$start = (($page - $num_links) > 0) ? $page - ($num_links - 1) : 1;
    		$end   = (($page + $num_links) < $totpage) ? $page + $num_links : $totpage;
    		
    		if ($start == 1) $start = 2;

    		$strurlpage = "";
    		//for ($i = 1; $i <= $totpage; $i++)
    		
    		if  ($page > ($num_links + 1)) $strurlpage .= '<a href="javascript:void(0)" onclick="ShowCommentsList(1)" class="page">first</a>';
    		if  ($page > 1) $strurlpage .= '<a href="javascript:void(0)" onclick="ShowCommentsList('.($page-1).')" class="page">&laquo;</a>';
    		
    		for ($i = $start - 1; $i <= $end; $i++) $strurlpage .= ($page == $i) ? '<span class="page active">'.$i.'</span> ' : '<a href="javascript:void(0)" onclick="ShowCommentsList('.$i.')" class="page">'.$i.'</a>';
		
    		if ($page < $totpage) $strurlpage .= '<a href="javascript:void(0)" onclick="ShowCommentsList('.($page+1).')" class="page">&raquo</a>';
    		if (($page + $num_links) < $totpage) $strurlpage .= '<a href="javascript:void(0)" onclick="ShowCommentsList('.$totpage.')" class="page">last</a>';
    		
    		echo '
    		<style>        
            .pagination {
                background: #f2f2f2;
                padding: 10px;
                text-align: center;
            }
            
            .page {
                display: inline-block;
                padding: 0px 9px;
                margin-right: 4px;
                border-radius: 3px;
                border: solid 1px #c0c0c0;
                background: #e9e9e9;
                box-shadow: inset 0px 1px 0px rgba(255,255,255, .8), 0px 1px 3px rgba(0,0,0, .1);
                font-size: .875em;
                font-weight: bold;
                text-decoration: none;
                color: #717171;
                text-shadow: 0px 1px 0px rgba(255,255,255, 1);
            }
            
            .page:hover {
                background: #fefefe;
                background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FEFEFE), to(#f0f0f0));
                background: -moz-linear-gradient(0% 0% 270deg,#FEFEFE, #f0f0f0);
            }
            
            .page.active {
                border: none;
                background: #616161;
                box-shadow: inset 0px 0px 8px rgba(0,0,0, .5), 0px 1px 0px rgba(255,255,255, .8);
                color: #f0f0f0;
                text-shadow: 0px 0px 3px rgba(0,0,0, .5);
            }
            </style>
    		<div style="margin-bottom:10px;" class="pagination">'.$strurlpage.'</div>';
	    }
	    
	    $query = $this->article_model->showPagingComment($artikel_id,(($page-1)*$batas),$batas);
		foreach ($query->result() as $row)
		{
            $avatar = '/assets/images/logo-96.png';
            if ($row->openid_source == "fb") $avatar = 'http://graph.facebook.com/'.$row->openid_uid.'/picture';
            if ($row->openid_source == "tw") $avatar = 'https://api.twitter.com/1/users/profile_image?screen_name='.$row->openid_uname.'&size=normal';
            
			echo '<div class="commentlistbox"><div style="width:50px;float:left;"><img src="'.$avatar.'" width="50"/></div><div style="width:510px;float:right;">'.nl2br(strip_tags($row->komentar)).'</div><div style="clear:both"></div><cite><span class="time">'.$this->allfunction->UbahTglJam($row->tanggal).'</span> by <span class="author">'.strip_tags($row->nama).'</span></cite></div>';
		}
		
		if ($totpage > 1) {
		    echo '<div style="margin:10px 0;" class="pagination">'.$strurlpage.'</div>';
		}
	}
}
?>
<!--<p align="center">Page rendered in <?=$this->benchmark->elapsed_time();?> seconds - <?=$this->benchmark->memory_usage();?></p>-->