<!--<h1>Registrasi Ditutup</h1>
<p>&nbsp;</p>
<p>Untuk saat ini registrasi audisi Galaxy Superstar ditutup.</p>
<p>Terima kasih.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>-->

<style>
/*.rowtit {display:block;width:100%;font-size:14px;font-weight:bold;padding:10px;margin-top:15px;border-bottom:5px solid #ff9900;}
.rowsmall {font-size:10px;}
#formBox table tr td {color:#000}
#formBox table tr td input[type=text] {width:300px}*/
</style>
<h1>Registrasi</h1>
<div id="formBox">
	<form action="/galaxysuperstar/register/submit" method="post" enctype="multipart/form-data" name="formRegister" id="formRegister">
		<table width="100%" cellpadding="4" cellspacing="0">
			<tr>
				<td colspan="2"><div class="rowtit">A. DATA PRIBADI</div></td>
			</tr>
			<tr>
				<td width="200" style="width:200px">Nama Lengkap</td>
				<td><input type="text" name="nama_lengkap" /></td>
			</tr>
			<tr>
				<td width="200">Nama Panggilan</td>
				<td><input type="text" name="nama_panggilan" /></td>
			</tr>
			<tr>
				<td width="200">Usia</td>
				<td>
					<select name="usia" size="1">
<?
for ($i=17; $i<=50; $i++) echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select> Thn.
				</td>
			</tr>
			<tr>
				<td width="200">Jenis Kelamin</td>
				<td>
					<input type="radio" name="jenis_kelamin" value="Pria" checked /> Pria &nbsp;&nbsp; 
					<input type="radio" name="jenis_kelamin" value="Wanita" /> Wanita
				</td>
			</tr>
			<tr>
				<td width="200">Tempat/Tgl. Lahir</td>
				<td>
					<input type="text" name="tempat_lahir" /> / 
					<select name="tgl_lahir_dd" size="1">
<?
for ($i=1; $i<=31; $i++) echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select name="tgl_lahir_mm" size="1">
<?
for ($i=1; $i<=12; $i++) echo '<option value="'.$i.'">'.date("F", strtotime("2010-$i-1")).'</option>';
?>
					</select>
					<select name="tgl_lahir_yyyy" size="1">
<?
for ($i=1995; $i>=1950; $i--) echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
				</td>
			</tr>
			<tr>
				<td width="200">Identitas</td>
				<td>
					<select name="jenis_identitas" size="1">
						<option value="KTP">KTP</option>
						<option value="SIM">SIM</option>
						<option value="PASPOR">PASPOR</option>
					</select> 
					<input type="text" name="nomor_identitas" />
				</td>
			</tr>
			<tr>
				<td width="200">Pendidikan</td>
				<td><input type="text" name="pendidikan" /></td>
			</tr>
			<tr>
				<td width="200">Alamat Sekolah</td>
				<td>
					<input type="text" name="alamat_sekolah1" style="width:100%" /><br /><input type="text" name="alamat_sekolah2" style="width:100%" />
				</td>
			</tr>
			<tr>
				<td width="200">Pekerjaan</td>
				<td><input type="text" name="pekerjaan" /></td>
			</tr>
			<tr>
				<td valign="top">Alamat Tinggal</td>
				<td>
					<input type="text" name="alamat1" style="width:100%" /><br /><input type="text" name="alamat2" style="width:100%" />
				</td>
			</tr>
			<tr>
				<td valign="top">No. Telepon</td>
				<td>
					<input type="text" name="no_telepon" />
				</td>
			</tr>
			<tr>
				<td width="200">Email</td>
				<td><input type="text" name="email" /></td>
			</tr>
			<tr>
				<td colspan="2"><div class="rowtit">B. DATA ORANG TUA LAKI-LAKI</div></td>
			</tr>
			<tr>
				<td width="200">Nama</td>
				<td><input type="text" name="nama_ortu_laki" /></td>
			</tr>
			<tr>
				<td width="200">Usia</td>
				<td>
					<select name="usia_ortu_laki" size="1">
<?
for ($i=30; $i<=100; $i++) echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select> Thn.
				</td>
			</tr>
			<tr>
				<td width="200">Tempat/Tgl. Lahir</td>
				<td>
					<input type="text" name="tempat_lahir_ortu_laki" /> / 
					<select name="tgl_lahir_ortu_laki_dd" size="1">
<?
for ($i=1; $i<=31; $i++) echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select name="tgl_lahir_ortu_laki_mm" size="1">
<?
for ($i=1; $i<=12; $i++) echo '<option value="'.$i.'">'.date("F", strtotime("2010-$i-1")).'</option>';
?>
					</select>
					<select name="tgl_lahir_ortu_laki_yyyy" size="1">
