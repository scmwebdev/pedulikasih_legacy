<script type="text/javascript">
var base_url = '<?=base_url()?>';
var mod_url = '<?=$_SERVER['REQUEST_URI']?>'; 
var myWidth = 0, myHeight = 0;

if(typeof(window.innerWidth) == 'number') {
  //Non-IE
  myWidth = window.innerWidth;
  myHeight = window.innerHeight;
} else if(document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
  //IE 6+ in 'standards compliant mode'
  myWidth = document.documentElement.clientWidth;
  myHeight = document.documentElement.clientHeight;
} else if(document.body && (document.body.clientWidth || document.body.clientHeight)) {
  //IE 4 compatible
  myWidth = document.body.clientWidth;
  myHeight = document.body.clientHeight;
}
Ext.onReady(function(){	
		var itemsPerPage = 23;
		var winForm, winSinopsis, activeForm;
	
		Ext.QuickTips.init();
		    
		Ext.define("modelForm", {
		    extend: "Ext.data.Model",
		    fields: ['l_id','id','judul','tanggal','url_slug','ringkasan','konten','publish','start','limit','page'],
		    sortInfo: {field: 'id', direction: "DESC"}
		});
		
		Ext.override(Ext.form.HtmlEditor, {
		    defaultValue: '',
		    cleanDefaultValue: true,
		    cleanHtml: function(html) {
		        html = String(html);
		        if(Ext.isWebKit){
		            html = html.replace(/\sclass="(?:Apple-style-span|khtml-block-placeholder)"/gi, '');
		        }
		        if(this.cleanDefaultValue){
		            html = html.replace(new RegExp(this.defaultValue), '');
		        }
		        return html;
		    }
		});
		
		var storecontent = Ext.create("Ext.data.Store", {
		    model: "modelForm",
		    id: "modelForm",
		    autoLoad: true,
		    pageSize: itemsPerPage,
		    proxy: {
		        type: "ajax",
		        url: mod_url+'&m=json',
		        simpleSortMode: true,
		        reader: {
		            type: "json",
		            root: "rows",
		            totalProperty: "results"
		        }
		    }
		});

	  function addData() {    
	  		sessChecked();
	  		<?=$this->lowongan_model->formeditor('formInputAdd','formeditoraddid')?> 
	      formInputAdd.getForm().reset();
				formInputAdd.getForm().loadRecord(Ext.create('modelForm', {							        
		        'l_id'    		: '',
		        'judul'	: '',
		        'ringkasan' 	: '',
		        'konten' 	: '',
		        'publish'	: 0
		    }));
		          
	      activeForm = 'input';
		    
        winForm = Ext.widget('window', {
			          title: 'Add Lowongan',
			          closeAction: 'hide',
			          width: 750,
			          height: 550,
			          minHeight: 330,
			          layout: 'fit',
			          resizable: true,
			          modal: true,
			          autoScroll: true,
			          items: formInputAdd,
								listeners: {
								          hide: function() {
								          this.destroy();
								          }
			          }	    	              			          
				});
	      winForm.show();
	  }
	  
	  function editData() {		
	  		sessChecked();
	  		<?=$this->lowongan_model->formeditor('formInputEdit','formeditoreditid')?>   	
				var selection = gridData.getView().getSelectionModel().getSelection()[0];
		    if (selection) {
		          data_id = gridData.getSelectionModel().selected.items[0].data.id;
		    }	  	
				formInputEdit.getForm().reset();
				
				var store = Ext.create('Ext.data.Store', {
				    model: 'modelForm',
				    proxy: {
						    type: 'ajax',
						    url: mod_url+'&m=jsonitem&id='+ data_id,	
						    reader:{
						        type:'json'
						    }
				    },
				    autoLoad: true,
				    listeners: {
				        load: function() {
				            formInputEdit.getForm().loadRecord(store.data.first());
				        }
				    }
				});
				
				activeForm = 'edit';
				
        winForm = Ext.widget('window', {
	              title: 'Edit Events',
	              closeAction: 'hide',
	              width: 750,
	              height: 550,
	              minHeight: 330,
	              layout: 'fit',
	              resizable: true,
	              autoScroll: true,
	              modal: true,
	              items: formInputEdit,
								listeners: {
								          hide: function() {
								          this.destroy();
								          }
			          }	 	              
        });
	      winForm.show();
		}

		//function untuk delete data//
		function deleteData() {
					sessChecked();
		      Ext.Msg.show({
		          title: 'Confirm',
		          msg: 'Delete Selected Data ?',
		          buttons: Ext.Msg.YESNO,
		          icon: Ext.Msg.QUESTION,
		          fn: function(btn) {
		              if (btn == 'yes') {
		                  var selection = gridData.getView().getSelectionModel().getSelection()[0];
		                  if (selection) {
				                  data = gridData.getSelectionModel().selected.items[0].data.id;
				                  Ext.Ajax.request({
				                      url: mod_url+'&m=deletedata',	
				                      method: 'POST',
				                      params: { postdata: data },
											        success: function(obj) {
											                Ext.MessageBox.alert('Success','Data was deleted');
											                storecontent.remove(selection);
											        }
				                  });
		                  }
		              }
		          }
		      });
		}		
/*
		function Showartikel() {
			//if (!winShowartikel) {			
				sessChecked();	
		    var artikelModel = Ext.define('artikelModel', {
		        extend: 'Ext.data.Model',
		        fields: [
		           {name: 'id'},
		           {name: 'title'},
		           {name: 'content'},
		           {name: 'datetime'},
		           {name: 'name'},
		           {name: 'shortdesc'},
		           {name: 'publish'},
		           {name: 'pic_id'}
		        ]
		    });		    
		    var data_id=gridData.getSelectionModel().selected.items[0].data.id;
		    var storeartikel = Ext.create('Ext.data.Store', {
		        model: 'artikelModel',
		        id: 'artikelModel',
		        proxy: {
		            type: 'ajax',
		            simpleSortMode: true,
		            url: mod_url+'&m=jsonview&id='+ data_id,
		            reader: {
		                type: 'json'               
		            }		            
		        },		        
				    autoLoad: true
		    });		    		
				
				var formartikel = new Ext.Panel({
				    id:'panel-preview',
				    width:'100%',
				    autoHeight:true,
				    autoScroll: true,
				    layout:'fit',
				    items: new Ext.DataView({
				        store: storeartikel,
		            tpl: [
		                '<tpl for=".">',
		                	'<style type="text/css">',
											'.pretty-table{  padding: 0;  margin: 0;  border-collapse: collapse;  border: 1px solid #333;  font-family: "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif;  font-size: 0.9em;  color: #000;  background: #bcd0e4 url("widget-table-bg.jpg") top left repeat-x;}.pretty-table caption{  caption-side: bottom;  font-size: 0.9em;  font-style: italic;  text-align: right;  padding: 0.5em 0;}',
											'.pretty-table th, .pretty-table td{  border: 1px dotted #666;  padding: 0.5em;  text-align: left;  color: #632a39;}',
											'.pretty-table th[scope=col]{  color: #000;  background-color: #8fadcc;  text-transform: uppercase;  font-size: 0.9em;  border-bottom: 2px solid #333;  border-right: 2px solid #333;}',
											'.pretty-table th+th[scope=col]{  color: #fff;  background-color: #7d98b3;  border-right: 1px dotted #666;}.pretty-table th[scope=row]{  background-color: #b8cfe5;  border-right: 2px solid #333;}',
											'.pretty-table tr.alt th, .pretty-table tr.alt td{  color: #2a4763;}.pretty-table tr:hover th[scope=row], .pretty-table tr:hover td{  background-color: #632a2a;  color: #fff;}',
											'</style>',
											'<table border="0" style="margin-left:5px;margin-right:5px;" class="pretty-table" cellspacing="0" cellpadding="0" width="650">',									    
											'<tr><td><b>Title :</b></td><td>{title}</td></tr>',
											'<tr><td><b>Content :</b></td><td>{content}</td></tr>',											
											'<tr><td><b>Category :</b></td><td>{name}</td></tr>',																						
											'<tr><td><b>shortdesc :</b></td><td>{shortdesc}</td></tr>',											
											'<tr><td><b>Publish :</b></td><td>{publish}</td></tr>',
											'</table>',
		                '</tpl>'
		            ], 
				        autoHeight:true,
				        itemSelector:''
				    })
				});					

	      winPreview = Ext.create('Ext.window.Window', {
	          title: 'Detail',
	          closeAction: 'hide',
            width: 700,
            height: 400,
            minHeight: 400,
	          layout: 'fit',
	          resizable: true,
	          modal: true,	          
	          items: formartikel,
						listeners: {
						          hide: function() {
						          this.destroy();
						          }
	          }	          
				});
				
				winPreview.show();		        
		           
    }  
*/
	  function renderPublish(val) {
	      if (val == "1") return "<img src="+base_url+"assets/grid-icons/tick.png width=14 height=14/>";
	      return "<img src="+base_url+"assets/grid-icons/cross.png width=14 height=14/>";
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
	              if (btn == 'yes') setpublishData(0);
	          }
	      });
	  }
	  
	  function setpublishData(jenis) {
				sessChecked();

		    var selection = gridData.getView().getSelectionModel().getSelection()[0];
		    if (selection) {
				    data = gridData.getSelectionModel().selected.items[0].data.id;
				    Ext.Ajax.request({
				        url: mod_url+'&m=publishdata',	
				        method: 'POST',
				        params: { postdata: data, set: jenis },
				        success: function(obj) {
				            var resp = obj.responseText;
				            if (resp != 0) {
				                Ext.MessageBox.alert('Failed', resp);
				            } else {
				                storecontent.load();
				            }
				        }											        
				    });
		    }
		}		

	  /* ---------------------- PICTURE SEARCH -------------------------- */
