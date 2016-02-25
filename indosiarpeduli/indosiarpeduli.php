<?php
$sitename               = "INDOSIAR Peduli";
$HTMLPageTitle          = "INDOSIAR Peduli";
$HTMLMetaDescription    =  'Indosiar Peduli merupakan program kemanusiaan yang meliputi Peduli Kasih, Kita Peduli, dan Peduli Komunitas';
$no_fb_timeline         = true;

include (APPPATH."views/inc_header.php");
?>
<link rel="stylesheet" href="/assets/css/csr.css" type="text/css">
<div class="social-row">
    <ul class="social" id="css3-social">
        <li><span>Follow Us :<span></li>
    	<li class="facebook">
    		<a href="http://www.facebook.com/IndosiarPeduli" target="_blank"><strong>Facebook</strong></a>
    	</li>
    	<li class="twitter">
    		<a href="https://twitter.com/Indosiar_Peduli" target="_blank"><strong>Twitter</strong></a>
    	</li>
    	<li class="youtube">
    		<a href="http://www.youtube.com/user/IndosiarPeduli" target="_blank"><strong>Youtube</strong></a>
    	</li>
    </ul>
    <div style="clear:both"></div>
</div>
<div style="width:200px;float:left;margin-right:30px;">
    <div class="csr_programbox">
        <div style="text-align:center;"><a href="<?=site_url('pedulikasih')?>"><img src="/assets/images/pedulikasih_logo.png" width="130" border="0" alt="Peduli Kasih" title="Program Peduli Kasih INDOSIAR" /></a></div>
        <div class="csr_clickhere"><a href="<?=site_url('pedulikasih')?>">click here</a></div>
        <div style="text-align:center;"><a href="<?=site_url('kitapeduli')?>"><img src="http://static.indosiar.com/images/kitapeduli.jpg" width="120" border="0" alt="Kita Peduli" title="Program Kita Peduli INDOSIAR" /></a></div>
        <div class="csr_clickhere"><a href="<?=site_url('kitapeduli')?>">click here</a></div>
        <div style="text-align:center"><a href="<?=site_url('pedulikomunitas')?>"><img src="/assets/images/pedulikomunitas_logo.jpg" width="120" border="0" alt="Peduli Komunitas" title="Program Peduli Komunitas INDOSIAR" /></a></div>
        <div class="csr_clickhere" style="margin-bottom:0px;"><a href="<?=site_url('pedulikomunitas')?>">click here</a></div>
    </div>
</div>
<div style="width:640px;float:left;">
    <p align="center"><img src="/assets/images/indosiarpeduli_logo.jpg" width="200" border="0" alt="INDOSIAR Peduli" title="INDOSIAR Peduli" /></p>
    <p>&nbsp;</p>
    <p style="text-align:justify;text-justify:inter-word;">Merujuk kepada Dasar Negara Republik Indonesia, Pancasila, dan alenia ke-4 Pembukaan Undang-Undang Dasar 1945, serta didorong oleh keinginan luhur untuk turut serta mewujudkan bangsa yang mandiri dan sejahtera, maka Perseroan tidak berhenti pada pencarian keuntungan finansial semata, tetapi juga berupaya memberikan sumbangsih bagi masyarakat banyak sesuai dengan tanggung jawab sosial perusahaan.</p>
    <p style="text-align:justify;text-justify:inter-word;">Wujud tanggung jawab sosial Perseroan dimulai sejak awal pendirian, berangkat dari lingkungan sekitar dan terus berkembang hingga menggapai seluruh masyarakat Indonesia tanpa terkecuali. Sebagai media penyampai informasi yang memiliki kemampuan menjangkau jutaan pemirsa secara cepat pada saat yang bersamaan, Perseroan senantiasa merasa terpanggil untuk memberikan kontribusi lebih bagi masyarakat Indonesia. Dengan dana yang berasal dari Perseroan dan kedermawanan sosial masyarakat (filantropi) yang digalang oleh Perseroan sebagai wujud kepedulian sosial serta bagian dari fungsi dan peran sosial media massa, Perseroan menyelenggarakan tiga program, yaitu : <a href="<?=site_url('pedulikasih')?>">Peduli Kasih</a>, <a href="<?=site_url('kitapeduli')?>">Kita Peduli</a>, dan <a href="<?=site_url('pedulikomunitas')?>">Peduli Komunitas</a> di bawah payung Indosiar Peduli. Demi menjaga transparansi dan akuntabilitas, Laporan Keuangan Indosiar Peduli diaudit secara berkala oleh Kantor Akuntan Publik Independen. Seluruh dana yang dihimpun dari pemirsa dapat dipantau melalui <i>website</i> <a href="http://www.indosiar.com">www.indosiar.com</a></p>
    <!--<p align="center"><a href="http://www.youtube.com/user/IndosiarPeduli" target="_blank"><img src="/assets/images/indosiarpeduli_youtube.jpg" border="0" title="INDOSIAR Peduli Youtube Channel" alt="INDOSIAR Peduli Youtube Channel"/></a></p>-->
</div>
<div style="clear:both"></div>
<p>&nbsp;</p>

<?php
include (APPPATH."views/inc_footer.php");
?>