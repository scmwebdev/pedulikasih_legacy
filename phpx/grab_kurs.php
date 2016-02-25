<?
include("../backend/db.php");

$data = grab_url('http://www.klikbca.com/individual/silver/Ind/rates.html', 'http://www.klikbca.com/');

if (preg_match('/<strong>DD\/TT<\/strong><br>(.*)<!--- Mulai proses untuk yang BN----->/s', $data, $match)) {
	$match[1] = str_replace(array("\n","\r","\r\n"), '', $match[1]);
	$arr = explode("</tr>", $match[1]);
	$tmpdata = "";	
	for ($i=0; $i<=count($arr)-1; $i++) {
		if ($i == 0) {
			$tmpdata = preg_replace('/<font color="black" size="1" face="Arial">(.*)<\/font><\/div><\/td>/s', '\\1', $arr[0]);
		}
		
		if ($i > 0) {
			if (preg_match('/&nbsp;(.*)<\/center><\/td>                        <td valign="top" align="right">(.*)&nbsp;<\/td>                        <td valign="top" align="right">(.*)&nbsp;<\/td>/', $arr[$i], $matchx)) {
				$tmpdata .= "\n".$matchx[1].'|'.$matchx[2].'|'.$matchx[3];
			}
		}
	}
	file_put_contents(ROOTBASEPATH.'inc/kurs.txt', $tmpdata);
}
?>