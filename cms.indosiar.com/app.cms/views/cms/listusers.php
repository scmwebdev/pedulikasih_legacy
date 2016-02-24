<script language="javascript">
Ext.onReady(function(){

	Ext.getCmp(centerLayout).setAutoScroll(false);
	function addUserGridResize(objComp, adjWidth, adjHeight, objOptions)
	{
		Ext.getCmp('datagrid-listusers').setHeight( adjHeight-2 );
		Ext.getCmp('datagrid-listusers').setWidth( Ext.getCmp(menuTBars).getWidth()-2 );
	}
	
	Ext.getCmp(centerLayout).removeListener('resize', addUserGridResize);
	Ext.getCmp(centerLayout).addListener('resize', addUserGridResize);
	
	var gridStore = new Ext.create('Ext.data.Store', {
		autoLoad: true,
		autoDestroy: true,
		storeId:'usersAccountStore',
		fields:[
				{name: 'id', type: 'number'}, 
				{name: 'uid', type: 'string'}, 
				{name: 'name', type: 'string'}, 
				{name: 'grp', type: 'string'}, 
				{name: 'status', type: 'number'}, 
				{name: 'email', type: 'string'}
		],
		model:'Users',
		proxy: {
			method:'POST',
			type: 'ajax',
			reader: {
				type: 'json',
				root: 'datatable',
				idProperty: 'id',
                totalProperty: 'total'
			},
			url:'?d=cms&c=listusers&act=data&mods=<?php echo $this->session->idmodule;?>',
			params:{}
		},
		remoteSort: true,
		pageSize:30
	});
	
	new Ext.create('Ext.grid.Panel', {
		id:'datagrid-listusers',
		title: 'Daftar User Accounts',
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
											url: '?d=cms&c=users&act=edit&mods=<?php echo $idmodule;?>',
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
			{
				header: 'Stat', 
				align:'center',
				fixed : true,
				dataIndex: 'status',
				menuDisabled : true,
				sortable : false,
				width:40,
				renderer:function(val){
					if(val==1) {
						return  '<img border="0" src="<?php echo ICONS;?>accept.png"/>';
					} else {
						return  '<img border="0" src="<?php echo ICONS;?>cancel_icon.gif"/>';
					}
				}
			},
			{header: 'User Name',  dataIndex: 'uid'},
			{header: 'Nama', dataIndex: 'name'},
			{header: 'Email', dataIndex: 'email'},
			{
				header: 'Group', 
				dataIndex: 'grp', 
				flex:1,
				menuDisabled : true,
				renderer:function(val){
					if(!val) {
						return 'Personal';
					} else {
						return val;
					}
				}
			}
		],
		features:[
			new Ext.create('Ext.ux.grid.FiltersFeature', {
				encode: true, 
				local: false,   
				filters: [
					{
						type: 'string',
						dataIndex: 'uid'
					},
					{
						type: 'string',
						dataIndex: 'name'
					},
					{
						type: 'string',
						dataIndex: 'grp'
					}
				]		
			})
		],
		height: Ext.getCmp(centerLayout).getHeight() - 2,
		width: Ext.getCmp(menuTBars).getWidth() - 2,
		renderTo: 'datacontrol-listusers',
		dockedItems: [
			Ext.create('Ext.toolbar.Paging', {
				dock: 'bottom',
				store: gridStore,
				items: [
					<?php if (isset($modAuths['del'])):?>
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
												Ext.getCmp('datagrid-listusers').getStore().load({params:{del:encodeURI(Ext.getCmp('tfrm_id').getValue())}});
												Ext.getCmp('tfrm_id').setValue('');
											}
																		
										}			
									}	
								});
								
							
							}
						}
					}, 
					<?php endif;?>
					'-',
					{
						xtype: 'combo',
						fieldLabel: 'Group',
						labelWidth: 35,
						id:'tfrm_grp',
						name: 'grp',
						editable :false,
						store: new Ext.create('Ext.data.Store', {
							autoLoad: true,
							autoDestroy: true,
							fields: ['id', 'name'],
							proxy:{
								type: 'ajax',
								url:'?d=cms&c=groups&act=combo&disp=grid',
								params:{}
							}
						}),
						queryMode: 'remote',
						displayField: 'name',
						valueField: 'id',
						triggerAction: 'all',
						allowBlank: false,
						listeners: {
							select:function(theField, theValue, objOptions){
								
								$.post('?c=sesschecked', '', function(data, status) 
								{					
									if(status == 'success') {
										var obj = jQuery.parseJSON(data);
										if (obj.sess==false){
											window.location.reload(true);
										} else {
																		
											Ext.getCmp('datagrid-listusers').getStore().setProxy({
													method:'POST',
													type: 'ajax',
													reader: {
														type: 'json',
														root: 'datatable',
														idProperty: 'id',
														totalProperty: 'total'
													},
													url:'?d=cms&c=listusers&act=data&mods=<?php echo $this->session->idmodule;?>&grp=' + theField.getValue(),
													params:{}
												});
											Ext.getCmp('datagrid-listusers').getStore().load();
																		
										}			
									}	
								});
								
							}
						}
					},
					<?php if (isset($modAuths['del'])):?>
					{
						xtype: 'hidden',
						id:'tfrm_id',
						value:''
					}
					<?php endif;?>
				],
				
			})
		]
	});	
	
	Ext.getCmp(statusModule).setText('Daftar User Accounts');
});
</script>
<div id="datacontrol-listusers"></div>