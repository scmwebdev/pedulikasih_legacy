<?
$HTMLPageTitle = "PT. Indosiar Visual Mandiri Memang Untuk Anda | Tv Indonesia";
$HTMLMetaDescription = "PT. Indosiar Visual Mandiri Memang Untuk Anda | Tv Indonesia";
$HTMLMetaKeywords = "Indosiar Community";
    
include (APPPATH."views/inc_header.php");
?>
  <div style="float:right;width:610px;">
    <div class="RoundedBox5px" style="width:590px;background:#E9E9E9;padding:10px;">
      <div class="RoundedBox5px" style="float:left;width:260px;height:300px;padding:10px;background:#fff;"><div id="hlBOX"></div></div>
      <div style="float:left; width:310px;">
        <div style="padding:0 0 5px 10px;" class="JudulKanal">What's On The Week</div>
<?
$strID = "";
$i = 1;
$query = $this->homepage_model->showWhatsOnTheWeek(2,$strID,4);
foreach ($query as $row) {
    $url = $this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']);
    $tgl_tayang = $this->allfunction->UbahTglTayang($row['tgl_tayang']);
    echo '
        <div id="hl'.$i.'" style="display:none;visibility:hidden;">
          <a href="'.$url.'"><div class="SubHeader" style="cursor:Pointer;background:url('.$this->config->item('URL_IMAGES_V09').$row['folder'].'/'.$row['img_index'].') no-repeat top left">
            <div class="SubHeader-BoxM">
              <div class="SubHeader-Box">
                <div class="SubHeader-Judul">'.$row['judul'].'</div>
              </div>
            </div>
          </div></a>
          <div style="text-align:center;font-size:11px;">[ Tayang: '.$tgl_tayang.' ]</div>
          <div style="font-size:11px;margin-top:5px;">'.(($row['subjudul'] == "") ? '' : '<b>'.$row['subjudul'].'</b><br />').$row['ringkasan'].'...[ <a href="'.$url.'">more</a> ]</div>
        </div>
        <div class="RoundedBoxTRBR5px" id="hlr'.$i.'" style="margin:2px 0;background:#B6B6B6;padding:8px;cursor:Pointer;" onMouseOver="ShowNews('.$i.')">
          <div style="font-size:10px">'.$tgl_tayang.'</div>
          <a href="'.$url.'"><b>'.$row['judul'].'</b></a>
        </div>';
    $strID .= " and id<>".$row['id'];
    $i++;
}
?>
        <div align=center style="margin-top:10px;"><?=$this->banner_model->getBanner(324)?></div>
      </div>
      <div style="clear:both"></div>
      <script type="text/javascript">
      var hlactive = 1;
      
      $("#hlBOX").html($("#hl1").html());
      $("#hlr1").css({backgroundColor:"#fff"});
      
      function ShowNews(idx) {
        $("#hlBOX").html($("#hl"+idx).html());
        $("#hlr"+idx).css({backgroundColor:"#fff"});
        
        if (hlactive != idx) {
          $("#hlr"+hlactive).css({backgroundColor:"#B6B6B6"});
          hlactive = idx;
        }
      }
      </script>
    </div>
  </div>
  <div style="float:left;width:300px;">
    <div><?=$this->banner_model->getBanner(303)?></div>
    <div style="margin-top:10px"><?=$this->banner_model->getBanner(304)?></div>
  </div>
  <div style="clear:both;padding-top:10px;"></div>
  <div style="float:right;width:610px;">
    <div style="float:left;width:300px;">
      <div class="JudulKanal">Sinopsis</div>
<?
$query = $this->homepage_model->showSinopsis($strID);
foreach ($query as $row) {
        $strID .= " and id<>".$row['id'];
        $url = $this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']);
        echo '
        <div style="clear:both;margin-top:10px;">
          <a href="'.$url.'"><img src="'.$this->config->item('URL_IMAGES_V09').$row['folder'].'/'.$row['img_list'].'" width="100" height="85" align="left" border="0" alt="'.$row['judul'].'" title="'.$row['judul'].'" style="margin-right:5px;" /></a>
          '.(($row['subjudul'] == "") ? '' : '<div class="SubJudulList">'.$row['subjudul'].'</div>').'
          <a href="'.$url.'"><b>'.$row['judul'].'</b></a>
          <div class="TglTayang">Tayang: '.$this->allfunction->UbahTglTayang($row['tgl_tayang']).'</div>
          <div style="clear:both;"></div>
        </div>';
}
?>      
    </div>
    <div style="float:right;width:300px;">
