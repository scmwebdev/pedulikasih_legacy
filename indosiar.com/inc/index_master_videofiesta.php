<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta name="author" content="indosiar web team" />

<meta name="robots" content="all" />
<meta name="description" content="video artis indonesia terupdate" />
<meta name="keywords" content="video artis,artis indonesia,video terbaru,video lagu,lagu indonesia" />
<title>Video Fiesta | Video Artis Indonesia</title><link href="http://www.indosiar.com/css/vfy.css" rel=stylesheet type=text/css>

<style type="text/css">
<!--
body {
	background-image: url();
	margin-top: 0px;
	margin-bottom: 0px;
	background-color: #FFFFFF;
}
-->
</style>
<script type="text/javascript" src="http://www.indosiar.com/js/jquery.js"></script>
<script type="text/javascript" src="http://www.indosiar.com/js/jquery.rater.packed.js"></script>
<script type="text/javascript" src="http://www.indosiar.com/js/jquery.block.js"></script> 
<script type="text/javascript" src="http://www.indosiar.com/js/jquery.form.js"></script>
<link rel="stylesheet" href="http://www.indosiar.com/css/jquery.bettertip.css" type="text/css" />
<script type="text/javascript" src="http://www.indosiar.com/js/jquery.bettertip.js"></script>
<link rel="stylesheet" type="text/css" href="http://www.indosiar.com/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="http://www.indosiar.com/css/rater.css" media="screen" /> 
<script type="text/javascript">
    $(function(){
       BT_setOptions({openWait:500, closeWait:3000, enableCache:false});
    })
</script>
<script type="text/javascript">
$().ajaxStop($.unblockUI); 
$(function() {     
    $('#cform').ajaxForm({
        beforeSubmit: function(a,f,o) {
			    var theForm = f[0]; 
			    if (!theForm.nama.value || !theForm.komentar.value || !theForm.email.value || !theForm.videoid.value) { 
				        alert('All field must fill!'); 
				        return false; 
				    }
            o.dataType = 'html';
            $.blockUI('<br /><img src="http://www.indosiar.com/videofiesta/img/loading.gif" /><br /><b>Wait a moment...</b><br /><br />', { backgroundColor: '#fff', color: '#000' }); 
        },
        success: function(data) {			    
						if (typeof data == 'object' && data.nodeType)
				        data = elementToString(data.documentElement, true);
				    else if (typeof data == 'object')
				        data = objToString(data);    

				    $('#cform').clearForm();				        
				    $('#hasilkomentar').html(data);
        }
    });
    $('#kirim').ajaxForm({
        beforeSubmit: function(a,f,o) {
			    var theForm = f[0]; 
			    if (!theForm.email.value) { 
				        alert('All field must fill!'); 
				        return false; 
				    }
            o.dataType = 'html';
            $.blockUI('<br /><img src="http://www.indosiar.com/videofiesta/img/loading.gif" /><br /><b>Wait a moment...</b><br /><br />', { backgroundColor: '#fff', color: '#000' }); 
        },
        success: function(data) {			    
						if (typeof data == 'object' && data.nodeType)
				        data = elementToString(data.documentElement, true);
				    else if (typeof data == 'object')
				        data = objToString(data);    
				        
				    $('#kirim').clearForm();
				    alert('Email has been sent');	
        }
    });
}); 
</script> 
	<link type="text/css" rel="stylesheet" href="http://www.indosiar.com/css/scroller_video.css" />
	<script type="text/javascript" src="http://www.indosiar.com/js/jquery.scrollTo-min.js"></script>
	<script type="text/javascript" src="http://www.indosiar.com/js/jquery.serialScroll-min.js"></script>
	<script type="text/javascript" src="http://www.indosiar.com/js/jquery.scrollTo.js"></script>
	<script type="text/javascript" src="http://www.indosiar.com/js/jquery.serialScroll.js"></script>
	<script type="text/javascript">	
		//easing equation, borrowed from jQuery easing plugin
		//http://gsgd.co.uk/sandbox/jquery/easing/
		$.easing.easeOutQuart = function (x, t, b, c, d) {
			return -c * ((t=t/d-1)*t*t*t - 1) + b;
		};
	
		jQuery(function( $ ){
			/**
			 * Most jQuery.serialScroll's settings, actually belong to jQuery.ScrollTo, check it's demo for an example of each option.
			 * @see http://flesler.webs.com/jQuery.ScrollTo/
			 * You can use EVERY single setting of jQuery.ScrollTo, in the settings hash you send to jQuery.serialScroll.
			 */
			
			/**
			 * The plugin binds 6 events to the container to allow external manipulation.
			 * prev, next, goto, start, stop and notify
			 * You use them like this: $(your_container).trigger('next'), $(your_container).trigger('goto', [5]) (0-based index).
			 * If for some odd reason, the element already has any of these events bound, trigger it with the namespace.
			 */		
			
			/**
			 * IMPORTANT: this call to the plugin specifies ALL the settings (plus some of jQuery.ScrollTo)
			 * This is done so you can see them. You DON'T need to specify them all.
			 * A 'target' is specified, that means that #screen is the context for target, prev, next and navigation.
			 */
			$('#screen').serialScroll({
				target:'#sections',
				items:'li', //selector to the items ( relative to the matched elements, '#sections' in this case )
				prev:'img.prev',//selector to the 'prev' button (absolute!, meaning it's relative to the document)
				next:'img.next',//selector to the 'next' button (absolute too)
				axis:'y',//the default is 'y'
				queue:false,//we scroll on both axes, scroll both at the same time.
				event:'click',//on which event to react (click is the default, you probably won't need to specify it)
				stop:false,//each click will stop any previous animations of the target. (false by default)
				lock:true, //ignore events if already animating (true by default)
				duration:700,//length of the animation (if you scroll 2 axes and use queue, then each axis take half this time)
				start: 0, //on which element (index) to begin ( 0 is the default, redundant in this case )
				force:true, //force a scroll to the element specified by 'start' (some browsers don't reset on refreshes)
				cycle:true,//cycle endlessly ( constant velocity, true is the default )
				step:1, //how many items to scroll each time ( 1 is the default, no need to specify )
				jump:false, //if true, items become clickable (or w/e 'event' is, and when activated, the pane scrolls to them)
				lazy:false,//(default) if true, the plugin looks for the items on each event(allows AJAX or JS content, or reordering)
				interval:false, //it's the number of milliseconds to automatically go to the next
				navigation:'#navigation li',
				constant:true,
				onBefore:function( e, elem, $pane, $items, pos ){
					/**
					 * 'this' is the triggered element 
					 * e is the event object
					 * elem is the element we'll be scrolling to
					 * $pane is the element being scrolled
					 * $items is the items collection at this moment
					 * pos is the position of elem in the collection
					 * if it returns false, the event will be ignored
					 */
					 //those arguments with a $ are jqueryfied, elem isn't.
					e.preventDefault();
					if( this.blur )
						this.blur();
				},
				onAfter:function( elem ){
					//'this' is the element being scrolled ($pane) not jqueryfied
				}
			});
			
			/**
			 * No need to have only one element in view, you can use it for slideshows or similar.
			 * In this case, clicking the images, scrolls to them.
			 * No target in this case, so the selectors are absolute.
			 */
			
			$('#slideshow').serialScroll({
				items:'li',
				prev:'#screen2 a.prev',
				next:'#screen2 a.next',
				axis:'x',
				offset:-230, //when scrolling to photo, stop 230 before reaching it (from the left)
				start:1, //as we are centering it, start at the 2nd
				duration:1200,
				force:true,
				stop:true,
				lock:false,
				cycle:false, //don't pull back once you reach the end
				easing:'easeOutQuart', //use this easing equation for a funny effect
				jump: true //click on the images to scroll to them
			});
			
			/**
			 * The call below, is just to show that you are not restricted to prev/next buttons
			 * In this case, the plugin will react to a custom event on the container
			 * You can trigger the event from the outside.
			 */
			
			var $news = $('#news-ticker');//we'll re use it a lot, so better save it to a var.
			$news.serialScroll({
				items:'div',
				duration:700,
				force:true,
				axis:'y',
				lazy:true,//NOTE: it's set to true, meaning you can add/remove/reorder items and the changes are taken into account.
				interval:5000, //yeah! I now added auto-scrolling
				step:2 //scroll 2 news each time
			});	
			
			/**
			 * The following you don't need to see, is just for the "Add 2 Items" and "Shuffle"" buttons
			 * These exemplify the use of the option 'lazy'.
			 */
			$('#add-news').click(function(){
				var 
					$items = $news.find('div'),
					num = $items.length + 1;
					
				$items.slice(-2).clone().find('h4').each(function(i){
					$(this).text( 'News ' + (num + i) );
				}).end().appendTo($news);
			});
			$('#shuffle-news').click(function(){//don't shuffle the first, don't wanna deal with css
				var shuffled = $news.find('div').get().slice(1).sort(function(){
					return Math.round(Math.random())-0.5;//just a random number between -0.5 and 0.5
				});
				$(shuffled).appendTo($news);//add them all reordered
			});
		});
	</script>
