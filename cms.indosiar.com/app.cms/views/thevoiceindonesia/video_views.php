<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){		
	var itemsPerPage = 50;
	var curDate = '<?=date("Y-m-d")?>';
	var winPanel, winPreview, activeID, activeIDParent, tplYoutube;
	
	function updateTplYoutube(video) {
        tplYoutube = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%" id="single1" name="single1"><param name="movie" value="http://player.longtailvideo.com/player.swf"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="wmode" value="transparent"><param name="flashvars" value="file=<?=STATIC_URL?>thevoiceindonesia/video/{video}&autostart=true"><embed type="application/x-shockwave-flash" id="single2" name="single2" src="http://player.longtailvideo.com/player.swf" width="100%" height="100%" bgcolor="undefined" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" flashvars="file=<?=STATIC_URL?>thevoiceindonesia/video/{video}&autostart=true" /></object>';
	}
	  
    function addData() {
        formInput.getForm().reset();
        formInput.setTitle('Add Video');
        
        formInput.getForm().loadRecord(Ext.create('modelData', {id:'',id_kategori:0,publish:1}));
        Ext.getCmp('video-panel').body.update('');
    }
	  
    function editData() {			
        sessChecked();
        
        formInput.getForm().reset();
        formInput.setTitle('Edit Video');
        
        updateTplYoutube(viewData.getSelectionModel().selected.items[0].data.video);
        Ext.getCmp('video-panel').body.update(tplYoutube);
        
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
		
	  function deleteData() {
	      sessChecked();
	      
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
	  
	  function previewData() {		
				sessChecked();
				
				var vstore = Ext.create('Ext.data.Store', {
				    model: modelData,
				    autoLoad: true,
				    autoDestroy: true,
				    proxy: {
				        type: 'ajax',
				        url : mod_url + '&m=jsonitem&data_id=' + activeID,
				        reader: { type: 'json' }
				    }
				});
				
				var vpanel = new Ext.Panel({
				    id:'panel-preview',
				    width:'100%',
				    autoHeight:true,
				    //autoScroll: true,
				    layout:'fit',
				    items: new Ext.DataView({
				        store: vstore,
				        tpl: [
								'<tpl for=".">',
                                '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="470" height="320" id="single1" name="single1">',
                                    '<param name="movie" value="http://player.longtailvideo.com/player.swf">',
                                    '<param name="allowfullscreen" value="true">',
                                    '<param name="allowscriptaccess" value="always">',
                                    '<param name="wmode" value="transparent">',
                                    '<param name="flashvars" value="file=<?=STATIC_URL?>thevoiceindonesia/video/{video}&autostart=true">',
                                    '<embed type="application/x-shockwave-flash" id="single2" name="single2" src="http://player.longtailvideo.com/player.swf" width="470" height="320" bgcolor="undefined" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" flashvars="file=<?=STATIC_URL?>thevoiceindonesia/video/{video}&autostart=true" />',
                                '</object>',
								'<div style="padding:5px"><h1>{judul}</h1>',
								'{isi}</div>',
								'</tpl>'
								],
				        autoHeight:true,
				        itemSelector:''
				    })
				});

	      winPreview = Ext.create('Ext.window.Window', {
	          title: 'Preview',
	          closeAction: 'hide',
	          width: 500,
	          height: 500,
	          minHeight: 500,
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
  
		function previewVideo() {
	      var url = Ext.getCmp('vid_url_source').getValue();
	      if (url == "") return false;
				if (url.match('http://(www.)?youtube|youtu\.be')){
				    y_id = url.split(/v\/|v=|youtu\.be\//)[1].split(/[?&]/)[0];
				    updateTplYoutube(y_id);
        		Ext.getCmp('video-panel').body.update(tplYoutube);
				}
	  }
	
	  function selectData() {
	  		var selection = viewDataParent.getSelectionModel().getSelection()[0];
	  		if (selection) {
	          Ext.getCmp('vid_parent_id').setValue(activeIDParent);
	          winPanel.hide();
				}
	  }
		
	/* -------------- GRID PANEL -------------- */
	Ext.define('modelData', {
	    extend: 'Ext.data.Model',
	    fields: ['id','id_kategori','judul','judul_url','isi','video','image_thumb','image_medium','image_big','publish']
	});

	function searchVideo() {
	    sessChecked();
	    
	    var keyword = Ext.getCmp("keyword").getValue();
	    storeData.getProxy().url = mod_url + '&m=json&q='+keyword;
	  	storeData.load({params: {start: 0, limit: itemsPerPage, page: 1}});
	}

	var tplImage = [
        '<tpl for=".">',
            '<div class="thumb-wrap" id="{id}">',
            '<div class="thumb"><img src="<?=STATIC_URL?>thevoiceindonesia/video/thumb/{image_thumb}" title="{judul}"></div>',
            '<span class="x-editable">{shortName}</span></div>',
        '</tpl>',
        '<div class="x-clear"></div>'
	];

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
	  
		var viewData = Ext.create('Ext.view.View', {
	      store: storeData,
	      tpl: tplImage,
	      //multiSelect: true,
	      height: Ext.getBody().getViewSize().height-173,
	      trackOver: true,
	      autoScroll: true,
	      overItemCls: 'x-item-over',
	      itemSelector: 'div.thumb-wrap',
	      emptyText: 'No images to display',
	      prepareData: function(data) {
	          Ext.apply(data, {
	              shortName: Ext.util.Format.ellipsis(data.judul, 23)
	              //sizeString: Ext.util.Format.fileSize(data.size),
	              //dateString: Ext.util.Format.date(data.lastmod, "m/d/Y g:i a")
	          });
	          return data;
	      },
	      listeners: {
	          selectionchange: function(dv, nodes){
                    var selection = viewData.getSelectionModel().getSelection()[0];
					      if (selection) {
			              activeID = viewData.getSelectionModel().selected.items[0].data.id;
			              <?php if (isset($modAuths['delete'])):?>
			              panelData.down('#edit').setDisabled(nodes.length === 0);
			              <?php 
			              endif;
			              if (isset($modAuths['delete'])):
			              ?>
			              panelData.down('#delete').setDisabled(nodes.length === 0);
			              <?php endif;?>
			              panelData.down('#view').setDisabled(nodes.length === 0);
					      } else {
					      		activeID = '';
			              <?php if (isset($modAuths['delete'])):?>
			              panelData.down('#edit').setDisabled(nodes.length === 0);
			              <?php 
			              endif;
			              if (isset($modAuths['delete'])):
			              ?>
			              panelData.down('#delete').setDisabled(nodes.length === 0);
			              <?php endif;?>
			              panelData.down('#view').setDisabled(nodes.length === 0);
					      }
	          },
	          itemdblclick: function(dv, record, item, index, e) { editData(); }
	      }
	  })
	  
	  var panelData = Ext.create('Ext.Panel', {
				region: 'center',
	      id: 'images-view',
	      width: '100%',
	      height: winHeight,
	      region: 'center',
	      title: 'Video Management',
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
								<?php endif;?>
								{
			              itemId: 'view',
			              text: 'View',
			              icon: base_url+'assets/grid-icons/eye.png',
			              disabled: true,
			              handler: previewData
								},'-',{
										xtype: 'textfield',
										name: 'keyword',
										id: 'keyword',
										width: 200,
				            listeners: {
				                specialkey: function(field, e){
				                    if (e.getKey() == e.ENTER) searchVideo();
				                }
				            }
								},{
										xtype: 'button',
										text:'<b>Search</b>',
										iconCls: 'toolbar_btnsearch',
										waitMsg: 'searching...',
										handler: searchVideo
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
		    id: 'form-panel',
		    title: 'Add Video',
		    region:'north',
		    border: true,
		    split: true,
		    height: 360,
		    minSize: 150,
	  		url: mod_url + '&m=submitdata',
	      layout: {type: 'vbox', align: 'stretch'},
	      bodyPadding: 7,
	      fieldDefaults: {labelWidth:80},
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
                xtype:'hidden',name:'video'
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
                fieldLabel: 'Video',
                name: 'video_file',
                id:'video_file',
                emptyText: 'format mp4, flv',
                buttonText: 'Browse'
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
	    	]
	    	<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
	    	,buttons: [
			    	{
			          text: 'Reset',
			          handler: addData
			      }, {
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

		var videoPanel = {
		    id: 'video-panel',
		    title: 'Video Preview',
		    region: 'center',
		    bodyStyle: 'background:#eee;',
		    html: '<p align="center">For video preview from youtube.</p>'
		};
		
		var viewportContent = Ext.create('Ext.Panel', {
		    layout: 'border',
		    border: false,
		    height: Ext.getBody().getViewSize().height-92,
		    items: [
						<?php if (isset($modAuths['add']) || isset($modAuths['edit'])):?>
				    {
				        layout: 'border',
				        id: 'layout-browser',
				        region:'east',
				        border: false,
				        split:true,
				        width: 360,
				        items: [formInput, videoPanel]
				    }, 
				    <?php endif;?>
		        panelData
		    ]
		});
		
		maincontent = viewport.getComponent(4);
		maincontent.add(viewportContent);
		if (maincontent.border) maincontent.border = false;
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