<?
for ($i=1975; $i>=1900; $i--) echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
				</td>
			</tr>
			<tr>
				<td valign="top" width="200">Alamat Tinggal</td>
				<td>
					<input type="text" name="alamat_ortu_laki1" style="width:100%" /><br /><input type="text" name="alamat_ortu_laki2" style="width:100%" />
				</td>
			</tr>
			<tr>
				<td colspan="2"><div class="rowtit">C. DATA ORANG TUA PEREMPUAN</div></td>
			</tr>
			<tr>
				<td width="200">Nama</td>
				<td><input type="text" name="nama_ortu_perempuan" /></td>
			</tr>
			<tr>
				<td width="200">Usia</td>
				<td>
					<select name="usia_ortu_perempuan" size="1">
<?
for ($i=30; $i<=100; $i++) echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select> Thn.
				</td>
			</tr>
			<tr>
				<td width="200">Tempat/Tgl. Lahir</td>
				<td>
					<input type="text" name="tempat_lahir_ortu_perempuan" /> / 
					<select name="tgl_lahir_ortu_perempuan_dd" size="1">
<?
for ($i=1; $i<=31; $i++) echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
					<select name="tgl_lahir_ortu_perempuan_mm" size="1">
<?
for ($i=1; $i<=12; $i++) echo '<option value="'.$i.'">'.date("F", strtotime("2010-$i-1")).'</option>';
?>
					</select>
					<select name="tgl_lahir_ortu_perempuan_yyyy" size="1">
<?
for ($i=1975; $i>=1900; $i--) echo '<option value="'.$i.'">'.$i.'</option>';
?>
					</select>
				</td>
			</tr>
			<tr>
				<td valign="top width="200"">Alamat Tinggal</td>
				<td>
					<input type="text" name="alamat_ortu_perempuan1" style="width:100%" /><br /><input type="text" name="alamat_ortu_perempuan2" style="width:100%" />
				</td>
			</tr>
			<tr>
				<td colspan="2"><div class="rowtit">D. PRESTASI PRIBADI</div></td>
			</tr>
			<tr>
				<td colspan="2"><textarea name="prestasi_pribadi" cols="60" rows="3" style="width:100%"></textarea></td>
			</tr>
			<tr>
				<td colspan="2"><div class="rowtit">E. PILIHAN AUDISI</div></td>
			</tr>
			<tr>
				<td width="200">Menyanyi</td>
				<td>
					<input type="radio" name="pilihan_audisi_menyanyi" value="Solo" /> Solo &nbsp;&nbsp; 
					<input type="radio" name="pilihan_audisi_menyanyi" value="Duo" /> Duo &nbsp;&nbsp; 
					<input type="radio" name="pilihan_audisi_menyanyi" value="Trio" /> Trio &nbsp;&nbsp; 
					<input type="radio" name="pilihan_audisi_menyanyi" value="Kwartet" /> Kwartet &nbsp;&nbsp; 
					<input type="radio" name="pilihan_audisi_menyanyi" value="Group" /> Group &nbsp;&nbsp; 
					[<a href="javascript:;" onclick="$('input[name=pilihan_audisi_menyanyi]').attr('checked',false)">reset</a>]
				</td>
			</tr>
			<tr>
				<td width="200">&nbsp;</td>
				<td>
					Jumlah Group <input type="text" name="pilihan_audisi_menyanyi_jml_group" style="width:50px" />
				</td>
			</tr>
			<tr>
				<td width="200">Menari</td>
				<td>
					<input type="radio" name="pilihan_audisi_menari" value="Solo" /> Solo &nbsp;&nbsp; 
					<input type="radio" name="pilihan_audisi_menari" value="Duo" /> Duo &nbsp;&nbsp; 
					<input type="radio" name="pilihan_audisi_menari" value="Trio" /> Trio &nbsp;&nbsp; 
					<input type="radio" name="pilihan_audisi_menari" value="Kwartet" /> Kwartet &nbsp;&nbsp; 
					<input type="radio" name="pilihan_audisi_menari" value="Group" /> Group &nbsp;&nbsp; 
					[<a href="javascript:;" onclick="$('input[name=pilihan_audisi_menari]').attr('checked',false)">reset</a>]
				</td>
			</tr>
			<tr>
				<td width="200">&nbsp;</td>
				<td>
					Jumlah Group <input type="text" name="pilihan_audisi_menari_jml_group" style="width:50px" />
				</td>
			</tr>
			<tr>
				<td width="200" valign="top">Lain-lain</td>
				<td><textarea name="pilihan_audisi_lainnya" cols="60" rows="2" style="width:100%"></textarea></td>
			</tr>
			<tr>
				<td width="200">&nbsp;</td>
				<td>
					Jumlah Group <input type="text" name="pilihan_audisi_lainnya_jml_group" style="width:50px" />
				</td>
			</tr>
			<tr>
				<td colspan="2"><div class="rowtit">F. PILIHAN KOTA AUDISI</div></td>
			</tr>
			<tr>
				<td width="200">Kota Audisi</td>
				<td>
					<input type="radio" name="kota_audisi" value="Jakarta"  /> Jakarta &nbsp;&nbsp;  
					<input type="radio" name="kota_audisi" value="Semarang" checked /> Semarang &nbsp;&nbsp; 
					<input type="radio" name="kota_audisi" value="Surabaya" /> Surabaya &nbsp;&nbsp; 
					<input type="radio" name="kota_audisi" value="Makassar" /> Makassar &nbsp;&nbsp; 
					<input type="radio" name="kota_audisi" value="Medan" /> Medan &nbsp;&nbsp; 
				</td>
			</tr>
			<tr>
				<td colspan="2"><div class="rowtit">G. WAJIB UPLOAD FOTO</div></td>
			</tr>
			<tr>
				<td valign="top" width="200">Upload Foto (JPG/JPEG/PNG)</td>
				<td>
					<input type="file" name="fotofile" size="40" />
					<div class="rowsmall">
					- Foto Ukuran 4R Close Up<br />
					- Besar file foto maksimum 8MB<br />
					- Format file foto JPG atau PNG
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2"><div class="rowtit">H. WAJIB UPLOAD VIDEO AUDIO</div></td>
			</tr>
			<tr>
				<td valign="top" width="200">File Video (MP4/3GP)</td>
				<td>
					<input type="file" name="videofile" size="40" />
					<div class="rowsmall">
					- Besar file video maksimum 8MB<br />
					- Format file video MP4 atau 3GP<br />
					- Lagu yang dibawakan tidak harus berbahasa Korea
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="2"><div class="rowtit">I. SECURITY CODE</div></td>
			</tr>
			<tr>
		    <td colspan="2">
        <?php
          require_once($this->config->item('ROOTBASEPATH').'phpx/recaptchalib.php');
          echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
        ?>
		    </td>
		  </tr>
			<tr>
				<td colspan="2" align="center">
					<br /><br /><br />
					<input type="submit" name="submitnow" value="Daftar Sekarang" />
				</td>
			</tr>
		</table>
	</form>
