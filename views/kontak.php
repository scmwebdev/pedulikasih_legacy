<?php
$HTMLPageTitle= "Kontak Respond Online";
$sitename = "Kontak Respond Online";

include (APPPATH."views/inc_header.php");
$strID = "";
?>

<script language="Javascript" type="text/javascript">
function cek() {
	var themessage = "Maaf, Anda belum mengisi field: ";
	if (document.tanggapform.nama.value=="") {
		themessage = themessage + " - NAMA";
	}
	if (document.tanggapform.email.value=="") {
		themessage = themessage + " - EMAIL";
	}
	if (document.tanggapform.pertanyaan.value=="") {
		themessage = themessage + " - ISI PERTANYAAN";
	}
	if (document.tanggapform.alamat.value=="") {
		themessage = themessage + " - ALAMAT";
	}
	if (document.tanggapform.kodepos.value=="") {
		themessage = themessage + " - KODE POS";
	}
	if (document.tanggapform.telepon.value=="") {
		themessage = themessage + " - NO TELEPON";
	}


	//alert if fields are empty and cancel form submit
	if (themessage == "Maaf, Anda belum mengisi field: ") {
		document.tanggapform.kirim.disabled=true;
		document.tanggapform.submit();
	}
	else {
		alert(themessage);
		return false;
   	}
}

function cerdas() {
	for (xx=0; xx < document.tanggapform.elements.length; xx++)
	{
	   if (document.tanggapform.elements[xx].name == 'kota')
		{
		document.tanggapform.elements[xx].checked = false;
		}
	}
}

function storeCaret(ftext) {
	if (ftext.createTextRange) {
		ftext.caretPos = document.selection.createRange().duplicate();
	}
}
</script>
  <table width="100%" border=0 cellspacing=0 cellpadding=0 bgcolor=#FFFFFF>
    <tr> 
      <td width=1 bgcolor="#425163"><img src="<?=$this->config->item('URL_IMG')?>s.gif" width=1 height=1></td>
      <td colspan=3 bgcolor="#FFFFFF"><img src="<?=$this->config->item('URL_IMG')?>s.gif" width=1 height=1></td>
      <td width=1 bgcolor="#425163"><img src="<?=$this->config->item('URL_IMG')?>s.gif" width=1 height=1></td>
    </tr>
    <tr> 
      <td width=1 bgcolor="#425163"><img src="<?=$this->config->item('URL_IMG')?>s.gif" width=1 height=1></td>
      <td width=20 bgcolor="#DEDFE7"><img src="<?=$this->config->item('URL_IMG')?>s.gif" width=1 height=34></td>
      <td width=728 bgcolor="#DEDFE7"> <img src="<?=$this->config->item('URL_IMG')?>lr.gif" width=90 height=13><br>
        <a href="<?=$this->config->item('URL_ROOT')?>daua/humas" class=menu>HUMAS</a> | 
        <a href="<?=$this->config->item('URL_ROOT')?>daua/program" class=menu>PROGRAMME</a> | 
        <a href="<?=$this->config->item('URL_ROOT')?>daua/news" class=menu>NEWS</a> | 
        <a href="<?=$this->config->item('URL_ROOT')?>daua/produsi" class=menu>PRODUKSI</a> | 
        <a href="<?=$this->config->item('URL_ROOT')?>daua/sales" class=menu>SALES</a> | 
        <a href="<?=$this->config->item('URL_ROOT')?>daua/market" class=menu>MARKETING</a> | 
        <a href="<?=$this->config->item('URL_ROOT')?>daua/finacc" class=menu>FINANCE</a> | 
        <a href="<?=$this->config->item('URL_ROOT')?>daua/webadmin" class=menu>WEBADMIN</a> | 
        <a href="<?=$this->config->item('URL_ROOT')?>daua/engineering" class=menu>ENGINEERING</a> | 
        <a href="<?=$this->config->item('URL_ROOT')?>daua" class=menu>SEMUA DIVISI</a></td>
      <td width=20 bgcolor="#DEDFE7">&nbsp;</td>
      <td width=1 bgcolor="425163"><img src="<?=$this->config->item('URL_IMG')?>s.gif" width=1 height=1></td>
    </tr>
  </table>
  <table width="100%" border=0 cellspacing=0 cellpadding=0 bgcolor="#FFFFFF">
    <tr> 
      <td width=1 bgcolor="#425163"><img src="<?=$this->config->item('URL_IMG')?>s.gif" width="1" height="1"></td>
      <td width=20 bgcolor="#8C9AA5"><img src="<?=$this->config->item('URL_IMG')?>s.gif" width="1" height="22"></td>
      <td bgcolor="#8C9AA5"><b><font color="#FFFFFF">KONTAK KAMI</font></b></td>
      <td bgcolor="#8C9AA5" align="right"><img src="<?=$this->config->item('URL_IMG')?>kx.gif" width=117 height=26 border=0 alt="kirimkan komentar Anda di sini!"></td>
      <td width=20 bgcolor="#8C9AA5">&nbsp;</td>
      <td width=1 bgcolor=425163><img src="<?=$this->config->item('URL_IMG')?>s.gif" width=1 height=1></td>
    </tr>
  </table>
  <table width="100%" border=0 cellspacing=0 cellpadding=0 bgcolor=#FFFFFF>
    <tr> 
      <td width=1 bgcolor="#425163"><img src="<?=$this->config->item('URL_IMG')?>s.gif" width=1 height=1></td>
      <td width=20>&nbsp;</td>
      <td width=728 align="center">
