<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){	
		var itemsPerPage = 50;

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
										                storeData.remove(selection);
										                //storeDataJenis.load();
										            }
										        }
			                  });
	                  }
	              }
	          }
	      });
	  }
	  
		/* -------------- GRID PANEL -------------- */    
			
		Ext.define('modelData', {
		    extend: 'Ext.data.Model',
		    fields: ['id','tanggal','id_artikel','kategori','jenis','nama','email','komentar','ip','judul','jenis_judul']
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
		    store: storeData,
		    title: 'Komentar Artikel',
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
		    columns: [
		    	{text:'Tanggal', dataIndex:'tanggal', align:'center', width:130},
		    	{text:'Nama', dataIndex:'nama', width:120},
		    	{text:'Email', dataIndex:'email', width:180}
				],
	      viewConfig: {
	          forceFit: true
	      },
	      split: true,
	      region: 'west',
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
						?>
						{
								xtype: 'textfield',
								name: 'keyword',
								id: 'keyword',
								width: 200
						},{
								xtype: 'button',
								text: '<b>Search</b>',
								iconCls: 'toolbar_btnsearch',
								waitMsg: 'searching...',
								handler: function(){
										sessChecked();
								    var keyword = Ext.getCmp("keyword").getValue();
								    storeData.getProxy().url = mod_url + '&m=json'+'&q='+keyword;
								  	storeData.load({params: {start: 0, limit: itemsPerPage, page: 1}});
								}
	          }
	          ]
				}),
				bbar: new Ext.PagingToolbar({
		        pageSize: itemsPerPage,
		        store: storeData,
		        displayInfo: true
	    	})
		});
		
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
						
		var tpl = new Ext.XTemplate(
				'<tpl for=".">',
				'<table width="100%" cellpadding="0" cellspacing="0">',
				'<tr><td class="rL">Nama:</td><td class="rV">{nama}</td><td class="rL">Tanggal:</td><td class="rV">{tanggal}</td></tr>',
				'<tr><td class="rL">Email:</td><td class="rV">{email}</td><td class="rL">IP Address:</td><td class="rV">{ip}</td></tr>',
				'<tr><td class="rL">Judul Artikel:</td><td class="rV">{judul}</td><td class="rL">Jenis Artikel:</td><td class="rV">{jenis_judul}</td></tr>',
				'<tr><td class="rL" colspan="4">Komentar:</td></tr>',
				'<tr><td class="rK" colspan="4">{komentar}</td></tr>',
				'</table>',
				'</tpl>'
		);
		
		var panel = new Ext.Panel({
		    id:'images-view',
		    //frame:true,
		    autoHeight:true,
		    autoScroll:true,
		    //layout:'fit',
		    title:'Preview',
		    region: 'center',
		
		    items: new Ext.DataView({
		        store: store,
		        tpl: tpl,
		        autoHeight:true,
		        multiSelect: true,
		        overClass:'x-view-over',
		        itemSelector:'div.thumb-wrap',
		        emptyText: '<p align="center">No data to display</p>'
		    })
		});

		gridData.getSelectionModel().on('selectionchange', function(sm, selectedRecord) {
		    if (selectedRecord.length) {
						store.getProxy().url = mod_url + '&m=jsonitem&data_id=' + selectedRecord[0].data.id;
						store.load();		        
		    }
		});
	
		var viewportContent = Ext.create('Ext.Panel', {
		    layout: 'border',
		    items: [
		    		gridData, panel
		    ],
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
<style type="text/css">
.rL {padding:5px;background:#D9E5F3;border-bottom:1px solid #fff;width:100px;font-weight:bold;}
.rV {padding:5px;background:#EEEEEF;border-bottom:1px solid #fff;}
.rK {padding:5px;background:#EEEEEF;border-bottom:1px solid #fff;}
</style>