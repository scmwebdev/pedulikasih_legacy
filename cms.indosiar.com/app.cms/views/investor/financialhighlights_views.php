<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){
    var formInput = Ext.create('Ext.form.Panel', {
        url: mod_url + '&m=submitdata',
        layout: {type: 'vbox', align: 'stretch'},
        title: 'Financial Highlights',
        //split:true,
        region: 'center',
        width: '100%',
        border: true,
        //bodyPadding: 7,
        fieldDefaults: {labelWidth: 100, anchor: '100%'},
        items: [{
            xtype: 'tinymcefield',
            name: 'isi',
            hideLabel: true,
            anchor: '100%',
            height: Ext.getBody().getViewSize().height-131,
            tinymceConfig: {}
        }]
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
    });

	var storeFHL = Ext.create('Ext.data.Store', {
	    fields: ['isi'],
	    proxy: {
			    type: 'ajax',
			    url : mod_url + '&m=json',
			    reader:{
			        type:'json'
			    }
	    },
	    autoLoad: true,
	    listeners: {
	        load: function() {
	            formInput.getForm().loadRecord(storeFHL.data.first());
	        }
	    }
	});
	
	var viewportContent = Ext.create('Ext.Panel', {
	    layout: 'border',
        border: false,
	    height: Ext.getBody().getViewSize().height-92,
	    items: [formInput]
	});

    maincontent = viewport.getComponent(4);
    maincontent.add(viewportContent);
    if (maincontent.border) maincontent.border = false;
    maincontent.doLayout();
    
    Ext.EventManager.onWindowResize(function () {
        //tabs.setSize(undefined, Ext.getBody().getViewSize().height-92);
        viewportContent.setSize(undefined, Ext.getBody().getViewSize().height-50);
        //viewportContentColumn.setSize(undefined, Ext.getBody().getViewSize().height-119);
    });
});
</script>