<br>
        <table width=100% border=0 cellspacing=0 cellpadding=0>
          <tr> 
            <td bgcolor="#8C9AA5"> 
              <table width=100% border=0 cellspacing=1 cellpadding=6>
                <tr> 
                  <td bgcolor="#EFEBEF" align=center> 
                    Kami menghimbau agar setiap pesan yang dikirim tidak menyinggung SARA dan pornografi.<br>
		    Kalimat yang tidak berkenan akan kami hapus.<br>
		    Terima kasih 
                  </td>
                </tr>
              </table>
            </td>
          </tr>
	</table>
 <br>
 						<div id="TanggapBoxInput"> 
            <form action="http://ivm.underdevel.com/daua/save" method="post" name="tanggapform" id="tanggapform">
              <table border="0" cellspacing="0" cellpadding="0" bgcolor="#CCCCCC" width="550" >
                <tr> 
                  <td> 
                    <table border="0" cellspacing="1" cellpadding="4" width="100%">
                      <tr> 
                        <td bgcolor="#ECECEC" align="center"> 
                          <table border="0" cellpadding="2" cellspacing="0" width="100%">
                            <tbody> 
                            <tr> 
                              <td valign="top" align="right"><b>Tujuan</b></td>
                              <td align="left"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="1">
                                  <tr> 
                                    <td> 
                                      <input type="radio" value="humas" checked name="to">
                                      Humas </td>
                                    <td> 
                                      <input type="radio" value="program" name="to">
                                      Program </td>
                                    <td> 
                                      <input type="radio" value="news" name="to">
                                      News </td>
                                  </tr>
                                  <tr> 
                                    <td> 
                                      <input type="radio" value="produksi" name="to">
                                      Produksi </td>
                                    <td> 
                                      <input type="radio" value="sales" name="to">
                                      Sales </td>
                                    <td> 
                                      <input type="radio" value="market" name="to">
                                      Marketing </td>
                                  </tr>
                                  <tr> 
                                    <td> 
                                      <input type="radio" value="finacc" name="to">
                                      Finance </td>
                                    <td> 
                                      <input type="radio" value="webadmin" name="to">
                                      WebAdmin </td>
                                    <td> 
                                      <input type="radio" value="engineering" name="to">
                                      Engineering </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                            <tr>
                              <td align="right">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr> 
                              <td align="right"><font color="#FF0000">*</font><b>Nama 
                                Anda</b></td>
                              <td align="left"> 
                                <input name="nama" size="30">
                              </td>
                            </tr>
                            <tr> 
                              <td align="right"><font color="#FF0000">*</font><b>Email</b></td>
                              <td align="left"> 
                                <input name="email" size="35">&nbsp; <input type="checkbox" name="no_email" value="0">
                          <i>Jangan tampilkan email</i>
                              </td>
                            </tr>
                            <tr> 
                              <td valign="top" align="right"><b><font color="#FF0000">*</font>Alamat</b></td>
                              <td align="left"> 
                                <textarea name="alamat" cols="52" rows="2"></textarea>
                              </td>
                            </tr>
                            <tr> 
                              <td align="right" valign="top"><b><font color="#FF0000">*</font>Wilayah</b></td>
                              <td align="left"> 
                                <table width="100%" border="0" cellspacing="0" cellpadding="1">
                                  <tr> 
                                    <td> 
                                      <input type="radio" value="Jakarta Pusat" checked name="kota" onClick="this.form.kota_lain.value=''">
                                      Jakarta Pusat</td>
                                    <td> 
                                      <input type="radio" value="Jakarta Timur" name="kota" onClick="this.form.kota_lain.value=''">
                                      Jakarta Timur</td>
                                    <td> 
                                      <input type="radio" value="Jakarta Barat" name="kota" onClick="this.form.kota_lain.value=''">
                                      Jakarta Barat</td>
                                  </tr>
                                  <tr> 
                                    <td> 
                                      <input type="radio" value="Jakarta Utara" name="kota" onClick="this.form.kota_lain.value=''">
                                      Jakarta Utara</td>
                                    <td> 
                                      <input type="radio" value="Jakarta Selatan" name="kota" onClick="this.form.kota_lain.value=''">
                                      Jakarta Selatan</td>
                                    <td>&nbsp; </td>
                                  </tr>
                                </table>
                                Kota / wilayah lainnya: 
                                <input name="kota_lain" size="25" onClick="cerdas()">
                              </td>
                            </tr>
                            <tr> 
                              <td align="right"><b><font color="#FF0000">*</font>Kode 
                                Pos</b></td>
                              <td align="left"> 
                                <input name="kodepos" size="15">
                              </td>
                            </tr>
                            <tr> 
                              <td align="right"><b><font color="#FF0000">*</font>No. 
                                Telpon</b></td>
                              <td align="left"> 
                                <input name="telepon" size="25">
                              </td>
                            </tr>
                            <tr> 
                              <td align="right">&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                            <tr> 
                              <td align="right"><font color="#FF0000">*</font><b>Subjek</b></td>
                              <td align="left"> 
                                <input name="subjek" size="40">
                              </td>
                            </tr>
                            <tr> 
                              <td valign="top" align="right"><font color="#FF0000">*</font><b>Pertanyaan</b></td>
                              <td align="left"> 
                                <textarea cols="52" name="pertanyaan" rows="6" wrap="VIRTUAL" onSelect="storeCaret(this);" onClick="storeCaret(this);" onKeyUp="storeCaret(this);" onChange="storeCaret(this);"></textarea>
                              </td>
                            </tr>
                            <tr> 
                              <td colspan="2" align="center"> </td>
                            </tr>
                            </tbody> 
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              <br>
              <input name="kirim" type="submit" value="Kirim">
              <input name="hapus" type="reset" value="hapus">
              <p>Terima kasih, secepatnya kami akan membalas e-mail Anda.</p>
              <p><b>Indosiar memang untuk Anda !</b></p>
            </form>
          </div>
															<script type="text/javascript" src="<?=$this->config->item('URL_JS')?>jquery.form.js"></script>
															<script type="text/javascript" src="<?=$this->config->item('URL_JS')?>jquery.blockUI.js"></script>
															<script language="javascript">
															$().ajaxStop($.unblockUI); 
															
															$(document).ready(function() {        
															    $('#tanggapform').ajaxForm({
															        beforeSubmit: function(a,f,o) {
																			    var theForm = f[0]; 
																			    if (!theForm.nama.value || !theForm.pertanyaan.value || !theForm.subjek.value) { 
																			        alert('Semua field harus terisi!'); 
																			        return false; 
																			    }
																			    
															            o.dataType = 'html';
															            $('#TanggapBoxInput').block(); 
															        },
															        success: function(data) {
																					if (typeof data == 'object' && data.nodeType)
																			        data = elementToString(data.documentElement, true);
																			    else if (typeof data == 'object')
																			        data = objToString(data);    
											
																		    if (data == "SUKSES") {
																		    	$("#tanggapform").clearForm();
																		    	alert('Thank you');
																		    } else {
																		    	alert("Error:\n" + data);
																		    }										
																			$('div#TanggapBoxInput').unblock();
															        }
															    });
															}); 
															</script>        
        <br>
      </td>
      <td width=20>&nbsp;</td>
      <td width=1 bgcolor="#425163"><img src="<?=$this->config->item('URL_IMG')?>s.gif" width=1 height=1></td>
    </tr>
  </table>
<?
include (APPPATH."views/inc_footer.php");
?>