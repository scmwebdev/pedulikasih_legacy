<script language="javascript">
Ext.onReady(function(){

	function addUserResize(objComp, adjWidth, adjHeight, objOptions)
	{
		Ext.getCmp('formAuthAction-users').setHeight( adjHeight-15 );
		Ext.getCmp('formAuthAction-users').setWidth( adjWidth - 375);
	}
	
	Ext.getCmp(centerLayout).removeListener('resize', addUserResize);
	Ext.getCmp(centerLayout).addListener('resize', addUserResize);
	
	new Ext.create('Ext.form.Panel', {
		title: '<?php echo ( isset($editData['id']) ? 'Edit Data' : 'Tambah Data' );?>',
		bodyPadding: 10,
		width: 350,
		frame:true,
		url: '?d=cms&c=users&act=save&mods=<?php echo $this->session->idmodule;?>',
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
				value: '<?php echo uniqid('user', true);?>'
			},
			<?php endif;?>
			{
				fieldLabel: 'User Name',
				id:'tfrm_uid',
				name: 'uid',
				width: 340,
				maxLength : 80,
				allowBlank: false,
				value: '<?php echo ( isset($editData['uid']) ? $editData['uid'] : '' );?>'
			},
			{
				fieldLabel: 'Nama',
				id:'tfrm_realname',
				name: 'name',
				width: 340,
				maxLength : 255,
				allowBlank: false,
				value: '<?php echo ( isset($editData['name']) ? $editData['name'] : '' );?>'
			},
			{
				fieldLabel: 'Password',
				id:'tfrm_pass',
				name: 'pass',
				inputType: 'password',
				width: 340,
				maxLength : 80
				<?php if (!isset($editData['id'])) :?>
				,allowBlank: false
				<?php endif;?>
			},
			{
				fieldLabel: 'Re Password',
				id:'tfrm_repass',
				name: 'repass',
				inputType: 'password',
				width: 340,
				maxLength : 80
				<?php if (!isset($editData['id'])) :?>
				,allowBlank: false
				<?php endif;?>
			},
			{
				fieldLabel: 'Email',
				id:'tfrm_email',
				name: 'email',
				width: 340,
				maxLength : 255,
				value:'<?php echo ( isset($editData['email']) ? $editData['email'] : '' );?>'
			},
			{
				xtype: 'combo',
				fieldLabel: 'User Group',
				id:'tfrm_grp',
				name: 'grp',
				typeAhead : true,
				width: 340,
				store: new Ext.create('Ext.data.Store', {
					autoLoad: true,
					autoDestroy: true,
					fields: ['id', 'name'],
					proxy:{
						type: 'ajax',
						url:'?d=cms&c=groups&act=combo',
						params:{}
					}
				}),
				queryMode: 'remote',
				displayField: 'name',
				valueField: 'id',
				triggerAction: 'all',
				allowBlank: false
				<?php if (isset($editData['id'])) :?>
				,
				valueNotFoundText : '<?php echo (!empty($editData['grpname']) ? $editData['grpname'] : 'Personal');?>',
				value:<?php echo $editData['grp'];?>
				<?php endif;?>
			},
			{
				xtype      : 'radiogroup',
				fieldLabel : 'Status',
				allowBlank: false,
				msgTarget: 'side',
				autoFitErrors: false,
				columns: [75, 100],
				vertical: false,
				items: [
					{
						boxLabel  : 'ACTIVE',
						name      : 'status',
						inputValue: '1',
						id        : 'tfrm_status1',
						checked   : <?php echo ( isset($editData['status']) ? ( $editData['status']==1 ? 'true' : 'false'  ) : 'true' );?>
					}, {
						boxLabel  : 'NON ACTIVE',
						name      : 'status',
						inputValue: '0',
						id        : 'tfrm_status2',
						checked   : <?php echo ( isset($editData['status']) ? ( $editData['status']==0 ? 'true' : 'false'  ) : 'false' );?>
					}
				]
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
							Ext.getCmp('formAuthAction-users').getStore().load({params:{}});
							Ext.getCmp(statusLayout).clearStatus({useDefaults:true, clear:false});
							<?php else:?>
							clickTopMenu('?d=cms&c=users');
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
														
							if (!isNaN(Ext.getCmp('tfrm_grp').getValue()))
							{
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
							} else {
								Ext.getCmp(statusLayout).clearStatus({useDefaults:true, clear:false});
								Ext.Msg.alert('Failed Information', 'Please select the right user group');
								Ext.getCmp('tfrm_grp').focus();
							}
														
						}			
					}	
				});
								
			}
		}],
		renderTo: 'formcontrol'
	});
	
	Ext.create('Ext.tree.Panel', {
		
		id:'formAuthAction-users',
		title:'Otorisasi Modul',
		width: Ext.getCmp(centerLayout).getWidth() - 375,
		height: Ext.getCmp(centerLayout).getHeight() - 15,
		padding:' 0 0 0 0',
		rootVisible: false, 
		store: Ext.create('Ext.data.TreeStore', {
			proxy: {
				type: 'ajax',
				method:'POST',
				url: '?c=nodes&act=auth<?php echo ( isset($editData['id']) ? '&usr=1&id='.$editData['id'] : '' );?>',
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
				var records = Ext.getCmp('formAuthAction-users').getView().getChecked(),
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
																
									$.post('?c=nodes&act=delmark', {usr: <?php echo $editData['id'];?>, del:Ext.getCmp('tfrm_uniqid').getValue(), mod:objdel.getValue()});
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
	
	Ext.getCmp(statusModule).setText('<?php echo ( isset($editData['id']) ? 'Edit' : 'Tambah' );?> User Accounts');
});
</script>
<div id="formcontrol" style="margin:5px; float:left;"></div>
<div id="authcontrol" style="margin:5px; float:left;"></div>