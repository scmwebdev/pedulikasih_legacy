<?
$HTMLPageTitle = "Annual Report - Corporate Info";
$HTMLMetaDescription = "INDOSIAR Annual Report";
$HTMLMetaKeywords = "Annual Report";

$no_fb_timeline         = true;

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

<div class="RoundedBox5px" style="font-weight: bold; font-style: normal; font-variant: normal; font-size: 18px; line-height: normal; font-family: 'Lucida Sans', 'Lucida Grande', 'Trebuchet MS'; letter-spacing: 0px; color: rgb(255, 255, 255); background-color: rgb(78, 100, 104); padding: 5px 10px; margin-bottom: 10px; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; background-position: initial initial; background-repeat: initial initial;">Corporate Information</div>
<div style="float:left;width:200px;margin-right:20px;">
<?=$menu?>
</div>
<div style="float:right;width:700px;">
    <h1>Annual Report</h1>
    <br/><br/>
    
<?php
foreach($annualreport as $row) {
    echo '<div style="float:left;width:200px;padding:3px;margin:8px;text-align:center;border:1px solid #ccc;"><a href="'.URL_STATIC.'pdf/investor/annualreport/'.$row['pdf'].'" title="Annual Report '.$row['tahun'].'" target="_blank"><img src="'.URL_STATIC.'images/investor/annualreport/'.$row['image'].'" width="200" alt="Annual Report '.$row['tahun'].'" border="0"/></a><br/>'.$row['tahun'].'</div>';
}
?>
    
    <div style="clear:both"></div>
</div>

<?
include (APPPATH."views/inc_footer.php");
?>