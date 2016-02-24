<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Lowongan_model extends CI_Model {
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
			      fieldDefaults: {labelAlign: 'top', labelWidth: 100},
			      defaults: {margins: '0 0 5 0'},
			      items: [{
			          xtype: 'hidden',
			          name: 'l_id'
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
				        xtype: 'htmleditor',
				        name: 'konten',
				        fieldLabel: 'Konten',
				        height: 300,
				        anchor: '100%',
				    },
						{
								xtype: 'fieldcontainer',
				        fieldLabel: 'Ringkasan',
				        combineErrors: true,
				        msgTarget : 'side',
				        layout: 'hbox',
				        defaults: {
				            hideLabel: true
				        },        	
				        cls: 'x-check-group-alt',        		
								items: [{        		
				          xtype: 'textarea',
				          maxLength:305,
				          enforceMaxLength : true,
				          name: 'ringkasan',
				          id: 'ringkasan',         
				          anchor: '60%',
				          width:400,
				          fieldLabel: '',
				          maxLengthText : 'Maksimum karakter adalah 305',
				          margin: '0 5 0 0',
				          allowBlank: false,
			            enableKeyEvents: true,
			            listeners: {
			                keyup: function(){
			                    var counter=this.value;
			                    $editorvar.getForm().findField('charcount').setValue('maximum karakter tersisa = '+ (305-counter.length));
			                }              
			            }
				        },{xtype: 'displayfield',
				        	 id: 'charcount',
				        	 name: 'charcount',
				        	 width:200		                                             
				        }]
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
    
    function addData() {
				$data = array(
					          'tanggal'			=>	date("Y-m-d H:i:s"),
									  'judul'			=>	$this->input->post('judul'),
									  'ringkasan'	=>	$this->input->post('ringkasan'),
									  'konten'		=>	$this->input->post('konten'),
									  'publish'		=>	$this->input->post('publish')
				        );
				$this->db->insert('ivmweb2009_lowongan', $data);
				$data_id=$this->db->insert_id();
				$data = array(
									  'url_slug'		=>	$this->allfunction->judul2url($this->input->post('judul'),$data_id)
				        );
				$this->db->where('id', $data_id);
				$this->db->update('ivmweb2009_lowongan', $data); 			
				/*	
				$sql = "select * from ivmweb2009_lowongan where id=$data_id";
				$query = $this->db->query($sql);
				$dataArticle = $query->row_array();
				$query->free_result();
								
				$cache = $this->setCache($data_id);
				$this->SphinxSubmit($cache);				
				*/
		}
		
		function editData($data_id) {
				$data = array(
					          'tanggal'			=>	date("Y-m-d H:i:s"),
									  'judul'			=>	$this->input->post('judul'),
									  'ringkasan'	=>	$this->input->post('ringkasan'),
									  'konten'		=>	$this->input->post('konten'),
									  'publish'		=>	$this->input->post('publish'),
									  'url_slug'		=>	$this->allfunction->judul2url($this->input->post('judul'),$data_id)
				        );
				$this->db->where('id', $data_id);
				$this->db->update('ivmweb2009_lowongan', $data); 
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
						$sql = "select * from ivmweb2009_lowongan where id=$data_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();

						return $data;
    		} 
    }

    function getPagesContent($artikel_id) {
    		if (is_numeric($data_id)) {
						$sql = "select * from ivmweb2009_lowongan where id=$data_id";
						$query = $this->db->query($sql);
						$data = $query->row_array();
						$query->free_result();

						return $data;
    		} 
    }		    
		function publishData($data_id,$set) {
				$sql = "update ivmweb2009_lowongan set publish=$set where id=$data_id";
				$this->db->query($sql);				
		}
		
}