<?  
echo $this->banner_model->getBanner(328);

include ($this->config->item('ROOTBASEPATH')."inc/program_change.php");
if ($progchange_judul == "") {
  echo '
        <div style="text-align:center;margin-top:10px;"><a href="/jadwal-acara/"><img src="/img/v9-jadwal-cut.gif" border="0" alt="jadwal acara" title="jadwal acara" /></a><a href="/program-change/"><img src="/img/v9-jadwal-change.gif" border="0" alt="program change" title="program change" /></a></div>';
} else {
  echo '<div style="text-align:center;margin-top:10px;"><a href="/jadwal-acara/"><img src="/img/v9-jadwal-cut.gif" border="0" alt="jadwal acara" title="jadwal acara" /></a><a href="/program-change/"><img src="/img/v9-jadwal-change.gif" border="0" alt="program change" title="program change" /></a></div>';
  //echo '<div style="text-align:center;margin-top:10px;"><a href="/jadwal-acara/"><img src="/img/v9-jadwal.gif" border="0" alt="jadwal acara" title="jadwal acara" /></a></div>';
}
?>
    </div>
    <div style="clear:both"></div>
  </div>
  <div style="float:left;width:300px;">
<?
$query = $this->homepage_model->showArticleKategori(1,$strID);
foreach ($query as $row)
{
        $strID .= " and id<>".$row['id'];

        echo '
        <div style="padding:5px 10px;margin-bottom:2px;background:#efefef;" class="RoundedBox5px">';
        
        if ($row['jenis_id'] == 8) echo '<div class="TglTayang">'.$this->allfunction->UbahTglTayang($row['tanggal']).'</div>';
        
        echo '
          <div class="JenisList">'.$row['jenis_judul'].'</div>
          '.(($row['subjudul'] == "") ? '' : '<div class="SubJudulList">'.$row['subjudul'].'</div>').'
          <a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'"><b>'.$row['judul'].'</b></a>
        </div>';
}

echo $this->banner_model->getBanner(326); 
?>
  </div>
  <div style="clear:both;padding-top:10px;"></div>
  <div style="float:left;width:300px;margin-right:10px;">
    <div><a href="<?=site_url('gossip')?>"><img src="<?=$this->config->item('URL_IMG')?>v9-col-gossip.gif" border="0" alt="gossip" title="gossip" /></a></div>
    <div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;" class="ListHomeJudul">
      <ul>
<?
$query = $this->homepage_model->showArticleJenis(2,$strID);
foreach ($query as $row) {
        $strID .= " and id<>".$row['id'];
        echo '
          <li><a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'">'.$row['judul'].'</a></li>';
}
?>
      </ul>
      <div style="margin-top:5px">
        <b>Tags:</b> 
<?
$query = $this->homepage_model->showArticleJenisTag(2);
foreach ($query as $row) {
        $fontsize = rand(1, 5);
        echo '
        <span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$row['tags_url']).'" class="tag'.$fontsize.'" title="'.$row['tags'].'">'.stripslashes($row['tags']).'</a></span> ';
}
?>
      </div>
    </div>
    <div><img src="<?=$this->config->item('URL_IMG')?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
  </div>

  <!-- INFOTAINMENT -->
  <div style="float:left;width:300px;margin-right:10px;">
    <div><a href="<?=site_url('infotainment')?>"><img src="<?=$this->config->item('URL_IMG')?>v9-col-infotainment.gif" border="0" alt="infotainment" title="infotainment" /></a></div>
    <div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;" class="ListHomeJudul">
      <ul>
<?
$query = $this->homepage_model->showArticleJenis(22,$strID);
foreach ($query as $row) {
        $strID .= " and id<>".$row['id'];
        echo '
          <li><a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'">'.$row['judul'].'</a></li>';
}
?>
      </ul>
      <div style="margin-top:5px">
        <b>Tags:</b> 
<?
$query = $this->homepage_model->showArticleJenisTag(22);
foreach ($query as $row) {
        $fontsize = rand(1, 5);
        echo '
        <span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$row['tags_url']).'" class="tag'.$fontsize.'" title="'.$row['tags'].'">'.stripslashes($row['tags']).'</a></span> ';
}
?>
      </div>
    </div>
    <div><img src="<?=$this->config->item('URL_IMG')?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
  </div>

  <!-- FEATURE -->
  <div style="float:left;width:300px;">
    <div><a href="<?=site_url('feature')?>"><img src="<?=$this->config->item('URL_IMG')?>v9-col-feature.gif" border="0" alt="feature" title="feature" /></a></div>
    <div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;" class="ListHomeJudul">
      <ul>
