<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('setMenuToolBar'))
{

	function setMenuToolBar($menus=array(), $first=false)
	{
		$resfunc = "";
		if ($first==true) 
		{
			$resfunc .= "{
							iconCls: 'home1',
							text: 'HOME',
							listeners:{
								click:function(objthis, objevent, objoption){
					
									$.post('?c=sesschecked', '', function(data, status) 
									{					
										if(status == 'success') {
											var obj = jQuery.parseJSON(data);
											if (obj.sess==false){
												window.location.reload(true);
											} else {
												
												Ext.getCmp(leftLayout).removeListener('collapse', clickTopMenu);
												if (parseInt($('#' + leftLayout).css('left').replace('px', ''))<0) Ext.getCmp(leftLayout).toggleCollapse(true);	 
												if (parseInt($('#' + rightLayout).css('left').replace('px', ''))>=0) Ext.getCmp(rightLayout).toggleCollapse(true);
												$('.x-splitter div.x-layout-split-right').css('visibility', 'hidden');
												
												clickTopMenu('?c=home');
												
												
											}			
										}	
									});
								
								}
							}
							
						}";
		}
		
		foreach($menus as $key=>$val)
		{
			if (!empty($resfunc)) $resfunc .= ",";
			if ($val['separator']==1) $resfunc .= "'-',";
			
			$link = '?';
			if (!empty($val['url']))
			{
				$link = trim($val['url']);
			} else {
				if ($link!=='?') $link .= '&';
				$link .= ( !empty($val['folder']) ? 'd='.trim($val['folder']) : '' );
				if ($link!=='?') $link .= '&';
				$link .= ( !empty($val['controller']) ? 'c='.trim($val['controller']) : '' );
				if ($link!=='?') $link .= '&';
				$link .= ( !empty($val['method']) ? 'm='.trim($val['method']) : '' );
				if ($link!=='?') $link .= '&mods='.trim($val['id']).trim($val['params']);
				if ($link=='?') $link = '?c=home';
			}
			
			if (!empty($val['nodes']))
			{
				if ($val['parent']==0)
				{
					$resfunc .= "{
									xtype:'splitbutton',
									//iconCls: '".trim($val['iconcls'])."',
									".((trim($val['iconcls']) == "") ? "" : "icon: '".ICONS.trim($val['iconcls']).".png',")."
									text: '".trim($val['title'])."',
									qtip: '".trim($val['desc'])."',
									tooltip: '".trim($val['desc'])."',
									menu:[".setMenuToolBar($val['nodes'])."]						
								}";
				} else {
					$resfunc .= "{
									//iconCls: '".trim($val['iconcls'])."',
									".((trim($val['iconcls']) == "") ? "" : "icon: '".ICONS.trim($val['iconcls']).".png',")."
									text: '".trim($val['title'])."',
									qtip: '".trim($val['desc'])."',
									tooltip: '".trim($val['desc'])."',
									menu:[".setMenuToolBar($val['nodes'])."]						
								}";
				}
			} else {
				$resfunc .= "{
								//iconCls: '".trim($val['iconcls'])."',
								".((trim($val['iconcls']) == "") ? "" : "icon: '".ICONS.trim($val['iconcls']).".png',")."
								text: '".trim($val['title'])."',
								qtip: '".trim($val['desc'])."',
								tooltip: '".trim($val['desc'])."',
								listeners:{
									click:function(objthis, objevent, objoption){
																			
										$.post('?c=sesschecked', '', function(data, status) 
										{					
											if(status == 'success') {
												var obj = jQuery.parseJSON(data);
												if (obj.sess==false){
													window.location.reload(true);
												} else {";
				
				if (empty($val['left_comp']))
				{
					$resfunc .= "
													if (parseInt($('#' + leftLayout).css('left').replace('px', ''))>=0) Ext.getCmp(leftLayout).toggleCollapse(true);
													$('.x-splitter div.x-layout-split-left').css('visibility', 'hidden');";			
				}
				
				if (empty($val['right_comp']))
				{								
					$resfunc .= "
													if (parseInt($('#' + rightLayout).css('left').replace('px', ''))>=0) Ext.getCmp(rightLayout).toggleCollapse(true);
													$('.x-splitter div.x-layout-split-right').css('visibility', 'hidden');";
				}
				                                                                                
				$resfunc .= "                                          
													clickTopMenu('".$link."');
													
												}			
											}	
										});
									
									}
								}
								
							}";
			}
			
		}
		return $resfunc;
	}
	
}

if ( ! function_exists('setLeftMenuNodes'))
{

	function setLeftMenuNodes($menus=array())
	{
		$resfunc = "";
		foreach($menus as $key=>$val)
		{
			if (!empty($resfunc)) $resfunc .= ",";
			$link = '?';
			if (!empty($val['url']))
			{
				$link = trim($val['url']);
			} else {
				if ($link!=='?') $link .= '&';
				$link .= ( !empty($val['folder']) ? 'd='.trim($val['folder']) : '' );
				if ($link!=='?') $link .= '&';
				$link .= ( !empty($val['controller']) ? 'c='.trim($val['controller']) : '' );
				if ($link!=='?') $link .= '&';
				$link .= ( !empty($val['method']) ? 'm='.trim($val['method']) : '' );
				if ($link!=='?') $link .= '&mods='.trim($val['id']).trim($val['params']);
				if ($link=='?') $link = '';
			}
			$link = ( $val['menutype'] == 'NODE' ? $link : '' );
			
			$resfunc .= '{
						"text":"'.$val['title'].'",
						"qtip":"'.$val['desc'].'",
						"tooltip":"'.$val['desc'].'",
						'.((trim($val['iconcls']) == "") ? '' : '"icon":"'.ICONS.trim($val['iconcls']).'.png",').' 
						"id":"'.$val['id'].'", 
						"stateId":"state-'.$val['id'].'", 
						"itemId":"item-'.$val['id'].'", 
						"leaf":'.( $val['menutype'] == 'NODE' ? 'true' : 'false' ).',
						"data": {
									"pageurl":"'. ( !empty($link) ? $link : '' ) .'"
							    }
						
					  }';
		}
		return $resfunc;
	}
	
}