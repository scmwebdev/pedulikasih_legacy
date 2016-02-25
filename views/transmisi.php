<?php
$sitename = "Transmisi Indosiar";
$HTMLPageTitle = "Transmisi Indosiar";
$HTMLMetaDescription = "Transmisi Indosiar";
$HTMLMetaKeywords = "Transmisi Indosiar";

include (APPPATH."views/inc_header.php");

echo '
	<div class="JenisArtikel RoundedBox5px">Stasiun Transmisi Indosiar</div>
';
?>

<link rel="stylesheet" href="/js/jquery.tooltip.css" />
<script src="/js/jquery.dimensions.js" type="text/javascript"></script>
<script src="/js/jquery.tooltip.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
$('map > area').tooltip({ 
    track: true, 
    delay: 0, 
    showURL: false, 
    showBody: " - ", 
    fade: 250 
});
});
</script>
<div align="center">
<a name="top" id="top">&nbsp;</a><br />
<img src="/img/indonesia2.jpg" name="map" width="800" height="315" border="0" usemap="#Indo" id="map" />
    <map name="Indo">
      <area shape="poly" coords="428,217,436,217,438,209,431,206,428,207,424,211" href="#sulsel" title="Makassar - Channel: 27 UHF <br />Power: 40 KW" />
  <area shape="poly" coords="213,242,213,243,212,247,216,250,219,250,224,251,224,248,223,247,224,245,223,241,221,240,220,239,217,238,216,239,213,241" href="#Jabar" title="Bandung - Channel: 54 UHF<br />Power: 20 KW" />
  <area shape="poly" coords="264,259,264,254,269,253,271,257,275,258,274,263,270,263" href="#ygy" title="Yogyakarta - Channel: 28 UHF <br />Power: 40 KW" />
  <area shape="poly" coords="211,228,211,233,206,238,202,243,195,240,191,238,188,235,191,233,192,229,194,225,200,225,209,225" href="#jakarta" title="Jakarta - Channel: 41 UHF <br />Power: 120 KW" />
  <area shape="poly" coords="270,249,269,251,272,254,275,256,277,255,276,254,278,251,278,249,278,248,277,244,276,245,274,245,272,244" href="#smg" title="Semarang - Channel: 27 UHF <br />Power: 20 KW" />
  <area shape="poly" coords="254,241,248,242,247,247,255,249,256,247,259,245" href="#tgl" title="Tegal - Channel: 51 UHF <br />Power: 20 KW" />
  <area shape="poly" coords="250,250,260,250,260,257,250,255,252,252" href="#bnms" title="Banyumas - Channel: 39 UHF <br />Power: 20 KW" />
  <area shape="poly" coords="300,245,306,242,309,246,308,252,305,252,300,250,302,248" href="#sby" title="Surabaya - Channel: 28 UHF <br />Power: 40 KW" />
<area shape="poly" coords="287,253,285,258,285,264,289,264,292,264,293,254" href="#mdun" title="Madiun - Channel: 44 UHF <br />Power: 5 KW" />
<area shape="rect" coords="293,253,300,267" href="#kdr" title="Kediri - Channel: 51 UHF <br />Power: 5 KW" />
<area shape="rect" coords="302,255,311,266" href="#mlg" title="Malang - Channel: 38 UHF <br />Power: 5 KW" />
<area shape="poly" coords="324,260,326,259,329,260,331,258,333,262,331,268,324,265,323,263" href="#jbr" title="Jember - Channel: 60 UHF <br />Power: 5 KW" />
<area shape="poly" coords="347,262,356,264,356,272,346,269" href="#bali" title="Denpasar - Channel: 27 UHF <br />Power: 25 KW" />
<area shape="circle" coords="320,260,5" href="#bdws" title="Situbondo - Channel: 49 UHF <br />Power: 2 KW" />
<area shape="poly" coords="55,63,63,76,69,72,72,64,65,56" href="#sumut" title="Medan - Channel: 23 UHF <br />Power: 20 KW" />
<area shape="poly" coords="87,126,96,119,101,121,103,126,95,133" href="#bkt" title="Bukittinggi - Channel: 50 UHF <br />Power: 500 KW" />
<area shape="poly" coords="105,158,114,155,115,148,112,142,105,142,101,146" href="#pdg" title="Padang - Channel: 49 UHF <br />Power: 2 KW" />
<area shape="poly" coords="117,128,120,133,123,137,128,139,134,137,139,138,140,130,139,128,138,125,131,124,125,123" href="#riau" title="Pekanbaru - Channel: 28 UHF <br />Power: 2 KW" />
<area shape="poly" coords="165,153,151,153,152,143,164,143" href="#jambi" title="Jambi - Channel: 23 UHF <br />Power: 2 KW" />
<area shape="poly" coords="175,189,176,185,180,189,185,189,189,186,195,180,194,178,189,176,191,173,187,169,186,171,177,171" href="#sumsel" title="Palembang - Channel: 28 UHF <br />Power: 20 KW" />
<area shape="poly" coords="140,181,126,178,126,184,130,189,138,192,136,186,137,185" href="#bkl" title="Bengkulu - Channel: 28 UHF <br />Power: 5 KW" />
<area shape="poly" coords="173,214,171,211,174,207,177,205,182,204,186,205,189,211,187,216,182,218,182,218,179,219,176,218,177,218,173,215" href="#lpg" title="Lampung - Channel: 28 UHF <br />Power: 20 KW" />
<area shape="poly" coords="163,127,166,132,171,135,175,134,180,133,182,130,182,119,172,112,164,119" href="#btm" title="Batam - Channel: 49 UHF <br />Power: 5 KW" />
<area shape="poly" coords="355,189,350,194,340,190,340,180,346,176,354,180" href="#kalsel" title="Banjarmasin - Channel: 38 UHF <br />Power: 2 KW" />
<!-- <area shape="poly" coords="336,182,325,183,323,178,321,180,315,176,308,183,301,180,296,185,293,175,275,176,282,170,282,163,279,153,297,138,318,134,323,122,330,114,340,115,348,112,350,120,350,126,354,124,354,133,362,145,351,162,346,162" href="#kalteng" /> -->
<area shape="poly" coords="256,113,260,116,261,119,261,120,261,124,262,123,258,126,254,127,247,123,252,127,248,117,252,112" href="#kalbar" title="Pontianank - Channel: 23 UHF <br />Power: 2 KW" />
<area shape="poly" coords="378,136,372,132,366,137,364,139,367,149,377,149,381,145,381,143" href="#kaltim" title="Balikpapan - Channel: 28 UHF <br />Power: 2 KW" />
<area shape="poly" coords="506,108,507,111,511,114,515,108,514,103,506,106" href="#sulut" title="Manado - Channel: 44 UHF <br />Power: 5 KW" />
<area shape="poly" coords="575,175,582,173,586,179,582,183,574,183,573,179" href="#ambon" title="Ambon - Channel: 38 UHF <br />Power: 2 KW" />
<area shape="poly" coords="673,171,675,169,675,170,674,169,675,169,675,170,677,168,676,169,678,168,683,167,685,174,684,180,684,179,679,179,676,178,674,177,674,177,673,173" href="#papua" title="Jayapura - Channel: 38 UHF <br />Power: 2 KW" />
<area shape="poly" coords="494,296,490,295,493,292,500,290,506,295,504,300,496,302,493,299,490,299" href="#kpg" title="Kupang - Channel: 38 UHF <br />Power: 2 KW" />
<area shape="circle" coords="232,237,5" href="#cirebon" title="Cirebon - Channel: 46 UHF <br />Power: 10 KW" />
  <area shape="circle" coords="230,248,5" href="#garut" title="Garut - Channel: 24 UHF <br />Power: 10 KW" />
  </map>
