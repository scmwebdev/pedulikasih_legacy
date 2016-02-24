<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){			
		var itemsPerPage 	= 100;
		var curDate 			= '<?=date("Y-m-d")?>';
	  	  
	  function addData() {     
	      sessChecked();
	      
	      formInput.getForm().reset();
	      formInput.setTitle('Add Promo');
	      
				formInput.getForm().loadRecord(Ext.create('modelData', {
		        'promo_id'    		: '',
		        'promo_publish'    		: 1
		    }));
	  }
	  
	  function editData(data_id) {		
				sessChecked();
				
				formInput.getForm().reset();
				formInput.setTitle('Edit Promo');
				
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
							      		for (i = 0; i < selection.length; ++i) data = data + gridData.getSelectionModel().selected.items[i].data.promo_id + "|";
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
			                  
			                  //strUsers.load();
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
							      		for (i = 0; i < selection.length; ++i) data = data + gridData.getSelectionModel().selected.items[i].data.promo_id + "|";
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
			                  
			                  //strUsers.load();
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
		    fields: ['promo_id','promo_judul','promo_slug','promo_ringkasan','promo_isi','promo_image','promo_video','promo_publish','promo_tanggal']
		});
	        
		var storeData = Ext.create('Ext.data.Store', {
		    model: 'modelData',
		    autoLoad: true,
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
		    width: '100%',
		    title: 'Promo',
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
				    itemdblclick: function(dv, record, item, index, e) { editData(gridData.getStore().getAt(index).get("promo_id")) }
				},
				<?php endif;?>
		    columns: [    
		    	{text:'Promo', dataIndex:'promo_judul', width:200},
		    	{
			    		xtype: "actioncolumn", 
			    		header:'Image',
			    		align:'center', 
			    		width:40,
			    		items: [
				    		{
                    getClass: function(v, meta, rec) {
                        if (rec.get('promo_image') != "") {
                            this.items[0].tooltip = 'View Image File';
                            return 'image-col';
                        }
                    },
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = gridData.getStore().getAt(rowIndex);
                        if (rec.get("promo_image") != "") window.open('<?=STATIC_URL?>images/promo/'+rec.get("promo_image"));
                    }
		          	}
	          	]
		    	},
		    	{
			    		xtype: "actioncolumn",
			    		header:'Video',
			    		align:'center', 
			    		width:40,
			    		items: [
				    		{
                    getClass: function(v, meta, rec) {
                        if (rec.get('promo_video') != "") {
                            this.items[0].tooltip = 'View Video File';
                            return 'video-col';
                        }
                    },
                    handler: function(grid, rowIndex, colIndex) {
                        var rec = gridData.getStore().getAt(rowIndex);
                        if (rec.get("promo_video") != "") window.open('<?=STATIC_URL?>video/promo/'+rec.get("promo_video"));
                    }
		          	}
	          	]
		    	},
		    	{text:'Publish', dataIndex:'promo_publish', align:'center', width:50, renderer:renderPublish},
		    	{
	          xtype: "actioncolumn",
	          width: 102,
	          align: "center",
	          items: [
			          {
			              icon   : base_url + 'assets/grid-icons/eye.png',
										tooltip: 'Preview Data',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridData.getStore().getAt(rowIndex);
			                  window.open('http://www.indosiar.com/promo/'+rec.get("promo_slug")+'.html');
			              }
			          },
			          <?php if (isset($modAuths['edit'])):?>
			          {
			              icon   : base_url + 'assets/grid-icons/application_edit.png',
										tooltip: 'Edit Data',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridData.getStore().getAt(rowIndex);
			                  editData(rec.get("promo_id"));
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
									                      params: { postdata: rec.get("promo_id") },
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
						},'-'
						<?php 
						endif;
						if (isset($modAuths['add'])):
						?>
						,{
	              itemId: 'add',
	              text: 'Add',
	              tooltip: 'Add Data',
	              icon: base_url+'assets/grid-icons/add.png',
	              handler: addData
						}
						<?php endif;?>
	          ]
				}),
				bbar: new Ext.PagingToolbar({
		        pageSize: itemsPerPage,
		        store: storeData,
		        displayInfo: true,
		        emptyMsg: 'No data to display'
	    	})
		});
  
		/* -------------- FORM PANEL -------------- */			
	  var formInput = Ext.create('Ext.form.Panel', {
	  		url: mod_url + '&m=submitdata',
	      layout: {type: 'vbox', align: 'stretch'},
	      title: 'Add Promo',
	      region: 'east',
	      split: true,
				width: 450,
	      border: true,
	      bodyPadding: 10,
	      fieldDefaults: {labelWidth: 90},
	      items: [{
	          xtype: 'hidden',
	          name: 'promo_id'
				},{
	          xtype: 'textfield',
	          fieldLabel: 'Judul Promo',
	          name: 'promo_judul',
	          allowBlank: false
				},{					          
						xtype: 'textarea',
						labelAlign: 'top',
	          fieldLabel: 'Ringkasan',
	          maxLength: 300,
	          height: 80,
	          anchor: '100%',
	          enforceMaxLength: true,
	          name: 'promo_ringkasan',
	          id: 'promo_ringkasan',
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
        	 	id: 'charcount',
        	 	name: 'charcount',
        	 	height: 20	
				},{         
						xtype: 'tinymcefield',
	          name: 'promo_isi',
	          hideLabel: true,
						anchor: '100%',
						height: Ext.getBody().getViewSize().height-450,
						tinymceConfig: {
								theme_advanced_buttons1: "fullscreen,|,bold,italic,underline,strikethrough,sub,sup,forecolor,|,bullist,numlist,|,outdent,indent,|,tablecontrols",
								theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,undo,redo,|,blockquote,hr,link,unlink,|,image,insertimage,media,charmap,|,code,preview,cleanup,removeformat",
								theme_advanced_buttons3: "",
								theme_advanced_buttons4: "",
							  extended_valid_elements: "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
								skin: 'o2k7'
						}	
				},{
		        xtype: 'radiogroup',
		        allowBlank: false,
		        fieldLabel: 'Publish',
		        items: [
		            {boxLabel: 'Yes', name: 'promo_publish', inputValue: 1},
		            {boxLabel: 'No', name: 'promo_publish', inputValue: 0}
		        ]
				},{
            xtype: 'fileuploadfield',
            fieldLabel: 'Upload Image',
            name: 'promo_image_file',
            emptyText: 'max width 900 pixel',
            buttonText: 'Browse'
				},{
	          xtype: 'textfield',
	          fieldLabel: 'Default Image',
	          name: 'promo_image'
				},{
            xtype: 'fileuploadfield',
            fieldLabel: 'Upload Video',
            name: 'promo_video_file',
            //emptyText: '260 x 180 pixel',
            buttonText: 'Browse'
				},{
	          xtype: 'textfield',
	          fieldLabel: 'Default Video',
	          name: 'promo_video'
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
.errBG .x-grid-cell {background-color: #FFCC00;}

.search-item {
    padding: 5px 10px;
    white-space: normal;
    color: #555;
}

.search-item h3 {
    display: block;
    font: inherit;
    font-weight: bold;
    color: #222;
}

.search-item h3 span {
    float: right;
    font-weight: normal;
    margin:0 0 5px 5px;
    width: 150px;
    clear: none;
}

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