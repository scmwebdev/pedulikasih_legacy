<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Allfunction {
    function Allfunction() 
    {
        $this->obj =& get_instance();
    }
    
		function judul2url($judul) {
				$replace 		= array("'",'"');
				$delimiter	= '-';
				$str 				= str_replace((array)$replace, ' ', trim($judul));
			
				$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
				$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
				$clean = strtolower(trim($clean, '-'));
				$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
			
				return $clean;
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
		
    function addZero($data) {
    		if (strlen($data) == 1) $data = '0'.$data;
    		return $data;
    }
}