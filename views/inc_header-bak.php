<?
if (!isset($HTMLMetaDescription)) {
	$HTMLMetaDescription="";
}
if (!isset($HTMLMetaKeywords)) {
	$HTMLMetaKeywords="";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$HTMLPageTitle?></title>
<meta name="description" content="<?=htmlspecialchars($HTMLMetaDescription)?>" />
<meta name="keywords" content="<?=$HTMLMetaKeywords?>" />
<?
include(ROOTBASEPATH."inc/metatag.php");
?>
<meta name="robots" content="all" />
<link rel="SHORTCUT ICON" type="image/x-icon" href="/favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="Indosiar" href="/rss" />
<style type="text/css">
body {
	background:#f2f2f2 url(/img/v9-bg.gif) repeat-x top;
	font-size:12px; 
	font-family: Lucida Grande, Verdana, Sans-serif;
	color:#333;
	margin:0px;
	padding:0px;
}

a {
	color: #0060B8;
	background-color: transparent;
	font-weight: normal;
	text-decoration: none;
}

a:hover {
	text-decoration: none;
	color: #000;
}

h1 {
	font-size:14px;
	font-weight: bold;
}

.header {
	margin:0 auto;
	width:940px;
	height:128px;
	background:url(/img/v9-header.gif) no-repeat;
	clear:both;
}
.header a {color:#1F76B9;font-weight:bold;}
.header a:hover {color:#000;font-weight:bold;}

.header-menu {
	margin:0 auto;
	width:920px;
	background:#D7E5F0;
	padding:10px;
	clear:both;
	font-size:11px;
}
.header-menu a {color:#000}
.header-menu a:hover {color:#000}
.header-menu-other a {color:#2E7914}

.footer {
	margin:0 auto;
	width:920px;
	padding:20px 10px;
	background:#525252;
	clear:both;
	text-align:right;
	color:#fff;
	font-size:11px;
}
.footer a {color:#4D9AD5;}
.footer a:hover {color:#fff;}

.container {
	margin:0 auto;
	width:920px;
	clear:both;
	padding:10px;
	background:#fff;
}

.SubHeader {
	height:180px;
	background:#060815;
}

.SubHeader-BoxM {
	height:100%;
	position:relative;
}

.SubHeader-Box {
	position:absolute;
	bottom:0;
	left:0;
	background:#fff;
	padding:10px 5px;
	width:100%;
	filter:alpha(opacity=75);-moz-opacity:.75;opacity:.75; 
}

.SubHeader-Judul {
	font-weight:bold;
	color:#000;
}

.SubHeader-Isi {
	color:#000;
	font-size:16px;
}

.JenisList {font-size:11px;color:#000;font-weight:bold;text-transform:uppercase;}
.SubJudulList {font-size:11px;color:#666;font-weight:bold;}
.tgl {font-size:10px;}
.TglTayang {font-size:10px;}
.JudulKanal {font:bold 24px Lucida Sans,Lucida Grande,Trebuchet MS;letter-spacing:-2px;color:#B6B6B6;}
.JudulSmall {font-size:11px};

.JenisArtikel {font:bold 18px Lucida Sans,Lucida Grande,Trebuchet MS;letter-spacing:-1px;color:#fff;background:#CFCFCF;padding:5px 10px;margin-bottom:10px;}
.JudulArtikel {font:bold 24px Lucida Sans,Lucida Grande,Trebuchet MS;letter-spacing:-2px;color:#000;}
.JudulArtikelList {font:bold 18px Lucida Sans,Lucida Grande,Trebuchet MS;letter-spacing:-1px;color:#333;}
.JudulArtikelList a {color:#333;}
.JudulArtikelList a:hover {color:#0060B8;}
.SubJudulArtikel {color:#666;font-weight:bold;}
.SubJudulArtikelList {color:#666;font-weight:bold;}

.FloatArtikelDetail {background:#E9E9E9;padding:10px;float:left;width:220px;margin-right:10px;}

.ListJudul01 {}
.ListJudul01 a {display:block;padding:5px 0;border-top:1px dashed #ccc;}
.ListJudul01 a:hover {padding:5px;background:#efefef;}

.ListJudul02 {font-size:10px;font-weight:bold;padding:5px 0;border-bottom:1px dashed #B6B6B6;}
.ListJudul02 a, .ListJudul02 a:hover {font-weight:normal;font-size:11px;}

.QuickLinkList {text-transform:uppercase;font-size:10px;}
.QuickLinkList a {color:#000;display:block;border-bottom:1px dashed #B6B6B6;padding:3px 0;}
.QuickLinkList a:hover {background:#CFCFCF;padding:3px 5px;}

.tag1 {font-size:10px;}
.tag2 {font-size:10px;font-weight:bold}
.tag3 {font-size:12px;}
.tag4 {font-size:12px;font-weight:bold}
.tag5 {font-size:14px;}
.tag1 a, .tag2 a, .tag3 a, .tag4 a, .tag5 a {color:#333}
.tag1 a:hover, .tag2 a:hover, .tag3 a:hover, .tag4 a:hover, .tag5 a:hover {color:#0060B8}

.paging {clear:both;margin-top:20px;padding:5px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000;font-weight:bold;text-align:center;}
.paging a {padding:4px 5px;margin:0px 1px;border:1px solid #333;background:#efefef;color:#333;text-decoration:none;}
.paging a:hover {border:1px solid #ccc;background:#F19323;color:#FFFFFF;text-decoration:none;}

/*search form*/
#search_form{width:210px;float:right;margin:2px 15px 0 0;_margin:2px 10px 0 0;}
#bt_ok{width:21px;height:19px;margin:0 0 0 5px;float:right;}
#search_form #keyword{background-image:url(/img/search_input.gif);width:156px;height:14px; border:0;font-size: 1em;font-family: 'Trebuchet MS','Lucida Grande';padding:1px 4px 3px 4px;_padding:1px 4px 3px 4px;_height:14px;!padding:1px 4px 3px 4px;!height:14px;margin:1px 0 0 15px;float:right;}

#headerbanner {
	width:100%;
	top:0px;
	margin-top:0px;
	height:50px;
	position:fixed;
	z-index:99;
	right:0;
	_position:absolute;
	_top:expression(document.body.scrollTop+document.body.clientHeight-this.clientHeight);
}
html>body #headerbanner {margin-top:0px;top:0}

#footerbanner {
	width: 100%;
	bottom: 0px;
	margin-bottom: 0px;
	height: 62px;
	position: fixed;
	z-index: 99;
	right: 0;
	_position:absolute;
	_top:expression(document.body.scrollTop+document.body.clientHeight-this.clientHeight);
}
html>body #footerbanner { margin-bottom: 0px; bottom: 0 }
</style>
<script type="text/javascript" language="javascript" src="<?=URL_JS?>jquery.js"></script>
<script type="text/javascript" src="<?=URL_JS?>jquery.corner.js"></script>
<link rel="stylesheet" href="http://www.indosiar.com/css/ajax-poller.css" type="text/css">
<script type="text/javascript" src="http://www.indosiar.com/js/ajax.js"></script>
<script type="text/javascript" src="http://www.indosiar.com/js/ajax-poller.js"></script>
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
</script>
</head>
<body>
<div style="background:transparent url(/img/v9-bgwrap.gif) center top no-repeat;">
<div id="headerbanner">
	<div style="margin:0 auto;width:940px;height:50px;background:#fff;text-align:center;"><script src="http://adlink.indosiar.com/inc.php?idc=320" type="text/javascript"></script></div>
</div>
<div style="height:50px">&nbsp;</div>
<div class="header">
	<div style="float:left;width:600px;margin-top:5px;margin-left:10px;">
		<a href="<?=site_url()?>">HOME</a> | <a href="<?=site_url('contact')?>">CONTACT US</a> | <a href="<?=site_url('berita')?>">BERITA</a> | <a href="<?=site_url('info-untuk-anda')?>">INFO UNTUK ANDA</a> | <a href="<?=site_url('rss')?>"><img src="/img/rss.gif" heigh="10" border="0"></a>
	</div>
	<div style="float:right;width:300px;margin-top:5px;">
	  <form action="<?=site_url('search')?>" method="post" name="search_form" id="search_form" onsubmit="if(document.search_form.qword.value=='Search'){alert('No Keyword');document.search_form.qword.focus();return false;}" >
	    <input type="hidden" name="doSearch" value="true"/>
	    <input type="image" name="bt_ok" id="bt_ok" src="/img/search_button.gif" />
	    <input name="qword" id="keyword" type="text" value="Search" onfocus="if(this.value=='Search') this.value='';" onblur="if(this.value=='') this.value='Search';" size="25" maxlength="255" />
	  </form>
	</div>
	<div style="clear:both">
		<div style="float:left;width:150px;"><a href="<?=site_url()?>"><img src="/img/v9-logo.gif" alt="indosiar dot com" border="0" /></a></div>
		<div style="float:right;width:750px;margin:20px 10px 0 0;text-align:right;"><script src="http://adlink.indosiar.com/inc.php?idc=322" type="text/javascript"></script></div>
	</div>
</div>
<div class="header-menu" style="background:#EFEFEF">
	<a href="<?=site_url('fokus')?>">FOKUS</a> | <a href="<?=site_url('patroli')?>">PATROLI</a> | <a href="<?=site_url('ragam')?>">RAGAM</a> | <a href="<?=site_url('gossip')?>">GOSSIP</a> | <a href="<?=site_url('sinopsis')?>">SINOPSIS</a> | <a href="<?=site_url('talk-show')?>">TALK SHOW</a> | <a href="<?=site_url('kolom')?>">KOLOM</a> | <span class="header-menu-other"><a href="http://www.indosiar.com/daua">RESPOND ONLINE</a> | <a href="http://www.indosiar.com/peduli-kasih/">PEDULI KASIH</a> | <a href="http://ww1.indosiar.com/v4/kitapeduli/">KITA PEDULI</a> | <a href="http://ww1.indosiar.com/investor/">INVESTOR RELATION</a></span>
</div>
<div class="container">
