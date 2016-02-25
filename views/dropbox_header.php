<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Drop Box</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
body {
	margin: 0px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000;
}

a {
	color: #0000FF;
	background-color: transparent;
	font-weight: normal;
	text-decoration: underline;
}

a:hover {
	text-decoration: none;
}

.BodyBox {margin:0 auto;width:974px}

.HeaderMenu {
  width: 100%;
	background: #747B83;
	/*border-top:1px solid #2D3134;*/
	margin-bottom:10px;
}
.HeaderMenu ul {
  margin: 0;
  padding: 0;
  list-style-type: none;
}
.HeaderMenu li {
  margin: 0;
  float: left;
  width: 16.666666666667%;
  text-align: center;
}

.HeaderMenu a{
	display: block;
  width: 100%;
	font: bold 12px Verdana;
	color:#fff;
	text-decoration: none;
	padding: 7px 0;
	border-right: 1px solid #2D3134;
}

.HeaderMenu a:hover{
	background: #38AC05;
}
.HeaderMenu li.a:hover{
	background: #38AC05;
}

.HeaderMenu li.selected a{
	background: #E62A2A;
}

.HeaderMenu li.leftmostitem a{
	border-left: 0px;
}

.JudulArtikel {font-size:14px;font-weight:bold;}
.JudulArtikel a {font-weight:bold;text-decoration:none;color:#FF0000;}
.JudulArtikel a:hover {text-decoration:none;color:#000;}

.JudulArtikel {
	font:bold 24px Lucida Sans, Lucida Grande, Trebuchet MS;
	letter-spacing: -2px;
	color: #2E81C3;
	margin-bottom:20px;
}

.JudulArtikelList {
	font:bold 18px Lucida Sans, Lucida Grande, Trebuchet MS;
	letter-spacing: -2px;
	color: #FF0000;
}

.JudulArtikelList a {
	color: #FF0000;
	text-decoration:none;
}

.JudulArtikelList a:hover {
	color: #000;
	text-decoration: none;
}

.JudulKanal {
	color: #38AC05;
	font-family: 'Lucida Sans', 'Lucida Grande', 'Trebuchet MS';
	letter-spacing: -2px;
	font-size: 20px;
	font-weight: bold;
	text-transform:uppercase;
}

.style2 {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333333;
}
.style3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #333333;
	font-weight: bold;
}

/* -------------- PAGING ------------- */
#paging{
	clear:both;
	margin-top:20px;
	padding:5px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#000;
	font-weight:bold;
	text-align:center;
}
#paging a{
	padding:4px 7px 4px 7px;
	margin:0px 2px 0px 2px;
	border:1px solid #333;
	background:#FFF;
	color:#333;
	text-decoration:none;
}
#paging a:hover{
	border:1px solid #333;
	background:#333;
	color:#FFFFFF;
	text-decoration:none;
}
</style>
<script type="text/javascript" src="/js/jquery.js"></script>
<style type="text/css">
div.RoundedBoxOuter {background:#97A5B0}
</style>
<script type="text/javascript" src="/js/jquery.corner.js"></script>
<script type="text/javascript">
	$(function(){
        $('div.RoundedBox5pxBorder').wrap('<div class="RoundedBoxOuter"></div>');
        $("div.RoundedBox5pxBorder").corner("round 5px").parent().css('padding', '1px').corner("round 6px")
				
				$('div.RoundedBox8pxBorder').wrap('<div class="RoundedBoxOuter"></div>');
        $("div.RoundedBox8pxBorder").corner("round 7px").parent().css('padding', '1px').corner("round 8px")
        
        $("div.RoundedBox5px").corner("8px");
        $("div.RoundedBoxTop5px").corner("top 5px");
        $("div.RoundedBoxBottom5px").corner("bottom 5px");
        
	});
</script>
<?
if (isset($JSHeader)) echo $JSHeader;
$ActiveRootPage = ($this->uri->segment(2) == "") ? 'home' : $this->uri->segment(2);
?>
</head>
<body>
<div class="BodyBox"><img src="/images/dropbox_header.gif" alt="drop box" border="0" /></div>
<div class="BodyBox">
	<div class="HeaderMenu">
		<ul>
			<li<?=($ActiveRootPage == "home") ? ' class="selected"' : ''?>><a href="/dropbox">H O M E</a></li>
			<li<?=($ActiveRootPage == "toa") ? ' class="selected"' : ''?>><a href="/dropbox/toa">FORMULIR DROPBOX</a></li>
			<li<?=($ActiveRootPage == "pengumuman") ? ' class="selected"' : ''?>><a href="/dropbox/pengumuman">PENGUMUMAN</a></li>
			<li<?=($ActiveRootPage == "photo") ? ' class="selected"' : ''?>><a href="/dropbox/photo">PHOTO</a></li>
		</ul>
		<br clear="left" />
	</div>
</div>
<div class="BodyBox">
