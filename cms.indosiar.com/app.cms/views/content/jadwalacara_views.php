<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){			
		var itemsPerPage 	= 100;
		var curDate 			= '<?=date("Y-m-d")?>';
		var activeDate 		= '<?=date("Y-m-d")?>';
		var activeForm 		= 'input';
		var winForm, winSlideIn, activeForm;

	  function addMassInput() {
	      sessChecked();
	      
			  var formDuplicate = Ext.create('Ext.form.Panel', {
			  		url: mod_url + '&m=submitmassinput',
			      layout: {type: 'vbox', align: 'stretch'},
			      border: false,
			      bodyPadding: 10,
			      fieldDefaults: {labelAlign: 'top'},
			      defaults: {margins: '0 0 5 0'},
			      items: [{
			          xtype: 'textareafield',
			          fieldLabel: 'FORMAT: <b>YYYY-MM-DD HH:MM#Nama Acara</b>    ',
			          flex: 1,
			          name: 'jadwal',
			          id: 'jadwalmass',
			          allowBlank: false
			    	}],
			      buttons: [{
			          text: 'Reset',
			          handler: function() {
			              formDuplicate.getForm().reset();
			          }
			      }, {
			          text: 'Submit',
			          formBind: true,
			          handler:function(){
										sessChecked();
														
			              formDuplicate.getForm().submit({ 
			                  method:'POST', 
			                  waitTitle:'Connecting', 
			                  waitMsg:'Sending data...',
			                  waitMsgTarget:true,
			
			                  success:function(form, action) {
			                  		obj = Ext.JSON.decode(action.response.responseText);
			                  		if (obj.success) {
			                  				if (obj.lastdate != "") {
			                  						var arr = obj.lastdate.split("-");
			                  						var tahun 	= arr[0];
			                  						var bulan		= arr[1];
			                  						var tanggal	= arr[2];
			                  						
														        Ext.getCmp("combotanggal").setValue(tanggal);
														        Ext.getCmp("combotahun").setValue(tahun);
														        Ext.getCmp("combobulan").setValue(bulan);
														        
														        activeDate = obj.lastdate;
														        storeData.getProxy().url = mod_url + '&m=json&thn='+tahun+'&bln='+bulan+'&tgl='+tanggal;							      	
														      	storeData.load({params: {start: 0, limit: itemsPerPage, page: 1}});
			                  				}

			                  				if (obj.result == "")
			                  						winDuplicate.hide();
			                  				else
				                  					Ext.getCmp("jadwalmass").setValue(obj.result);
				                    } else
			                    			Ext.Msg.alert('Failed!', obj.reason);
			                	},
			
			                  failure:function(form, action){
														if (action.failureType == 'server') {
																obj = Ext.JSON.decode(action.response.responseText);
																Ext.Msg.alert('Failed!', obj.reason);
														} else {
																Ext.Msg.alert('Warning!', 'Authentication server is unreachable : ' + action.response.responseText);
														}
			                  } 
			              });
			          } 
			      }]
			  });
		    
	      winDuplicate = Ext.widget('window', {
	          title: 'Input Massal',
	          closeAction: 'hide',
            //width: Ext.getBody().getViewSize().width-100,
            width: 600,
        		height: Ext.getBody().getViewSize().height-100,
	          minHeight: 150,
	          layout: 'fit',
	          resizable: true,
	          modal: true,
	          items: formDuplicate,
	          listeners: {
	          		hide: function() {
	          				this.destroy();
	          		}
	          }
	      });
	      winDuplicate.show();
	  }
	  	  
	  function addData() {     
	      sessChecked();
	      
	      formInput.getForm().reset();
	      formInput.setTitle('Add Jadwal Acara');
	      
				formInput.getForm().loadRecord(Ext.create('modelForm', {
		        'sc_id'    		: '',
		        'sc_date'  		: Ext.getCmp("combotahun").getValue() + '-' + Ext.getCmp("combobulan").getValue() + '-' + Ext.getCmp("combotanggal").getValue(),
		        's_id'	: 0,
		        'sc_slot_hh' 	: 0,
		        'sc_slot_mm' 	: 0
		    }));
		    
		    activeForm = 'input';
	  }
	  
	  function editData(data_id) {		
				sessChecked();
				
				formInput.getForm().reset();
				formInput.setTitle('Edit Jadwal Acara');
				
				var store = Ext.create('Ext.data.Store', {
				    model: 'modelForm',
				    proxy: {
						    type: 'ajax',
						    url : mod_url + '&m=jsonitem&sc_id=' + data_id,
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
				
				activeForm = 'input';
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
							      		for (i = 0; i < selection.length; ++i) data = data + gridData.getSelectionModel().selected.items[i].data.sc_id + "|";
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
							      		for (i = 0; i < selection.length; ++i) data = data + gridData.getSelectionModel().selected.items[i].data.sc_id + "|";
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

	  function previewData() {
				sessChecked();
				
				var vstore = Ext.create('Ext.data.Store', {
				    model: modelData,
				    autoLoad: true,
				    autoDestroy: true,
				    proxy: {
				        type: 'ajax',
				        url : mod_url + '&m=jsonpreview&sc_date='+activeDate,
				        reader: { type: 'json' }
				    }
				});
				
				var vpanel = new Ext.Panel({
				    id:'panel-preview',
				    width:'100%',
				    autoHeight:true,
				    autoScroll: true,
				    layout:'fit',
				    items: new Ext.DataView({
				        store: vstore,
				        bodyPadding: 10,
				        tpl: [
				        		'<div style="padding:10px">',
				        		'<div style="text-align:center;font-weight:bold;margin-bottom:10px;">'+Ext.util.Format.date(activeDate, "d F Y")+'</div>',
										'<tpl for=".">',
										'{sc_slot} - {sc_title}<br>',
										'</tpl>',
										'</div>'
								],
				        autoHeight:true,
				        itemSelector:''
				    })
				});

	      winPreview = Ext.create('Ext.window.Window', {
	          title: 'Preview',
	          closeAction: 'hide',
	          width: 350,
	          height: 400,
	          minHeight: 400,
	          layout: 'fit',
	          resizable: true,
	          modal: true,
	          items: vpanel,
	          listeners: {
	          		hide: function() {
	          				this.destroy();
	          		}
	          }
				});
				
				winPreview.show();
	  }

		/* -------------- GRID PANEL -------------- */		
		Ext.define('modelData', {
		    extend: 'Ext.data.Model',
		    fields: ['sc_id','sc_date','sc_slot','sc_title']
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
		    title: 'Jadwal Acara',
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
				    itemdblclick: function(dv, record, item, index, e) { editData(gridData.getStore().getAt(index).get("sc_id")) }
				},
				<?php endif;?>
		    columns: [    
		    	{text:'Tanggal', dataIndex:'sc_date', align:'center', width:80},
		    	{text:'Jam', dataIndex:'sc_slot', align:'center', width:70},
		    	{text:'Judul', dataIndex:'sc_title', align:'left', width:300},
		    	{
	          xtype: "actioncolumn",
	          width: 82,
	          align: "center",
	          items: [
			          <?php if (isset($modAuths['edit'])):?>
			          {
			              icon   : base_url + 'assets/grid-icons/application_edit.png',
										tooltip: 'Edit Data',
			              handler: function(grid, rowIndex, colIndex) {
			                  var rec = gridData.getStore().getAt(rowIndex);
			                  editData(rec.get("sc_id"));
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
									                      params: { postdata: rec.get("sc_id") },
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
						},'-',
						{
	              itemId: 'massinput',
	              text: 'Input Massal',
	              tooltip: 'Input data massal',
	              icon: base_url+'assets/grid-icons/add.png',
	              handler: addMassInput
						},'-',
						<?php endif;?>
						{
	              itemId: 'view',
	              text: 'View',
	              tooltip: 'Preview Data',
	              icon: base_url+'assets/grid-icons/eye.png',
	              handler: previewData
						},'-',
	          {
								xtype: 'combo',
								mode: 'local',
								name: 'combotanggal',
								id: 'combotanggal',
								width:50,
								displayField: 'tanggal',
								store: new Ext.data.SimpleStore({
								    fields: ['id', 'tanggal'],
								    data: [
								        ['01', '1'],
								        ['02', '2'],
								        ['03', '3'],
								        ['04', '4'],
								        ['05', '5'],
								        ['06', '6'],
								        ['07', '7'],
								        ['08', '8'],
								        ['09', '9'],							            
								        ['10', '10'],
								        ['11', '11'],
								        ['12', '12'],
								        ['13', '13'],
								        ['14', '14'],
								        ['15', '15'],
								        ['16', '16'],
								        ['17', '17'],
								        ['18', '18'],
								        ['19', '19'],
								        ['20', '20'],
								        ['21', '21'],
								        ['22', '22'],
								        ['23', '23'],
								        ['24', '24'],
								        ['25', '25'],
								        ['26', '26'],
								        ['27', '27'],
								        ['28', '28'],
								        ['29', '29'],
								        ['30', '30'],
								        ['31', '31']
								    ]
								}),
								valueField: 'id',
								value: '<?=date("d")?>',
								emptyText: "Date"						   
	          },{
	                 xtype: 'combo',
	                 mode: 'local',
	                 name: 'combobulan',
	                 id: 'combobulan',
	                 width: 80,
	                 displayField: 'bulan',
								   store: new Ext.data.SimpleStore({
								        fields: ['id', 'bulan'],
								        data: [
								            ['01', 'Januari'],
								            ['02', 'Februari'],
								            ['03', 'Maret'],
								            ['04', 'April'],
								            ['05', 'Mei'],
								            ['06', 'Juni'],
								            ['07', 'Juli'],
								            ['08', 'Agustus'],
								            ['09', 'September'],							            
								            ['10', 'Oktober'],
								            ['11', 'Nopember'],
								            ['12', 'Desember']						            
								        ]
								   }),
								   valueField: 'id',
								   value: '<?=date("m")?>',
								   emptyText: "Month"  
						},{
								xtype: 'combo',
								mode: 'local',
								name: 'combotahun',
								id: 'combotahun',
								width:60,
								displayField: 'tahun',
								store: new Ext.data.SimpleStore({
								    fields: ['id', 'tahun'],
								    data: [
								        ['2010', '2010'],
								        ['2011', '2011'],
								        ['2012', '2012'],
								        ['2013', '2013']
								    ]
								}),
								valueField: 'id',
								value: '<?=date("Y")?>',
								emptyText: "Year"
						},{
						    xtype: 'button',
						    text:'<b>Search</b>',
						    waitMsg: 'searching...',
						    iconCls: 'toolbar_btnsearch',
						    handler:function(){
						    		sessChecked();
						    		
						        var tanggal=Ext.getCmp("combotanggal").getValue();
						        var tahun=Ext.getCmp("combotahun").getValue();
						        var bulan=Ext.getCmp("combobulan").getValue();
						        
						        activeDate = tahun+'-'+bulan+'-'+tanggal;
						        storeData.getProxy().url = mod_url + '&m=json&thn='+tahun+'&bln='+bulan+'&tgl='+tanggal;							      	
						      	storeData.load({params: {start: 0, limit: itemsPerPage, page: 1}});
						    }
	          }
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
	Ext.define('modelForm', {
	    extend: 'Ext.data.Model',
	    fields: ['sc_id','sc_date','sc_slot_hh','sc_slot_mm','sc_title']
	});
		
  var formInput = Ext.create('Ext.form.Panel', {
  		url: mod_url + '&m=submitdata',
      layout: {type: 'vbox', align: 'stretch'},
      title: 'Add Jadwal Acara',
      region: 'east',
      split: true,
			width: 200,
      border: true,
      bodyPadding: 10,
      fieldDefaults: {labelAlign: 'top', labelWidth: 100},
      defaults: {margins: '0 0 5 0'},
      items: [{
          xtype: 'hidden',
          name: 'sc_id'
			},{
          xtype: 'fieldcontainer',
          layout: 'hbox',
          defaultType: 'textfield',
          fieldDefaults: {labelAlign: 'top'},
          items: [{
              xtype: 'datefield',
              format: 'Y-m-d',
              width: 130,
              name: 'sc_date',
              value: curDate,
              fieldLabel: 'Tanggal (yyyy-mm-dd)',
              allowBlank: false
          }]
      },{
          xtype: 'fieldcontainer',
          layout: 'hbox',
          defaultType: 'textfield',
          fieldDefaults: {labelAlign: 'top'},
          items: [ {
              xtype: 'fieldcontainer',
              layout: 'hbox',
              width: 95,
              fieldLabel: 'Jam (hh:mm)',
              labelAlign: 'top',
              items: [
                  {xtype: 'numberfield',  name: 'sc_slot_hh', width: 40, maxValue: 24, minValue: 0, allowBlank: false},
                  {xtype: 'displayfield', value: ':', margins: '0 5 0 5'},
                  {xtype: 'numberfield',  name: 'sc_slot_mm', width: 40, maxValue: 59, minValue: 0, allowBlank: false}
              ]
          }]
      },{
          xtype: 'textfield',
          fieldLabel: 'Judul Acara',
          name: 'sc_title',
          id: 'sc_title',
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
	
  var formDuplicate = Ext.create('Ext.form.Panel', {
  		url: mod_url + '&m=submitduplicate',
      layout: {type: 'vbox', align: 'stretch'},
      border: false,
      bodyPadding: 10,
      fieldDefaults: {labelWidth: 180},
      defaults: {margins: '0 0 5 0'},
      items: [{
          xtype: 'datefield',
          format: 'Y-m-d',
          name: 'sc_date_source',
          fieldLabel: 'Source Date (yyyy-mm-dd)',
          allowBlank: false
			},{
          xtype: 'datefield',
          format: 'Y-m-d',
          name: 'sc_date_target',
          fieldLabel: 'Target Date (yyyy-mm-dd)',
          value: curDate,
          allowBlank: false
    	}],
      buttons: [{
          text: 'Cancel',
          handler: function() {
              formDuplicate.getForm().reset();
              this.up('window').hide();
          }
      }, {
          text: 'Submit',
          formBind: true,
          handler:function(){
							sessChecked();
											
              formDuplicate.getForm().submit({ 
                  method:'POST', 
                  waitTitle:'Connecting', 
                  waitMsg:'Sending data...',
                  waitMsgTarget:true,

                  success:function(form, action) {
                  		obj = Ext.JSON.decode(action.response.responseText);
                  		if (obj.success) {
	                  			Ext.Msg.alert('Success', 'Data Duplicated');
	                  			storeData.getProxy().url = mod_url + '&m=json&thn='+obj.thn+'&bln='+obj.bln+'&tgl='+obj.tgl;
	                      	storeData.load();
	                      	
							        		Ext.getCmp("combotanggal").setValue(obj.tgl);
							        		Ext.getCmp("combotahun").setValue(obj.thn);
							        		Ext.getCmp("combobulan").setValue(obj.bln);
							        
							        		activeDate = obj.thn+'-'+obj.bln+'-'+obj.tgl
							        		
	                      	winDuplicate.close();
	                    } else
                    			Ext.Msg.alert('Failed!', obj.reason);
                	},

                  failure:function(form, action){
											if (action.failureType == 'server') {
													obj = Ext.JSON.decode(action.response.responseText);
													Ext.Msg.alert('Failed!', obj.reason);
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
</style>