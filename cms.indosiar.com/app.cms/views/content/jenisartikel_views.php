<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){		
		var itemsPerPage 	= 50;
		var curDate 			= '<?=date("Y-m-d")?>';
		activeIDJenis 		= 0;
		activeIDKategori 	= 0;
		
	  function renderPublish(val) {
	      if (val == "1") return "<img src="+base_url+"assets/grid-icons/tick.png width=14 height=14/>";
	      return "<img src="+base_url+"assets/grid-icons/cross.png width=14 height=14/>";
	  }
	  
		/* -------------- START OF JENIS ARTIKEL -------------- */
		function popFormJenis() {
				sessChecked();
				
				var storeKategori = Ext.create('Ext.data.Store', {
				    autoLoad: true,
				    autoDestroy: true,
				    fields: ['id','kategori'],
				    proxy: {
					      type: 'ajax',
					      url: mod_url + '&m=jsonkategoriform',
					      reader: {type:'json'}
				    }
				});
				
				Ext.define('modelForm', {
				    extend: 'Ext.data.Model',
				    fields: ['id','kategori_id','jenis','jenis_desc','jenis_url','jenis_url_spesial','folder','folder_old','status','id_old']
				});

			  var formInput = Ext.create('Ext.form.Panel', {
			  		url: mod_url + '&m=submitjenis',
			      layout: {type: 'vbox', align: 'stretch'},
			      width: '100%',
			      border: false,
			      bodyPadding: 7,
			      fieldDefaults: {labelWidth: 100, anchor: '100%'},
			      items: [{
			          xtype: 'hidden',
			          name: 'id'
	         	},{
			          xtype: 'hidden',
			          name: 'folder_old'
	         	},{
	          		xtype: 'combobox',
	              fieldLabel: 'Kategori',
								name: 'kategori_id',
								id: 'kategori_id',
								store: storeKategori,
								queryMode: 'local',
								emptyText: '',
								forceSelection: true,
								triggerAction: 'all',
								valueField: 'id',
								displayField: 'kategori',
								allowBlank: false
						},{
			          xtype: 'textfield',
			          fieldLabel: 'Jenis Artikel',
			          name: 'jenis',
			          allowBlank: false
						},{
			          xtype: 'textfield',
			          fieldLabel: 'Folder',
			          name: 'folder',
			          allowBlank: false
						},{
			          xtype: 'textfield',
			          fieldLabel: 'Spesial URL',
			          name: 'jenis_url_spesial'
						},{
				        xtype: 'radiogroup',
				        allowBlank: false,
				        fieldLabel: 'Publish', 
				        items: [
				            {boxLabel: 'Yes', name: 'status', inputValue: 1},
				            {boxLabel: 'No', name: 'status', inputValue: 0}
				        ]
			    	}]
			    	<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
			      ,buttons: [
					      {
					          text: 'Close',
					          handler: function() {
					              winFormJenis.close();
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
					                      storeDataJenis.load();
					                      winFormJenis.close();
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
	  
        winFormJenis = Ext.widget('window', {
            title: 'Add Jenis Artikel',
            closeAction: 'hide',
            width: 500,
        		height: 215,
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
	      winFormJenis.show();
	      
	      if (activeIDJenis > 0) {
						winFormJenis.setTitle('Edit Jenis Artikel');
						var store = Ext.create('Ext.data.Store', {
						    model: 'modelForm',
						    proxy: {
								    type: 'ajax',
								    url : mod_url + '&m=jsonitemjenis&data_id=' + activeIDJenis,
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
				        'id'    	: '',
				        'status'	: 1
				    }));
	      }
		}
		
	  function addDataJenis() {
	      activeIDJenis = 0;
		    popFormJenis();
	  }
	  
	  function editDataJenis(data_id) {
				activeIDJenis = data_id;
				popFormJenis();
		}
		
	  function deleteDataJenis() {
	      sessChecked();
	      
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Delete Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') {
	                  var selection = gridDataJenis.getView().getSelectionModel().getSelection();
	                  if (selection) {
												var data = "";
							      		for (i = 0; i < selection.length; ++i) data = data + gridDataJenis.getSelectionModel().selected.items[i].data.id + "|";
			                  Ext.Ajax.request({
			                      url: mod_url + '&m=deletedatajenis',
			                      method: 'POST',
			                      params: { postdata: data },
										        success: function(obj) {
										            var resp = obj.responseText;
										            if (resp != 0) {
										                Ext.MessageBox.alert('Failed', resp);
										            } else {
										                //Ext.MessageBox.alert('Success','Data was deleted');
										                //storeDataJenis.remove(selection);
										                storeDataJenis.load();
										            }
										        }
			                  });
	                  }
	              }
	          }
	      });
	  }
	  
	  function deleteDataJenisSelection() {
	      sessChecked();
	      
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Delete Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') {
	                  var selection = gridDataJenis.getView().getSelectionModel().getSelection();
	                  if (selection) {
												var data = "";
							      		for (i = 0; i < selection.length; ++i) data = data + gridDataJenis.getSelectionModel().selected.items[i].data.id + "|";
			                  Ext.Ajax.request({
			                      url: mod_url + '&m=deletedatajenis',
			                      method: 'POST',
			                      params: { postdata: data },
										        success: function(obj) {
										            var resp = obj.responseText;
										            if (resp != 0) {
										                Ext.MessageBox.alert('Failed', resp);
										            } else {
										                //Ext.MessageBox.alert('Success','Data was deleted');
										                //storeDataJenis.remove(selection);
										                storeDataJenis.load();
										            }
										        }
			                  });
	                  }
	              }
	          }
	      });
	  }
	  
	  function publishDataJenis() {
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Publish Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') setpublishDataJenis(1);
	          }
	      });
	  }
	  
	  function unpublishDataJenis() {
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Unpublish Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') setpublishDataJenis(0);
	          }
	      });
	  }
	  
	  function setpublishDataJenis(flag) {
				sessChecked();
				
				var selection = gridDataJenis.getView().getSelectionModel().getSelection();
        if (selection) {
						var data = "";
	      		for (i = 0; i < selection.length; ++i) data = data + gridDataJenis.getSelectionModel().selected.items[i].data.id + "|";
            Ext.Ajax.request({
                url: mod_url + '&m=publishdatajenis',
                method: 'POST',
                params: { postdata: data, set: flag },
				        success: function(obj) {
				            var resp = obj.responseText;
				            if (resp != 0) {
				                Ext.MessageBox.alert('Failed', resp);
				            } else {
				                storeDataJenis.load();
				            }
				        }
            });
        }
		}
		
		Ext.define('modelDataJenis', {
		    extend: 'Ext.data.Model',
		    fields: ['id','kategori_id','jenis','jenis_desc','jenis_url','folder','status','id_old','kategori']
		});
		
		var storeDataJenis = Ext.create('Ext.data.Store', {
		    model: modelDataJenis,
		    autoLoad: true,
		    pageSize: itemsPerPage,
		    proxy: {
		        type: 'ajax',
		        url : mod_url + '&m=jsonjenis',
		        simpleSortMode: true,
		        reader: {
		            type: 'json',
		            root: 'rows',
		            totalProperty: 'results'
		        }
		    }
		});
		
	  var gridDataJenis = Ext.create('Ext.grid.Panel', {
		    store: storeDataJenis,
		    //region: 'center',
		    width: '100%',
		    height: Ext.getBody().getViewSize().height-119,
		    columnLines: true,
	      selModel: Ext.create('Ext.selection.CheckboxModel', {
			      listeners: {
			          selectionchange: function(sm, selections) {
			              <?php if (isset($modAuths['delete'])):?>
			              gridDataJenis.down('#delete').setDisabled(selections.length == 0);
			              <?php 
			              endif;
			              if (isset($modAuths['publish'])):
			              ?>
			              gridDataJenis.down('#publish').setDisabled(selections.length == 0);
			              gridDataJenis.down('#unpublish').setDisabled(selections.length == 0);
			              <?php endif;?>
			          }
			      }
			  }),
			  <?php if (isset($modAuths['edit'])):?>
		    listeners : {
				    itemdblclick: function(dv, record, item, index, e) { editDataJenis(gridDataJenis.getStore().getAt(index).get("id")) }
				},
				<?php endif;?>
		    columns: [    
		    	{text:'ID', dataIndex:'id', align:'center', width:50},
		    	{text:'Kategori', dataIndex:'kategori', width:100},
		    	{text:'Jenis Artikel', dataIndex:'jenis', width:200},
		    	{text:'URL', dataIndex:'jenis_url', align:'center', width:150},
		    	{text:'Folder', dataIndex:'folder', align:'center', width:150},
		    	{text:'Publish', dataIndex:'status', align:'center', width:50, renderer:renderPublish},
		    	{
	          xtype: "actioncolumn",
	          width: 110,
	          align: "center",
	          items: [
			          {
			              icon   : base_url + 'assets/grid-icons/eye.png',
										tooltip: 'Preview Data',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridDataJenis.getStore().getAt(rowIndex);
			                  window.open('http://www.indosiar.com/'+rec.get("jenis_url"));
			              }
			          },
			          <?php if (isset($modAuths['edit'])):?>
			          {
			              icon   : base_url + 'assets/grid-icons/application_edit.png',
										tooltip: 'Edit Data',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridDataJenis.getStore().getAt(rowIndex);
			                  editDataJenis(rec.get("id"));
			              }
			          },
			          <?php 
			          endif;
			          if (isset($modAuths['publish'])):
			          ?>
			          {
			              getClass: function(v, meta, rec) {
			                  if (rec.get("status") == "1") {
			                      this.items[2].tooltip = "Set to Unpublish";
			                      return "set-unpublish";
			                  } else {
			                      this.items[2].tooltip = "Set to Publish";
			                      return "set-publish";
			                  }
			              },
			              handler: function(grid, rowIndex, colIndex) {
			                  sessChecked();
			                  var rec = grid.getStore().getAt(rowIndex);
			                  var jenis = (rec.get("status") == "1") ? 0 : 1;
			                  Ext.Ajax.request({
			                      url: mod_url + '&m=publishdatajenis',
			                      method: 'POST',
			                      params: { postdata: rec.get("id"), set: jenis },
										        success: function(obj) {
										            var resp = obj.responseText;
										            if (resp != 0) {
										                Ext.MessageBox.alert('Failed', resp);
										            } else {
										                storeDataJenis.load();
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
									                      url: mod_url + '&m=deletedatajenis',
									                      method: 'POST',
									                      params: { postdata: rec.get("id") },
																        success: function(obj) {
																            var resp = obj.responseText;
																            if (resp != 0) {
																                Ext.MessageBox.alert('Failed', resp);
																            } else {
																                //Ext.MessageBox.alert('Success','Data was deleted');
																                //storeDataJenis.removeAt(rowIndex);
																                storeDataJenis.load();
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
			              handler: deleteDataJenisSelection
								},'-',
								<?php 
								endif;
								if (isset($modAuths['add'])):
								?>
								{
			              itemId: 'add',
			              text: 'Add',
			              icon: base_url+'assets/grid-icons/add.png',
			              handler: addDataJenis
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
			              handler: publishDataJenis
								},'-',{
			              itemId: 'unpublish',
			              text: 'Unpublish',
			              icon: base_url+'assets/grid-icons/delete.png',
			              disabled: true,
			              handler: unpublishDataJenis
			          }
			          <?php endif;?>
	          ]
				}),
				bbar: new Ext.PagingToolbar({
		        pageSize: itemsPerPage,
		        store: storeDataJenis,
		        displayInfo: true
	    	})
		});
	  /* -------------- END OF JENIS ARTIKEL -------------- */
	  
		/* -------------- START OF KATEGORI ARTIKEL -------------- */
		function popFormKategori() {
				sessChecked();
				
				Ext.define('modelForm', {
				    extend: 'Ext.data.Model',
				    fields: ['id','kategori','status']
				});

			  var formInput = Ext.create('Ext.form.Panel', {
			  		url: mod_url + '&m=submitkategori',
			      layout: {type: 'vbox', align: 'stretch'},
			      width: '100%',
			      border: false,
			      bodyPadding: 7,
			      fieldDefaults: {labelWidth: 100, anchor: '100%'},
			      items: [{
			          xtype: 'hidden',
			          name: 'id'
						},{
			          xtype: 'textfield',
			          fieldLabel: 'Kategori Artikel',
			          name: 'kategori',
			          allowBlank: false
						},{
				        xtype: 'radiogroup',
				        allowBlank: false,
				        fieldLabel: 'Publish', 
				        items: [
				            {boxLabel: 'Yes', name: 'status', inputValue: 1},
				            {boxLabel: 'No', name: 'status', inputValue: 0}
				        ]
			    	}]
			    	<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
			      ,buttons: [
					      {
					          text: 'Close',
					          handler: function() {
					              winFormKategori.close();
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
					                      storeDataKategori.load();
					                      winFormKategori.close();
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
	  
        winFormKategori = Ext.widget('window', {
            title: 'Add Kategori Artikel',
            closeAction: 'hide',
            width: 500,
        		height: 150,
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
	      winFormKategori.show();
	      
	      if (activeIDKategori > 0) {
						winFormKategori.setTitle('Edit Kategori Artikel');
						var store = Ext.create('Ext.data.Store', {
						    model: 'modelForm',
						    proxy: {
								    type: 'ajax',
								    url : mod_url + '&m=jsonitemkategori&data_id=' + activeIDKategori,
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
				        'id'    	: '',
				        'status'	: 1
				    }));
	      }
		}
		
	  function addDataKategori() {
	      activeIDKategori = 0;
		    popFormKategori();
	  }
	  
	  function editDataKategori(data_id) {
				activeIDKategori = data_id;
				popFormKategori();
		}
		
	  function deleteDataKategori() {
	      sessChecked();
	      
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Delete Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') {
	                  var selection = gridDataKategori.getView().getSelectionModel().getSelection();
	                  if (selection) {
												var data = "";
							      		for (i = 0; i < selection.length; ++i) data = data + gridDataKategori.getSelectionModel().selected.items[i].data.id + "|";
			                  Ext.Ajax.request({
			                      url: mod_url + '&m=deletedatakategori',
			                      method: 'POST',
			                      params: { postdata: data },
										        success: function(obj) {
										            var resp = obj.responseText;
										            if (resp != 0) {
										                Ext.MessageBox.alert('Failed', resp);
										            } else {
										                Ext.MessageBox.alert('Success','Data was deleted');
										                //storeDataKategori.remove(selection);
										                storeDataKategori.load();
										            }
										        }
			                  });
	                  }
	              }
	          }
	      });
	  }
	  
	  function deleteDataKategoriSelection() {
	      sessChecked();
	      
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Delete Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') {
	                  var selection = gridDataKategori.getView().getSelectionModel().getSelection();
	                  if (selection) {
												var data = "";
							      		for (i = 0; i < selection.length; ++i) data = data + gridDataKategori.getSelectionModel().selected.items[i].data.id + "|";
			                  Ext.Ajax.request({
			                      url: mod_url + '&m=deletedatakategori',
			                      method: 'POST',
			                      params: { postdata: data },
										        success: function(obj) {
										            var resp = obj.responseText;
										            if (resp != 0) {
										                Ext.MessageBox.alert('Failed', resp);
										            } else {
										                Ext.MessageBox.alert('Success','Data was deleted');
										                //storeDataKategori.remove(selection);
										                storeDataKategori.load();
										            }
										        }
			                  });
	                  }
	              }
	          }
	      });
	  }
	  
	  function publishDataKategori() {
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Publish Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') setpublishDataKategori(1);
	          }
	      });
	  }
	  
	  function unpublishDataKategori() {
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Unpublish Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') setpublishDataKategori(0);
	          }
	      });
	  }
	  
	  function setpublishDataKategori(flag) {
				sessChecked();
				
				var selection = gridDataKategori.getView().getSelectionModel().getSelection();
        if (selection) {
						var data = "";
	      		for (i = 0; i < selection.length; ++i) data = data + gridDataKategori.getSelectionModel().selected.items[i].data.id + "|";
            Ext.Ajax.request({
                url: mod_url + '&m=publishdatakategori',
                method: 'POST',
                params: { postdata: data, set: flag },
				        success: function(obj) {
				            var resp = obj.responseText;
				            if (resp != 0) {
				                Ext.MessageBox.alert('Failed', resp);
				            } else {
				                storeDataKategori.load();
				            }
				        }
            });
        }
		}
		
		Ext.define('modelDataKategori', {
		    extend: 'Ext.data.Model',
		    fields: ['id','kategori','status']
		});
		
		var storeDataKategori = Ext.create('Ext.data.Store', {
		    model: modelDataKategori,
		    autoLoad: true,
		    pageSize: itemsPerPage,
		    proxy: {
		        type: 'ajax',
		        url : mod_url + '&m=jsonkategori',
		        simpleSortMode: true,
		        reader: {
		            type: 'json',
		            root: 'rows',
		            totalProperty: 'results'
		        }
		    }
		});
		
	  var gridDataKategori = Ext.create('Ext.grid.Panel', {
		    store: storeDataKategori,
		    width: '100%',
		    height: Ext.getBody().getViewSize().height-119,
		    columnLines: true,
	      selModel: Ext.create('Ext.selection.CheckboxModel', {
			      listeners: {
			          selectionchange: function(sm, selections) {
			              <?php if (isset($modAuths['delete'])):?>
			              gridDataKategori.down('#delete').setDisabled(selections.length == 0);
			              <?php 
			              endif;
			              if (isset($modAuths['publish'])):
			              ?>
			              gridDataKategori.down('#publish').setDisabled(selections.length == 0);
			              gridDataKategori.down('#unpublish').setDisabled(selections.length == 0);
			              <?php endif;?>
			          }
			      }
			  }),
			  <?php if (isset($modAuths['edit'])):?>
		    listeners : {
				    itemdblclick: function(dv, record, item, index, e) { editDataKategori(gridDataKategori.getStore().getAt(index).get("id")) }
				},
				<?php endif;?>
		    columns: [    
		    	{text:'ID', dataIndex:'id', align:'center', width:50},
		    	{text:'Kategori', dataIndex:'kategori', width:200},
		    	{text:'Publish', dataIndex:'status', align:'center', width:50, renderer:renderPublish},
		    	{
	          xtype: "actioncolumn",
	          width: 110,
	          align: "center",
	          items: [
			          {
			              icon   : base_url + 'assets/grid-icons/eye.png',
										tooltip: 'Preview Data',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridDataKategori.getStore().getAt(rowIndex);
			                  window.open('http://www.indosiar.com/'+rec.get("kategori_url"));
			              }
			          },
			          <?php if (isset($modAuths['edit'])):?>
			          {
			              icon   : base_url + 'assets/grid-icons/application_edit.png',
										tooltip: 'Edit Data',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridDataKategori.getStore().getAt(rowIndex);
			                  editDataKategori(rec.get("id"));
			              }
			          },
			          <?php 
			          endif;
			          if (isset($modAuths['publish'])):
			          ?>
			          {
			              getClass: function(v, meta, rec) {
			                  if (rec.get("status") == "1") {
			                      this.items[2].tooltip = "Set to Unpublish";
			                      return "set-unpublish";
			                  } else {
			                      this.items[2].tooltip = "Set to Publish";
			                      return "set-publish";
			                  }
			              },
			              handler: function(grid, rowIndex, colIndex) {
			                  sessChecked();
			                  var rec = grid.getStore().getAt(rowIndex);
			                  var kategori = (rec.get("status") == "1") ? 0 : 1;
			                  Ext.Ajax.request({
			                      url: mod_url + '&m=publishdatakategori',
			                      method: 'POST',
			                      params: { postdata: rec.get("id"), set: kategori },
										        success: function(obj) {
										            var resp = obj.responseText;
										            if (resp != 0) {
										                Ext.MessageBox.alert('Failed', resp);
										            } else {
										                storeDataKategori.load();
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
									                      url: mod_url + '&m=deletedatakategori',
									                      method: 'POST',
									                      params: { postdata: rec.get("id") },
																        success: function(obj) {
																            var resp = obj.responseText;
																            if (resp != 0) {
																                Ext.MessageBox.alert('Failed', resp);
																            } else {
																                //Ext.MessageBox.alert('Success','Data was deleted');
																                //storeDataKategori.removeAt(rowIndex);
																                storeDataKategori.load();
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
			              handler: deleteDataKategoriSelection
								},'-',
								<?php 
								endif;
								if (isset($modAuths['add'])):
								?>
								{
			              itemId: 'add',
			              text: 'Add',
			              icon: base_url+'assets/grid-icons/add.png',
			              handler: addDataKategori
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
			              handler: publishDataKategori
								},'-',{
			              itemId: 'unpublish',
			              text: 'Unpublish',
			              icon: base_url+'assets/grid-icons/delete.png',
			              disabled: true,
			              handler: unpublishDataKategori
			          }
			          <?php endif;?>
	          ]
				}),
				bbar: new Ext.PagingToolbar({
		        pageSize: itemsPerPage,
		        store: storeDataKategori,
		        displayInfo: true
	    	})
		});
	  /* -------------- END OF KATEGORI ARTIKEL -------------- */
	  
	  
	  var tabs = Ext.create('Ext.tab.Panel', {
	      height: Ext.getBody().getViewSize().height-92,
	      activeTab: 0,
	      plain: false,
	      tabPosition: 'top',
	      defaults :{
	          autoScroll: true,
	          bodyPadding: 0
	      },
	      items: [
				{
	          items: gridDataJenis, 
	          title: 'Jenis Artikel'
	      },{
	          items: gridDataKategori, 
	          title: 'Kategori Artikel'
	      }
	      ]
	  });
		
		maincontent = viewport.getComponent(4);
		maincontent.add(tabs);
		if (maincontent.border) maincontent.border = false;
		maincontent.doLayout();

		Ext.EventManager.onWindowResize(function () {
				//viewportContent.setSize(undefined, Ext.getBody().getViewSize().height-92);
				tabs.setSize(undefined, Ext.getBody().getViewSize().height-92);
				gridDataJenis.setSize(undefined, Ext.getBody().getViewSize().height-119);
				gridDataKategori.setSize(undefined, Ext.getBody().getViewSize().height-119);
	  });
});
</script>