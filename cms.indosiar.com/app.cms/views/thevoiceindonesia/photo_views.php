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

      
/* ================================== ADD IMAGE ====================================================== */  
/* ===================================================================================================  */

    function addData() {
        formInput.getForm().reset();
        formInput.setTitle('Add Pictures');       
        formInput.getForm().loadRecord(Ext.create('modelData', {id:'',id_kategori:0,publish:1}));
    }

/* ================================== EDIT IMAGE ======================================================  */  
 /* ===================================================================================================  */

    function editData() {			
        formInput.getForm().reset();
        formInput.setTitle('Edit Pictures');
        
        updateTplImage(viewData.getSelectionModel().selected.items[0].data.image_big);
        Ext.getCmp('pict-panel').body.update(tplPictures);
        
        var store = Ext.create('Ext.data.Store', {
            model: 'modelData',
            proxy: {
                type: 'ajax',
                url : mod_url + '&m=jsonitem&data_id=' + activeID,
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
/* ================================== DELETE IMAGE ===================================================  */  
/* ===================================================================================================  */

    function deleteData() {
        Ext.Msg.show({
            title: 'Confirm',
            msg: 'Delete Selected Data ?',
            buttons: Ext.Msg.YESNO,
            fn: function(btn) {
            if (btn == 'yes') {
                var selection = viewData.getSelectionModel().getSelection()[0];
                if (selection) {
                    Ext.Ajax.request({
                        url: mod_url + '&m=deletedata',
                        method: 'POST',
                        params: { postdata: activeID },
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
                    }
                }
            }
        });
    }

/* ================================== PREVIEW IMAGE DETAIL ===========================================  */  
/* ===================================================================================================  */

    function showParentPicturesDetail() { 
        storeDataParentDetail.getProxy().url = mod_url + '&m=detailImage&data_id=' +activeID;
        storeDataParentDetail.load();
        winPanel = Ext.widget('window', {
            title: 'Pictures Parent List',
            closeAction: 'hide',
            width: myWidth-100,
            height: winHeight-100,
            layout: 'fit',
            resizable: true,
            modal: true,
            items: panelDataParentDetail
        });
        winPanel.show();
    }
    
    function selectDataDetail() {
        var selection = viewDataParentDetail.getSelectionModel().getSelection()[0];
        if (selection) {
            Ext.getCmp('parent_id').setValue(activeIDParent);
            winPanel.hide();
        }
    }


	function searchData() {
		sessChecked();
		
		var keyword = Ext.getCmp("keyword").getValue();
		var jenisid = Ext.getCmp("id_kategori").getValue();
		
		storeData.getProxy().url = mod_url + '&m=json&kategori='+ jenisid + '&q='+keyword;
		storeData.load({params: {start: 0, limit: itemsPerPage, page: 1}});
	}
		
/* ================================== MAIN IMAGE LAYOUT ==============================================  */
/* ===================================================================================================  */

    Ext.define('modelData', {
        extend: 'Ext.data.Model',
        fields: ['id','id_kategori','judul','judul_url','isi','image_thumb','image_medium','image_big','publish']
    });
    
    var tplImage = [
        '<tpl for=".">',
        '<div class="thumb-wrap" id="{id}">',
        '<div class="thumb"><img src="<?=STATIC_URL?>thevoiceindonesia/photo/thumb/{image_thumb}" title="{judul}"></div>',
        '<span class="x-editable">{shortName}</span></div>',
        '</tpl>',
        '<div class="x-clear"></div>'
    ];

// DATA MAIN ==================================        
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
<?php
$txt_kategori = '';
foreach($kategori as $row) $txt_kategori .= '["'.$row['id'].'","'.$row['kategori'].'"],';
echo substr($txt_kategori, 0, -1);
?>
	    ]
	});
	
// DISPLAY MAIN ==================================        
    var viewData = Ext.create('Ext.view.View', {
        store: storeData,
        tpl: tplImage,
        //multiSelect: true,
        height: Ext.getBody().getViewSize().height-173,
        autoScroll: true,
        trackOver: true,
        overItemCls: 'x-item-over',
        itemSelector: 'div.thumb-wrap',
        emptyText: 'No images to display',
        prepareData: function(data)
        {
            Ext.apply(data, {
                shortName: Ext.util.Format.ellipsis(data.judul, 20)
                //sizeString: Ext.util.Format.fileSize(data.size),
                //dateString: Ext.util.Format.date(data.lastmod, "m/d/Y g:i a")
            });
            return data;
        },
        listeners:
        {
            selectionchange: function(dv, nodes){
                var selection = viewData.getSelectionModel().getSelection()[0];
                if (selection)
                {
                    activeID = viewData.getSelectionModel().selected.items[0].data.id;
                    
                    <?php if (isset($modAuths['edit'])):?>
                    panelData.down('#edit').setDisabled(nodes.length === 0);
                    <?php 
                    endif;
                    if (isset($modAuths['delete'])):
                    ?>
                    panelData.down('#delete').setDisabled(nodes.length === 0);
                    <?php 
                    endif;
                    ?>
                    //panelData.down('#view').setDisabled(nodes.length === 0);
                } else {
                    activeID = '';
                    <?php 
                    if (isset($modAuths['edit'])):
                    ?>
                    panelData.down('#edit').setDisabled(nodes.length === 0);
                    <?php 
                    endif;
                    if (isset($modAuths['delete'])):
                    ?>
                    panelData.down('#delete').setDisabled(nodes.length === 0);
                    <?php 
                    endif;
                    ?>
                    //panelData.down('#view').setDisabled(nodes.length === 0);
                }
                //alert(activeID);
            },
            itemdblclick: function(dv, record, item, index, e) { editData(); }
        }
    })
        
// MAIN GRID ==================================
    var panelData = Ext.create('Ext.Panel', {
        region: 'center',
        id: 'images-view',
        width: '100%',
        height: winHeight,
        region: 'center',
        title: 'Pictures Management',
        items: viewData,
        tbar: new Ext.Toolbar({
            items: [
    <?php if (isset($modAuths['add'])):?>
            {
                itemId: 'add',
                text: 'Add',
                icon: base_url+'assets/grid-icons/add.png',
                handler: addData
            },'-',
    <?php 
    endif;
    if (isset($modAuths['edit'])):
    ?>
            {
                itemId: 'edit',
                text: 'Edit',
                icon: base_url+'assets/grid-icons/application_edit.png',
                disabled: true,
                handler: editData
            },'-',
    <?php 
    endif;
    if (isset($modAuths['delete'])):
    ?>
            {
                itemId: 'delete',
                text: 'Delete',
                icon: base_url+'assets/grid-icons/trash.png',
                disabled: true,
                handler: deleteData
            },'-',
    <?php 
    endif;
    ?>
            {
                xtype: 'combo',
                width: 120,
    			name: 'id_kategori',
    			id: 'id_kategori',
    			store: storeKategori,
    			queryMode: 'local',
    			//itemSelector: '',
    			emptyText: '',
    			forceSelection: true,
    			triggerAction: 'all',
    			valueField: 'id',
    			displayField: 'name'
            },{
				xtype: 'textfield',
				name: 'keyword',
				id: 'keyword',
				flex: 1,
	            listeners: {
	                specialkey: function(field, e){
	                    if (e.getKey() == e.ENTER) searchData();
	                }
	            }
            },{
                xtype: 'button',
                text:'<b>Search</b>',
                waitMsg: 'searching...',
                iconCls: 'toolbar_btnsearch',
                handler: searchData
          }
            ]
        }),
        bbar: new Ext.PagingToolbar({
            pageSize: itemsPerPage,
            store: storeData,
            displayInfo: true
        })
    });
// MAIN GRID ==================================
	  
    
/* ======================================== FORM LAYOUT ==============================================  */
/* ===================================================================================================  */

    var formInput = Ext.create('Ext.form.Panel', {
        id: 'form-panel',
        title: 'Add Pictures',
        region:'north',
        border: true,
        split: true,
        height: 400,
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
                xtype:'hidden',name:'image_big'
            },{
                xtype:'hidden',name:'image_medium'
            },{
                xtype:'hidden',name:'image_thumb'
            },{
                xtype:'textfield',name:'judul',id:'judul',allowBlank:false,fieldLabel:'Title'
            },{
				xtype: 'combo',
				mode: 'local',
				allowBlank: false,
				fieldLabel: 'Kategori',
				name: 'id_kategori',
				store: storeKategori,
				displayField: 'name',
				valueField: 'id'
            },{
                xtype: 'fileuploadfield',
                fieldLabel: 'Big Pict',
                name: 'image_big_file',
                id:'image_big_file',
                emptyText: '600 x 850 pixel (portrait)',
                buttonText: 'Browse'
            },{
                xtype: 'fileuploadfield',          
                fieldLabel: 'Medium Pict',
                name: 'image_medium_file',
                id:'image_medium_file',
                emptyText: '470 x 300 pixel (landscape)',
                buttonText: 'Browse'
            },{
                xtype: 'fileuploadfield',          
                fieldLabel: 'Thumb Pict',
                name: 'image_thumb_file',
                id:'image_thumb_file',
                emptyText: '300 x 225 pixel (landscape)',
                buttonText: 'Browse'
            },{
                xtype: 'htmleditor',
                name: 'isi',
                height: 200,
                flex: 1,
                anchor: '100%'
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
            formInput.getForm().reset();
            formInput.setTitle('Add Photo');
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
                        formInput.getForm().reset();
                        formInput.setTitle('Add Pictures');
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
                width: 352,
                minSize: 300,
                maxSize: 400,
                items: [formInput, picturesPanel]
            }, 
            panelData
        ]
    });
       
    maincontent = viewport.getComponent(4);
    maincontent.add(viewportContent);
    maincontent.border = false;
    maincontent.doLayout();     
    Ext.EventManager.onWindowResize(function () {
        viewportContent.setSize(undefined, Ext.getBody().getViewSize().height-92);
        viewData.setSize(undefined, Ext.getBody().getViewSize().height-173);
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