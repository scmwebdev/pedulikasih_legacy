<script type="text/javascript">
    var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

    Ext.onReady(function(){
        var itemsPerPage = 50;
        var activeID     = 0;
        var curDate      = '<?=date("Y-m-d")?>';
        
        <?php
        switch ($modSeleksi) {
            case 'ok':
                echo "var json = 'jsonok';";
                break;
            case 'ko':
                echo "var json = 'jsonko';";
                break;
            case 'content':
                echo "var json = 'jsoncontent';";
                break;
            default:
                echo "var json = 'json';";
        }
        ?>
        
        var tplx = new Ext.XTemplate(
            '<tpl for=".">',
                '<table width="100%" cellpadding="3" cellspacing="0"><tr><td class="rN">1</td><td class="rL">Nama Lengkap :</td><td class="rV">{nama_lengkap}</td><td class="rN">10</td><td class="rL">Tempat / Tanggal Lahir :</td><td class="rV">{tempat_lahir}&nbsp;/&nbsp;{tanggal_lahir}</td><td rowspan="14" align="center" valign="top"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="470" height="320" id="single1" name="single1"><param name="movie" value="http://player.longtailvideo.com/player.swf"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="wmode" value="transparent"><param name="flashvars" value="file={video}&autostart=true"><embed type="application/x-shockwave-flash" id="single2" name="single2" src="http://player.longtailvideo.com/player.swf" width="470" height="320" bgcolor="undefined" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" flashvars="file={video}&autostart=true" /></object></td></tr><tr><td class="rN">&nbsp;</td><td class="rL">Nama Panggilan :</td><td class="rV">{nama_panggilan}</td><td class="rN">11</td><td class="rL">Alamat Rumah:</td><td class="rV">{alamat_rumah}</td></tr><tr><td class="rN">2</td><td class="rL">Jenis Kelamin :</td><td class="rV">{jenis_kelamin}</td><td class="rN">&nbsp;</td><td class="rL">RT/RW :</td><td class="rV">{rt_rw}</td></tr><tr><td class="rN">3</td><td class="rL">Usia :</td><td class="rV">{usia} tahun</td><td class="rN">&nbsp;</td><td class="rL">Kelurahan :</td><td class="rV">{kelurahan}</td></tr><tr><td class="rN">4</td><td class="rL">Tinggi / Berat Badan :</td><td class="rV">{tinggi_badan} cm &nbsp;/&nbsp; {berat_badan} kg</td><td class="rN">&nbsp;</td><td class="rL">Kecamatan :</td><td class="rV">{kecamatan}</td></tr><tr><td class="rN">5</td><td class="rL">Ukuran Pakaian:</td><td class="rV">&nbsp;</td><td class="rN">&nbsp;</td><td class="rL">Kota :</td><td class="rV">{kota}</td></tr><tr><td class="rN">&nbsp;</td><td class="rL">Baju :</td><td class="rV">{ukuran_baju}</td><td class="rN">&nbsp;</td><td class="rL">Kode Pos :</td><td class="rV">{kodepos}</td></tr><tr><td class="rN">&nbsp;</td><td class="rL">Kemeja :</td><td class="rV">{ukuran_kemeja}</td><td class="rN">12</td><td class="rL">No Telepon / HP :</td><td class="rV">{no_telepon} / {no_hp}</td></tr><tr><td class="rN">&nbsp;</td><td class="rL">Celana :</td><td class="rV">{ukuran_celana}</td><td class="rN">13</td><td class="rL">Alamat Email :</td><td class="rV">{email}</td></tr><tr><td class="rN">&nbsp;</td><td class="rL">Sepatu :</td><td class="rV">{ukuran_sepatu}</td><td class="rN">14</td><td valign="top" class="rL">Kepemilikan Rumah :</td><td class="rV">{kepemilikan_rumah}</td></tr><tr><td class="rN">6</td><td class="rL">Agama :</td><td class="rV">{agama}</td><td class="rN">&nbsp;</td><td class="rL">&nbsp;</td><td class="rV">Lainnya : {kepemilikan_rumah_lainnya}</td></tr><tr><td class="rN">7</td><td class="rL">Kewarganegaraan :</td><td class="rV">{kewarganegaraan}</td><td class="rN">15</td><td class="rL">Lama Menetap :</td><td class="rV">{lama_menetap_tahun} tahun &nbsp;&nbsp;&nbsp; {lama_menetap_bulan} bulan</td></tr><tr><td class="rN">8</td><td class="rL">Nomor KTP :</td><td class="rV">{no_ktp}</td><td class="rN">16</td><td class="rL">Profesi :</td><td class="rV">{profesi}</td></tr><tr><td class="rN">9</td><td class="rL">Nomor NPWP :</td><td class="rV">{no_npwp}</td><td class="rN">17</td><td class="rL">Catatan :</td><td class="rV">{catatan}</td></tr></table>',
            '</tpl>'
        );

        function popDetail(dID) {
            var store = Ext.create('Ext.data.Store', {
                model: 'modelData',
                proxy: {
                    type: 'ajax',
                    reader:{ type:'json' }
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
        
        function popCatatan(dID) {
            sessChecked();

            Ext.define('modelForm', {
                extend: 'Ext.data.Model',
                fields: ['<?=implode("','", $fields)?>']
            });

            var formInput = Ext.create('Ext.form.Panel', {
                url: mod_url + '&m=submitdata',
			    layout: {type: 'vbox', align: 'stretch'},
			    //split:true,
			    width: '100%',
			    border: false,
			    bodyPadding: 7,
			    fieldDefaults: {labelWidth: 100, anchor: '100%'},
			    items: [{
			        xtype: 'hidden',
			        name: 'id'
	         	},{
                    xtype: 'textfield',
                    fieldLabel: 'Catatan',
                    name: 'catatan',
                    allowBlank: false,
                    flex: 1
                }]
			    
                <?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
			    ,buttons: [
                    {
                        text: 'Close',
                        handler: function() {
                            winFormArtikel.close();
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
                                    storeData.load();
                                    winFormArtikel.close();
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
	  
            winFormArtikel = Ext.widget('window', {
                title: 'Add Catatan',
                closeAction: 'hide',
                width: Ext.getBody().getViewSize().width / 2,
                height: 70,
                layout: 'fit',
                resizable: true,
                modal: true,
                items: formInput,
                listeners: {
                    hide: function() {
                        this.destroy();
                    }
                }
            });
            
            winFormArtikel.show();

            var store = Ext.create('Ext.data.Store', {
                model: 'modelForm',
                proxy: {
                    type: 'ajax',
                    url : mod_url + '&m=jsonitem&data_id=' + dID,
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
                    if (btn == 'yes') setpublishData(2);
                }
            });
        }

        function contentData() {
            Ext.Msg.show({
                title: 'Confirm',
                msg: 'Set to Content the Selected Data ?',
                buttons: Ext.Msg.YESNO,
                fn: function(btn) {
                    if (btn == 'yes') setpublishData(3);
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

        function searchArtikel() {
            sessChecked();

            var keyword = Ext.getCmp("keyword").getValue();

            storeData.getProxy().url = mod_url + '&m=' + json + '&q=' + keyword;
            storeData.load({params: {start: 0, limit: itemsPerPage, page: 1}});
        }

        /* -------------- GRID PANEL -------------- */
        function renderPublish(val) {
            if (val == "1") return "<img src="+base_url+"assets/grid-icons/tick.png width=14 height=14/>";
            return "<img src="+base_url+"assets/grid-icons/cross.png width=14 height=14/>";
        }

        function renderRow(val, meta, rec) {
            //if (rec.data.status == "0") meta.tdAttr = 'style="background-color: #FFCC33;"';
            return val;
        }

        Ext.define('modelData', {
            extend: 'Ext.data.Model',
            fields: ['<?=implode("','", $fields)?>']
        });

        var storeData = Ext.create('Ext.data.Store', {
            model: 'modelData',
            autoLoad: true,
            pageSize: itemsPerPage,
            proxy: {
                type: 'ajax',
                url : mod_url + '&m=' + json,
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
            title: '<?=$modTitle?>',
            columnLines: true,
            selModel: Ext.create('Ext.selection.CheckboxModel', {
                listeners: {
                    selectionchange: function(sm, selections) {
                        <?php
                        if (isset($modAuths['publish'])):
                            if ($modSeleksi == 'baru'):
                        ?>
                        
                        gridData.down('#publish').setDisabled(selections.length == 0);
                        gridData.down('#unpublish').setDisabled(selections.length == 0);
                        gridData.down('#content').setDisabled(selections.length == 0);
                        
                        <?php
                            endif;
                            if ($modSeleksi == 'ko'):
                        ?>
                        
                        gridData.down('#publish').setDisabled(selections.length == 0);
                        gridData.down('#content').setDisabled(selections.length == 0);
                        
                        <?php
                            endif;
                            
                            if ($modSeleksi == 'ok'):
                        ?>
                        
                        
                        gridData.down('#unpublish').setDisabled(selections.length == 0);
                        gridData.down('#content').setDisabled(selections.length == 0);
                        
                        <?php
                            endif;
                            
                            if ($modSeleksi == 'content'):
                        ?>
                        
                        gridData.down('#publish').setDisabled(selections.length == 0);
                        gridData.down('#unpublish').setDisabled(selections.length == 0);
                        
                        <?php
                            endif;
                        endif;
                        ?>
                    }
                }
             }),

            <?php if (isset($modAuths['edit'])):?>
                listeners : {
                    itemdblclick: function(dv, record, item, index, e) { popDetail(gridData.getStore().getAt(index).get("id")) }
                },
            <?php endif;?>

            columns: [
                {text:'Nama Lengkap', dataIndex:'nama_lengkap', width:100, renderer:renderRow},
                {text:'Usia', dataIndex:'usia', align:'center', width:40, renderer:renderRow},
                {text:'Profesi', dataIndex:'profesi', align:'center', width:100, renderer:renderRow},
                {text:'Telepon', dataIndex:'no_telepon', align:'center', width:80, renderer:renderRow},
                {text:'HP', dataIndex:'no_hp', align:'center', width:80, renderer:renderRow},
                {text:'Email', dataIndex:'email', align:'center', width:100, renderer:renderRow},
                {
                    text: 'Foto',
                    renderer:renderRow,
                    columns: [
                        {
                            xtype: "actioncolumn",
                            renderer:renderRow,
                            header:'Full',
                            align:'center',
                            width:40,
                            items: [
                                {
                                    getClass: function(v, meta, rec) {
                                        if (rec.get('foto_full') != "") {
                                            this.items[0].tooltip = 'View Image File';
                                            return 'image-col';
                                        }
                                    },
                                    handler: function(grid, rowIndex, colIndex) {
                                        var rec = gridData.getStore().getAt(rowIndex);
                                        if (rec.get("foto_full") != "") window.open('<?=STATIC_URL?>takemeout/registrasi/'+rec.get("foto_full"));
                                    }
                                }
                            ]
                        },{
                            xtype: "actioncolumn",
                            renderer:renderRow,
                            header:'Close',
                            align:'center',
                            width:40,
                            items: [
                                {
                                    getClass: function(v, meta, rec) {
                                        if (rec.get('foto_closeup') != "") {
                                            this.items[0].tooltip = 'View Image File';
                                            return 'image-col';
                                        }
                                    },
                                    handler: function(grid, rowIndex, colIndex) {
                                        var rec = gridData.getStore().getAt(rowIndex);
                                        if (rec.get("foto_closeup") != "") window.open('<?=STATIC_URL?>takemeout/registrasi/'+rec.get("foto_closeup"));
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
                                if (rec.get("video") != "") window.open('<?=STATIC_URL?>takemeout/registrasi/'+rec.get("video"));
                            }
                        }
                    ]
                },
                {text:'Catatan', dataIndex:'catatan', width:150, renderer:renderRow},                
                {
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
                }, {
                    xtype: "actioncolumn",
                    renderer:renderRow,
                    width: 40,
                    align: "center",
                    items: [
                        {
                            icon   : base_url + 'assets/grid-icons/edit.png',
                            tooltip: 'Beri Catatan',
                            handler: function(grid, rowIndex, colIndex) {
                                var rec = gridData.getStore().getAt(rowIndex);
                                popCatatan(rec.get("id"));
                            }
                        }
                    ]
                }
            ],
            tbar: new Ext.Toolbar({
                items: [
                    <?php
                    if (isset($modAuths['publish'])):

                        if ($modSeleksi == 'baru'):
                    ?>
                        
                        {
                          itemId: 'publish',
                          text: 'Publish',
                          icon: base_url+'assets/grid-icons/accept.png',
                          disabled: true,
                          handler: publishData
                        },'-',
                        {
                          itemId: 'unpublish',
                          text: 'Unpublish',
                          icon: base_url+'assets/grid-icons/delete.png',
                          disabled: true,
                          handler: unpublishData
                        },'-',
                        {
                          itemId: 'content',
                          text: 'Content',
                          icon: base_url+'assets/grid-icons/layout_content.png',
                          disabled: true,
                          handler: contentData
                        },'-',
                        
                    <?php
                        endif;
                        
                        if ($modSeleksi == 'ko'):
                    ?>
                        
                        {
                          itemId: 'publish',
                          text: 'Publish',
                          icon: base_url+'assets/grid-icons/accept.png',
                          disabled: true,
                          handler: publishData
                        },'-',
                        {
                          itemId: 'content',
                          text: 'Content',
                          icon: base_url+'assets/grid-icons/layout_content.png',
                          disabled: true,
                          handler: contentData
                        },'-',
                        
                    <?php
                        endif;
                        
                        if ($modSeleksi == 'ok'):
                    ?>
                        
                        {
                          itemId: 'unpublish',
                          text: 'Unpublish',
                          icon: base_url+'assets/grid-icons/delete.png',
                          disabled: true,
                          handler: unpublishData
                        },'-',
                        {
                          itemId: 'content',
                          text: 'Content',
                          icon: base_url+'assets/grid-icons/layout_content.png',
                          disabled: true,
                          handler: contentData
                        },'-',
                        
                    <?php
                        endif;
                        
                        if ($modSeleksi == 'content'):
                    ?>
                        
                        {
                          itemId: 'publish',
                          text: 'Publish',
                          icon: base_url+'assets/grid-icons/accept.png',
                          disabled: true,
                          handler: publishData
                        },'-',
                        {
                          itemId: 'unpublish',
                          text: 'Unpublish',
                          icon: base_url+'assets/grid-icons/delete.png',
                          disabled: true,
                          handler: unpublishData
                        },'-',
                        
                    <?php
                        endif;
                        
                    endif;
                    ?>
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


        var viewportContent = Ext.create('Ext.Panel', {
            layout: 'border',
            border: false,
            height: Ext.getBody().getViewSize().height-92,
            items: [ gridData ]
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

.rN {padding:5px;background:#D9E5F3;border-bottom:1px solid #fff;width:30px;font-weight:bold;}
.rL {padding:5px;background:#D9E5F3;border-bottom:1px solid #fff;width:180px;font-weight:bold;}
.rV {padding:5px;background:#EEEEEF;border-bottom:1px solid #fff;}
.rK {padding:5px;background:#EEEEEF;border-bottom:1px solid #fff;}
</style>