<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CI_Sctvlib {
		function judul_url($str,$id) {
				$replace 		= array("'",'"');
				$delimiter	= '-';
				$str 				= str_replace((array)$replace, ' ', trim($str));
			
				$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
				$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
				$clean = strtolower(trim($clean, '-'));
				$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
			
				return $clean."_".$id.".html";
		}
			
		public function judul_url_no_id($str)
		{
				$replace 		= array("'",'"');
				$delimiter	= '-';
				$str 				= str_replace((array)$replace, ' ', trim($str));
			
				$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
				$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
				$clean = strtolower(trim($clean, '-'));
				$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
				
				return $clean;
		}	

    function getAirDays($data) {
    		$arr = explode(";", $data);
    		$data = "";
    		if (count($arr) == 7) {
    				if ($arr[0] == 1) $data .= 'Senin, ';
    				if ($arr[1] == 1) $data .= 'Selasa, ';
    				if ($arr[2] == 1) $data .= 'Rabu, ';
    				if ($arr[3] == 1) $data .= 'Kamis, ';
    				if ($arr[4] == 1) $data .= 'Jumat, ';
    				if ($arr[5] == 1) $data .= 'Sabtu, ';
    				if ($arr[6] == 1) $data .= 'Minggu, ';
    				
    				if ($data != "") {
	    					$data = 'Setiap '.substr($data,0,-2);
	    					if ($arr[4] == 1 && $arr[5] == 1 && $arr[6] == 1) $data = 'Jumat - Minggu';
	    					if ($arr[0] == 1 && $arr[1] == 1 && $arr[2] == 1 && $arr[3] == 1 && $arr[4] == 1) $data = 'Senin - Jumat';
	    					if ($arr[0] == 1 && $arr[1] == 1 && $arr[2] == 1 && $arr[3] == 1 && $arr[4] == 1 && $arr[5] == 1) $data = 'Senin - Sabtu';
	    					if ($arr[1] == 1 && $arr[2] == 1 && $arr[3] == 1 && $arr[4] == 1 && $arr[5] == 1 && $arr[6] == 1) $data = 'Selasa - Minggu';
	    					if ($arr[0] == 1 && $arr[1] == 1 && $arr[2] == 1 && $arr[3] == 1 && $arr[4] == 1 && $arr[5] == 1 && $arr[6] == 1) $data = 'Setiap Hari';
    				}
    		}
    		
    		return $data;
    }
}	
?>	