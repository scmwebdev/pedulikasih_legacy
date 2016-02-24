<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){		
		var itemsPerPage = 100;
		var winIcon;

	  function addData() {     
	      sessChecked();
	      
	      formInput.getForm().reset();
	      formInput.setTitle('Add Menu');
				formInput.getForm().loadRecord(Ext.create('modelData', {							        
		        id:'',parent:0,modtype:'LEFT_TREE_PANEL',menutype:'NODE',sort:0,separator:0
		    }));
	  }
	  
	  function editData(data_id) {
				sessChecked();
				
				formInput.getForm().reset();
				formInput.setTitle('Edit Menu');
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
		}
		
	  function showIconList() {			    
		    var store = Ext.create('Ext.data.Store', {
		        fields: ['name','filename'],
		        proxy: {
		            type: 'ajax',
		            url: mod_url + '&m=jsonicon',
		            reader: {
		                type: 'json',
		                root: 'images'
		            }
		        }
		    });
		    
				var grid = Ext.create('Ext.grid.Panel', {
				    store: store,
				    width: '100%',
				    columnLines: true,
				    columns: [
					    	{text:'Name', dataIndex:'name', align:'center', width:200},
					    	{
					    			text:'Icon', 
					    			dataIndex:'filename', 
					    			align:'center', 
					    			width:40, 
					    			renderer: function(val, meta, rec) {
												if (val == "") return "";
		    								return "<img src="+base_url+"assets/images/icons/"+val+" width=14 height=14/>";
					    			}
								}
						]
			      ,tbar: new Ext.Toolbar({
			          items: [
										{
					              itemId: 'select',
					              text: 'Select',
					              icon: base_url+'assets/grid-icons/add.png',
					              disabled: true,
					              handler: function(){
														Ext.getCmp('iconcls').setValue(grid.getSelectionModel().selected.items[0].data.name);
			          						winIcon.hide();
					              }
										}
			          ]
						})
			      ,listeners: {
			          selectionchange: function(dv, nodes){
										var selection = grid.getSelectionModel().getSelection()[0];
							      if (selection)
					              grid.down('#select').setDisabled(nodes.length === 0);
							      else
												grid.down('#select').setDisabled(nodes.length === 0);
			          },
			          itemdblclick: function(dv, record, item, index, e) {
			          		Ext.getCmp('iconcls').setValue(grid.getSelectionModel().selected.items[0].data.name);
			          		winIcon.hide();
								}
			      }
				});
				
		    store.load();
		    
	      winIcon = Ext.create('Ext.window.Window', {
	          title: 'Icon List',
	          closeAction: 'hide',
	          width: 280,
	          height: 500,
	          minHeight: 500,
	          layout: 'fit',
	          resizable: true,
	          modal: true,
	          items: grid,
	          listeners: {
	          		hide: function() {
	          				this.destroy();
	          		}
	          }
				});
						
				winIcon.show();
	  }
	  
		/* -------------- GRID PANEL -------------- */    
	 	function renderIcon(val, meta, rec) {
		    if (val == "") return "";
		    return "<img src="+base_url+"assets/images/icons/"+val+".png width=14 height=14/>";
		}
		
		function renderPublish(val) {
		      if (val == "1") return "<img src="+base_url+"assets/grid-icons/tick.png width=14 height=14/>";
		      return "<img src="+base_url+"assets/grid-icons/cross.png width=14 height=14/>";
		  }
		  
		Ext.define('modelData', {
		    extend: 'Ext.data.Model',
		    fields: ['id','id_label','name','title','iconcls','desc','parent','sort','folder','controller','method','params','url','modtype','menutype','auth','status','separator','key_name','left_comp','right_comp']
		});
	        
		var storeData = Ext.create('Ext.data.Store', {
		    model: 'modelData',
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
	      region: 'center',
		    store: storeData,
		    title: 'Menu Management',
		    width: '100%',
		    columnLines: true,
		    columns: [
			    	{text:'ID', dataIndex:'id', align:'center', width:30},
			    	{text:'Parent', dataIndex:'parent', align:'center', width:40},
			    	{text:'Title', dataIndex:'title', align:'left', width:180},
			    	{text:'Icon', dataIndex:'iconcls', align:'center', width:30, renderer:renderIcon},
			    	{text:'Folder', dataIndex:'folder', align:'center', width:70},
			    	{text:'Controller', dataIndex:'controller', align:'center', width:100},
			    	{text:'Mod Type', dataIndex:'modtype', align:'center', width:120},
			    	{text:'Menu Type', dataIndex:'menutype', align:'center', width:70},
			    	{text:'Auth', dataIndex:'auth', align:'center', width:150},
			    	{text:'Publish', dataIndex:'status', align:'center', width:45, renderer:renderPublish},
			    	{text:'Sort', dataIndex:'sort', align:'center', width:30},
			    	{
			          xtype: "actioncolumn",
			          width: 90,
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
					          if (isset($modAuths['publish'])):
					          ?>
					          {
					              getClass: function(v, meta, rec) {
					                  if (rec.get("status") == "1") {
					                      this.items[1].tooltip = "Set to Unpublish";
					                      return "set-unpublish";
					                  } else {
					                      this.items[1].tooltip = "Set to Publish";
					                      return "set-publish";
					                  }
					              },
					              handler: function(grid, rowIndex, colIndex) {
					                  sessChecked();
					                  var rec = grid.getStore().getAt(rowIndex);
					                  var jenis = (rec.get("status") == "1") ? 0 : 1;
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
	      viewConfig: {
	          forceFit: true
	      }
	      ,tbar: new Ext.Toolbar({
	          items: [
								<?php if (isset($modAuths['add'])):?>
								{
			              itemId: 'add',
			              text: 'Add Menu',
			              icon: base_url+'assets/grid-icons/add.png',
			              handler: addData
								}
								<?php endif;?>
	          ]
				})
				,bbar: new Ext.PagingToolbar({
		        pageSize: itemsPerPage,
		        store: storeData,
		        displayInfo: true
	    	})
		});
		
		gridData.getSelectionModel().on('selectionchange', function(sm, selectedRecord) {
		    if (selectedRecord.length) {
		    		editData(selectedRecord[0].data.id)
		    }
		});
	
	  var formInput = Ext.create('Ext.form.Panel', {
	  		url: mod_url + '&m=submitdata',
	      layout: {type: 'vbox', align: 'stretch'},
	      region: 'east',
	      title: 'Add Menu',
	      split:true,
	      width: 300,
	      border: true,
	      bodyPadding: 7,
	      fieldDefaults: {labelWidth: 70},
	      items: [{
	          xtype: 'hidden',
	          name: 'id'
				},{
	          xtype: 'displayfield',
	          fieldLabel: 'ID',
	          name: 'id_label'
				},{
	          xtype: 'numberfield',
	          fieldLabel: 'Parent ID',
	          name: 'parent',
	          allowBlank: false
				},{
	          xtype: 'textfield',
	          fieldLabel: 'Menu Title',
	          name: 'title',
	          allowBlank: false
	      },{
	          xtype: 'textfield',
	          fieldLabel: 'Menu Desc.',
	          name: 'desc'
        },{
	          xtype: 'fieldcontainer',
	          layout: 'hbox',
	          items: [
		          	{xtype:'textfield', name:'iconcls', id:'iconcls', fieldLabel: 'Icon', labelWidth: 70, flex:1},
		          	{xtype:'button', text:'List', margins:'0 0 0 5', handler:showIconList}
	          ]
        },{
	          xtype: 'textfield',
	          fieldLabel: 'Folder',
	          name: 'folder'
        },{
	          xtype: 'textfield',
	          fieldLabel: 'Controller',
	          name: 'controller'
	      },{
						xtype: 'combo',
						mode: 'local',
						fieldLabel: 'Mod Type',
						name: 'modtype',
						id: 'modtype',
						store: new Ext.data.SimpleStore({
						    fields: ['id', 'name'],
						    data: [
						        ['LEFT_TREE_PANEL', 'LEFT_TREE_PANEL'],
						        ['TOP_MENU_BAR', 'TOP_MENU_BAR'],
						        ['', '-- NULL --']
						    ]
						}),
						displayField: 'name',
						valueField: 'id',
						value: 'LEFT_TREE_PANEL'
	      },{
						xtype: 'combo',
						mode: 'local',
						fieldLabel: 'Menu Type',
						name: 'menutype',
						id: 'menutype',
						store: new Ext.data.SimpleStore({
						    fields: ['id', 'name'],
						    data: [
						        ['NODE', 'NODE'],
						        ['PARENT', 'PARENT'],
						        ['', '-- NULL --']
						    ]
						}),
						displayField: 'name',
						valueField: 'id',
						value: 'NODE'
				},{
	          xtype: 'textfield',
	          fieldLabel: 'Auth',
	          name: 'auth'
	      },{
	          xtype: 'textfield',
	          fieldLabel: 'Key Name',
	          name: 'key_name'
	      },{
	          xtype: 'numberfield',
	          fieldLabel: 'Sort',
	          name: 'sort',
	          value: 0,
	          minValue: 0,
	          allowBlank: false
        },{
            xtype: 'radiogroup',
            fieldLabel: 'Separator',
            allowBlank: false,
            items: [
                {boxLabel: 'Yes', name: 'separator', inputValue: 1},
                {boxLabel: 'No', name: 'separator', inputValue: 0, checked: true}
            ]
	    	}],
	      buttons: [{
	          text: 'Reset',
	          handler: function() {
	              formInput.getForm().reset();
	              formInput.setTitle('Add Bio Actress');
	          }
	      }, {
	          text: 'Submit',
	          formBind: true,
	          handler:function(){
	              formInput.getForm().submit({ 
	                  method:'POST', 
	                  waitTitle:'Connecting', 
	                  waitMsg:'Sending data...',
	                  waitMsgTarget:true,
	
	                  success:function(form, action) {
	                  		Ext.Msg.alert('Success', 'Data Updated Successful');
	                      storeData.load();
	                      addData();
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
	      }]
	  });
	  
		var viewportContent = Ext.create('Ext.Panel', {
		    layout: 'border',
		    items: [gridData,formInput],
		    border: false,
			  height: Ext.getBody().getViewSize().height-92
		});
		
		maincontent = viewport.getComponent(4);
		maincontent.add(viewportContent);
		if (maincontent.border) maincontent.border = false;
		maincontent.doLayout();
		
		Ext.EventManager.onWindowResize(function () {
				viewportContent.setSize(undefined, Ext.getBody().getViewSize().height-92);
	  });
});
</script>