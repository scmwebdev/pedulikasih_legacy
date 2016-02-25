<?
echo 'START = '.date("Y-m-d H:i:s").'<br />';
include("../backend/db.php");
$data = grab_url('http://www.indosiar.com/master/programme');
if (strlen($data) > 500) file_put_contents(ROOTBASEPATH.'inc/index_v09_programme.php', $data);
echo 'END = '.date("Y-m-d H:i:s").'<br />';
?>
