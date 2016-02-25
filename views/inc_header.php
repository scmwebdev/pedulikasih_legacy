<?php
$HTMLPageTitle          = (isset($HTMLPageTitle)) ? htmlspecialchars(character_limiter(strip_tags(trim($HTMLPageTitle)),69,''),ENT_QUOTES) : "";
$HTMLPageImage          = (isset($HTMLPageImage)) ? $HTMLPageImage : base_url().'assets/images/logo-96.png';
$HTMLMetaDescription    = (isset($HTMLMetaDescription)) ? htmlspecialchars(strip_tags($HTMLMetaDescription),ENT_QUOTES) : "";
$HTMLMetaKeywords       = (isset($HTMLMetaKeywords)) ? htmlspecialchars($HTMLMetaKeywords,ENT_QUOTES) : "";
$curURL = (isset($HTMLCanonical)) ? $HTMLCanonical : 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<title><?=$HTMLPageTitle?></title>
<meta name="description" content="<?=$HTMLMetaDescription?>" />
<meta name="keywords" content="<?=$HTMLMetaKeywords?>" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="all" />
<meta name="google-site-verification" content="YCqKTsMAsI6Feo3WXhb5r5zzmOBQ4XSK01PMc-yl6Mk" />
<meta name="msvalidate.01" content="77115FB9ED53BA8A1529A3F0027F1D89" />
<meta name="alexaVerifyID" content="QacCy0qo5dixE383QtjSPHXcXNU" />
<meta property="fb:app_id"      content="209188075876033" />
<meta property="og:site_name"   content="INDOSIAR.COM" />
<meta property="og:type"        content="article" />
<meta property="og:url"         content="<?=$curURL?>" />
<meta property="og:title"       content="<?=$HTMLPageTitle?>" />
<meta property="og:description" content="<?=$HTMLMetaDescription?>" />
<meta property="og:image"       content="<?=$HTMLPageImage?>" />
<?
if (isset($HTMLCanonical) && $HTMLCanonical != site_url($_SERVER['REQUEST_URI'])) echo '<link rel="canonical" href="'.$HTMLCanonical.'" />'."\r\n";
?>
<link rel="SHORTCUT ICON" type="image/x-icon" href="/favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="Indosiar" href="<?=site_url()?>rss" />
<link rel="stylesheet" href="/css/v09.css?v2" type="text/css">
<link rel="stylesheet" href="/assets/css/fb.css?v1" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery.corner.js"></script>
<script type="text/javascript">
$(function(){
    $('div.RoundedBox5pxBorder').wrap('<div class="RoundedBoxOuter"></div>');
    $("div.RoundedBox5pxBorder").corner("round 5px").parent().css('padding', '1px').corner("round 6px")
    $('div.RoundedBox8pxBorder').wrap('<div class="RoundedBoxOuter"></div>');
    $("div.RoundedBox8pxBorder").corner("round 7px").parent().css('padding', '1px').corner("round 8px")    
    $("div.RoundedBox5px").corner("5px");
    $("div.RoundedBox8px").corner("8px");
    $("div.RoundedBoxTop5px").corner("top 5px");
    $("div.RoundedBoxBottom5px").corner("bottom 5px");
    $("div.RoundedBoxTRBR5px").corner("tr 5px").corner("br 5px");
    $("div.RoundedBoxTLBLBR5px").corner("tl 5px").corner("bl 5px").corner("br 5px");
});

