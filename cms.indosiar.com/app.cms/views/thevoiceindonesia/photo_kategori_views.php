<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){
    var itemsPerPage       = 50;
    var curDate            = '<?=date("Y-m-d")?>';
    activeIDPhoto_kategori = 1;

    function renderPublish(val) {
        if (val == "1") return "<img src="+base_url+"assets/grid-icons/tick.png width=14 height=14/>";
        return "<img src="+base_url+"assets/grid-icons/cross.png width=14 height=14/>";
      }

    /* -------------- START OF PHOTO KATEGORI -------------- */

    function popFormPhoto_kategori() {
        sessChecked();

        Ext.define('modelForm', {
            extend: 'Ext.data.Model',
            fields: ['id','kategori','kategori_url','sort','publish']
        });

        var formInput = Ext.create('Ext.form.Panel', {
            url   : mod_url + '&m=submitphoto_kategori',
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
                            winFormPhoto_kategori.close();
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
                                    storeDataPhoto_kategori.load();
                                    winFormPhoto_kategori.close();
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

        winFormPhoto_kategori = Ext.widget('window', {
            title       : 'Add Photo Kategori',
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
        winFormPhoto_kategori.show();

        if (activeIDPhoto_kategori > 0) {
            winFormPhoto_kategori.setTitle('Edit Photo Kategori');
            var store = Ext.create('Ext.data.Store', {
                model: 'modelForm',
                proxy: {
                    type: 'ajax',
                    url : mod_url + '&m=jsonitemphoto_kategori&data_id=' + activeIDPhoto_kategori,
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

    function addDataPhoto_kategori() {
        activeIDPhoto_kategori = 0;
        popFormPhoto_kategori();
    }

    function editDataPhoto_kategori(data_id) {
        activeIDPhoto_kategori = data_id;
        popFormPhoto_kategori();
    }

    function deleteDataPhoto_kategori() {
        sessChecked();
        Ext.Msg.show({
            title  : 'Confirm',
            msg    : 'Delete Selected Data ?',
            buttons: Ext.Msg.YESNO,
            fn: function(btn) {
                if (btn == 'yes') {
                    var selection = gridDataPhoto_kategori.getView().getSelectionModel().getSelection();
                    if (selection) {
                        var data = "";
                        for (i = 0; i < selection.length; ++i) data = data + gridDataPhoto_kategori.getSelectionModel().selected.items[i].data.id + "|";
                            Ext.Ajax.request({
                                url: mod_url + '&m=deletedataphoto_kategori',
                                method: 'POST',
                                params: { postdata: data },
                                success: function(obj) {
                                    var resp = obj.responseText;
                                    if (resp != 0) {
                                        Ext.MessageBox.alert('Failed', resp);
                                    } else {
                                        //Ext.MessageBox.alert('Success','Data was deleted');
                                        //storeDataPhoto_kategori.remove(selection);
                                        storeDataPhoto_kategori.load();
                                    }
                                }
                            });
                    }
                }
            }
        });
    }

    function deleteDataPhoto_kategoriSelection() {
        sessChecked();
        Ext.Msg.show({
            title: 'Confirm',
            msg: 'Delete Selected Data ?',
            buttons: Ext.Msg.YESNO,
            fn: function(btn) {
                if (btn == 'yes') {
                    var selection = gridDataPhoto_kategori.getView().getSelectionModel().getSelection();
                    if (selection) {
                        var data = "";
                        for (i = 0; i < selection.length; ++i) data = data + gridDataPhoto_kategori.getSelectionModel().selected.items[i].data.id + "|";
                            Ext.Ajax.request({
                                url: mod_url + '&m=deletedataphoto_kategori',
                                method: 'POST',
                                params: { postdata: data },
                                success: function(obj) {
                                    var resp = obj.responseText;
                                    if (resp != 0) {
                                        Ext.MessageBox.alert('Failed', resp);
                                    } else {
                                        //Ext.MessageBox.alert('Success','Data was deleted');
                                        //storeDataPhoto_kategori.remove(selection);
                                        storeDataPhoto_kategori.load();
                                    }
                                }
                            });
                    }
                }
            }
        });
    }

    function publishDataPhoto_kategori() {
        Ext.Msg.show({
            title   : 'Confirm',
            msg     : 'Publish Selected Data ?',
            buttons : Ext.Msg.YESNO,
            fn      : function(btn) {
                if (btn == 'yes') setpublishDataPhoto_kategori(1);
            }
        });
    }

    function unpublishDataPhoto_kategori() {
        Ext.Msg.show({
            title   : 'Confirm',
            msg     : 'Unpublish Selected Data ?',
            buttons : Ext.Msg.YESNO,
            fn: function(btn) {
                if (btn == 'yes') setpublishDataPhoto_kategori(0);
            }
        });
    }

    function setpublishDataPhoto_kategori(flag) {
        sessChecked();
        var selection = gridDataPhoto_Kategori.getView().getSelectionModel().getSelection();
        if (selection) {
            var data = "";
            for (i = 0; i < selection.length; ++i) data = data + gridDataPhoto_kategori.getSelectionModel().selected.items[i].data.id + "|";
            Ext.Ajax.request({
                url   : mod_url + '&m=publishdataphoto_kategori',
                method: 'POST',
                params: { postdata: data, set: flag },
                success: function(obj) {
                    var resp = obj.responseText;
                    if (resp != 0) {
                        Ext.MessageBox.alert('Failed', resp);
                    } else {
                        storeDataPhoto_kategori.load();
                    }
                }
            });
        }
    }

    Ext.define('modelDataPhoto_kategori', {
        extend: 'Ext.data.Model',
        fields: ['id','kategori','kategori_url','sort','publish']
    });

    var storeDataPhoto_kategori = Ext.create('Ext.data.Store', {
        model: modelDataPhoto_kategori,
        autoLoad: true,
        pageSize: itemsPerPage,
        proxy: {
            type: 'ajax',
            url : mod_url + '&m=jsonphoto_kategori',
            simpleSortMode: true,
            reader: {
                type: 'json',
                root: 'rows',
                totalProperty: 'results'
            }
        }
    });

    var gridDataPhoto_kategori = Ext.create('Ext.grid.Panel', {
        store: storeDataPhoto_kategori,
        //region: 'center',
        width: '100%',
        height: Ext.getBody().getViewSize().height-119,
        columnLines: true,
        selModel: Ext.create('Ext.selection.CheckboxModel', {
            listeners: {
                selectionchange: function(sm, selections) {
                    <?php if (isset($modAuths['delete'])):?>
                        gridDataPhoto_kategori.down('#delete').setDisabled(selections.length == 0);
                    <?php endif;

                    if (isset($modAuths['publish'])): ?>
                        gridDataPhoto_kategori.down('#publish').setDisabled(selections.length == 0);
                        gridDataPhoto_kategori.down('#unpublish').setDisabled(selections.length == 0);
                    <?php endif;?>
                }
            }
        }),

        <?php if (isset($modAuths['edit'])):?>
            listeners : {
                itemdblclick: function(dv, record, item, index, e) { editDataPhoto_kategori(gridDataPhoto_kategori.getStore().getAt(index).get("id")) }
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
                                var rec = gridDataPhoto_kategori.getStore().getAt(rowIndex);
                                window.open('http://www.thevoiceindonesia.co.id/foto/'+rec.get("kategori_url"));
                            }
                        },
                        <?php if (isset($modAuths['edit'])):?>
                            {
                                icon   : base_url + 'assets/grid-icons/application_edit.png',
                                tooltip: 'Edit Data',
                                handler: function(grid, rowIndex, colIndex) {
                                    var rec = gridDataPhoto_kategori.getStore().getAt(rowIndex);
                                    editDataPhoto_kategori(rec.get("id"));
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
                                    url: mod_url + '&m=publishdataphoto_kategori',
                                    method: 'POST',
                                    params: { postdata: rec.get("id"), set: kategori },
                                                success: function(obj) {
                                                    var resp = obj.responseText;
                                                    if (resp != 0) {
                                                        Ext.MessageBox.alert('Failed', resp);
                                                    } else {
                                                        storeDataPhoto_kategori.load();
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
                                                    url: mod_url + '&m=deletedataphoto_kategori',
                                                    method: 'POST',
                                                    params: { postdata: rec.get("id") },
                                                    success: function(obj) {
                                                        var resp = obj.responseText;
                                                        if (resp != 0) {
                                                            Ext.MessageBox.alert('Failed', resp);
                                                        } else {
                                                            //Ext.MessageBox.alert('Success','Data was deleted');
                                                            //storeDataPhoto_kategori.removeAt(rowIndex);
                                                            storeDataPhoto_kategori.load();
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
                        handler: deleteDataPhoto_kategoriSelection
                    },'-',
                <?php endif;

                if (isset($modAuths['add'])): ?>
                    {
                        itemId: 'add',
                        text: 'Add',
                        icon: base_url+'assets/grid-icons/add.png',
                        handler: addDataPhoto_kategori
                    },'-',
                <?php endif;

                if (isset($modAuths['publish'])): ?>
                    {
                        itemId: 'publish',
                        text: 'Publish',
                        icon: base_url+'assets/grid-icons/accept.png',
                        disabled: true,
                        handler: publishDataPhoto_kategori
                    },'-',{
                        itemId: 'unpublish',
                        text: 'Unpublish',
                        icon: base_url+'assets/grid-icons/delete.png',
                        disabled: true,
                        handler: unpublishDataPhoto_kategori
                    }
                <?php endif;?>
            ]
        }),
        bbar: new Ext.PagingToolbar({
            pageSize: itemsPerPage,
            store: storeDataPhoto_kategori,
            displayInfo: true
        })
    });

    /* -------------- END OF PHOTO KATEGORI -------------- */

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
                items: gridDataPhoto_kategori,
                title: 'Photo Kategori'
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
            gridDataPhoto_kategori.setSize(undefined, Ext.getBody().getViewSize().height-119);
    });
});
</script>
