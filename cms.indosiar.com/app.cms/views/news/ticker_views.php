<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){			
    var itemsPerPage 	= 50;
	var curDate 	    = '<?=date("Y-m-d")?>';
    var tplx = new Ext.XTemplate(
            '<tpl for=".">',
                '<table width="100%" cellpadding="3" cellspacing="0">',
                    '<tr>',
                        '<td class="rL">Kategori:</td>',
                        '<td class="rV">{kategori}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Judul:</td>',
                        '<td class="rV">{judul}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Isi Ticker:</td>',
                        '<td class="rV">{isi}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Tgl. Buat:</td>',
                        '<td class="rV">{create_date}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Nama Pembuat:</td>',
                        '<td colspan="3" class="rV">{create_by}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Tgl. Ubah:</td>',
                        '<td class="rV">{update_date}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Nama Pengubah:</td>',
                        '<td class="rV">{update_by}</td>',
                    '</tr>',
                '</table>',
            '</tpl>'
        );
        
	function addData() {     
	    sessChecked();
	    
	    formInput.getForm().reset();
	    formInput.setTitle('Add New Ticker');
	      
        formInput.getForm().loadRecord(Ext.create('modelData', {
		    'id'		: '',
		    'publish'	: 1,
		    'sort'	    : 1,
		    'kategori'  : 'POLITIK'
        }));
    }
	  
    function editData(data_id) {
	    sessChecked();
				
		formInput.getForm().reset();
		formInput.setTitle('Edit Ticker');
		
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
	  
	  function generateData() {
	      Ext.Msg.show({
	          title: 'Confirm',
	          msg: 'Apakah Anda setuju untuk mengirim data-data ini ke News Ticker ?',
	          buttons: Ext.Msg.YESNO,
	          fn: function(btn) {
                    if (btn == 'yes') {
    	                Ext.Ajax.request({
    	                    //url: 'http://devil.cms.scm.co.id/newsticker/indosiar_ticker.php',
    	                    url: mod_url + '&m=generatedata',
			                method: 'POST',
			                params: { postdata: 'generate' },
    				        success: function(obj) {
    				            var resp = obj.responseText;
    				            if (resp != 0) {
    				                Ext.MessageBox.alert('Failed', resp);
    				            } else {
    				                Ext.MessageBox.alert('Success','Data sudah terkirim');
    				                storeData.load();
    				            }
    				        }
    	                });
	                }
	          }
	      });
	  }
	  
    function logData(data_id) {
        var store = Ext.create('Ext.data.Store', {
            model: 'modelData',
            proxy: {
                    type: 'ajax',
                    reader:{
                        type:'json'
                    }
            },
            autoLoad: false
        });

        tpl = tplx;

        winDetail = Ext.widget('window', {
            title: 'Ticker Log',
            closeAction: 'hide',
            width: 640,
            height: 210,
            layout: 'fit',
            resizable: true,
            modal: true,
            items: new Ext.DataView({
                store: store,
                tpl: tpl,
                autoHeight:true,
                multiSelect: true,
                overClass:'x-view-over',
                itemSelector:'div.thumb-wrap',
                emptyText: '<p align="center">No data to display</p>'
            }),
            listeners: {
                  hide: function() {
                      this.destroy();
                }
            }
        });
        winDetail.show();

        store.getProxy().url = mod_url + '&m=jsonitem&data_id=' + data_id;
        store.load();
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
	  
	function renderTick(val) {
	    if (val == "") return "<img src="+base_url+"assets/grid-icons/cross.png width=14 height=14/>";
	    return "<img src="+base_url+"assets/grid-icons/tick.png width=14 height=14/>";
    }

	function searchArtikel() {
			sessChecked();
			
			var keyword = Ext.getCmp("keyword").getValue();
			var jenisid = Ext.getCmp("jenis_id").getValue();
			
			storeData.getProxy().url = mod_url + '&m=json&jenisid='+ jenisid + '&q='+keyword;
			storeData.load({params: {start: 0, limit: itemsPerPage, page: 1}});
	}
		
	Ext.define('modelData', {
	    extend: 'Ext.data.Model',
	    fields: ['id','isi','judul','kategori','tanggal','publish','sort','create_by','create_date','update_by','update_date']
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

	var storeKategori = new Ext.data.SimpleStore({
	    fields: ['id', 'name'],
	    data: [
	        ['POLITIK', 'POLITIK'],
	        ['EKONOMI', 'EKONOMI'],
	        ['SOSIAL', 'SOSIAL'],
	        ['BUDAYA', 'BUDAYA'],
	        ['HUKUM', 'HUKUM'],
	        ['SPORT', 'SPORT'],
	        ['KRIMINAL', 'KRIMINAL'],
			['INTERNASIONAL', 'INTERNASIONAL'],
	        ['KESEHATAN', 'KESEHATAN'],
	        ['BENCANA', 'BENCANA'],
		['PILPRES', 'PILPRES']
	    ]
	});
            						
		var gridData = Ext.create('Ext.grid.Panel', {
		    store: storeData,
		    width: '100%',
		    title: 'News Ticker Management',
		    region: 'center',
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
				{text:'Urut', dataIndex:'sort', sortable: false, width:30, align:'center'},
				{text:'Kategori', dataIndex:'kategori', sortable: false, width:70, align:'center'},
    			{text:'Judul', dataIndex:'judul', sortable: false, width:200},
    			{text:'Isi', dataIndex:'isi', sortable: false, flex: 1, width:350},
    			{text:'Tanggal', dataIndex:'tanggal', align:'center', sortable: false, width:120},
		    	{text:'Publish', dataIndex:'publish', align:'center', width:50, sortable: false, renderer:renderPublish},
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
			          },
			          <?php endif;?>
			          {
			              icon   : base_url + 'assets/grid-icons/eye.png',
                          tooltip: 'View Log',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridData.getStore().getAt(rowIndex);
			                  logData(rec.get("id"));
			              }
			          },
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
                    ,'-',
						<?php 
						endif;
						if (isset($modAuths['generate'])):
						?>
					{
    		              itemId: 'generate',
    		              text: 'Generate',
    		              icon: base_url+'assets/grid-icons/lightning.png',
    		              handler: generateData
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
    						name: 'kategori',
    						id: 'jenis_id',
            				store: storeKategori,
            				displayField: 'name',
            				valueField: 'id',
    						emptyText: '',
    						forceSelection: true,
    						triggerAction: 'all',
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
  
		/* -------------- FORM PANEL -------------- */			
    var formInput = Ext.create('Ext.form.Panel', {
	    url: mod_url + '&m=submitdata',
        layout: {type: 'vbox', align: 'stretch'},
        title: 'Add New Ticker',
        region: 'south',
        split: true,
        height: 200,
        border: true,
        bodyPadding: 10,
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
    				xtype: 'combo',
    				flex: 1,
    				mode: 'local',
    				fieldLabel: '* Kategori',
    				name: 'kategori',
    				store: storeKategori,
    				displayField: 'name',
    				valueField: 'id',
    				value: 'POLITIK'
        		},{
    		        xtype: 'radiogroup',
    		        allowBlank: false,
    		        fieldLabel: '* Publish',
    		        width: 200,
                    margins: '0 0 0 10',
    		        items: [
    		            {boxLabel: 'Yes', name: 'publish', inputValue: 1},
    		            {boxLabel: 'No', name: 'publish', inputValue: 0}
    		        ]
                }]
			},{
                xtype: 'fieldcontainer',
                layout: 'hbox',
                defaults: {margins: '0'},
                fieldDefaults: {labelWidth: 100},
                items: [{
    				flex: 1,
                    xtype: 'textfield',
                    fieldLabel: '* Judul',
                    name: 'judul',
                    allowBlank: false
        		},{
    				fieldLabel: '* No. Urut', xtype: 'numberfield', name: 'sort', width: 40, maxValue: 50, minValue: 1, value: 1, allowBlank: false, width: 200, margins: '0 0 0 10'
                }]
			},{
				xtype: 'textfield',
			    fieldLabel: '* Isi Ticker',
			    anchor: '100%',
			    name: 'isi',
			    id: 'isi',
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
                formBind: false,
                handler: function(){
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
	                failure: function(form, action){
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
.rL {padding:5px;background:#D9E5F3;border-bottom:1px solid #fff;width:150px;font-weight:bold;}
.rV {padding:5px;background:#EEEEEF;border-bottom:1px solid #fff;}
.rK {padding:5px;background:#EEEEEF;border-bottom:1px solid #fff;}
</style>
