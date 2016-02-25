<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Banner_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->DBWRITE = $this->load->database('dbwrite', true);
    }

    function getBanner($banner_id) {
    		if (is_numeric($banner_id)) {
						if (!$bannertxt = $this->ivmcache->get('newbanner'.$banner_id)) {

								$query = $this->db->query("select id_banner from banner_inc where id=".$banner_id);
								if ($query->num_rows() > 0)
								{
								   	$row = $query->row(); 
								   	$id_banner=$row->id_banner;
								}
								$query->free_result();
								
								$query = $this->db->query("select tinggi,lebar from banner where id=".$id_banner);
								if ($query->num_rows() > 0)
								{
								   	$row = $query->row(); 
										$tinggi=$row->tinggi;
										$lebar=$row->lebar;
								}
								$query->free_result();

								$query = $this->db->query("select * from banner where id=".$id_banner);
								if ($query->num_rows() > 0)
								{
								   	$row = $query->row(); 
										$banjenis=$row->jenis;
										$tanggal_akhir=$row->tanggal_akhir;
										$banner=trim($row->banner);
										$javascript=trim($row->java_script);		
										$alternatif=trim($row->alternatif);
										$alt=$row->alt;
										$link=trim($row->link);
								 		$linkalternatif=trim($row->linkalternatif);
										$klik=$row->klik;
										$tinggi=$row->tinggi;
										$target=$row->target;
										$lebar=$row->lebar;
										$align=trim($row->align);
										if ($link=="0") {
											$link="";
										}
										if ($linkalternatif=="0") {
											$linkalternatif="";
										}
								}
								$query->free_result();

								$id=$banner_id;

								if ($banjenis=="image") {
									if ($tanggal_akhir>date("Y-m-d H:i:s")) {
										if ($link=="") {
											$bannertxt="<img src=\"".$this->config->item('URL_STATIC')."banner/".$banner."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=0";
											if ($align<>"none") $bannertxt.="align=\"".$align."\""; 
											$bannertxt.=">";
											}
										else {
											$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$id_banner."/".$banner_id."\"";
											if ($target<>"") $bannertxt.=" target=\"".$target."\"";
											$bannertxt.="><img src=\"".$this->config->item('URL_STATIC')."banner/".$banner."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=0";
											if ($align<>"none") $bannertxt.="align=\"".$align."\""; 
											$bannertxt.="></a>";				
										}		
									     }
									else {
										if ($linkalternatif=="") {			
											$bannertxt="<img src=\"".$this->config->item('URL_STATIC')."banner/".$alternatif."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=\"0\"";
											if ($align<>"none") $bannertxt.="align=\"".$align."\"";
											$bannertxt.=">";	
											}				
										else	{
											$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$id_banner."/".$banner_id."/ok\"";
											if ($target<>"") $bannertxt.=" target=\"".$target."\"";
											$bannertxt.="><img src=\"".$this->config->item('URL_STATIC')."banner/".$alternatif."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=\"0\"";
											if ($align<>"none") $bannertxt.="align=\"".$align."\"";
											$bannertxt.="></a>";	
										}		
									}
								}	
								elseif ($banjenis=="flash") {
									if ($tanggal_akhir>date("Y-m-d H:i:s")) {
										if ($link=="") {			
											$bannertxt="<embed src=\"".$this->config->item('URL_STATIC')."banner/".$alternatif."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
											if ($align<>"none") $bannertxt.= "align=\"".$align."\"";
											$bannertxt.="></embed>";
											}
										else	{
											$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$id_banner."/".$banner_id."/ok";
											if ($target<>"") $bannertxt.=" target=\"".$target."\"";
											$bannertxt.="><embed src=\"".$this->config->item('URL_STATIC')."banner/".$alternatif."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
											if ($align<>"none") $bannertxt.= "align=\"".$align."\"";
											$bannertxt.="></embed></a>";			
										}		
									    }
									else	{
										if ($linkalternatif=="") {						
											$bannertxt="<embed src=\"".$this->config->item('URL_STATIC')."banner/".$banner."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
											if ($align<>"none") $bannertxt.="align=\"".$align."\"";
											$bannertxt.="></embed>";	
											}
										else	{
											$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$id_banner."/".$banner_id."\"";
											if ($target<>"") $bannertxt.= " target=\"".$target."\"";
											$bannertxt.="><embed src=\"".$this->config->item('URL_STATIC')."banner/".$banner."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
											if ($align<>"none") $bannertxt.="align=\"".$align."\"";
											$bannertxt.="></embed></a>";				
										}		
									}
								}
								elseif ($banjenis=="text") {
									$bannertxt=$javascript;
								}
					
								$this->ivmcache->add('newbanner'.$banner_id, $bannertxt);
						}

						return $bannertxt;
    		}
    }   
}        