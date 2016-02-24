<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){			
    var itemsPerPage 	= 100;
	var curDate 			= '<?=date("Y-m-d")?>';
	  	  
	function addData() {     
	    sessChecked();
	      
	    formInput.getForm().reset();
	    formInput.setTitle('Add New Menu');
	      
        formInput.getForm().loadRecord(Ext.create('modelData', {
		        'id'    		: '',
		        'publish'    	: 1,
		        'show_judul'    : 1,
		        'id_main'    	: 0,
		        'status_sort'	: 1
		}));
		    
	    storeMainMenu.load();
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
		function renderPublish(val) {
	      if (val == "1") return "<img src="+base_url+"assets/grid-icons/tick.png width=14 height=14/>";
	      return "<img src="+base_url+"assets/grid-icons/cross.png width=14 height=14/>";
	  }
	  
	  function renderTick(val) {
	      if (val == "") return "<img src="+base_url+"assets/grid-icons/cross.png width=14 height=14/>";
	      return "<img src="+base_url+"assets/grid-icons/tick.png width=14 height=14/>";
	  }
	  
		Ext.define('modelData', {
		    extend: 'Ext.data.Model',
		    fields: ['url','show_judul','id','id_main','judul_id','judul_menu_id','judul_url_id','judul_en','judul_menu_en','judul_url_en','pdf_id','pdf_en','isi_id','isi_en','status_sort','tanggal','publish']
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
		    fields: ['id','judul_menu_id'],
		    proxy: {
			      type: 'ajax',
			      url: mod_url + '&m=jsonmainmenu',
			      reader: {type:'json'}
		    }
		});
				
		var gridData = Ext.create('Ext.grid.Panel', {
		    store: storeData,
		    width: '100%',
		    title: 'Investor Relation Menu Management',
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
		    	{
            text: 'INDONESIA',
            columns: [
							{text:'Menu', dataIndex:'judul_menu_id', sortable: false, width:150},
		    			{text:'Judul', dataIndex:'judul_id', sortable: false, width:150},
							{
					    		xtype: "actioncolumn", 
					    		header:'PDF',
					    		align:'center', 
					    		width:30,
					    		items: [
						    		{
		                    getClass: function(v, meta, rec) {
		                        if (rec.get('pdf_id') != "") {
		                            this.items[0].tooltip = 'View PDF File';
		                            return 'pdf-col';
		                        }
		                    },
		                    handler: function(grid, rowIndex, colIndex) {
		                        var rec = gridData.getStore().getAt(rowIndex);
		                        if (rec.get("pdf_id") != "") window.open('<?=STATIC_URL?>pdf/investor/'+rec.get("pdf_id"));
		                    }
				          	}
			          	]
							}
            ]
          },{
            text: 'ENGLISH',
            columns: [
							{text:'Menu', dataIndex:'judul_menu_en', sortable: false, width:150},
		    			{text:'Judul', dataIndex:'judul_en', sortable: false, width:150},
							{
					    		xtype: "actioncolumn", 
					    		header:'PDF',
					    		align:'center', 
					    		width:30,
					    		items: [
						    		{
		                    getClass: function(v, meta, rec) {
		                        if (rec.get('pdf_en') != "") {
		                            this.items[0].tooltip = 'View PDF File';
		                            return 'pdf-col';
		                        }
		                    },
		                    handler: function(grid, rowIndex, colIndex) {
		                        var rec = gridData.getStore().getAt(rowIndex);
		                        if (rec.get("pdf_en") != "") window.open('<?=STATIC_URL?>pdf/investor/'+rec.get("pdf_en"));
		                    }
				          	}
			          	]
		    			}
            ]
          },
		    	{text:'Sort', dataIndex:'status_sort', align:'center', sortable: false, width:30},
		    	{text:'Publish', dataIndex:'publish', align:'center', width:50, sortable: false, renderer:renderPublish},
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
	      title: 'Add New Menu',
	      region: 'east',
	      split: true,
				width: 400,
	      border: true,
	      bodyPadding: 10,
	      fieldDefaults: {labelWidth: 100, anchor: '100%'},
	      items: [{
	          xtype: 'hidden',
	          name: 'id'
				},{						
	          xtype:'fieldset',
	          title: 'Indonesia',
	          collapsible: false,
	          layout: 'anchor',
	          items: [{
					xtype: 'textfield',
					fieldLabel: 'Menu',
					name: 'judul_menu_id',
					allowBlank: false
				},{
					xtype: 'textfield',
					fieldLabel: 'Judul',
					name: 'judul_id',
					allowBlank: false
				},{
		            xtype: 'fileuploadfield',
		            fieldLabel: 'Upload PDF',
		            name: 'pdf_id_file',
		            buttonText: 'Browse'
		        },{
					xtype: 'textfield',
					fieldLabel: 'Default PDF',
					name: 'pdf_id'
				},{
					xtype: 'textarea',
					name: 'isi_id',
					hideLabel: true,
					anchor: '100%',
					height: 50
	          	}]
			},{						
	          xtype:'fieldset',
	          title: 'English',
	          collapsible: false,
	          layout: 'anchor',
	          items: [{
			          xtype: 'textfield',
			          fieldLabel: 'Menu',
			          name: 'judul_menu_en',
			          allowBlank: false
						},{
			          xtype: 'textfield',
			          fieldLabel: 'Judul',
			          name: 'judul_en',
			          allowBlank: false
						},{
		            xtype: 'fileuploadfield',
		            fieldLabel: 'Upload PDF',
		            name: 'pdf_en_file',
		            buttonText: 'Browse'
	          	},{
			          xtype: 'textfield',
			          fieldLabel: 'Default PDF',
			          name: 'pdf_en'
				},{
					xtype: 'textarea',
					name: 'isi_en',
					hideLabel: true,
					anchor: '100%',
					height: 50
	          }]
				},{
            xtype: 'combobox',
            fieldLabel: 'Parent Menu',
						name: 'id_main',
						store: storeMainMenu,
						queryMode: 'local',
						emptyText: '',
						forceSelection: true,
						triggerAction: 'all',
						valueField: 'id',
						displayField: 'judul_menu_id',
						allowBlank: false
	    },{
		        xtype: 'radiogroup',
		        allowBlank: false,
		        fieldLabel: 'Show Judul',
		        items: [
		            {boxLabel: 'Yes', name: 'show_judul', inputValue: 1},
		            {boxLabel: 'No', name: 'show_judul', inputValue: 0}
		        ]
        },{
	          xtype: 'numberfield',
	          fieldLabel: 'Sort',
	          name: 'status_sort',
	          value: 1,
	          minValue: 1,
	          allowBlank: false
        },{
                xtype: 'textfield',
                fieldLabel: 'URL',
                name: 'url'
        },{
		        xtype: 'radiogroup',
		        allowBlank: false,
		        fieldLabel: 'Publish',
		        items: [
		            {boxLabel: 'Yes', name: 'publish', inputValue: 1},
		            {boxLabel: 'No', name: 'publish', inputValue: 0}
		        ]
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
			          formBind: false,
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
		    items: [
<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
		    	formInput,
<?php endif;?>
					gridData
		    ],
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

<style type="text/css">
.x-action-col-cell img.pdf-col {
    background-image: url('/assets/grid-icons/pdf.png');
}
.x-ie6 .x-action-col-cell img.pdf-col {
    background-image: url('/assets/grid-icons/pdf.png');
}
</style>