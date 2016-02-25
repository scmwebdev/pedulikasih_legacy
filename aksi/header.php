<?php
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
<link rel="stylesheet" type="text/css" href="/assets/aksi/main.css" />
<script type="text/javascript" src="/assets/js/jquery.1.8.2.js"></script>
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
</head>
<body>
<div class="content">
