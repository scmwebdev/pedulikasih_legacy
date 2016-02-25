<?php
if (!isset($HTMLMetaDescription)) $HTMLMetaDescription="";
if (!isset($HTMLMetaKeywords)) $HTMLMetaKeywords="";
if (!isset($HTMLCanonical)) $HTMLCanonical = site_url($_SERVER['REQUEST_URI']);
?><!DOCTYPE html>
<html class="html">
 <head>
  <title><?=$HTMLPageTitle?></title>
  <meta name="description" content="<?=htmlspecialchars($HTMLMetaDescription)?>" />
  <meta name="keywords" content="<?=$HTMLMetaKeywords?>" />
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
  <meta name="robots" content="all" />
  <meta name="google-site-verification" content="YCqKTsMAsI6Feo3WXhb5r5zzmOBQ4XSK01PMc-yl6Mk" />
  <meta name="msvalidate.01" content="77115FB9ED53BA8A1529A3F0027F1D89" />
  <link rel="canonical" href="<?=$HTMLCanonical?>" />
  <link rel="SHORTCUT ICON" type="image/x-icon" href="/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="/assets/aksi2014/css/site_global.css?417434784"/>
  <link rel="stylesheet" type="text/css" href="/assets/aksi2014/css/master_a-master.css?4066808440"/>
  <!-- Other scripts -->
  <script type="text/javascript">
   document.documentElement.className += ' js';
  </script>
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
<body class="museBGSize">
  <div class="clearfix" id="page">
