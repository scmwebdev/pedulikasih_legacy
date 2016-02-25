<?
function get_data($url)
{
$ch = curl_init();
$timeout = 5;
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);     
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

function get_string_between($string, $start, $end){
	$string = " ".$string;
	$ini = strpos($string,$start);
	if ($ini == 0) return "";
	$ini += strlen($start);
	$len = strpos($string,$end,$ini) - $ini;
	return substr($string,$ini,$len);
}

$data=get_data("http://ligaprimerindonesia.co.id/table.html");
$content=get_string_between($data,'<div style="padding-top:10px;">','<div style="background:url(images/fixturetbl3.png) top left no-repeat;width:606px;height:45px;">');
$content='<div style="padding-top:10px;">'.$content;
$content=str_replace("images/","http://ligaprimerindonesia.co.id/images/",$content);
$content=str_replace("club/","http://ligaprimerindonesia.co.id/club/",$content);
?>
<div style="width:599px;margin: 0 11px 10px 0;float:left;">
					<div style="background:url(http://ligaprimerindonesia.co.id/images/articletop.png) top left repeat-x; width:599px;height:50px;">
						<div style="float:left;color:white;font-size:20px;margin-top:17px;margin-left:11px;">Statistik Liga Primer Indonesia</div><div style="float:right;align:right;"><img src="http://ligaprimerindonesia.co.id/images/lpiarticle.png" border="0" /></div>
						<div style="clear:both;"></div>
					</div>
<?
if ($content!="") echo $content;
?>
</div>