</head>
<body>
<table width="996" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" bgcolor="#E81C1B">
<div id="theHeader">
		<style type="text/css">
	#menusite ul{
		font: bold 10px Arial;
		margin:0;
		padding: 0;
		list-style: none;
	}
	
	#menusite li{
		font: bold 10px Arial;
		display: inline;
		padding: 0;
		text-transform:uppercase;
		vertical-align: middle;
	}
	
	#menusite a{
		font: bold 10px Arial;
		float: left;
		display: block;
		color: #fff;
		margin: 0;
		text-decoration: none;
		letter-spacing: 0px;
		padding: 0 12px 0 12px;
		height:30px;
		line-height: 30px;
		border-right:1px solid #fff;
	}
	
	#menusite a:hover{
		background:url(http://www.indosiar.com/img/tabbgh.gif);
	}
	
	#menusite #current a{
		font: bold 10px Arial;
		color: #fff;
		background:url(http://www.indosiar.com/img/tabbgs.gif);
		line-height: 30px;
	}
	</style>
	<div style="background:url(http://www.indosiar.com/img/tabbg.gif)">
		<div id="menusite">
			<ul>
	  		<li><a href="http://www.indosiar.com/" target="_top"><img src="http://www.indosiar.com/img/tabhome.gif" width="20" height="20" border="0" alt="back to halaman utama" style="margin-top:5px" /></a></li>
<!--		    <li><a href="http://www.indosiar.com/program/" target="_top">PROGRAMME</a></li>
		    <li><a href="http://www.indosiar.com/news/" target="_top">N E W S</a></li>
-->
		    <li><a href="http://www.lautanindonesia.com/" target="_top">FORUM</a></li>
		    <li><a href="http://www.bloggaul.com/" target="_top">BLOG</a></li>
		    <li id="current"><a href="http://www.indosiar.com/videofiesta/" target="_top">VIDEO FIESTA</a></li>
		    <li><a href="http://www.indosiar.com/daua" target="_top">RESPOND ONLINE</a></li>
		    <li><a href="http://www.indosiar.com/pedulikasih/" target="_top">PEDULI KASIH</a></li>
		    <li><a href="http://ww1.indosiar.com/v4/kitapeduli" target="_top">KITA PEDULI</a></li>
		    <li><a href="http://ww1.indosiar.com/investor/" alt="INVESTOR RELATIONS" target="_top">INVESTOR RELATION</a></li>
		    <li><a href="http://www.indosiar.com/transmisi" target="_top">Transmisi</a></li>
		  </ul>
		</div>
		<div style="clear:both"></div>
  </div>
