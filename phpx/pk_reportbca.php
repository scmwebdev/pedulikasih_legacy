<?
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://www.indosiar.com/pedulikasih");

include("../blakang/db.php");
function pk_dbconnect() {
	global $koneksidb;

	$koneksidb = mysql_connect (DB_HOST, DB_USERNAME, DB_PASSWORD);
	if (!$koneksidb) die('Could not connect: ' . mysql_error());
	mysql_select_db('pedulikasih') or die ('Can not use pedulikasih : ' . mysql_error());
}

pk_dbconnect();

$kategori = trim($_REQUEST["kategori"]);
if ($kategori != "person" && $kategori != "company") $kategori = "person";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css.css" type="text/css" />
<script type="text/javascript" LANGUAGE="JavaScript">
function bca(){
popup = window.open("http://www.klikbca.com","","");
}

function ValidNumber(thestring)
{
    for (i = 0; i < thestring.length; i++) {
        ch = thestring.substring(i, i+1);
        if (ch < "0" || ch > "9")
          {
          alert("Masukan harus sebuah nilai numerik");
          window.opener.location.href="reportbca.php?kategori=<?=$kategori?>";
          return false;
          }
    }
    return true;
}
function chknum(fld)
{ 
   if(!ValidNumber(fld.value)) {
     fld.value = "";
     fld.focus(); } 
}

</script>
</head>
<body>
<table border="0" cellspacing="1" cellpadding="2" width="100%">
  <form action="pk_reportbca.php" method=post name="form1">
  	<input type="hidden" name="kategori" value="<?=$kategori?>" />
    <tr> 
      <td align="center" bgcolor="#FFFFFF"><b>Kata Kunci</b> 
        <select name="jenis">
          <option value="nama">Nama</option>
          <option value="kota">Kota</option>
          <option value="all">Semua Kanal</option>
        </select>
        <input type="text" name="qword">
        <input type="hidden" name="que" value="1">
        <input type="submit" name="Submit2" value=" Cari! ">
      </td>
    </tr>
  </form>
  <form action="pk_reportbca.php" method=post name="form2">
  <input type="hidden" name="kategori" value="<?=$kategori?>" />
    <tr> 
      <td align="center" bgcolor="#FFFFFF"><b>Nilai Antara</b> 
        <input type="text" name="satu" onBlur="chknum(document.form2.satu)">
        <b>Sampai</b> 
        <input type="text" name="dua" onBlur="chknum(document.form2.dua)">
        <input type="hidden" name="que" value="2">
        <input type="submit" name="Submit1" value=" Cari! ">
      </td>
    </tr>
  </form>
</table>
<?
$batas = 25;

$page = trim($_REQUEST["page"]);
if ($page == "" || !is_numeric($page)) $page = 1;
$strlimit = ($page == 1) ? " limit 0, $batas" : " limit ". ($page-1) * $batas .", $batas";

$sqltot = "select id from pedulikasih1 where kategori='$kategori'";
$resulttot = mysql_query($sqltot);
$totpenyumbang = mysql_num_rows($resulttot);

$sqltot = "select ID from pedulikasih1 where kategori='$kategori'";
$sql = "select * from pedulikasih1 where kategori='$kategori' order by tanggal desc".$strlimit;

