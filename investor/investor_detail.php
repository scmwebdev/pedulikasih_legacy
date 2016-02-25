<?php
if ($versi == "english") {
	$x_judul 	= $isi['judul_en'];
	$x_menu 	= $isi['judul_menu_en'];
	$x_isi 		= $isi['isi_en'];
} else {
	$x_judul 	= $isi['judul_id'];
	$x_menu 	= $isi['judul_menu_id'];
	$x_isi 		= $isi['isi_id'];
}

$HTMLPageTitle = $x_judul." - Investor Relations";
$HTMLMetaDescription = "";
$HTMLMetaKeywords = $x_menu;

include (APPPATH."views/inc_header.php");
?>
<style type="text/css">
#ddblueblockmenu{
	padding:0px;
	margin:0px;
	border: 1px solid black;
	/*border-bottom-width: 0;*/
	width: 200px;
}

#ddblueblockmenu ul{
margin: 0px;
padding: 0px;
list-style-type: none;
/*font: normal 90% 'Trebuchet MS', 'Lucida Grande', Arial, sans-serif;*/
}

#ddblueblockmenu ul li{
margin: 0px;
padding: 0px;
}

#ddblueblockmenu li{
margin: 0px;
padding: 0px;
}

#ddblueblockmenu li a{
display: block;
margin: 0px;
padding: 3px 0;
padding-left: 9px;
width: 184px; /*185px minus all left/right paddings and margins*/
text-decoration: none;
color: white;
background-color: #2175bc;
border-bottom: 1px solid #90bade;
border-left: 7px solid #1958b7;
}

* html #ddblueblockmenu li a{ /*IE only */
margin: 0px;
width: 202px; /*IE 5*/
w\idth: 184px; /*185px minus all left/right paddings and margins*/
}

#ddblueblockmenu li a:hover {
margin: 0;
background-color: #2586d7;
border-left-color: #1c64d1;
}

#ddblueblockmenu div.menutitle {
margin: 0;
color: white;
border-bottom: 1px solid black;
padding: 3px 0;
padding-left: 5px;
background-color: black;
/*font: bold 90% 'Trebuchet MS', 'Lucida Grande', Arial, sans-serif;*/
}

.bahasa {
border: 1px solid black;
margin: 10px 0 0 0;
color: white;
/*border-bottom: 1px solid black;*/
text-align:center;
background-color: #FF8000;
/*font: bold 90% 'Trebuchet MS', 'Lucida Grande', Arial, sans-serif;*/
}

.bahasa a {
display: block;
padding: 3px 0;
color: white;
background-color: #FF8000;
/*font: bold 90% 'Trebuchet MS', 'Lucida Grande', Arial, sans-serif;*/
}

.bahasa a:hover {
color: white;
background-color: #000;
}

.indexBox1{
	padding:0px;
	margin:0px;
}

.indexBox1 ul{
margin: 0px;
padding: 0px;
list-style-type: none;
}

.indexBox1 ul li{
margin: 0px;
padding: 0px;
}

.indexBox1 li{
margin: 0px;
padding: 0px;
}

.indexBox1 li a{
display: block;
margin: 0px;
padding: 3px 10px 3px 20px;
text-decoration: none;
border-top: 1px dashed #ccc;
}

.indexBox1 li a:hover {
margin: 0;
background-color: #efefef;
}

.table-hl {width:100%;border-collapse:collapse;text-align:center;border:1px solid #666;font-size: 11px;}
.table-hl th {font-weight: bold;padding: 8px;background:#2E7C92;color:#fff;text-align: center;font-size: 11px;}
.table-hl tbody tr {border-top:1px solid #666;}
.table-hl td {padding:4px;}
.bg-row {background:#93CDDD;}
.title-top {font-weight:bold;text-align:center;font-size: 11px;}
.title-left {font-weight:bold;text-align:right;font-size: 11px;}

</style>
<div style="float:left;width:200px;margin-right:20px;">
<?=$menu?>
</div>
<div style="float:right;width:700px;">
	<div class="RoundedBox5px" style="font:bold 18px Lucida Sans,Lucida Grande,Trebuchet MS;letter-spacing:-1px;color:#fff;background:#CFCFCF;padding:5px 10px;margin-bottom:10px;">Investor Relation</div>
	<br />
<?php
if ($isi['show_judul'] == '1') echo '<h1>'.$x_judul.'</h1><br/><br/>';
echo $x_isi;
?>
</div>
<?php
include (APPPATH."views/inc_footer.php");
?>