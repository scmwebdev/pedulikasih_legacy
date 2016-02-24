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
		    fields: ['vk_id','nama','judulvideo','tanggal','id','ip','komentar','start','limit','page'],
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
	
		var gridData = Ext.create('Ext.grid.Panel', {
		    renderTo: Ext.getBody(),
		    store: storecontent,
		    width: '100%',
	      height: '100%',	
		    title: 'Index Komentar Video',
    
		    listeners : {
				 			itemdblclick: function(dv, record, item, index, e) { editData() }
				},						        

		    columns: [	    
		    	{text:'Tanggal', dataIndex:'tanggal',align:'center', width:120},
		    	{text:'Judul Video', dataIndex:'judulvideo',align:'center', width:250},
		    	{text:'Nama', dataIndex:'nama',align:'center', width:250},
		    	{text:'Komentar', dataIndex:'komentar',align:'left', width:450},
		    	{text:'IP', dataIndex:'ip',align:'center', width:150}
				],
				
				tbar: new Ext.Toolbar({
	          items: [          
	          <?php
			      if (isset($modAuths['delete'])):?>	    	          
	          {
	              itemId: 'delete',
	              text: 'Delete',
	              icon: base_url+'assets/grid-icons/delete.png',
	              disabled: true
	              ,handler: deleteData
	          },'-',	          
	          <?php endif; ?>   	          	          
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
			 <?
			 if (isset($modAuths['delete'])):?>		      		   
		   if (selection) {			 
		      gridData.down('#delete').setDisabled(selections.length == 0);
		   }else {
		   		gridData.down('#delete').setDisabled(selections.length == 1); 
		   }  
	     <?php 
	     endif;
	     ?> 	  	
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