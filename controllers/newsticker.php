<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Newsticker extends CI_Controller {
  function __construct() {
    parent::__construct();
  }

  function index(){
    $str='';
    $word1 = array("&","'");
    $word2 = array("dan","`");

    $_query="/*web:ticker_model::: selectTickerindosiar*/
    SELECT * FROM news_ticker
    WHERE publish = 1
    ORDER BY tanggal DESC LIMIT 0,25";

    $result = $this->db->query($_query)->result();

    foreach($result as $row) :
      $str .= '
        <item>
            <id>'.$row->id.'</id>
            <category>'.$row->kategori.'</category>
            <title>'.strtoupper(html_entity_decode(str_replace($word1, $word2, $row->judul))).'</title>
            <desc>'.strtoupper(html_entity_decode(str_replace($word1, $word2, $row->isi))).'</desc>
            <pubdate>'.$row->tanggal.'</pubdate>
            <sort>'.$row->sort.'</sort>
        </item>
        ';
    endforeach;

    header('Content-type: application/xml', true);

    echo '<?xml version="1.0" encoding="UTF-8"?'.'>';
    echo '<rss version="2.0">';
    echo '<channel>';
    echo '<title>INDOSIAR RSS 0.92</title>';
    echo '<link>'.base_url().'</link>';
    echo '<description>INDOSIAR</description>';
    echo '<lastBuildDate>'.date("D, d M Y H:i:s").' +0700</lastBuildDate>';
    echo '<docs>http://backend.userland.com/rss092</docs>';
    echo $str;
    echo '</channel>';
    echo '</rss>';    
  }

}
