<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function () {
    var itemsPerPage = 100;
    var curDate = '<?=date("Y-m-d")?>';

    /* ---------------------- PICTURE SEARCH -------------------------- */
    var winPictureSearch, tplvidPictureSearch;

    function settplvidPictureSearch(yid) {
        tplvidPictureSearch = '<p align="center"><img width="' + Ext.getCmp('previdPictureSearch').getWidth() + '" src="<?=STATIC_URL?>images/pedulikomunitas/gallery/' + yid + '"></p>';
    }

    function uploadImage(id_album, judul_album) {
        sessChecked();
        
        var storeImage = Ext.create('Ext.data.Store', {
            fields: ['id', 'id_album', 'image', 'keterangan', 'tanggal', 'urutan'],
            pageSize: 50,
            autoLoad: true,
            proxy: {
                type: 'ajax',
                url: mod_url + '&m=jsonimage&id_album=' + id_album,
                simpleSortMode: true,
                reader: {
                    type: 'json',
                    root: 'rows',
                    totalProperty: 'results'
                }
            }
        });

        var viewPictureSearch = Ext.create('Ext.view.View', {
            store: storeImage,
            tpl: [
                    '<tpl for=".">',
                    '<div class="thumb-wrap" id="{image}">',
                    '<div class="thumb"><img src="<?=STATIC_URL?>images/pedulikomunitas/gallery/th_{image}" title="{keterangan}"></div>',
                    '<span class="x-editable">{shortName}</span></div>',
                    '</tpl>',
                    '<div class="x-clear"></div>'
            ],
            height: Ext.getBody().getViewSize().height - 188,
            trackOver: true,
            autoScroll: true,
            overItemCls: 'x-item-over',
            itemSelector: 'div.thumb-wrap',
            emptyText: 'No images to display',
            prepareData: function (data) {
                Ext.apply(data, {
                    shortName: data.urutan + ' - ' + Ext.util.Format.ellipsis(data.keterangan, 20)
                });
                return data;
            },
            listeners: {
                selectionchange: function (dv, nodes) {
                    var selection = viewPictureSearch.getSelectionModel().getSelection()[0];
                    if (selection) {
                        panelPictureSearch.down('#select').setDisabled(nodes.length === 0);

                        var picData = viewPictureSearch.getSelectionModel().selected.items[0].data;

                        settplvidPictureSearch(picData.image);
                        Ext.getCmp('previdPictureSearch').body.update(tplvidPictureSearch);
                    } else
                        panelPictureSearch.down('#select').setDisabled(nodes.length === 0);
                },
                itemdblclick: function (dv, record, item, index, e) {
                    formInputImage.getForm().reset();
                    formInputImage.setTitle('Edit Pictures');

                    var picData = viewPictureSearch.getSelectionModel().selected.items[0].data;

                    settplvidPictureSearch(picData.image);
                    Ext.getCmp('previdPictureSearch').body.update(tplvidPictureSearch);

                    var store = Ext.create('Ext.data.Store', {
                        model: 'modelFormImage',
                        proxy: {
                            type: 'ajax',
                            url: mod_url + '&m=jsonimageitem&data_id=' + picData.id,
                            reader: {
                                type: 'json'
                            }
                        },
                        autoLoad: true,
                        listeners: {
                            load: function () {
                                formInputImage.getForm().loadRecord(store.data.first());
                            }
                        }
                    });
                }
            }
        })

        var panelPictureSearch = Ext.create('Ext.Panel', {
            id: 'images-view',
            width: '100%',
            region: 'center',
            items: viewPictureSearch,
            tbar: new Ext.Toolbar({
                items: [{
                        itemId: 'addImage',
                        text: 'Add Image',
                        icon: base_url + 'assets/grid-icons/add.png',
                        handler: function () {
                            //alert(id_album + ' = ' + id_album_x);
                            formInputImage.getForm().reset();
                            formInputImage.setTitle('Add New Image');
                            formInputImage.getForm().loadRecord(Ext.create('modelFormImage', {
                                'id': '',
                                'id_album': id_album,
                                'urutan': 1
                            }));
                            Ext.getCmp('previdPictureSearch').body.update('');
                        }
                    }, '-', {
                        itemId: 'select',
                        text: 'Delete',
                        icon: base_url + 'assets/grid-icons/trash.png',
                        disabled: true,
                        handler: function () {
                            var picData = viewPictureSearch.getSelectionModel().selected.items[0].data;
                            sessChecked();
                            Ext.Msg.show({
                                title: 'Confirm',
                                msg: 'Delete this image ?',
                                buttons: Ext.Msg.YESNO,
                                fn: function (btn) {
                                    if (btn == 'yes') {
                                        Ext.Ajax.request({
                                            url: mod_url + '&m=deleteimage',
                                            method: 'POST',
                                            params: {
                                                postdata: picData.id
                                            },
                                            success: function (obj) {
                                                var resp = obj.responseText;
                                                if (resp != 0) {
                                                    Ext.MessageBox.alert('Failed', resp);
                                                } else {
                                                    storeImage.load();
                                                    formInputImage.getForm().reset();
                                                    formInputImage.setTitle('Add New Image');
                                                    formInputImage.getForm().loadRecord(Ext.create('modelFormImage', {
                                                        'id': ''
                                                    }));
                                                    Ext.getCmp('previdPictureSearch').body.update('');
                                                }
                                            }
                                        });
                                    }
                                }
                            });

                        }
                    }
                ]
            }),
            bbar: new Ext.PagingToolbar({
                pageSize: 50,
                store: storeImage,
                displayInfo: true
            })
        });

        var previdPictureSearch = {
            id: 'previdPictureSearch',
            region: 'center',
            split: true,
            height: Ext.getBody().getViewSize().height - 250,
            bodyStyle: 'background:#eee;',
            autoScroll: true,
            html: '<p align="center">picture preview</p>'
        };

        Ext.define('modelFormImage', {
            extend: 'Ext.data.Model',
            fields: ['id', 'keterangan', 'image', 'id_album', 'urutan']
        });

        var formInputImage = Ext.create('Ext.form.Panel', {
            id: 'formInputImage',
            title: 'Add Pictures',
            region: 'north',
            border: true,
            split: true,
            height: 250,
            //minSize: 200,
            url: mod_url + '&m=submitimage',
            layout: {
                type: 'vbox',
                align: 'stretch'
            },
            bodyPadding: 7,
            fieldDefaults: {
                labelWidth: 70
            },
            items: [{
                    xtype: 'hidden',
                    name: 'id'
                }, {
                    xtype: 'hidden',
                    name: 'id_album',
                    value: id_album
                }, {
                    xtype: 'hidden',
                    name: 'judul_album',
                    value: judul_album
                }, {
                    xtype: 'displayfield',
                    name: 'judul_album_x',
                    fieldLabel: 'Album',
                    height: 25,
                    value: judul_album
                }, {
                    xtype: 'fileuploadfield',
                    fieldLabel: 'Image',
                    name: 'image_file',
                    emptyText: 'upload image gallery',
                    buttonText: 'Browse'
                }, {
                    xtype: 'numberfield',
                    fieldLabel: 'Urutan',
                    name: 'urutan',
                    maxValue: 100,
                    minValue: 1,
                    allowBlank: false
                }, {
                    xtype: 'textfield',
                    fieldLabel: 'Last Image',
                    name: 'image'
                }, {
                    xtype: 'textarea',
                    labelAlign: 'top',
                    fieldLabel: 'Keterangan',
                    name: 'keterangan',
                    //height: 80,
                    //anchor: '100%',
                    flex: 1
                }
            ],
            buttons: [{
                    text: 'Reset',
                    handler: function () {
                        formInputImage.getForm().reset();
                        formInputImage.setTitle('Add Image');
                    }
                }, 
                <?php if (isset($modAuths['add']) || isset($modAuths['edit'])): ?> 
                {
                    text: 'Submit',
                    formBind: true,
                    handler: function () {
                        formInputImage.getForm().submit({
                            method: 'POST',
                            waitTitle: 'Connecting',
                            waitMsg: 'Sending data...',
                            waitMsgTarget: true,
                            success: function (form, action) {
                                Ext.Msg.alert('Success', 'Data Updated Successful');
                                formInputImage.getForm().reset();
                                formInputImage.setTitle('Add Pictures');
                                storeImage.load();
                            },
                            failure: function (form, action) {
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
                <?php endif; ?>
            ]
        });

        formInputImage.getForm().reset();
        formInputImage.setTitle('Add New Image');
        formInputImage.getForm().loadRecord(Ext.create('modelFormImage', {
            'id': '',
            'id_album': id_album,
            'urutan': 1
        }));

        var viewportPictureSearch = Ext.create('Ext.Panel', {
            layout: 'border',
            border: false,
            width: '100%',
            items: [{
                    layout: 'border',
                    id: 'layout-browser',
                    region: 'east',
                    border: false,
                    split: true,
                    width: 300,
                    minSize: 300,
                    maxSize: 300,
                    items: [formInputImage, previdPictureSearch]
                },
                panelPictureSearch
            ]
        });

        winPictureSearch = Ext.widget('window', {
            title: 'Album: ' + judul_album,
            closeAction: 'hide',
            width: Ext.getBody().getViewSize().width - 50,
            height: Ext.getBody().getViewSize().height - 50,
            border: false,
            layout: 'fit',
            resizable: true,
            modal: true,
            items: viewportPictureSearch,
            listeners: {
                hide: function () {
                    this.destroy();
                }
            }
        });

        winPictureSearch.show();
    }
    /* ---------------------- EO PICTURE SEARCH -------------------------- */


    /* ---------------------- VIDEO SEARCH -------------------------- */
    var winVideoSearch, tplVideoSearch;

    function settplVideoSearch(yid) {
        tplVideoSearch = '<embed src="http://www.youtube.com/v/'+yid+'?fs=1&autoplay=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="100%" height="100%"></embed>';
    }

    function uploadVideo(id_album, judul_album) {
        sessChecked();
        
        var storeVideo = Ext.create('Ext.data.Store', {
            fields: ['id', 'id_album', 'video_url', 'video_url_id', 'keterangan', 'tanggal', 'urutan'],
            pageSize: 50,
            autoLoad: true,
            proxy: {
                type: 'ajax',
                url: mod_url + '&m=jsonvideo&id_album=' + id_album,
                simpleSortMode: true,
                reader: {
                    type: 'json',
                    root: 'rows',
                    totalProperty: 'results'
                }
            }
        });

        var viewVideoSearch = Ext.create('Ext.view.View', {
            store: storeVideo,
            tpl: [
                    '<tpl for=".">',
		            '<div class="thumb-wrap" id="{video_url_id}">',
		            '<div class="thumb"><img src="http://i.ytimg.com/vi/{video_url_id}/default.jpg" title="{keterangan}"></div>',
		            '<span class="x-editable">{shortName}</span></div>',
                    '</tpl>',
                    '<div class="x-clear"></div>'
            ],
            height: Ext.getBody().getViewSize().height - 188,
            trackOver: true,
            autoScroll: true,
            overItemCls: 'x-item-over',
            itemSelector: 'div.thumb-wrap',
            emptyText: 'No videos to display',
            prepareData: function (data) {
                Ext.apply(data, {
                    shortName: data.urutan + ' - ' + Ext.util.Format.ellipsis(data.keterangan, 20)
                });
                return data;
            },
            listeners: {
                selectionchange: function (dv, nodes) {
                    var selection = viewVideoSearch.getSelectionModel().getSelection()[0];
                    if (selection) {
                        panelVideoSearch.down('#select').setDisabled(nodes.length === 0);

                        var picData = viewVideoSearch.getSelectionModel().selected.items[0].data;

                        settplVideoSearch(picData.video_url_id);
                        Ext.getCmp('previdVideoSearch').body.update(tplVideoSearch);
                    } else
                        panelVideoSearch.down('#select').setDisabled(nodes.length === 0);
                },
                itemdblclick: function (dv, record, item, index, e) {
                    formInputVideo.getForm().reset();
                    formInputVideo.setTitle('Edit Video');

                    var picData = viewVideoSearch.getSelectionModel().selected.items[0].data;

                    settplVideoSearch(picData.video_url_id);
                    Ext.getCmp('previdVideoSearch').body.update(tplVideoSearch);

                    var store = Ext.create('Ext.data.Store', {
                        model: 'modelFormVideo',
                        proxy: {
                            type: 'ajax',
                            url: mod_url + '&m=jsonvideoitem&data_id=' + picData.id,
                            reader: {
                                type: 'json'
                            }
                        },
                        autoLoad: true,
                        listeners: {
                            load: function () {
                                formInputVideo.getForm().loadRecord(store.data.first());
                            }
                        }
                    });
                }
            }
        })

        var panelVideoSearch = Ext.create('Ext.Panel', {
            id: 'videos-view',
            width: '100%',
            region: 'center',
            items: viewVideoSearch,
            tbar: new Ext.Toolbar({
                items: [{
                        itemId: 'addImage',
                        text: 'Add Video',
                        icon: base_url + 'assets/grid-icons/add.png',
                        handler: function () {
                            //alert(id_album + ' = ' + id_album_x);
                            formInputVideo.getForm().reset();
                            formInputVideo.setTitle('Add New Video');
                            formInputVideo.getForm().loadRecord(Ext.create('modelFormVideo', {
                                'id': '',
                                'id_album': id_album,
                                'urutan': 1
                            }));
                            Ext.getCmp('previdVideoSearch').body.update('');
                        }
                    }, '-', {
                        itemId: 'select',
                        text: 'Delete',
                        icon: base_url + 'assets/grid-icons/trash.png',
                        disabled: true,
                        handler: function () {
                            var picData = viewVideoSearch.getSelectionModel().selected.items[0].data;
                            sessChecked();
                            Ext.Msg.show({
                                title: 'Confirm',
                                msg: 'Delete this video ?',
                                buttons: Ext.Msg.YESNO,
                                fn: function (btn) {
                                    if (btn == 'yes') {
                                        Ext.Ajax.request({
                                            url: mod_url + '&m=deletevideo',
                                            method: 'POST',
                                            params: {
                                                postdata: picData.id
                                            },
                                            success: function (obj) {
                                                var resp = obj.responseText;
                                                if (resp != 0) {
                                                    Ext.MessageBox.alert('Failed', resp);
                                                } else {
                                                    storeVideo.load();
                                                    formInputVideo.getForm().reset();
                                                    formInputVideo.setTitle('Add New Video');
                                                    formInputVideo.getForm().loadRecord(Ext.create('modelFormVideo', {
                                                        'id': ''
                                                    }));
                                                    Ext.getCmp('previdVideoSearch').body.update('');
                                                }
                                            }
                                        });
                                    }
                                }
                            });

                        }
                    }
                ]
            }),
            bbar: new Ext.PagingToolbar({
                pageSize: 50,
                store: storeVideo,
                displayInfo: true
            })
        });

        var previdVideoSearch = {
            id: 'previdVideoSearch',
            region: 'center',
            split: true,
            height: Ext.getBody().getViewSize().height - 250,
            bodyStyle: 'background:#eee;',
            autoScroll: true,
            html: '<p align="center">picture preview</p>'
        };

        Ext.define('modelFormVideo', {
            extend: 'Ext.data.Model',
            fields: ['id', 'keterangan', 'video_url', 'video_url_id', 'id_album', 'urutan']
        });

        var formInputVideo = Ext.create('Ext.form.Panel', {
            id: 'formInputVideo',
            title: 'Add Video',
            region: 'north',
            border: true,
            split: true,
            height: 250,
            //minSize: 200,
            url: mod_url + '&m=submitvideo',
            layout: {
                type: 'vbox',
                align: 'stretch'
            },
            bodyPadding: 7,
            fieldDefaults: {
                labelWidth: 70
            },
            items: [{
                    xtype: 'hidden',
                    name: 'id'
                }, {
                    xtype: 'hidden',
                    name: 'id_album',
                    value: id_album
                }, {
                    xtype: 'hidden',
                    name: 'judul_album',
                    value: judul_album
                }, {
                    xtype: 'displayfield',
                    name: 'judul_album_x',
                    fieldLabel: 'Album',
                    height: 25,
                    value: judul_album
                }, {
                    xtype: 'textfield',
                    fieldLabel: 'Youtube',
                    name: 'video_url',
                    allowBlank: false
                }, {
                    xtype: 'numberfield',
                    fieldLabel: 'Urutan',
                    name: 'urutan',
                    maxValue: 100,
                    minValue: 1,
                    allowBlank: false
                }, {
                    xtype: 'textarea',
                    labelAlign: 'top',
                    fieldLabel: 'Keterangan',
                    name: 'keterangan',
                    //height: 80,
                    //anchor: '100%',
                    flex: 1
                }
            ],
            buttons: [{
                    text: 'Reset',
                    handler: function () {
                        formInputVideo.getForm().reset();
                        formInputVideo.setTitle('Add Video');
                    }
                }, 
                <?php if (isset($modAuths['add']) || isset($modAuths['edit'])): ?> 
                {
                    text: 'Submit',
                    formBind: true,
                    handler: function () {
                        formInputVideo.getForm().submit({
                            method: 'POST',
                            waitTitle: 'Connecting',
                            waitMsg: 'Sending data...',
                            waitMsgTarget: true,
                            success: function (form, action) {
                                Ext.Msg.alert('Success', 'Data Updated Successful');
                                formInputVideo.getForm().reset();
                                formInputVideo.setTitle('Add Pictures');
                                storeVideo.load();
                            },
                            failure: function (form, action) {
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
                <?php endif; ?>
            ]
        });

        formInputVideo.getForm().reset();
        formInputVideo.setTitle('Add New Video');
        formInputVideo.getForm().loadRecord(Ext.create('modelFormVideo', {
            'id': '',
            'id_album': id_album,
            'urutan': 1
        }));

        var viewportVideoSearch = Ext.create('Ext.Panel', {
            layout: 'border',
            border: false,
            width: '100%',
            items: [{
                    layout: 'border',
                    id: 'layout-browser',
                    region: 'east',
                    border: false,
                    split: true,
                    width: 300,
                    minSize: 300,
                    maxSize: 300,
                    items: [formInputVideo, previdVideoSearch]
                },
                panelVideoSearch
            ]
        });

        winVideoSearch = Ext.widget('window', {
            title: 'Album: ' + judul_album,
            closeAction: 'hide',
            width: Ext.getBody().getViewSize().width - 50,
            height: Ext.getBody().getViewSize().height - 50,
            border: false,
            layout: 'fit',
            resizable: true,
            modal: true,
            items: viewportVideoSearch,
            listeners: {
                hide: function () {
                    this.destroy();
                }
            }
        });

        winVideoSearch.show();
    }
    /* ---------------------- EO VIDEO SEARCH -------------------------- */


    function addData() {
        sessChecked();

        formInput.getForm().reset();
        formInput.setTitle('Add New Album');
        formInput.getForm().loadRecord(Ext.create('modelData', {
            'id': '',
            'tanggal': curDate,
            'tanggal_hh': '<?=date('G')?>',
            'tanggal_mn': '<?=date('i')?>',
            'publish': 1
        }));
    }

    function editData(data_id) {
        sessChecked();

        formInput.getForm().reset();
        formInput.setTitle('Edit Album');

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

    /* -------------- GRID PANEL -------------- */
    function renderPublish(val) {
        if (val == "1") return "<img src=" + base_url + "assets/grid-icons/tick.png width=14 height=14/>";
        return "<img src=" + base_url + "assets/grid-icons/cross.png width=14 height=14/>";
    }

    function renderTick(val) {
        if (val == "") return "<img src=" + base_url + "assets/grid-icons/cross.png width=14 height=14/>";
        return "<img src=" + base_url + "assets/grid-icons/tick.png width=14 height=14/>";
    }

    Ext.define('modelData', {
        extend: 'Ext.data.Model',
        fields: ['id', 'ringkasan', 'judul', 'judul_url', 'pdf', 'isi', 'tanggal', 'tanggal_hh', 'tanggal_mn', 'publish', 'lokasi', 'lokasi_gmap']
    });

    var storeData = Ext.create('Ext.data.Store', {
        model: 'modelData',
        autoLoad: true,
        proxy: {
            type: 'ajax',
            url: mod_url + '&m=json',
            simpleSortMode: true,
            reader: {
                type: 'json'
            }
        }
    });

    var gridData = Ext.create('Ext.grid.Panel', {
        store: storeData,
        width: '100%',
        title: 'Peduli Komunitas Photo Gallery Management',
        region: 'center',
        columnLines: true,
        selModel: Ext.create('Ext.selection.CheckboxModel', {
            listeners: {
                selectionchange: function (sm, selections) { 
                    <?php if (isset($modAuths['delete'])): ?> 
                    gridData.down('#delete').setDisabled(selections.length == 0); 
                    <?php endif; ?>
                }
            }
        }),
        <?php if (isset($modAuths['edit'])): ?> 
        listeners: {
            itemdblclick: function (dv, record, item, index, e) {
                editData(gridData.getStore().getAt(index).get("id"))
            }
        },
        <?php endif; ?>
            columns: [{
                text: 'Judul',
                dataIndex: 'judul',
                sortable: false,
                width: 250
            }, {
                text: 'Tanggal',
                dataIndex: 'tanggal',
                align: 'center',
                sortable: false,
                width: 120
            }, {
                text: 'Publish',
                dataIndex: 'publish',
                align: 'center',
                width: 50,
                sortable: false,
                renderer: renderPublish
            }, {
                xtype: "actioncolumn",
                width: 150,
                align: "center",
                items: [
                    {
                        icon: base_url + 'assets/grid-icons/eye.png',
                        tooltip: 'Preview Data',
                        handler: function (grid, rowIndex, colIndex) {
                            var rec = gridData.getStore().getAt(rowIndex);
                            var uri = 'http://www.indosiar.com/pedulikomunitas/gallery/' + rec.get("judul_url");
                            window.open(uri);
                        }
                    }, 
                    <?php if (isset($modAuths['add']) || isset($modAuths['edit'])): ?> 
                    {
                        icon: base_url + 'assets/grid-icons/image.png',
                        tooltip: 'Upload Image',
                        handler: function (grid, rowIndex, colIndex) {
                            var rec = gridData.getStore().getAt(rowIndex);
                            uploadImage(rec.get("id"), rec.get("judul"));
                        }
                    }, 
                    <?php 
                    endif;
                    
                    if (isset($modAuths['add']) || isset($modAuths['edit'])): ?> 
                    {
                        icon: base_url + 'assets/grid-icons/film.png',
                        tooltip: 'Upload Video',
                        handler: function (grid, rowIndex, colIndex) {
                            var rec = gridData.getStore().getAt(rowIndex);
                            uploadVideo(rec.get("id"), rec.get("judul"));
                        }
                    }, 
                    <?php 
                    endif;
                    
                    if (isset($modAuths['edit'])): ?> {
                        icon: base_url + 'assets/grid-icons/application_edit.png',
                        tooltip: 'Edit Data',
                        handler: function (grid, rowIndex, colIndex) {
                            var rec = gridData.getStore().getAt(rowIndex);
                            editData(rec.get("id"));
                        }
                    }, 
                    <?php
                    endif;
                    if (isset($modAuths['delete'])): 
                    ?> 
                    {
                        icon: base_url + 'assets/grid-icons/trash.png',
                        tooltip: 'Delete Data',
                        handler: function (grid, rowIndex, colIndex) {
                            sessChecked();

                            var rec = grid.getStore().getAt(rowIndex);
                            Ext.Msg.show({
                                title: 'Confirm',
                                msg: 'Delete this data ?',
                                buttons: Ext.Msg.YESNO,
                                fn: function (btn) {
                                    if (btn == 'yes') {
                                        Ext.Ajax.request({
                                            url: mod_url + '&m=deletedata',
                                            method: 'POST',
                                            params: {
                                                postdata: rec.get("id")
                                            },
                                            success: function (obj) {
                                                var resp = obj.responseText;
                                                if (resp != 0) {
                                                    Ext.MessageBox.alert('Failed', resp);
                                                } else {
                                                    Ext.MessageBox.alert('Success', 'Data was deleted');
                                                    storeData.removeAt(rowIndex);
                                                }
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    } 
                    <?php endif; ?>
                ]
            }
        ],
        tbar: new Ext.Toolbar({
            items: [ 
                <?php if (isset($modAuths['delete'])): ?> 
                {
                    itemId: 'delete',
                    text: 'Delete',
                    tooltip: 'Delete Selected Data',
                    icon: base_url + 'assets/grid-icons/trash.png',
                    disabled: true,
                    handler: deleteDataSelection
                }, '-', 
                <?php 
                endif;
                if (isset($modAuths['add'])): 
                ?> 
                {
                    itemId: 'add',
                    text: 'Add',
                    tooltip: 'Add Data',
                    icon: base_url + 'assets/grid-icons/add.png',
                    handler: addData
                } 
                <?php endif; ?>
            ]
        })
    });

    /* -------------- FORM PANEL -------------- */
    var formInput = Ext.create('Ext.form.Panel', {
        url: mod_url + '&m=submitdata',
        layout: {
            type: 'vbox',
            align: 'stretch'
        },
        title: 'Add New Album',
        region: 'east',
        split: true,
        width: 500,
        border: true,
        bodyPadding: 10,
        fieldDefaults: {
            labelWidth: 80,
            anchor: '100%'
        },
        items: [{
                xtype: 'hidden',
                name: 'id'
            }, {
                xtype: 'textfield',
                fieldLabel: '*Judul',
                name: 'judul',
                allowBlank: false
            }, {
                xtype: 'textarea',
                labelAlign: 'top',
                fieldLabel: '*Ringkasan',
                maxLength: 300,
                height: 80,
                anchor: '100%',
                name: 'ringkasan',
                allowBlank: false
            }, {
                xtype: 'textarea',
                labelAlign: 'top',
                fieldLabel: 'Lokasi',
                //maxLength: 300,
                height: 80,
                anchor: '100%',
                name: 'lokasi'
            }, {
                xtype: 'textfield',
                fieldLabel: 'Google Map',
                name: 'lokasi_gmap'
            }, {
                xtype: 'fieldcontainer',
                layout: 'hbox',
                width: 300,
                fieldLabel: 'Tanggal',
                items: [{
                        xtype: 'datefield',
                        format: 'Y-m-d',
                        name: 'tanggal',
                        width: 90,
                        allowBlank: false,
                        margins: '0 5 0 0'
                    }, {
                        xtype: 'numberfield',
                        name: 'tanggal_hh',
                        width: 40,
                        maxValue: 23,
                        minValue: 0,
                        allowBlank: false
                    }, {
                        xtype: 'displayfield',
                        value: ':',
                        margins: '0 5 0 5'
                    }, {
                        xtype: 'numberfield',
                        name: 'tanggal_mn',
                        width: 40,
                        maxValue: 59,
                        minValue: 0,
                        allowBlank: false
                    }
                ]
            }, {
                xtype: 'radiogroup',
                allowBlank: false,
                fieldLabel: '*Publish',
                items: [{
                        boxLabel: 'Yes',
                        name: 'publish',
                        inputValue: 1
                    }, {
                        boxLabel: 'No',
                        name: 'publish',
                        inputValue: 0
                    }
                ]
            }, {
                xtype: 'tinymcefield',
                name: 'isi',
                hideLabel: true,
                anchor: '100%',
                height: Ext.getBody().getViewSize().height - 290,
                tinymceConfig: {
                    theme_advanced_buttons1: "fullscreen,|,bold,italic,underline,strikethrough,sub,sup,forecolor,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect",
                    theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,undo,redo,|,blockquote,hr,link,unlink,|,image,insertimage,media,charmap,|,code,preview,cleanup,removeformat",
                    theme_advanced_buttons3: "bullist,numlist,|,outdent,indent,|,tablecontrols",
                    theme_advanced_buttons4: "",
                    extended_valid_elements: "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
                    skin: 'o2k7'
                }
            }
        ] 
        <?php if (isset($modAuths['add']) || isset($modAuths['edit'])): ?> 
        , buttons: [{
                text: 'Reset',
                handler: function () {
                    addData();
                }
            }, {
                text: 'Submit',
                formBind: false,
                handler: function () {
                    sessChecked();

                    formInput.getForm().submit({
                        method: 'POST',
                        waitTitle: 'Connecting',
                        waitMsg: 'Sending data...',
                        waitMsgTarget: true,
                        success: function (form, action) {
                            Ext.Msg.alert('Success', 'Data Updated Successful');
                            addData();
                            storeData.load();
                        },
                        failure: function (form, action) {
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
        <?php endif; ?>
    });

    addData();

    var viewportContent = Ext.create('Ext.Panel', {
        layout: 'border',
        border: false,
        items: [ 
                <?php if (isset($modAuths['add']) || isset($modAuths['edit'])): ?>
                formInput, 
                <?php endif; ?>
                gridData
        ],
        height: Ext.getBody().getViewSize().height - 92
    });

    maincontent = viewport.getComponent(4);
    maincontent.add(viewportContent);
    if (maincontent.border) maincontent.border = false;
    maincontent.doLayout();

    Ext.EventManager.onWindowResize(function () {
        viewportContent.setSize(undefined, Ext.getBody().getViewSize().height - 92);
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


/* Video Thumb List */
#videos-view .x-panel-body, #videos-view-parent .x-panel-body {
    background: white;
    font: 11px Arial, Helvetica, sans-serif;
}
#videos-view .thumb, #videos-view-parent .thumb{
    background: #dddddd;
    padding: 3px;
    padding-bottom: 0;
}

.x-quirks #videos-view .thumb, .x-quirks #videos-view-parent .thumb {
    padding-bottom: 3px;
}

#videos-view .thumb img, #videos-view-parent .thumb img{
    height: 90px;
    width: 120px;
}
#videos-view .thumb-wrap, #videos-view-parent .thumb-wrap{
    float: left;
    margin: 4px;
    margin-right: 0;
    padding: 5px;
}
#videos-view .thumb-wrap span, #videos-view-parent .thumb-wrap span {
    display: block;
    overflow: hidden;
    text-align: center;
    width: 120px; // for ie to ensure that the text is centered
}

#videos-view .x-item-over, #videos-view-parent .x-item-over{
    border:1px solid #dddddd;
    background: #efefef url('/assets/images/over.gif') repeat-x left top;
    padding: 4px;
}

#videos-view .x-item-selected, #videos-view-parent .x-item-selected{
    background: #eff5fb url('/assets/images/selected.gif') no-repeat right bottom;
    border:1px solid #99bbe8;
    padding: 4px;
}
#videos-view .x-item-selected .thumb, #videos-view-parent .x-item-selected .thumb{
    background:transparent;
}

#videos-view .loading-indicator, #videos-view-parent .loading-indicator {
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