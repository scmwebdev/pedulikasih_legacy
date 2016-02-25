<script language="JavaScript">
    extArray = new Array(".3gp", ".mp4", ".avi", ".mpg", ".mpeg", ".flv",".mp3",".wav");
    function LimitAttach(form, file) {
    allowSubmit = false;
    if (!file) return;
    while (file.indexOf("\\") != -1)
    file = file.slice(file.indexOf("\\") + 1);
    ext = file.slice(file.indexOf(".")).toLowerCase();
    for (var i = 0; i < extArray.length; i++) {
    if (extArray[i] == ext) { allowSubmit = true; break; }
    }
    if (allowSubmit) return true;
    else
    alert("Please only upload files that end in types:  "
    + (extArray.join("  ")) + "\nPlease select a new "
    + "file to upload and submit again.");
    return false;
    }
    //  End -->
</script>
<script type="text/javascript" src="http://www.indosiar.com/js/jquery.js"></script>
<script type="text/javascript" src="http://www.indosiar.com/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="http://www.indosiar.com/js/jquery.form.js"></script>
<script type="text/javascript">
	$().ajaxStop($.unblockUI); 
	
	$(function() {     
		$('#formx').ajaxForm({
			beforeSubmit: function(a,f,o) {
				o.dataType = 'html';
				$.blockUI('<br /><img src="http://www.indosiar.com/img/loading.gif" /><br /><b>Upload and Encoding...</b><br /><br />', { backgroundColor: '#fff', color: '#000' }); 
			},
			success: function(data) {			    
						if (typeof data == 'object' && data.nodeType)
							data = elementToString(data.documentElement, true);
						else if (typeof data == 'object')
							data = objToString(data);    
							
						$('#hasilx').html(data);
			}
		});
	}); 
</script>
<div align="center">
	<form action="videoconverter.php" name="formx" id="formx" method="POST" enctype="multipart/form-data">
	<table border="0" cellpadding="3" cellspacing="1">
	  <tr>
	    <td>Video File: </td>
	    <td><input id="FILE_FIELD" type="file" size="45" name="FILE_FIELD"></td>
	  </tr>
		<tr>
	    <td colspan="2">Convert to --> <input name="video" type="radio" value="mp4" /> mp4 <input name="video" type="radio" value="avi" /> avi <input name="video" type="radio" value="mpg" /> mpg <input name="video" type="radio" value="mpg" /> mpeg <input name="video" type="radio" value="flv" checked="checked" /> 
	    flv <input name="video" type="radio" value="mp3" /> 
	    mp3 </td>
	  </tr>
	</table>
	<div class="tgl"><input type="submit" name="Submit" value="Convert" onclick='return LimitAttach(this.form, this.form.FILE_FIELD.value)'></div>
	<div class="tgl">Maximum file download and convert 10 MB </div>
	</form>
</div>
    <img id="loading" src="http://www.lautanindonesia.com/img/loading.gif" style="display:none;">
	<div id="hasilx" style="padding:10px; border:1px solid #999; background:#efefef; text-align:center; margin:20px 0 20px 0;">Your video download link will show here...</div>