<p>
<table width="800" border="2" cellspacing="1" cellpadding="3">
      <tr>
        <td colspan="7" align="center">DAERAH JANGKAUAN INDOSIAR 2005</td>
      </tr>
      <tr>
        <td rowspan="2">&nbsp;NO&nbsp;</td>
        <td rowspan="2" align="center">STASIUN TRANSMISI</td>
        <td rowspan="2" align="center">On Air Date</td>
        <td rowspan="2" align="center">CHANNEL<br />(UHF)</td>
        <td rowspan="2" align="center">POWER<br />(KW)</td>
        <td colspan="2" align="center">DAERAH JANGKAUAN</td>
      </tr>
      <tr>
        <td align="center">&nbsp;KABUPATEN/KOTAMADYA&nbsp;</td>
        <td align="center">&nbsp;POPULASI 2003&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a name="jakarta" id="jakarta"></a>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">1</td>
        <td><strong>JAKARTA&nbsp;</strong></td>
        <td align="center">Sep 2006</td>
        <td align="center">41</td>
        <td align="center">120</td>
        <td>DKI Jakarta (5 Kodya)</td>
        <td align="right">8.763.700</td>
      </tr>
      <tr>
        <td rowspan="14" valign="top"><img src="/img/logodaerah/Jakarta.jpg" width="66" height="77" /></td>
        <td rowspan="14" valign="top">Jl. Raya Panjang <br />
        RT 11 RW 10<br />
        Kel. Kebon Jeruk<br />
        Kec. Kebon Jeruk<br />
        JAKARTA BARAT</td>
        <td rowspan="14">&nbsp;</td>
        <td rowspan="14">&nbsp;</td>
        <td rowspan="14">&nbsp;</td>
        <td>Kodya Tangerang</td>
        <td align="right">1.462.726</td>
      </tr>
      <tr>
        <td>Kodya. Bogor</td>
        <td align="right">792.657</td>
      </tr>
      <tr>
        <td>Kab. Bogor</td>
        <td align="right">3.791.781</td>
      </tr>
      <tr>
        <td>Kab. Bekasi</td>
        <td align="right">1.858.925</td>
      </tr>
      <tr>
        <td>Kodya Bekasi</td>
        <td align="right">2.845.005</td>
      </tr>
      <tr>
        <td>Kab. Karawang</td>
        <td align="right">1.871.179</td>
      </tr>
      <tr>
        <td>Kab. Serang</td>
        <td align="right">1.776.995</td>
      </tr>
      <tr>
        <td>Kab. Pandeglang</td>
        <td align="right">1.082.012</td>
      </tr>
      <tr>
        <td>Lebak</td>
        <td align="right">1.122.228</td>
      </tr>
      <tr>
        <td>Purwakarta</td>
        <td align="right">746.254</td>
      </tr>
      <tr>
        <td>Kab. Tangerang</td>
        <td align="right">3.185.944</td>
      </tr>
      <tr>
        <td>Kodya Cilegon</td>
        <td align="right">326.324</td>
      </tr>
      <tr>
        <td>Kodya Depok</td>
        <td align="right">1.309.995</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">30.935.725</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="jabar" id="jabar"></a>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">2.</td>
        <td><strong>BANDUNG</strong></td>
        <td align="center">Nov'94</td>
        <td align="center">54</td>
        <td align="center">20</td>
        <td>Kodya. Bandung</td>
        <td align="right">2.228.268</td>
      </tr>
      <tr>
        <td rowspan="7" valign="top"><img src="/img/logodaerah/Bandung.jpg" width="66" height="73" /></td>
        <td rowspan="7" valign="top">Komplek Pemancar Televisi<br />
        Kp. Gandrung<br />
        Desa Jambudipa<br />
        KAB. BANDUNG</td>
        <td rowspan="7">&nbsp;</td>
        <td rowspan="7">&nbsp;</td>
        <td rowspan="7">&nbsp;</td>
        <td>Sukabumi</td>
        <td align="right">2.168.569</td>
      </tr>
      <tr>
        <td>Kab. Bandung</td>
        <td align="right">4.504.387</td>
      </tr>
      <tr>
        <td>Cianjur</td>
        <td align="right">2.041.131</td>
      </tr>
      <tr>
        <td>Sumedang</td>
        <td align="right">1.014.319</td>
      </tr>
      <tr>
        <td>Subang</td>
        <td align="right">1.371.005</td>
      </tr>
      <tr>
        <td>Majelengka</td>
        <td align="right">1.153.442</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">14.481.121</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="smg" id="smg"></a>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">3.</td>
        <td><strong>SEMARANG</strong></td>
        <td align="center">Nov'94</td>
        <td align="center">27</td>
        <td align="center">20</td>
        <td>Semarang</td>
        <td align="right">1.455.994</td>
      </tr>
      <tr>
        <td rowspan="11" valign="top"><img src="/img/logodaerah/Semarang.jpg" width="66" height="71" /></td>
        <td rowspan="11" valign="top">Jl. Bukit Puncak 1Bukit Sari<br />
        Kel. Ngesrep<br />
        Kec. Banyumanik<br />
        KODYA SEMARANG</td>
        <td rowspan="11">&nbsp;</td>
        <td rowspan="11">&nbsp;</td>
        <td rowspan="11">&nbsp;</td>
        <td>Kab. Semarang/ Ungaran</td>
        <td align="right">842.242</td>
      </tr>
      <tr>
        <td>Kendal / Weleri</td>
        <td align="right">859.471</td>
      </tr>
      <tr>
        <td>Grobogan/ Purwodadi</td>
        <td align="right">1.289.937</td>
      </tr>
      <tr>
        <td>Demak</td>
        <td align="right">1.009.863</td>
      </tr>
      <tr>
        <td>Kudus</td>
        <td align="right">718.253</td>
      </tr>
      <tr>
        <td>Jepara</td>
        <td align="right">999.635</td>
      </tr>
      <tr>
        <td>Pati</td>
        <td align="right">1.171.785</td>
      </tr>
      <tr>
        <td>Rembang</td>
        <td align="right">566.288</td>
      </tr>
      <tr>
        <td>Temanggung</td>
        <td align="right">710.991</td>
      </tr>
      <tr>
        <td>Salatiga</td>
        <td align="right">163.079</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">9.787.538</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="ygy" id="ygy">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">4.</td>
        <td><strong>YOGYAKARTA</strong></td>
        <td align="center">Nov'94</td>
        <td align="center">28</td>
        <td align="center">40</td>
        <td>Kodya. Yogyakarta</td>
        <td align="right">390.941</td>
      </tr>
      <tr>
        <td rowspan="14" valign="top"><img src="/img/logodaerah/Yogyakarta.jpg" width="66" height="77" /></td>
        <td rowspan="14" valign="top">Desa Ngoro-oro<br />
        Kec. Pathuk<br />
        Kab. Gunung Kidul<br />
        DI YOGYAKARTA</td>
        <td rowspan="14">&nbsp;</td>
        <td rowspan="14">&nbsp;</td>
        <td rowspan="14">&nbsp;</td>
        <td>Surakarta</td>
        <td align="right">488.168</td>
      </tr>
      <tr>
        <td>Magelang</td>
        <td align="right">116.498</td>
      </tr>
      <tr>
        <td>Kab. Magelang</td>
        <td align="right">1.127.714</td>
      </tr>
      <tr>
        <td>Sleman</td>
        <td align="right">940.019</td>
      </tr>
      <tr>
        <td>Kulon Progo</td>
        <td align="right">375.153</td>
      </tr>
      <tr>
        <td>Bantul</td>
        <td align="right">815.667</td>
      </tr>
      <tr>
        <td>Gunung Kidul</td>
        <td align="right">685.605</td>
      </tr>
      <tr>
        <td>Klaten</td>
        <td align="right">1.167.613</td>
      </tr>
      <tr>
        <td>Karanganyar</td>
        <td align="right">786.557</td>
      </tr>
      <tr>
        <td>Sukoharjo</td>
        <td align="right">799.493</td>
      </tr>
      <tr>
        <td>Sragen</td>
        <td align="right">855.948</td>
      </tr>
      <tr>
        <td>Purworejo</td>
        <td align="right">705.272</td>
      </tr>
      <tr>
        <td>Boyolali</td>
        <td align="right">906.530</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">10.161.178</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="tgl" id="tgl">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">5.</td>
        <td><strong>TEGAL</strong></td>
        <td align="center">18-Feb-97</td>
        <td align="center">51</td>
        <td align="center">20</td>
        <td>Kodya. Cirebon</td>
        <td align="right">272.673</td>
      </tr>
      <tr>
        <td rowspan="9" valign="top"><img src="/img/logodaerah/Tegal.jpg" width="66" height="78" /></td>
        <td rowspan="9" valign="top">Jl. Raya TVRI<br />
        Desa Gunung Gantungan<br />
        Kec. Jatinegara<br />
        Kab. Tegal<br />
        JAWA TENGAH</td>
        <td rowspan="9">&nbsp;</td>
        <td rowspan="9">&nbsp;</td>
        <td rowspan="9">&nbsp;</td>
        <td>Kab. Cirebon/ Losari</td>
        <td align="right">2.038.263</td>
      </tr>
      <tr>
        <td>Brebes</td>
        <td align="right">1.728.808</td>
      </tr>
      <tr>
        <td>Kodya. Tegal</td>
        <td align="right">238.059</td>
      </tr>
      <tr>
        <td>Kab. Tegal/ Slawi</td>
        <td align="right">1.410.057</td>
      </tr>
      <tr>
        <td>Pemalang</td>
        <td align="right">1.343.951</td>
      </tr>
      <tr>
        <td>Kodya. Pekalongan</td>
        <td align="right">265.829</td>
      </tr>
      <tr>
        <td>Kab. Pekalongan</td>
        <td align="right">819.397</td>
      </tr>
      <tr>
        <td>Batang</td>
        <td align="right">674.307</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">8.791.344</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="bnms" id="bnms">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">6.</td>
        <td><strong>BANYUMAS</strong></td>
        <td align="center">06-Feb-97</td>
        <td align="center">39</td>
        <td align="center">20</td>
        <td>Banyumas</td>
        <td align="right">1.472.122</td>
      </tr>
      <tr>
        <td rowspan="8" valign="top"><img src="/img/logodaerah/Banyumas.jpg" width="66" height="67" /></td>
        <td rowspan="8" valign="top">Gunung Depok<br />
        Desa Binangun<br />
        Kec. Banyumas<br />
        Kab. Banyumas<br />
        Jawa Tengah 53192</td>
        <td rowspan="8">&nbsp;</td>
        <td rowspan="8">&nbsp;</td>
        <td rowspan="8">&nbsp;</td>
        <td>Purbalingga</td>
        <td align="right">795.874</td>
      </tr>
      <tr>
        <td>Banjarnegara</td>
        <td align="right">848.317</td>
      </tr>
      <tr>
        <td>Cilacap</td>
        <td align="right">1.630.832</td>
      </tr>
      <tr>
        <td>Kebumen</td>
        <td align="right">1.176.102</td>
      </tr>
      <tr>
        <td>Wonosobo</td>
        <td align="right">750.939</td>
      </tr>
      <tr>
        <td>Purworejo</td>
        <td align="right">705.272</td>
      </tr>
      <tr>
        <td>Brebes</td>
        <td align="right">1.728.808</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">9.108.266</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="sby" id="sby">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">7.</td>
        <td><strong>SURABAYA</strong></td>
        <td align="center">Nov'94</td>
        <td align="center">28</td>
        <td align="center">40</td>
        <td>Surabaya</td>
        <td align="right">2.660.380</td>
      </tr>
      <tr>
        <td rowspan="16" valign="top"><img src="/img/logodaerah/Surabaya.jpg" width="66" height="82" /></td>
        <td rowspan="16" valign="top">Jl. Bumi Indah No. 50<br />
        Kel. Lontar, Kec Lakarsanti<br />
        KODYA SURABAYA<br />
        Jawa Timur 60216</td>
        <td rowspan="16">&nbsp;</td>
        <td rowspan="16">&nbsp;</td>
        <td rowspan="16">&nbsp;</td>
        <td>Gresik</td>
        <td align="right">1.059.820</td>
      </tr>
      <tr>
        <td>Lamongan</td>
        <td align="right">1.235.890</td>
      </tr>
      <tr>
        <td>Kodya. Mojokerto</td>
        <td align="right">112.000</td>
      </tr>
      <tr>
        <td>Kab. Mojokerto</td>
        <td align="right">968.500</td>
      </tr>
      <tr>
        <td>Sidoarjo</td>
        <td align="right">1.682.280</td>
      </tr>
      <tr>
        <td>Kodya. Pasuruan</td>
        <td align="right">176.730</td>
      </tr>
      <tr>
        <td>Kab. Pasuruan</td>
        <td align="right">1.419.720</td>
      </tr>
      <tr>
        <td>Bangkalan</td>
        <td align="right">886.080</td>
      </tr>
      <tr>
        <td>Sampang</td>
        <td align="right">833.640</td>
      </tr>
      <tr>
        <td>Pamekasan</td>
        <td align="right">740.150</td>
      </tr>
      <tr>
        <td>Sumenep</td>
        <td align="right">1.032.260</td>
      </tr>
      <tr>
        <td>Kodya. Probolinggo</td>
        <td align="right">200.250</td>
      </tr>
      <tr>
        <td>Kab. Probolinggo</td>
        <td align="right">1.036.260</td>
      </tr>
      <tr>
        <td>Bojonegoro</td>
        <td align="right">1.212.700</td>
      </tr>
      <tr>
        <td>Tuban</td>
        <td align="right">1.077.090</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">16.333.750</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="mlg" id="mlg">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">8.</td>
        <td><strong>MALANG</strong></td>
        <td align="center">14-Des-96</td>
        <td align="center">38</td>
        <td align="center">5</td>
        <td>Kodya Malang</td>
        <td align="right">767.570</td>
      </tr>
      <tr>
        <td rowspan="3" valign="top"><img src="/img/logodaerah/Malang.jpg" width="66" height="68" /></td>
        <td rowspan="3" valign="top">Desa Oro-Oro Ombo<br />
        Kotif Batu Kab. Malang<br />
        Jawa Timur 65351</td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td>Kab. Malang</td>
        <td align="right">2.338.870</td>
      </tr>
      <tr>
        <td>Kodya Batu</td>
        <td align="right">177.260</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">3.283.700</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="kdr" id="kdr">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">9.</td>
        <td><strong>KEDIRI</strong></td>
        <td align="center">16-Agust-97</td>
        <td align="center">51</td>
        <td align="center">5</td>
        <td>Jombang/ Kertosono</td>
        <td align="right">1.172.440</td>
      </tr>
      <tr>
        <td rowspan="8" valign="top"><img src="/img/logodaerah/Kediri.jpg" width="66" height="59" /></td>
        <td rowspan="8" valign="top">Desa Besuki<br />
        Kec. Mojo&nbsp;Kab. Kediri<br />
        Jawa Timur</td>
        <td rowspan="8">&nbsp;</td>
        <td rowspan="8">&nbsp;</td>
        <td rowspan="8">&nbsp;</td>
        <td>Kodya. Kediri</td>
        <td align="right">252.030</td>
      </tr>
      <tr>
        <td>Kab. Kediri/ Pare</td>
        <td align="right">1.474.840</td>
      </tr>
      <tr>
        <td>Tulungagung</td>
        <td align="right">960.070</td>
      </tr>
      <tr>
        <td>Trenggalek</td>
        <td align="right">671.080</td>
      </tr>
      <tr>
        <td>Nganjuk</td>
        <td align="right">1.028.260</td>
      </tr>
      <tr>
        <td>Kodya. Blitar</td>
        <td align="right">123.340</td>
      </tr>
      <tr>
        <td>Kab. Blitar</td>
        <td align="right">1.110.730</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">6.792.790</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="mdun" id="mdun">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">10.</td>
        <td><strong>MADIUN</strong></td>
        <td align="center">25-Okt-97</td>
        <td align="center">44</td>
        <td align="center">5</td>
        <td>Kodya Madiun</td>
        <td align="right">169.480</td>
      </tr>
      <tr>
        <td rowspan="9" valign="top"><img src="/img/logodaerah/Madiun.jpg" width="66" height="82" /></td>
        <td rowspan="9" valign="top">Jl. Raya Sarangan<br />
        Dusun Duwet<br />
        Kec. Plaosan<br />
        Kab. Magetan<br />
        Jawa Timur</td>
        <td rowspan="9">&nbsp;</td>
        <td rowspan="9">&nbsp;</td>
        <td rowspan="9">&nbsp;</td>
        <td>Kab. Madiun/ Caruban</td>
        <td align="right">656.920</td>
      </tr>
      <tr>
        <td>Magetan</td>
        <td align="right">620.750</td>
      </tr>
      <tr>
        <td>Nganjuk</td>
        <td align="right">1.028.260</td>
      </tr>
      <tr>
        <td>Kab. Blora</td>
        <td align="right">821.588</td>
      </tr>
      <tr>
        <td>Cepu / Pati</td>
        <td align="right">1.171.785</td>
      </tr>
      <tr>
        <td>Ngawi</td>
        <td align="right">839.950</td>
      </tr>
      <tr>
        <td>Ponorogo</td>
        <td align="right">86.936</td>
      </tr>
      <tr>
        <td>Pacitan</td>
        <td align="right">538.390</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">5.934.059</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="jbr" id="jbr">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">11.</td>
        <td><strong>JEMBER</strong></td>
        <td align="center">16-Jun-97</td>
        <td align="center">60</td>
        <td align="center">5</td>
        <td>Jember</td>
        <td align="right">2.231.790</td>
      </tr>
      <tr>
        <td rowspan="5" valign="top"><img src="/img/logodaerah/Jember.jpg" width="66" height="79" /></td>
        <td rowspan="5" valign="top">Dusun Ketangi, Desa Tugusari<br />
        Kec. Bangsal Sari<br />
        Kab. Jember<br />
        Jawa Timur</td>
        <td rowspan="5">&nbsp;</td>
        <td rowspan="5">&nbsp;</td>
        <td rowspan="5">&nbsp;</td>
        <td>Lumajang</td>
        <td align="right">999.530</td>
      </tr>
      <tr>
        <td>Bondowoso</td>
        <td align="right">708.650</td>
      </tr>
      <tr>
        <td>Situbondo</td>
        <td align="right">621.070</td>
      </tr>
      <tr>
        <td>Banyuwangi</td>
        <td align="right">1.539.950</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">6.100.990</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="bali" id="bali">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">12.</td>
        <td><strong>DENPASAR</strong></td>
        <td align="center">Nop-94</td>
        <td align="center">27</td>
        <td align="center">25</td>
        <td>Denpasar</td>
        <td align="right">435.920</td>
      </tr>
      <tr>
        <td rowspan="8" valign="top"><img src="/img/logodaerah/Denpasar.jpg" width="66" height="62" /></td>
        <td rowspan="8" valign="top">Bukit Bakung<br />
        Desa Kutuh, Kec Kuta<br />
        Kab. Badung<br />
        BALI</td>
        <td rowspan="8">&nbsp;</td>
        <td rowspan="8">&nbsp;</td>
        <td rowspan="8">&nbsp;</td>
        <td>Badung</td>
        <td align="right">351.077</td>
      </tr>
      <tr>
        <td>Klungkung</td>
        <td align="right">167.826</td>
      </tr>
      <tr>
        <td>Tabanan</td>
        <td align="right">394.004</td>
      </tr>
      <tr>
        <td>Jembranan</td>
        <td align="right">220.093</td>
      </tr>
      <tr>
        <td>Karangasem</td>
        <td align="right">388.320</td>
      </tr>
      <tr>
        <td>Gianyar</td>
        <td align="right">375.631</td>
      </tr>
      <tr>
        <td>Bangli</td>
        <td align="right">209.241</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">2.542.112</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="mdn" id="mdn">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">13.</td>
        <td><strong>MEDAN</strong></td>
        <td align="center">Nop-94</td>
        <td align="center">23</td>
        <td align="center">20</td>
        <td>Kodya Medan</td>
        <td align="right">1.979.340</td>
      </tr>
      <tr>
        <td rowspan="9" valign="top"><img src="/img/logodaerah/Medan.jpg" width="66" height="72" /></td>
        <td rowspan="9" valign="top">Jl. Kompleks TVRI<br />
        Desa&nbsp;    Bandar Baru,<br />
        Kec. Sibolangit<br />
        Kab. Deli Serdang<br />
        SUMATERA UTARA 20357</td>
        <td rowspan="9">&nbsp;</td>
        <td rowspan="9">&nbsp;</td>
        <td rowspan="9">&nbsp;</td>
        <td>Kab. Langkat</td>
        <td align="right">940.601</td>
      </tr>
      <tr>
        <td>Kab. Deli Serdang</td>
        <td align="right">2.054.707</td>
      </tr>
      <tr>
        <td>Kab. Simalungun</td>
        <td align="right">808.288</td>
      </tr>
      <tr>
        <td>Kodya Binjai</td>
        <td align="right">225.535</td>
      </tr>
      <tr>
        <td>KodyaTebingtinggi</td>
        <td align="right">132.760</td>
      </tr>
      <tr>
        <td>Kab. Asahan</td>
        <td align="right">990.230</td>
      </tr>
      <tr>
        <td>Kod. Tanjungbalai</td>
        <td align="right">144.979</td>
      </tr>
      <tr>
        <td>Kod. Pematang Siantar</td>
        <td align="right">223.949</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">7.500.389</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="sumsel" id="sumsel">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">14.</td>
        <td><strong>PALEMBANG</strong></td>
        <td align="center">19-Feb-97</td>
        <td align="center">28</td>
        <td align="center">20</td>
        <td>Palembang</td>
        <td align="right">1.287.841</td>
      </tr>
      <tr>
        <td rowspan="5" valign="top"><img src="/img/logodaerah/Palembang.jpg" width="66" height="84" /></td>
        <td rowspan="5" valign="top">Jl. Angkatan 45<br />
        Kel. Pakjo, Kec. Ilir Timur 1<br />
        Kodya Palembang<br />
        Sumatra Selatan</td>
        <td rowspan="5">&nbsp;</td>
        <td rowspan="5">&nbsp;</td>
        <td rowspan="5">&nbsp;</td>
        <td>Muaraenim</td>
        <td align="right">611.702</td>
      </tr>
      <tr>
        <td>Ogan Komering Ilir</td>
        <td align="right">986.152</td>
      </tr>
      <tr>
        <td>Ogan Komering Ulu</td>
        <td align="right">1.096.606</td>
      </tr>
      <tr>
        <td>Musi Banyu Asin</td>
        <td align="right">445.756</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">4.428.057</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="lpg" id="lpg">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">15.</td>
        <td><strong>LAMPUNG</strong></td>
        <td align="center">26-Feb-97</td>
        <td align="center">28</td>
        <td align="center">20</td>
        <td>Bandar Lampung</td>
        <td align="right">779.179</td>
      </tr>
      <tr>
        <td rowspan="4" valign="top"><img src="/img/logodaerah/Lampung.jpg" width="66" height="100" /></td>
        <td rowspan="4" valign="top">Jalan TVRI,<br />
        Kel. Sumber Agung<br />
        Kec. Kemiling<br />
        BANDAR LAMPUNG 35150</td>
        <td rowspan="4">&nbsp;</td>
        <td rowspan="4">&nbsp;</td>
        <td rowspan="4">&nbsp;</td>
        <td>Lampung Tengah</td>
        <td align="right">1.073.412</td>
      </tr>
      <tr>
        <td>Lampung Selatan</td>
        <td align="right">1.177.505</td>
      </tr>
      <tr>
        <td>Lampung Utara</td>
        <td align="right">549.060</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">3.579.156</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="sulsel" id="sulsel"></a>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">16.</td>
        <td><strong>MAKASAR</strong></td>
        <td align="center">Des-94</td>
        <td align="center">27</td>
        <td align="center">40</td>
        <td>Makasar</td>
        <td align="right">1.145.406</td>
      </tr>
      <tr>
        <td rowspan="9" valign="top"><img src="/img/logodaerah/Makassar.jpg" width="66" height="82" /></td>
        <td rowspan="9" valign="top">Jl. Raya Malino Km. 22<br />
        Ds. Pakatto<br />
        Kec. Bontomarannu<br />
        Kab. Gowa<br />
        SULAWESI SELATAN</td>
        <td rowspan="9">&nbsp;</td>
        <td rowspan="9">&nbsp;</td>
        <td rowspan="9">&nbsp;</td>
        <td>Pangkajene Kepulauan</td>
        <td align="right">275.151</td>
      </tr>
      <tr>
        <td>Maros</td>
        <td align="right">286.260</td>
      </tr>
      <tr>
        <td>Takalar</td>
        <td align="right">240.578</td>
      </tr>
      <tr>
        <td>Jeneponto</td>
        <td align="right">323.245</td>
      </tr>
      <tr>
        <td>Gowa</td>
        <td align="right">552.293</td>
      </tr>
      <tr>
        <td>Selayar</td>
        <td align="right">109.415</td>
      </tr>
      <tr>
        <td>Barru</td>
        <td align="right">156.661</td>
      </tr>
      <tr>
        <td>Pinrang</td>
        <td align="right">331.592</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">3.420.601</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="sulut" id="sulut">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">17.</td>
        <td><strong>MANADO</strong></td>
        <td align="center">Okt-99</td>
        <td align="center">44</td>
        <td align="center">5</td>
        <td>Kodya. Manado</td>
        <td align="right">410.870</td>
      </tr>
      <tr>
        <td rowspan="4" valign="top"><img src="/img/logodaerah/Manado.jpg" width="66" height="77" /></td>
        <td rowspan="4" valign="top">Komplek Angkatan Laut<br />
        Lantamal - Kairagi<br />
        Gedung RB Panjaitan<br />
        Manado</td>
        <td rowspan="4">&nbsp;</td>
        <td rowspan="4">&nbsp;</td>
        <td rowspan="4">&nbsp;</td>
        <td>Kab. Minahasa Induk</td>
        <td align="right">827.877</td>
      </tr>
      <tr>
        <td>Kab. Minahasa Utara</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Kab. Minahasa Selatan</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">1.238.747</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="kalteng" id="kalteng">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">18.</td>
        <td><strong>PONTIANAK</strong></td>
        <td align="center">Mei-01</td>
        <td align="center">23</td>
        <td align="center">2</td>
        <td>Kodya. Pontianak</td>
        <td align="right">482.365</td>
      </tr>
      <tr>
        <td rowspan="3" valign="top"><img src="/img/logodaerah/Pontianak.jpg" width="66" height="64" /></td>
        <td rowspan="3" valign="top">Direktorat Reserse dan Logistik<br />
        Polda Kalimantan Barat<br />
        Pontianak</td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td>Kab. Pontianak</td>
        <td align="right">682.232</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">1.164.597</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="kaltim" id="kaltim">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">19</td>
        <td><strong>BALIKPAPAN</strong></td>
        <td align="center">Apr-01</td>
        <td align="center">28</td>
        <td align="center">2</td>
        <td>Kodya. Balikpapan</td>
        <td align="right">428.819</td>
      </tr>
      <tr>
        <td valign="top"><img src="/img/logodaerah/Balikpapan.jpg" width="66" height="79" /></td>
        <td valign="top">Jl. Bonto Bolaeng 14,<br /> 
          Sumber Rejo<br />
        Balikpapan<br />
        Kalimantan Timur</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>SUB TOTAL</td>
        <td align="right">428.819</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="kalsel" id="kalsel">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">20</td>
        <td><strong>BANJARMASIN</strong></td>
        <td align="center">Apr-02</td>
        <td align="center">38</td>
        <td align="center">2</td>
        <td>Kodya. Banjarmasin</td>
        <td align="right">572.942</td>
      </tr>
      <tr>
        <td rowspan="3" valign="top"><img src="/img/logodaerah/Banjarmasin.jpg" width="66" height="97" /></td>
        <td rowspan="3" valign="top">Polda Kalimantan SelatanBanjarmasin<br />
        Kalimantan Selatan</td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td>Kab. Barito Kuala</td>
        <td align="right">259.281</td>
      </tr>
      <tr>
        <td>Banjar</td>
        <td align="right">453.042</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">1.285.265</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="pdg" id="pdg">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">21</td>
        <td><strong>PADANG</strong></td>
        <td align="center">Mar-03</td>
        <td align="center">49</td>
        <td align="center">2</td>
        <td>Kodya. Padang</td>
        <td align="right">764.800</td>
      </tr>
      <tr>
        <td rowspan="3" valign="top"><img src="/img/logodaerah/Padang.jpg" width="66" height="77" /></td>
        <td rowspan="3" valign="top">Stasiun Radio Repeater<br />
        Polda Bukit Gado-gado<br />
        PADANG</td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td>Kab. Padang Pariaman</td>
        <td align="right">442.400</td>
      </tr>
      <tr>
        <td>Pesisir Selatan</td>
        <td align="right">415.000</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">1.622.200</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="riau" id="riau">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">22</td>
        <td><strong>PEKANBARU</strong></td>
        <td align="center">29-Sep-03</td>
        <td align="center">28</td>
        <td align="center">2</td>
        <td>Kodya Pekanbaru</td>
        <td align="right">585.440</td>
      </tr>
      <tr>
        <td rowspan="4" valign="top"><img src="/img/logodaerah/Pekanbaru.jpg" width="66" height="91" /></td>
        <td rowspan="4" valign="top">Jl. Indrapuri Ujung&nbsp;<br />
          Kel. Sail <br />
        Kec. Tenayan Raya<br />
        Pekanbaru - Riau</td>
        <td rowspan="4">&nbsp;</td>
        <td rowspan="4">&nbsp;</td>
        <td rowspan="4">&nbsp;</td>
        <td>Kampar</td>
        <td align="right">447.157</td>
      </tr>
      <tr>
        <td>Indragiri Hulu</td>
        <td align="right">247.306</td>
      </tr>
      <tr>
        <td>Bengkalis</td>
        <td align="right">520.241</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">1.800.144</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="jambi" id="jambi">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">23</td>
        <td><strong>JAMBI</strong></td>
        <td align="center">12-Agust-04</td>
        <td>23</td>
        <td>2</td>
        <td>Kodya Jambi</td>
        <td align="right">431.709</td>
      </tr>
      <tr>
        <td rowspan="7" valign="top"><img src="/img/logodaerah/Jambi.jpg" width="66" height="70" /></td>
        <td rowspan="7" valign="top">Jl. Lorong Kenali Jaya<br />
        RT. 015/ RW 001<br />
        Kel. Kenali Besar&nbsp;<br />
        Kec. Kota Baru<br />
        Jambi</td>
        <td rowspan="7">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td rowspan="7" align="center">&nbsp;</td>
        <td>Tanjab Timur</td>
        <td align="right">188.006</td>
      </tr>
      <tr>
        <td>Tanjab Barat</td>
        <td align="right">217.685</td>
      </tr>
      <tr>
        <td>Kab. Batanghari</td>
        <td align="right">197.176</td>
      </tr>
      <tr>
        <td>Bungo</td>
        <td align="right">222.238</td>
      </tr>
      <tr>
        <td>Tebo</td>
        <td align="right">231.636</td>
      </tr>
      <tr>
        <td>Sarolangun&nbsp;</td>
        <td align="right">185.144</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">1.673.594</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="papua" id="papua">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">24</td>
        <td><strong>JAYAPURA</strong></td>
        <td align="center">19-Des-04</td>
        <td align="center">38</td>
        <td align="center">2</td>
        <td>Kodya Jayapura</td>
        <td align="right">185.102</td>
      </tr>
      <tr>
        <td rowspan="2" valign="top"><img src="/img/logodaerah/Jayapura.jpg" width="66" height="97" /></td>
        <td rowspan="2" valign="top">Jl. Pemancar TVRI <br />
        Desa Polimak I<br />
        RT 01 RW 01 Kel Ardipura,<br />
        Kec. Jayapura Selatan</td>
        <td rowspan="2">&nbsp;</td>
        <td rowspan="2">&nbsp;</td>
        <td rowspan="2">&nbsp;</td>
        <td>Kab. Jayapura</td>
        <td align="right">105.967</td>
      </tr>
      <tr>
        <td>SUB TOTAL</td>
        <td align="right">291.069</td>
      </tr>
      <tr>
        <td colspan="7">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">25</td>
        <td><strong>PACITAN</strong></td>
        <td align="center">03-Jan-05</td>
        <td align="center">23</td>
        <td align="center">500 w</td>
        <td>Kab. Pacitan</td>
        <td align="right">538.390</td>
      </tr>
      <tr>
        <td valign="top"><img src="/img/logodaerah/Pacitan.jpg" width="66" height="79" /></td>
        <td valign="top">D/A Radio Grindulu<br />
        Jl. Basuki Rahmad No. 67<br />
        Kel. Baleharjo Pacitan</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="ambon" id="cirebon">&nbsp;</a></td>
    </tr>
      <tr>
        <td align="center">26</td>
        <td><strong>CIREBON</strong></td>
        <td align="center">04-Jan-05</td>
        <td align="center">46</td>
        <td align="center">10</td>
        <td>Kod. Cirebon</td>
        <td align="right">272.673</td>
      </tr>
      <tr>
        <td rowspan="6" valign="top"><img src="/img/logodaerah/Cirebon.jpg" width="63" height="89" /></td>
        <td rowspan="6" valign="top">Desa Padabeunghar, <br />
        Kecamatan Pesawahan <br />
        Kabupaten Kuningan</td>
        <td rowspan="6">&nbsp;</td>
        <td rowspan="6">&nbsp;</td>
        <td rowspan="6">&nbsp;</td>
        <td>Kab. Indramayu</td>
        <td align="right">1.653.146</td>
      </tr>
      <tr>
        <td>Kab. Majalengka</td>
        <td align="right">1.153.442</td>
      </tr>
      <tr>
        <td>Kab. Sumedang</td>
        <td align="right">1.014.319</td>
      </tr>
      <tr>
        <td>Kab. Cirebon</td>
        <td align="right">2.038.263</td>
      </tr>
      <tr>
        <td>Kab. Subang</td>
        <td align="right">1.371.005</td>
      </tr>
      <tr>
        <td>Sub Total</td>
        <td align="right">7.502.848</td>
      </tr>
      <tr>
        <td colspan="7">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">27</td>
        <td><strong>PANGKAL PINANG</strong></td>
        <td align="center">21-Mar-05</td>
        <td align="center">23</td>
        <td align="center">5</td>
        <td>Kep. Bangka Belitung</td>
        <td align="right">998.800</td>
      </tr>
      <tr>
        <td valign="top"><img src="/img/logodaerah/Pangkalpinang.jpg" width="66" height="82" /></td>
        <td valign="top">Hutan Lindung, <br />
          Gn Mangkol,
        Desa Terak, <br />
        Kec. Simpang Katis<br />
        Gunung Mangkol<br />
        Pangkal Pinang</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="ambon" id="ambon">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">28</td>
        <td><strong>AMBON</strong></td>
        <td align="center">19-Jun-05</td>
        <td align="center">38</td>
        <td align="center">2</td>
        <td>Kab. Maluku Tengah</td>
        <td align="right">1.299.100</td>
      </tr>
      <tr>
        <td valign="top"><img src="/img/logodaerah/Ambon.jpg" width="66" height="70" /></td>
        <td valign="top">Area Lat&amp;Bek <br />
          Lantamal VIII<br />
        Jl. Mohammad Toha<br />
        Telaga Kodok <br />
        Ds. Hitumesing<br />
        Kec. Leihitu <br />
        Kab Malteng</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td valign="top">Kodya Ambon</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="bkl" id="bkl">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">29</td>
        <td><strong>BENGKULU</strong></td>
        <td align="center">13 Juli 05</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td valign="top"><img src="/img/logodaerah/Bengkulu.jpg" width="66" height="85" /></td>
        <td valign="top">Jl. WR Supratman, <br />
          Kel Bentiring<br />
        Kec. Muara Bangkahulu<br />
        Kota Bengkulu<br />
        Propinsi Bengkulu</td>
        <td>&nbsp;</td>
        <td align="center">28</td>
        <td align="center">5</td>
        <td>Kodya Bengkulu</td>
        <td align="right">279.630</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="bdws">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">30</td>
        <td><strong>SITUBONDO</strong></td>
        <td align="center">28 Agt 05</td>
        <td align="center">49</td>
        <td align="center">2</td>
        <td>&nbsp;</td>
        <td align="right">&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="3" valign="top"><img src="/img/logodaerah/Situbondo.jpg" width="66" height="90" /></td>
        <td rowspan="3" valign="top">Dusun Kluncing <br />
        Desa Sukorejo,&nbsp;<br />
        Kec. Sumberwringin<br />
        Bondowoso</td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td rowspan="3">&nbsp;</td>
        <td>Kab. Situbondo</td>
        <td align="right">621.070</td>
      </tr>
      <tr>
        <td>Kab. Bondowoso</td>
        <td align="right">708.650</td>
      </tr>
      <tr>
        <td>Sub Total</td>
        <td>1.329.720</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="garut" id="garut">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">31</td>
        <td><strong>GARUT</strong></td>
        <td align="center">06-Sep-05</td>
        <td align="center">24</td>
        <td align="center">10</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td rowspan="4" valign="top"><img src="/img/logodaerah/Garut.jpg" width="66" height="80" /></td>
        <td rowspan="4" valign="top">Gunung Cikuray,<br /> 
          Jl. PTPN VIII<br />
        Desa Sukatani, Kec. Cilawu<br />
        Kab. Garut<br />
        Jawa Barat 44181</td>
        <td rowspan="4">&nbsp;</td>
        <td rowspan="4" align="center">&nbsp;</td>
        <td rowspan="4" align="center">&nbsp;</td>
        <td>Garut</td>
        <td align="right">2.048.388</td>
      </tr>
      <tr>
        <td>Tasikmalaya</td>
        <td align="right">2.062.975</td>
      </tr>
      <tr>
        <td>Ciamis</td>
        <td align="right">1.617.593</td>
      </tr>
      <tr>
        <td>Sub Total</td>
        <td align="right">5.728.956</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="kpg" id="kpg">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">32</td>
        <td><strong>KUPANG</strong></td>
        <td align="center">17 Okt 2005</td>
        <td align="center">38</td>
        <td align="center">2</td>
        <td>Kab. Kupang</td>
        <td align="right">4.110.900</td>
      </tr>
      <tr>
        <td valign="top"><img src="/img/logodaerah/Kupang.jpg" width="66" height="63" /></td>
        <td valign="top">Desa Sikumana<br />
        Kec. Maulafa&nbsp;<br />
        Kodya Kupang</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="bkt" id="bkt">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">33</td>
        <td><strong>BUKITTINGGI</strong></td>
        <td align="center">30-Sep-05</td>
        <td align="center">50</td>
        <td align="center">500</td>
        <td>Kodya Bukittinggi</td>
        <td align="right">97.800</td>
      </tr>
      <tr>
        <td rowspan="5" valign="top"><img src="/img/logodaerah/Bukittinggi.jpg" width="66" height="84" /></td>
        <td rowspan="5" valign="top">Stasiun Relay Repeater POLDA<br />
        Puncak Gunung Singgalang<br />
        Desa Tanjung - Pandaisikat<br />
        Kec. X Koto<br />
        Kab Tanah Datar</td>
        <td rowspan="5">&nbsp;</td>
        <td rowspan="5">&nbsp;</td>
        <td rowspan="5">&nbsp;</td>
        <td>Padangpanjang</td>
        <td align="right">42.800</td>
      </tr>
      <tr>
        <td>Tanah Datar</td>
        <td align="right">333.600</td>
      </tr>
      <tr>
        <td>Payakumbyh</td>
        <td align="right">102.100</td>
      </tr>
      <tr>
        <td>Pasaman</td>
        <td align="right">547.300</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="right">1.123.600</td>
      </tr>
      <tr>
        <td colspan="7" align="right"><a href="#top">kembali ke atas </a><a name="batam" id="batam">&nbsp;</a></td>
      </tr>
      <tr>
        <td align="center">34</td>
        <td><strong>BATAM</strong></td>
        <td align="center">21 Des 2005</td>
        <td align="center">49</td>
        <td align="center">5</td>
        <td>Batam</td>
        <td align="right">437.358</td>
      </tr>
      <tr>
        <td rowspan="4" valign="top"><img src="/img/logodaerah/Batam.jpg" width="66" height="91" /></td>
        <td rowspan="4" valign="top">TVRI Batam<br />
        Bukit Dangas<br />
        Jl. Palapa VII Sekupang<br />
        Batam</td>
        <td rowspan="4">&nbsp;</td>
        <td rowspan="4">&nbsp;</td>
        <td rowspan="4">&nbsp;</td>
        <td>Tanjung Pinang</td>
        <td align="right">137.356</td>
      </tr>
      <tr>
        <td>Sub Total</td>
        <td align="right">574.714</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="6">TOTAL JANGKAUAN    INDOSIAR</td>
        <td align="right">175.146.069</td>
      </tr>
      <tr>
        <td colspan="6">TOTAL PENDUDUK INDONESIA</td>
        <td align="right">219.898.300</td>
      </tr>
      <tr>
        <td colspan="6">% JANGKAUAN INDOSIAR    DARI TOTAL PENDUDUK INDONESIA</td>
        <td align="right">80%</td>
      </tr>
      <tr>
        <td colspan="6">JUMLAH KOTA (KOTAMADYA/    KABUPATEN)</td>
        <td align="right">188</td>
      </tr>
      <tr>
        <td colspan="6">JUMLAH PROPINSI (TOTAL    INDONESIA : 33)</td>
        <td align="right">25</td>
      </tr>
      <tr>
        <td colspan="6">% JANGKAUAN INDOSIAR    DARI JUMLAH PROPINSI</td>
        <td align="right">75,758%</td>
      </tr>
      <tr>
        <td colspan="6">SELURUH STASIUN TRANSMISI DILENGKAPI DENGAN    SISTEM TATA SUARA NICAM STEREO</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="6">Sumber    : BPS - Survey Sosial Ekonomi Nasional Penduduk 2003&nbsp; dan Engineering Dept. Indosiar</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7">&nbsp;</td>
      </tr>
  </table>
</p>
</div>
<?
include (APPPATH."views/inc_footer.php");
?>