</div>
      <table border="0" align="left" cellpadding="0" cellspacing="4">

        <tr>
          <td id="menu"><a href="http://www.indosiar.com/videofiesta/">home</a></td>
				          
          <td id="menu"><a href="http://www.indosiar.com/videofiesta/dramaasia">Drama Asia                                        </td>
				          
          <td id="menu"><a href="http://www.indosiar.com/videofiesta/kiss">KISS                                              </td>
				          
          <td id="menu"><a href="http://www.indosiar.com/videofiesta/take-me-out">Take Me Out Indonesia</td>
				          
          <td id="menu"><a href="http://www.indosiar.com/videofiesta/take-him-out">Take Him Out Indonesia</td>
				          
          <td id="menu"><a href="http://www.indosiar.com/videofiesta/the-dating">The Dating</td>
				          
          <td id="menu"><a href="http://www.indosiar.com/videofiesta/take-a-celebrity-out">Take A Celebrity Out</td>
		
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td><img src="http://www.indosiar.com/videofiesta/img/header_01.gif" width="315" height="19" /></td>
    <td rowspan="2" valign="top" align="center" valign="bottom" bgcolor="#2F2F2F">
	<script src="http://adlink.indosiar.com/inc.php?idc=322" type="text/javascript"></script>
</td>
    <td rowspan="2" valign="top" align="right" bgcolor="#2F2F2F">
	<form name="form1" method="post" action="http://www.indosiar.com/videofiesta/search" style="padding-top:2px;">
      <input name="vsearch" type="text" size="15">
      <input type="submit" name="Submit" value="search">
	</form></td>
  </tr>
  <tr>
    <td colspan="3"><a href="http://www.indosiar.com/videofiesta/"><img src="http://www.indosiar.com/videofiesta/img/header_03.gif" width="315" height="50" border="0" /></a></td>
  </tr>
  <tr>
    <td><img src="http://www.indosiar.com/videofiesta/img/header_04.gif" width="315" height="24" /></td>
    <td colspan="2"><img src="http://www.indosiar.com/videofiesta/img/header_05.gif" width="681" height="24" /></td>
  </tr>
  <tr>
    <td colspan="3"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="5" /></td>
  </tr>
</table><table width="996" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="15" height="10" /></td>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="22" background="http://www.indosiar.com/videofiesta/img/bg_bar.gif">
            <div class="boxbar">Fresh Video </div>
          </td>
        </tr>
      </table>
    </td>
    <td><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="16" height="10" /></td>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="22" background="http://www.indosiar.com/videofiesta/img/bg_bar.gif">
            <div class="boxbar">Promoted Video  </div>
          </td>
        </tr>
      </table>
    </td>
    <td><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="15" height="10" /></td>
  </tr>
  <tr>
    <td colspan="5"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">
	
      <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
        <tr>
          <td>
            <div align="center" style="margin-bottom:10px; background-color:#333333">
				<div align="center" style="margin-bottom:10px">
					<div name='mediaspace' id='mediaspace'></div>
	            	<script type="text/javascript" src="http://www.indosiar.com/swf/viral/swfobject.js"></script>
					<script type="text/javascript">
					var so = new SWFObject('http://www.indosiar.com/swf/viral/player-viral.swf','mpl','400','320','9','#ffffff');
						so.addParam('wmode','transparent');
						so.addParam('allowScriptAccess', 'always');
						so.addParam('allowfullscreen','true');
						so.addVariable('enablejs', 'true');
						so.addVariable('width','400');
						so.addVariable('height','320');
						so.addVariable('showstop','true');
						so.addVariable('searchbar','false');
						so.addVariable('channel', '1295');
						so.addVariable('plugins', 'ltas_beta');						
						so.addVariable('file','http://www.indosiar.com/video/videofiesta/KISS_261010_emma-warokaFiesta.flv');
						so.addVariable('ltas.mediaid','http://www.indosiar.com/video/videofiesta/KISS_261010_emma-warokaFiesta.flv');
						so.addVariable('title','Kekasih dan Mantan Kekasih Emma Waroka Adu Jotos');
						so.addVariable('description','Ketenangan Emma Waroka yang tengah menikmati suasana disebuah klub malam, terusik. Pasalnya kekasih-mantan Emma Waroka terlibat baku hantam. Seperti apa kronolgisnya ?');
						so.addVariable('skin','http://www.indosiar.com/swf/jw/skins/stijl.swf');
						so.addVariable('logo','');
						so.addVariable('image','&image=http://www.indosiar.com/images/videofiesta/video_kiss.jpg&');
						so.addVariable('linktarget','_self');
						so.addVariable('backcolor','0xFFFFFF');
						so.addVariable('frontcolor','0x333333');
						so.addVariable('lightcolor','0x000000');
						so.write('mediaspace');
					</script> 
