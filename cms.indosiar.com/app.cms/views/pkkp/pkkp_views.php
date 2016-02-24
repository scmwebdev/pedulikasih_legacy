<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){		
		var itemsPerPage = 50;
		var curDate = '<?=date("Y-m-d")?>';
		var winForm, activeForm;
	  	   
		var formUpload = Ext.create('Ext.form.Panel', {
		  	url: mod_url+'&m=submitdata',		
		  	title: 'Upload Excel Peduli Kasih & Kita Peduli',
		  	renderTo: 'formupload',
		    border: true,
		    bodyPadding: 10,
		    autoScroll: true,
		    fieldDefaults: {labelAlign: 'left', labelWidth: 180},
		    defaults: {margins: '0 0 5 0'},
		    items: [			
				{
		        xtype: 'radiogroup',
		        fieldLabel: 'Kategori',
		        width:200,
		        anchor:'55%',
		        allowBlank: false,
		        items: [
		            {boxLabel: 'Peduli Kasih', name: 'pkkp', inputValue: 'pedulikasih'},
		            {boxLabel: 'Kita Peduli', name: 'pkkp', inputValue: 'kitapeduli'}
		        ]
		    },
				{
		        xtype: 'fieldcontainer',
		        layout: 'hbox',
		        anchor:'100%',
		        fieldLabel: 'File Excel 2007 (xlsx)',
		        width:800,
		        labelAlign: 'left',   
		        allowBlank: false,
		        items:[   			           				      			      			          
						{
						    xtype: 'filefield',
						    id: 'excel',
						    msgTarget: 'side',
						    emptyText: 'Masukan upload...',
						    fieldLabel: '',
						    name: 'excel',							      
						    anchor:'60%',
						    labelAlign: 'left',
						    width:300,
						    margins: '0 10 0 0',								    
								buttonText: 'Browse'
						}]
				}		
		    ],
		    buttonAlign : 'center',
		    buttons: [{
		        text: 'Cancel',
		        handler: function() {
		            formUpload.getForm().reset();
		            this.up('window').hide();
		        }
		    }, {
		        text: 'Submit',
		        formBind: true,
		        handler:function(){
		            formUpload.getForm().submit({ 			              		
		                method:'POST', 
		                waitTitle:'Connecting', 
		                waitMsg:'Sending data...',
		                waitMsgTarget:true,
		
		                success:function(form, action) {
		                		Ext.Msg.alert('Success', 'Data Updated Successful');
		              	},
		
		                failure:function(form, action){
												if (action.failureType == 'server') {
														obj = Ext.JSON.decode(action.response.responseText);
														alert('Format Excel tidak cocok, gunakan format excel 2007 ( .xlsx )');
												} else {
														Ext.Msg.alert('Warning!', 'Authentication server is unreachable : ' + action.response.responseText);
												}
		                } 
		            }); 
		        } 
		    }]
		});

		/* -------------- FORM PANEL -------------- */	  		
/*
		var viewportContent = Ext.create('Ext.Panel', {
		    layout: 'border',
		    items: [
		    	formUpload
		    ],
		    border: false,
			  height: Ext.getBody().getViewSize().height-92
		});
	
		maincontent = viewport.getComponent(4);
		maincontent.add(viewportContent);
		if (maincontent.border) maincontent.border = false;
		maincontent.doLayout();

		Ext.EventManager.onWindowResize(function () {
				viewportContent.setSize(undefined, Ext.getBody().getViewSize().height-92);
	  });
*/	  
});
</script>
<style type="text/css">
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
<div id="formupload"></div>