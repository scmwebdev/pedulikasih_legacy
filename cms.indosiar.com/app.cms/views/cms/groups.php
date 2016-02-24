<script language="javascript">
Ext.onReady(function(){
	
	function addGroupResize(objComp, adjWidth, adjHeight, objOptions)
	{
		Ext.getCmp('formAuthAction-groups').setHeight( adjHeight-15 );
		Ext.getCmp('formAuthAction-groups').setWidth(adjWidth - 375);
	}
	
	Ext.getCmp(centerLayout).removeListener('resize', addGroupResize);
	Ext.getCmp(centerLayout).addListener('resize', addGroupResize);
	
	Ext.create('Ext.form.Panel', {
		id:'formCtrlAction',
		title: '<?php echo ( isset($editData['id']) ? 'Edit Data' : 'Tambah Data' );?>',
		bodyPadding: 10,
		width: 350,
		frame:true,
		url: '?d=cms&c=groups&act=save&mods=<?php echo $this->session->idmodule;?>',
		layout: 'anchor',
		defaults: {
			labelStyle: 'width:80px',
		},
		defaultType: 'textfield',
		items: [
			{
				xtype: 'hiddenfield',
				id:'tfrm_id',
				name: 'id',
				value: '<?php echo ( isset($editData['id']) ? $editData['id'] : '' );?>'
			},
			{
				xtype: 'hiddenfield',
				id:'tfrm_auths',
				name: 'auths',
				value: ''
			},
			<?php if (isset($editData['id'])) :?>
			{
				xtype: 'hiddenfield',
				id:'tfrm_del',
				name: 'del',
				value: ''
			},
			{
				xtype: 'hiddenfield',
				id:'tfrm_uniqid',
				name: 'uniqid',
				value: '<?php echo uniqid('group', true);?>'
			},
			<?php endif;?>
			{
				fieldLabel: 'Nama Group',
				id:'tfrm_name',
				name: 'name',
				width: 340,
				maxLength : 255,
				allowBlank: false,
				value: '<?php echo ( isset($editData['name']) ? $editData['name'] : '' );?>'
			},
			{
				fieldLabel: 'Keterangan',
				id:'tfrm_description',
				name: 'description',
				width: 340,
				maxLength : 255,
				value: '<?php echo ( isset($editData['description']) ? $editData['description'] : '' );?>'
			}
			
		],
		buttons: [
		<?php if (isset($modAuths['view'])):?>
		{
			text: 'Reset',
			handler: function() {
			
				var buttons_objthis = this;
				$.post('?c=sesschecked', '', function(data, status) 
				{					
					if(status == 'success') {
						var obj = jQuery.parseJSON(data);
						if (obj.sess==false){
							window.location.reload(true);
						} else {
														
							<?php if(!isset($editData['id'])):?>
							buttons_objthis.up('form').getForm().reset();
							Ext.getCmp('formAuthAction-groups').getStore().load({params:{}});
							Ext.getCmp(statusLayout).clearStatus({useDefaults:true, clear:false});
							<?php else:?>
							clickTopMenu('?d=cms&c=groups&mods=<?php echo $this->session->idmodule;?>');
							<?php endif;?>
														
						}			
					}	
				});
				
			}
		}, 
		<?php endif;?>
		{
			text: 'Submit',
			handler: function() {
			
				var buttons_objthis = this;
				$.post('?c=sesschecked', '', function(data, status) 
				{					
					if(status == 'success') {
						var obj = jQuery.parseJSON(data);
						if (obj.sess==false){
							window.location.reload(true);
						} else {
														
							var form = buttons_objthis.up('form').getForm();
							if (form.isValid()) {
								Ext.getCmp(statusLayout).showBusy();
								form.submit({
									success: function(form, action) {
										Ext.getCmp(statusLayout).setStatus({
											text: 'Saving data successfuly',
											iconCls: 'x-status-valid',
											clear: false 
										}); 
									},
									failure: function(form, action) {
										Ext.getCmp(statusLayout).clearStatus({useDefaults:true, clear:false});
										Ext.Msg.alert('Failed Information', action.result.msg);
									}
								});
							}
														
						}			
					}	
				});
				
			}
		}],
		renderTo: 'formcontrol'
	});
	
	Ext.create('Ext.tree.Panel', {
		
		id:'formAuthAction-groups',
		title:'Otorisasi Modul',
		width: Ext.getCmp(centerLayout).getWidth() - 375,
		height: Ext.getCmp(centerLayout).getHeight() - 15,
		padding:' 0 0 0 0',
		rootVisible: false, 
		store: Ext.create('Ext.data.TreeStore', {
			proxy: {
				type: 'ajax',
				method:'POST',
				url: '?c=nodes&act=auth<?php echo ( isset($editData['id']) ? '&id='.$editData['id'] : '' );?>',
				params:{}
			},
			root: {
				text: 'Root Node',
				expanded: true,
				draggable:false,
				id:"0-view"
			},
			folderSort: false		
		}),
		listeners:{
			checkchange:function(node, ischecked){
				var objdel = Ext.getCmp('tfrm_del');
				if (objdel) 
				{
					if (ischecked==false)
					{
						if (objdel.getValue()!=='')
						{
							objdel.setValue(objdel.getValue() + '|' + node.data.id);
						} else {
							objdel.setValue(node.data.id);
						}
					}
				}
				
				checkUncheckChildTreePanel(node, ischecked);
				if (node.parentNode) checkUncheckParentTreePanel(node, ischecked);
				var records = Ext.getCmp('formAuthAction-groups').getView().getChecked(),
					names = [];
					
					Ext.Array.each(records, function(rec){
						names.push(rec.raw.value);
					});										
				Ext.getCmp('tfrm_auths').setValue(names.join('|'));
				<?php if (isset($editData['id'])) :?>
				if (objdel)
				{
					if (ischecked==false)
					{
					
						$.post('?c=sesschecked', '', function(data, status) 
						{					
							if(status == 'success') {
								var obj = jQuery.parseJSON(data);
								if (obj.sess==false){
									window.location.reload(true);
								} else {
																
									$.post('?c=nodes&act=delmark', {grp: <?php echo $editData['id'];?>, del:Ext.getCmp('tfrm_uniqid').getValue(), mod:objdel.getValue()});
									objdel.setValue('');
																
								}			
							}	
						});
										
					}
				}
				<?php endif;?>
			}
		},
		renderTo: 'authcontrol'		
	});
	
	Ext.getCmp(statusModule).setText('<?php echo ( isset($editData['id']) ? 'Edit' : 'Tambah' );?> User Groups');
});
</script>
<div id="formcontrol" style="margin:5px; float:left;"></div>
<div id="authcontrol" style="margin:5px; float:left;"></div>