<script language="JavaScript" src="http://www.ltassrv.com/serve/api5.4.asp?d=281&s=318&c=1295&v=1"></script>					
			  </div>				
		    </div>
            </div>
            
            <div><span class="category">Category</span>: <span class="read">KISS                                              </span> </div>
            <div><strong>Video Clip : Kekasih dan Mantan Kekasih Emma Waroka Adu Jotos</strong> </div>
            <div id="keterangan" class="box3"></div>
            <br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>Views: 4472            <div id="rating07012011110101"></div></td>
                <td>
                  <form name="embed" id="embed">
                    <div class="betterTip" id="div3"> Embed:<br />
                        <input onclick="javascript:document.embed.embedtext.select();" id="embedtext" name="embedtext" type="text" size="30" readonly="readonly" value="&lt;object width=&quot;300&quot; height=&quot;237&quot;&gt;&lt;param name=&quot;wmode&quot; value=&quot;transparent&quot;&gt;&lt;/param&gt;&lt;embed src=&quot;http://www.indosiar.com/swf/jw/player.swf?file=http://www.indosiar.com/video/videofiesta/KISS_261010_emma-warokaFiesta.flv&quot; type=&quot;application/x-shockwave-flash&quot; wmode=&quot;transparent&quot; width=&quot;300&quot; height=&quot;237&quot;&gt;&lt;/embed&gt;&lt;/object&gt;" />
                    </div>
                    <div id="div3Tip" style="display:none">use for blogs like wordpress,friendster blog,blogspot etc.</div>
                  </form>
                </td>
              </tr>
              <tr>
                <td>Post: 71 days 21 hours 25 minutes  ago 
		<div><!-- AddThis Button BEGIN -->