</div>
<script type="text/javascript" src="<?=$this->config->item('URL_JS')?>jquery.form.js"></script>
<script type="text/javascript" src="<?=$this->config->item('URL_JS')?>jquery.blockUI.js"></script>
<script language="javascript">
$().ajaxStop($.unblockUI); 

$(document).ready(function() {        
    $('#formRegister').ajaxForm({
        beforeSubmit: function(a,f,o) {
				    var theForm = f[0]; 
				    if (!theForm.videofile.value || !theForm.fotofile.value || !theForm.nama_lengkap.value || !theForm.email.value || !theForm.tempat_lahir.value || !theForm.nomor_identitas.value || !theForm.nama_ortu_laki.value || !theForm.nama_ortu_perempuan.value || !theForm.pendidikan.value || !theForm.pekerjaan.value || !theForm.alamat1.value || !theForm.no_telepon.value) {
				        alert('Semua field harus terisi!'); 
				        return false; 
				    }
				    
            o.dataType = 'html';
            $('#formBox').block(); 
        },
        success: function(data) {
						if (typeof data == 'object' && data.nodeType)
				        data = elementToString(data.documentElement, true);
				    else if (typeof data == 'object')
				        data = objToString(data);    

			    if (data.substring(0,6) == "SUKSES") {
			    	var namax = document.formRegister.nama_lengkap.value;
			    	var emailx = document.formRegister.email.value;
			    	var noreg = data.substring(7);
			    	
			    	$("#formBox").html('<p>&nbsp;</p><p>Hallo '+namax+',<br/><br/>Registrasi berhasil. Kami telah mengirim konfirmasi ke email '+emailx+'. Bila tidak ada di inbox email, coba cek di spam atau bulk email.<br/><br/>Terima Kasih.</p>');
			    	
			    	//$("#formRegister").clearForm();
			    	
			    	//alert('Thank you');
			    } else {
			    	alert("Error:\n" + data);
			    	Recaptcha.reload();
			    }										
			    
					$("#formBox").unblock();
        }
    });
});

function clearRadiobuttons(radioName) {
    var i=0;
    for (i=0; i < radioName.length; i++) { // Runs through all radio buttons
        radioName[i].checked = false; // Unchecks radio button
    }
}
</script>