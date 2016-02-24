<script language="javascript">
Ext.onReady(function() {
	
	Ext.getCmp(menuTBars).removeAll();
	Ext.getCmp(menuTBars).add(<?php echo setMenuToolBar($menutoolbar, true, $this->session->islogin);?>);
	
	if (parseInt($('#' + leftLayout).css('left').replace('px', ''))<0) Ext.getCmp(leftLayout).toggleCollapse(true);
	if (parseInt($('#' + rightLayout).css('left').replace('px', ''))>=0) Ext.getCmp(rightLayout).toggleCollapse(true);
	$('.x-splitter div.x-layout-split-right').css('visibility', 'hidden');
  $('.x-splitter div.x-layout-split-left').css('visibility', 'visible'); 

	<?php if(!empty($leftmenu)):?>
	Ext.getCmp(leftLayout).removeAll(true);
	Ext.getCmp(leftLayout).add([
		<?php $treepanel='';
		foreach($leftmenu as $k=>$v):
			if(empty($treepanel)) $treepanel = $v['id'];
		?>
		Ext.create('Ext.tree.Panel', {
			id: 'ltreepanel-<?php echo $v['id'];?>',
			stateId: '<?php echo 'state-'.$v['id'];?>',
			title: '<?php echo $v['title'];?>',
			qtip:	'<?php echo $v['desc'];?>',
			tooltip: '<?php echo $v['desc'];?>',
			iconCls:'<?php echo $v['iconcls'];?>',
			padding:'0 0 0 0',
			rootVisible: false, 
			store: Ext.create('Ext.data.TreeStore', {
				proxy: {
					type: 'ajax',
					url: '/index.php?c=lnodes'
				},
				root: {
					text: 'Root Node',
					expanded: true,
					draggable:false,
					id:"<?php echo $v['id'];?>"
				},
				folderSort: false 
			}),
			listeners:{
				//itemdblclick: function(mythis, myrecord, myitem, myindex, mye, myoptions)
				itemclick: function(mythis, myrecord, myitem, myindex, mye, myoptions)
				{
					if (myrecord.childNodes.length == 0)
					{
						if (myrecord.raw.data.pageurl !== '') {   							
							clickTopMenu(myrecord.raw.data.pageurl);						
						}								
					}
				}
			}
		}),
		<?php endforeach;?>
	]);
	Ext.getCmp('ltreepanel-<?php echo $treepanel;?>').expand(true);
	<?php endif;?>
	Ext.getCmp(statusModule).setText('HOME');
});
</script>