<script type="text/javascript">var addthis_pub="kewell";</script>
<a href="http://www.addthis.com/bookmark.php?v=20" onmouseover="return addthis_open(this, '', 'http%3A%2F%2Fwww.indosiar.com%2Fvideofiesta%2Fmaster', 'Kekasih dan Mantan Kekasih Emma Waroka Adu Jotos')" onmouseout="addthis_close()" onclick="return addthis_sendto()"><img src="http://s7.addthis.com/static/btn/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/200/addthis_widget.js"></script>
<!-- AddThis Button END -->
	</div>
                	</td>
              </tr>                
            </table>
            
            <script type="text/javascript">
			
			$(function (){
			
			  function starRater(res){
				$('#rating07012011110101').empty().rater(
					'http://www.indosiar.com/videofiesta/updaterate/3383', {
						maxvalue : 5, 
						style    : 'basic', 
						curvalue : 3,
						callback : function(resoj){
						
							eval("var oj="+resoj);
							
							starRater(oj.Average);
							
							$('#rating07012011110101').children('.star-rating-result').html(
								oj.message 
								+"<br>Your click is : "+oj.myrate
								+"<br>Average is : "+oj.Average 
							)
						}
				});
			  }
			  starRater(0);
			  
			});

				
					function Showketerangan(iditem) {
						 
						 surl = "http://www.indosiar.com/videofiesta/keterangan/" + iditem;
						 $.ajax({
						   type: "GET",
						   url: surl,
						   dataType: "html",
						   beforeSend: function(){
									$('div#keterangan').block('<b>Processing</b>', { border: '3px solid #1F4266' }); 
						   },
						   success: function(msg){
							   	$("#keterangan").html(msg);
							   	$('div#keterangan').unblock(); 
						   }
						 });
					}			
			                                                                                                                                               	
				Showketerangan("3383");
						
			</script>
          <br />
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td height="22" background="http://www.indosiar.com/videofiesta/img/bg_bar.gif">
				  <div class="boxbar">Promoted Video </div>
				</td>
			  </tr>
			</table><br />		  
			
				          <a href="http://www.indosiar.com/videofiesta/kiss/0/3382/duet-anang-syahrini-tergantikan"><img src="http://www.indosiar.com/images/videofiesta/dating.jpg" width="139" height="64" border="0" align="left" /></a>

				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3382/duet-anang-syahrini-tergantikan">Duet Anang-Syahrini Tergantikan</a> </span><br />         
				          
					<span class="category">Category</span>: KISS                                              <br />
					          Views: 6261&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br><br /><div class="separator"></div>
			
				          <a href="http://www.indosiar.com/videofiesta/kiss/0/3381/foto-jennifer-dunn-picu-isu-baru"><img src="http://www.indosiar.com/images/videofiesta/KISS_251010_jennifer-dunn.jpg" width="139" height="64" border="0" align="left" /></a>

				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3381/foto-jennifer-dunn-picu-isu-baru">Foto Jennifer Dunn Picu Isu Baru</a> </span><br />         
				          
					<span class="category">Category</span>: KISS                                              <br />
					          Views: 7399&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br><br /><div class="separator"></div>
			
				          <a href="http://www.indosiar.com/videofiesta/kiss/0/3380/agnes-monica-sosok-penuh-kejutan"><img src="http://www.indosiar.com/images/videofiesta/KISS_181010_Agnes.jpg" width="139" height="64" border="0" align="left" /></a>

				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3380/agnes-monica-sosok-penuh-kejutan">Agnes Monica Sosok Penuh Kejutan</a> </span><br />         
				          
					<span class="category">Category</span>: KISS                                              <br />
					          Views: 8274&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br><br /><div class="separator"></div>
			
				          <a href="http://www.indosiar.com/videofiesta/kiss/0/3379/indonesian-got-talent-curi-perhatian"><img src="http://www.indosiar.com/images/videofiesta/KISS_181010_IGT.jpg" width="139" height="64" border="0" align="left" /></a>

				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3379/indonesian-got-talent-curi-perhatian">Indonesian Got Talent Curi Perhatian</a> </span><br />         
				          
					<span class="category">Category</span>: KISS                                              <br />
					          Views: 4222&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br><br /><div class="separator"></div>
			
				          <a href="http://www.indosiar.com/videofiesta/kiss/0/3378/pasha-akan-menikah-"><img src="http://www.indosiar.com/images/videofiesta/KISS_131010_pasha.jpg" width="139" height="64" border="0" align="left" /></a>

				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3378/pasha-akan-menikah-">Pasha Akan Menikah ?</a> </span><br />         
				          
					<span class="category">Category</span>: KISS                                              <br />
					          Views: 4432&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br><br /><div class="separator"></div>
			
				          <a href="http://www.indosiar.com/videofiesta/kiss/0/3377/adjie-notonegoro-divonis-4-bulan-penjara"><img src="http://www.indosiar.com/images/videofiesta/KISS_131010_adjienoto.jpg" width="139" height="64" border="0" align="left" /></a>

				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3377/adjie-notonegoro-divonis-4-bulan-penjara">Adjie Notonegoro Divonis 4 Bulan Penjara</a> </span><br />         
				          
					<span class="category">Category</span>: KISS                                              <br />
					          Views: 1559&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br><br /><div class="separator"></div>
				
		  </td>
        </tr>
      </table>
    </td>
    <td>&nbsp;</td>
    <td valign="top">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td>
	<div id="screen" >
		<img class="prev" src="http://www.indosiar.com/videofiesta/img/prev.gif" style="cursor:hand" alt="prev" width="42" height="53" />
		<div id="sections">
			<ul>
			
				<li>
			
				          <a href="http://www.indosiar.com/videofiesta/kiss/0/3376/kehidupan-indra-bekti-setelah-menikah"><img src="http://www.indosiar.com/images/videofiesta/KISS_131010_indrabekt.jpg" width="139" height="64" border="0" align="left" /></a>
				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3376/kehidupan-indra-bekti-setelah-menikah">Kehidupan Indra Bekti Setelah Menikah</a> </span><br />         
	
					<span class="category">Category</span>: KISS                                              <br />
					          Views: 2511&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br>
					Post: 84 days 20 hours 35 minutes  ago								          
				</li>
			
				<li>
			
				          <a href="http://www.indosiar.com/videofiesta/kiss/0/3375/jadwal-padat-calon-putri-indonesia-2010"><img src="http://www.indosiar.com/images/videofiesta/040910_putriindonesia.jpg" width="139" height="64" border="0" align="left" /></a>
				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3375/jadwal-padat-calon-putri-indonesia-2010">Jadwal Padat Calon Putri Indonesia 2010</a> </span><br />         
	
					<span class="category">Category</span>: KISS                                              <br />
					          Views: 2508&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br>
					Post: 94 days 1 hours 40 minutes  ago								          
				</li>
			
				<li>
			
				          <a href="http://www.indosiar.com/videofiesta/kiss/0/3374/trio-libels-luncurkan-album-dan-tetap-digemari"><img src="http://www.indosiar.com/images/videofiesta/040910_triolibels.jpg" width="139" height="64" border="0" align="left" /></a>
				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3374/trio-libels-luncurkan-album-dan-tetap-digemari">Trio Libels Luncurkan Album Dan Tetap Digemari</a> </span><br />         
	
					<span class="category">Category</span>: KISS                                              <br />
					          Views: 1023&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br>
					Post: 94 days 1 hours 41 minutes  ago								          
				</li>
			
				<li>
			
				          <a href="http://www.indosiar.com/videofiesta/kiss/0/3373/rahasia-rhoma-irama-tetap-eksis"><img src="http://www.indosiar.com/images/videofiesta/040910_rhoma-irama.jpg" width="139" height="64" border="0" align="left" /></a>
				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3373/rahasia-rhoma-irama-tetap-eksis">Rahasia Rhoma Irama Tetap Eksis</a> </span><br />         
	
					<span class="category">Category</span>: KISS                                              <br />
					          Views: 1868&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br>
					Post: 94 days 1 hours 42 minutes  ago								          
				</li>
			
				<li>
				          <a href="http://www.indosiar.com/videofiesta/3372/1-lawan-100-promo"><img src="http://www.indosiar.com/images/videofiesta/1lawan100-fiesta.jpg" width="139" height="64" border="0" align="left" /></a>
				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/3372/1-lawan-100-promo">1 lawan 100 promo</a> </span><br />         		
	
					<span class="category">Category</span>: Lain-Lain                                         <br />
					          Views: 2620&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br>
					Post: 106 days 23 hours 37 minutes  ago								          
				</li>
			
				<li>
				          <a href="http://www.indosiar.com/videofiesta/3371/fans-meeting-kim-bum"><img src="http://www.indosiar.com/images/videofiesta/kimbumfansmeet.jpg" width="139" height="64" border="0" align="left" /></a>
				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/3371/fans-meeting-kim-bum">Fans Meeting Kim Bum</a> </span><br />         		
	
					<span class="category">Category</span>: Music                                             <br />
					          Views: 5328&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br>
					Post: 139 days 18 hours 21 minutes  ago								          
				</li>
			
				<li>
				          <a href="http://www.indosiar.com/videofiesta/3370/kim-bum-eksklusif-interview"><img src="http://www.indosiar.com/images/videofiesta/kimbuminterview.jpg" width="139" height="64" border="0" align="left" /></a>
				          <span class="judul"><a href="http://www.indosiar.com/videofiesta/3370/kim-bum-eksklusif-interview">Kim Bum Eksklusif Interview</a> </span><br />         		
	
					<span class="category">Category</span>: Music                                             <br />
					          Views: 5741&nbsp;
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
														           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					<br>
					Post: 139 days 20 hours 54 minutes  ago								          
				</li>
			</ul>
		</div>
		<img class="next" src="http://www.indosiar.com/videofiesta/img/next.gif" style="cursor:hand" alt="next" width="42" height="53" />
	</div>
	
          </td>
        </tr>
      </table>
      <div style="clear:both">
	  <br />	  
	  <br />	  
	  <br />	  
	  <br />	  
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="22" background="http://www.indosiar.com/videofiesta/img/bg_bar.gif">
      <div class="boxbar">Featured Video </div>
    </td>
  </tr>