var base_url 		= '<?=base_url()?>';
var cur_url			= '<?=$curURL?>';
var page_title	    = '<?=$HTMLPageTitle?>';
var page_desc		= '<?=$HTMLMetaDescription?>';
var page_image	    = '<?=$HTMLPageImage?>';
var page_id	        = <?=(isset($page_id)) ? $page_id : '0'?>;
var perms 			= ['email','publish_actions','publish_stream','read_stream','read_friendlists','user_birthday','user_likes','user_online_presence','user_actions.news','user_actions.video'];
var auth_url 		= 'https://www.facebook.com/dialog/oauth?client_id=209188075876033&redirect_uri=<?=urlencode($curURL)?>&scope=' + perms.join(',') + '&response_type=token';
var fbAppID         = '209188075876033';
var fbUserID 		= '';
var fbUserToken	    = '';
var isNewsReads	    = <?=(isset($isNewsReads)) ? 'true' : 'false'?>;
var isVideoWatches	= <?=(isset($isVideoWatches)) ? 'true' : 'false'?>;
</script>
</head>
<body>
<div id="fb-root"></div>
<div style="background:transparent url(/img/v9-bgwrap.gif) center top no-repeat;">
<div id="headerbanner">
	<div style="margin:0 auto;width:940px;height:50px;background:#fff;text-align:center;"><?php
$now = date("Y-m-d h:i:s");
$start = "2012-07-11 13:00:00";
$end = "2012-07-12 13:00:00";
/*
echo (strtotime($now) > strtotime($start) && strtotime($now) < strtotime($end)) ? '<div id="pilkada"></div><script>$.get("/pilkada",function(data){$("#pilkada").html(data)})</script>' : $this->banner_model->getBanner(320);
*/
echo $this->banner_model->getBanner(320);
?></div>
</div>
<div style="height:50px">&nbsp;</div>
<div class="header">
	<div style="float:left;width:600px;margin-top:5px;margin-left:10px;">
		<table cellpadding="0" cellspacing="0">
			<tr>
				<td><a href="<?=site_url()?>">HOME</a> | <a href="<?=site_url('berita')?>">BERITA</a> | <a href="<?=site_url('info-untuk-anda')?>">INFO UNTUK ANDA</a> | <a href="http://tv.liputan6.com/watch/indosiar" target="_blank"><span style="color:#006600;text-decoration:blink;">LIVE STREAMING</span></a> | <a href="<?=site_url('lowongan')?>"><span style="color: #FF0000">LOWONGAN</span></a></td>
				<td><div style="margin:0 5px"><a href="<?=site_url('rss')?>"><img src="/img/rss.gif" heigh="10" border="0"></a></div></td>
				<td><div class="g-plusone" data-size="small" data-annotation="none"></div></td>
			</tr>
		</table>
	</div>
	<div style="float:right;width:300px;margin-top:5px;">
	  <form action="/search" method="post" name="search_form" id="search_form" onsubmit="if(document.search_form.qword.value=='Search'){alert('No Keyword');document.search_form.qword.focus();return false;}" >
	    <input type="hidden" name="doSearch" value="true"/>
	    <input type="image" name="bt_ok" id="bt_ok" src="/img/search_button.gif" />
	    <input name="qword" id="keyword" type="text" value="Search" onfocus="if(this.value=='Search') this.value='';" onblur="if(this.value=='') this.value='Search';" size="25" maxlength="255" />
	  </form>
	</div>
	<div style="clear:both">
		<div style="float:left;width:150px;"><a href="<?=site_url()?>"><img src="/img/logo-v12-new.png" alt="indosiar dot com" border="0" /></a></div>
		<div style="float:right;width:750px;margin:20px 10px 0 0;text-align:right;"><?=$this->banner_model->getBanner(322)?></div>
	</div>
</div>
<div class="header-menu" style="background:#EFEFEF">
	<a href="<?=site_url('fokus')?>">FOKUS</a> | <a href="<?=site_url('patroli')?>">PATROLI</a> | <a href="<?=site_url('ragam')?>">RAGAM</a> | <a href="<?=site_url('gossip')?>">GOSSIP</a> | <a href="<?=site_url('sinopsis')?>">SINOPSIS</a> | <span class="header-menu-other"><a href="<?=site_url('daua')?>">RESPOND ONLINE</a> | <a href="<?=site_url('indosiarpeduli')?>">INDOSIAR PEDULI</a> | <a href="<?=site_url('corporate')?>">CORPORATE INFO</a></span> 
</div>
<div class="container">
<?php
if (!isset($no_fb_timeline)) {
?>
    <div id="fbContainer">
    	<div id="fbContentBox"></div>
    </div>
<?
}
?>
