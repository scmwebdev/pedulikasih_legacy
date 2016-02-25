<style>
.rowtit {display:block;width:100%;font-size:14px;font-weight:bold;padding:10px;margin-top:15px;border-bottom:5px solid #ff9900;}
.rowsmall {font-size:10px;}
#formBox table tr td {color:#000}
#formBox table tr td input[type=text] {border:1px solid #ccc;}
.error {color:red;font-size:10px;}
.errors {border:1px solid red;}
</style>
<img src="/assets/aksi/images/form.jpg" border="0" usemap="#Map" />
<map name="Map" id="Map">
    <area shape="rect" coords="272,846,366,923" href="/" />
    <area shape="rect" coords="253,32,397,184" href="/aksi" />
</map>
<div class="form">
    
    <div id="formBox">
    	<form action="/aksi/register/submit" method="post" enctype="multipart/form-data" name="formRegister" id="formRegister">
    		<table border="0" cellspacing="0" cellpadding="4">
    		  <tr>
    			<td>Nama :</td>
    			<td><input name="nama_lengkap" type="text" class="required" size="60" maxlength="50" /></td>
    		  </tr>
    		  <tr>
    			<td>Jenis Kelamin :</td>
    			<td><input type="radio" name="jenis_kelamin" value="L" checked />
    		Laki-laki &nbsp;&nbsp;&nbsp;&nbsp;
    		<input type="radio" name="jenis_kelamin" value="P" /> 
    		Perempuan
    		</td>
    		  </tr>
    		  <tr>
    			<td>Tempat / Tanggal Lahir :</td>
    			<td><input name="tempat_lahir" type="text" class="required" size="30" />
    			&nbsp;/&nbsp;
    			<input name="tanggal_lahir" type="text" class="required" size="10" id="tanggal_lahir" maxlength="10" /> 
    			(yyyy/mm/dd)</td>
    		  </tr>
    		  <tr>
    			<td valign="top">Alamat  :</td>
    			<td><textarea name="alamat" cols="30" rows="3" style="width:100%" class="required" id="alamat"></textarea></td>
    		  </tr>
    		  <tr>
    			<td>Telepon :</td>
    			<td><input name="no_telepon" type="text" class="required" size="30" maxlength="20" />
    			  &nbsp;</td>
    		  </tr>
    		  <tr>
    			<td>Email :</td>
    			<td><input name="email" type="text" class="required" id="email" size="40" maxlength="50" /></td>
    		  </tr>
    		  <tr>
    			<td>Pendidikan :</td>
    			<td><input name="pendidikan" type="text" class="required" size="60" maxlength="100" id="pendidikan" /></td>
    		  </tr>
    		  <tr>
    		    <td>Hobi :</td>
    		    <td><input name="hobi" type="text" class="required" size="60" maxlength="100" id="hobi" /></td>
    	      </tr>
    		  <tr>
    		    <td>Keahlian :</td>
    		    <td><input name="keahlian" type="text" class="required" size="60" maxlength="100" id="pendidikan4" /></td>
    	      </tr>
    		  <tr>
    		    <td>Pengalaman :</td>
    		    <td><input name="pengalaman" type="text" class="required" size="60" maxlength="100" id="pendidikan3" /></td>
    	      </tr>
    		  <tr>
    			<td valign="top">Security Code :</td>
    			<td>
    				<?php
    				  require_once($this->config->item('ROOTBASEPATH').'phpx/recaptchalib.php');
    				  echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
    				?>
    			</td>
    		  </tr>
    		</table>
    		<br/><br/>
    	  <p align="center"><input type="submit" name="submitnow" value="Daftar Sekarang" /></p>
    	</form>
    </div>

</div>
<link rel="stylesheet" media="screen" href="/assets/css/ui/dark-hive/jquery.ui.all.css" />
<script type="text/javascript" src="/assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="/assets/js/jquery.validate.js"></script>
<script type="text/javascript" src="/assets/js/jquery.form.js"></script>
<script type="text/javascript" src="/assets/js/jquery.blockUI.js"></script>
<script language="javascript">
$().ajaxStop($.unblockUI); 

$(document).ready(function() {
    $.datepicker.setDefaults({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
	
    $("#tanggal_lahir").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: '1920:2010'
    });
	
	var v = jQuery("#formRegister").validate({
	    ignore: "",
		rules: {
			email: { required: true, email: true },
			tanggal_lahir: { required: true, dateISO: true }
		},
		submitHandler: function(form) {
			$("#formBox").block();
			jQuery(form).ajaxSubmit({
                beforeSubmit: function(a,f,o) {
                },
                success: function(data) {
					if (data.substring(0,6) == "SUKSES") {
						var namax = document.formRegister.nama_lengkap.value;
						var emailx = document.formRegister.email.value;
						$("#formBox").html('<div style="font-family:\'Times New Roman\', Times, serif; font-size:24px; font-weight:bold;padding:20px;text-align:center;"><p>&nbsp;</p><p>Hallo '+namax+',<br/><br/>Registrasi Berhasil.<br/>Download Formulir dan bawa kembali pada saat pendaftaran ulang Audisi Aksi<br/>Tanggal 19 - 20 Juni 2013 pukul 07.00 di<br/><br/><b>STUDIO 5 INDOSIAR</b><br/>Jalan Damai 11, Daan Mogot<br/>Jakarta Barat<br/><br/><b>Follow Twitter <a href="https://twitter.com/aksiindosiar" target="_blank">@aksiindosiar.com</a></b><br/><br/><a href="/assets/aksi/formulir.pdf"><b>DOWNLOAD FORMULIR</b></a></p><p>&nbsp;</p><p>&nbsp;</p></div>');
						//window.location.href = '/aksi/sukses';
					} else {
						alert("Error:\n" + data);
						Recaptcha.reload();
					}
					
					$("#formBox").unblock();
                }
			});
		}
	});
	
    $('.number').each(function() {
        $(this).rules('add', {
            number: true
        });
    });
});
</script>