</table>
      <img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" />
	  
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139"><a href="http://www.indosiar.com/videofiesta/3369/kim-bum-fans-meeting"><img src="http://www.indosiar.com/images/videofiesta/kimbumfansmeet.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/3369/kim-bum-fans-meeting">Kim Bum Fans Meeting</a> </span><br />Post: 139 days 21 hours 11 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />Drama Asia                                        <br />
          Views: 1703<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					
		  </td>
        </tr>
      </table>
	  <div class="separator"></div>
	  
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139"><a href="http://www.indosiar.com/videofiesta/3368/"><img src="http://www.indosiar.com/images/videofiesta/kimbumfansmeet.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/3368/"></a> </span><br />Post: 139 days 21 hours 17 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />Drama Asia                                        <br />
          Views: 481<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					
		  </td>
        </tr>
      </table>
	  <div class="separator"></div>
	  
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139"><a href="http://www.indosiar.com/videofiesta/3367/"><img src="http://www.indosiar.com/images/videofiesta/kimbumfansmeet.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/3367/"></a> </span><br />Post: 139 days 21 hours 21 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />Drama Asia                                        <br />
          Views: 420<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					
		  </td>
        </tr>
      </table>
	  <div class="separator"></div>
	  
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	
          <td width="139"><a href="http://www.indosiar.com/videofiesta/kiss/0/3366/nama-besar-adjie-notonegoro-dipertaruhkan"><img src="http://www.indosiar.com/images/videofiesta/KISS_190710_adjie-notonegoro-dipertaruhkan.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3366/nama-besar-adjie-notonegoro-dipertaruhkan">Nama Besar Adjie Notonegoro Dipertaruhkan</a> </span><br />Post: 170 days 19 hours 37 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />KISS                                              <br />
          Views: 7650<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					
		  </td>
        </tr>
      </table>
	  <div class="separator"></div>
	  
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	
          <td width="139"><a href="http://www.indosiar.com/videofiesta/kiss/0/3365/adjie-notonegoro-tersandung-kasus-penipuan"><img src="http://www.indosiar.com/images/videofiesta/KISS_190710_adjie-notonegoro.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3365/adjie-notonegoro-tersandung-kasus-penipuan">Adjie Notonegoro Tersandung Kasus Penipuan</a> </span><br />Post: 170 days 19 hours 40 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />KISS                                              <br />
          Views: 4274<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					
		  </td>
        </tr>
      </table>
	  <div class="separator"></div>
	  
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	
          <td width="139"><a href="http://www.indosiar.com/videofiesta/kiss/0/3364/cut-tari-dapatkan-dukungan"><img src="http://www.indosiar.com/images/videofiesta/KISS_cuttari-dukungan.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3364/cut-tari-dapatkan-dukungan">Cut Tari Dapatkan Dukungan</a> </span><br />Post: 170 days 19 hours 42 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />KISS                                              <br />
          Views: 6860<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					
		  </td>
        </tr>
      </table>
	  <div class="separator"></div>
	  
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	
          <td width="139"><a href="http://www.indosiar.com/videofiesta/kiss/0/3363/luna-ditahan-atau-diamankan"><img src="http://www.indosiar.com/images/videofiesta/KISS_Luna-diamankan.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3363/luna-ditahan-atau-diamankan">Luna Ditahan atau Diamankan</a> </span><br />Post: 170 days 19 hours 44 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />KISS                                              <br />
          Views: 7057<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					
		  </td>
        </tr>
      </table>
	  <div class="separator"></div>
	  
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	
          <td width="139"><a href="http://www.indosiar.com/videofiesta/kiss/0/3362/cut-tari-meminta-maaf"><img src="http://www.indosiar.com/images/videofiesta/KISS_090710_Maaf-cuttari.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3362/cut-tari-meminta-maaf">Cut Tari Meminta Maaf</a> </span><br />Post: 181 days 18 hours 23 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />KISS                                              <br />
          Views: 10636<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
					
		  </td>
        </tr>
      </table>
	  <div class="separator"></div>
	 
    </td>
    <td>&nbsp;</td>
  </tr>
</table>
<!--
<table width="996" height="26" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="7">&nbsp;</td>
    <td width="240"><img src="http://ww1.indosiar.com/banner/jendela_240_70.jpg" width="240" height="70" /></td>
    <td width="7">&nbsp;</td>
    <td width="240"><img src="http://ww1.indosiar.com/banner/mezza_spazio09.gif" width="240" height="70" /></td>
    <td width="8">&nbsp;</td>
    <td width="240"><img src="http://ww1.indosiar.com/banner/blog_240_70.jpg" width="240" height="70" /></td>
    <td width="7">&nbsp;</td>
    <td width="240"><img src="http://ww1.indosiar.com/banner/fullhouse240_70.gif" width="240" height="70" /></td>
    <td width="7">&nbsp;</td>
  </tr>
