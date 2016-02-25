<style>
.rowtit {display:block;width:100%;font-size:14px;font-weight:bold;padding:10px;margin-top:15px;border-bottom:5px solid #ff9900;}
.rowsmall {font-size:10px;}
#formBox table tr td {color:#000;font-size:13px;}
#formBox table tr td textarea, #formBox table tr td input[type=text] {padding:3px;border:1px solid #ccc;}
.error {color:red;font-size:10px;}
.errors {border:1px solid red;}
</style>
<img src="/assets/afi2013/images/form.jpg?2" border="0" usemap="#Map" />
<map name="Map" id="Map">
	<area shape="rect" coords="477,1833,680,1877" href="#" />
</map>
<div class="form">
    
    <div id="formBox">
    	<form action="/afi2013/register/submit" method="post" enctype="multipart/form-data" name="formRegister" id="formRegister">
    	  <table border="0" cellspacing="0" cellpadding="5" width="100%">
    	    <tr>
    	      <td colspan="2"><div class="title">BIODATA</div></td>
  	      </tr>
    	    <tr>
    	      <td>Nama Lengkap* :</td>
    	      <td><input name="nama_lengkap" type="text" class="required" size="60" maxlength="50" /></td>
  	      </tr>
    	    <tr>
    	      <td>Nama Panggilan* :</td>
    	      <td><input name="nama_panggilan" type="text" class="required" maxlength="20" /></td>
  	      </tr>
    	    <tr>
    	      <td>Jenis Kelamin* :</td>
    	      <td><input type="radio" name="jenis_kelamin" value="PRIA" checked="checked" />
    	        Pria &nbsp;&nbsp;&nbsp;&nbsp;
    	        <input type="radio" name="jenis_kelamin" value="WANITA" />
    	        Wanita </td>
  	      </tr>
    	    <tr>
    	      <td>Tempat / Tanggal Lahir* :</td>
    	      <td><input name="tempat_lahir" type="text" class="required" size="40" />
    	        &nbsp;/&nbsp;
    	        <input name="tanggal_lahir" type="text" class="required" id="tanggal_lahir" maxlength="10" size="10" />
    	        (yyyy/mm/dd)</td>
  	      </tr>
    	    <tr>
    	      <td valign="top">Alamat* :</td>
    	      <td><textarea name="alamat" id="alamat" cols="60" rows="3" class="required"></textarea></td>
  	      </tr>
    	    <tr>
    	      <td>No Telepon Rumah* :</td>
    	      <td><input name="no_telepon" type="text" class="required number" size="30" maxlength="20" id="no_telepon" />
    	        &nbsp;</td>
  	      </tr>
    	    <tr>
    	      <td>No HP* :</td>
    	      <td><input name="no_hp" type="text" class="required number" size="30" maxlength="20" id="no_hp" /></td>
  	      </tr>
    	    <tr>
    	      <td>Tinggi / Berat Badan* :</td>
    	      <td><input name="tinggi_badan" type="text" class="required number" size="5" maxlength="3" />
    	        cm
    	        &nbsp;/&nbsp;
    	        <input name="berat_badan" type="text" class="required number" size="5" maxlength="3" />
    	        kg</td>
  	      </tr>
    	    <tr>
    	      <td>Ukuran Baju* :</td>
    	      <td><input type="radio" name="ukuran_baju" value="S" checked="checked" />
    	        S &nbsp;
    	        <input type="radio" name="ukuran_baju" value="M" />
    	        M &nbsp;
    	        <input type="radio" name="ukuran_baju" value="L" />
    	        L &nbsp;
    	        <input type="radio" name="ukuran_baju" value="XL" />
    	        XL &nbsp;
    	        <input type="radio" name="ukuran_baju" value="XXL" />
    	        XXL </td>
  	      </tr>
    	    <tr>
    	      <td>Ukuran Celana* :</td>
    	      <td><input name="ukuran_celana" type="text" class="required number" size="5" maxlength="2" /></td>
  	      </tr>
    	    <tr>
    	      <td>Ukuran Sepatu* :</td>
    	      <td><input name="ukuran_sepatu" type="text" class="required number" size="5" maxlength="2" /></td>
  	      </tr>
    	    <tr>
    	      <td>Pendidikan Terakhir* :</td>
    	      <td><input name="pendidikan" type="text" class="required" size="40" maxlength="30" id="pendidikan" /></td>
  	      </tr>
    	    <tr>
    	      <td>Pekerjaan* :</td>
    	      <td><input name="pekerjaan" type="text" class="required" size="40" maxlength="30" id="pekerjaan" /></td>
  	      </tr>
    	    <tr>
    	      <td valign="top">Penyakit yang Pernah Diderita* :</td>
    	      <td><textarea name="penyakit_diderita" id="penyakit_diderita" cols="60" rows="3" class="required"></textarea></td>
  	      </tr>
    	    <tr>
    	      <td colspan="2"><div class="title">NAMA ORANG TUA</div></td>
  	      </tr>
    	    <tr>
    	      <td>Nama Ayah* :</td>
    	      <td><input name="nama_ayah" type="text" size="60" class="required" id="nama_ayah" /></td>
  	      </tr>
    	    <tr>
    	      <td valign="top">Pekerjaan Ayah* :</td>
    	      <td><select name="pekerjaan_ayah" size="1" id="pekerjaan_ayah">
    	        <option value="Tidak Ada">Tidak Ada</option>
    	        <option value="Karyawan Swasta">Karyawan Swasta</option>
    	        <option value="Pegawai Negeri">Pegawai Negeri</option>
    	        <option value="Profesional">Profesional</option>
    	        <option value="Wiraswasta">Wiraswasta</option>
    	        <option value="Militer">Militer</option>
    	        <option value="Pensiun">Pensiun</option>
  	        </select>
    	        <div style="margin-top:5px;">
    	        Lainnya :
    	        <input name="pekerjaan_ayah_lainnya" type="text" size="40" maxlength="50" id="pekerjaan_ayah_lainnya" />
    	        </div></td>
  	      </tr>
    	    <tr>
    	      <td>No. Telepon/HP* :</td>
    	      <td><input name="no_telepon_ayah" type="text" class="required number" size="40" maxlength="50" id="no_telepon_ayah" /></td>
  	      </tr>
    	    <tr>
    	      <td colspan="2">&nbsp;</td>
  	      </tr>
    	    <tr>
    	      <td>Nama Ibu* :</td>
    	      <td><input name="nama_ibu" type="text" size="60" class="required" id="nama_ibu" /></td>
  	      </tr>
    	    <tr>
    	      <td valign="top">Pekerjaan Ibu* :</td>
    	      <td><select name="pekerjaan_ibu" size="1" id="pekerjaan_ibu">
    	        <option value="Tidak Ada">Tidak Ada</option>
    	        <option value="Karyawan Swasta">Karyawan Swasta</option>
    	        <option value="Pegawai Negeri">Pegawai Negeri</option>
    	        <option value="Profesional">Profesional</option>
    	        <option value="Wiraswasta">Wiraswasta</option>
    	        <option value="Militer">Militer</option>
    	        <option value="Pensiun">Pensiun</option>
  	        </select>
    	        <div style="margin-top:5px;">
    	        Lainnya :
    	        <input name="pekerjaan_ibu_lainnya" type="text" size="40" maxlength="50" id="pekerjaan_ibu_lainnya" />
    	        </div></td>
  	      </tr>
    	    <tr>
    	      <td>No. Telepon/HP* :</td>
    	      <td><input name="no_telepon_ibu" type="text" class="required number" size="40" maxlength="50" id="no_telepon_ibu" /></td>
  	      </tr>
    	    <tr>
    	      <td colspan="2"><div class="title">YANG BISA DIHUBUNGI SAAT DARURAT (tidak serumah)</div></td>
  	      </tr>
    	    <tr>
    	      <td>Nama* :</td>
    	      <td><input name="nama_darurat" type="text" class="required" id="nama_darurat" size="60" maxlength="50" /></td>
  	      </tr>
    	    <tr>
    	      <td valign="top">Alamat* :</td>
    	      <td><textarea name="alamat_darurat" id="alamat_darurat" cols="60" rows="3" class="required"></textarea></td>
  	      </tr>
    	    <tr>
    	      <td>No. Telepon/HP* :</td>
    	      <td><input name="no_telepon_darurat" type="text" size="60" maxlength="50" id="no_telepon_darurat" class="required number" /></td>
  	      </tr>
    	    <tr>
    	      <td>Hubungan dengan Pendaftar* :</td>
    	      <td><input name="hubungan_darurat" type="text" class="required" size="60" maxlength="50" id="hubungan_darurat" /></td>
  	      </tr>
    	    <tr>
    	      <td colspan="2"><div class="title">MINAT &amp; BAKAT</div></td>
  	      </tr>
    	    <tr>
    	      <td>Hobby* :</td>
    	      <td><input name="hobby" type="text" size="60" maxlength="50" id="hobby" class="required" /></td>
  	      </tr>
    	    <tr>
    	      <td>Jenis Musik yang Disukai* :</td>
    	      <td><input name="jenis_musik" type="text" size="60" maxlength="50" id="jenis_musik" class="required" /></td>
  	      </tr>
    	    <tr>
    	      <td>Penyanyi Wanita yang Disukai* :</td>
    	      <td><input name="penyanyi_wanita_favorit" type="text" size="60" maxlength="50" id="penyanyi_wanita_favorit" class="required" /></td>
  	      </tr>
    	    <tr>
    	      <td>Penyanyi Pria yang Disukai* :</td>
    	      <td><input name="penyanyi_pria_favorit" type="text" size="60" maxlength="50" id="penyanyi_pria_favorit" class="required" /></td>
  	      </tr>
    	    <tr>
    	      <td>Cita-cita* :</td>
    	      <td><input name="cita_cita" type="text" size="60" maxlength="50" id="cita_cita" class="required" /></td>
  	      </tr>
    	    <tr>
    	      <td colspan="2"><div class="title">KEMAMPUAN</div></td>
  	      </tr>
    	    <tr>
    	      <td>Kemampuan Menyanyi* :</td>
    	      <td><input type="radio" name="kemampuan_menyanyi" value="Biasa" checked="checked" />
    	        Biasa &nbsp;
    	        <input type="radio" name="kemampuan_menyanyi" value="Bagus" />
    	        Bagus &nbsp;
    	        <input type="radio" name="kemampuan_menyanyi" value="Sangat Bagus" />
    	        Sangat Bagus </td>
  	      </tr>
    	    <tr>
    	      <td>Alat Musik yang Dikuasai* :</td>
    	      <td><input name="alat_musik" type="text" size="60" maxlength="50" class="required" /></td>
  	      </tr>
    	    <tr>
    	      <td valign="top">Penghargaan Musik* :</td>
    	      <td><textarea name="penghargaan_musik" cols="60" rows="3" class="required"></textarea></td>
  	      </tr>
    	    <tr>
    	      <td valign="top">Penghargaan Non-Musik* :</td>
    	      <td><textarea name="penghargaan_non_musik" cols="60" rows="3" class="required"></textarea></td>
  	      </tr>
    	    <tr>
    	      <td colspan="2"><div class="title">UNGGAH DATA</div></td>
  	      </tr>
    	    <tr>
    	      <td>Foto Diri* :<br />
    	        <div style="font-size:10px">Close Up dan Seluruh Badan(berwarna)</div></td>
    	      <td valign="top"><input name="file_foto" type="file" class="required" size="60" id="file_foto" /></td>
  	      </tr>
    	    <tr>
    	      <td>Video* : <br/>
    	        <div style="font-size:10px">(format MP4/3GP, max. 10 MB)</div></td>
    	      <td valign="top"><input name="file_video" type="file" class="required" size="60" id="file_video" /></td>
  	      </tr>
    	    <tr>
    	      <td valign="top">&nbsp;</td>
    	      <td>&nbsp;</td>
  	      </tr>
    	    <tr>
    	      <td valign="top">Security Code* :</td>
    	      <td><?php
				  require_once($this->config->item('ROOTBASEPATH').'phpx/recaptchalib.php');
				  echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
				?></td>
  	      </tr>
  	    </table>
    	  <br/><br/>
    	  <p align="center"><input type="submit" name="submitnow" value="Daftar Sekarang" /></p>
   	  </form>
    </div>
    <br /><br />
    NB : Isilah nomor kontak Anda di form pendaftaran di atas dengan BENAR.<br />
    <br />
    Lampiran Dokumen yang harus dibawa ke tempat audisi saat Anda diputuskan <strong>LOLOS</strong>
    <link rel="stylesheet" media="screen" href="/assets/css/ui/dark-hive/jquery.ui.all.css" />
    <script type="text/javascript" src="/assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.form.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.blockUI.js"></script>
    :<br />
    1. Salinan kartu identitas diri.<br />
    2. Salinan ijasah minimal SMU/Sederajat.<br />
    3. Salinan sertifikat penghargaan.
</div>

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
						//var namax = document.formRegister.nama_lengkap.value;
						//var emailx = document.formRegister.email.value;
						//$("#formBox").html('<div style="font-family:\'Times New Roman\', Times, serif; font-size:24px; font-weight:bold;padding:20px;text-align:center;"><p>&nbsp;</p><p>Hallo '+namax+',<br/><br/>Registrasi Berhasil.<br/>Download Formulir dan bawa kembali pada saat pendaftaran ulang Audisi Aksi<br/>Tanggal 19 - 20 Juni 2013 pukul 07.00 di<br/><br/><b>STUDIO 5 INDOSIAR</b><br/>Jalan Damai 11, Daan Mogot<br/>Jakarta Barat<br/><br/><b>Follow Twitter <a href="https://twitter.com/aksiindosiar" target="_blank">@aksiindosiar.com</a></b><br/><br/><a href="/assets/aksi/formulir.pdf"><b>DOWNLOAD FORMULIR</b></a></p><p>&nbsp;</p><p>&nbsp;</p></div>');
						window.location.href = '/afi2013/sukses';
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
