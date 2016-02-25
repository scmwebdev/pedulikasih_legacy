<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Comment extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
	}
	
	function index(){}
	
	function paging($artikel_id, $page)
	{		
		$this->load->model('article_model');
		
		$data['artikel_id'] = $artikel_id;
		$data['page']       = $page;
		$data['batas']      = 10;
		$data['num_links']  = 3;
		
		$this->load->view('article/article_comment_list', $data);
	}
	
	function submitnow() {
		header("Cache-Control: no-store, no-cache, must-revalidate"); 
		header("Cache-Control: post-check=0, pre-check=0", false); 
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Pragma: no-cache");
		header("Content-Type: text/html; charset=UTF-8");
		
		$artikel_id = (int)$this->input->post('artikel_id', TRUE);
		$komentar = strip_tags(trim($this->input->post('komentar', TRUE)));
		
		if ($this->session->userdata('openid') && is_numeric($artikel_id) && $komentar != "") {	
			$bad_ip = array('118.96.75.204');
			if (in_array($_SERVER['REMOTE_ADDR'],$bad_ip)) die('SUKSES');
			
			$sql = "select kategori_id,jenis_id from ivmweb2009_artikel_data where id=?";
			$query = $this->db->query($sql, array($artikel_id));
			if ($query->num_rows() > 0) {
				$row = $query->row();
				
				require_once($this->config->item('ROOTBASEPATH').'phpx/inc_badwords.php');
				$komentar = $this->db->escape(str_ireplace($arrBadWords, '', $komentar));

    		    $sess = $this->session->userdata('openid');
    			$nama = $this->db->escape(str_ireplace($arrBadWords, '', $sess['name']));
    		    $email = $this->db->escape($sess['email']);
		    
				$DBW = $this->load->database('dbwrite', TRUE);
				$sql = "insert into ivmweb_artikel_komentar (tanggal,id_artikel,kategori,jenis,nama,email,komentar,ip,openid_source,openid_uid,openid_uname) values (now(),?,".$row->kategori_id.",".$row->jenis_id.",'$nama','$email','$komentar','".$_SERVER['REMOTE_ADDR']."','".$sess['source']."','".$this->db->escape($sess['uid'])."','".$this->db->escape($sess['uname'])."')";
				$DBW->query($sql, array($artikel_id));
				
				$ref = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : '';
					
				//if (isset($_POST['publish']) && $_POST['publish'] == 'yes') {
					if ($sess['source'] == "fb") {
						$this->load->model('facebook_model');
						$this->facebook_model->sendFeed($komentar, $ref);
					} else {
						$this->load->model('twitter_model');
						$this->twitter_model->sendFeed($komentar, $ref);
					}
			    //}
				    
				die('SUKSES');
			} else {
                die('Error!');
			}
			$query->free_result();
		}
	}
	
	function formbox($artikel_id) {
	    if ($this->session->userdata('openid')) {
	        $sess = $this->session->userdata('openid');
?>
            <div style="padding:10px;background:#efefef;" id="CommentsBoxInput" class="RoundedBox8px">
            	<form action="/comment/submitnow" method="post" name="frmArtikelKomentar" id="frmArtikelKomentar"> 
            	<table border="0" cellpadding="2" cellspacing="0" width="100%">
            	<input name="artikel_id" type="hidden" value="<?=$artikel_id?>" />
            	<tr><td><b>Nama:</b></td><td><?=$sess['name']?></td></tr>
            	<tr><td><b>Account:</b></td><td><?=($sess['source'] == "tw") ? 'Twitter' : 'Facebook'?></td></tr>
                <tr><td valign="top"><b>Komentar:</b><td><textarea id="komentar" name="komentar" cols="40" rows="5" style="width:100%"></textarea></td></tr>
            	<tr><td>&nbsp;<td><div style="margin-top:10px"><input type="submit" name="Submit" value="Kirim Komentar" /></div></td></tr>
                </table>
            	</form>
        	</div>
    		<script language="javascript">
    		$().ajaxStop($.unblockUI); 
    		
    		$(document).ready(function() {        
    		    $("#frmArtikelKomentar").ajaxForm({
    		        beforeSubmit: function(a,f,o) {
    				    var theForm = f[0]; 
    				    if (!theForm.komentar.value) { 
    				        alert('Semua field harus terisi!'); 
    				        return false; 
    				    }
    						    
    		            o.dataType = 'html';
    		            $('#theArtikelCommentForm').block(); 
    		        },
    		        success: function(data) {
    					if (typeof data == 'object' && data.nodeType)
    				        data = elementToString(data.documentElement, true);
    				    else if (typeof data == 'object')
    				        data = objToString(data);    
    
    				    if (data == "SUKSES") {
    				    	ShowCommentsList(1);
    				    	$("#frmArtikelKomentar").html('<div style="text-align:center">Terima Kasih Atas Komentar Anda</div>');
    				    } else {
    				    	alert("Error:\n" + data);
    				    }										
    
    					$('#theArtikelCommentForm').unblock();
    		        }
    		    });
    		});
<?
        } else {
?>
            <div style="padding:10px;background:#efefef;text-align:center;" id="CommentsBoxInput" class="RoundedBox8px"><b>Gunakan Account Facebook atau Twitter Anda untuk Memberi Komentar</b><br/><br/><img src="/assets/images/facebook-connect.png" class="facebook_login_button"/>&nbsp;<img src="/assets/images/twitter-connect.png" class="twitter_login_button"/></div>
            <script language="javascript">
            $(".facebook_login_button").click(function (a) {FB.login(function (a) {FBLoginCheck(a)}, {scope: perms.join(",")})});
            $(function () {$(".twitter_login_button").click(function (a) {window.location = "/openid/twitter/login"})});
            </script>
<?
        }
	}
}
?>