</table>
-->
<table width="996" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="15" height="10" /><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="16" height="10" /><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="15" height="10" /></td>
  </tr>
  <tr>
    <td width="15"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="15" height="10" /></td>
    <td >
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td height="22" background="http://www.indosiar.com/videofiesta/img/bg_bar.gif">
		  <div class="boxbar">Featured Video </div>
		</td>
	  </tr>
	</table>
    </td>
    <td width="16"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="16" height="10" /></td>
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td height="22" background="http://www.indosiar.com/videofiesta/img/bg_bar.gif">
		  <div class="boxbar">Featured Video </div>
		</td>
	  </tr>
	</table>
    </td>
    <td width="15"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="15" height="10" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="518" valign="top">
		
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	
          <td width="139"><a href="http://www.indosiar.com/videofiesta/kiss/0/3361/kesetiaan-seorang-yusuf-subrata"><img src="http://www.indosiar.com/images/videofiesta/KISS_090710_yusuf-subrata.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3361/kesetiaan-seorang-yusuf-subrata">Kesetiaan Seorang Yusuf Subrata</a> </span><br />Post: 181 days 18 hours 22 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />KISS                                              <br />
          Views: 6894<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
			</td>
        </tr>
      </table>
	  <div class="separator"></div>
		
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	
          <td width="139"><a href="http://www.indosiar.com/videofiesta/kiss/0/3360/ariel-dapat-banyak-dukungan"><img src="http://www.indosiar.com/images/videofiesta/KISS_290610_dukungan-ariel.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3360/ariel-dapat-banyak-dukungan">Ariel Dapat Banyak Dukungan</a> </span><br />Post: 190 days 21 hours 34 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />KISS                                              <br />
          Views: 7088<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
			</td>
        </tr>
      </table>
	  <div class="separator"></div>
		
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	
          <td width="139"><a href="http://www.indosiar.com/videofiesta/kiss/0/3359/luna-tetap-setia"><img src="http://www.indosiar.com/images/videofiesta/KISS_290610_luna-jenguk-ariel.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3359/luna-tetap-setia">Luna Tetap Setia</a> </span><br />Post: 190 days 21 hours 36 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />KISS                                              <br />
          Views: 3356<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
			</td>
        </tr>
      </table>
	  <div class="separator"></div>
		
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139"><a href="http://www.indosiar.com/videofiesta/3358/take-him-out-indonesia-ranny-belajar-dari-pengalaman"><img src="http://www.indosiar.com/images/videofiesta/Take_Him_Out-270610_Ranny-Zaenal.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/3358/take-him-out-indonesia-ranny-belajar-dari-pengalaman">Take Him Out Indonesia: Ranny, Belajar Dari Pengalaman</a> </span><br />Post: 190 days 21 hours 40 minutes  ago</td>
	          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />Take Him Out Indonesia<br />
          Views: 13263<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
			</td>
        </tr>
      </table>
	  <div class="separator"></div>
 	

      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="22" background="http://www.indosiar.com/videofiesta/img/bg_bar.gif">
            <div class="boxbar">Most Commented Video </div>          </td>
        </tr>
      </table>
	<img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="16" height="10" />	 
                        <div><a href="http://www.indosiar.com/videofiesta/3106/opening-song-boys-before-flowers">
                          Opening Song Boys Before Flowers                          </a> Comments:
                          1528                          &nbsp;<img src="http://www.indosiar.com/videofiesta/img/comment_icon_white.png" /> </div>
                                              <div><a href="http://www.indosiar.com/videofiesta/48/they-kiss-again">
                          They Kiss Again                          </a> Comments:
                          1157                          &nbsp;<img src="http://www.indosiar.com/videofiesta/img/comment_icon_white.png" /> </div>
                                              <div><a href="http://www.indosiar.com/videofiesta/20/ost---full-house">
                          OST - Full House                          </a> Comments:
                          1061                          &nbsp;<img src="http://www.indosiar.com/videofiesta/img/comment_icon_white.png" /> </div>
                                              <div><a href="http://www.indosiar.com/videofiesta/43/supermama-memang-top">
                          Supermama Memang TOP                          </a> Comments:
                          867                          &nbsp;<img src="http://www.indosiar.com/videofiesta/img/comment_icon_white.png" /> </div>
                                              <div><a href="http://www.indosiar.com/videofiesta/2982/opening-theme-song-queen-seon-deok">
                          Opening Theme Song Queen Seon Deok                          </a> Comments:
                          737                          &nbsp;<img src="http://www.indosiar.com/videofiesta/img/comment_icon_white.png" /> </div>
                                              <div><a href="http://www.indosiar.com/videofiesta/589/bobby-bagus-tampil-makin-ekspresif-dengan-ekspresi">
                          Bobby-Bagus Tampil Makin Ekspresif dengan 'Ekspresi'                          </a> Comments:
                          687                          &nbsp;<img src="http://www.indosiar.com/videofiesta/img/comment_icon_white.png" /> </div>
                                              <div><a href="http://www.indosiar.com/videofiesta/68/ivan-yang-malang">
                          Ivan Yang Malang                          </a> Comments:
                          593                          &nbsp;<img src="http://www.indosiar.com/videofiesta/img/comment_icon_white.png" /> </div>
                                              <div><a href="http://www.indosiar.com/videofiesta/24/naruto4">
                          NARUTO4                          </a> Comments:
                          551                          &nbsp;<img src="http://www.indosiar.com/videofiesta/img/comment_icon_white.png" /> </div>
                                              <div><a href="http://www.indosiar.com/videofiesta/3163/opening-brilliant-legacy">
                          Opening Brilliant Legacy                          </a> Comments:
                          544                          &nbsp;<img src="http://www.indosiar.com/videofiesta/img/comment_icon_white.png" /> </div>
                                              <div><a href="http://www.indosiar.com/videofiesta/3383/kekasih-dan-mantan-kekasih-emma-waroka-adu-jotos">
                          Kekasih dan Mantan Kekasih Emma Waroka Adu Jotos                          </a> Comments:
                          508                          &nbsp;<img src="http://www.indosiar.com/videofiesta/img/comment_icon_white.png" /> </div>
                        	
    <td>&nbsp;</td>
    <td width="518" valign="top">
		
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139"><a href="http://www.indosiar.com/videofiesta/3357/take-him-out-indonesia-putra-pria-jujur"><img src="http://www.indosiar.com/images/videofiesta/Take_Him_Out-270610_Achiet-Putra.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/3357/take-him-out-indonesia-putra-pria-jujur">Take Him Out Indonesia: Putra, Pria Jujur</a> </span><br />Post: 190 days 21 hours 43 minutes  ago</td>
          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />Take Him Out Indonesia<br />
          Views: 8436<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
			</td>
        </tr>
      </table>
	  <div class="separator"></div>
		
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139"><a href="http://www.indosiar.com/videofiesta/3356/take-me-out-indonesia-ada-keiripan-antara-robiana-iing"><img src="http://www.indosiar.com/images/videofiesta/TMO_270610_Iing-Robiana.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/3356/take-me-out-indonesia-ada-keiripan-antara-robiana-iing">Take Me Out Indonesia: Ada Keiripan Antara Robiana-Iing</a> </span><br />Post: 190 days 21 hours 48 minutes  ago</td>
          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />Take Me Out Indonesia<br />
          Views: 5077<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
			</td>
        </tr>
      </table>
	  <div class="separator"></div>
		
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139"><a href="http://www.indosiar.com/videofiesta/3355/take-me-out-indonesia-suka-touring-dicky-pilih-hesti"><img src="http://www.indosiar.com/images/videofiesta/TMO_270610_Dicky-Hesti.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/3355/take-me-out-indonesia-suka-touring-dicky-pilih-hesti">Take Me Out Indonesia: Suka Touring, Dicky Pilih Hesti</a> </span><br />Post: 190 days 21 hours 51 minutes  ago</td>
          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />Take Me Out Indonesia<br />
          Views: 4298<br />
			  		  
                          <img src="http://www.indosiar.com/videofiesta/img/star-empty.gif" width="18" height="18" />
			</td>
        </tr>
      </table>
	  <div class="separator"></div>
		
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	
          <td width="139"><a href="http://www.indosiar.com/videofiesta/kiss/0/3354/isu-tak-mendapat-restu-terpa-choky"><img src="http://www.indosiar.com/images/videofiesta/KISS_220610_beda-agama.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3354/isu-tak-mendapat-restu-terpa-choky">Isu Tak mendapat Restu Terpa Choky</a> </span><br />Post: 197 days 21 hours 10 minutes  ago</td>
          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />KISS                                              <br />
          Views: 11058<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
			</td>
        </tr>
      </table>
	  <div class="separator"></div>
		
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
	
          <td width="139"><a href="http://www.indosiar.com/videofiesta/kiss/0/3353/artis-penggemar-tatoo"><img src="http://www.indosiar.com/images/videofiesta/KISS_220610_tatoo.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/kiss/0/3353/artis-penggemar-tatoo">Artis Penggemar Tatoo</a> </span><br />Post: 197 days 21 hours 15 minutes  ago</td>
          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />KISS                                              <br />
          Views: 3729<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
			</td>
        </tr>
      </table>
	  <div class="separator"></div>
		
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139"><a href="http://www.indosiar.com/videofiesta/3352/take-him-out-indonesia-rima-pilih-reza"><img src="http://www.indosiar.com/images/videofiesta/Take_Him_Out_Rima-Reza_130610.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/3352/take-him-out-indonesia-rima-pilih-reza">Take Him Out Indonesia: Rima Pilih Reza</a> </span><br />Post: 205 days 44 minutes  ago</td>
          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />Take Him Out Indonesia<br />
          Views: 4115<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
			</td>
        </tr>
      </table>
	  <div class="separator"></div>
		
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="139"><a href="http://www.indosiar.com/videofiesta/3351/take-him-out-indonesia-cici-fiqhi-orangnya-jujur"><img src="http://www.indosiar.com/images/videofiesta/Take_Him_Out_Cici-Fiqhi.jpg" width="139" height="64" border="0" /></a></td>
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="260"><span class="judul"><a href="http://www.indosiar.com/videofiesta/3351/take-him-out-indonesia-cici-fiqhi-orangnya-jujur">Take Him Out Indonesia: Cici, Fiqhi Orangnya Jujur</a> </span><br />Post: 205 days 48 minutes  ago</td>
          	
          <td width="10"><img src="http://www.indosiar.com/videofiesta/img/blnk.gif" width="10" height="10" /></td>
          <td width="121"><span class="category">Category</span>:<br />Take Him Out Indonesia<br />
          Views: 3323<br />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
				           <img src="http://www.indosiar.com/videofiesta/img/star-ps.gif" width="18" height="18" />
			</td>
        </tr>
      </table>
	  <div class="separator"></div>
 	
    </td>
    <td>&nbsp;</td>
  </tr>
</table>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-2033320-1";
urchinTracker();
</script>
<!-- Histats.com START -->
<a href="http://www.histats.com" target="_blank" title="counter create hit" >
<script type="text/javascript" language="javascript">

var s_sid = 140814;var st_dominio = 4;
var cimg = 0;var cwi =150;var che =30;
</script>
<script type="text/javascript" language="javascript" src="http://s10.histats.com/js9.js"></script>
</a>
<noscript><a href="http://www.histats.com" target="_blank">
<img src="http://s4.histats.com/stats/0.gif?140814&1" alt="counter create hit" border="0"></a>
</noscript>

<!-- Histats.com END -->

<table width="996" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="33" valign="bottom"  background="http://www.indosiar.com/videofiesta/img/footer.gif" class="style2">
      <div align="right">&copy; 2008, INDOSIAR.COM&nbsp;&nbsp;&nbsp;&nbsp;</div>
    </td>
  </tr>
</table>
<!--<p align="center">Page rendered in 0.1578 seconds - 1.15MB</p>-->
</body>
</html>