<?
$query = $this->homepage_model->showArticleJenis(23,$strID);
foreach ($query as $row) {
        $strID .= " and id<>".$row['id'];
        echo '
          <li><a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'">'.$row['judul'].'</a></li>';
}
?>
      </ul>
      <div style="margin-top:5px">
        <b>Tags:</b> 
<?
$query = $this->homepage_model->showArticleJenisTag(23);
foreach ($query as $row) {
        $fontsize = rand(1, 5);
        echo '
        <span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$row['tags_url']).'" class="tag'.$fontsize.'" title="'.$row['tags'].'">'.stripslashes($row['tags']).'</a></span> ';
}
?>
      </div>
    </div>
    <div><img src="<?=$this->config->item('URL_IMG')?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
  </div>
  <div style="clear:both;padding-top:10px;"></div>
  <div style="float:left;width:300px;margin-right:10px;">
    <div><a href="<?=site_url('fokus')?>"><img src="<?=$this->config->item('URL_IMG')?>v9-col-fokus.gif" border="0" alt="fokus" title="fokus" /></a></div>
    <div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;" class="ListHomeJudul">
      <ul>
<?
$query = $this->homepage_model->showArticleJenis(5,$strID);
foreach ($query as $row) {
        $strID .= " and id<>".$row['id'];
        echo '
          <li><a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'">'.$row['judul'].'</a></li>';
}
?>
      </ul>
      <div style="margin-top:5px">
        <b>Tags:</b> 
<?
$query = $this->homepage_model->showArticleJenisTag(5);
foreach ($query as $row) {
        $fontsize = rand(1, 5);
        echo '
        <span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$row['tags_url']).'" class="tag'.$fontsize.'" title="'.$row['tags'].'">'.stripslashes($row['tags']).'</a></span> ';
}
?>
      </div>
    </div>
    <div><img src="<?=$this->config->item('URL_IMG')?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
  </div>
  <div style="float:left;width:300px;margin-right:10px;">
    <div><a href="<?=site_url('patroli')?>"><img src="<?=$this->config->item('URL_IMG')?>v9-col-patroli.gif" border="0" alt="patroli" title="patroli" /></a></div>
    <div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;" class="ListHomeJudul">
      <ul>
<?
$query = $this->homepage_model->showArticleJenis(6,$strID);
foreach ($query as $row) {
        $strID .= " and id<>".$row['id'];
        echo '
          <li><a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'">'.$row['judul'].'</a></li>';
}
?>
      </ul>
      <div style="margin-top:5px">
        <b>Tags:</b> 
<?
$query = $this->homepage_model->showArticleJenisTag(6);
foreach ($query as $row) {
        $fontsize = rand(1, 5);
        echo '
        <span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$row['tags_url']).'" class="tag'.$fontsize.'" title="'.$row['tags'].'">'.stripslashes($row['tags']).'</a></span> ';
}
?>
      </div>
    </div>
    <div><img src="<?=$this->config->item('URL_IMG')?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
  </div>
  <div style="float:left;width:300px;">
    <div><a href="<?=site_url('ragam')?>"><img src="<?=$this->config->item('URL_IMG')?>v9-col-ragam.gif" border="0" alt="ragam" title="ragam" /></a></div>
    <div style="height:300px;padding:0px 10px;border-left:1px solid #ccc;border-right:1px solid #ccc;" class="ListHomeJudul">
      <ul>
<?
$query = $this->homepage_model->showArticleJenis(3,$strID);
foreach ($query as $row) {
        $strID .= " and id<>".$row['id'];
        echo '
          <li><a href="'.$this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']).'">'.$row['judul'].'</a></li>';
}
?>
      </ul>
      <div style="margin-top:5px">
        <b>Tags:</b> 
<?
$query = $this->homepage_model->showArticleJenisTag(3);
foreach ($query as $row) {
        $fontsize = rand(1, 5);
        echo '
        <span class="tag'.$fontsize.'"><a href="'.site_url('tag/'.$row['tags_url']).'" class="tag'.$fontsize.'" title="'.$row['tags'].'">'.stripslashes($row['tags']).'</a></span> ';
}
?>
      </div>
    </div>
    <div><img src="<?=$this->config->item('URL_IMG')?>v9-col-closer.gif" border="0" alt="column closer" title="column closer" /></div>
  </div>
  <div style="clear:both"></div>
