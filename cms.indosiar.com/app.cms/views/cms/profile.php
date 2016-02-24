<script language="javascript">
Ext.onReady(function(){

	new Ext.create('Ext.form.Panel', {
		title: 'Edit Profile',
		bodyPadding: 10,
		width: 368,
		frame:true,
		url: '?d=cms&c=profile&act=save',
		layout: 'anchor',
		defaults: {
			labelStyle: 'width:100px',
		},
		defaultType: 'textfield',
		items: [
			{
				xtype: 'hiddenfield',
				id:'tfrm_id',
				name: 'id',
				value: '<?php echo $this->session->userdata('id');?>'
			},
			{
				fieldLabel: 'Full Name',
				id:'tfrm_name',
				name: 'name',
				width: 340,
				maxLength : 255,
				allowBlank: false,
				value: '<?php echo $this->session->userdata('name');?>'
			},
			{
				fieldLabel: 'New Password',
				id:'tfrm_pass',
				name: 'pass',
				inputType: 'password',
				width: 340,
				maxLength : 80
			},
			{
				fieldLabel: 'Re Password',
				id:'tfrm_repass',
				name: 'repass',
				inputType: 'password',
				width: 340,
				maxLength : 80
			},
			{
				fieldLabel: 'Email',
				id:'tfrm_email',
				name: 'email',
				width: 340,
				maxLength : 255,
				value:'<?php echo $this->session->userdata('email');?>'
			}
			
		],
	
		buttons: [{
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
														
							buttons_objthis.up('form').getForm().reset();
							Ext.getCmp(statusLayout).clearStatus({useDefaults:true, clear:false});
														
						}			
					}	
				});
				
			}
		}, {
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
										
										$('.top-full-name').html(Ext.getCmp('tfrm_name').getValue());
										
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
	
	Ext.getCmp(statusModule).setText('Edit Profile');
});
</script>
<div id="formcontrol" style="margin:5px; float:left;"></div>