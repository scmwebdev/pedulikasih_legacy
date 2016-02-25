<?
		$id 	= (int)$this->uri->segment(2);
		$idinc 	= (int)$this->uri->segment(3);
		$home	= $this->uri->segment(4);

		$query = $this->db->query("select * from banner where id=?", array($id));
		if ($query->num_rows() > 0)
		{
			$row = $query->row(); 
		 	$link=trim($row->link);
		 	$linkalternatif=trim($row->linkalternatif);
		 	$tanggal_akhir=$row->tanggal_akhir;
		 	$java_script=trim($row->java_script);
		 	$klik=$row->klik;
			
			if ($link=="0") {
				$link="";
			}
			if ($linkalternatif=="0") {
				$linkalternatif="";
			}
		}
		$query->free_result();
		$txtbanner="<head>
		<script language=\"javascript\">	
		function cheatCloseWin() {
		  win = top;
		  // lying:
		  win.opener = top;
		  win.close ();
		}		
		".$java_script."	
		
		function mailto(emailnya) {
		window.opener.location.href=emailnya;
		cheatCloseWin ();
		}
		</script></head>";
		
		if ($tanggal_akhir>date("Y-m-d H:i:s")) {
			$linkalternatif=$link;
		}
			
		$browser=trim($_SERVER['HTTP_USER_AGENT']);
		$ipuser=trim($_SERVER['REMOTE_ADDR']);

		//$query = $this->db->query("select * from banner_blokip where ip='".$ipuser."'");
		//if ($query->num_rows() > 0)
		//{		
			// $this->db->query("update banner set klik=klik+1  where id=$id");
			// $sqlupdate1="insert into banner_log (tanggal,ip,browser,id_inc,id_banner) values(now(),'".$ipuser."','".$browser."',".$idinc.",".$id.")";
			// $this->db->query($sqlupdate1);
			// $sqlupdate2="update banner_inc set klik=klik+1 where id=$idinc";
			// $this->db->query($sqlupdate2);
		//}
		//$query->free_result();
		
		if ($home=="ok") {
		
			If (strlen($linkalternatif) == "") {
			 	echo "<html>".$txtbanner."<body><script>document.location.href='".$_SERVER['HTTP_REFERER']."';</script>\n</body></html>";
				exit();
			}
		   else {
		   	if (substr($linkalternatif,0,11)=="javascript:") {
					echo '					
			   <html>'.$txtbanner.'
			   <body onload="'.str_replace("javascript:","",$linkalternatif).'">
			   </body>
			   </html>';
			   exit();
				}
		elseif (substr($linkalternatif,0,7)=="mailto:") {
			echo '
			   <html>'.$txtbanner.'
			   <body onload="window.close();">
			   </body>
			   </html>';		
			   exit();
				}
			else {	
				if (strlen($linkalternatif)<>strlen(str_replace(",","",$linkalternatif))) {
					echo '
				   <html>'.$txtbanner.'
				   <body onload=\'javascript:window.location="http://'.$linkalternatif.'";\'>
				   </body>
				   </html>';
				   exit();
					}
				else	{
				 	echo "<html><body><script>document.location.href='http://".$linkalternatif."';</script>\n</body></html>";
					exit();			
				}   		
		   	}	
		   	
		   }
		}
		else	{
		
		   If (strlen($linkalternatif)=="") {
			 	echo "<html>".$txtbanner."<body><script>document.location.href=".$_SERVER['HTTP_REFERER']."';</script>\n</body></html>";
				exit();
			 }
		   else	{
		   	if (substr($linkalternatif,0,11)=="javascript:") { 
				 echo '
			   <html>'.$txtbanner.'
			   <body onload="'.str_replace("javascript:","",$linkalternatif).'">
			   </body>
			   </html>';
			   exit();	
				}
			elseif (substr($linkalternatif,0,7)=="mailto:") {
				echo '
			   <html>'.$txtbanner.'
			   <body onload="window.close();">
			   </body>
			   </html>';
			   exit();
				}
			else	
			{
				if (strlen($linkalternatif)<>strlen(str_replace(",","",$linkalternatif))) {
					echo '
				   <html>'.$txtbanner.'
				   <body onload=\'javascript:window.location="http://'.$linkalternatif.'";\'>
				   </body>
				   </html>';
				   exit();
					}
				else	{
				 	echo "<html>".$txtbanner."<body><script>document.location.href='http://".$linkalternatif."';</script>\n</body></html>";
					exit();				
				}
		   	}
		   	
		   }
		
		}
		
?>