/*
		var winPictureSearch,tplvidPictureSearch,tpldescPictureSearch;
			
		function showPictureSearch(selectedvalue,idx) {
				sessChecked();

				function settplvidPictureSearch(yid) {
						tplvidPictureSearch = '<p align="center"><img src="<?=STATIC_MEDIA?>pictures/'+yid+'"></p>';
				}
				
				function settpldescPictureSearch(vid,vtit,vdesc,yid) {
						tpldescPictureSearch = '<b>Picture ID:</b> '+vid+'<br><b>Title:</b> '+vtit+'<br><b>Description:</b><br>'+vdesc;
				}
				var storePictureSearch = Ext.create('Ext.data.Store', {
				    fields: ['pic_id','pic_title','pic_thumb','pic_big','pic_detail'],
				    pageSize: 50,
				    autoLoad: true,
				    proxy: {
				        type: 'ajax',
				        url : mod_url + '&m=jsonpicture',
				        simpleSortMode: true,
				        reader: {
				            type: 'json',
				            root: 'rows',
				            totalProperty: 'results'
				        }
				    }
				});
			  
				var viewPictureSearch = Ext.create('Ext.view.View', {
			      store: storePictureSearch,
			      tpl: [
				        '<tpl for=".">',
				            '<div class="thumb-wrap" id="{pic_thumb}">',
				            '<div class="thumb"><img src="<?=STATIC_MEDIA?>thumbnail/{pic_thumb}" title="{pic_title}"></div>',
				            '<span class="x-editable">{shortName}</span></div>',
				        '</tpl>',
				        '<div class="x-clear"></div>'
						],
			      height: Ext.getBody().getViewSize().height-188,
			      trackOver: true,
			      autoScroll: true,
			      overItemCls: 'x-item-over',
			      itemSelector: 'div.thumb-wrap',
			      emptyText: 'No images to display',
			      prepareData: function(data) {
			          Ext.apply(data, {
			              shortName: Ext.util.Format.ellipsis(data.pic_id+' - '+data.pic_title, 23)
			          });
			          return data;
			      },
			      listeners: {
			          selectionchange: function(dv, nodes){
										var selection = viewPictureSearch.getSelectionModel().getSelection()[0];
							      if (selection) {
					              panelPictureSearch.down('#select').setDisabled(nodes.length === 0);
					              
					              var picData = viewPictureSearch.getSelectionModel().selected.items[0].data;
					              
												settplvidPictureSearch(picData.pic_big);
		        						Ext.getCmp('previdPictureSearch').body.update(tplvidPictureSearch);
		        						
		        						settpldescPictureSearch(picData.pic_id,picData.pic_title,picData.pic_detail,picData.pic_thumb);
		        						Ext.getCmp('predescPictureSearch').body.update(tpldescPictureSearch);
							      } else
					              panelPictureSearch.down('#select').setDisabled(nodes.length === 0);
			          },
			          itemdblclick: function(dv, record, item, index, e) {
										var pic_id_search = viewPictureSearch.getSelectionModel().selected.items[0].data.pic_id;
										
										var data = "";
						  			var pic_id_tmp = pic_id_search + ',' + Ext.getCmp("pic_id").getValue();
						  			var arr = pic_id_tmp.split(',');
						  			var arr = setArrUnique(arr);
						  			var pic_id_tmp = arr.join(",");
						  			
						  			if (pic_id_tmp.substring(0,1) == ",") pic_id_tmp = pic_id_tmp.substring(1)
						  			
										Ext.getCmp('pic_id').setValue(pic_id_tmp);
											              				
										winPictureSearch.hide();
			          }
			      }
			  })

				function SubmitPictureSelection(idx) {
							sessChecked();
				      Ext.Msg.show({
				          title: 'Confirm',
				          msg: 'Submit Selected Data ?',
				          buttons: Ext.Msg.YESNO,
				          icon: Ext.Msg.QUESTION,
				          fn: function(btn) {
				              if (btn == 'yes') {
						                  var submitedvalue = Ext.getCmp("PictureSelection").getValue();
						                  Ext.Ajax.request({
						                      url: mod_url+'&m=submitpicture',	
						                      method: 'POST',
						                      params: { postdata: submitedvalue,id:idx },
													        success: function(obj) {
													                Ext.MessageBox.alert('Success','Data was submited');
													                winPictureSearch.hide();
													                storecontent.load();
													                
													        }
						                  });
				              }
				          }
				      });
				}				
		
			  var panelPictureSearch = Ext.create('Ext.Panel', {
			      id: 'images-view',
			      width: '100%',
			      region: 'center',
			      items: viewPictureSearch,
						tbar: new Ext.Toolbar({
			          items: [{
			              itemId: 'select',
			              text: 'Select',
			              icon: base_url+'assets/grid-icons/add.png',
			              disabled: true,
			              handler: function() {
												var pic_id_search = viewPictureSearch.getSelectionModel().selected.items[0].data.pic_id;
												
												var data = "";
								  			var pic_id_tmp = pic_id_search + ',' + Ext.getCmp("PictureSelection").getValue();
								  			var arr = pic_id_tmp.split(',');
								  			var arr = setArrUnique(arr);
								  			var pic_id_tmp = arr.join(",");
								  			
								  			if (pic_id_tmp.substring(0,1) == ",") pic_id_tmp = pic_id_tmp.substring(1)
								  			
												Ext.getCmp('PictureSelection').setValue(pic_id_tmp);
													              				
												//winPictureSearch.hide();
			              }		              
			              
								},'-',{
										xtype: 'textfield',
										name: 'keyword',
										id: 'keywordPictureSearch',
										width: 200,
				            listeners: {
				                specialkey: function(field, e){
				                    if (e.getKey() == e.ENTER) {
														    var keyword = Ext.getCmp("keywordPictureSearch").getValue();
														    storePictureSearch.removeAll();
														    storePictureSearch.getProxy().url = mod_url + '&m=jsonpicture&q='+keyword;
														  	storePictureSearch.load({params: {start: 0, limit: 50, page: 1}});
				                    }
				                }
				            }
								},{
										xtype: 'button',
										text:'<b>Search</b>',
										waitMsg: 'searching...',
										iconCls: 'toolbar_btnsearch',
										handler: function() {
										    var keyword = Ext.getCmp("keywordPictureSearch").getValue();
										    storePictureSearch.removeAll();
										    storePictureSearch.getProxy().url = mod_url + '&m=jsonpicture&q='+keyword;
										  	storePictureSearch.load({params: {start: 0, limit: 50, page: 1}});
										}
			          },'  -  <b>Picture Selection: </b>',{
										xtype: 'textfield',
										name: 'Picture Selection',
										id: 'PictureSelection',
										value:selectedvalue,
										width: 200
								},{
										xtype: 'button',
										text:'<b>Submit</b>',
										waitMsg: 'submiting...',
										handler: function() {
											SubmitPictureSelection(idx);
										}										
									}			          
			          ]
						}),
						bbar: new Ext.PagingToolbar({
				        pageSize: 50,
				        store: storePictureSearch,
				        displayInfo: true
			    	})
			  });
				
				var previdPictureSearch = {
				    id: 'previdPictureSearch',
				    region: 'north',
				    split: true,
				    height: 250,
				    bodyStyle: 'background:#eee;',
				    html: '<p align="center">picture preview</p>'
				};
				
				var predescPictureSearch = {
				    id: 'predescPictureSearch',
						region: 'center',
				    bodyStyle: 'background:#eee;',
				    autoScroll: true,
				    bodyPadding: 5,
				    html: '<p align="center">desc preview</p>'
				};
				
				var viewportPictureSearch = Ext.create('Ext.Panel', {
				    layout: 'border',
				    border: false,
				    width: '100%',
				    items: [
				    {
				        layout: 'border',
				        id: 'layout-browser',
				        region:'east',
				        border: false,
				        split:true,
				        width: 300,
				        minSize: 300,
				        maxSize: 300,
				        items: [predescPictureSearch, previdPictureSearch]
				    }, 
				    panelPictureSearch
				    ]
				});
										
	      winPictureSearch = Ext.widget('window', {
	          title: 'Picture List',
	          closeAction: 'hide',
	          width: Ext.getBody().getViewSize().width-100,
	          height: Ext.getBody().getViewSize().height-100,
	          border: false,
	          layout: 'fit',
	          resizable: true,
	          modal: true,
	          items: viewportPictureSearch,
	          listeners: {
        		hide: function() {
	          				this.destroy();
	          		}
	          }
	      });
	      
	      winPictureSearch.show();
		}
*/		
	  /* ---------------------- EO PICTURE SEARCH -------------------------- */		
		
		var gridData = Ext.create('Ext.grid.Panel', {
		    renderTo: Ext.getBody(),
		    store: storecontent,
		    width: '100%',
	      height: '100%',	
		    title: 'Index Lowongan',
    
		    listeners : {
				 			itemdblclick: function(dv, record, item, index, e) { editData() }
				},						        

		    columns: [	    
		    	{text:'Judul', dataIndex:'judul',width:450},
		    	{text:'Tanggal', dataIndex:'tanggal',align:'center', width:200},
		    	{text:'Ringkasan', dataIndex:'ringkasan',align:'center', width:200},
		    	{text:'Publish', dataIndex:'publish',align:'center', width:100, renderer:renderPublish}
				],
				
				tbar: new Ext.Toolbar({
	          items: [
		<?php if (isset($modAuths['add'])):	     ?>     	          
	          {
	              text: 'Add',
	              icon: base_url+'assets/grid-icons/add.png',
	              handler: addData
	          }, '-', 
	          <?php
	          endif;
	          if (isset($modAuths['edit'])): ?>	          
	          {
	              itemId: 'edit',
	              text: 'Edit',
	              icon: base_url+'assets/grid-icons/edit.png',
	              disabled: true,
                handler: editData
	          }, '-', 
			      <?php 
			      endif;
			      if (isset($modAuths['delete'])):?>	    	          
	          {
	              itemId: 'delete',
	              text: 'Delete',
	              icon: base_url+'assets/grid-icons/delete.png',
	              disabled: true
	              ,handler: deleteData
	          },'-',	          
	          <?php endif; ?>        
<?php	if (isset($modAuths['publish'])):
								?>
								{
			              itemId: 'publish',
			              text: 'Publish',
			              icon: base_url+'assets/grid-icons/accept.png',
			              disabled: true,
			              handler: publishData
								},'-',{
			              itemId: 'unpublish',
			              text: 'Unpublish',
			              icon: base_url+'assets/grid-icons/delete.png',
			              disabled: true,
			              handler: unpublishData
			          },'-',
			          <?php endif;?>  	          	          
	          {
										margin: '0 0 0 6',
		                xtype:'textfield',
		                fieldLabel: '',
		                labelWidth: 50,
		                name: 'search_content',
		                id: 'search_content',
		                width: 300,
		                enableKeyEvents: true,
										listeners:{
										    specialkey:function(elem,evnt){
										        //alert(evnt.getKey());
														if(evnt.getKey() == Ext.EventObject.ENTER){
											        var search_content=Ext.getCmp("search_content").getValue();
											        storecontent.getProxy().url = mod_url+'&m=json&search='+search_content;
											        storecontent.load();
														}										        
										    },
										    scope: this                
				            }   		                
						},{
							    xtype: 'button',
							    text:'<b>Search</b>',
							    waitMsg: 'Searching...',
							    iconCls: 'toolbar_btnsearch',
							    handler:function(){
							        var search_content=Ext.getCmp("search_content").getValue();
							        storecontent.getProxy().url = mod_url+'&m=json&search='+search_content;
							        storecontent.load();
							    }   
						}
	          ]
				}),
				
				bbar: new Ext.PagingToolbar({
		        pageSize: itemsPerPage,
		        store: storecontent,
		        displayInfo: true
	    	})
		});
		
		//storecontent.loadPage(0);
		
	  gridData.getSelectionModel().on('selectionchange', function(selModel, selections){
	  	var selection = gridData.getView().getSelectionModel().getSelection()[0];
	  	<?php if (isset($modAuths['edit'])):?>
	      gridData.down('#edit').setDisabled(selections.length == 0);
			<?php
				endif;				
			 if (isset($modAuths['delete'])):?>		      		   
		   if (selection) {			 
		      gridData.down('#delete').setDisabled(selections.length == 0);
		   }else {
		   		gridData.down('#delete').setDisabled(selections.length == 1); 
		   }  
	     <?php 
	     endif;
	     ?> 
			 <?php if (isset($modAuths['publish'])):			 	
			  ?>
		    if (selection) {			  
				  if (gridData.getSelectionModel().selected.items[0].data.publish!="1") {
				  	gridData.down('#publish').setDisabled(selections.length == 0);
				  	gridData.down('#unpublish').setDisabled(selections.length == 1);
					}else {
				  	gridData.down('#unpublish').setDisabled(selections.length == 0);
				  	gridData.down('#publish').setDisabled(selections.length == 1);
					}
				}else {
				  	gridData.down('#unpublish').setDisabled(selections.length == 0);
				  	gridData.down('#publish').setDisabled(selections.length == 0);
				  	gridData.down('#delete').setDisabled(selections.length == 0); 
				}	
			  <?php 
			  endif;?>				  
	  });

    //top.render(document.body);
    content = viewport.getComponent(4);    
    content.add(gridData);    
});
</script>
<style type="text/css">
#images-view .x-panel-body{
    background: white;
    font: 11px Arial, Helvetica, sans-serif;
}
#images-view .thumb{
    background: #dddddd;
    padding: 3px;
    padding-bottom: 0;
}

