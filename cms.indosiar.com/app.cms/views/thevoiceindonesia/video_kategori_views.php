<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){
    var itemsPerPage       = 50;
    var curDate            = '<?=date("Y-m-d")?>';
    activeIDVideo_kategori = 1;

    function renderPublish(val) {
        if (val == "1") return "<img src="+base_url+"assets/grid-icons/tick.png width=14 height=14/>";
        return "<img src="+base_url+"assets/grid-icons/cross.png width=14 height=14/>";
      }

    /* -------------- START OF VIDEO KATEGORI -------------- */

    function popFormVideo_kategori() {
        sessChecked();

        Ext.define('modelForm', {
            extend: 'Ext.data.Model',
            fields: ['id','kategori','kategori_url','sort','publish']
        });

        var formInput = Ext.create('Ext.form.Panel', {
            url   : mod_url + '&m=submitvideo_kategori',
            layout: {type: 'vbox', align: 'stretch'},
            width : '100%',
            border: false,
            bodyPadding: 7,
            fieldDefaults: {labelWidth: 100, anchor: '100%'},
            items: [{
                xtype: 'hidden',
                name: 'id'
            },{
                xtype: 'textfield',
                fieldLabel: 'Kategori',
                name: 'kategori',
                allowBlank: false
            },{
                xtype: 'textfield',
                fieldLabel: 'Sort',
                name: 'sort',
                allowBlank: false
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
                        text: 'Close',
                        handler: function() {
                            winFormVideo_kategori.close();
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
                                    storeDataVideo_kategori.load();
                                    winFormVideo_kategori.close();
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

        winFormVideo_kategori = Ext.widget('window', {
            title       : 'Add Video Kategori',
            closeAction : 'hide',
            width       : 500,
            height      : 215,
            layout      : 'fit',
            resizable   : true,
            modal       : true,
            items       : formInput,
            listeners   : {
                hide    : function() {
                          this.destroy();
                          }
            }
        });
        winFormVideo_kategori.show();

        if (activeIDVideo_kategori > 0) {
            winFormVideo_kategori.setTitle('Edit Video Kategori');
            var store = Ext.create('Ext.data.Store', {
                model: 'modelForm',
                proxy: {
                    type: 'ajax',
                    url : mod_url + '&m=jsonitemvideo_kategori&data_id=' + activeIDVideo_kategori,
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
        } else {
            formInput.getForm().loadRecord(Ext.create('modelForm', {
                'id'        : '',
                'publish'    : 1
            }));
        }
    }

    function addDataVideo_kategori() {
        activeIDVideo_kategori = 0;
        popFormVideo_kategori();
    }

    function editDataVideo_kategori(data_id) {
        activeIDVideo_kategori = data_id;
        popFormVideo_kategori();
    }

    function deleteDataVideo_kategori() {
        sessChecked();
        Ext.Msg.show({
            title  : 'Confirm',
            msg    : 'Delete Selected Data ?',
            buttons: Ext.Msg.YESNO,
            fn: function(btn) {
                if (btn == 'yes') {
                    var selection = gridDataVideo_kategori.getView().getSelectionModel().getSelection();
                    if (selection) {
                        var data = "";
                        for (i = 0; i < selection.length; ++i) data = data + gridDataVideo_kategori.getSelectionModel().selected.items[i].data.id + "|";
                            Ext.Ajax.request({
                                url: mod_url + '&m=deletedatavideo_kategori',
                                method: 'POST',
                                params: { postdata: data },
                                success: function(obj) {
                                    var resp = obj.responseText;
                                    if (resp != 0) {
                                        Ext.MessageBox.alert('Failed', resp);
                                    } else {
                                        //Ext.MessageBox.alert('Success','Data was deleted');
                                        //storeDataVideo_kategori.remove(selection);
                                        storeDataVideo_kategori.load();
                                    }
                                }
                            });
                    }
                }
            }
        });
    }

    function deleteDataVideo_kategoriSelection() {
        sessChecked();
        Ext.Msg.show({
            title: 'Confirm',
            msg: 'Delete Selected Data ?',
            buttons: Ext.Msg.YESNO,
            fn: function(btn) {
                if (btn == 'yes') {
                    var selection = gridDataVideo_kategori.getView().getSelectionModel().getSelection();
                    if (selection) {
                        var data = "";
                        for (i = 0; i < selection.length; ++i) data = data + gridDataVideo_kategori.getSelectionModel().selected.items[i].data.id + "|";
                            Ext.Ajax.request({
                                url: mod_url + '&m=deletedatavideo_kategori',
                                method: 'POST',
                                params: { postdata: data },
                                success: function(obj) {
                                    var resp = obj.responseText;
                                    if (resp != 0) {
                                        Ext.MessageBox.alert('Failed', resp);
                                    } else {
                                        //Ext.MessageBox.alert('Success','Data was deleted');
                                        //storeDataVideo_kategori.remove(selection);
                                        storeDataVideo_kategori.load();
                                    }
                                }
                            });
                    }
                }
            }
        });
    }

    function publishDataVideo_kategori() {
        Ext.Msg.show({
            title   : 'Confirm',
            msg     : 'Publish Selected Data ?',
            buttons : Ext.Msg.YESNO,
            fn      : function(btn) {
                if (btn == 'yes') setpublishDataVideo_kategori(1);
            }
        });
    }

    function unpublishDataVideo_kategori() {
        Ext.Msg.show({
            title   : 'Confirm',
            msg     : 'Unpublish Selected Data ?',
            buttons : Ext.Msg.YESNO,
            fn: function(btn) {
                if (btn == 'yes') setpublishDataVideo_kategori(0);
            }
        });
    }

    function setpublishDataVideo_kategori(flag) {
        sessChecked();
        var selection = gridDataVideo_Kategori.getView().getSelectionModel().getSelection();
        if (selection) {
            var data = "";
            for (i = 0; i < selection.length; ++i) data = data + gridDataVideo_kategori.getSelectionModel().selected.items[i].data.id + "|";
            Ext.Ajax.request({
                url   : mod_url + '&m=publishdatavideo_kategori',
                method: 'POST',
                params: { postdata: data, set: flag },
                success: function(obj) {
                    var resp = obj.responseText;
                    if (resp != 0) {
                        Ext.MessageBox.alert('Failed', resp);
                    } else {
                        storeDataVideo_kategori.load();
                    }
                }
            });
        }
    }

    Ext.define('modelDataVideo_kategori', {
        extend: 'Ext.data.Model',
        fields: ['id','kategori','kategori_url','sort','publish']
    });

    var storeDataVideo_kategori = Ext.create('Ext.data.Store', {
        model: modelDataVideo_kategori,
        autoLoad: true,
        pageSize: itemsPerPage,
        proxy: {
            type: 'ajax',
            url : mod_url + '&m=jsonvideo_kategori',
            simpleSortMode: true,
            reader: {
                type: 'json',
                root: 'rows',
                totalProperty: 'results'
            }
        }
    });

    var gridDataVideo_kategori = Ext.create('Ext.grid.Panel', {
        store: storeDataVideo_kategori,
        //region: 'center',
        width: '100%',
        height: Ext.getBody().getViewSize().height-119,
        columnLines: true,
        selModel: Ext.create('Ext.selection.CheckboxModel', {
            listeners: {
                selectionchange: function(sm, selections) {
                    <?php if (isset($modAuths['delete'])):?>
                        gridDataVideo_kategori.down('#delete').setDisabled(selections.length == 0);
                    <?php endif;

                    if (isset($modAuths['publish'])): ?>
                        gridDataVideo_kategori.down('#publish').setDisabled(selections.length == 0);
                        gridDataVideo_kategori.down('#unpublish').setDisabled(selections.length == 0);
                    <?php endif;?>
                }
            }
        }),

        <?php if (isset($modAuths['edit'])):?>
            listeners : {
                itemdblclick: function(dv, record, item, index, e) { editDataVideo_kategori(gridDataVideo_kategori.getStore().getAt(index).get("id")) }
            },
        <?php endif;?>

        columns: [
            {text:'ID', dataIndex:'id', align:'center', width:50},
            {text:'Kategori', dataIndex:'kategori', width:100},
            {text:'Kategori URL', dataIndex:'kategori_url', width:200},
            {text:'Sort', dataIndex:'sort', align:'center', width:150},
            {text:'Publish', dataIndex:'publish', align:'center', width:50, renderer:renderPublish},
            {
                xtype: "actioncolumn",
                width: 110,
                align: "center",
                items:
                    [
                        {
                            icon   : base_url + 'assets/grid-icons/eye.png',
                            tooltip: 'Preview Data',
                            handler: function(grid, rowIndex, colIndex) {
                                var rec = gridDataVideo_kategori.getStore().getAt(rowIndex);
                                window.open('http://www.thevoiceindonesia.co.id/foto/'+rec.get("kategori_url"));
                            }
                        },
                        <?php if (isset($modAuths['edit'])):?>
                            {
                                icon   : base_url + 'assets/grid-icons/application_edit.png',
                                tooltip: 'Edit Data',
                                handler: function(grid, rowIndex, colIndex) {
                                    var rec = gridDataVideo_kategori.getStore().getAt(rowIndex);
                                    editDataVideo_kategori(rec.get("id"));
                                }
                            },
                        <?php endif;

                        if (isset($modAuths['publish'])): ?>
                            {
                                getClass: function(v, meta, rec) {
                                    if (rec.get("publish") == "1") {
                                        this.items[2].tooltip = "Set to Unpublish";
                                        return "set-unpublish";
                                    } else {
                                        this.items[2].tooltip = "Set to Publish";
                                        return "set-publish";
                                    }
                                },
                                handler: function(grid, rowIndex, colIndex) {
                                    sessChecked();
                                    var rec = grid.getStore().getAt(rowIndex);
                                    var kategori = (rec.get("publish") == "1") ? 0 : 1;
                                    Ext.Ajax.request({
                                    url: mod_url + '&m=publishdatavideo_kategori',
                                    method: 'POST',
                                    params: { postdata: rec.get("id"), set: kategori },
                                                success: function(obj) {
                                                    var resp = obj.responseText;
                                                    if (resp != 0) {
                                                        Ext.MessageBox.alert('Failed', resp);
                                                    } else {
                                                        storeDataVideo_kategori.load();
                                                    }
                                                }
                                    });
                                }
                            },
                        <?php endif;

                        if (isset($modAuths['delete'])): ?>
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
                                                    url: mod_url + '&m=deletedatavideo_kategori',
                                                    method: 'POST',
                                                    params: { postdata: rec.get("id") },
                                                    success: function(obj) {
                                                        var resp = obj.responseText;
                                                        if (resp != 0) {
                                                            Ext.MessageBox.alert('Failed', resp);
                                                        } else {
                                                            //Ext.MessageBox.alert('Success','Data was deleted');
                                                            //storeDataVideo_kategori.removeAt(rowIndex);
                                                            storeDataVideo_kategori.load();
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
                        icon: base_url+'assets/grid-icons/trash.png',
                        disabled: true,
                        handler: deleteDataVideo_kategoriSelection
                    },'-',
                <?php endif;

                if (isset($modAuths['add'])): ?>
                    {
                        itemId: 'add',
                        text: 'Add',
                        icon: base_url+'assets/grid-icons/add.png',
                        handler: addDataVideo_kategori
                    },'-',
                <?php endif;

                if (isset($modAuths['publish'])): ?>
                    {
                        itemId: 'publish',
                        text: 'Publish',
                        icon: base_url+'assets/grid-icons/accept.png',
                        disabled: true,
                        handler: publishDataVideo_kategori
                    },'-',{
                        itemId: 'unpublish',
                        text: 'Unpublish',
                        icon: base_url+'assets/grid-icons/delete.png',
                        disabled: true,
                        handler: unpublishDataVideo_kategori
                    }
                <?php endif;?>
            ]
        }),
        bbar: new Ext.PagingToolbar({
            pageSize: itemsPerPage,
            store: storeDataVideo_kategori,
            displayInfo: true
        })
    });

    /* -------------- END OF VIDEO KATEGORI -------------- */

    var tabs = Ext.create('Ext.tab.Panel', {
        height: Ext.getBody().getViewSize().height-92,
        activeTab: 0,
        plain: false,
        tabPosition: 'top',
        defaults :{
            autoScroll: true,
            bodyPadding: 0
        },
        items: [
            {
                items: gridDataVideo_kategori,
                title: 'Video Kategori'
            }
        ]
    });

    maincontent = viewport.getComponent(4);
    maincontent.add(tabs);
    if (maincontent.border) maincontent.border = false;
        maincontent.doLayout();

        Ext.EventManager.onWindowResize(function () {
            //viewportContent.setSize(undefined, Ext.getBody().getViewSize().height-92);
            tabs.setSize(undefined, Ext.getBody().getViewSize().height-92);
            gridDataVideo_kategori.setSize(undefined, Ext.getBody().getViewSize().height-119);
    });
});
</script>