$que = trim($_REQUEST["que"]);
if ($que == 1) {
	$qword = trim($_REQUEST["qword"]);
	$jenis = trim($_REQUEST["jenis"]);
	
	if ($jenis == "kota") {
		$sqltot = "select id from pedulikasih1 where kategori='$kategori' and kota like '%$qword%'";
		$sql = "select * from pedulikasih1 where kategori='$kategori' and kota like '%$qword%' order by tanggal desc ".$strlimit;
	} elseif ($jenis == "nama") {
		$sqltot = "select id from pedulikasih1 where kategori='$kategori' and nama like '%$qword%'";
		$sql = "select * from pedulikasih1 where kategori='$kategori' and nama like '%$qword%' order by tanggal desc ".$strlimit;
	} else {
		$sqltot = "select id from pedulikasih1 where kategori='$kategori' and (nama like '%$qword%' or kota like '%$qword%')";
		$sql = "select * from pedulikasih1 where kategori='$kategori' and (nama like '%$qword%' or kota like '%$qword%') order by tanggal desc ".$strlimit;
	}
} elseif ($que == 2) {
	$satu = trim($_REQUEST["satu"]);
	$dua = trim($_REQUEST["dua"]);
	if ($satu != "" && $dua == "") {
		$sqltot = "select id from pedulikasih1 where kategori='$kategori' and nilai between $satu and 300000000";
		$sql = "select * from pedulikasih1 where kategori='$kategori' and nilai between $satu and 300000000 order by nilai desc".$strlimit;
	} elseif ($satu == "" && $dua != "") {
		$sqltot = "select id from pedulikasih1 where kategori='$kategori' and nilai between 0 and $dua";
		$sql = "select * from pedulikasih1 where kategori='$kategori' and nilai between 0 and $dua order by nilai desc".$strlimit;
	} elseif ($satu != "" && $dua != "") {
		$sqltot = "select id from pedulikasih1 where kategori='$kategori' and nilai between $satu and $dua";
		$sql = "select * from pedulikasih1 where kategori='$kategori' and nilai between $satu and $dua order by nilai desc".$strlimit;
	}
}

$result = mysql_query($sqltot);
$totresult = mysql_num_rows($result);
mysql_free_result($result);

// Tambahan ulfi 2 april 2013, untuk hilangkan error notice: PHP Notice:  Undefined variable: satu in /srv/ivm/indosiar.com/phpx/pk_reportbca.php on line 135

$qword=isset($qword)?$qword:"";
$jenis=isset($jenis)?$jenis:"";
$satu=isset($satu)?$satu:"";
$dua=isset($dua)?$dua:"";
// Sampai sini
if ($totresult > 0) {
	$totpage = ceil($totresult/$batas);
	$strurlpage = "";
	if ($totpage > 1) {
		if ($totpage > 100) $totpage = 100;
		for ($i = 1; $i <= $totpage; $i++) {
			if ($page == $i)
				$strurlpage .= '<option SELECTED>'.$i.'</option>'."\r\n";
			else
				$strurlpage .= '<option value="pk_reportbca.php?kategori='.$kategori.'&page='.$i.'&que='.$que.'&jenis='.$jenis.'&satu='.$satu.'&dua='.$dua.'&qword='.$qword.'">'.$i.'</option>'."\r\n";
		}
	}
	
	echo '
	<b>Total Penyumbang: '.$totpenyumbang.'</b>
  <table width="100%" border="0" cellspacing="1" cellpadding="3" style="border:1px solid #333">
    <tr bgcolor="#D6DFF7"> 
      <td align="center" width="40"><b>NO</b></td>
      <td><b>NAMA</b></td>
      <td align="right"><b>DONASI</b></td>
			<td align="center"><b>TANGGAL</b></td>
      <td align="center"><b>KOTA</b></td>
    </tr>';
  
  $iNum = ($page * $batas) - $batas;
  $result = mysql_query($sql);
  while ($row = mysql_fetch_assoc($result)) {
  	$iNum++;
  	$bgcolor = ($iNum % 2 == 1) ? "#EFEFEF" : "#FFFFFF";
  	
  	echo '
  	<tr bgcolor="'.$bgcolor.'">
  		<td align="center">'.$iNum.'</td>
  		<td>'.(($row["NAMA"] == "") ? "NN" : $row["NAMA"]).'</td>
  		<td align="right">'.number_format($row["NILAI"],0,',','.').'</td>
  		<td align="right">'.$row["TANGGAL"].'</td>
  		<td align="center">'.(($row["KOTA"] == "") ? "&nbsp;" : $row["KOTA"]).'</td>
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
