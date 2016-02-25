<style type="text/css">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

.urbangreymenu{
width: 200px; /*width of menu*/
}

.urbangreymenu .headerbar{
font: bold 16px Verdana;
color: white;
background: #606060 url(media/arrowstop.gif) no-repeat 8px 6px; /*last 2 values are the x and y coordinates of bullet image*/
margin-bottom: 0; /*bottom spacing between header and rest of content*/
text-transform: uppercase;
padding: 7px 0 7px 31px; /*31px is left indentation of header text*/
}

.urbangreymenu ul{
list-style-type: none;
margin: 0;
padding: 0;
margin-bottom: 0; /*bottom spacing between each UL and rest of content*/
}

.urbangreymenu ul li{
padding-bottom: 2px; /*bottom spacing between menu items*/
}

.urbangreymenu ul li a{
font: normal 14px Arial;
color: white;
background: #EA172A;
display: block;
padding: 5px 0;
line-height: 17px;
padding-left: 8px; /*link text is indented 8px*/
text-decoration: none;
}

.urbangreymenu ul li a:hover{ /*hover state CSS*/
color: white;
background: black;
}

.list-float{float:right;width:270px;margin-left:10px;border:1px solid #999;padding:8px;}
.list-float ul{margin: 0px;padding: 0px;list-style-type: none;}
.list-float ul li, .list-float li{margin: 0px;padding:5px 0px; border-bottom: 1px dashed #999;font-size:11px;}
.list-float li a{
	display: block;
	margin: 0px;
	padding: 3px 0;
	text-decoration: none;
	font-weight:bold;
	font-size:12px;
}
.list-float li a:hover {text-decoration:underline;}

.list-lain{margin-top:20px;}
.list-lain h2{margin:0 0 5px;padding-bottom:5px;border-bottom:1px solid #999;font-size:14px;}
.list-lain ul{margin: 0px;padding: 0px;list-style-type: none;}
.list-lain ul li, .list-lain li{margin: 0px;padding:5px 0px; border-bottom: 1px dashed #999;}
.list-lain li a{
	display: block;
	margin: 0px;
	padding: 3px 0;
	text-decoration: none;
	font-weight:bold;
	font-size:12px;
}
.list-lain li a:hover {text-decoration:underline;}

.list-paging {}
.list-paging ul{margin: 0px;padding: 0px;list-style-type: none;}
.list-paging ul li, .list-paging li{margin: 0px;padding:10px 0px; border-bottom: 1px dashed #999;}
.list-paging li h2 {margin:0;padding:0;}
.list-paging li h2 a{
	/*display: block;*/
	margin: 0;
	padding: 0;
	text-decoration: none;
	font-weight:bold;
	font-size:14px;
}
.list-paging li h2 a:hover {text-decoration:underline;}

.list-foto {margin-top:20px;clear:both;}
.list-foto ul{margin: 0px;padding: 0px;list-style-type: none;}
.list-foto ul li, .list-foto li{display:block;width:150px;float:left;margin:5px;padding:3px;border:1px solid #999;}
.list-foto li a{
	display: block;
	margin: 0;
	padding: 0;
}
.list-foto li a:hover, .list-foto li:hover {background:#ccc;}
</style> 

<div style="float:left;width:200px;margin-right:20px;">
	<div class="urbangreymenu" style="margin-top:10px">
		<a href="/kitapeduli"><img src="<?=$this->config->item('URL_IMAGES')?>kitapeduli.jpg" alt="Kita Peduli" border="0" /></a>
		<ul>
			<li><b>LAPORAN KEUANGAN</b></li>
			<li><a href="/kitapeduli/bcaperorangan">Transfer BCA Perorangan</a></li>
			<li><b>BERITA</b></li>
			<li><a href="/kitapeduli/berita">Berita Kita Peduli</a></li>
			<li><b>GALLERY</b></li>
			<li><a href="/kitapeduli/gallery">Gallery Foto</a></li>
		</ul>
	</div>
</div>
<div style="float:right;width:680px;">