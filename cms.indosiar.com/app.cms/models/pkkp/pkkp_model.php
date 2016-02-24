<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pkkp_model extends CI_Model {
    function __construct() {
        parent::__construct();
        //$this->load->database();
        $this->load->library('allfunction');         
    }
		
		function submitData($file_name_excel,$kategori) {			
			if ($file_name_excel!="") {
				
				$upload_dir = STATIC_PATH."tmp/";
				$getWorksheetName = array();
				require_once('simplexlsx.class.php');
				//$xlsx = $this->simplexlsx->addexcel($upload_dir.$file_name_excel);
				$xlsx = new SimpleXLSX($upload_dir.$file_name_excel);		
				$getWorksheetName = $xlsx->getWorksheetName();
		    $sep = ",";	    
		    ob_start();
				for($j=1;$j <= $xlsx->sheetsCount();$j++){
					list($cols,) = $xlsx->dimension($j);
					foreach( $xlsx->rows($j) as $k => $r) {
						$tmpexcel=""; 
						for( $i = 0; $i < $cols; $i++) {
							//if (isset($r[$i])) {
								if ($k>0) {								
									//if ($i==4) {
									//	$tmpdate=($r[$i] - 25569)*86400;
									//	$tmpexcel.=date('Y-m-d',$tmpdate).$sep;
									//}else {
										if (isset($r[$i])) {
											$tmpexcel.=str_replace(","," ",$r[$i]).$sep;
										}else {
											$tmpexcel.="".$sep;
										}
									//}	
								}				
						}	
						if ($tmpexcel!="") echo $tmpexcel."\n\r";
					}
				}
		    $filecsv="kitapeduli-pedulikasih.csv";
		    $fp = fopen($upload_dir.$filecsv,'w');
		    fwrite($fp,ob_get_contents());
		    fclose($fp);
		    ob_end_clean();

				$data = file_get_contents($upload_dir.$filecsv);
				$data = str_replace("'","`",$data);
				//echo $data."\n\r";
				//exit();
				$data = explode("\n\r", $data);
				$i=1;
				$sql1="";
				foreach($data as $arr) {
					//echo $i."<br>";
					if ($i>1) {
						if (trim($arr) != "") {			
							//echo $arr."\n\r";		    			   								    			
							$arr = explode(",", $arr);		
							$tgl=$arr[4]; 
						  //$arrtgl=explode("/",$arr[4]);
						  //$tgl=$arrtgl[2]."-".$arrtgl[0]."-".$arrtgl[1];						
							if ($kategori=="pedulikasih") {
								$sql = "select nama from pedulikasih1 where tanggal='".$tgl."' and kategori='person' and nama='".str_replace("'","",$arr[1])."' and nilai=".$arr[3];
								$query = $this->db->query($sql);
								if ($query->num_rows() == 0) {								
									$sql="insert into pedulikasih1 (kota,nama,nilai,tanggal,kategori) values ('".$arr[2]."','".str_replace("'","",$arr[1])."',".$arr[3].",'".$tgl."','person');";					    		
									$this->db->query($sql);
									//mysql_query($sql) or die (mysql_error());
								}
							}else {
								$sql = "select nama from kitapeduli where tanggal='".$tgl."' and kategori='person' and nama='".str_replace("'","",$arr[1])."' and nilai=".$arr[3];
								$query = $this->db->query($sql);
								if ($query->num_rows() == 0) {							
									$sql="insert into kitapeduli (kota,nama,nilai,tanggal,kategori) values ('".$arr[2]."','".str_replace("'","",$arr[1])."',".$arr[3].",'".$tgl."','person');";
									$this->db->query($sql);
								}	
							}
							$sql1.=$sql."\n\r";
						}
					}	
					$i++;
				}	
				echo "{success: true}";
			}	
		}

}