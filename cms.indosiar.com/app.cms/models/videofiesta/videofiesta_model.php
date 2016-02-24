<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Videofiesta_model extends CI_Model {
    function __construct() {
        parent::__construct();
        //$this->load->database();
        $this->load->library('allfunction');         
    }
    
    function addZero($data) {
    		if (strlen($data) == 1) $data = '0'.$data;
    		return $data;
    }

		function formeditor($editorvar,$editorid) {
			$data="
			  var $editorvar = Ext.create('Ext.form.Panel', {
			    	url: mod_url+'&m=submitdata',		
			      border: false,
			      bodyPadding: 10,
			      autoScroll: true,
			      fieldDefaults: {msgTarget: 'side',labelWidth: 120},
			      defaults: {margins: '0 0 5 0'},
			      items: [{
			          xtype: 'hidden',
			          name: 'v_id'
						},				
						{
			          xtype: 'hidden',
			          name: 'filenameimage_old'
						},						
						{
			          xtype: 'hidden',
			          name: 'filenamelogo_old'
						},						
						{
				        xtype: 'combobox',
				        name: 'kategori',
				        fieldLabel: 'Kategori',
				        displayField: 'kategori',
				        valueField: 'id',
				        queryMode: 'local',
				        emptyText: '',
				        hideLabel: false,
				        margins: '0 6 0 0',
				        store: combo_category,
				        flex: 1,
				        allowBlank: false,
				        forceSelection: true
				    },						
						{
			          xtype: 'textfield',
			          fieldLabel: 'Judul',
			          name: 'judul',
			          id: 'judul',
			          anchor:'60%',
			          allowBlank: false
			      },				
						{
			          xtype: 'textfield',
			          fieldLabel: 'File FLV 1',
			          name: 'file_flv',
			          id: 'file_flv',
			          anchor:'60%',
			          allowBlank: false
			      },				      		
						{
			          xtype: 'textfield',
			          fieldLabel: 'File FLV 2',
			          name: 'file_flv2',
			          id: 'file_flv2',
			          anchor:'60%',
			          allowBlank: true
			      },				      		
						{
			          xtype: 'textfield',
			          fieldLabel: 'File FLV 3',
			          name: 'file_flv3',
			          id: 'file_flv3',
			          anchor:'60%',
			          allowBlank: true
			      },				      	
						{
			          xtype: 'textfield',
			          fieldLabel: 'File FLV 4',
			          name: 'file_flv4',
			          id: 'file_flv4',
			          anchor:'60%',
			          allowBlank: true
			      },				      	
						{
			          xtype: 'textfield',
			          fieldLabel: 'File FLV 5',
			          name: 'file_flv5',
			          id: 'file_flv5',
			          anchor:'60%',
			          allowBlank: true
			      },				      	
						{
			          xtype: 'textfield',
			          fieldLabel: 'File FLV 6',
			          name: 'file_flv6',
			          id: 'file_flv6',
			          anchor:'60%',
			          allowBlank: true
			      },				 
						{
				        xtype: 'fieldcontainer',
			          layout: 'hbox',
			          anchor:'100%',
			          fieldLabel: 'Image Logo',
			          width:800,
			          labelAlign: 'left',   
				        items:[   			           				      			      			          
								{
								    xtype: 'filefield',
								    id: 'logo',
								    msgTarget: 'side',
								    emptyText: 'Select image logo to upload...',
								    fieldLabel: '',
								    name: 'logo',							      
								    anchor:'60%',
								    labelAlign: 'left',
								    width:300,
								    margins: '0 10 0 0',								    
										buttonText: 'Browse'
								},	      
								{
								    xtype: 'displayfield',
								    msgTarget: 'side',
								    id:'filenamelogo',
								    fieldLabel: 'Filename',
								    name:'filenamelogo',
										labelStyle: 'width:50px;'    
								}]
						},		    								
						{
				        xtype: 'fieldcontainer',
			          layout: 'hbox',
			          anchor:'100%',
			          width:800,
			          fieldLabel: 'Image Video FLV',
			          labelAlign: 'left',   
				        items:[  						
								{
								    xtype: 'filefield',
								    id: 'image',
								    msgTarget: 'side',
								    emptyText: 'Select image video FLV to upload...',
								    fieldLabel: '',
								    name: 'image',
								    anchor:'60%',
								    labelAlign: 'left',
								    width:300,
								    margins: '0 10 0 0',	
								    buttonText: 'Browse'
								},	      
								{
								    xtype: 'displayfield',
								    msgTarget: 'side',
								    fieldLabel: 'Filename',
								    id:'filenameimage',
								    name:'filenameimage',
								    labelStyle: 'width:50px;'
								}]
						},	            
						{
			          xtype: 'textfield',
			          fieldLabel: 'Link',
			          name: 'link',
			          id: 'link',
			          anchor:'60%',
			          allowBlank: true
			      },	            
						{
								xtype: 'fieldcontainer',
				        fieldLabel: 'Keterangan',
				        combineErrors: true,
				        msgTarget : 'side',
				        layout: 'hbox',
				        defaults: {
				            hideLabel: true
				        },        	
				        cls: 'x-check-group-alt',        		
								items: [{        		
				          xtype: 'textarea',
				          maxLength:605,
				          enforceMaxLength : true,
				          name: 'keterangan',
				          id: 'keterangan',         
				          anchor: '60%',
				          width:400,
				          fieldLabel: '',
				          maxLengthText : 'Maksimum karakter adalah 605',
				          margin: '0 5 0 0',
				          allowBlank: false,
			            enableKeyEvents: true,
			            listeners: {
			                keyup: function(){
			                    var counter=this.value;
			                    $editorvar.getForm().findField('charcount').setValue('maximum karakter tersisa = '+ (605-counter.length));
			                }              
			            }
				        },{xtype: 'displayfield',
				        	 id: 'charcount',
				        	 name: 'charcount',
				        	 width:200		                                             
				        }]
				    },
						{
				        xtype: 'radiogroup',
				        fieldLabel: 'Masuk di Varietyshow',
				        width:200,
				        anchor:'55%',
				        items: [
				            {boxLabel: 'Yes', name: 'status_variety', inputValue: '1'},
				            {boxLabel: 'No', name: 'status_variety', inputValue: '0'}
				        ]
				    },
						{
				        xtype: 'radiogroup',
				        fieldLabel: 'Masuk di Program',
				        width:200,
				        anchor:'55%',
				        items: [
				            {boxLabel: 'Yes', name: 'status_program', inputValue: '1'},
				            {boxLabel: 'No', name: 'status_program', inputValue: '0'}
				        ]
				    },
						{
				        xtype: 'radiogroup',
				        fieldLabel: 'Publish',
				        width:200,
				        anchor:'55%',
				        items: [
				            {boxLabel: 'Yes', name: 'publish', inputValue: '1'},
				            {boxLabel: 'No', name: 'publish', inputValue: '0'}
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
			                      storecontent.load();
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
    
    function addData($file_name_logo,$file_name_image) {				
				$data = array(
					          'tanggal'			=>	date("Y-m-d H:i:s"),
									  'judul'			=>	$this->input->post('judul'),
									  'keterangan'	=>	$this->input->post('keterangan'),
									  'id_kategori'		=>	$this->input->post('kategori'),
									  'file_flv'		=>	$this->input->post('file_flv'),
									  'file_flv2'		=>	$this->input->post('file_flv2'),
									  'file_flv3'		=>	$this->input->post('file_flv3'),
									  'file_flv4'		=>	$this->input->post('file_flv4'),
									  'file_flv5'		=>	$this->input->post('file_flv5'),
									  'file_flv6'		=>	$this->input->post('file_flv6'),
									  'image'		=>	$file_name_image,
									  'logo'		=>	$file_name_logo,
									  'link'		=>	$this->input->post('link'),
									  'status_variety'		=>	$this->input->post('status_variety'),
									  'status_program'		=>	$this->input->post('status_program'),
									  'status_video'		=>	$this->input->post('publish')
				        );
				$this->db->insert('tbl_video', $data);			
				/*	
				$sql = "select * from tbl_video where id=$data_id";
				$query = $this->db->query($sql);
				$dataArticle = $query->row_array();
				$query->free_result();
								
				$cache = $this->setCache($data_id);
				$this->SphinxSubmit($cache);				
				*/
		}
		
		function editData($file_name_logo,$file_name_image,$data_id) {			
			  if ($file_name_logo=="") {
			  	$file_name_logo=$this->input->post('filenamelogo_old');
			  }
			  if ($file_name_image=="") {
			  	$file_name_image=$this->input->post('filenameimage_old');
			  }			  
				$data = array(
					          'tanggal'			=>	date("Y-m-d H:i:s"),
									  'judul'			=>	$this->input->post('judul'),
									  'keterangan'	=>	$this->input->post('keterangan'),
									  'id_kategori'		=>	$this->input->post('kategori'),
									  'file_flv'		=>	$this->input->post('file_flv'),
									  'file_flv2'		=>	$this->input->post('file_flv2'),
									  'file_flv3'		=>	$this->input->post('file_flv3'),
									  'file_flv4'		=>	$this->input->post('file_flv4'),
									  'file_flv5'		=>	$this->input->post('file_flv5'),
									  'file_flv6'		=>	$this->input->post('file_flv6'),
									  'image'		=>	$file_name_image,
									  'logo'		=>	$file_name_logo,
									  'link'		=>	$this->input->post('link'),
									  'status_variety'		=>	$this->input->post('status_variety'),
									  'status_program'		=>	$this->input->post('status_program'),
									  'status_video'		=>	$this->input->post('publish')
				        );
				$this->db->where('id', $data_id);
				$this->db->update('tbl_video', $data); 
				/*
				$sql = "select * from tbl_content where id=$data_id";
				$query = $this->db->query($sql);
				$dataArticle = $query->row_array();
				$query->free_result();
								
				$cache = $this->setCache($data_id);
				$this->SphinxSubmit($cache);
				*/
		}

    function getData($data_id) {
    		if (is_numeric($data_id)) {
						$sql = "select * from tbl_video where id=$data_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();

						return $data;
    		} 
    }

    function getPagesContent($artikel_id) {
    		if (is_numeric($data_id)) {
						$sql = "select * from tbl_video where id=$data_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();

						return $data;
    		} 
    }		    
		function publishData($data_id,$set) {
				$sql = "update tbl_video set status_video=$set where id=$data_id";
				$this->db->query($sql);				
		}
		
}