<script language="javascript">
Ext.onReady(function(){
	
	Ext.getCmp(centerLayout).setAutoScroll(false);
	function addGroupGridResize(objComp, adjWidth, adjHeight, objOptions)
	{
		Ext.getCmp('datagrid-listgroups').setWidth( Ext.getCmp(menuTBars).getWidth()-2 );
        Ext.getCmp('datagrid-listgroups').setHeight( adjHeight-2 );
	}
	
	Ext.getCmp(centerLayout).removeListener('resize', addGroupGridResize);
	Ext.getCmp(centerLayout).addListener('resize', addGroupGridResize);
	
	var gridStore = new Ext.create('Ext.data.Store', {
		autoLoad: true,
		autoDestroy: true,
		storeId:'groupStores',
		fields:['id', 'name', 'description'],
		model:'Groups',
		proxy: {
			method:'POST',
			type: 'ajax',
			reader: {
				type: 'json',
				root: 'datatable',
				idProperty: 'id',
				totalProperty: 'total'
			},
			url:'?d=cms&c=listgroups&act=data&mods=<?php echo $this->session->idmodule;?>',
			params:{}
		},
		remoteSort: true,
		pageSize:30
	});
	
	new Ext.create('Ext.grid.Panel', {
		id:'datagrid-listgroups',
		title: 'Daftar User Groups',
		store: gridStore,
		<?php if (isset($modAuths['del'])):?>
		selModel: new Ext.create('Ext.selection.CheckboxModel', {
			listeners:{
				selectionchange: function( objThis, arrSelected, objOptions ) 
				{
					var vchecked = [];					
					Ext.Array.each(arrSelected, function(rec){
						vchecked.push(rec.data.id);
					});	
					Ext.getCmp('tfrm_id').setValue(vchecked.join(','));
					if (vchecked.length>0) {
						Ext.getCmp('btnGridDelete').setDisabled(false)						
					} else {
						Ext.getCmp('btnGridDelete').setDisabled(true)
					}
				}
			}
		}),
		<?php endif;?>
		columns: [
			<?php if (isset($modAuths['edit'])):?>
			{
				xtype:'actioncolumn', 
				id:'idact-ctrl',
				width:25,
				items: [
					{
						icon: '<?php echo ICONS;?>icon_edit.gif',  
						tooltip: 'Click here to edit data',
						handler: function(grid, rowIndex, colIndex) {
						
							$.post('?c=sesschecked', '', function(data, status) 
							{					
								if(status == 'success') {
									var obj = jQuery.parseJSON(data);
									if (obj.sess==false){
										window.location.reload(true);
									} else {
																	
										var rec = grid.getStore().getAt(rowIndex);
										Ext.getCmp(centerLayout).setAutoScroll(true);
										Ext.getCmp(statusLayout).clearStatus({useDefaults:true, clear:false});
										Ext.getCmp(centerLayout).getLoader().load({
											loadMask:true,
											scripts:true,
											method:'POST',
											url: '?d=cms&c=groups&act=edit&mods=<?php echo $idmodule;?>',
											params:{id:rec.get('id')},
											failure : function(obj, res){
												Ext.Msg.alert('status : ' + res.statusText, res.responseText);
											}							
										});
																	
									}			
								}	
							});
							
						}
					}
				],
				header: 'ED', 
				align:'center',
				fixed : true,
				dataIndex: 'id',
				menuDisabled : true,
				sortable : false
			},
			<?php endif;?>
			{header: 'Nama Group',  dataIndex: 'name'},
			{header: 'Keterangan', dataIndex: 'description', flex:1}
		],
		features:[
			new Ext.create('Ext.ux.grid.FiltersFeature', {
				encode: true, 
				local: false,   
				filters: [
					{
						type: 'string',
						dataIndex: 'name'
					},
					{
						type: 'string',
						dataIndex: 'description'
					}
				]		
			})
		],
		height: Ext.getCmp(centerLayout).getHeight() - 2,
		width: Ext.getCmp(menuTBars).getWidth() - 2,
		renderTo: 'datacontrol-listgroups',
		dockedItems: [
			Ext.create('Ext.toolbar.Paging', {
				dock: 'bottom',
				displayInfo: true,
				store: gridStore,
				<?php if (isset($modAuths['del'])):?>
				items: [
					{
						xtype: 'button', 
						id:'btnGridDelete',
						text: 'Delete',
						iconCls:'toolbar_btndelete',
						disabled:true,
						listeners:{
							click:function(){
							
								$.post('?c=sesschecked', '', function(data, status) 
								{					
									if(status == 'success') {
										var obj = jQuery.parseJSON(data);
										if (obj.sess==false){
											window.location.reload(true);
										} else {
																		
											if (Ext.getCmp('tfrm_id').getValue()) {
												Ext.getCmp('datagrid-listgroups').getStore().load({params:{del:encodeURI(Ext.getCmp('tfrm_id').getValue())}});
												Ext.getCmp('tfrm_id').setValue('');
											}
																		
										}			
									}	
								});
								
								
							
							}
						}
					},
					{
						xtype: 'hidden',
						id:'tfrm_id',
						value:''
					}
				],
				<?php endif;?>
			})
		]
	});
	
	Ext.getCmp(statusModule).setText('Daftar User Groups');
});
</script>
<div id="datacontrol-listgroups"></div>