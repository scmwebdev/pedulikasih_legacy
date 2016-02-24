<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Banner_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }    

		function setCache($data_id,$content) {
				
				if ($this->ivmcache->get('newbanner'.$data_id))
						$this->ivmcache->replace('newbanner'.$data_id, $content);
				else
						$this->ivmcache->add('newbanner'.$data_id, $content);

		}
		
    function addData($file_name_banner,$file_name_alternatif) {				
				$data = array(
					          'tanggal'			=>	date("Y-m-d H:i:s"),
									  'tanggal_akhir'			=>	$this->input->post('tanggal_akhir'),
									  'jenis'	=>	$this->input->post('jenis'),
									  'nama'		=>	$this->input->post('nama'),
									  'banner'		=>	$file_name_banner,
									  'alternatif'		=>	$file_name_alternatif,
									  'java_script'		=>	$this->input->post('java_script'),
									  'link'		=>	$this->input->post('link'),
									  'linkalternatif'		=>	$this->input->post('linkalternatif'),
									  'alt'		=>	$this->input->post('alt'),
									  'link'		=>	$this->input->post('link'),
									  'tinggi'		=>	$this->input->post('tinggi'),
									  'lebar'		=>	$this->input->post('lebar'),
									  'align'		=>	$this->input->post('align'),
									  'target'		=>	$this->input->post('target')
				        );
				$this->db->insert('banner', $data);			
		}

    function addDatasetup() {				
    		$banner_id=base64_decode($this->input->post('idbanner'));
				$data = array(
					          'tanggal'			=>	date("Y-m-d H:i:s"),
									  'keterangan'		=>	$this->input->post('keterangan'),
									  'id_banner'		=>	$banner_id
				        );
				$this->db->insert('banner_inc', $data);		
				$data_id=$this->db->insert_id();

				$sql = "select * from banner where id=$banner_id";
				$query = $this->db->query($sql);
				
				if ($query->num_rows() > 0)
				{
				    $row = $query->row(); 
						$banjenis				= $row->jenis;
						$tanggal_akhir	= $row->tanggal_akhir;
						$banner					=	trim($row->banner);
						$javascript			= trim($row->java_script);		
						$alternatif			= trim($row->alternatif);
						$alt						= $row->alt;
						$link						= trim($row->link);
				 		$linkalternatif	= trim($row->linkalternatif);
						$klik						= $row->klik;
						$tinggi					= $row->tinggi;
						$target					= $row->target;
						$lebar					= $row->lebar;
						$align					= trim($row->align);
						
						if ($link == "0") $link="";
						if ($linkalternatif == "0") $linkalternatif="";				

						$posisi_id = $data_id;

						$bannertxt = "";
						switch ($banjenis) {
						    case "image":
										if ($tanggal_akhir>date("Y-m-d H:i:s")) {
											if ($link=="") {
												$bannertxt="<img src=\"".STATIC_URL."banner/".$banner."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=0";
												if ($align<>"none") $bannertxt.="align=\"".$align."\""; 
												$bannertxt.=">";
											} else {
												$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$banner_id."/".$posisi_id."\"";
												if ($target<>"") $bannertxt.=" target=\"".$target."\"";
												$bannertxt.="><img src=\"".STATIC_URL."banner/".$banner."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=0";
												if ($align<>"none") $bannertxt.="align=\"".$align."\""; 
												$bannertxt.="></a>";				
											}		
										} else {
											if ($linkalternatif=="") {			
												$bannertxt="<img src=\"".STATIC_URL."banner/".$alternatif."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=\"0\"";
												if ($align<>"none") $bannertxt.="align=\"".$align."\"";
												$bannertxt.=">";	
											} else	{
												$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$banner_id."/".$posisi_id."/ok\"";
												if ($target<>"") $bannertxt.=" target=\"".$target."\"";
												$bannertxt.="><img src=\"".STATIC_URL."banner/".$alternatif."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=\"0\"";
												if ($align<>"none") $bannertxt.="align=\"".$align."\"";
												$bannertxt.="></a>";	
											}		
										}
						        break;
						        
						    case "flash":
										if ($tanggal_akhir>date("Y-m-d H:i:s")) {
											if ($link=="") {			
												$bannertxt="<embed src=\"".STATIC_URL."banner/".$alternatif."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
												if ($align<>"none") $bannertxt.= "align=\"".$align."\"";
												$bannertxt.="></embed>";
											} else	{
												$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$banner_id."/".$posisi_id."/ok";
												if ($target<>"") $bannertxt.=" target=\"".$target."\"";
												$bannertxt.="><embed src=\"".STATIC_URL."banner/".$alternatif."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
												if ($align<>"none") $bannertxt.= "align=\"".$align."\"";
												$bannertxt.="></embed></a>";			
											}		
										} else	{
											if ($linkalternatif=="") {						
												$bannertxt="<embed src=\"".STATIC_URL."banner/".$banner."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
												if ($align<>"none") $bannertxt.="align=\"".$align."\"";
												$bannertxt.="></embed>";	
											} else	{
												$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$banner_id."/".$posisi_id."\"";
												if ($target<>"") $bannertxt.= " target=\"".$target."\"";
												$bannertxt.="><embed src=\"".STATIC_URL."banner/".$banner."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
												if ($align<>"none") $bannertxt.="align=\"".$align."\"";
												$bannertxt.="></embed></a>";				
											}		
										}
						        break;
						        
						    case "text":
						        $bannertxt=$javascript;
						        break;
						}
						$this->setCache($data_id,$bannertxt);										
				}				
				$query->free_result();					
		}
		
		function editData($file_name_banner,$file_name_alternatif,$data_id) {			
			  if ($file_name_banner=="") {
			  	$file_name_banner=$this->input->post('filenamebanner_old');
			  }
			  if ($file_name_alternatif=="") {
			  	$file_name_alternatif=$this->input->post('filenamealternatif_old');
			  }			  

				$data = array(
					          'tanggal'			=>	date("Y-m-d H:i:s"),
									  'tanggal_akhir'			=>	$this->input->post('tanggal_akhir'),
									  'jenis'	=>	$this->input->post('jenis'),
									  'nama'		=>	$this->input->post('nama'),
									  'banner'		=>	$file_name_banner,
									  'alternatif'		=>	$file_name_alternatif,
									  'java_script'		=>	$this->input->post('java_script'),
									  'link'		=>	$this->input->post('link'),
									  'linkalternatif'		=>	$this->input->post('linkalternatif'),
									  'alt'		=>	$this->input->post('alt'),
									  'link'		=>	$this->input->post('link'),
									  'tinggi'		=>	$this->input->post('tinggi'),
									  'lebar'		=>	$this->input->post('lebar'),
									  'align'		=>	$this->input->post('align'),
									  'target'		=>	$this->input->post('target')
				        );
				$this->db->where('id', $data_id);
				$this->db->update('banner', $data); 				
		}

		function editDatasetup($data_id) {			
				$banner_id=base64_decode($this->input->post('idbanner'));
				$data = array(
					          'tanggal'			=>	date("Y-m-d H:i:s"),
									  'keterangan'		=>	$this->input->post('keterangan'),
									  'id_banner'		=>	$banner_id
				        );
				$this->db->where('id', $data_id);
				$this->db->update('banner_inc', $data); 								
				
				$sql = "select * from banner where id=$banner_id";
				$query = $this->db->query($sql);
				
				if ($query->num_rows() > 0)
				{
				    $row = $query->row(); 
						$banjenis				= $row->jenis;
						$tanggal_akhir	= $row->tanggal_akhir;
						$banner					=	trim($row->banner);
						$javascript			= trim($row->java_script);		
						$alternatif			= trim($row->alternatif);
						$alt						= $row->alt;
						$link						= trim($row->link);
				 		$linkalternatif	= trim($row->linkalternatif);
						$klik						= $row->klik;
						$tinggi					= $row->tinggi;
						$target					= $row->target;
						$lebar					= $row->lebar;
						$align					= trim($row->align);
						
						if ($link == "0") $link="";
						if ($linkalternatif == "0") $linkalternatif="";				

						$posisi_id = $data_id;
	
						$bannertxt = "";
						switch ($banjenis) {
						    case "image":
										if ($tanggal_akhir>date("Y-m-d H:i:s")) {
											if ($link=="") {
												$bannertxt="<img src=\"".STATIC_URL."banner/".$banner."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=0";
												if ($align<>"none") $bannertxt.="align=\"".$align."\""; 
												$bannertxt.=">";
											} else {
												$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$banner_id."/".$posisi_id."\"";
												if ($target<>"") $bannertxt.=" target=\"".$target."\"";
												$bannertxt.="><img src=\"".STATIC_URL."banner/".$banner."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=0";
												if ($align<>"none") $bannertxt.="align=\"".$align."\""; 
												$bannertxt.="></a>";				
											}		
										} else {
											if ($linkalternatif=="") {			
												$bannertxt="<img src=\"".STATIC_URL."banner/".$alternatif."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=\"0\"";
												if ($align<>"none") $bannertxt.="align=\"".$align."\"";
												$bannertxt.=">";	
											} else	{
												$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$banner_id."/".$posisi_id."/ok\"";
												if ($target<>"") $bannertxt.=" target=\"".$target."\"";
												$bannertxt.="><img src=\"".STATIC_URL."banner/".$alternatif."\" width=\"".$lebar."\" height=\"".$tinggi."\" alt=\"".$alt."\" border=\"0\"";
												if ($align<>"none") $bannertxt.="align=\"".$align."\"";
												$bannertxt.="></a>";	
											}		
										}
						        break;
						        
						    case "flash":
										if ($tanggal_akhir>date("Y-m-d H:i:s")) {
											if ($link=="") {			
												$bannertxt="<embed src=\"".STATIC_URL."banner/".$alternatif."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
												if ($align<>"none") $bannertxt.= "align=\"".$align."\"";
												$bannertxt.="></embed>";
											} else	{
												$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$banner_id."/".$posisi_id."/ok";
												if ($target<>"") $bannertxt.=" target=\"".$target."\"";
												$bannertxt.="><embed src=\"".STATIC_URL."banner/".$alternatif."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
												if ($align<>"none") $bannertxt.= "align=\"".$align."\"";
												$bannertxt.="></embed></a>";			
											}		
										} else	{
											if ($linkalternatif=="") {						
												$bannertxt="<embed src=\"".STATIC_URL."banner/".$banner."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
												if ($align<>"none") $bannertxt.="align=\"".$align."\"";
												$bannertxt.="></embed>";	
											} else	{
												$bannertxt="<a href=\"http://www.indosiar.com/adsbanner/".$banner_id."/".$posisi_id."\"";
												if ($target<>"") $bannertxt.= " target=\"".$target."\"";
												$bannertxt.="><embed src=\"".STATIC_URL."banner/".$banner."\" alt=\"".$alt."\" width=\"".$lebar."\" height=\"".$tinggi."\" hspace=\"0\" vspace=\"0\" border=\"0\"";
												if ($align<>"none") $bannertxt.="align=\"".$align."\"";
												$bannertxt.="></embed></a>";				
											}		
										}
						        break;
						        
						    case "text":
						        $bannertxt=$javascript;
						        break;
						}
						$this->setCache($data_id,$bannertxt);										
				}				
				$query->free_result();								
		}		

		function formeditor($editorvar,$editorid) {
			$data="
			  var $editorvar = Ext.create('Ext.form.Panel', {
			    	url: mod_url+'&m=submitdata',		
			      border: false,
			      bodyPadding: 10,
			      autoScroll: true,
			      fieldDefaults: {labelAlign: 'left', labelWidth: 180},
			      defaults: {margins: '0 0 5 0'},
			      items: [{
			          xtype: 'hidden',
			          name: 'b_id'
						},					
						{
			          xtype: 'hidden',
			          name: 'filenamebanner_old'
						},						
						{
			          xtype: 'hidden',
			          name: 'filenamealternatif_old'
						},											
						{
			          xtype: 'textfield',
			          fieldLabel: 'Nama Banner',
			          name: 'nama',
			          id: 'nama',
			          anchor:'60%',
			          allowBlank: false
			      },
						{
				        xtype: 'radiogroup',
				        fieldLabel: 'Jenis Banner',
				        anchor:'100%',
			          allowBlank: false,
				        items: [
				            {boxLabel: 'Image', name: 'jenis', inputValue: 'image'},
				            {boxLabel: 'Flash', name: 'jenis', inputValue: 'flash'},
				            {boxLabel: 'Text/Script', name: 'jenis', inputValue: 'text'}
				        ]
				    },	
						{
				        xtype: 'fieldcontainer',
			          layout: 'hbox',
			          anchor:'100%',
			          fieldLabel: 'Banner Utama',
			          width:800,
			          labelAlign: 'left',   
				        items:[   			           				      			      			          
								{
								    xtype: 'filefield',
								    id: 'banner',
								    msgTarget: 'side',
								    emptyText: 'Select main banner to upload...',
								    fieldLabel: '',
								    name: 'banner',							      
								    anchor:'60%',
								    labelAlign: 'left',
								    width:300,
								    margins: '0 10 0 0',		
								    allowBlank: true,						    
										buttonText: 'Browse'
								},	      
								{
								    xtype: 'displayfield',
								    msgTarget: 'side',
								    id:'filenamebanner',
								    fieldLabel: 'Filename',
								    name:'filenamebanner',
								    anchor:'100%'  
								}]
						},		
						{
				        xtype: 'fieldcontainer',
			          layout: 'hbox',
			          anchor:'100%',
			          fieldLabel: 'Banner Alternatif',
			          width:800,
			          labelAlign: 'left',   
				        items:[   			           				      			      			          
								{
								    xtype: 'filefield',
								    id: 'alternatif',
								    msgTarget: 'side',
								    emptyText: 'Select alternate banner to upload...',
								    fieldLabel: '',
								    name: 'alternatif',							      
								    anchor:'60%',
								    labelAlign: 'left',
								    allowBlank: true,	
								    width:300,
								    margins: '0 10 0 0',								    
										buttonText: 'Browse'
								},	      
								{
								    xtype: 'displayfield',
								    msgTarget: 'side',
								    id:'filenamebanneralternatif',
								    fieldLabel: 'Filename',
								    name:'filenamebanneralternatif'
										
								}]
						},					
						{
			          xtype: 'textfield',
			          fieldLabel: 'Link Banner',
			          name: 'link',
			          id: 'link',
			          anchor:'60%',
			          allowBlank: true
			      },								
						{
			          xtype: 'textfield',
			          fieldLabel: 'Link Banner Alternatif',
			          name: 'linkalternatif',
			          id: 'linkalternatif',
			          anchor:'60%',
			          allowBlank: true
			      },						
			      {  		
				        xtype: 'textarea',
				        name: 'java_script',
				        id: 'java_script',         
				        anchor: '100%',
				        width:'100%',
				        fieldLabel: 'Java Script',
				        allowBlank: true
				    },
						{
			          xtype: 'datefield',
			          fieldLabel: 'Tanggal Akhir Banner',
			          name: 'tanggal_akhir',
			          id: 'tanggal_akhir',
			          anchor:'40%',
			          format:'Y-m-d',			          
			          allowBlank: false
			      },				    
						{
			          xtype: 'textfield',
			          fieldLabel: 'Alt Text Banner',
			          name: 'alt',
			          id: 'alt',
			          anchor:'60%',
			          allowBlank: true
			      },					
						{
			          xtype: 'fieldcontainer',
			          layout: 'hbox',
			          defaultType: 'textfield',
								margins: '0',
								width: 520,
								fieldLabel: 'Lebar Banner',
					      fieldDefaults: {labelAlign: 'left'},
			          items: [{
			             	xtype: 'numberfield', 
			              width: 120,
			              name: 'lebar',
			              id: 'lebar',
			              margins: '0 10 0 0'			              
			          },{
			             	xtype: 'numberfield', 
			              width: 220,
			              name: 'tinggi',
			              id: 'tinggi',
			              fieldLabel: 'Tinggi Banner'
			          }]
			      },
						{
				        xtype: 'radiogroup',
				        fieldLabel: 'Align/Rata Banner',
				        anchor:'100%',
				        labelAlign: 'left',
				        items: [
				            {boxLabel: 'Kanan', name: 'align', inputValue: 'right'},
				            {boxLabel: 'Tengah', name: 'align', inputValue: 'center'},
				            {boxLabel: 'Kiri', name: 'align', inputValue: 'left'},
				            {boxLabel: 'Tidak Ada', name: 'align', inputValue: 'none'}
				        ]
				    },	
						{
				        xtype: 'radiogroup',
				        fieldLabel: 'Target Banner',
				        anchor:'100%',
				        items: [
				            {boxLabel: 'Kosong', name: 'target', inputValue: ''},
				            {boxLabel: 'Blank/window baru', name: 'target', inputValue: '_blank'},
				            {boxLabel: 'Top', name: 'target', inputValue: '_top'}
				        ]
				    }					    	    		    
				    ],
				    buttonAlign : 'center',
			      buttons: [{
			          text: 'Cancel',
			          handler: function() {
			              $editorvar.getForm().reset();
			              this.up('window').hide();
			          }
			      }, {
			          text: 'Submit',
			          formBind: true,
			          handler:function(){
			              $editorvar.getForm().submit({ 			              		
			                  method:'POST', 
			                  waitTitle:'Connecting', 
			                  waitMsg:'Sending data...',
			                  waitMsgTarget:true,
			
			                  success:function(form, action) {
			                  		Ext.Msg.alert('Success', 'Data Updated Successful');
			                      storeData.load();
			                      winForm.close();
			                	},
			
			                  failure:function(form, action){
														if (action.failureType == 'server') {
																obj = Ext.util.JSON.decode(action.response.responseText);
																Ext.Msg.alert('Failed!', obj.errors.reason);
														} else {
																Ext.Msg.alert('Warning!', 'Authentication server is unreachable : ' + action.response.responseText);
														}
			                  } 
			              }); 
			          } 
			      }]
			  });";	 			
			  return $data;			
		}

    function getData($data_id) {
    		if (is_numeric($data_id)) {
						$sql = "select * from banner where id=$data_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();

						return $data;
    		}
    }

    function getDatasetup($data_id) {
    		if (is_numeric($data_id)) {
						$sql = "select bi.tanggal,bi.id,bi.keterangan,b.banner,b.alternatif,b.link,b.linkalternatif,b.nama,bi.id_banner as idbanner,b.tinggi,b.lebar from banner_inc as bi inner join banner as b on bi.id_banner=b.id where bi.id=$data_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();

						return $data;
    		}
    }

    function getBanner($data_id) {
    		if (is_numeric($data_id)) {
						$sql = "select id,nama,banner,alternatif,tinggi,lebar from banner where id=$data_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();
						
						return $data;
						
    		}
    }  	 

    function getBannersetup($data_id) {
    		if (is_numeric($data_id)) {
						$sql = "select id,nama,banner,alternatif,tinggi,lebar from banner where id=$data_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();
						
						return $data;
						
    		}
    }  	    
}