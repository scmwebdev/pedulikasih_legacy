<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){			
		var itemsPerPage 	= 100;
		var curDate 			= '<?=date("Y-m-d")?>';
	  	  
	  function addData() {     
	      sessChecked();
	      
	      formInput.getForm().reset();
	      formInput.setTitle('Add New Data');
	      
				formInput.getForm().loadRecord(Ext.create('modelData', {
		        'id'    	: '',
		        'id_main' : 0,
		        'menu_id'	: 0,
		        'sort'		: 1
		    }));
		    
		    storeMainMenu.load();
	  }
	  
	  function editData(data_id) {		
				sessChecked();
				
				formInput.getForm().reset();
				formInput.setTitle('Edit Data');
				
				var store = Ext.create('Ext.data.Store', {
				    model: 'modelData',
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
				
				storeMainMenu.load();
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
										                //Ext.MessageBox.alert('Success','Data was deleted');
										                //storeData.remove(selection);
										                storeData.load();
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
										                //Ext.MessageBox.alert('Success','Data was deleted');
										                //storeData.remove(selection);
										                storeData.load();
										            }
										        }
			                  });
	                  }
	              }
	          }
	      });
	  }

		/* -------------- GRID PANEL -------------- */		
		function renderRow(val, meta, rec) {
	 			if (rec.data.id_main == "0") meta.tdAttr = 'style="background-color: #FFCC33;"';
		    return val;
		}
	  
		Ext.define('modelData', {
		    extend: 'Ext.data.Model',
		    fields: ['id','id_main','col_title','col_value','sort','tanggal']
		});
	        
		var storeData = Ext.create('Ext.data.Store', {
		    model: 'modelData',
		    autoLoad: true,
		    proxy: {
		        type: 'ajax',
		        url : mod_url + '&m=json',
		        simpleSortMode: true,
		        reader: {
		            type: 'json'
		        }
		    }
		});
		  
		var storeMainMenu = Ext.create('Ext.data.Store', {
		    autoLoad: true,
		    autoDestroy: true,
		    fields: ['id','col_title'],
		    proxy: {
			      type: 'ajax',
			      url: mod_url + '&m=jsonmainmenu',
			      reader: {type:'json'}
		    }
		});
				
		var gridData = Ext.create('Ext.grid.Panel', {
		    store: storeData,
		    width: '100%',
		    region: 'center',
		    columnLines: true,
	      selModel: Ext.create('Ext.selection.CheckboxModel', {
			      listeners: {
			          selectionchange: function(sm, selections) {
			              <?php if (isset($modAuths['delete'])):?>
			              gridData.down('#delete').setDisabled(selections.length == 0);
			              <?php 
			              endif;
			              ?>
			          }
			      }
			  }),
			  <?php if (isset($modAuths['edit'])):?>
		    listeners : {
				    itemdblclick: function(dv, record, item, index, e) { editData(gridData.getStore().getAt(index).get("id")) }
				},
				<?php endif;?>
		    columns: [    
		    	{text:'Title', dataIndex:'col_title', width:250, sortable: false, renderer:renderRow},
		    	{text:'Value', dataIndex:'col_value', width:200, align:'center', sortable: false, renderer:renderRow},
		    	{text:'Sort', dataIndex:'sort', width:40, align:'center', sortable: false, renderer:renderRow},
		    	{
	          xtype: "actioncolumn",
	          width: 62,
	          align: "center",
	          items: [
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
	              tooltip: 'Delete Selected Data',
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
	              tooltip: 'Add Data',
	              icon: base_url+'assets/grid-icons/add.png',
	              handler: addData
						}
						<?php endif;?>
	          ]
				})
		});
  
		/* -------------- FORM PANEL -------------- */			
	  var formInput = Ext.create('Ext.form.Panel', {
	  		url: mod_url + '&m=submitdata',
	      layout: {type: 'vbox', align: 'stretch'},
	      title: 'Add New Data',
	      region: 'east',
	      split: true,
				width: 450,
	      border: true,
	      bodyPadding: 10,
	      fieldDefaults: {labelWidth: 100},
	      items: [{
	          xtype: 'hidden',
	          name: 'id'
				},{
            xtype: 'combobox',
            fieldLabel: 'Parent Column',
						name: 'id_main',
						store: storeMainMenu,
						queryMode: 'local',
						emptyText: '',
						forceSelection: true,
						triggerAction: 'all',
						valueField: 'id',
						displayField: 'col_title',
						allowBlank: false
				},{
	          xtype: 'textfield',
	          fieldLabel: 'Title',
	          name: 'col_title',
	          allowBlank: false
	      },{
	          xtype: 'textfield',
	          fieldLabel: 'Value',
	          name: 'col_value',
	          allowBlank: false
	      },{
	          xtype: 'numberfield',
	          fieldLabel: 'Sort',
	          name: 'sort',
	          value: 1,
	          minValue: 1,
	          allowBlank: false
	    	}]
	<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
	      ,buttons: [
		      	{
			          text: 'Reset',
			          handler: function() {
			              addData();
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
			                  		addData();
			                      storeData.load();
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
		
		var viewportContent = Ext.create('Ext.Panel', {
		    layout: 'border',
				border: false,
		    height: Ext.getBody().getViewSize().height-119,
		    items: [
<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
		    	formInput,
<?php endif;?>
					gridData
		    ]
		});
		
		
		// ----------------- COLUMN HIGHLIGHTS ------------------- //
	  function addDataColumn() {     
	      sessChecked();
	      
	      formInputColumn.getForm().reset();
	      formInputColumn.setTitle('Add New Data');
	      
				formInputColumn.getForm().loadRecord(Ext.create('modelDataColumn', {
		        'id'    			: '',
		        'id_main'    	: 0,
		        'sort'	: 1
		    }));
		    
		    storeMainMenuColumn.load();
	  }
	  
	  function editDataColumn(data_id) {		
				sessChecked();
				
				formInputColumn.getForm().reset();
				formInputColumn.setTitle('Edit Data');
				
				var store = Ext.create('Ext.data.Store', {
				    model: 'modelDataColumn',
				    proxy: {
						    type: 'ajax',
						    url : mod_url + '&m=jsonitemcolumn&data_id=' + data_id,
						    reader:{
						        type:'json'
						    }
				    },
				    autoLoad: true,
				    listeners: {
				        load: function() {
				            formInputColumn.getForm().loadRecord(store.data.first());
				        }
				    }
				});
				
				storeMainMenuColumn.load();
		}
		
	  function deleteDataColumn() {
	      sessChecked();
	      
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Delete Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') {
	                  var selection = gridDataColumn.getView().getSelectionModel().getSelection();
	                  if (selection) {
												var data = "";
							      		for (i = 0; i < selection.length; ++i) data = data + gridDataColumn.getSelectionModel().selected.items[i].data.id + "|";
			                  Ext.Ajax.request({
			                      url: mod_url + '&m=deletedata',
			                      method: 'POST',
			                      params: { postdata: data },
										        success: function(obj) {
										            var resp = obj.responseText;
										            if (resp != 0) {
										                Ext.MessageBox.alert('Failed', resp);
										            } else {
										                //Ext.MessageBox.alert('Success','Data was deleted');
										                //storeDataColumn.remove(selection);
										                storeDataColumn.load();
										            }
										        }
			                  });
	                  }
	              }
	          }
	      });
	  }
	  
	  function deleteDataSelectionColumn() {
	      sessChecked();
	      
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Delete Selected Data ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
	              if (btn == 'yes') {
	                  var selection = gridDataColumn.getView().getSelectionModel().getSelection();
	                  if (selection) {
												var data = "";
							      		for (i = 0; i < selection.length; ++i) data = data + gridDataColumn.getSelectionModel().selected.items[i].data.id + "|";
			                  Ext.Ajax.request({
			                      url: mod_url + '&m=deletedata',
			                      method: 'POST',
			                      params: { postdata: data },
										        success: function(obj) {
										            var resp = obj.responseText;
										            if (resp != 0) {
										                Ext.MessageBox.alert('Failed', resp);
										            } else {
										                //Ext.MessageBox.alert('Success','Data was deleted');
										                //storeDataColumn.remove(selection);
										                storeDataColumn.load();
										            }
										        }
			                  });
	                  }
	              }
	          }
	      });
	  }

		function showListMenu() {
				sessChecked();

				Ext.define('modelDataMenu', {
				    extend: 'Ext.data.Model',
				    fields: ['id','id_main','judul_id','judul_menu_id','judul_ur_idl','judul_en','judul_menu_en','judul_url_en','pdf_id','pdf_en','status_sort','tanggal','publish']
				});
			        
				var storeDataMenu = Ext.create('Ext.data.Store', {
				    model: 'modelDataMenu',
				    autoLoad: true,
				    proxy: {
				        type: 'ajax',
				        url : mod_url + '&m=jsonmenu',
				        simpleSortMode: true,
				        reader: {
				            type: 'json'
				        }
				    }
				});
						
				var gridDataMenu = Ext.create('Ext.grid.Panel', {
				    store: storeDataMenu,
				    width: '100%',
				    columnLines: true,
						listeners : {
						    itemdblclick: function(dv, record, item, index, e) {
										Ext.getCmp('menu_id').setValue(gridDataMenu.getStore().getAt(index).get("id"));
	              		winMenu.close();
								}
						},
				    columns: [    
				    	{text:'ID', dataIndex:'id', width:50, sortable: false, align:'center'},
				    	{text:'Menu', dataIndex:'judul_menu_id', sortable: false, width:200},
				    	{text:'Judul', dataIndex:'judul_id', sortable: false, width:200},
				    	{
		            text: 'PDF',
		            columns: [
									{
							    		xtype: "actioncolumn", 
							    		header:'ID',
							    		align:'center', 
							    		width:40,
							    		items: [
								    		{
				                    getClass: function(v, meta, rec) {
				                        if (rec.get('pdf_id') != "") {
				                            this.items[0].tooltip = 'View PDF File';
				                            return 'pdf-col';
				                        }
				                    },
				                    handler: function(grid, rowIndex, colIndex) {
				                        var rec = gridDataMenu.getStore().getAt(rowIndex);
				                        if (rec.get("pdf_id") != "") window.open('<?=STATIC_URL?>pdf/investor/'+rec.get("pdf_id"));
				                    }
						          	}
					          	]
									},{
							    		xtype: "actioncolumn", 
							    		header:'EN',
							    		align:'center', 
							    		width:40,
							    		items: [
								    		{
				                    getClass: function(v, meta, rec) {
				                        if (rec.get('pdf_en') != "") {
				                            this.items[0].tooltip = 'View PDF File';
				                            return 'pdf-col';
				                        }
				                    },
				                    handler: function(grid, rowIndex, colIndex) {
				                        var rec = gridDataMenu.getStore().getAt(rowIndex);
				                        if (rec.get("pdf_en") != "") window.open('<?=STATIC_URL?>pdf/investor/'+rec.get("pdf_en"));
				                    }
						          	}
					          	]
				    			}
		            ]
		          }
						],
						tbar: new Ext.Toolbar({
			          items: [
									{			          		
			              itemId: 'select',
			              text: 'Select',
			              icon: base_url+'assets/grid-icons/accept.png',
			              disabled: true,
			              handler: function() {
			              		var data = gridDataMenu.getSelectionModel().selected.items[0].data;
												Ext.getCmp('menu_id').setValue(data.id);
			              		winMenu.close();
			              }
			            }
			          ]
						})
				});

			  gridDataMenu.getSelectionModel().on('selectionchange', function(selModel, selections){
			      gridDataMenu.down('#select').setDisabled(selections.length === 0);
			  });
			  
        winMenu = Ext.widget('window', {
            title: 'List Menu',
            closeAction: 'hide',
            width: 600,
        		height: Ext.getBody().getViewSize().height-100,
            layout: 'fit',
            resizable: true,
            modal: true,
            items: gridDataMenu,
	          listeners: {
	          		hide: function() {
	          				this.destroy();
	          		}
	          }
        });
	      winMenu.show();
		}
		
		/* -------------- GRID PANEL -------------- */	  
		Ext.define('modelDataColumn', {
		    extend: 'Ext.data.Model',
		    fields: ['id','id_main','judul','menu_id','sort','tanggal','pdf_id','pdf_en']
		});
	        
		var storeDataColumn = Ext.create('Ext.data.Store', {
		    model: 'modelDataColumn',
		    autoLoad: true,
		    proxy: {
		        type: 'ajax',
		        url : mod_url + '&m=jsoncolumn',
		        simpleSortMode: true,
		        reader: {
		            type: 'json'
		        }
		    }
		});
		  
		var storeMainMenuColumn = Ext.create('Ext.data.Store', {
		    autoLoad: true,
		    autoDestroy: true,
		    fields: ['id','judul'],
		    proxy: {
			      type: 'ajax',
			      url: mod_url + '&m=jsonmainmenucolumn',
			      reader: {type:'json'}
		    }
		});
				
		var gridDataColumn = Ext.create('Ext.grid.Panel', {
		    store: storeDataColumn,
		    width: '100%',
		    region: 'center',
		    columnLines: true,
	      selModel: Ext.create('Ext.selection.CheckboxModel', {
			      listeners: {
			          selectionchange: function(sm, selections) {
			              <?php if (isset($modAuths['delete'])):?>
			              gridDataColumn.down('#deleteColumn').setDisabled(selections.length == 0);
			              <?php 
			              endif;
			              ?>
			          }
			      }
			  }),
			  <?php if (isset($modAuths['edit'])):?>
		    listeners : {
				    itemdblclick: function(dv, record, item, index, e) { editDataColumn(gridDataColumn.getStore().getAt(index).get("id")) }
				},
				<?php endif;?>
		    columns: [    
		    	{text:'Title', dataIndex:'judul', width:250, sortable: false, renderer:renderRow},
		    	{
            text: 'PDF',
            columns: [
							{
					    		xtype: "actioncolumn", 
					    		header:'ID',
					    		align:'center', 
					    		width:40,
					    		items: [
						    		{
		                    getClass: function(v, meta, rec) {
		                        if (rec.get('pdf_id') != "") {
		                            this.items[0].tooltip = 'View PDF File';
		                            return 'pdf-col';
		                        }
		                    },
		                    handler: function(grid, rowIndex, colIndex) {
		                        var rec = gridDataColumn.getStore().getAt(rowIndex);
		                        if (rec.get("pdf_id") != "") window.open('<?=STATIC_URL?>pdf/investor/'+rec.get("pdf_id"));
		                    }
				          	}
			          	]
							},{
					    		xtype: "actioncolumn", 
					    		header:'EN',
					    		align:'center', 
					    		width:40,
					    		items: [
						    		{
		                    getClass: function(v, meta, rec) {
		                        if (rec.get('pdf_en') != "") {
		                            this.items[0].tooltip = 'View PDF File';
		                            return 'pdf-col';
		                        }
		                    },
		                    handler: function(grid, rowIndex, colIndex) {
		                        var rec = gridDataColumn.getStore().getAt(rowIndex);
		                        if (rec.get("pdf_en") != "") window.open('<?=STATIC_URL?>pdf/investor/'+rec.get("pdf_en"));
		                    }
				          	}
			          	]
		    			}
            ]
          },
		    	{text:'Sort', dataIndex:'sort', width:40, sortable: false, align:'center'},
		    	{
	          xtype: "actioncolumn",
	          width: 62,
	          align: "center",
	          items: [
			          <?php if (isset($modAuths['edit'])):?>
			          {
			              icon   : base_url + 'assets/grid-icons/application_edit.png',
										tooltip: 'Edit Data',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridDataColumn.getStore().getAt(rowIndex);
			                  editDataColumn(rec.get("id"));
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
																                storeDataColumn.removeAt(rowIndex);
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
	              itemId: 'deleteColumn',
	              text: 'Delete',
	              tooltip: 'Delete Selected Data',
	              icon: base_url+'assets/grid-icons/trash.png',
	              disabled: true,
	              handler: deleteDataSelectionColumn
						},'-',
						<?php 
						endif;
						if (isset($modAuths['add'])):
						?>
						{
	              itemId: 'addColumn',
	              text: 'Add',
	              tooltip: 'Add Data',
	              icon: base_url+'assets/grid-icons/add.png',
	              handler: addDataColumn
						}
						<?php endif;?>
	          ]
				})
		});
  
		/* -------------- FORM PANEL -------------- */			
	  var formInputColumn = Ext.create('Ext.form.Panel', {
	  		url: mod_url + '&m=submitdatacolumn',
	      layout: {type: 'vbox', align: 'stretch'},
	      title: 'Add New Data',
	      region: 'east',
	      split: true,
				width: 450,
	      border: true,
	      bodyPadding: 10,
	      fieldDefaults: {labelWidth: 100},
	      items: [{
	          xtype: 'hidden',
	          name: 'id'
				},{
            xtype: 'combobox',
            fieldLabel: 'Parent Column',
						name: 'id_main',
						store: storeMainMenuColumn,
						queryMode: 'local',
						emptyText: '',
						forceSelection: true,
						triggerAction: 'all',
						valueField: 'id',
						displayField: 'judul',
						allowBlank: false
				},{
	          xtype: 'textfield',
	          fieldLabel: 'Title',
	          name: 'judul',
	          allowBlank: false
	      },{
              xtype: 'fieldcontainer',
              layout: 'hbox',
              defaultType: 'button',
              items: [{
				          xtype: 'numberfield',
				          fieldLabel: 'Investor Link ID',
				          name: 'menu_id',
				          id: 'menu_id',
				          value: 0,
				          minValue: 0,
				          flex: 1
			        },{
	                text: 'View Menu',
	                iconCls: 'toolbar_btnsearch',
	                margins: '0 0 0 10',
	                handler: showListMenu
              }]
	      },{
	          xtype: 'numberfield',
	          fieldLabel: 'Sort',
	          name: 'sort',
	          value: 1,
	          minValue: 1,
	          allowBlank: false
	    	}]
	<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
	      ,buttons: [
		      	{
			          text: 'Reset',
			          handler: function() {
			              addDataColumn();
			          }
			      },{
			          text: 'Submit',
			          formBind: true,
			          handler:function(){
										sessChecked();
	
			              formInputColumn.getForm().submit({ 
			                  method:'POST', 
			                  waitTitle:'Connecting', 
			                  waitMsg:'Sending data...',
			                  waitMsgTarget:true,
			                  success:function(form, action) {
			                  		Ext.Msg.alert('Success', 'Data Updated Successful');
			                  		addDataColumn();
			                      storeDataColumn.load();
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
		
		var viewportContentColumn = Ext.create('Ext.Panel', {
		    layout: 'border',
				border: false,
		    height: Ext.getBody().getViewSize().height-119,
		    items: [
<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
		    	formInputColumn,
<?php endif;?>
					gridDataColumn
		    ]
		});
		
		// ----------------- COLUMN HIGHLIGHTS ------------------- //
		
	  var tabs = Ext.create('Ext.tab.Panel', {
	      height: Ext.getBody().getViewSize().height-92,
	      activeTab: 0,
	      border: true,
	      plain: false,
	      tabPosition: 'top',
	      defaults :{
	          autoScroll: true,
	          bodyPadding: 0
	      },
	      items: [
				{
	          items: viewportContentColumn, 
	          title: 'Column Highlights'
	      },{
	          items: viewportContent, 
	          title: 'Financial Highlights'
	      }
	      ]
	  });
	  
		maincontent = viewport.getComponent(4);
		maincontent.add(tabs);
		if (maincontent.border) maincontent.border = false;
		maincontent.doLayout();
		
		Ext.EventManager.onWindowResize(function () {
				tabs.setSize(undefined, Ext.getBody().getViewSize().height-92);
				viewportContent.setSize(undefined, Ext.getBody().getViewSize().height-119);
				viewportContentColumn.setSize(undefined, Ext.getBody().getViewSize().height-119);
	  });
});
</script>

<style type="text/css">
.x-action-col-cell img.pdf-col {
    background-image: url('/assets/grid-icons/pdf.png');
}
.x-ie6 .x-action-col-cell img.pdf-col {
    background-image: url('/assets/grid-icons/pdf.png');
}
</style>