</div>
<div class="container" style="background:#E9E9E9">
  <div style="float:left;width:300px;margin-right:10px;">
    <div class="JudulKanal">Corporate Info</div>
    <div style="margin-top:10px;" class="footLinkList">
      <div style="float:left;width:130px;">
        <h3>Marketing Services</h3>
        <ul>
          <li><a href="http://www.indosiar.com/transmisi">Coverage Area</a></li>
        </ul>
        <h3>Humanity</h3>
        <ul>
          <li><a href="http://www.indosiar.com/pedulikasih/">Peduli Kasih</a></li>
          <li><a href="http://www.indosiar.com/kitapeduli/">Kita Peduli</a></li>
        </ul>
      </div>
      <div style="float:left;width:130px;margin-left:10px;">
        <h3>Investor Relation</h3>
        <ul>
          <li><a href="http://www.indosiar.com/investor/">Corporate Action</a></li>
          <li><a href="http://www.indosiar.com/investor/">Shareholders Meeting</a></li>
          <li><a href="http://www.indosiar.com/investor/">News</a></li>
          <li><a href="http://www.indosiar.com/investor/">Financials</a></li>
        </ul>
      </div>
      <div style="clear:left"></div>
    </div>
    <div class="footLinkList">
      <h3>Respond Online</h3>
      <div style="float:left;width:130px;">
        <ul>
          <li><a href="http://www.indosiar.com/daua">HUMAS</a></li>
          <li><a href="http://www.indosiar.com/daua">PROGRAMME</a></li>
          <li><a href="http://www.indosiar.com/daua">NEWS</a></li>
          <li><a href="http://www.indosiar.com/daua">PRODUKSI</a></li>
          <li><a href="http://www.indosiar.com/daua">ENGINEERING</a></li>
        <ul>
      </div>
      <div style="float:left;width:130px;margin-left:10px;">
        <ul>
          <li><a href="http://www.indosiar.com/daua">SALES</a></li>
          <li><a href="http://www.indosiar.com/daua">MARKETING</a></li>
          <li><a href="http://www.indosiar.com/daua">FINANCE</a></li>
          <li><a href="http://www.indosiar.com/daua">WEBADMIN</a></li>
        </ul>
      </div>
      <div style="clear:left"></div>
    </div>
    <br /><br />
    <div style="float:left;width:130px;margin-left:10px;"><a href="http://www.facebook.com/pages/indosiarID/130125797101796" target="_blank"><img src="/img/fb140_40.gif" border="0" alt="" /></a></div>
    <div style="float:left;width:130px;margin-left:20px;"><a href="http://www.twitter.com/indosiartvtwit" target="_blank"><img src="/img/twitter140_40.gif" border="0" alt="" /></a></div>
    <div style="clear:left"></div>
  </div>
  <div style="float:left;width:300px;margin-right:10px;">
    <div class="JudulKanal">Variety Show</div>
<?
$query = $this->homepage_model->showArticleJenis(24, $strID, 3, 'img_list');
foreach ($query as $row) {
    $strID .= " and id<>".$row['id'];
    $url = $this->allfunction->makeArticleURL($row['id'],$row['judul_url'],$row['jenis_url']);
    echo '
    <div style="clear:both;margin-top:10px;">
      <a href="'.$url.'"><img src="'.$this->config->item('URL_IMAGES_V09').$row['folder'].'/'.$row['img_list'].'" width="100" height="85" align="left" border="0" alt="'.$row['judul'].'" title="'.$row['judul'].'" style="margin-right:5px;" /></a>
      '.(($row['subjudul'] == "") ? '' : '<div class="SubJudulList">'.$row['subjudul'].'</div>').'
      <a href="'.$url.'"><b>'.$row['judul'].'</b></a>
      <div style="clear:both;"></div>
    </div>';
}
?>  
  </div>
  <div style="float:left;width:300px;">
    <div><? echo  $this->banner_model->getBanner(308); ?></div>
    <div style="margin-top:10px"><? echo  $this->banner_model->getBanner(305); ?></div>
  </div>
<?
$JSFooter = '
<script type="text/javascript"><!--//<![CDATA[
var ox_u = "http://ads.liputan6.com/www/delivery/al.php?zoneid=210&ct0=INSERT_CLICKURL_HERE&layerstyle=simple&align=center&valign=middle&padding=2&closetime=15&padding=2&shifth=0&shiftv=0&closebutton=t&nobg=t&noborder=t";
if (document.context) ox_u += "&context=" + escape(document.context);
document.write("<scr"+"ipt type=\'text/javascript\' src=\'" + ox_u + "\'></scr"+"ipt>");
//]]>--></script>';

include (APPPATH."views/inc_footer.php");
?>
