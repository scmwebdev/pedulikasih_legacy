<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Allfunction {
    function Allfunction() 
    {
        $this->obj =& get_instance();
    }
    
		function judul2url($judul) {
				$judul = strip_tags($judul);
				$judul = htmlspecialchars_decode($judul, ENT_QUOTES);
				$judul_url = preg_replace("/[^a-zA-Z0-9_\- ]/", "", $judul);
				$judul_url = trim($judul_url);
				$judul_url = str_replace(array("_"," "), "-", $judul_url);
				$judul_url = str_replace(array("---","--"), "-", $judul_url);
				$judul = strtolower($judul_url);
				return $judul;
		}
		
		function makeArticleURL($artikel_id,$artikel_judul_url,$artikel_jenis_url) {
				return site_url($artikel_jenis_url.'/'.$artikel_judul_url.'_'.$artikel_id).'.html';
		}
		
		function UbahTgl($tgl) {
				if (!is_numeric($tgl)) $tgl = strtotime($tgl);
				//return date("j-M-Y", $tgl)." WIB";
				return date("j-M-Y", $tgl);
		}
		
		function UbahTglJam($tgl) {
				if (!is_numeric($tgl)) $tgl = strtotime($tgl);
				return date("j-M-Y H:i:s", $tgl)." WIB";
		}
		
		function UbahTglTayang($tgl) {
				if (!is_numeric($tgl)) $tgl = strtotime($tgl);
				return date("j-M-Y H:i", $tgl)." WIB";
		}
		
		function PotongTeks($data,$max=18) {
				$data = trim($data);
				if (strlen($data) > $max)
					return substr($data,0,$max)."...";
				else
					return $data;
		}

		function curPageURL() {
			 $pageURL = 'http';
			 //if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			 $pageURL .= "://";
			 if ($_SERVER["SERVER_PORT"] != "80") {
			  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			 } else {
			  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			 }
			 $pageURL=urlencode($pageURL);
			 return $pageURL;
		}			

		function beda_waktu($time)
		{ // calculate elapsed time (in seconds!)
		$diff = time()-$time;
		$daysDiff = floor($diff/60/60/24);
		$diff -= $daysDiff*60*60*24;
		$hrsDiff = floor($diff/60/60);
		$diff -= $hrsDiff*60*60;
		$minsDiff = floor($diff/60);
		$diff -= $minsDiff*60;
		$secsDiff = $diff;
		$beda="";
		if ($daysDiff>0) {
			$beda=$daysDiff.' days ';
		}
		if ($hrsDiff>0) {
			$beda.=$hrsDiff.' hours ';		 	
		}
		$beda.=$minsDiff.' minutes ';		 			
			
		return ($beda);
		}

		function menumainsite($sitename = "home") {
		$menu='
			<style type="text/css">
			#menusite ul{
				font: bold 10px Arial;
				margin:0;
				padding: 0;
				list-style: none;
			}
			
			#menusite li{
				font: bold 10px Arial;
				display: inline;
				padding: 0;
				text-transform:uppercase;
				vertical-align: middle;
			}
			
			#menusite a{
				font: bold 10px Arial;
				float: left;
				display: block;
				color: #fff;
				margin: 0;
				text-decoration: none;
				letter-spacing: 0px;
				padding: 0 12px 0 12px;
				height:30px;
				line-height: 30px;
				border-right:1px solid #fff;
			}
			
			#menusite a:hover{
				background:url('.$this->obj->config->item('URL_IMG').'tabbgh.gif);
			}
			
			#menusite #current a{
				font: bold 10px Arial;
				color: #fff;
				background:url('.$this->obj->config->item('URL_IMG').'tabbgs.gif);
				line-height: 30px;
			}
			</style>
			<div style="background:url('.$this->obj->config->item('URL_IMG').'tabbg.gif)">
				<div id="menusite">
					<ul>
			  		<li';
			  		if ($sitename == "home") $menu.=' id="current"';
			  		$menu.='><a href="'.$this->obj->config->item('URL_ROOT').'" target="_top"><img src="'.$this->obj->config->item('URL_IMG').'tabhome.gif" width="20" height="20" border="0" alt="back to halaman utama" style="margin-top:5px" /></a></li>
				    <li';
				    if ($sitename == "videofiesta") $menu.=' id="current"';
				    $menu.='><a href="'.$this->obj->config->item('URL_ROOT').'videofiesta/" target="_top">VIDEO FIESTA</a></li>
				    <li';
				    if ($sitename == "Respond Online") $menu.=' id="current"';  
				    $menu.='><a href="'.$this->obj->config->item('URL_ROOT').'daua" target="_top">RESPOND ONLINE</a></li>
				    <li><a href="'.$this->obj->config->item('URL_ROOT').'pedulikasih/" target="_top">PEDULI KASIH</a></li>
				    <li><a href="'.$this->obj->config->item('URL_ROOT').'investor/" alt="INVESTOR RELATIONS" target="_top">INVESTOR RELATION</a></li>
				    <li';
				    if ($sitename == "Transmisi Indosiar") $menu.=' id="current"';
				    $menu.='><a href="'.$this->obj->config->item('URL_ROOT').'transmisi" target="_top">Transmisi</a></li>
				  </ul>
				</div>
				<div style="clear:both"></div>
		  </div>';
		  return $menu; 
		  //menu
		}

		function strip_script($string) {
				$string = preg_replace("/<script[^>]*>.*?< *script[^>]*>/i", "", $string);
		    // Prevent linking to source files
		    $string = preg_replace("/<script[^>]*>/i", "", $string);
		
		    //styles
		    $string = preg_replace("/<style[^>]*>.*<*style[^>]*>/i", "", $string);
		    // Prevent linking to source files
		    $string = preg_replace("/<style[^>]*>/i", "", $string);
		    return $string;
		}

		function checkemail($address)
		{
		  // check an email address is possibly valid
		  return (preg_match('/^[a-z\d_\.\-]+@([a-z\d\-]+)(?:\.(?1)){1,2}$/i',$address)) ? true : false;
		}		
		
}