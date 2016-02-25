<?
echo 'START = '.date("Y-m-d H:i:s").'<br />';

include("../blakang/db.php");

$data = grab_url('http://www.goal.com/en/scores/result-standings/277/liga-primer-indonesia');
$data = preg_replace('/<a href="(.*)">(.*)<\/a>/U', '\\2', $data);
$data = preg_replace('/<td (.*)>/U', '<td>', $data);
$data = preg_replace('/<tr (.*)>/U', '<tr>', $data);

$strData = "";

if (preg_match('/<table id="roundResultsTable" cellspacing="0">(.*)<\/table>/sU', $data, $match)) {
	$strData .= '
	<table width="100%" cellpadding="5" cellspacing="1" style="border:1px solid #999">
		<tr align="center" bgcolor="#EA172A">
			<td><b>TANGGAL</b></td>
			<td><b>KANDANG</b></td>
			<td><b>TANDANG</b></td>
			<td><b>HASIL</b></td>
		</tr>';
		
	$match[1] = str_replace(array('<td>','<tr>','<tbody>','</tbody>',"\r\n","\n"), '', $match[1]);
	$arrTR = explode('</tr>', $match[1]);
	$i = 1;
	foreach($arrTR as $tmpTD) {
		if (trim($tmpTD) != "") {
			$arrTD = explode('</td>', $tmpTD);
			$arrVS = explode(' - ', $arrTD[0]);
			$bgcolor = ($i%2 == 1) ? '#efefef' : '#ffffff';
			$strData .= '
			<tr align="center" bgcolor="'.$bgcolor.'">
				<td>'.date("d-M-Y", strtotime(trim($arrTD[2]))).'</td>
				<td>'.$arrVS[0].'</td>
				<td>'.$arrVS[1].'</td>
				<td>'.$arrTD[1].'</td>
			</tr>';
			
			$i++;
		}
	}
	
	$strData .= '
	</table>';
}

if (preg_match('/<table id="teamStandings">(.*)<\/table>/sU', $data, $match)) {
	$match[1] = preg_replace('/<thead>(.*)<\/thead>/s', '', $match[1]);
	//$match[1] = str_replace('<td><img src="', '<td width="30"><img src="', $match[1]);
	
	$strData .= '
	<p>&nbsp;</p>
	<table width="100%" cellpadding="3" cellspacing="1" style="border:1px solid #999">
  <tr align="center">
    <td colspan="2" rowspan="2" bgcolor="#EA172A"><b>Team</b></td>
    <td bgcolor="#EA172A" colspan="5"><b>Matches</b></td>
    <td bgcolor="#EA172A" colspan="3"><b>Home</b></td>
    <td bgcolor="#EA172A" colspan="3"><b>Away</b></td>
    <td bgcolor="#EA172A" colspan="2"><b>Goals</b></td>
  </tr>
  <tr align="center">
    <td bgcolor="#EA172A"><b>Pts</b></td>
    <td bgcolor="#EA172A"><b>GP</b></td>
    <td bgcolor="#EA172A"><b>Wins</b></td>
    <td bgcolor="#EA172A"><b>Draws</b></td>
    <td bgcolor="#EA172A"><b>Losses</b></td>
    <td bgcolor="#EA172A"><b>Wins</b></td>
    <td bgcolor="#EA172A"><b>Draws</b></td>
    <td bgcolor="#EA172A"><b>Losses</b></td>
    <td bgcolor="#EA172A"><b>Wins</b></td>
    <td bgcolor="#EA172A"><b>Draws</b></td>
    <td bgcolor="#EA172A"><b>Losses</b></td>
    <td bgcolor="#EA172A"><b>GS</b></td>
    <td bgcolor="#EA172A"><b>GA</b></td>
  </tr>';
  
  $arrTR = explode('<tr>', $match[1]);
  $i = 1;
	foreach($arrTR as $tmpTD) {
		if (trim($tmpTD) != "") {
			$bgcolor = ($i%2 == 1) ? '#efefef' : '#ffffff';
			
			$strData .= '
			<tr align="center" bgcolor="'.$bgcolor.'">'.$tmpTD;
			
			$i++;
		}
	}
	
	$strData .= '
	</table>';
}

if (strlen($strData) > 100) file_put_contents('../inc/score_lpi.php', $strData);

echo 'END = '.date("Y-m-d H:i:s").'<br />';
?>