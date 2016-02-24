<script type="text/javascript">
    var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

    Ext.onReady(function(){
        var itemsPerPage = 50;
        var activeID     = 0;
        var curDate      = '<?=date("Y-m-d")?>';
        var tplx = new Ext.XTemplate(
            '<tpl for=".">',
                '<table width="100%" cellpadding="3" cellspacing="0">',
                    '<tr>',
                        '<td class="rL">Kategori:</td>',
                        '<td class="rV">{kategori}</td>',
                        '<td class="rL">Kota Audisi:</td>',
                        '<td class="rV">{kota_audisi}</td>',
                        '<td rowspan="14" align="center" valign="top">',
                            '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="470" height="320" id="single1" name="single1">',
                                '<param name="movie" value="http://player.longtailvideo.com/player.swf">',
                                '<param name="allowfullscreen" value="true">',
                                '<param name="allowscriptaccess" value="always">',
                                '<param name="wmode" value="transparent">',
                                '<param name="flashvars" value="file={video}&autostart=true">',
                                '<embed type="application/x-shockwave-flash" id="single2" name="single2" src="http://player.longtailvideo.com/player.swf" width="470" height="320" bgcolor="undefined" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" flashvars="file={video}&autostart=true" />',
                            '</object>',
                        '</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Nama Depan:</td>',
                        '<td class="rV">{nama_depan}</td>',
                        '<td class="rL">Nama Belakang:</td>',
                        '<td class="rV">{nama_belakang}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Kelamin:</td>',
                        '<td class="rV">{jenis_kelamin}</td>',
                        '<td class="rL">Pekerjaan:</td>',
                        '<td class="rV">{pekerjaan}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Tgl. Lahir:</td>',
                        '<td class="rV">{tgl_lahir}</td>',
                        '<td class="rL">Warga Negara:</td>',
                        '<td class="rV">{kewarganegaraan}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Alamat:</td>',
                        '<td colspan="3" class="rV">{alamat}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Kota:</td>',
                        '<td class="rV">{kota}</td>',
                        '<td class="rL">Kode Pos:</td>',
                        '<td class="rV">{kodepos}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Telp. Rumah</td>',
                        '<td class="rV">{telp_rumah}</td>',
                        '<td class="rL">Telp. Kerabat:</td>',
                        '<td class="rV">{telp_kerabat}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Telp. HP:</td>',
                        '<td class="rV">{telp_hp}</td>',
                        '<td class="rL">Email:</td>',
                        '<td class="rV">{email}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Musical Link</td>',
                        '<td colspan="3" class="rV">{musical_link}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Lama Bernyanyi:</td>',
                        '<td colspan="3" class="rV">{lama_menyanyi}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Tampil Depan Audience:</td>',
                        '<td colspan="3" class="rV">{tampil_depan_audience}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Tampil Acara TV:</td>',
                        '<td class="rV" colspan="3">{tampil_acara_tv}</td>',
                    '</tr>',
                    '<tr>',
                        '<td class="rL">Kejadian Terpenting:</td>',
                        '<td class="rV" colspan="3">{kejadian_terpenting}</td>',
                    '</tr>',
                    '<tr>',
                            '<td class="rL">Penyanyi Idola:</td>',
                            '<td class="rV" colspan="3">{penyanyi_idola}</td>',
                    '</tr>',
                '</table>',
            '</tpl>'
        );

        function popDetail(dID) {
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
                title: 'Detail Pendaftar',
                closeAction: 'hide',
                width: Ext.getBody().getViewSize().width-50,
                height: Ext.getBody().getViewSize().height-50,
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

            store.getProxy().url = mod_url + '&m=jsonitem&data_id=' + dID;
            store.load();
        }

        function publishData() {
            Ext.Msg.show({
                title: 'Confirm',
                msg: 'Publish Selected Data ?',
                buttons: Ext.Msg.YESNO,
                fn: function(btn) {
                    if (btn == 'yes') setpublishData(2);
                }
            });
        }

        function unpublishData() {
            Ext.Msg.show({
                title: 'Confirm',
                msg: 'Unpublish Selected Data ?',
                buttons: Ext.Msg.YESNO,
                fn: function(btn) {
                    if (btn == 'yes') setpublishDataOK(1);
                }
            });
        }

        function markRead() {
            Ext.Msg.show({
                title: 'Confirm',
                msg: 'Mark as Read Selected Data ?',
                buttons: Ext.Msg.YESNO,
                fn: function(btn) {
                    if (btn == 'yes') setpublishData(0);
                }
            });
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

        function setpublishDataOK(jenis) {
            sessChecked();

            var selection = gridDataOK.getView().getSelectionModel().getSelection();
            if (selection) {
                var data = "";
                  for (i = 0; i < selection.length; ++i) data = data + gridDataOK.getSelectionModel().selected.items[i].data.id + "|";
                Ext.Ajax.request({
                    url: mod_url + '&m=publishdata',
                    method: 'POST',
                    params: { postdata: data, set: jenis },
                            success: function(obj) {
                                var resp = obj.responseText;
                                if (resp != 0) {
                                    Ext.MessageBox.alert('Failed', resp);
                                } else {
                                    storeDataOK.load();
                                }
                            }
                });
            }
        }

        function searchArtikel() {
            sessChecked();

            var keyword = Ext.getCmp("keyword").getValue();

            storeData.getProxy().url = mod_url + '&m=json&q='+keyword;
            storeData.load({params: {start: 0, limit: itemsPerPage, page: 1}});
        }

        function searchArtikelOK() {
            sessChecked();

            var keyword = Ext.getCmp("keywordOK").getValue();

            storeDataOK.getProxy().url = mod_url + '&m=jsonok&q='+keyword;
            storeDataOK.load({params: {start: 0, limit: itemsPerPage, page: 1}});
        }

        /* -------------- GRID PANEL -------------- */
        function renderPublish(val) {
            if (val == "1") return "<img src="+base_url+"assets/grid-icons/tick.png width=14 height=14/>";
            return "<img src="+base_url+"assets/grid-icons/cross.png width=14 height=14/>";
        }

        function renderRow(val, meta, rec) {
             if (rec.data.status == "0") meta.tdAttr = 'style="background-color: #FFCC33;"';
            return val;
        }

        Ext.define('modelData', {
            extend: 'Ext.data.Model',
            fields: ['id','tanggal','kategori','kota_audisi','no_registrasi','nama_depan','nama_belakang','jenis_kelamin','kewarganegaraan','alamat','kodepos','kota','tgl_lahir','telp_rumah','telp_kerabat','telp_hp','email','pekerjaan','video','photo1','photo2','musical_link','lama_menyanyi','tampil_depan_audience','tampil_acara_tv','kejadian_terpenting','penyanyi_idola','status']
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

        var storeDataOK = Ext.create('Ext.data.Store', {
            model: 'modelData',
            autoLoad: true,
            pageSize: itemsPerPage,
            proxy: {
                type: 'ajax',
                url : mod_url + '&m=jsonok',
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
            region: 'center',
            width: '100%',
            //title: 'Pendaftar Management',
            columnLines: true,
            selModel: Ext.create('Ext.selection.CheckboxModel', {
                listeners: {
                    selectionchange: function(sm, selections) {
                        <?php
                        if (isset($modAuths['publish'])):
                        ?>
                        gridData.down('#publish').setDisabled(selections.length == 0);
                        gridData.down('#setread').setDisabled(selections.length == 0);
                        <?php endif;?>
                    }
                }
             }),

            <?php if (isset($modAuths['edit'])):?>
                listeners : {
                    itemdblclick: function(dv, record, item, index, e) { popDetail(gridData.getStore().getAt(index).get("id")) }
                },
            <?php endif;?>

            columns: [
                {text:'Kategori', dataIndex:'kategori', align:'center', width:50, renderer:renderRow},
                {text:'Kota Audisi', dataIndex:'kota_audisi', align:'center', width:80, renderer:renderRow},
                {text:'Nama Depan', dataIndex:'nama_depan', width:100, renderer:renderRow},
                {text:'Nama Belakang', dataIndex:'nama_belakang', width:100, renderer:renderRow},
                {text:'Gender', dataIndex:'jenis_kelamin', align:'center', width:60, renderer:renderRow},
                {text:'Tanggal Lahir', dataIndex:'tgl_lahir', align:'center', align:'center', width:80, renderer:renderRow},
                {text:'Kota', dataIndex:'kota', align:'center', width:80, renderer:renderRow},
                {
                    text: 'Photo',
                    renderer:renderRow,
                    columns: [
                        {
                            xtype: "actioncolumn",
                            renderer:renderRow,
                            header:'1',
                            align:'center',
                            width:40,
                            items: [
                                {
                                    getClass: function(v, meta, rec) {
                                        if (rec.get('photo1') != "") {
                                            this.items[0].tooltip = 'View Image File';
                                            return 'image-col';
                                        }
                                    },
                                    handler: function(grid, rowIndex, colIndex) {
                                        var rec = gridData.getStore().getAt(rowIndex);
                                        if (rec.get("photo1") != "") window.open('<?=STATIC_URL?>images/thevoiceindonesia/'+rec.get("photo1"));
                                    }
                                  }
                            ]
                        },{
                            xtype: "actioncolumn",
                            renderer:renderRow,
                            header:'2',
                            align:'center',
                            width:40,
                            items: [
                                {
                                    getClass: function(v, meta, rec) {
                                        if (rec.get('photo2') != "") {
                                            this.items[0].tooltip = 'View Image File';
                                            return 'image-col';
                                        }
                                    },
                                    handler: function(grid, rowIndex, colIndex) {
                                        var rec = gridData.getStore().getAt(rowIndex);
                                        if (rec.get("photo2") != "") window.open('<?=STATIC_URL?>images/thevoiceindonesia/'+rec.get("photo2"));
                                    }
                                }
                            ]
                        }
                    ]
                },{
                    xtype: "actioncolumn",
                    renderer:renderRow,
                    header:'Video',
                    align:'center',
                    width:40,
                    items: [
                        {
                            getClass: function(v, meta, rec) {
                                if (rec.get('video') != "") {
                                    this.items[0].tooltip = 'View Video File';
                                    return 'video-col';
                                }
                            },
                            handler: function(grid, rowIndex, colIndex) {
                                var rec = gridData.getStore().getAt(rowIndex);
                                if (rec.get("video") != "") window.open('<?=STATIC_URL?>video/thevoiceindonesia/'+rec.get("video"));
                            }
                        }
                    ]
                },{
                    xtype: "actioncolumn",
                    renderer:renderRow,
                    width: 40,
                    align: "center",
                    items: [
                        {
                            icon   : base_url + 'assets/grid-icons/eye.png',
                            tooltip: 'Preview Data',
                            handler: function(grid, rowIndex, colIndex) {
                                var rec = gridData.getStore().getAt(rowIndex);
                                popDetail(rec.get("id"));
                            }
                        }
                    ]
                }
            ],
            tbar: new Ext.Toolbar({
                items: [
                    <?php
                    if (isset($modAuths['publish'])):
                    ?>
                        {
                          itemId: 'publish',
                          text: 'Publish',
                          icon: base_url+'assets/grid-icons/accept.png',
                          disabled: true,
                          handler: publishData
                        },'-',{
                          itemId: 'setread',
                          text: 'Set Read',
                          icon: base_url+'assets/grid-icons/delete.png',
                          disabled: true,
                          handler: markRead
                        },'-',
                    <?php endif;?>
                    {
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

        var gridDataOK = Ext.create('Ext.grid.Panel', {
            store: storeDataOK,
            region: 'center',
            width: '100%',
            //title: 'Pendaftar Management',
            columnLines: true,
            selModel: Ext.create('Ext.selection.CheckboxModel', {
                  listeners: {
                      selectionchange: function(sm, selections) {
                          <?php
                          if (isset($modAuths['publish'])):
                          ?>
                          gridDataOK.down('#unpublish').setDisabled(selections.length == 0);
                          <?php endif;?>
                      }
                  }
            }),
            <?php if (isset($modAuths['edit'])):?>
                listeners : {
                    itemdblclick: function(dv, record, item, index, e) { popDetail(gridDataOK.getStore().getAt(index).get("id")) }
                },
            <?php endif;?>
            columns: [
                {text:'Kategori', dataIndex:'kategori', align:'center', width:50, renderer:renderRow},
                {text:'Kota Audisi', dataIndex:'kota_audisi', align:'center', width:80, renderer:renderRow},
                {text:'Nama Depan', dataIndex:'nama_depan', width:100, renderer:renderRow},
                {text:'Nama Belakang', dataIndex:'nama_belakang', width:100, renderer:renderRow},
                {text:'Gender', dataIndex:'jenis_kelamin', align:'center', width:60, renderer:renderRow},
                {text:'Tanggal Lahir', dataIndex:'tgl_lahir', align:'center', align:'center', width:80, renderer:renderRow},
                {text:'Kota', dataIndex:'kota', align:'center', width:80, renderer:renderRow},
                {
                    text: 'Photo',
                    renderer:renderRow,
                    columns: [
                        {
                            xtype: "actioncolumn",
                            renderer:renderRow,
                            header:'1',
                            align:'center',
                            width:40,
                            items: [
                                {
                                    getClass: function(v, meta, rec) {
                                        if (rec.get('photo1') != "") {
                                            this.items[0].tooltip = 'View Image File';
                                            return 'image-col';
                                        }
                                    },
                                    handler: function(grid, rowIndex, colIndex) {
                                        var rec = gridDataOK.getStore().getAt(rowIndex);
                                        if (rec.get("photo1") != "") window.open('<?=STATIC_URL?>images/thevoiceindonesia/'+rec.get("photo1"));
                                    }
                                }
                            ]
                        },{
                            xtype: "actioncolumn",
                            renderer:renderRow,
                            header:'2',
                            align:'center',
                            width:40,
                            items: [
                                {
                                    getClass: function(v, meta, rec) {
                                        if (rec.get('photo2') != "") {
                                            this.items[0].tooltip = 'View Image File';
                                            return 'image-col';
                                        }
                                    },
                                    handler: function(grid, rowIndex, colIndex) {
                                        var rec = gridDataOK.getStore().getAt(rowIndex);
                                        if (rec.get("photo2") != "") window.open('<?=STATIC_URL?>images/thevoiceindonesia/'+rec.get("photo2"));
                                    }
                                }
                            ]
                        }
                    ]
                },{
                    xtype: "actioncolumn",
                    renderer:renderRow,
                    header:'Video',
                    align:'center',
                    width:40,
                    items: [
                        {
                            getClass: function(v, meta, rec) {
                                if (rec.get('video') != "") {
                                    this.items[0].tooltip = 'View Video File';
                                    return 'video-col';
                                }
                            },
                            handler: function(grid, rowIndex, colIndex) {
                                var rec = gridDataOK.getStore().getAt(rowIndex);
                                if (rec.get("video") != "") window.open('<?=STATIC_URL?>video/thevoiceindonesia/'+rec.get("video"));
                            }
                        }
                    ]
                },{
                    xtype: "actioncolumn",
                    renderer:renderRow,
                    width: 40,
                    align: "center",
                    items: [
                        {
                            icon   : base_url + 'assets/grid-icons/eye.png',
                            tooltip: 'Preview Data',
                            handler: function(grid, rowIndex, colIndex) {
                                var rec = gridDataOK.getStore().getAt(rowIndex);
                                popDetail(rec.get("id"));
                            }
                        }
                    ]
                }
            ],
            tbar: new Ext.Toolbar({
                Items: [
                    <?php
                    if (isset($modAuths['publish'])):
                    ?>
                        {
                          itemId: 'unpublish',
                          text: 'Unpublish',
                          icon: base_url+'assets/grid-icons/delete.png',
                          disabled: true,
                          handler: unpublishData
                        },'-',
                    <?php endif;?>
                        {
                            xtype: 'textfield',
                            name: 'keywordOK',
                            id: 'keywordOK',
                            flex: 1,
                            listeners: {
                                specialkey: function(field, e){
                                    if (e.getKey() == e.ENTER) searchArtikelOK();
                                }
                            }
                        },{
                                        xtype: 'button',
                                        text:'<b>Search</b>',
                                        waitMsg: 'searching...',
                                        iconCls: 'toolbar_btnsearch',
                                        handler: searchArtikelOK
                        }
                ]
            }),
            bbar: new Ext.PagingToolbar({
                pageSize: itemsPerPage,
                store: storeDataOK,
                displayInfo: true
            })
        });

        var viewportContent = Ext.create('Ext.Panel', {
            layout: 'border',
            border: false,
            height: Ext.getBody().getViewSize().height-119,
            items: [ gridData ]
        });

        var viewportContentOK = Ext.create('Ext.Panel', {
            layout: 'border',
            border: false,
            height: Ext.getBody().getViewSize().height-119,
            items: [ gridDataOK ]
        });

        var tabs = Ext.create('Ext.tab.Panel', {
            height: Ext.getBody().getViewSize().height-92,
            activeTab: 0,
            border: true,
            plain: false,
            tabPosition: 'top',
            defaults :{
              autoScroll: true,
              bodyPadding: 0
            },
            items: [
                {
                  items: viewportContent,
                  title: 'Peserta Baru'
                },{
                  items: viewportContentOK,
                  title: 'Peserta Terseleksi'
                }
            ]
        });

        maincontent = viewport.getComponent(4);
        maincontent.add(tabs);
        if (maincontent.border) maincontent.border = false;
        maincontent.doLayout();

        Ext.EventManager.onWindowResize(function () {
            tabs.setSize(undefined, Ext.getBody().getViewSize().height-92);
            viewportContent.setSize(undefined, Ext.getBody().getViewSize().height-119);
            viewportContentOK.setSize(undefined, Ext.getBody().getViewSize().height-119);
        });
    });
</script>

<style type="text/css">
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

    .rL {padding:5px;background:#D9E5F3;border-bottom:1px solid #fff;width:150px;font-weight:bold;}
    .rV {padding:5px;background:#EEEEEF;border-bottom:1px solid #fff;}
    .rK {padding:5px;background:#EEEEEF;border-bottom:1px solid #fff;}
</style>
