<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron extends CI_Controller {
	//var $mbox;

	public function index(){}
	
	public function pedulikasih(){
	    $this->_fetchmail('pedulikasih');
	}
	
	public function kitapeduli(){
	    $this->_fetchmail('kitapeduli');
	}

        private function _connect($jenis) {
            $myServerName   = "{webmail.indosiar.com:143/imap/novalidate-cert}INBOX";
            $myUsername     = $jenis.'.bca';
            $myPassword     = 'Init1234';
            $tryCnt         = 0;

            while(!is_resource($this->mbox)){
              $this->mbox = imap_open($myServerName, $myUsername, $myPassword,
                                  NULL, 1, array("DISABLE_AUTHENTICATOR" => "GSSAPI"));
              $tryCnt ++;

              if(!is_resource($this->mbox)){
                $this->mbox = imap_open($myServerName, $myUsername, $myPassword,
                                    NULL, 1, array('DISABLE_AUTHENTICATOR' => 'PLAIN'));
                $tryCnt ++;
              }

              if($tryCnt > 20){
                echo "Cannot Connect To Exchange Server:<BR>";
                die(var_dump(imap_errors()));
              }
            }
        }
	
	private function _fetchmail($jenis){
        	$this->load->library('PHPExcel');

		//$myServerName       = "{webmail.indosiar.com/imap:1143}INBOX";
		$myServerName 		= "{webmail.indosiar.com:143/imap/novalidate-cert}INBOX";
		$myUsername         = $jenis.'.bca';
		$myPassword         = 'Init1234';
		//$myPassword         = 'ivm2012';
		$mySavePath         = '/data/bca/'.$jenis.'/';
		$myTrustedDomain    = array('indosiar.com','bca.co.id');

		$message                          = array();
		$message["attachment"]["type"][0] = "text";
		$message["attachment"]["type"][1] = "multipart";
		$message["attachment"]["type"][2] = "message";
		$message["attachment"]["type"][3] = "application";
		$message["attachment"]["type"][4] = "audio";
		$message["attachment"]["type"][5] = "image";
		$message["attachment"]["type"][6] = "video";
		$message["attachment"]["type"][7] = "other";

		echo "\r\n";
		echo date ('d-m-Y H:i:s')." -> $jenis is on work!\r\n";
		echo "\r\n";
	   
		//$this->_connect($jenis);
		//$mbox = $this->mbox;

		$mbox = imap_open($myServerName, $myUsername, $myPassword, NULL, 1, array("DISABLE_AUTHENTICATOR" => "GSSAPI")) or die("Could not open Mailbox - try again later!\n".print_r(imap_errors()));
		//$mbox = imap_open($myServerName, $myUsername, $myPassword) or die("Could not open Mailbox - try again later!");

		/*if (count(imap_errors())) {
			echo "imap_errors:\n";
			print_r(imap_errors());
			die;
		}*/

		if ($hdr = imap_check($mbox)) 
            		$msgCount = $hdr->Nmsgs;
		else
			die("imap_check error");
	
		$overview   = imap_fetch_overview($mbox,"1:$msgCount",0);
		$size       = sizeof($overview); 

		//for ($i=0; $i<$size; $i++) {
		for ($i=($size-1); $i >= 0; $i--) {
			$val    = $overview[$i];
			$msgno  = $val->msgno;
			$date   = $val->date;
			$subject= $val->subject;
			$seen   = $val->seen;
			$from   = str_replace('"','',$val->from);

			// MAKE DANISH DATE DISPLAY
			list($dayName,$day,$month,$year,$time) = explode(" ",$date); 
			$time = substr($time,0,8);
			$date = $day ." ". $month ." ". $year . " ". $time;

			//$this->_connect($jenis);
			//$mbox = $this->mbox;

			$tryCnt = 0;

			while(!is_resource($mbox)){
				$mbox = imap_open($myServerName, $myUsername, $myPassword, 
						NULL, 1, array("DISABLE_AUTHENTICATOR" => "GSSAPI"));
				$tryCnt ++;

				if(!is_resource($mbox)){
					$mbox = imap_open($myServerName, $myUsername, $myPassword, 
							  NULL, 1, array('DISABLE_AUTHENTICATOR' => 'PLAIN'));
					$tryCnt ++;
				}

				if($tryCnt > 20){
					echo "Cannot Connect To Exchange Server:<BR>";
					die(var_dump(imap_errors()));
				}
			}

			//$structure = imap_fetchstructure($mbox, $val->uid, FT_UID);  
			$structure  = imap_fetchstructure($mbox, $msgno) or die("$i == $msgno == $date == $subject");
			if (isset($structure->parts)) {
				//echo "$msgno == $subject == $date \n";

				$parts  = $structure->parts;
				$fpos   = 2;
				for($j = 1; $j < count($parts); $j++) {
					$message["pid"][$j] = ($j);
					$part               = $parts[$j];
					
					if(isset($part->disposition) && $part->disposition == "attachment" && $part->subtype == "VND.MS-EXCEL") {
						$message["type"][$j]    = $message["attachment"]["type"][$part->type] . "/" . strtolower($part->subtype);
						$message["subtype"][$j] = strtolower($part->subtype);
						$ext                    = $part->subtype;
						$params                 = $part->dparameters;
						$filename               = $part->dparameters[0]->value;
						$filedate               = str_ireplace(array(".xls","pk","kp"), "", $filename);
						
						if (strlen($filedate) == 6) $filedate = '20'.substr($filedate, 0, 2).'-'.substr($filedate, 2, 2).'-'.substr($filedate, -2);
						
						$mege   = "";
						$data   = "";
						$mege   = imap_fetchbody($mbox,$msgno,$fpos);

						$sql = "SELECT log_id FROM ".$jenis."_bca_log WHERE log_from='".mysql_real_escape_string($from)."' AND log_subject='".mysql_real_escape_string($subject)."' AND log_date='$date'";
						$query = $this->db->query($sql);
						if ($query->num_rows() > 0) {
							$query->free_result();
						} else {
							$query->free_result();
							                             
							// Check Trusted Domain
							$myEmail        = $from;
							$myLeft         = '<';
							$myRight        = '>';
							$myPosLeft      = strpos($myEmail,$myLeft);
							$myPosRight     = strpos($myEmail,$myRight);
							$myLen          = $myPosRight - $myPosLeft;
							$mySubsEmail    = substr($myEmail,$myPosLeft+1,$myLen-1);
							$myExpl         = explode('@',$mySubsEmail);
							$myDomain       = $myExpl[1];
		      
		      		        if (in_array(strtolower($myDomain), $myTrustedDomain)) {    		      				
    							$myFormat           = str_replace(' ','_',$date);
    							$myFormat           = str_replace(':','_',$myFormat);
    							$mySaveFilename     = 'bca_'.$myFormat.'.xls';
    							$mySaveFilenameCSV  = 'bca_'.$myFormat.'.csv';
    							
    							$fp     = fopen($mySavePath.$mySaveFilename,"w");
    							if (!$fp) die("unable to create file: ".$mySavePath.$mySaveFilename);
    							$data   = $this->_getdecodevalue($mege,$part->type);
    							fputs($fp,$data);
    							fclose($fp);
                                
                                chmod($mySavePath.$mySaveFilename, 0777);
                                                                    
    			      			$objPHPExcel    = new PHPExcel();
    			      			$objPHPExcel    = PHPExcel_IOFactory::load($mySavePath.$mySaveFilename);
    			      			$objWriter      = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV')->setDelimiter('|')
                                                  ->setEnclosure('')
                                                  ->setLineEnding("\r\n")
                                                  ->setSheetIndex(0)
                                                  ->save($mySavePath.$mySaveFilenameCSV);
                                
                                chmod($mySavePath.$mySaveFilenameCSV, 0777);
                            
								echo "\r\n";
								echo "logged: $from\t$subject\t$date\r\n";
								echo "$mySavePath$mySaveFilename\r\n";		

    			      			$csvData    = file_get_contents($mySavePath.$mySaveFilenameCSV);
    			      			$csvRow     = explode("\r\n",$csvData);
			      			
    			      			for ($k=0; $k<count($csvRow); $k++) {
			      					if ($k == 0) {
		      							$csv    = explode("|", $csvRow[$k]);
		      							if (count($csv) != 5 && $csv[0] != "NO" && $csv[1] != "NAMA" && $csv[2] != "KOTA" && $csv[3] != "NILAI" && $csv[4] != "TGL") {
	      									echo "\r\n";
	      									echo "kolom data tidak valid!\r\n";
	      									break;
		      							}
			      					} else {
		      							$csv    = explode("|", $csvRow[$k]);
		      							if (count($csv) == 5) {
		      							    $tgl        = array();
			      							$ID2 		= $csv[0];
			      							$KOTA 		= $csv[2];
			      							$NAMA 		= $csv[1];
			      							$NILAI 		= $csv[3];
			      							$TANGGAL	= $filedate;
			      							
			      							/*$csv[4]     = trim($csv[4]);
			      							if (strlen($csv[4]) == 10) {
    			      							$tgl    = explode("/", $csv[4]);
    			      							if (count($tgl) != 3) $tgl     = explode("-", $csv[4]);
    			      							if (count($tgl) == 3) $TANGGAL = $tgl[2].'-'.$tgl[0].'-'.$tgl[1];
    			      						}*/
			      							    
			      							    
			      							$sql = "INSERT INTO ".$jenis."_bca (ID2,KOTA,NAMA,NILAI,TANGGAL,KATEGORI) VALUES ($ID2,'".mysql_real_escape_string($KOTA)."','".mysql_real_escape_string($NAMA)."','$NILAI','$TANGGAL','person')";
                                            $this->db->simple_query($sql);
                                            
											echo "$ID2, $KOTA, $NAMA, $NILAI, $TANGGAL \r\n";
											
											//sleep (1);
										}
			      					}
    			      			}
    			      			
    		      				$sql = "INSERT INTO ".$jenis."_bca_log(log_id,log_from,log_subject,log_date) VALUES('','".mysql_real_escape_string($from)."','".mysql_real_escape_string($subject)."','$date')";
    		      				$this->db->simple_query($sql);
							}
						}
						
						$fpos+=1;
					}
				}
            }
		}
	
		imap_close($mbox);
	}
		
	function _getdecodevalue($message,$coding) {
		switch($coding) {
			case 0:
			case 1:
				$message = imap_8bit($message);
				break;
			case 2:
				$message = imap_binary($message);
				break;
			case 3:
			case 5:
				$message = imap_base64($message);
				break;
			case 4:
				$message = imap_qprint($message);
				break;
		}
		return $message;
	}
}
