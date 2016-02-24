<script type="text/javascript">
var mod_url = '<?=$_SERVER['REQUEST_URI']?>';

Ext.onReady(function(){		
		var panel = new Ext.Panel({
		    border: true,
		    //frame:true,
		    //autoHeight:true,
		    autoScroll:false,
		    layout:'fit',
		    title:'File Manager',
		    region: 'center',
		    items: [
		    	{
			        xtype : "component",
			        border: false,
			        height: Ext.getBody().getViewSize().height-119,
			        autoEl : {
			            tag : "iframe",
			            frameborder : "0",
			            name : "filemanager",
			            width : "100%",
			            height : "100%",
			            src : "/extplorer/index.php"
			        }
			  	}
		    ]
		});
		
		maincontent = viewport.getComponent(4);
		//maincontent.add(viewportContent);
		maincontent.add(panel);
		if (maincontent.border) maincontent.border = false;
		maincontent.doLayout();
		
		
		Ext.EventManager.onWindowResize(function () {
				//viewportContent.setSize(undefined, Ext.getBody().getViewSize().height-92);
	  });
});
</script>