<?
if (!isset($HTMLMetaDescription)) $HTMLMetaDescription="";
if (!isset($HTMLMetaKeywords)) $HTMLMetaKeywords="";
if (!isset($HTMLCanonical)) $HTMLCanonical = site_url($_SERVER['REQUEST_URI']);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?=$HTMLPageTitle?></title>
<meta name="description" content="<?=htmlspecialchars($HTMLMetaDescription)?>" />
<meta name="keywords" content="<?=$HTMLMetaKeywords?>" />
<meta http-equiv="Content-Type"	content="text/html; charset=iso-8859-1" />
<meta name="robots" content="all" />
<meta name="google-site-verification" content="YCqKTsMAsI6Feo3WXhb5r5zzmOBQ4XSK01PMc-yl6Mk" />
<meta name="msvalidate.01" content="77115FB9ED53BA8A1529A3F0027F1D89" />
<link rel="canonical" href="<?=$HTMLCanonical?>" />
<link rel="SHORTCUT ICON" type="image/x-icon" href="/favicon.ico" />
<script type="text/javascript" src="<?=$this->config->item('URL_JS')?>jquery.js"></script>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-27419835-1']);
_gaq.push(['_trackPageview']);

(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
<style type="text/css">
body {
	background-color:#fff;
	background-image:url(/assets/images/galaxysuperstar/bgbottom2.jpg);
	background-repeat:repeat-x;
	background-position:bottom;
	font-size:12px; 
	font-family: Lucida Grande, Verdana, Sans-serif;
	color:#000;
	margin:0;padding:0;
}

a {
	color: #000;
	background-color: transparent;
	font-weight: normal;
	text-decoration: none;
}

a:hover {
	text-decoration: none;
	color: #ffcc00;
}

h1 {font:bold 24px Lucida Sans,Lucida Grande,Trebuchet MS;letter-spacing:-2px;color:#000;margin:0;padding:0;}
.wrapper {
	margin:0;
	padding:0;
	background-image:url(/assets/images/galaxysuperstar/bgtop2.jpg);
	background-repeat:repeat-x;
	background-position:top;
}
.container {margin:0 auto;padding:0;width:800px;}
.thecontent {margin:0;padding:0;}

.underlinemenu{font-weight: bold;width: 100%;margin-bottom:20px;}
.underlinemenu ul{
padding: 6px 0 7px 0; /*6px should equal top padding of "ul li a" below, 7px should equal bottom padding + bottom border of "ul li a" below*/
margin: 0;
text-align: right; //set value to "left", "center", or "right"*/
}
.underlinemenu ul li{display: inline;}
.underlinemenu ul li a{
color: #ED1C24;
padding: 6px 3px 4px 3px; /*top padding is 6px, bottom padding is 4px*/
margin-right: 20px; /*spacing between each menu link*/
text-decoration: none;
border-bottom: 3px solid #ED1C24; /*bottom border is 3px*/
}
.underlinemenu ul li a:hover, .underlinemenu ul li a.selected{color:black; border-bottom-color: black;}
</style>
</head>
<body>
<div class="wrapper">
	<div class="container">
		<div style="text-align:center;padding-top:20px;padding-bottom:20px;"><a href="/galaxysuperstar"><img src="/assets/images/galaxysuperstar/logo4.png" alt="Galaxy Superstar" /></a></div>
		<div class="underlinemenu">
			<ul>
				<li><a href="/galaxysuperstar/register">REGISTRASI</a></li>
				<li><a href="/galaxysuperstar/faq">F.A.Q</a></li>
		</div>
	</div>
	<div class="container">