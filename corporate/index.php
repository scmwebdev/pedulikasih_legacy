<?
$HTMLPageTitle = "Corporate Info";
$HTMLMetaDescription = "Corporate Info";
$HTMLMetaKeywords = "Corporate Info";
$no_fb_timeline         = true;

include (APPPATH."views/inc_header.php");
?>

<link rel="stylesheet" type="text/css" href="/assets/css/base/advanced-slider-base.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="/assets/css/glossy-square/gray/glossy-square-gray.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="/assets/css/basic-slider.css" media="screen"/>
<script type="text/javascript" src="/assets/js/jquery.transition.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.advancedSlider.min.js"></script>

<script type="text/javascript">	
	jQuery(document).ready(function($){
		$('#basic-slider').advancedSlider({width: '700px',
											height: '420px',
											scaleType: 'outsideFit',
											skin: 'glossy-square-gray',
											effectType: 'fade',
											pauseSlideshowOnHover: true,
											swipeThreshold: 50,
											slideButtons: false,
											thumbnailType: 'scroller',
											thumbnailButtons: false,
											thumbnailScrollerResponsive: true,
											minimumVisibleThumbnails: 2,
										    effectType: 'slice',
									 	   slideProperties:{
												0:{sliceEffectType: 'scale', horizontalSlices: 6, verticalSlices: 3, slicePattern: 'spiralCenterToMarginCW', 
												   sliceDelay: 80, captionHideEffect: 'fade'},
												1:{sliceEffectType: 'fade', captionHideEffect: 'fade', slideshowDelay: 12000},
												2:{sliceEffectType: 'slide', horizontalSlices: 10, verticalSlices: 1, slicePattern: 'rightToLeft', sliceDuration: 700},
												3:{sliceEffectType: 'height', horizontalSlices: 10, verticalSlices: 1, slicePattern: 'leftToRight', slicePoint: 'centerBottom',
												   sliceDuration: 500},
												4:{sliceEffectType: 'scale', horizontalSlices: 10, verticalSlices: 5, sliceDuration: 800},
												5:{sliceEffectType: 'height', horizontalSlices: 1, verticalSlices: 15, slicePattern: 'bottomToTop', slicePoint: 'centerTop',
												   sliceDuration: 700, captionPosition: 'bottom', captionHideEffect: 'fade'},
												6:{sliceEffectType: 'slide', horizontalSlices: 6, verticalSlices: 3, slicePattern: 'topLeftToBottomRight', 
												   sliceStartPosition: 'rightBottom', sliceStartRatio: 0.5, sliceDuration: 700},
												7:{sliceEffectType: 'fade', horizontalSlices: 10, verticalSlices: 5},
												8:{sliceEffectType: 'slide', horizontalSlices: 15, verticalSlices: 1, slideMask: true, slicePattern: 'rightToLeft', 
												   sliceStartPosition:'verticalAlternate', sliceDuration:'800'},
												9:{sliceEffectType: 'fade', horizontalSlices: 10, verticalSlices: 5}
										    }
		});
	});
</script>



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
    <div class="advanced-slider" id="basic-slider">
		<ul class="slides">
        <?php
        foreach($slideshow as $row) {
            echo '<li class="slide">';
            echo '<img class="image" src="'.URL_STATIC.'images/investor/slideshow/'.$row['image'].'" alt=""/>';
            echo '<div class="caption">'.$row['keterangan'].'</div>';
            echo '</li>';
        }
        ?>
		</ul>
	</div>
</div>

<?
include (APPPATH."views/inc_footer.php");
?>