<?
include (APPPATH."views/dropbox_header.php");
?>
<script type="text/javascript">
<!--

function validate_form ( )
{
    valid = true;

    if ( document.post.nama.value == "" )
    {
        alert ( "masukan kolom nama anda" );
        valid = false;
    }

    if ( document.post.tgl_lahir.value == "" )
    {
        alert ( "masukan kolom tempat tanggal lahir anda" );
        valid = false;
    }

    if ( document.post.telp.value == "" )
    {
        alert ( "masukan kolom no telp anda" );
        valid = false;
    }
    if ( document.post.alamat.value == "" )
    {
        alert ( "masukan kolom alamat anda" );
        valid = false;
    }
    if ( document.post.judul_naskah.value == "" )
    {
        alert ( "masukan kolom judul naskah anda" );
        valid = false;
    }	
    if ( document.post.naskah.value == "" )
    {
        alert ( "masukan kolom naskah anda" );
        valid = false;
    }	
    return valid;
}

//-->
</script>

<?
include (APPPATH."views/jseditor.php");
ShowTinyMCE("naskah");
?>
	<div style="float:left; width:650px;">
		<div style="margin-bottom:10px;padding:5px;background:#F7EFDF;" class="RoundedBox5px JudulKanal">Formulir Drop Box</div>
	  <form action="http://www.indosiar.com/dropbox/submit" method="post" name="post" onsubmit="return validate_form ( );">
      <table align="center" width="100%">
        <tr>
          <td > <strong>Nama Lengkap</strong></td>
          <td > : </td>
          <td  >
            <input name="nama" type="text" id="nama" size="50" />
          </td>
        </tr>
        <tr>
          <td><strong>Tempat Tanggal Lahir </strong></td>
          <td> : </td>
          <td>
            <input name="tgl_lahir" type="text" id="tgl_lahir" size="50" />
          </td>
        </tr>
        <tr>
          <td><strong>No. Hp/Telepon </strong></td>
          <td> : </td>
          <td>
            <input name="telp" type="text" id="telp" size="50" />
          </td>
        </tr>
        <tr>
          <td > <strong>Email</strong></td>
          <td > : </td>
          <td  >
            <input name="email" type="text" id="email" size="50" />
          </td>
        </tr>		
        <tr>
          <td><strong>Porfolio</strong></td>
          <td> : </td>
          <td>
            <textarea name="porfolio" cols="50" rows="5" id="porfolio"></textarea>
          </td>
        </tr>
        <tr>
          <td><strong>Alamat</strong></td>
          <td> : </td>
          <td>
            <textarea name="alamat" cols="50" rows="5" id="alamat"></textarea>
          </td>
        </tr>
        <tr>
          <td valign="top"><strong>Tema </strong></td>
          <td> : </td>
          <td>
		  <select name="tema">
            <option value="">Tema Lainnya</option>				  
<?
$sql = "select * from blog_gaul_tema_drop_box where status=0";
$query = $this->db->query($sql);
if ($query->num_rows() > 0) {
		foreach ($query->result() as $row)
		{
?>		
            <option value="<?=$row->id?>"><?=$row->tema?></option>
<?
		}
}
$query->free_result();
?>	
          </select><br />
		  <input name="tema_lainnya" type="text" id="tema_lainnya" size="50" onFocus="if(this.value=='--isi tema lainnya--') this.value='';"  value="--isi tema lainnya--" />
          </td>
        </tr>
        <tr>
          <td><strong>Judul Naskah </strong></td>
          <td> : </td>
          <td>
            <input name="judul_naskah" type="text" id="judul_naskah" size="50" />
          </td>
        </tr>
        <tr>
          <td colspan="3"><strong>Naskah</strong></td>
        </tr>
        <tr>
          <td colspan="3">
            <textarea name="naskah" cols="80" rows="30" id="naskah"></textarea>
          </td>
        </tr>
        <tr>
          <td colspan="3"><input type="checkbox" name="workshop" value="1">&nbsp;&nbsp; <strong>Saya pernah mengikuti workshop</strong></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">
            <div align="center">
              <input type="submit" name="Submit" value="Submit" />
              &nbsp;
              <input type="reset" name="Submit2" value="Reset" />
            </div>
          </td>
        </tr>
      </table>
	  </form>
	</div>
	<div style="float:right; width:270px;">
<?
include (APPPATH."views/dropbox_inc_samping.php");
?>
	</div>
<?
include (APPPATH."views/dropbox_footer.php");
?>