.x-quirks #images-view .thumb {
    padding-bottom: 3px;
}

#images-view .thumb img{
    height: 60px;
    width: 80px;
}

#images-view .thumb-wrap{
    float: left;
    margin: 4px;
    margin-right: 0;
    padding: 5px;
}
#images-view .thumb-wrap span {
    
    display: block;
    overflow: hidden;
    text-align: center;
    width: 86px; // for ie to ensure that the text is centered
}

#images-view .x-item-over{
    border:1px solid #dddddd;
    background: #efefef url(over.gif) repeat-x left top;
    padding: 4px;
}

#images-view .x-item-selected{
    background: #eff5fb url(selected.gif) no-repeat right bottom;
    border:1px solid #99bbe8;
    padding: 4px;
}
#images-view .x-item-selected .thumb{
    background:transparent;
}

#images-view .loading-indicator {
    font-size:11px;
    background-image:url('../../resources/themes/images/default/grid/loading.gif');
    background-repeat: no-repeat;
    background-position: left;
    padding-left:20px;
    margin:10px;
}

.x-icon-spaces {
	margin-right:3px;
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
}.ext-strict .ext-ie .x-tree .x-panel-bwrap{
    position:relative;
    overflow:hidden;
}
</style>
<div id="imagediv" class="demo-ct"></div>
<div id="videodiv" class="demo-ct"></div>
<div id="twitterdiv" class="demo-ct"></div>