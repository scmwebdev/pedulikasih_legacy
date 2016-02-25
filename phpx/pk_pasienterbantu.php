<?
include("../blakang/db.php");
function pk_dbconnect() {
	global $koneksidb;

	$koneksidb = mysql_connect (DB_HOST, DB_USERNAME, DB_PASSWORD);
	if (!$koneksidb) die('Could not connect: ' . mysql_error());
	mysql_select_db('pedulikasih') or die ('Can not use pedulikasih : ' . mysql_error());
}

pk_dbconnect();

$tgl = trim($_REQUEST["tgl"]);
if ($tgl == "") {
	$sql = "select tanggal from daftar_pasien_pk order by tgl_rek desc limit 1";
	$result = mysql_query($sql);
	list($tgl) = mysql_fetch_row($result);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css.css" type="text/css" />
</head>
<body>
<form method="post" action="pk_pasienterbantu.php">
<select name="tgl">
  <option value="">Tanggal Lainnya</option>
<?
$sql = "select tanggal from daftar_pasien_pk group by tanggal order by tanggal desc";
$result = mysql_query($sql);
while ($row = mysql_fetch_assoc($result)) {
	echo '
	<option value="'.$row["tanggal"].'"'.(($tgl == $row["tanggal"]) ? ' selected' : '').'>'.$row["tanggal"].'</option>';
}
 mysql_free_result($result);
?>
</select>
<input type=submit name=Submit value="Submit">
</form>
<?
$batas = 25;

$page = trim($_REQUEST["page"]);
if ($page == "" || !is_numeric($page)) $page = 1;
$strlimit = ($page == 1) ? " limit 0, $batas" : " limit ". ($page-1) * $batas .", $batas";

$sqltot = "select id from daftar_pasien_pk where tanggal='$tgl'";
$sql = "select * from daftar_pasien_pk where tanggal='$tgl' order by nama".$strlimit;

$result = mysql_query($sqltot);
$totresult = mysql_num_rows($result);
mysql_free_result($result);

if ($totresult > 0) {
	$totpage = ceil($totresult/$batas);
	$strurlpage = "";
	if ($totpage > 1) {
		if ($totpage > 100) $totpage = 100;
		for ($i = 1; $i <= $totpage; $i++) {
			if ($page == $i)
				$strurlpage .= '<option SELECTED>'.$i.'</option>'."\r\n";
			else
				$strurlpage .= '<option value="pasienterbantu.php?tgl='.$tgl.'&page='.$i.'">'.$i.'</option>'."\r\n";
		}
	}
	
	echo '
	<b>Daftar Pasien Yang Telah Terbantu per-'.$tgl.' :</b>
  <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:1px solid #333">
    <tr bgcolor="#D6DFF7" align="center"> 
      <td><b>NO</b></td>
      <td><b>NAMA</b></td>
      <td><b>UMUR</b></td>
      <td><b>PENYAKIT</b></td>
      <td><b>RUMAH SAKIT</b></td>
    </tr>';
  
  $iNum = ($page * $batas) - $batas;
  $result = mysql_query($sql);
  while ($row = mysql_fetch_assoc($result)) {
  	$iNum++;
  	$bgcolor = ($iNum % 2 == 1) ? "#EFEFEF" : "#FFFFFF";
  	
  	echo '
  	<tr bgcolor="'.$bgcolor.'">
  		<td align="center">'.$iNum.'</td>
  		<td>'.$row["nama"].'</td>
  		<td align="center">'.$row["umur"].'</td>
  		<td>'.$row["penyakit"].'</td>
  		<td>'.$row["rumahsakit"].'</td>
  	</tr>';
	}
	mysql_free_result($result);
	
  echo '
  </table>';
  
  if ($strurlpage != "") {
	  echo '
	  <table>
		  <form>
		  <tr>
		  	<td>Page</td>
		  	<td>
					<select style="font:12px verdana, arial, sans-serif;text-decoration:none;background-color:#FFFFFF;" name=select2 onChange="javascript:if( options[selectedIndex].value != \'\') document.location = options[selectedIndex].value">
					'.$strurlpage.'
		  		</select>
		  	</td>
		  	<td>of '.$totpage.'</td>
		  </tr>
		  </form>
	  </table>';
	}
}
?>
</body>
</html>  
<?
dbclose();
?>