// JavaScript Document
Ext.Loader.setConfig({enabled: true});
Ext.Loader.setPath('Ext.ux', assets + 'extjs4/ux');
Ext.require([
	'Ext.panel',
	'Ext.Viewport',
	'Ext.Component',
	'Ext.state',
	'Ext.toolbar',
	'Ext.button',
	'Ext.form',
	'Ext.window',
	'Ext.EventObject',
	'Ext.ux.statusbar.StatusBar',
	'Ext.ux.statusbar.ValidationStatus',
	'Ext.ux.form.TinyMCE',
	'Ext.ux.grid.FiltersFeature',
	'Ext.ux.grid.TransformGrid'
]); 

var menuTBars = 'menutoolbar';
var topLayout = 'toplayout';
var centerLayout = 'centerlayout';
var dockCenterLayout = {dockTop:'topDockCenterLayout'};
var statusLayout = 'statuslayout';
var statusModule = 'statusmodule';
var leftLayout = 'leftlayout';
var rightLayout = 'rightlayout';
var viewport;

Ext.onReady(function() {
	var now = new Date();
	
	Ext.QuickTips.init();
	//Ext.state.Manager.setProvider(Ext.create('Ext.state.CookieProvider'));
	if (islogin==true)
	{
		viewport = Ext.create('Ext.Viewport', {
			id: 'border-layout',
			layout: 'border',
			items: 
			[
				new Ext.create('Ext.panel.Panel', {
					id:topLayout,
					region: 'north',
					frame : true,
					bodyBorder:false,
					autoScroll:false,
					padding: '5',
					height: 65,
					style:{
						border:'none'
					},
					dockedItems:[
						new Ext.create('Ext.toolbar.Toolbar', {
							dock: 'bottom',
							id: menuTBars,
							layout: {
								overflowHandler: 'Menu'
							},
							items:[
								{
									iconCls: 'home1',
									text: 'HOME'
								}
							]
						})
					],
					contentEl: 'header-component-element'
				}),
				new Ext.create('Ext.ux.StatusBar', {
					id: statusLayout,
					region: 'south',
					style:{
						borderTop:'none'
					},
					defaultText: 'Ready',
					statusAlign: 'right',
					items: [
						{
							xtype:'label',
							text:'Copyright ' + ( now.getFullYear()== 2011 ? '2011' : '2011-' + now.getFullYear() ),
							style: {
								paddingLeft:'5px'
							}
						}, '-',
						{
							xtype:'label',
              width:200,
							id:statusModule,
							text:'HOME',
							style: {
								paddingLeft:'5px'
							}
						}
					]
				}),
				new Ext.create('Ext.panel.Panel', {
					id:rightLayout,
					region: 'east',
					stateId: rightLayout,
					title: 'Options',
					split: true,
					width: 200,
					minWidth: 200,
					maxWidth: 200,
					collapsible: true,
					animCollapse: true,
					collapseMode: 'mini',
					collapsed:true,
					hidden :false,
					margins: '0 5 0 0',
					layout: 'accordion',
					items: []
				}), 
				new Ext.create('Ext.panel.Panel', {
					id:leftLayout,
					region: 'west',
					stateId: leftLayout,
					title: 'Main Menu',
					split: true,
					width: 200,
					minWidth: 200,
					maxWidth: 200,
					collapsible: true,
					animCollapse: true,
					margins: '0 0 0 5',
					collapseMode: 'mini',
					collapsed:true,
					hidden :false,
					layout: 'accordion',
					items: []
				}),
				new Ext.create('Ext.panel.Panel', {
					id:centerLayout,
					region: 'center',
					margins: '0 0 0 0',
					cls: 'viewport',
					autoScroll:true,
					dockedItems:[],
					loader:{
								loadMask:true,
								autoLoad:true,
								scripts: true,
								method:'POST',
								url: '/index.php?c=home',
								params:{}
							}
				})
			],
            listeners:{
                afterrender:function(objthis, eOpts)
                {
                    $('#loadfirst').remove(); 
                }
            }
		});
        
	} else {
		
		Ext.create('Ext.window.Window', {
			height: 162, //175
			width: 250,
			draggable:false,
			resizable :false,
			closable:false,
			autoShow: true,
			bbar: new Ext.create('Ext.ux.StatusBar', {
				id: statusLayout,
				style:{
					borderTop:'none'
				},
				defaultText: 'Press ENTER to login'
			}),
			items: [
						Ext.create('Ext.Img', {
							src: assets + 'images/lg-login.png'
						}),
						Ext.create('Ext.form.Panel', {
							bodyPadding: 10,
							border:0,
							method: 'POST',
							url: '/index.php?c=login',
							layout: 'anchor',
							defaults: {
								labelStyle: 'width:60px'
							},
							defaultType: 'textfield',
							items: [
								{
									xtype: 'hidden',
									name: 'token',
									value: $('#token').html()
								},
								{
									fieldLabel: 'Username',
									name: 'uid',
									width: 250,
									allowBlank: false,
									enableKeyEvents :true,
									listeners: {
										keydown : function( objthis, e, opt )
										{
											if (e.getKey()==Ext.EventObject.ENTER) 
											{
											
												var form = this.up('form').getForm();
												if (form.isValid()) {
													Ext.getCmp(statusLayout).showBusy();
													form.submit({
														success: function(form, action) {
														   window.location.reload(true);
														},
														failure: function(form, action) {
															Ext.getCmp(statusLayout).setStatus({
																text: action.result.msg,
																iconCls: 'x-status-error',
																clear: false 
															}); 
														}
													});
												}
											
											}
										}
									}
								},
								{
									fieldLabel: 'Password',
									name: 'pass',
									width: 250,
									inputType: 'password',
									allowBlank: false,
									enableKeyEvents :true,
									listeners: {
										keydown : function( objthis, e, opt )
										{
											if (e.getKey()==Ext.EventObject.ENTER) 
											{
											
												var form = this.up('form').getForm();
												if (form.isValid()) {
													Ext.getCmp(statusLayout).showBusy();
													form.submit({
														success: function(form, action) {
														   window.location.reload(true);
														},
														failure: function(form, action) {
															Ext.getCmp(statusLayout).setStatus({
																text: action.result.msg,
																iconCls: 'x-status-error',
																clear: false 
															});
														}
													});
												}
											
											}
										}
									}
								}
							]
						})
			],
            listeners:{
                show:function(objthis, eOpts)
                {
                    $('#loadfirst').remove(); 
                }
            }
		});
		
		$('#token').remove();
	}

});