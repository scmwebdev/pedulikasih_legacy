function checkUncheckChildTreePanel(node, ischecked) 
{
	var objdel = Ext.getCmp('tfrm_del');
	node.eachChild(function(n){
		if (objdel) 
		{
			if (ischecked==false)
			{
				if (objdel.getValue()!=='')
				{
					objdel.setValue(objdel.getValue() + '|' + n.data.id);
				} else {
					objdel.setValue(n.data.id);
				}
			}
		}
		n.set('checked', ischecked); 
		checkUncheckChildTreePanel(n, ischecked);
	});	
}

function checkUncheckParentTreePanel (node, ischecked)
{
	if (ischecked==true && node.data.depth>1) {
		var obj = node.parentNode;
		obj.set('checked', ischecked);
		checkUncheckParentTreePanel(obj, ischecked);
	}
}

function changeThemes(xobj)
{
	$.post('/index.php?c=sesschecked', '', function(data, status) 
	{					
		if(status == 'success') {
			var obj = jQuery.parseJSON(data);
			if (obj.sess==false){
				window.location.reload(true);
			} else {
				
				
				$.post('?c=theme', { theme: xobj.val() }, function(data, status) 
				{					
					if(status == 'success') {
						window.location.reload(true);
					}	
				});
				
				
			}			
		}	
	});	
}

function showLeftComponent()
{
	if (parseInt($('#' + leftLayout).css('left').replace('px', ''))<0)
	{
		$('.x-splitter div.x-layout-split-left').css('visibility', 'visible');
		Ext.getCmp(leftLayout).toggleCollapse(true);
	}	
	Ext.getCmp(leftLayout).removeAll(true);
}

function showRightComponent()
{
	if (parseInt($('#' + rightLayout).css('left').replace('px', ''))<0)
	{
		$('.x-splitter div.x-layout-split-right').css('visibility', 'visible');
		Ext.getCmp(rightLayout).toggleCollapse(true);
	}	
	Ext.getCmp(rightLayout).removeAll(true);
}

function clickTopMenu(mlink)
{
	$.post('/index.php?c=sesschecked', '', function(data, status) 
	{					
		if(status == 'success') {
			var obj = jQuery.parseJSON(data);
			if (obj.sess==false){
				window.location.reload(true);
			} else {
				
				for(xvar in dockCenterLayout)
				{
					Ext.getCmp(centerLayout).removeDocked(Ext.getCmp(centerLayout).getDockedComponent(dockCenterLayout[xvar]),true);
				}
				Ext.getCmp(centerLayout).removeAll(true);
				Ext.getCmp(centerLayout).setAutoScroll(true);
				Ext.getCmp(statusLayout).clearStatus({useDefaults:true, clear:false});
				Ext.getCmp(centerLayout).getLoader().load({
					loadMask:true,
					scripts:true,
					method:'POST',
					url: mlink,
					params:{},
					failure : function(obj, res){
						Ext.Msg.alert('status : ' + res.statusText, res.responseText);
					}							
				});	
				
			}			
		}	
	});	
}

function setHelp(idhelp)
{
	$.post('/index.php?c=sesschecked', '', function(data, status) 
	{					
		if(status == 'success') {
			var obj = jQuery.parseJSON(data);
			if (obj.sess==false){
				window.location.reload(true);
			} else {
				
				Ext.create('Ext.window.Window', {
					title: 'HELP',
					autoShow : true,
					modal : true,
					iconCls:'help',
					height: 250,
					width: 400,
					layout: 'fit',
					items: {  
						xtype: 'panel',
						border: false,
						autoScroll:true,
						loader:{
							loadMask:true,
							autoLoad:true,
							scripts: true,
							method:'POST',
							url: '?c=help&id=' + idhelp
						}
					}
				});	
				
			}			
		}	
	});	
}

function setTab(vid, vtitle, vtype, vlink)
{
    $.post('/index.php?c=sesschecked', '', function(data, status) 
    {                    
        if(status == 'success') {
            var obj = jQuery.parseJSON(data);
            if (obj.sess==false){
                window.location.reload(true);
            } else {
               
               var ctab = Ext.getCmp('tabcontrol-articles').child('#' + 'tabpanel' + vid + '-' + vtype);
               if(ctab)
               {
                   Ext.getCmp('tabcontrol-articles').setActiveTab(ctab);
               } else {  
                   Ext.getCmp('tabcontrol-articles').add(
                       {                                         
                            id:'tabpanel' + vid + '-' + vtype,
                            title: (vtype!=='content' ? vtype + ': ' : '') + decodeURI(vtitle), 
                            autoScroll:true, 
                            closable :true,                                                                          
                            loader:{
                                loadMask:true,
                                autoLoad:true,
                                scripts: true,
                                method:'POST',
                                url: vlink 
                            }
                       }
                   );
                   Ext.getCmp('tabcontrol-articles').setActiveTab(Ext.getCmp('tabcontrol-articles').child('#' + 'tabpanel' + vid + '-' + vtype)); 
                     
               }
               
                
            }            
        }    
    });    
}

function setDownload(vlink1, vlink2)
{
    $.post(vlink1, '', function(data, status) 
    {                    
        if(status == 'success') {
            var obj = jQuery.parseJSON(data);
            if (obj.sess==false){
                window.location.reload(true);
            } else if (obj.msgbox!=='') {
                Ext.Msg.alert('Failed Information', obj.msgbox);
            } else {  
                window.open(vlink2 + '&tmp=' + obj.idtmp , 'download','width=300,height=200,menubar=none,status=none,location=none,toolbar=none,scrollbars=none')
            }            
        }    
    });    
}

function getFileSize(fsize)
{
    var byteSize = Math.round(fsize / 1024 * 100) * .01;
    var suffix = 'KB';
    if (byteSize > 1000) {
        byteSize = Math.round(byteSize *.001 * 100) * .01;
        suffix = 'MB';
    } 
    return byteSize + suffix;    
}

$(document).ready(function(){
	
	if (islogin==true) {
	
		$('#rdothemes1').click(function(){changeThemes($(this))});
		$('#rdothemes2').click(function(){changeThemes($(this))});
	
	}
	
});