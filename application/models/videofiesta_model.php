<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Videofiesta_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
        //$this->obj =& get_instance();
        $this->DB = $this->load->database('default', true);
    }    
    
    function totalrecord($sql)    
    {
    	$result =  $this->DB->query($sql);
    	return $result->num_rows();
    }    

    function looprecord($sql)    
    {
    	return $this->DB->query($sql);	
    }
	
    function voting($sql)    
    {	
    	$queryx = $this->db->query($sql);
			if ($queryx->num_rows() > 0) {			
				$rowx = $queryx->row();
				$rating=round($rowx->voteValue/$rowx->voteNr);
			}
			else	{				
				$rating=0;
			}
			$queryx->free_result();			
			return $rating;
		}
		
    function imagebanner($sql)    
    {	
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
						$row = $query->row(); 
						if ($row->tanggal_akhir>date("d/m/Y")) {
							$imagebanner="&image=".$this->config->item('URL_VIDEOFIESTA_IMG').$row->banner."&";
						}
						else	{
							$imagebanner="&image=".$this->config->item('URL_VIDEOFIESTA_IMG').$row->alternatif."&";
						}
			}
			else	{
					$imagebanner="";
			}		
			$query->free_result();			
			return $imagebanner;		
		}	

    function checkinclude($sql)    
    {			
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0) {
				$jalur="ok";
			} else {
				$jalur="nok";
			}
			$query->free_result();		
			return $jalur;
		}	
}
