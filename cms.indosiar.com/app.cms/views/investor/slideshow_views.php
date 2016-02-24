<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){
    Ext.QuickTips.init();
		
    var itemsPerPage = 50;
    var curDate = '<?=date("Y-m-d")?>';
    var winPanel, winPreview, activeID, activeIDParent, tplPictures;

    function updateTplImage(yid) {
        tplPictures ='<p align="center"><img src="<?=STATIC_URL?>thevoiceindonesia/photo/big/'+yid+'" title="" width="360px" height="333px"></p>';
    }  

      
    function addData() {
        sessChecked();

        formInput.getForm().reset();
        formInput.setTitle('Add New Slide Show');
        formInput.getForm().loadRecord(Ext.create('modelData', {
            'id': '',
            'publish': 1,
            'urutan': 1
        }));
    }

    function editData(data_id) {
        sessChecked();

        formInput.getForm().reset();
        formInput.setTitle('Edit Slide Show');

        var store = Ext.create('Ext.data.Store', {
            model: 'modelData',
            proxy: {
                type: 'ajax',
                url: mod_url + '&m=jsonitem&data_id=' + data_id,
                reader: {
                    type: 'json'
                }
            },
            autoLoad: true,
            listeners: {
                load: function () {
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
            fn: function (btn) {
                if (btn == 'yes') {
                    var selection = gridData.getView().getSelectionModel().getSelection();
                    if (selection) {
                        var data = "";
                        for (i = 0; i < selection.length; ++i) data = data + gridData.getSelectionModel().selected.items[i].data.id + "|";
                        Ext.Ajax.request({
                            url: mod_url + '&m=deletedata',
                            method: 'POST',
                            params: {
                                postdata: data
                            },
                            success: function (obj) {
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
            fn: function (btn) {
                if (btn == 'yes') {
                    var selection = gridData.getView().getSelectionModel().getSelection();
                    if (selection) {
                        var data = "";
                        for (i = 0; i < selection.length; ++i) data = data + gridData.getSelectionModel().selected.items[i].data.id + "|";
                        Ext.Ajax.request({
                            url: mod_url + '&m=deletedata',
                            method: 'POST',
                            params: {
                                postdata: data
                            },
                            success: function (obj) {
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
	    fields: ['id','image','keterangan','link','urutan','publish']
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
				
	var gridData = Ext.create('Ext.grid.Panel', {
	    store: storeData,
	    width: '100%',
	    title: 'Slide Show Management',
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
					{text:'No.', dataIndex:'urutan', sortable: false, width:40, align:'center'},
    			    {text:'Keterangan', dataIndex:'keterangan', sortable: false, width:250},
    			    {text:'Link', dataIndex:'link', sortable: false, width:250},
		    	    {text:'Publish', dataIndex:'publish', align:'center', width:50, sortable: false, renderer:renderPublish},
		    	    
                {
    	    		xtype: "actioncolumn", 
    	    		header:'Image',
    	    		align:'center', 
    	    		width:60,
    	    		items: [
                        {
		                    getClass: function(v, meta, rec) {
		                        if (rec.get('image') != "") {
		                            this.items[0].tooltip = 'View Image File';
		                            return 'image-col';
		                        }
		                    },
    		                handler: function(grid, rowIndex, colIndex) {
    		                    var rec = gridData.getStore().getAt(rowIndex);
    		                    if (rec.get("image") != "") window.open('<?=STATIC_URL?>images/investor/slideshow/'+rec.get("image"));
                            }
    				    }
                    ]
		    	    
		    	    
		    	},{
    	          xtype: "actioncolumn",
    	          width: 70,
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
	  
    
/* ======================================== FORM LAYOUT ==============================================  */
/* ===================================================================================================  */

    var formInput = Ext.create('Ext.form.Panel', {
        id: 'form-panel',
        title: 'Add Pictures',
        region:'north',
        border: true,
        split: true,
        height: 250,
        minSize: 150,
        url: mod_url + '&m=submitdata',
        layout: {type: 'vbox', align: 'stretch'},
        bodyPadding: 7,
        fieldDefaults: {labelWidth:80},
        //defaults: {margins: '0 0 5 0'},
        items: [
            {
                xtype:'hidden',name:'id',id:'id'
            },{
                xtype:'hidden',name:'image'
            },{
                xtype:'textfield',name:'keterangan',id:'keterangan',allowBlank:false,fieldLabel:'Title'
            },{
                xtype: 'fileuploadfield',
                fieldLabel: 'Image',
                name: 'image_file',
                id:'image_file',
                emptyText: '600 x 850 pixel (landscape)',
                buttonText: 'Browse'
            }, {
                xtype: 'numberfield',
                fieldLabel: 'Urutan',
                name: 'urutan',
                maxValue: 100,
                minValue: 1,
                allowBlank: false
            },{
                xtype:'textfield',name:'link',fieldLabel:'Link'
    		},{
		        xtype: 'radiogroup',
		        allowBlank: false,
		        fieldLabel: 'Publish',
                margins: '0 0 0 10',
		        items: [
		            {boxLabel: 'Yes', name: 'publish', inputValue: 1},
		            {boxLabel: 'No', name: 'publish', inputValue: 0}
		        ]
            }
        ],
        buttons: [{
            text: 'Reset',
            handler: function() {
                addData();
            }
        },
        <?php 
        if (isset($modAuths['add'])||isset($modAuths['edit'])):
        ?>
        {
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
                        addData();
                        storeData.load();
                    },	
                    failure: function(form, action) {
                        if (action.failureType == 'server') {
                            obj = Ext.JSON.decode(action.response.responseText);
                            Ext.Msg.alert('Failed!', obj.errors.reason);
                        } else {
                            obj = Ext.JSON.decode(action.response.responseText);
                            Ext.Msg.alert('Failed!', obj.errors.reason);
                        }
                    }
                }); 
            } 
        }
        <?php
        endif;
        ?>
        ]
    });
    
 
 
/* ======================================== MAIN LAYOUT ==============================================  */
/* ===================================================================================================  */

// PARENT LAYOUT RIGHT ==================================    
    var picturesPanel = {
        id: 'pict-panel',
        title: 'Show Pictures',
        region: 'center'
        //bodyStyle: 'background:#eee;',
        //autoScroll: true,
        //html: '<p align="center">Pictures parent.</p>'
        //items: showParentPicturesDetail
    };

// MAIN LAYOUT ==================================        
    var viewportContent = Ext.create('Ext.Panel', {
        layout: 'border',
        border: false,
        height: Ext.getBody().getViewSize().height-92,
        items: [
            {
                layout: 'border',
                id: 'layout-browser',
                region:'east',
                border: false,
                split:true,
                //margins: '0 0 0 5',
                width: 400,
                minSize: 300,
                maxSize: 400,
                items: [formInput, picturesPanel]
            }, 
            gridData
        ]
    });
       
    maincontent = viewport.getComponent(4);
    maincontent.add(viewportContent);
    maincontent.border = false;
    maincontent.doLayout();     
    Ext.EventManager.onWindowResize(function () {
        viewportContent.setSize(undefined, Ext.getBody().getViewSize().height-92);
    });
    
    addData();
});
</script>

<style type="text/css">
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

.x-action-col-cell img.image-col {
    background-image: url('/assets/grid-icons/image.png');
}
.x-ie6 .x-action-col-cell img.image-col {
    background-image: url('/assets/grid-icons/image.png');
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