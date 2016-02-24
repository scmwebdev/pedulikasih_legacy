<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){		
		var itemsPerPage = 50;
		var activeID = 0;
		var curDate = '<?=date("Y-m-d")?>';

		/* ----------- FORM EDITOR POP UP --------------*/			
		function popFormArtikel() {
				sessChecked();
				
				var storeJenis = Ext.create('Ext.data.Store', {
				    autoLoad: true,
				    autoDestroy: true,
				    fields: ['id','jenis'],
				    proxy: {
					      type: 'ajax',
					      url: mod_url + '&m=jsonjenis',
					      reader: {type:'json'}
				    }
				});
				
				Ext.define('modelForm', {
				    extend: 'Ext.data.Model',
				    fields: ['id','jenis_id','judul','subjudul','judul_url','ringkasan','isi','jenis_judul','jenis_url','folder','img_index','img_artikel','img_list','video','tgl_tayang','tgl_tayang_hh','tgl_tayang_mn','tgl_robot','tgl_robot_hh','tgl_robot_mn','status_tampil','tags']
				});


			  var formInput = Ext.create('Ext.form.Panel', {
			  		url: mod_url + '&m=submitdata',
			      layout: {type: 'vbox', align: 'stretch'},
			      //split:true,
			      width: '100%',
			      border: false,
			      bodyPadding: 7,
			      fieldDefaults: {labelWidth: 100, anchor: '100%'},
			      items: [{
			          xtype: 'hidden',
			          name: 'id'
	         	},{
			          xtype: 'fieldcontainer',
			          layout: 'hbox',
			          defaults: {margins: '0'},
			          fieldDefaults: {labelWidth: 100},
			          items: [{
			              xtype: 'combobox',
			              fieldLabel: 'Jenis',
										name: 'jenis_id',
										id: 'jenis_id',
										store: storeJenis,
										queryMode: 'local',
										//itemSelector: '',
										emptyText: '',
										forceSelection: true,
										triggerAction: 'all',
										valueField: 'id',
										displayField: 'jenis',
										allowBlank: false,
										flex: 1
								},{
			              xtype: 'fieldcontainer',
			              layout: 'hbox',
			              width: 300,
			              margins: '0 0 0 10',
			              fieldLabel: 'Tgl. Robot',
			              items: [
			                  {xtype: 'datefield', format: 'Y-m-d', name: 'tgl_robot', width: 90, allowBlank: false, margins: '0 5 0 0'},
			                  {xtype: 'numberfield', name: 'tgl_robot_hh', width: 40, maxValue: 23, minValue: 0, allowBlank: false},
			                  {xtype: 'displayfield', value: ':', margins: '0 5 0 5'},
			                  {xtype: 'numberfield',  name: 'tgl_robot_mn', width: 40, maxValue: 59, minValue: 0, allowBlank: false}
			              ]
			          }]
						},{
			          xtype: 'fieldcontainer',
			          layout: 'hbox',
			          defaults: {margins: '0'},
			          fieldDefaults: {labelWidth: 100},
			          items: [{
					          xtype: 'textfield',
					          fieldLabel: 'Sub Judul',
					          name: 'subjudul',
					          flex: 1
								},{
			              xtype: 'fieldcontainer',
			              layout: 'hbox',
			              width: 300,
			              margins: '0 0 0 10',
			              fieldLabel: 'Tgl. Tayang',
			              items: [
			                  {xtype: 'datefield', format: 'Y-m-d', name: 'tgl_tayang', width: 90, margins: '0 5 0 0'},
			                  {xtype: 'numberfield', name: 'tgl_tayang_hh', width: 40, maxValue: 23, minValue: 0},
			                  {xtype: 'displayfield', value: ':', margins: '0 5 0 5'},
			                  {xtype: 'numberfield',  name: 'tgl_tayang_mn', width: 40, maxValue: 59, minValue: 0}
			              ]
			          }]
						},{
			          xtype: 'fieldcontainer',
			          layout: 'hbox',
			          defaults: {margins: '0'},
			          fieldDefaults: {labelWidth: 100},
			          items: [{
					          xtype: 'textfield',
					          fieldLabel: 'Judul',
					          name: 'judul',
					          allowBlank: false,
					          flex: 1
								},{
						        xtype: 'radiogroup',
						        allowBlank: false,
						        fieldLabel: 'Publish', 
						        items: [
						            {boxLabel: 'Yes', name: 'status_tampil', inputValue: 1},
						            {boxLabel: 'No', name: 'status_tampil', inputValue: 0}
						        ],
			              width: 300,
			              margins: '0 0 0 10'
			          }]
						},{
			          xtype: 'fieldcontainer',
			          layout: 'hbox',
			          defaults: {margins: '0'},
			          fieldDefaults: {labelWidth: 100},
			          items: [{
					          xtype: 'textfield',
					          fieldLabel: 'Keyword Terkait',
					          name: 'tags',
					          emptyText: 'pisahkan dengan koma',
					          flex: 1
								},{
						        xtype: 'displayfield',
			              width: 300,
			              margins: '0 0 0 10'
			          }]
						},{					          
								xtype: 'textarea',
			          fieldLabel: 'Ringkasan',
			          maxLength: 300,
			          height: 60,
			          anchor: '100%',
			          enforceMaxLength: true,
			          name: 'ringkasan',
			          id: 'ringkasan',
			          maxLengthText : 'Maksimum karakter adalah 300',
			          allowBlank: false,
		            enableKeyEvents: true,
		            listeners: {
		                keyup: function(){
		                    var counter=this.value;
		                    formInput.getForm().findField('charcount').setValue('karakter tersisa = ' + (300-counter.length));
		                }
		            }
		        },{
		        		xtype: 'displayfield',
		        		fieldLabel: 'Max. 300 Chars',
		        	 	id: 'charcount',
		        	 	name: 'charcount',
		        	 	height: 20
						},{
								xtype: 'tinymcefield',
			          name: 'isi',
			          hideLabel: true,
								anchor: '100%',
								height: Ext.getBody().getViewSize().height-340,
								tinymceConfig: {}
			    	}]
			    	<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
			      ,buttons: [
					      {
					          text: 'Close',
					          handler: function() {
					              winFormArtikel.close();
					          }
					      },{
					          text: 'Submit',
					          formBind: true,
					          handler:function(){
												sessChecked();
					              formInput.getForm().submit({ 
					                  method:'POST', 
					                  waitTitle:'Connecting', 
					                  waitMsg:'Sending data...',
					                  waitMsgTarget:true,
					
					                  success:function(form, action) {
					                  		Ext.Msg.alert('Success', 'Data Updated Successful');
					                      storeData.load();
					                      winFormArtikel.close();
					                	},
					
					                  failure:function(form, action){
																if (action.failureType == 'server') {
																		obj = Ext.JSON.decode(action.response.responseText);
																		Ext.Msg.alert('Failed!', obj.errors.reason);
																} else {
																		Ext.Msg.alert('Warning!', 'Authentication server is unreachable : ' + action.response.responseText);
																}
					                  } 
					              });
					          } 
					      }
			      ]
			      <?php endif;?>
			  });
	  
        winFormArtikel = Ext.widget('window', {
            title: 'Add Artikel',
            closeAction: 'hide',
            width: Ext.getBody().getViewSize().width-50,
        		height: Ext.getBody().getViewSize().height-50,
            layout: 'fit',
            resizable: true,
            modal: true,
            items: formInput,
	          listeners: {
	          		hide: function() {
	          				this.destroy();
	          		}
	          }
        });
	      winFormArtikel.show();
	      
	      if (activeID > 0) {
						winFormArtikel.setTitle('Edit Artikel');
						var store = Ext.create('Ext.data.Store', {
						    model: 'modelForm',
						    proxy: {
								    type: 'ajax',
								    url : mod_url + '&m=jsonitem&data_id=' + activeID,
								    reader:{
								        type:'json'
								    }
						    },
						    autoLoad: true,
						    listeners: {
						        load: function() {
						            formInput.getForm().loadRecord(store.data.first());
						        }
						    }
						});
	      } else {
						formInput.getForm().loadRecord(Ext.create('modelForm', {							        
				        'id'    				: '',
				        'tgl_robot'			: curDate,
				        'tgl_robot_hh'	: '<?=date('G')?>',
				        'tgl_robot_mn'	: '<?=date('i')?>',
				        'status_tampil'	: 1
				    }));
	      }
		}
	  /* ----------- FORM EDITOR POP UP --------------*/
		
	  function addData() {
	      activeID = 0;
		    popFormArtikel();
	  }
	  
	  function editData(data_id) {
				activeID = data_id;
				popFormArtikel();
		}
		
		function uploadImage(data_id) {
				sessChecked();
				
				Ext.define('modelForm', {
				    extend: 'Ext.data.Model',
				    fields: ['id','jenis_id','judul','subjudul','judul_url','ringkasan','isi','jenis_judul','jenis_url','folder','img_index','img_artikel','img_list','video','tgl_tayang','tgl_tayang_hh','tgl_tayang_mn','tgl_robot','tgl_robot_hh','tgl_robot_mn','status_tampil','tags']
				});

			  var formInput = Ext.create('Ext.form.Panel', {
			  		url: mod_url + '&m=submitimage',
			      layout: {type: 'vbox', align: 'stretch'},
			      //split:true,
			      width: '100%',
			      border: false,
			      bodyPadding: 7,
			      fieldDefaults: {labelWidth: 100, anchor: '100%'},
			      items: [{
			          xtype: 'hidden',
			          name: 'id'
	         	},{
			          xtype: 'textfield',
			          fieldLabel: 'Jenis Artikel',
			          name: 'jenis_judul',
			          allowBlank: false,
			          readOnly: true
						},{
			          xtype: 'textfield',
			          fieldLabel: 'Folder',
			          name: 'folder',
			          allowBlank: false,
			          readOnly: true
						},{
			          xtype: 'textfield',
			          fieldLabel: 'Judul',
			          name: 'judul',
			          allowBlank: false,
			          readOnly: true
			     	},{     
			          xtype:'fieldset',
			          title: 'Image Artikel',
			          collapsible: true,
			          layout: 'anchor',
			          fieldDefaults: {labelWidth: 80},
			          items: [{
		                xtype: 'fileuploadfield',
		                fieldLabel: 'Upload Image',
		                name: 'img_artikel_file',
		                emptyText: 'max width 200 pixel',
		                buttonText: 'Browse'
								},{
										xtype: 'textfield',
					          fieldLabel: 'Default Image',
					          name: 'img_artikel'
			          }]
            },{
			          xtype:'fieldset',
			          title: 'Image List',
			          collapsible: true,
			          layout: 'anchor',
			          fieldDefaults: {labelWidth: 80},
			          items: [{
		                xtype: 'fileuploadfield',
		                fieldLabel: 'Upload Image',
		                name: 'img_list_file',
		                emptyText: '100 x 85 pixel',
		                buttonText: 'Browse'
								},{
										xtype: 'textfield',
					          fieldLabel: 'Default Image',
					          name: 'img_list'
			          }]
            },{     
                xtype:'fieldset',
			          title: 'Image Index',
			          collapsible: true,
			          layout: 'anchor',
			          fieldDefaults: {labelWidth: 80},
			          items: [{
		                xtype: 'fileuploadfield',
		                fieldLabel: 'Upload Image',
		                name: 'img_index_file',
		                emptyText: '260 x 180 pixel',
		                buttonText: 'Browse'
								},{
										xtype: 'textfield',
					          fieldLabel: 'Default Image',
					          name: 'img_index'
			          }]
			    	}]
			    	<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
			      ,buttons: [
					      {
					          text: 'Close',
					          handler: function() {
					              winUploadImage.close();
					          }
					      },{
					          text: 'Upload Image',
					          formBind: true,
					          handler:function(){
												sessChecked();
					              formInput.getForm().submit({ 
					                  method:'POST', 
					                  waitTitle:'Connecting', 
					                  waitMsg:'Sending data...',
					                  waitMsgTarget:true,
					
					                  success:function(form, action) {
					                  		Ext.Msg.alert('Success', 'Data Updated Successful');
					                      storeData.load();
					                      winUploadImage.close();
					                	},
					
					                  failure:function(form, action){
																if (action.failureType == 'server') {
																		obj = Ext.JSON.decode(action.response.responseText);
																		Ext.Msg.alert('Failed!', obj.errors.reason);
																} else {
																		Ext.Msg.alert('Warning!', 'Authentication server is unreachable : ' + action.response.responseText);
																}
					                  } 
					              });
					          } 
					      }
			      ]
			      <?php endif;?>
			  });
	  
        winUploadImage = Ext.widget('window', {
            title: 'Upload Image',
            closeAction: 'hide',
        		width: 500,
        		height: 400,
            layout: 'fit',
            resizable: true,
            modal: true,
            items: formInput,
	          listeners: {
	          		hide: function() {
	          				this.destroy();
	          		}
	          }
        });
	      winUploadImage.show();

				var store = Ext.create('Ext.data.Store', {
				    model: 'modelForm',
				    proxy: {
						    type: 'ajax',
						    url : mod_url + '&m=jsonitem&data_id=' + data_id,
						    reader:{
						        type:'json'
						    }
				    },
				    autoLoad: true,
				    listeners: {
				        load: function() {
				            formInput.getForm().loadRecord(store.data.first());
				        }
				    }
				});
		}
		
		function uploadVideo(data_id) {
				sessChecked();
				
				Ext.define('modelForm', {
				    extend: 'Ext.data.Model',
				    fields: ['id','jenis_id','judul','subjudul','judul_url','ringkasan','isi','jenis_judul','jenis_url','folder','img_index','img_artikel','img_list','video','tgl_tayang','tgl_tayang_hh','tgl_tayang_mn','tgl_robot','tgl_robot_hh','tgl_robot_mn','status_tampil','tags']
				});

			  var formInput = Ext.create('Ext.form.Panel', {
			  		url: mod_url + '&m=submitvideo',
			      layout: {type: 'vbox', align: 'stretch'},
			      //split:true,
			      width: '100%',
			      border: false,
			      bodyPadding: 7,
			      fieldDefaults: {labelWidth: 100, anchor: '100%'},
			      items: [{
			          xtype: 'hidden',
			          name: 'id'
	         	},{
			          xtype: 'textfield',
			          fieldLabel: 'Jenis Artikel',
			          name: 'jenis_judul',
			          allowBlank: false,
			          readOnly: true
						},{
			          xtype: 'textfield',
			          fieldLabel: 'Folder',
			          name: 'folder',
			          allowBlank: false,
			          readOnly: true
						},{
			          xtype: 'textfield',
			          fieldLabel: 'Judul',
			          name: 'judul',
			          allowBlank: false,
			          readOnly: true
			     	},{     
                xtype: 'fileuploadfield',
                fieldLabel: 'Upload Video',
                name: 'video_file',
                emptyText: '.mp4 and .flv video file',
                buttonText: 'Browse'
						},{
								xtype: 'textfield',
			          fieldLabel: 'Default Video',
			          name: 'video'
			    	}]
			    	<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
			      ,buttons: [
					      {
					          text: 'Close',
					          handler: function() {
					              winUploadVideo.close();
					          }
					      },{
					          text: 'Upload Video',
					          formBind: true,
					          handler:function(){
												sessChecked();
					              formInput.getForm().submit({ 
					                  method:'POST', 
					                  waitTitle:'Connecting', 
					                  waitMsg:'Sending data...',
					                  waitMsgTarget:true,
					
					                  success:function(form, action) {
					                  		Ext.Msg.alert('Success', 'Data Updated Successful');
					                      storeData.load();
					                      winUploadVideo.close();
					                	},
					
					                  failure:function(form, action){
																if (action.failureType == 'server') {
																		obj = Ext.JSON.decode(action.response.responseText);
																		Ext.Msg.alert('Failed!', obj.errors.reason);
																} else {
																		Ext.Msg.alert('Warning!', 'Authentication server is unreachable : ' + action.response.responseText);
																}
					                  } 
					              });
					          } 
					      }
			      ]
			      <?php endif;?>
			  });
	  
        winUploadVideo = Ext.widget('window', {
            title: 'Upload Video',
            closeAction: 'hide',
        		width: 500,
        		height: 210,
            layout: 'fit',
            resizable: true,
            modal: true,
            items: formInput,
	          listeners: {
	          		hide: function() {
	          				this.destroy();
	          		}
	          }
        });
	      winUploadVideo.show();

				var store = Ext.create('Ext.data.Store', {
				    model: 'modelForm',
				    proxy: {
						    type: 'ajax',
						    url : mod_url + '&m=jsonitem&data_id=' + data_id,
						    reader:{
						        type:'json'
						    }
				    },
				    autoLoad: true,
				    listeners: {
				        load: function() {
				            formInput.getForm().loadRecord(store.data.first());
				        }
				    }
				});
		}
		
	  function deleteData() {
	      sessChecked();
	      
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Delete Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') {
	                  var selection = gridData.getView().getSelectionModel().getSelection();
	                  if (selection) {
												var data = "";
							      		for (i = 0; i < selection.length; ++i) data = data + gridData.getSelectionModel().selected.items[i].data.id + "|";
			                  Ext.Ajax.request({
			                      url: mod_url + '&m=deletedata',
			                      method: 'POST',
			                      params: { postdata: data },
										        success: function(obj) {
										            var resp = obj.responseText;
										            if (resp != 0) {
										                Ext.MessageBox.alert('Failed', resp);
										            } else {
										                Ext.MessageBox.alert('Success','Data was deleted');
										                storeData.remove(selection);
										            }
										        }
			                  });
	                  }
	              }
	          }
	      });
	  }
	  
	  function deleteDataSelection() {
	      sessChecked();
	      
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Delete Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') {
	                  var selection = gridData.getView().getSelectionModel().getSelection();
	                  if (selection) {
												var data = "";
							      		for (i = 0; i < selection.length; ++i) data = data + gridData.getSelectionModel().selected.items[i].data.id + "|";
			                  Ext.Ajax.request({
			                      url: mod_url + '&m=deletedata',
			                      method: 'POST',
			                      params: { postdata: data },
										        success: function(obj) {
										            var resp = obj.responseText;
										            if (resp != 0) {
										                Ext.MessageBox.alert('Failed', resp);
										            } else {
										                Ext.MessageBox.alert('Success','Data was deleted');
										                storeData.remove(selection);
										            }
										        }
			                  });
	                  }
	              }
	          }
	      });
	  }
	  
	  function publishData() {
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Publish Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') setpublishData(1);
	          }
	      });
	  }
	  
	  function unpublishData() {
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Unpublish Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') setpublishData(0);
	          }
	      });
	  }
	  
	  function setpublishData(jenis) {
				sessChecked();
				
				var selection = gridData.getView().getSelectionModel().getSelection();
        if (selection) {
						var data = "";
	      		for (i = 0; i < selection.length; ++i) data = data + gridData.getSelectionModel().selected.items[i].data.id + "|";
            Ext.Ajax.request({
                url: mod_url + '&m=publishdata',
                method: 'POST',
                params: { postdata: data, set: jenis },
				        success: function(obj) {
				            var resp = obj.responseText;
				            if (resp != 0) {
				                Ext.MessageBox.alert('Failed', resp);
				            } else {
				                storeData.load();
				            }
				        }
            });
        }
		}

		/* -------------- GRID PANEL -------------- */	  
	  function renderPublish(val) {
	      if (val == "1") return "<img src="+base_url+"assets/grid-icons/tick.png width=14 height=14/>";
	      return "<img src="+base_url+"assets/grid-icons/cross.png width=14 height=14/>";
	  }
 
 		function searchArtikel() {
				sessChecked();
				
				var keyword = Ext.getCmp("keyword").getValue();
				var jenisid = Ext.getCmp("jenis_id").getValue();
				
				storeData.getProxy().url = mod_url + '&m=json&jenisid='+ jenisid + '&q='+keyword;
				storeData.load({params: {start: 0, limit: itemsPerPage, page: 1}});
		}

		var storeSearchJenis = Ext.create('Ext.data.Store', {
		    autoLoad: true,
		    autoDestroy: true,
		    fields: ['id','jenis'],
		    proxy: {
			      type: 'ajax',
			      url: mod_url + '&m=jsonjenis',
			      reader: {type:'json'}
		    }
		});
				
		var storeData = Ext.create('Ext.data.Store', {
		    fields: ['id','judul','subjudul','judul_url','ringkasan','jenis_judul','jenis_url','folder','img_index','img_artikel','img_list','video','tanggal','tgl_tayang','tgl_robot','status_tampil','total_view'],
		    autoLoad: true,
		    pageSize: itemsPerPage,
		    proxy: {
		        type: 'ajax',
		        url : mod_url + '&m=json',
		        simpleSortMode: true,
		        reader: {
		            type: 'json',
		            root: 'rows',
		            totalProperty: 'results'
		        }
		    }
		});
	  
		var gridData = Ext.create('Ext.grid.Panel', {
		    store: storeData,
		    region: 'center',
		    width: '100%',
		    title: 'Artikel Management',
		    columnLines: true,
	      selModel: Ext.create('Ext.selection.CheckboxModel', {
			      listeners: {
			          selectionchange: function(sm, selections) {
			              <?php if (isset($modAuths['delete'])):?>
			              gridData.down('#delete').setDisabled(selections.length == 0);
			              <?php 
			              endif;
			              if (isset($modAuths['publish'])):
			              ?>
			              gridData.down('#publish').setDisabled(selections.length == 0);
			              gridData.down('#unpublish').setDisabled(selections.length == 0);
			              <?php endif;?>
			          }
			      }
			  }),
			  <?php if (isset($modAuths['edit'])):?>
		    listeners : {
				    itemdblclick: function(dv, record, item, index, e) { editData(gridData.getStore().getAt(index).get("id")) }
				},
				<?php endif;?>
		    columns: [    
		    	{text:'ID', dataIndex:'id', align:'center', width:50},
		    	{text:'Judul', dataIndex:'judul', width:200},
		    	{text:'Jenis', dataIndex:'jenis_judul', align:'center', width:60},
					{
            text: 'Image',
            columns: [
							{
					    		xtype: "actioncolumn", 
					    		header:'Artikel',
					    		align:'center', 
					    		width:40,
					    		items: [
						    		{
		                    getClass: function(v, meta, rec) {
		                        if (rec.get('img_artikel') != "") {
		                            this.items[0].tooltip = 'View Image File';
		                            return 'image-col';
		                        }
		                    },
		                    handler: function(grid, rowIndex, colIndex) {
		                        var rec = gridData.getStore().getAt(rowIndex);
		                        if (rec.get("img_artikel") != "") window.open('<?=STATIC_URL?>images/v09/'+rec.get("folder")+'/'+rec.get("img_artikel"));
		                    }
				          	}
			          	]
							},{
					    		xtype: "actioncolumn", 
					    		header:'List',
					    		align:'center', 
					    		width:40,
					    		items: [
						    		{
		                    getClass: function(v, meta, rec) {
		                        if (rec.get('img_list') != "") {
		                            this.items[0].tooltip = 'View Image File';
		                            return 'image-col';
		                        }
		                    },
		                    handler: function(grid, rowIndex, colIndex) {
		                        var rec = gridData.getStore().getAt(rowIndex);
		                        if (rec.get("img_list") != "") window.open('<?=STATIC_URL?>images/v09/'+rec.get("folder")+'/'+rec.get("img_list"));
		                    }
				          	}
			          	]
			        },{
					    		xtype: "actioncolumn", 
					    		header:'Index',
					    		align:'center', 
					    		width:40,
					    		items: [
						    		{
		                    getClass: function(v, meta, rec) {
		                        if (rec.get('img_index') != "") {
		                            this.items[0].tooltip = 'View Image File';
		                            return 'image-col';
		                        }
		                    },
		                    handler: function(grid, rowIndex, colIndex) {
		                        var rec = gridData.getStore().getAt(rowIndex);
		                        if (rec.get("img_index") != "") window.open('<?=STATIC_URL?>images/v09/'+rec.get("folder")+'/'+rec.get("img_index"));
		                    }
				          	}
			          	]
		    			}
            ]
          },{
			    		xtype: "actioncolumn", 
			    		header:'Video',
			    		align:'center', 
			    		width:40,
			    		items: [
				    		{
                    getClass: function(v, meta, rec) {
                        if (rec.get('video') != "") {
                            this.items[0].tooltip = 'View Video File';
                            return 'video-col';
                        }
                    },
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = gridData.getStore().getAt(rowIndex);
                        if (rec.get("video") != "") window.open(rec.get("video"));
                    }
		          	}
	          	]
					},
		    	{text:'Tgl. Tayang', dataIndex:'tgl_tayang', align:'center', width:120},
		    	{text:'Tgl. Robot', dataIndex:'tgl_robot', align:'center', width:120},
		    	{text:'Tgl. Artikel', dataIndex:'tanggal', align:'center', width:120},
		    	{text:'Publish', dataIndex:'status_tampil', align:'center', width:50, renderer:renderPublish},
		    	{
	          xtype: "actioncolumn",
	          width: 170,
	          align: "center",
	          items: [
			          {
			              icon   : base_url + 'assets/grid-icons/eye.png',
										tooltip: 'Preview Data',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridData.getStore().getAt(rowIndex);
			                  window.open('http://www.indosiar.com/'+rec.get("jenis_url")+'/'+rec.get("judul_url")+'_'+rec.get("id")+'.html');
			              }
			          },
			          <?php if (isset($modAuths['edit'])):?>
			          {
			              icon   : base_url + 'assets/grid-icons/application_edit.png',
										tooltip: 'Edit Data',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridData.getStore().getAt(rowIndex);
			                  editData(rec.get("id"));
			              }
			          },
			          <?php
			          endif;
			          if (isset($modAuths['add']) || isset($modAuths['edit'])):
			          ?>
			          {
			              icon   : base_url + 'assets/grid-icons/image.png',
										tooltip: 'Upload Image',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridData.getStore().getAt(rowIndex);
			                  uploadImage(rec.get("id"));
			              }
			          },{
			              icon   : base_url + 'assets/grid-icons/film.png',
										tooltip: 'Upload Video',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridData.getStore().getAt(rowIndex);
			                  uploadVideo(rec.get("id"));
			              }
			          },
			          <?php
			          endif;
			          if (isset($modAuths['publish'])):
			          ?>
			          {
			              getClass: function(v, meta, rec) {
			                  if (rec.get("status_tampil") == "1") {
			                      this.items[4].tooltip = "Set to Unpublish";
			                      return "set-unpublish";
			                  } else {
			                      this.items[4].tooltip = "Set to Publish";
			                      return "set-publish";
			                  }
			              },
			              handler: function(grid, rowIndex, colIndex) {
			                  sessChecked();
			                  var rec = grid.getStore().getAt(rowIndex);
			                  var jenis = (rec.get("status_tampil") == "1") ? 0 : 1;
			                  Ext.Ajax.request({
			                      url: mod_url + '&m=publishdata',
			                      method: 'POST',
			                      params: { postdata: rec.get("id"), set: jenis },
										        success: function(obj) {
										            var resp = obj.responseText;
										            if (resp != 0) {
										                Ext.MessageBox.alert('Failed', resp);
										            } else {
										                storeData.load();
										            }
										        }
			                  });
			              }
			          },
			          <?php 
			          endif;
			          if (isset($modAuths['delete'])):
			          ?>
			          {
			              icon   : base_url + 'assets/grid-icons/trash.png',
										tooltip: 'Delete Data',
			              handler: function(grid, rowIndex, colIndex) {
			                  sessChecked();
			                  var rec = grid.getStore().getAt(rowIndex);
									      Ext.Msg.show({
									          title: 'Confirm',
									          msg: 'Delete this data ?',
									          buttons: Ext.Msg.YESNO,
									          fn: function(btn) {
									              if (btn == 'yes') {
									                  Ext.Ajax.request({
									                      url: mod_url + '&m=deletedata',
									                      method: 'POST',
									                      params: { postdata: rec.get("id") },
																        success: function(obj) {
																            var resp = obj.responseText;
																            if (resp != 0) {
																                Ext.MessageBox.alert('Failed', resp);
																            } else {
																                Ext.MessageBox.alert('Success','Data was deleted');
																                storeData.removeAt(rowIndex);
																            }
																        }
									                  });
									              }
									          }
									      });
			              }
			          }
			          <?php endif;?>
	          ]
					}
				],
				tbar: new Ext.Toolbar({
	          items: [
			          <?php if (isset($modAuths['delete'])):?>
			          {
			              itemId: 'delete',
			              text: 'Delete',
			              icon: base_url+'assets/grid-icons/trash.png',
			              disabled: true,
			              handler: deleteDataSelection
								},'-',
								<?php 
								endif;
								if (isset($modAuths['add'])):
								?>
								{
			              itemId: 'add',
			              text: 'Add',
			              icon: base_url+'assets/grid-icons/add.png',
			              handler: addData
								},'-',
								<?php 
								endif;
								if (isset($modAuths['publish'])):
								?>
								{
			              itemId: 'publish',
			              text: 'Publish',
			              icon: base_url+'assets/grid-icons/accept.png',
			              disabled: true,
			              handler: publishData
								},'-',{
			              itemId: 'unpublish',
			              text: 'Unpublish',
			              icon: base_url+'assets/grid-icons/delete.png',
			              disabled: true,
			              handler: unpublishData
			          },'-',
			          <?php endif;?>
			          {
			              xtype: 'combo',
			              width: 120,
										name: 'jenis_id',
										id: 'jenis_id',
										store: storeSearchJenis,
										queryMode: 'local',
										//itemSelector: '',
										emptyText: '',
										forceSelection: true,
										triggerAction: 'all',
										valueField: 'id',
										displayField: 'jenis'
			          },{
										xtype: 'textfield',
										name: 'keyword',
										id: 'keyword',
										flex: 1,
				            listeners: {
				                specialkey: function(field, e){
				                    if (e.getKey() == e.ENTER) searchArtikel();
				                }
				            }
								},{
										xtype: 'button',
										text:'<b>Search</b>',
										waitMsg: 'searching...',
										iconCls: 'toolbar_btnsearch',
										handler: searchArtikel
			          }
	          ]
				}),
				bbar: new Ext.PagingToolbar({
		        pageSize: itemsPerPage,
		        store: storeData,
		        displayInfo: true
	    	})
		});
	  		
		var viewportContent = Ext.create('Ext.Panel', {
		    layout: 'border',
		    items: [
					gridData
		    ],
		    border: false,
			  height: Ext.getBody().getViewSize().height-92
		});
		
		maincontent = viewport.getComponent(4);
		maincontent.add(viewportContent);
		//maincontent.add(gridData);
		if (maincontent.border) maincontent.border = false;
		maincontent.doLayout();

		Ext.EventManager.onWindowResize(function () {
				viewportContent.setSize(undefined, Ext.getBody().getViewSize().height-92);
	  });
});
</script>
<style type="text/css">
.x-action-col-cell img.image-col {
    background-image: url('/assets/grid-icons/image.png');
}
.x-ie6 .x-action-col-cell img.image-col {
    background-image: url('/assets/grid-icons/image.png');
}

.x-action-col-cell img.video-col {
    background-image: url('/assets/grid-icons/film.png');
}
.x-ie6 .x-action-col-cell img.video-col {
    background-image: url('/assets/grid-icons/film.png');
}
</style>