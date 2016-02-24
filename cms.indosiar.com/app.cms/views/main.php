<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php echo TITLE; $themes = $this->session->userdata('themes'); ?></title>
<link rel="SHORTCUT ICON" href="<?php echo IMAGES;?>favicon.ico" />
<link rel="stylesheet" type="text/css" href="<?php echo EXTJS;?>resources/css/<?php echo ($this->session->islogin==true ? ( (empty($themes) || $themes == 'ext-all') ? 'ext-all' : $themes ) : 'ext-all');?>.css">
<link rel="stylesheet" type="text/css" href="<?php echo EXTJS;?>ux/grid/css/GridFilters.css" />
<link rel="stylesheet" type="text/css" href="<?php echo EXTJS;?>ux/grid/css/RangeMenu.css" />
<link rel="stylesheet" type="text/css" href="<?php echo EXTJS;?>ux/statusbar/css/statusbar.css" />
<link rel="stylesheet" type="text/css" href="<?php echo CSS;?>main.css">
<link rel="stylesheet" type="text/css" href="<?php echo CSS;?>iconcls.css">
<script type="text/javascript">
var assets = '<?php echo ASSETS;?>';
var islogin = <?php echo ($this->session->islogin==true ? 'true' : 'false');?>;
 var base_url = '<?=base_url()?>';
var winWidth = 0, winHeight = 0;

if(typeof(window.innerWidth) == 'number') {
  //Non-IE
  winWidth = window.innerWidth;
  winHeight = window.innerHeight;
} else if(document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
  //IE 6+ in 'standards compliant mode'
  winWidth = document.documentElement.clientWidth;
  winHeight = document.documentElement.clientHeight;
} else if(document.body && (document.body.clientWidth || document.body.clientHeight)) {
  //IE 4 compatible
  winWidth = document.body.clientWidth;
  winHeight = document.body.clientHeight;
}

var myWidth = winWidth;
var myHeight = winHeight;
</script>
<script type="text/javascript" src="<?php echo EXTJS;?>bootstrap.js"></script>
<script type="text/javascript">
Ext.onReady(function(){
		Ext.override(Ext.grid.Scroller, {
			  afterRender: function() {
				    var me = this;
				    me.callParent();
				    me.mon(me.scrollEl, 'scroll', me.onElScroll, me);
				    Ext.cache[me.el.id].skipGarbageCollection = true;
				    // add another scroll event listener to check, if main listeners is active
				    $(me.scrollEl.dom).scroll({scope: me}, me.onElScrollCheck);
			  },

			  // flag to check, if main listeners is active
			  wasScrolled: false,

			  // synchronize the scroller with the bound gridviews
			  onElScroll: function(event, target) {
				    this.wasScrolled = true; // change flag -> show that listener is alive
				    this.fireEvent('bodyscroll', event, target);
			  },

			  // executes just after main scroll event listener and check flag state
			  onElScrollCheck: function(event, target) {
				    var me = event.data.scope;
				    if (!me.wasScrolled)
				      // Achtung! Event listener was disappeared, so we'll add it again
				      me.mon(me.scrollEl, 'scroll', me.onElScroll, me);
				    me.wasScrolled = false; // change flag to initial value
			  }
		});

		Ext.override(Ext.form.HtmlEditor, {
		    defaultValue: '',
		    cleanDefaultValue: true,
		    cleanHtml: function(html) {
		        html = String(html);
		        if(Ext.isWebKit){
		            html = html.replace(/\sclass="(?:Apple-style-span|khtml-block-placeholder)"/gi, '');
		        }
		        if(this.cleanDefaultValue){
		            html = html.replace(new RegExp(this.defaultValue), '');
		        }
		        return html;
		    }
		});
});
</script>
<style type="text/css">
.x-grid-row-over .x-grid-cell-inner {font-weight:bold}
.x-action-col-cell img {height:16px; width:16px; cursor:pointer; margin:0 5px;}
.x-ie6 .x-action-col-cell img {position:relative; top:-1px;}
body, .viewport {
	background-image:url('<?php echo IMAGES;?>bglogo.png');
	background-repeat:no-repeat;
	background-attachment:fixed;
	background-position:right bottom;
}
</style>
</head>
<body>
<table id="loadfirst" width="100%" cellpadding="2" cellspacing="2" border="0">
    <tr>
        <td align="center" style="padding-top:10px;">
            <table cellpadding="2" cellspacing="2" border="0">
                <tr>
                    <td><img border="0" src="<?php echo IMAGES;?>wpspin_light.gif"/></td>
                    <td style="padding-left:5px;">Wait for loading component first</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php if ($this->session->islogin=='true'):?>
<div id="header-component-element" class="x-hide-display">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td align="left">
        	<div class="title" style="background-image:url(<?php echo IMAGES;?>indosiar.png); background-repeat:no-repeat; width:188px; height:25px;">&nbsp;</div>
        </td>
        <td align="right">
        	<div class="login-logout">
            	<form action="/index.php?c=logout" method="post">
                	<input type="hidden" name="logout" value="1"/>
                	<input class="logout" type="submit" value="" />
                </form>
            </div>
			<div class="login-border">|</div>
				<form action="" method="post">
					<div class="items">GRAY</div>
					<div class="items"><input type="radio" id="rdothemes1"  name="theme" value="ext-all-gray" <?php echo ( $themes == 'ext-all-gray' ? 'checked="checked"' : '' );?> /></div>
					<div class="items">BLUE</div>
					<div class="items"><input type="radio"  id="rdothemes2"  name="theme" value="ext-all" <?php echo ( (empty($themes) || $themes == 'ext-all') ? 'checked="checked"' : '' );?> /></div>
                </form>
            <div class="login-border">|</div>
            <div class="login-info"><span>Welcome</span>,&nbsp;&nbsp;<span class="top-full-name" style="font-weight:normal; color:#000000"><?php echo $this->session->userdata('name');?></span></div>
        </td>
      </tr>
    </table>
</div>
<style type="text/css">
<?php
$leftmenu = $this->modules->menuToolbars($this->modules->getIdFromKeyName('menu_kiri_otorisasi'), 'LEFT_TREE_PANEL');
foreach($leftmenu as $k=>$v) echo (trim($v['iconcls']) == "") ? '' : '.'.trim($v['iconcls']).' { background:transparant; background-image:url('.ICONS.trim($v['iconcls']).'.png); background-repeat:no-repeat; }'."\n";
	?>
</style>
<?php else:?>
<div id="token" style="display:none"><?php echo $this->session->set_uniqid();?></div>
<?php endif;?>
<script type="text/javascript" src="<?php echo ASSETS;?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo ASSETS;?>js/tinymce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo JS;?>layout.js"></script>
<script type="text/javascript" src="<?php echo JS;?>functions.js"></script>
<div id="endtags"/>
<script type="text/javascript">
function sessChecked() {
		$.post('/index.php?c=sesschecked', '', function(data, status)
		{
				if (status == 'success') {
						var obj = jQuery.parseJSON(data);
						if (obj.sess == false) window.location.reload(true);
				}
		});
}

function setArrUnique(my_array) {
    my_array.sort();
    for (var i=1; i<my_array.length; i++) if (my_array[i] === my_array[i-1]) my_array.splice(i--, 1);
    return my_array;
};
</script>
</body>
</html>
