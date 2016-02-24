<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){		
		var itemsPerPage = 50;
		var curDate = '<?=date("Y-m-d")?>';
		var winForm, activeForm;
	  	   
		Ext.define('modelFormbanner', {
		    extend: 'Ext.data.Model',
		    fields: ['id','nama','banner','idbanner','bannerid','alternatif','link','linkalternatif','tinggi','lebar']
		});
		Ext.define('modelForm', {
		    extend: 'Ext.data.Model',
		    fields: ['s_id','bannerid','idpos','idbanner','bannerid','id','tanggal','keterangan','nama','banner','alternatif','link','linkalternatif','tinggi','lebar']
		});
		var storebanner = Ext.create('Ext.data.Store', {
		    model: modelForm,
		    autoLoad: false,
		    autoDestroy: true,
		    proxy: {
		        type: 'ajax',
		        url : mod_url + '&m=bannershow',
		        reader: { type: 'json' }
		    }
		});		  
		
	  function addData() {     
	  		sessChecked();
				Ext.define('modelForm', {
				    extend: 'Ext.data.Model',
				    fields: ['s_id','bannerid','idpos','idbanner','bannerid','id','tanggal','keterangan','nama','banner','alternatif','link','linkalternatif','tinggi','lebar']
				});	  		
				var storebannerpopup = Ext.create('Ext.data.Store', {
				    model: modelForm,
				    autoLoad: false,
				    autoDestroy: true,
				    proxy: {
				        type: 'ajax',
				        url : mod_url + '&m=bannersetupshow',
				        reader: { type: 'json' }
				    }
				});		 
				var combo_banner = Ext.create("Ext.data.Store", {
				    model: "modelFormbanner",
				    autoLoad: true,
				    pageSize: 1000,
				    proxy: {
				        type: "ajax",		        
				        //url : base_url+"sinopsis/jsoncategory",
				       	url: mod_url+'&m=jsonbanner',
				        simpleSortMode: true,
				        reader: {
				            type: "json",
				            root: "rows",
				            totalProperty: "results"
				        } 
				    }
				});  					  		
			  var formInputAdd = Ext.create('Ext.form.Panel', {
			    	url: mod_url+'&m=submitdata',		
			      border: false,
			      bodyPadding: 10,
			      autoScroll: true,
			      fieldDefaults: {labelAlign: 'left', labelWidth: 180},
			      defaults: {margins: '0 0 5 0'},
			      items: [{
			          xtype: 'hidden',
			          name: 's_id'
						},					
						{
			          xtype: 'textfield',
			          fieldLabel: 'Nama Posisi Banner',
			          name: 'keterangan',
			          id: 'keterangan',
			          anchor:'60%',
			          allowBlank: false
			      },
						{
				        xtype: 'combobox',
				        name: 'idbanner',
				        id: 'idbanner',
				        fieldLabel: 'Banner List',
				        displayField: 'nama',
				        valueField: 'id',
				        queryMode: 'local',
				        emptyText: '',
				        hideLabel: false,
				        margins: '0 6 0 0',
				        store: combo_banner,
				        flex: 1,
				        anchor:'80%',
				        allowBlank: false,
				        forceSelection: true,
						    listeners : {						    	
								    select: function(combo, record, index) {	
				    					storebannerpopup.getProxy().url = mod_url+'&m=bannershow&id='+combo.getValue();
							        storebannerpopup.load();				    
							        //alert(mod_url+'&m=bannershow&id='+combo.getValue());
								    }
								}				        
				    },
				    {xtype: 'dataview',
				            store: storebannerpopup,
				            tpl: [
							        '<tpl for="."><br/><br/>',
							        '<div class="thumb-wrap"" id="{id}">{nama}<br/><br/>',
							        '<div class="thumb"><img src="http://static.indosiar.com/banner/{banner}" title="{nama}"><br/>Banner Utama</div><hr>',
							        '<div class="thumb"><img src="http://static.indosiar.com/banner/{alternatif}" title="{nama}"><br/>Banner alternatif</div>',
							        '</div>',
							        '</tpl>',
				        			'<div class="x-clear"></div>'
				            ],
						        autoHeight:true,
						        multiSelect: true,
						        overClass:'x-view-over',
						        itemSelector:'div.thumb-wrap'				           		    	    		    
				    }    
				    ],
				    buttonAlign : 'center',
			      buttons: [{
			          text: 'Cancel',
			          handler: function() {
			              formInputAdd.getForm().reset();
			              this.up('window').hide();
			          }
			      }, {
			          text: 'Submit',
			          formBind: true,
			          handler:function(){
			              formInputAdd.getForm().submit({ 			              		
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
			  });
			  	  		
	      formInputAdd.getForm().reset();
				/*
				formInputAdd.getForm().loadRecord(Ext.create('modelForm', {							        
		        's_id'    		: '',
		        'nama'	: '',
		        'banner' 	: ''
		    }));
		    */      
	      activeForm = 'input';
		    
	      winForm = Ext.widget('window', {
			          title: 'Add Banner Setup',
			          closeAction: 'hide',
			          width: 850,
			          height: 500,
			          minHeight: 230,
			          layout: 'fit',
			          resizable: true,
			          modal: true,
			          items: formInputAdd,
								listeners: {
								          hide: function() {
								          this.destroy();
								          }			 
								}                  
				});
	      winForm.show();
	  }
	  
	  function editData(data_id) {	
	  		sessChecked();	
				Ext.define('modelForm', {
				    extend: 'Ext.data.Model',
				    fields: ['s_id','bannerid','idpos','id','idbanner','bannerid','tanggal','keterangan','nama','banner','alternatif','link','linkalternatif','tinggi','lebar']
				});	  		

				var combo_banner = Ext.create("Ext.data.Store", {
				    model: "modelFormbanner",
				    autoLoad: true,
				    pageSize: 500,
				    proxy: {
				        type: "ajax",		        
				        //url : base_url+"sinopsis/jsoncategory",
				       	url: mod_url+'&m=jsonbanner',
				        simpleSortMode: true,
				        reader: {
				            type: "json",
				            root: "rows",
				            totalProperty: "results"
				        } 
				    }
				});  								
								
				var storebannerpopup = Ext.create('Ext.data.Store', {
				    model: modelForm,
				    autoLoad: false,
				    autoDestroy: true,
				    proxy: {
				        type: 'ajax',
				        url : mod_url + '&m=bannersetupshow',
				        reader: { type: 'json' }
				    }
				});		 	  		
			  var formInputEdit = Ext.create('Ext.form.Panel', {
			    	url: mod_url+'&m=submitdata',		
			      border: false,
			      bodyPadding: 10,
			      autoScroll: true,
			      fieldDefaults: {labelAlign: 'left', labelWidth: 180},
			      defaults: {margins: '0 0 5 0'},
			      items: [{
			          xtype: 'hidden',
			          name: 's_id'
						},					
						{
			          xtype: 'textfield',
			          fieldLabel: 'Nama Posisi Banner',
			          name: 'keterangan',
			          id: 'keterangan',
			          anchor:'60%',
			          allowBlank: false
			      },
						{
				        xtype: 'combobox',
				        name: 'idbanner',
				        id: 'idbanner',
				        fieldLabel: 'Banner List',
				        displayField: 'nama',
				        valueField: 'idbanner',
				        queryMode: 'local',
				        emptyText: '',
				        anchor:'80%',
				        hideLabel: false,
				        margins: '0 6 0 0',
				        store: combo_banner,
				        flex: 1,
				        allowBlank: false,
				        forceSelection: true,
						    listeners : {						    	
								    select: function(combo, record, index) {	
				    					storebannerpopup.getProxy().url = mod_url+'&m=bannershow&id='+combo.getValue();
							        storebannerpopup.load();				    
							        //alert(mod_url+'&m=bannershow&id='+gridData.getStore().getAt(index).get("target"));
								    }
								}				        
				    },
				    {xtype: 'dataview',
				            store: storebannerpopup,
				            tpl: [
							        '<tpl for="."><br/><br/>',
							        '<div class="thumb-wrap"" id="{id}">{nama}<br/><br/>',
							        '<div class="thumb"><img src="http://static.indosiar.com/banner/{banner}" title="{nama}"><br/>Banner Utama</div><hr>',
							        '<div class="thumb"><img src="http://static.indosiar.com/banner/{alternatif}" title="{nama}"><br/>Banner alternatif</div>',
							        '</div>',
							        '</tpl>',
				        			'<div class="x-clear"></div>'
				            ],
						        autoHeight:true,
						        multiSelect: true,
						        overClass:'x-view-over',
						        itemSelector:'div.thumb-wrap'				           		    	    		    
				    }   
				    ],
				    buttonAlign : 'center',
			      buttons: [{
			          text: 'Cancel',
			          handler: function() {
			              formInputEdit.getForm().reset();
			              this.up('window').hide();
			          }
			      }, {
			          text: 'Submit',
			          formBind: true,
			          handler:function(){
			              formInputEdit.getForm().submit({ 			              		
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
			  });	  		
				var selection = gridData.getView().getSelectionModel().getSelection()[0];
				var tinggi="";
				var lebar="";
				var idbanner="";
		    if (selection) {
		          data_id = gridData.getSelectionModel().selected.items[0].data.id;
		          idbanner = gridData.getSelectionModel().selected.items[0].data.idbanner;		          
		          tinggi = gridData.getSelectionModel().selected.items[0].data.tinggi;
		          lebar = gridData.getSelectionModel().selected.items[0].data.lebar;
		    }	  	
				formInputEdit.getForm().reset();						   				
				var store = Ext.create('Ext.data.Store', {
				    model: 'modelForm',
				    proxy: {
						    type: 'ajax',
						    url: mod_url+'&m=jsonitemsetup&id='+ data_id,	
						    reader:{
						        type:'json'
						    }
				    },
				    autoLoad: true,
				    listeners: {
				        load: function() {
				            formInputEdit.getForm().loadRecord(store.data.first());
				      			combo_banner.getProxy().url = mod_url+'&m=jsonbanner&tinggi='+tinggi+'&lebar='+lebar;
			        			combo_banner.load();			
				    				storebannerpopup.getProxy().url = mod_url+'&m=bannershow&id='+idbanner;
							      storebannerpopup.load();				        			
				        }
				    }
				});
				
				activeForm = 'edit';
				
        winForm = Ext.widget('window', {
	              title: 'Edit Banner Setup',
	              closeAction: 'hide',
	              width: 850,
	              height: 500,
	              minHeight: 230,
	              layout: 'fit',
	              resizable: true,
	              modal: true,
	              items: formInputEdit,
								listeners: {
								          hide: function() {
								          this.destroy();
								          }			   
								}                    
        });
	      winForm.show();	      	      
		}

		//function untuk delete data//
		function deleteData() {
					sessChecked();
		      Ext.Msg.show({
		          title: 'Confirm',
		          msg: 'Delete Selected Data ?',
		          buttons: Ext.Msg.YESNO,
		          icon: Ext.Msg.QUESTION,
		          fn: function(btn) {
		              if (btn == 'yes') {
		                  var selection = gridData.getView().getSelectionModel().getSelection()[0];
		                  if (selection) {
				                  data = gridData.getSelectionModel().selected.items[0].data.id;
				                  Ext.Ajax.request({
				                      //url: base_url+'file/deletedata',
				                      url: mod_url+'&m=deletedatasetup',	
				                      method: 'POST',
				                      params: { postdata: data },
											        success: function(obj) {
											                Ext.MessageBox.alert('Success','Data was deleted');
											                storeData.remove(selection);
											        }
				                  });
		                  }
		              }
		          }
		      });
		}		
		//function untuk delete data//	
 
 		function searchBanner() {
				sessChecked();
				
				var keyword = Ext.getCmp("keyword").getValue();
				storeData.getProxy().url = mod_url + '&m=json&q='+keyword;
				storeData.load({params: {start: 0, limit: itemsPerPage, page: 1}});
		}
	        
		var storeData = Ext.create('Ext.data.Store', {
		    fields: ['s_id','bannerid','idbanner','idpos','id','tanggal','keterangan','nama','banner','alternatif','link','linkalternatif','tinggi','lebar'],
		    autoLoad: true,
		    pageSize: itemsPerPage,
		    proxy: {
		        type: 'ajax',
		        url : mod_url + '&m=jsonsetup',
		        simpleSortMode: true,
		        reader: {
		            type: 'json',
		            root: 'rows',
		            totalProperty: 'results'
		        }
		    }
		});

		var storebannergrid = Ext.create('Ext.data.Store', {
		    model: modelForm,
		    autoLoad: false,
		    autoDestroy: true,
		    proxy: {
		        type: 'ajax',
		        url : mod_url + '&m=bannershow',
		        reader: { type: 'json' }
		    }
		});
    		
	  var viewBanner = Ext.create('Ext.Panel', {
	      layout: {type: 'vbox', align: 'stretch'},
	      region: 'east',
	      title: 'Banner Preview',
	      split:true,
	      width: 400,
	      border: true,
	      bodyPadding: 7,
    
	      items: [
				Ext.create('Ext.view.View', {
            store: storebannergrid,
            tpl: [
			        '<tpl for=".">',
			        '<div class="thumb-wrap"" id="{id}">Nama: {nama} , tinggi:{tinggi} , lebar:{lebar}<br/><br/>',
			        '<div class="thumb"><img src="http://static.indosiar.com/banner/{banner}" title="{nama}"><br/>Banner Utama</div><hr>',
			        '<div class="thumb"><img src="http://static.indosiar.com/banner/{alternatif}" title="{nama}"><br/>Banner alternatif</div>',
			        '</div>',
			        '</tpl>',
        			'<div class="x-clear"></div>'
            ],
		        autoHeight:true,
		        multiSelect: true,
		        overClass:'x-view-over',
		        itemSelector:'div.thumb-wrap'
        })	      
	    	]
	  });	  
	  
		var gridData = Ext.create('Ext.grid.Panel', {
		    store: storeData,
		    region: 'center',
		    width: '100%',
		    //height: winHeight,
		    title: 'Setup Banner Position',
		    columnLines: true,
		    listeners : {
				    itemclick: function(dv, record, item, index, e) { 
    					storebannergrid.getProxy().url = mod_url+'&m=bannershow&id='+gridData.getStore().getAt(index).get("bannerid");
			        storebannergrid.load();				    
			        //alert(mod_url+'&m=bannershow&id='+gridData.getStore().getAt(index).get("id"));
				    },
				    itemdblclick: function(dv, record, item, index, e) { editData(gridData.getStore().getAt(index).get("id")) }
				},		    
		    columns: [    
					{text:'ID Position', dataIndex:'idpos', width:50},
		    	{text:'Nama Lokasi Banner', dataIndex:'keterangan', width:100},
		    	{text:'Banner Utama', dataIndex:'banner', width:200},
		    	{text:'Banner Alternatif', dataIndex:'alternatif', align:'center', width:150},
		    	{text:'Banner Link', dataIndex:'link', align:'center', width:100},
		    	{text:'Banner Link Alternatif', dataIndex:'linkalternatif', align:'center', width:100},
		    	{text:'Tinggi', dataIndex:'tinggi', align:'center', width:60},
		    	{text:'Lebar', dataIndex:'lebar', align:'center', width:60}
				],
				tbar: new Ext.Toolbar({
	          items: [
			          <?php
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
			          if (isset($modAuths['edit'])): ?>	          
			          {
			              itemId: 'edit',
			              text: 'Edit',
			              icon: base_url+'assets/grid-icons/edit.png',
			              disabled: true,
		                handler: editData
			          }, '-', 
					      <?php 
					      endif;		
					      if (isset($modAuths['delete'])):?>	    	          
/*			          {
			              itemId: 'delete',
			              text: 'Delete',
			              icon: base_url+'assets/grid-icons/delete.png',
			              disabled: true
			              ,handler: deleteData
			          },'-',	*/          
			          <?php endif; ?>					      						
			          {
										xtype: 'textfield',
										name: 'keyword',
										id: 'keyword',
										width: 200,
				            listeners: {
				                specialkey: function(field, e){
				                    if (e.getKey() == e.ENTER) searchBanner();
				                }
				            }
								},{
										xtype: 'button',
										text:'<b>Search</b>',
										waitMsg: 'searching...',
										iconCls: 'toolbar_btnsearch',
										handler: searchBanner
			          }
	          ]
				}),
				bbar: new Ext.PagingToolbar({
		        pageSize: itemsPerPage,
		        store: storeData,
		        displayInfo: true
	    	})
		});
	  
		/* -------------- FORM PANEL -------------- */
	  		
		var viewportContent = Ext.create('Ext.Panel', {
		    layout: 'border',
		    items: [
		    	viewBanner,
					gridData
		    ],
		    border: false,
			  height: Ext.getBody().getViewSize().height-92
		});

	  gridData.getSelectionModel().on('selectionchange', function(selModel, selections){
	  	var selection = gridData.getView().getSelectionModel().getSelection()[0];
	  	<?php if (isset($modAuths['edit'])):?>
	      gridData.down('#edit').setDisabled(selections.length === 0);
			<?php
				endif;
			 if (isset($modAuths['delete'])):?>		      
	      gridData.down('#delete').setDisabled(selections.length === 0);
	     <?php 
	     endif;
	     ?>       	      
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
/* Image Thumb List */
#images-view .x-panel-body, #images-view-parent .x-panel-body {
    background: white;
    font: 11px Arial, Helvetica, sans-serif;
}
#images-view .thumb, #images-view-parent .thumb{
    background: #dddddd;
    padding: 3px;
    padding-bottom: 0;
}

.x-quirks #images-view .thumb, .x-quirks #images-view-parent .thumb {
    padding-bottom: 3px;
}

#images-view .thumb img, #images-view-parent .thumb img{
    height: 90px;
    width: 120px;
}
#images-view .thumb-wrap, #images-view-parent .thumb-wrap{
    float: left;
    margin: 4px;
    margin-right: 0;
    padding: 5px;
}
#images-view .thumb-wrap span, #images-view-parent .thumb-wrap span {
    display: block;
    overflow: hidden;
    text-align: center;
    width: 120px; // for ie to ensure that the text is centered
}

#images-view .x-item-over, #images-view-parent .x-item-over{
    border:1px solid #dddddd;
    background: #efefef url('/assets/images/over.gif') repeat-x left top;
    padding: 4px;
}

#images-view .x-item-selected, #images-view-parent .x-item-selected{
    background: #eff5fb url('/assets/images/selected.gif') no-repeat right bottom;
    border:1px solid #99bbe8;
    padding: 4px;
}
#images-view .x-item-selected .thumb, #images-view-parent .x-item-selected .thumb{
    background:transparent;
}

#images-view .loading-indicator, #images-view-parent .loading-indicator {
    font-size:11px;
    background-image:url('/assets/extjs4/resources/themes/images/default/grid/loading.gif');
    background-repeat: no-repeat;
    background-position: left;
    padding-left:20px;
    margin:10px;
}

.x-view-selector {
    position:absolute;
    left:0;
    top:0;
    width:0;
    border:1px dotted;
    opacity: .5;
    -moz-opacity: .5;
    filter:alpha(opacity=50);
    zoom:1;
    background-color:#c3daf9;
    border-color:#3399bb;
}

.ext-strict .ext-ie .x-tree .x-panel-bwrap{
    position:relative;
    overflow:hidden;
}
</style>