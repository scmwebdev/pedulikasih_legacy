<?php
$HTMLPageTitle= "INDOSIAR Live Streaming";
$HTMLMetaDescription = "INDOSIAR Live TV Streaming";
$HTMLMetaKeywords = "indosiar streaming";
include (APPPATH."views/inc_header.php");
?>
			<h1>Live Streaming</h1>
			<p>&nbsp;</p>
			<div style="text-align:center">
				<table style="width:500px;margin:0 auto;">
					<tr>
						<td><div id="video-preview">&nbsp;</div></td>
					</tr>
				</table>
			</div>
			<script type="text/javascript" src="/assets/jwplayer/jwplayer.js"></script>
			<script type="text/javascript">
			  jwplayer('video-preview').setup({
			    'flashplayer': '/assets/jwplayer/player.swf',
			    'width': '500',
			    'height': '400',
			    'autoplay': true,
			    'playlist': [
			        {
			           'title': 'INDOSIAR Live Streaming',
								 'image': '/assets/jwplayer/stream-indosiar.jpg',
								 'skin' : '/assets/jwplayer/glow.zip',
			           'provder': 'rtmp',
			           'duration': '00:00:00',
			           'streamer': 'rtmp://202.58.124.140/live',
			           'levels': [
			              {bitrate:"320", width:"500", file:"ivm_128"},
			              {bitrate:"480", width:"500", file:"ivm_256"},
			              {bitrate:"650", width:"500", file:"ivm_500"}
			           ]
			        }
			    ]
			  });
			</script>	
<?
include (APPPATH."views/inc_footer.php");
?>