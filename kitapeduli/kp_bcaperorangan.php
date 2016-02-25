<?php
$sitename = "Kita Peduli";
$HTMLPageTitle = "Kita Peduli - Berita";
$HTMLMetaDescription = "Berita Kita Peduli";
$HTMLMetaKeywords = "Berita, kita peduli"; 

include (APPPATH."views/inc_header.php");
include (APPPATH."views/kitapeduli/kp_top.php");

if (isset($_REQUEST["kategori"])) {
	$kategori = trim($_REQUEST["kategori"]);
}else {
	$kategori=$this->session->userdata('kategori');
}
//if ($kategori != "person" && $kategori != "company") $kategori = "person";
$kategori = "person";
$this->session->set_userdata('kategori',$kategori);	
?>

	<div class="JudulArtikel">Transfer BCA Perorangan Kita Peduli</div>
	<p>&nbsp;</p>
<table border="0" cellspacing="1" cellpadding="2" width="100%">
  <form action="<?=site_url('kitapeduli/bcaperorangan')?>" method=post name="form1">
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
  <form action="<?=site_url('kitapeduli/bcaperorangan')?>" method=post name="form2">
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

//$page = trim($_REQUEST["page"]);
$page = trim($this->uri->segment(4));
if ($page == "") {
	$page=$this->session->userdata('page');
	if ($page=="") $page="";
}
if ($page=="") {
	$iNum=0;
}else {
	$iNum=$page;
}	
if ($page == "" || !is_numeric($page)) $page = 1; 
$strlimit = ($page == 1) ? " limit 0, $batas" : " limit ". $page .", $batas";

$sqltot = "select ID from kitapeduli_bca where kategori='$kategori'";
$totpenyumbang=$this->kitapeduli_model->totalrecord($sqltot);

if (isset($_REQUEST["que"])) {
	$que = trim($_REQUEST["que"]);
	$this->session->set_userdata('que',$que);	
}else {
	$que=$this->session->userdata('que');
	if ($que=="") $que=1;
}
if ($que == 1) {
	if (isset($_REQUEST["qword"])) {
		$qword = trim($_REQUEST["qword"]);
		$this->session->set_userdata('qword',$qword);
	}else {
		$qword=$this->session->userdata('qword');
	}
	if (isset($_REQUEST["jenis"])) {
		$jenis = trim($_REQUEST["jenis"]);
		$this->session->set_userdata('jenis',$jenis);
	}else {
		$jenis=$this->session->userdata('jenis');
	}
	
	if ($jenis == "kota") {
		$sqltot = "select id from kitapeduli_bca where kategori='$kategori' and kota like '%$qword%'";
		$sql = "select * from kitapeduli_bca where kategori='$kategori' and kota like '%$qword%' order by tanggal desc ".$strlimit;
	} elseif ($jenis == "nama") {
		$sqltot = "select id from kitapeduli_bca where kategori='$kategori' and nama like '%$qword%'";
		$sql = "select * from kitapeduli_bca where kategori='$kategori' and nama like '%$qword%' order by tanggal desc ".$strlimit;
	} else {
		$sqltot = "select id from kitapeduli_bca where kategori='$kategori' and (nama like '%$qword%' or kota like '%$qword%')";
		$sql = "select * from kitapeduli_bca where kategori='$kategori' and (nama like '%$qword%' or kota like '%$qword%') order by tanggal desc ".$strlimit;
	}
} elseif ($que == 2) {
	if (isset($_REQUEST["satu"])) {
		$satu = trim($_REQUEST["satu"]);
		$this->session->set_userdata('satu',$satu);
	}else {
		$satu=$this->session->userdata('satu');
	}
	if (isset($_REQUEST["dua"])) {	
		$dua = trim($_REQUEST["dua"]);
		$this->session->set_userdata('dua',$dua);
	}else {
		$dua=$this->session->userdata('dua');
	}
	if ($satu != "" && $dua == "") {
		$sqltot = "select id from kitapeduli_bca where kategori='$kategori' and nilai between $satu and 300000000";
		$sql = "select * from kitapeduli_bca where kategori='$kategori' and nilai between $satu and 300000000 order by nilai desc".$strlimit;
	} elseif ($satu == "" && $dua != "") {
		$sqltot = "select id from kitapeduli_bca where kategori='$kategori' and nilai between 0 and $dua";
		$sql = "select * from kitapeduli_bca where kategori='$kategori' and nilai between 0 and $dua order by nilai desc".$strlimit;
	} elseif ($satu != "" && $dua != "") {
		$sqltot = "select id from kitapeduli_bca where kategori='$kategori' and nilai between $satu and $dua";
		$sql = "select * from kitapeduli_bca where kategori='$kategori' and nilai between $satu and $dua order by nilai desc".$strlimit;
	}
} 


$totrecord=$this->kitapeduli_model->totalrecord($sqltot);
$segment=4;
if ($totrecord > 0) {
	$this->session->set_userdata('kategori',$kategori);	
	echo $this->kitapeduli_model->pagingbca($iNum,$sql,$totrecord,$batas,$segment,$totpenyumbang);
}

include (APPPATH."views/kitapeduli/kp_bottom.php");
include (APPPATH."views/inc_footer.php");
?>