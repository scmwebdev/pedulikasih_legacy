<?php
$sitename = "Kita Peduli";
$HTMLPageTitle = "Kita Peduli - Transfer BCA Perorangan";
$HTMLMetaDescription = "Transfer BCA Perorangan Kita Peduli"; 
$HTMLMetaKeywords = "Transfer BCA Perorangan, peduli kasih";

include (APPPATH."views/kitapeduli/header.php");

if (isset($_REQUEST["kategori"])) {
  $kategori = trim($_REQUEST["kategori"]);
}else {
  $kategori=$this->session->userdata('kategori');
}
//if ($kategori != "person" && $kategori != "company") $kategori = "person";
$kategori = "person";
$this->session->set_userdata('kategori',$kategori); 
?>

<h1>Daftar Donatur Kita Peduli</h1>
<p>&nbsp;</p>
<div class="csr_subtitle">PENCARIAN</div>
<div style="width:49%;float:left;">
    <form action="<?=site_url('kitapeduli/donatur')?>" method=post name="form1">
    <input type="hidden" name="kategori" value="<?=$kategori?>" />
    <input type="hidden" name="que" value="1" />
    <table border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td>KRITERIA</td>
        <td>:</td>
        <td>
            <select name="jenis">
              <option value="nama">Nama</option>
              <option value="kota">Kota</option>
              <option value="all">Semua Kanal</option>
            </select>
        </td>
      </tr>
      <tr>
        <td>KATA KUNCI</td>
        <td>:</td>
        <td><input type="text" name="qword" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input type="submit" name="Submit2" value=" Cari Donatur "></td>
      </tr>
    </table>
    </form>
</div>
<div style="width:49%;float:right;">
    <form action="<?=site_url('kitapeduli/donatur')?>" method=post name="form2">
    <input type="hidden" name="kategori" value="<?=$kategori?>" />
    <input type="hidden" name="que" value="2" />
    <table border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td>NILAI DONASI DARI</td>
        <td>:</td>
        <td><input type="text" name="satu" onBlur="chknum(document.form2.satu)" /></td>
      </tr>
      <tr>
        <td>SAMPAI</td>
        <td>:</td>
        <td><input type="text" name="dua" onBlur="chknum(document.form2.dua)" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><input type="submit" name="Submit2" value=" Cari Donatur "></td>
      </tr>
    </table>
    </form>
</div>
<div style="clear:both"></div>
<br /><br />
<div class="csr_subtitle">DAFTAR DONATUR</div>
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
  
  $qword = mysql_escape_string($qword);
  $jenis = mysql_escape_string($jenis);

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

  $satu = (int)$satu;
  $dua  = (int)$dua;

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
  echo $this->kitapeduli_model->showDonatur($iNum,$sql,$totrecord,$batas,$segment,$totpenyumbang);
}


include (APPPATH."views/kitapeduli/footer.php");
?>
